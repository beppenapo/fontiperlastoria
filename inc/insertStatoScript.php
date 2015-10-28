<?php
include("db.php");
$newDef = $_POST['newDef'];
$newDef = pg_escape_string($newDef);
$inserisci = ("INSERT INTO stato(stato) VALUES ('$newDef');");
$result = pg_query($connection, $inserisci);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "<div style='text-align:center;'><h2>Inseriento avvenuto correttamente</h2></div>";
}
?>