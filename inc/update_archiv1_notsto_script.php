<?php
include("db.php");
$id = $_POST['id_archivi1'];
$archiv1_vicarch_update = pg_escape_string($_POST['archiv1_vicarch_update']);
$archiv1_notstonote_update = pg_escape_string($_POST['archiv1_notstonote_update']);

$update = ("
BEGIN;
 UPDATE archivi1 set nst_vicarch = '$archiv1_vicarch_update', nst_oss = '$archiv1_notstonote_update' where id = $id;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>