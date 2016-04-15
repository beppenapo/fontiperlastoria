<div class="inner">
 <h2 class="h2aperto">DESCRIZIONE TIPOLOGIA</h2>
 <table class="mainData" style="width:98% !important;">
  <tr>
   <td width="50%;">
    <div class="arrow_box mater2catgen">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="mater2catgen"></i> CATEGORIA GENERALE</label>
    <select id="mater2_dog_catgen" name="mater2_dog_catgen" class="form">
     <option value="">--tutte le categorie--</option>
     <?php
       $query =  ("SELECT * from lista_dog_catgen order by definizione asc");
       $result = pg_query($connection, $query);
       $righe = pg_num_rows($result);
       $i=0;
       for ($i = 0; $i < $righe; $i++){
        $idCatGen = pg_result($result, $i, "id");
        $defCatGen = pg_result($result, $i, "definizione");
        echo "<option value='$idCatGen'>$defCatGen</option>";
       }
     ?>
    </select>
    <br/>
    <div class="arrow_box mater2morf">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="mater2morf"></i> MORFOLOGIA</label>
    <select id="mater2_dtp_morf" name="mater2_dtp_morf" class="form">
     <option value="">--tutte le morfologie--</option>
     <?php
      $query =  ("SELECT * from lista_dtp_morf order by definizione asc");
      $result = pg_query($connection, $query);
      $righe = pg_num_rows($result);
      $i=0;
      for ($i = 0; $i < $righe; $i++){
       $idMorf = pg_result($result, $i, "id");
       $defMorf = pg_result($result, $i, "definizione");
       echo "<option value='$idMorf'>$defMorf</option>";
      }
     ?>
    </select>
    <br/>
    <div class="arrow_box mater2notemorf">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="mater2notemorf"></i> NOTE MORFOLOGIA</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box mater2funz">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="mater2funz"></i> FUNZIONE</label>
    <select id="mater2_dtp_uso" name="mater2_dtp_uso" class="form">
     <option value="">--tutte le funzioni--</option>
     <?php
      $query =  ("SELECT * from lista_dtp_uso order by definizione asc");
      $result = pg_query($connection, $query);
      $righe = pg_num_rows($result);
      $i=0;
      for ($i = 0; $i < $righe; $i++){
       $idUso = pg_result($result, $i, "id");
       $defUso = pg_result($result, $i, "definizione");
       echo "<option value='$idUso'>$defUso</option>";
      }
     ?>
    </select>
    <br/>
    <div class="arrow_box mater2notefunz">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="mater2notefunz"></i> NOTE FUNZIONE</label>
    <textarea id="" class="form"></textarea>
   </td>
   <td>
    <div class="arrow_box mater2catspec">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="mater2catspec"></i> CATEGORIA SPECIFICA</label>
    <select id="mater2_dtp_catspec" name="mater2_dtp_catspec" class="form">
     <option value="">--tutte le categorie--</option>
     <?php
      $query =  ("SELECT * from lista_dog_catspec order by definizione asc");
      $result = pg_query($connection, $query);
      $righe = pg_num_rows($result);
      $i=0;
      for ($i = 0; $i < $righe; $i++){
       $idCatSpec = pg_result($result, $i, "id");
       $defCatSpec = pg_result($result, $i, "definizione");
       echo "<option value='$idCatSpec'>$defCatSpec</option>";
      }
     ?>
    </select>
    <br/>
    <div class="arrow_box mater2contamb">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="mater2contamb"></i> CONTESTO AMBIENTALE</label>
    <select id="mater2_dtp_cta" name="mater2_dtp_cta" class="form">
     <option value="">--tutti i contesti ambientali--</option>
     <?php
      $query =  ("SELECT * from lista_dtp_cta order by definizione asc");
      $result = pg_query($connection, $query);
      $righe = pg_num_rows($result);
      $i=0;
      for ($i = 0; $i < $righe; $i++){
       $idCta = pg_result($result, $i, "id");
       $defCta = pg_result($result, $i, "definizione");
       echo "<option value='$idCta'>$defCta</option>";
      }
     ?>
    </select>
    <br/>
    <div class="arrow_box mater2notecontamb">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="mater2notecontamb"></i> NOTE CONTESTO AMBIENTALE</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box mater2cronotipo">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="mater2cronotipo"></i> CRONOTIPO</label>
    <select id="mater2_dtp_crntipo" name="mater2_dtp_crntipo" class="form">
     <option value="">--tutti i cronotipi--</option>
     <?php
      $query =  ("SELECT * from lista_dtp_crntipo order by definizione asc");
      $result = pg_query($connection, $query);
      $righe = pg_num_rows($result);
      $i=0;
      for ($i = 0; $i < $righe; $i++){
       $idCatSpec = pg_result($result, $i, "id");
       $defCatSpec = pg_result($result, $i, "definizione");
       echo "<option value='$idCatSpec'>$defCatSpec</option>";
      }
     ?>
    </select>
    <br/>
    <div class="arrow_box mater2notecronotipo">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="mater2notecronotipo"></i> NOTE CRONOTIPO</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box mater2codtipo">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="mater2codtipo"></i> CODICE TIPOLOGIA</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box mater2note2">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="mater2note2"></i> NOTE</label>
    <textarea id="" class="form"></textarea>
   </td>
  </tr>
 </table>
</div>
