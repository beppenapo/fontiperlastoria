var center,zoom,map,resetMap,base,osm,thunderF,cluster,fonti;
initMap()
function initMap(){
  zoom = 12;
  $("#loader").show();
  cluster = L.markerClusterGroup({
    maxClusterRadius:50,
    iconCreateFunction: function(cluster) {
      var mark = cluster.getAllChildMarkers()
      var sum = 0
      var digit = 0
      mark.forEach(function(v,i){
        sum += v.feature.properties.foto
        digit = (sum+'').length
      })
      return new L.DivIcon({
        html: sum,
        className: 'cluster digit-'+digit,
        iconSize: null
      })
    }
  });
  map = L.map('map',{ minZoom: zoom})
  map.on('load', function (event) {
    $("#loader").hide()
    $(".leaflet-tooltip").css("display","none")
  });

  $.ajax({
    url: 'json/centroMappa.php',
    type: 'POST',
    dataType: 'json'
  })
  .done(function(data) {
    center = [data[0].lon,data[0].lat];
    map.setView(center,zoom);
  });

  // base = L.tileLayer('./mappa/{z}/{x}/{y}.png', {tms: true}).addTo(map)
  thunderF = L.tileLayer('https://tile.thunderforest.com/neighbourhood/{z}/{x}/{y}.png?apikey=f1151206891e4ca7b1f6eda1e0852b2e',{
    opacity:0.7
  }).addTo(map)
  osm = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
    opacity:0.7
  })
  var ico = L.icon({
    iconUrl: 'img/mapIco/marker_pieno.png',
    shadowUrl: 'img/mapIco/marker_ombra.png',
    iconSize:     [25, 50],
    shadowSize:   [50, 25],
    iconAnchor:   [10, 50],
    shadowAnchor: [0, 22]
  });
  $.getJSON('json/comuni.php', function(data) {
    console.log(data.features);
    comuni = L.geoJson(data,{
      style: {
        fillOpacity: 0.1,
        fillColor: '#ac8b5a',
        color:'#ac8b5a',
        weight:1
      },
      onEachFeature: function (feature, layer) {
        // layer.bindTooltip(feature.properties.comune, {permanent: true, opacity: 0.7});
      }
    });
    map.addLayer(comuni);
  });

  $.getJSON("json/markerList.php", function(data) {
    console.log(data);
    if (!data.features) {
      console.log('no data');
    }else {
      fonti = L.geoJson(data,{
        pointToLayer: function (feature, latlng) {
          label = String(feature.properties.area)
          return L.marker(latlng, {icon: ico}).bindTooltip(label, {
            permanent: true,
            opacity: 0.7,
            direction: 'bottom',
            offset: L.point({x:0, y:0})
          }).openTooltip();
        }
      });
      cluster.addLayer(fonti);
      map.addLayer(cluster);
      map.fitBounds(cluster.getBounds());
      fonti.on('click',bindPopUp)
      const tooltipThreshold = 17;
      map.on('zoomend', function() {
        var z = map.getZoom();
        if (z < tooltipThreshold ) {
          $(".leaflet-tooltip").css("display","none")
        } else {
          $(".leaflet-tooltip").css("display","block")
        }
      })
    }
  });

  resetMap = L.Control.extend({
    options: { position: 'topleft'},
    onAdd: function (map) {
      var container = L.DomUtil.create('div', 'extentControl leaflet-bar leaflet-control leaflet-touch');
      btn=$("<a/>",{href:'#'}).appendTo(container);
      $("<i/>",{class:'fas fa-home'}).appendTo(btn)
      btn.on('click', function (e) {
        e.preventDefault()
        map.fitBounds(cluster.getBounds());
      });
      return container;
    }
  })

  map.addControl(new resetMap());
  L.control.scale({imperial:false}).addTo(map);
  L.control.mousePosition({emptystring:'',prefix:'WGS84'}).addTo(map);
  $("[name=baseLayer]").on('change',function(){
    show = $(this).val()
    if (show == 'osm') {
      map.addLayer(osm)
      map.removeLayer(thunderF)
    }else {
      map.removeLayer(osm)
      map.addLayer(thunderF)

    }
  })
}
function bindPopUp(e) {
  prop = e.sourceTarget.feature.properties;
  $("#nome-area").text(prop.area)

  $.getJSON("json/imgMapList.php",{area:prop.id_area})
  .done(function(data){ buildImgList(data) })
  .fail(function( jqxhr, textStatus, error ) { console.log( "Request Failed: " + textStatus + ", " + error ); })

  $("#panel").show().promise().done(function(){
    header = $(".panel-content>header").outerHeight();
    footer = $(".panel-content>footer").outerHeight();
    height = parseInt(header+footer+10)
    $(".panel-content>section").css("height","calc(100% - "+height+"px)")
    $(".panel-content").animate({marginRight:0},500);
  })
}

function buildImgList(data){
  var imgArr = []
  var imgItem;
  $.each(data,function(i,img){
    imgItem = "<div id='imgMap"+i+"' data-id='"+img.id+"' class='col-12 col-md-6 p-0 imgMapDiv'>"
    imgItem += "<div class='imgContent animation lozad' data-background-image='foto_medium/"+img.path+"'></div>"
    imgItem += "<div class='animation imgTxt d-none d-md-block'>"
    imgItem += "<p class='animation'>"+img.dgn_dnogg+"</p>"
    imgItem += "</div>"
    imgItem += "</div>"
    imgArr.push(imgItem)
  })
  $(".imgGallery").html(imgArr.join(''))
  $(".imgMapDiv").height($("#imgMap0").width()).on('click',function(){ linkScheda($(this).data('id')) });
  observer.observe();
}

function initSwitcher(){

}
