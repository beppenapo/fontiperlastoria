<?php
require('db.php');
$term = $_GET["term"];

$query = ("
SELECT * FROM ts_stat ('SELECT
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
WHERE scheda.fine = 2')
where word ilike '".$term."%'
order by word asc;
");

$exec = pg_query($connection, $query);

$return_arr = array();  
while ($row = pg_fetch_assoc($exec)) {
  $row_array['value'] = $row['word'].'*';
  array_push($return_arr,$row_array);
}
echo json_encode($return_arr);
//echo($query);
?>

