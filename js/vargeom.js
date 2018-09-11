// var map,scalebar,hub,extent;
bingKey = 'Arsp1cEoX9gu-KKFYZWbJgdPEa8JkRIUkxcPr8HBVSReztJ6b0MOz3FEgmNRd4nM';
proxy="/cgi-bin/proxy.cgi?url=";
format = 'image/png';
resolution=[156543.03390625, 78271.516953125, 39135.7584765625, 19567.87923828125, 9783.939619140625, 4891.9698095703125, 2445.9849047851562, 1222.9924523925781, 611.4962261962891, 305.74811309814453, 152.87405654907226, 76.43702827453613, 38.218514137268066, 19.109257068634033, 9.554628534317017, 4.777314267158508, 2.388657133579254, 1.194328566789627, 0.5971642833948135, 0.29858214169740677, 0.14929107084870338, 0.07464553542435169, 0.037322767712175846, 0.018661383856087923, 0.009330691928043961, 0.004665345964021981, 0.0023326729820109904, 0.0011663364910054952, 5.831682455027476E-4, 2.915841227513738E-4, 1.457920613756869E-4];
proj900913 = new OpenLayers.Projection("EPSG:900913");
proj4326 = new OpenLayers.Projection("EPSG:4326");
proj32632 = new OpenLayers.Projection("EPSG:32632");
proj3857 = new OpenLayers.Projection("EPSG:3857");
srs3857='EPSG:3857';
gsat = new OpenLayers.Layer.Bing({name: "Aerial",key: bingKey,type: "Aerial"});
osm = new OpenLayers.Layer.OSM("CycleMap");
wmsHost="http://www.lefontiperlastoria.it:8080/geoserver/wms";
wfsHost="http://www.lefontiperlastoria.it:8080/geoserver/wfs";
version="1.0.0";
namespace="http://78.46.230.205/fps";
schema="http://78.46.230.205:8080/geoserver/fps/wfs?service=WFS&version=1.0.0&request=DescribeFeatureType&typeName=fps:area_int_poly"
//schema="http://www.lefontiperlastoria.it/fonti?service=WFS&version=1.0.0&request=DescribeFeatureType&TypeName=area_int_poly"
tileSize=new OpenLayers.Size(256,256);
namespace='http://78.46.230.205/fps';
