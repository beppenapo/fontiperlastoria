<?php
$nd = '-';
$q2 =  ("SELECT 
  scheda.id, 
  foto2.id as id_foto2,
  foto2.fot_collocazione as collocazione, 
  foto2.sog_titolo as titolo, 
  foto2.sog_autore as autore, 
  foto2.sog_sogg as soggetto, 
  foto2.sog_noteaut as note_autore, 
  foto2.sog_note as note, 
  foto2.sog_notestor as note_storiche,
  foto2.sog_notstooss as oss_storiche,
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
$idFoto2		=$a2['id_foto2'];
$collocazione		=stripslashes($a2['collocazione']); if($collocazione == '') {$collocazione=$nd;}
$titolo			=stripslashes($a2['titolo']); if($titolo == '') {$titolo=$nd;}
$autore			=stripslashes($a2['autore']); if($autore == '') {$autore=$nd;}
$soggetto		=stripslashes($a2['soggetto']); if($soggetto == '') {$soggetto=$nd;}
$note_autore		=stripslashes($a2['note_autore']); if($note_autore == '') {$note_autore=$nd;}
$note			=stripslashes($a2['note']); if($note == '') {$note=$nd;}
$note_storiche		=stripslashes($a2['note_storiche']); if($note_storiche == '') {$note_storiche=$nd;}
$oss_storiche		=stripslashes($a2['oss_storiche']); if($note_storiche == '') {$note_storiche=$nd;}
$materia		=stripslashes($a2['materia']); if($materia == '') {$materia=$nd;}
$colore			=$a2['colore']; if($colore == '') {$colore=$nd;}
$misura			=stripslashes($a2['misura']); if($misura == '') {$misura=$nd;}
$formato		=stripslashes($a2['formato']); if($formato == '') {$formato=$nd;}
$dimensione		=stripslashes($a2['dimensione']); if($dimensione == '') {$dimensione=$nd;}
$note2			=stripslashes($a2['note2']); if($note2 == '') {$note2=$nd;}
$negativi		=$a2['negativi']; if($negativi == '') {$negativi=$nd;}
$apparecchio		=stripslashes($a2['apparecchio']); if($apparecchio == '') {$apparecchio=$nd;}
$note3			=stripslashes($a2['note3']); if($note3 == '') {$note3=$nd;}

?>
<div class="inner">
 <div class="toggle check bassa">
  <div class="sezioni" style="border-top:none !important; border-bottom:1px solid #96867B">
   <h2>SEGNATURA/COLLOCAZIONE</h2>
  </div>
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
    <?php if($_SESSION['username']!='guest') {?>
    <tr>
     <td colspan="2">
      <label class="update" id="foto2_segn">modifica sezione</label>
     </td>
    </tr>
    <?php } ?>
   </table>
   <div class="updateContent" style="display:none">
    <?php require("inc/form_update/foto2_segn.php"); ?>
   </div>
  </div>
 </div>
 <div class="check bassa">
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
      <?php if($hub==1){ ?>
      <label>NOTE AUTORE</label>
      <div class="valori"><?php echo($note_autore); ?> </div>
      <br/>
      <?php } ?>
      <label>NOTE</label>
      <div class="valori"><?php echo($note); ?> </div>
     </td>
    </tr>
    <?php if($_SESSION['username']!='guest') {?>
    <tr>
     <td colspan="2">
      <label class="update" id="foto2_descr">modifica sezione</label>
     </td>
    </tr>
    <?php } ?>
   </table>
   <div class="updateContent" style="display:none">
    <?php require("inc/form_update/foto2_descr.php"); ?>
   </div>
  </div>
        
  <div class="toggle check">
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
              <div class="valori"><?php echo($oss_storiche); ?> </div>
             </td>
           </tr>
           <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="foto2_notsto">modifica sezione</label>
           </td>
          </tr>
        <?php } ?>
          </table>
          <div class="updateContent" style="display:none">
        <?php require("inc/form_update/foto2_notsto.php"); ?>
        </div>
        </div>
   </div>
   
   <div class="toggle check bassa">
        <div class="sezioni"><h2>DATI TECNICI</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>
                <?php
                 $hub==2? $dt1= "ACQUISIZIONE":$dt1= "MATERIA E TECNICA";
                 echo $dt1;
                ?> 
               </label>
               <div class="valori"><?php echo($materia); ?></div>
             </td>
             <td></td>
            </tr>
            <tr>
             <td>
              <label>BN/COLORE</label>
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
             <?php if($hub==1){?>
              <label>TIPOLOGIA APPARECCHIO</label>
              <div class="valori"><?php echo($apparecchio); ?></div>
              <br/>
              <?php } ?>
              <label>PRESENZA NEGATIVI</label>
              <div class="valori"><?php echo($negativi); ?></div>
             </td>
             <td>
              <label>NOTE</label>
              <div class="valori"><?php echo($note2); ?></div>
             </td>
           </tr>
           <?php if($_SESSION['username']!='guest') {?>
            <tr>
             <td colspan="2">
              <label class="update" id="foto2_datitec">modifica sezione</label>
             </td>
            </tr>
           <?php } ?>
          </table>
          <div class="updateContent" style="display:none">
        <?php require("inc/form_update/foto2_datitec.php"); ?>
        </div>
      </div>
   </div>
   <div class="toggle check">
        <div class="sezioni"><h2>ALTRE NOTE</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="98%;">
               <br/>
               <div class="valori"><?php echo($note3); ?></div>
             </td>
           </tr>
           <?php if($_SESSION['username']!='guest') {?>
            <tr>
             <td colspan="2">
              <label class="update" id="foto2_altrenote">modifica sezione</label>
             </td>
            </tr>
           <?php } ?>
          </table>
          <div class="updateContent" style="display:none">
        <?php require("inc/form_update/foto2_altrenote.php"); ?>
        </div>
        </div>
   </div>
  </div>
