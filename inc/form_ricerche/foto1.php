   <div class="inner">
       <h2 class="h2aperto">DESCRIZIONE RACCOLTA</h2>
      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <label>TIPOLOGIA RACCOLTA</label>
<select id="foto1_crc_tipo" name="foto1_crc_tipo" class="form">
 <option value="">--tutte lel tipologie--</option>
  <?php
    $query =  ("SELECT * from lista_archivi_alt_tipo order by definizione asc");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
     $idTipoArch = pg_result($result, $i, "id");
     $defTipoArch = pg_result($result, $i, "definizione");
     echo "<option value='$defTipoArch'>$defTipoArch</option>";
    }
   ?>
</select>
        </td>
        <td></td>
       </tr>
       <tr>
        <td>
         <label>CONSISTENZA</label>
         <textarea id="" class="form"></textarea>
         <br/>
         <label>CARATTERISTICHE RACCOLTA</label>
         <textarea id="" class="form"></textarea>
        </td>
        <td>
         <label>SPECIFICI ELEMENTI DI INTERESSE</label>
         <textarea id="" class="form"></textarea>
         <br/>
         <label>NOTE</label>
         <textarea id="" class="form"></textarea>
        </td>
       </tr>
      </table>
      <div class="toggle">
        <div class="sezioni"><h2>CRITERI DI ORDINAMENTO</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td>
               <textarea id="" class="form"></textarea>
             </td>
            </tr>
      </table>
        </div>
   </div>
     
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
  </div>
