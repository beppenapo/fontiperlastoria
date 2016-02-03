<?php
session_start();
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
ini_set( "display_errors", 0);
require("inc/db.php");
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
  <link href="css/scheda.css" type="text/css" rel="stylesheet" media="screen" />
  <link type="text/css" rel="stylesheet" href="lib/qtip/jquery.qtip.min.css" />
  <link href="lib/jquery-ui-1.11.4/jquery-ui.min.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="shortcut icon" href="img/icone/favicon.ico" />
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
   <?php require_once('inc/logoHub.php'); ?>
 <div id="livelloScheda">
  <ul>
   <li id="catalogoTitle" class="livAttivo">GESTIONE VOCABOLARI</li>
  </ul>
 </div>
 
 <div id="skArcheoContent">
  <div class="inner primo" style="padding-top:30px;">
   <div id="pulsanti" style="margin:30px;">
     <label style="display:block;margin-bottom:10px;">Compila i seguenti campi per inserire un nuovo Stato - Tutti i campi sono obbligatori</label>
     <input id="addDefinizione" name="addDefinizione" type="text" />
     <input type="button" id="add" name="add" value="Aggiungi Stato" />
   </div>
   <div style="float:left;width:90%;height:600px;overflow:auto;margin-left:30px;">
<?php
$statoquery = ("SELECT * FROM stato ORDER BY stato ASC;");
$statoexec = pg_query($connection, $statoquery);
$statorow = pg_num_rows($statoexec);
?>
<table id="vocabolariTable">
 <thead>
  <tr>
    <th id="intestaz">Stai modificando i valori della tabella "Stato"</th><th></th><th></th>
  </tr>
  </thead>
  <tbody>
   <?php
   if($statorow != 0) {
     for ($a = 0; $a < $statorow; $a++){
       $idStato = pg_result($statoexec, $a,"id"); 	
       $stato = pg_result($statoexec, $a,"stato");
       echo "<tr class='trListe' id='stato$idStato' tab='stato' def='$stato' rec='$idStato'><td>$stato</td><td class='modLista update'>modifica</td><td class='modLista del'>elimina</td></tr>";
     }
 }else{echo "<tr class='' ref=''><td colspan='3'>Nessuna definizione disponibile</td></tr>";}
 ?>  
  </tbody>
</table>
  </div>
  <div style="clear:both;"></div>
  </div>
 </div>
   </div><!--content-->
   <div id="footer"><?php require_once ("inc/footer.php"); ?></div><!--footer-->
  </div><!-- wrap-->
 </div><!--container-->
 <!--div invisibili -->
<script type="text/javascript" src="lib/jquery-core/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="lib/jquery-ui-1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="lib/qtip/jquery.qtip.min.js"></script>
<script type="text/javascript" src="lib/funzioni.js"></script>
<script type="text/javascript" >
var tab;
$(document).ready(function() {
	$('#add').click(function(){
      var newDef = $('#addDefinizione').val();
      if(!newDef){
      	alert('Attenzione!\nDevi inserire un valore prima di cliccare sul tasto "Aggiungi Stato"'); 
      	return false;
      }else{
      //alert(tab + ' ' +newDef);return false;
        $.ajax({
           url: 'inc/insertStatoScript.php',
           type: 'POST', 
           data: {newDef:newDef}, 
           success: function(data){
           	//$('#vocabolariTable tbody').html(data);
           	$(data)
           	.dialog()
           	.delay(2500)
           	.fadeOut(function(){ $(this).dialog("close");window.location.href = 'stato.php'; });
           }//success
        });//ajax
      }
     });
     
    $('td.del').each(function(){ 
     var def = $(this).parent('tr').attr('def');
     var id = $(this).parent('tr').attr('rec');
     var idTipDelete = 'delete-stato'+id;
     $(this).qtip({
     	 id: idTipDelete,
    	 content: { 
    	    text: 'Loading...',
    	    title: {
              text: 'Elimina il record "'+def+'"',
              button: 'Close'
          },
    	    ajax: {
    	       url: 'inc/deleteStatoConfirm.php',
             data: {id:id},
             type: 'POST'
    	    }
       },
       overwrite: false,
    	 style: {classes: 'qtip-shadow qtip-youtube ui-tooltip-rounded'},
    	 //style:{widget:true, def:false},
    	 position: {my: 'right center', at: 'left center'},
    	 show: {event: 'click'},
       hide: {event: false}
	 });
	}); 
	
	$('td.update').each(function(){ 
     var def = $(this).parent('tr').attr('def');
     var id = $(this).parent('tr').attr('rec');
     var idTipUpdate = 'update-stato'+id;
     $(this).qtip({
    	 id: idTipUpdate,
    	 content: { 
    	    text: 'Loading...',
    	    title: {
              text: 'Aggiorna il record "'+def+'"',
              button: 'Close'
          },
    	    ajax: {
    	       url: 'inc/updateStatoConfirm.php',
             data: {def:def, id:id},
             type: 'POST'
    	    }
       },
       overwrite: false,
    	 style: {classes: 'qtip-shadow qtip-bootstrap ui-tooltip-rounded'},
    	 position: {my: 'right center', at: 'left center'},
    	 show: {event: 'click'},
       hide: {event: false}
	 });
	}); 

});
</script>

</body>
</html>
