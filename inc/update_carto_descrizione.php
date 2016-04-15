<?php
require("db.php");

$id = $_POST['idScheda'];
$titolo = pg_escape_string($_POST['titolo']);
$istituto = pg_escape_string($_POST['istituto']);
$soggetto = pg_escape_string($_POST['soggetto']);
$autore = pg_escape_string($_POST['autore']);
$elementi = pg_escape_string($_POST['elementi']);
$note = pg_escape_string($_POST['note']);
$update = ("
BEGIN;
 UPDATE cartografia2 
 SET titolo = '$titolo'
   , istituto = '$istituto'
   , soggetto = '$soggetto'
   , autore = '$autore'
   , elem_interesse = '$elementi'
   , note = '$note' 
 WHERE id_scheda = $id;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>
