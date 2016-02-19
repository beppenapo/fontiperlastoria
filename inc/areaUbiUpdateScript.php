<?php
require("db.php");
$update = ("
BEGIN;
update area set nome = '".pg_escape_string($_POST['area'])."' where id = ".$_POST['id'].";
update aree set id_comune = ".$_POST['comune'].", id_indirizzo = ".$_POST['indirizzo'].", id_rubrica = ".$_POST['rubrica']." where nome_area = ".$_POST['id'].";
COMMIT;
");
$result = pg_query($connection, $update);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>
