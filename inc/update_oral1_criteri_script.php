<?php
include("db.php");

$idOral1       = pg_escape_string($_POST['idOral1']);
$dsc_critord   = pg_escape_string($_POST['oral1_dsc_critord']);


$update = ("
BEGIN;
 UPDATE fonti_orali1 SET

    dsc_critord  = '$dsc_critord'

    where id = $idOral1;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
