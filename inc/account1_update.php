<?php
include("db.php");

$id = $_POST['id'];
$cognome= pg_escape_string($_POST['cognome']);
$nome= pg_escape_string($_POST['nome']);
$email= pg_escape_string($_POST['email']);

$update = ("
BEGIN;
UPDATE usr SET nome='$nome', cognome='$cognome', email='$email'
WHERE id_user = $id;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("<h1>Salvataggio avvenuto correttamente.</h1><br/>Le modifiche effettuate sarranno attive al prossimo login!<br/>" . pg_last_error($connection));}
?>

