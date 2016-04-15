<?php
$nd = 'Dato non presente';
$q2 =  ("
SELECT 
  scheda.id AS id_scheda,
  fonti_archtt2.id AS id_archtt2, 
  fonti_archtt2.dsc_tipol2, 
  fonti_archtt2.dsc_bene2, 
  fonti_archtt2.dsc_tcost2, 
  fonti_archtt2.dsc_pianta2, 
  fonti_archtt2.dsc_npiani2, 
  fonti_archtt2.dsc_fond2, 
  fonti_archtt2.dsc_mur2, 
  fonti_archtt2.dsc_vsol2, 
  fonti_archtt2.dsc_ambsott2, 
  fonti_archtt2.dsc_pavim2, 
  fonti_archtt2.dsc_scale2, 
  fonti_archtt2.dsc_coper2, 
  fonti_archtt2.dsc_note2,
  fonti_archtt2.dsc_matdata,  
  fonti_archtt2.dtc_mis, 
  fonti_archtt2.dtc_notemis, 
  fonti_archtt2.cat_storasb,
  fonti_archtt2.cat_stornap
FROM 
  public.fonti_archtt2, 
  public.fonti_archtt, 
  public.scheda
WHERE 
  fonti_archtt2.dgn_numsch2 = fonti_archtt.dgn_numsch AND
  fonti_archtt.id_scheda = scheda.id AND scheda.id= $id;
");
$r2 = pg_query($connection, $q2);
$a2 = pg_fetch_array($r2, 0, PGSQL_ASSOC);
$rC2 = pg_num_rows($r2);

$idArchtt2= $a2['id_archtt2'];
$idScheda= $a2['id_scheda'];
$archtt2_dsc_tipol2= stripslashes($a2['dsc_tipol2']);
$archtt2_dsc_bene2= stripslashes( $a2['dsc_bene2']); 
$archtt2_dsc_tcost2= stripslashes( $a2['dsc_tcost2']); 
$archtt2_dsc_pianta2= stripslashes( $a2['dsc_pianta2']); 
$archtt2_dsc_npiani2= stripslashes( $a2['dsc_npiani2']); 
$archtt2_dsc_fond2= stripslashes( $a2['dsc_fond2']); 
$archtt2_dsc_mur2= stripslashes( $a2['dsc_mur2']); 
$archtt2_dsc_vsol2= stripslashes( $a2['dsc_vsol2']); 
$archtt2_dsc_ambsott2= stripslashes( $a2['dsc_ambsott2']); 
$archtt2_dsc_pavim2= stripslashes( $a2['dsc_pavim2']); 
$archtt2_dsc_scale2= stripslashes( $a2['dsc_scale2']); 
$archtt2_dsc_coper2= stripslashes( $a2['dsc_coper2']); 
$archtt2_dsc_note2= stripslashes( $a2['dsc_note2']); 
$archtt2_dsc_matdata= stripslashes( $a2['dsc_matdata']);
$archtt2_dtc_mis= stripslashes( $a2['dtc_mis']); 
$archtt2_dtc_notemis= stripslashes( $a2['dtc_notemis']);
$archtt2_cat_storasb= stripslashes( $a2['cat_storasb']);
$archtt2_cat_stornap= stripslashes( $a2['cat_stornap']);
?>
   <div class="inner">
      <h2 class="h2aperto">DESCRIZIONE BENE ARCHITETTONICO</h2>
      
      <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>TIPOLOGIA BENE ARCHITETTONICO</label>
               <div class="valori"><?php echo(nl2br($archtt2_dsc_tipol2)); ?></div>
               <br/>
               <label>PIANTA</label>
               <div class="valori"><?php echo(nl2br($archtt2_dsc_pianta2)); ?></div>
               <br/>
               <label>FONDAZIONI</label>
               <div class="valori"><?php echo(nl2br($archtt2_dsc_fond2)); ?></div> 
               <br/>
               <label>VOLTE E SOLAI</label>
               <div class="valori"><?php echo(nl2br($archtt2_dsc_vsol2)); ?></div> 
               <br/>
               <label>PAVIMENTAZIONI</label>
               <div class="valori"><?php echo(nl2br($archtt2_dsc_pavim2)); ?></div> 
               <br/>
               <label>COPERTURA</label>
               <div class="valori"><?php echo(nl2br($archtt2_dsc_coper2)); ?></div> 
             </td>
             <td>
              <label>TECNICHE COSTRUTTIVE</label>
              <div class="valori"><?php echo(nl2br($archtt2_dsc_tcost2)); ?></div>
              <br/>
              <label>NUMERO PIANI</label>
              <div class="valori"><?php echo(nl2br($archtt2_dsc_npiani2)); ?></div> 
              <br/>
              <label>MURATURE</label>
              <div class="valori"><?php echo(nl2br($archtt2_dsc_mur2)); ?></div> 
              <br/>
              <label>AMBIENTI SOTTERRANEI</label>
              <div class="valori"><?php echo(nl2br($archtt2_dsc_ambsott2)); ?></div> 
              <br/>
              <label>SCALE</label>
              <div class="valori"><?php echo(nl2br($archtt2_dsc_scale2)); ?></div> 
             </td>
           </tr>
           <tr>
            <td colspan="2">
             <label>DESCRIZIONE</label>
             <div class="valori"><?php echo(nl2br($archtt2_dsc_bene2)); ?></div> 
             <br/>
             <label>SPECIFICI ELEMENTI DI INTERESSE / MATERIALI DATANTI</label>
             <div class="valori"><?php echo(nl2br($archtt2_dsc_matdata)); ?></div> 
             <br/>
             <label>NOTE</label>
             <div class="valori"><?php echo(nl2br($archtt2_dsc_note2)); ?></div> 
            </td>
           </tr>
          <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="archtt2_descriz_bene">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/archtt2_descriz_bene.php"); ?>
      </div>
          
      <div class="toggle">
        <div class="sezioni"><h2>DATI TECNICI</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>DIMENSIONI</label>
               <div class="valori"><?php echo($archtt2_dtc_mis); ?></div>
             </td>
             <td>
              <label>NOTE</label>
              <div class="valori"><?php echo($archtt2_dtc_notemis); ?></div>
             </td>
           </tr>
          <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="archtt2_dati_tecnici">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
          <div class="updateContent" style="display:none">
           <?php require("inc/form_update/archtt2_dati_tecnici.php"); ?>
          </div>
        </div>
      </div>
    
      <div class="toggle">
        <div class="sezioni"><h2>CATASTI STORICI</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>CATASTO 1814</label>
               <div class="valori"><?php echo($archtt2_cat_stornap); ?></div>
             </td>
            <td>
             <label>CATASTO 1859</label>
             <div class="valori"><?php echo($archtt2_cat_storasb); ?></div> 
            </td>
           </tr>
          <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="archtt2_catsto">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
          <div class="updateContent" style="display:none">
           <?php require("inc/form_update/archtt2_catsto.php"); ?>
          </div>
        </div>
      </div>
   </div>
