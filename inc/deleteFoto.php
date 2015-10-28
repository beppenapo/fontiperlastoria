<?php
include("db.php");
$id = $_POST['id_scheda'];
$file = $_POST['file'];
$cartella = '../foto/';
$path = $cartella.$file;
$elimina = ("DELETE from file WHERE id_scheda = $id;");
$result = pg_query($connection, $elimina);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{
   unlink($path);
   echo "<div style='text-align:center;'><h2>Il record è stato eliminato</h2></div>";
}
?>