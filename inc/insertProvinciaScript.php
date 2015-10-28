<?php
include("db.php");
$newStato = $_POST['newStato'];
$newProv = $_POST['newProv'];
$newProv = pg_escape_string($newProv);

$inserisci = ("INSERT INTO provincia(stato, provincia) VALUES ($newStato, '$newProv');");
$result = pg_query($connection, $inserisci);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "<div style='text-align:center;'><h2>Modifica completata con successo</h2></div>";}
?>