/******************************************************************************/
/*****************  FUNZIONI OPENLAYERS  ******************************************/
/******************************************************************************/
function init() {
    OpenLayers.ProxyHost = proxy;
    extent = new OpenLayers.Bounds(1279972.812, 5782339.838, 1331677.275, 5838213.399);
    cqlHub = 1;
    map = new OpenLayers.Map ("map", {
        controls:[
            new OpenLayers.Control.Navigation(),
            new OpenLayers.Control.Zoom(),
            new OpenLayers.Control.MousePosition({div:document.getElementById("coord")}),
        ],
        resolutions: resolution,
        maxResolution: 'auto',
        units: 'm',
        projection: new OpenLayers.Projection("EPSG:3857"),
        displayProjection: new OpenLayers.Projection("EPSG:4326")
    });
    scalebar = new OpenLayers.Control.ScaleBar({div:document.getElementById("scalebar")});
    map.addControl(scalebar);
    // if(hub==1 || !hub){
    //     extent = new OpenLayers.Bounds(1279972.812, 5782339.838, 1331677.275, 5838213.399);
    //     comuniLayer = 'fonti:comuni';
    //     cqlHub = 1;
    // }
    // if(hub==2){
    //     extent = new OpenLayers.Bounds(1216522,5769354,1294374,5813972);
    //     comuniLayer = 'fonti:comuni_bassa';
    //     cqlHub = 2;
    // }
    map.addLayers([gsat,osm]);

    comuni = new OpenLayers.Layer.WMS("comuni",wmsHost,
        {srs:srs3857,layers:'fps:comuni',format:format,transparent:true}
        ,{isBaseLayer: false,singleTile: true, ratio: 1, tileSize:tileSize}
    );
    map.addLayer(comuni);

    aree_archeo = new OpenLayers.Layer.WMS("Aree archeologiche", wmsHost
        ,{srs:srs3857,layers:'fps:aree_archeo_poly',format: format,transparent: true}
        ,{isBaseLayer: false,singleTile: true,ratio: 1,tileSize:tileSize}
    );
    map.addLayer(aree_archeo);
    aree_archeo.setVisibility(false);

    aree_architett = new OpenLayers.Layer.WMS("Aree architettoniche", wmsHost
        ,{srs:srs3857,layers:'fps:aree_architett_poly',format: format,transparent: true}
        ,{isBaseLayer: false,singleTile:true,ratio:1,tileSize:tileSize}
    );
    map.addLayer(aree_architett);
    aree_architett.setVisibility(false);

    aree_archivi = new OpenLayers.Layer.WMS("Aree archivistiche", wmsHost
        ,{srs:srs3857,layers:'fps:aree_archiv_poly',format: format,transparent: true}
        ,{isBaseLayer: false,singleTile: true,ratio: 1,tileSize:tileSize}
    );
    map.addLayer(aree_archivi);
    aree_archivi.setVisibility(false);

    aree_biblio = new OpenLayers.Layer.WMS("Aree bibliografiche", wmsHost
        ,{srs:srs3857,layers:'fps:ai_biblio_poly',format: format,transparent: true}
        ,{isBaseLayer: false,singleTile: true,ratio: 1,tileSize: tileSize}
    );
    map.addLayer(aree_biblio);
    aree_biblio.setVisibility(false);

    aree_cultmat = new OpenLayers.Layer.WMS("Aree cultura materiale", wmsHost
        ,{srs:srs3857,layers:'fps:aree_mater_poly',format: format,transparent: true}
        ,{isBaseLayer: false,singleTile: true, ratio: 1,tileSize: tileSize}
    );
    map.addLayer(aree_cultmat);
    aree_cultmat.setVisibility(false);

aree_cultmat_line = new OpenLayers.Layer.WMS("Aree cultura materiale linee", wmsHost,{
   srs:srs3857,
   layers: ['fonti:aree_mater_line'],
   //CQL_FILTER: "hub="+cqlHub,
   styles: '',
   format: format,
   transparent: true
  },{isBaseLayer: false},{singleTile: true, ratio: 1},{ tileSize: tileSize}
);
map.addLayer(aree_cultmat_line);
aree_cultmat_line.setVisibility(false);

aree_foto = new OpenLayers.Layer.WMS("Aree foto", wmsHost,{
   srs:srs3857,
   layers: ['fonti:aree_foto_poly'],
   CQL_FILTER: "hub="+cqlHub,
   styles: '',
   format: format,
   transparent: true
  },{isBaseLayer: false},{singleTile: true, ratio: 1},{ tileSize: tileSize}
);
map.addLayer(aree_foto);
aree_foto.setVisibility(false);

aree_orale = new OpenLayers.Layer.WMS("Aree orale", wmsHost,{
   srs:srs3857,
   layers: ['fonti:aree_orale_poly'],
   CQL_FILTER: "hub="+cqlHub,
   styles: 'orale',
   format: format,
   transparent: true
  },{isBaseLayer: false},{singleTile: true, ratio: 1},{ tileSize: tileSize}
);
map.addLayer(aree_orale);
aree_orale.setVisibility(false);

aree_stoart = new OpenLayers.Layer.WMS("Aree storico-artistiche", wmsHost,{
   srs:srs3857,
   layers: ['fonti:aree_stoart_poly'],
   //CQL_FILTER: "hub="+cqlHub,
   styles: '',
   format: format,
   transparent: true
  },{isBaseLayer: false},{singleTile: true, ratio: 1},{ tileSize: tileSize}
);
map.addLayer(aree_stoart);
aree_stoart.setVisibility(false);

aree_carto = new OpenLayers.Layer.WMS("Aree cartografiche", wmsHost,{
   srs:srs3857,
   layers: ['fonti:area_carto_poly'],
   //CQL_FILTER: "hub="+cqlHub,
   styles: '',
   format: format,
   transparent: true
  },{isBaseLayer: false},{tiled: true, ratio: 1},{ tileSize: tileSize}
);
map.addLayer(aree_stoart);
aree_stoart.setVisibility(false);

var s = new OpenLayers.StyleMap({
   "default": new OpenLayers.Style({fillOpacity:0,strokeOpacity:0}),
   "select": new OpenLayers.Style({strokeColor: "#1D22CF",strokeWidth:3,fillColor: "#1D22CF", fillOpacity:0.6, graphicZIndex: 2}),
   "active": new OpenLayers.Style({fillColor: "#7578F5", fillOpacity:0.6, graphicZIndex: 2})
});
var hiLy = ["area_int_poly", "area_int_line"]
highlightLayer = new OpenLayers.Layer.Vector("Highlighted", {
      strategies: [new OpenLayers.Strategy.BBOX()],
      styleMap: s,
      protocol: new OpenLayers.Protocol.WFS({
          version:     "1.0.0",
          url:         "http://www.lefontiperlastoria.it:8080/geoserver/wfs",
          featureType: hiLy,
          featureNS:   "http://www.lefontiperlastoria.it/fonti",
          srsName:     "EPSG:3857",
          geometryName:"the_geom"//,
          //schema:      "http://www.lefontiperlastoria.it/fonti?service=WFS&version=1.0.0&request=DescribeFeatureType&TypeName=area_int_poly"
      })
});
map.addLayer(highlightLayer);

actLayer = new OpenLayers.Layer.Vector("Active", {
      strategies: [new OpenLayers.Strategy.BBOX()],
      styleMap: s,
      protocol: new OpenLayers.Protocol.WFS({
          version:     "1.0.0",
          url:         "http://www.lefontiperlastoria.it:8080/geoserver/wfs",
          featureType: "area_int_poly",
          featureNS:   "http://www.lefontiperlastoria.it/fonti",
          srsName:     "EPSG:3857",
          geometryName:"the_geom",
          schema:      "http://www.lefontiperlastoria.it/fonti?service=WFS&version=1.0.0&request=DescribeFeatureType&TypeName=area_int_poly"
      })
});
map.addLayer(actLayer);

    toponomastica = new OpenLayers.Layer.WMS("Toponomastica", wmsHost
        ,{srs:srs3857,layers:'fps:toponomastica',format:format,transparent: true}
        ,{isBaseLayer: false,singleTile: true,ratio: 1,tileSize:tileSize}
    );
    map.addLayer(toponomastica);

ubi_archeo = new OpenLayers.Layer.Vector("ubi_archeo", {
      strategies: [new OpenLayers.Strategy.BBOX()],
      protocol: new OpenLayers.Protocol.WFS({
          version:     "1.0.0",
          url:         "http://www.lefontiperlastoria.it:8080/geoserver/wfs",
          featureType: "ubi_archeo",
          featureNS:   "http://www.lefontiperlastoria.it/fonti",
          srsName:     "EPSG:3857",
          geometryName:"the_geom",
          schema:      "http://www.lefontiperlastoria.it/fonti?service=WFS&version=1.0.0&request=DescribeFeatureType&TypeName=ubi_archeo"
      })
});
map.addLayer(ubi_archeo);
ubi_archeo.setVisibility(false);

ubi_archit = new OpenLayers.Layer.Vector("ubi_archit", {
      strategies: [new OpenLayers.Strategy.BBOX()],
      protocol: new OpenLayers.Protocol.WFS({
          version:     "1.0.0",
          url:         "http://www.lefontiperlastoria.it:8080/geoserver/wfs",
          featureType: "ubi_archit",
          featureNS:   "http://www.lefontiperlastoria.it/fonti",
          srsName:     "EPSG:3857",
          geometryName:"the_geom",
          schema:      "http://www.lefontiperlastoria.it/fonti?service=WFS&version=1.0.0&request=DescribeFeatureType&TypeName=ubi_archit"
      })
});
map.addLayer(ubi_archit);
ubi_archit.setVisibility(false);

ubi_archiv = new OpenLayers.Layer.Vector("ubi_archiv", {
      strategies: [new OpenLayers.Strategy.BBOX()],
      protocol: new OpenLayers.Protocol.WFS({
          version:     "1.0.0",
          url:         "http://www.lefontiperlastoria.it:8080/geoserver/wfs",
          featureType: "ubi_archiv",
          featureNS:   "http://www.lefontiperlastoria.it/fonti",
          srsName:     "EPSG:3857",
          geometryName:"the_geom",
          schema:      "http://www.lefontiperlastoria.it/fonti?service=WFS&version=1.0.0&request=DescribeFeatureType&TypeName=ubi_archiv"
      })
});
map.addLayer(ubi_archiv);
ubi_archiv.setVisibility(false);

ubi_biblio = new OpenLayers.Layer.Vector("ubi_biblio", {
      strategies: [new OpenLayers.Strategy.BBOX()],
      protocol: new OpenLayers.Protocol.WFS({
          version:     "1.0.0",
          url:         "http://www.lefontiperlastoria.it:8080/geoserver/wfs",
          featureType: "ubi_biblio",
          featureNS:   "http://www.lefontiperlastoria.it/fonti",
          srsName:     "EPSG:3857",
          geometryName:"the_geom",
          schema:      "http://www.lefontiperlastoria.it/fonti?service=WFS&version=1.0.0&request=DescribeFeatureType&TypeName=ubi_biblio"
      })
});
map.addLayer(ubi_biblio);
ubi_biblio.setVisibility(false);

ubi_foto = new OpenLayers.Layer.Vector("ubi_foto", {
      strategies: [new OpenLayers.Strategy.BBOX()],
      protocol: new OpenLayers.Protocol.WFS({
          version:     "1.0.0",
          url:         "http://www.lefontiperlastoria.it:8080/geoserver/wfs",
          featureType: "ubi_foto",
          featureNS:   "http://www.lefontiperlastoria.it/fonti",
          srsName:     "EPSG:3857",
          geometryName:"the_geom",
          schema:      "http://www.lefontiperlastoria.it/fonti?service=WFS&version=1.0.0&request=DescribeFeatureType&TypeName=ubi_foto"
      })
});
map.addLayer(ubi_foto);
ubi_foto.setVisibility(false);

ubi_mater = new OpenLayers.Layer.Vector("ubi_mater", {
      strategies: [new OpenLayers.Strategy.BBOX()],
      protocol: new OpenLayers.Protocol.WFS({
          version:     "1.0.0",
          url:         "http://www.lefontiperlastoria.it:8080/geoserver/wfs",
          featureType: "ubi_mater",
          featureNS:   "http://www.lefontiperlastoria.it/fonti",
          srsName:     "EPSG:3857",
          geometryName:"the_geom",
          schema:      "http://www.lefontiperlastoria.it/fonti?service=WFS&version=1.0.0&request=DescribeFeatureType&TypeName=ubi_mater"
      })
});
map.addLayer(ubi_mater);
ubi_mater.setVisibility(false);

ubi_oral = new OpenLayers.Layer.Vector("ubi_oral", {
      strategies: [new OpenLayers.Strategy.BBOX()],
      protocol: new OpenLayers.Protocol.WFS({
          version:     "1.0.0",
          url:         "http://www.lefontiperlastoria.it:8080/geoserver/wfs",
          featureType: "ubi_oral",
          featureNS:   "http://www.lefontiperlastoria.it/fonti",
          srsName:     "EPSG:3857",
          geometryName:"the_geom",
          schema:      "http://www.lefontiperlastoria.it/fonti?service=WFS&version=1.0.0&request=DescribeFeatureType&TypeName=ubi_oral"
      })
});
map.addLayer(ubi_oral);
ubi_oral.setVisibility(false);

ubi_stoart = new OpenLayers.Layer.Vector("ubi_stoart", {
      strategies: [new OpenLayers.Strategy.BBOX()],
      protocol: new OpenLayers.Protocol.WFS({
          version:     "1.0.0",
          url:         "http://www.lefontiperlastoria.it:8080/geoserver/wfs",
          featureType: "ubi_stoart",
          featureNS:   "http://www.lefontiperlastoria.it/fonti",
          srsName:     "EPSG:3857",
          geometryName:"the_geom",
          schema:      "http://www.lefontiperlastoria.it/fonti?service=WFS&version=1.0.0&request=DescribeFeatureType&TypeName=ubi_stoart"
      })
});
map.addLayer(ubi_stoart);
ubi_stoart.setVisibility(false);

listaUbi=[ubi_archeo, ubi_archit, ubi_archiv, ubi_biblio, ubi_foto, ubi_mater, ubi_oral, ubi_stoart];
listalayer= [aree_carto, aree_archeo, aree_archivi, aree_architett, aree_biblio, aree_cultmat,aree_cultmat_line, aree_foto, aree_orale, aree_stoart];

info = new OpenLayers.Control.WMSGetFeatureInfo({
    url: 'http://www.lefontiperlastoria.it/geoserver/wms',
    title: 'Informazioni sui livelli interrogati',
    queryVisible: true,
    layers: listalayer,
    infoFormat: 'application/vnd.ogc.gml',
    //vendorParams: {buffer: 10},
    eventListeners: {
        getfeatureinfo: function(event) {
            var arr = new Array();
            var arrActive = new Array();
            var arrArea = new Array();
            for (var i = 0; i < event.features.length; i++) {
               var feature = event.features[i];
               var attributes = feature.attributes;
               var id_ai = attributes.id_geom;
               var id_area = attributes.id_area;
               arr.push(id_ai);
               arrArea.push(id_area);
            }
            $(".ai:checked").map(function(){arrActive.push($(this).attr('data-tipo'));});

            $.ajax({
                 url: 'inc/popupAi.php',
                 type: 'POST',
                 data: {arr:arr,arrActive:arrActive,arrArea:arrArea},
                 success: function(data){
                   $("#result").animate({left:"0px"});
                   $("#resultContent").html(data);
                 }
            });//ajax*/
            console.log(arr);
            console.log(arrArea);
            console.log(arrActive);
        }
    }
});
map.addControl(info);
info.activate();

var report = function(e) {OpenLayers.Console.log(e.type, e.feature.id);};

var highlightCtrl = new OpenLayers.Control.SelectFeature(listaUbi, {
    hover: true,
    highlightOnly: true,
    renderIntent: "temporary",
    eventListeners: {
        beforefeaturehighlighted: report,
        featurehighlighted: report,
        featureunhighlighted: report
    }
});
var selectCtrl = new OpenLayers.Control.SelectFeature(listaUbi);

map.addControl(highlightCtrl);
map.addControl(selectCtrl);

highlightCtrl.activate();
selectCtrl.activate();

function onPopupClose(evt) {selectControl.unselect(feature);}

var selectControl = new OpenLayers.Control.SelectFeature(listaUbi);
ubi_archeo.events.on({
  featureselected: function(event) {
     var feature = event.feature;
     var id_ubi = feature.attributes.id;
     var tipoUbi = new Array();
     var tu = $('input:checkbox[name=overlaysUbi]:checked').map(function() { return this.value; }).get();
     console.log("ubi: "+tu);
     $.ajax({
       url: '../inc/popupUbi.php',
       type: 'POST',
       data: {id_ubi:id_ubi, tipo:6},
       success: function(data){
          popupUbi = data;
          var popup = new OpenLayers.Popup.Anchored(
            "popUbi",
            feature.geometry.getBounds().getCenterLonLat(),
            null,
            popupUbi,
            null,
            true,
            null
     );
     feature.popup = popup;
     popup.autoSize = true;
     map.addPopup(popup);
     $(".olPopupCloseBox").html('&#10006;');
     }
   });//ajax
     //console.log("popup: "+popupUbi);

  },
  featureunselected: function(event) {
     var feature = event.feature;
     if (feature.popup){
       map.removePopup(feature.popup);
       feature.popup.destroy();
       feature.popup = null;
     }
   }
});

ubi_archit.events.on({
  featureselected: function(event) {
     var feature = event.feature;
     var id_ubi = feature.attributes.id;
     var tipoUbi = new Array();
     var tu = $('input:checkbox[name=overlaysUbi]:checked').map(function() { return this.value; }).get();
     console.log("ubi: "+tu);
     $.ajax({
       url: '../inc/popupUbi.php',
       type: 'POST',
       data: {id_ubi:id_ubi, tipo:8},
       success: function(data){
          popupUbi = data;
          var popup = new OpenLayers.Popup.Anchored(
            "popUbi",
            feature.geometry.getBounds().getCenterLonLat(),
            null,
            popupUbi,
            null,
            true,
            null
     );
     feature.popup = popup;
     popup.autoSize = true;
     map.addPopup(popup);
     $(".olPopupCloseBox").html('&#10006;');
     }
   });//ajax
     //console.log("popup: "+popupUbi);

  },
  featureunselected: function(event) {
     var feature = event.feature;
     if (feature.popup){
       map.removePopup(feature.popup);
       feature.popup.destroy();
       feature.popup = null;
     }
   }
});

ubi_archiv.events.on({
  featureselected: function(event) {
     var feature = event.feature;
     var id_ubi = feature.attributes.id;
     var tipoUbi = new Array();
     var tu = $('input:checkbox[name=overlaysUbi]:checked').map(function() { return this.value; }).get();
     console.log("ubi: "+tu);
     $.ajax({
       url: '../inc/popupUbi.php',
       type: 'POST',
       data: {id_ubi:id_ubi, tipo:4},
       success: function(data){
          popupUbi = data;
          var popup = new OpenLayers.Popup.Anchored(
            "popUbi",
            feature.geometry.getBounds().getCenterLonLat(),
            null,
            popupUbi,
            null,
            true,
            null
     );
     feature.popup = popup;
     popup.autoSize = true;
     map.addPopup(popup);
     $(".olPopupCloseBox").html('&#10006;');
     }
   });//ajax
     //console.log("popup: "+popupUbi);

  },
  featureunselected: function(event) {
     var feature = event.feature;
     if (feature.popup){
       map.removePopup(feature.popup);
       feature.popup.destroy();
       feature.popup = null;
     }
   }
});

ubi_biblio.events.on({
  featureselected: function(event) {
     var feature = event.feature;
     var id_ubi = feature.attributes.id;
     var tipoUbi = new Array();
     var tu = $('input:checkbox[name=overlaysUbi]:checked').map(function() { return this.value; }).get();
     console.log("ubi: "+tu);
     $.ajax({
       url: '../inc/popupUbi.php',
       type: 'POST',
       data: {id_ubi:id_ubi, tipo:5},
       success: function(data){
          popupUbi = data;
          var popup = new OpenLayers.Popup.Anchored(
            "popUbi",
            feature.geometry.getBounds().getCenterLonLat(),
            null,
            popupUbi,
            null,
            true,
            null
     );
     feature.popup = popup;
     popup.autoSize = true;
     map.addPopup(popup);
     $(".olPopupCloseBox").html('&#10006;');
     }
   });//ajax
     //console.log("popup: "+popupUbi);

  },
  featureunselected: function(event) {
     var feature = event.feature;
     if (feature.popup){
       map.removePopup(feature.popup);
       feature.popup.destroy();
       feature.popup = null;
     }
   }
});

ubi_foto.events.on({
  featureselected: function(event) {
     var feature = event.feature;
     var id_ubi = feature.attributes.id;
     var tipoUbi = new Array();
     var tu = $('input:checkbox[name=overlaysUbi]:checked').map(function() { return this.value; }).get();
     console.log("ubi: "+tu);
     $.ajax({
       url: '../inc/popupUbi.php',
       type: 'POST',
       data: {id_ubi:id_ubi, tipo:7},
       success: function(data){
          popupUbi = data;
          var popup = new OpenLayers.Popup.Anchored(
            "popUbi",
            feature.geometry.getBounds().getCenterLonLat(),
            null,
            popupUbi,
            null,
            true,
            null
     );
     feature.popup = popup;
     popup.autoSize = true;
     map.addPopup(popup);
     $(".olPopupCloseBox").html('&#10006;');
     }
   });//ajax
     //console.log("popup: "+popupUbi);

  },
  featureunselected: function(event) {
     var feature = event.feature;
     if (feature.popup){
       map.removePopup(feature.popup);
       feature.popup.destroy();
       feature.popup = null;
     }
   }
});

ubi_mater.events.on({
  featureselected: function(event) {
     var feature = event.feature;
     var id_ubi = feature.attributes.id;
     var tipoUbi = new Array();
     var tu = $('input:checkbox[name=overlaysUbi]:checked').map(function() { return this.value; }).get();
     console.log("ubi: "+tu);
     $.ajax({
       url: '../inc/popupUbi.php',
       type: 'POST',
       data: {id_ubi:id_ubi, tipo:2},
       success: function(data){
          popupUbi = data;
          var popup = new OpenLayers.Popup.Anchored(
            "popUbi",
            feature.geometry.getBounds().getCenterLonLat(),
            null,
            popupUbi,
            null,
            true,
            null
     );
     feature.popup = popup;
     popup.autoSize = true;
     map.addPopup(popup);
     $(".olPopupCloseBox").html('&#10006;');
     }
   });//ajax
     //console.log("popup: "+popupUbi);

  },
  featureunselected: function(event) {
     var feature = event.feature;
     if (feature.popup){
       map.removePopup(feature.popup);
       feature.popup.destroy();
       feature.popup = null;
     }
   }
});

ubi_oral.events.on({
  featureselected: function(event) {
     var feature = event.feature;
     var id_ubi = feature.attributes.id;
     var tipoUbi = new Array();
     var tu = $('input:checkbox[name=overlaysUbi]:checked').map(function() { return this.value; }).get();
     console.log("ubi: "+tu);
     $.ajax({
       url: '../inc/popupUbi.php',
       type: 'POST',
       data: {id_ubi:id_ubi, tipo:1},
       success: function(data){
          popupUbi = data;
          var popup = new OpenLayers.Popup.Anchored(
            "popUbi",
            feature.geometry.getBounds().getCenterLonLat(),
            null,
            popupUbi,
            null,
            true,
            null
     );
     feature.popup = popup;
     popup.autoSize = true;
     map.addPopup(popup);
     $(".olPopupCloseBox").html('&#10006;');
     }
   });//ajax
     //console.log("popup: "+popupUbi);

  },
  featureunselected: function(event) {
     var feature = event.feature;
     if (feature.popup){
       map.removePopup(feature.popup);
       feature.popup.destroy();
       feature.popup = null;
     }
   }
});

ubi_stoart.events.on({
  featureselected: function(event) {
     var feature = event.feature;
     var id_ubi = feature.attributes.id;
     var tipoUbi = new Array();
     var tu = $('input:checkbox[name=overlaysUbi]:checked').map(function() { return this.value; }).get();
     console.log("ubi: "+tu);
     $.ajax({
       url: '../inc/popupUbi.php',
       type: 'POST',
       data: {id_ubi:id_ubi, tipo:9},
       success: function(data){
          popupUbi = data;
          var popup = new OpenLayers.Popup.Anchored(
            "popUbi",
            feature.geometry.getBounds().getCenterLonLat(),
            null,
            popupUbi,
            null,
            true,
            null
     );
     feature.popup = popup;
     popup.autoSize = true;
     map.addPopup(popup);
     $(".olPopupCloseBox").html('&#10006;');
     }
   });//ajax
     //console.log("popup: "+popupUbi);

  },
  featureunselected: function(event) {
     var feature = event.feature;
     if (feature.popup){
       map.removePopup(feature.popup);
       feature.popup.destroy();
       feature.popup = null;
     }
   }
});
 //Storico navigazione
 var history = new OpenLayers.Control.NavigationHistory();
 map.addControl(history);

 var btnPrev = new OpenLayers.Control.Panel({
    div: document.getElementById("btnPrev"),
    displayClass:"prev"
 });

 var btnNext = new OpenLayers.Control.Panel({
   div: document.getElementById("btnNext"),
   displayClass:"next"
 });

 map.addControl(btnPrev);
 btnPrev.addControls([history.previous]);
 map.addControl(btnNext);
 btnNext.addControls([history.next]);

 pan = new OpenLayers.Control.DragPan({
 	div: document.getElementById("drag"),
 	isDefault: true,
 	title:"Pan"
 });
 map.addControl(pan);
 pan.activate();

 zoomin = new OpenLayers.Control.ZoomBox({
 	div: document.getElementById("zoomArea"),
 	title:"Zoom in box",
 	out: false
 });
 map.addControl(zoomin);
 zoomin.deactivate();

    var panControl = document.getElementById("drag");
    var zoomControl = document.getElementById("zoomArea");

    if (!map.getCenter()) {map.zoomToExtent(extent);}
    layerList=[comuni,toponomastica,aree_archeo,aree_architett,aree_archivi,aree_biblio,aree_cultmat];

}


/***********  FUNZIONI PER LA CREAZIONE DEI LIVELLI NELLA MAPPA **************************/

/******** ACCENDI/SPEGNI TUTTE LE AREE CONTEMPORANEAMENTE ************************/
$("#areaToggle").click(function(){
  $(this).toggleClass('acceso');
  if($(this).hasClass('acceso')){
     aree_archeo.setVisibility(true);
     aree_architett.setVisibility(true);
     aree_archivi.setVisibility(true);
     aree_biblio.setVisibility(true);
     aree_cultmat.setVisibility(true);
     aree_cultmat_line.setVisibility(true);
     aree_foto.setVisibility(true);
     aree_orale.setVisibility(true);
     aree_stoart.setVisibility(true);
     $('input[name=overlays]').attr('checked', true);
     $('div.legendeAree').fadeIn('fast');
  }else{
     aree_archeo.setVisibility(false);
     aree_architett.setVisibility(false);
     aree_archivi.setVisibility(false);
     aree_biblio.setVisibility(false);
     aree_cultmat.setVisibility(false);
     aree_cultmat_line.setVisibility(false);
     aree_foto.setVisibility(false);
     aree_orale.setVisibility(false);
     aree_stoart.setVisibility(false);
     $('input[name=overlays]').attr('checked', false);
     $('div.legendeAree').fadeOut('fast');
  }
});

/******** ACCENDI/SPEGNI TUTTE LE UBICAZIONI CONTEMPORANEAMENTE ************************/
/*$("#ubiToggle").click(function(){
  $(this).toggleClass('acceso');
  if($(this).hasClass('acceso')){
  	ubicazione.setVisibility(true);
  	$('input[name=overlaysUbi]').attr('checked', true);
  	$('div.legendeUbi').fadeIn('fast');
  }else{
  	ubicazione.setVisibility(false);
  	$('input[name=overlaysUbi]').attr('checked', false);
   $('div.legendeUbi').fadeOut('fast');
  }

});
*/
function toggleComuni(){
	if (comuni.getVisibility() == true) {comuni.setVisibility(false);}else{comuni.setVisibility(true);}
}
function toggleToponomastica(){
	if (toponomastica.getVisibility() == true) {toponomastica.setVisibility(false);}else{toponomastica.setVisibility(true);}
}
function toggleAreeArcheo(){
  if (aree_archeo.getVisibility() == true) {aree_archeo.setVisibility(false);}else{aree_archeo.setVisibility(true);}
}
function toggleAreeArchivi(){
  if (aree_archivi.getVisibility() == true) {aree_archivi.setVisibility(false);}else{aree_archivi.setVisibility(true);}
}
function toggleAreeArchitett(){
  if (aree_architett.getVisibility() == true) {aree_architett.setVisibility(false);}else{aree_architett.setVisibility(true);}
}
function toggleAreeBiblio(){
  if (aree_biblio.getVisibility() == true) {aree_biblio.setVisibility(false);}else{aree_biblio.setVisibility(true);}
}
function toggleAreeCultMat(){
  if (aree_cultmat.getVisibility() == true) {aree_cultmat.setVisibility(false);}else{aree_cultmat.setVisibility(true);}
  if (aree_cultmat_line.getVisibility() == true) {aree_cultmat_line.setVisibility(false);}else{aree_cultmat_line.setVisibility(true);}
}
function toggleAreeFoto(){
  if (aree_foto.getVisibility() == true) {aree_foto.setVisibility(false);}else{aree_foto.setVisibility(true);}
}
function toggleAreeOrale(){
  if (aree_orale.getVisibility() == true) {aree_orale.setVisibility(false);}else{aree_orale.setVisibility(true);}
}
function toggleAreeStoArt(){
  if (aree_stoart.getVisibility() == true) {aree_stoart.setVisibility(false);}else{aree_stoart.setVisibility(true);}
}
function toggleAreeCarto(){
  if (aree_carto.getVisibility() == true) {aree_carto.setVisibility(false);}else{aree_carto.setVisibility(true);}
}
function toggleUbiArcheo(){if (ubi_archeo.getVisibility() == true) {ubi_archeo.setVisibility(false);}else{ubi_archeo.setVisibility(true);}}
function toggleUbiArchiv(){if (ubi_archiv.getVisibility() == true) {ubi_archiv.setVisibility(false);}else{ubi_archiv.setVisibility(true);}}
function toggleUbiArchit(){if (ubi_archit.getVisibility() == true) {ubi_archit.setVisibility(false);}else{ubi_archit.setVisibility(true);}}
function toggleUbiBiblio(){if (ubi_biblio.getVisibility() == true) {ubi_biblio.setVisibility(false);}else{ubi_biblio.setVisibility(true);}}
function toggleUbiFoto(){if (ubi_foto.getVisibility() == true) {ubi_foto.setVisibility(false);}else{ubi_foto.setVisibility(true);}}
function toggleUbiMater(){if (ubi_mater.getVisibility() == true) {ubi_mater.setVisibility(false);}else{ubi_mater.setVisibility(true);}}
function toggleUbiOral(){if (ubi_oral.getVisibility() == true) {ubi_oral.setVisibility(false);}else{ubi_oral.setVisibility(true);}}
function toggleUbiStoart(){if (ubi_stoart.getVisibility() == true) {ubi_stoart.setVisibility(false);}else{ubi_stoart.setVisibility(true);}}
function zoomLayer(layer,ll){
    if (comuni.getVisibility() == true) {comuni.setVisibility(false);$("input#comuni").attr('checked', false);}
    if (toponomastica.getVisibility() == false) {
        toponomastica.setVisibility(true);
        $("input#"+layer).attr('checked', true);
    }
    var xy = new OpenLayers.LonLat(ll[0],ll[1]);
    var testZoom = map.getZoomForExtent(extent);
    console.log(xy);
    map.setCenter(xy,17);
}
/******************************************************************************/
/*****************  FUNZIONI JQUERY  ******************************************/
/**********************it********************************************************/
$("#logo").click(function(){window.open("home.php", "_blank");});
$("#database").click(function(){window.open("ricerche.php", "_blank");});
$("#formRicerca, .legendeAreeArcheo, .legendeAreeArchitet, .legendeAreeArchiv, .legendeAreeBiblio, .legendeAreeCult, .legendeAreeFoto, .legendeAreeOrale, .legendeAreeStoArt, .legendeUbiArcheo, .legendeUbiArchitet, .legendeUbiArchiv, .legendeUbiBiblio, .legendeUbiCult, .legendeUbiFoto, .legendeUbiOrale, .legendeUbiStoArt").hide();

//$("#ricercaToggle").click(function(){ $("#formRicerca").slideToggle().toggleClass('aperto'); });

/***************** ACCORDION SWITCHER ********************************************


$("#cartografiaToggle").click(function(){
  $("#cartografiaSwitch").slideToggle().toggleClass('aperto');
  if($("#formRicerca").hasClass('aperto')){$("#formRicerca").slideToggle().removeClass('aperto');}
  if($("#areaSwitch").hasClass('aperto')){$("#areaSwitch").slideToggle().removeClass('aperto');}
  if($("#ubiSwitch").hasClass('aperto')){$("#ubiSwitch").slideToggle().removeClass('aperto');}
});

$("#areaToggle").click(function(){
  $("#areaSwitch").slideToggle().toggleClass('aperto');
  if($("#formRicerca").hasClass('aperto')){$("#formRicerca").slideToggle().removeClass('aperto');}
  if($("#cartografiaSwitch").hasClass('aperto')){$("#cartografiaSwitch").slideToggle().removeClass('aperto');}
  if($("#ubiSwitch").hasClass('aperto')){$("#ubiSwitch").slideToggle().removeClass('aperto');}
});

$("#ubiToggle").click(function(){
  $("#ubiSwitch").slideToggle().toggleClass('aperto');
  if($("#formRicerca").hasClass('aperto')){$("#formRicerca").slideToggle().removeClass('aperto');}
  if($("#cartografiaSwitch").hasClass('aperto')){$("#cartografiaSwitch").slideToggle().removeClass('aperto');}
  if($("#areaSwitch").hasClass('aperto')){$("#areaSwitch").slideToggle().removeClass('aperto');}
});

*/
var $tooltip = $('<span class="sliderTip" id="sliderTip"></span>');

/*
$(".olControlZoomIn, .olControlZoomOut, #drag, #zoomArea, #zoomMax, #history").hover(
 function(){$("#pannello").css('background-color','rgba(255,255,255,0.5)').fadeIn('slow')},
 function(){$("#pannello").css('background-color','rgba(255,255,255,0)').fadeOut('slow')}
);
*/
/******************** GESTIONE ACCENSIONE LIVELLI ******************/
$("#comuni").on("change", toggleComuni);
$("#toponomastica").on("change", toggleToponomastica);

$("#aree_archeo")
   .on("change", toggleAreeArcheo)
   .click(function(){
   	 if($(this).attr('checked')){$(".legendeAreeArcheo").fadeIn('fast');}
   	 else{$(".legendeAreeArcheo").fadeOut('fast');}
   });

$("#aree_architet")
   .on("change", toggleAreeArchitett)
   .click(function(){
   	 if($(this).attr('checked')){$(".legendeAreeArchitet").fadeIn('fast');}
   	 else{$(".legendeAreeArchitet").fadeOut('fast');}
   });

$("#aree_archiv")
   .on("change", toggleAreeArchivi)
   .click(function(){
   	 if($(this).attr('checked')){$(".legendeAreeArchiv").fadeIn('fast');}
   	 else{$(".legendeAreeArchiv").fadeOut('fast');}
   });

$("#aree_biblio")
   .on("change", toggleAreeBiblio)
   .click(function(){
   	 if($(this).attr('checked')){$(".legendeAreeBiblio").fadeIn('fast');}
   	 else{$(".legendeAreeBiblio").fadeOut('fast');}
   });

$("#aree_cult")
   .on("change", toggleAreeCultMat)
   .click(function(){
   	 if($(this).attr('checked')){$(".legendeAreeCult").fadeIn('fast');}
   	 else{$(".legendeAreeCult").fadeOut('fast');}
   });

$("#aree_foto")
   .on("change", toggleAreeFoto)
   .click(function(){
   	 if($(this).attr('checked')){$(".legendeAreeFoto").fadeIn('fast');}
   	 else{$(".legendeAreeFoto").fadeOut('fast');}
   });

$("#aree_orale")
   .on("change", toggleAreeOrale)
   .click(function(){
   	 if($(this).attr('checked')){$(".legendeAreeOrale").fadeIn('fast');}
   	 else{$(".legendeAreeOrale").fadeOut('fast');}
   });

$("#aree_stoart")
   .on("change", toggleAreeStoArt)
   .click(function(){
   	 if($(this).attr('checked')){$(".legendeAreeStoArt").fadeIn('fast');}
   	 else{$(".legendeAreeStoArt").fadeOut('fast');}
   });

$("#ubi_archeo").on("change", toggleUbiArcheo);
$("#ubi_architet").on("change", toggleUbiArchit);
$("#ubi_archiv").on("change", toggleUbiArchiv);
$("#ubi_biblio").on("change", toggleUbiBiblio);
$("#ubi_cult").on("change", toggleUbiMater);
$("#ubi_foto").on("change", toggleUbiFoto);
$("#ubi_orale").on("change", toggleUbiOral);
$("#ubi_stoart").on("change", toggleUbiStoart);

/*****************   COMANDI PER INTERAGIRE CON LA MAPPA ***********************/
$("#zoomMax").click(function(){map.zoomToExtent(extent);});
$("#topoSearch select").change(function(){
    var ll = $(this).val().split(',');
    var layer = "toponomastica";
    zoomLayer(layer,ll);
    //console.log("ll: "+ll);
});

$("#zoomArea").click(function(){
	$(this).addClass('attivo');
	$('#drag').removeClass('attivo');
	zoomin.activate();
	pan.deactivate();
});
$("#drag").click(function(){
	$(this).addClass('attivo');
	$('#zoomArea').removeClass('attivo');
   zoomin.deactivate();
	pan.activate();
});


/******************** GESTIONE SLIDER *******************************************/
$( "#slider" ).slider({
       orientation: "vertical",
       range: "min",
       min: 0,
       max: 2000,
       value: 2000,
       slide: function( event, ui ) {
         $(".sliderTip").text(ui.value);
       }
}).find(".ui-slider-handle").append($tooltip);
$(".sliderTip").text($("#slider").slider('option','value'));

$("#sliderArea,#amountAree").hide();
$('input[name=overlays]').on("change", function(){
 if($('input[name=overlays]').is(':checked')){$("#sliderArea, #amountAree").show(); }else{ $("#sliderArea,#amountAree").hide(); }
});

$("#sliderArea").slider({
        range: "min",
        min: 0,
        max: 100,
        value: 100,
        slide: function(e, ui) {
          aree_archeo.setOpacity(ui.value / 100);
          aree_archivi.setOpacity(ui.value / 100);
          aree_architett.setOpacity(ui.value / 100);
          aree_biblio.setOpacity(ui.value / 100);
          aree_cultmat.setOpacity(ui.value / 100);
          aree_cultmat_line.setOpacity(ui.value / 100);
          aree_foto.setOpacity(ui.value / 100);
          aree_orale.setOpacity(ui.value / 100);
          aree_stoart.setOpacity(ui.value / 100);
          $( "#amountAree" ).text(ui.value + "%");
          $('.legendeAreeArcheo').css('background-color', 'rgba(255,102,0,'+ui.value/100+')');
          $('.legendeAreeArchitet').css('background-color', 'rgba(255,0,0,'+ui.value/100+')');
          $('.legendeAreeArchiv').css('background-color', 'rgba(255,0,255,'+ui.value/100+')');
          $('.legendeAreeBiblio').css('background-color', 'rgba(255,255,0,'+ui.value/100+')');
          $('.legendeAreeCult').css('background-color', 'rgba(0,128,0,'+ui.value/100+')');
          $('.legendeAreeFoto').css('background-color', 'rgba(0,255,0,'+ui.value/100+')');
          $('.legendeAreeOrale').css('background-color', 'rgba(0,255,255,'+ui.value/100+')');
          $('.legendeAreeStoArt').css('background-color', 'rgba(0,0,128,'+ui.value/100+')');
        }
});
$("#amountAree").text($("#sliderArea").slider("value") + "%");
