<?php
include('db.php');

if($_POST['q']){
 $q=stripslashes($_POST['q']);
 $query = ("
  select distinct s.id, s.dgn_numsch, s.dgn_dnogg, c.cro_iniz, c.cro_fin
  from scheda s
  inner join cronologia c on c.id_scheda=s.id
  left join ricerca compilazione on s.cmp_id = compilazione.id
  left join compilazione cmp on cmp.id_scheda = s.id
  left join ricerca provenienza on s.prv_id = provenienza.id
  left join aree_scheda on aree_scheda.id_scheda = s.id
  left join aree_scheda as ubi_scheda on ubi_scheda.id_scheda = s.id
  left join aree on aree_scheda.id_area = aree.id
  left join aree as ubi on ubi_scheda.id_area = ubi.id  
  left join comune on aree.id_comune = comune.id
  left join comune as comubi on aree.id_comune = comubi.id
  left join anagrafica on ubi.id_rubrica = anagrafica.id
  left join consultabilita on consultabilita.id_scheda = s.id
  left join archeo on archeo.id_scheda = s.id
  where 
   s.dgn_tpsch = 6 
   and s.livello = 1 
   and cmp.cmp_prv = 1 
   and aree.tipo = 1 
   and s.fine = 2
   and $q
  order by s.dgn_numsch ASC;
 ");
 $result = pg_query($connection, $query);
 $righe = pg_num_rows($result);
 if($righe > 0){
  while($row = pg_fetch_array($result)){
   $id=$row['id'];
   $numsch=$row['dgn_numsch'];
   $ogg=$row['dgn_dnogg'];
   $croin=$row['cro_iniz']; 
   $crofin=$row['cro_fin'];     
   echo '<h1>'.$numsch.'</h1><p>'.$ogg.'</p><p>'.$croin.'</p><p>'.$crofin.'</p><a href="scheda_archeo.php?id='.$id.'" target="_blank">visualizza scheda</a>';
  }
 }else{echo '<h1>Nessuna scheda trovata</h1><p>'.$q.'</p>';}
}
?>
