<?php

?>

   <div class="inner">
    <div class="toggle">
        <div class="sezioni" style="border-top:none;"><h2>DESCRIZIONE INDAGINE</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>DATA</label>
               <textarea id="" class="form"></textarea>
               <br/>
               <label>RIFERIMENTO PERMESSO</label>
               <textarea id="" class="form"></textarea>
               <br/>
               <label>RIFERIMENTO SITO</label>
               <textarea id="" class="form"></textarea>
               <br/>
               <label>CODICE SCAVO</label>
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
    <div style="border-top:1px solid #96867B">
      <h2 class="h2aperto">DESCRIZIONE SITO</h2>
    </div>
      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <label>TIPOLOGIA</label>
          <select id="tipo_sito_update" name="tipo_sito_update" class="form">
           <option value="0"></option>
           <?php
            $query =  ("SELECT * FROM lista_dsc_tipol order by definizione asc; ");
            $result = pg_query($connection, $query);
            $righe = pg_num_rows($result);
            for ($i = 0; $i < $righe; $i++){
              $idTipo = pg_result($result, $i, "id");
              $def = pg_result($result, $i, "definizione");
              echo "<option value=\"$idTipo\">$def</option>";
            }
           ?>
          </select>
        </td>
        <td>
         <label>DESCRIZIONE</label>
         <textarea id="" class="form"></textarea>
        </td>
       </tr>
       <tr>
        <td>
         <label>SPECIFICI ELEMENTI DI INTERESSE / MATERIALI DATANTI</label>
         <textarea id="" class="form"></textarea>
        </td>
        <td>
         <label>NOTE</label>
         <textarea id="" class="form"></textarea>
        </td>
       </tr>
      </table>
      <div class="toggle">
        <div class="sezioni"><h2>DATI TECNICI</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>DIMENSIONI</label>
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
        <div class="sezioni"><h2>ALTRE INDAGINI</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>TIPO INDAGINE</label>
               <select id="tipo_ind_update" name="tipo_ind_update" class="form">
                <option value="0">--seleziona un valore dalla lista--</option>
                <?php
                 $query =  ("SELECT * FROM lista_ain_tipo order by definizione asc; ");
                 $result = pg_query($connection, $query);
                 $righe = pg_num_rows($result);
                 for ($i = 0; $i < $righe; $i++){
                  $idTipo = pg_result($result, $i, "id");
                  $def = pg_result($result, $i, "definizione");
                  echo "<option value=\"$idTipo\">$def</option>";
                 }
                ?>
               </select>
               <br/>
               <label>DATA</label>
               <textarea id="" class="form"></textarea>
               <br/>
               <label>ENTE RESPONSABILE</label>
               <select id="enresp_update" name="enresp_update" class="form">
                <option value="0">--seleziona n valore dalla lista--</option>
                <?php
                 $query =  ("SELECT id, nome FROM anagrafica order by nome asc; ");
                 $result = pg_query($connection, $query);
                 $righe = pg_num_rows($result);
                 for ($i = 0; $i < $righe; $i++){
                  $idEnresp = pg_result($result, $i, "id");
                  $nome = pg_result($result, $i, "nome");
                  echo "<option value=\"$idEnresp\">$nome</option>";
                 }
                ?>
               </select>
               <br/>
               <label>DESCRIZIONE</label>
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
