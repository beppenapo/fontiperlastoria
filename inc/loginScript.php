<?php
session_start();
ini_set( "display_errors", 1);

if($_REQUEST['login']=="yes"){
 include("db.php");
 $username=$_POST['username'];
 $password=$_POST['password'];
 $hub = $_POST['hub'];
 $query = ("SELECT * FROM usr where username='$username' and pwd='$password' and attivo=1;");
 $result=pg_query($connection, $query);
 $rowCheck = pg_num_rows($result);
 if($rowCheck>0){
   	
  while ($array=pg_fetch_array($result)){
   $_SESSION['id_user']=$array['id_user'];
   $_SESSION['username']=$username;
   $_SESSION['nome']=$array["nome"];
   $_SESSION['cognome']=$array["cognome"];
   $_SESSION['tipo']=$array['tipo'];
   $_SESSION['email']=$array['email']; 
   $_SESSION['pwd']=$array['pwd'];
   $_SESSION['attivo']=$array['attivo'];
   $_SESSION['schede']=$array['schede'];
   $_SESSION['hub']=$_POST['hub'];
   $_SESSION['start'] = time();
   
   $utente=$array['id_user'];
   $login = ("insert into connessioni(utente)values($utente);");
   $result2=pg_query($connection, $login); 
 
   if($hub==1){header("Location:../home.php");}
   if($hub==2){header("Location:../scheda_nuova.php?tpsch=7&def=fotografica");}
   
  }//end while 
  
 }else{
  
  header("Refresh: 3; URL=../login.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//IT"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="IT" >
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="author" content="Giuseppe Naponiello" />
  <meta name="keywords" content="gfoss, archaeology, anthropology, openlayer, jquery, grass, postgresql, postgis, qgis, webgis, informatic" />
  <meta name="description" content="Le fonti per la storia. Per un archivio delle fonti sulle valli di Primiero e Vanoi" />
  <meta name="robots" content="INDEX,FOLLOW" />
  <meta name="copyright" content="&copy;2011 Museo Provinciale" />

  <title>Le fonti per la storia. Per un archivio delle fonti sulle valli di Primiero e Vanoi</title>
  <link href="../css/default.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="shortcut icon" href="../img/icone/favicon.ico" />

  <style>
   table{width:850px;margin: 0px auto;}
   table tr td{padding:0px 50px;}
   div#loghi{margin-top:200px;}
   label{color: #747474;line-height: 18px;font-family: helvetica,arial,sans-serif;font-size: 16px;}
  </style>
</head>
<body>
 <div id="container">
  <div id="wrap">
   <div id="loginWrap">
    <div id="loginTitle">Attenzione</div>
    <div id="loginForm">
      <label style="text-align:center;"><strong>Login fallito!</strong></label><br/>
      <label>Riprova facendo attenzione a digitare correttamente lo username e/o la password.<br/>Se il problema sussiste è possibile che il tuo utente sia stato disabilitato.</label>
    </div>
  </div><!-- wrap-->
 </div><!--container-->
</body>
</html>
<?php
 }
}else{
 include("db.php");
 $utente = $_SESSION['id_user'];
 $logout = ("update connessioni set logout = now() where utente = $utente AND logout is null;");
 $result3=pg_query($connection, $logout); 

 session_destroy();
 header("Location:../home.php");
}
?>
