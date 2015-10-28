<?php
include("db.php");
$id= $_POST['id'];
$schPar= $_POST['schPar'];
$trim = substr($schPar, 0, -1);
$arrayschPar = explode(",", $trim);
$c = count($arrayschPar);
for($z = 0; $z < $c; $z++){
 //echo ($arrayschPar[$z].'<br/>');
 $queryParente = ("INSERT INTO altrif_parenti(id_scheda,id_parente)VALUES($id, ".$arrayschPar[$z].");");
 $resultParente = pg_query($connection, $queryParente);

} 
if(!$resultParente){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente\n" . pg_last_error($connection));}