<?php
include("db.php");

$idStoart1        = pg_escape_string($_POST['idStoart1']);

$ins_desc   = pg_escape_string( $_POST['ins_desc']);
$ins_note    = pg_escape_string( $_POST['ins_note']);


$update = ("
BEGIN;
 UPDATE beni_stoart1 SET

    ins_desc   = '$ins_desc',
    ins_note    = '$ins_note'

    where id = $idStoart1;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
