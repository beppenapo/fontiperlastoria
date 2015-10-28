<div id="mater2_descr_form">
<input type="hidden" id="idMater2" name="idMater2" value="<?php echo($idMater2); ?>" />

<label>CATEGORIA GENERALE</label>
<select id="mater2_dog_catgen" name="mater2_dog_catgen" class="form">
 <option value="<?php echo($a2['catgen_id']); ?>"><?php echo($catgen);?></option>
  <?php
    $query =  ("SELECT * from lista_dog_catgen WHERE definizione != '$catgen' order by definizione asc");
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

<label>MORFOLOGIA</label>
<select id="mater2_dtp_morf" name="mater2_dtp_morf" class="form">
 <option value="<?php echo($a2['morf_id']); ?>"><?php echo($morf);?></option>
  <?php
    $query =  ("SELECT * from lista_dtp_morf WHERE definizione != '$morf' order by definizione asc");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
     $idMorf = pg_result($result, $i, "id");
     $defMorf = pg_result($result, $i, "definizione");
     echo "<option value='$idMorf'>$defMorf</option>";
    }
   ?>
</select>

<label>NOTE MORFOLOGIA</label>
<textarea id="mater2_dtp_morfnote" class="form"><?php echo($morfonote); ?> </textarea>

<label>FUNZIONE</label>
<select id="mater2_dtp_uso" name="mater2_dtp_uso" class="form">
 <option value="<?php echo($a2['uso_id']); ?>"><?php echo($uso);?></option>
  <?php
    $query =  ("SELECT * from lista_dtp_uso WHERE definizione != '$uso' order by definizione asc");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
     $idUso = pg_result($result, $i, "id");
     $defUso = pg_result($result, $i, "definizione");
     echo "<option value='$idUso'>$defUso</option>";
    }
   ?>
</select>

<label>NOTE FUNZIONE</label>
<textarea id="mater2_dtp_usonote" class="form"><?php echo($usonote); ?> </textarea>

<label>CATEGORIA SPECIFICA</label>
<select id="mater2_dtp_catspec" name="mater2_dtp_catspec" class="form">
 <option value="<?php echo($a2['catspec_id']); ?>"><?php echo($catspec);?></option>
  <?php
    $query =  ("SELECT * from lista_dog_catspec where definizione != '$catspec' order by definizione asc");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
     $idCatSpec = pg_result($result, $i, "id");
     $defCatSpec = pg_result($result, $i, "definizione");
     echo "<option value='$idCatSpec'>$defCatSpec</option>";
    }
   ?>
</select>
<br/>
<label>CONTESTO AMBIENTALE</label>
<select id="mater2_dtp_cta" name="mater2_dtp_cta" class="form">
 <option value="<?php echo($a2['cta_id']); ?>"><?php echo($cta);?></option>
  <?php
    $query =  ("SELECT * from lista_dtp_cta where definizione != '$cta' order by definizione asc");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
     $idCta = pg_result($result, $i, "id");
     $defCta = pg_result($result, $i, "definizione");
     echo "<option value='$idCta'>$defCta</option>";
    }
   ?>
</select>
<br/>
<label>NOTE CONTESTO AMBIENTALE</label>
<textarea id="mater2_dtp_ctanote" class="form"><?php echo($ctanote); ?> </textarea>
<br/>
<label>CRONOTIPO</label>
<select id="mater2_dtp_crntipo" name="mater2_dtp_crntipo" class="form">
 <option value="<?php echo($a2['crntipo_id']); ?>"><?php echo($crntipo);?></option>
  <?php
    $query =  ("SELECT * from lista_dtp_crntipo where definizione != '$crntipo' order by definizione asc");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
     $idCatSpec = pg_result($result, $i, "id");
     $defCatSpec = pg_result($result, $i, "definizione");
     echo "<option value='$idCatSpec'>$defCatSpec</option>";
    }
   ?>
</select>
<br/>
<label>NOTE CRONOTIPO</label>
<textarea id="mater2_dtp_crntiponote" class="form"><?php echo($crntiponote); ?> </textarea>
<br/>
<label>CODICE TIPOLOGIA</label>
<textarea id="mater2_dtp_num" class="form"><?php echo($num); ?> </textarea>
<br/>
<label>NOTE</label>
<textarea id="mater2_dtp_note" class="form"><?php echo($note1); ?> </textarea>

 <div class="login2" style="margin-top:20px;" id="mater2_descr_salva">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>
