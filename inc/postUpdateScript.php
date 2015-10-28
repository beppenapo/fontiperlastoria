<?php
include("db.php");
$id = $_POST['modIdPost'];
$post = pg_escape_string($_POST['modTestoPost']);
$titolo = pg_escape_string($_POST['modTitoloPost']);

$aggiorna = ("UPDATE post SET testo = '$post', titolo = '$titolo' WHERE id=$id;");
$result = pg_query($connection, $aggiorna);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "Il post è stato aggiornato!";}
?>
