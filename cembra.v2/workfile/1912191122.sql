begin;
alter table usr add column pw character varying;
update usr set pw = crypt(pwd,gen_salt('bf'));
ALTER TABLE usr DROP COLUMN pwd;
ALTER TABLE usr RENAME pw to pwd;
commit;
