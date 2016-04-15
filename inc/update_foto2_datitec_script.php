<?php
include("db.php");

$idFoto2=pg_escape_string($_POST['idFoto2']);
$dtc_mattec=pg_escape_string($_POST['foto2_dtc_mattec']);
$dtc_icol=pg_escape_string($_POST['foto2_dtc_icol']);
$dtc_misst=pg_escape_string($_POST['foto2_dtc_misst']);
$dtc_ffile=pg_escape_string($_POST['foto2_dtc_ffile']);
$dtc_misfd=pg_escape_string($_POST['foto2_dtc_misfd']);
$dtc_note=pg_escape_string($_POST['foto2_dtc_note']);
$dtc_presneg=pg_escape_string($_POST['foto2_dtc_presneg']);
$dtc_tpapp=pg_escape_string($_POST['foto2_dtc_tpapp']);
    
$update = ("
BEGIN;
 UPDATE foto2 SET dtc_mattec = '$dtc_mattec', dtc_icol = '$dtc_icol', dtc_misst = '$dtc_misst', dtc_ffile = '$dtc_ffile', dtc_misfd = '$dtc_misfd', dtc_note = '$dtc_note', dtc_presneg = '$dtc_presneg', dtc_tpapp = '$dtc_dtc_tpapp' where id = $idFoto2;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>