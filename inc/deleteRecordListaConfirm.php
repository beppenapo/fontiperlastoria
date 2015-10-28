<?php
 $tab = $_POST['tabella'];
 $def = $_POST['def'];
 $id = $_POST['id'];
?>

<div class="confirm">
 <h2>Attenzione! Questa operazione non può essere annullata!!!</h2>
 <h2>Stai per eliminare il record <?php echo($def); ?> dalla tabella <?php echo($tab); ?></h2>
 <p>Se non sei sicuro di voler eliminare il record, annulla l'operazione utilizzando il tasto in alto a destra.</p>
 <br/>
 <input type="hidden" id="tab" value="<?php echo($tab); ?>" />
 <input type="hidden" id="def" value="<?php echo($def); ?>" />
 <input type="hidden" id="id" value="<?php echo($id); ?>" />
 <!--<div class="login2 annulla" style="font-size:10px !important" id="annulla">Non sono sicuro, annulla eliminazione</div>-->
 <div class="login2 elimina" style="font-size:10px !important">Ok, sono sicuro, elimina record</div>
</div>


<script type="text/javascript" >
$(document).ready(function() {
 
 $('.elimina').each(function(){
   $(this).click(function(){
  	 var id= $('input#id').val();
 	 var tab= $('input#tab').val();
 	 var def= $('input#def').val();
 	 //alert(id +' '+tab+' '+def);return false;
 	 $.ajax({
      url: 'inc/deleteRecordListaScript.php',
      type: 'POST', 
      data: {tab:tab,id:id}, 
      success: function(data){
      	$('#qtip-delete-'+tab+id).qtip('destroy');
         $('table#vocabolariTable tbody tr#'+tab+id).hide();
      }//success
    });//ajax
   });
 });


});
</script>