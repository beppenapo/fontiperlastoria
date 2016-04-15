<div id="mater3_contesto_form">
<input type="hidden" id="idMater3" name="idMater3" value="<?php echo($idMater3); ?>" />

<label>CONTESTO AMBIENTALE ATTUALE</label>
<textarea id="mater3_cta_vcoltatt" class="form noteform"><?php echo($vcoltatt); ?> </textarea>

<label>CONTESTO AMBIENTALE PASSATO</label>
<textarea id="mater3_cta_vcoltpass" class="form noteform"><?php echo($vcoltpass); ?> </textarea>

<label>FASCIA ALTIMETRICA</label>
<div style="max-height:300px; overflow-y:auto;" class="checkboxDiv">
 <?php 
  $trimFscAlt = str_replace(', ',',',$fscalt3);
  $trimFscAlt = ltrim($trimFscAlt);
  $arrFscAlt= explode(",", $trimFscAlt);
  $i = count($arrFscAlt);
  $newFscAlt ='';
  foreach($arrFscAlt as $element){
   $q1 =  ("SELECT id FROM lista_dca_fsalt where definizione = '$element'; ");
   $r1 = pg_query($connection, $q1);
   $row1 = pg_num_rows($r1);
   if($row1>0) {
    for ($i1 = 0; $i1 < $row1; $i1++){
      $checkFscAlt = pg_result($r1, $i1, "id");
      $newFscAlt.=$checkFscAlt.',';
    }
   }
  }
  echo "<input type='hidden' value='$newFscAlt' id='arrFscAlt'/>";

  $q2 =  ("SELECT * FROM lista_dca_fsalt order by id asc; ");
  $r2 = pg_query($connection, $q2);
  $row2 = pg_num_rows($r2);
  for ($i2 = 0; $i2 < $row2; $i2++){
    $id2 = pg_result($r2, $i2, "id");
    $def2 = pg_result($r2, $i2, "definizione");
    echo "<label for='fscalt$id2' style='display:block;cursor:pointer;margin-bottom:3px; padding-right:3px;'><input type='checkbox' name='fscalt' id='fscalt$id2' value='$def2' />$def2</label>";
  }
?>
</div>

<label>VEGETAZIONE</label>
<textarea id="mater3_cta_veg" class="form"><?php echo($veg); ?> </textarea>

<label>NOTE</label>
<textarea id="mater3_cta_note" class="form noteform"><?php echo($note6); ?> </textarea>


 <div class="login2" style="margin-top:20px;" id="mater3_contesto_salva">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>
<script type="text/javascript" >
$(document).ready(function(){
/*---------- fscalt ---------*/
var arr1=$('#arrFscAlt').val();
var elem1 = arr1.split(',');
for(var i=0;i<elem1.length;i++){
   $('#fscalt'+elem1[i]).attr('checked', 'checked');
}
/*---------------------------------------*/
});
</script>