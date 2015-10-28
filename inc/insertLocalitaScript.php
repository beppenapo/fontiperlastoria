<?php
include("db.php");
$newCom = $_POST['newCom'];
$newLoc = pg_escape_string($_POST['newLoc']);

$inserisci = ("INSERT INTO localita(comune, localita) VALUES ($newCom, '$newLoc');");
$result = pg_query($connection, $inserisci);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "<h2 style='text-align:center;width:100%;'>Salvataggio avvenuto correttamente!</h2>";}
?>