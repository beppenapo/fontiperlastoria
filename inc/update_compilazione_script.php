<?php
include("db.php");
$id                 = $_POST['id'];
$denric_update      = $_POST['denric_update'];
$notecmp_update     = pg_escape_string($_POST['notecmp_update']);

$update = ("
BEGIN;
 UPDATE scheda SET cmp_note = '$notecmp_update', cmp_id = $denric_update WHERE id = $id;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>
