<?php
include("db.php");
 $def = $_POST['def'];
 $id = $_POST['id'];
 $stato = $_POST['stato'];
 $idStato = $_POST['idStato'];
?>

<div class="confirm">
<h2 id="avvisi">Per annullare la modifica e chiudere la finestra utilizza il tasto in alto a destra</h2>
 <input type="hidden" id="id" value="<?php echo($id); ?>" />
 <select id="sSel" class="addListe">
   <option value="<?php echo($idStato); ?>"><?php echo($stato); ?></option>
   <?php
    $ss = ("Select * from stato WHERE id != $idStato ORDER BY stato ASC");
    $sse = pg_query($connection, $ss);
    $ssr = pg_num_rows($sse);
    for ($z = 0; $z < $ssr; $z++){
       $sId = pg_result($sse, $z,"id"); 	
       $sDef = pg_result($sse, $z, "stato");
       
       echo "<option value='$sId'>$sDef</option>";
     }
   ?>
  </select>
 <input type="text" id="def" value="<?php echo($def); ?>" />
 
 <div class="login2 update" style="font-size:10px !important" id="ok">Modifica Provincia</div>
</div>

<script type="text/javascript" >
$(document).ready(function() {

 $('.update').each(function(){
   $(this).click(function(){
  	 var id= $('input#id').val();
 	 var def= $('input#def').val();
 	 var stato= $('#sSel').val();
 	 //alert('id: '+id+'\ndef: '+def+'\nstato: '+stato); return false;
 	 var idTipUpdate = 'update-provincia'+id;
 	 $.ajax({
      url: 'inc/updateProvinciaScript.php',
      type: 'POST', 
      data: {id:id, def:def, stato:stato}, 
      success: function(data){
         //$('table#vocabolariTable tbody tr#stato'+id+' td:first-child').text(def);
         $(data)
           	   .dialog({position:['middle', 10]})
           	   .delay(2500)
           	   .fadeOut(function(){ $(this).dialog("close");window.location.href = 'provincia.php'; });
      }//success
    });//ajax
   });
 });
});
</script>