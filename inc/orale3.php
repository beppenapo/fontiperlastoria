<?php
$nd = 'Dato non presente';
$q2 =  ("SELECT
  fonti_orali3.id,
  fonti_orali3.dsc_conten3,
  fonti_orali3.dsc_catgen3,
  fonti_orali3.dan_elstrutt3,
  fonti_orali3.dan_incverb3,
  fonti_orali3.dan_trascr3,
  fonti_orali3.dan_motiv3
FROM
  public.scheda,
  public.fonti_orali3
WHERE
  fonti_orali3.dgn_numsch3 = scheda.dgn_numsch AND
  scheda.id = $id;");
$r2 = pg_query($connection, $q2);
$a2 = pg_fetch_array($r2, 0, PGSQL_ASSOC);
$rC2 = pg_num_rows($r2);

$idOral3 = $a2['id'];

$dsc_conten3   = stripslashes($a2['dsc_conten3']); if($dsc_conten3     == '') {$dsc_conten3=$nd;}
$dsc_catgen3   = stripslashes($a2['dsc_catgen3']); if($dsc_catgen3     == '') {$dsc_catgen3=$nd;}
$dan_elstrutt3 = stripslashes($a2['dan_elstrutt3']); if($dan_elstrutt3 == '') {$dan_elstrutt3=$nd;}
$dan_incverb3  = stripslashes($a2['dan_incverb3']); if($dan_incverb3   == '') {$dan_incverb3=$nd;}
$dan_trascr3   = stripslashes($a2['dan_trascr3']); if($dan_trascr3     == '') {$dan_trascr3=$nd;}
$dan_motiv3    = stripslashes($a2['dan_motiv3']); if($dan_motiv3       == '') {$dan_motiv3=$nd;}

?>
   <div class="inner">
    <h2 class="h2aperto">DESCRIZIONE BRANO</h2>

      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <label>SPECIFICI ELEMENTI DI INTERESSE</label>
         <div class="valori"><?php echo($dsc_conten3);?></div>
        </td>
        <td>
         <label>CATEGORIE CONTENUTO</label>
         <div class="valori"><?php echo($dsc_catgen3);?></div>
        </td>
       </tr>
      </table>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="oral3" rel="sez_descrizione">modifica sezione</label>
           </td>
          </tr>
       <?php } ?>
      <h2 class="h2aperto">DATI ANALITICI</h2>
      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <label>ELEMENTI STRUTTURALI</label>
         <div class="valori" style="height:250px; overflow:auto;"><?php echo(nl2br($dan_elstrutt3)); ?></div>
        </td>
        <td>
         <label>INCIPIT VERBALE</label>
         <div class="valori"><?php echo($dan_incverb3); ?></div>
         <br/>
         <label>TRASCRIZIONE</label>
         <div class="valori"><?php echo($dan_trascr3); ?></div>
         <br/>
         <label>NOTE</label>
         <div class="valori"><?php echo($dan_motiv3); ?></div>
        </td>
       </tr>
      </table>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="oral3" rel="sez_analitici">modifica sezione</label>
           </td>
          </tr>
       <?php } ?>
   </div>
      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/oral3.php"); ?>
      </div>
