<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require("db.class.php");
require 'mailer/autoload.php';
class Login extends Db{
  function __construct(){}
  public function login($dati=array()){
    try {
      $usrInfo = $this->checkEmail($dati['email']);
      $this->checkAct($dati['email']);
      $this->checkPwd($dati['pwd']);
      $this->setSession($usrInfo[0]);
      return "Credenziali corrette, stai per accedere all'area riservata";
    } catch (\Exception $e) {
      return $e->getMessage();
    } catch (PDOException $e){
      return $e->getMessage();
    }
  }

  private function checkEmail($email){
    $check = $this->simple("select * from usr where email = '".$email."';");
    if (count($check)==0) {
      throw new \Exception("Errore! Email non valida o scritta male", 1);
    }
    return $check;
  }

  private function checkAct($email){
    $check = $this->simple("select * from usr where attivo = 1 and email = '".$email."';");
    if (count($check)==0) {
      throw new \Exception("Errore! Il tuo account è stato disabilitato per motivi di sicurezza, contatta Beppe ;)", 1);
    }
    return $check;
  }

  private function checkPwd($pwd){
    $check = $this->simple("select id_user from usr where pwd = crypt('".$pwd."',pwd);");
    if (count($check)==0) {
      throw new \Exception("Errore! La password non è corretta o è stata digitata male.<br>Riprova, se l'errore persiste contatta Beppe ;)", 1);
    }
    return true;
  }

  private function setSession($dati=array()){
    $_SESSION['id_user']=$dati['id_user'];
    return true;
  }


// TODO: sistemare le funzioni per il recupero della password
  public function newPwd($email){
    $sql="select u.id from rubrica r, usr u where u.rubrica = r.id and u.attivo = 't' and r.email = '".$email."';";
    $row=$this->countRow($sql);
    if ($row>0){
      $utente=$this->simple($sql);
      $dati=$this->createPwd();
      $usr=$this->getUsername($email);
      $dati['id']=$utente[0]['id'];
      $update=array("salt"=>$dati['salt'],"pwd"=>$dati['criptPwd'],"id"=>$dati['id']);
      $sql="update usr set salt=:salt, pwd=:pwd where id=:id;";
      try {
        $out=$this->prepared("nuova password", $sql, $update);
        $out="<br />";
        $out .= $this->sendMail(array($email,$usr,$dati['clearPwd'],"password"));
        return $out;
      } catch (Exception $e) {
        return "Errore di sistema, non è stato possibile effettuare l'operazione richiesta! Riprova o segnala l'errore all'indirizzo beppenapo@arc-team.com";
      }
    }else{
      return "1";
    }
  }

  protected function getUsername($email){$u = explode("@",$email);return $u[0];}
  protected function createPwd(){
      $salt = $this->genSalt();
      $clearPwd = $this->genPwd($salt);
      $criptPwd = $this->criptPwd($salt,$clearPwd);
      return array("salt"=>$salt,"clearPwd"=>$clearPwd,"criptPwd"=>$criptPwd);
  }
  protected function genSalt(){ return '$2y$11$'.substr(md5(uniqid(rand(),true)),0,22);}
  private function genPwd($salt){
    $pwd = "";
    $pwdRand = array_merge(range('A','Z'), range('a','z'), range(0,9));
    for($i=0; $i < 10; $i++) {$pwd .= $pwdRand[array_rand($pwdRand)];}
    return $pwd;
  }
  protected function criptPwd($salt,$pwd){return hash('sha512',$pwd.$salt);}
  protected function sendMail($dati){
    $folder=$_SERVER['SERVER_NAME'];
    $mail = new PHPMailer(true);
    switch ($dati[3]) {
      case 'nuovo':
        $oggetto = 'Nuovo account per il sistema di gestione della documentazione dei lavori di Arc-Team';
        $bodyFile = "newUsr";
      break;
      case 'password':
        $oggetto = 'Nuova password per il tuo account sul sistema di getsione della documentazione dei lavori di Arc-Team';
        $bodyFile = "newPwd";
      break;
    }
    $altBody = file_get_contents($_SERVER["DOCUMENT_ROOT"].'/atWorks/bodyMail/'.$bodyFile.'.txt');
    $altBody = str_replace('%utente%', $dati[1], $altBody);
    $altBody = str_replace('%password%', $dati[2], $altBody);
    $body = file_get_contents($_SERVER["DOCUMENT_ROOT"].'/atWorks/bodyMail/'.$bodyFile.'.html');
    $body = str_replace('%utente%', $dati[1], $body);
    $body = str_replace('%password%', $dati[2], $body);
    try {
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'arcteam.archaeology@gmail.com';
      $mail->Password = 'alelucabepperupert';
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;
      //Recipients
      $mail->setFrom('arcteam.archaeology@gmail.com', 'Arc-Team');
      $mail->addAddress($dati[0],$dati[1]);
      $mail->addReplyTo('arcteam.archaeology@gmail.com', 'Arc-Team');
      //Content
      $mail->isHTML(true);
      $mail->Subject = $oggetto;
      $mail->Body    = $body;
      $mail->AltBody = $altBody;
      $mail->send();
      return "La password è stata inviata alla mail di riferimento. Puoi continuare ad utilizzare la nuova password o decidere di cambiarla dopo il primo login.";
    } catch (Exception $e) {
      return "Errore nell&apos;invio della mail!<br/>Se di seguito visualizzi un messaggio di errore, copialo ed invialo all&apos;amministratore di sistema - beppenapo@arc-team.com<br/>: ".$mail->ErrorInfo;
    }
  }
}
?>
