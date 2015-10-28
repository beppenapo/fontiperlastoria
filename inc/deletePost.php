<?php
include("db.php");
$id = $_POST['id'];
$elimina = ("DELETE from post WHERE id = $id;");
$result = pg_query($connection, $elimina);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "Il post è stato eliminato";}
?>
