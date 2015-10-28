<div id="dati_principali_form">
<input type="hidden" id="id_scheda" name="id_scheda" value="<?php echo($id_scheda); ?>" />

     <label>NUMERO SCHEDA</label>
     <textarea id="num_sch_update" class="form"><?php echo($numSch); ?></textarea>
     
      <label>TIPO SCHEDA</label>
      <select id="tpsch_update" name="tpsch_update" class="form">
       <option value="<?php echo($tpsch); ?>"><?php echo($a['tipo_scheda']); ?></option>
       <?php
         $query =  ("SELECT * FROM public.lista_dgn_tpsch where id != $tpsch order by definizione asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $id_tpsch = pg_result($result, $i, "id");
           $def = pg_result($result, $i, "definizione");
           echo "<option value=\"$id_tpsch\">$def</option>";
         }
       ?>
      </select>

      <label>DEFINIZIONE OGGETTO</label>
      <textarea id="def_ogg_update" class="form"><?php echo($dgn_ogg); ?></textarea>

       <label>CRONOLOGIA</label>
       <textarea id="cro_spec_update" class="form"><?php echo($cro_spec); ?></textarea>

       <label>LIVELLO INDIVIDUAZIONE DATI</label>
       <select id="livind_update" name="livind_update" class="form">
        <option value="<?php echo($livind); ?>"><?php echo($a['individuazione']); ?></option>
        <?php
         $query =  ("SELECT * FROM public.lista_dgn_livind where id != $livind order by definizione asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $id_livind = pg_result($result, $i, "id");
           $def = pg_result($result, $i, "definizione");
           echo "<option value=\"$id_livind\">$def</option>";
         }
        ?>
       </select>

      <label>NOTE</label>
      <textarea id="schnote_update" class="form noteform"><?php echo($note1); ?></textarea>
      
      <div class="login2" id="dati_principali_update" style="margin-top:20px;">Salva modifiche</div>
      <div class="chiudiForm login2">Annulla modifiche</div>
</div>