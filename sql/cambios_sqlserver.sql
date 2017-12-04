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



#### CREACION DE TABLA DE PAISES

CREATE TABLE rem_paises (
id int primary key,
iso char(2) DEFAULT NULL,
nombre varchar(80) DEFAULT NULL,
)
 
INSERT INTO rem_paises (id,iso,nombre) VALUES(1, 'AF', 'Afganistán');
INSERT INTO rem_paises (id,iso,nombre) VALUES(2, 'AX', 'Islas Gland');
INSERT INTO rem_paises (id,iso,nombre) VALUES(3, 'AL', 'Albania');
INSERT INTO rem_paises (id,iso,nombre) VALUES(4, 'DE', 'Alemania');
INSERT INTO rem_paises (id,iso,nombre) VALUES(5, 'AD', 'Andorra');
INSERT INTO rem_paises (id,iso,nombre) VALUES(6, 'AO', 'Angola');
INSERT INTO rem_paises (id,iso,nombre) VALUES(7, 'AI', 'Anguilla');
INSERT INTO rem_paises (id,iso,nombre) VALUES(8, 'AQ', 'Antártida');
INSERT INTO rem_paises (id,iso,nombre) VALUES(9, 'AG', 'Antigua y Barbuda');
INSERT INTO rem_paises (id,iso,nombre) VALUES(10, 'AN', 'Antillas Holandesas');
INSERT INTO rem_paises (id,iso,nombre) VALUES(11, 'SA', 'Arabia Saudí');
INSERT INTO rem_paises (id,iso,nombre) VALUES(12, 'DZ', 'Argelia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(13, 'AR', 'Argentina');
INSERT INTO rem_paises (id,iso,nombre) VALUES(14, 'AM', 'Armenia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(15, 'AW', 'Aruba');
INSERT INTO rem_paises (id,iso,nombre) VALUES(16, 'AU', 'Australia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(17, 'AT', 'Austria');
INSERT INTO rem_paises (id,iso,nombre) VALUES(18, 'AZ', 'Azerbaiyán');
INSERT INTO rem_paises (id,iso,nombre) VALUES(19, 'BS', 'Bahamas');
INSERT INTO rem_paises (id,iso,nombre) VALUES(20, 'BH', 'Bahréin');
INSERT INTO rem_paises (id,iso,nombre) VALUES(21, 'BD', 'Bangladesh');
INSERT INTO rem_paises (id,iso,nombre) VALUES(22, 'BB', 'Barbados');
INSERT INTO rem_paises (id,iso,nombre) VALUES(23, 'BY', 'Bielorrusia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(24, 'BE', 'Bélgica');
INSERT INTO rem_paises (id,iso,nombre) VALUES(25, 'BZ', 'Belice');
INSERT INTO rem_paises (id,iso,nombre) VALUES(26, 'BJ', 'Benin');
INSERT INTO rem_paises (id,iso,nombre) VALUES(27, 'BM', 'Bermudas');
INSERT INTO rem_paises (id,iso,nombre) VALUES(28, 'BT', 'Bhután');
INSERT INTO rem_paises (id,iso,nombre) VALUES(29, 'BO', 'Bolivia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(30, 'BA', 'Bosnia y Herzegovina');
INSERT INTO rem_paises (id,iso,nombre) VALUES(31, 'BW', 'Botsuana');
INSERT INTO rem_paises (id,iso,nombre) VALUES(32, 'BV', 'Isla Bouvet');
INSERT INTO rem_paises (id,iso,nombre) VALUES(33, 'BR', 'Brasil');
INSERT INTO rem_paises (id,iso,nombre) VALUES(34, 'BN', 'Brunéi');
INSERT INTO rem_paises (id,iso,nombre) VALUES(35, 'BG', 'Bulgaria');
INSERT INTO rem_paises (id,iso,nombre) VALUES(36, 'BF', 'Burkina Faso');
INSERT INTO rem_paises (id,iso,nombre) VALUES(37, 'BI', 'Burundi');
INSERT INTO rem_paises (id,iso,nombre) VALUES(38, 'CV', 'Cabo Verde');
INSERT INTO rem_paises (id,iso,nombre) VALUES(39, 'KY', 'Islas Caimán');
INSERT INTO rem_paises (id,iso,nombre) VALUES(40, 'KH', 'Camboya');
INSERT INTO rem_paises (id,iso,nombre) VALUES(41, 'CM', 'Camerún');
INSERT INTO rem_paises (id,iso,nombre) VALUES(42, 'CA', 'Canadá');
INSERT INTO rem_paises (id,iso,nombre) VALUES(43, 'CF', 'República Centroafricana');
INSERT INTO rem_paises (id,iso,nombre) VALUES(44, 'TD', 'Chad');
INSERT INTO rem_paises (id,iso,nombre) VALUES(45, 'CZ', 'República Checa');
INSERT INTO rem_paises (id,iso,nombre) VALUES(46, 'CL', 'Chile');
INSERT INTO rem_paises (id,iso,nombre) VALUES(47, 'CN', 'China');
INSERT INTO rem_paises (id,iso,nombre) VALUES(48, 'CY', 'Chipre');
INSERT INTO rem_paises (id,iso,nombre) VALUES(49, 'CX', 'Isla de Navidad');
INSERT INTO rem_paises (id,iso,nombre) VALUES(50, 'VA', 'Ciudad del Vaticano');
INSERT INTO rem_paises (id,iso,nombre) VALUES(51, 'CC', 'Islas Cocos');
INSERT INTO rem_paises (id,iso,nombre) VALUES(52, 'CO', 'Colombia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(53, 'KM', 'Comoras');
INSERT INTO rem_paises (id,iso,nombre) VALUES(54, 'CD', 'República Democrática del Congo');
INSERT INTO rem_paises (id,iso,nombre) VALUES(55, 'CG', 'Congo');
INSERT INTO rem_paises (id,iso,nombre) VALUES(56, 'CK', 'Islas Cook');
INSERT INTO rem_paises (id,iso,nombre) VALUES(57, 'KP', 'Corea del Norte');
INSERT INTO rem_paises (id,iso,nombre) VALUES(58, 'KR', 'Corea del Sur');
INSERT INTO rem_paises (id,iso,nombre) VALUES(59, 'CI', 'Costa de Marfil');
INSERT INTO rem_paises (id,iso,nombre) VALUES(60, 'CR', 'Costa Rica');
INSERT INTO rem_paises (id,iso,nombre) VALUES(61, 'HR', 'Croacia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(62, 'CU', 'Cuba');
INSERT INTO rem_paises (id,iso,nombre) VALUES(63, 'DK', 'Dinamarca');
INSERT INTO rem_paises (id,iso,nombre) VALUES(64, 'DM', 'Dominica');
INSERT INTO rem_paises (id,iso,nombre) VALUES(65, 'DO', 'República Dominicana');
INSERT INTO rem_paises (id,iso,nombre) VALUES(66, 'EC', 'Ecuador');
INSERT INTO rem_paises (id,iso,nombre) VALUES(67, 'EG', 'Egipto');
INSERT INTO rem_paises (id,iso,nombre) VALUES(68, 'SV', 'El Salvador');
INSERT INTO rem_paises (id,iso,nombre) VALUES(69, 'AE', 'Emiratos Árabes Unidos');
INSERT INTO rem_paises (id,iso,nombre) VALUES(70, 'ER', 'Eritrea');
INSERT INTO rem_paises (id,iso,nombre) VALUES(71, 'SK', 'Eslovaquia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(72, 'SI', 'Eslovenia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(73, 'ES', 'España');
INSERT INTO rem_paises (id,iso,nombre) VALUES(74, 'UM', 'Islas ultramarinas de Estados Unidos');
INSERT INTO rem_paises (id,iso,nombre) VALUES(75, 'US', 'Estados Unidos');
INSERT INTO rem_paises (id,iso,nombre) VALUES(76, 'EE', 'Estonia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(77, 'ET', 'Etiopía');
INSERT INTO rem_paises (id,iso,nombre) VALUES(78, 'FO', 'Islas Feroe');
INSERT INTO rem_paises (id,iso,nombre) VALUES(79, 'PH', 'Filipinas');
INSERT INTO rem_paises (id,iso,nombre) VALUES(80, 'FI', 'Finlandia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(81, 'FJ', 'Fiyi');
INSERT INTO rem_paises (id,iso,nombre) VALUES(82, 'FR', 'Francia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(83, 'GA', 'Gabón');
INSERT INTO rem_paises (id,iso,nombre) VALUES(84, 'GM', 'Gambia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(85, 'GE', 'Georgia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(86, 'GS', 'Islas Georgias del Sur y Sandwich del Sur');
INSERT INTO rem_paises (id,iso,nombre) VALUES(87, 'GH', 'Ghana');
INSERT INTO rem_paises (id,iso,nombre) VALUES(88, 'GI', 'Gibraltar');
INSERT INTO rem_paises (id,iso,nombre) VALUES(89, 'GD', 'Granada');
INSERT INTO rem_paises (id,iso,nombre) VALUES(90, 'GR', 'Grecia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(91, 'GL', 'Groenlandia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(92, 'GP', 'Guadalupe');
INSERT INTO rem_paises (id,iso,nombre) VALUES(93, 'GU', 'Guam');
INSERT INTO rem_paises (id,iso,nombre) VALUES(94, 'GT', 'Guatemala');
INSERT INTO rem_paises (id,iso,nombre) VALUES(95, 'GF', 'Guayana Francesa');
INSERT INTO rem_paises (id,iso,nombre) VALUES(96, 'GN', 'Guinea');
INSERT INTO rem_paises (id,iso,nombre) VALUES(97, 'GQ', 'Guinea Ecuatorial');
INSERT INTO rem_paises (id,iso,nombre) VALUES(98, 'GW', 'Guinea-Bissau');
INSERT INTO rem_paises (id,iso,nombre) VALUES(99, 'GY', 'Guyana');
INSERT INTO rem_paises (id,iso,nombre) VALUES(100, 'HT', 'Haití');
INSERT INTO rem_paises (id,iso,nombre) VALUES(101, 'HM', 'Islas Heard y McDonald');
INSERT INTO rem_paises (id,iso,nombre) VALUES(102, 'HN', 'Honduras');
INSERT INTO rem_paises (id,iso,nombre) VALUES(103, 'HK', 'Hong Kong');
INSERT INTO rem_paises (id,iso,nombre) VALUES(104, 'HU', 'Hungría');
INSERT INTO rem_paises (id,iso,nombre) VALUES(105, 'IN', 'India');
INSERT INTO rem_paises (id,iso,nombre) VALUES(106, 'ID', 'Indonesia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(107, 'IR', 'Irán');
INSERT INTO rem_paises (id,iso,nombre) VALUES(108, 'IQ', 'Iraq');
INSERT INTO rem_paises (id,iso,nombre) VALUES(109, 'IE', 'Irlanda');
INSERT INTO rem_paises (id,iso,nombre) VALUES(110, 'IS', 'Islandia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(111, 'IL', 'Israel');
INSERT INTO rem_paises (id,iso,nombre) VALUES(112, 'IT', 'Italia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(113, 'JM', 'Jamaica');
INSERT INTO rem_paises (id,iso,nombre) VALUES(114, 'JP', 'Japón');
INSERT INTO rem_paises (id,iso,nombre) VALUES(115, 'JO', 'Jordania');
INSERT INTO rem_paises (id,iso,nombre) VALUES(116, 'KZ', 'Kazajstán');
INSERT INTO rem_paises (id,iso,nombre) VALUES(117, 'KE', 'Kenia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(118, 'KG', 'Kirguistán');
INSERT INTO rem_paises (id,iso,nombre) VALUES(119, 'KI', 'Kiribati');
INSERT INTO rem_paises (id,iso,nombre) VALUES(120, 'KW', 'Kuwait');
INSERT INTO rem_paises (id,iso,nombre) VALUES(121, 'LA', 'Laos');
INSERT INTO rem_paises (id,iso,nombre) VALUES(122, 'LS', 'Lesotho');
INSERT INTO rem_paises (id,iso,nombre) VALUES(123, 'LV', 'Letonia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(124, 'LB', 'Líbano');
INSERT INTO rem_paises (id,iso,nombre) VALUES(125, 'LR', 'Liberia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(126, 'LY', 'Libia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(127, 'LI', 'Liechtenstein');
INSERT INTO rem_paises (id,iso,nombre) VALUES(128, 'LT', 'Lituania');
INSERT INTO rem_paises (id,iso,nombre) VALUES(129, 'LU', 'Luxemburgo');
INSERT INTO rem_paises (id,iso,nombre) VALUES(130, 'MO', 'Macao');
INSERT INTO rem_paises (id,iso,nombre) VALUES(131, 'MK', 'ARY Macedonia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(132, 'MG', 'Madagascar');
INSERT INTO rem_paises (id,iso,nombre) VALUES(133, 'MY', 'Malasia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(134, 'MW', 'Malawi');
INSERT INTO rem_paises (id,iso,nombre) VALUES(135, 'MV', 'Maldivas');
INSERT INTO rem_paises (id,iso,nombre) VALUES(136, 'ML', 'Malí');
INSERT INTO rem_paises (id,iso,nombre) VALUES(137, 'MT', 'Malta');
INSERT INTO rem_paises (id,iso,nombre) VALUES(138, 'FK', 'Islas Malvinas');
INSERT INTO rem_paises (id,iso,nombre) VALUES(139, 'MP', 'Islas Marianas del Norte');
INSERT INTO rem_paises (id,iso,nombre) VALUES(140, 'MA', 'Marruecos');
INSERT INTO rem_paises (id,iso,nombre) VALUES(141, 'MH', 'Islas Marshall');
INSERT INTO rem_paises (id,iso,nombre) VALUES(142, 'MQ', 'Martinica');
INSERT INTO rem_paises (id,iso,nombre) VALUES(143, 'MU', 'Mauricio');
INSERT INTO rem_paises (id,iso,nombre) VALUES(144, 'MR', 'Mauritania');
INSERT INTO rem_paises (id,iso,nombre) VALUES(145, 'YT', 'Mayotte');
INSERT INTO rem_paises (id,iso,nombre) VALUES(146, 'MX', 'México');
INSERT INTO rem_paises (id,iso,nombre) VALUES(147, 'FM', 'Micronesia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(148, 'MD', 'Moldavia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(149, 'MC', 'Mónaco');
INSERT INTO rem_paises (id,iso,nombre) VALUES(150, 'MN', 'Mongolia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(151, 'MS', 'Montserrat');
INSERT INTO rem_paises (id,iso,nombre) VALUES(152, 'MZ', 'Mozambique');
INSERT INTO rem_paises (id,iso,nombre) VALUES(153, 'MM', 'Myanmar');
INSERT INTO rem_paises (id,iso,nombre) VALUES(154, 'NA', 'Namibia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(155, 'NR', 'Nauru');
INSERT INTO rem_paises (id,iso,nombre) VALUES(156, 'NP', 'Nepal');
INSERT INTO rem_paises (id,iso,nombre) VALUES(157, 'NI', 'Nicaragua');
INSERT INTO rem_paises (id,iso,nombre) VALUES(158, 'NE', 'Níger');
INSERT INTO rem_paises (id,iso,nombre) VALUES(159, 'NG', 'Nigeria');
INSERT INTO rem_paises (id,iso,nombre) VALUES(160, 'NU', 'Niue');
INSERT INTO rem_paises (id,iso,nombre) VALUES(161, 'NF', 'Isla Norfolk');
INSERT INTO rem_paises (id,iso,nombre) VALUES(162, 'NO', 'Noruega');
INSERT INTO rem_paises (id,iso,nombre) VALUES(163, 'NC', 'Nueva Caledonia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(164, 'NZ', 'Nueva Zelanda');
INSERT INTO rem_paises (id,iso,nombre) VALUES(165, 'OM', 'Omán');
INSERT INTO rem_paises (id,iso,nombre) VALUES(166, 'NL', 'Países Bajos');
INSERT INTO rem_paises (id,iso,nombre) VALUES(167, 'PK', 'Pakistán');
INSERT INTO rem_paises (id,iso,nombre) VALUES(168, 'PW', 'Palau');
INSERT INTO rem_paises (id,iso,nombre) VALUES(169, 'PS', 'Palestina');
INSERT INTO rem_paises (id,iso,nombre) VALUES(170, 'PA', 'Panamá');
INSERT INTO rem_paises (id,iso,nombre) VALUES(171, 'PG', 'Papúa Nueva Guinea');
INSERT INTO rem_paises (id,iso,nombre) VALUES(172, 'PY', 'Paraguay');
INSERT INTO rem_paises (id,iso,nombre) VALUES(173, 'PE', 'Perú');
INSERT INTO rem_paises (id,iso,nombre) VALUES(174, 'PN', 'Islas Pitcairn');
INSERT INTO rem_paises (id,iso,nombre) VALUES(175, 'PF', 'Polinesia Francesa');
INSERT INTO rem_paises (id,iso,nombre) VALUES(176, 'PL', 'Polonia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(177, 'PT', 'Portugal');
INSERT INTO rem_paises (id,iso,nombre) VALUES(178, 'PR', 'Puerto Rico');
INSERT INTO rem_paises (id,iso,nombre) VALUES(179, 'QA', 'Qatar');
INSERT INTO rem_paises (id,iso,nombre) VALUES(180, 'GB', 'Reino Unido');
INSERT INTO rem_paises (id,iso,nombre) VALUES(181, 'RE', 'Reunión');
INSERT INTO rem_paises (id,iso,nombre) VALUES(182, 'RW', 'Ruanda');
INSERT INTO rem_paises (id,iso,nombre) VALUES(183, 'RO', 'Rumania');
INSERT INTO rem_paises (id,iso,nombre) VALUES(184, 'RU', 'Rusia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(185, 'EH', 'Sahara Occidental');
INSERT INTO rem_paises (id,iso,nombre) VALUES(186, 'SB', 'Islas Salomón');
INSERT INTO rem_paises (id,iso,nombre) VALUES(187, 'WS', 'Samoa');
INSERT INTO rem_paises (id,iso,nombre) VALUES(188, 'AS', 'Samoa Americana');
INSERT INTO rem_paises (id,iso,nombre) VALUES(189, 'KN', 'San Cristóbal y Nevis');
INSERT INTO rem_paises (id,iso,nombre) VALUES(190, 'SM', 'San Marino');
INSERT INTO rem_paises (id,iso,nombre) VALUES(191, 'PM', 'San Pedro y Miquelón');
INSERT INTO rem_paises (id,iso,nombre) VALUES(192, 'VC', 'San Vicente y las Granadinas');
INSERT INTO rem_paises (id,iso,nombre) VALUES(193, 'SH', 'Santa Helena');
INSERT INTO rem_paises (id,iso,nombre) VALUES(194, 'LC', 'Santa Lucía');
INSERT INTO rem_paises (id,iso,nombre) VALUES(195, 'ST', 'Santo Tomé y Príncipe');
INSERT INTO rem_paises (id,iso,nombre) VALUES(196, 'SN', 'Senegal');
INSERT INTO rem_paises (id,iso,nombre) VALUES(197, 'CS', 'Serbia y Montenegro');
INSERT INTO rem_paises (id,iso,nombre) VALUES(198, 'SC', 'Seychelles');
INSERT INTO rem_paises (id,iso,nombre) VALUES(199, 'SL', 'Sierra Leona');
INSERT INTO rem_paises (id,iso,nombre) VALUES(200, 'SG', 'Singapur');
INSERT INTO rem_paises (id,iso,nombre) VALUES(201, 'SY', 'Siria');
INSERT INTO rem_paises (id,iso,nombre) VALUES(202, 'SO', 'Somalia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(203, 'LK', 'Sri Lanka');
INSERT INTO rem_paises (id,iso,nombre) VALUES(204, 'SZ', 'Suazilandia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(205, 'ZA', 'Sudáfrica');
INSERT INTO rem_paises (id,iso,nombre) VALUES(206, 'SD', 'Sudán');
INSERT INTO rem_paises (id,iso,nombre) VALUES(207, 'SE', 'Suecia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(208, 'CH', 'Suiza');
INSERT INTO rem_paises (id,iso,nombre) VALUES(209, 'SR', 'Surinam');
INSERT INTO rem_paises (id,iso,nombre) VALUES(210, 'SJ', 'Svalbard y Jan Mayen');
INSERT INTO rem_paises (id,iso,nombre) VALUES(211, 'TH', 'Tailandia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(212, 'TW', 'Taiwán');
INSERT INTO rem_paises (id,iso,nombre) VALUES(213, 'TZ', 'Tanzania');
INSERT INTO rem_paises (id,iso,nombre) VALUES(214, 'TJ', 'Tayikistán');
INSERT INTO rem_paises (id,iso,nombre) VALUES(215, 'IO', 'Territorio Británico del Océano Índico');
INSERT INTO rem_paises (id,iso,nombre) VALUES(216, 'TF', 'Territorios Australes Franceses');
INSERT INTO rem_paises (id,iso,nombre) VALUES(217, 'TL', 'Timor Oriental');
INSERT INTO rem_paises (id,iso,nombre) VALUES(218, 'TG', 'Togo');
INSERT INTO rem_paises (id,iso,nombre) VALUES(219, 'TK', 'Tokelau');
INSERT INTO rem_paises (id,iso,nombre) VALUES(220, 'TO', 'Tonga');
INSERT INTO rem_paises (id,iso,nombre) VALUES(221, 'TT', 'Trinidad y Tobago');
INSERT INTO rem_paises (id,iso,nombre) VALUES(222, 'TN', 'Túnez');
INSERT INTO rem_paises (id,iso,nombre) VALUES(223, 'TC', 'Islas Turcas y Caicos');
INSERT INTO rem_paises (id,iso,nombre) VALUES(224, 'TM', 'Turkmenistán');
INSERT INTO rem_paises (id,iso,nombre) VALUES(225, 'TR', 'Turquía');
INSERT INTO rem_paises (id,iso,nombre) VALUES(226, 'TV', 'Tuvalu');
INSERT INTO rem_paises (id,iso,nombre) VALUES(227, 'UA', 'Ucrania');
INSERT INTO rem_paises (id,iso,nombre) VALUES(228, 'UG', 'Uganda');
INSERT INTO rem_paises (id,iso,nombre) VALUES(229, 'UY', 'Uruguay');
INSERT INTO rem_paises (id,iso,nombre) VALUES(230, 'UZ', 'Uzbekistán');
INSERT INTO rem_paises (id,iso,nombre) VALUES(231, 'VU', 'Vanuatu');
INSERT INTO rem_paises (id,iso,nombre) VALUES(232, 'VE', 'Venezuela');
INSERT INTO rem_paises (id,iso,nombre) VALUES(233, 'VN', 'Vietnam');
INSERT INTO rem_paises (id,iso,nombre) VALUES(234, 'VG', 'Islas Vírgenes Británicas');
INSERT INTO rem_paises (id,iso,nombre) VALUES(235, 'VI', 'Islas Vírgenes de los Estados Unidos');
INSERT INTO rem_paises (id,iso,nombre) VALUES(236, 'WF', 'Wallis y Futuna');
INSERT INTO rem_paises (id,iso,nombre) VALUES(237, 'YE', 'Yemen');
INSERT INTO rem_paises (id,iso,nombre) VALUES(238, 'DJ', 'Yibuti');
INSERT INTO rem_paises (id,iso,nombre) VALUES(239, 'ZM', 'Zambia');
INSERT INTO rem_paises (id,iso,nombre) VALUES(240, 'ZW', 'Zimbabue');