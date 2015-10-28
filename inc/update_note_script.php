<?php
include("db.php");
$id = $_POST['id'];
$note_gen_update= pg_escape_string($_POST['note_gen']);


$update = ("
BEGIN;
 UPDATE scheda SET note = '$note_gen_update' WHERE id = $id;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>