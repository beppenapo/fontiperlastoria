<div id="provenienza_form">
  <label>DENOMINAZIONE RICERCA</label>
  <select id="denricprv_update" name="denricprv_update" class="form">
       <option value="<?php echo($idricprv); ?>"><?php echo($denricprv); ?></option>
        <?php
         $query =  ("SELECT * FROM ricerca where id != $idricprv order by denric asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $ric = pg_result($result, $i, "id");
           $def = pg_result($result, $i, "denric");
           $def = stripslashes($def); 
           echo "<option value=\"$ric\">$def</option>";
         }
        ?>
  </select>


  <!-- tabella compilazione -->
  <label>REDATTORE</label>
  <textarea disabled="disabled" id="compilatoreprv_update" class="form"><?php echo($compilatoreprv); ?></textarea>

  <!-- tabella compilazione -->
  <label>DATA</label>
  <textarea disabled="disabled" id="dataprv_update" class="form"><?php echo($dataprv); ?></textarea>
  <div id="tabellaRicercaPrv">

   <!-- tabella ricerca -->
   <label>ENTE RESPONSABILE</label>
   <textarea disabled="disabled" id="enrespprv_update" class="form"><?php echo($enrespprv); ?></textarea>

   <!-- tabella ricerca -->
   <label>RESPONSABILE RICERCA</label>
   <textarea disabled="disabled" id="respricprv_update" class="form"><?php echo($respricprv); ?></textarea>
  </div>

  <!-- tabella compilazione -->
  <label>NOTE</label>
  <textarea id="noteprv_update" class="form noteform"><?php echo($noteprv); ?></textarea>

  <div class="login2" style="margin-top:20px;" id="provenienza_update">Salva modifiche</div>
  <div class="chiudiForm login2">Annulla modifiche</div>

</div>
