<?php
include("db.php");

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

<table id="vocabolariTable">
 <thead>
  <tr>
    <th id="intestaz" colspan="6">Stai modificando i valori della tabella "Comune"</th>
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
<div id="pulsanti" style="margin-top:20px;">
  <input type="button" id="add" name="add" value="Aggiungi Comune" class="pulsanti"/>
</div>
<div id="comuneForm" style="display:none">
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
  <input type="text" id="cap_insert" value="" class="form" placeholder="Inserisci un cap"/>
 
 <div class="avviso"></div>
 <div class="login2" style="margin-top:20px;" id="comune_insert_button">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>

<script type="text/javascript" >
//var tabella,id,def;
$(document).ready(function() {
 
 //nascondo gli input di provincia comune e cap
 $('#provincia_update, #comune_insert, #cap_insert, #comune_insert_button').hide();
 
 //inizializzo il dialog con il form
 $("#comuneForm").dialog({
      autoOpen: false,
      resizable:false,
      modal:true,
      height: 'auto',
      width: 500,
      title: "Inserisci un nuovo Comune",
 });//dialog
 
 //imposto l'azione sul pulsante per aprire il dialog   
 $('#add').click(function(){$('#comuneForm').dialog('open');});//click
 $("#comuneForm").dialog("option", "position", ['center','center']);
 $('#comuneForm').dialog('widget').attr('id', 'ComuneInsertForm');
 
 $("#stato_insert").change(function() {
  var id = $(this).val();
  $("#provincia_update").fadeIn('slow');
  $.ajax({
   type: "POST",
   url: "inc/dinSelProvincia.php",
   data: {id:id},
   cache: false,
   success: function(html){$("#provincia_update").html(html);} 
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
   if(!newComCap){newComCap = '00000';}
   var newTr = "<tr class='trListe'><td>"+newComCom+"</td><td>"+newComCap+"</td><td>"+newComStatoDef+"</td><td>"+newComProvDef+"</td><td></td><td></td></tr>";
   //alert (newComStato+'\n'+newComProv+'\n'+newComCom+'\n'+newComCap); return false;
   $.ajax({
    type: "POST",
    url: "inc/insertComuneScript.php",
    data: {newComStato:newComStato,newComProv:newComProv,newComCom:newComCom,newComCap:newComCap},
    cache: false,
    success: function(html){
    	$('.avviso').html('<h2>Salvataggio avvenuto correttamente!<br/>Per modificare o eliminare il record appena inserito devi ricaricare la pagina.</h2>');
    	$("table#vocabolariTable tbody").append(newTr);
    	//$('#ComuneInsertForm').dialog().delay(2500).fadeOut(function(){ $(this).dialog("close");});
      //$('#ComuneInsertForm').dialog("close").delay(2500);
      setTimeout(function(){$('#comune_insert_button').closest('.ui-dialog-content').dialog("close");},5000);
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
       hide: {event: false}
	 });
	}); 
	
});
</script>