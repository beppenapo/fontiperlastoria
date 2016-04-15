<?php
 $def = $_POST['def'];
 $id = $_POST['id'];
?>

<div class="confirm">
<h2>Per annullare la modifica e chiudere la finestra utilizza il tasto in alto a destra</h2>
 <input type="hidden" id="id" value="<?php echo($id); ?>" />
 <input type="text" id="def" value="<?php echo($def); ?>" />
 
 <div class="login2 update" style="font-size:10px !important" id="ok">Modifica definizione</div>
</div>

<script type="text/javascript" >
$(document).ready(function() {

 $('.update').each(function(){
   $(this).click(function(){
  	 var id= $('input#id').val();
 	 var def= $('input#def').val();
 	 var idTipUpdate = 'update-stato'+id;
 	 $.ajax({
      url: 'inc/updateStatoScript.php',
      type: 'POST', 
      data: {id:id, def:def}, 
      success: function(data){
         //$('table#vocabolariTable tbody tr#stato'+id+' td:first-child').text(def);
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