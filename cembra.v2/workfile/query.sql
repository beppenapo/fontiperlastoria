SELECT row_to_json(comuni.*) as geometrie
FROM (
  SELECT 'FeatureCollection'::text As type, array_to_json(array_agg(features.*)) As features
  FROM (
    SELECT 'Feature'::text As type, ST_AsGeoJSON(st_transform(ST_SetSRID(comuni.geom,3857),4326))::json As geometry, (select row_to_json(t) from (select comune) t) As properties
    FROM comuni
  ) As features
)  As comuni;
