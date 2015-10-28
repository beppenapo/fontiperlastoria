<?php
$nd = 'Dato non presente';
$q2 =  ("SELECT
  fonti_orali2.id,
  fonti_orali2.dsc_segnatura2,
  fonti_orali2.dsc_denom,
  fonti_orali2.dsc_conten,
  fonti_orali2.dsc_categ,
  fonti_orali2.dsc_occas,
  fonti_orali2.dsc_durata,
  fonti_orali2.dan_elstrutt2 as dan_elstrutt,
  fonti_orali2.dan_incverb2 as dan_incverb,
  fonti_orali2.dan_trascr2 as dan_trascr,
  fonti_orali2.dan_motiv2 as dan_motiv,
  fonti_orali2.com_nvoci,
  fonti_orali2.com_modesec,
  fonti_orali2.att_datipers,
  fonti_orali2.att_ruolo,
  fonti_orali2.att_mestiere,
  fonti_orali2.att_nascita,
  fonti_orali2.att_note,
  fonti_orali2.att_collden,
  fonti_orali2.att_collnote,
  fonti_orali2.loc_luogo,
  fonti_orali2.loc_contst,
  fonti_orali2.sup_tipreg,
  fonti_orali2.sup_formato,
  fonti_orali2.sup_freqvel,
  fonti_orali2.sup_attec,
  fonti_orali2.sup_oss,
  fonti_orali2.riv_tpriv,
  fonti_orali2.riv_formato,
  fonti_orali2.riv_descform
FROM
  public.scheda,
  public.fonti_orali2
WHERE
  fonti_orali2.dgn_numsch2 = scheda.dgn_numsch AND
  scheda.id = $id;");
$r2 = pg_query($connection, $q2);
$a2 = pg_fetch_array($r2, 0, PGSQL_ASSOC);
$rC2 = pg_num_rows($r2);

$idOral2 = $a2['id'];

$dsc_segnatura2 = stripslashes($a2['dsc_segnatura2']); if($dsc_segnatura2       == '') {$dsc_segnatura2=$nd;}
$dsc_denom      = stripslashes($a2['dsc_denom']); if($dsc_denom       == '') {$dsc_denom=$nd;}
$dsc_conten     = stripslashes($a2['dsc_conten']); if($dsc_conten      == '') {$dsc_conten=$nd;}
$dsc_categ      = stripslashes($a2['dsc_categ']); if($dsc_categ       == '') {$dsc_categ=$nd;}
$dsc_occas      = stripslashes($a2['dsc_occas']); if($dsc_occas       == '') {$dsc_occas=$nd;}
$dsc_durata     = stripslashes($a2['dsc_durata']); if($dsc_durata      == '') {$dsc_durata=$nd;}
$dan_elstrutt   = stripslashes($a2['dan_elstrutt']); if($dan_elstrutt    == '') {$dan_elstrutt=$nd;}
$dan_incverb    = stripslashes($a2['dan_incverb']); if($dan_incverb     == '') {$dan_incverb=$nd;}
$dan_trascr     = stripslashes($a2['dan_trascr']); if($dan_trascr      == '') {$dan_trascr=$nd;}
$dan_motiv      = stripslashes($a2['dan_motiv']); if($dan_motiv       == '') {$dan_motiv=$nd;}
$com_nvoci      = stripslashes($a2['com_nvoci']); if($com_nvoci       == '') {$com_nvoci=$nd;}
$com_modesec    = stripslashes($a2['com_modesec']); if($com_modesec     == '') {$com_modesec=$nd;}
$att_datipers   = stripslashes($a2['att_datipers']); if($att_datipers    == '') {$att_datipers=$nd;}
$att_ruolo      = stripslashes($a2['att_ruolo']); if($att_ruolo       == '') {$att_ruolo=$nd;}
$att_mestiere   = stripslashes($a2['att_mestiere']); if($att_mestiere    == '') {$att_mestiere=$nd;}
$att_nascita    = stripslashes($a2['att_nascita']); if($att_nascita     == '') {$att_nascita=$nd;}
$att_note       = stripslashes($a2['att_note']); if($att_note        == '') {$att_note=$nd;}
$att_collden    = stripslashes($a2['att_collden']); if($att_collden     == '') {$att_collden=$nd;}
$att_collnote   = stripslashes($a2['att_collnote']); if($att_collnote    == '') {$att_collnote=$nd;}
$loc_luogo      = stripslashes($a2['loc_luogo']); if($loc_luogo       == '') {$loc_luogo=$nd;}
$loc_contst     = stripslashes($a2['loc_contst']); if($loc_contst      == '') {$loc_contst=$nd;}
$sup_tipreg     = stripslashes($a2['sup_tipreg']); if($sup_tipreg      == '') {$sup_tipreg=$nd;}
$sup_formato    = stripslashes($a2['sup_formato']); if($sup_formato     == '') {$sup_formato=$nd;}
$sup_freqvel    = stripslashes($a2['sup_freqvel']); if($sup_freqvel     == '') {$sup_freqvel=$nd;}
$sup_attec      = stripslashes($a2['sup_attec']); if($sup_attec       == '') {$sup_attec=$nd;}
$sup_oss        = stripslashes($a2['sup_oss']); if($sup_oss         == '') {$sup_oss=$nd;}
$riv_tpriv      = stripslashes($a2['riv_tpriv']); if($riv_tpriv       == '') {$riv_tpriv=$nd;}
$riv_formato    = stripslashes($a2['riv_formato']); if($riv_formato     == '') {$riv_formato=$nd;}
$riv_descform   = stripslashes($a2['riv_descform']); if($riv_descform    == '') {$riv_descform=$nd;}

?>


   <div class="inner">

   <div class="toggle">
    <div class="sezioni" style="border-top:none !important; border-bottom:1px solid #96867B">
     <h2>SEGNATURA/COLLOCAZIONE</h2>
    </div>
    <div class="slide" style="border-bottom:1px solid #96867B">
     <table class="mainData" style="width:98% !important;">
      <tr>
       <td width="50%;">
        <br/>
        <div class="valori"><?php echo($dsc_segnatura2);?></div>
       </td>
       <td>
       </td>
      </tr>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="oral2" rel="sez_segnatura">modifica sezione</label>
           </td>
          </tr>
       <?php } ?>
      </table>


    </div>
   </div>
   <h2 class="h2aperto">DESCRIZIONE INTERVISTA</h2>

      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <label>TIPOLOGIA INTERVISTA</label>
         <div class="valori"><?php echo($dsc_denom); ?></div>
         <br/>
         <label>SPECIFICI ELEMENTI DI INTERESSE</label>
         <div class="valori"><?php echo(nl2br($dsc_conten)); ?></div>
        </td>
        <td>
         <label>CATEGORIE CONTENUTO</label>
         <div class="valori"><?php echo($dsc_categ); ?></div>
         <br/>
         <label>OCCASIONE O MOMENTO DI RACCOLTA</label>
         <div class="valori"><?php echo($dsc_occas); ?></div>
         <br/>
         <label>DURATA</label>
         <div class="valori"><?php echo($dsc_durata); ?></div>
        </td>
       </tr>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="oral2" rel="sez_descrizione">modifica sezione</label>
           </td>
          </tr>
       <?php } ?>
      </table>

      <div class="toggle">
        <div class="sezioni"><h2>DATI ANALITICI</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>ELEMENTI STRUTTURALI</label>
               <div class="valori" style="height:250px; overflow:auto;"><?php echo(nl2br($dan_elstrutt)); ?></div>
             </td>
             <td>
              <label>INCIPIT VERBALE</label>
              <div class="valori"><?php echo($dan_incverb); ?></div>
              <br/>
              <label>TRASCRIZIONE</label>
              <div class="valori"><?php echo($dan_trascr); ?></div>
              <br/>
              <label>NOTE</label>
              <div class="valori"><?php echo($dan_motiv); ?></div>
              <br/>
             </td>
           </tr>
          </table>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="oral2" rel="sez_analitici">modifica sezione</label>
           </td>
          </tr>
       <?php } ?>
        </div>
      </div>
      <div class="toggle">
        <div class="sezioni"><h2>COMUNICAZIONE</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>NUMERO VOCI</label>
               <div class="valori"><?php echo($com_nvoci); ?></div>
             </td>
             <td>
              <label>MODALITA' ESECUTIVE</label>
              <div class="valori"><?php echo($com_modesec); ?></div>
             </td>
           </tr>
          </table>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="oral2" rel="sez_comunicazione">modifica sezione</label>
           </td>
          </tr>
       <?php } ?>
        </div>
      </div>
      <div class="toggle">
        <div class="sezioni"><h2>INTERVISTATO</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>DATI PERSONALI</label>
               <div class="valori"><?php echo($att_datipers); ?></div>
               <br/>
               <label>RUOLO</label>
               <div class="valori"><?php echo($att_ruolo); ?></div>
               <br/>
               <label>MESTIERE O PROFESSIONE</label>
               <div class="valori"><?php echo($att_mestiere); ?></div>
             </td>
             <td>
              <label>NASCITA</label>
              <div class="valori"><?php echo($att_nascita); ?></div>
              <br/>
              <label>NOTE</label>
              <div class="valori"><?php echo($att_note); ?></div>
             </td>
           </tr>
          </table>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="oral2" rel="sez_intervistato">modifica sezione</label>
           </td>
          </tr>
       <?php } ?>
        </div>
      </div>
      <div class="toggle">
        <div class="sezioni"><h2>GRUPPO INTERVISTATI</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>TIPOLOGIA ATTORI</label>
               <div class="valori"><?php echo($att_collden); ?></div>
             </td>
             <td>
              <label>NOTE</label>
              <div class="valori"><?php echo($att_collnote); ?></div>
             </td>
           </tr>
          </table>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="oral2" rel="sez_gruppo">modifica sezione</label>
           </td>
          </tr>
       <?php } ?>
        </div>
      </div>
      <div class="toggle">
        <div class="sezioni"><h2>CONTESTO</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>LUOGO SVOLGIMENTO</label>
               <div class="valori"><?php echo($loc_luogo); ?></div>
             </td>
             <td>
              <label>DESCRIZIONE CONTESTO</label>
              <div class="valori"><?php echo($loc_contst); ?></div>
             </td>
           </tr>
          </table>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="oral2" rel="sez_contesto">modifica sezione</label>
           </td>
          </tr>
       <?php } ?>
        </div>
      </div>
      <div class="toggle">
        <div class="sezioni"><h2>SUPPORTO</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>TIPO REGISTRAZIONE</label>
               <div class="valori"><?php echo($sup_tipreg); ?></div>
               <br/>
               <label>FORMATO</label>
               <div class="valori"><?php echo($sup_formato); ?></div>
               <br/>
               <label>FREQUENZA VELOCITA'</label>
               <div class="valori"><?php echo($sup_freqvel); ?></div>
             </td>
             <td>
              <label>ATTREZZATURE TECNICHE</label>
              <div class="valori"><?php echo($sup_attec); ?></div>
              <br/>
              <label>OSSERVAZIONI</label>
              <div class="valori"><?php echo($sup_oss); ?></div>
             </td>
           </tr>
          </table>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="oral2" rel="sez_supporto">modifica sezione</label>
           </td>
          </tr>
       <?php } ?>
        </div>
      </div>
      <div class="toggle">
        <div class="sezioni"><h2>RIVERSAMENTO</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>TIPO RIVERSAMENTO</label>
               <div class="valori"><?php echo($riv_tpriv); ?></div>
               <br/>
               <label>FORMATO</label>
               <div class="valori"><?php echo($riv_formato); ?></div>
             </td>
             <td>
              <label>DESCRIZIONE FORMATO</label>
              <div class="valori"><?php echo($riv_descform); ?></div>
             </td>
           </tr>
          </table>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="oral2" rel="sez_riversamento">modifica sezione</label>
           </td>
          </tr>
       <?php } ?>
        </div>
      </div>
   </div>


      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/oral2.php"); ?>
      </div>
