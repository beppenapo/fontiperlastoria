<?php
$nd = 'Dato non presente';
$q2 =  ("SELECT 
  scheda.id, 
  foto1.crc_con, 
  foto1.crc_car, 
  foto1.crc_note
FROM 
  public.foto1, 
  public.scheda
WHERE 
  foto1.dgn_numsch1 = scheda.dgn_numsch AND
  scheda.id = $id;");
$r2 = pg_query($connection, $q2);
$a2 = pg_fetch_array($r2, 0, PGSQL_ASSOC);
$rC2 = pg_num_rows($r2);

$crc_con= $a2['crc_con']; if($crc_con == '') {$crc_con=$nd;}
$crc_car=$a2['crc_car']; if($crc_car == '') {$crc_car=$nd;}
$crc_note=$a2['crc_note']; if($crc_note == '') {$crc_note=$nd;}

?>
   <div class="inner">
       <h2 class="h2aperto">DESCRIZIONE RACCOLTA</h2>
      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <label>TIPOLOGIA RACCOLTA</label>
         <div class="valori">Campo non presente nel database</div>
        </td>
        <td></td>
       </tr>
       <tr>
        <td>
         <label>CONSISTENZA</label>
         <div class="valori"><?php echo($crc_con); ?> </div>
         <br/>
         <label>CARATTERISTICHE RACCOLTA</label>
         <div class="valori"><?php echo($crc_car); ?> </div>
        </td>
        <td>
         <label>SPECIFICI ELEMENTI DI INTERESSE</label>
         <div class="valori">Campo non presente nel database</div>
         <br/>
         <label>NOTE</label>
         <div class="valori"><?php echo($crc_note); ?> </div>
        </td>
       </tr>
      </table>

      <div class="toggle">
        <div class="sezioni"><h2>CRITERI DI ORDINAMENTO</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <div class="valori">Campo non presente nel database</div>
             </td>
             <td>
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
               <div class="valori">Campo non presente nel database</div>
             </td>
             <td>
              <label>NOTE</label>
              <div class="valori">Campo non presente nel database</div>
             </td>
           </tr>
          </table>
        </div>
   </div>
  </div>