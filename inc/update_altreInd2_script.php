<?php
include("db.php");

$id = $_POST['id'];
$id_archeo = $_POST['id_archeo'];
$tipo_ind_update = $_POST['tipo_ind_update'];
$ain_data_update= pg_escape_string($_POST['ain_data_update']);
$ain_data_update= nl2br($ain_data_update);
$enresp_update = $_POST['enresp_update'];
$descr2_update= pg_escape_string($_POST['descr2_update']);
$descr2_update= nl2br($descr2_update);
$note1_update= pg_escape_string($_POST['note1_update']);
$note1_update= nl2br($note1_update);

$update = ("
BEGIN;
 UPDATE archeo SET ain_tipo=$tipo_ind_update, ain_data='$ain_data_update', ain_enresp = $enresp_update, ain_descr ='$descr2_update', ain_note = '$note1_update' WHERE id_scheda = $id AND id_archeo=$id_archeo;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>