<?php
session_start();
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
ini_set( "display_errors", 0);
require_once("inc/db.php");
$id=$_GET['a'];
$q0=("SELECT aree.id,comune.comune,localita.localita
      FROM aree, comune, localita
      WHERE aree.id_localita = localita.id AND aree.id_comune = comune.id AND aree.id = $id;");
$r0=pg_query($connection, $q0);
$a0=pg_fetch_array($r0, 0, PGSQL_ASSOC);
$com=strtoupper(stripslashes($a0['comune']));
$loc=strtoupper(stripslashes($a0['localita']));

/**********************************************************************************/

$qgeom1=("select count(id) as num_poly from area_int_poly where id_area = $id");
$qgeom1Res = pg_query($connection, $qgeom1);

$qgeom2=("select count(id) as num_line from area_int_line where id_area = $id");
$qgeom2Res = pg_query($connection, $qgeom2);

$g1 = pg_fetch_array($qgeom1Res, 0, PGSQL_ASSOC);
$g2 = pg_fetch_array($qgeom2Res, 0, PGSQL_ASSOC);

$numPoly = $g1['num_poly'];
$numLine = $g2['num_line'];
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
  <link href="lib/jquery_friuli/css/start/jquery-ui-1.8.10.custom.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="css/scheda.css" type="text/css" rel="stylesheet" media="screen" /> 
  <link rel="stylesheet" href="css/google.css" type="text/css">
  <link rel="stylesheet" href="lib/OpenLayers-2.12/theme/default/style.css" type="text/css">  
  <link rel="stylesheet" href="css/geom.css" type="text/css"> 
  <link rel="shortcut icon" href="img/icone/favicon.ico" />
  <script type="text/javascript" src="lib/jquery-ui-lampi/js/jquery-1.7.1.min.js"></script>
  <script type="text/javascript" src="lib/jquery-ui-lampi/js/jquery-ui-1.8.18.custom.min.js"></script>
  <script type="text/javascript" src="lib/OpenLayers-2.12/OpenLayers.js"></script>
  <script type="text/javascript" src="lib/OpenLayers-2.10/ScaleBar.js"></script>
  
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
      <li id="catalogoTitle" class="livAttivo">COMUNE DI <?php echo($com);?><br/><b><?php echo($loc);?></b></li>
     </ul>
    </div>
 
    <div id="skArcheoContent">
     <div class="inner primo">
      
      <div id="filtro">
        <select id="filtroAree" class="form filtro" style="display:inline">
         <option value=''>Scegli area</option>
         <?php
            $locquery = ("SELECT aree.id, aree.id_localita, aree.id_comune, comune.comune, localita.localita 
                          FROM aree, comune, localita 
                          WHERE aree.id_localita = localita.id AND 
                                aree.id_comune = comune.id AND
                                aree.tipo = 1 AND 
                                aree.id != $id AND
                                aree.id_localita != 6 AND 
                                aree.id_localita != 175 
                          order by comune asc, localita asc;");
            $locexec = pg_query($connection, $locquery);
            $locrow = pg_num_rows($locexec);
            if($locrow != 0) {
               for ($l = 0; $l < $locrow; $l++){
                  $idArea = pg_result($locexec, $l,"id"); 	
                  $localita = pg_result($locexec, $l,"localita");
                  $localita = stripslashes($localita);
                  $comune = pg_result($locexec, $l,"comune");
                  $comune = stripslashes($comune);
                  $comune=($comune == '-' OR $comune=='--')?'AREA SOVRACOMUNALE':$comune;
                  $localita=($localita == '-')?'Area Comunale':$localita;
                  echo "<option value='$idArea' data-loc='$localita' data-com='$comune'>$comune - $localita</option>"; 
                }
             }
         ?>
        </select>
        <select id="filtroUbi" class="form filtro"  style="display:inline">
         <option value=''>Scegli ubicazione</option>
         <?php
             $ubiquery = ("SELECT aree.id, aree.id_localita, aree.id_comune, comune.comune, localita.localita,indirizzo.indirizzo
                          FROM aree, comune, localita, indirizzo
                          WHERE aree.id_localita = localita.id AND 
                                aree.id_comune = comune.id AND
                                aree.id_indirizzo = indirizzo.id AND
                                aree.tipo = 2 AND 
                                aree.id != $id AND
                                aree.id_localita != 6 AND 
                                aree.id_localita != 175 
                          order by comune asc, localita asc;");
            $ubiexec = pg_query($connection, $ubiquery);
            $ubirow = pg_num_rows($ubiexec);
            if($ubirow != 0) {
               for ($l = 0; $l < $ubirow; $l++){
                  $idAreaUbi = pg_result($ubiexec, $l,"id"); 	
                  $localita = pg_result($ubiexec, $l,"localita");
                  $localita = stripslashes($localita);
                  $comune = pg_result($ubiexec, $l,"comune");
                  $comune = stripslashes($comune);
                  $indirizzo = pg_result($ubiexec, $l,"indirizzo");
                  $comune=($comune == '-' OR $comune=='--')?'AREA SOVRACOMUNALE':$comune;
                  $localita=($localita == '-')?'Area Comunale':$localita;
                  echo "<option value='$idAreaUbi' data-loc='$localita' data-com='$comune' data-ind='$indirizzo'>$comune - $indirizzo</option>"; 
                }
             }
         ?>
        </select>
      </div>
      <div id="panel" class="customEditingToolbar"></div>
      <div id="nodelist"></div>     
      <div id="mappa2"></div>   
      <div id="coordinates">sistema visualizzato: WGS84 - EPSG:4326 -<span id="coo"></span></div>
     </div>
    </div>
     <?php } ?>
   </div><!--content-->
   <div id="footer"><?php require_once ("inc/footer.inc"); ?></div><!--footer-->
  </div><!-- wrap-->
 </div><!--container-->
 
 <!--div invisibili -->
<div id="dialog">  </div>

<script type="text/javascript" >
$(document).ready(function(){
 $('#filtroAree').change(function(){
       var idNewArea = $(this).val();
       var selected = $(this).find('option:selected');
       var newLoc = selected.data('loc');
       var newCom = selected.data('com');
       var href = 'aree_geom.php?id='+idNewArea+'&c='+newCom+'&loc='+newLoc;
       if (idNewArea) {window.location.href=href;}
 });
 
 $('#filtroUbi').change(function(){
       var idNewUbi = $(this).val();
       var selected = $(this).find('option:selected');
       var newUbiLoc = selected.data('loc');
       var newUbiCom = selected.data('com');
       var newUbiInd = selected.data('ind');
       var href = 'point_geom.php?id='+idNewUbi+'&c='+newUbiCom+'&loc='+newUbiLoc+'&ind='+newUbiInd;
       if (idNewUbi) {window.location.href=href;}
 });
});
</script>


<script type="text/javascript" >
var map, line, poly, reg, numPoly, numLine, id_area;
var navigate, drawpoly, drawbox, drawline, edit, save, del, ruota, resize, panel, akt;
var ctrlPolyOptions, ctrlSelectFeatureOptions, ctrlSelectFeature;
numPoly = '<?php echo($numPoly); ?>';
numLine = '<?php echo($numLine); ?>';
OpenLayers.ProxyHost = "/cgi-bin/proxy.cgi?url=";
var DeleteFeature = OpenLayers.Class(OpenLayers.Control, {
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

function showMsg(szMessage) {
   document.getElementById("nodelist").innerHTML = szMessage;
   setTimeout("document.getElementById('nodelist').innerHTML = ''",2000);
}
 
function showSuccessMsg(){showMsg("<div class='nodeContent'>Salvatagio avvenuto correttamente</div>");};
function showFailureMsg(){showMsg("<div class='nodeContent'>Errore durante il salvataggio! Riprova.</div>");};


var bingKey = 'Arsp1cEoX9gu-KKFYZWbJgdPEa8JkRIUkxcPr8HBVSReztJ6b0MOz3FEgmNRd4nM';
var numFeat;
function init() {
 var saveStrategy = new OpenLayers.Strategy.Save();
 saveStrategy.events.register("success", '', showSuccessMsg); saveStrategy.events.register("failure", '', showFailureMsg);
 
 map = new OpenLayers.Map ("mappa2", {   
  controls:[
    new OpenLayers.Control.Navigation(),
    new OpenLayers.Control.PanZoom(),
    new OpenLayers.Control.LayerSwitcher(),
    new OpenLayers.Control.MousePosition({div:document.getElementById("coo")})   
  ],
  units: 'm',
  projection: new OpenLayers.Projection("EPSG:3857"),
  displayProjection: new OpenLayers.Projection("EPSG:4326")
 });
 
var mapextent = new OpenLayers.Bounds(1279972.812, 5782339.838, 1331677.275, 5838213.399);

var sat = new OpenLayers.Layer.Bing({name: "Sat",key: bingKey,type: "Aerial"});
arrayOSM = ["http://otile1.mqcdn.com/tiles/1.0.0/map/${z}/${x}/${y}.jpg",
            "http://otile2.mqcdn.com/tiles/1.0.0/map/${z}/${x}/${y}.jpg",
            "http://otile3.mqcdn.com/tiles/1.0.0/map/${z}/${x}/${y}.jpg",
            "http://otile4.mqcdn.com/tiles/1.0.0/map/${z}/${x}/${y}.jpg"];
var osm = new OpenLayers.Layer.OSM("osm", arrayOSM, {
                attribution: "Data, imagery and map information provided by <a href='http://www.mapquest.com/'  target='_blank'>MapQuest</a>, <a href='http://www.openstreetmap.org/' target='_blank'>Open Street Map</a> and contributors, <a href='http://creativecommons.org/licenses/by-sa/2.0/' target='_blank'>CC-BY-SA</a>  <img src='http://developer.mapquest.com/content/osm/mq_logo.png' border='0'>",
                transitionEffect: "resize"
            }); 
//wfs-t editable overlay
line = new OpenLayers.Layer.Vector("linee", {
 strategies: [new OpenLayers.Strategy.BBOX()],
 //projection: new OpenLayers.Projection("EPSG:3857"),
 protocol: new OpenLayers.Protocol.WFS({
   version:      "1.1.0",
   url:          "http://www.lefontiperlastoria.it/geoserver/wfs",
   featureNS :   "http://www.lefontiperlastoria.it/fonti",
   //maxExtent:    mapextent,
   srsName:      "EPSG:3857",
   featureType:  "area_int_line", 
   geometryName: "the_geom", 
   schema:       "http://www.lefontiperlastoria.it/fonti?service=WFS&version=1.0.0&request=DescribeFeatureType&TypeName=fonti:area_int_line"
 }),
 filter: new OpenLayers.Filter.Comparison({
   type: OpenLayers.Filter.Comparison.EQUAL_TO,
   property: "id_area",
   value: "<?php echo($id); ?>"
 })
});

poly = new OpenLayers.Layer.Vector("poligoni", {
 strategies: [new OpenLayers.Strategy.BBOX(), saveStrategy],
 //projection: new OpenLayers.Projection("EPSG:3857"),
 protocol: new OpenLayers.Protocol.WFS({
   version:      "1.1.0",
   url:          "http://www.lefontiperlastoria.it/geoserver/wfs",
   featureNS :   "http://www.lefontiperlastoria.it/fonti",
   //maxExtent:    mapextent,
   srsName:      "EPSG:3857",
   featureType:  "area_int_poly", 
   geometryName: "the_geom", 
   schema:       "http://www.lefontiperlastoria.it/fonti?service=WFS&version=1.0.0&request=DescribeFeatureType&TypeName=fonti:area_int_poly"
 }),
 filter: new OpenLayers.Filter.Comparison({
   type: OpenLayers.Filter.Comparison.EQUAL_TO,
   property: "id_area",
   value: "<?php echo($id); ?>"
 })
});

map.addLayers([sat, osm, poly, line]);

if (numPoly!=0) {poly.events.register("loadend", poly, function() {map.zoomToExtent(poly.getDataExtent());});}
if (numPoly==0 && numLine!=0) {line.events.register("loadend", line, function() {map.zoomToExtent(line.getDataExtent());});}
if (numPoly==0 && numLine==0) {map.zoomToExtent(mapextent);}
console.log("poly= "+numPoly);

// add the custom editing toolbar
 navigate = new OpenLayers.Control.DragPan({
   isDefault: true,
   title: "Pan map: muovi il mouse allinterno della mappa tenendo premuto il tasto sinistro",
   displayClass: "olControlNavigation"
 });

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
 
 
 edit = new OpenLayers.Control.ModifyFeature(poly, {
        title: "Modifica vertici geometria",
        displayClass: "olControlModifyFeature"
        //,vertexRenderIntent: "vertex"
 });
 
 ruota = new OpenLayers.Control.ModifyFeature(poly, {title: "Ruota o sposta la geometria", displayClass: "olControlRotateFeature"});
 ruota.mode = OpenLayers.Control.ModifyFeature.ROTATE | OpenLayers.Control.ModifyFeature.DRAG;
 resize = new OpenLayers.Control.ModifyFeature(poly, {title: "Ridimensiona geometria",displayClass: "olControlResizeFeature"});
 resize.mode = OpenLayers.Control.ModifyFeature.RESIZE;
/*
 ctrlSelectFeatureOptions = { 
      clickout: true, 
      toggle: true, 
      multiple: true, 
      hover: false, 
      toggleKey: "ctrlKey", 
      multipleKey: "altKey", 
      box: true 
    };
    
 ctrlSelectFeature = new OpenLayers.Control.SelectFeature([line, poly], ctrlSelectFeatureOptions);
*/ 
 var divPannello = document.getElementById("panel");
 panel = new OpenLayers.Control.Panel({
       defaultControl: navigate,
       displayClass: 'olControlPanel',
       div: divPannello
 });
 panel.addControls([
        navigate
        , save
        , del        
        , drawpoly
        , drawbox
        , edit
        , resize
        , ruota
        //, ctrlSelectFeature
    ]);
    
 map.addControl(panel);
}


function onPopupClose(evt) {selectControl.unselect(selectedFeature);}
function onFeatureUnselect(feature) {
    map.removePopup(feature.popup);
    feature.popup.destroy();
    feature.popup = null;
}
function onFeatureInsert(feature){
   selectedFeature = feature;
   var fid = selectedFeature.id;
   var area = selectedFeature.attributes['id_area'];
   id_area= '<?php echo($id);?>';
      
   if (area == null) { 
        // formulario
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
 // fin trigger insertar    
 // Trigger y funciÃ³n para pasar atributos del formulario en el update
 var btnUpdate = new OpenLayers.Control.Button({trigger: onTriggerUpdate});
 function onTriggerUpdate(){
     miFeature = [selectedFeature];
     var fid =  OpenLayers.Util.getElement('fid').value;
     miFeature[0].id = fid;
     miFeature[0].attributes.id_area = OpenLayers.Util.getElement('id_area').value;
     miFeature[0].state = OpenLayers.State.UPDATE;
     // elimina el popup
     map.removePopup(miFeature[0].popup);
     selectControl.unselectAll();
     miFeature[0].popup = null;
  }
 // fin trigger  
</script>

</body>
</html>
