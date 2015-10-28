<?php
include("db.php");
$id = $_POST['idArchiv3'];
$dsc_data= pg_escape_string($_POST['archiv3_data_update']);
/*$dsc_tpfonte= pg_escape_string($_POST['archiv3_tipo_update']);*/
$dsc_luogo= pg_escape_string($_POST['archiv3_luogo_update']);
$dsc_supp= pg_escape_string($_POST['archiv3_supporto_update']);
$dsc_conten= pg_escape_string($_POST['archiv3_contenuto_update']);
$dsc_dscfis= pg_escape_string($_POST['archiv3_descrizione_update']);
/*$dsc_lingua3= pg_escape_string($_POST['archiv3_lingua_update']);*/
$dsc_note3= pg_escape_string($_POST['archiv3_note_update']);

$dsc_tpfonte= pg_escape_string($_POST['archiv3_tipo_update']);
$dsc_tpfonte= substr($dsc_tpfonte, 0, -2);
$dsc_lingua3= $_POST['archiv3_lingua_update'];
$dsc_lingua3= substr($dsc_lingua3, 0, -2);

$update = ("
BEGIN;
 UPDATE archivi3 set dsc_data = '$dsc_data', dsc_tpfonte = '$dsc_tpfonte', dsc_luogo= '$dsc_luogo', dsc_supp='$dsc_supp', dsc_conten = '$dsc_conten', dsc_dscfis = '$dsc_dscfis', dsc_lingua3 = '$dsc_lingua3', dsc_note3 = '$dsc_note3' where id = $id;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>