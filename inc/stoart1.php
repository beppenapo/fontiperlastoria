<?php
$nd = 'Dato non presente';
$q2 =  ("SELECT
  beni_stoart1.id,
  beni_stoart1.ins_desc,
  beni_stoart1.ins_note
FROM
  public.scheda,
  public.beni_stoart1
WHERE
  beni_stoart1.dgn_numsch1 = scheda.dgn_numsch AND
  scheda.id = $id;");
$r2 = pg_query($connection, $q2);
$a2 = pg_fetch_array($r2, 0, PGSQL_ASSOC);
$rC2 = pg_num_rows($r2);



$ins_desc= stripslashes($a2['ins_desc']); if($ins_desc    == '') {$ins_desc=$nd;}
$ins_note = stripslashes($a2['ins_note']); if($ins_note     == '') {$ins_note=$nd;}

$idStoart1 = $a2['id'];
?>
   <div class="inner">
    <h2 class="h2aperto">DESCRIZIONE INSIEME</h2>

      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <br/>
         <div class="valori" style="height:250px; overflow:auto;"><?php echo(nl2br($ins_desc)); ?></div>
        </td>
        <td>
         <label>NOTE</label>
         <div class="valori" style="height:250px; overflow:auto;"><?php echo(nl2br($ins_note)); ?></div>
        </td>
       </tr>
      </table>

       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="stoart1" >modifica sezione</label>
           </td>
          </tr>
       <?php } ?>
   </div>

      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/stoart1.php"); ?>
      </div>
