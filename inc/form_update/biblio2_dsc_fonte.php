<div id="biblio2_dsc_fonte_form" rel="<?php echo($pag); ?>">
  <input type="hidden" id="id_biblio2" name="id_biblio2" value="<?php echo($id_biblio2); ?>" />

  <label>TITOLO</label>
  <textarea id="biblio2_titolo_update" class="form noteform"><?php echo($titolo); ?></textarea>

  <label>SOGGETTO</label>
  <textarea id="biblio2_soggetto_update" class="form noteform"><?php echo($soggetto); ?></textarea>

  <label>AUTORE</label>
  <textarea id="biblio2_autore_update" class="form noteform"><?php echo($autore); ?></textarea>
  
  <label>NOTE AUTORE</label>
  <textarea id="biblio2_notenome_update" class="form noteform"><?php echo($notenome); ?></textarea>
  
  <label>SPECIFICI ELEMENTI DI INTERESSE</label>
  <textarea id="biblio2_contenuto_update" class="form noteform"><?php echo($contenuto); ?></textarea>
  
  <label>LIVELLO BIBLIOGRAFICO</label>
  <select id="biblio2_livello_update" name="biblio2_livello_update" class="form">
    <option value="<?php echo($livbib_id); ?>"><?php echo($livbib); ?></option>
       <?php
         $query =  ("SELECT * FROM lista_bib_livbib where id != $livbib_id order by definizione asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idlivbib = pg_result($result, $i, "id");
           $livbib = pg_result($result, $i, "definizione");
           echo "<option value=\"$idlivbib\">$livbib</option>";
         }
       ?>
  </select>
  
  
  <label>TIPOLOGIA DOCUMENTO</label>
  <select id="biblio2_tipodoc_update" name="biblio2_tipodoc_update" class="form">
    <option value="<?php echo($tipo); ?>"><?php echo($tipo); ?></option>
       <?php
         $query =  ("SELECT * FROM lista_bib_tipodoc where definizione != '$tipo' order by definizione asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idtipodoc = pg_result($result, $i, "id");
           $tipodoc = pg_result($result, $i, "definizione");
           echo "<option value=\"$tipodoc\">$tipodoc</option>";
         }
       ?>
  </select>
  
  <label>EDIZIONE</label>
  <textarea id="biblio2_edizione_update" class="form noteform"><?php echo($edizione); ?></textarea>
  
  <label>PERIODICITA'</label>
  <textarea id="biblio2_periodi_update" class="form noteform"><?php echo($periodi); ?></textarea>
  
  <label>DESCRIZIONE FISICA</label>
  <textarea id="biblio2_descrizione_update" class="form noteform"><?php echo($descrizione); ?></textarea>
  
  <label>LINGUA</label>
  <input type="hidden" value="<?php echo($lingua);?>" id="arrBiblio2Lingua"/>
  <?php
    $query =  ("SELECT * FROM lista_lingua order by definizione asc; ");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
      $idLingua = pg_result($result, $i, "id");
      $defLingua = pg_result($result, $i, "definizione");
      echo "<label for='lingua$defLingua' style='display:block;cursor:pointer;margin-bottom:3px; padding-right:3px;'><input type='checkbox' name='biblio2_lingua_update' id='lingua$defLingua' value='$defLingua' />$defLingua</label>";
    }

  ?>
  
  <label>NOTE STORICHE</label>
  <textarea id="biblio2_note_update" class="form noteform"><?php echo($note); ?></textarea>

<div class="login2" style="margin-top:20px;" id="biblio2_dsc_fonte_update">Salva modifiche</div>
<div class="chiudiForm login2" >Annulla modifiche</div>
</div>
<script type="text/javascript" >
$(document).ready(function(){
/*---------- lingua ---------*/
var al=$('#arrBiblio2Lingua').val();
var el = al.split(', ');
for(var i=0;i<el.length;i++){
   $('#lingua'+el[i]).attr('checked', 'checked');
}
/*---------------------------------------*/

});
</script>