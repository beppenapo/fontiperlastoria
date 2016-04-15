<?php
include("db.php");
$id = $_POST['id_archivi1'];
$ord = pg_escape_string($_POST['aou']);
//$ord = nl2br ($ord);
$update = ("
BEGIN;
 UPDATE archivi1 set dsc_crord = '$ord' where id = $id;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>