<div id="foto1_descr_form">
<input type="hidden" id="idFoto1" name="idFoto1" value="<?php echo($idFoto1); ?>" />
  
<label>TIPOLOGIA RACCOLTA</label>
<select id="foto1_crc_tipo" name="foto1_crc_tipo" class="form">
 <option><?php echo($tipologia);?></option>
  <?php
    $query =  ("SELECT * from lista_archivi_alt_tipo where definizione != '$tipologia' order by definizione asc");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
     $idTipoArch = pg_result($result, $i, "id");
     $defTipoArch = pg_result($result, $i, "definizione");
     echo "<option value='$defTipoArch'>$defTipoArch</option>";
    }
   ?>
</select>
<label>CONSISTENZA</label>
<textarea id="foto1_crc_con" class="form noteform"><?php echo($consistenza); ?></textarea>

<label>CARATTERISTICHE RACCOLTA</label>
<textarea id="foto1_crc_car" class="form noteform"><?php echo($caratteristiche); ?></textarea>

<label>SPECIFICI ELEMENTI DI INTERESSE</label>
<textarea id="foto1_crc_elemint" class="form noteform"><?php echo($elementi); ?></textarea>

<label>NOTE</label>
<textarea id="foto1_crc_note" class="form noteform"><?php echo($note); ?></textarea>


 <div class="login2" style="margin-top:20px;" id="foto1_descr_salva">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>