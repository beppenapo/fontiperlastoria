<?php
include("db.php");
$id                 = $_POST['id'];
$consultabilita_update= pg_escape_string($_POST['consultabilita_update']);
$orario_update= pg_escape_string($_POST['orario_update']);
$servizi= $_POST['servizi'];
$servizi= substr($servizi, 0, -2);

$update = ("
BEGIN;
 UPDATE consultabilita SET consultabilita = '$consultabilita_update', orario = '$orario_update',servizi = '$servizi'
 WHERE id_scheda = $id;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>