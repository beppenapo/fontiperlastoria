/******************************************************************************/
/*****************  FUNZIONI OPENLAYERS  ******************************************/
/******************************************************************************/
var gsat, comuni,  arrayOSM, osm; //baselayer
var aree_archeo, ubicazione, aree_line, aree; //overlay
var extent, highlightCtrl, selectCtrl, pan, zoomin; //funzioni o comandi
//###################################################################################
// popup start
//###################################################################################
//ubi_numsch, ubi_stato, ubi_prov, ubi_com, ubi_loc, ubi_ind, ubi_tel, ubi_mail, ubi_web, ubi_motiv, ubi_id, ubi_point_wgs, ubi_pcat, id, scheda

 
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
    //new OpenLayers.Control.PanZoom(),
    new OpenLayers.Control.Zoom(),
    new OpenLayers.Control.MousePosition({div:document.getElementById("coord")}),
   ],
   resolutions: [156543.03390625, 78271.516953125, 39135.7584765625, 19567.87923828125, 9783.939619140625, 4891.9698095703125, 2445.9849047851562, 1222.9924523925781, 611.4962261962891, 305.74811309814453, 152.87405654907226, 76.43702827453613, 38.218514137268066, 19.109257068634033, 9.554628534317017, 4.777314267158508, 2.388657133579254, 1.194328566789627, 0.5971642833948135, 0.29858214169740677, 0.14929107084870338, 0.07464553542435169, 0.037322767712175846, 0.018661383856087923, 0.009330691928043961, 0.004665345964021981, 0.0023326729820109904, 0.0011663364910054952, 5.831682455027476E-4, 2.915841227513738E-4, 1.457920613756869E-4],
   maxResolution: 'auto',
   maxExtent: new OpenLayers.Bounds (1279972.812, 5782339.838, 1331677.275, 5838213.399),
   //allOverlays: true,
   units: 'm',
   projection: new OpenLayers.Projection("EPSG:3857"),
   displayProjection: new OpenLayers.Projection("EPSG:4326")
 });
 var scalebar = new OpenLayers.Control.ScaleBar({div:document.getElementById("scalebar")});
 map.addControl(scalebar);
 
 //var LayerSwitcher = new OpenLayers.Control.LayerSwitcher({activeColor:"#f5f3e5"});
 //map.addControl(LayerSwitcher);
 
 extent = new OpenLayers.Bounds(1279972.812, 5782339.838, 1331677.275, 5838213.399);
 
 proj900913 = new OpenLayers.Projection("EPSG:900913");
 proj4326 = new OpenLayers.Projection("EPSG:4326");
 
 

 gsat = new OpenLayers.Layer.Google("Satellite", {type: google.maps.MapTypeId.SATELLITE, numZoomLevels: 22});
 map.addLayer(gsat);

arrayOSM = ["http://otile1.mqcdn.com/tiles/1.0.0/map/${z}/${x}/${y}.jpg",
            "http://otile2.mqcdn.com/tiles/1.0.0/map/${z}/${x}/${y}.jpg",
            "http://otile3.mqcdn.com/tiles/1.0.0/map/${z}/${x}/${y}.jpg",
            "http://otile4.mqcdn.com/tiles/1.0.0/map/${z}/${x}/${y}.jpg"];
            
osm = new OpenLayers.Layer.OSM("MapQuest-OSM Tiles", arrayOSM, {
                attribution: "Data, imagery and map information provided by <a href='http://www.mapquest.com/'  target='_blank'>MapQuest</a>, <a href='http://www.openstreetmap.org/' target='_blank'>Open Street Map</a> and contributors, <a href='http://creativecommons.org/licenses/by-sa/2.0/' target='_blank'>CC-BY-SA</a>  <img src='http://developer.mapquest.com/content/osm/mq_logo.png' border='0'>",
                transitionEffect: "resize"
            });
map.addLayer(osm);



 comuni = new OpenLayers.Layer.WMS("comuni", "http://arc-team.homelinux.com:8080/geoserver/wms",{
   srs: 'EPSG:900913',
   layers: 'fonti:comuni',
   styles: '',
   format: format, 
   transparent: true
  },{isBaseLayer: false},{singleTile: true, ratio: 1},{ tileSize: new OpenLayers.Size(256,256)}
);
map.addLayer(comuni); 
comuni.setVisibility(false);

ubicazione = new OpenLayers.Layer.Vector("ubicazione", {
                    strategies: [new OpenLayers.Strategy.BBOX()],
                    protocol: new OpenLayers.Protocol.WFS({
                        url:  "http://lefontiperlastoria.it/geoserver/wfs",
                        featureType: "ubicazione_view",
                        featureNS: "http://www.lefontiperlastoria.it/fonti"
                    })
                });
map.addLayer(ubicazione);


aree_archeo = new OpenLayers.Layer.WMS("Aree archeologiche", "http://www.lefontiperlastoria.it/geoserver/wms",{
   srs: 'EPSG:900913',
   layers: ['fonti:area_archeo_poly'],
   styles: '',
   format: format, 
   transparent: true
  },{isBaseLayer: false},{singleTile: true, ratio: 1},{ tileSize: new OpenLayers.Size(256,256)}
);
map.addLayer(aree_archeo); 
aree_archeo.setVisibility(false);

aree = new OpenLayers.Layer.Vector("aree", {
                    strategies: [new OpenLayers.Strategy.BBOX()],
                    protocol: new OpenLayers.Protocol.WFS({
                        url:  "http://lefontiperlastoria.it/geoserver/wfs",
                        featureType: ['area_int_line', 'area_int_poly'],
                        featureNS: "http://www.lefontiperlastoria.it/fonti"
                    })
                });
map.addLayer(aree);
aree.setVisibility(false);
  
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
 
 //if($(panControl).is('.attivo')){pan.activate();}else{pan.deactivate();}
 //if($(zoomControl).is('.attivo')){zoomin.activate();}else{zoomin.deactivate();}
 
 if (!map.getCenter()) {map.zoomToExtent(extent);}
} //end init mappa


   


/***********  FUNZIONI PER LA CREAZIONE DEI LIVELLI NELLA MAPPA **************************/
function toggleComuni(){
	if (comuni.getVisibility() == true) {comuni.setVisibility(false);}else{comuni.setVisibility(true);}
}

function toggleAreeArcheo(){
  if (aree_archeo.getVisibility() == true) {aree_archeo.setVisibility(false);}else{aree_archeo.setVisibility(true);}
}

function toggleAree(){
  if (aree.getVisibility() == true) {aree.setVisibility(false);}else{aree.setVisibility(true);}
}

function toggleUbicazioni(){
  if (ubicazione.getVisibility() == true) {ubicazione.setVisibility(false);}else{ubicazione.setVisibility(true);}
}

/******************************************************************************/
/*****************  FUNZIONI JQUERY  ******************************************/
/******************************************************************************/
$("#logo").click(function(){window.location.href="home.php";});

$("#formRicerca, #sliderAreaArcheoDiv, #sliderAreaArchivDiv, #sliderAreaArchitetDiv, #sliderAreaBiblioDiv, #sliderAreaCultDiv, #sliderAreaFotoDiv, #sliderAreaOraleDiv, #sliderAreaStoArtDiv, .legendeAreeArcheo, .legendeAreeArchitet, .legendeAreeArchiv, .legendeAreeBiblio, .legendeAreeCult, .legendeAreeFoto, .legendeAreeOrale, .legendeAreeStoArt, #cartografiaSwitch, #areaSwitch, #ubiSwitch").hide();


/***************** ACCORDION SWITCHER *********************************************/
$("#ricercaToggle").click(function(){ 
  $("#formRicerca").slideToggle().toggleClass('aperto'); 
  if($("#cartografiaSwitch").hasClass('aperto')){$("#cartografiaSwitch").slideToggle().removeClass('aperto');}
  if($("#areaSwitch").hasClass('aperto')){$("#areaSwitch").slideToggle().removeClass('aperto');}
  if($("#ubiSwitch").hasClass('aperto')){$("#ubiSwitch").slideToggle().removeClass('aperto');}
});
   
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

/*********************************************************************************/      
var $tooltip = $('<span class="sliderTip" id="sliderTip"></span>');

$(".olControlZoomIn, .olControlZoomOut, #drag, #zoomArea, #zoomMax, #history").hover(
 function(){$("#pannello").css('background-color','rgba(255,255,255,0.5)').fadeIn('slow')},
 function(){$("#pannello").css('background-color','rgba(255,255,255,0)').fadeOut('slow')}
);

/******************** GESTIONE ACCENSIONE LIVELLI ******************/
$("#comuni").on("change", toggleComuni);

$("#aree_archeo")
   .on("change", toggleAreeArcheo)
   .click(function(){
   	 if($(this).attr('checked')){$("#sliderAreaArcheoDiv, .legendeAreeArcheo").fadeIn('fast');}
   	 else{$("#sliderAreaArcheoDiv, .legendeAreeArcheo").fadeOut('fast');}
   });

$("#aree_architet")
   //.on("change", toggleAreeArcheo)
   .click(function(){
   	 if($(this).attr('checked')){$("#sliderAreaArchitetDiv, .legendeAreeArchitet").fadeIn('fast');}
   	 else{$("#sliderAreaArchitetDiv, .legendeAreeArchitet").fadeOut('fast');}
   });

$("#aree_archiv")
   //.on("change", toggleAreeArcheo)
   .click(function(){
   	 if($(this).attr('checked')){$("#sliderAreaArchivDiv, .legendeAreeArchiv").fadeIn('fast');}
   	 else{$("#sliderAreaArchivDiv, .legendeAreeArchiv").fadeOut('fast');}
   });

$("#aree_biblio")
   //.on("change", toggleAreeArcheo)
   .click(function(){
   	 if($(this).attr('checked')){$("#sliderAreaBiblioDiv, .legendeAreeBiblio").fadeIn('fast');}
   	 else{$("#sliderAreaBiblioDiv, .legendeAreeBiblio").fadeOut('fast');}
   });

$("#aree_cult")
   //.on("change", toggleAreeArcheo)
   .click(function(){
   	 if($(this).attr('checked')){$("#sliderAreaCultDiv, .legendeAreeCult").fadeIn('fast');}
   	 else{$("#sliderAreaCultDiv, .legendeAreeCult").fadeOut('fast');}
   });

$("#aree_foto")
   //.on("change", toggleAreeArcheo)
   .click(function(){
   	 if($(this).attr('checked')){$("#sliderAreaFotoDiv, .legendeAreeFoto").fadeIn('fast');}
   	 else{$("#sliderAreaFotoDiv, .legendeAreeFoto").fadeOut('fast');}
   });

$("#aree_orale")
   //.on("change", toggleAreeArcheo)
   .click(function(){
   	 if($(this).attr('checked')){$("#sliderAreaOraleDiv, .legendeAreeOrale").fadeIn('fast');}
   	 else{$("#sliderAreaOraleDiv, .legendeAreeOrale").fadeOut('fast');}
   });

$("#aree_stoart")
   //.on("change", toggleAreeArcheo)
   .click(function(){
   	 if($(this).attr('checked')){$("#sliderAreaStoArtDiv, .legendeAreeStoArt").fadeIn('fast');}
   	 else{$("#sliderAreaStoArtDiv, .legendeAreeStoArt").fadeOut('fast');}
   });
 
$("#aree")
   .on("change", toggleAree);

$("#ubicazione")
   .on("change", toggleUbicazioni);



/*****************   COMANDI PER INTERAGIRE CON LA MAPPA ***********************/
$("#zoomMax").click(function(){map.zoomToExtent(extent);});

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
      
$("#sliderArea").slider({
        range: "min",
        min: 0,
        max: 100,
        value: 100,
        slide: function(e, ui) {
          aree.setOpacity(ui.value / 100);
          $( "#amountAree" ).text(ui.value + "%");
        }
});
$("#amountAree").text($("#sliderArea").slider("value") + "%");
      
$("#sliderAreaArcheo").slider({
        range: "min",
        min: 0,
        max: 100,
        value: 100,
        slide: function(e, ui) {
          aree_archeo.setOpacity(ui.value / 100);
          $( "#amountAreaArcheo" ).text(ui.value + "%");
          $('.legendeAreeArcheo').css('background-color', 'rgba(255,102,0,'+ui.value/100+')');
        }
});
$("#amountAreaArcheo").text($("#sliderAreaArcheo").slider("value") + "%");

$("#sliderAreaArchitet").slider({
        range: "min",
        min: 0,
        max: 100,
        value: 100,
        slide: function(e, ui) {
          aree_archeo.setOpacity(ui.value / 100);
          $( "#amountAreaArchitet" ).text(ui.value + "%");
          $('.legendeAreeArchitet').css('background-color', 'rgba(255,0,0,'+ui.value/100+')');
        }
});
$("#amountAreaArchitet").text($("#sliderAreaArchitet").slider("value") + "%");

$("#sliderAreaArchiv").slider({
        range: "min",
        min: 0,
        max: 100,
        value: 100,
        slide: function(e, ui) {
          //aree_archeo.setOpacity(ui.value / 100);
          $( "#amountAreaArchiv" ).text(ui.value + "%");
          $('.legendeAreeArchiv').css('background-color', 'rgba(255,0,255,'+ui.value/100+')');
        }
});
$("#amountAreaArchiv").text($("#sliderAreaArchiv").slider("value") + "%");

$("#sliderAreaBiblio").slider({
        range: "min",
        min: 0,
        max: 100,
        value: 100,
        slide: function(e, ui) {
          aree_archeo.setOpacity(ui.value / 100);
          $( "#amountAreaBiblio" ).text(ui.value + "%");
          $('.legendeAreeBiblio').css('background-color', 'rgba(255,255,0,'+ui.value/100+')');
        }
});
$("#amountAreaBiblio").text($("#sliderAreaBiblio").slider("value") + "%");

$("#sliderAreaCult").slider({
        range: "min",
        min: 0,
        max: 100,
        value: 100,
        slide: function(e, ui) {
          aree_archeo.setOpacity(ui.value / 100);
          $( "#amountAreaCult" ).text(ui.value + "%");
          $('.legendeAreeCult').css('background-color', 'rgba(0,128,0,'+ui.value/100+')');
        }
});
$("#amountAreaCult").text($("#sliderAreaCult").slider("value") + "%");

$("#sliderAreaFoto").slider({
        range: "min",
        min: 0,
        max: 100,
        value: 100,
        slide: function(e, ui) {
          aree_archeo.setOpacity(ui.value / 100);
          $( "#amountAreaFoto" ).text(ui.value + "%");
          $('.legendeAreeFoto').css('background-color', 'rgba(0,255,0,'+ui.value/100+')');
        }
});
$("#amountAreaFoto").text($("#sliderAreaFoto").slider("value") + "%");

$("#sliderAreaOrale").slider({
        range: "min",
        min: 0,
        max: 100,
        value: 100,
        slide: function(e, ui) {
          aree_archeo.setOpacity(ui.value / 100);
          $( "#amountAreaOrale" ).text(ui.value + "%");
          $('.legendeAreeOrale').css('background-color', 'rgba(0,255,255,'+ui.value/100+')');
        }
});
$("#amountAreaOrale").text($("#sliderAreaOrale").slider("value") + "%");

$("#sliderAreaStoArt").slider({
        range: "min",
        min: 0,
        max: 100,
        value: 100,
        slide: function(e, ui) {
          aree_archeo.setOpacity(ui.value / 100);
          $( "#amountAreaStoArt" ).text(ui.value + "%");
          $('.legendeAreeStoArt').css('background-color', 'rgba(0,0,128,'+ui.value/100+')');
        }
});
$("#amountAreaStoArt").text($("#sliderAreaStoArt").slider("value") + "%");