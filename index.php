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
		
  <link href="css/index.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="shortcut icon" href="img/icone/favicon.ico" />
</head>
<body>
<div id="container">
 <div id="wrap">
   <div id="messaggio">
    <div id="messaggioText"></div>
   </div>
   <div id="switch">
    <div id="home">HOME</div>
    <div id="webgis">WEBGIS</div>
    <div id="database">DATABASE</div>
   </div>
 </div>
</div>
<div id="footer"><?php include("inc/footer.inc"); ?></div>
<script type="text/javascript" src="lib/jquery-core/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="lib/jquery_friuli/js/jquery-ui-1.8.10.custom.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
$("#messaggioText").hide();
 $("#home").hover(function() {
   $("#messaggioText").fadeIn("slow").html("Entra nella sezione del sito dedicata al progetto. Qui troverai informazioni sulla metodologia e le fonti della ricerca, gli strumenti sviluppati, i progetti in corso.");
 });
 $("#home").mouseout(function() {
   $("#messaggioText").fadeOut("slow").html("");
 });
 $("#webgis").hover(function() {
   $("#messaggioText").fadeIn("slow").html("Da questo link potrai accedere direttamente al webgis, navigare tra le mappe a disposizione ed interrogarne i dati. ");
 });
 $("#webgis").mouseout(function() {
   $("#messaggioText").fadeOut("slow").html("");
 });

 $("#database").hover(function() {
   $("#messaggioText").fadeIn("slow").html("Consulta il catalogo delle schede e ricerca nel database le fonti che ti interessano! ");
 });
 $("#database").mouseout(function() {
   $("#messaggioText").fadeOut("slow").html("");
 });

 $("#home").click(function() { window.location.href= "home.php";});
 $("#webgis").click(function() { window.location.href= "webgis.php";});
 $("#database").click(function() { window.location.href= "ricerche.php";});
});
</script>
</body>
</html>
