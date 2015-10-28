<?php
include("db.php");

$id = $_POST['id_biblio2'];
$bib_titolo= pg_escape_string($_POST['bib_titolo']);
$bib_sogg = pg_escape_string($_POST['bib_sogg']);
$bib_nome = pg_escape_string($_POST['bib_nome']);
$bib_notenome = pg_escape_string($_POST['bib_notenome']);
$bib_contenuto= pg_escape_string($_POST['bib_contenuto']);
$bib_livbib= $_POST['bib_livbib'];
$bib_tipodoc= pg_escape_string($_POST['bib_tipodoc']);
$bib_ediz = pg_escape_string($_POST['bib_ediz']);
$bib_period = pg_escape_string($_POST['bib_period']);
$bib_descfis = pg_escape_string($_POST['bib_descfis']);

$bib_lingua= pg_escape_string($_POST['bib_lingua']);
$bib_lingua= substr($bib_lingua, 0, -2);

$bib_notestor = pg_escape_string($_POST['bib_notestor']);

$bib_titolo = nl2br($bib_titolo);
$bib_sogg = nl2br($bib_sogg);
$bib_nome = nl2br($bib_nome);
$bib_notenome = nl2br($bib_notenome);
$bib_contenuto= nl2br($bib_contenuto);
$bib_tipodoc = nl2br($bib_tipodoc);
$bib_ediz = nl2br($bib_ediz);
$bib_period = nl2br($bib_period);
$bib_descfis = nl2br($bib_descfis);
$bib_lingua = nl2br($bib_lingua);
$bib_notestor = nl2br($bib_notestor);
  
$update = ("
BEGIN;
UPDATE biblio2 SET bib_titolo='$bib_titolo', bib_sogg='$bib_sogg',  bib_nome='$bib_nome', bib_notenome='$bib_notenome', bib_contenuto='$bib_contenuto', bib_livbib=$bib_livbib, bib_tipodoc='$bib_tipodoc', bib_ediz='$bib_ediz', bib_period='$bib_period', bib_descfis='$bib_descfis', bib_lingua='$bib_lingua', bib_notestor='$bib_notestor' WHERE id_biblio2 = $id;
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}

?>