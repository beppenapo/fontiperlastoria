<?php
include("db.php");
$id = $_POST['id'];
$noteai= pg_escape_string($_POST['noteaiupdate']);
$update = ("BEGIN; UPDATE scheda SET noteai = '$noteai' WHERE id = $id;COMMIT;");
$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>
