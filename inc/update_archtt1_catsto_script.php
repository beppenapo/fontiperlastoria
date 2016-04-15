<?php
include("db.php");
$idArchtt1=$_POST['idArchtt1'];

$cat_stornap=pg_escape_string($_POST['archtt1_cat_stornap_update']);
$cat_storasb=pg_escape_string($_POST['archtt1_cat_storasb_update']);

$update = ("
BEGIN;
 UPDATE  fonti_archtt1 SET cat_stornap='$cat_stornap', cat_storasb='$cat_storasb'  where id = $idArchtt1;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>