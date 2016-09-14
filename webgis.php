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
    <select>
        <?php echo $opt; ?>
    </select>
  </div>

  <div id="text">
   <div id="switcher">
    <div id="cartografiaToggle"><h1 class="switcher">CARTOGRAFIA DI BASE</h1></div>
    <div id='cartografiaSwitch'>
     <div class="livelli">
      <input type="radio" name="baselayer" value="gsat" class='checkLiv' onclick="map.setBaseLayer(gsat)" checked /> SATELLITE
     </div>
     <div class="livelli">
      <input type="radio" name="baselayer" value="osm" class='checkLiv' onclick="map.setBaseLayer(osm)" />OPENSTREETMAP
     </div>
     <div class="livelli">
      <input type="checkbox" name="baselayer" id="comuni"class='checkLiv' value="comuni" checked/><label id="comuniLabel">COMUNI</label>
     </div>
     <div class="livelli">
      <input type="checkbox" name="baselayer" id="toponomastica"class='checkLiv' value="toponomastica" checked/><label id="toponomasticaLabel">TOPONOMASTICA</label>
     </div>
    </div><!--cartografiaSwitch-->

    <div id="areaToggle" class="hover tip" title="Mostra/nascondi le aree di interesse"><h1 class="switcher">AREA DI INTERESSE</h1></div>
    <div id='areaSwitch' class="chiuso">
     <div class="livelli">
      <input type="checkbox" name="overlays" id="aree_archeo" value="aree_archeo" data-tipo="6" class='checkLiv ai'/>
      <label for="aree_archeo" id="areeArcheoLabel" class="info" title="Il livello mostra le aree di interesse archeologico...">ARCHEOLOGICA</label>
      <div class="legende legendeAree legendeAreeArcheo"></div>
     </div>
     <div class="livelli">
      <input type="checkbox" name="overlays" id="aree_architet" value="aree_architet" data-tipo="8" class='checkLiv ai' />
      <label for="aree_architet" id="areeArchitetLabel" class="info" title="Il livello mostra le aree di interesse architettonico...">ARCHITETTONICA</label>
      <div class="legende legendeAree legendeAreeArchitet"></div>
     </div>
     <div class="livelli">
      <input type="checkbox" name="overlays" id="aree_archiv" value="aree_archiv" data-tipo="4" class='checkLiv ai' />
      <label for="aree_archiv" id="areeArchivLabel" class="info" title="Il livello mostra le aree di interesse archivistico...">ARCHIVISTICA</label>
      <div class="legende legendeAree legendeAreeArchiv"></div>
     </div>
     <div class="livelli">
      <input type="checkbox" name="overlays" id="aree_biblio" value="aree_biblio" data-tipo="5" class='checkLiv ai' />
      <label for="aree_biblio" id="areeBiblioLabel"  class="info" title="Il livello mostra le aree di interesse bibliografico...">BIBLIOGRAFICA</label>
      <div class="legende legendeAree legendeAreeBiblio"></div>
     </div>
     <div class="livelli">
      <input type="checkbox" name="overlays" id="aree_cult" value="aree_cult" data-tipo="2" class='checkLiv ai' />
      <label for="aree_cult" id="areeCultLabel"  class="info" title="Il livello mostra le aree di interesse per la cultura materiale del luogo...">CULTURA MATERIALE</label>
      <div class="legende legendeAree legendeAreeCult"></div>
     </div>
     <div class="livelli bassa">
      <input type="checkbox" name="overlays" id="aree_foto" value="aree_foto" data-tipo="7" class='checkLiv ai' />
      <label for="aree_foto" id="areeFotoLabel"  class="info" title="Il livello mostra le aree di interesse fotografico...">FOTOGRAFICA </label>
      <div class="legende legendeAree legendeAreeFoto"></div>
     </div>
     <div class="livelli">
      <input type="checkbox" name="overlays" id="aree_orale" value="aree_orale" data-tipo="1" class='checkLiv ai' />
      <label for="aree_orale" id="areeOraleLabel" class="info" title="Il livello mostra le aree di interesse per le fonti orali...">ORALE</label>
      <div class="legende legendeAree legendeAreeOrale"></div>
     </div>
     <div class="livelli">
      <input type="checkbox" name="overlays" id="aree_stoart" value="aree_stoart" data-tipo="9" class='checkLiv ai' />
      <label for="aree_stoart" id="areeStoArtLabel" class="info" title="Il livello mostra le aree di interesse storico-artistico...">STORICO-ARTISTICA</label>
      <div class="legende legendeAree legendeAreeStoArt"></div>
     </div>
     <div class="livelli bassa">
      <div class="sliderLivelli">
       <div class="sliderOpacity" id="sliderArea"> <div class="ui-slider-handle"></div> </div>
       <span class="amount" id="amountAree"></span>
      </div>
     </div>
    </div><!--areaSwitch-->
    <?php if($hub!=2){?>
    <div id="ubiToggle" class="hover tip" title="Mostra/nascondi le ubicazioni"><h1 class="switcher">UBICAZIONE FONTE</h1></div>
    <div id='ubiSwitch' class="chiuso">
     <div class="livelli">
      <label for="ubi_archeo" id="ubiArcheoLabel" class="info" title="Il livello mostra le aree di interesse archeologico...">
       <input type="checkbox" name="overlaysUbi" id="ubi_archeo" value="ubi_archeo" class='checkLiv'/> ARCHEOLOGICA
      </label>
      <div class="legende legendeUbi legendeUbiArcheo"></div>
     </div>
     <div class="livelli">
      <label id="ubiArchitetLabel" class="info" title="Il livello mostra le aree di interesse architettonico...">
       <input type="checkbox" name="overlaysUbi" id="ubi_architet" value="ubi_architet" class='checkLiv' /> ARCHITETTONICA
      </label>
      <div class="legende legendeUbi legendeUbiArchitet"></div>
     </div>
     <div class="livelli">
      <label id="ubiArchivLabel" class="info" title="Il livello mostra le aree di interesse archivistico...">
       <input type="checkbox" name="overlaysUbi" id="ubi_archiv" value="ubi_archiv" class='checkLiv' /> ARCHIVISTICA
      </label>
      <div class="legende legendeUbi legendeUbiArchiv"></div>
     </div>
     <div class="livelli">
      <label id="ubiBiblioLabel"  class="info" title="Il livello mostra le aree di interesse bibliografico...">
       <input type="checkbox" name="overlaysUbi" id="ubi_biblio" value="ubi_biblio" class='checkLiv' /> BIBLIOGRAFICA
      </label>
      <div class="legende legendeUbi legendeUbiBiblio"></div>
     </div>
     <div class="livelli">
      <label id="ubiCultLabel"  class="info" title="Il livello mostra le aree di interesse per la cultura materiale del luogo...">
       <input type="checkbox" name="overlaysUbi" id="ubi_cult" value="ubi_cult" class='checkLiv' /> CULTURA MATERIALE
      </label>
      <div class="legende legendeUbi legendeUbiCult"></div>
     </div>
     <div class="livelli bassa">
      <label id="ubiFotoLabel"  class="info" title="Il livello mostra le aree di interesse fotografico...">
       <input type="checkbox" name="overlaysUbi" id="ubi_foto" value="ubi_foto" class='checkLiv' />FOTOGRAFICA
      </label>
      <div class="legende legendeUbi legendeUbiFoto"></div>
     </div>
     <div class="livelli">
      <label id="ubiOraleLabel" class="info" title="Il livello mostra le aree di interesse per le fonti orali...">
       <input type="checkbox" name="overlaysUbi" id="ubi_orale" value="ubi_orale" class='checkLiv' /> ORALE
      </label>
      <div class="legende legendeUbi legendeUbiOrale"></div>
     </div>
     <div class="livelli">
      <label id="ubiStoArtLabel" class="info" title="Il livello mostra le aree di interesse storico-artistico...">
       <input type="checkbox" name="overlaysUbi" id="ubi_stoart" value="ubi_stoart" class='checkLiv' /> STORICO-ARTISTICA
      </label>
      <div class="legende legendeUbi legendeUbiStoArt"></div>
     </div>
    </div><!--ubiSwitch-->
    <?php } ?>
   </div><!--switcher-->
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

 <!-- <div id="sliderWrap">
   <div id="sliderLabel"><label>Anno </label></div>
   <div id="slider"></div>
  </div>-->
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
  <script src="http://maps.google.com/maps/api/js?v=3.2&amp;sensor=false"></script>
  <script src="lib/webgis.js"></script>
  <script type="text/javascript">
  var hub = '<?php echo($hub); ?>';
  console.log('hub: '+hub);
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
