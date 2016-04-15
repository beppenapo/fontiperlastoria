<?php
include("db.php");
$idMater3=$_POST['idMater3'];    
$segnatura=pg_escape_string($_POST['mater3_segn']);
$update = ("
BEGIN;
 UPDATE materiali3 SET fot_coll='$segnatura' where id = $idMater3;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>

