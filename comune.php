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
    <input type="button" id="add" name="add" value="Aggiungi Comune" class="pulsanti"/>
   </div>
  <div style="float:left;width:90%;height:700px;overflow:auto;margin-left:30px;">
<?php
$comquery = ("
SELECT 
  comune.stato AS id_stato, 
  comune.provincia AS id_provincia, 
  comune.id AS id_comune, 
  stato.stato, 
  provincia.provincia, 
  comune.comune, 
  comune.cap
FROM 
  public.stato, 
  public.provincia, 
  public.comune
WHERE 
  provincia.stato = stato.id AND
  comune.provincia = provincia.id AND
  comune.stato = stato.id
ORDER BY comune;
");
$comexec = pg_query($connection, $comquery);
$comrow = pg_num_rows($comexec);
?>
<label>Stai modificando i valori della tabella "Comune"</label>
<table id="vocabolariTable">
 <thead>
  <tr id="intestaz" class="trIntestaz">
    <th>Comune</th><th>CAP</th><th>Stato</th><th>Provincia</th><th></th><th></th>
  </tr>
 </thead>
 <tbody>
   <?php
   if($comrow != 0) {
     for ($c = 0; $c < $comrow; $c++){
       $idStato = pg_result($comexec, $c,"id_stato"); 
       $idProv = pg_result($comexec, $c,"id_provincia");
       $idComune = pg_result($comexec, $c,"id_comune");
       $stato = pg_result($comexec, $c, "stato");
       $provincia = pg_result($comexec, $c,"provincia");
       $comune = pg_result($comexec, $c,"comune");
       $cap = pg_result($comexec, $c,"cap");
       if($cap == 0) {$cap = '';}
       $stato = stripslashes($stato);
       $provincia = stripslashes($provincia);
       $comune = stripslashes($comune);
       
       echo "<tr class='trListe' id='comune$idComune' tab='comune' def='$comune' rec='$idComune' idstato='$idStato' stato='$stato' idprov='$idProv' prov='$provincia' cap='$cap'>
              <td>$comune</td>
              <td>$cap</td>
              <td>$stato</td>
              <td>$provincia</td>
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
   <div id="footer"><?php require_once ("inc/footer.php"); ?></div><!--footer-->
  </div><!-- wrap-->
 </div><!--container-->
 
 <!--div invisibili -->
<div id="comuneForm">
 <select id="stato_insert" name="stato_insert" class="form">
   <option value="0">--seleziona uno Stato--</option>
   <?php
     $query =  ("SELECT * FROM public.stato order by stato asc; ");
     $result = pg_query($connection, $query);
     $righe = pg_num_rows($result);
     $i=0;
     for ($i = 0; $i < $righe; $i++){
       $sid = pg_result($result, $i, "id");
       $sdef = pg_result($result, $i, "stato");
       echo "<option value=\"$sid\">$sdef</option>";
      }
   ?>
 </select>
 <select id="provincia_update" name="provincia_update" class="form">

 </select>
  
  <input type="text" id="comune_insert" value="" class="form" placeholder="Inserisci un nuovo Comune"/>
  <input type="text" id="cap_insert" value="" class="form" placeholder="Inserisci un cap" maxlength="5" />
 
 <div class="avviso"></div>
 <div class="login2" style="margin-top:20px;" id="comune_insert_button">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>

<script type="text/javascript" src="lib/jquery-core/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="lib/jquery-ui-1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="lib/qtip/jquery.qtip.min.js"></script>
<script type="text/javascript" src="lib/funzioni.js"></script>
<script type="text/javascript" >
var tab;
$(document).ready(function() {
  //nascondo gli input di provincia comune e cap
 $('#provincia_update, #comune_insert, #cap_insert, #comune_insert_button').hide();
 
 //inizializzo il dialog con il form
 $("#comuneForm").dialog({
      autoOpen: false,
      resizable:false,
      modal:true,
      width: 500,
      title: "Inserisci un nuovo Comune",
 });//dialog
 
 //imposto l'azione sul pulsante per aprire il dialog   
 $('#add').click(function(){$('#comuneForm').dialog('open');});//click
 $('#comuneForm').dialog('widget').attr('id', 'ComuneInsertForm');
 
 $("#stato_insert").change(function() {
  var id = $(this).val();
  $("#provincia_update").fadeIn('slow');
  $.ajax({
   type: "POST",
   url: "inc/dinSelProvincia.php",
   data: {id:id},
   cache: false,
   success: function(data){$("#provincia_update").html(data);} 
  });//ajax1
 });
 
 $('#provincia_update').change(function(){$('#comune_insert, #cap_insert, #comune_insert_button').fadeIn('slow');});
 
 $('.chiudiForm').click(function(){
 	$(this).closest('.ui-dialog-content').dialog('close');
 	$("#stato_insert").val(0);
   $("#provincia_update").val(0).hide();
   $("#comune_insert").val('').hide();
   $("#cap_insert").val('').hide();
 	$("#comune_insert_button").hide();
 });
    
 $('#comune_insert_button').click(function(){
   var newComStato = $("#stato_insert").val();
   var newComStatoDef = $('select[name="stato_insert"] option:selected').text();
  	var newComProvDef = $('select[name="provincia_update"] option:selected').text();
   var newComProv = $("#provincia_update").val();
   var newComCom = $("#comune_insert").val();
   var newComCap = $("#cap_insert").val();
   if(!newComCom){alert('Il campo Comune è obbligatorio e non può essere vuoto!');return false;}
   if(!newComCap){newComCap = '0';}
   //alert (newComStato+'\n'+newComProv+'\n'+newComCom+'\n'+newComCap); return false;
   $.ajax({
    type: "POST",
    url: "inc/insertComuneScript.php",
    data: {newComStato:newComStato,newComProv:newComProv,newComCom:newComCom,newComCap:newComCap},
    cache: false,
    success: function(data){
    	$('.avviso').html(data);
    	//$("table#vocabolariTable tbody").append(newTr);
    	//$('#ComuneInsertForm').dialog().delay(2500).fadeOut(function(){ $(this).dialog("close");});
      //$('#ComuneInsertForm').dialog("close").delay(2500);
      setTimeout(function(){
      	$('#comune_insert_button').closest('.ui-dialog-content').dialog("close");
      	window.location.href = 'comune.php';
      },5000);
    } 
   });//ajax1
   
 });  
    $('td.del').each(function(){ 
     var def = $(this).parent('tr').attr('def');
     var id = $(this).parent('tr').attr('rec');
     var idTipDelete = 'delete-comune'+id;
     $(this).qtip({
     	 id: idTipDelete,
    	 content: { 
    	    text: 'Loading...',
    	    title: {
              text: 'Elimina il record "'+def+'"',
              button: 'Close'
          },
    	    ajax: {
    	       url: 'inc/deleteComuneConfirm.php',
             data: {id:id, def:def},
             type: 'POST'
    	    }
       },
       overwrite: false,
    	 style: {classes: 'qtip-shadow qtip-youtube ui-tooltip-rounded'},
    	 //style:{widget:true, def:false},
    	 position: {my: 'right center', at: 'left center'},
    	 show: {event: 'click', solo:true},
       hide: {event: false}
	 });
	}); 
	
	$('td.update').each(function(){ 
     var comune = $(this).parent('tr').attr('def');
     var idComune = $(this).parent('tr').attr('rec');
     var idStato = $(this).parent('tr').attr('idstato');
     var stato = $(this).parent('tr').attr('stato');
     var idProv = $(this).parent('tr').attr('idprov');
     var prov = $(this).parent('tr').attr('prov');
     var cap = $(this).parent('tr').attr('cap');
     if (!cap) {cap = '0'}
     var idTipUpdate = 'update-comune'+idComune;
     $(this).qtip({
    	 id: idTipUpdate,
    	 content: { 
    	    text: 'Loading...',
    	    title: {
              text: 'Aggiorna il record "'+comune+'"',
              button: 'Close'
          },
    	    ajax: {
    	       url: 'inc/updateComuneConfirm.php',
             data: {comune:comune, idComune:idComune, idStato:idStato, stato:stato, idProv:idProv, prov:prov, cap:cap},
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
	}); 
	


});
</script>

</body>
</html>
