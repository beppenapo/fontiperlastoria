<?php
include("db.php");
$id = $_POST['idArchiv3'];
$segnatura = pg_escape_string($_POST['archiv3_segnatura_update']);

$update = ("
BEGIN;
 UPDATE archivi3 set dsc_segnatura3 = '$segnatura' where id = $id;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>