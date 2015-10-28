<div id="mater3_costruzioni_form">
<input type="hidden" id="idMater3" name="idMater3" value="<?php echo($idMater3); ?>" />

<label>COMMITTENTE</label>
<textarea id="mater3_cst_commnome" class="form"><?php echo($commnome); ?> </textarea>

<label>ESECUTORE</label>
<textarea id="mater3_cst_esecnome" class="form"><?php echo($esecnome); ?> </textarea>

<label>DATA COSTRUZIONE</label>
<textarea id="mater3_cst_commdat" class="form"><?php echo($commdat); ?> </textarea>

<label>MOTIVAZIONE DATA COSTRUZIONE</label>
<select id="mater3_cst_commfnt" name="mater3_cst_commfnt" class="form">
 <option value="<?php echo($commfntId); ?>"><?php echo($commfnt);?></option>
  <?php
    $query =  ("SELECT * from lista_cro_motiv WHERE id != '$commfntId' order by definizione asc");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
     $idCommFnt = pg_result($result, $i, "id");
     $defCommFnt = pg_result($result, $i, "definizione");
     echo "<option value='$idCommFnt'>$defCommFnt</option>";
    }
   ?>
</select>

<label>NOTE</label>
<textarea id="mater3_cst_note" class="form noteform"><?php echo($note5); ?> </textarea>


 <div class="login2" style="margin-top:20px;" id="mater3_costruzioni_salva">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>
