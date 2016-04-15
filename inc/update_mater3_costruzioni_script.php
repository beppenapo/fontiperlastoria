<?php
include("db.php");
$idMater3=$_POST['idMater3'];    
$cst_commnome=pg_escape_string($_POST['mater3_cst_commnome']);
$cst_esecnome=pg_escape_string($_POST['mater3_cst_esecnome']);
$cst_commfnt=$_POST['mater3_cst_commfnt'];
$cst_commdat=pg_escape_string($_POST['mater3_cst_commdat']);
$cst_note=pg_escape_string($_POST['mater3_cst_note']);

$update = ("
BEGIN;
 UPDATE materiali3 SET cst_commnome='$cst_commnome', cst_esecnome='$cst_esecnome', cst_commfnt=$cst_commfnt, cst_commdat='$cst_commdat', cst_note='$cst_note'  where id = $idMater3;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>

