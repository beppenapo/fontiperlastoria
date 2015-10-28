<?php
include("db.php");

$id =$_POST['id'];
$areeList=$_POST['areeList'];

if($areeList) {
  $areeListTrim = substr($areeList, 0, -1);//tolgo l'ultimo carattere
  $arrayareeList = explode("|", $areeListTrim); //esplodo l'array in corrispondenza del carattere | che divide i valori da salvare
  $c = count($arrayareeList);
   for($z = 0; $z < $c; $z++){
    list($area, $area_motiv) = explode(",", $arrayareeList[$z]);//esplodo il singolo array nei singoli valori
    $queryAreeList = ("
     BEGIN;
     INSERT INTO aree_scheda(id_scheda, id_area, id_motivazione) values ($id, $area, $area_motiv);
     COMMIT;
    ");
    $result = pg_query($connection, $queryAreeList);
  }
 }

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{echo "<div style='text-align:center;'><h2>Modifica completata con successo</h2></div>";}
?>