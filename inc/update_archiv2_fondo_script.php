<?php
include("db.php");
$id = $_POST['idArchiv2'];
$dscfondo = pg_escape_string($_POST['archiv2_dscfondo_update']);
$consist = pg_escape_string($_POST['archiv2_consist_update']);
$tipodoc = pg_escape_string($_POST['archiv2_tipodoc_update']);
$tipodoc= substr($tipodoc, 0, -2);
$lingua = pg_escape_string($_POST['archiv2_lingua_update']);
$lingua= substr($lingua, 0, -2);
$fondonote = pg_escape_string($_POST['archiv2_fondonote_update']);

$update = ("
BEGIN;
 UPDATE archivi2 set dsc_fondo = '$dscfondo', dsc_consist2 = '$consist', dsc_tipol2 = '$tipodoc', dsc_lingua2 = '$lingua', dsc_note2 = '$fondonote' where id = $id;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>