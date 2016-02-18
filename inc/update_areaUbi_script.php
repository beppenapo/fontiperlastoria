<?php
include("db.php");
$id = $_POST['id'];
$old_ubi= $_POST['old_ubi'];
$area_update= $_POST['area_update'];
$motiv_update= $_POST['motiv_update'];
$noteUbiUpdate=pg_escape_string($_POST['noteUbiUpdate']);
$update ="BEGIN;
            UPDATE aree_scheda SET id_area = $area_update, id_motivazione = $motiv_update  WHERE id_scheda = $id AND id = $old_ubi;
            UPDATE scheda SET noteubi = '$noteUbiUpdate' WHERE id = $id;
          COMMIT;";
$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>
