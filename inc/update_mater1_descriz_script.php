<?php
include("db.php");

$idMater1=pg_escape_string($_POST['idMater1']);
$dsc_tpfonte=pg_escape_string($_POST['mater1_dsc_tpfonte']);
$dsc_nummanuf=pg_escape_string($_POST['mater1_dsc_nummanuf']);
$dsc_ogg=pg_escape_string($_POST['mater1_dsc_ogg']);
$dsc_catman=pg_escape_string($_POST['mater1_dsc_catman']);
$dsc_catman = substr($dsc_catman,0,-2);
$dsc_contaa=pg_escape_string($_POST['mater1_dsc_contaa']);
$dsc_gradutil=pg_escape_string($_POST['mater1_dsc_gradutil']);
$dsc_oggpreg=pg_escape_string($_POST['mater1_dsc_oggpreg']);
$dsc_oss=pg_escape_string($_POST['mater1_dsc_oss']);
    
$update = ("
BEGIN;
 UPDATE materiali1 SET dsc_tipo_raccolta = $dsc_tpfonte, dsc_nummanuf='$dsc_nummanuf', dsc_ogg='$dsc_ogg', dsc_catman='$dsc_catman', dsc_contaa='$dsc_contaa', dsc_gradutil='$dsc_gradutil', dsc_oggpreg='$dsc_oggpreg', dsc_oss='$dsc_oss' where id = $idMater1;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>