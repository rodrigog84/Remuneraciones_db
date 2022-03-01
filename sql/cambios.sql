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



## AGREGADAS 07/07/2020
create table rem_causal_finiquito (
idcausal int identity,
motivo varchar(200),
articulo varchar(50),
activo int,
created_at datetime default getdate()
)



insert into rem_causal_finiquito (
								motivo
								,articulo
								,activo
)
values (
'Falta de probidad, vias de hecho, injurias o conducta grave.'
,'Art. 160 Inciso 1.'
,1
)


insert into rem_causal_finiquito (
								motivo
								,articulo
								,activo
)
values (
'Negociaciones que ejecuta el trabajador dentro del giro del negocio.'
,'Art. 160 Inciso 2.'
,1
)


insert into rem_causal_finiquito (
								motivo
								,articulo
								,activo
)
values (
'No concurrencia del trabajador a sus labores sin causa justificada.'
,'Art. 160 Inciso 3.'
,1
)


insert into rem_causal_finiquito (
								motivo
								,articulo
								,activo
)
values (
'Abandono del trabajo por parte del trabajador.'
,'Art. 160 Inciso 4.'
,1
)


insert into rem_causal_finiquito (
								motivo
								,articulo
								,activo
)
values (
'Actos, omisiones o imprudencias temerarias que afectan a la seguridad, a la salud, al funcionamiento del trabajador y/o establecimiento. '
,'Art. 160 Inciso 5.'
,1
)




insert into rem_causal_finiquito (
								motivo
								,articulo
								,activo
)
values (
'Perjuicio material causado intencionalmente en las instalaciones, maquinarias, utiles, productos, mercaderias, etc. del trabajo.'
,'Art. 160 Inciso 6.'
,1
)



insert into rem_causal_finiquito (
								motivo
								,articulo
								,activo
)
values (
'Incumplimiento grave de las obligaciones que impone el contrato.'
,'Art. 160 Inciso 7.'
,1
)



insert into rem_causal_finiquito (
								motivo
								,articulo
								,activo
)
values (
'Necesidades de la empresa.'
,'Art. 161.'
,1
)



/*************************************************************/


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
'rrhh/ver_formato_carga_colaboradores'
,null
,4
,0
,0
,1
,null
)

insert into rem_role (appid,levelid) values (6098,2)


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
'rrhh/ver_tablas_anexas_colaboradores'
,null
,4
,0
,0
,1
,null
)

insert into rem_role (appid,levelid) values (6099,2)

/*****************************************************/

alter table rem_licencias_medicas add idmovimiento int
alter table rem_licencias_medicas add active smallint


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
'rrhh/submit_personal_data'
,null
,4
,0
,0
,1
,null
)

insert into rem_role (appid,levelid) values (6101,2)



/*****************************************************************************/

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
'configuraciones/cargos'
,'Cargos'
,2
,0
,1
,1
,5
)


insert into rem_role (appid,levelid) values (6102,2)



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
'configuraciones/add_cargo'
,null
,2
,0
,0
,1
,null
)

insert into rem_role (appid,levelid) values (6103,2)




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
'configuraciones/submit_cargo'
,null
,2
,0
,0
,1
,null
)

insert into rem_role (appid,levelid) values (6104,2)




ALTER TABLE rem_cargos
ADD CONSTRAINT df_UD
DEFAULT GETDATE() FOR updated_at;

/*********************************************************************************/


	
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
'auxiliares/colaborador_licencias'
,null
,9
,0
,0
,1
,null
)

insert into rem_role (appid,levelid) values (6105,2)


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
'auxiliares/add_licencias'
,null
,9
,0
,0
,1
,null
)

insert into rem_role (appid,levelid) values (6106,2)




create table rem_tipo_licencia (
	idtipolicencia int identity,
	nombre varchar(50),
	activo tinyint default 1,
	created_at datetime default getdate()
)

insert into rem_tipo_licencia (nombre) values ('Enfermedad o Accidente Común')
insert into rem_tipo_licencia (nombre) values ('Prorroga Medicina Preventiva')
insert into rem_tipo_licencia (nombre) values ('Licencia Pre y Post Natal')
insert into rem_tipo_licencia (nombre) values ('Enfermedad Grave Hijo menor de 1 año')
insert into rem_tipo_licencia (nombre) values ('Accidente del Trabajo o Trayecto')
insert into rem_tipo_licencia (nombre) values ('Enfermedad Profesional')
insert into rem_tipo_licencia (nombre) values ('Patologias del Embarazo')




EXEC sp_rename 'dbo.rem_licencias_medicas.responsabilidad_laboral', 'recuperabilidad_laboral', 'COLUMN';
EXEC sp_rename 'dbo.rem_licencias_medicas.direccion_otro_domicilio', 'direccion_reposo', 'COLUMN';
EXEC sp_rename 'dbo.rem_licencias_medicas.telefono_contacto', 'telefono_reposo', 'COLUMN';
EXEC sp_rename 'dbo.rem_licencias_medicas.direccion_profesional', 'direccion_emision_licencia', 'COLUMN';


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
'auxiliares/edit_licencias'
,null
,9
,0
,0
,1
,null
)

insert into rem_role (appid,levelid) values (6107,2)

ALTER TABLE rem_licencias_medicas DROP COLUMN idmovimiento
alter table rem_lista_movimiento_personal add idlicenciamedica int





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
'auxiliares/del_licencia'
,null
,9
,0
,0
,1
,null
)


insert into rem_role (appid,levelid) values (6108,2)

/**********************************************************************************************/



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
'rrhh/liquidaciones'
,null
,5
,0
,0
,1
,null
)


insert into rem_role (appid,levelid) values (6109,2)



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
'rrhh/ultima_liquidacion'
,null
,5
,0
,0
,1
,null
)



insert into rem_role (appid,levelid) values (6110,2)




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
'rrhh/historico_sueldos'
,null
,5
,0
,0
,1
,null
)


insert into rem_role (appid,levelid) values (6111,2)



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
'rrhh/licencias_colaborador'
,null
,5
,0
,0
,1
,null
)


insert into rem_role (appid,levelid) values (6112,2)