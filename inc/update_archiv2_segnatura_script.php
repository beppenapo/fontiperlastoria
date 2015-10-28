<?php
include("db.php");
$id = $_POST['idArchiv2'];
$segnatura = pg_escape_string($_POST['archiv2_segnatura_update']);

$update = ("
BEGIN;
 UPDATE archivi2 set dsc_segnatura2 = '$segnatura' where id = $id;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>