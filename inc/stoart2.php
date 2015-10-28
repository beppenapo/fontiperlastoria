<?php
$nd = 'Dato non presente';
$qbiblio = ("
SELECT
  beni_stoart2.dgn_numsch2,
  beni_stoart2.dtc_mattec,
  beni_stoart2.dsc_indic,
  beni_stoart2.dsc_soggicon,
  beni_stoart2.dsc_colloc,
  beni_stoart2.dsc_prov,
  beni_stoart2.dsc_noteprov,
  beni_stoart2.dsc_oss,
  beni_stoart2.def_aut,
  beni_stoart2.def_nomecomm,
  beni_stoart2.def_datacomm,
  beni_stoart2.def_circcomm,
  beni_stoart2.def_fonticomm,
  beni_stoart2.def_motaut,
  beni_stoart2.def_ambcult,
  beni_stoart2.def_motambcult,
  beni_stoart2.dtc_mis,
  beni_stoart2.dtc_notemis,
  beni_stoart2.isc_descont,
  beni_stoart2.isc_trascr,
  beni_stoart2.isc_note,
  beni_stoart2.doc_elrest,
  beni_stoart2.doc_docrest,
  beni_stoart2.doc_rifschcei,
  beni_stoart2.doc_note,
  beni_stoart2.id
FROM
  public.beni_stoart2, scheda
where beni_stoart2.dgn_numsch2 = scheda.dgn_numsch and scheda.id =$id;");
$rq = pg_query($connection, $qbiblio);
$aq = pg_fetch_array($rq, 0, PGSQL_ASSOC);
$rowqbiblio = pg_num_rows($rq);

$dtc_mattec    = stripslashes($aq['dtc_mattec']); if($dtc_mattec == '') {$dtc_mattec =$nd;}
$dsc_indic     = stripslashes($aq['dsc_indic']); if($dsc_indic == '') {$dsc_indic =$nd;}
$dsc_soggicon  = stripslashes($aq['dsc_soggicon']); if($dsc_soggicon == '') {$dsc_soggicon =$nd;}
$dsc_colloc    = stripslashes($aq['dsc_colloc']); if($dsc_colloc == '') {$dsc_colloc=$nd;}
$dsc_prov      = stripslashes($aq['dsc_prov']); if($dsc_prov == '') {$dsc_prov  =$nd;}
$dsc_noteprov  = stripslashes($aq['dsc_noteprov']); if($dsc_noteprov == '') {$dsc_noteprov =$nd;}
$dsc_oss       = stripslashes($aq['dsc_oss']); if($dsc_oss == '') {$dsc_oss =$nd;}
$def_aut       = stripslashes($aq['def_aut']); if($def_aut == '') {$def_aut =$nd;}
$def_nomecomm  = stripslashes($aq['def_nomecomm']); if($def_nomecomm   == '') {$def_nomecomm  =$nd;}
$def_datacomm  = stripslashes($aq['def_datacomm']); if($def_datacomm   == '') {$def_datacomm  =$nd;}
$def_circcomm  = stripslashes($aq['def_circcomm']); if($def_circcomm   == '') {$def_circcomm  =$nd;}
$def_fonticomm = stripslashes($aq['def_fonticomm']); if($def_fonticomm  == '') {$def_fonticomm =$nd;}
$def_motaut    = stripslashes($aq['def_motaut']); if($def_motaut     == '') {$def_motaut    =$nd;}
$def_ambcult   = stripslashes($aq['def_ambcult']); if($def_ambcult    == '') {$def_ambcult   =$nd;}
$def_motambcult= stripslashes($aq['def_motambcult']); if($def_motambcult == '') {$def_motambcult=$nd;}
$dtc_mis       = stripslashes($aq['dtc_mis']); if($dtc_mis == '') {$dtc_mis=$nd;}
$dtc_notemis   = stripslashes($aq['dtc_notemis']); if($dtc_notemis == '') {$dtc_notemis=$nd;}
$isc_descont   = stripslashes($aq['isc_descont']); if($isc_descont == '') {$isc_descont=$nd;}
$isc_trascr    = stripslashes($aq['isc_trascr']); if($isc_trascr == '') {$isc_trascr=$nd;}
$isc_note      = stripslashes($aq['isc_note']); if($isc_note == '') {$isc_note=$nd;}
$doc_elrest    = stripslashes($aq['doc_elrest']); if($doc_elrest     == '') {$doc_elrest    =$nd;}
$doc_docrest   = stripslashes($aq['doc_docrest']); if($doc_docrest    == '') {$doc_docrest   =$nd;}
$doc_rifschcei = stripslashes($aq['doc_rifschcei']); if($doc_rifschcei  == '') {$doc_rifschcei =$nd;}
$doc_note      = stripslashes($aq['doc_note']); if($doc_note    == '') {$doc_note   =$nd;}

$idStoart2=$aq['id'];




?>
   <div class="inner">
      <h2 class="h2aperto">DESCRIZIONE OGGETTO</h2>

      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <label>MATERIA E TECNICA</label>
         <div class="valori"><?php echo(nl2br($dtc_mattec)); ?></div>
        </td>
        <td>
        </td>
       </tr>
       <tr>
        <td>
         <label>INDICAZIONI SULL'OGGETTO</label>
         <div class="valori" style="min-height:120px;"><?php echo(nl2br($dsc_indic)); ?></div>
         <br/>
         <label>CLASSIFICAZIONE ICONCLASS</label>
         <div class="valori"><?php echo($dsc_soggicon); ?></div>
        </td>
        <td>
         <label>COLLOCAZIONE</label>
         <div class="valori"><?php echo($dsc_colloc); ?></div>
         <br/>
         <label>PROVENIENZA</label>
         <div class="valori"><?php echo($dsc_prov); ?></div>
         <br/>
         <label>NOTE SULLA PROVENIENZA</label>
         <div class="valori"><?php echo(nl2br($dsc_noteprov)); ?></div>
         <br/>
         <label>NOTE</label>
         <div class="valori"><?php echo(nl2br($dsc_oss)); ?></div>
        </td>
       </tr>
      </table>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="stoart2" rel="sez_indicazioni">modifica sezione</label>
           </td>
          </tr>
       <?php } ?>
      <div style="border-top:1px solid #96867B;"><h2 class="h2aperto">DEFINIZIONE CULTURALE</h2></div>

      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <label>AUTORE</label>
         <div class="valori"><?php echo($def_aut ); ?></div>
         <br/>
         <label>MOTIVAZIONE AUTORE</label>
         <div class="valori"><?php echo($def_motaut); ?></div>
         <br/>
         <label>AMBITO CULTURALE</label>
         <div class="valori"><?php echo($def_ambcult); ?></div>
         <br/>
         <label>MOTIVAZIONE AMBITO CULTURALE</label>
         <div class="valori"><?php echo($def_motambcult); ?></div>
        </td>
        <td>
         <label>NOME COMMITTENTE</label>
         <div class="valori"><?php echo($def_nomecomm); ?></div>
         <br/>
         <label>DATA COMMITTENZA</label>
         <div class="valori"><?php echo($def_datacomm); ?></div>
         <br/>
         <label>CIRCOSTANZE COMMITTENZA</label>
         <div class="valori"><?php echo($def_circcomm); ?></div>
         <br/>
         <label>FONTI COMMITTENZA</label>
         <div class="valori"><?php echo($def_fonticomm); ?></div>
        </td>
       </tr>
      </table>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="stoart2" rel="sez_definizione">modifica sezione</label>
           </td>
          </tr>
       <?php } ?>
      <div class="toggle">
        <div class="sezioni"><h2>DATI TECNICI</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>DIMENSIONI</label>
               <div class="valori"><?php echo($dtc_mis); ?></div>
             </td>
             <td>
              <label>NOTE</label>
              <div class="valori"><?php echo($dtc_notemis); ?></div>
             </td>
           </tr>
          </table>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="stoart2" rel="sez_dati">modifica sezione</label>
           </td>
          </tr>
       <?php } ?>
        </div>
      </div>
      <div class="toggle">
        <div class="sezioni"><h2>ISCRIZIONI</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>DESCRIZIONE</label>
               <div class="valori"><?php echo($isc_descont); ?></div>
             </td>
             <td>
              <label>TRASCRIZIONE</label>
              <div class="valori"><?php echo($isc_trascr); ?></div>
              <br/>
              <label>NOTE</label>
              <div class="valori"><?php echo($isc_note); ?></div>
             </td>
           </tr>
          </table>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="stoart2" rel="sez_iscrizioni">modifica sezione</label>
           </td>
          </tr>
       <?php } ?>
        </div>
      </div>
      <div class="toggle">
        <div class="sezioni"><h2>RESTAURI/INVENTARIO CEI-OA</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>ELENCO RESTAURI/MANUTENZIONI</label>
               <div class="valori"><?php echo($doc_elrest); ?></div>
               <br/>
               <label>INVENTARIO CEI/OA</label>
               <div class="valori"><?php echo($doc_rifschcei); ?></div>
             </td>
             <td>
              <label>DOCUMENTAZIONE RESTAURI/MANUTENZIONI</label>
              <div class="valori"><?php echo($doc_docrest); ?></div>
              <br/>
              <label>NOTE</label>
              <div class="valori"><?php echo($doc_note); ?></div>
             </td>
           </tr>
          </table>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="stoart2" rel="sez_restauri">modifica sezione</label>
           </td>
          </tr>
       <?php } ?>
        </div>
      </div>
   </div>



      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/stoart2.php"); ?>
      </div>
