<?php
include("db.php");
$id = $_POST['id'];
$elimina = ("DELETE from commenti WHERE id = $id;");
$result = pg_query($connection, $elimina);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "Il commento è stato eliminato";}
?>
