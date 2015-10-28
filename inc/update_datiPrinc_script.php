<?php
include("db.php");
$id = $_POST['id'];
$num_sch_update = pg_escape_string(stripslashes($_POST['num_sch_update']));
$tpsch_update   = pg_escape_string(stripslashes($_POST['tpsch_update']));
$def_ogg_update = pg_escape_string(stripslashes($_POST['def_ogg_update']));
$crospec_update = pg_escape_string(stripslashes($_POST['crospec_update']));
$livind_update  = pg_escape_string(stripslashes($_POST['livind_update']));
$schnote_update = pg_escape_string(stripslashes($_POST['schnote_update']));

$update = ("
BEGIN;
 UPDATE scheda SET dgn_numsch = '$num_sch_update', dgn_tpsch = $tpsch_update, dgn_dnogg='$def_ogg_update', dgn_livind = $livind_update, dgn_note = '$schnote_update' WHERE id = $id ;

 UPDATE cronologia SET cro_spec = '$crospec_update' WHERE id_scheda = $id ;

COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>
