<?php
require('db.php');
$tpsch=$_GET["tpsch"];
$q = strtoupper($_GET["term"]);
$query = ("SELECT id, dgn_numsch FROM scheda where dgn_numsch like '%" . $q . "%'  and dgn_tpsch = $tpsch ORDER BY dgn_numsch ASC"); 
$exec = pg_query($connection, $query);

$return_arr = array();  
while ($row = pg_fetch_assoc($exec)) {
  $row_array['id_parente'] = $row['id'];
  $row_array['value'] = $row['dgn_numsch'];
  array_push($return_arr,$row_array);
}
echo json_encode($return_arr);

?>