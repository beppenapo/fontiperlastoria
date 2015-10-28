<?php
include("db.php");

$id_user = $_POST['id_update'];
$cognome= pg_escape_string($_POST['cognome_up']);
$nome= pg_escape_string($_POST['nome_up']);
$email= pg_escape_string($_POST['email_up']);
$password= pg_escape_string($_POST['password_up']);
$username= pg_escape_string($_POST['username_up']);
$tipo= pg_escape_string($_POST['tipo_up']);
$stato= pg_escape_string($_POST['stato_up']);
$schede= pg_escape_string($_POST['schede_up']);
$schede = substr($schede, 0, -2);
$update = ("
BEGIN;
UPDATE usr
SET nome='$nome', cognome='$cognome', email='$email', pwd='$password', username='$username', tipo=$tipo, attivo=$stato, schede='$schede'
WHERE id_user = $id_user;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>

