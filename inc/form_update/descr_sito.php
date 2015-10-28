<div id="descr_sito_form">
 <label>TIPOLOGIA</label>
 <select id="tipo_sito_update" name="tipo_sito_update" class="form">
       <option value="<?php echo($id_tipologia); ?>"><?php echo($tipologia); ?></option>
        <?php
         $query =  ("SELECT * FROM lista_dsc_tipol where id != $id_tipologia order by definizione asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idTipo = pg_result($result, $i, "id");
           $def = pg_result($result, $i, "definizione");
           echo "<option value=\"$idTipo\">$def</option>";
         }
        ?>
  </select>

 <label>DESCRIZIONE</label>
 <textarea id="descr_sito2" class="form noteform"><?php echo($descr); ?></textarea>
 
 <label>SPECIFICI ELEMENTI DI INTERESSE / MATERIALI DATANTI</label>
 <textarea id="ind_rif_sito2" class="form"><?php echo($sit_matdata); ?></textarea>
  
 <label>NOTE</label>
 <textarea id="ind_note_sito2" class="form"><?php echo($note); ?></textarea>

 <div class="login2" style="margin-top:20px;" id="descr_sito2_update">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>