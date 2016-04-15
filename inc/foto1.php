<?php
$nd = '-';
$q2 =  ("SELECT 
  foto1.id as id_foto1,
  foto1.crc_tipo as tipologia,
  foto1.crc_con as consistenza,
  foto1.crc_car as caratteristiche,
  foto1.crc_elemint as elementi,
  foto1.crc_note as note,
  foto1.dsc_critord as ordinamento,
  foto1.dsc_notsto as notesto,
  foto1.dsc_notstooss as notstooss
FROM 
  public.foto1, 
  public.scheda
WHERE 
  foto1.dgn_numsch1 = scheda.dgn_numsch AND
  scheda.id = $id;");
$r2 = pg_query($connection, $q2);
$a2 = pg_fetch_array($r2, 0, PGSQL_ASSOC);
$rC2 = pg_num_rows($r2);
$idFoto1	=$a2['id_foto1'];
$tipologia	=stripslashes($a2['tipologia']); if($tipologia == '') {$tipologia=$nd;}
$consistenza	=stripslashes($a2['consistenza']); if($consistenza == '') {$consistenza=$nd;}
$caratteristiche=stripslashes($a2['caratteristiche']); if($caratteristiche == '') {$caratteristiche=$nd;}
$elementi	=stripslashes($a2['elementi']); if($elementi == '') {$elementi=$nd;}
$note		=stripslashes($a2['note']); if($note == '') {$note=$nd;}
$ordinamento	=stripslashes($a2['ordinamento']); if($ordinamento == '') {$ordinamento=$nd;}
$notesto	=stripslashes($a2['notesto']); if($notesto == '') {$notesto=$nd;}
$notstooss	=stripslashes($a2['notstooss']); if($notstooss == '') {$notstooss=$nd;}

?>
   <div class="inner">
       <h2 class="h2aperto">DESCRIZIONE RACCOLTA</h2>
      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <label>TIPOLOGIA RACCOLTA</label>
         <div class="valori"><?php echo($tipologia); ?> </div>
        </td>
        <td></td>
       </tr>
       <tr>
        <td>
         <label>CONSISTENZA</label>
         <div class="valori"><?php echo($consistenza); ?> </div>
         <br/>
         <label>CARATTERISTICHE RACCOLTA</label>
         <div class="valori"><?php echo(nl2br($caratteristiche)); ?> </div>
        </td>
        <td>
         <label>SPECIFICI ELEMENTI DI INTERESSE</label>
         <div class="valori"><?php echo(nl2br($elementi)); ?> </div>
         <br/>
         <label>NOTE</label>
         <div class="valori"><?php echo(nl2br($note)); ?> </div>
        </td>
       </tr>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="foto1_descr">modifica sezione</label>
           </td>
          </tr>
        <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/foto1_descr.php"); ?>
      </div>

      <div class="toggle">
        <div class="sezioni"><h2>CRITERI DI ORDINAMENTO</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td>
               <div class="valori"><?php echo($ordinamento); ?> </div>
             </td>
            </tr>
          <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td>
             <label class="update" id="foto1_criteri">modifica sezione</label>
           </td>
          </tr>
        <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/foto1_criteri.php"); ?>
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
               <div class="valori"><?php echo($notesto); ?> </div>
             </td>
             <td>
              <label>NOTE</label>
              <div class="valori"><?php echo($notstooss); ?> </div>
             </td>
            </tr>
           <?php if($_SESSION['username']!='guest') {?>
           <tr>
            <td colspan="2">
             <label class="update" id="foto1_notsto">modifica sezione</label>
            </td>
           </tr>
           <?php } ?>
          </table>
          <div class="updateContent" style="display:none">
          	<?php require("inc/form_update/foto1_notsto.php"); ?>
          </div>
          	</div>
   </div>
  </div>