<?php
include("db.php");
$nome = $_POST['n'];
$arr = $_POST['a'];
$query;
$query .= "BEGIN;";
$query .= "insert into aree_carto(nome) values('$nome');";
foreach($arr as $k) {
  $query .= "insert into aree(nome_area, id_comune, id_localita,tipo) values(currval('aree_carto_id_seq'), ".$k['com'].", ".$k['loc'].", 3);";
}
$query .= "COMMIT;";

$r = pg_query($connection, $query);
if(!$r){
    die('errore nella query\n'. pg_last_error($connection));
}else{
    echo "ok, area correttamente inserita";
}
?>
