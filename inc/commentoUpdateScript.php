<?php
include("db.php");
$id = $_POST['modIdComm'];
$commento = pg_escape_string($_POST['modCommTesto']);

$aggiorna = ("UPDATE commenti SET testo = '$commento' WHERE id=$id;");
$result = pg_query($connection, $aggiorna);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "Il commento è stato aggiornato!";}
?>
