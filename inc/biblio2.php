<?php
$nd = 'Dato non presente';
$qbiblio2 = ("
SELECT 
  scheda.id AS id_scheda, 
  biblio2.id_biblio2,
  biblio2.bib_titolo as titolo, 
  biblio2.bib_sogg as soggetto, 
  biblio2.bib_nome as autore, 
  biblio2.bib_notenome as notenome, 
  biblio2.bib_contenuto as contenuto, 
  biblio2.bib_livbib as livbib_id, 
  lista_bib_livbib.definizione as livbib,
  biblio2.bib_tipodoc as tipo, 
  biblio2.bib_ediz as edizione, 
  biblio2.bib_period as periodi, 
  biblio2.bib_descfis as descrizione, 
  biblio2.bib_lingua as lingua, 
  biblio2.bib_notestor as note
FROM  
  public.biblio2, 
  public.scheda,
  public.lista_bib_livbib
WHERE 
  biblio2.dgn_numsch2 = scheda.dgn_numsch AND
  biblio2.bib_livbib = lista_bib_livbib.id and
  scheda.id = $id;");
$rq2 = pg_query($connection, $qbiblio2);
$aq2 = pg_fetch_array($rq2, 0, PGSQL_ASSOC);
$rowqbiblio2 = pg_num_rows($rq2);

$id_biblio2=$aq2['id_biblio2'];
$titolo= stripslashes($aq2['titolo']); if($titolo == '') {$titolo=$nd;}
$soggetto= stripslashes($aq2['soggetto']); if($soggetto == '') {$soggetto=$nd;}
$autore= stripslashes($aq2['autore']); if($autore == '') {$autore=$nd;}
$notenome= stripslashes($aq2['notenome']); if($notenome == '') {$notenome=$nd;}
$contenuto= stripslashes($aq2['contenuto']); if($contenuto == '') {$contenuto=$nd;}
$livbib= stripslashes($aq2['livbib']);
$livbib_id = $aq2['livbib_id'];
$tipo= stripslashes($aq2['tipo']); if($tipo == '') {$tipo=$nd;}
$edizione= stripslashes($aq2['edizione']); if($edizione == '') {$edizione=$nd;}
$periodi= stripslashes($aq2['periodi']); if($periodi == '') {$periodi=$nd;}
$descrizione= stripslashes($aq2['descrizione']); if($descrizione == '') {$descrizione=$nd;}
$lingua= stripslashes($aq2['lingua']); if($lingua == '') {$lingua=$nd;}
$note= stripslashes($aq2['note']); if($note == '') {$note=$nd;}

?>

   <div class="inner">
      <h2 class="h2aperto">DESCRIZIONE FONTE BIBLIOGRAFICA</h2>
      
      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <label>TITOLO</label>
         <div class="valori"><?php echo($titolo); ?></div>
         <br/>
         <label>SOGGETTO</label>
         <div class="valori"><?php echo($soggetto); ?></div>
         <br/>
         <label>AUTORE</label>
         <div class="valori"><?php echo($autore); ?></div>
         <br/>
         <label>NOTE AUTORE</label>
         <div class="valori"><?php echo($notenome); ?></div>
         <br/>
         <label>SPECIFICI ELEMENTI DI INTERESSE</label>
         <div class="valori"><?php echo($contenuto); ?></div>
        </td>
        <td>
         <label>LIVELLO BIBLIOGRAFICO</label>
         <div class="valori"><?php echo($livbib); ?></div>
         <br/>
         <label>TIPOLOGIA DOCUMENTO</label>
         <div class="valori"><?php echo($tipo); ?></div>
         <br/>
         <label>EDIZIONE</label>
         <div class="valori"><?php echo($edizione); ?></div>
         <br/>
         <label>PERIODICITA'</label>
         <div class="valori"><?php echo($periodi); ?></div>
         <br/>
         <label>DESCRIZIONE FISICA</label>
         <div class="valori"><?php echo($descrizione); ?></div>
         <br/>
         <label>LINGUA</label>
         <div class="valori"><?php echo($lingua); ?></div>
         <br/>
         <label>NOTE STORICHE</label>
         <div class="valori"><?php echo($note); ?></div>
         
        </td>
        </tr>
<?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="biblio2_dsc_fonte">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
          <div class="updateContent" style="display:none">
           <?php require("inc/form_update/biblio2_dsc_fonte.php"); ?>
          </div>
   </div>