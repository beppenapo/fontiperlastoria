<?php
 $tab = $_POST['tabella'];
 $def = $_POST['def'];
 $id = $_POST['id'];
?>

<div class="confirm">
<h2>Per annullare la modifica e chiudere la finestra utilizza il tasto in alto a destra</h2>
 <input type="hidden" id="tab" value="<?php echo($tab); ?>" />
 <input type="hidden" id="id" value="<?php echo($id); ?>" />
 <input type="text" id="def" value="<?php echo($def); ?>" />
 
 <div class="login2 update" style="font-size:10px !important" id="ok">Modifica definizione</div>
 <!--<div class="login2 annulla" style="font-size:10px !important" id="no">Annulla modifica</div>-->
</div>


<script type="text/javascript" >
$(document).ready(function() {

 $('.update').each(function(){
   $(this).click(function(){
  	 var id= $('input#id').val();
 	 var tab= $('input#tab').val();
 	 var def= $('input#def').val();
 	 var idTipUpdate = 'update-'+tab+id;
 	 //alert(id +' '+tab+' '+def);return false;
 	 $.ajax({
      url: 'inc/updateRecordListaScript.php',
      type: 'POST', 
      data: {tab:tab,id:id, def:def}, 
      success: function(data){
      	//$('#qtip-'+idTipUpdate).qtip('hide');
         $('table#vocabolariTable tbody tr#'+tab+id+' td:first-child').text(def);
      }//success
    });//ajax
   });
 });


});
</script>