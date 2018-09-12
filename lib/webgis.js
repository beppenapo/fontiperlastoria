/******************************************************************************/
/*****************  FUNZIONI OPENLAYERS  ******************************************/
/******************************************************************************/
function init() {
    layer={
        "aree":[
            {"wms":"comuni","label":"comuni","tipo":null},
            {"wms":"toponomastica","label":"toponomastica","tipo":null},
            {"wms":"aree_archeo_poly","label":"archeologica","tipo":6},
            {"wms":"aree_architett_poly","label":"architettonica","tipo":8},
            {"wms":"aree_archiv_poly","label":"archivistica","tipo":4},
            {"wms":"aree_biblio_poly","label":"bibliografica","tipo":5},
            {"wms":"aree_mater_poly","label":"cultura materiale","tipo":2},
            {"wms":"aree_mater_line","label":null,"tipo":2},
            {"wms":"aree_foto_poly","label":"fotografica","tipo":7},
            {"wms":"aree_orale_poly","label":"orale","tipo":1},
            {"wms":"aree_stoart_poly","label":"storico-artistica","tipo":9}
        ],
        "ubi":[
            {"wms":"ubi_archeo","label":"archeologica"},
            {"wms":"ubi_archit","label":"architettonica"},
            {"wms":"ubi_archiv","label":"archivistica"},
            {"wms":"ubi_biblio","label":"bibliografica"},
            {"wms":"ubi_mater","label":"cultura materiale"},
            {"wms":"ubi_foto","label":"fotografica"},
            {"wms":"ubi_oral","label":"orale"},
            {"wms":"ubi_stoart","label":"storico-artistica"}
        ]
    }

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
    map.addLayers([gsat,osm]);
    s = new OpenLayers.StyleMap({
        "default": new OpenLayers.Style({fillOpacity:0,strokeOpacity:0}),
        "select": new OpenLayers.Style({strokeColor: "#1D22CF",strokeWidth:3,fillColor: "#1D22CF", fillOpacity:0.6, graphicZIndex: 2}),
        "active": new OpenLayers.Style({fillColor: "#7578F5", fillOpacity:0.6, graphicZIndex: 2})
    });
    hiLy = ["area_int_poly", "area_int_line"]
    highlightLayer = new OpenLayers.Layer.Vector("Highlighted", {
        strategies: [new OpenLayers.Strategy.BBOX()],
        styleMap: s,
        protocol: new OpenLayers.Protocol.WFS({
            version:version,
            url:wfsHost,
            featureType:hiLy,
            featureNS:namespace,
            srsName:srs3857,
            geometryName:"the_geom"
        })
    });
    actLayer = new OpenLayers.Layer.Vector("Active", {
        strategies: [new OpenLayers.Strategy.BBOX()],
        styleMap: s,
        protocol: new OpenLayers.Protocol.WFS({
            version:version,
            url:wfsHost,
            featureType:"area_int_poly",
            featureNS:namespace,
            srsName:srs3857,
            geometryName:"the_geom",
            schema:schema+"fps:area_int_poly"
        })
    });
    listalayer=[];
    listaUbi=[];
    for (item in layer.aree) {
        l = new OpenLayers.Layer.WMS(layer.aree[item].wms,wmsHost,
            {srs:srs3857,layers:'fps:'+layer.aree[item].wms,format:format,transparent:true}
            ,{isBaseLayer: false,singleTile: true, ratio: 1, tileSize:tileSize}
        );
        map.addLayer(l);
        if (layer.aree[item].label!==null) {
            li=$("<div/>",{class:"livelli"});
            label=$("<label/>",{for:layer.aree[item].wms,class:'info',text:layer.aree[item].label.toUpperCase()}).appendTo(li);
            input=$("<input/>",{type:'checkbox',name:'overlays',class:'checkLiv',id:layer.aree[item].wms})
                .attr("data-tipo",layer.aree[item].tipo)
                .val(layer.aree[item].wms)
                .prependTo(label);
        }
        if (layer.aree[item].wms.indexOf('aree_')>-1) {
            l.setVisibility(false);
            listalayer.push(l);
            input.addClass('ai');
            li.appendTo("#areaSwitch");
        }else {
            li.appendTo("#cartografiaSwitch");
            input.prop("checked",true);
        }
    }
    for (item in layer.ubi){
        l = new OpenLayers.Layer.Vector(layer.ubi[item].wms, {
            strategies: [new OpenLayers.Strategy.BBOX()],
            protocol: new OpenLayers.Protocol.WFS({
                version:version,
                url:wfsHost,
                featureType: layer.ubi[item].wms,
                featureNS:namespace,
                srsName:srs3857,
                geometryName:"the_geom",
                schema:schema+"fps:"+layer.ubi[item].wms
            })
        });
        map.addLayer(l);
        l.setVisibility(false);
        listaUbi.push(l);
        l.events.on({
            featureselected: function(event) {
                feature = event.feature;
                $.ajax({
                    url: './inc/popupUbi.php',
                    type: 'POST',
                    data: {id_ubi:feature.attributes.id, tipo:feature.attributes.dgn_tpsch},
                    success: function(data){
                        popup = new OpenLayers.Popup.Anchored(
                            "popUbi",feature.geometry.getBounds().getCenterLonLat(),null,data,null,true,null
                        );
                        feature.popup = popup;
                        popup.autoSize = true;
                        map.addPopup(popup);
                        $(".olPopupCloseBox").html('&#10006;');
                    }
                });
            },
            featureunselected: function(event) {
                feature = event.feature;
                if (feature.popup){
                    map.removePopup(feature.popup);
                    feature.popup.destroy();
                    feature.popup = null;
                }
            }
        });

        li=$("<div/>",{class:"livelli"}).appendTo("#ubiSwitch");
        label=$("<label/>",{for:layer.ubi[item].wms,class:'info',text:layer.ubi[item].label.toUpperCase()}).appendTo(li);
        $("<input/>",{type:'checkbox',name:'overlaysUbi',class:'checkLiv',id:layer.ubi[item].wms}).val(layer.ubi[item].wms).prependTo(label);
    }
    map.addLayers([highlightLayer,actLayer]);
    info = new OpenLayers.Control.WMSGetFeatureInfo({
        url: wmsHost,
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
                });
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

    $("#areaToggle").click(function(){toggleAree();});
    $("#ubiToggle").click(function(){toggleUbi();});
    $("input.checkLiv").on('click',function(){ toggleVis($(this).val()); });

}
function toggleAree(){
    $("#areaToggle").toggleClass('acceso');
    if($("#areaToggle").hasClass('acceso')){
        $('#areaSwitch input').prop('checked', true);
        $('div.legendeAree').fadeIn('fast');
        for (var i = 0; i < listalayer.length; i++) { listalayer[i].setVisibility(true);}
    }else{
        $('#areaSwitch input').prop('checked', false);
        $('div.legendeAree').fadeOut('fast');
        for (var i = 0; i < listalayer.length; i++) { listalayer[i].setVisibility(false);}
    }
}
function toggleUbi(){
    $("#ubiToggle").toggleClass('acceso');
    if($("#ubiToggle").hasClass('acceso')){
        $('#ubiSwitch input').prop('checked', true);
        for (var i = 0; i < listaUbi.length; i++) { listaUbi[i].setVisibility(true);}
    }else{
        $('#ubiSwitch input').prop('checked', false);
        for (var i = 0; i < listaUbi.length; i++) { listaUbi[i].setVisibility(false);}
    }
}
function toggleVis(l){
    i=map.getLayersByName(l);
    i[0].getVisibility()==true?i[0].setVisibility(false):i[0].setVisibility(true);
}
function zoomLayer(ll){
    comuni=map.getLayersByName('comuni');
    toponomastica=map.getLayersByName('toponomastica');
    if (comuni[0].getVisibility() == true) {
        comuni[0].setVisibility(false);
        $("input#comuni").prop('checked', false);
    }
    if (toponomastica[0].getVisibility() == false) {
        toponomastica[0].setVisibility(true);
        $("input#toponomastica").attr('checked', true);
    }
    xy = new OpenLayers.LonLat(ll[0],ll[1]);
    testZoom = map.getZoomForExtent(extent);
    console.log(xy);
    map.setCenter(xy,17);
}
/******************************************************************************/
/*****************  FUNZIONI JQUERY  ******************************************/
/**********************it********************************************************/
$("#logo").click(function(){window.open("home.php", "_blank");});
$("#database").click(function(){window.open("ricerche.php", "_blank");});
$("#formRicerca, .legendeAreeArcheo, .legendeAreeArchitet, .legendeAreeArchiv, .legendeAreeBiblio, .legendeAreeCult, .legendeAreeFoto, .legendeAreeOrale, .legendeAreeStoArt, .legendeUbiArcheo, .legendeUbiArchitet, .legendeUbiArchiv, .legendeUbiBiblio, .legendeUbiCult, .legendeUbiFoto, .legendeUbiOrale, .legendeUbiStoArt").hide();
var $tooltip = $('<span class="sliderTip" id="sliderTip"></span>');

/******************** GESTIONE ACCENSIONE LIVELLI ******************/
// $("#comuni").on("change", toggleComuni);
// $("#toponomastica").on("change", toggleToponomastica);
//
// $("#aree_archeo")
//    .on("change", toggleAreeArcheo)
//    .click(function(){
//    	 if($(this).attr('checked')){$(".legendeAreeArcheo").fadeIn('fast');}
//    	 else{$(".legendeAreeArcheo").fadeOut('fast');}
//    });
//
// $("#aree_architet")
//    .on("change", toggleAreeArchitett)
//    .click(function(){
//    	 if($(this).attr('checked')){$(".legendeAreeArchitet").fadeIn('fast');}
//    	 else{$(".legendeAreeArchitet").fadeOut('fast');}
//    });
//
// $("#aree_archiv")
//    .on("change", toggleAreeArchivi)
//    .click(function(){
//    	 if($(this).attr('checked')){$(".legendeAreeArchiv").fadeIn('fast');}
//    	 else{$(".legendeAreeArchiv").fadeOut('fast');}
//    });
//
// $("#aree_biblio")
//    .on("change", toggleAreeBiblio)
//    .click(function(){
//    	 if($(this).attr('checked')){$(".legendeAreeBiblio").fadeIn('fast');}
//    	 else{$(".legendeAreeBiblio").fadeOut('fast');}
//    });
//
// $("#aree_cult")
//    .on("change", toggleAreeCultMat)
//    .click(function(){
//    	 if($(this).attr('checked')){$(".legendeAreeCult").fadeIn('fast');}
//    	 else{$(".legendeAreeCult").fadeOut('fast');}
//    });
//
// $("#aree_foto")
//    .on("change", toggleAreeFoto)
//    .click(function(){
//    	 if($(this).attr('checked')){$(".legendeAreeFoto").fadeIn('fast');}
//    	 else{$(".legendeAreeFoto").fadeOut('fast');}
//    });
//
// $("#aree_orale")
//    .on("change", toggleAreeOrale)
//    .click(function(){
//    	 if($(this).attr('checked')){$(".legendeAreeOrale").fadeIn('fast');}
//    	 else{$(".legendeAreeOrale").fadeOut('fast');}
//    });
//
// $("#aree_stoart")
//    .on("change", toggleAreeStoArt)
//    .click(function(){
//    	 if($(this).attr('checked')){$(".legendeAreeStoArt").fadeIn('fast');}
//    	 else{$(".legendeAreeStoArt").fadeOut('fast');}
//    });
//
// $("#ubi_archeo").on("change", toggleUbiArcheo);
// $("#ubi_architet").on("change", toggleUbiArchit);
// $("#ubi_archiv").on("change", toggleUbiArchiv);
// $("#ubi_biblio").on("change", toggleUbiBiblio);
// $("#ubi_cult").on("change", toggleUbiMater);
// $("#ubi_foto").on("change", toggleUbiFoto);
// $("#ubi_orale").on("change", toggleUbiOral);
// $("#ubi_stoart").on("change", toggleUbiStoart);

/*****************   COMANDI PER INTERAGIRE CON LA MAPPA ***********************/
$("#zoomMax").click(function(){map.zoomToExtent(extent);});
$("#topoSearch select").change(function(){
    ll = $(this).val().split(',');
    zoomLayer(ll);
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
