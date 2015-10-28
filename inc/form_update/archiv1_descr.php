<div id="archiv1_descr_form">
<input type="hidden" id="id_archivi_update" name="id_archivi" value="<?php echo($id_archivi); ?>" />
<input type="hidden" id="id_archivi1_update" name="id_archivi1" value="<?php echo($id_archivi1); ?>" />

 <label>TIPOLOGIA ARCHIVIO</label>
  <select id="archiv1_tipo_arch_update" name="enresp_update" class="form">
       <option value="<?php echo($id_tipoArch); ?>"><?php echo($tipoArch); ?></option>
        <?php
         $query =  ("SELECT * FROM lista_archivi_alt_tipo where id != $id_tipoArch order by definizione asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idTipoArch = pg_result($result, $i, "id");
           $defTipoArch = pg_result($result, $i, "definizione");
           echo "<option value=\"$idTipoArch\">$defTipoArch</option>";
         }
        ?>
  </select>

 <label>CONSISTENZA</label>
 <textarea id="archiv1_consist_update" class="form noteform"><?php echo($consistenza); ?></textarea>

 <label>TIPOLOGIA DOCUMENTI</label>
  <div class="checkboxDiv">
 <?php 
  $trim = str_replace(', ',',',$tipoDoc);
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
  echo "<input type='hidden' value='$newArr' id='arrArchiv1_tipodoc'/>";

  $query2 =  ("SELECT * FROM lista_archivi_dsc_tipo order by definizione asc; ");
  $result2 = pg_query($connection, $query2);
  $righe2 = pg_num_rows($result2);
  $i2=0;
  for ($i2 = 0; $i2 < $righe2; $i2++){
    $idArchTipo2 = pg_result($result2, $i2, "id");
    $defArchTipo2 = pg_result($result2, $i2, "definizione");
    echo "<label for='archtipo$idArchTipo2' style='display:block;cursor:pointer;margin-bottom:3px; padding-right:3px;'><input type='checkbox' name='archiv1_tipoDoc_update' id='archtipo$idArchTipo2' value='$defArchTipo2' />$defArchTipo2</label>";
  }
?>
</div>

 <label>SEGNALAZIONE FONDI</label>
 <textarea id="archiv1FondiSegn_update" class="form noteform"><?php echo($fondiSegn); ?></textarea>

 <label>ELENCO FONDI</label>
 <textarea id="archiv1_fondi_update" class="form noteform"><?php echo($fondi); ?></textarea>

 <label>NOTE</label>
 <textarea id="archiv1_note_update" class="form noteform"><?php echo($note); ?></textarea>

 <div class="login2" style="margin-top:20px;" id="archiv1_descr_update">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>
<script type="text/javascript" >
$(document).ready(function(){
/*---------- tipo archivio ---------*/
var aat=$('#arrArchiv1_tipodoc').val();
var eat = aat.split(',');
for(var i=0;i<eat.length;i++){
   $('#archtipo'+eat[i]).attr('checked', 'checked');
}
/*---------------------------------------*/
});
</script>