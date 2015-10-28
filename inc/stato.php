<?php
include("db.php");

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
<div id="pulsanti" style="margin-top:20px;"><input id="addDefinizione" name="addDefinizione" type="text" /><input type="button" id="add" name="add" value="Aggiungi Stato" /></div>


<script type="text/javascript" >
//var tabella,id,def;
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
           	$('<div style="text-align:center;"><h2>Inserimento avvenuto correttamente</h2></div>')
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
             type: 'POST',
             success: function(data){
           	   $('<div style="text-align:center;"><h2>Modifica completata con successo</h2></div>')
           	   .dialog()
           	   .delay(2500)
           	   .fadeOut(function(){ $(this).dialog("close");window.location.href = 'stato.php'; });
           }//success
    	    }
       },
       overwrite: false,
    	 style: {classes: 'qtip-shadow qtip-bootstrap ui-tooltip-rounded'},
    	 position: {my: 'right center', at: 'left center'},
    	 show: {event: 'click', solo:true},
       hide: {event: false}
	 });
	}); 
	
});
</script>