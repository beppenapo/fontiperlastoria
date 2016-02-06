<?php
include("db.php");

$id =$_POST['id'];
$areeList=$_POST['areeList'];
$q = "begin;";
foreach($areeList as $a) {
    $q .= "INSERT INTO aree_scheda(id_scheda, id_area, id_motivazione, tipo) values ($id, ".$a['area'].", ".$a['motiv'].", 1);";
}
$q .= "commit;";
$result = pg_query($connection, $q);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "<div style='text-align:center;'><h2>Modifica completata con successo</h2></div>";}
?>
