<?php
include('db.php');
$array = $_POST['arr'];
$arrayActive = $_POST['arrActive'];
$arrayArea = $_POST['arrArea'];
$i = count($array);
$y = count($arrayActive);
$w = count($arrayArea);

if($i==0) {$h1='Non è stata selezionata alcuna area';}

$id = '';
$tipo = '';
$idarea = '';

for($x=0; $x<$i; $x++ ) { $id .= 'area_int_poly.id = '.$array[$x].' OR '; }
$items = substr($id, 0, -4);
$items2 = str_replace("area_int_poly.id","area_int_line.id",$items);

for($z=0; $z<$y; $z++ ) { $tipo .= 'dgn_tpsch = '.$arrayActive[$z].' OR '; }
$tpsch = substr($tipo, 0, -4);

for($h=0; $h<$w; $h++ ) { $idarea .= 'id_area = '.$arrayArea[$h].' OR '; }
$area = substr($idarea, 0, -4);

$query=("
SELECT
  area_int_poly.id,
  area.nome,
  aree.nome_area as id_area,
  st_area(area_int_poly.the_geom) as misura,
  st_xmin(area_int_poly.the_geom) as xmin,
  st_xmax(area_int_poly.the_geom) as xmax,
  st_ymin(area_int_poly.the_geom) as ymin,
  st_ymax(area_int_poly.the_geom) as ymax
FROM area_int_poly, aree, area
WHERE
  area_int_poly.id_area = aree.nome_area AND
  aree.nome_area = area.id AND
  aree.tipo = 1 and
  ($items) AND
  ($area)

UNION

SELECT
  area_int_line.id,
  area.nome,
  aree.nome_area as id_area,
  st_length(area_int_line.the_geom) as misura,
  st_xmin(area_int_line.the_geom) as xmin,
  st_xmax(area_int_line.the_geom) as xmax,
  st_ymin(area_int_line.the_geom) as ymin,
  st_ymax(area_int_line.the_geom) as ymax
FROM area_int_line, aree, area
WHERE
  area_int_line.id_area = aree.nome_area AND
  aree.nome_area = area.id AND
  aree.tipo = 1 and
  ($items2) AND
  ($area)
order by misura asc;
");
$result = @pg_query($connection, $query);
$righe = @pg_num_rows($result);
if(!$result){echo "<div id='resContentHeader'><h1>$h1</h1></div>";}
else {
   echo "<div id='resContentHeader'><h1>$h1</h1></div>";
   echo "<div id='resContentData' data-hub='$hub'><ul class='ulpopup'>";
   if($righe != 0) {
     while($a = pg_fetch_array($result)){
       $extent = $a['xmin'].','.$a['ymin'].','.$a['xmax'].','.$a['ymax'];
       echo "<li id='".$a['idArea']."' ext='".$extent."' class='openSchede' onclick='openSchede(".$a['idArea'].")'>".$a['area']."</li>";
     }
    /*for ($x = 0; $x < $righe; $x++){
       $idGeom = pg_result($result, $x,"id");
       $idArea = pg_result($result, $x,"id_area");
       $comune = pg_result($result, $x,"comune");
       $comune = stripslashes($comune);
       $area = pg_result($result, $x,"nome");
       $area = stripslashes($area);
       $xmin = pg_result($result, $x, "xmin");
       $ymin = pg_result($result, $x, "ymin");
       $xmax = pg_result($result, $x, "xmax");
       $ymax = pg_result($result, $x, "ymax");
       $extent = $xmin.','.$ymin.','.$xmax.','.$ymax;
       echo "<li id='$idArea' ext='$extent' class='openSchede' onclick='openSchede($idArea)'>$area</li>";
    }*/
   }else {echo "<li><h1>L'area selezionata presenta schede in lavorazione</h1></li>";}
   echo "</ul></div>";
}
?>
<div id="resContentSchede"></div>

<script type="text/javascript">
var tpsch = "<?php echo($tpsch); ?>";
function openSchede(idArea){
   //console.log('area: '+idArea+'\ntipo: '+tpsch+'\nhub: '+hub);
   $.ajax({
    url: '../inc/popupAiSchede.php',
    type: 'POST',
    data: {idArea:idArea, tpsch:tpsch, hub:hub},
    success: function(data){$("#resContentSchede").html(data);}
   });//ajax*/
}

$('.openSchede').on({
   click: function(){
       $(this).addClass('active').siblings().removeClass('active');
       var ext = $(this).attr('ext');
       if (ext == 0) return;
       var parse = ext.split(',');
       var newExt= new OpenLayers.Bounds(parse[0],parse[1],parse[2],parse[3]);
       map.zoomToExtent(newExt);
       //var id_area=$(this).attr('id');
       //var featHiLite = actLayer.getFeaturesByAttribute('id_area', id_area);
       //actLayer.drawFeature(featHiLite[0], "active");
   },
   mouseenter: function() {
       var id_area=$(this).attr('id');
       //console.log(id_area);return false;
       var featHiLite = highlightLayer.getFeaturesByAttribute('id_area', id_area);
       highlightLayer.drawFeature(featHiLite[0], "select");
   },
   mouseleave: function() {
       var id_area=$(this).attr('id');
       var featHiLite = highlightLayer.getFeaturesByAttribute('id_area', id_area);
       highlightLayer.drawFeature(featHiLite[0], "default");

   }
});
</script>
