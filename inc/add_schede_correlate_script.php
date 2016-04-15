<?php
include("db.php");
$id_scheda = pg_escape_string($_POST['id']);
$schAssoc= pg_escape_string($_POST['schAssoc']);
if($schAssoc) {
  $qs = "SELECT dgn_numsch, dgn_tpsch, livello FROM scheda WHERE id = $id_scheda";
  $query = pg_query($connection, $qs);
  $scheda = pg_fetch_array($query, 0, PGSQL_ASSOC);
  $schAssocTrim = trim($schAssoc,'|');// substr($schAssoc, 0, -1);//tolgo l'ultimo carattere
  $arrayschAssoc = explode("|", $schAssocTrim); //esplodo l'array in corrispondenza del carattere | che divide i valori da salvare
  $c = count($arrayschAssoc);
  for($z = 0; $z < $c; $z++){
    list($tipoSch, $idSchAssoc, $livAltrif) = explode(",", $arrayschAssoc[$z]);//esplodo il singolo array nei singoli valori
    $querySelectDgn_numsch = "SELECT dgn_numsch FROM scheda WHERE id = $tipoSch";
    $r_numsch = pg_query($connection, $querySelectDgn_numsch);
    $a_numsch = pg_fetch_array($r_numsch, 0, PGSQL_ASSOC);

    $queryAltrif = ("
     BEGIN;
     INSERT INTO altrif(
      scheda,
      numsch,
      tpsch,
      livello,
      scheda_altrif,
      numsch_altrif,
      tpsch_altrif,
      livello_altrif
      )
     VALUES(
       $tipoSch,
       '".$a_numsch['dgn_numsch']."',
       $idSchAssoc,
       $livAltrif ,
       $id_scheda,
       '".$scheda['dgn_numsch']."',
       '".$scheda['dgn_tpsch']."',
       '".$scheda['livello']."'
      );
     COMMIT;
    ");

    $resultAltrif = pg_query($connection, $queryAltrif);
    if(!$resultAltrif){die("Errore nella query: \n" . pg_last_error($connection));}
    else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
  }
 }