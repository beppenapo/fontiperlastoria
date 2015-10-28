<?php
include("db.php");
$idArchtt2=$_POST['idArchtt2'];
$tipol2=pg_escape_string($_POST['archtt2_dsc_tipol2']);
$tcost2=pg_escape_string($_POST['archtt2_dsc_tcost2_update']);
$pianta2=pg_escape_string($_POST['archtt2_dsc_pianta2_update']);
$npiani2=pg_escape_string($_POST['archtt2_dsc_npiani2_update']);
$fond2=pg_escape_string($_POST['archtt2_dsc_fond2_update']);
$mur2=pg_escape_string($_POST['archtt2_dsc_mur2_update']);
$vsol2=pg_escape_string($_POST['archtt2_dsc_vsol2_update']);
$ambsott2=pg_escape_string($_POST['archtt2_dsc_ambsott2_update']);
$pavim2=pg_escape_string($_POST['archtt2_dsc_pavim2_update']);
$scale2=pg_escape_string($_POST['archtt2_dsc_scale2_update']);
$coper2=pg_escape_string($_POST['archtt2_dsc_coper2_update']);
$bene2=pg_escape_string($_POST['archtt2_dsc_bene2_update']);
$note2=pg_escape_string($_POST['archtt2_dsc_note2_update']);
$matdata=pg_escape_string($_POST['archtt2_dsc_matdata_update']);

$update = ("
BEGIN;
 UPDATE  fonti_archtt2 SET dsc_tipol2 = '$tipol2', dsc_bene2='$bene2', dsc_tcost2='$tcost2', dsc_pianta2='$pianta2', dsc_npiani2='$npiani2', dsc_fond2='$fond2', dsc_mur2='$mur2', dsc_vsol2='$vsol2', dsc_ambsott2='$ambsott2', dsc_pavim2 ='$pavim2', dsc_scale2='$scale2', dsc_coper2='$coper2', dsc_note2='$note2', dsc_matdata='$matdata'  where id = $idArchtt2;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>