<div id="ubicazione_form">
    <input type="hidden" id="id_area_old" name="id_area_old" value="<?php echo($id_as); ?>"  class="form"/>
    <label>LOCALITA' / Indirizzo</label>
    <select id="areaubi_update" name="areaubi_update" class="form">
    <?php
        //$query =  ("SELECT aree.id, aree.nome_area as area, comune.comune, localita.localita, indirizzo.indirizzo, anagrafica.nome  FROM aree, localita, comune, indirizzo, anagrafica   WHERE aree.id_localita = localita.id AND aree.id_comune = comune.id AND aree.id_indirizzo = indirizzo.id AND aree.id_rubrica = anagrafica.id and aree.tipo = 2 order by comune asc, localita asc; ");
        $query =  ("SELECT aree.id, a.id as area, a.nome AS area_def, an.nome FROM aree, area a, anagrafica an  WHERE aree.nome_area = a.id  AND aree.id_rubrica = an.id  AND a.tipo = 2");
        $result = pg_query($connection, $query);
        while($u = pg_fetch_array($result)){
            $attr = ($id_ubi == $u['area'])?'selected="selected"':'';
            echo "<option ".$attr."  value='".$u['area']."'>".$u['area_def']." ".$u['nome']."</option>";
        }
            ?>
  </select>


  <label>MOTIVAZIONE UBICAZIONE</label>
 <select id="motivubi_update" name="motivubi_update" class="form">
       <option value="<?php echo($id_motiv_ubi); ?>"><?php echo($motivubi); ?></option>
       <?php
         $query =  ("SELECT * FROM lista_ai_motiv order by definizione asc; ");
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
