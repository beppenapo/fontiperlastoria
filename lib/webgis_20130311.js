var gsat, comuni, ubicazione; //livelli
var extent, highlightCtrl, selectCtrl; //funzioni o comandi
  //###################################################################################
// popup start
//###################################################################################
//ubi_numsch, ubi_stato, ubi_prov, ubi_com, ubi_loc, ubi_ind, ubi_tel, ubi_mail, ubi_web, ubi_motiv, ubi_id, ubi_point_wgs, ubi_pcat, id, scheda

function onPopupClose(evt) {
    selectCtrl.unselect(feature);
   }
function regFeatureSelected(event) {
    feature = event.feature;
    popup = new OpenLayers.Popup.FramedCloud(
       "chicken", 
         feature.geometry.getBounds().getCenterLonLat(),
         //new OpenLayers.Size(500,600),
         null,
         "<div id=\"print\">"
           + "<h2>Scheda " + feature.attributes.scheda + ": " + feature.attributes.ubi_numsch +  "</h2>"
           + "<table>"
      + "<tr>"
       + "<td>Comune:</td>" 
       + "<td>" + feature.attributes.ubi_com + "</td>" 
      + "</tr>"
      + "<tr>"
       + "<td>Località:</td>" 
       + "<td>" + feature.attributes.ubi_loc + "</td>"
      + "</tr>"
      + "<tr>"
       + "<td>Sito web:</td>" 
       + "<td><a href='http://"+ feature.attributes.ubi_web + "' target='_blank'>"+ feature.attributes.ubi_web +"</a></td>"
     + "</tr>" 
     + "<tr>"
       + "<td>Motivazione:</td>" 
       + "<td>" + feature.attributes.ubi_motiv + "</td>"
     + "</tr>"
      + "</table></div>"
      + "<hr/>"
      +"<div><a href=\"#\">Scheda completa</a>(link non attivo)</div>"
      +"<hr/>",
         null, 
         true, 
         onPopupClose
        );
    feature.popup = popup;
    map.addPopup(popup);
   }

function regFeatureUnselected(event) {
  feature = event.feature;
   if (feature.popup){
     map.removePopup(feature.popup);
     feature.popup.destroy();
     feature.popup = null;
   } 
  }
  
//###################################################################################
// popup end
//###################################################################################
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
   projection: new OpenLayers.Projection("EPSG:3857"),
   displayProjection: new OpenLayers.Projection("EPSG:4326")
 });
 var scalebar = new OpenLayers.Control.ScaleBar({div:document.getElementById("scalebar")});
 map.addControl(scalebar);
 
 var LayerSwitcher = new OpenLayers.Control.LayerSwitcher({activeColor:"#f5f3e5"});
 map.addControl(LayerSwitcher);
 
 extent = new OpenLayers.Bounds(1279972.812, 5782339.838, 1331677.275, 5838213.399);
 
 proj900913 = new OpenLayers.Projection("EPSG:900913");
 proj4326 = new OpenLayers.Projection("EPSG:4326");
 
 
 var aStyleMap = new OpenLayers.StyleMap({fillColor: 'yellow', fillOpacity: 0.3, strokeWidth: 1.0, strokeColor:'yellow', pointRadius: 5 });
 var lookup = {};
 lookup['Archeologica']      = {fillColor: '#24ACCC', fillOpacity: 0.3, strokeWidth: 1.0, strokeColor:'#24ACCC',  pointRadius: 5 };
 lookup['Architettonica']    = {fillColor: '#FF7F2A', fillOpacity: 0.3, strokeWidth: 2.0, strokeColor:'#FF7F2A',  pointRadius: 5 };
 lookup['Archivistica']      = {fillColor: '#5BFF24', fillOpacity: 0.3, strokeWidth: 1.0, strokeColor:'#5BFF24',  pointRadius: 5 };
 lookup['Bibliografica']     = {fillColor: '#FF5555', fillOpacity: 0.3, strokeWidth: 2.0, strokeColor:'#FF5555',  pointRadius: 5 };
 lookup['Cultura Materiale'] = {fillColor: '#FFCC00', fillOpacity: 0.3, strokeWidth: 2.0, strokeColor:'#FFCC00',  pointRadius: 5 };
 lookup['Fotografica']       = {fillColor: '#0066FF', fillOpacity: 0.3, strokeWidth: 2.0, strokeColor:'#0066FF',  pointRadius: 5 };  
 lookup['Orale']             = {fillColor: '#FF00FF', fillOpacity: 0.3, strokeWidth: 2.0, strokeColor:'#FF00FF',  pointRadius: 5 };  
 lookup['Storico-Artistica'] = {fillColor: '#ABC837', fillOpacity: 0.3, strokeWidth: 2.0, strokeColor:'#ABC837',  pointRadius: 5 }; 
  
  //lookup['marker blue'] = {fillOpacity: 1, pointRadius: 10, externalGraphic: "../OL26/img/marker-blue.png"};

 aStyleMap.addUniqueValueRules("default", "scheda", lookup);

 gsat = new OpenLayers.Layer.Google("Satellite", {type: google.maps.MapTypeId.SATELLITE, numZoomLevels: 22});
 map.addLayer(gsat);

 comuni = new OpenLayers.Layer.WMS("comuni", "http://arc-team.homelinux.com:8080/geoserver/wms",{
   srs: 'EPSG:900913',
   layers: 'fonti:comuni',
   styles: '',
   format: format, 
   transparent: true
  },{isBaseLayer: false},{singleTile: true, ratio: 1}
);
 map.addLayer(comuni); 
 
/*  ubicazione = new OpenLayers.Layer.WMS("comuni", "http://arc-team.homelinux.com:8080/geoserver/wms",{
    srs: 'EPSG:900913',
    layers: 'fonti:ubicazione',
    styleMap: aStyleMap,
    format: format, 
    transparent: true
   },{isBaseLayer: false},{singleTile: true, ratio: 1}
 );
  map.addLayer(ubicazione);*/  
 
/*var ubicazione = new OpenLayers.Layer.Vector("Ubicazione", {
 //styleMap: sitiStyles,
 strategies: [new OpenLayers.Strategy.BBOX()],
 protocol: new OpenLayers.Protocol.WFS({
  version:       "1.0.0",
  url:           "http://www.lefontiperlastoria.it:80/geoserver/wfs",
  featureType:   "ubicazione_view",
  srsName:       "EPSG:3857",
  featureNS:     "http://www.lefontiperlastoria.it:80",
  geometryName:  "the_geom",
  schema:        "http://www.lefontiperlastoria.it:80?service=WFS&version=1.0.0&request=DescribeFeatureType&TypeName=fonti:ubicazione_view"
 })
});
//siti.setVisibility(false);*/

ubicazione = new OpenLayers.Layer.WMS("ubicazione_view", "http://lefontiperlastoria.it:80/geoserver/fonti/wms",{
     LAYERS: 'fonti:ubicazione_view',
     STYLES: '',
     format: format,
     transparent: true
 },{ 
     singleTile: true,ratio: 1, isBaseLayer: false, 
});


map.addLayer(ubicazione);
 //var gmlLayer = new OpenLayers.Layer.GML("GML", "../OL26/examples/gml/squares_group_4326.xml", {styleMap : aStyleMap})
 
var report = function(e) {OpenLayers.Console.log(e.type, e.feature.id);};
            
highlightCtrl = new OpenLayers.Control.SelectFeature(ubicazione, {
    hover: true,
    highlightOnly: true,
    renderIntent: "temporary",
    eventListeners: {
        beforefeaturehighlighted: report,
        featurehighlighted: report,
        featureunhighlighted: report
    }
});

selectCtrl = new OpenLayers.Control.SelectFeature(ubicazione);

map.addControl(highlightCtrl);
map.addControl(selectCtrl);

highlightCtrl.activate();
selectCtrl.activate();


var aktLayer = 1; //index of a vectorlayer
map.layers[aktLayer].events.register('loadend', map.layers[aktLayer], Radio_and_Checkboxes);
//ubicazione.events.on({
//  "featureselected": regFeatureSelected,
//  "featureunselected": regFeatureUnselected
//});
//map.layers[aktLayer].events.register('featureselected',   map.layers[aktLayer], regFeatureSelected);
//map.layers[aktLayer].events.register('featureunselected', map.layers[aktLayer], regFeatureUnselected);  
  
 if (!map.getCenter()) {map.zoomToExtent(extent);}
} //end init mappa

//###################################################################################
// Create Radiobutton and Checkbox controls
//###################################################################################

 function _lambda_(funcObj, obj, result){
     var Count = obj.length;
     for(var i=0;i<Count;i++)
       if(result.constructor==Array) result.push(funcObj(i,obj[i]));
       else if(result.constructor==Number) result += funcObj(i,obj[i]);
       else if(result.constructor==String) result += funcObj(i,obj[i]);
     return(result);
 }
 
 //funzione per creare un filtro in base ad un attributo dell'oggetto
 function holla(i, obj){
     var name = obj.attributes.name;
     return('<option value="' + i + '">' + name + '</option>');
 }

 function Radio_and_Checkboxes(){
     var groupArr = ["Archeologica", "Architettonica", "Archivistica", "Bibliografica", "Cultura Materiale", "Fotografica", "Orale", "Storico-Artistica"];
     var objFs = map.layers[1].features;
     var theHTML = '';
     theHTML += '<h1>UBICAZIONE FONTE</h1>';
     for(var i=0;i<groupArr.length;i++)
     theHTML += '<input id="ubicazione' + i + '" type="checkbox" checked onclick="changeFeatureVisibility(' + i + ',this.checked)"><label>' + groupArr[i] + '</label><br>';
     //theHTML += '<br><br><b>Select by attribute name</b><br>';
     //theHTML += '<select id="bernd" onchange="showSelectItem(this);">\n';
     //theHTML += _lambda_(holla, map.layers[1].features, []).join("\n");
     //theHTML += '</select>\n';
 
     document.getElementById("switchUbicazione").innerHTML = theHTML;
 }
 
  var popo;   //flag for window.open
 // var popupOpacity=true;
 
 //###################################################################################
 // changeFeatureVisibility
 //###################################################################################
 
 var stylearcheo   = {fillColor: '#24ACCC', fillOpacity: 0.3, strokeWidth: 1.0, strokeColor:'#24ACCC',  pointRadius: 5, display:''};
 var stylearchit   = {fillColor: '#FF7F2A', fillOpacity: 0.3, strokeWidth: 2.0, strokeColor:'#FF7F2A',  pointRadius: 5, display:''};
 var stylearchiv   = {fillColor: '#5BFF24', fillOpacity: 0.3, strokeWidth: 1.0, strokeColor:'#5BFF24',  pointRadius: 5, display:''};
 var stylebiblio   = {fillColor: '#FF5555', fillOpacity: 0.3, strokeWidth: 2.0, strokeColor:'#FF5555',  pointRadius: 5, display:''};
 var stylecultmat  = {fillColor: '#FFCC00', fillOpacity: 0.3, strokeWidth: 2.0, strokeColor:'#FFCC00',  pointRadius: 5, display:''};
 var stylefoto     = {fillColor: '#0066FF', fillOpacity: 0.3, strokeWidth: 2.0, strokeColor:'#0066FF',  pointRadius: 5, display:''};
 var styleorale    = {fillColor: '#FF00FF', fillOpacity: 0.3, strokeWidth: 2.0, strokeColor:'#FF00FF',  pointRadius: 5, display:''};
 var stylestoart   = {fillColor: '#ABC837', fillOpacity: 0.3, strokeWidth: 2.0, strokeColor:'#ABC837',  pointRadius: 5, display:''};
 //var stylecultmat  = {fillOpacity: 1, pointRadius: 10, externalGraphic: "../OL26/img/marker-blue.png", display:''};
 //var stylefoto  = {fillOpacity: 1, pointRadius: 10, externalGraphic: "../OL26/img/marker.png", display:''};
 
 function changeFeatureVisibility(){
     var AstyleMap = new OpenLayers.StyleMap({fillColor: 'yellow', fillOpacity: 0.3, strokeWidth: 1.0, strokeColor:'yellow', pointRadius: 5 });
 
     var lookup = {};
     for(var i=0;i<8;i++){
         var flag = document.getElementById("ubicazione"+i).checked;
         if(i==0 && flag)      lookup['Archeologica']       = stylearcheo;
         else if(i==1 && flag) lookup['Architettonica']     = stylearchit; 
         else if(i==2 && flag) lookup['Archivistica']       = stylearchiv; 
         else if(i==3 && flag) lookup['Bibliografica']      = stylebiblio; 
         else if(i==4 && flag) lookup['Cultura Materiale']  = stylecultmat;
         else if(i==5 && flag) lookup['Fotografica']        = stylefoto;   
         else if(i==6 && flag) lookup['Orale']              = styleorale;  
         else if(i==7 && flag) lookup['Storico-Artistica']  = stylestoart;        
     }
 
     AstyleMap.addUniqueValueRules("default", "scheda", lookup);
     var vlyr = map.layers[2];
     vlyr.styleMap = AstyleMap;
     var objFs = vlyr.features;
     for(var i=0;i<objFs.length;i++) vlyr.drawFeature(objFs[i]);
 }