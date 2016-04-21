<?php
session_start();
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
ini_set( "display_errors", 0);
$hub = $_SESSION['hub'];
require("inc/db.php");
$id = $_GET["id"];
$tipoUsr = $_SESSION['tipo'];
$idUsr = $_SESSION['id_user'];
$schedeUsr = $_SESSION['schede'];
$idMappa = $id;
$nd = 'Dato non presente';
$q1 =  "SELECT scheda.id, scheda.livello,scheda.dgn_numsch as numsch, scheda.dgn_dnogg, scheda.dgn_tpsch, lista_dgn_tpsch.definizione AS tipo_scheda, scheda.dgn_livind, lista_dgn_livind.definizione AS individuazione, scheda.dgn_note, scheda.scn_note, scheda.note, scheda.ana_note, scheda.noteai, scheda.noteubi, cronologia.cro_spec, cronologia.cro_iniz, cronologia.cro_fin, scheda.fine FROM scheda, lista_dgn_tpsch, lista_dgn_livind, cronologia WHERE scheda.dgn_tpsch = lista_dgn_tpsch.id AND  scheda.dgn_livind = lista_dgn_livind.id AND cronologia.id_scheda = scheda.id AND  scheda.id = $id;";
$r = pg_query($connection, $q1);
$a = pg_fetch_array($r, 0, PGSQL_ASSOC);
$rC = pg_num_rows($r);
$tab='';
$livello = $a['livello'];
$tpsch = $a['dgn_tpsch'];
$tipologiaScheda = $a['tipo_scheda'];
$livind = $a['dgn_livind'];
$fine = $a['fine'];

if($tpsch==1){
    $upload = "uploaded_audio.php";
    $noFile="<h2>Non sono presenti file audio</h2>";
    $tipoFile = 2;
    $folder = "audio/";
    $mapSwitch="Multimedia";
    $css = "style='background-image:url(\"img/layout/loghiSchede/logoSkOrale.png\"); background-repeat:no-repeat;background-position:center center;background-size:contain;'";
}else{
    $upload = "uploaded_file.php";
    $noFile = "<h2>Non sono presenti foto</h2>";
    $tipoFile = 1;
    $folder = "../foto/";
    $mapSwitch="Foto";
    $css = '';
}


$statoScheda=($fine == 1)?'APERTA':'CHIUSA';
$upStatoScheda=($fine == 1)?'upVal=2':'upVal=1';
if($a['cro_spec'] == '0') {$cro_spec = 'Cronologia assente';}
elseif($a['cro_spec']==''||!$a['cro_spec']){$cro_spec = $a['cro_iniz']." - ".$a['cro_fin'];}
else{$cro_spec = stripslashes($a['cro_spec']);}
$dgn_ogg=stripslashes($a['dgn_dnogg']);
$pag = $tpsch.$livello;

$stile = $a['tipo_scheda'];
if($stile == 'fonte orale') {$stile = 'orale'; $logo = 'logoSkOrale';}
if($stile == 'fonte materiale') {$stile = 'materiale';$logo = 'logoSkMateriale';}
if($stile == 'bene storico-artistico') {$stile = 'stoart';$logo = 'logoSkStoart';}
if($stile == 'storico artistica') {$stile = 'stoart';$logo = 'logoSkStoart';}
if($stile == 'archeologica') {$logo = 'logoSkArcheo';}
if($stile == 'architettonica') {$logo = 'logoSkArchitett';}
if($stile == 'archivistica') {$logo = 'logoSkArchiv';}
if($stile == 'bibliografica') {$logo = 'logoSkBiblio';}
if($stile == 'fotografica') {$logo = 'logoSkFoto';}
if($stile == 'cartografica') { $logo = ($hub == 1)?'logoSkCarto1':'logoSkCarto';}

$numSch = $a['numsch'];
$note1 = stripslashes($a['dgn_note']); if($note1 == '') {$note1 = $nd;}
$note2 = stripslashes($a['note']); if($note2 == '') {$note2 = $nd;}
$noteAi = stripslashes($a['noteai']); if($noteAi == '') {$noteAi = $nd;}
$noteUbi = stripslashes($a['noteubi']); if($noteUbi == '') {$noteUbi = $nd;}

switch ($pag) {
 case 11: $tab = "orale1"; break;
 case 12: $tab = "orale2"; break;
 case 13: $tab = "orale3"; break;
 case 21: $tab = "materiale1"; break;
 case 22: $tab = "materiale2"; break;
 case 23: $tab = "materiale3"; break;
 case 31: $tab = "stoart1"; break;
 case 32: $tab = "stoart2"; break;
 case 33: $tab = "stoart3"; break;
 case 41: $tab = "archivi1"; break;
 case 42: $tab = "archivi2"; break;
 case 43: $tab = "archivi3"; break;
 case 51: $tab = "biblio1"; break;
 case 52: $tab = "biblio2"; break;
 case 53: $tab = "biblio3"; break;
 case 61: $tab = "archeo1"; break;
 case 62: $tab = "archeo2"; break;
 case 63: $tab = "archeo3"; break;
 case 71: $tab = "foto1"; break;
 case 72: $tab = "foto2"; break;
 case 73: $tab = "foto3"; break;
 case 81: $tab = "fonti_archtt1"; break;
 case 82: $tab = "fonti_archtt2"; break;
 case 83: $tab = "fonti_archtt3"; break;
 case 91: $tab = "stoart1"; break;
 case 92: $tab = "stoart2"; break;
 case 93: $tab = "stoart3"; break;
 case 102: $tab = "cartografia2"; break;
}

/**********************************************************************************/

$qgeom1=("
  SELECT count(area_int_poly.id) as num_poly
  FROM area_int_poly,aree,aree_scheda
  WHERE area_int_poly.id_area = aree.nome_area AND
        aree_scheda.id_area = aree.nome_area AND
        aree_scheda.id_scheda = $id;
  ");

$qgeom2=("
  SELECT count(area_int_line.id) as num_line
  FROM area_int_line,aree,aree_scheda
  WHERE area_int_line.id_area = aree.nome_area AND
        aree_scheda.id_area = aree.nome_area AND
        aree_scheda.id_scheda = $id;
  ");

$qgeom3=("
select st_extent(area_int_poly.the_geom) as extent
  FROM area_int_poly, aree,aree_scheda
  WHERE area_int_poly.id_area = aree.nome_area AND
        aree_scheda.id_area = aree.nome_area AND
        aree_scheda.id_scheda = $id;
");
$qgeom4=("
select st_extent(area_int_line.the_geom) as extent2
  FROM area_int_line, aree,aree_scheda
  WHERE area_int_line.id_area = aree.nome_area AND
        aree_scheda.id_area = aree.nome_area AND
        aree_scheda.id_scheda = $id;
");

$qgeom1Res = pg_query($connection, $qgeom1);
$qgeom2Res = pg_query($connection, $qgeom2);
$qgeom3Res = pg_query($connection, $qgeom3);
$qgeom4Res = pg_query($connection, $qgeom4);

$g1 = pg_fetch_array($qgeom1Res, 0, PGSQL_ASSOC);
$g2 = pg_fetch_array($qgeom2Res, 0, PGSQL_ASSOC);
$g3 = pg_fetch_array($qgeom3Res, 0, PGSQL_ASSOC);
$g4 = pg_fetch_array($qgeom4Res, 0, PGSQL_ASSOC);

$numPoly = $g1['num_poly'];
$numLine = $g2['num_line'];

$extent = $g3['extent'];
$extent = substr($extent, 4, -1);
$extent = str_replace(' ', ',', $extent);

$extent2 = $g4['extent2'];
$extent2 = substr($extent2, 4, -1);
$extent2 = str_replace(' ', ',', $extent2);


?>

<!DOCTYPE>
<html lang="it">
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />

  <meta name="author" content="Giuseppe Naponiello" />
  <meta name="keywords" content="gfoss, archaeology, anthropology, openlayer, jquery, grass, postgresql, postgis, qgis, webgis, informatic" />
  <meta name="description" content="Le fonti per la storia. Per un archivio delle fonti sulle valli di Primiero e Vanoi" />
  <meta name="robots" content="INDEX,FOLLOW" />
  <meta name="copyright" content="&copy;2011 Museo Provinciale" />

  <title>Le fonti per la storia. Per un archivio delle fonti sulle valli di Primiero e Vanoi</title>
  <link rel="stylesheet" href="lib/OpenLayers-2.12/theme/default/style.css" type="text/css">
  <link href="lib/jquery-ui-1.11.4/jquery-ui.min.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="css/scheda.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="css/ico-font/css/font-awesome.min.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="stylesheet" href="css/google.css" type="text/css">
  <link href="css/print.css" type="text/css" rel="stylesheet" media="print" />
  <link rel="shortcut icon" href="img/icone/favicon.ico" />
  <script type="text/javascript" src="lib/jquery-core/jquery-1.12.0.min.js"></script>
  <script type="text/javascript" src="lib/jquery-ui-1.11.4/jquery-ui.min.js"></script>

  <style>
    #mapImgWrap{position:relative;}
    #imgDiv{position: absolute;top: 0;left: 0;background-color: #fff;z-index: 9000;}
    .areeList{display:block;width: 100%; margin:10px 0px}
    .areeListRecord{display:inline-block; margin:2px 10px; width:45%;}
    .areeListRecord label{font-size: 1em !important;}
    #areeAdd{ border-radius: 15px; -moz-border-radius: 15px; -webkit-border-radius: 15px;  padding:5px 8px !important; margin-bottom: 0px;}
    #primoDivSx{width:450px; float:left; margin-left:-70px;}
    #last{border:none !important; background-color: none !important; height:auto !important}
    button.print{ background-color: transparent; background-image: -webkit-linear-gradient(top,#f8f8f8,#f1f1f1); background-image: linear-gradient(top,#f8f8f8,#f1f1f1); background-image: -webkit-gradient(linear,left top,left bottom,from(#f8f8f8),to(#f1f1f1)); background-image: -webkit-linear-gradient(top,#f8f8f8,#f1f1f1); border: 1px solid rgba(0,0,0,0.1); cursor:pointer; padding: 7px 10px; color: #444;}
    button.print:hover{color: #111;}
  </style>

</head>
<body onload="init();">
 <div id="container">
  <input type="hidden" id="numPoly" value="<?php echo($numPoly);?>" />
  <input type="hidden" id="numLine" value="<?php echo($numLine);?>" />
  <div id="wrap">
   <?php if ($_SESSION['username']!='guest'){require("inc/sessione.php"); }?>
   <div id="content">
    <?php require_once('inc/logoHub.php'); ?>
    <?php if($hub != 2){ ?>
    <div id="livelloScheda" class="noPrint">
     <ul>
      <li id="liv1">PRIMO LIVELLO</li>
      <li id="liv2">SECONDO LIVELLO</li>
      <li id="liv3">TERZO LIVELLO</li>
     </ul>
    </div>
    <?php } ?>
    <div id="logoSchedaDx"><img src="img/layout/loghiSchede/<?php echo($logo);?>.png" alt="logo scheda" /></div>

<div id="skArcheoContent">
    <div class="inner primo">
        <div id="primoDivSx" class="check bassa">
            <table class="mainData">
                <tr>
                    <td colspan="2">
                        <button class="print noPrint" type="button">
                            <i class="fa fa-file-pdf-o"></i> stampa
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>NUMERO SCHEDA</label>
                        <h1 class="<?php echo($stile);?>"><?php echo($numSch); ?></h1>
                    </td>
                    <td>
                        <label>TIPO SCHEDA</label>
                        <div class="valori"><?php echo($a['tipo_scheda']); ?></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label>DEFINIZIONE OGGETTO</label>
                        <div class="valori" style="min-height:50px; font-size:18px;"><?php echo($dgn_ogg); ?></div>
                    </td>
                </tr>
                <tr>
                    <td <?php if($hub==2){echo "colspan='2'";} ?>>
                        <label>CRONOLOGIA</label>
                        <div class="valori"><?php echo($cro_spec); ?></div>
                    </td>
                    <td>
                        <?php if($hub!=2){ ?>
                            <label>LIVELLO INDIVIDUAZIONE DATI</label>
                            <div class="valori"><?php echo($a['individuazione']); ?></div>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label>NOTE</label>
                        <div class="valori"><?php echo($note1); ?></div>
                    </td>
                </tr>
                <?php if($_SESSION['username']!='guest') {?>
                <tr>
                    <td>
                        <label class="update" id="dati_principali">modifica sezione</label>
                    </td>
                    <td>
                        <label class="update" id="elimina_scheda" scheda="<?php echo ($id);?>">elimina scheda</label>
                    </td>
                </tr>
                <?php } ?>
            </table>
            <div class="updateContent" style="display:none">
                <?php require("inc/form_update/dati_principali.php"); ?>
            </div>
        </div> <!--primoDivSx-->
        <!--  ############  switch mappa file ############## -->
        <?php if(($tpsch==1)||($tpsch==7)||($pag==92)||($pag==63)||($pag==23))  {?>
        <div id="switchImgMap" class="noPrint">
            <label class="switchLabel" for="switchImg"><?php echo $mapSwitch; ?></label>
            <label class="switchLabel" for="switchMappa">Mappa</label>
            <input type="radio" id="switchMappa" class="switchImgMapButton" name="switchImgMapButton" />
            <input type="radio" id="switchImg" class="switchImgMapButton" name="switchImgMapButton" />
        </div>
        <?php } ?>
        <!--  ############ fine switch mappa file ############## -->

       <div id="mapImgWrap">
       <?php if($numPoly == 0 && $numLine == 0){?>
           <div id="noMap">
               <div id="noMapAlert">
                   <h2>Non sono presenti geometrie per la scheda visualizzata</h2>
               </div>
           </div> <!-- no map -->
       <?php }else {?>
           <!--  ############  MAPPA PICCOLA ############## -->
           <div id="smallMap">
               <div id="smallMapPanel" class="noPrint">
                   <a href="#" class="baseButton" id="sat" onclick="mappa.setBaseLayer(gsat)">SAT</a>
                   <a href="#" class="baseButton" id="osm" onclick="mappa.setBaseLayer(osm)">OSM</a>
               </div>
           </div>
           <!--  ############  FINE MAPPA PICCOLA ############## -->
       <?php }
        if(($tpsch==1)||($tpsch==7)||($pag==92)||($pag==63)||($pag==23)) {
             $imgq = ("select path from file where id_scheda = $id;");
             $imgexec = pg_query($connection, $imgq);
             $imgrow = pg_num_rows($imgexec);
             $imgres = pg_fetch_array($imgexec, 0, PGSQL_ASSOC);
             $img=$imgres['path'];
       ?>
            <img id="imgOrig" src="<?php echo($folder.$img);?>" style="position:absolute; left:-1000%;">
            <div id="imgDiv" <?php echo $css; ?> >
                <div id="noImgAlert">
                <?php
                    if($imgrow > 0) {
                        if($tpsch!=1){
                            echo "<img id='imgSmall' src='".$folder.$img."' />";
                            echo "<div id='panelFoto'>";
                                echo "<label id='ingrFoto' scheda='$id'>ingrandisci</label>&nbsp;&nbsp;";
                                if($idUsr) {echo"<label id='delFoto' scheda='$id' img='$img'>elimina</label>";}
                            echo "</div>";
                        }else{
                            echo "<audio preload='none' controls>";
                            echo "<source src='".$folder.$img."' type='audio/mp3'>";
                            echo "Il tuo browser non supporta l'elemento audio";
                            echo "</audio>";
                        }
                    }else{
                        echo $noFile;
                        if($idUsr) {
                ?>
                    <form action="inc/<?php echo $upload; ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="schedaFoto" value="<?php echo($id);?>" />
                        <input type="file" name="file" id="file"><br>
                        <input type="submit" name="submit" id="submitFile" value="Carica file selezionato">
                    </form>
                    <?php }}//else ?>
                </div> <!-- noImgAlert -->
            </div> <!-- imgDiv -->
         <?php }//primo if ?>
        </div> <!-- mapImgWrap -->
        <div style="clear:both"></div>
       <?php
         $qcro =  ("SELECT c.cro_iniz, c.cro_fin, c.cro_spec, c.cro_motiv as cro_id, l.definizione AS cro_motiv, c.cro_note
                    FROM public.cronologia as c, public.scheda as s, public.lista_cro_motiv as l
                    WHERE c.cro_motiv = l.id AND c.id_scheda = s.id AND s.id = $id;");
         $rcro = pg_query($connection, $qcro);
         $acro = pg_fetch_array($rcro, 0, PGSQL_ASSOC);
         $rowcro = pg_num_rows($rcro);

         $cro_iniz= $acro['cro_iniz']; if($cro_iniz == '') {$cro_iniz=$nd;}
         $cro_fin= $acro['cro_fin']; if($cro_fin == '') {$cro_fin=$nd;}
         $cro_spec= stripslashes($acro['cro_spec']); if($cro_spec == '') {$cro_spec=$nd;}
         $cro_motiv= $acro['cro_motiv']; if($cro_motiv == '') {$cro_motiv=$nd;}
         $cro_motiv_id = $acro['cro_id'];
         $cro_note= stripslashes($acro['cro_note']); if($cro_note == '') {$cro_note=$nd;}

         $periodo = $cro_iniz.'-'.$cro_fin;
         if($rowcro>0) {
        ?>
       <div class="toggle check bassa">
        <div class="sezioni" style="margin-top:20px;"><h2>DETTAGLIO CRONOLOGIA</h2></div>

        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>SPECIFICA</label>
               <div class="valori"><?php echo($cro_spec); ?></div>
               <br/>
               <label>GENERICA</label>
               <div class="valori"><?php echo($periodo); ?></div>
               <br/>
               <label>MOTIVAZIONE CRONOLOGIA</label>
               <div class="valori"><?php echo($cro_motiv); ?></div>
             </td>
             <td>
              <label>NOTE</label>
              <div class="valori" style="height:120px;overflow:auto;"><?php echo(nl2br($cro_note)); ?></div>
             </td>
           </tr>
           <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="dettagli_crono">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
           <div class="updateContent" style="display:none">
           <?php require("inc/form_update/dettagli_crono.php"); ?>
          </div>
        </div>
       </div>
       <?php } ?>

       <?php

         $qcmp =  ("
         SELECT r.id, r.denric, r.enresp, r.respric, s.compilatore, s.data_compilazione, s.cmp_note, u.nome, u.cognome
         FROM ricerca as r, scheda as s, usr as u
         WHERE s.compilatore = u.id_user and s.cmp_id = r.id and s.id = $id;
         ");

         $rcmp = pg_query($connection, $qcmp);
         $acmp = pg_fetch_array($rcmp, 0, PGSQL_ASSOC);
         $rowcmp = pg_num_rows($rcmp);

         $idric=$acmp['id'];
         $denric= stripslashes($acmp['denric']); if($denric == '') {$denric=$nd;}
         $enresp= stripslashes($acmp['enresp']); if($enresp == '') {$enresp=$nd;}
         $respric= stripslashes($acmp['respric']); if($respric == '') {$respric=$nd;}
         $id_compilatore= $acmp['compilatore']; if($id_compilatore == '') {$id_compilatore=$nd;}
         $nome= stripslashes($acmp['nome']); if($nome == '') {$nome=$nd;}
         $cognome= stripslashes($acmp['cognome']); if($cognome == '') {$cognome=$nd;}
         $compilatore= $nome." ".$cognome;
         $datacmp= stripslashes($acmp['data_compilazione']); if($datacmp == '') {$datacmp=$nd;}
         $notecmp= stripslashes($acmp['cmp_note']); if($notecmp == '') {$notecmp=$nd;}

       ?>

       <?php if($hub==1 || !$hub){ ?>
       <div class="toggle check bassa">
        <div class="sezioni"><h2>COMPILAZIONE</h2></div>

        <div class="slide">
          <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>DENOMINAZIONE RICERCA</label>
               <div class="valori"><?php echo($denric); ?></div>
               <br/>
               <label>COMPILATORE</label>
               <div class="valori"><?php echo($compilatore); ?></div>
               <br/>
               <label>DATA</label>
               <div class="valori"><?php echo($datacmp); ?></div>
             </td>
             <td>
               <label>ENTE RESPONSABILE</label>
               <div class="valori"><?php echo($enresp); ?></div>
               <br/>
               <label>RESPONSABILE RICERCA</label>
               <div class="valori"><?php echo($respric); ?></div>
               <br/>
               <label>NOTE</label>
               <div class="valori"><?php echo($notecmp); ?></div>
             </td>
           </tr>
           <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="compilazione">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
          <div class="updateContent" style="display:none">
           <?php require("inc/form_update/compilazione.php"); ?>
          </div>
        </div>
       </div>
       <?php } ?>
       <?php
         $qprv =  ("
           SELECT scheda.prv_note, ricerca.id, ricerca.denric, ricerca.enresp, ricerca.respric, ricerca.data, scheda.prv_note, ricerca.redattore
           FROM public.ricerca, public.scheda
           WHERE scheda.prv_id = ricerca.id and scheda.id = $id;
         ");
         $rprv = pg_query($connection, $qprv);
         $aprv = pg_fetch_array($rprv, 0, PGSQL_ASSOC);
         $rowprv = pg_num_rows($rprv);



         $idricprv=$aprv['id'];
         $denricprv= stripslashes($aprv['denric']); if($denricprv == '') {$denricprv=$nd;}
         $enrespprv= stripslashes($aprv['enresp']); if($enrespprv== '') {$prvprv=$nd;}
         $respricprv= stripslashes($aprv['respric']); if($respricprv == '') {$respricprv=$nd;}
         $compilatoreprv= stripslashes($aprv['redattore']); if($compilatoreprv == '') {$compilatoreprv=$nd;}
         $dataprv= stripslashes($aprv['data']); if($dataprv == '') {$dataprv=$nd;}
         $noteprv= stripslashes($aprv['prv_note']); if($noteprv == '') {$noteprv=$nd;}

        ?>
       <div class="toggle check">
        <div class="sezioni"><h2>PROVENIENZA DATI</h2></div>

        <div class="slide">

         <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>DENOMINAZIONE RICERCA</label>
               <div class="valori">
               <?php echo($denricprv); ?></div>
               <br/>
               <label>REDATTORE</label>
               <div class="valori"><?php echo($compilatoreprv); ?></div>
               <br/>
               <label>DATA</label>
               <div class="valori"><?php echo($dataprv); ?></div>
             </td>
             <td>
               <label>ENTE RESPONSABILE</label>
               <div class="valori"><?php echo($enrespprv); ?></div>
               <br/>
               <label>RESPONSABILE RICERCA</label>
               <div class="valori"><?php echo($respricprv); ?></div>
               <br/>
               <label>NOTE</label>
               <div class="valori"><?php echo(nl2br($noteprv)); ?></div>
             </td>
           </tr>
           <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="provenienza">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
          <div class="updateContent" style="display:none">
           <?php require("inc/form_update/provenienza.php"); ?>
          </div>
        </div>
       </div>
       <?php

$qai =  ("
select aree_scheda.id as id_as, area.id as filtro, area.nome,lista_ai_motiv.definizione as motiv, localita.localita, comune.comune, provincia.provincia, stato.stato
from area
inner join aree on aree.nome_area = area.id
inner join aree_scheda on aree_scheda.id_area = area.id
inner join lista_ai_motiv on aree_scheda.id_motivazione = lista_ai_motiv.id
left join localita on aree.id_localita = localita.id
left join comune on aree.id_comune = comune.id
left join provincia on comune.provincia = provincia.id
left join stato on comune.stato=stato.id
where aree_scheda.id_scheda = $id and area.tipo <> 2 order by comune asc, localita asc;
");
$rai = pg_query($connection, $qai);
$rowai = pg_num_rows($rai);
$param = '';
?>
       <div class="toggle check bassa">
        <div class="sezioni"><h2>AREA DI INTERESSE</h2></div>
        <div class="slide">
        <div style="width:98%; margin:0px auto !important">
        <?php if($rowai > 0) {?>
         <table class="mainData zebra" style="margin-top:10px !important;">
          <thead>
           <th>STATO</th>
           <th>PROVINCIA</th>
           <th>COMUNE</th>
           <th>LOCALITA'</th>
           <th>NOME AREA</th>
           <th>MOTIVAZIONE</th>
           <th></th>
          </thead>
          <tbody>
          <?php
          while ($x = pg_fetch_array($rai)){
              $param .= 'id_area='.$x['filtro'].' OR ';
              echo "
              <tr>
               <td>".$x['stato']."</td>
               <td>".$x['provincia']."</td>
               <td>".$x['comune']."</td>
               <td>".$x['localita']."</td>
               <td>".$x['nome']."</td>
               <td>".$x['motiv']."</td>
               <td>";
               if ($_SESSION['username']!='guest'){ echo "<a href='#' id='removeArea' class='avviso' title='Rimuovi area' data-id='".$x['id_as']."'><i class='fa fa-times fa-2x'></i></a>"; }
               echo "</td>
              </tr>
             ";
          }

          ?>
          </tbody>
         </table>
         <?php }else {?>
           <div style="width:98%;height:50px;margin:0px auto;text-align:center">
            <h1 style="width:90% !important;">Nessuna area definita</h1>
           </div>
         <?php } if($_SESSION['username']!='guest') {?>
          <div style="padding:10px;"><label class="update" id="area_interesse_add">aggiungi area</label></div>
         <?php } ?>
         </div>
         <div>
          <label style="margin-left:2.5%">NOTE</label>
          <div class="valori" style="height:70px;overflow:auto;margin:0px auto 10px; width:94% !important;">
           <?php echo(nl2br($noteAi))?>
         </div>
         <?php if($_SESSION['username']!='guest') {?>
          <div style="padding:10px;"><label class="update" id="updatenoteai">aggiorna note</label></div>
         <?php } ?>
         </div>
         <div class="updateContent" style="display:none">
           <?php
            require("inc/form_update/area_interesse.php");
            require("inc/form_update/area_interesse_add.php");
            require("inc/form_update/noteai_update.php");
           ?>
          </div>
        </div>
       </div>

       <?php
         $qubi =  ("
         SELECT aree_scheda.id as id_as, area.id as area_id, area.nome as area, comune.comune, localita.localita, indirizzo.indirizzo, indirizzo.cap, anagrafica.nome, anagrafica.tel, anagrafica.cell, anagrafica.fax, anagrafica.mail, anagrafica.web, provincia.provincia,
         stato.stato, lista_ai_motiv.definizione as motiv
         FROM aree_scheda
        LEFT JOIN area ON aree_scheda.id_area = area.id
LEFT JOIN aree ON aree.nome_area = area.id
LEFT JOIN comune ON aree.id_comune = comune.id
LEFT JOIN localita ON aree.id_localita = localita.id
LEFT JOIN indirizzo ON aree.id_indirizzo = indirizzo.id
LEFT JOIN anagrafica ON aree.id_rubrica = anagrafica.id
LEFT JOIN provincia ON comune.provincia = provincia.id
LEFT JOIN stato ON provincia.stato = stato.id
LEFT JOIN lista_ai_motiv ON aree_scheda.id_motivazione = lista_ai_motiv.id
WHERE aree_scheda.id_scheda = $id AND area.tipo = 2;
");
         $rubi = pg_query($connection, $qubi);
         $aubi = pg_fetch_array($rubi, 0, PGSQL_ASSOC);
         $rowubi = pg_num_rows($rubi);

         $id_as= $aubi['id_as'];
         $id_ubi = $aubi['area_id'];
         $localitaubi = ($aubi['localita']=="") ? $nd : stripslashes($aubi['localita']);
         $comuneubi = ($aubi['comune']=="") ? $nd : stripslashes($aubi['comune']);
         $motivubi = ($aubi['motiv']=="") ? $nd : stripslashes($aubi['motiv']);
         $indirizzoubi = ($aubi['indirizzo']=="") ? $nd : stripslashes($aubi['indirizzo']);
         $provinciaubi = ($aubi['provincia']=="") ? $nd : stripslashes($aubi['provincia']);
         $statoubi = ($aubi['stato']=="") ? $nd : stripslashes($aubi['stato']);
         $telubi = ($aubi['tel']=="") ? $nd : stripslashes($aubi['tel']);
         $mailubi = ($aubi['mail']=="") ? $nd : stripslashes($aubi['mail']);
         $linkubi = ($aubi['web']=="") ? $nd : '<a href="'.stripslashes($aubi['web']).'" target="_blank" class="generico" title="[link esterno]">'.stripslashes($aubi['web']).'</a>';
        ?>
       <div class="toggle check">
        <div class="sezioni"><h2>UBICAZIONE</h2></div>

        <div class="slide">

         <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>INDIRIZZO</label><div class="valori"><?php echo($indirizzoubi); ?></div><br/>
               <label>LOCALITA'</label><div class="valori"><?php echo($localitaubi); ?></div><br/>
               <label>COMUNE</label><div class="valori"><?php echo($comuneubi); ?></div><br/>
               <label>PROVINCIA</label><div class="valori"><?php echo($provinciaubi); ?></div><br/>
               <label>STATO</label><div class="valori"><?php echo($statoubi); ?></div><br/>
               <label>MOTIVAZIONE UBICAZIONE</label><div class="valori"><?php echo($motivubi); ?></div>
             </td>
             <td>
               <label>TELEFONO</label><div class="valori"><?php echo($telubi); ?></div><br/>
               <label>INDIRIZZO E-MAIL</label><div class="valori"><?php echo($mailubi); ?></div><br/>
               <label>SITO WEB</label><div class="valori"><?php echo($linkubi); ?></div><br/>
               <label>NOTE</label><div class="valori" style="height:108px;"><?php echo(nl2br($noteUbi))?></div>
            </td>
           </tr>
           <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="ubicazione">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>

          <div class="updateContent" style="display:none">
           <?php require("inc/form_update/ubicazione.php"); ?>
          </div>
        </div>
       </div>

      <?php
         $qana =  ("SELECT scheda.id AS id_scheda, anagrafica.id as ana_id, anagrafica.nome,  comune.id AS id_comune,  comune.comune,  indirizzo.id AS id_indirizzo,  indirizzo.indirizzo,  localita.id AS id_localita,  localita.localita, anagrafica.tel,  anagrafica.cell,  anagrafica.fax,  anagrafica.mail,  anagrafica.web,  anagrafica.note
         FROM anagrafica, comune, indirizzo, localita, scheda
         WHERE anagrafica.comune = comune.id AND  anagrafica.indirizzo = indirizzo.id AND  anagrafica.localita = localita.id AND  scheda.ana_id = anagrafica.id AND  scheda.id = $id
         order by id_scheda asc; ");
         $rana = pg_query($connection, $qana);
         $aana = pg_fetch_array($rana, 0, PGSQL_ASSOC);
         $rowana = pg_num_rows($rana);

         $id_comune_ana=$aana['id_comune'];
         $comune_ana=$aana['comune'];
         $id_localita_ana=$aana['id_localita'];
         $id_indirizzo_ana=$aana['id_indirizzo'];
         $localita_ana=$aana['localita'];
         $indirizzo_ana=$aana['indirizzo'];
         $idana = $aana['ana_id'];
         $nomeana= $aana['nome']; if($nomeana == '') {$nomeana=$nd;}
         $telana= $aana['tel']; if($telana == '') {$telana=$nd;}
         $mailana= $aana['mail']; if($mailana == '') {$mailana=$nd;}
         $webana= $aana['web'];
         if($webana == '') {$webana=$nd;}
         else {$linkana='<a href="http://'.$webana.'" target="_blank" class="generico" title="[link esterno]">'.$webana.'</a>';}
         $noteana= stripslashes($a['ana_note']); if($noteana== '') {$noteana=$nd;}


        ?>
       <div class="toggle check bassa">
        <div class="sezioni"><h2>ANAGRAFICA</h2></div>
        <div class="slide">
         <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <label>NOME</label> <div class="valori"><?php echo($nomeana); ?></div> <br/>
               <label>COMUNE</label> <div class="valori"><?php echo($comune_ana); ?></div>  <br/>
               <label>LOCALITA'</label> <div class="valori"><?php echo($localita_ana); ?></div> <br/>
               <label>INDIRIZZO</label> <div class="valori"><?php echo($indirizzo_ana); ?></div> <br/>
               <label>TELEFONO</label> <div class="valori"><?php echo($telana); ?></div> <br/>
               <label>INDIRIZZO E-MAIL</label> <div class="valori"><?php echo($mailana); ?></div>
            </td>
             <td>
               <label>SITO WEB</label> <div class="valori"><?php echo($linkana); ?></div> <br/>
               <label>NOTE</label><div class="valori" style="height:240px;overflow:auto;"><?php echo(nl2br($noteana)); ?></div>
             </td>
           </tr>
           <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="anagrafica">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
          <div class="updateContent" style="display:none">
           <?php require("inc/form_update/anagrafica.php"); ?>
          </div>
        </div>
       </div>

       <?php
         $qcre =  ("SELECT c.consultabilita, c.orario, c.servizi
                    FROM consultabilita c, scheda s
                    WHERE c.id_scheda = s.id AND s.id =  $id;");
         $rcre = pg_query($connection, $qcre);
         $acre = pg_fetch_array($rcre, 0, PGSQL_ASSOC);
         $rowcre = pg_num_rows($rcre);

         $consultabilita= stripslashes($acre['consultabilita']); if($consultabilita == '') {$consultabilita=$nd;}
         $orario= stripslashes($acre['orario']); if($orario== '') {$orario=$nd;}
         $servizi= stripslashes($acre['servizi']);

        ?>

       <div class="toggle check">
        <div class="sezioni"><h2>CONSULTABILITA'</h2></div>
        <div class="slide">
         <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
              <br/>
              <div class="valori"><?php echo(nl2br($consultabilita)); ?></div>
             </td>
             <td>
               <label>ORARIO</label>
               <div class="valori"><?php echo(nl2br($orario)); ?></div>
               <br/>
               <label>SERVIZI</label>
               <div class="valori"><?php echo($servizi); ?></div>
             </td>
           </tr>
           <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="consultabilita">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
          <div class="updateContent" style="display:none">
           <?php require("inc/form_update/consultabilita.php"); ?>
          </div>
        </div>
       </div>

       <?php
         $qscn =  ("SELECT l.id as scn_id, l.definizione AS scn, s.scn_note
                    FROM scheda s, lista_stato_conserv l
                    WHERE s.scn_id = l.id AND s.id = $id;");
         $rscn = pg_query($connection, $qscn);
         $ascn = pg_fetch_array($rscn, 0, PGSQL_ASSOC);
         $rowscn = pg_num_rows($rscn);

         $id_scn= $ascn['scn_id'];
         $scn= $ascn['scn']; if($scn == '') {$scn=$nd;}
         $scn_note= stripslashes($a['scn_note']); if($scn_note== '') {$scn_note=$nd;}
        ?>
       <div class="toggle check">
        <div class="sezioni"><h2>STATO DI CONSERVAZIONE</h2></div>
        <div class="slide">
         <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <div class="valori"><?php echo($scn); ?></div>
             </td>
             <td>
               <label>NOTE</label>
               <div class="valori"><?php echo(nl2br($scn_note)); ?></div>
             </td>
           </tr>
           <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td colspan="2">
             <label class="update" id="conservazione">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
          <div class="updateContent" style="display:none">
           <?php require("inc/form_update/conservazione.php"); ?>
          </div>
        </div>
       </div>

       <?php
         $qrif =  ("select count(id) as schede from altrif where scheda = $id;");
         $rrif = pg_query($connection, $qrif);
         $arif = pg_fetch_array($rrif, 0, PGSQL_ASSOC);

         $rif= $arif['schede'];
       ?>

       <div class="toggle check bassa">
        <div class="sezioni"><h2>SCHEDE CORRELATE</h2></div>
        <div class="slide">
         <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
             <?php if($rif == 0) {echo "<label>Non ci sono schede correlate</label>";}?>
             <?php

              foreach(array( 6=>array('ARCHEOLOGICHE','archeologica'), 8=>array('ARCHITETTONICHE','architettonica'), 9=>array('STORICO-ARTISTICHE','stoart'), 2=>array('MATERIALI','materiale'), 4=>array('ARCHIVISTICHE','archivistica'), 1=>array('ORALI','orale'), 7=>array('FOTOGRAFICHE','fotografica'), 5=>array('BIBLIOGRAFICHE','bibliografica'), 10=>array('CARTOGRAFICHE','cartografica')) as $idforeach=>$nomeforeach){
                 $qrif6 = ("select * from altrif where scheda = $id and tpsch_altrif = $idforeach");
                $rrif6 = pg_query($connection, $qrif6);
                 $rowrif6 = pg_num_rows($rrif6);
                 if($rowrif6 != 0) {
                   echo '<label>'.$nomeforeach[0].'</label><div class="valori">';
                   for ($x = 0; $x < $rowrif6; $x++){
                    $idrif6 = pg_result($rrif6, $x,"scheda_altrif");
                    $numschrif6 = pg_result($rrif6, $x,"numsch_altrif");
                    $idaltrifprinc = pg_result($rrif6, $x,"id");
                    echo "<a href=\"scheda_archeo.php?id=$idrif6\" target=\"_blank\" class=\"altrif ".$nomeforeach[1]."\">$numschrif6</a>";
                    if ($_SESSION['username']!='guest'){echo '<a href="javascript:removeCorrela('.$idaltrifprinc.')"><i class="fa fa-times avviso"></i></a>   ';             }
                   }
                   echo '</div><br/>';
                  }
                }
              ?>

         <?php if($_SESSION['username']!='guest') {?>

              <label class="update" id="newschedacorr">Aggiungi scheda</label>

              <div class="updateContent" style="display:none">
               <div id="newschedacorr_form">
                  <label>Inizia a digitare il nome della scheda da associare (es. "ARCHEO-"), la ricerca non e' case sensitive.</label>
                  <input class="form" id="termfiga" style="width:150px !important;"/>
                  <label id="numItems"></label>
                  <div id="resultfiga">
                  </div>

                  <div  id="newschedacorr_update" class="login2" style="margin-top:20px;">Aggiungi schede</div>
                  <div class="chiudiForm login2">Annulla</div>
                </div>
              </div>
          <?php } ?>

             </td>
           </tr>
          </table>
        </div>
       </div>
      <?php if($hub==1){ ?>
       <div class="toggle check bassa">
        <div class="sezioni"><h2>NOTE GENERALI</h2></div>
        <div class="slide">
         <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <div class="valori" style="height:240px !important"><?php echo(nl2br($note2)); ?></div>
             </td>
            </tr>
            <?php if($_SESSION['username']!='guest') {?>
          <tr>
           <td>
             <label class="update" id="note">modifica sezione</label>
           </td>
          </tr>
          <?php } ?>
          </table>
          <div class="updateContent" style="display:none">
           <?php require("inc/form_update/note.php"); ?>
          </div>
        </div>
      </div>
     <?php } ?>
   </div>
<?php require("inc/".$tab.".php"); ?>

<?php if($hub==2){ ?>
 <div class="inner">
  <div class="toggle check bassa">
   <div class="sezioni" style="border:none !important"><h2>COMPILAZIONE</h2></div>
    <div class="slide">
     <table class="mainData" style="width:98% !important;">
      <tr>
       <td width="50%;">
        <label>DENOMINAZIONE RICERCA</label>
        <div class="valori"><?php echo($denric); ?></div>
        <br/>
        <label>COMPILATORE</label>
        <div class="valori"><?php echo($compilatore); ?></div>
        <br/>
        <label>DATA</label>
        <div class="valori"><?php echo($datacmp); ?></div>
       </td>
       <td>
        <label>ENTE RESPONSABILE</label>
        <div class="valori"><?php echo($enresp); ?></div>
        <br/>
        <label>RESPONSABILE RICERCA</label>
        <div class="valori"><?php echo($respric); ?></div>
        <br/>
        <label>NOTE</label>
        <div class="valori"><?php echo($notecmp); ?></div>
       </td>
      </tr>
      <?php if($_SESSION['username']!='guest') {?>
      <tr>
       <td colspan="2">
        <label class="update" id="compilazione">modifica sezione</label>
       </td>
      </tr>
      <?php } ?>
     </table>
     <div class="updateContent" style="display:none">
      <?php require("inc/form_update/compilazione.php"); ?>
     </div>
    </div>
   </div>
  </div>
 <?php } ?>

   <div class="inner noPrint" id="last">
    <div class="inner check" style="width:250px !important; float:left; margin-right:10px;">
     <label>SCHEDE DI PRIMO LIVELLO</label><br />
     <?php
      $q1 = ("SELECT a.id, a.id_parente, s.dgn_numsch
              FROM scheda s, altrif_parenti a
              WHERE a.id_parente = s.id AND a.id_scheda = $id and s.livello = 1 order by dgn_numsch asc ;");
      $r1 = pg_query($connection, $q1);
      $righe1 = pg_num_rows($r1);

      if($righe1 != 0) {
        for ($x = 0; $x < $righe1; $x++){
         $ap_id1 = pg_result($r1, $x,"id");
         $id_parente1 = pg_result($r1, $x,"id_parente");
         $ap_dgn_numsch1 = pg_result($r1, $x,"dgn_numsch");
         echo "<a href=\"scheda_archeo.php?id=$id_parente1\" target=\"_blank\" class=\"altrif $stile\">$ap_dgn_numsch1</a>  ";
         if ($_SESSION['username']!='guest'){echo '<a href="javascript:removeParente('.$ap_id1.')"><img style="width:10px;height:10px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACHElEQVR42n2T70tTYRTHB73ddPfubq6ld5utYOQ2lsRYm7IyK6xBoC8CK+jHin5AWLEQgugPkG48OlEqMtIKhKAfrhFkJOVwlYVBSe1FvvDFSFj0B3x7zr1udOvOA1/Oc87nex547uGaTP9ErsHsM9WItZgp22Bex6W8CnpB2YDXZGo8c5gzn3q78HtyAHP74+C18hdj73s6VEaZvLrhxw4L+3BwL8ojF1Dqi6F8qx/5fXHwvkKs0N2B8mhaZb9uXgbV1FeHHzksvlyLFz8Hz2P5zDZN5yJYGUnjTVcM+QMJrAxfxPLZSJVTnfXL4LOyesmk3cKmwy78OBbG0vFVpVpRGrqEEuvD0onWap88L0Mu0IzuGQ/sdexF0IXvvQEUD63qSAjFw6FqTSwXWA/yGn7IcamOZbc48bXbj8Uevag35XeCPDVXOSbVs1x7GAvJzfic9Om0kNyEbCwI7jFe421bPXve2Ybi1ZOY392M+U6PTh/3bETx2mlM7YyCe/WXjNqsytNdcXy7kkIhIaPQ3qhqrk1TpX6XcHPPKTzZsR18RnvKsGj1jvk8+JI+itmoC7MRp6q3XPfdNjz0SOq50s9HN2CxP4U7zW7wWW2Ng6JVmZBteL1VwgwX5XFZBO8zEp0rjDTh1pjuGTdEgd1tFDHdIoAy1TrWxFlAwL0mgVjG8ENeFwRlSBJA2YCxjF1ltddIMSAI8hrsv9/5D5EYVSAsqeh8AAAAAElFTkSuQmCC"></a>';}
        }
     }
     ?>
    </div>

    <div class="inner check" style="width:324px !important; float:left; margin-right:10px;">
     <label>SCHEDE DI SECONDO LIVELLO</label><br />
     <?php
      $q2 = ("SELECT a.id, a.id_parente, s.dgn_numsch
              FROM scheda s, altrif_parenti a
              WHERE a.id_parente = s.id AND a.id_scheda = $id and s.livello = 2 order by dgn_numsch asc ;");
      $r2 = pg_query($connection, $q2);
      $righe2 = pg_num_rows($r2);

      if($righe2 != 0) {
        for ($x = 0; $x < $righe2; $x++){
         $ap_id2 = pg_result($r2, $x,"id");
         $id_parente2 = pg_result($r2, $x,"id_parente");
         $ap_dgn_numsch2 = pg_result($r2, $x,"dgn_numsch");
         echo "<a href=\"scheda_archeo.php?id=$id_parente2\" target=\"_blank\" class=\"altrif $stile\">$ap_dgn_numsch2</a>  ";
         if ($_SESSION['username']!='guest'){echo '<a href="javascript:removeParente('.$ap_id2.')"><img style="width:10px;height:10px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACHElEQVR42n2T70tTYRTHB73ddPfubq6ld5utYOQ2lsRYm7IyK6xBoC8CK+jHin5AWLEQgugPkG48OlEqMtIKhKAfrhFkJOVwlYVBSe1FvvDFSFj0B3x7zr1udOvOA1/Oc87nex547uGaTP9ErsHsM9WItZgp22Bex6W8CnpB2YDXZGo8c5gzn3q78HtyAHP74+C18hdj73s6VEaZvLrhxw4L+3BwL8ojF1Dqi6F8qx/5fXHwvkKs0N2B8mhaZb9uXgbV1FeHHzksvlyLFz8Hz2P5zDZN5yJYGUnjTVcM+QMJrAxfxPLZSJVTnfXL4LOyesmk3cKmwy78OBbG0vFVpVpRGrqEEuvD0onWap88L0Mu0IzuGQ/sdexF0IXvvQEUD63qSAjFw6FqTSwXWA/yGn7IcamOZbc48bXbj8Uevag35XeCPDVXOSbVs1x7GAvJzfic9Om0kNyEbCwI7jFe421bPXve2Ybi1ZOY392M+U6PTh/3bETx2mlM7YyCe/WXjNqsytNdcXy7kkIhIaPQ3qhqrk1TpX6XcHPPKTzZsR18RnvKsGj1jvk8+JI+itmoC7MRp6q3XPfdNjz0SOq50s9HN2CxP4U7zW7wWW2Ng6JVmZBteL1VwgwX5XFZBO8zEp0rjDTh1pjuGTdEgd1tFDHdIoAy1TrWxFlAwL0mgVjG8ENeFwRlSBJA2YCxjF1ltddIMSAI8hrsv9/5D5EYVSAsqeh8AAAAAElFTkSuQmCC"></a>';}
        }
     }
     ?>
    </div>

    <div class="inner check" style="width:350px !important; float:left;">
      <label>SCHEDE DI TERZO LIVELLO</label><br />
     <?php
      $q3 = ("SELECT a.id, a.id_parente, s.dgn_numsch
              FROM scheda s, altrif_parenti a
              WHERE a.id_parente = s.id AND a.id_scheda = $id and s.livello = 3 order by dgn_numsch asc ;");
      $r3 = pg_query($connection, $q3);
      $righe3 = pg_num_rows($r3);

      if($righe3 != 0) {
        for ($x = 0; $x < $righe3; $x++){
         $ap_id3 = pg_result($r3, $x,"id");
         $id_parente3 = pg_result($r3, $x,"id_parente");
         $ap_dgn_numsch3 = pg_result($r3, $x,"dgn_numsch");
         echo "<a href=\"scheda_archeo.php?id=$id_parente3\" target=\"_blank\" class=\"altrif $stile\">$ap_dgn_numsch3</a>  ";
         if ($_SESSION['username']!='guest'){echo '<a href="javascript:removeParente('.$ap_id3.')"><img style="width:10px;height:10px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACHElEQVR42n2T70tTYRTHB73ddPfubq6ld5utYOQ2lsRYm7IyK6xBoC8CK+jHin5AWLEQgugPkG48OlEqMtIKhKAfrhFkJOVwlYVBSe1FvvDFSFj0B3x7zr1udOvOA1/Oc87nex547uGaTP9ErsHsM9WItZgp22Bex6W8CnpB2YDXZGo8c5gzn3q78HtyAHP74+C18hdj73s6VEaZvLrhxw4L+3BwL8ojF1Dqi6F8qx/5fXHwvkKs0N2B8mhaZb9uXgbV1FeHHzksvlyLFz8Hz2P5zDZN5yJYGUnjTVcM+QMJrAxfxPLZSJVTnfXL4LOyesmk3cKmwy78OBbG0vFVpVpRGrqEEuvD0onWap88L0Mu0IzuGQ/sdexF0IXvvQEUD63qSAjFw6FqTSwXWA/yGn7IcamOZbc48bXbj8Uevag35XeCPDVXOSbVs1x7GAvJzfic9Om0kNyEbCwI7jFe421bPXve2Ybi1ZOY392M+U6PTh/3bETx2mlM7YyCe/WXjNqsytNdcXy7kkIhIaPQ3qhqrk1TpX6XcHPPKTzZsR18RnvKsGj1jvk8+JI+itmoC7MRp6q3XPfdNjz0SOq50s9HN2CxP4U7zW7wWW2Ng6JVmZBteL1VwgwX5XFZBO8zEp0rjDTh1pjuGTdEgd1tFDHdIoAy1TrWxFlAwL0mgVjG8ENeFwRlSBJA2YCxjF1ltddIMSAI8hrsv9/5D5EYVSAsqeh8AAAAAElFTkSuQmCC"></a>';}
        }
     }
     ?>
    </div>
    <div style="clear:both"></div>
    <?php if($_SESSION['username']!='guest') {?>
      <div class="check"><label class="update" id="newParente">Aggiungi scheda</label></div>
      <div class="updateContent" style="display:none">
        <div id="newParente_form">
          <label>Inizia a digitare il nome della scheda da associare (es. "ARCHEO-"), la ricerca non e' case sensitive.</label>

          <input class="form" id="termfiga2" style="width:150px !important; margin-top:10px !important;"/>
          <label id="numItems2"></label>
          <div id="resultfiga2"></div>
          <div  id="newParenteUpdate" class="login2" style="margin-top:20px;">Aggiungi schede</div>
          <div class="chiudiForm login2">Annulla</div>
        </div>
      </div>
    <?php } ?>

    <?php if ($_SESSION['username']!='guest'){  ?>
      <div id="fine">
       <label style="display:block;text-align:center;">La scheda risulta <?php echo($statoScheda); ?>.
       <?php if($tipoUsr != 3) {?>Utilizza il pulsante in basso per cambiare lo stato della scheda.</label>
       <br/>
       <label style="display:block;text-align:center;" class="update" id="upStatoScheda" <?php echo($upStatoScheda);?>>modifica stato</label>
      </div>
     <?php }} ?>
   </div>
   </div> <!-- test -->
 </div><!--skArcheoContent-->
 </div><!--content-->
 <div id="footer"><?php require_once ("inc/footer.php"); ?></div><!--footer-->
 </div><!-- wrap-->
 </div><!--container-->

 <!--div invisibili -->
 <div id="delDialog" style="display:none; text-align:center;">
 <h2>Hai scelto di eliminare la scheda <b><?php echo ($numsch); ?></b></h2>
 <p>Il record potrebbe avere diversi elementi collegati, eliminadolo cancellerai definitivamente tutti i dati.</p>
 <p>Sei sicuro di voler eliminare il record?</p>
 <div id="no" class="login2" style="margin-top:20px;" id="compilazione_update">NO, non eliminare</div>
 <div id="si" class="login2">SI, procedi con l'eliminazione</div>
</div>

<div id="delFotoDialog" style="display:none; text-align:center;">
 <h2>Sei proprio sicuro di voler eliminare definitivmente la foto?</h2>
 <div id="noFoto" class="login2" style="margin-top:20px;" id="compilazione_update">NO, non eliminare</div>
 <div id="siFoto" class="login2">SI, procedi con l'eliminazione</div>
</div>

<div id="fotoOrig" style="display:none;"><img src="foto/<?php echo($img); ?>" /></div>

  <script type="text/javascript" src="lib/OpenLayers-2.12/OpenLayers.js"></script>
  <script src="http://maps.google.com/maps/api/js?v=3.2&amp;sensor=false"></script>
  <script type="text/javascript" src="lib/menu.js"></script>
  <script type="text/javascript" src="lib/select.js"></script>
  <script type="text/javascript" src="lib/update.js"></script>
  <script type="text/javascript" src="lib/funzioniScheda.js"></script>

<script type="text/javascript" >
var hub = '<?php echo($hub); ?>'
var id = '<?php echo($id); ?>';
var tiposch = '<?php echo($tpsch); ?>';
var pag = '<?php echo($pag); ?>';
var livello = '<?php echo($livello); ?>';

var tipoUsr = '<?php echo($tipoUsr); ?>';
var compilatore = '<?php echo($id_compilatore); ?>';
var idUsr = '<?php echo($idUsr); ?>';
var schede = '<?php echo($schedeUsr); ?>';
var scheda = '<?php echo($tipologiaScheda); ?>';

$(document).ready(function() {
    $(window).bind('beforeunload', function(){
        $.ajax({
            type: "POST",
            url: "loginScript.php",
            data: {login:'no'},
            cache: false
        });
    });
    $('.submenu').hide();
    $("#sessionMenu li").on({
         mouseenter: function() {$(this).find('.submenu').slideDown('fast');}
        ,mouseleave: function() {$(this).find('.submenu').slideUp('fast');}
    });
    if(hub==2){$( "div.check:not([class~='bassa'])" ).remove();}
    $("a#removeArea").click(function(e){
        e.preventDefault();
        var id = $(this).data('id');
        removeArea(id);
    });
    $("#submitFile").hide();
    $('#file').bind('change', function (e) { $("#submitFile").show(); });

    $(".print").on("click", function(){ window.print();});


////////////// SHOW/HIDE modifica sezione /////////////////
    if ( (tipoUsr == 1)||((tipoUsr==2)&&(schede.indexOf(scheda)!=-1))||(idUsr==compilatore)) {
        $('.update').show();
    } else {
        $('.update').hide();
    }
////////////////////////////////////////////////////////////////
    $( "#termfiga" ).autocomplete({
        source: "inc/autocomplete.php",
        minLength: 2,
        select: function( event, ui ) {
            $("#resultfiga").append("<div class='schAssoc' livello='"+ui.item.livello+"'tpsch='"+ui.item.tpsch+"' id='"+ui.item.id+"'>"+ui.item.value+"</div>");
            $(this).val("");
            numItems = $('.schAssoc').length;
            $('#numItems').text('Schede associate: '+numItems);
            $("#schAssocCanc").fadeIn('slow');
            event.preventDefault();
        }
    });

    $( "#termfiga2" ).autocomplete({
        source: "inc/autocomplete3.php?tpsch=<?php echo($tpsch);?>",
        minLength: 2,
        select: function( event, ui ) {
            $("#resultfiga2").append("<div class='schAssoc2' id_scheda='"+id+"' id_parente='"+ui.item.id_parente+"'>"+ui.item.value+"</div>");
            $(this).val("");
            numItems2 = $('.schAssoc2').length;
            $('#numItems2').text('Schede parenti: '+numItems2);
            $("#schParentiCanc").fadeIn('slow');
            event.preventDefault();
        }
    });

    $('#liv'+livello).addClass('livAttivo');
    $('.slide').hide();
    $('.toggle > div > h2').click(function(){$(this).parent().next('.slide').slideToggle(); });
    $("#switchImg").attr("checked", true);
    $(".switchImgMapButton").change(function(){ $("#imgDiv").slideToggle("fast"); });
//////////  AGGIORNA STATO SCHEDA ///////////////
    $('#upStatoScheda').click(function(){
        var upStato = $(this).attr('upVal');
        $.ajax({
            url: 'inc/updateStatoScheda.php',
            type: 'POST',
            data: {id:id, upStato:upStato},
            success: function(data){ $(data).dialog().delay(2500).fadeOut(function(){ window.location.href = 'scheda_archeo.php?id='+id; }); }
        });//ajax
    });
//////////  ELIMINA SCHEDA ///////////////
    $('#elimina_scheda').click(function(){
        var id_scheda = $(this).attr('scheda');
        $("#delDialog").dialog({
            resizable:false,
            height: 300,
            width: 500,
            title: "ATTENZIONE!!!"
        });
        $('#si').click(function(){
            $.ajax({
                url: 'inc/deleteScheda.php',
                type: 'POST',
                data: {id_scheda:id_scheda},
                success: function(data){ $(data).dialog().delay(2500).fadeOut(function(){ window.location.href = 'catalogo.php'; }); }
            });//ajax
        });

        $('#no').click(function(){$(this).closest('.ui-dialog-content').dialog('close');});
    });
//////////  ELIMINA FOTO ///////////////
    $('#delFoto').click(function(){
        var id_scheda = $(this).attr('scheda');
        var file = $(this).attr('img');
        $("#delFotoDialog").dialog({
            resizable:false,
            height: 300,
            width: 500,
            title: "ATTENZIONE!!!"
        });
        $('#siFoto').click(function(){
            $.ajax({
                url: 'inc/deleteFoto.php',
                type: 'POST',
                data: {id_scheda:id_scheda, file:file},
                success: function(data){ $(data).dialog().delay(2500).fadeOut(function(){ window.location = window.location; }); }
            });//ajax
        });
        $('#noFoto').click(function(){$(this).closest('.ui-dialog-content').dialog('close');});
    });
//////////// ingrandisci foto  //////////////////
    $('#ingrFoto').click(function () {
        $('#fotoOrig').dialog({resizable:false,modal:true,width: 'auto'});
    });
///////// FORM UPDATE /////////////////
    $('.update').click(function(){
        var form = $(this).attr('id');
        $('#'+form+'_form').dialog({
            autoOpen: false,
            resizable:false,
            modal:true,
            height: 'auto',
            width: 500,
            title: "Modifica sezione"
        });
        if ($(this).attr('rel')) {
            $('.sez').hide();
            $('#'+$(this).attr('rel')).show();
        }
        $('#'+form+'_form').dialog("open");
        $('#'+form+'_form').dialog("option", "position", ['center','center']);
        return false;
    });//click
    $('.chiudiForm').click(function(){ $(this).closest('.ui-dialog-content').dialog('close'); });
    var imgThumb = $('#imgOrig');
    var maxWidth = 400; // Max width for the image
    var minHeight = 300;    // Max height for the image
    var ratio = 0;  // Used for aspect ratio
    var width = imgThumb.width();
    var height = imgThumb.height();
    if (width >= height) {
        ratio = maxWidth / width;   // get ratio for scaling image
        height = height * ratio;    // Reset height to match scaled image
        if (height > 300) {
   	        ratio2 = minHeight / height;
   	        width = 400 * ratio2;    // Reset width to match scaled image
            $('#imgSmall').css({width:width, height:minHeight});
            height = height * ratio2;
        }else {
   	        $('#imgSmall').css({width:maxWidth, height:height});
            width = width * ratio;    // Reset width to match scaled image
        }
    }
    if(height > width){
        ratio = minHeight / height;
        width = width * ratio;    // Reset width to match scaled image
        $('#imgSmall').css({width:width, height:minHeight});
        height = height * ratio;
    }
    $(".arrow_box").hide();
    $("i").hover(function(){
        var tip = $(this).data('class');
        $("."+tip).toggle();
    });
});

var mappa, gsat, aree, linee, arrayOSM, osm;
var extent, extent2, bound, coo, numPoly, numLine, format, stile, param;
var bingKey = 'Arsp1cEoX9gu-KKFYZWbJgdPEa8JkRIUkxcPr8HBVSReztJ6b0MOz3FEgmNRd4nM';
OpenLayers.ProxyHost = "/cgi-bin/proxy.cgi?url=";
format = 'image/png';
numPoly = '<?php echo($numPoly); ?>';
numLine = '<?php echo($numLine); ?>';
param = '<?php echo($param);?>';
stile='<?php echo($stile);?>';
var cql = param.slice(0, -4);

if ((numPoly > 0 && numLine >= 0)){
    coo = '<?php echo($extent);?>';
    bound = coo.split(',');
    console.log(bound, '\n'+cql);
}

if ((numPoly == 0 && numLine > 0)){
	coo = '<?php echo($extent2);?>';
    bound = coo.split(',');
}
function init() {
    extent = new OpenLayers.Bounds(bound[0], bound[1], bound[2], bound[3]);
    var options = {
        controls: [ new OpenLayers.Control.Navigation(), new OpenLayers.Control.Zoom() ],
        resolutions: [156543.03390625, 78271.516953125, 39135.7584765625, 19567.87923828125, 9783.939619140625, 4891.9698095703125, 2445.9849047851562,     1222.9924523925781, 611.4962261962891, 305.74811309814453, 152.87405654907226, 76.43702827453613, 38.218514137268066, 19.109257068634033, 9.554628534317017, 4.777314267158508, 2.388657133579254, 1.194328566789627, 0.5971642833948135, 0.29858214169740677, 0.14929107084870338, 0.07464553542435169, 0.037322767712175846, 0.018661383856087923, 0.009330691928043961, 0.004665345964021981, 0.0023326729820109904, 0.0011663364910054952, 5.831682455027476E-4, 2.915841227513738E-4, 1.457920613756869E-4],
        maxExtent:new OpenLayers.Bounds (-20037508.34,-20037508.34,20037508.34,20037508.34),
        units: 'm',
        projection: new OpenLayers.Projection("EPSG:900913"),
        displayProjection: new OpenLayers.Projection("EPSG:4326")
    };//options
    mappa = new OpenLayers.Map('smallMap', options);
    gsat = new OpenLayers.Layer.Bing({name: "Aerial",key: bingKey,type: "Aerial"});
    mappa.addLayer(gsat);
    arrayOSM = ["http://otile1.mqcdn.com/tiles/1.0.0/map/${z}/${x}/${y}.jpg", "http://otile2.mqcdn.com/tiles/1.0.0/map/${z}/${x}/${y}.jpg", "http://otile3.mqcdn.com/tiles/1.0.0/map/${z}/${x}/${y}.jpg", "http://otile4.mqcdn.com/tiles/1.0.0/map/${z}/${x}/${y}.jpg"];
    osm = new OpenLayers.Layer.OSM(" MapQuest", arrayOSM, {
        attribution: "Data, imagery and map information provided by <a href='http://www.mapquest.com/'  target='_blank'>MapQuest</a>, <a href='http://www.openstreetmap.org/' target='_blank'>Open Street Map</a> and contributors, <a href='http://creativecommons.org/licenses/by-sa/2.0/' target='_blank'>CC-BY-SA</a>  <img src='http://developer.mapquest.com/content/osm/mq_logo.png' border='0'>",
        transitionEffect: "resize"
    });
    mappa.addLayer(osm);
    var report = function(e) { OpenLayers.Console.log(e.type, e.feature.id); };
    if (numPoly != 0) {
        aree = new OpenLayers.Layer.WMS("Aree","http://www.lefontiperlastoria.it:80/geoserver/fonti/wms",{
	        layers: 'fonti:area_int_poly',
	        styles: stile,
	        srs: 'EPSG:3857',
            format: 'image/png',
            transparent: true,
            CQL_FILTER: cql
        },{
            isBaseLayer: false,
            tileSize: new OpenLayers.Size(256,256)
        });
        mappa.addLayer(aree);
    }
    if(numLine != 0){
        linee = new OpenLayers.Layer.WMS("Tracciati","http://www.lefontiperlastoria.it:80/geoserver/fonti/wms",{
            layers: 'fonti:area_int_line',
            styles: stile+'_linea',
            srs: 'EPSG:3857',
            format: 'image/png',
            transparent: true,
            CQL_FILTER: cql
        },{
            isBaseLayer: false,
            tileSize: new OpenLayers.Size(256,256)
        });
        mappa.addLayer(linee);
    }
    if (!mappa.getCenter()) {mappa.zoomToExtent(extent);}
}
</script>
</body>
</html>
