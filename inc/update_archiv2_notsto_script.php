<?php
include("db.php");
$id = $_POST['idArchiv2'];
$nstfondo = pg_escape_string($_POST['archiv2_nstfondo_update']);
$ossfondo = pg_escape_string($_POST['archiv2_ossfondo_update']);

$update = ("
BEGIN;
 UPDATE archivi2 set nst_fondo = '$nstfondo', nst_ossfondo = '$ossfondo' where id = $id;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>