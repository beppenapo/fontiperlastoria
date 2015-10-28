<?php
include('db.php');
$livello = $_POST['livello_list'];
$tipo = $_POST['tpsch'];
$query = ("
select dgn_numsch 
from scheda 
where dgn_numsch = (select max(dgn_numsch) from scheda where dgn_tpsch = $tipo AND livello = $livello )");
$result = pg_query($connection, $query);
$righe = pg_num_rows($result);

if($righe > 0){
 $row = pg_fetch_array($result);
 $last=$row['dgn_numsch'];
 echo "Ultima scheda presente nel db: $last";
}else {
 echo "Non sono presenti schede di questo tipo";
}

?>