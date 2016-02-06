<?php
include("db.php");
//scheda
$dgn_tpsch = $_POST['tpsch'];
$livello = $_POST['livello'];
$dgn_numsch = pg_escape_string($_POST['dgn_numsch']);
$dgn_livind = $_POST['dgn_livind'];
$dgn_dnogg = pg_escape_string($_POST['dgn_dnogg']);
$dgn_note = pg_escape_string($_POST['dgn_note']);
$compilatore = $_POST['compilatore'];
$cmp_id = $_POST['cmp_id'];
$cmp_note = pg_escape_string($_POST['cmp_note']);
$prv_id = $_POST['prv_id'];
$prv_note = pg_escape_string($_POST['prv_note']);
$ana_id = $_POST['ana_id'];
$ana_note = pg_escape_string($_POST['ana_note']);
$scn_id = $_POST['scn_id'];
$scn_note = pg_escape_string($_POST['scn_note']);
$note = pg_escape_string($_POST['note_gen']);
$fine = $_POST['fine'];
$tipoArea = ($dgn_tpsch==10)? 3 : 1 ;
//cronologia
$cro_iniz = $_POST['cro_iniz'];
$cro_fin = $_POST['cro_fin'];
$cro_spec = pg_escape_string($_POST['cro_spec']);
$cro_motiv = $_POST['cro_motiv'];
$cro_note = pg_escape_string($_POST['cro_note']);

//aree_scheda
$areeList = $_POST['areeList'];
$noteAi=pg_escape_string($_POST['noteAi']);
$queryAreeList="";
if($areeList) {
 $areeListTrim = substr($areeList, 0, -1);//tolgo l'ultimo carattere
 $arrayareeList = explode("|", $areeListTrim); //esplodo l'array in corrispondenza del carattere | che divide i valori da salvare
 $c = count($arrayareeList);
 for($z = 0; $z < $c; $z++){
  list($area, $area_motiv) = explode(",", $arrayareeList[$z]);//esplodo il singolo array nei singoli valori
  $queryAreeList .= ("
   INSERT INTO aree_scheda(id_scheda, id_area, id_motivazione, tipo) values (currval('scheda_liv1_id_seq'), $area, $area_motiv, $tipoArea);
  ");
 }
}


//aree_scheda (ubicazione)
$id_area = $_POST['id_area'];
$motiv = $_POST['motiv'];
$id_ubi = $_POST['ana_ubi'];
$id_motivUbi = $_POST['motivubi_update'];
$noteUbi=pg_escape_string($_POST['noteUbi']);

//consultabilita
$consultabilita = pg_escape_string($_POST['consultabilita']);
$orario = pg_escape_string($_POST['orario']);
$servizi = $_POST['servizi'];

//altrif
$schAssoc = $_POST['schAssoc'];
$queryAltrif = '';
if($schAssoc) {
 $schAssocTrim = substr($schAssoc, 0, -1);//tolgo l'ultimo carattere
 $arrayschAssoc = explode("|", $schAssocTrim); //esplodo l'array in corrispondenza del carattere | che divide i valori da salvare
 $c = count($arrayschAssoc);
 for($z = 0; $z < $c; $z++){
  list($tipoSch, $idSchAssoc, $livAltrif) = explode(",", $arrayschAssoc[$z]);//esplodo il singolo array nei singoli valori
  $querySelectDgn_numsch = "SELECT dgn_numsch FROM scheda WHERE id = $tipoSch";
  $r_numsch = pg_query($connection, $querySelectDgn_numsch);
  $a_numsch = pg_fetch_array($r_numsch, 0, PGSQL_ASSOC);
  $queryAltrif .= ("
   INSERT INTO altrif(scheda,numsch,tpsch,livello,scheda_altrif,numsch_altrif,tpsch_altrif,livello_altrif)
   VALUES($tipoSch,'".$a_numsch['dgn_numsch']."', $idSchAssoc, $livAltrif , currval('scheda_liv1_id_seq'), '$dgn_numsch', $dgn_tpsch, $livello);
  ");
 }
}

//creo il riferimento per le tabelle specifiche
$tab='';
switch ($dgn_tpsch) {
 case 1: $tab = "fonti_orali"; break;
 case 2: $tab = "materiali"; break;
 case 4: $tab = "archivi"; break;
 case 5: $tab = "biblio"; break;
 case 6: $tab = "archeo"; break;
 case 7: $tab = "foto"; break;
 case 8: $tab = "fonti_archtt"; break;
 case 9: $tab = "beni_stoart"; break;
 case 10: $tab = "cartografia"; break;
}

$insert1=("
BEGIN;
INSERT INTO scheda(dgn_tpsch, livello, dgn_numsch, dgn_livind, dgn_dnogg, dgn_note, compilatore, cmp_id, cmp_note, prv_id, prv_note, ana_id, ana_note, scn_id, scn_note, note,noteai,noteubi, fine)
VALUES ($dgn_tpsch, $livello, '$dgn_numsch', $dgn_livind, '$dgn_dnogg', '$dgn_note', $compilatore, $cmp_id, '$cmp_note', $prv_id, '$prv_note', $ana_id, '$ana_note', $scn_id, '$scn_note', '$note', '$noteAi','$noteUbi',$fine);

INSERT INTO cronologia(id_scheda, cro_iniz, cro_fin, cro_spec, cro_motiv, cro_note)
VALUES (currval('scheda_liv1_id_seq'), $cro_iniz, $cro_fin, '$cro_spec', $cro_motiv, '$cro_note');

INSERT INTO aree_scheda(id_scheda, id_area, id_motivazione,tipo) values (currval('scheda_liv1_id_seq'), $id_ubi, $id_motivUbi,2);

INSERT INTO consultabilita(id_scheda, consultabilita, orario, servizi)values(currval('scheda_liv1_id_seq'), '$consultabilita', '$orario', '$servizi');

insert into $tab (id_scheda, dgn_numsch) values (currval('scheda_liv1_id_seq'), '$dgn_numsch');
insert into $tab$livello (id_scheda, dgn_numsch$livello) values (currval('scheda_liv1_id_seq'), '$dgn_numsch');

$queryAltrif
$queryAreeList
COMMIT;
");

$result = pg_query($connection, $insert1);

if(!$result){
  die("Errore nella query: \n" . pg_last_error($connection)."\n".$insert1);
}else{
 $maxId=("select max(id) as id_scheda from scheda;");
 $result = pg_query($connection, $maxId);
 $i=0;
 $max=pg_fetch_array($result, 0, PGSQL_ASSOC);
 $id_scheda = $max['id_scheda'];
?>
<div style='text-align:center;'>
 <h2>Salvataggio avvenuto correttamente!</h2>
 <div class="login2" style="width:98% !important; margin:20px auto 5px;">
  <a href="scheda_archeo.php?id=<?php echo($id_scheda);?>" title="Vai alla pagina della scheda creata">Visualizza scheda creata</a>
 </div>
 <div class="login2" style="width:98% !important; margin:20px auto 5px;">
  <a href="catalogo.php" title="Vai al catalogo schede">Vai al catalogo schede</a>
 </div>
</div>
<?php } ?>
