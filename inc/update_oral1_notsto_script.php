<?php
include("db.php");

$idOral1        = pg_escape_string($_POST['idOral1']);
$nsc_vicarch    = pg_escape_string($_POST['oral1_nsc_vicarch']);
$nsc_oss        = pg_escape_string($_POST['oral1_nsc_oss']);


$update = ("
BEGIN;
 UPDATE fonti_orali1 SET

    nsc_vicarch  = '$nsc_vicarch',
    nsc_oss      = '$nsc_oss'

    where id = $idOral1;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
