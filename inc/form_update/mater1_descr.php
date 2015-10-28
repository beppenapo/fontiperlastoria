<div id="mater1_descr_form">
<input type="hidden" id="idMater1" name="idMater1" value="<?php echo($idMater1); ?>" />
  
<label>TIPOLOGIA RACCOLTA/INDAGINE</label>
<select id="mater1_dsc_tipo_raccolta" class="form">
 <option value="<?php echo($idTipologia); ?>"><?php echo($tipologia); ?></option>
 <?php 
  $q1 = ("SELECT * from lista_tipo_raccolta where id != $idTipologia ORDER BY definizione ASC;");
  $r1 = pg_query($connection, $q1);
  $row1 = pg_num_rows($r1);
  for ($i = 0; $i < $row1; $i++){
    $id1 = pg_result($r1, $i, "id");
    $def = pg_result($r1, $i, "definizione");
    echo "<option value='$id1'>$def</option>";
  }
 ?>
</select>

<label>CONSISTENZA</label>
<textarea id="mater1_dsc_nummanuf" class="form noteform"><?php echo($consistenza); ?></textarea>

<label>CARATTERISTICHE RACCOLTA/INDAGINE</label>
<textarea id="mater1_dsc_ogg" class="form noteform"><?php echo($caratteristiche); ?></textarea>

<label>CATEGORIE MANUFATTI</label>
<div style="max-height:300px; overflow-y:auto;">
 <?php 
  $trimCatMan = str_replace(', ',',',$categorie);
  $trimCatMan = ltrim($trimCatMan);
  $arrCatMan= explode(",", $trimCatMan);
  $i = count($arrCatMan);
  $newArr ='';
  foreach($arrCatMan as $element){
   $q4 =  ("SELECT id FROM lista_dsc_catman where definizione = '$element'; ");
   $r4 = pg_query($connection, $q4);
   $row4 = pg_num_rows($r4);
   if($row4>0) {
    for ($i = 0; $i < $row4; $i++){
      $checkCatManTipo = pg_result($r4, $i, "id");
      $newArr.=$checkCatManTipo.',';
    }
   }
  }
  echo "<input type='hidden' value='$newArr' id='arrCatMan'/>";

  $q3 =  ("SELECT * FROM lista_dsc_catman order by definizione asc; ");
  $r3 = pg_query($connection, $q3);
  $row3 = pg_num_rows($r3);
  $i3=0;
  for ($i3 = 0; $i3 < $row3; $i3++){
    $id3 = pg_result($r3, $i3, "id");
    $def3 = pg_result($r3, $i3, "definizione");
    echo "<label for='catman$id3' style='display:block;cursor:pointer;margin-bottom:3px; padding-right:3px;'><input type='checkbox' name='mater1CatMan' id='catman$id3' value='$def3' />$def3</label>";
  }
?>
</div>

<label>CONTESTO CONSERVATIVO</label>
<textarea id="mater1_dsc_contaa" class="form noteform"><?php echo($contesto); ?></textarea>

<label>GRADO DI UTILIZZO</label>
<textarea id="mater1_dsc_gradutil" class="form"><?php echo($utilizzo); ?></textarea>

<label>SPECIFICI ELEMENTI DI INTERESSE</label>
<textarea id="mater1_dsc_oggpreg" class="form noteform"><?php echo($elementi); ?></textarea>

<label>NOTE</label>
<textarea id="mater1_dsc_oss" class="form noteform"><?php echo($note1); ?></textarea>

 <div class="login2" style="margin-top:20px;" id="mater1_descr_salva">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>
<script type="text/javascript" >
$(document).ready(function(){
/*---------- lingua ---------*/
var al=$('#arrCatMan').val();
var el = al.split(',');
for(var i=0;i<el.length;i++){
   $('#catman'+el[i]).attr('checked', 'checked');
}
/*---------------------------------------*/

});
</script>