<?php
require('db.php');

$q = strtoupper($_GET["term"]);
$query = ("
    SELECT scheda.id, scheda.dgn_numsch, lista_dgn_tpsch.css  
    FROM scheda, lista_dgn_tpsch 
    WHERE scheda.dgn_tpsch = lista_dgn_tpsch.id AND dgn_numsch like '%" . $q . "%' 
    ORDER BY dgn_numsch ASC;
"); 
$exec = pg_query($connection, $query);

$return_arr = array();  
while ($row = pg_fetch_assoc($exec)) {
  $row_array['id'] = $row['id'];
  $row_array['value'] = $row['dgn_numsch'];
  $row_array['css'] = $row['css'];
  array_push($return_arr,$row_array);
}
echo json_encode($return_arr);

?>