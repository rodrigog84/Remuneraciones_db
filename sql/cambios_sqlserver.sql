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