alter table rem_personal add anticipo_permanente int default 0
alter table rem_personal add anticipo bigint


#### AGREGADAS 18/06/2020


ALTER TABLE rem_personal
DROP CONSTRAINT "DF__rem_perso__horas__6AEFE058";
ALTER TABLE rem_personal
ALTER COLUMN horasdiarias float ;
ALTER TABLE rem_personal
ADD CONSTRAINT df_horasdiarias
DEFAULT 8 FOR horasdiarias;


ALTER TABLE rem_personal
DROP CONSTRAINT "DF__rem_perso__horas__6BE40491";
ALTER TABLE rem_personal
ALTER COLUMN horassemanales float;
ALTER TABLE rem_personal
ADD CONSTRAINT df_horassemanales
DEFAULT 45 FOR horassemanales;


## AGREGADAS 22/06/2020


insert into rem_app (

funcion
,nombre
,menuid
,leaf
,visible
,valid
,orden

)

values (
'rrhh/ver_planillas_imposiciones'
,null
,5
,0
,0
,1
,null
)


## AGREGADAS 24/06/2020

alter table rem_remuneracion add idafp_rem int
alter table rem_remuneracion add idisapre_rem int
alter table rem_remuneracion add idmutual_rem int
alter table rem_remuneracion add idcaja_rem int





