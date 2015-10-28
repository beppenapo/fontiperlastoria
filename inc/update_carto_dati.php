<?php
require("db.php");

$id = $_POST['idScheda'];
$supporto = pg_escape_string($_POST['supporto']);
$colore = $_POST['colore'];
$misura = pg_escape_string($_POST['misura']);
$scala = pg_escape_string($_POST['scala']);
  
$update = ("
BEGIN;
 UPDATE cartografia2 
 SET supporto = '$supporto',
     colore = $colore,
     misura = '$misura',
     scala = '$scala'
 WHERE id_scheda = $id;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>
