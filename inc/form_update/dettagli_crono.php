<div id="dettagli_crono_form">
    <label>SPECIFICA</label>
    <textarea id="crospec_update" class="form"><?php echo($cro_spec); ?></textarea>

    <label>CRONOLOGIA INIZIALE</label>    
    <input type="text" id="cro_iniz" name="cro_iniz_update" maxlength="4" value="<?php echo($cro_iniz); ?>"  class="form"/>
    
    <label>CRONOLOGIA FINALE</label>
    <input type="text" id="cro_fine" name="cro_fine_update" maxlength="4" value="<?php echo($cro_fin); ?>"  class="form"/>

    <label>MOTIVAZIONE CRONOLOGIA</label>
    <select id="cro_motiv_update" name="cro_motiv_update" class="form">
       <option value="<?php echo($cro_motiv_id); ?>"><?php echo($cro_motiv); ?></option>
        <?php
         $query =  ("SELECT * FROM public.lista_cro_motiv where id != $cro_motiv_id order by definizione asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idcro = pg_result($result, $i, "id");
           $def = pg_result($result, $i, "definizione");
           echo "<option value=\"$idcro\">$def</option>";
         }
        ?>
    </select>
    
    <label>NOTE</label>
    <textarea id="cronote_update" class="form noteform"><?php echo($cro_note); ?></textarea>
    
  <div id="dettagli_crono_update" class="login2" style="margin-top:20px;">Salva modifiche</div>
  <div class="chiudiForm login2">Annulla modifiche</div>
</div>