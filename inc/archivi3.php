<?php
$nd = 'Dato non presente';
$q2 =  ("SELECT
  scheda.id,
  archivi3.id,
  archivi3.dsc_tpfonte as tipo,
  archivi3.dsc_supp as supporto,
  archivi3.dsc_dscfis as descrizione,
  archivi3.dsc_lingua3 as lingua,
  archivi3.dsc_conten as contenuto,
  archivi3.dsc_segnatura3 as segnatura,
  archivi3.dsc_note3 as note,
  archivi3.dsc_data,
  archivi3.dsc_luogo
FROM
  public.archivi3,
  public.scheda
WHERE
  archivi3.dgn_numsch3 = scheda.dgn_numsch AND
  scheda.id = $id;");
$r2 = pg_query($connection, $q2);
$a2 = pg_fetch_array($r2, 0, PGSQL_ASSOC);
$rC2 = pg_num_rows($r2);

$idArchiv3 = $a2['id'];
$tipo= stripslashes($a2['tipo']); if($tipo == '') {$tipo=$nd;}
$supporto=stripslashes($a2['supporto']); if($supporto == '') {$supporto=$nd;}
$descrizione=stripslashes($a2['descrizione']); if($descrizione == '') {$descrizione=$nd;}
$lingua= stripslashes($a2['lingua']); if($lingua == '') {$lingua=$nd;}
$contenuto= stripslashes($a2['contenuto']); if($contenuto == '') {$contenuto=$nd;}
$segnatura= stripslashes($a2['segnatura']); if($segnatura == '') {$segnatura=$nd;}
$note= stripslashes($a2['note']); if($note == '') {$note=$nd;}
$data= stripslashes($a2['dsc_data']); if($data == '') {$data=$nd;}
$luogo= stripslashes($a2['dsc_luogo']); if($luogo == '') {$luogo=$nd;}

?>
   <div class="inner">
         <div class="toggle">
        <div class="sezioni" style="border-top:none;"><h2>SEGNATURA/COLLOCAZIONE</h2></div>
        <div class="slide">
          <table class="mainData" >
           <tr>
            <td style="width:50%;"><div class="valori"><?php echo($segnatura); ?></div></td><td></td>
           </tr>
            <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="archiv3_segnatura">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
        </div>
       </div>
       <div class="updateContent" style="display:none">
        <?php require("inc/form_update/archiv3_segnatura.php"); ?>
      </div>
      <div style="border-top:1px solid #96867B">
       <h2 class="h2aperto">DESCRIZIONE DOCUMENTO</h2>
      </div>
      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <label>DATA REDAZIONE</label>
         <div class="valori"><?php echo($data); ?></div>
        </td>
        <td>
         <label>TIPOLOGIA DOCUMENTO</label>
         <div class="valori"><?php echo($tipo); ?> </div>
        </td>
       </tr>
       <tr>
        <td>
         <label>LUOGO REDAZIONE</label>
         <div class="valori"><?php echo($luogo); ?></div>
        </td>
        <td>
         <label>SUPPORTO</label>
         <div class="valori"><?php echo($supporto); ?> </div>
        </td>
       </tr>
       <tr>
        <td>
         <label>CONTENUTO</label>
         <div class="valori"><?php echo nl2br($contenuto); ?> </div>
        </td>
        <td>
         <label>DESCRIZIONE FISICA</label>
         <div class="valori"><?php echo nl2br($descrizione); ?> </div>
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
          <label class="update" id="archiv3_descrizione">modifica sezione</label>
        </td>
       </tr>
       <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/archiv3_descrizione.php"); ?>
      </div>
