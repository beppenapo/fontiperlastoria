<?php
require("../class/db.class.php");
$obj = new Db;
$filter = isset($_GET['area']) ? " area.id != ".$_GET['area']." AND " : "";
$geom = $obj->simple("
SELECT row_to_json(punti.*) AS geometrie
FROM (
  SELECT 'FeatureCollection'::text AS type, array_to_json(array_agg(features.*)) AS features
  FROM (
    SELECT 'Feature'::text AS type, st_asgeojson(st_transform(ST_SetSRID(punti.geom, 3857), 4326))::json AS geometry, row_to_json(prop.*) AS properties
    FROM punti
    JOIN (
      SELECT
        area.id AS id_area,
        area.nome as area,
        punti.pk,
        count(file.*) as foto,
        punti.geom
        FROM
          punti,
          area,
          aree_scheda,
          scheda,
          lista_dgn_tpsch,
          ricerca,
          file
        WHERE
          ".$filter."
          punti.id = area.id AND
          aree_scheda.id_area = area.id AND
          aree_scheda.id_scheda = scheda.id AND
          scheda.cmp_id = ricerca.id AND
          file.id_scheda = scheda.id and
          area.tipo <> 2 AND
          scheda.dgn_tpsch = lista_dgn_tpsch.id and
          ricerca.hub=2
        GROUP BY area.id,area.nome,punti.pk, punti.geom
        ORDER BY area.id ASC
    ) prop ON punti.pk = prop.pk
  ) features
) punti;
");
echo $geom[0]['geometrie'];
?>
