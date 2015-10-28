<?php
include("db.php");
$cognome = pg_escape_string($_POST['cognome']);
$nome = pg_escape_string($_POST['nome']);
$email = pg_escape_string($_POST['email']);
$password = pg_escape_string($_POST['password']);
$username = pg_escape_string($_POST['username']);
$tipo = pg_escape_string($_POST['tipo']);
$stato = pg_escape_string($_POST['stato']);
$schede = pg_escape_string($_POST['schede']);

$inserisci = ("
INSERT INTO usr(cognome, nome, email,username, pwd, tipo, attivo, schede)
VALUES ('$cognome', '$nome', '$email','$username', '$password', $tipo, $stato, '$schede');
");
$result = pg_query($connection, $inserisci);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "<div style='text-align:center;'><h2>Modifica completata con successo</h2></div>";}
?>