<?php
include("db.php");

$id = $_POST['id_biblio1'];
$biblio1_notsto_update= pg_escape_string($_POST['biblio1_notsto_update']);
$biblio1_notsto_update = nl2br($biblio1_notsto_update);
$biblio1_ossbiblio_update= pg_escape_string($_POST['biblio1_ossbiblio_update']);
$biblio1_ossbiblio_update = nl2br($biblio1_ossbiblio_update);
  
$update = ("
BEGIN;
 UPDATE biblio1 SET dsc_notsto = '$biblio1_notsto_update', nst_ossbiblio='$biblio1_ossbiblio_update' WHERE id = $id;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>