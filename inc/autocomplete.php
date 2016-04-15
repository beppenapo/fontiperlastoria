<?php
require('db.php');

$q = strtoupper($_GET["term"]);
$query = ("SELECT id, dgn_numsch, dgn_tpsch, livello FROM scheda where dgn_numsch like '%" . $q . "%' ORDER BY dgn_numsch ASC"); 
$exec = pg_query($connection, $query);

$return_arr = array();  
while ($row = pg_fetch_assoc($exec)) {
  $row_array['id'] = $row['id'];
  $row_array['value'] = $row['dgn_numsch'];
  $row_array['tpsch'] = $row['dgn_tpsch'];
  $row_array['livello'] = $row['livello'];
  array_push($return_arr,$row_array);
}
echo json_encode($return_arr);

?>