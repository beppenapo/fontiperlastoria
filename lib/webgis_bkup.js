var gsat, comuni, ubicazione; //livelli
var extent, ctrlSelectFeatures; //funzioni o comandi
function init() {
 OpenLayers.ProxyHost = "/cgi-bin/proxy.cgi?url=";
 format = 'image/png';
 
 map = new OpenLayers.Map ("map", {
   controls:[
    new OpenLayers.Control.Navigation(),
    //new OpenLayers.Control.PanZoomBar(),
    new OpenLayers.Control.PanZoom(),
    new OpenLayers.Control.MousePosition({div:document.getElementById("coord")}),
   ],
   maxResolution: 'auto',
   restrictedExtent: new OpenLayers.Bounds(1279972.812, 5782339.838, 1331677.275, 5838213.399),
   maxExtent: new OpenLayers.Bounds (1279972.812, 5782339.838, 1331677.275, 5838213.399),
   //allOverlays: true,
   units: 'm',
   projection: new OpenLayers.Projection("EPSG:900913"),
   displayProjection: new OpenLayers.Projection("EPSG:4326")
 });
 var scalebar = new OpenLayers.Control.ScaleBar({div:document.getElementById("scalebar")});
 map.addControl(scalebar);
 
 var LayerSwitcher = new OpenLayers.Control.LayerSwitcher({activeColor:"#f5f3e5"});
 map.addControl(LayerSwitcher);
 
 extent = new OpenLayers.Bounds(1279972.812, 5782339.838, 1331677.275, 5838213.399);
 
 proj900913 = new OpenLayers.Projection("EPSG:900913");
 proj4326 = new OpenLayers.Projection("EPSG:4326");
 
 comuni = new OpenLayers.Layer.WMS("comuni", "http://arc-team.homelinux.com:8080/geoserver/wms",{
   srs: 'EPSG:900913',
   layers: 'fonti:comuni',
   styles: '',
   format: format, 
   transparent: true
  },{isBaseLayer: false},{singleTile: true, ratio: 1}
);
 map.addLayer(comuni); 
  
 if (!map.getCenter()) {map.zoomToExtent(extent);}
} //end init mappa