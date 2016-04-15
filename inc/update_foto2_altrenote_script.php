<?php
include("db.php");

$idFoto2=pg_escape_string($_POST['idFoto2']);
$alt_note=pg_escape_string($_POST['foto2_alt_note']);
    
$update = ("
BEGIN;
 UPDATE foto2 SET alt_note = '$alt_note' where id = $idFoto2;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>