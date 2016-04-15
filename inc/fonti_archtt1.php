<?php
$nd = 'Dato non presente';
$q2 =  ("
SELECT 
  scheda.id AS id_scheda,
  fonti_archtt1.id AS id_archtt1, 
  fonti_archtt1.dsc_tipol1, 
  fonti_archtt1.dsc_bene1, 
  fonti_archtt1.dsc_tcost1, 
  fonti_archtt1.dsc_pianta1, 
  fonti_archtt1.dsc_npiani1, 
  fonti_archtt1.dsc_fond1, 
  fonti_archtt1.dsc_mur1, 
  fonti_archtt1.dsc_vsol1, 
  fonti_archtt1.dsc_ambsott1, 
  fonti_archtt1.dsc_pavim1, 
  fonti_archtt1.dsc_scale1, 
  fonti_archtt1.dsc_coper1, 
  fonti_archtt1.dsc_note1, 
  fonti_archtt1.dtc_mis, 
  fonti_archtt1.dtc_notemis, 
  fonti_archtt1.rst_tpint,
  fonti_archtt1.rst_rifar,  
  fonti_archtt1.rst_note, 
  fonti_archtt1.cat_storasb,
  fonti_archtt1.cat_stornap
FROM 
  public.fonti_archtt1, 
  public.fonti_archtt, 
  public.scheda
WHERE 
  fonti_archtt1.dgn_numsch1 = fonti_archtt.dgn_numsch AND
  fonti_archtt.id_scheda = scheda.id AND scheda.id= $id;
");
$r2 = pg_query($connection, $q2);
$a2 = pg_fetch_array($r2, 0, PGSQL_ASSOC);
$rC2 = pg_num_rows($r2);

$idArchtt1= $a2['id_archtt1'];
$idScheda= $a2['id_scheda'];
$archtt1_dsc_tipol1= stripslashes($a2['dsc_tipol1']);
$archtt1_dsc_bene1= stripslashes( $a2['dsc_bene1']); 
$archtt1_dsc_tcost1= stripslashes( $a2['dsc_tcost1']); 
$archtt1_dsc_pianta1= stripslashes( $a2['dsc_pianta1']); 
$archtt1_dsc_npiani1= stripslashes( $a2['dsc_npiani1']); 
$archtt1_dsc_fond1= stripslashes( $a2['dsc_fond1']); 
$archtt1_dsc_mur1= stripslashes( $a2['dsc_mur1']); 
$archtt1_dsc_vsol1= stripslashes( $a2['dsc_vsol1']); 
$archtt1_dsc_ambsott1= stripslashes( $a2['dsc_ambsott1']); 
$archtt1_dsc_pavim1= stripslashes( $a2['dsc_pavim1']); 
$archtt1_dsc_scale1= stripslashes( $a2['dsc_scale1']); 
$archtt1_dsc_coper1= stripslashes( $a2['dsc_coper1']); 
$archtt1_dsc_note1= stripslashes( $a2['dsc_note1']); 
$archtt1_dtc_mis= stripslashes( $a2['dtc_mis']); 
$archtt1_dtc_notemis= stripslashes( $a2['dtc_notemis']); 
$archtt1_rst_tpint= stripslashes( $a2['rst_tpint']); 
$archtt1_rst_rifar= stripslashes( $a2['rst_rifar']);
$archtt1_rst_note= stripslashes( $a2['rst_note']); 
$archtt1_cat_storasb= stripslashes( $a2['cat_storasb']);
$archtt1_cat_stornap= stripslashes( $a2['cat_stornap']);
?>
   <div class="inner">
      <h2 class="h2aperto">DESCRIZIONE BENE ARCHITETTONICO</h2>
      
      <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>TIPOLOGIA BENE ARCHITETTONICO</label>
               <div class="valori"><?php echo(nl2br($archtt1_dsc_tipol1)); ?></div>
               <br/>
               <label>PIANTA</label>
               <div class="valori"><?php echo(nl2br($archtt1_dsc_pianta1)); ?></div>
               <br/>
               <label>FONDAZIONI</label>
               <div class="valori"><?php echo(nl2br($archtt1_dsc_fond1)); ?></div> 
               <br/>
               <label>VOLTE E SOLAI</label>
               <div class="valori"><?php echo(nl2br($archtt1_dsc_vsol1)); ?></div> 
               <br/>
               <label>PAVIMENTAZIONI</label>
               <div class="valori"><?php echo(nl2br($archtt1_dsc_pavim1)); ?></div> 
               <br/>
               <label>COPERTURA</label>
               <div class="valori"><?php echo(nl2br($archtt1_dsc_coper1)); ?></div> 
             </td>
             <td>
              <label>TECNICHE COSTRUTTIVE</label>
              <div class="valori"><?php echo(nl2br($archtt1_dsc_tcost1)); ?></div>
              <br/>
              <label>NUMERO PIANI</label>
              <div class="valori"><?php echo(nl2br($archtt1_dsc_npiani1)); ?></div> 
              <br/>
              <label>MURATURE</label>
              <div class="valori"><?php echo(nl2br($archtt1_dsc_mur1)); ?></div> 
              <br/>
              <label>AMBIENTI SOTTERRANEI</label>
              <div class="valori"><?php echo(nl2br($archtt1_dsc_ambsott1)); ?></div> 
              <br/>
              <label>SCALE</label>
              <div class="valori"><?php echo(nl2br($archtt1_dsc_scale1)); ?></div> 
             </td>
           </tr>
           <tr>
            <td colspan="2">
             <label>DESCRIZIONE</label>
             <div class="valori"><?php echo(nl2br($archtt1_dsc_bene1)); ?></div> 
             <br/>
             <label>NOTE</label>
             <div class="valori"><?php echo(nl2br($archtt1_dsc_note1)); ?></div> 
            </td>
           </tr>
          <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="archtt1_descriz_bene">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/archtt1_descriz_bene.php"); ?>
      </div>
          
      <div class="toggle">
        <div class="sezioni"><h2>DATI TECNICI</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>DIMENSIONI</label>
               <div class="valori"><?php echo($archtt1_dtc_mis); ?></div>
             </td>
             <td>
              <label>NOTE</label>
              <div class="valori"><?php echo($archtt1_dtc_notemis); ?></div>
             </td>
           </tr>
          <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="archtt1_dati_tecnici">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
          <div class="updateContent" style="display:none">
           <?php require("inc/form_update/archtt1_dati_tecnici.php"); ?>
          </div>
        </div>
      </div>
      <div class="toggle">
        <div class="sezioni"><h2>RESTAURI</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>ELENCO RESTAURI</label>
               <div class="valori"><?php echo($archtt1_rst_tpint); ?></div>
             </td>
             <td>
              <label>DOCUMENTAZIONE RESTAURI</label>
              <div class="valori"><?php echo($archtt1_rst_rifar); ?></div>
              <br/>
              <label>NOTE</label>
              <div class="valori"><?php echo($archtt1_rst_note); ?></div>
             </td>
           </tr>
          <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="archtt1_restauri">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
          <div class="updateContent" style="display:none">
           <?php require("inc/form_update/archtt1_restauri.php"); ?>
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
               <div class="valori"><?php echo($archtt1_cat_stornap); ?></div>
             </td>
            <td>
             <label>CATASTO 1859</label>
             <div class="valori"><?php echo($archtt1_cat_storasb); ?></div> 
            </td>
           </tr>
          <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="archtt1_catsto">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
          <div class="updateContent" style="display:none">
           <?php require("inc/form_update/archtt1_catsto.php"); ?>
          </div>
        </div>
      </div>
   </div>
