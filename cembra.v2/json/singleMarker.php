<?php
require("../class/db.class.php");
$obj = new Db;
$sql = "
SELECT
  area.id as area,
  st_X(st_transform(punti.geom,4326)) as x,
  st_Y(st_transform(punti.geom,4326)) as y
FROM
  area,
  aree_scheda,
  punti,
  scheda
WHERE
  aree_scheda.id_area = area.id AND
  aree_scheda.id_scheda = scheda.id AND
  punti.id = area.id and
  scheda.id = ".$_POST['id'].";";
$punto = $obj->simple($sql);
echo json_encode($punto);
?>
