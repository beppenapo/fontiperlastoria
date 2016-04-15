<?php
include("db.php");

$idFoto2=pg_escape_string($_POST['idFoto2']);
$fot_collocazione=pg_escape_string($_POST['foto2_fot_collocazione']);
    
$update = ("
BEGIN;
 UPDATE foto2 SET fot_collocazione = '$fot_collocazione' where id = $idFoto2;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>