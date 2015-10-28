<div class="inner">
 <h2 class="h2aperto">DESCRIZIONE FONTE BIBLIOGRAFICA</h2>
 <table class="mainData" style="width:98% !important;">
  <tr>
   <td width="50%;">
    <div class="arrow_box biblio2titolo">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="biblio2titolo"></i> TITOLO</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box biblio2sogg">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="biblio2sogg"></i> SOGGETTO</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box biblio2aut">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="biblio2aut"></i> AUTORE</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box biblio2noteaut">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="biblio2noteaut"></i> NOTE AUTORE</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box biblio2elemint">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="biblio2elemint"></i> SPECIFICI ELEMENTI DI INTERESSE</label>
    <textarea id="" class="form"></textarea>
   </td>
   <td>
    <div class="arrow_box biblio2livbib">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="biblio2livbib"></i> LIVELLO BIBLIOGRAFICO</label>
    <select id="biblio2_livello_update" name="biblio2_livello_update" class="form">
     <option value="">--tutti i livelli--</option>
     <?php
       $query =  ("SELECT * FROM lista_bib_livbib order by definizione asc; ");
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
    <br/>
    <div class="arrow_box biblio2tipodoc">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="biblio2tipodoc"></i> TIPOLOGIA DOCUMENTO</label>
    <select id="biblio2_tipodoc_update" name="biblio2_tipodoc_update" class="form">
     <option value="">--tutte le tipologie--</option>
     <?php
       $query =  ("SELECT * FROM lista_bib_tipodoc order by definizione asc; ");
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
    <br/>
    <div class="arrow_box biblio2ediz">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="biblio2ediz"></i> EDIZIONE</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box biblio2period">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="biblio2period"></i> PERIODICITA'</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box biblio2descrfis">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="biblio2descrfis"></i> DESCRIZIONE FISICA</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box biblio2lingua">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="biblio2lingua"></i> LILNGUA</label>
    <select id="lingua" name="lingua" class="form">
     <option value="">--tutte le lingue--</option>
     <?php
      $query =  ("SELECT * FROM lista_lingua order by definizione asc; ");
      $result = pg_query($connection, $query);
      $righe = pg_num_rows($result);
      for ($i = 0; $i < $righe; $i++){
       $idLingua = pg_result($result, $i, "id");
       $defLingua = pg_result($result, $i, "definizione");
       echo "<option value=\"$idLingua\">$defLingua</option>";
      }
     ?>
    </select>
    <br/>
    <div class="arrow_box biblio2notsto">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="biblio2notsto"></i> NOTE STORICHE</label>
    <textarea id="" class="form"></textarea>
   </td>
  </tr>
 </table>
</div>
