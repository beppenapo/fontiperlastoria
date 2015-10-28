<?php
include("db.php");

$id = $_POST['id'];
$pwd= pg_escape_string($_POST['pwd']);

$update = ("
BEGIN;
UPDATE usr SET pwd='$pwd'
WHERE id_user = $id;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("<h1>Salvataggio avvenuto correttamente.</h1><br/>Le modifiche effettuate sarranno attive al prossimo login!<br/>" . pg_last_error($connection));}
?>

