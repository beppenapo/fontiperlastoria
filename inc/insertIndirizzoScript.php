<?php
include("db.php");
$newCom = $_POST['newCom'];
$newInd = pg_escape_string($_POST['newInd']);
$newInd = strtoupper($newInd);
$newCap = $_POST['newCap'];
if(!$newCap) {$newCap = 0;}

$inserisci = ("INSERT INTO indirizzo(comune, indirizzo, cap) VALUES ($newCom, '$newInd', $newCap);");
$result = pg_query($connection, $inserisci);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "<h2 style='text-align:center;width:100%;'>Salvataggio avvenuto correttamente!</h2>";}
?>