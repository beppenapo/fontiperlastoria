   <div class="inner">
   <div class="toggle">
    <div class="sezioni" style="border-top:none !important; border-bottom:1px solid #96867B"><h2>SEGNATURA/COLLOCAZIONE</h2></div>
        <div class="slide" style="border-bottom:1px solid #96867B">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <br/>
               <textarea id="" class="form"></textarea>
             </td>
             <td>
             </td>
           </tr>
          </table>
   </div>
  </div>
   
       <h2 class="h2aperto">DESCRIZIONE FOTOGRAFIA</h2>
      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <label>TITOLO</label>
         <textarea id="" class="form"></textarea>
        </td>
        <td>
         <label>AUTORE</label>
         <textarea id="" class="form"></textarea>
        </td>
       </tr>
       <tr>
        <td>
         <label>SOGGETTO</label>
         <textarea id="" class="form"></textarea>
        </td>
        <td>
         <label>NOTE AUTORE</label>
         <textarea id="" class="form"></textarea>
         <br/>
         <label>NOTE</label>
         <textarea id="" class="form"></textarea>
        </td>
       </tr>
      </table>
        
      <div class="toggle">
        <div class="sezioni"><h2>NOTIZIE STORICHE</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <br/>
               <textarea id="" class="form"></textarea>
             </td>
             <td>
              <label>NOTE</label>
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
               <label>MATERIA E TECNICA</label>
               <select id="foto2_dtc_mattec" name="foto2_dtc_mattec" class="form">
 <option value="">--tutte le tipologie --</option>
  <?php
    $query =  ("SELECT * from lista_dtc_mattec order by definizione asc");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
     $idmateria = pg_result($result, $i, "id");
     $defmateria = pg_result($result, $i, "definizione");
     echo "<option value='$defmateria'>$defmateria</option>";
    }
   ?>
</select>
             </td>
             <td></td>
            </tr>
            <tr>
             <td>
              <label>COLORE</label>
              <select id="foto2_dtc_icol" name="foto2_dtc_icol" class="form">
 <option value="">--tutti i colori--</option>
  <?php
    $query =  ("SELECT * from lista_dtc_icol order by definizione asc");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
     $idcolore = pg_result($result, $i, "id");
     $defcolore = pg_result($result, $i, "definizione");
     echo "<option value='$defcolore'>$defcolore</option>";
    }
   ?>
</select>
             </td>
             <td>
              <label>FORMATO FILE</label>
             <select id="foto2_dtc_ffile" name="foto2_dtc_ffile" class="form">
 <option value="">--tutti i formati--</option>
  <?php
    $query =  ("SELECT * from lista_dtc_ffile order by definizione asc");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
     $idformato = pg_result($result, $i, "id");
     $defformato = pg_result($result, $i, "definizione");
     echo "<option value='$defformato'>$defformato</option>";
    }
   ?>
</select>
             </td>
           </tr>
           <tr>
            <td>
              <label>MISURA STAMPA</label>
              <textarea id="" class="form"></textarea>
             </td>
             <td>
              <label>DIMENSIONE FOTO DIGITALE</label>
              <textarea id="" class="form"></textarea>
             </td>
           </tr>
           <tr>
            <td>
              <label>TIPOLOGIA APPARECCHIO</label>
              <textarea id="" class="form"></textarea>
              <br/>
              <label>PRESENZA NEGATIVI</label>
              <textarea id="" class="form"></textarea>
             </td>
             <td>
              <label>NOTE</label>
              <textarea id="" class="form"></textarea>
             </td>
           </tr>
          </table>
        </div>
   </div>
   <div class="toggle">
        <div class="sezioni"><h2>ALTRE NOTE</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="98%;">
               <br/>
               <textarea id="" class="form"></textarea>
             </td>
           </tr>
          </table>
        </div>
   </div>
  </div>
