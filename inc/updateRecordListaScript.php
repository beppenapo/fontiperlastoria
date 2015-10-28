<?php
include("db.php");
$tab = $_POST['tab'];
$id = $_POST['id'];
$def = $_POST['def'];
$def = pg_escape_string($def);
$update = ("UPDATE $tab SET definizione = '$def' WHERE id = $id");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}

?>