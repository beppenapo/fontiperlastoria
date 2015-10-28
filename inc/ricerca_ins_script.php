<?php
session_start();
include("db.php");

$denric = pg_escape_string($_POST['denric_ins']);
$respric = pg_escape_string($_POST['respric_ins']);
$enresp = pg_escape_string($_POST['enresp_ins']);
$data = pg_escape_string($_POST['data_ins']);
$hub = $_SESSION['hub'];

$inserisci = ("INSERT INTO ricerca(denric,enresp,respric,data, hub) VALUES ('$denric', '$enresp', '$respric', '$data', $hub);");
$result = pg_query($connection, $inserisci);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "<div style='text-align:center;'><h2>Modifica completata con successo</h2></div>";}
?>
