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
    #comSel{width: 430px;}
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
  <div id="pulsanti" style="margin: 30px;">
  <label class="label" style="display:block;">Per inserire un Indirizzo devi prima selezionare un Comune</label>
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
  <input id="addDefinizione" name="addDefinizione" type="text" style="width:220px !important;" class="pulsanti" placeholder="Inserisci indirizzo"/>
  <input id="addDefinizione2" name="addDefinizione2" type="text" style="width:40px !important;" class="pulsanti" placeholder="CAP" maxlength="5"/>
  <input type="button" id="add" name="add" value="Aggiungi Indirizzo" class="pulsanti"/>
  
</div>
  <div style="width:90%;margin-left:30px;">
   <?php
$indquery = ("
SELECT 
  indirizzo.id, 
  indirizzo.comune AS id_comune, 
  comune.comune, 
  indirizzo.indirizzo, 
  indirizzo.cap
FROM 
  public.indirizzo, 
  public.comune
WHERE 
  indirizzo.comune = comune.id 
order by comune asc, indirizzo asc;");
$indexec = pg_query($connection, $indquery);
$indrow = pg_num_rows($indexec);
?>
<label>Stai modificando i valori della tabella "Indirizzo"</label>
<table id="vocabolariTable">
 <thead>
  <tr>
    <th id="intestaz" class="trIntestaz">Comune</th><th>CAP</th><th>Indirizzo</th><th colspan = "2"></th>
  </tr>
  </thead>
  <tbody>
   <?php
   if($indrow != 0) {
     for ($i = 0; $i < $indrow; $i++){
       $idInd = pg_result($indexec, $i,"id"); 	
       $idCom = pg_result($indexec, $i, "id_comune");
       $comune = pg_result($indexec, $i,"comune");
       $comune = stripslashes($comune);
       $indirizzo = pg_result($indexec, $i,"indirizzo");
       $indirizzo = stripslashes($indirizzo);
       $cap = pg_result($indexec, $i,"cap");
       if($cap == 0) {$cap = '';}
       echo "<tr class='trListe' id='indirizzo$idInd' tab='indirizzo' def=\"$indirizzo\" rec='$idInd' idcom='$idCom' comune=\"$comune\" cap='$cap'>
              <td>$comune</td>
              <td>$cap</td>
              <td>$indirizzo</td>
              <td class='modLista update'>modifica</td>
              <td class='modLista del'>elimina</td>
             </tr>";
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
   <div id="footer"><?php require_once ("inc/footer.inc"); ?></div><!--footer-->
  </div><!-- wrap-->
 </div><!--container-->
 
 <!--div invisibili -->

<script type="text/javascript" src="lib/jquery-core/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="lib/jquery-ui-1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="lib/qtip/jquery.qtip.min.js"></script>
<script type="text/javascript" src="lib/funzioni.js"></script>
<script type="text/javascript" >
$(document).ready(function() {
   $('.pulsanti').hide();
      
   $('#comSel').change(function(){
    var id = $(this).val();
    if (id == 0) {$('.pulsanti').hide();}else {$('.pulsanti').show();}
   });
   
	$('#add').click(function(){
      var check = '';
		var newCom = $('#comSel').val();
      var newInd = $('#addDefinizione').val();
      var newCap = $('#addDefinizione2').val();
      if(newInd == '' || newInd == 'Inserisci indirizzo'){
      	alert('Attenzione!\nDevi inserire un valore prima di cliccare sul tasto "Aggiungi Indirizzo"'); 
      	return false;
      }else{
      //alert(newCom + ' ' +newLoc+ ' ' +newCap);return false;
        $.ajax({
           url: 'inc/insertIndirizzoScript.php',
           type: 'POST', 
           data: {newCom:newCom, newInd:newInd, newCap:newCap}, 
           success: function(data){
           	$('<div style="text-align:center;"><h2>Inserimento avvenuto correttamente</h2></div>')
           	.dialog()
           	.delay(3000)
           	.fadeOut(function(){ $(this).dialog("close");});
            window.location.href = 'indirizzo.php';
           }//success
        });//ajax
      }
     });
     
    $('td.del').each(function(){ 
     var def = $(this).parent('tr').attr('def');
     var id = $(this).parent('tr').attr('rec');
     var idTipDelete = 'delete-indirizzo'+id;
     $(this).qtip({
     	 id: idTipDelete,
    	 content: { 
    	    text: 'Loading...',
    	    title: {
              text: 'Elimina il record "'+def+'"',
              button: 'Close'
          },
    	    ajax: {
    	       url: 'inc/deleteIndirizzoConfirm.php',
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
     var indirizzo = $(this).parent('tr').attr('def');
     var id = $(this).parent('tr').attr('rec');
     var idCom = $(this).parent('tr').attr('idcom');
     var comune = $(this).parent('tr').attr('comune');
     var cap = $(this).parent('tr').attr('cap');
     if (!cap) {cap = '0'}
     var idTipUpdate = 'update-indirizzo'+id;
     $(this).qtip({
    	 id: idTipUpdate,
    	 content: { 
    	    text: 'Loading...',
    	    title: {
              text: 'Aggiorna il record "'+indirizzo+'"',
              button: true
          },
    	    ajax: {
    	       url: 'inc/updateIndirizzoConfirm.php',
             data: {indirizzo:indirizzo, id:id, comune:comune, idCom:idCom, cap:cap},
             type: 'POST'
    	    }
       },
       overwrite: false,
    	 style: {classes: 'qtip-shadow qtip-bootstrap ui-tooltip-rounded'},
    	 position: {my: 'right center', at: 'left center'},
    	 show: {event: 'click'},
       hide: {event: false},
       events: {hide: function(event, api) {$(this).qtip('destroy');}
      }
	 });
	 //return false;
	}); 
	
});
</script>

</body>
</html>
