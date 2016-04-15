<div id="mater3_collegamenti_form">
<input type="hidden" id="idMater3" name="idMater3" value="<?php echo($idMater3); ?>" />

<label>LUOGHI DI ATTRAZIONE</label>
<div style="max-height:300px; overflow-y:auto;" class="checkboxDiv">
 <?php 
  $trimAttr = str_replace(', ',',',$lgattr);
  $trimAttr = ltrim($trimAttr);
  $arrAttr= explode(",", $trimAttr);
  $i = count($arrAttr);
  $newAttr ='';
  foreach($arrAttr as $element){
   $q1 =  ("SELECT id FROM lista_coll_lgatt where definizione = '$element'; ");
   $r1 = pg_query($connection, $q1);
   $row1 = pg_num_rows($r1);
   if($row1>0) {
    for ($i1 = 0; $i1 < $row1; $i1++){
      $checkAttr = pg_result($r1, $i1, "id");
      $newAttr.=$checkAttr.',';
    }
   }
  }
  echo "<input type='hidden' value='$newAttr' id='arrAttr'/>";

  $q2 =  ("SELECT * FROM lista_coll_lgatt order by definizione asc; ");
  $r2 = pg_query($connection, $q2);
  $row2 = pg_num_rows($r2);
  for ($i2 = 0; $i2 < $row2; $i2++){
    $id2 = pg_result($r2, $i2, "id");
    $def2 = pg_result($r2, $i2, "definizione");
    echo "<label for='attr$id2' style='display:block;cursor:pointer;margin-bottom:3px; padding-right:3px;'><input type='checkbox' name='attr' id='attr$id2' value='$def2' />$def2</label>";
  }
?>
</div>

<label>LUOGHI DI ATTIVITA' ECONOMICO-PRODUTTIVE</label>
<div style="max-height:300px; overflow-y:auto;" class="checkboxDiv">
 <?php 
  $trimLgecon = str_replace(', ',',',$lgecon);
  $trimLgecon = ltrim($trimLgecon);
  $arrLgecon= explode(",", $trimLgecon);
  $i = count($arrLgecon);
  $newLgecon ='';
  foreach($arrLgecon as $element){
   $q3 =  ("SELECT id FROM lista_coll_lgpro where definizione = '$element'; ");
   $r3 = pg_query($connection, $q3);
   $row3 = pg_num_rows($r3);
   if($row3>0) {
    for ($i3 = 0; $i3 < $row3; $i3++){
      $checkLgecon = pg_result($r3, $i3, "id");
      $newLgecon.=$checkLgecon.',';
    }
   }
  }
  echo "<input type='hidden' value='$newLgecon' id='arrLgecon'/>";

  $q4 =  ("SELECT * FROM lista_coll_lgpro order by definizione asc; ");
  $r4 = pg_query($connection, $q4);
  $row4 = pg_num_rows($r4);
  for ($i4 = 0; $i4 < $row4; $i4++){
    $id4 = pg_result($r4, $i4, "id");
    $def4 = pg_result($r4, $i4, "definizione");
    echo "<label for='lgecon$id4' style='display:block;cursor:pointer;margin-bottom:3px; padding-right:3px;'><input type='checkbox' name='lgecon' id='lgecon$id4' value='$def4' />$def4</label>";
  }
?>
</div>

<label>INFRASTRUTTURE COMPLEMENTARI</label>
<div style="max-height:300px; overflow-y:auto;" class="checkboxDiv">
 <?php 
  $trimInfCompl = str_replace(', ',',',$infcompl);
  $trimInfCompl = ltrim($trimInfCompl);
  $arrInfCompl= explode(",", $trimInfCompl);
  $i = count($arrInfCompl);
  $newInfCompl ='';
  foreach($arrInfCompl as $element){
   $q5 =  ("SELECT id FROM lista_coll_infcom where definizione = '$element'; ");
   $r5 = pg_query($connection, $q5);
   $row5 = pg_num_rows($r5);
   if($row5>0) {
    for ($i5 = 0; $i5 < $row5; $i5++){
      $checkInfCompl = pg_result($r5, $i5, "id");
      $newInfCompl.=$checkInfCompl.',';
    }
   }
  }
  echo "<input type='hidden' value='$newInfCompl' id='arrInfCompl'/>";

  $q6 =  ("SELECT * FROM lista_coll_infcom order by definizione asc; ");
  $r6 = pg_query($connection, $q6);
  $row6 = pg_num_rows($r6);
  for ($i6 = 0; $i6 < $row6; $i6++){
    $id6 = pg_result($r6, $i6, "id");
    $def6 = pg_result($r6, $i6, "definizione");
    echo "<label for='infcom$id6' style='display:block;cursor:pointer;margin-bottom:3px; padding-right:3px;'><input type='checkbox' name='infcom' id='infcom$id6' value='$def6' />$def6</label>";
  }
?>
</div>

<label>NOTE</label>
<textarea id="mater3_cll_note" class="form"><?php echo($note8); ?> </textarea>

 <div class="login2" style="margin-top:20px;" id="mater3_collegamenti_salva">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>


<script type="text/javascript" >
$(document).ready(function(){
/*---------- matcos ---------*/
var arr1=$('#arrAttr').val();
var elem1 = arr1.split(',');
for(var i=0;i<elem1.length;i++){
   $('#attr'+elem1[i]).attr('checked', 'checked');
}
/*---------------------------------------*/
/*---------- lgecon ---------*/
var arr2=$('#arrLgecon').val();
var elem2 = arr2.split(',');
for(var i=0;i<elem2.length;i++){
   $('#lgecon'+elem2[i]).attr('checked', 'checked');
}
/*---------------------------------------*/
/*---------- infcom ---------*/
var arr3=$('#arrInfCompl').val();
var elem3 = arr3.split(',');
for(var i=0;i<elem3.length;i++){
   $('#infcom'+elem3[i]).attr('checked', 'checked');
}
/*---------------------------------------*/
});
</script>