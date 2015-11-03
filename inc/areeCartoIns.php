<?php
include("db.php");
$nome = $_POST['n'];
$arr = $_POST['a'];
foreach($arr as $k) {
  echo "insert into aree(nome, id_comune, id_localita) values(\"$nome\", ".$k['com'].", ".$k['loc'].");<br/>";
}
/*$query = ("
 BEGIN;
 INSERT INTO aree(id_localita, id_comune, id_indirizzo, tipo, id_rubrica) values ($localita, $comune, $indirizzo, $tipo, $rubrica);
 COMMIT;
");*/
?>
