<?php
include("db.php");
$idMater3=$_POST['idMater3'];    
$cat_stornap=pg_escape_string($_POST['mater3_cat_stornap']);
$cat_storasb=pg_escape_string($_POST['mater3_cat_storasb']);

$update = ("
BEGIN;
 UPDATE materiali3 SET cat_stornap='$cat_stornap', cat_storasb='$cat_storasb' where id = $idMater3;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>

