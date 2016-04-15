<div id="altre_indagini_form">
 
 <label>TIPO INDAGINE</label>
 <select id="tipo_ind_update" name="tipo_ind_update" class="form">
       <option value="<?php echo($id_tipo); ?>"><?php echo($tipo); ?></option>
        <?php
         $query =  ("SELECT * FROM lista_ain_tipo where id != $id_tipo order by definizione asc; ");
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
  
 <label>DATA</label>
 <textarea id="ain_data_update" class="form noteform"><?php echo($ain_data); ?></textarea>

 <label>ENTE RESPONSABILE</label>
 <select id="enresp_update" name="enresp_update" class="form">
       <option value="<?php echo($id_enresp); ?>"><?php echo($enresp); ?></option>
        <?php
         $query =  ("SELECT id, nome FROM anagrafica where id != $id_enresp order by nome asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idEnresp = pg_result($result, $i, "id");
           $nome = pg_result($result, $i, "nome");
           echo "<option value=\"$idEnresp\">$nome</option>";
         }
        ?>
  </select>
  
 <label>DESCRIZIONE</label>
 <textarea id="descr2_update" class="form noteform"><?php echo($descr2); ?></textarea>
 
 <label>NOTE</label>
 <textarea id="note1_update" class="form noteform"><?php echo($note1); ?></textarea>

 <div class="login2" style="margin-top:20px;" id="altre_indagini_update">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>