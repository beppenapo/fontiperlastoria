<?php
include("db.php");

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
<div id="pulsanti" style="margin-top:20px;">
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
  <input id="addDefinizione" name="addDefinizione" type="text" style="width:220px !important;" class="pulsanti" value="Inserisci il nome della Provincia"/>
  <input type="button" id="add" name="add" value="Aggiungi Provincia" class="pulsanti"/>
  <label class="label">Per inserire una Provincia devi prima selezionare uno Stato</label>
</div>


<script type="text/javascript" >
//var tabella,id,def;
$(document).ready(function() {
   $('.pulsanti').hide();
   
   $('#addDefinizione')
    .focus(function(){if($(this).val() == 'Inserisci il nome della Provincia') { $(this).val('');}})
    .blur(function() {if($(this).val() == '') {$(this).val('Inserisci il nome della Provincia');}});
   
   
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
           	$('#vocabolariTable tbody').html(data);
           	$('<div style="text-align:center;"><h2>Inserimento avvenuto correttamente</h2><p>Per modificare o eliminare un record appena inserito devi prima ricaricare la pagina!</p></div>')
           	.dialog()
           	.delay(3000)
           	.fadeOut(function(){ $(this).dialog("close");});
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