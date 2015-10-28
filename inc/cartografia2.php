<?php
 $carto = ("
  select c.id, collocazione, titolo, istituto, soggetto, autore, elem_interesse, note, supporto, colore as id_colore, col.definizione as colore, misura, scala, tag1, tag2, tag3, tag4, tag5
  from cartografia2 c
  left join lista_dtc_icol col on c.colore = col.id
  left join tag on tag.id_scheda = c.id_scheda
  where c.id_scheda = $id;
 ");
 $cartoExec = pg_query($connection, $carto);
 $cartoArr = pg_fetch_array($cartoExec, 0, PGSQL_ASSOC);

?>

<div class="inner">
 <div class="toggle check bassa">
  <div class="sezioni" style="border-top:none !important;">
   <h2>PAROLE CHIAVE</h2>
  </div>
  <div class="slide" style="">
   <table style="width:98% !important;">
    <tr>
     <td>
      <label>PAROLA CHIAVE 1</label>
      <div class="valori"><?php echo $cartoArr['tag1']; ?></div>
     </td>
     <td>
      <label>PAROLA CHIAVE 2</label>
      <div class="valori"><?php echo $cartoArr['tag2']; ?></div>
     </td>
     <td>
      <label>PAROLA CHIAVE 3</label>
      <div class="valori"><?php echo $cartoArr['tag3']; ?></div>
     </td>
     <td>
      <label>PAROLA CHIAVE 4</label>
      <div class="valori"><?php echo $cartoArr['tag4']; ?></div>
     </td>
     <td>
      <label>PAROLA CHIAVE 5</label>
      <div class="valori"><?php echo $cartoArr['tag5']; ?></div>
     </td>
    </tr>
    <?php if($_SESSION['username']!='guest') {?>
    <tr>
     <td colspan="2">
      <label class="update" id="cartoTag">modifica sezione</label>
     </td>
    </tr>
    <?php } ?>
   </table>
   <div class="updateContent" style="display:none">
    <?php require("inc/form_update/cartoTag.php"); ?>
   </div>
  </div>
 </div>
 
 <div class="toggle check bassa">
  <div class="sezioni">
   <h2>SEGNATURA/COLLOCAZIONE</h2>
  </div>
  <div class="slide" style="">
   <table style="width:98% !important;">
    <tr>
     <td>
      <div class="valori"><?php echo stripslashes(nl2br($cartoArr['collocazione'])); ?></div>
     </td>
    </tr>
    <?php if($_SESSION['username']!='guest') {?>
    <tr>
     <td colspan="2">
      <label class="update" id="cartoCollocaz">modifica sezione</label>
     </td>
    </tr>
    <?php } ?>
   </table>
   <div class="updateContent" style="display:none">
    <?php require("inc/form_update/cartoCollocaz.php"); ?>
   </div>
  </div>
 </div>
 
 <div class="toggle check bassa">
  <div class="sezioni">
   <h2>DESCRIZIONE CARTOGRAFIA</h2>
  </div>
  <div class="slide" style="">
   <table style="width:98% !important;">
    <tr>
     <td>
      <label>TITOLO</label>
      <div class="valori"><?php echo stripslashes($cartoArr['titolo']); ?></div>
     </td>
     <td>
      <label>ISTITUO/UFFICIO PRODUTTORE</label>
      <div class="valori"><?php echo stripslashes($cartoArr['istituto']); ?></div>
     </td>
    </tr>
    <tr>
     <td>
      <label>SOGGETTO</label>
      <div class="valori"><?php echo stripslashes($cartoArr['soggetto']); ?></div>
     </td>
     <td>
      <label>AUTORE</label>
      <div class="valori"><?php echo stripslashes($cartoArr['autore']); ?></div>
     </td>
    </tr>
    <tr>
     <td>
      <label>SPECIFICI ELEMENTI DI INTERESSE</label>
      <div class="valori"><?php echo stripslashes($cartoArr['elem_interesse']); ?></div>
     </td>
     <td>
      <label>NOTE</label>
      <div class="valori"><?php echo stripslashes(nl2br($cartoArr['note'])); ?></div>
     </td>
    </tr>
    <?php if($_SESSION['username']!='guest') {?>
    <tr>
     <td colspan="2">
      <label class="update" id="cartoDescriz">modifica sezione</label>
     </td>
    </tr>
    <?php } ?>
   </table>
   <div class="updateContent" style="display:none">
    <?php require("inc/form_update/cartoDescriz.php"); ?>
   </div>
  </div>
 </div>
 
 <div class="toggle check bassa">
  <div class="sezioni">
   <h2>DATI TENICI</h2>
  </div>
  <div class="slide" style="">
   <table style="width:50% !important;">
    <tr>
     <td>
      <label>SUPPORTO</label>
      <div class="valori"><?php echo $cartoArr['supporto']; ?></div>
     </td>
    </tr>
    <tr>
     <td>
      <label>BN/COLORE</label>
      <div class="valori"><?php echo $cartoArr['colore']; ?></div>
     </td>
    </tr>
    <tr>
     <td>
      <label>MISURA STAMPA</label>
      <div class="valori"><?php echo $cartoArr['misura']; ?></div>
     </td>
    </tr>
    <tr>
     <td>
      <label>RAPPORTO DI SCALA</label>
      <div class="valori"><?php echo $cartoArr['scala']; ?></div>
     </td>
    </tr>
   <?php if($_SESSION['username']!='guest') {?>
    <tr>
     <td colspan="2">
      <label class="update" id="cartoDati">modifica sezione</label>
     </td>
    </tr>
    <?php } ?>
   </table>
   <div class="updateContent" style="display:none">
    <?php require("inc/form_update/cartoDati.php"); ?>
   </div>
  </div>
 </div> 
 
</div>
