<?php
$nd = 'Dato non presente';
$q2 =  ("SELECT
  scheda.id,
  materiali1.id as id_materiali1,
  materiali1.dsc_tipo_raccolta as id_tipologia,
  lista_tipo_raccolta.definizione as tipologia,
  materiali1.dsc_nummanuf as consistenza,
  materiali1.dsc_ogg as caratteristiche,
  materiali1.dsc_catman as categorie,
  materiali1.dsc_critord as ordinamento,
  materiali1.dsc_notesto as notesto,
  materiali1.dsc_contaa as contesto,
  materiali1.dsc_gradutil as utilizzo,
  materiali1.dsc_oggpreg as elementi,
  materiali1.dsc_oss as note1,
  materiali1.dsc_notstooss as notstooss
FROM
  public.materiali1,
  public.scheda,
  lista_tipo_raccolta
WHERE
  materiali1.dgn_numsch1 = scheda.dgn_numsch AND
  materiali1.dsc_tipo_raccolta = lista_tipo_raccolta.id AND
  scheda.id =  $id;");
$r2 = pg_query($connection, $q2);
$a2 = pg_fetch_array($r2, 0, PGSQL_ASSOC);
$rC2 = pg_num_rows($r2);
$idMater1= $a2['id_materiali1'];
$idTipologia= $a2['id_tipologia'];
$tipologia= stripslashes($a2['tipologia']); if($tipologia == '') {$tipologia=$nd;}
$consistenza=stripslashes($a2['consistenza']); if($consistenza == '') {$consistenza=$nd;}
$caratteristiche=stripslashes($a2['caratteristiche']); if($caratteristiche == '') {$caratteristiche=$nd;}
$categorie=stripslashes($a2['categorie']); if($categorie == '') {$categorie=$nd;}
$ordinamento=stripslashes($a2['ordinamento']); if($ordinamento == '') {$ordinamento=$nd;}
$notesto=stripslashes($a2['notesto']); if($notesto == '') {$notesto=$nd;}
$contesto=stripslashes($a2['contesto']); if($contesto == '') {$contesto=$nd;}
$utilizzo=stripslashes($a2['utilizzo']); if($utilizzo == '') {$utilizzo=$nd;}
$elementi=stripslashes($a2['elementi']); if($elementi == '') {$elementi=$nd;}
$note1=stripslashes($a2['note1']); if($note1 == '') {$note1=$nd;}
$notstooss=stripslashes($a2['notstooss']); if($notstooss == '') {$notstooss=$nd;}

?>
   <div class="inner">
       <h2 class="h2aperto">DESCRIZIONE RACCOLTA/INDAGINE</h2>
      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <label>TIPOLOGIA RACCOLTA/INDAGINE</label>
         <div class="valori"><?php echo($tipologia); ?> </div>
        </td>
        <td></td>
       </tr>
       <tr>
        <td>
         <label>CONSISTENZA</label>
         <div class="valori"><?php echo($consistenza); ?> </div>
         <br/>
         <label>CARATTERISTICHE RACCOLTA/INDAGINE</label>
         <div class="valori" style="height:300px;overflow-y:auto;"><?php echo(nl2br($caratteristiche)); ?> </div>
         <br/>
         <label>CATEGORIE MANUFATTI</label>
         <div class="valori"><?php echo($categorie); ?> </div>
        </td>
        <td>
         <label>CONTESTO CONSERVATIVO</label>
         <div class="valori"><?php echo($contesto); ?> </div>
         <br/>
         <label>GRADO DI UTILIZZO</label>
         <div class="valori"><?php echo($utilizzo); ?> </div>
         <br/>
         <label>SPECIFICI ELEMENTI DI INTERESSE</label>
         <div class="valori"><?php echo($elementi); ?> </div>
         <br/>
         <label>NOTE</label>
         <div class="valori"><?php echo($note1); ?> </div>
        </td>
       </tr>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="mater1_descr">modifica sezione</label>
           </td>
          </tr>
        <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/mater1_descr.php"); ?>
      </div>

      <div class="toggle">
        <div class="sezioni"><h2>CRITERI DI ORDINAMENTO</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td>
               <div class="valori"><?php echo(nl2br($ordinamento)); ?> </div>
             </td>
           </tr>
          <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td>
             <label class="update" id="mater1_criteri">modifica sezione</label>
           </td>
          </tr>
        <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/mater1_criteri.php"); ?>
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
             <label class="update" id="mater1_notsto">modifica sezione</label>
           </td>
          </tr>
        <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/mater1_notsto.php"); ?>
      </div>
        </div>
   </div>
  </div>
