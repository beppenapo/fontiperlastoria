<?php
include("db.php");
$id = $_POST['idUpdate']; 
$comune = $_POST['comuneubi_update'];
$localita = $_POST['localitaubi_update'];
$indirizzo = $_POST['indirizzoubi_update'];
$rubrica = $_POST['rubrica_up'];
$tipo = $_POST['tipo_update'];

$update = ("
BEGIN;
 UPDATE aree SET id_localita=$localita, id_comune=$comune, id_indirizzo=$indirizzo, tipo=$tipo, id_rubrica=$rubrica WHERE id = $id;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>