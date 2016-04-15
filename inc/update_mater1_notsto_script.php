<?php
include("db.php");

$idMater1=pg_escape_string($_POST['idMater1']);
$dsc_notesto=pg_escape_string($_POST['mater1_dsc_notesto']);
$dsc_notstooss=pg_escape_string($_POST['mater1_dsc_notstooss']);
    
$update = ("
BEGIN;
 UPDATE materiali1 SET dsc_notesto = '$dsc_notesto', dsc_notstooss = '$dsc_notstooss' where id = $idMater1;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>