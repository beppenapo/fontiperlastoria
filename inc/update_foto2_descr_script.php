<?php
include("db.php");

$idFoto2=pg_escape_string($_POST['idFoto2']);
$sog_titolo=pg_escape_string($_POST['foto2_sog_titolo']);
$sog_autore=pg_escape_string($_POST['foto2_sog_autore']);
$sog_sogg=pg_escape_string($_POST['foto2_sog_sogg']);
$sog_noteaut=pg_escape_string($_POST['foto2_sog_noteaut']);
$sog_note=pg_escape_string($_POST['foto2_sog_note']);

    
$update = ("
BEGIN;
 UPDATE foto2 SET sog_titolo = '$sog_titolo', sog_autore = '$sog_autore', sog_sogg = '$sog_sogg', sog_noteaut = '$sog_noteaut', sog_note = '$sog_note' where id = $idFoto2;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>