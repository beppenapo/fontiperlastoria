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
  <script type="text/javascript" src="lib/jquery-ui-lampi/js/jquery-ui-1.8.18.custom.min.js"></script>
  <!--<script type="text/javascript" src="lib/jquery_friuli/js/jquery-ui-1.8.10.custom.min.js"></script>-->



  <link href="css/default.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="lib/jquery-ui-lampi/css/humanity/jquery-ui-1.8.18.custom.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="shortcut icon" href="img/icone/favicon.ico" />

  <style>
   div#accordion a{color:rgb(171,200,55);}
   .ui-accordion .ui-accordion-content,.ui-accordion-header, #accordion h3{
     border:1px solid rgb(171,200,55) !important; 
     padding:0px !important; 
     margin:0px 10px 10px 10px !important; 
     -moz-border-radius: 0px;
     -webkit-border-radius:0px;
     border-radius:0px; 
    }
    .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, .ui-widget-content, .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default { background:transparent !important;}
    
    .ui-state-active a, .ui-state-active a:link, .ui-state-active a:visited, #accordion a:hover, .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active{color:#fff !important;background-color:rgb(171,200,55) !important;}
    .pHover{font-size:14px !important;font-weight:bold !important;margin:0px !important;padding:5px!important;color:#fff !important;background-color:rgb(171,200,55);}
    .titoletto{position:absolute; top:30px; left: 28px; font-size:12px;}
    .link{color:rgb(171,200,55); font-weight:bold !important;}
    .link:hover{cursor:pointer; text-decoration:underline;}
    img.imgSez {display: block;margin-left: auto;margin-right: auto }
  </style>

</head>
<body>
 <div id="container">
  <div id="wrap">
  <div id="header"><?php require_once ("inc/header.php"); ?></div><!--header-->
  <div id="content"><?php require_once ("inc/progCorrContent.php"); ?></div><!--content-->
  <div id="footer"><?php require_once ("inc/footer.inc"); ?></div><!--footer-->
 </div><!-- wrap-->
 </div><!--container-->
<script type="text/javascript">
var $accordion;
$(document).ready(function () {
  $accordion = $("#accordion").accordion({
   active: false,
   navigation: true,
   collapsible: true,
   autoHeight: false
  });
  $("#accordion").accordion("option", "icons",{ 'header': 'ui-icon-circle-plus', 'headerSelected': 'ui-icon-circle-minus' });



  var myProt='http://'; //protocollo
  var myHost= myProt+window.location.host;
  var target="_blank"; // _blank apre ogni link in una nuova finestra
  
  $('.link').click(function(){
    $(this).each(function(){
      var linkUrl = $(this).attr('rel');
      //window.location.href = linkUrl;
      window.open(linkUrl, target);
     });
   });
}); //fine funzione principale
</script>
<script type="text/javascript" src="lib/menu.js"></script>
</body>
</html>
