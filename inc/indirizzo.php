<?php
include("db.php");

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

<table id="vocabolariTable">
 <thead>
  <tr>
    <th id="intestaz" colspan="4">Stai modificando i valori della tabella "Indirizzo"</th>
  </tr>
  </thead>
  <tbody>
   <?php
   if($indrow != 0) {
     for ($i = 0; $i < $indrow; $i++){
       $idInd = pg_result($indexec, $i,"id"); 	
       $idCom = pg_result($indexec, $i, "id_comune");
       $comune = pg_result($indexec, $i,"comune");
       $indirizzo = pg_result($indexec, $i,"indirizzo");
       $cap = pg_result($indexec, $i,"cap");
       
       echo "<tr class='trListe' id='indirizzo$idInd' tab='indirizzo' def='$indirizzo' rec='$idInd' idcom='$idCom' comune='$comune' cap='$cap'>
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
<div id="pulsanti" style="margin-top:20px;">
  <select id="comSel" class="addListe">
   <option value="0">--seleziona un Comune--</option>
   <?php
    $comSel = ("Select * from comune ORDER BY comune ASC");
    $comSelexec = pg_query($connection, $comSel);
    $comSelrow = pg_num_rows($comSelexec);
    for ($c = 0; $c < $comSelrow; $c++){
       $id = pg_result($comSelexec, $c,"id"); 	
       $comDef = pg_result($comSelexec, $c, "comune");
       
       echo "<option value='$id'>$comDef</option>";
     }
   ?>
  </select>
  <input id="addDefinizione" name="addDefinizione" type="text" style="width:220px !important;" class="pulsanti" placeholder="Inserisci il nome della Località"/>
<input id="addDefinizione2" name="addDefinizione2" type="text" style="width:20px !important;" class="pulsanti" placeholder="Inserisci il cap"/>
  <input type="button" id="add" name="add" value="Aggiungi Indirizzo" class="pulsanti"/>
  <label class="label">Per inserire un Indirizzo devi prima selezionare un Comune</label>
</div>


<script type="text/javascript" >
//var tabella,id,def;
$(document).ready(function() {
   $('.pulsanti').hide();
   
   //$('#addDefinizione')
   // .focus(function(){if($(this).val() == 'Inserisci il nome del Comune') { $(this).val('');}})
   // .blur(function() {if($(this).val() == '') {$(this).val('Inserisci il nome del Comune');}});
   
   
   $('#comSel').change(function(){
    var id = $(this).val();
    if (id == 0) {$('.pulsanti').hide();$('.label').show();}else {$('.pulsanti').show();$('.label').hide();}
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