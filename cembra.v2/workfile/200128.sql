BEGIN;
-- ALTER TABLE comuni
--   DROP COLUMN cod_rip,
--   DROP COLUMN cod_reg,
--   DROP COLUMN cod_prov,
--   DROP COLUMN cod_cm,
--   DROP COLUMN pro_com,
--   DROP COLUMN comune_a,
--   DROP COLUMN cc_p_cm,
--   ADD COLUMN provincia integer references provincia(id);
-- insert into comune(provincia, comune, stato, geom) select 1, comune, 1, geom from comuni order by comune asc;
COMMIT;
