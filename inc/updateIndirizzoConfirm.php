<?php
include("db.php");
 $indirizzo = stripslashes($_POST['indirizzo']);
 $id = $_POST['id'];
 $comune = stripslashes($_POST['comune']);
 $idCom = $_POST['idCom'];
 $cap = $_POST['cap'];
?>

<div class="confirm">
<h2 id="avvisi">Per annullare la modifica e chiudere la finestra utilizza il tasto in alto a destra</h2>
 <input type="hidden" id="id" value="<?php echo($id); ?>" />
 <select id="cSel" name="cSel" class="addListe">
   <option value="<?php echo($idCom); ?>"><?php echo($comune); ?></option>
   <?php
    $sc = ("Select * from comune WHERE id != $idCom ORDER BY comune ASC");
    $sce = pg_query($connection, $sc);
    $scr = pg_num_rows($sce);
    for ($x = 0; $x < $scr; $x++){
       $cId = pg_result($sce, $x,"id"); 	
       $cDef = pg_result($sce, $x, "comune");
       
       echo "<option value='$cId'>$cDef</option>";
     }
   ?>
  </select>
 <input type="text" id="indUp" value="<?php echo($indirizzo); ?>" />
 <input type="text" id="capUp" value="<?php echo($cap); ?>" placeholder="cap assente" maxlength="5" />
 
 <div class="login2 modifica" style="font-size:10px !important" id="ok">Modifica Indirizzo</div>
</div>

<script type="text/javascript" >
$(document).ready(function() {

 $('.modifica').each(function(){
   $(this).click(function(){
  	 var id= $('input#id').val();
 	 var indirizzo= $('input#indUp').val();
 	 var cap= $('input#capUp').val();
 	 var comune= $('#cSel').val();
 	 var comuneDef = $('select[name="cSel"] option:selected').text();
 	 //alert('id: '+id+'\ndef: '+indirizzo+'\nstato: '+cap+'\ncomune: '+comune); return false;
 	 var idTipUpdate = 'update-indirizzo'+id;
 	 $.ajax({
      url: 'inc/updateIndirizzoScript.php',
      type: 'POST', 
      data: {id:id, indirizzo:indirizzo, comune:comune, cap:cap}, 
      success: function(data){
      	$(data)
           .dialog({position:['middle', 10]})
           .delay(2500)
           .fadeOut(function(){ $(this).dialog("close");window.location.href = 'indirizzo.php'; });
      }//success
    });//ajax
   });
 });
});
</script>