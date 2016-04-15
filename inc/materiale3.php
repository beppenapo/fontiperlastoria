<?php
$nd = 'Dato non presente';
$q2 =  ("SELECT 
  scheda.id, 
  materiali3.id as id_mater3,
  materiali3.dgn_numsch3, 
  materiali3.dnm_denomin AS denominazione,
  materiali3.dnm_note AS note1,
  materiali3.mrf_descr3 AS descr, 
  materiali3.mrf_modcostr3 AS modcostr, 
  materiali3.mrf_note3 AS note2, 
  materiali3.mrf_matcost3 as matcost,
  materiali3.uso_descrfunz AS descrfunz, 
  materiali3.uso_note AS note3, 
  materiali3.dtc_quote AS quote, 
  materiali3.dtc_note AS note4,
  materiali3.dgn_numsch3, 
  materiali3.cst_commnome AS commnome, 
  materiali3.cst_commdat AS commdat, 
  materiali3.cst_commfnt AS commfnt_id, 
  lista_cro_motiv.definizione AS commfnt,
  materiali3.cst_esecnome AS esecnome, 
  materiali3.cst_note as note5,
  materiali3.cta_vcoltatt as vcoltatt, 
  materiali3.cta_vcoltpass as vcoltpass, 
  materiali3.cta_fscalt3 as fscalt3, 
  materiali3.cta_veg as veg, 
  materiali3.cta_note as note6,
  materiali3.rpp_lega as lega, 
  materiali3.rpp_taglia as taglia, 
  materiali3.rpp_tagliato as tagliato, 
  materiali3.rpp_conduce as conduce, 
  materiali3.rpp_servita as servita, 
  materiali3.rpp_note as note7,
  materiali3.cll_lgattr3 as lgattr, 
  materiali3.cll_lgecon3 as lgecon, 
  materiali3.cll_infcompl3 as infcompl, 
  materiali3.cll_note as note8,
  materiali3.isc_descont AS descont, 
  materiali3.isc_trascr AS trascr, 
  materiali3.isc_note as note9,
  materiali3.fot_coll as segnatura,
  materiali3.dog_catgen AS catgen_id, 
  materiali3.dog_catspec AS catspec_id,
  lista_dog_catgen.definizione AS catgen, 
  lista_dog_catspec.definizione AS catspec,
  materiali3.dtc_dim,
  materiali3.rst_tpint,
  materiali3.rst_rifar,
  materiali3.cat_stornap,
  materiali3.cat_storasb,
  materiali3.rst_note
FROM 
  scheda, materiali3, lista_dog_catgen, lista_dog_catspec, lista_cro_motiv  
WHERE 
  materiali3.dgn_numsch3 = scheda.dgn_numsch AND 
  materiali3.dog_catgen = lista_dog_catgen.id AND
  materiali3.dog_catspec = lista_dog_catspec.id AND
  materiali3.cst_commfnt = lista_cro_motiv.id AND
  scheda.id = $id;");
$r2 = pg_query($connection, $q2);
$a2 = pg_fetch_array($r2, 0, PGSQL_ASSOC);
$rC2 = pg_num_rows($r2);

$idMater3= $a2['id_mater3'];
$catgenId= $a2['catgen_id'];
$catspecId= $a2['catspec_id'];
$commfntId= $a2['commfnt_id'];
$denominazione= stripslashes($a2['denominazione']); if($denominazione == '') {$denominazione=$nd;}
$note1= stripslashes($a2['note1']); if($note1 == '') {$note1=$nd;}
$descr= stripslashes($a2['descr']); if($descr == '') {$descr=$nd;}
$modcostr= stripslashes($a2['modcostr']); if($modcostr == '') {$modcostr=$nd;}
$note2= stripslashes($a2['note2']); if($note2 == '') {$note2=$nd;}
$matcost= stripslashes($a2['matcost']); if($matcost == '') {$matcost=$nd;}
$descrfunz= stripslashes($a2['descrfunz']); if($descrfunz == '') {$descrfunz=$nd;}
$note3= stripslashes($a2['note3']); if($note3 == '') {$note3=$nd;}
$dim= stripslashes($a2['dtc_dim']); if($dim == '') {$dim=$nd;}
$quote= stripslashes($a2['quote']); if($quote == '') {$quote=$nd;}
$note4= stripslashes($a2['note4']); if($note4 == '') {$note4=$nd;}
$commnome= stripslashes($a2['commnome']); if($commnome == '') {$commnome=$nd;}
$commdat= stripslashes($a2['commdat']); if($commdat == '') {$commdat=$nd;}
$commfnt= stripslashes($a2['commfnt']); if($commfnt == '') {$commfnt=$nd;}
$esecnome= stripslashes($a2['esecnome']); if($esecnome == '') {$esecnome=$nd;}
$note5= stripslashes($a2['note5']); if($note5 == '') {$note5=$nd;}
$vcoltatt= stripslashes($a2['vcoltatt']); if($vcoltatt == '') {$vcoltatt=$nd;}
$vcoltpass= stripslashes($a2['vcoltpass']); if($vcoltpass == '') {$vcoltpass=$nd;}
$fscalt3= stripslashes($a2['fscalt3']); if($fscalt3 == '') {$fscalt3=$nd;}
$veg= stripslashes($a2['veg']); if($veg == '') {$veg=$nd;}
$note6= stripslashes($a2['note6']); if($note6 == '') {$note6=$nd;}
$lega= stripslashes($a2['lega']); if($lega == '') {$lega=$nd;}
$taglia= stripslashes($a2['taglia']); if($taglia == '') {$taglia=$nd;}
$tagliato= stripslashes($a2['tagliato']); if($tagliato == '') {$tagliato=$nd;}
$conduce= stripslashes($a2['conduce']); if($conduce == '') {$conduce=$nd;}
$servita= stripslashes($a2['servita']); if($servita == '') {$servita=$nd;}
$note7= stripslashes($a2['note7']); if($note7 == '') {$note7=$nd;}
$lgattr= stripslashes($a2['lgattr']); if($lgattr == '') {$lgattr=$nd;}
$lgecon= stripslashes($a2['lgecon']); if($lgecon == '') {$lgecon=$nd;}
$infcompl= stripslashes($a2['infcompl']); if($infcompl == '') {$infcompl=$nd;}
$note8= stripslashes($a2['note8']); if($note8 == '') {$note8=$nd;}
$descont= stripslashes($a2['descont']); if($descont == '') {$descont=$nd;}
$trascr= stripslashes($a2['trascr']); if($trascr == '') {$trascr=$nd;}
$note9= stripslashes($a2['note9']); if($note9 == '') {$note9=$nd;}
$segnatura= stripslashes($a2['segnatura']); if($segnatura == '') {$segnatura=$nd;}
$dog_catgen3= stripslashes($a2['catgen']); if($dog_catgen3 == '') {$dog_catgen3=$nd;}
$dog_catspec3= stripslashes($a2['catspec']); if($dog_catspec3 == '') {$dog_catspec3=$nd;}
$rst_tpint= stripslashes($a2['rst_tpint']); if($rst_tpint == '') {$rst_tpint=$nd;}
$rst_rifar= stripslashes($a2['rst_rifar']); if($rst_rifar == '') {$rst_rifar=$nd;}
$cat_stornap= stripslashes($a2['cat_stornap']); if($cat_stornap == '') {$cat_stornap=$nd;}
$cat_storasb= stripslashes($a2['cat_storasb']); if($cat_storasb == '') {$cat_storasb=$nd;}
$rst_note= stripslashes($a2['rst_note']); if($rst_note == '') {$rst_note=$nd;}
?>
  <div class="inner">
   <div class="toggle">
    <div class="sezioni" style="border-top:none !important; border-bottom:1px solid #96867B"><h2>SEGNATURA/COLLOCAZIONE</h2></div>
        <div class="slide" style="border-bottom:1px solid #96867B">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <br/>
               <div class="valori"><?php echo($segnatura); ?></div>
             </td>
             <td>
             </td>
           </tr>
           <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="mater3_segnatura">modifica sezione</label>
           </td>
          </tr>
        <?php } ?>
          </table>
          <div class="updateContent" style="display:none">
           <?php require("inc/form_update/mater3_segnatura.php"); ?>
          </div>
        </div>
      </div>
      <div style="border-top:none !important; border-bottom:1px solid #96867B">
      <h2 class="h2aperto">DENOMINAZIONE COMUNE</h2>
      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <br/>
         <div class="valori" style="height:120px;overflow:auto;"><?php echo(nl2br($denominazione)); ?> </div>
        </td>
        <td>
         <label>NOTE</label>
         <div class="valori" style="height:120px;overflow:auto;"><?php echo(nl2br($note1)); ?> </div>
        </td>
       </tr>
      <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="mater3_denominazione">modifica sezione</label>
           </td>
          </tr>
        <?php } ?>
          </table>
          <div class="updateContent" style="display:none">
           <?php require("inc/form_update/mater3_denominazione.php"); ?>
          </div>
      </div>
      <h2 class="h2aperto">DESCRIZIONE MORFOLOGIA</h2>
      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <label>CATEGORIA GENERALE</label>
         <div class="valori"><?php echo($dog_catgen3); ?></div>
         <br/>
         <label>MATERIALI COSTRUTTIVI</label>
         <div class="valori"><?php echo($matcost); ?> </div>
         <br/>
         <label>DESCRIZIONE</label>
         <div class="valori" style="height:120px;overflow:auto;"><?php echo(nl2br($descr)); ?> </div>
        </td>
        <td>
         <label>CATEGORIA SPECIFICA</label>
         <div class="valori"><?php echo($dog_catspec3); ?></div>
         <input type="hidden" id="catspecclass" value="<?php echo($catspecId); ?>" />
         <br/>
         <label>TECNICHE COSTRUTTIVE</label>
         <div class="valori"><?php echo($modcostr); ?> </div>
         <br/>
         <label>NOTE</label>
         <div class="valori"style="height:120px;overflow:auto;"><?php echo(nl2br($note2)); ?> </div>
        </td>
       </tr>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="mater3_morfologia">modifica sezione</label>
           </td>
          </tr>
        <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
           <?php require("inc/form_update/mater3_morfologia.php"); ?>
      </div>
      <div class="toggle">
        <div class="sezioni"><h2>DESCRIZIONE FUNZIONI</h2></div>
        <div class="slide">
       <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <br/>
         <div class="valori" style="height:120px;overflow:auto;"><?php echo(nl2br($descrfunz)); ?> </div>
        </td>
        <td>
         <label>NOTE</label>
         <div class="valori" style="height:120px;overflow:auto;"><?php echo(nl2br($note3)); ?> </div>
        </td>
       </tr>
     <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="mater3_funzioni">modifica sezione</label>
           </td>
          </tr>
        <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
           <?php require("inc/form_update/mater3_funzioni.php"); ?>
      </div>
        </div>
   </div>
     
      <div class="toggle">
        <div class="sezioni"><h2>DATI TECNICI</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>DIMENSIONI</label>
               <div class="valori"><?php echo($dim); ?> </div>
             </td>
             <td>
              <label>QUOTE</label>
              <div class="valori"><?php echo($quote); ?></div>
             </td>
            </tr>
            <tr>
            <td colspan="2">
              <label>NOTE</label>
              <div class="valori" style="height:120px;overflow:auto;"><?php echo(nl2br($note4)); ?></div>
             </td>
           </tr>
          <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="mater3_datitecnici">modifica sezione</label>
           </td>
          </tr>
        <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
           <?php require("inc/form_update/mater3_datitecnici.php"); ?>
      </div>
        </div>
   </div>
   <div class="toggle">
        <div class="sezioni"><h2>COSTRUZIONE</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>COMMITTENTE</label>
               <div class="valori"><?php echo($commnome); ?> </div>
               <br/>
               <label>DATA COSTRUZIONE</label>
               <div class="valori"><?php echo($commdat); ?></div>
               <br/>
               <label>MOTIVAZIONE DATA COSTRUZIONE</label>
               <div class="valori"><?php echo($commfnt); ?></div>
             </td>
             <td>
              <label>ESECUTORE</label>
              <div class="valori"><?php echo($esecnome); ?></div>
              <br/>
              <label>NOTE</label>
              <div class="valori" style="height:120px;overflow:auto;"><?php echo(nl2br($note5)); ?></div>
             </td>
           </tr>
          <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="mater3_costruzioni">modifica sezione</label>
           </td>
          </tr>
        <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
           <?php require("inc/form_update/mater3_costruzioni.php"); ?>
      </div>
        </div>
   </div>
   
   <div class="toggle">
        <div class="sezioni"><h2>RESTAURI/MANUTENZIONI</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>ELENCO RESTAURI/MANUTENZIONI</label>
               <div class="valori"><?php echo($rst_tpint); ?></div>
             </td>
             <td>
              <label>DOCUMENTAZIONE RESTAURI/MANUTENZIONI</label>
              <div class="valori"><?php echo($rst_rifar); ?></div>
             </td>
            </tr>
            <tr>
             <td colspan="2">
              <label>NOTE</label>
              <div class="valori" style="height:120px;overflow:auto;"><?php echo(nl2br($rst_note)); ?></div>
             </td>
           </tr>
          <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="mater3_restauri">modifica sezione</label>
           </td>
          </tr>
        <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
           <?php require("inc/form_update/mater3_restauri.php"); ?>
      </div>
        </div>
   </div>
  <div id="sottocategorie">
   <div class="toggle">
        <div class="sezioni"><h2 class="sottosez">DESCRIZIONE CONTESTO AMBIENTALE</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>CONTESTO AMBIENTALE ATTUALE</label>
               <div class="valori"><?php echo($vcoltatt); ?> </div>
               <br/>
               <label>CONTESTO AMBIENTALE PASSATO</label>
               <div class="valori"><?php echo($vcoltpass); ?> </div>
             </td>
             <td>
              <label>FASCIA ALTIMETRICA</label>
               <div class="valori"><?php echo($fscalt3); ?> </div>
               <br/>
               <label>VEGETAZIONE</label>
               <div class="valori"><?php echo($veg); ?> </div>
             </td>
            </tr>
            <tr>
             <td colspan="2">
              <label>NOTE</label>
              <div class="valori" style="height:120px;overflow:auto;"><?php echo(nl2br($note6)); ?></div>
             </td>
           </tr>
          <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="mater3_contesto">modifica sezione</label>
           </td>
          </tr>
        <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
           <?php require("inc/form_update/mater3_contesto.php"); ?>
      </div>
        </div>
   </div>
   
   <div class="toggle">
        <div class="sezioni"><h2 class="sottosez">RAPPORTI TRA INFRASTRUTTURE</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
             <?php
              foreach(array(
                            'rpp_lega'=>array(1, 'SI LEGA A'),
                            'rpp_taglia'=>array(2, 'TAGLIA'),
                            'rpp_tagliato'=>array(3, 'TAGLIATO DA'),
                            'rpp_conduce'=>array(4, 'CONDUCE A'),
                            'rpp_servita'=>array(5, 'SERVITO DA')                           
              ) as $campofor=>$nomefor){
                $qrif7 = ("
                   SELECT mater_infrastrutture.id AS id_mater_infr, scheda.id, scheda.dgn_numsch, lista_dgn_tpsch.css
                   FROM mater_infrastrutture, scheda, lista_dgn_tpsch
                   WHERE mater_infrastrutture.collegata = scheda.id AND
                         scheda.dgn_tpsch = lista_dgn_tpsch.id AND
                         mater_infrastrutture.scheda = $id AND
                         mater_infrastrutture.rapporto = $nomefor[0];
                ");
 
                $rrif7 = pg_query($connection, $qrif7);
                $rowrif7 = pg_num_rows($rrif7);
                   echo '<tr><td style="width:70% !important;"><label>'.$nomefor[1].'</label><div id="div_'.$campofor.'" class="valori">';
                   for ($x = 0; $x < $rowrif7; $x++){
                    $idmi = pg_result($rrif7, $x,"id_mater_infr");
                    $idLinked = pg_result($rrif7, $x,"id");
                    $linked = pg_result($rrif7, $x,"dgn_numsch");
                    $css = pg_result($rrif7, $x,"css");
                    if($rowrif7==0) {$idmi = 'Nessuna scheda segnalata';}
                    echo "<a href=\"scheda_archeo.php?id=$idLinked\" target=\"_blank\" class=\"altrif ".$css."\">$linked</a>";
                   }
                   echo '</div></td></tr>';
              }
           ?>
          <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td>
             <label class="update" id="mater3_infrastrutture">modifica sezione</label>
           </td>
          </tr>
        <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
           <?php require("inc/form_update/mater3_infrastrutture.php"); ?>
      </div>
        </div>
   </div>

   <div class="toggle">
        <div class="sezioni"><h2 class="sottosez">COLLEGAMENTI VIARI</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>LUOGHI DI ATTRAZIONE</label>
               <div class="valori"><?php echo($lgattr); ?> </div>
               <br/>
               <label>LUOGHI DI ATTIVITA' ECONOMICO-PRODUTTIVE</label>
               <div class="valori"><?php echo($lgecon); ?></div>
             </td>
             <td>
              <label>INFRASTRUTTURE COMPLEMENTARI</label>
              <div class="valori"><?php echo($infcompl); ?></div>
              <br/>
              <label>NOTE</label>
              <div class="valori"><?php echo($note8); ?></div>
             </td>
           </tr>
          <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="mater3_collegamenti">modifica sezione</label>
           </td>
          </tr>
        <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
           <?php require("inc/form_update/mater3_collegamenti.php"); ?>
      </div>
        </div>
   </div>
  </div>
     <div class="toggle">
        <div class="sezioni"><h2>ISCRIZIONI</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>DESCRIZIONE</label>
               <div class="valori"><?php echo($descont); ?> </div>
             </td>
             <td>
              <label>TRASCRIZIONE</label>
              <div class="valori"><?php echo($trascr); ?> </div>
            </td>
            </tr>
            <tr>
             <td colspan="2">
              <label>NOTE</label>
              <div class="valori" style="height:120px;overflow:auto;"><?php echo(nl2br($note9)); ?> </div>
             </td>
           </tr>
          <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="mater3_iscrizioni">modifica sezione</label>
           </td>
          </tr>
        <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
           <?php require("inc/form_update/mater3_iscrizioni.php"); ?>
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
               <div class="valori"><?php echo($cat_stornap); ?></div>
             </td>
             <td>
              <label>CATASTO 1859</label>
              <div class="valori"><?php echo($cat_storasb); ?></div>
             </td>
           </tr>
          <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="mater3_catasto">modifica sezione</label>
           </td>
          </tr>
        <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
           <?php require("inc/form_update/mater3_catasto.php"); ?>
      </div>
        </div>
   </div>
  </div>
