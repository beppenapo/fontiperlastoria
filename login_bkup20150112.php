<?php
session_start();
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
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
  <script type="text/javascript" src="lib/jquery-core/jquery-1.4.4.min.js"></script>
  <script type="text/javascript" src="lib/jquery_friuli/js/jquery-ui-1.8.10.custom.min.js"></script>

  <link href="css/default.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="shortcut icon" href="img/icone/favicon.ico" />

  <style>
   table{width:850px;margin: 0px auto;}
   table tr td{padding:0px 50px;}
   div#loghi{margin-top:200px;}
  </style>
</head>
<body>
 <div id="container">
  <div id="wrap">
   <div id="loginWrap">
   <?php 
     if($_SESSION['username']=='guest') {
   ?>
    <div id="loginTitle">Bentornato</div>
    <div id="loginForm">
      <form id="login_form" name="login_form" action="inc/loginScript.php" method="post">
       <input name="login" type="hidden" value="yes"/>
       <label>Nome utente</label>
       <input id="username" name="username" class="text" type="text" />
       <div id="username_errors" class="form_errors"></div>
       <label>Password</label>
       <input id="password" name="password" class="text" type="password" />
       
       <input name="login_button" value="Accedi" type="submit" />
     </form>
    </div>
   <?php
     }else {
   ?>
    <div id="loginTitle">Ciao <?php echo($_SESSION['username']);?></div>
    <div id="loginForm">
      <div class="loginTitle2">La tua sessione di lavoro è già aperta!</div>
      <div class="login2" id="home">Torna alla home page</div>
      <div class="login2" id="mappa">Accedi alla mappa</div>
      <form id="login_form" name="login_form" action="inc/loginScript.php" method="post">
       <input name="login" type="hidden" value="no"/>
       <input name="login_button" value="Chiudi sessione" type="submit" />
     </form>
    </div>
   <?php } ?>
   </div>
  </div><!-- wrap-->
 </div><!--container-->
<script type="text/javascript" src="lib/menu.js"></script>
<script type="text/javascript" >
 $(document).ready(function() {
   $('#home').click(function(){window.location.href= 'home.php';});
   $('#mappa').click(function(){window.location.href= 'webgis.php';});
 });
</script>
</body>
</html>
