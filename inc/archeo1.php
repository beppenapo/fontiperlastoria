<?php
$nd = 'Dato non presente';
$q2 =  ("SELECT 
  archeo.id_archeo, 
  archeo.id_scheda, 
  archeo.ind_data, 
  archeo.ind_rifper, 
  lista_ind_met.definizione AS metodo, 
  archeo.ind_rifsito, 
  archeo.ind_descr, 
  archeo.ind_codsca, 
  archeo.ind_met,
  archeo.ind_note,
  lista_ain_tipo.id as id_tipo, 
  lista_ain_tipo.definizione as tipo, 
  archeo.ain_data, 
  archeo.ain_enresp as id_enresp,
  anagrafica.nome as enresp, 
  archeo.ain_descr as descr, 
  archeo.ain_note as note1
FROM 
  public.archeo, 
  public.lista_ind_met,
  public.lista_ain_tipo, 
  public.anagrafica
WHERE 
  archeo.ind_met = lista_ind_met.id AND
  archeo.ain_tipo = lista_ain_tipo.id AND
  archeo.ain_enresp = anagrafica.id AND
  archeo.id_scheda = $id;");
$r2 = pg_query($connection, $q2);
$a2 = pg_fetch_array($r2, 0, PGSQL_ASSOC);
$rC2 = pg_num_rows($r2);

$id_archeo=$a2['id_archeo'];
$id_metodo=$a2['ind_met'];
$metodo=$a2['metodo'];
$data= stripslashes($a2['ind_data']); if($data == '') {$data=$nd;}
$rifper=stripslashes($a2['ind_rifper']); if($rifper == '') {$rifper=$nd;}
$rifsito=stripslashes($a2['ind_rifsito']); if($rifsito == '') {$rifsito=$nd;}
$descr= stripslashes($a2['ind_descr']); if($descr == '') {$descr=$nd;}
$codsca= stripslashes($a2['ind_codsca']); if($codsca == '') {$codsca=$nd;}
$note= stripslashes($a2['ind_note']); if($note == '') {$note=$nd;}
$id_tipo= $a2['id_tipo'];
$tipo= stripslashes($a2['tipo']); if($tipo == '') {$tipo=$nd;}
$ain_data= stripslashes($a2['ain_data']); if($ain_data == '') {$ain_data=$nd;}
$id_enresp= $a2['id_enresp'];
$enresp= stripslashes($a2['enresp']); if($enresp == '') {$enresp=$nd;}
$descr2= stripslashes($a2['descr']); if($descr2 == '') {$descr2=$nd;}
$note1= stripslashes($a2['note1']); if($note1 == '') {$note1=$nd;}
?>
   <div class="inner">
      <h2 class="h2aperto">DESCRIZIONE INDAGINE</h2>
      
      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <label>DATA</label>
         <div class="valori"><?php echo(nl2br($data)); ?></div>
        </td>
        <td>
         <label>RIFERIMENTO PERMESSO</label>
         <div class="valori"><?php echo(nl2br($rifper)); ?></div>
        </td>
       </tr>
       <tr>
        <td>
         <label>METODO</label>
         <div class="valori"><?php echo($a2['metodo']); ?></div>
        </td>
        <td>
         <label>RIFERIMENTO SITO</label>
         <div class="valori"><?php echo($rifsito); ?></div>
        </td>
       </tr>
       <tr>
        <td>
         <label>DESCRIZIONE</label>
         <div class="valori"><?php echo(nl2br($descr)); ?></div>
        </td>
        <td>
         <label>CODICE SCAVO</label>
         <div class="valori"><?php echo($codsca); ?></div>
         <br/>
         <label>NOTE</label>
         <div class="valori"><?php echo(nl2br($note)); ?></div>
        </td>
       </tr>
       <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="descr_indagine">modifica sezione</label>
           </td>
          </tr>
        <?php } ?>
      </table>
      <div class="updateContent" style="display:none">
        <?php require("inc/form_update/descr_indagine.php"); ?>
      </div>
          
      <div class="toggle">
        <div class="sezioni"><h2>ALTRE INDAGINI</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>TIPO INDAGINE</label>
               <div class="valori"><?php echo($tipo); ?></div>
               <br/>
               <label>DATA</label>
               <div class="valori"><?php echo($ain_data); ?></div>
               <br/>
               <label>ENTE RESPONSABILE</label>
               <div class="valori"><?php echo($enresp); ?></div>
               <br/>
               <label>DESCRIZIONE</label>
               <div class="valori"><?php echo($descr2); ?></div> 
             </td>
             <td>
              <label>NOTE</label>
              <div class="valori"><?php echo($note1); ?></div>
             </td>
           </tr>
          <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="altre_indagini">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
          <div class="updateContent" style="display:none">
           <?php require("inc/form_update/altre_indagini.php"); ?>
          </div>
        </div>
      </div>
   </div>
