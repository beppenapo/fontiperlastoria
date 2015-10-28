<?php
include("db.php");
$newComStato = $_POST['newComStato'];
$newComProv = $_POST['newComProv'];
$newComCom = pg_escape_string($_POST['newComCom']);
$newComCom = strtoupper($newComCom);
$newComCap = $_POST['newComCap'];

$inserisci = ("INSERT INTO comune(stato, provincia, comune, cap) VALUES ($newComStato, $newComProv, '$newComCom', $newComCap);");
$result = pg_query($connection, $inserisci);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "<h2 style='text-align:center;width:100%;'>Salvataggio avvenuto correttamente!</h2>";}
?>