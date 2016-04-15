<?php
include("db.php");

$idScheda = $_POST['id'];
$idAggregato = $_POST['aggregato'];

$update = ("
BEGIN;
 insert into archivi_collegati(scheda,aggregato,aggregante)values($idScheda, $idAggregato, 0);
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>