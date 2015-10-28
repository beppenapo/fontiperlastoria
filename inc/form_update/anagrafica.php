<div id="anagrafica_form">

    <label>NOME</label>
    <select id="id_ana" name="id_ana" class="form">
     <?php
      $query =  ("SELECT * FROM anagrafica order by nome asc; ");
      $result = pg_query($connection, $query);
      $righe = pg_num_rows($result);
      for ($i = 0; $i < $righe; $i++){
       $id_ana = pg_result($result, $i, "id");
       $nome = pg_result($result, $i, "nome");
       echo "<option ".($idana == $id_ana ? 'selected="selected"':'')."  value=\"$id_ana\">$nome</option>";
      }
     ?>
    </select>

  <label>NOTE</label>
  <textarea id="note_ana_update" class="form noteform"><?php echo($noteana); ?></textarea>

   <div class="login2" style="margin-top:20px;" id="anagrafica_update">Salva modifiche</div>
   <div class="chiudiForm login2">Annulla modifiche</div>
</div>
