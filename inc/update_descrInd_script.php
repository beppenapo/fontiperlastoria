<?php
include("db.php");

$id = $_POST['id'];
$id_archeo = $_POST['id_archeo'];

$data_update= pg_escape_string($_POST['data_update']);
$rifper_update= pg_escape_string($_POST['rifper_update']);
$metodo_update= $_POST['metodo_update'];
$rifsito_update= pg_escape_string($_POST['rifsito_update']);
$descr_update= pg_escape_string($_POST['descr_update']);
$codsca_update= pg_escape_string($_POST['codsca_update']);
$note_update= pg_escape_string($_POST['note_update']);

$update = ("
BEGIN;
 UPDATE archeo SET ind_data='$data_update', ind_rifper='$rifper_update', ind_met= $metodo_update, ind_rifsito='$rifsito_update', ind_descr='$descr_update', ind_codsca='$codsca_update', ind_note='$note_update' WHERE id_scheda = $id AND id_archeo=$id_archeo;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>
