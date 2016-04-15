<?php
include("db.php");

$id = $_POST['id'];
$aggregati = $_POST['v'];

$aggregatiTrim = substr($aggregati, 0, -1); //tolgo l'ultimo carattere |
$arrayaggregati = explode("|", $aggregatiTrim);
$d = count($arrayaggregati);

 for($k = 0; $k < $d; $k++){
  $a = $arrayaggregati[$k];
  $query = ("
    delete from archivi_collegati where scheda = $id AND aggregato = $a;
  ");
  $result = pg_query($connection, $query);
 }

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>