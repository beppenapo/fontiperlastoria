<div class="inner">
 <div class="toggle">
  <div class="sezioni" style="border-top:none !important; border-bottom:1px solid #96867B"><h2>SEGNATURA/COLLOCAZIONE</h2></div>
  <div class="slide" style="border-bottom:1px solid #96867B">
   <table class="mainData" style="width:98% !important;">
    <tr>
     <td width="50%;">
      <div class="arrow_box mater3segnatura">Inserire descrizione campo</div>
      <label><i class="fa fa-info-circle" data-class="mater3segnatura"></i> SEGNATURA/COLLOCAZIONE</label>
      <textarea id="" class="form"></textarea>
     </td>
     <td>
     </td>
    </tr>
   </table>
  </div>
 </div>
 <div style="border-top:none !important; border-bottom:1px solid #96867B">
  <h2 class="h2aperto">DENOMINAZIONE COMUNE</h2>
  <table class="mainData" style="width:98% !important;">
   <tr>
    <td width="50%;">
      <div class="arrow_box mater3dencom">Inserire descrizione campo</div>
      <label><i class="fa fa-info-circle" data-class="mater3dencom"></i> DENOMINAZIONE COMUNE</label>
     <textarea id="" class="form"></textarea>
    </td>
    <td>
      <div class="arrow_box mater3note">Inserire descrizione campo</div>
      <label><i class="fa fa-info-circle" data-class="mater3note"></i> NOTE</label>
     <textarea id="" class="form"></textarea>
    </td>
   </tr>
  </table>
 </div>
 <h2 class="h2aperto">DESCRIZIONE MORFOLOGIA</h2>
  <table class="mainData" style="width:98% !important;">
   <tr>
    <td width="50%;">
      <div class="arrow_box mater3catgen">Inserire descrizione campo</div>
      <label><i class="fa fa-info-circle" data-class="mater3catgen"></i> CATEGORIA GENERALE</label>
     <select id="mater3_catgen" name="mater3_catgen" class="form">
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
      <div class="arrow_box mater3materiali">Inserire descrizione campo</div>
      <label><i class="fa fa-info-circle" data-class="mater3materiali"></i> MATERIALI COSTRUTTIVI</label>
     <select id="materiali" name="materiali" class="form">
      <option value="">--tutti i materiali--</option>
      <?php
       $q5 =  ("SELECT * FROM lista_dog_mtcos order by definizione asc;");
       $r5 = pg_query($connection, $q5);
       $row5 = pg_num_rows($r5);
       for ($i5 = 0; $i5 < $row5; $i5++){
        $id5 = pg_result($r5, $i5, "id");
        $def5 = pg_result($r5, $i5, "definizione");
        echo "<option value='$id5'>$def5</option>";
       }
      ?>
     </select>
     <br/>
      <div class="arrow_box mater3descriz">Inserire descrizione campo</div>
      <label><i class="fa fa-info-circle" data-class="mater3descriz"></i> DESCRIZIONE</label>
     <textarea id="" class="form"></textarea>
    </td>
    <td>
      <div class="arrow_box mater3catspec">Inserire descrizione campo</div>
      <label><i class="fa fa-info-circle" data-class="mater3catspec"></i> CATEGORIA SPECIFICA</label>
     <select id="mater3_catspec" name="mater3_catspec" class="form">
      <option value="">--tutte le categorie--</option>
      <?php
       $query2 =  ("SELECT * from lista_dog_catspec order by definizione asc");
       $result2 = pg_query($connection, $query2);
       $righe2 = pg_num_rows($result2);
       $i2=0;
       for ($i2 = 0; $i2 < $righe2; $i2++){
        $idCatSpec = pg_result($result2, $i2, "id");
        $defCatSpec = pg_result($result2, $i2, "definizione");
        echo "<option value='$idCatSpec'>$defCatSpec</option>";
       }
      ?>
     </select>
     <br/>
      <div class="arrow_box mater3tecniche">Inserire descrizione campo</div>
      <label><i class="fa fa-info-circle" data-class="mater3tecniche"></i> TECNICHE COSTRUTTIVE</label>
      <select id="tecniche" name="tecniche" class="form">
       <option value="">--tutte le tecniche--</option>
        <?php
         $q4 =  ("SELECT * FROM lista_dog_tccos order by definizione asc;");
         $r4 = pg_query($connection, $q4);
         $row4 = pg_num_rows($r4);
         for ($i4 = 0; $i4 < $row4; $i4++){
          $id4 = pg_result($r4, $i4, "id");
          $def4 = pg_result($r4, $i4, "definizione");
          echo "<option value='$id4'>$def4</option>";
         }
        ?>
      </select>
      <br/>
      <div class="arrow_box mater3note2">Inserire descrizione campo</div>
      <label><i class="fa fa-info-circle" data-class="mater3note2"></i> NOTE</label>
      <textarea id="" class="form"></textarea>
     </td>
    </tr>
   </table>
   <div class="toggle">
    <div class="sezioni"><h2>DESCRIZIONE FUNZIONI</h2></div>
    <div class="slide">
     <table class="mainData" style="width:98% !important;">
      <tr>
       <td width="50%;">
        <div class="arrow_box mater3funzioni">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3funzioni"></i> FUNZIONI</label>
        <textarea id="" class="form"></textarea>
       </td>
       <td>
        <div class="arrow_box mater3note3">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3note3"></i> NOTE</label>
        <textarea id="" class="form"></textarea>
       </td>
      </tr>
     </table>
    </div>
   </div>
   <div class="toggle">
    <div class="sezioni"><h2>DATI TECNICI</h2></div>
    <div class="slide">
     <table class="mainData" style="width:98% !important;">
      <tr>
       <td width="50%;">
        <div class="arrow_box mater3dim">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3dim"></i> DIMENSIONI</label>
        <textarea id="" class="form"></textarea>
       </td>
       <td>
        <div class="arrow_box mater3quote">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3quote"></i> QUOTE</label>
        <textarea id="" class="form"></textarea>
       </td>
      </tr>
      <tr>
       <td colspan="2">
        <div class="arrow_box mater3note4">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3note4"></i> NOTE</label>
        <textarea id="" class="form"></textarea>
       </td>
      </tr>
     </table>
    </div>
   </div>
   <div class="toggle">
    <div class="sezioni"><h2>COSTRUZIONE</h2></div>
    <div class="slide">
     <table class="mainData" style="width:98% !important;">
      <tr>
       <td width="50%;">
        <div class="arrow_box mater3commit">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3commit"></i> COMMITTENTE</label>
        <textarea id="" class="form"></textarea>
        <br/>
        <div class="arrow_box mater3datacostruz">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3datacostruz"></i> DATA COSTRUZIONE</label>
        <textarea id="" class="form"></textarea>
        <br/>
        <div class="arrow_box mater3motivdatacostruz">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3motivdatacostruz"></i> MOTIVAZIONE DATA COSTRUZIONE</label>
        <select id="mater3_cst_commfnt" name="mater3_cst_commfnt" class="form">
         <option value="">--tutte le motivazioni--</option>
         <?php
          $query =  ("SELECT * from lista_cro_motiv order by definizione asc");
          $result = pg_query($connection, $query);
          $righe = pg_num_rows($result);
          $i=0;
          for ($i = 0; $i < $righe; $i++){
           $idCommFnt = pg_result($result, $i, "id");
           $defCommFnt = pg_result($result, $i, "definizione");
           echo "<option value='$idCommFnt'>$defCommFnt</option>";
          }
         ?>
        </select>
       </td>
       <td>
        <div class="arrow_box mater3esecutore">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3esecutore"></i> ESECUTORE</label>
        <textarea id="" class="form"></textarea>
        <br/>
        <div class="arrow_box mater3note5">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3note5"></i> NOTE</label>
        <textarea id="" class="form"></textarea>
       </td>
      </tr>
     </table>
    </div>
   </div>
   <div class="toggle">
    <div class="sezioni"><h2>RESTAURI/MANUTENZIONI</h2></div>
    <div class="slide">
     <table class="mainData" style="width:98% !important;">
      <tr>
       <td width="50%;">
        <div class="arrow_box mater3elerest">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3elerest"></i> ELENCO RESTAURI/MANUTENZIONI</label>
        <textarea id="" class="form"></textarea>
       </td>
       <td>
        <div class="arrow_box mater3docrest">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3docrest"></i> DOCUMENTAZIONE RESTAURI/MANUTENZIONI</label>
        <textarea id="" class="form"></textarea>
       </td>
      </tr>
      <tr>
       <td colspan="2">
        <div class="arrow_box mater3note6">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3note6"></i> NOTE</label>
        <textarea id="" class="form"></textarea>
       </td>
      </tr>
     </table>
    </div>
   </div>
   <div class="toggle">
    <div class="sezioni"><h2 class="sottosez">DESCRIZIONE CONTESTO AMBIENTALE</h2></div>
    <div class="slide">
     <table class="mainData" style="width:98% !important;">
      <tr>
       <td width="50%;">
        <div class="arrow_box mater3ambatt">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3ambatt"></i> CONTESTO AMBIENTALE ATTUALE</label>
        <textarea id="" class="form"></textarea>
        <br/>
        <div class="arrow_box mater3ambpass">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3ambpass"></i> CONTESTO AMBIENTALE PASSATO</label>
        <textarea id="" class="form"></textarea>
       </td>
       <td>
        <div class="arrow_box mater3altim">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3altim"></i> FASCIA ALTIMETRICA</label>
        <select id="fascia" name="fascia" class="form">
         <option value="">--tutte le fasce--</option>
         <?php
          $query6 =  ("SELECT * FROM lista_dca_fsalt order by id asc;");
          $result6 = pg_query($connection, $query6);
          $righe6 = pg_num_rows($result6);
          for ($i = 0; $i < $righe6; $i++){
           $id6 = pg_result($result6, $i, "id");
           $def6 = pg_result($result6, $i, "definizione");
           echo "<option value='$id6'>$def6</option>";
          }
         ?>
        </select>
        <br/>
        <div class="arrow_box mater3vegetaz">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3vegetaz"></i> VEGETAZIONE</label>
        <textarea id="" class="form"></textarea>
       </td>
      </tr>
      <tr>
       <td colspan="2">
        <div class="arrow_box mater3note7">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3note7"></i> NOTE</label>
        <textarea id="" class="form"></textarea>
       </td>
      </tr>
     </table>
    </div>
   </div>
   <div class="toggle">
    <div class="sezioni"><h2 class="sottosez">RAPPORTI TRA INFRASTRUTTURE</h2></div>
    <div class="slide">
     <table class="mainData" style="width:98% !important;">
      <tr>
       <td style="width:70% !important;">
        <div class="arrow_box mater3legato">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3legato"></i> SI LEGA A</label>
        <textarea id="" class="form"></textarea>
       </td>
      </tr>   
      <tr>
       <td style="width:70% !important;">
        <div class="arrow_box mater3taglia">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3taglia"></i> TAGLIA</label>
        <textarea id="" class="form"></textarea>
       </td>
      </tr>
      <tr>
       <td style="width:70% !important;">
        <div class="arrow_box mater3tagliato">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3tagliato"></i> TAGLIATO DA</label>
        <textarea id="" class="form"></textarea>
       </td>
      </tr>
      <tr>
       <td style="width:70% !important;">
        <div class="arrow_box mater3conduce">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3conduce"></i> CONDUCE A</label>
        <textarea id="" class="form"></textarea>
       </td>
      </tr>
      <tr>
       <td style="width:70% !important;">
        <div class="arrow_box mater3servito">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3servito"></i> SERVITO DA</label>
        <textarea id="" class="form"></textarea>
       </td>
      </tr>   
     </table>
    </div>
   </div>
   <div class="toggle">
    <div class="sezioni"><h2 class="sottosez">COLLEGAMENTI VIARI</h2></div>
    <div class="slide">
     <table class="mainData" style="width:98% !important;">
      <tr>
       <td width="50%;">
        <div class="arrow_box mater3luoghiattraz">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3luoghiattraz"></i> LUOGHI DI ATTRAZIONE</label>
        <select id="fascia" name="fascia" class="form">
         <option value="">--tutti i luoghi--</option>
          <?php
           $query7 =  ("SELECT * FROM lista_coll_lgatt order by definizione asc; ");
           $result7 = pg_query($connection, $query7);
           $righe7 = pg_num_rows($result7);
           for ($i = 0; $i < $righe7; $i++){
            $id7 = pg_result($result7, $i, "id");
            $def7 = pg_result($result7, $i, "definizione");
            echo "<option value='$id7'>$def7</option>";
           }
          ?>
        </select>
        <br/>
        <div class="arrow_box mater3luoghieconom">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3luoghieconom"></i> LUOGHI DI ATTIVITA' ECONOMICO-PRODUTTIVE</label>
        <select id="fascia" name="fascia" class="form">
                <option value="">--tutti i luoghi--</option>
                <?php
                 $query8 =  ("SELECT * FROM lista_coll_lgpro order by definizione asc;");
                 $result8 = pg_query($connection, $query8);
                 $righe8 = pg_num_rows($result8);
                 for ($i = 0; $i < $righe8; $i++){
                  $id8 = pg_result($result8, $i, "id");
                  $def8 = pg_result($result8, $i, "definizione");
                  echo "<option value='$id8'>$def8</option>";
                 }
                ?>
        </select>
       </td>
       <td>
        <div class="arrow_box mater3infrcompl">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3infrcompl"></i> INFRASTRUTTURE COMPLEMENTARI</label>
        <select id="fascia" name="fascia" class="form">
                <option value="">--tutte le infrastrutture--</option>
                <?php
                 $query9 =  ("SELECT * FROM lista_coll_infcom order by definizione asc;");
                 $result9 = pg_query($connection, $query9);
                 $righe9 = pg_num_rows($result9);
                 for ($i = 0; $i < $righe9; $i++){
                  $id9 = pg_result($result9, $i, "id");
                  $def9 = pg_result($result9, $i, "definizione");
                  echo "<option value='$id9'>$def9</option>";
                 }
                ?>
        </select>
        <br/>
        <div class="arrow_box mater3note8">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3note8"></i> NOTE</label>
        <textarea id="" class="form"></textarea>
       </td>
      </tr>
     </table>
    </div>
   </div>
   <div class="toggle">
    <div class="sezioni"><h2>ISCRIZIONI</h2></div>
    <div class="slide">
     <table class="mainData" style="width:98% !important;">
      <tr>
       <td width="50%;">
        <div class="arrow_box mater3descriziscriz">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3descriziscriz"></i> DESCRIZIONE</label>
        <textarea id="" class="form"></textarea>
       </td>
       <td>
        <div class="arrow_box mater3trascriz">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3trascriz"></i> TRASCRIZIONE</label>
        <textarea id="" class="form"></textarea>
       </td>
      </tr>
      <tr>
       <td colspan="2">
        <div class="arrow_box mater3note9">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater3note9"></i> NOTE</label>
        <textarea id="" class="form"></textarea>
       </td>
      </tr>
     </table>
    </div>
   </div>
   <div class="toggle">
    <div class="sezioni"><h2>CATASTI STORICI</h2></div>
    <div class="slide">
     <table class="mainData" style="width:98% !important;">
      <tr>
       <td width="50%;">
        <div class="arrow_box mater31814">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater31814"></i> CATASTO 1814</label>
        <textarea id="" class="form"></textarea>
       </td>
       <td>
        <div class="arrow_box mater31859">Inserire descrizione campo</div>
        <label><i class="fa fa-info-circle" data-class="mater31859"></i> CATASTO 1859</label>
        <textarea id="" class="form"></textarea>
       </td>
      </tr>
     </table>
    </div>
   </div>
  </div>
