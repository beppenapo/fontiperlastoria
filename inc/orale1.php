<?php
$nd = 'Dato non presente';
$q2 =  ("SELECT  fonti_orali1.id
               , fonti_orali1.dsc_tipoarch
               , fonti_orali1.dsc_numint
               , fonti_orali1.dsc_numinf
               , fonti_orali1.dsc_cararch
               , fonti_orali1.dsc_sched
               , fonti_orali1.dsc_trascr
               , fonti_orali1.dsc_indic
               , fonti_orali1.dsc_matint
               , fonti_orali1.dsc_oss
               , fonti_orali1.dsc_critord
               , fonti_orali1.nsc_vicarch
               , fonti_orali1.nsc_oss
FROM
  public.scheda,
  public.fonti_orali1
WHERE
  fonti_orali1.dgn_numsch1 = scheda.dgn_numsch AND
  scheda.id = $id;");


$r2 = pg_query($connection, $q2);
$a2 = pg_fetch_array($r2, 0, PGSQL_ASSOC);
$rC2 = pg_num_rows($r2);

$idOral1 = $a2['id'];

$dsc_tipoarch  = $a2['dsc_tipoarch'] ? $a2['dsc_tipoarch'] : $nd;
$dsc_numint    = $a2['dsc_numint']   ? $a2['dsc_numint']   : $nd;
$dsc_numinf    = $a2['dsc_numinf']   ? $a2['dsc_numinf']   : $nd;
$dsc_cararch   = $a2['dsc_cararch']  ? $a2['dsc_cararch']  : $nd;
$dsc_sched     = $a2['dsc_sched']    ? $a2['dsc_sched']    : $nd;
$dsc_trascr    = $a2['dsc_trascr']   ? $a2['dsc_trascr']   : $nd;
$dsc_indic     = $a2['dsc_indic']    ? $a2['dsc_indic']    : $nd;
$dsc_matint    = $a2['dsc_matint']   ? $a2['dsc_matint']   : $nd;
$dsc_oss       = $a2['dsc_oss']      ? $a2['dsc_oss']      : $nd;
$dsc_critord   = $a2['dsc_critord']  ? $a2['dsc_critord']  : $nd;
$nsc_vicarch   = $a2['nsc_vicarch']  ? $a2['nsc_vicarch']  : $nd;
$nsc_oss       = $a2['nsc_oss']      ? $a2['nsc_oss']      : $nd;


?>
   <div class="inner">
      <h2 class="h2aperto">DESCRIZIONE ARCHIVIO</h2>

      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <label>TIPOLOGIA ARCHIVIO</label>
         <div class="valori"><?php echo(stripslashes($dsc_tipoarch));?></div>
         <br/>
         <label>CONSISTENZA</label>
         <div class="valori"><?php echo(stripslashes($dsc_numint)); ?></div>
         <br/>
         <label>NUMERO INFORMATORI</label>
         <div class="valori"><?php echo(stripslashes($dsc_numinf)); ?></div>
         <br/>
         <label>CARATTERISTICHE ARCHIVIO</label>
         <div class="valori"><?php echo(stripslashes($dsc_cararch));?></div>
         <br/>
         <label>SCHEDATURA</label>
         <div class="valori"><?php echo(stripslashes($dsc_sched)); ?></div>
         <br/>
         <label>TRASCRIZIONE</label>
         <div class="valori"><?php echo(stripslashes($dsc_trascr)); ?></div>
         <br/>
         <label>INDICIZZAZIONE</label>
         <div class="valori"><?php echo(stripslashes($dsc_indic)); ?></div>
        </td>
        <td>
         <label>SPECIFICI ELEMENTI DI INTERESSE</label>
         <div class="valori"><?php echo(stripslashes(nl2br($dsc_matint))); ?></div>
         <br/>
         <label>NOTE</label>
         <div class="valori"><?php echo(stripslashes(nl2br($dsc_oss))); ?></div>
        </td>
       </tr>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="oral1_descr">modifica sezione</label>
           </td>
          </tr>
       <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/oral1_descr.php"); ?>
      </div>

      <div class="toggle">
        <div class="sezioni"><h2>CRITERI DI ORDINAMENTO</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <div class="valori"><?php echo(stripslashes($dsc_critord));?></div>
             </td>
             <td>
             </td>
           </tr>
           <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="oral1_criteri">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/oral1_criteri.php"); ?>
      </div>
        </div>
      </div>
      <div class="toggle">
        <div class="sezioni"><h2>NOTIZIE STORICHE</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <br/>
               <div class="valori"><?php echo(stripslashes($nsc_vicarch));?></div>
             </td>
             <td>
              <label>NOTE</label>
              <div class="valori"><?php echo(stripslashes($nsc_oss));?></div>
             </td>
           </tr>
          <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="oral1_notsto">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/oral1_notsto.php"); ?>
      </div>
        </div>
      </div>
   </div>
