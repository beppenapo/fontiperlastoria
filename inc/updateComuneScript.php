<?php
include("db.php");
$idStato = $_POST['idStato'];
$idProv = $_POST['idProvincia'];
$idCom = $_POST['idCom'];
$comune = pg_escape_string($_POST['comune']);
$comune = strtoupper($comune);
$cap = $_POST['cap'];


$update = ("UPDATE comune SET stato = $idStato, provincia = $idProv, comune = '$comune', cap = $cap WHERE id = $idCom");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "<div style='text-align:center;'><h2>Modifica completata con successo</h2></div>";}
?>