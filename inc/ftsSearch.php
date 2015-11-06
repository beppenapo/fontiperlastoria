<?php
session_start();
require("db.php");

if(!isset($_SESSION['id_user']) or $_SESSION['hub']==1){
 $andhub="and hub.id=1";
}else{
 $andhub='and hub.id=2';
}

$ci = $_POST['ci'];
$cf = $_POST['cf'];
$tipoArr = $_POST['tipo'];
$livArr = $_POST['liv'];
$vect = $_POST['vect'];
$filtro = $_POST['filtro'];
//$andhub = $_POST['andhub'];
$q = $_POST['q'];

$tipi = ' and (';
$livelli = ' and (';

//cronologia
if(!$ci){ $ci = 0; $cf = date('Y');}

//se si utilizza il pulsante filtro
if($filtro == 1){
 //parole chiave
 if($vect == 'no'){  $whereFts = ''; }else{ $whereFts = "where a.vettori @@ to_tsquery('$vect')"; }
 
 //tipo scheda
 foreach($tipoArr as $tipo){$tipi .= " scheda.dgn_tpsch = ".$tipo." or ";}
 $tipi = substr($tipi, 0, -4);
 $tipi .= " ) ";
 //echo $tipi;
 
 //livello
 foreach($livArr as $livello){$livelli .= " scheda.livello = ".$livello." or ";}
 $livelli = substr($livelli, 0, -4);
 $livelli .= " ) ";

//se si utilizzano le parole chiave
}else{
 $whereFts = "where a.vettori @@ to_tsquery('$q')";
 $tipi = " ";
 //echo $tipi;
 $livelli = " ";
}

//echo 'ci: '.$ci.' cf: '.$cf.' tipo: '.$tipo.' liv: '.$liv.' vect: '.$vect.' filtro: '.$filtro.' '.$andhub.' fts: '.$q;

$query=("
SELECT distinct a.id, a.dgn_tpsch tipo, a.livello, a.numsch, a.livind, a.oggetto, a.note, a.cro_spec, a.cro_iniz ci, a.cro_fin cf 
 from (SELECT scheda.id, scheda.dgn_numsch numsch, scheda.dgn_dnogg oggetto, scheda.dgn_note note, scheda.dgn_tpsch, scheda.dgn_livind, 
 livind.definizione as livind, scheda.fine, scheda.livello, crono.cro_iniz, crono.cro_fin,  crono.cro_spec,
  coalesce(scheda.scheda_vector,'') 
  ||coalesce(livind.livind_vector,'')
  ||coalesce(crono.crono_vector,'')
  ||coalesce(prv.ricerca_vector,'')
  ||coalesce(cmp.ricerca_vector,'')
  ||coalesce(com_ai.comune_vector,'')
  ||coalesce(com_ai.comune_vector,'')
  ||coalesce(com_ubi.comune_vector,'')
  ||coalesce(loc_ai.localita_vector,'')
  ||coalesce(loc_ubi.localita_vector,'')
  ||coalesce(ind_ai.indirizzo_vector,'')
  ||coalesce(ind_ubi.indirizzo_vector,'')
  ||coalesce(ana.anagrafica_vector,'')
  ||coalesce(conserv.conserv_vector,'')
  ||coalesce(altrif.altrif_vector,'')
  ||coalesce(tipo.dsc_tipol_vector,'')
  ||coalesce(archeo.archeo_vector,'')
  ||coalesce(archtt1.archtt1_vector,'')
  ||coalesce(archtt2.archtt2_vector,'')
  ||coalesce(biblio1.biblio1_vector,'')
  ||coalesce(biblio2.biblio2_vector,'')
  ||coalesce(foto1.foto1_vector,'')
  ||coalesce(foto2.foto2_vector,'')
  ||coalesce(archivi.archivi_vector,'')
  ||coalesce(archivi1.archivi1_vector,'')
  ||coalesce(archivi2.archivi2_vector,'')
  ||coalesce(archivi3.archivi3_vector,'')
  ||coalesce(materiali1.materiali1_vector,'')
  ||coalesce(materiali3.materiali3_vector,'')
  ||coalesce(fonti_orali1.orali1_vector,'')
  ||coalesce(fonti_orali2.orali2_vector,'')
  ||coalesce(fonti_orali3.orali3_vector,'')
  ||coalesce(beni_stoart1.stoart1_vector,'')
  ||coalesce(beni_stoart2.stoart2_vector ,'')
  as vettori
FROM 
  scheda
left join archeo on archeo.id_scheda = scheda.id
left join altrif on altrif.scheda = scheda.id
left join lista_dsc_tipol tipo on tipo.id = archeo.sit_tipol
left join fonti_archtt archtt on archtt.id_scheda = scheda.id
left join fonti_archtt1 archtt1 on archtt1.dgn_numsch1 = archtt.dgn_numsch 
left join fonti_archtt2 archtt2 on archtt2.dgn_numsch2 = archtt.dgn_numsch
left join biblio on biblio.id_scheda = scheda.id
left join biblio1 on biblio1.dgn_numsch1 = biblio.dgn_numsch
left join biblio2 on biblio2.dgn_numsch2 = biblio.dgn_numsch
left join foto on foto.id_scheda = scheda.id
left join foto1 on foto1.dgn_numsch1 = foto.dgn_numsch
left join foto2 on foto2.dgn_numsch2 = foto.dgn_numsch
left join archivi on archivi.id_scheda = scheda.id
left join archivi1 on archivi1.dgn_numsch1 = archivi.dgn_numsch
left join archivi2 on archivi2.dgn_numsch2 = archivi.dgn_numsch
left join archivi3 on archivi3.dgn_numsch3 = archivi.dgn_numsch
left join materiali on materiali.id_scheda = scheda.id
left join materiali1 on materiali1.dgn_numsch1 = materiali.dgn_numsch
left join materiali3 on materiali3.dgn_numsch3 = materiali.dgn_numsch
left join fonti_orali on fonti_orali.id_scheda = scheda.id
left join fonti_orali1 on fonti_orali1.dgn_numsch1 = fonti_orali.dgn_numsch
left join fonti_orali2 on fonti_orali2.dgn_numsch2 = fonti_orali.dgn_numsch
left join fonti_orali3 on fonti_orali3.dgn_numsch3 = fonti_orali.dgn_numsch
left join beni_stoart on beni_stoart.id_scheda = scheda.id
left join beni_stoart1 on beni_stoart1.dgn_numsch1 = beni_stoart.dgn_numsch
left join beni_stoart2 on beni_stoart2.dgn_numsch2 = beni_stoart.dgn_numsch
inner join aree_scheda as_ai on as_ai.id_scheda = scheda.id
inner join aree aai on aai.id=as_ai.id_area
inner join comune com_ai on com_ai.id = aai.id_comune
inner join localita loc_ai on loc_ai.id = aai.id_localita
inner join indirizzo ind_ai on ind_ai.id = aai.id_indirizzo
inner join aree_scheda as_ubi on as_ubi.id_scheda = scheda.id
inner join aree aubi on aubi.id=as_ubi.id_area
inner join comune com_ubi on com_ubi.id = aubi.id_comune
inner join localita loc_ubi on loc_ubi.id = aubi.id_localita
inner join indirizzo ind_ubi on ind_ubi.id = aubi.id_indirizzo
inner join lista_dgn_livind livind on livind.id = scheda.dgn_livind
inner join cronologia crono on crono.id_scheda = scheda.id
inner join ricerca prv on prv.id = scheda.prv_id
inner join ricerca cmp on cmp.id = scheda.cmp_id
inner join anagrafica ana on ana.id = scheda.ana_id
inner join lista_stato_conserv conserv on conserv.id = scheda.scn_id
inner join hub on cmp.hub = hub.id
WHERE scheda.fine = 2 and ((crono.cro_iniz between $ci and $cf) or (crono.cro_fin between $ci and $cf)) $tipi $livelli $andhub) a
$whereFts
order by numsch asc;
");

$exec = pg_query($connection, $query);
while ($row = pg_fetch_assoc($exec)){ 
 echo "<tr class='filtro".$row['tipo'].$row['livello']." link' title='Clicca per aprire la scheda ".$row['numsch']."' ref='".$row['id']."' liv='".$row['livello']."' ci='".$row['ci']."' cf='".$row['cf']."'>
  <td>".$row['numsch']."</td>
  <td>".$row['livind']."</td>
  <td>".$row['oggetto']."</td>
  <td>".$row['note']."</td>
  <td style='padding-left:20px;'>".$row['cro_spec']."</td>
 </tr>";
}
echo "<tr><td colspan='5'>$query</td></tr>";
?>
