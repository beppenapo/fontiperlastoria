<?php

$q2 =  ("SELECT 
  scheda.id, 
  foto2.dgn_numsch2, 
  foto2.fot_collocazione as collocazione, 
  foto2.sog_titolo as titolo, 
  foto2.sog_autore as autore, 
  foto2.sog_sogg as soggetto, 
  foto2.sog_noteaut as note_autore, 
  foto2.sog_note as note, 
  foto2.sog_notestor as note_storiche,
  foto2.dtc_mattec as materia, 
  foto2.dtc_icol as colore, 
  foto2.dtc_misst as misura, 
  foto2.dtc_ffile as formato, 
  foto2.dtc_misfd as dimensione, 
  foto2.dtc_note as note2, 
  foto2.dtc_presneg as negativi, 
  foto2.dtc_tpapp as apparecchio, 
  foto2.alt_note as note3
FROM 
  public.foto2, 
  public.scheda
WHERE 
  foto2.dgn_numsch2 = scheda.dgn_numsch AND
  scheda.id = $id;");
$r2 = pg_query($connection, $q2);
$a2 = pg_fetch_array($r2, 0, PGSQL_ASSOC);
$rC2 = pg_num_rows($r2);

$collocazione= $a2['collocazione']; if($collocazione == '') {$collocazione=$nd;}
$titolo=$a2['titolo']; if($titolo == '') {$titolo=$nd;}
$autore=$a2['autore']; if($autore == '') {$autore=$nd;}
$soggetto=$a2['soggetto']; if($soggetto == '') {$soggetto=$nd;}
$note_autore=$a2['note_autore']; if($note_autore == '') {$note_autore=$nd;}
$note=$a2['note']; if($note == '') {$note=$nd;}
$note_storiche=$a2['note_storiche']; if($note_storiche == '') {$note_storiche=$nd;}

$materia=$a2['materia']; if($materia == '') {$materia=$nd;}
$colore=$a2['colore']; if($colore == '') {$colore=$nd;}
$misura=$a2['misura']; if($misura == '') {$misura=$nd;}
$formato=$a2['formato']; if($formato == '') {$formato=$nd;}
$dimensione=$a2['dimensione']; if($dimensione == '') {$dimensione=$nd;}
$note2=$a2['note2']; if($note2 == '') {$note2=$nd;}
$negativi=$a2['negativi']; if($negativi == '') {$negativi=$nd;}
$apparecchio=$a2['apparecchio']; if($apparecchio == '') {$apparecchio=$nd;}
$note3=$a2['note3']; if($note3 == '') {$note3=$nd;}

?>
   <div class="inner">
   <div class="toggle">
    <div class="sezioni" style="border-top:none !important; border-bottom:1px solid #96867B"><h2>SEGNATURA/COLLOCAZIONE</h2></div>
        <div class="slide" style="border-bottom:1px solid #96867B">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <br/>
               <div class="valori"><?php echo($collocazione); ?> </div>
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
         <div class="valori"><?php echo($titolo); ?> </div>
        </td>
        <td>
         <label>AUTORE</label>
         <div class="valori"><?php echo($autore); ?> </div>
        </td>
       </tr>
       <tr>
        <td>
         <label>SOGGETTO</label>
         <div class="valori"><?php echo($soggetto); ?> </div>
        </td>
        <td>
         <label>NOTE AUTORE</label>
         <div class="valori"><?php echo($note_autore); ?> </div>
         <br/>
         <label>NOTE</label>
         <div class="valori"><?php echo($note); ?> </div>
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
               <div class="valori"><?php echo($note_storiche); ?> </div>
             </td>
             <td>
              <label>NOTE</label>
              <div class="valori">Campo non presente nel database</div>
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
               <div class="valori"><?php echo($materia); ?></div>
             </td>
             <td></td>
            </tr>
            <tr>
             <td>
              <label>COLORE</label>
              <div class="valori"><?php echo($colore); ?></div>
             </td>
             <td>
              <label>FORMATO FILE</label>
              <div class="valori"><?php echo($formato); ?></div>
             </td>
           </tr>
           <tr>
            <td>
              <label>MISURA STAMPA</label>
              <div class="valori"><?php echo($misura); ?></div>
             </td>
             <td>
              <label>DIMENSIONE FOTO DIGITALE</label>
              <div class="valori"><?php echo($dimensione); ?></div>
             </td>
           </tr>
           <tr>
            <td>
              <label>TIPOLOGIA APPARECCHIO</label>
              <div class="valori"><?php echo($apparecchio); ?></div>
              <br/>
              <label>PRESENZA NEGATIVI</label>
              <div class="valori"><?php echo($negativi); ?></div>
             </td>
             <td>
              <label>NOTE</label>
              <div class="valori"><?php echo($note2); ?></div>
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
               <div class="valori"><?php echo($note3); ?></div>
             </td>
           </tr>
          </table>
        </div>
   </div>
  </div>