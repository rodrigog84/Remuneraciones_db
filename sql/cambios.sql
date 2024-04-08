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

--  Agregado 18/03/2022
CREATE TABLE rem_parametros (
    id int identity NOT NULL,
    nombre varchar(20) NOT NULL,
    valor float NOT NULL,
    fecha datetime NOT NULL,
    created_at datetime default getdate(),
    updated_at datetime
)




alter table rem_periodo add periodo int
ALTER TABLE rem_parametros ALTER COLUMN fecha DATE


/********************************************************************/

update	a	
	set		funcion = 'configuraciones/tipos_documentos'
--select		*
	from		rem_app a
	where		nombre = 'Tipos de Documentos'


update		t
		set			id_empresa = null
		--select		*
		from		rem_tipo_doc_colaborador t	


	update		t
	set			tipo = 'Contrato'
	--select		*
	from		rem_tipo_doc_colaborador t
	where		tipo = 'CONTRATO'


	update		t
	set			tipo = 'Finiquito'
	--select		*
	from		rem_tipo_doc_colaborador t
	where		tipo = 'FINIQUITOS'

	update		t
	set			tipo = 'Carta Aviso'
	--select		*
	from		rem_tipo_doc_colaborador t
	where		tipo = 'CARTA AVISO'

	alter table rem_tipo_doc_colaborador drop column id_empresa
	insert into rem_tipo_doc_colaborador ( tipo, created_at, updated_at) values ('Anexos Contrato',getdate(), getdate())


EXEC sp_rename 'dbo.rem_tipo_doc_colaborador', 'rem_tipo_documentos';

EXEC sp_rename 'dbo.rem_tipo_documentos.id_tipo_doc_colaborador', 'id_tipo_documento', 'COLUMN';

create table rem_formato_documentos (
id_formato int identity,
id_tipo_documento int,
nombre varchar(100),
txt_documento varchar(max),
id_empresa int,
created_at datetime default getdate(),
updated_at datetime default getdate()
)


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
'configuraciones/add_formato_documento'
,null
,7
,0
,0
,1
,null
)

insert into rem_role (appid,levelid) values (7109,2)




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
'configuraciones/ver_formato_documento'
,null
,7
,0
,0
,1
,null
)


insert into rem_role (appid,levelid) values (7110,2)




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
'configuraciones/submit_documentos'
,null
,7
,0
,0
,1
,null
)


insert into rem_role (appid,levelid) values (7111,2)


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
'rrhh/documentos_colaborador'
,'Documentos Colaborador'
,4
,0
,1
,1
,5
)
insert into rem_role (appid,levelid) values (7112,2)


create table rem_documentos_colaborador (
id_documento int identity,
id_personal int,
id_formato int,
pdf_content varchar(max),
activo tinyint default 1,
created_at datetime default getdate(),
updated_at datetime default getdate()
)


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
'rrhh/crear_documentos_colaborador'
,null
,4
,0
,0
,1
,null
)
insert into rem_role (appid,levelid) values (7113,2)



	
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
'rrhh/submit_documento_colaborador'
,null
,4
,0
,0
,1
,null
)

insert into rem_role (appid,levelid) values (7114,2)


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
'rrhh/del_documento_colaborador'
,null
,4
,0
,0
,1
,null
)
insert into rem_role (appid,levelid) values (7115,2)




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
'rrhh/ver_documento_colaborador'
,null
,4
,0
,0
,1
,null
)
insert into rem_role (appid,levelid) values (7116,2)



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
'configuraciones/ejemplo_formato_documento'
,null
,7
,0
,0
,1
,null
)
insert into rem_role (appid,levelid) values (7117,2)




delete		r
--select		*
from		rem_role r
where		appid in (
						select		id
						from		rem_app
						where		funcion = 'rrhh/contratos' 
						and			visible = 1
						union
						select		id
						from		rem_app
						where		funcion = 'rrhh/finiquitos' 
						and			visible = 1
						union
						select		id
						from		rem_app
						where		funcion = 'rrhh/cartas' 
						and			visible = 1
						)




/*******************************************************************************/
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
'rrhh/mod_trabajador'
,null
,4
,0
,0
,1
,null
)

insert into rem_role (appid,levelid) values (7118,2)




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
'rrhh/editar_trabajador'
,null
,4
,0
,0
,1
,null
)

insert into rem_role (appid,levelid) values (7119,2)


/**********************************************************/

alter table rem_empresa add fecvencimiento date
alter table rem_empresa alter column fecvencimiento date
alter table rem_users add inicpass varchar(250)


/***********************************************************/

alter table rem_empresa add codvendedor varchar(15)


create table rem_vendedor_sistema (
id int identity,
rut int,
dv char(1),
nombre varchar(250),
codigo varchar(10),
created_at datetime default getdate()
)



/********************************************************************************/


create table rem_accesos_registro (
id int identity,
codigo varchar(10),
ip_acceso varchar(20),
http_user_agent varchar(250),
fecha_acceso datetime default getdate()
)


/********************************************************************************/


create table rem_log_envio_mail (
id int identity,
email varchar(100),
messageid varchar(100),
idempresa int,
created_at datetime default getdate()
)


/****************************************************************************************/

-- ================================================
-- Template generated from Template Explorer using:
-- Create Procedure (New Menu).SQL
--
-- Use the Specify Values for Template Parameters 
-- command (Ctrl-Shift-M) to fill in the parameter 
-- values below.
--
-- This block of comments will not be included in
-- the definition of the procedure.
-- ================================================
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
alter PROCEDURE SP_GET_PERIODO_ANTERIOR  (@idperiodo INT) AS 
BEGIN
		select	id_periodo
		from	rem_periodo
		where	periodo = (
							select  max(periodo) as pediodo
							from	rem_calendario
							where	periodo < (
												select	periodo
												from	rem_periodo
												where	id_periodo = @idperiodo
												)
							)

END
GO




/************************************************************************************************/

update	r
SET		TIPO_DIA = 'F'
--SELECT	*
FROM	rem_calendario r
WHERE	AÑO = 2023
AND		FECHA = '20230507'



INSERT INTO REM_FERIADO (FECHA, ACTIVE, CREATED_AT)

SELECT	FECHA, 1 AS ACTIVE, GETDATE() AS CREATED_AT
FROM	rem_calendario r
WHERE	TIPO_DIA = 'F'
AND		FECHA NOT IN (SELECT FECHA
					  FROM	REM_FERIADO
					  WHERE	ACTIVE = 1)



/*************************************************************************************/

alter table rem_remuneracion add sueldoimponibleafcnotrabajo int default 0
alter table rem_remuneracion add sueldoimponibleimposicionesnotrabajo int default 0


/************************************************************************************/

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
'rrhh/resumen_rem'
,null
,5
,0
,0
,1
,null
)


insert into rem_role (appid,levelid) values (9118,2)


/****************************************************************************************/

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
'auxiliares/calcular_finiquito'
,'Calcular Finiquito'
,9
,0
,1
,1
,3
)


insert into rem_role (appid,levelid) values (9119,2)



truncate table rem_causal_finiquito

INSERT INTO rem_causal_finiquito (motivo, articulo, activo, created_at) VALUES ('Acuerdo entre las partes de ponerle término', 'Art. 159 Inciso 1', 1, '2022-06-03 12:48:55');
INSERT INTO rem_causal_finiquito (motivo, articulo, activo, created_at) VALUES ('Renuncia del trabajador', 'Art. 159 Inciso 2', 1, '2022-06-03 12:49:02');
INSERT INTO rem_causal_finiquito (motivo, articulo, activo, created_at) VALUES ('Muerte del trabajador', 'Art. 159 Inciso 3', 1, '2022-06-03 12:49:15');
INSERT INTO rem_causal_finiquito (motivo, articulo, activo, created_at) VALUES ('Vencimiento del plazo del contrato', 'Art. 159 Inciso 4', 1, '2022-06-03 12:52:04');
INSERT INTO rem_causal_finiquito (motivo, articulo, activo, created_at) VALUES ('Término del trabajo acordado', 'Art. 159 Inciso 5', 1, '2022-06-03 12:52:14');
INSERT INTO rem_causal_finiquito (motivo, articulo, activo, created_at) VALUES ('Caso fortuito o fuerza mayor', 'Art. 159 Inciso 6', 1, '2022-06-03 12:52:25');
INSERT INTO rem_causal_finiquito (motivo, articulo, activo, created_at) VALUES ('Conductas indebidas y graves del trabajador', 'Art. 160 Inciso 1', 1, '2022-06-03 12:57:07');
INSERT INTO rem_causal_finiquito (motivo, articulo, activo, created_at) VALUES ('Realizar actividades prohibidas en el contrato de trabajo', 'Art. 160 Inciso 2', 1, '2022-06-03 12:57:36');
INSERT INTO rem_causal_finiquito (motivo, articulo, activo, created_at) VALUES ('No presentarse el trabajador a sus labores sin causa justificada ', 'Art. 160 Inciso 3', 1, '2022-06-03 12:57:56');
INSERT INTO rem_causal_finiquito (motivo, articulo, activo, created_at) VALUES ('Abandono del trabajo', 'Art. 160 Inciso 4', 1, '2022-06-03 12:58:12');
INSERT INTO rem_causal_finiquito (motivo, articulo, activo, created_at) VALUES ('Actos, omisiones o imprudencias temerarias que afecten a la seguridad o al funcionamiento del establecimiento', 'Art. 160 Inciso 5', 1, '2022-06-03 12:58:33');
INSERT INTO rem_causal_finiquito (motivo, articulo, activo, created_at) VALUES ('El perjuicio material causado intencionalmente en las instalaciones, maquinarias, herramientas, útiles de trabajo, productos o mercaderías', 'Art. 160 Inciso 6', 1, '2022-06-03 12:58:45');
INSERT INTO rem_causal_finiquito (motivo, articulo, activo, created_at) VALUES ('Incumplimiento grave de las obligaciones que impone el contrato', 'Art. 160 Inciso 7', 1, '2022-06-03 12:58:56');
INSERT INTO rem_causal_finiquito (motivo, articulo, activo, created_at) VALUES ('Necesidades de la empresa, establecimiento o servicio', 'Art. 161', 1, '2022-06-03 12:59:07');
INSERT INTO rem_causal_finiquito (motivo, articulo, activo, created_at) VALUES ('Por haber sido sometido el empleador, mediante resolución judicial, a un procedimiento concursal de liquidación de sus bienes', 'Artículo 163 bis', 1, '2022-06-03 12:59:24');




/******************************************************************************************************/


alter table rem_empresa add centralizacion int default 0;
update	r
set		centralizacion = 0
from	rem_empresa r;

/********************************************************************************************************/




alter table rem_conf_haber_descuento add idcuentacontable int default 0
alter table rem_conf_haber_descuento add idcentrocosto int default 0
alter table rem_conf_haber_descuento add iditemingreso int default 0
alter table rem_conf_haber_descuento add iditemgasto int default 0
alter table rem_conf_haber_descuento add idcuentacorriente int default 0
update	r
set		idcuentacontable = 0,
		idcentrocosto = 0,
		iditemingreso = 0,
		iditemgasto = 0,
		idcuentacorriente = 0
from	rem_conf_haber_descuento r



/*******************************************************************************************************/



alter table rem_haber_descuento_remuneracion add idconfhd int default 0



/******************************************************************************************************/


--  Agregado 18/01/2024
CREATE TABLE rem_cuentas_centralizacion (
    id int identity NOT NULL,
    nombre_codigo varchar(50) NOT NULL,
	nombre_sistema varchar(100) NOT NULL,
    active smallint default 1,
    created_at datetime default getdate()
)


insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('sueldo_base','Sueldo Base')
insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('gratificacion','Gratificacion')
insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('movilizacion','Movilizaci&oacute;n')
insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('colacion','Colaci&oacute;n')
insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('horasextras50','Horas Extras 50%')
insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('horasextras100','Horas Extras 100%')
insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('semanacorrida','Semana Corrida')
insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('aguinaldo','Aguinaldo')
insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('asigfamiliar','Asignaci&oacute;n Familiar')
insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('cotobligatoria','Cotizaci&oacute;n Obligatoria')
insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('cotadic','Cotizaci&oacute;n Adicional')

insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('ahorrovol','Ahorro Voluntario')
insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('apv','APV')
insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('cotsalud','Cotizaci&oacute;n Salud')
insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('segurocesantia','Seguro Cesant&iacute;a')
insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('impuestos','Impuestos')
insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('anticipos','Anticipos')
insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('desctoaguinaldo','Descuento Aguinaldo')

insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('aportesegcesantia','Aporte Seguro Cesant&iacute;a')
insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('aportesis','Aporte SIS')
insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema) values ('mutseguridad','Mutual Seguridad')




CREATE TABLE rem_cuentas_centralizacion_empresa (
    id int identity NOT NULL,
    idctacentralizacion int NOT NULL,
	idempresa int not null,
	idcuentacontable int default 0,
	idcentrocosto int default 0,
	iditemingreso int default 0,
	iditemgasto int default 0,
	idcuentacorriente int default 0,
    created_at datetime default getdate()
)

update	r
set		funcion = 'configuraciones/cuentas_centralizacion'
from	rem_app r
where	id = 31





insert into rem_app (

funcion
,menuid
,leaf
,visible
,valid
)

values (
'configuracion/edit_cuenta_centralizacion'
,7
,0
,0
,1
)


insert into rem_role (appid,levelid) values (9120,2)


update	r
set		funcion = 'configuraciones/edit_cuenta_centralizacion'
--select *
from rem_app r
where id = 9120


insert into rem_app (

funcion
,menuid
,leaf
,visible
,valid
)

values (
'configuraciones/submit_cuentas_centralizacion'
,7
,0
,0
,1
)
insert into rem_role (appid,levelid) values (9121,2)




/**************************************************************************************************************/

alter table rem_personal add diastrabajosemanal int default 6


/*************************************************************************************************************/


alter table rem_personal add sueldoprevio bigint default 0


/****************************************************************************************************************/

CREATE TABLE rem_centralizacion_periodo (
    id int identity NOT NULL,
	idperiodo int not null,
	idempresa int not null,
	calculado datetime,
	aprobado datetime,
	tipomovimiento char(1),
	nrocomprobante int default 0,
	totaldebe bigint default 0,
	totalhaber bigint default 0,
    created_at datetime default getdate()
)



CREATE TABLE rem_centralizacion_periodo_detalle (
    id int identity NOT NULL,
	idcentralizacion int NOT NULL,
	idcuentacontable int default 0,
	idcentrocosto int default 0,
	iditemingreso int default 0,
	iditemgasto int default 0,
	idcuentacorriente int default 0,
	montodebe bigint default 0,
	montohaber bigint default 0,
    created_at datetime default getdate()
)


update	a
set		funcion = 'rrhh/centralizacion_mensual'
--select	*
from	rem_app a
where	id = 32



insert into rem_app (

funcion
,menuid
,leaf
,visible
,valid
)

values (
'rrhh/add_centralizacion_mensual'
,8
,0
,0
,1
)
insert into rem_role (appid,levelid) values (9122,2)



insert into rem_app (

funcion
,menuid
,leaf
,visible
,valid
)

values (
'rrhh/submit_centralizacion_mensual'
,8
,0
,0
,1
)
insert into rem_role (appid,levelid) values (9123,2)



alter table rem_cuentas_centralizacion add tipo_cuadratura char(1)


update rem_cuentas_centralizacion set tipo_cuadratura = 'D' where nombre_codigo = 'sueldo_base'
update rem_cuentas_centralizacion set tipo_cuadratura = 'D' where nombre_codigo = 'gratificacion'
update rem_cuentas_centralizacion set tipo_cuadratura = 'D' where nombre_codigo = 'movilizacion'
update rem_cuentas_centralizacion set tipo_cuadratura = 'D' where nombre_codigo = 'colacion'
update rem_cuentas_centralizacion set tipo_cuadratura = 'D' where nombre_codigo = 'horasextras50'
update rem_cuentas_centralizacion set tipo_cuadratura = 'D' where nombre_codigo = 'horasextras100'
update rem_cuentas_centralizacion set tipo_cuadratura = 'D' where nombre_codigo = 'semanacorrida'
update rem_cuentas_centralizacion set tipo_cuadratura = 'D' where nombre_codigo = 'aguinaldo'
update rem_cuentas_centralizacion set tipo_cuadratura = 'D' where nombre_codigo = 'asigfamiliar'
update rem_cuentas_centralizacion set tipo_cuadratura = 'H' where nombre_codigo = 'cotobligatoria'
update rem_cuentas_centralizacion set tipo_cuadratura = 'H' where nombre_codigo = 'cotadic'
update rem_cuentas_centralizacion set tipo_cuadratura = 'H' where nombre_codigo = 'ahorrovol'
update rem_cuentas_centralizacion set tipo_cuadratura = 'H' where nombre_codigo = 'apv'
update rem_cuentas_centralizacion set tipo_cuadratura = 'H' where nombre_codigo = 'cotsalud'
update rem_cuentas_centralizacion set tipo_cuadratura = 'H' where nombre_codigo = 'segurocesantia'
update rem_cuentas_centralizacion set tipo_cuadratura = 'H' where nombre_codigo = 'impuestos'
update rem_cuentas_centralizacion set tipo_cuadratura = 'H' where nombre_codigo = 'anticipos'
update rem_cuentas_centralizacion set tipo_cuadratura = 'H' where nombre_codigo = 'desctoaguinaldo'
update rem_cuentas_centralizacion set tipo_cuadratura = 'A' where nombre_codigo = 'aportesegcesantia'
update rem_cuentas_centralizacion set tipo_cuadratura = 'A' where nombre_codigo = 'aportesis'
update rem_cuentas_centralizacion set tipo_cuadratura = 'A' where nombre_codigo = 'mutseguridad'

insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema, tipo_cuadratura) values ('sueldo_liquido','Sueldo Liquido','H')
insert into rem_cuentas_centralizacion (nombre_codigo,nombre_sistema, tipo_cuadratura) values ('saldo_asig_familiar','Saldo a Favor Asignacion Familiar','H')
	

insert into rem_app (

funcion
,menuid
,leaf
,visible
,valid
)

values (
'rrhh/crea_asiento_centralizacion'
,8
,0
,0
,1
)
insert into rem_role (appid,levelid) values (10122,2)

insert into rem_app (

funcion
,menuid
,leaf
,visible
,valid
)

values (
'rrhh/aprobar_centralizacion'
,8
,0
,0
,1
)


insert into rem_role (appid,levelid) values (10123,2)

insert into rem_app (

funcion
,menuid
,leaf
,visible
,valid
)

values (
'rrhh/get_centralizacion'
,8
,0
,0
,1
)


insert into rem_role (appid,levelid) values (10124,2)



/***************************************************************************************/

insert into rem_app (

funcion
,menuid
,leaf
,visible
,valid
,orden
)

values (
'admins/correccion_monetaria'
,2
,0
,1
,1
,4
)

insert into rem_role (appid,levelid) values (10125,1)

update rem_app set nombre = 'Correccion Monetaria' where id = 10125



create table rem_tabla_correccion_monetaria (
		id int identity,
		anno int default 0,
		mes_orig int default 0,
		dic float default 0
)




insert into rem_app (

funcion
,menuid
,leaf
,visible
,valid
)

values (
'admins/submit_correccion_monetaria'
,2
,0
,1
,1
)

insert into rem_role (appid,levelid) values (10126,1)


update rem_app set visible = 0 where id = 10126



insert into rem_app (

funcion
,menuid
,leaf
,visible
,valid
)

values (
'admins/get_correccion_monetaria'
,2
,0
,0
,1
)

insert into rem_role (appid,levelid) values (10127,1)


/********************************************************************************/


insert into rem_app (

funcion
,menuid
,leaf
,visible
,valid
,orden
)

values (
'rrhh/decjurada_rentas'
,5
,0
,1
,1
,11
)

insert into rem_role (appid,levelid) values (10128,2)


update rem_app set nombre = 'Declaración Jurada Rentas' where id = 10128



CREATE TABLE rem_declaracion_jurada (
	id INT identity,
	anno INT,
	rentatotalsinactualizar BIGINT DEFAULT 0,
	rentatotalneta BIGINT DEFAULT 0,
	impuestorentasinactualizar BIGINT DEFAULT 0,
	impuestorentapagada BIGINT DEFAULT 0,
	impuestorentaaccesoria BIGINT DEFAULT 0,
	rentanogravada BIGINT DEFAULT 0,
	rentanogravadasinactualizar BIGINT DEFAULT 0,
	rentaexenta BIGINT DEFAULT 0,
	rebajazonasextremas BIGINT DEFAULT 0,
	leyessociales BIGINT DEFAULT 0,
	idempresa INT DEFAULT NULL,
	created_at DATETIME DEFAULT GETDATE(),
	PRIMARY KEY (id) 
)
;


CREATE TABLE rem_declaracion_jurada_detalle (
	id INT NOT NULL identity,
	iddeclaracion INT DEFAULT NULL,
	idpersonal INT DEFAULT NULL,
	rut INT DEFAULT NULL,
	dv CHAR(1) DEFAULT NULL,
	rentatotalsinactualizar BIGINT DEFAULT 0,
	rentatotalneta BIGINT DEFAULT 0,
	impuestosinactualizar BIGINT DEFAULT 0,
	impuestoactualizado BIGINT DEFAULT 0,
	bonosnoimponiblessinactualizar BIGINT DEFAULT 0,
	bonosnoimponibles BIGINT DEFAULT 0,
	leyessociales BIGINT DEFAULT 0,
	eneroind CHAR(1),
	febreroind CHAR(1),
	marzoind CHAR(1),
	abrilind CHAR(1),
	mayoind CHAR(1),
	junioind CHAR(1),
	julioind CHAR(1),
	agostoind CHAR(1),
	septiembreind CHAR(1),
	octubreind CHAR(1),
	noviembreind CHAR(1),
	diciembreind CHAR(1),
	correlativo INT DEFAULT 0,
	enerorenta BIGINT DEFAULT 0,
	febrerorenta BIGINT DEFAULT 0,
	marzorenta BIGINT DEFAULT 0,
	abrilrenta BIGINT DEFAULT 0,
	mayorenta BIGINT DEFAULT 0,
	juniorenta BIGINT DEFAULT 0,
	juliorenta BIGINT DEFAULT 0,
	agostorenta BIGINT DEFAULT 0,
	septiembrerenta BIGINT DEFAULT 0,
	octubrerenta BIGINT DEFAULT 0,
	noviembrerenta BIGINT DEFAULT 0,
	diciembrerenta BIGINT DEFAULT 0,
	horassemanales INT DEFAULT 0,
	PRIMARY KEY (id)
)



insert into rem_app (

funcion
,menuid
,leaf
,visible
,valid
)

values (
'rrhh/decjurada_rentas_exportar'
,5
,0
,0
,1
)


insert into rem_role (appid,levelid) values (10129,2)


/***************************************************************************************/

alter table rem_declaracion_jurada_detalle add sueldoimponible bigint default 0
alter table rem_declaracion_jurada_detalle add sueldoimponiblesinactualizar bigint default 0

alter table rem_declaracion_jurada add sueldoimponible bigint default 0
alter table rem_declaracion_jurada add sueldoimponiblesinactualizar bigint default 0



/********************************************************************************************/

alter table rem_personal add ccafcredito bigint default 0
alter table rem_personal add ccafseguro bigint default 0


/********************************************************************************************/

alter table rem_remuneracion add ccafcredito bigint default 0
alter table rem_remuneracion add ccafseguro bigint default 0


/**********************************************************************************************/

alter table rem_empresa add rol_privado tinyint default 0
UPDATE rem_empresa set rol_privado = 0


/*********************************************************************************************/


alter table rem_users add rol_privado tinyint default 0
UPDATE rem_users set rol_privado = 0


/***********************************************************************************************/

alter table rem_personal add rol_privado_personal tinyint default 0
UPDATE rem_personal set rol_privado_personal = 0

