<div id="ubicazione_form">
 <input type="hidden" id="id_area_old" name="id_area_old" value="<?php echo($id_ubi); ?>"  class="form"/>
 <label>LOCALITA' / Indirizzo</label>
         <select id="localitaubi_update" name="localitaubi_update" class="form">
             <?php
             $query =  ("
             
              SELECT aree.id, comune.comune, localita.localita, indirizzo.indirizzo, anagrafica.nome
              FROM aree, localita, comune, indirizzo, anagrafica 
              WHERE aree.id_localita = localita.id AND aree.id_comune = comune.id AND aree.id_indirizzo = indirizzo.id AND aree.id_rubrica = anagrafica.id and aree.tipo = 2 order by comune asc, localita asc;
             ");
             $result = pg_query($connection, $query);
             $righe = pg_num_rows($result);
             $i=0;
             for ($i = 0; $i < $righe; $i++){
               $idArea = pg_result($result, $i, "id");
               $comune = pg_result($result, $i, "comune");
               $localita = pg_result($result, $i, "localita");
               $indirizzo = pg_result($result, $i, "indirizzo");
               $nome = pg_result($result, $i, "nome");
               $comune = stripslashes($comune);
               if($localita == 'Non determinabile') {$localita = '';}else {$localita = stripslashes($localita);}
               if($indirizzo == 'Non determinabile') {$indirizzo = '';}else {$indirizzo = stripslashes($indirizzo );}
               if($nome == 'Non determinabile') {$nome = '';}else {$nome = stripslashes($nome);}
               echo "<option ".($id_ubi == $idArea ? 'selected="selected"':'')."  value=\"$idArea\">$comune $localita $indirizzo $nome</option>";
             }
            ?>
  </select>


  <label>MOTIVAZIONE UBICAZIONE</label>
 <select id="motivubi_update" name="motivubi_update" class="form">
       <option value="<?php echo($id_motiv_ubi); ?>"><?php echo($motivubi); ?></option>
       <?php
         $query =  ("SELECT * FROM lista_ai_motiv where id != $id_motiv_ubi order by definizione asc; ");
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

  <label>NOTE</label>
  <textarea id="noteUbiUpdate" class="form" style="height:100px !important"><?php echo($noteUbi); ?></textarea>

      <div  id="ubicazione_update" class="login2" style="margin-top:20px;">Salva modifiche</div>
      <div class="chiudiForm login2">Annulla modifiche</div>
</div>
