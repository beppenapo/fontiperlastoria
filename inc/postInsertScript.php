<?php
include("db.php");
$usr = $_POST['usr'];
$post = pg_escape_string($_POST['post']);
$titolo = pg_escape_string($_POST['titoloPost']);

$inserisci = ("INSERT INTO post(utente, titolo, testo) VALUES ($usr,'$titolo', '$post');");
$result = pg_query($connection, $inserisci);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "<h2 style='text-align:center;width:100%;'>Salvataggio avvenuto correttamente!</h2>";}
?>
