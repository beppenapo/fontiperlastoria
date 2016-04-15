<?php
include("db.php");
$idMater3=$_POST['idMater3'];    
$isc_descont=pg_escape_string($_POST['mater3_isc_descont']);
$isc_trascr=pg_escape_string($_POST['mater3_isc_trascr']);
$isc_note=pg_escape_string($_POST['mater3_isc_note']);

$update = ("
BEGIN;
 UPDATE materiali3 SET isc_descont='$isc_descont', isc_trascr='$isc_trascr', isc_note='$isc_note' where id = $idMater3;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>

