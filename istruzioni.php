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
  <link href="lib/jquery-ui-lampi/css/humanity/jquery-ui-1.8.18.custom.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="shortcut icon" href="img/icone/favicon.ico" />

  <style>
   .sezioni{cursor:pointer;font-size: 1em;}
   .sezioni h2{color:rgb(255, 137, 82); 
     padding: .5em .5em .5em .7em;
     -moz-border-radius: 0px;
     -webkit-border-radius:0px;
     border-radius:0px; 
    }
    .sezioni h2:hover, .aperto{color:rgb(255,255,255) !important;background-color:rgb(255, 137, 82);}
    span.ui-icon{float:left;margin-right:5px;}
    .sezioni h2, .slide{
      border:1px solid rgb(255, 137, 82) !important;
      margin:0px 10px 10px 10px !important; 
     }
    .pHover{
      font-size:14px !important;
      font-weight:bold !important;
      margin:0px !important;
      padding:5px!important;
      color:#fff !important;
      background-color:rgb(255, 137, 82);
    }
    .titoletto{position:absolute; top:30px; left: 28px; font-size:12px;}
    .link{color:rgb(255, 85, 85); font-weight:bold !important;}
    .link:hover{cursor:pointer; text-decoration:underline;}
    img.imgSez {display: block;margin-left: auto;margin-right: auto }
  </style>

</head>
<body>
 <div id="container">
  <div id="wrap">
   <div id="header"><?php require_once ("inc/header.php"); ?></div><!--header-->
   <div id="content"><?php require_once ("inc/istruzioniContent.php"); ?></div><!--content-->
   <div id="footer"><?php require_once ("inc/footer.inc"); ?></div><!--footer-->
  </div><!-- wrap-->
 </div><!--container-->
<script type="text/javascript">
var $accordion;
$(document).ready(function () {
  $accordion = $(".accordion").accordion({
   active: false,
   navigation: true,
   collapsible: false,
   autoHeight: false
  });
  $(".accordion").accordion("option", "icons",{ 'header': 'ui-icon-circle-plus', 'headerSelected': 'ui-icon-circle-minus' });

   $('.slide').hide();
   $('.toggle').click(function(){
    $(this).children('.slide').slideToggle();
    $(this).find('span').toggleClass('ui-icon-circle-plus ui-icon-circle-minus');
    $(this).find('h2').toggleClass('aperto');
   });

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
