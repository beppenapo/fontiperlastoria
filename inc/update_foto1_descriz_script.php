<?php
include("db.php");

$idFoto1=pg_escape_string($_POST['idFoto1']);
$crc_tipo=pg_escape_string($_POST['foto1_crc_tipo']);
$crc_con=pg_escape_string($_POST['foto1_crc_con']);
$crc_car=pg_escape_string($_POST['foto1_crc_car']);
$crc_elemint=pg_escape_string($_POST['foto1_crc_elemint']);
$crc_note=pg_escape_string($_POST['foto1_crc_note']);
    
$update = ("
BEGIN;
 UPDATE foto1 SET crc_tipo = '$crc_tipo', crc_con='$crc_con', crc_car='$crc_car', crc_elemint='$crc_elemint', crc_note='$crc_note' where id = $idFoto1;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>