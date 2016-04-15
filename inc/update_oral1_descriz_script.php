<?php
include("db.php");

$idOral1        = pg_escape_string($_POST['idOral1']);
$dsc_tipoarch   = pg_escape_string($_POST['oral1_dsc_tipoarch']);
$dsc_numint     = pg_escape_string($_POST['oral1_dsc_numint']);
$dsc_numinf     = pg_escape_string($_POST['oral1_dsc_numinf']);
$dsc_cararch    = pg_escape_string($_POST['oral1_dsc_cararch']);
$dsc_sched      = pg_escape_string($_POST['oral1_dsc_sched']);
$dsc_trascr     = pg_escape_string($_POST['oral1_dsc_trascr']);
$dsc_indic      = pg_escape_string($_POST['oral1_dsc_indic']);
$dsc_matint     = pg_escape_string($_POST['oral1_dsc_matint']);
$dsc_oss        = pg_escape_string($_POST['oral1_dsc_oss']);

$update = ("
BEGIN;
 UPDATE fonti_orali1 SET

    dsc_tipoarch   = '$dsc_tipoarch',
    dsc_numint     = '$dsc_numint',
    dsc_numinf     = '$dsc_numinf',
    dsc_cararch    = '$dsc_cararch',
    dsc_sched      = '$dsc_sched',
    dsc_trascr     = '$dsc_trascr',
    dsc_indic      = '$dsc_indic',
    dsc_matint     = '$dsc_matint',
    dsc_oss        = '$dsc_oss'

    where id = $idOral1;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
