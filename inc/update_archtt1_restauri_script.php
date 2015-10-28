<?php
include("db.php");
$idArchtt1=$_POST['idArchtt1'];

$rst_tpint=pg_escape_string($_POST['archtt1_rst_tpint_update']);
$rst_rifar=pg_escape_string($_POST['archtt1_rst_rifar_update']);
$rst_note=pg_escape_string($_POST['archtt1_rst_note_update']);
$update = ("
BEGIN;
 UPDATE  fonti_archtt1 SET rst_tpint='$rst_tpint', rst_rifar='$rst_rifar', rst_note='$rst_note'  where id = $idArchtt1;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>