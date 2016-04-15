<?php
include("db.php");
$tipo = $_POST['newTipo'];
$comune = $_POST['comune_update'];
$localita = $_POST['localita_update'];
$indirizzo = $_POST['indirizzo_update'];
$rubrica = $_POST['rubrica_update'];
$query = ("
 BEGIN;
 INSERT INTO aree(id_localita, id_comune, id_indirizzo, tipo, id_rubrica) values ($localita, $comune, $indirizzo, $tipo, $rubrica);
 COMMIT;
");
$result = pg_query($connection, $query);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "<div style='text-align:center;'><h2>Modifica completata con successo</h2></div>";}
?>
