<?php
session_start();
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
ini_set( "display_errors", 0);
require_once("inc/db.php");

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
  <link href="lib/jquery_friuli/css/start/jquery-ui-1.8.10.custom.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="css/scheda.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="shortcut icon" href="img/icone/favicon.ico" />
  <link type="text/css" rel="stylesheet" href="css/jquery.qtip.min.css" />
  <script type="text/javascript" src="lib/jquery-core/jquery-1.4.4.min.js"></script>
  <script type="text/javascript" src="lib/jquery_friuli/js/jquery-ui-1.8.10.custom.min.js"></script>
  <style type="text/css">
    div#content{border: 1px solid #C1FEAE;margin-top:50px;}
    table.mainData{width:100% !important;}
    table.mainData td{vertical-align: top !important;}
  </style>

</head>
<body>
 <div id="container">
  <div id="wrap">
   <?php if ($_SESSION['username']!='guest'){require("inc/sessione.php"); }?>
   <div id="content">
     <div id="logoSchedaSx"><img src="img/layout/logo.png" alt="logo" /></div> 
 <div id="livelloScheda">
  <ul>
   <li id="catalogoTitle" class="livAttivo">GESTIONE VOCABOLARI</li>
  </ul>
 </div>
 
 <div id="skArcheoContent">
  <div class="inner primo" style="padding-top:30px;">
  <div style="float:left;width:220px;height:600px;overflow:auto;margin-left:30px;direction:rtl;">

  <table id="catalogoTable" style="width:180px;">
   <caption></caption>
   <thead>
    <tr>
     <th>TABELLA</th>
    </tr>
   </thead>
   <tbody> 
    <tr class="link" title="Modifica Stato" ref='stato'><td>Stato</td></tr>
    <tr class="link" title="Modifica Provincia" ref='provincia'><td>Provincia</td></tr>
    <tr class="link" title="Modifica Comune" ref='comune'><td>Comune</td></tr>
    <tr class="link" title="Modifica Località" ref='localita'><td>Località</td></tr>
    <tr class="link" title="Modifica Indirizzo" ref='indirizzo'><td>Indirizzo</td></tr>
  </tbody>
  </table>
  </div>
  <div style="float:left;width:650px;height:600px;overflow:auto;margin-left:40px; margin-bottom:20px;" id="territorioList">
    
  </div>
  <div style="clear:both;"></div>
  </div>
 </div>
   </div><!--content-->
   <div id="footer"><?php require_once ("inc/footer.inc"); ?></div><!--footer-->
  </div><!-- wrap-->
 </div><!--container-->
 
 <!--div invisibili -->

<script type="text/javascript" src="lib/jquery.qtip.min-2.0.1.js"></script>
<script type="text/javascript" >
var tab;
$(document).ready(function() {
 $('.link').each(function(){
   $(this).click(function(){
     var cliccata = $(this);
     $('.link').not(cliccata).removeClass('cliccata');
     cliccata.addClass('cliccata');
     
     tab = cliccata.attr('ref');
     $('#intestaz').html('Stai modificando i valori della tabella <b>'+tab+'</b>');
     $('#territorioList').load('inc/'+tab+'.php');
     
   });//.link click
 });//.link each


});
</script>

</body>
</html>
