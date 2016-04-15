<?php
include("db.php");

$idFoto2=pg_escape_string($_POST['idFoto2']);
$sog_notestor=pg_escape_string($_POST['foto2_sog_notestor']);
$sog_notstooss=pg_escape_string($_POST['foto2_sog_notstooss']);
    
$update = ("
BEGIN;
 UPDATE foto2 SET sog_notestor = '$sog_notestor', sog_notstooss = '$sog_notstooss' where id = $idFoto2;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>
