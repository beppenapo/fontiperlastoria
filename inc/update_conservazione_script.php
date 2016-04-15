<?php
include("db.php");
$id = $_POST['id'];
$scn_update= $_POST['scn_update'];
$scn_note_update= $_POST['scn_note_update'];
$scn_note_update = pg_escape_string($scn_note_update);

$update = ("
BEGIN;
 UPDATE scheda SET scn_id = $scn_update, scn_note = '$scn_note_update' WHERE id = $id;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>