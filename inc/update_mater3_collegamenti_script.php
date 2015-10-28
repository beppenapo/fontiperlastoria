<?php
include("db.php");
$idMater3=$_POST['idMater3'];    
$cll_lgattr3=pg_escape_string($_POST['mater3_cll_lgattr3']);
$cll_lgattr3= substr($cll_lgattr3,0,-2);
$cll_lgecon3=pg_escape_string($_POST['mater3_cll_lgecon3']);
$cll_lgecon3= substr($cll_lgecon3,0,-2);
$cll_infcompl3=pg_escape_string($_POST['mater3_cll_infcompl3']);
$cll_infcompl3= substr($cll_infcompl3,0,-2);
$cll_note=pg_escape_string($_POST['mater3_cll_note']);

$update = ("
BEGIN;
 UPDATE materiali3 SET cll_lgattr3='$cll_lgattr3', cll_lgecon3='$cll_lgecon3', cll_infcompl3='$cll_infcompl3', cll_note='$cll_note' where id = $idMater3;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>

