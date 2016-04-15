<?php
include("db.php");
$id = $_POST['id'];
$id_archeo = $_POST['id_archeo'];
$archeo2_mis_update= pg_escape_string($_POST['archeo2_mis_update']);
$archeo2_notemis_update= pg_escape_string($_POST['archeo2_notemis_update']);

$update = ("
BEGIN;
 UPDATE archeo SET sit_mis = '$archeo2_mis_update',sit_notemis = '$archeo2_notemis_update' WHERE id_scheda = $id AND id_archeo=$id_archeo;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>
