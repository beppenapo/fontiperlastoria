<?php
$nd = 'Dato non presente';
$q2 =  ("SELECT
  archivi.id_archivi,
  archivi.id_scheda,
  archivi1.id,
  lista_archivi_alt_tipo.definizione AS tipo_archivio,
  lista_archivi_alt_tipo.id AS id_tipo_archivio,
  archivi.dsc_fondiint AS fondi_segnalati,
  archivi.dsc_fondi AS elenco_fondi,
  archivi.dsc_note AS note,
  archivi.dsc_consist AS consistenza,
  archivi1.dsc_tipol AS tipo_doc,
  archivi1.dsc_crord,
  archivi1.nst_vicarch,
  archivi1.nst_oss
FROM
  public.archivi,
  public.archivi1,
  public.lista_archivi_alt_tipo
WHERE
  archivi.alt_tipologia = lista_archivi_alt_tipo.id AND
  archivi1.dgn_numsch1 = archivi.dgn_numsch AND
  archivi.id_scheda = $id;");
$r2 = pg_query($connection, $q2);
$a2 = pg_fetch_array($r2, 0, PGSQL_ASSOC);
$rC2 = pg_num_rows($r2);

$id_archivi= $a2['id_archivi'];
$id_archivi1= $a2['id'];
$id_scheda= $a2['id_scheda'];

$tipoArch= $a2['tipo_archivio'];
$id_tipoArch= stripslashes($a2['id_tipo_archivio']);
$consistenza=stripslashes($a2['consistenza']); if($consistenza == '') {$consistenza=$nd;}
$tipoDoc=stripslashes($a2['tipo_doc']); if($tipoDoc == '') {$tipoDoc=$nd;}
$fondiSegn= stripslashes($a2['fondi_segnalati']); if($fondiSegn == '') {$fondiSegn=$nd;}
$fondi= stripslashes($a2['elenco_fondi']); if($fondi == '') {$fondi=$nd;}
$note= stripslashes($a2['note']); if($note == '') {$note=$nd;}
$crord= stripslashes($a2['dsc_crord']); if($crord == '') {$crord=$nd;}
$vicarch= stripslashes($a2['nst_vicarch']); if($vicarch == '') {$vicarch=$nd;}
$oss= stripslashes($a2['nst_oss']); if($oss == '') {$oss=$nd;}

$crord2=nl2br($crord);
$vicarch2 = nl2br($vicarch);
$oss2 = nl2br($oss);
/*$tpsch = $a2['dgn_tpsch'];*/
?>
   <div class="inner">
      <h2 class="h2aperto">DESCRIZIONE ARCHIVIO</h2>

      <table class="mainData" style="width:98% !important;">
        <td width="50%;">
         <label>TIPOLOGIA ARCHIVIO</label>
         <div class="valori"><?php echo($tipoArch); ?></div>
         <br/>
         <label>CONSISTENZA</label>
         <div class="valori"><?php echo(nl2br($consistenza)); ?></div>
         <br/>
         <label>TIPOLOGIA DOCUMENTI</label>
         <div class="valori"><?php echo($tipoDoc); ?></div>
         <br/>
         <label>SEGNALAZIONE FONDI</label>
         <div class="valori"><?php echo($fondiSegn); ?></div>
        </td>
        <td>
         <label>ELENCO FONDI</label>
         <div class="valori" style="min-height:180px !important;max-height:250px !important;overflow:auto;"><?php echo(nl2br($fondi)); ?></div>
         <br/>
        </td>
       </tr>
       <tr>
        <td colspan="2">
         <label>NOTE</label>
         <div class="valori"><?php echo nl2br($note); ?></div>
        </td>
       </tr>
        <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="archiv1_descr">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/archiv1_descr.php"); ?>
      </div>


      <div style="border-top:1px solid #96867B">
       <h2 class="h2aperto">ARCHIVI COLLEGATI</h2>
      </div>
      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <label>ARCHIVI AGGREGATI</label>
         <div class="valori">
          <?php
           $qaggregato=("SELECT archivi_collegati.scheda AS id_scheda, a.dgn_numsch AS scheda, archivi_collegati.aggregato AS id_aggregato, b.dgn_numsch as aggregato FROM archivi_collegati, scheda a, scheda b WHERE archivi_collegati.scheda = a.id AND archivi_collegati.aggregato = b.id and archivi_collegati.scheda = $id;");
          $raggregato = pg_query($connection, $qaggregato);
          $rowaggregato = pg_num_rows($raggregato);
          if($rowaggregato != 0) {
          for ($x = 0; $x < $rowaggregato; $x++){
          	$id_aggregato = pg_result($raggregato, $x,"id_aggregato");
            $aggregato = pg_result($raggregato, $x,"aggregato");
          echo "<a href=\"scheda_archeo.php?id=$id_aggregato\" target=\"_blank\" class=\"altrif $stile\">$aggregato</a>  ";
          }
         }else {echo "<label>La fonte non ha nessun archivio aggregato</label>";}
         ?>
         </div>
        </td>
        <td>
         <label>AGGREGATO A</label>
         <div class="valori">
          <?php
           $qaggregante=("
            SELECT
              archivi_collegati.scheda AS id_scheda,
              archivi_collegati.aggregante AS id_aggregante,
              a.dgn_numsch AS scheda,
              b.dgn_numsch AS aggregante
            FROM
              archivi_collegati,
              scheda a,
              scheda b
            WHERE
              archivi_collegati.scheda = a.id AND
              archivi_collegati.aggregante = b.id and
              archivi_collegati.scheda = $id;
          ");
          $raggregante = pg_query($connection, $qaggregante);
          $rowaggregante = pg_num_rows($raggregante);
          if($rowaggregante != 0) {
          for ($x = 0; $x < $rowaggregante; $x++){
          	$id_aggregante = pg_result($raggregante, $x,"id_aggregante");
            $aggregante = pg_result($raggregante, $x,"aggregante");

            echo "<a href=\"scheda_archeo.php?id=$id_aggregante\" target=\"_blank\" class=\"altrif $stile\">$aggregante</a>  ";
          }
         }else {echo "<label>La fonte non è aggregata a nessun archivio</label>";}
         ?>
         </div>
        </td>
       </tr>
       <tr>
        <td>
          <?php if($_SESSION['username']!='guest') {?>
            <label class="update" id="archiv1_aggregati">aggrega archivio</label>
            &nbsp;|&nbsp;
            <?php if($rowaggregato != 0) {?>
            <label class="update" id="archiv1_aggregati_del">elimina archivio aggregato</label>
          <?php }} ?>
          <div class="updateContent" style="display:none">
           <?php require("inc/form_update/archiv1_aggregati.php"); ?>
           <?php require("inc/form_update/archiv1_aggregati_del.php"); ?>
          </div>
        </td>
        <td>
          <?php if($_SESSION['username']!='guest') {?>
             <label class="update" id="archiv1_aggrega">aggrega ad archivio esistente</label>
             &nbsp;|&nbsp;
             <?php if($rowaggregante != 0) {?>
             <label class="update" id="archiv1_aggregante_del">elimina collegamento ad archivio</label>
          <?php }} ?>
          <div class="updateContent" style="display:none">
           <?php require("inc/form_update/archiv1_aggrega.php"); ?>
           <?php require("inc/form_update/archiv1_aggrega_del.php"); ?>
          </div>
        </td>
       </tr>
      </table>
      <div class="toggle">
        <div class="sezioni"><h2>CRITERI DI ORDINAMENTO</h2></div>
        <div class="slide">
          <table class="mainData" >
           <tr>
            <td style="width:50%;">
             <div class="valori" style="min-height:180px !important;max-height:250px !important;overflow:auto;"><?php echo($crord2); ?></div>
            </td>
           </tr>
            <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="archiv1_ordinamento">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
        </div>
       </div>
      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/archiv1_ordinamento.php"); ?>
      </div>


      <div class="toggle">
        <div class="sezioni"><h2>NOTIZIE STORICHE</h2></div>
        <div class="slide">
         <table class="mainData" >
           <tr>
            <td style="width:50%;">
             <br/>
             <div class="valori" style="height:250px !important;overflow:auto;"><?php echo($vicarch2); ?></div>
            </td>
            <td>
             <label>NOTE</label>
             <div class="valori" style="height:250px !important;overflow:auto;"><?php echo($oss2); ?></div>
            </td>
           </tr>
         <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="archiv1_notsto">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
        </div>
       </div>
       <div class="updateContent" style="display:none">
        <?php require("inc/form_update/archiv1_notsto.php"); ?>
      </div>
   </div>
