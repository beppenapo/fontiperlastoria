<?php
include("db.php");
$idArchtt2=$_POST['idArchtt2'];

$cat_stornap=pg_escape_string($_POST['archtt2_cat_stornap_update']);
$cat_storasb=pg_escape_string($_POST['archtt2_cat_storasb_update']);

$update = ("
BEGIN;
 UPDATE  fonti_archtt2 SET cat_stornap='$cat_stornap', cat_storasb='$cat_storasb'  where id = $idArchtt2;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>