<?php
include("db.php");
$id = $_POST['idUpdate']; 
$denric = pg_escape_string($_POST['denric']);
$enresp = pg_escape_string($_POST['enresp']); 
$respric = pg_escape_string($_POST['respric']);
$redattore = pg_escape_string($_POST['redattore']);
$data = pg_escape_string($_POST['data']);
$update = ("
BEGIN;
 UPDATE ricerca SET denric = '$denric', enresp = '$enresp', respric = '$respric',redattore='$redattore', data='$data' WHERE id = $id;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>