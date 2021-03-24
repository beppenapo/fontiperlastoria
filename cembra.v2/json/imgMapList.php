<?php
require("../class/db.class.php");
$obj = new Db;
$imgList = $obj->simple("
SELECT
  scheda.id,
  scheda.dgn_dnogg,
  scheda.dgn_numsch,
  file.path
FROM
  aree_scheda,
  file,
  scheda
WHERE
  aree_scheda.id_scheda = scheda.id AND
  file.id_scheda = scheda.id and
  aree_scheda.id_area = ".$_GET['area']."
group by scheda.id, scheda.dgn_dnogg,scheda.dgn_numsch, file.path;
");
echo json_encode($imgList);
?>
