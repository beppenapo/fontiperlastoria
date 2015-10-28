<?php
include("db.php");
$idArchtt2=$_POST['idArchtt2'];
$dtc_mis=pg_escape_string($_POST['archtt2_dtc_mis_update']);
$dtc_notemis=pg_escape_string($_POST['archtt2_dtc_notemis_update']);

$update = ("
BEGIN;
 UPDATE  fonti_archtt2 SET dtc_mis='$dtc_mis', dtc_notemis='$dtc_notemis'  where id = $idArchtt2;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>