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
  <link href="lib/jquery-ui-lampi/css/humanity/jquery-ui-1.8.18.custom.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="shortcut icon" href="img/icone/favicon.ico" />

  <style>
  .accordion a{color:rgb(0, 102, 255);}
  .ui-accordion .ui-accordion-content,.ui-accordion-header, .accordion h3{
     border:1px solid rgb(0, 102, 255) !important; 
     padding:0px !important; 
     margin:0px 10px 10px 10px !important; 
     -moz-border-radius: 0px;
     -webkit-border-radius:0px;
     border-radius:0px; 
  }
  .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, .ui-widget-content, .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default { background:transparent !important;}
    
  .ui-state-active a, .ui-state-active a:link, .ui-state-active a:visited, .accordion a:hover, .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active{color:#fff !important;background-color:rgb(0, 102, 255) !important;}
  .pHover{font-size:14px !important;font-weight:bold !important;margin:0px !important;padding:5px!important;color:#fff !important;background-color:rgb(0, 102, 255);}
  .titoletto{position:absolute; top:30px; left: 28px; font-size:12px;}
  .link{color:rgb(0, 102, 255); font-weight:bold !important;}
  .link:hover{cursor:pointer; text-decoration:underline;}
  img.imgSez {display: block;margin-left: auto;margin-right: auto }

  #imgDialog{background-color: rgba(255, 255, 255,0.8) !important;display:none;}  

  div#pan {
    width: 600px;
    height: 605px;
    overflow: hidden;
  }

  #imgControls{
   width:600px;
   margin:15px auto 0px;
   text-align:center;
  }
  </style>

</head>
<body>
 <div id="container">
  <div id="wrap">
  <div id="header"><?php require_once ("inc/header.php"); ?></div><!--header-->
  <div id="content"><?php require_once ("inc/webgisContent.php"); ?></div><!--content-->
  <div id="footer"><?php require_once ("inc/footer.inc"); ?></div><!--footer-->
 </div><!-- wrap-->
 </div><!--container-->


<div id="imgDialog">
 <div id="pan">
  <img src="img/layout/schema_relazionale.png" />
 </div>
 <div id="imgControls">
  <a id="zoomin" href="#"><img src="img/icone/zoom_in.png"></a>
  <a id="zoomout" href="#"><img src="img/icone/zoom_out.png"></a>
  <a id="fit" href="#"><img src="img/icone/arrow_out.png"></a>
 </div>
</div>

  <script type="text/javascript" src="lib/jquery-core/jquery-1.4.4.min.js"></script>
  <script type="text/javascript" src="lib/jquery_friuli/js/jquery-ui-1.8.10.custom.min.js"></script>
  <script type="text/javascript" src="lib/jquery-panzoom.js"></script>

<script type="text/javascript">
var $accordion;
$(document).ready(function () {

function initPanZoom() {
  $('#pan img').panZoom({
    'zoomIn':$('#zoomin'),
    'zoomOut':$('#zoomout'),
    'fit':$('#fit'),
    'debug':false
  });
};
initPanZoom();

  $accordion = $(".accordion").accordion({
   active: false,
   navigation: true,
   collapsible: true,
   autoHeight: false
  });
  $(".accordion").accordion("option", "icons",{ 'header': 'ui-icon-circle-plus', 'headerSelected': 'ui-icon-circle-minus' });

$('#thumb').click(function () {
 $('#imgDialog').dialog({
      resizable:false,
      modal:true,
      width: 650,
      //title: "Modifica sezione"//,
      //buttons: {'Chiudi form': function() {$(this).dialog('close');}}//buttons
   });//dialog
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
