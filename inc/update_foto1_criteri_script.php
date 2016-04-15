<?php
include("db.php");

$idFoto1=pg_escape_string($_POST['idFoto1']);
$dsc_critord=pg_escape_string($_POST['foto1_dsc_critord']);
    
$update = ("
BEGIN;
 UPDATE foto1 SET dsc_critord = '$dsc_critord' where id = $idFoto1;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>