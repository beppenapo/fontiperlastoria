<?php
include("db.php");
$id = $_POST['id'];
$def = $_POST['def'];
$def = pg_escape_string($def);
$stato = $_POST['stato'];
$update = ("UPDATE provincia SET provincia = '$def', stato = $stato WHERE id = $id");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "<div style='text-align:center;'><h2>Modifica completata con successo</h2></div>";}

?>