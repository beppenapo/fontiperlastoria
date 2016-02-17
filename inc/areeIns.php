<?php
include("db.php");
$tipo = $_POST['tipo'];
$nome = $_POST['nome'];
$comune = $_POST['comune'];
$arr = $_POST['localita'];
$ana = $_POST['rubrica'];
$ind = $_POST['indirizzo'];
$query;
$query .= "BEGIN;";
$query .= "insert into area(nome, tipo) values('$nome', $tipo);";
if($tipo==2){
    $query .= "insert into aree(nome_area, id_comune, id_rubrica, id_indirizzo) values(currval('aree_carto_id_seq'), ".$comune.", ".$ana.", ".$ind.");";
}else{
    foreach($arr as $k) { $query .= "insert into aree(nome_area, id_comune, id_localita) values(currval('aree_carto_id_seq'), ".$k['com'].", ".$k['loc'].");"; }
}
$query .= "COMMIT;";

$r = pg_query($connection, $query);
if(!$r){
    die('errore nella query\n'. pg_last_error($connection));
}else{
    echo "ok, area correttamente inserita";
}
?>
