<div id="mater3_morfologia_form">
<input type="hidden" id="idMater3" name="idMater3" value="<?php echo($idMater3); ?>" />

<label>CATEGORIA GENERALE</label>
<select id="mater3_catgen" name="mater3_catgen" class="form">
 <option value="<?php echo($catgenId); ?>"><?php echo($dog_catgen3);?></option>
  <?php
    $query =  ("SELECT * from lista_dog_catgen WHERE definizione != '$dog_catgen3' order by definizione asc");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
     $idCatGen = pg_result($result, $i, "id");
     $defCatGen = pg_result($result, $i, "definizione");
     echo "<option value='$idCatGen'>$defCatGen</option>";
    }
   ?>
</select>

<label>CATEGORIA SPECIFICA</label>
<select id="mater3_catspec" name="mater3_catspec" class="form">
 <option value="<?php echo($catspecId); ?>"><?php echo($dog_catspec3);?></option>
  <?php
    $query2 =  ("SELECT * from lista_dog_catspec WHERE definizione != '$dog_catspec3' order by definizione asc");
    $result2 = pg_query($connection, $query2);
    $righe2 = pg_num_rows($result2);
    $i2=0;
    for ($i2 = 0; $i2 < $righe2; $i2++){
     $idCatSpec = pg_result($result2, $i2, "id");
     $defCatSpec = pg_result($result2, $i2, "definizione");
     echo "<option value='$idCatSpec'>$defCatSpec</option>";
    }
   ?>
</select>

<label>DESCRIZIONE</label>
<textarea id="mater3_mrf_descr3" class="form noteform"><?php echo($descr); ?> </textarea>

<label>MATERIALI COSTRUTTIVI</label>
<div style="max-height:300px; overflow-y:auto;" class="checkboxDiv">
 <?php 
  $trimMatCost = str_replace(', ',',',$matcost);
  $trimMatCost = ltrim($trimMatCost);
  $arrMatCost= explode(",", $trimMatCost);
  $i = count($arrMatCost);
  $newMatCost ='';
  foreach($arrMatCost as $element){
   $q3 =  ("SELECT id FROM lista_dog_mtcos where definizione = '$element'; ");
   $r3 = pg_query($connection, $q3);
   $row3 = pg_num_rows($r3);
   if($row3>0) {
    for ($i3 = 0; $i3 < $row3; $i3++){
      $checkMatCost = pg_result($r3, $i3, "id");
      $newMatCost.=$checkMatCost.',';
    }
   }
  }
  echo "<input type='hidden' value='$newMatCost' id='arrMatCost'/>";

  $q4 =  ("SELECT * FROM lista_dog_mtcos order by definizione asc; ");
  $r4 = pg_query($connection, $q4);
  $row4 = pg_num_rows($r4);
  $i4=0;
  for ($i4 = 0; $i4 < $row4; $i4++){
    $id4 = pg_result($r4, $i4, "id");
    $def4 = pg_result($r4, $i4, "definizione");
    echo "<label for='matcos$id4' style='display:block;cursor:pointer;margin-bottom:3px; padding-right:3px;'><input type='checkbox' name='matcos' id='matcos$id4' value='$def4' />$def4</label>";
  }
?>
</div>

<label>TECNICHE COSTRUTTIVE</label>
<div style="max-height:300px; overflow-y:auto;" class="checkboxDiv">
 <?php 
  $trimModCost = str_replace(', ',',',$modcostr);
  $trimModCost = ltrim($trimModCost);
  $arrModCost= explode(",", $trimModCost);
  $i2 = count($arrModCost);
  $newModCost ='';
  foreach($arrModCost as $element){
   $q5 =  ("SELECT id FROM lista_dog_tccos where definizione = '$element'; ");
   $r5 = pg_query($connection, $q5);
   $row5 = pg_num_rows($r5);
   if($row5>0) {
    for ($i5 = 0; $i5 < $row5; $i5++){
      $checkModCost = pg_result($r5, $i5, "id");
      $newModCost.=$checkModCost.',';
    }
   }
  }
  echo "<input type='hidden' value='$newModCost' id='arrModCost'/>";

  $q6 =  ("SELECT * FROM lista_dog_tccos order by definizione asc; ");
  $r6 = pg_query($connection, $q6);
  $row6 = pg_num_rows($r6);
  for ($i6 = 0; $i6 < $row6; $i6++){
    $id6 = pg_result($r6, $i6, "id");
    $def6 = pg_result($r6, $i6, "definizione");
    echo "<label for='modcos$id6' style='display:block;cursor:pointer;margin-bottom:3px; padding-right:3px;'><input type='checkbox' name='modcos' id='modcos$id6' value='$def6' />$def6</label>";
  }
?>
</div>

<label>NOTE</label>
<textarea id="mater3_mrf_note3" class="form noteform"><?php echo($note2); ?></textarea>

 <div class="login2" style="margin-top:20px;" id="mater3_morfologia_salva">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>
<script type="text/javascript" >
$(document).ready(function(){
/*---------- matcos ---------*/
var arr1=$('#arrMatCost').val();
var elem1 = arr1.split(',');
for(var i=0;i<elem1.length;i++){
   $('#matcos'+elem1[i]).attr('checked', 'checked');
}
/*---------------------------------------*/
/*---------- modcos ---------*/
var arr2=$('#arrModCost').val();
var elem2 = arr2.split(',');
for(var i=0;i<elem2.length;i++){
   $('#modcos'+elem2[i]).attr('checked', 'checked');
}
/*---------------------------------------*/
});
</script>