<?php
include("db.php");
$idMater2=pg_escape_string($_POST['idMater2']);    
$dog_catgen=pg_escape_string($_POST['mater2_dog_catgen']);
$dtp_morf=pg_escape_string($_POST['mater2_dtp_morf']);
$dtp_morfnote=pg_escape_string($_POST['mater2_dtp_morfnote']);
$dtp_uso=pg_escape_string($_POST['mater2_dtp_uso']);
$dtp_usonote=pg_escape_string($_POST['mater2_dtp_usonote']);
$dog_catspec=pg_escape_string($_POST['mater2_dog_catspec']);
$dtp_cta=pg_escape_string($_POST['mater2_dtp_cta']);
$dtp_ctanote=pg_escape_string($_POST['mater2_dtp_ctanote']);
$dtp_crntipo=pg_escape_string($_POST['mater2_dtp_crntipo']);
$dtp_num=pg_escape_string($_POST['mater2_dtp_num']);
$dtp_note=pg_escape_string($_POST['mater2_dtp_note']);

$update = ("
BEGIN;
 UPDATE materiali2 SET dog_catgen='$dog_catgen', dtp_morf='$dtp_morf', dtp_morfnote='$dtp_morfnote', dtp_uso='$dtp_uso', dtp_usonote='$dtp_usonote', dog_catspec='$dog_catspec', dtp_cta='$dtp_cta', dtp_ctanote='$dtp_ctanote', dtp_crntipo='$dtp_crntipo', dtp_num='$dtp_num', dtp_note='$dtp_note' where id = $idMater2;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>

