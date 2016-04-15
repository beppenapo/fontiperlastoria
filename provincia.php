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
  <link type="text/css" rel="stylesheet" href="lib/qtip/jquery.qtip.min.css" />
  <link href="lib/jquery-ui-1.11.4/jquery-ui.min.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="css/scheda.css" type="text/css" rel="stylesheet" media="screen" />
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
  <label style="display:block;margin-bottom:10px;">Compila i seguenti campi per inserire una nuova Provincia - Tutti i campi sono obbligatori</label>
  <select id="statoSel" class="addListe">
   <option value="0">--seleziona uno Stato--</option>
   <?php
    $statoSel = ("Select * from stato ORDER BY stato ASC");
    $statoSelexec = pg_query($connection, $statoSel);
    $statoSelrow = pg_num_rows($statoSelexec);
    for ($s = 0; $s < $statoSelrow; $s++){
       $id = pg_result($statoSelexec, $s,"id"); 	
       $statoDef = pg_result($statoSelexec, $s, "stato");
       
       echo "<option value='$id'>$statoDef</option>";
     }
   ?>
  </select>
  <input id="addDefinizione" name="addDefinizione" type="text" style="width:220px !important;" class="pulsanti" value="" placeholder="Inserisci il nome della Provincia"/>
  <input type="button" id="add" name="add" value="Aggiungi Provincia" class="pulsanti"/>
  <label class="label">Per inserire una Provincia devi prima selezionare uno Stato</label>
</div>
  <div style="float:left;width:90%;height:600px;overflow:auto;margin-left:30px;">
<?php
$provquery = ("
SELECT 
  provincia.id AS id_prov, 
  provincia.provincia, 
  stato.id AS id_stato, 
  stato.stato
FROM 
  public.stato, 
  public.provincia
WHERE 
  provincia.stato = stato.id
ORDER BY provincia ASC;");
$provexec = pg_query($connection, $provquery);
$provrow = pg_num_rows($provexec);
?>

<table id="vocabolariTable">
 <thead>
  <tr>
    <th id="intestaz" colspan="4">Stai modificando i valori della tabella "Provincia"</th>
  </tr>
  </thead>
  <tbody>
   <?php
   if($provrow != 0) {
     for ($b = 0; $b < $provrow; $b++){
       $idProv = pg_result($provexec, $b,"id_prov"); 	
       $provincia = pg_result($provexec, $b, "provincia");
       $idStato = pg_result($provexec, $b,"id_stato");
       $stato = pg_result($provexec, $b,"stato");
       
       echo "<tr class='trListe' id='provincia$idProv' tab='provincia' def='$provincia' rec='$idProv' idstato='$idStato' stato='$stato'>
              <td>$provincia</td>
              <td>$stato</td>
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
<script type="text/javascript" src="lib/jquery-core/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="lib/jquery-ui-1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="lib/qtip/jquery.qtip.min.js"></script>
<script type="text/javascript" src="lib/funzioni.js"></script>
<script type="text/javascript" >
var tab;
$(document).ready(function() {
   $('.pulsanti').hide();
   $('#statoSel').change(function(){
    var id = $(this).val();
    if (id == 0) {$('.pulsanti').hide();$('.label').show();}else {$('.pulsanti').show();$('.label').hide();}
   });
   
	$('#add').click(function(){
      var check = '';
		var newStato = $('#statoSel').val();
      var newProv = $('#addDefinizione').val();
      
      if(newProv == '' || newProv == 'Inserisci il nome della Provincia'){
      	alert('Attenzione!\nDevi inserire un valore prima di cliccare sul tasto "Aggiungi Provincia"'); 
      	return false;
      }else{
      //alert(newStato + ' ' +newProv);return false;
        $.ajax({
           url: 'inc/insertProvinciaScript.php',
           type: 'POST', 
           data: {newStato:newStato, newProv:newProv}, 
           success: function(data){
           	//$('#vocabolariTable tbody').html(data);
           	$(data)
           	.dialog()
           	.delay(3000)
           	.fadeOut(function(){ $(this).dialog("close");window.location.href = 'provincia.php'; });
           }//success
        });//ajax
      }
     });
     
    $('td.del').each(function(){ 
     var def = $(this).parent('tr').attr('def');
     var id = $(this).parent('tr').attr('rec');
     var idTipDelete = 'delete-provincia'+id;
     $(this).qtip({
     	 id: idTipDelete,
    	 content: { 
    	    text: 'Loading...',
    	    title: {
              text: 'Elimina il record "'+def+'"',
              button: 'Close'
          },
    	    ajax: {
    	       url: 'inc/deleteProvinciaConfirm.php',
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
	}); 
	
	$('td.update').each(function(){ 
     var def = $(this).parent('tr').attr('def');
     var id = $(this).parent('tr').attr('rec');
     var idStato = $(this).parent('tr').attr('idstato');
     var stato = $(this).parent('tr').attr('stato');
     var idTipUpdate = 'update-provincia'+id;
     $(this).qtip({
    	 id: idTipUpdate,
    	 content: { 
    	    text: 'Loading...',
    	    title: {
              text: 'Aggiorna il record "'+def+'"',
              button: 'Close'
          },
    	    ajax: {
    	       url: 'inc/updateProvinciaConfirm.php',
             data: {def:def, id:id, stato:stato, idStato:idStato},
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
