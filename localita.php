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
    #comSel{width:400px;}
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
   <div class="toggle" style="margin:30px 0px 10px;">
    <div class="sezioni sezAperta" style="margin:30px 30px 10px; border:none;">
      <h2>Inserisci una nuova località</h2>
    </div>
   <div class="slide">
   <div id="pulsanti" style="margin:10px 30px 30px;">
   <label class="label" style="display:block;">Per inserire una Località devi prima selezionare un Comune</label>
   <select id="comSel" class="addListe">
     <option value="0">--seleziona un Comune--</option>
     <?php
      $comSel = ("Select * from comune ORDER BY comune ASC");
      $comSelexec = pg_query($connection, $comSel);
      $comSelrow = pg_num_rows($comSelexec);
      for ($c = 0; $c < $comSelrow; $c++){
       $id = pg_result($comSelexec, $c,"id"); 	
       $comDef = pg_result($comSelexec, $c, "comune");
       $comDef = stripslashes($comDef);
       echo "<option value='$id'>$comDef</option>";
      }
     ?>
   </select>
   <input id="addDefinizione" name="addDefinizione" type="text" style="width:220px !important;" class="pulsanti" placeholder="Inserisci il nome della Località"/>
   <input type="button" id="add" name="add" value="Aggiungi Località" class="pulsanti"/>
   </div>
  </div>
  <div style="float:left;width:96%;height:700px;overflow:auto;margin-left:30px;">
  <?php
   $locquery = ("
SELECT 
  localita.id, 
  localita.comune AS id_comune, 
  comune.comune, 
  localita.localita
FROM 
  public.localita, 
  public.comune
WHERE 
  localita.comune = comune.id
ORDER BY comune ASC, localita ASC;");
$locexec = pg_query($connection, $locquery);
$locrow = pg_num_rows($locexec);
?>
<label>Stai modificando i valori della tabella "Località"</label>
<table id="vocabolariTable">
 <thead>
  <tr>
    <th id="intestaz" class="trIntestaz" style="width:30% !important;">Comune</th>
    <th style="width:40% !important;">Località</th>
    <th></th>
    <th></th>
  </tr>
  </thead>
  <tbody>
   <?php
   if($locrow != 0) {
     for ($l = 0; $l < $locrow; $l++){
       $idLoc = pg_result($locexec, $l,"id"); 	
       $idCom = pg_result($locexec, $l, "id_comune");
       $comune = pg_result($locexec, $l,"comune");
       $localita = pg_result($locexec, $l,"localita");
       $comune = stripslashes($comune);
       $localita = stripslashes($localita);
       echo '<tr class="trListe" id="localita'.$idLoc.'" tab="localita" def="'.$localita.'" rec="'.$idLoc.'" idcom="'.$idCom.'" comune="'.$comune.'">
              <td>'.$comune.'</td>
              <td>'.$localita.'</td>
              <td class="modLista update">modifica</td>
              <td class="modLista del">elimina</td>
             </tr>';
     }
 }else{echo "<tr class='' ref=''><td colspan='4'>Nessuna definizione disponibile</td></tr>";}
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
//var tabella,id,def;
$(document).ready(function() {
   $('.slide').hide();
   $('.sezioni').click(function(){
   	$('.slide').slideToggle();
   	//$('.sezioni').toggleClass('sezAperta');
   });   
   
   $('.pulsanti').hide();  
   $('#comSel').change(function(){
    var id = $(this).val();
    if (id == 0) {$('.pulsanti').hide();}else {$('.pulsanti').show();}
   });
   
	$('#add').click(function(){
      var check = '';
		var newCom = $('#comSel').val();
      var newLoc = $('#addDefinizione').val();
      
      if(newLoc == '' || newLoc == 'Inserisci il nome della Località'){
      	alert('Attenzione!\nDevi inserire un valore prima di cliccare sul tasto "Aggiungi Località"'); 
      	return false;
      }else{
      //alert(newCom + ' ' +newLoc);return false;
        $.ajax({
           url: 'inc/insertLocalitaScript.php',
           type: 'POST', 
           data: {newCom:newCom, newLoc:newLoc}, 
           success: function(data){
           	$('<div style="text-align:center;"><h2>Inserimento avvenuto correttamente</h2></div>')
           	.dialog()
           	.delay(3000)
           	.fadeOut(function(){ $(this).dialog("close");});
           	window.location.href = 'localita.php';
           }//success
        });//ajax
      }
     });
     
    $('td.del').each(function(){ 
     var def = $(this).parent('tr').attr('def');
     var id = $(this).parent('tr').attr('rec');
     var idTipDelete = 'delete-localita'+id;
     $(this).qtip({
     	 id: idTipDelete,
    	 content: { 
    	    text: 'Loading...',
    	    title: {
              text: 'Elimina il record "'+def+'"',
              button: 'Close'
          },
    	    ajax: {
    	       url: 'inc/deleteLocalitaConfirm.php',
             data: {id:id, def:def},
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
	 //return false;
	}); 
	
	$('td.update').each(function(){ 
     var def = $(this).parent('tr').attr('def');
     var id = $(this).parent('tr').attr('rec');
     var idCom = $(this).parent('tr').attr('idcom');
     var comune = $(this).parent('tr').attr('comune');
     var idTipUpdate = 'update-provincia'+id;
     $(this).qtip({
    	 id: idTipUpdate,
    	 content: { 
    	    text: 'Loading...',
    	    title: {
              text: 'Aggiorna il record "'+def+'"',
              button: true
          },
    	    ajax: {
    	       url: 'inc/updateLocalitaConfirm.php',
             data: {def:def, id:id, comune:comune, idCom:idCom},
             type: 'POST'
    	    }
       },
       overwrite: false,
    	 style: {classes: 'qtip-shadow qtip-bootstrap ui-tooltip-rounded'},
    	 position: {my: 'right center', at: 'left center'},
    	 show: {event: 'click'},
       hide: {event: false}
	 });
	 //return false;
	}); 
});
</script>

</body>
</html>
