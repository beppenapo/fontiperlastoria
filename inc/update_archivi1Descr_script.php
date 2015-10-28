<?php
include("db.php");

$id_archivi_update = $_POST['id_archivi_update'];
$id_archivi1_update = $_POST['id_archivi1_update'];
$archiv1_tipo_arch_update = $_POST['archiv1_tipo_arch_update']; //archivi.alt_tipologia
$archiv1_consist_update = pg_escape_string($_POST['archiv1_consist_update']); //archivi.dsc_consist
$archiv1_tipoDoc_update = pg_escape_string($_POST['archiv1_tipoDoc_update']); //archivi1.dsc_tipol
$archiv1_tipoDoc_update= substr($archiv1_tipoDoc_update, 0, -2);
$archiv1FondiSegn_update = pg_escape_string($_POST['archiv1FondiSegn_update']); //archivi.dsc_fondiint
$archiv1_fondi_update = pg_escape_string($_POST['archiv1_fondi_update']); //archivi.dsc_fondi
$archiv1_note_update = pg_escape_string($_POST['archiv1_note_update']); //archivi.dsc_note

$update = ("
BEGIN;
 UPDATE archivi SET alt_tipologia= $archiv1_tipo_arch_update, dsc_consist='$archiv1_consist_update' , dsc_fondiint='$archiv1FondiSegn_update' , dsc_fondi= '$archiv1_fondi_update', dsc_note= '$archiv1_note_update' WHERE id_archivi = $id_archivi_update;
 UPDATE archivi1 SET dsc_tipol='$archiv1_tipoDoc_update' WHERE id= $id_archivi1_update;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>