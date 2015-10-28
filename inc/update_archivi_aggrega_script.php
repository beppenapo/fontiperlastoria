<?php
include("db.php");

$idScheda = $_POST['id'];
$idAggrega = $_POST['aggrega'];

$update = ("
BEGIN;
 insert into archivi_collegati(scheda,aggregato,aggregante)values($idScheda, 0, $idAggrega);
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>