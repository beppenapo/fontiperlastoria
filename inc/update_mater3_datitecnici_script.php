<?php
include("db.php");
$idMater3=$_POST['idMater3'];    
$dtc_dim=pg_escape_string($_POST['mater3_dtc_dim']);
$dtc_quote=pg_escape_string($_POST['mater3_dtc_quote']);
$dtc_note=pg_escape_string($_POST['mater3_dtc_note']);

$update = ("
BEGIN;
 UPDATE materiali3 SET dtc_dim='$dtc_dim', dtc_quote='$dtc_quote', dtc_note='$dtc_note'  where id = $idMater3;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>

