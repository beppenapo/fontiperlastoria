<?php
include("db.php");
$id = $_POST['id'];
$localita_update= pg_escape_string($_POST['localita_update']);
$motiv_update= pg_escape_string($_POST['motiv_update']);


/*
$id_area = $_POST['id_area'];
$comune_update= $_POST['comune_update'];
$indirizzo_update= $_POST['indirizzo_update'];


$query = "SELECT * FROM aree where id_localita = ".$localita_update;
$r = pg_query($connection, $query);
$area = pg_fetch_array($r, 0, PGSQL_ASSOC);


if (!$id_area) $id_area = $area['id'];
if (!$comune_update) $comune_update = $area['id_comune'];
if (!$indirizzo_update) $indirizzo_update = $area['id_indirizzo'];

$update = ("
BEGIN;
 UPDATE aree_scheda SET
 id_comune = $comune_update,
 id_localita = $localita_update,
 id_indirizzo = $indirizzo_update,
 id_lista_ai_motiv = $motiv_update
 WHERE id_scheda = $id and id = $id_area;
COMMIT;
");

*/

if ($motiv_update && $localita_update){


    $update = ("
    BEGIN;
     UPDATE aree_scheda SET
     id_area = $localita_update,
     id_motivazione = $motiv_update
     WHERE id_scheda = $id;
    COMMIT;
    ");


    $result = pg_query($connection, $update);
    if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
    else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
}
else{
    die("Devi selezionare il campo ".($motiv_update?'Località' : 'Motivazione'));
}

?>
