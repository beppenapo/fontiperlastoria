<div id="conservazione_form">
  <label>STATO CONSERVAZIONE</label>
  <select id="scn_update" name="scn_update" class="form">
       <option value="<?php echo($id_scn); ?>"><?php echo($scn); ?></option>
        <?php
         $query =  ("SELECT * FROM lista_stato_conserv where id != $id_scn order by definizione asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idScn = pg_result($result, $i, "id");
           $def = pg_result($result, $i, "definizione");
           echo "<option value=\"$idScn\">$def</option>";
         }
        ?>
  </select>
  
  <label>NOTE</label>
  <textarea id="scn_note_update" class="form noteform"><?php echo($scn_note); ?></textarea>

 <div class="login2" style="margin-top:20px;" id="conservazione_update">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>