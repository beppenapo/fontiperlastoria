<?php
require('../db.php');
$id = $_POST['id'];
$schede = $_POST['schede'];
$denric = stripslashes($_POST['denric']);
$enresp = stripslashes($_POST['enresp']);
$respric = stripslashes($_POST['respric']);
$redattore = stripslashes($_POST['redattore']);
$data = stripslashes($_POST['data']);
?>

<div id="compilazione_form">
 <label>* DENOMINAZIONE RICERCA</label>
 <textarea id="denric_update" class="form"><?php echo($denric);?></textarea>

 <label>ENTE RESPONSABILE</label>
 <textarea id="enresp_update" class="form"><?php echo($enresp);?></textarea>
   
 <label>RESPONSABILE RICERCA</label>
 <textarea id="respric_update" class="form "><?php echo($respric);?></textarea>
 
  <label>REDATTORE</label>
 <textarea id="redattore_update" class="form "><?php echo($redattore);?></textarea>
 
 <label>DATA</label>
 <textarea id="data_update" class="form "><?php echo($data);?></textarea>
 
 <input type="hidden" id="id" value="<?php echo($id); ?>" />
 <div id="salva" class="login2" style="margin-top:20px;" id="compilazione_update">Salva modifiche</div>
 <div id="chiudi" class="login2">Annulla modifiche</div>
 <div id="elimina" class="login2">Elimina record</div>
</div>


<div id="delDialog" style="display:none; text-align:center;">
 <h2>Hai scelto di eliminare la ricerca "<?php echo ($denric); ?>" <span id="checkId"></span></h2>
 <p>Il record ha <?php echo($schede); ?> schede collegate, eliminadolo cancellerai definitivamente anche tutte le schede.</p>
 <p>Sei sicuro di voler eliminare il record?</p>
 <div id="no" class="login2" style="margin-top:20px;" id="compilazione_update">NO, non eliminare</div>
 <div id="si" class="login2">SI, procedi con l'eliminazione</div>
</div>

<script type="text/javascript" >
$(document).ready(function(){
 $('#chiudi, #no').click(function(){$(this).closest('.ui-dialog-content').dialog('close');});
 
 $('#elimina').click(function(){
   //$('#checkId').html(idDel);
   $("#delDialog").dialog({
      resizable:false,
      height: 300,
      width: 500,
      title: "ATTENZIONE!!!"
   });
   $('#si').click(function(){
     var idDel = $('#id').val();
     //alert('elimina il record:' + idDel); return false;
     $.ajax({
          url: 'inc/deleteRicerca.php',
          type: 'POST', 
          data: {idDel:idDel},
          success: function(data){
             $(data).dialog().delay(2500).fadeOut(function(){ window.location.href = 'ricerca.php'; });
          }//success
     });//ajax
   });     
 });//elimina
 
 $('#salva').click(function(){
     var idUpdate = $('#id').val();
     var denric = $('#denric_update').val(); 
     var enresp = $('#enresp_update').val();
     var respric = $('#respric_update').val(); 
     var redattore = $('#redattore_update').val(); 
     var data = $('#data_update').val();
     //alert('aggiorna il record:' + idUpdate+'\ndenric: '+denric+'\nenresp: '+enresp+'\nrespric: '+respric+'\nredattore: '+redattore+'\ndata: '+data); return false;
     $.ajax({
          url: 'inc/updateRicerca_script.php',
          type: 'POST',
          data: {idUpdate:idUpdate, denric:denric, enresp:enresp,redattore:redattore, respric:respric, data:data},
          success: function(data){
            alert('Record aggiornato!'); window.location.href = 'ricerca.php';
          }//success
     });//ajax
   });
 
});

</script>