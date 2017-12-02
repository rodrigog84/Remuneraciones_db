create table rem_usuario_empresa (
idusuario int,
idempresa int
)

insert into rem_usuario_empresa (idusuario,idempresa) values (6,17);
update rem_app set nombre = 'Mantenci&oacute;n Personal' where id = 10;


create table rem_centro_costo (
id int identity,
idempresa int,
nombre varchar(100),
codigo varchar(10),
valido tinyint,
fecha datetime default getdate()
)	

insert into rem_app 
(funcion,nombre,menuid,visible,valid,orden)
values
('Centro_costo/centrocosto','Centro de Costo',2,1,1,1)


insert into rem_role
(appid,levelid)
values
(47,2)

create table rem_estudio (
id int identity,
idempresa int,
nombre varchar(100),
codigo varchar(10),
valido tinyint,
fecha datetime default getdate()
)