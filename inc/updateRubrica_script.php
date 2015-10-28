<?php
include("db.php");
$idUpdate = $_POST['idUpdate'];
$nome_update = pg_escape_string($_POST['nome_update']);
$comune_update = $_POST['comune_update'];
$localita_update = $_POST['localita_update'];
$indirizzo_update = $_POST['indirizzo_update'];
$tel_update = $_POST['tel_update'];
$cell_update = $_POST['cell_update'];
$fax_update = $_POST['fax_update'];
$mail_update = $_POST['mail_update'];
$web_update = $_POST['web_update'];
$note_update = pg_escape_string($_POST['note_update']);
$tipo_update = $_POST['tipo_update'];

$update = ("
BEGIN;
 UPDATE public.anagrafica
 SET nome='$nome_update', comune=$comune_update, indirizzo=$indirizzo_update, localita=$localita_update, tel='$tel_update', cell='$cell_update', fax='$fax_update', mail='$mail_update', web='$web_update', tipo_soggetto=$tipo_update, note='$note_update'
 WHERE id=$idUpdate;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>