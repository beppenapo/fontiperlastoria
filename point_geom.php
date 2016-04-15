<?php
session_start();
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
ini_set( "display_errors", 0);
require_once("inc/db.php");
$id=$_GET['id'];
$loc=$_GET['loc'];
$c=$_GET['c'];
$ind=$_GET['ind'];

/**********************************************************************************/

$qgeom1=("select count(id) as num_geom from ubicazione where area = $id");
$qgeom1Res = pg_query($connection, $qgeom1);
$g1 = pg_fetch_array($qgeom1Res, 0, PGSQL_ASSOC);

$numGeom = $g1['num_geom'];
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
    <div id="logoSchedaSx"><img src="img/layout/logo.png" alt="logo" /></div> 
    <div id="livelloScheda">
     <ul>
      <li id="catalogoTitle" class="livAttivo">SEI NELLA SEZIONE DI MODIFICA DELL'UBICAZIONE: <br/><b><?php echo(strtoupper($c).' '.strtoupper($ind));?></b></li>
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
                  $comune = pg_result($locexec, $l,"comune");
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
                  $comune = pg_result($ubiexec, $l,"comune");
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
           
      <div id="mappa2">
       <div id="nodelist"></div>
      </div>   
      <div id="coordinates">sistema visualizzato: WGS84 - EPSG:4326 -<span id="coo"></span></div>
     </div>
    </div>
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
var map, punti, numPunti, id_area;
var navigate, draw, edit, save, del, panel;
var ctrlSelectFeatureOptions, ctrlSelectFeature;
var feature, coords;
numPunti = '<?php echo($numGeom); ?>';
OpenLayers.ProxyHost = "/cgi-bin/proxy.cgi?url=";
var DeleteFeature = OpenLayers.Class(OpenLayers.Control, {
   initialize: function(layer, options) {
     OpenLayers.Control.prototype.initialize.apply(this, [options]);
     this.layer = layer;
     this.handler = new OpenLayers.Handler.Feature(this, layer, {click: this.clickFeature});
   },
   clickFeature: function(feature) {
      // if feature doesn't have a fid, destroy it
      if(feature.fid == undefined) {this.layer.destroyFeatures([feature]);} 
      else {
        feature.state = OpenLayers.State.DELETE;
        this.layer.events.triggerEvent("afterfeaturemodified",
        {feature: feature});
        feature.renderIntent = "select";
        this.layer.drawFeature(feature);
      }
    },
    setMap: function(map) {this.handler.setMap(map);OpenLayers.Control.prototype.setMap.apply(this, arguments);},
    CLASS_NAME: "OpenLayers.Control.DeleteFeature"
});

function showMsg(szMessage) {document.getElementById("nodelist").innerHTML = szMessage;setTimeout("document.getElementById('nodelist').innerHTML = ''",2000);}
function showSuccessMsg(){showMsg("<div class='nodeContent'>Salvatagio avvenuto correttamente</div>");};
function showFailureMsg(){showMsg("<div class='nodeContent'>Errore durante il salvataggio! Riprova.</div>");};
var bingKey = 'Arsp1cEoX9gu-KKFYZWbJgdPEa8JkRIUkxcPr8HBVSReztJ6b0MOz3FEgmNRd4nM';
function init() {
 var saveStrategy = new OpenLayers.Strategy.Save();
 saveStrategy.events.register("success", '', showSuccessMsg);
 saveStrategy.events.register("failure", '', showFailureMsg);
 
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

var filt = new OpenLayers.Filter.Logical({
   type: OpenLayers.Filter.Logical.AND,
   filters: [
     new OpenLayers.Filter.Comparison({
       type: OpenLayers.Filter.Comparison.EQUAL_TO,
       property: "area",
       value: "<?php echo($id); ?>"
     })
   ]
});

punti = new OpenLayers.Layer.Vector("linee", {
 strategies: [new OpenLayers.Strategy.BBOX(), saveStrategy],
 //projection: new OpenLayers.Projection("EPSG:3857"),
 protocol: new OpenLayers.Protocol.WFS({
   version:      "1.1.0",
   url:          "http://www.lefontiperlastoria.it/geoserver/wfs",
   featureNS :   "http://www.lefontiperlastoria.it/fonti",
   //maxExtent:    mapextent,
   srsName:      "EPSG:3857",
   featureType:  "ubicazione", 
   geometryName: "the_geom", 
   schema:       "http://www.lefontiperlastoria.it/fonti?service=WFS&version=1.0.0&request=DescribeFeatureType&TypeName=fonti:ubicazione",
   defaultFilter: filt
 })
});

map.addLayers([sat, osm, punti]);

if (numPunti!=0) {punti.events.register("loadend",punti, function () {map.zoomToExtent(punti.getDataExtent());});}
else{map.zoomToExtent(mapextent);}




// add the custom editing toolbar
 navigate = new OpenLayers.Control.DragPan({
   isDefault: true,
   title: "Pan map: muovi il mouse allinterno della mappa tenendo premuto il tasto sinistro",
   displayClass: "olControlNavigation"
 });
 save = new OpenLayers.Control.Button({
         title: "Salva modifiche",
         trigger: function() {
            if(edit.feature) {edit.selectControl.unselectAll();}
            saveStrategy.save();
            // alert('saved');
         },
         displayClass: "olControlSaveFeatures"
 });
 del = new DeleteFeature(punti, {title: "Elimina geometria"});
 draw = new OpenLayers.Control.DrawFeature(punti, OpenLayers.Handler.Point,{
    title: "Disegna punto",
    displayClass:"olControlDrawFeaturePoint",
    //handlerOptions: {multi: true},
    featureAdded: onFeatureInsert
 });
 edit = new OpenLayers.Control.ModifyFeature(punti, {
        title: "Modifica vertici geometria",
        displayClass: "olControlModifyFeature"
        //,vertexRenderIntent: "vertex"
 });
 
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
        , draw
        , edit
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
   var area = selectedFeature.attributes['area'];
   id_area= '<?php echo($id);?>';
      
   if (area == null) { 
        // formulario
        htmlForm = "<div style='font-size:.8em'>"+
        "<input type='hidden' name='fid' id='fid' value='"+ fid +"'>" +
        "<input type='hidden' name='area' id='area' value='"+id_area+"'>"+
        "<h2>Utilizza il tasto in basso per salvare la geometria.</h2>"+
        "<p>Per chiudere la sessione di lavoro ricordati di cliccare il tasto<br/> \"Salva e chiudi sessione\" <br/>nella barra dei comandi</p>"+"<button onclick='onTriggerInsert()'>Salva geometria</button>";
   }else{
       htmlForm = "<div style='font-size:.8em'>"+
        "<input type='hidden' name='fid' id='fid' value='"+ fid +"'>" +
        "<input type='hidden' name='area' id='area' value='"+id_area+"'>"+
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
   var miFeature = punti.getFeatureById(fid);
   miFeature.attributes.area = OpenLayers.Util.getElement('area').value;
   onFeatureUnselect(miFeature); 
 }

 var btnUpdate = new OpenLayers.Control.Button({trigger: onTriggerUpdate});
 function onTriggerUpdate(){
     miFeature = [selectedFeature];
     var fid =  OpenLayers.Util.getElement('fid').value;
     miFeature[0].id = fid;
     miFeature[0].attributes.area = OpenLayers.Util.getElement('area').value;
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
