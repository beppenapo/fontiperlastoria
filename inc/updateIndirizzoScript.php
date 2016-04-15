<?php
include("db.php");
$id = $_POST['id'];
$indirizzo = pg_escape_string($_POST['indirizzo']);
$indirizzo = strtoupper($indirizzo);
$cap = $_POST['cap'];
$comune = $_POST['comune'];

$update = ("UPDATE indirizzo SET indirizzo = '$indirizzo', comune = $comune, cap= $cap WHERE id = $id");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "<div style='text-align:center;'><h2>Modifica completata con successo</h2></div>";}

?>