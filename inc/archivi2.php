<?php
$nd = 'Dato non presente';
$q2 =  ("SELECT
  archivi2.id,
  archivi2.dgn_numsch2 as numsch,
  archivi2.dsc_fondo as fondo,
  archivi2.dsc_segnatura2 as segnatura,
  archivi2.nst_fondo,
  archivi2.nst_ossfondo,
  archivi2.dsc_consist2 as consist,
  archivi2.dsc_tipol2 as tipo,
  archivi2.dsc_lingua2 as lingua,
  archivi2.dsc_note2 as note
FROM
  public.scheda,
  public.archivi2
WHERE
  archivi2.dgn_numsch2 = scheda.dgn_numsch AND
  scheda.id = $id;");
$r2 = pg_query($connection, $q2);
$a2 = pg_fetch_array($r2, 0, PGSQL_ASSOC);
$rC2 = pg_num_rows($r2);

$idArchiv2=$a2['id'];
$numsch= stripslashes($a2['numsch']); if($numsch == '') {$numsch=$nd;}
$segnatura= stripslashes($a2['segnatura']); if($segnatura == '') {$segnatura=$nd;}
$fondo=stripslashes($a2['fondo']); if($fondo == '') {$fondo=$nd;}
$nstfondo=stripslashes($a2['nst_fondo']); if($nstfondo == '') {$nstfondo=$nd;}
$ossfondo=stripslashes($a2['nst_ossfondo']); if($ossfondo == '') {$ossfondo=$nd;}
$consist=stripslashes($a2['consist']); if($consist == '') {$consist=$nd;}
$tipo= stripslashes($a2['tipo']); if($tipo == '') {$tipo=$nd;}
$lingua= stripslashes($a2['lingua']); if($lingua == '') {$lingua=$nd;}
$note= stripslashes($a2['note']); if($note == '') {$note=$nd;}

?>
   <div class="inner">
         <div class="toggle">
        <div class="sezioni"><h2>SEGNATURA/COLLOCAZIONE</h2></div>
        <div class="slide">
          <table class="mainData" >
           <tr>
            <td style="width:50%;"><div class="valori"><?php echo($segnatura); ?></div></td><td></td>
           </tr>
           <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="archiv2_segnatura">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
        </div>
       </div>
       <div class="updateContent" style="display:none">
        <?php require("inc/form_update/archiv2_segnatura.php"); ?>
      </div>
      <div style="border-top:1px solid #96867B">
       <h2 class="h2aperto">DESCRIZIONE FONDO</h2>
      </div>
      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <label>DESCRIZIONE</label>
         <div class="valori" style="min-height:190px;"><?php echo nl2br($fondo); ?></div>
        </td>
        <td>
         <label>CONSISTENZA</label>
         <div class="valori"><?php echo nl2br($consist); ?> </div>
         <br/>
         <label>TIPOLOGIA DOCUMENTI</label>
         <div class="valori"><?php echo($tipo); ?> </div>
         <br/>
         <label>LINGUA</label>
         <div class="valori"><?php echo($lingua); ?> </div>
         <br/>
         <label>NOTE</label>
         <div class="valori"><?php echo nl2br($note); ?> </div>
        </td>
       </tr>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="archiv2_fondo">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/archiv2_fondo.php"); ?>
      </div>
      <div class="toggle">
        <div class="sezioni"><h2>NOTIZIE STORICHE</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <br/>
               <div class="valori" style="min-height:190px;"><?php echo nl2br($nstfondo); ?></div>
             </td>
             <td>
              <label>NOTE</label>
              <div class="valori" style="min-height:190px;"><?php echo nl2br($ossfondo); ?></div>
             </td>
           </tr>
          <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="archiv2_notsto">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
        </div>
        <div class="updateContent" style="display:none">
        <?php require("inc/form_update/archiv2_notsto.php"); ?>
       </div>
   </div>
  </div>
