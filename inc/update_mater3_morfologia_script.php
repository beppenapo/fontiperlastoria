<?php
include("db.php");
$idMater3=$_POST['idMater3'];    
$dog_catgen3=$_POST['mater3_catgen'];
$dog_catspec3=$_POST['mater3_catspec'];
$mrf_descr3=pg_escape_string($_POST['mater3_mrf_descr3']);
$mrf_modcostr3=pg_escape_string($_POST['mater3_mrf_modcostr3']);
$mrf_modcostr3 = substr($mrf_modcostr3,0,-2);
$mrf_matcost3=pg_escape_string($_POST['mater3_mrf_matcost3']);
$mrf_matcost3 = substr($mrf_matcost3,0,-2);
$mrf_note3=pg_escape_string($_POST['mater3_mrf_note3']);

$update = ("
BEGIN;
 UPDATE materiali3 SET dog_catgen=$dog_catgen3, dog_catspec=$dog_catspec3, mrf_descr3='$mrf_descr3', mrf_modcostr3='$mrf_modcostr3', mrf_matcost3='$mrf_matcost3', mrf_note3='$mrf_note3'  where id = $idMater3;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>

