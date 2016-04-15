<?php
$nd = 'Dato non presente';
$q2 =  ("SELECT 
  scheda.id AS id_scheda, 
  materiali2.id,  
  materiali2.dtp_morf AS morf_id, 
  materiali2.dtp_cta AS cta_id, 
  materiali2.dtp_uso AS uso_id, 
  materiali2.dtp_crntipo AS crntipo_id, 
  materiali2.dog_catgen AS catgen_id, 
  materiali2.dog_catspec AS catspec_id,
  lista_dog_catgen.definizione AS catgen, 
  lista_dog_catspec.definizione AS catspec, 
  lista_dtp_morf.definizione AS morf, 
  lista_dtp_cta.definizione AS cta, 
  lista_dtp_uso.definizione AS uso, 
  lista_dtp_crntipo.definizione AS crntipo, 
  materiali2.dtp_morfnote AS morfonote, 
  materiali2.dtp_usonote AS usonote, 
  materiali2.dtp_ctanote AS ctanote, 
  materiali2.dtp_crntiponote AS crntiponote, 
  materiali2.dtp_num AS num, 
  materiali2.dtp_note as note1
FROM 
  public.materiali2, 
  public.scheda, 
  public.lista_dog_catgen, 
  public.lista_dog_catspec, 
  public.lista_dtp_morf, 
  public.lista_dtp_cta, 
  public.lista_dtp_uso, 
  public.lista_dtp_crntipo
WHERE 
  materiali2.dgn_numsch2 = scheda.dgn_numsch AND
  materiali2.dog_catgen = lista_dog_catgen.id AND
  materiali2.dog_catspec = lista_dog_catspec.id AND
  materiali2.dtp_morf = lista_dtp_morf.id AND
  materiali2.dtp_cta = lista_dtp_cta.id AND
  materiali2.dtp_uso = lista_dtp_uso.id AND
  materiali2.dtp_crntipo = lista_dtp_crntipo.id and
  scheda.id = $id;");
$r2 = pg_query($connection, $q2);
$a2 = pg_fetch_array($r2, 0, PGSQL_ASSOC);
$rC2 = pg_num_rows($r2);
$idMater2= $a2['id'];
$catgen= stripslashes($a2['catgen'] ); if($catgen == '') {$catgen=$nd;}
$catspec=stripslashes($a2['catspec']); if($catspec == '') {$catspec=$nd;}
$morf=stripslashes($a2['morf']); if($morf == '') {$morf=$nd;}
$morfonote=stripslashes($a2['morfonote']); if($morfonote == '') {$morfonote=$nd;}
$uso=stripslashes($a2['uso']); if($uso == '') {$uso=$nd;}
$usonote=stripslashes($a2['usonote']); if($usonote == '') {$usonote=$nd;}
$cta=stripslashes($a2['cta']); if($cta == '') {$cta=$nd;}
$ctanote=stripslashes($a2['ctanote']); if($ctanote == '') {$ctanote=$nd;}
$crntipo=stripslashes($a2['crntipo']); if($crntipo == '') {$crntipo=$nd;}
$crntiponote=stripslashes($a2['crntiponote']); if($crntiponote == '') {$crntiponote=$nd;}
$num=stripslashes($a2['num']); if($num == '') {$num=$nd;}
$note1=stripslashes($a2['note1']); if($note1 == '') {$note1=$nd;}

?>
   <div class="inner">
       <h2 class="h2aperto">DESCRIZIONE TIPOLOGIA</h2>
      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <label>CATEGORIA GENERALE</label>
         <div class="valori"><?php echo($catgen); ?> </div>
         <br/>
         <label>MORFOLOGIA</label>
         <div class="valori"><?php echo($morf); ?> </div>
         <br/>
         <label>NOTE MORFOLOGIA</label>
         <div class="valori"><?php echo($morfonote); ?> </div>
         <br/>
         <label>FUNZIONE</label>
         <div class="valori"><?php echo($uso); ?> </div>
         <br/>
         <label>NOTE FUNZIONE</label>
         <div class="valori"><?php echo($usonote); ?> </div>
        </td>
        <td>
         <label>CATEGORIA SPECIFICA</label>
         <div class="valori"><?php echo($catspec); ?> </div>
         <br/>
         <label>CONTESTO AMBIENTALE</label>
         <div class="valori"><?php echo($cta); ?> </div>
         <br/>
         <label>NOTE CONTESTO AMBIENTALE</label>
         <div class="valori"><?php echo($ctanote); ?> </div>
         <br/>
         <label>CRONOTIPO</label>
         <div class="valori"><?php echo($crntipo); ?> </div>
         <br/>
         <label>NOTE CRONOTIPO</label>
         <div class="valori"><?php echo($crntiponote); ?> </div>
         <br/>
         <label>CODICE TIPOLOGIA</label>
         <div class="valori"><?php echo($num); ?> </div>
         <br/>
         <label>NOTE</label>
         <div class="valori"><?php echo($note1); ?> </div>
        </td>
       </tr>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="mater2_descr">modifica sezione</label>
           </td>
          </tr>
        <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/mater2_descr.php"); ?>
      </div>
  </div>