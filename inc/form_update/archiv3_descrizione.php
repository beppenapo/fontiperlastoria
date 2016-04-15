<div id="archiv3_descrizione_form">
<input type="hidden" id="idArchiv3" name="idArchiv3" value="<?php echo($idArchiv3); ?>" />

 <label>DATA REDAZIONE</label>
 <textarea id="archiv3_data_update" class="form"><?php echo($data); ?></textarea>

 <label>TIPOLOGIA DOCUMENTO</label>
 <div class="checkboxDiv">
 <?php
  $trim = str_replace(', ',',',$tipo);
  $trim = ltrim($trim);
  $arr = explode(",", $trim);
  $i = count($arr);
  $newArr ='';
  foreach($arr as $element){
   $query =  ("SELECT id FROM lista_archivi_dsc_tipo where definizione = '$element'; ");
   $result = pg_query($connection, $query);
   $righe = pg_num_rows($result);
   if($righe>0) {
    for ($i = 0; $i < $righe; $i++){
      $checkArchTipo = pg_result($result, $i, "id");
      $newArr.=$checkArchTipo.',';
    }
   }
  }
  echo "<input type='hidden' value='$newArr' id='arrArchiv3_tipo'/>";

  $query2 =  ("SELECT * FROM lista_archivi_dsc_tipo order by definizione asc; ");
  $result2 = pg_query($connection, $query2);
  $righe2 = pg_num_rows($result2);
  $i2=0;
  for ($i2 = 0; $i2 < $righe2; $i2++){
    $idArchTipo2 = pg_result($result2, $i2, "id");
    $defArchTipo2 = pg_result($result2, $i2, "definizione");
    echo "<label for='archtipo$idArchTipo2' style='display:block;cursor:pointer;margin-bottom:3px; padding-right:3px;'><input type='checkbox' name='archiv3_tipo_update' id='archtipo$idArchTipo2' value='$defArchTipo2' />$defArchTipo2</label>";
  }
?>
</div>

 <label>LUOGO REDAZIONE</label>
 <textarea id="archiv3_luogo_update" class="form"><?php echo($luogo); ?></textarea>

<label>SUPPORTO</label>
<select id="archiv3_supporto_update" name="archiv3_supporto_update" class="form">
 <option><?php echo($supporto);?></option>
  <?php
    $query =  ("SELECT * from lista_dsc_supp where definizione != '$supporto' order by definizione asc");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
     $idsupporto = pg_result($result, $i, "id");
     $defsupporto = pg_result($result, $i, "definizione");
     echo "<option value='$defsupporto'>$defsupporto</option>";
    }
   ?>
</select>

<label>CONTENUTO</label>
<textarea id="archiv3_contenuto_update" class="form noteform"><?php echo html_entity_decode($contenuto); ?></textarea>

<label>DESCRIZIONE FISICA</label>
<textarea id="archiv3_descrizione_update" class="form noteform"><?php echo html_entity_decode($descrizione); ?> </textarea>

<label>LINGUA</label>
<input type="hidden" value="<?php echo($lingua);?>" id="arrArchiv3Lingua"/>
  <?php
    $query =  ("SELECT * FROM lista_lingua order by definizione asc; ");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
      $idLingua = pg_result($result, $i, "id");
      $defLingua = pg_result($result, $i, "definizione");
      echo "<label for='lingua$defLingua' style='display:block;cursor:pointer;margin-bottom:3px; padding-right:3px;'><input type='checkbox' name='archiv3_lingua_update' id='lingua$defLingua' value='$defLingua' />$defLingua</label>";
    }

  ?>
<label>NOTE
<textarea id="archiv3_note_update" class="form noteform"><?php echo html_entity_decode($note); ?> </textarea>

<div class="login2" style="margin-top:20px;" id="archiv3_descrizione_salva">Salva modifiche</div>
<div class="chiudiForm login2">Annulla modifiche</div>
</div>
<script type="text/javascript" >
$(document).ready(function(){
/*---------- lingua ---------*/
var al=$('#arrArchiv3Lingua').val();
var el = al.split(', ');
for(var i=0;i<el.length;i++){
   $('#lingua'+el[i]).attr('checked', 'checked');
}
/*---------------------------------------*/
/*---------- tipo archivio ---------*/
var aat=$('#arrArchiv3_tipo').val();
var eat = aat.split(',');
for(var i=0;i<eat.length;i++){
   $('#archtipo'+eat[i]).attr('checked', 'checked');
}
/*---------------------------------------*/
});
</script>
