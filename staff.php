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

  <link href="css/default.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="shortcut icon" href="img/icone/favicon.ico" />
</head>
<body>
 <div id="container">
  <div id="wrap">
  <?php if ($_SESSION['username']!='guest'){require("inc/sessione.php");}?>
  <div id="header"><?php require_once ("inc/header.php"); ?></div><!--header-->
  <div id="content"><?php require_once ("inc/staffContent.php"); ?></div><!--content-->
  <div id="footer"><?php require_once ("inc/footer.php"); ?></div><!--footer-->
 </div><!-- wrap-->
 </div><!--container-->
<script type="text/javascript" src="lib/jquery-core/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="lib/menu.js"></script>
<script type="text/javascript" src="lib/funzioni.js"></script>

</body>
</html>
