<?php
include("db.php");

$idOral2        = pg_escape_string($_POST['idOral2']);

$dsc_segnatura2 = pg_escape_string($_POST['oral2_dsc_segnatura2']);
$dsc_denom      = pg_escape_string($_POST['oral2_dsc_denom']);
$dsc_conten     = pg_escape_string($_POST['oral2_dsc_conten']);
$dsc_categ      = pg_escape_string($_POST['oral2_dsc_categ']);
$dsc_occas      = pg_escape_string($_POST['oral2_dsc_occas']);
$dsc_durata     = pg_escape_string($_POST['oral2_dsc_durata']);
$dan_elstrutt2  = pg_escape_string($_POST['oral2_dan_elstrutt2']);
$dan_incverb2   = pg_escape_string($_POST['oral2_dan_incverb2']);
$dan_trascr2    = pg_escape_string($_POST['oral2_dan_trascr2']);
$dan_motiv2     = pg_escape_string($_POST['oral2_dan_motiv2']);
$com_nvoci      = pg_escape_string($_POST['oral2_com_nvoci']);
$com_modesec    = pg_escape_string($_POST['oral2_com_modesec']);
$att_datipers   = pg_escape_string($_POST['oral2_att_datipers']);
$att_ruolo      = pg_escape_string($_POST['oral2_att_ruolo']);
$att_mestiere   = pg_escape_string($_POST['oral2_att_mestiere']);
$att_nascita    = pg_escape_string($_POST['oral2_att_nascita']);
$att_note       = pg_escape_string($_POST['oral2_att_note']);
$att_collden    = pg_escape_string($_POST['oral2_att_collden']);
$att_collnote   = pg_escape_string($_POST['oral2_att_collnote']);
$loc_luogo      = pg_escape_string($_POST['oral2_loc_luogo']);
$loc_contst     = pg_escape_string($_POST['oral2_loc_contst']);
$sup_tipreg     = pg_escape_string($_POST['oral2_sup_tipreg']);
$sup_formato    = pg_escape_string($_POST['oral2_sup_formato']);
$sup_freqvel    = pg_escape_string($_POST['oral2_sup_freqvel']);
$sup_attec      = pg_escape_string($_POST['oral2_sup_attec']);
$sup_oss        = pg_escape_string($_POST['oral2_sup_oss']);
$riv_tpriv      = pg_escape_string($_POST['oral2_riv_tpriv']);
$riv_formato    = pg_escape_string($_POST['oral2_riv_formato']);
$riv_descform   = pg_escape_string($_POST['oral2_riv_descform']);




$update = ("
BEGIN;
 UPDATE fonti_orali2 SET

    dsc_segnatura2 = '$dsc_segnatura2',
    dsc_denom      = '$dsc_denom',
    dsc_conten     = '$dsc_conten',
    dsc_categ      = '$dsc_categ',
    dsc_occas      = '$dsc_occas',
    dsc_durata     = '$dsc_durata',
    dan_elstrutt2  = '$dan_elstrutt2',
    dan_incverb2   = '$dan_incverb2',
    dan_trascr2    = '$dan_trascr2',
    dan_motiv2     = '$dan_motiv2',
    com_nvoci      = '$com_nvoci',
    com_modesec    = '$com_modesec',
    att_datipers   = '$att_datipers',
    att_ruolo      = '$att_ruolo',
    att_mestiere   = '$att_mestiere',
    att_nascita    = '$att_nascita',
    att_note       = '$att_note',
    att_collden    = '$att_collden',
    att_collnote   = '$att_collnote',
    loc_luogo      = '$loc_luogo',
    loc_contst     = '$loc_contst',
    sup_tipreg     = '$sup_tipreg',
    sup_formato    = '$sup_formato',
    sup_freqvel    = '$sup_freqvel',
    sup_attec      = '$sup_attec',
    sup_oss        = '$sup_oss',
    riv_tpriv      = '$riv_tpriv',
    riv_formato    = '$riv_formato',
    riv_descform   = '$riv_descform'

    where id = $idOral2;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
