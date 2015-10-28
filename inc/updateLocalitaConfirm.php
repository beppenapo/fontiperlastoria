<?php
include("db.php");
 $def = stripslashes($_POST['def']);
 $id = $_POST['id'];
 $comune = stripslashes($_POST['comune']);
 $idCom = $_POST['idCom'];
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
 <textarea id="def" style="padding:5px; width:240px; height:80px"><?php echo($def); ?></textarea>
 
 <div class="login2 updateButton" style="font-size:10px !important" id="ok">Modifica Località</div>
</div>

<script type="text/javascript" >
$(document).ready(function() {

 $('.updateButton').each(function(){
   $(this).click(function(){
  	 var id= $('input#id').val();
 	 var def= $('textarea#def').val();
 	 var comune= $('#cSel').val();
 	 var comuneDef = $('select[name="cSel"] option:selected').text();
 	 //alert('id: '+id+'\ndef: '+def+'\nstato: '+stato); return false;
 	 var idTipUpdate = 'update-localita'+id;
 	 $.ajax({
      url: 'inc/updateLocalitaScript.php',
      type: 'POST', 
      data: {id:id, def:def, comune:comune}, 
      success: function(data){
      	$(data)
           .dialog({position:['middle', 10]})
           .delay(2500)
           .fadeOut(function(){ $(this).dialog("close");window.location.href = 'localita.php'; })
           ;
      }//success
    });//ajax
   });
 });
});
</script>