<div id="area_interesse_form">
 <input type="hidden" id="id_area" name="id_area" value="<?php echo($id_area); ?>"  class="form"/>
 <label>LOCALITA' / Indirizzo</label>
   <select id="localita_update" name="localita_update" class="form">
    <?php
     $query =  ("
      SELECT distinct aree.id, comune.comune, localita.localita
      FROM aree, localita,comune
      WHERE 
        localita.comune = comune.id AND
        aree.id_comune = comune.id AND
        aree.id_localita = localita.id AND
        aree.tipo = 1
        order by comune asc, localita asc;
      ");
      $result = pg_query($connection, $query);
      $righe = pg_num_rows($result);
      $i=0;
      for ($i = 0; $i < $righe; $i++){
        $idArea = pg_result($result, $i, "id");
        $comune = pg_result($result, $i, "comune");
        $localita = pg_result($result, $i, "localita");
        echo "<option ".($id_area == $idArea ? 'selected="selected"':'')." value=\"$idArea\">$comune $localita</option>";
      }
    ?>
   </select>

 <label>MOTIVAZIONE AREA DI INTERESSE</label>
 <select id="motiv_update" name="motiv_update" class="form">
       <option value="<?php echo($id_motiv); ?>"><?php echo($motivai); ?></option>
       <?php
         $query =  ("SELECT * FROM lista_ai_motiv ". ($id_motiv ? " where  id != $id_motiv " : "" )." order by definizione asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idMotivAi = pg_result($result, $i, "id");
           $def = pg_result($result, $i, "definizione");
           echo "<option value=\"$idMotivAi\">$def</option>";
         }
       ?>
  </select>
 <div class="login2" style="margin-top:20px;" id="area_interesse_update">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>
