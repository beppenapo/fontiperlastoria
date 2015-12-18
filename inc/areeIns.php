<?php
include("db.php");
$tipo = $_POST['t'];
$nome = $_POST['n'];
$arr = $_POST['a'];
$query;
$query .= "BEGIN;";
$query .= "insert into area(nome, tipo) values('$nome', $tipo);";
foreach($arr as $k) {
  $query .= "insert into aree(nome_area, id_comune, id_localita) values(currval('aree_carto_id_seq'), ".$k['com'].", ".$k['loc'].");";
}
$query .= "COMMIT;";

$r = pg_query($connection, $query);
if(!$r){
    die('errore nella query\n'. pg_last_error($connection));
}else{
    echo "ok, area correttamente inserita";
}
?>
