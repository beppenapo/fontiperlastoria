<div class="slide">
         <table class="mainData" style="width:98% !important;">
            <tr>
             <td>
  <label>NOME</label>
  <textarea id="nome_ana_update" class="form"></textarea>
 </td>
 <td>
  <label>COMUNE</label>
  <select id="comune_ana_update" name="comune_ana_update" class="form">
       <option value="0">--Seleziona un Comune dalla lista--</option>
       <?php
         $query =  ("SELECT * FROM public.comune order by comune asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idComAna = pg_result($result, $i, "id");
           $defComAna = pg_result($result, $i, "comune");
           echo "<option value=\"$idComAna\">$defComAna</option>";
         }
       ?>
  </select>
 </td>
 <td>
  <label>LOCALITA'</label>
  <select id="localita_ana_update" name="localita_ana_update" class="form disabilitata" disabled>
   <option value="0"></option>
       <?php
         $query = ("SELECT localita.id AS id_localita, localita.comune AS id_comune, comune.comune, localita.localita FROM public.localita, public.comune WHERE localita.comune = comune.id order by localita asc;");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idLocAna = pg_result($result, $i, "id_localita");
           $locAna = pg_result($result, $i, "localita");
           echo "<option value=\"$idLocAna\">$locAna</option>";
         }
       ?>
  </select>
 </td>
 <td>
 <label>INDIRIZZO</label>
  <select id="indirizzo_ana_update" name="indirizzo_ana_update" class="form disabilitata" disabled>
   <option value="0"></option>
       <?php
         $query =  ("SELECT indirizzo.id AS id_indirizzo, indirizzo.comune as id_comune, comune.comune, indirizzo.indirizzo FROM comune,indirizzo WHERE indirizzo.comune = comune.id order by indirizzo asc;");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idIndAna = pg_result($result, $i, "id_indirizzo");
           $indAna = pg_result($result, $i, "indirizzo");
           echo "<option value=\"$idIndAna\">$indAna</option>";
         }
       ?>
  </select>
 </td>
</tr>
<tr> 
 <td>
  <label>TELEFONO</label>
  <textarea id="tel_ana" class="form"></textarea>
 </td>
 <td>
  <label>INDIRIZZO E-MAIL</label>
  <textarea id="mail_ana" class="form"></textarea>
 </td>
 <td> 
  <label>SITO WEB</label>
  <textarea id="web_ana" class="form"></textarea>
 </td>
 <td></td>
 </tr>
 <tr>
 <td colspan="4">
  <label>NOTE</label>
  <textarea id="note_ana" class="form" style="height:100px !important"></textarea>
 </td>
</tr>
</table> 
 </div>
 
 //ANAGRAFICA
   var nome_ana_update = $('#nome_ana_update').val(); 
   var comune_ana_update = $('#comune_ana_update').val(); 
   var localita_ana_update = $('#localita_ana_update').val(); 
   var indirizzo_ana_update = $('#indirizzo_ana_update').val(); 
   var tel_ana = $('#tel_ana').val(); 
   var mail_ana = $('#mail_ana').val(); 
   var web_ana = $('#web_ana').val(); 
   var note_ana = $('#note_ana').val();