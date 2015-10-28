<?php
include("db.php");
$idMater3=$_POST['idMater3'];    
$cta_vcoltatt=pg_escape_string($_POST['mater3_cta_vcoltatt']);
$cta_vcoltpass=pg_escape_string($_POST['mater3_cta_vcoltpass']);
$cta_fscalt3=pg_escape_string($_POST['mater3_cta_fscalt3']);
$cta_fscalt3=substr($cta_fscalt3,0,-2);
$cta_veg=pg_escape_string($_POST['mater3_cta_veg']);
$cta_note=pg_escape_string($_POST['mater3_cta_note']);

$update = ("
BEGIN;
 UPDATE materiali3 SET cta_vcoltatt='$cta_vcoltatt', cta_vcoltpass='$cta_vcoltpass', cta_fscalt3='$cta_fscalt3', cta_veg='$cta_veg', cta_note='$cta_note' where id = $idMater3;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>

