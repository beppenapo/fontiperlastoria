<?php
require("db.php");
$id=$_POST['id'];
$tipo=$_POST['tipo'];
$nome=pg_escape_string($_POST['nome']);
$arrNew=$_POST['arrNew'];
$arrDel=$_POST['arrDel'];
foreach($arrNew as $a) {
    if($a == 0){$add = '';}
    else{$add .= "insert into aree(nome_area, id_comune, id_localita) values(".$id.", ".$a['com'].", ".$a['loc'].");";}
}
foreach($arrDel as $b) {
    if($b == 0){$del = '';}
    else{$add .= "delete from aree where id = $b;";}
}
$update = ("
BEGIN;
update area set nome = '$nome', tipo = $tipo where id = $id;
$add
$del 
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>