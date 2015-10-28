<div id="foto2_datitec_form">
<input type="hidden" id="idFoto2" name="idFoto2" value="<?php echo($idFoto2); ?>" />

<label>MATERIA E TECNICA</label>
<select id="foto2_dtc_mattec" name="foto2_dtc_mattec" class="form">
 <option><?php echo($materia);?></option>
  <?php
    $query =  ("SELECT * from lista_dtc_mattec where definizione != '$materia' order by definizione asc");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
     $idmateria = pg_result($result, $i, "id");
     $defmateria = pg_result($result, $i, "definizione");
     echo "<option value='$defmateria'>$defmateria</option>";
    }
   ?>
</select>

<label>COLORE</label>
<select id="foto2_dtc_icol" name="foto2_dtc_icol" class="form">
 <option><?php echo($colore);?></option>
  <?php
    $query =  ("SELECT * from lista_dtc_icol where definizione != '$colore' order by definizione asc");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
     $idcolore = pg_result($result, $i, "id");
     $defcolore = pg_result($result, $i, "definizione");
     echo "<option value='$defcolore'>$defcolore</option>";
    }
   ?>
</select>

<label>MISURA STAMPA</label>
<textarea id="foto2_dtc_misst" class="form" style="height:250px !important;"><?php echo($misura); ?></textarea>

<label>TIPOLOGIA APPARECCHIO</label>
<textarea id="foto2_dtc_tpapp" class="form" style="height:250px !important;"><?php echo($apparecchio); ?></textarea>

<label>PRESENZA NEGATIVI</label>
<textarea id="foto2_dtc_presneg" class="form" style="height:250px !important;"><?php echo($negativi); ?></textarea>

<label>FORMATO FILE</label>
<select id="foto2_dtc_ffile" name="foto2_dtc_ffile" class="form">
 <option><?php echo($formato);?></option>
  <?php
    $query =  ("SELECT * from lista_dtc_ffile where definizione != '$formato' order by definizione asc");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
     $idformato = pg_result($result, $i, "id");
     $defformato = pg_result($result, $i, "definizione");
     echo "<option value='$defformato'>$defformato</option>";
    }
   ?>
</select>

<label>DIMENSIONE FOTO</label>
<textarea id="foto2_dtc_misfd" class="form" style="height:250px !important;"><?php echo($dimensione); ?></textarea>

<label>NOTE</label>
<textarea id="foto2_dtc_note" class="form" style="height:250px !important;"><?php echo($note2); ?></textarea>

 <div class="login2" style="margin-top:20px;" id="foto2_datitec_salva">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>