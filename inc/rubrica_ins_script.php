<?php
include("db.php");
$nome = pg_escape_string($_POST['nome_ins']);
$tipo_soggetto =$_POST['tipo_ins'];
$comune=$_POST['comune_ins'];
$localita=$_POST['localita_ins'];
$indirizzo=$_POST['indirizzo_ins'];
$tel=$_POST['tel_ins'];
$cell=$_POST['cell_ins'];
$fax=$_POST['fax_ins'];
$mail=$_POST['mail_ins'];
$web=$_POST['web_ins'];
$note=pg_escape_string($_POST['note_ins']);

$inserisci = ("
INSERT INTO anagrafica(nome, comune, indirizzo, localita, tel, cell, fax, mail, web, tipo_soggetto, note)
VALUES ('$nome', $comune, $indirizzo, $localita, '$tel', '$cell', '$fax', '$mail', '$web', $tipo_soggetto, '$note');
");
$result = pg_query($connection, $inserisci);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "<div style='text-align:center;'><h2>Modifica completata con successo</h2></div>";}
?>