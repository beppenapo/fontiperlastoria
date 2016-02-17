<?php
require('db.php');
$ubiList = array();
$anaList = array();
$indList = array();
$a = "select id, nome from anagrafica where comune = ".$_POST['id'];
$b = "select id, indirizzo, cap from indirizzo where comune = ".$_POST['id'];
$aexec = pg_query($connection,$a);
$bexec = pg_query($connection,$b);

while ($ana = pg_fetch_assoc($aexec)) {
    $anaArr['id'] = $ana['id'];
    $anaArr['nome'] = $ana['nome'];
    array_push($anaList,$anaArr);
}
$ubiList['anagrafica'] = $anaList;

while ($ind = pg_fetch_assoc($bexec)) {
    $indArr['id'] = $ind['id'];
    $indArr['indirizzo'] = $ind['indirizzo'];
    $indArr['cap'] = $ind['cap'];
    array_push($indList,$indArr);
}
$ubiList['indirizzi'] = $indList;

echo json_encode($ubiList);
exit();
?>