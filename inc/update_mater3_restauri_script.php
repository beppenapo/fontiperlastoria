<?php
include("db.php");
$idMater3=$_POST['idMater3'];    
$rst_tpint=pg_escape_string($_POST['mater3_rst_tpint']);
$rst_rifar=pg_escape_string($_POST['mater3_rst_rifar']);
$rst_note=pg_escape_string($_POST['mater3_rst_note']);

$update = ("
BEGIN;
 UPDATE materiali3 SET rst_tpint='$rst_tpint', rst_rifar='$rst_rifar', rst_note='$rst_note'  where id = $idMater3;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>

