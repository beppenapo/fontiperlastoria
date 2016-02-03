<?php
session_start();
ini_set( "display_errors", 0);
require_once("inc/db.php");
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
$id=$_GET['a'];

$a=("select a.nome, aa.id from area a, aree aa where aa.nome_area = a.id and a.id = $id");
$ar = pg_query($connection, $a);
$arr = pg_fetch_array($ar, 0, PGSQL_ASSOC);
$area = $arr['nome'];
$idarea = $arr['id'];
/**********************************************************************************/
$qgeom1=("select count(id) as num_poly from area_int_poly where id_area = $id");
$qgeom1Res = pg_query($connection, $qgeom1);
$g1 = pg_fetch_array($qgeom1Res, 0, PGSQL_ASSOC);
$numPoly = $g1['num_poly'];

$topo = " 
select ac.id, ac.nome area, array_to_string(array_agg(c.comune || ' (' || l.localita || ')' ), '<br/>') as lista
from area ac
inner join aree a on a.nome_area = ac.id
inner join comune c on a.id_comune = c.id
inner join localita l on a.id_localita = l.id 
where nome_area = $id 
group by ac.id, ac.nome, a.tipo order by area asc;
";
$topoExec = pg_query($connection, $topo);

/*$extCom =  ("
select max(xmax) as maxx, min(xmin) as minx, max(ymax) as maxy, min(ymin) as miny from(
 select  st_xmin(geom) as xmin, st_xmax(geom) as xmax, st_ymin(geom) as ymin, st_ymax(geom) as ymax from(
  select ST_Multi(ST_Union(comune.geom)) as geom 
  from comune, aree
  where aree.id_comune = comune.id and aree.id = $id
 )as geom 
) as ext;
");
$extComRes = pg_query($connection, $extCom);
$extComArr = pg_fetch_array($extComRes, 0, PGSQL_ASSOC);
$extComRow = pg_num_rows($extComRes);
$xmin = $extComArr['minx'];
$xmax = $extComArr['maxx'];
$ymin = $extComArr['miny'];
$ymax = $extComArr['maxy'];*/
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//IT" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="IT" >
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  
  <meta name="author" content="Giuseppe Naponiello" />
  <meta name="keywords" content="gfoss, archaeology, anthropology, openlayer, jquery, grass, postgresql, postgis, qgis, webgis, informatic" />
  <meta name="description" content="Le fonti per la storia. Per un archivio delle fonti sulle valli di Primiero e Vanoi" />
  <meta name="robots" content="INDEX,FOLLOW" />
  <meta name="copyright" content="&copy;2011 Museo Provinciale" />

  <title>Le fonti per la storia. Per un archivio delle fonti sulle valli di Primiero e Vanoi</title>
  <link href="css/scheda.css" type="text/css" rel="stylesheet" media="screen" /> 
  <link rel="stylesheet" href="css/google.css" type="text/css">
  <link rel="stylesheet" href="lib/OpenLayers-2.12/theme/default/style.css" type="text/css">  
  <link href="lib/jquery-ui-1.11.4/jquery-ui.min.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="stylesheet" href="css/geom.css" type="text/css"> 
  <link rel="shortcut icon" href="img/icone/favicon.ico" />

  <style>
    #topoLista{
    position: absolute;
    top: 25px;
    left: -25px;
    background-color: #fff;
    border-radius: 5px;
    padding: 10px;
    border: 1px solid #ccc;
    box-shadow: 0px 0px 10px #000;
    display:none;
}
  </style>
</head>
<body onload="init()">
 <div id="container">
  <div id="wrap">
   <?php if ($_SESSION['username']!='guest'){require("inc/sessione.php"); }?>
   <div id="content">
   <?php if ($_SESSION['username']=='guest'){?>
 <div id="wrapBacheca">
  <div id="tabProg">
   <div align="center" style="padding-top:150px;">
    <img src="img/layout/noAccess.png" />
    <h1>Attenzione! Stai cercando di entrare in una sezione privata del sito</h1>
    <h3>Per visualizzare i contenuti della pagina devi prima effettuare il login.</h3>
   </div>
  </div>
 </div>
  <?php }else{ ?>
    <div id="logoSchedaSx"><img src="img/layout/logo.png" alt="logo" /></div> 
    <div id="livelloScheda">
     <ul>
      <li id="catalogoTitle" class="livAttivo"><b><?php echo strtoupper($area);?></b></li>
     </ul>
    </div>
 
    <div id="skArcheoContent">
     <div class="inner primo">
        <div id="filtro">
            <label id="openListaTopo">Definizione topografica</label>
            <div id="topoLista">
            <?php
                while($l = pg_fetch_array($topoExec)){
                    echo $l['lista'];
                }
            ?>
            </div>
        </div>
        
        <div id="panel" class="customEditingToolbar"></div>
        <div id="nodelist"></div>     
        <div id="mappa2"></div>   
        <div id="coordinates">sistema visualizzato: WGS84 - EPSG:4326 -<span id="coo"></span></div>
     </div>
    </div>
     <?php } ?>
   </div><!--content-->
   <div id="footer"><?php require_once ("inc/footer.php"); ?></div><!--footer-->
  </div><!-- wrap-->
 </div><!--container-->
 
 <!--div invisibili -->
<div id="dialog">  </div>

<script type="text/javascript" src="lib/jquery-core/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="lib/jquery-ui-1.11.4/jquery-ui.min.js"></script>
  <script type="text/javascript" src="lib/OpenLayers-2.12/OpenLayers.js"></script>
  <script type="text/javascript" src="lib/OpenLayers-2.10/ScaleBar.js"></script>
<script type="text/javascript" >
$(document).ready(function(){
    $("#openListaTopo").mouseover(function(){$("#topoLista").fadeIn('fast');}).mouseout(function(){$("#topoLista").fadeOut('fast');});
     $('.submenu').hide();
    $("#sessionMenu li").on({
          mouseenter: function() {$(this).find('.submenu').slideDown('fast');}
        , mouseleave: function() {$(this).find('.submenu').slideUp('fast');}
    });
});

/******* OPEN LAYERS ********/
var map, arrayOSM, osm, sat, poly, reg, numPoly, id_area, navigate, drawpoly, drawbox, drawline, edit, save, del, ruota, resize, panel, akt, ctrlPolyOptions, ctrlSelectFeatureOptions, ctrlSelectFeature,DeleteFeature,bingKey,numFeat,mainExtent,mainResolution, unit, epsg3857, epsg4326, mapOption, saveStrategy, mapextent,divPannello;

/*var xmin, ymin, xmax, ymax, extent, lat, lon;
xmin = '<?php echo($xmin);?>';
ymin = '<?php echo($ymin);?>';
xmax = '<?php echo($xmax);?>';
ymax = '<?php echo($ymax);?>';*/

numPoly = '<?php echo($numPoly); ?>';

DeleteFeature = OpenLayers.Class(OpenLayers.Control, {
   initialize: function(layer, options) {
     OpenLayers.Control.prototype.initialize.apply(this, [options]);
     this.layer = layer;
     this.handler = new OpenLayers.Handler.Feature(
       this, layer, {click: this.clickFeature}
     );
   },
   clickFeature: function(feature) {
      // if feature doesn't have a fid, destroy it
      if(feature.fid == undefined) {
        this.layer.destroyFeatures([feature]);
      } else {
        feature.state = OpenLayers.State.DELETE;
        this.layer.events.triggerEvent("afterfeaturemodified",
        {feature: feature});
        feature.renderIntent = "select";
        this.layer.drawFeature(feature);
      }
    },
    setMap: function(map) {
        this.handler.setMap(map);
        OpenLayers.Control.prototype.setMap.apply(this, arguments);
    },
    CLASS_NAME: "OpenLayers.Control.DeleteFeature"
});
bingKey = 'Arsp1cEoX9gu-KKFYZWbJgdPEa8JkRIUkxcPr8HBVSReztJ6b0MOz3FEgmNRd4nM';
mainExtent = new OpenLayers.Bounds (-20037508.34,-20037508.34,20037508.34,20037508.34);
mainResolution = [156543.03390625, 78271.516953125, 39135.7584765625, 19567.87923828125, 9783.939619140625, 4891.9698095703125, 2445.9849047851562, 1222.9924523925781, 611.4962261962891, 305.74811309814453, 152.87405654907226, 76.43702827453613, 38.218514137268066, 19.109257068634033, 9.554628534317017, 4.777314267158508, 2.388657133579254, 1.194328566789627, 0.5971642833948135, 0.29858214169740677, 0.14929107084870338, 0.07464553542435169, 0.037322767712175846, 0.018661383856087923, 0.009330691928043961, 0.004665345964021981, 0.0023326729820109904, 0.0011663364910054952, 5.831682455027476E-4, 2.915841227513738E-4, 1.457920613756869E-4];
unit =  'm';
epsg3857 = new OpenLayers.Projection("EPSG:3857");
epsg4326 = new OpenLayers.Projection("EPSG:4326");
mapOption = {maxExtent: mainExtent, resolutions: mainResolution, units:unit, projection: epsg3857, displayProjection: epsg4326, controls:[]};
//8s161lhzp2
function init() {
    OpenLayers.ProxyHost = "/cgi-bin/proxy.cgi?url=";
    saveStrategy = new OpenLayers.Strategy.Save();
    saveStrategy.events.register("success", '', showSuccessMsg); saveStrategy.events.register("failure", '', showFailureMsg);
    map = new OpenLayers.Map ("mappa2", mapOption);
    map.addControl(new OpenLayers.Control.Navigation());
    map.addControl(new OpenLayers.Control.PanZoom());
    map.addControl(new OpenLayers.Control.LayerSwitcher());
    map.addControl(new OpenLayers.Control.MousePosition({div:document.getElementById("coo")}));
    mapextent = new OpenLayers.Bounds(1279972.812, 5782339.838, 1331677.275, 5838213.399);
    //mapextent = new OpenLayers.Bounds(xmin, ymin, xmax, ymax);
    sat = new OpenLayers.Layer.Bing({name: "Sat",key: bingKey,type: "Aerial"});
    arrayOSM = ["http://otile1.mqcdn.com/tiles/1.0.0/map/${z}/${x}/${y}.jpg", "http://otile2.mqcdn.com/tiles/1.0.0/map/${z}/${x}/${y}.jpg","http://otile3.mqcdn.com/tiles/1.0.0/map/${z}/${x}/${y}.jpg", "http://otile4.mqcdn.com/tiles/1.0.0/map/${z}/${x}/${y}.jpg"];
    osm = new OpenLayers.Layer.OSM("osm", arrayOSM, {attribution: "Data, imagery and map information provided by <a href='http://www.mapquest.com/'  target='_blank'>MapQuest</a>, <a href='http://www.openstreetmap.org/' target='_blank'>Open Street Map</a> and contributors, <a href='http://creativecommons.org/licenses/by-sa/2.0/' target='_blank'>CC-BY-SA</a>  <img src='http://developer.mapquest.com/content/osm/mq_logo.png' border='0'>", transitionEffect: "resize"}); 
    poly = new OpenLayers.Layer.Vector("poligoni", {
         strategies: [new OpenLayers.Strategy.BBOX(), saveStrategy]
        ,protocol: new OpenLayers.Protocol.WFS({
             version: "1.1.0"
            ,url: "http://www.lefontiperlastoria.it/geoserver/wfs"
            ,featureNS: "http://www.lefontiperlastoria.it/fonti"
            ,srsName: "EPSG:3857"
            ,featureType: "area_int_poly"
            ,geometryName: "the_geom",
            schema: "http://www.lefontiperlastoria.it/fonti?service=WFS&version=1.0.0&request=DescribeFeatureType&TypeName=fonti:area_int_poly"
        })
        ,filter: new OpenLayers.Filter.Comparison({
             type: OpenLayers.Filter.Comparison.EQUAL_TO
            ,property: "id_area"
            ,value: "<?php echo($id); ?>"
        })
    });
    map.addLayers([sat, osm, poly]);
    console.log("poly= "+numPoly);
    navigate = new OpenLayers.Control.DragPan({isDefault: true, title: "Pan map: muovi il mouse allinterno della mappa tenendo premuto il tasto sinistro", displayClass: "olControlNavigation"});
    del = new DeleteFeature(poly, {title: "Elimina geometria"});
    drawpoly = new OpenLayers.Control.DrawFeature(poly, OpenLayers.Handler.Polygon,{
        id: 'drawpoly',
        title: "Disegna poligono irregolare",
        displayClass:"olControlDrawFeaturePolygon",
        handlerOptions: {freehand: false, multi: true},
        featureAdded: onFeatureInsert
    });
    drawbox = new OpenLayers.Control.DrawFeature(poly,OpenLayers.Handler.RegularPolygon,{
        id: 'drawbox',
        handlerOptions: {sides: 4, irregular:true,freehand: false, multi: true},
        title: " Disegna poligono regolare.\nPer disegnare un poligono regolare clicca in un punto sulla mapa e trascina il mouse",
        displayClass:"olControlDrawFeatureBox",
        featureAdded: onFeatureInsert
    });
    save = new OpenLayers.Control.Button({
        title: "Salva modifiche",
        trigger: function() {
            if(edit.feature) {edit.selectControl.unselectAll();}
            saveStrategy.save();
        },
        displayClass: "olControlSaveFeatures"
    }); 
    edit = new OpenLayers.Control.ModifyFeature(poly, {title: "Modifica vertici geometria", displayClass: "olControlModifyFeature" });
    ruota = new OpenLayers.Control.ModifyFeature(poly, {title: "Ruota o sposta la geometria", displayClass: "olControlRotateFeature"});
    ruota.mode = OpenLayers.Control.ModifyFeature.ROTATE | OpenLayers.Control.ModifyFeature.DRAG;
    resize = new OpenLayers.Control.ModifyFeature(poly, {title: "Ridimensiona geometria",displayClass: "olControlResizeFeature"});
    resize.mode = OpenLayers.Control.ModifyFeature.RESIZE;
    divPannello = document.getElementById("panel");
    panel = new OpenLayers.Control.Panel({ defaultControl: navigate, displayClass: 'olControlPanel',  div: divPannello});
    panel.addControls([navigate, save, del, drawpoly, drawbox, edit, resize, ruota]);
    map.addControl(panel);
    if (numPoly!=0) {poly.events.register("loadend", poly, function() {map.zoomToExtent(poly.getDataExtent());});}
    if (numPoly==0) {map.zoomToExtent(mapextent);}
    //map.zoomToExtent(mapextent);
}
/******* funzioni *******/
function showMsg(szMessage) { document.getElementById("nodelist").innerHTML = szMessage; setTimeout("document.getElementById('nodelist').innerHTML = ''",2000);}
function showSuccessMsg(){showMsg("<div class='nodeContent'>Salvatagio avvenuto correttamente</div>");};
function showFailureMsg(){showMsg("<div class='nodeContent'>Errore durante il salvataggio! Riprova.</div>");};
function onPopupClose(evt) {selectControl.unselect(selectedFeature);}
function onFeatureUnselect(feature) {map.removePopup(feature.popup); feature.popup.destroy(); feature.popup = null;}
function onFeatureInsert(feature){
   selectedFeature = feature;
   var fid = selectedFeature.id;
   var area = selectedFeature.attributes['id_area'];
   id_area= '<?php echo($id);?>';
   if (area == null) { 
        htmlForm = "<div style='font-size:.8em'>"+
        "<input type='hidden' name='fid' id='fid' value='"+ fid +"'>" +
        "<input type='hidden' name='id_area' id='id_area' value='"+id_area+"'>"+
        "<h2>Utilizza il tasto in basso per salvare la geometria.</h2>"+
        "<p>Per chiudere la sessione di lavoro ricordati di cliccare il tasto<br/> \"Salva e chiudi sessione\" <br/>nella barra dei comandi</p>"+"<button onclick='onTriggerInsert()'>Salva geometria</button>";
   }else{
       htmlForm = "<div style='font-size:.8em'>"+
        "<input type='hidden' name='fid' id='fid' value='"+ fid +"'>" +
        "<input type='hidden' name='id_area' id='id_area' value='"+id_area+"'>"+
        "<h2>Utilizza il tasto in basso per salvare la geometria.</h2>"+
        "<p>Per chiudere la sessione di lavoro ricordati di cliccare il tasto <br/>\"Salva e chiudi sessione\"<br/> nella barra dei comandi</p>"+"<button onclick='onTriggerUpdate()'>Aggiorna geometria</button></div>";
   }
   popup = new OpenLayers.Popup.FramedCloud(
     "info",
     feature.geometry.getBounds().getCenterLonLat(),
     null,
     htmlForm,
     null,
     true,
     onPopupClose
   );
   feature.popup = popup;
   map.addPopup(popup);
}

  // Passa attributi al form
 var btnInsert = new OpenLayers.Control.Button({trigger: onTriggerInsert});
 function onTriggerInsert(fid){
   var fid =  OpenLayers.Util.getElement('fid').value;
   var miFeature = poly.getFeatureById(fid);
   miFeature.attributes.id_area = OpenLayers.Util.getElement('id_area').value;
   onFeatureUnselect(miFeature); 
 }
 var btnUpdate = new OpenLayers.Control.Button({trigger: onTriggerUpdate});
 function onTriggerUpdate(){
     miFeature = [selectedFeature];
     var fid =  OpenLayers.Util.getElement('fid').value;
     miFeature[0].id = fid;
     miFeature[0].attributes.id_area = OpenLayers.Util.getElement('id_area').value;
     miFeature[0].state = OpenLayers.State.UPDATE;
     map.removePopup(miFeature[0].popup);
     selectControl.unselectAll();
     miFeature[0].popup = null;
  }
</script>
</body>
</html>