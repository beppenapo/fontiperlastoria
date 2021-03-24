<?php
require("db.class.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require ('mailer/autoload.php');

class General extends Db{
  function __construct(){}

  ###NOTE: FUNZIONI PER LISTE IMMAGINI
  public function imgWall($limit=array(), $filter=null){
    $sql="select * from viewscheda ".$filter." order by random() ";
    if(!empty($limit)){$sql .= " limit ".$limit['limit'].";";}
    return $this->simple($sql);
  }


  public function lazyLoad($filtro=null,$tag=null,$val=null){
    $out=array();

    switch ($filtro) {
      case 'miniere':
      $filter = "where idricerca = 70";
      $out['img'] = $this->imgWall(array(),$filter);
      $txt2 = ' appertenenti al progetto "Quando andavamo in miniera"';
      break;
      case 'tag':
        $filter = "where '".$tag."' in(select(unnest(tags))) ";
        $out['img'] = $this->imgWall(array(),$filter);
        $txt2 = 'a cui è associata la tag "'.$tag.'"';
      break;
      case 'geotag':
        $sql="select * from geotag where geoid = ".$val." order by random();";
        $out['img'] = $this->simple($sql);
        $txt2 = count($out['img']) == 1 ? ' scattata ' : ' scattate ';
        $txt2 .= ' in località "'.$tag.'"';
      break;
      case 'titolo':
        $keywords = str_replace(' ', ' & ', $tag);
        $filter = "WHERE to_tsvector(concat_ws(' ',sog_titolo,dgn_numsch,dgn_dnogg,cro_spec,sog_sogg,sog_note,sog_notestor,alt_note)) @@ to_tsquery('".$keywords."') ";
        $out['img'] = $this->imgWall(array(),$filter);
        $txt2 = count($out['img']) == 1 ? ' che contiene ' : ' che contengono ';
        $txt2 .= ' le parole "'.$tag.'"';
      break;
      case null:
        $out['img'] =  $this->imgWall();
        $txt2 = 'totali';
        break;
    }
    $tot = count($out['img']);
    if ($tot == 0) {
      $out['title'] = 'Nessuna immagine corrispondente al tuo criterio di ricerca!';
    }else {
      $txt1 = $tot == 1 ? ' immagine ' : ' immagini ';
      $out['title'] = $tot.$txt1.$txt2;
    }
    return $out;
  }

  private function remove_duplicateKeys($key,$data){
    $_data = array();
    foreach ($data as $v) {
      if (isset($_data[$v[$key]])) { continue; }
      $_data[$v[$key]] = $v;
    }
    $data = array_values($_data);
    return $data;
  }


  ###NOTE: FUNZIONI PER LISTE TAGS
  public function tagList(){
    $out = array();
    $out['geotag']=$this->geotag();
    $out['tag']=$this->tag();
    return $out;
  }

  private function geotag(){
    $sql = "SELECT geoid, tag, count(*) schede from geotag group by geoid,tag order by tag asc;";
    $arr =  $this->simple($sql);
    return $this->cluster($arr);
  }

  private function tag(){
    $sql="select row_number() over() id,unnest(tags) as tag, count(*) as schede from viewscheda group by tag having count(*) > 10 order by tag asc;";
    $arr =  $this->simple($sql);
    return $this->cluster($arr);
  }

  private function cluster($arr = array()){
    $max = max(array_column($arr, 'schede'));
    $cluster = $max / 10;
    $out=array();
    $font='';
    foreach ($arr as $k => $v) {
      switch (true) {
        case ($v['schede'] <= $cluster): $font = 12; break;
        case ($v['schede'] > $cluster && $v['schede'] <= ($cluster * 2) ): $font = 16; break;
        case ($v['schede'] > ($cluster * 2) && $v['schede'] <= ($cluster * 3) ): $font = 18; break;
        case ($v['schede'] > ($cluster * 3) && $v['schede'] <= ($cluster * 4) ): $font = 20; break;
        case ($v['schede'] > ($cluster * 4) && $v['schede'] <= ($cluster * 5) ): $font = 22; break;
        case ($v['schede'] > ($cluster * 5) && $v['schede'] <= ($cluster * 6) ): $font = 24; break;
        case ($v['schede'] > ($cluster * 6) && $v['schede'] <= ($cluster * 7) ): $font = 26; break;
        case ($v['schede'] > ($cluster * 7) && $v['schede'] <= ($cluster * 8) ): $font = 28; break;
        case ($v['schede'] > ($cluster * 8) && $v['schede'] <= ($cluster * 9) ): $font = 30; break;
        case ($v['schede'] > ($cluster * 9) && $v['schede'] <= $max ): $font = 32; break;
        default: $font = 12;
      }
      $out[$k]['geoid']=$v['geoid'];
      $out[$k]['tag']=$v['tag'];
      $out[$k]['schede']=$v['schede'];
      $out[$k]['size']=$font;
    }
    return $out;
  }

  public function getIdByNumsch($sk){
    return $this->simple("select id from viewscheda where dgn_numsch = '".$sk['numsch']."';");
  }


  public function feedback($dati=array()){
    $campi=[];
    foreach ($dati as $key => $value) { $campi[]=":".$key; }
    $sql = "insert into feedback(".str_replace(":","",implode(",",$campi)).") values(".implode(",",$campi).");";
    $pdo = $this->pdo();
    $exec = $pdo->prepare($sql);
    try {
      $exec->execute($dati);
      $this->sendMail($dati);
      return true;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  ### sendMail function
  protected function sendMail($dati=array()){
    $bodyTxt = "<p>Il giorno ".date('d m Y')." ".$dati['nome']." ha scritto:</p>";
    $bodyTxt .= "<p>".$dati['commento']."</p>";
    $bodyTxt .= "<br><a href='http://78.46.230.205/pdc.v2/scheda.php?scheda=".$dati['scheda']."' target='_blank'>apri la scheda</a> ";
    $bodyTxt .= "<p>Per rispondere utilizza la seguente mail fornita dall'utente: ".$dati['email']."</p>";

    $altBodyTxt = "Il giorno ".date('d m Y')." ".$dati['nome']." ha scritto:\n";
    $altBodyTxt .= $dati['commento'];
    $altBodyTxt .= "\nlink alla scheda: 78.46.230.205/pdc.v2/scheda.php?scheda=".$dati['scheda'];
    $altBodyTxt .= "\nPer rispondere utilizza la seguente mail fornita dall'utente: ".$dati['email'];
    $mail = new PHPMailer(true);
    try {
      $mail->SMTPDebug = 2;
      $mail->isSMTP();
      $mail->SMTPAuth = true;
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;
      $mail->Username = 'cooperativa.testo@gmail.com';
      $mail->Password = 'cooptesto2011';
      //Recipients
      $mail->setFrom('cooperativa.testo@gmail.com', 'Archivio Fotografico Cembra');
      // $mail->addAddress('servizio.urbanistica@comunita.altavalsugana.tn.it');
      // $mail->addBCC(getenv('PDCGMAIL'));
      $mail->addReplyTo($dati['email'], $dati['nome']);
      //Content
      $mail->isHTML(true);
      $mail->Subject = 'Archivio Fotografio Cembra - nuovo feedback';
      $mail->Body    = $bodyTxt;
      $mail->AltBody = $altBodyTxt;
      $mail->send();
      return true;
    } catch (Exception $e) {
      return "Errore nell'invio della mail!<br/>Se di seguito visualizzi un messaggio di errore, copialo ed invialo all'amministratore di sistema - cooperativa.testo@gmail.com<br/>: ".$mail->ErrorInfo;
    }
  }
}

?>
