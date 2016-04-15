<?php
$nd = 'Dato non presente';
$qbiblio1 = ("
SELECT 
biblio1.id as id_biblio1,	 
scheda.id, biblio1.dsc_tipo as biblio1_tipo_biblio, biblio1.dsc_dsc as biblio1_tipo_biblio_desc, biblio1.dsc_notsto as biblio1_not_sto, biblio1.nst_ossbiblio as biblio1_ossbiblio FROM public.biblio1, public.scheda WHERE biblio1.dgn_numsch1 = scheda.dgn_numsch AND 
  scheda.id = $id;");
$rq1 = pg_query($connection, $qbiblio1);
$aq1 = pg_fetch_array($rq1, 0, PGSQL_ASSOC);
$rowqbiblio1 = pg_num_rows($rq1);

$id_biblio1=$aq1['id_biblio1'];
$biblio1_tipo_biblio= stripslashes($aq1['biblio1_tipo_biblio']); if($biblio1_tipo_biblio == '') {$biblio1_tipo_biblio=$nd;}
$biblio1_tipo_biblio_desc= stripslashes($aq1['biblio1_tipo_biblio_desc']); if($biblio1_tipo_biblio_desc == '') {$biblio1_tipo_biblio_desc=$nd;}
$biblio1_not_sto= stripslashes($aq1['biblio1_not_sto']); if($biblio1_not_sto == '') {$biblio1_not_sto=$nd;}
$biblio1_ossbiblio= stripslashes($aq1['biblio1_ossbiblio']); if($biblio1_ossbiblio == '') {$biblio1_ossbiblio=$nd;}
?>
   <div class="inner">
      <h2 class="h2aperto">DESCRIZIONE BIBLIOTECA</h2>
      
      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <label>TIPOLOGIA BIBLIOTECA</label>
         <div class="valori" style="height:120px;overflow:auto;"><?php echo(nl2br($biblio1_tipo_biblio)); ?></div>
        </td>
        <td>
         <label>DESCRIZIONE</label>
         <div class="valori" style="height:120px;overflow:auto;"><?php echo(nl2br($biblio1_tipo_biblio_desc)); ?></div>
        </td>
       </tr>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="descr_biblioteca">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
      </table>
      
      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/descr_biblioteca.php"); ?>
      </div>
      
      <div class="toggle">
        <div class="sezioni"><h2>NOTIZIE STORICHE</h2></div>
        <div class="slide">
         <table class="mainData" >
           <tr>
            <td style="width:50%;">
             <br/>
             <div class="valori" style="height:120px;overflow:auto;"><?php echo(nl2br($biblio1_not_sto)); ?></div>
            </td>
            <td>
             <label>NOTE</label>
             <div class="valori" style="height:120px;overflow:auto;"><?php echo(nl2br($biblio1_ossbiblio)); ?></div>
            </td>
           </tr>
<?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="biblio1_notsto">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
          <div class="updateContent" style="display:none">
           <?php require("inc/form_update/biblio1_notsto.php"); ?>
          </div>
        </div>
       </div>
   </div>