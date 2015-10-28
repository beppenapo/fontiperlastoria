<?php
include("db.php");
$idMater3=$_POST['idMater3'];    
$uso_descrfunz=pg_escape_string($_POST['mater3_uso_descrfunz']);
$uso_note=pg_escape_string($_POST['mater3_uso_note']);

$update = ("
BEGIN;
 UPDATE materiali3 SET uso_descrfunz='$uso_descrfunz', uso_note='$uso_note'  where id = $idMater3;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>

