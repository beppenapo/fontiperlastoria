<div id="oral1_descr_form">
<input type="hidden" id="idOral1" name="idOral1" value="<?php echo($idOral1); ?>" />

<label>TIPOLOGIA ARCHIVIO</label>
<select id="oral1_dsc_tipoarch" name="oral1_dsc_tipoarch" class="form">
 <option><?php echo($dsc_tipoarch);?></option>
  <?php
    $query =  ("SELECT * from lista_archivi_alt_tipo where definizione != '$dsc_tipoarch' order by definizione asc");
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
<textarea id="oral1_dsc_numint" class="form noteform"><?php echo(stripslashes($dsc_numint)); ?></textarea>

<label>NUMERO INFORMATORI</label>
<textarea id="oral1_dsc_numinf" class="form noteform"><?php echo(stripslashes($dsc_numinf)); ?></textarea>

<label>CARATTERISTICHE ARCHIVIO</label>
<textarea id="oral1_dsc_cararch" class="form noteform"><?php echo(stripslashes($dsc_cararch)); ?></textarea>



<label>SCHEDATURA</label>
<textarea id="oral1_dsc_sched" class="form noteform"><?php echo(stripslashes($dsc_sched)); ?></textarea>

<label>TRASCRIZIONE</label>
<textarea id="oral1_dsc_trascr" class="form"><?php echo(stripslashes($dsc_trascr)); ?></textarea>

<label>INDICIZZAZIONE</label>
<textarea id="oral1_dsc_indic" class="form noteform"><?php echo(stripslashes($dsc_indic)); ?></textarea>

<label>SPECIFICI ELEMENTI DI INTERESSE</label>
<textarea id="oral1_dsc_matint" class="form noteform"><?php echo(stripslashes($dsc_matint)); ?></textarea>

<label>NOTE</label>
<textarea id="oral1_dsc_oss" class="form noteform"><?php echo(stripslashes($dsc_oss)); ?></textarea>


 <div class="login2" style="margin-top:20px;" id="oral1_descr_salva">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>



