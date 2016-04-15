<?php
include("db.php");
$id = $_POST['id'];
$crospec_update = pg_escape_string($_POST['crospec_update']);
$cro_iniz = $_POST['cro_iniz'];  
$cro_fine = $_POST['cro_fine'];
$cro_motiv_update= $_POST['cro_motiv_update'];
$cronote_update = pg_escape_string($_POST['cronote_update']); 

$update = ("
BEGIN;
 
 UPDATE cronologia SET cro_spec = '$crospec_update', cro_iniz=$cro_iniz, cro_fin=$cro_fine, cro_motiv=$cro_motiv_update, cro_note = '$cronote_update' WHERE id_scheda = $id ;

COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>