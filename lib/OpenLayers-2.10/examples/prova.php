<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Modify Feature</title>
    <link rel="stylesheet" href="../theme/default/style.css" type="text/css" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <style type="text/css">
        #controls {
            width: 512px;
        }
        #controlToggle {
            padding-left: 1em;
        }
        #controlToggle li {
            list-style: none;
        }
    </style>
    <script src="../lib/Firebug/firebug.js"></script>
    <script src="../lib/OpenLayers.js"></script>
    <script src="http://www.openstreetmap.org/openlayers/OpenStreetMap.js"></script>
	 <script src="http://maps.google.com/maps/api/js?v=3.2&amp;sensor=false"></script>

    <script type="text/javascript">
            var lon = 5;
            var lat = 40;
            var zoom = 5;
            var map, layer;

            function init(){
            	vlayer = new OpenLayers.Layer.Vector( "Editable" );
                map = new OpenLayers.Map( 'map', {
                    controls: [
                        new OpenLayers.Control.PanZoom(),
                        new OpenLayers.Control.EditingToolbar(vlayer),
                        new OpenLayers.Control.LayerSwitcher(),
                        new OpenLayers.Control.MousePosition()
                    ]
                });
                 var gsat = new OpenLayers.Layer.Google("Google Satellite", {type: google.maps.MapTypeId.SATELLITE, numZoomLevels: 22});
map.addLayer(gsat);

var gphy = new OpenLayers.Layer.Google("Google Physical",{type: google.maps.MapTypeId.TERRAIN});
map.addLayer(gphy);

var gmap = new OpenLayers.Layer.Google("Google Streets",{numZoomLevels: 20});
map.addLayer(gmap);
					
                map.addLayers([vlayer]);

                map.setCenter(new OpenLayers.LonLat(lon, lat), zoom);
            }
        </script>

  </head>
  <body onload="init()">
    <div id="panel"></div>
    <div id="map"></div>
 </body>
</html>
