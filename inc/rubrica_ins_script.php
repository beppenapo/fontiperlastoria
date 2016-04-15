<?php
include("db.php");
$nome = pg_escape_string($_POST['nome_ins']);
$tipo_soggetto =$_POST['tipo_ins'];
$comune=$_POST['comune_ins'];
$localita=$_POST['localita_ins'];
$indirizzo=$_POST['indirizzo_ins'];
$tel=pg_escape_string($_POST['tel_ins']);
$cell=pg_escape_string($_POST['cell_ins']);
$fax=pg_escape_string($_POST['fax_ins']);
$mail=pg_escape_string($_POST['mail_ins']);
$web=pg_escape_string($_POST['web_ins']);
$note=pg_escape_string($_POST['note_ins']);
$inserisci = ("
INSERT INTO anagrafica(nome, comune, indirizzo, localita, tel, cell, fax, mail, web, tipo_soggetto, note)
VALUES ('$nome', $comune, $indirizzo, $localita, '$tel', '$cell', '$fax', '$mail', '$web', $tipo_soggetto, '$note');
");
$result = pg_query($connection, $inserisci);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "Il nuovo soggetto è sato inserito in rubrica.";}
?>