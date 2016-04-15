<?php
include("db.php");

$id = $_POST['id_biblio1'];
$tipo_biblio1_update= pg_escape_string($_POST['tipo_biblio1_update']);
$tipo_biblio1_update = nl2br($tipo_biblio1_update);
$tipo_biblio1_descriz_update= pg_escape_string($_POST['tipo_biblio1_descriz_update']);
$tipo_biblio1_descriz_update = nl2br($tipo_biblio1_descriz_update);

$update = ("
BEGIN;
 UPDATE biblio1 SET dsc_tipo = '$tipo_biblio1_update', dsc_dsc='$tipo_biblio1_descriz_update' WHERE id = $id;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>