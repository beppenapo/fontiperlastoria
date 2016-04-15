<?php
include("db.php");

$id = $_POST['id'];
$id_ana = $_POST['id_ana'];
$nome_ana_update= $_POST['nome_ana_update'];
$nome_ana_update = pg_escape_string($nome_ana_update);
$nome_ana_update = nl2br($nome_ana_update);

$comune_ana_update= $_POST['comune_ana_update'];
$localita_ana_update= $_POST['localita_ana_update'];
$indirizzo_ana_update= $_POST['indirizzo_ana_update'];
$tel_ana_update = $_POST['tel_ana_update'];
$mail_ana_update= $_POST['mail_ana_update'];
$web_ana_update= $_POST['web_ana_update'];
$note_ana_update= $_POST['note_ana_update'];
$note_ana_update = pg_escape_string($note_ana_update);

$update = ("
BEGIN;
 UPDATE scheda SET ana_note = '$note_ana_update',  ana_id='$id_ana' WHERE id = $id;
COMMIT;
");

$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("<br>Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>
