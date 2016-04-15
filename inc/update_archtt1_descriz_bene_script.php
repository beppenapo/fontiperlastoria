<?php
include("db.php");
$idArchtt1=$_POST['idArchtt1'];
$tipol1=pg_escape_string($_POST['archtt1_dsc_tipol1']);
$tcost1=pg_escape_string($_POST['archtt1_dsc_tcost1_update']);
$pianta1=pg_escape_string($_POST['archtt1_dsc_pianta1_update']);
$npiani1=pg_escape_string($_POST['archtt1_dsc_npiani1_update']);
$fond1=pg_escape_string($_POST['archtt1_dsc_fond1_update']);
$mur1=pg_escape_string($_POST['archtt1_dsc_mur1_update']);
$vsol1=pg_escape_string($_POST['archtt1_dsc_vsol1_update']);
$ambsott1=pg_escape_string($_POST['archtt1_dsc_ambsott1_update']);
$pavim1=pg_escape_string($_POST['archtt1_dsc_pavim1_update']);
$scale1=pg_escape_string($_POST['archtt1_dsc_scale1_update']);
$coper1=pg_escape_string($_POST['archtt1_dsc_coper1_update']);
$bene1=pg_escape_string($_POST['archtt1_dsc_bene1_update']);
$note1=pg_escape_string($_POST['archtt1_dsc_note1_update']);

$update = ("
BEGIN;
 UPDATE  fonti_archtt1 SET dsc_tipol1 = '$tipol1', dsc_bene1='$bene1', dsc_tcost1='$tcost1', dsc_pianta1='$pianta1', dsc_npiani1='$npiani1', dsc_fond1='$fond1', dsc_mur1='$mur1', dsc_vsol1='$vsol1', dsc_ambsott1='$ambsott1', dsc_pavim1 ='$pavim1', dsc_scale1='$scale1', dsc_coper1='$coper1', dsc_note1='$note1'  where id = $idArchtt1;
COMMIT;
");

$result = pg_query($connection, $update);
if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else {die("Salvataggio avvenuto correttamente" . pg_last_error($connection));}
?>