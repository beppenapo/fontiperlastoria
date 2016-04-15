<?php
include("db.php");
$idMater3=$_POST['idMater3'];    
$denom=pg_escape_string($_POST['mater3_denom']);
$denomnote=pg_escape_string($_POST['mater3_denomnote']);
$update = ("
BEGIN;
 UPDATE materiali3 SET  dnm_denomin='$denom', dnm_note='$denomnote' where id = $idMater3;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>

