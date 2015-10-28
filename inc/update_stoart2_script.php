<?php
include("db.php");

$idStoart2        = pg_escape_string($_POST['idStoart2']);


$dgn_numsch2      = pg_escape_string($_POST['dgn_numsch2']);
$dtc_mattec       = pg_escape_string($_POST['dtc_mattec']);
$dsc_indic        = pg_escape_string($_POST['dsc_indic']);
$dsc_soggicon     = pg_escape_string($_POST['dsc_soggicon']);
$dsc_colloc       = pg_escape_string($_POST['dsc_colloc']);
$dsc_prov         = pg_escape_string($_POST['dsc_prov']);
$dsc_noteprov     = pg_escape_string($_POST['dsc_noteprov']);
$dsc_oss          = pg_escape_string($_POST['dsc_oss']);
$def_aut          = pg_escape_string($_POST['def_aut']);
$def_nomecomm     = pg_escape_string($_POST['def_nomecomm']);
$def_datacomm     = pg_escape_string($_POST['def_datacomm']);
$def_circcomm     = pg_escape_string($_POST['def_circcomm']);
$def_fonticomm    = pg_escape_string($_POST['def_fonticomm']);
$def_motaut       = pg_escape_string($_POST['def_motaut']);
$def_ambcult      = pg_escape_string($_POST['def_ambcult']);
$def_motambcult   = pg_escape_string($_POST['def_motambcult']);
$dtc_mis          = pg_escape_string($_POST['dtc_mis']);
$dtc_notemis      = pg_escape_string($_POST['dtc_notemis']);
$isc_descont      = pg_escape_string($_POST['isc_descont']);
$isc_trascr       = pg_escape_string($_POST['isc_trascr']);
$isc_note         = pg_escape_string($_POST['isc_note']);
$doc_elrest       = pg_escape_string($_POST['doc_elrest']);
$doc_docrest      = pg_escape_string($_POST['doc_docrest']);
$doc_rifschcei    = pg_escape_string($_POST['doc_rifschcei']);
$doc_note         = pg_escape_string($_POST['doc_note']);




$update = ("
BEGIN;
 UPDATE beni_stoart2 SET

    dtc_mattec      = '$dtc_mattec',
    dsc_indic       = '$dsc_indic',
    dsc_soggicon    = '$dsc_soggicon',
    dsc_colloc      = '$dsc_colloc',
    dsc_prov        = '$dsc_prov',
    dsc_noteprov    = '$dsc_noteprov',
    dsc_oss         = '$dsc_oss',
    def_aut         = '$def_aut',
    def_nomecomm    = '$def_nomecomm',
    def_datacomm    = '$def_datacomm',
    def_circcomm    = '$def_circcomm',
    def_fonticomm   = '$def_fonticomm',
    def_motaut      = '$def_motaut',
    def_ambcult     = '$def_ambcult',
    def_motambcult  = '$def_motambcult',
    dtc_mis         = '$dtc_mis',
    dtc_notemis     = '$dtc_notemis',
    isc_descont     = '$isc_descont',
    isc_trascr      = '$isc_trascr',
    isc_note        = '$isc_note',
    doc_elrest      = '$doc_elrest',
    doc_docrest     = '$doc_docrest',
    doc_rifschcei   = '$doc_rifschcei',
    doc_note        = '$doc_note'


    where id = $idStoart2;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
