<?php
require("db.php");

$id = $_POST['idScheda'];
$collocazione = pg_escape_string($_POST['collocazione']);
  
$update = ("
BEGIN;
 UPDATE cartografia2 SET collocazione = '$collocazione' WHERE id_scheda = $id;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>
