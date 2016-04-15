<?php
include("db.php");
$id = $_POST['id'];
$denricprv_update= pg_escape_string($_POST['denricprv_update']);
$compilatoreprv_update= pg_escape_string($_POST['compilatoreprv_update']);
$dataprv_update= pg_escape_string($_POST['dataprv_update']);
$enrespprv_update= pg_escape_string($_POST['enrespprv_update']);
$respricprv_update= pg_escape_string($_POST['respricprv_update']);
$noteprv_update= pg_escape_string($_POST['noteprv_update']);

$update = ("
BEGIN;
 UPDATE compilazione SET id_ricerca = $denricprv_update, compilatore = '$compilatoreprv_update', data = '$dataprv_update', note = '$noteprv_update' WHERE id_scheda = $id AND cmp_prv = 2;

 UPDATE scheda SET prv_note = '$noteprv_update', prv_id = '$denricprv_update' WHERE id = $id;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>
