<div id="descr_indagine_form" rel="<?php echo($pag); ?>">
  <input type="hidden" id="id_archeo" name="id_archeo" value="<?php echo($id_archeo); ?>" />

  <label>DATA</label>
  <textarea id="data_update" class="form noteform"><?php echo(stripslashes($data)); ?></textarea>

  <label>RIFERIMENTO PERMESSO</label>
  <textarea id="rifper_update" class="form noteform"><?php echo($rifper); ?></textarea>
  
  <?php if($pag == 61) {?>
  <label>METODO</label>
  <select id="metodo_update" name="metodo_update" class="form">
       <option value="<?php echo($id_metodo); ?>"><?php echo($metodo); ?></option>
        <?php
         $query =  ("SELECT * FROM lista_ind_met where id != $id_metodo order by definizione asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idMetodo = pg_result($result, $i, "id");
           $def = pg_result($result, $i, "definizione");
           echo "<option value=\"$idMetodo\">$def</option>";
         }
        ?>
  </select>
  <?php } ?>
  <label>RIFERIMENTO SITO</label>
  <textarea id="rifsito_update" class="form"><?php echo(stripslashes($rifsito)); ?></textarea>
  
  <?php if($pag == 61) {?>
  <label>DESCRIZIONE</label>
  <textarea id="descr_update" class="form noteform"><?php echo(stripslashes($descr)); ?></textarea>
  <?php } ?>
  
  <label>CODICE SCAVO</label>
  <textarea id="codsca_update" class="form"><?php echo($codsca); ?></textarea>
  
  <label>NOTE</label>
  <textarea id="note_update" class="form noteform"><?php echo(stripslashes($note)); ?></textarea>

<?php if($pag == 61) {?>
 <div class="login2" style="margin-top:20px;" id="descr_ind_update">Salva modifiche</div>
<?php }else {?>
 <div class="login2" style="margin-top:20px;" id="descr_ind2_update">Salva modifiche</div>
<?php } ?>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>