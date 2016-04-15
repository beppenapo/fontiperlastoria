<?php
include("db.php");

$id = $_POST['id'];
$id_archeo = $_POST['id_archeo'];
$descr_sito2=pg_escape_string($_POST['descr_sito2']);
$ind_rif_sito2 =pg_escape_string($_POST['ind_rif_sito2']);
$ind_note_sito2 =pg_escape_string($_POST['ind_note_sito2']);
$tipo_sito_update = $_POST['tipo_sito_update'];	

$update = ("
BEGIN;
 UPDATE archeo SET sit_descr = '$descr_sito2', sit_matdata = '$ind_rif_sito2', sit_note ='$ind_note_sito2', 
sit_tipol = $tipo_sito_update WHERE id_scheda = $id AND id_archeo=$id_archeo;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>
