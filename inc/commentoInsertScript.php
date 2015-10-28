<?php
include("db.php");
$usr = $_POST['idUsr'];
$post = $_POST['idPost'];
$commento = pg_escape_string($_POST['commento']);

$inserisci = ("INSERT INTO commenti(utente, id_post, testo) VALUES ($usr,$post, '$commento');");
$result = pg_query($connection, $inserisci);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "<h2 style='text-align:center;width:100%;'>Salvataggio avvenuto correttamente!</h2>";}
?>
