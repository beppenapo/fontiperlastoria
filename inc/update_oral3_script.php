<?php
include("db.php");

$idOral3        = pg_escape_string($_POST['idOral3']);


$dsc_conten3    = pg_escape_string( $_POST['dsc_conten3']);
$dsc_catgen3    = pg_escape_string( $_POST['dsc_catgen3']);
$dan_elstrutt3  = pg_escape_string( $_POST['dan_elstrutt3']);
$dan_incverb3   = pg_escape_string( $_POST['dan_incverb3']);
$dan_trascr3    = pg_escape_string( $_POST['dan_trascr3']);
$dan_motiv3     = pg_escape_string( $_POST['dan_motiv3']);


$update = ("
BEGIN;
 UPDATE fonti_orali3 SET

    dsc_conten3    = '$dsc_conten3',
    dsc_catgen3    = '$dsc_catgen3',
    dan_elstrutt3  = '$dan_elstrutt3',
    dan_incverb3   = '$dan_incverb3',
    dan_trascr3    = '$dan_trascr3',
    dan_motiv3     = '$dan_motiv3'

    where id = $idOral3;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
