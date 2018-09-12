<?php
session_start();
require("inc/db.php");
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
if($_SESSION['hub']){
 $hub=$_SESSION['hub'];
}else{
 if($_GET['hub']){
  $hub=$_GET['hub'];
 }
}
$title = ($hub==2)?'Archivio iconografico dei Paesaggi di Comunità':'Le fonti per la storia. Per un archivio delle fonti sulle valli di Primiero e Vanoi';

////  LISTA TOPONIMI PER FUNZIONE ZOOM ////////
$topoQ="select toponomastica.gid, upper(top_nomai) toponimo, upper(comu2) comune, st_X(st_transform((geom),3857))||','||st_Y(st_transform((geom),3857)) as lonlat from toponomastica, comuni where st_contains(comuni.the_geom, st_transform(toponomastica.geom,3857)) order by 3,2;";
$topoR=pg_query($connection,$topoQ);
$opt="<option value='0'>--zoom su località--</option>";
while($topo = pg_fetch_array($topoR)){
    $opt.="<option value='".$topo['lonlat']."'>".$topo['comune']." - ".$topo['toponimo']."</option>";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//IT"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="IT" >
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="author" content="Giuseppe Naponiello" />
  <meta name="keywords" content="Trentino, Trento, Belluno, Dolomiti, Primiero, Vanoi, Fonti, storia, archeologia, orali, fotografia, arte, restauro, gfoss, openlayer, jquery, grass, postgresql, postgis, qgis, webgis" />
  <meta name="description" content="Le fonti per la storea. Per un archivio delle fonti sulle valli di Primiero e Vanoi" />
  <meta name="robots" content="INDEX,FOLLOW" />
  <meta name="copyright" content="&copy;2011 Museo Provinciale" />

  <title><?php echo $title; ?></title>

<link href="css/mappa.css" type="text/css" rel="stylesheet" media="screen" />
<link href="css/google.css" rel="stylesheet" type="text/css">
<link href="lib/OpenLayers-2.11/theme/default/style.css" rel="stylesheet" type="text/css">
<link href="lib/jquery-ui-1.11.4/jquery-ui.min.css" type="text/css" rel="stylesheet" media="screen" />
<?php if($hub!=2){?><link rel="shortcut icon" href="img/icone/favicon.ico" /><?php } ?>

</head>
 <body onload="init()">
  <div id="map"></div>

<?php if($hub!=2){?>
  <div id="logo" class="hover"></div>
  <div id="logo2Wrap">
   <div id="logo2" class="logoTondo">
    <div id="database" title="Da questo link potrai accedere alla pagina di ricerca.">
     <p>DATABASE</p>
    </div>
   </div>
  </div>
<?php }else{ ?>
 <div id="wrapLogoAvs">
  <div id="headLogo" class="headDiv"></div>
  <div id="headTitle" class="headDiv bianco">
   <h1>ARCHIVIO ICONOGRAFICO DEI PAESAGGI DI COMUNITÀ</h1>
   <h2>Comunità Alta Valsugana e Bersntol<br>Tolgamoa'schòft Hoa Valzegu' ont Bersntol</h2>
  </div>
 </div>
<?php } ?>
  <div id="pannello"></div>
    <div id="drag" class="attivo"></div>
    <div id="zoomArea"></div>
    <div id="zoomMax"></div>
    <div id="history">
      <div id="btnPrev"></div>
      <div id="btnNext"></div>
    </div>
  <div id="nord"></div>

    <div id="topoSearch">
        <select><?php echo $opt; ?></select>
    </div>

    <div id="text">
        <div id="switcher">
            <div id="cartografiaToggle"><h1 class="switcher">CARTOGRAFIA DI BASE</h1></div>
            <div id='cartografiaSwitch'>
                <div class="livelli">
                    <label for="gsat">
                        <input type="radio" name="baselayer" id="gsat" value="gsat" class='checkLiv' onclick="map.setBaseLayer(gsat)" checked />
                        SATELLITE
                    </label>
                </div>
                <div class="livelli">
                    <label for="osm">
                        <input type="radio" name="baselayer" value="osm" id="osm" class='checkLiv' onclick="map.setBaseLayer(osm)" />
                        OPENSTREETMAP
                    </label>
                </div>
            </div>

            <div id="areaToggle" class="hover tip" title="Mostra/nascondi le aree di interesse">
                <h1 class="switcher">AREA DI INTERESSE</h1>
            </div>
            <div id='areaSwitch' class="chiuso"></div>
            <?php if($hub!=2){?>
            <div id="ubiToggle" class="hover tip" title="Mostra/nascondi le ubicazioni">
                <h1 class="switcher">UBICAZIONE FONTE</h1>
            </div>
            <div id='ubiSwitch' class="chiuso"></div>
            <?php } ?>
        </div>
        <?php if($hub!=2){?>
            <div id="ricerca">
                <div id="ricercaToggle"  class="tip" title="Mostra/nascondi i form per la ricerca avanzata"><h1>RICERCA</h1></div>
                <div id="formRicerca" class="chiuso">
                    <div class="sezioni" id="datiGenerali"><h2>DATI GENERALI</h2></div>
                    <div class="sezioni" id="compilazione"><h2>COMPILAZIONE</h2></div>
                    <div class="sezioni" id="provenienza"><h2>PROVENIENZA</h2></div>
                    <div class="sezioni" id="cronologia"><h2>CRONOLOGIA</h2></div>
                    <div class="sezioni" id="anagrafica"><h2>ANAGRAFICA</h2></div>
                    <div class="sezioni" id="documentazione"><h2>DOCUMENTAZIONE</h2></div>
                    <div class="sezioni" id="consultabilita"><h2>CONSULTABILITA'</h2></div>
                    <div class="sezioni" id="conservazione"><h2>STATO DI CONSERVAZIONE</h2></div>
                    <div class="sezioni" id="archeologica"><h2>ARCHEOLOGICA</h2></div>
                    <div class="sezioni" id="architettonica"><h2>ARCHITETTONICA</h2></div>
                    <div class="sezioni" id="archivistica"><h2>ARCHIVISTICA</h2></div>
                    <div class="sezioni" id="bibliografica"><h2>BIBLIOGRAFICA</h2></div>
                    <div class="sezioni" id="cultura"><h2>CULTURA MATERIALE</h2></div>
                    <div class="sezioni" id="fotografica"><h2>FOTOGRAFICA</h2></div>
                    <div class="sezioni" id="orale"><h2>ORALE</h2></div>
                    <div class="sezioni" id="storicoArtistica"><h2>STORICO-ARTISTICA</h2></div>
                </div><!--div formRicerca -->
            </div><!-- div ricerca -->
        <?php } ?>
    </div><!--div text -->
    <div id="scalebar"></div>
    <div id="coord"></div>
    <div id="resultWrap">
        <div id="result">
            <div id="resultHeader">
                <div id="resHeadImg" data-icon='&#10006;'>&#10006;</div>
            </div>
            <div id="resultContent"></div>
        </div>
    </div>
    <script type="text/javascript" src="lib/jquery-core/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="lib/jquery-ui-1.11.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="lib/OpenLayers-2.12/OpenLayers.js"></script>
    <script type="text/javascript" src="lib/OpenLayers-2.10/ScaleBar.js"></script>
    <script src="https://www.openstreetmap.org/openlayers/OpenStreetMap.js"></script>
    <script src="js/vargeom.js"></script>
    <script src="lib/webgis.js"></script>
    <script type="text/javascript">
    var hub = '<?php echo($hub); ?>';
    $(document).ready(function() {
        (function ($) {
            $.fn.clickToggle = function (func1, func2) {
                var funcs = [func1, func2];
                this.data('toggleclicked', 0);
                this.click(function () {
                    var data = $(this).data();
                    var tc = data.toggleclicked;
                    $.proxy(funcs[tc], this)();
                    data.toggleclicked = (tc + 1) % 2;
                });
                return this;
            };
        }(jQuery));

        $("#resHeadImg").clickToggle(
            function() {$("#result").animate({ left: '-290px' });},
            function() {$("#result").animate({ left: '0px' });}
        );

        if(hub==2){
            $( "#areaSwitch > div:not([class~='bassa'])" ).remove();
            $( "#ubiSwitch > div:not([class~='bassa'])" ).remove();
            $("#wrapLogoAvs").click(function(){ window.location.href='avs/index.php'; })
        }
    });
    </script>
    </body>
</html>
