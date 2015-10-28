<?php
include("db.php");
$id=$_POST['id'];   
$idMater3 = $_POST['idMater3']; 
$infrastrutture=pg_escape_string($_POST['infrastrutture']);
$rpp_note=pg_escape_string($_POST['mater3_rpp_note']);
if($infrastrutture) {
$trim = substr($infrastrutture, 0, -1); //tolgo l'ultimo carattere |
$array = explode("|", $trim);
$a = count($array);
 for($x = 0; $x < $a; $x++){
  list($add, $rapp) = explode(",", $array[$x]);
  $queryInfr = ("
    begin;
    insert into mater_infrastrutture (scheda, collegata, rapporto) values ($id, $add, $rapp);
    commit;
  ");
  $resultInfr = pg_query($connection, $queryInfr);
 }
}


$update = ("
BEGIN;
 UPDATE materiali3 SET rpp_note='$rpp_note' where id = $idMater3;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>

