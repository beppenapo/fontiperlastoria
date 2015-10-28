<?php
include("db.php");
$id = $_POST['id'];
$qs = "
BEGIN;
DELETE FROM altrif_parenti WHERE id = $id;
COMMIT;
";

$result = pg_query($connection, $qs);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("<br>Eliminazione avvenuta correttamente" . pg_last_error($connection));}
