<div id="compilazione_form">
  <label>DENOMINAZIONE RICERCA</label>
  <select id="denric_update" name="denric_update" class="form">
       <? if ($idric){
            ?><option value="<?php echo($idric); ?>"><?php echo($denric); ?></option><?
        }
        else{
          ?> <option value="1">--seleziona un valore dalla lista--</option><?
        }
        ?>

        <?php
         $query =  ("SELECT * FROM ricerca ".($idric?"where id != $idric" :'') ."  order by denric asc; ");
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
  <label>COMPILATORE</label>
  <textarea disabled="disabled" id="compilatore_update" class="form"><?php echo($compilatore); ?></textarea>

  <!-- tabella compilazione -->
  <label>DATA</label>
  <textarea disabled="disabled" id="datacmp_update" class="form"><?php echo($datacmp); ?></textarea>

  <!-- tabella ricerca -->
  <div id="tabellaRicerca">
   <label>ENTE RESPONSABILE</label>
   <textarea disabled="disabled" id="enteresp_update" class="form"><?php echo($enresp); ?></textarea>

   <!-- tabella ricerca -->
   <label>RESPONSABILE RICERCA</label>
   <textarea disabled="disabled" id="respric_update" class="form"><?php echo($respric); ?></textarea>
  </div>
  <!-- tabella compilazione -->
  <label>NOTE</label>
  <textarea id="notecmp_update" class="form noteform"><?php echo($notecmp); ?></textarea>

  <div class="login2" style="margin-top:20px;" id="compilazione_update">Salva modifiche</div>
  <div class="chiudiForm login2">Annulla modifiche</div>
</div>
