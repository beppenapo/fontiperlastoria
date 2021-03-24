<?php
require("../class/db.class.php");
$obj = new Db;
$query = "select st_X(st_centroid(st_union(st_transform(ST_SetSRID(geom,3857), 4326)))) as lat, st_Y(st_centroid(st_union(st_transform(ST_SetSRID(geom,3857), 4326)))) as lon from comuni;";
echo json_encode($obj->simple($query));
?>
