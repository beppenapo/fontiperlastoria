<?php
 $def = $_POST['def'];
 $id = $_POST['id'];
?>

<div class="confirm">
 <h2>Attenzione! Questa operazione non può essere annullata!!!</h2>
 <h2>Stai per eliminare il record <?php echo($def); ?> dalla tabella Stato</h2>
 <p>Se non sei sicuro di voler eliminare il record, annulla l'operazione utilizzando il tasto in alto a destra.</p>
 <br/>
 <input type="hidden" id="id" value="<?php echo($id); ?>" />
 <div class="login2 elimina" style="font-size:10px !important">Ok, sono sicuro, elimina record</div>
</div>


<script type="text/javascript" >
$(document).ready(function() {
 
 $('.elimina').each(function(){
   $(this).click(function(){
  	 var id= $('input#id').val();
 	 $.ajax({
      url: 'inc/deleteStatoScript.php',
      type: 'POST', 
      data: {id:id}, 
      success: function(data){
      	//$('#qtip-delete-stato'+id).qtip('destroy');
         //$('table#vocabolariTable tbody tr#stato'+id).hide();
         $(data)
           	   .dialog({position:['middle', 10]})
           	   .delay(2500)
           	   .fadeOut(function(){ $(this).dialog("close");window.location.href = 'stato.php'; });
      }//success
    });//ajax
   });
 });


});
</script>