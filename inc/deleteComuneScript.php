<?php
include("db.php");
$id = $_POST['id'];
$elimina = ("DELETE from comune WHERE id = $id;");
$result = pg_query($connection, $elimina);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "<div style='text-align:center;'><h2>Il record è stato eliminato</h2></div>";}
?>