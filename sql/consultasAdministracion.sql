# EL RUT DE LA EMPRESA ES EL PARAMETRO DE ENTRADA


#PLAN DE CUENTAS
SELECT 	
			p1.id AS idn1
			,p1.codigo AS codigon1
			,c1.nombre AS nombren1
			,p2.id	AS idn2
			,p2.codigo AS codigon2
			,c2.nombre AS nombren2
			,p3.id 	AS idn3
			,p3.codigo AS codigon3
			,c3.nombre AS nombren3
			,p.id AS idn4
			,p.codigo AS codigon4
			,c.nombre AS nombren4
			,p.centro_costo
			,p.item_ingreso
			,p.item_gasto
			,p.cuenta_corriente
			,p.referencia
FROM 		plan_cuentas p
INNER JOIN cuentas c ON p.id_cuenta = c.id
INNER JOIN empresas e ON p.id_empresa = e.id
INNER JOIN 	plan_cuentas p3 ON p.id_padre = p3.id
INNER JOIN 	cuentas c3 ON p3.id_cuenta = c3.id
INNER JOIN 	plan_cuentas p2 ON p3.id_padre = p2.id
INNER JOIN 	cuentas c2 ON p2.id_cuenta = c2.id	
INNER JOIN 	plan_cuentas p1 ON p2.id_padre = p1.id
INNER JOIN 	cuentas c1 ON p1.id_cuenta = c1.id
WHERE e.rut = 90380000
AND 	p.nivel = 4
AND 	p.activo = 1
ORDER BY 	p1.codigo
				,p2.codigo
				,p3.codigo
				,p.codigo;



#CENTROS DE COSTO
SELECT 	cc.id
			,cc.codigo
			,cc.nombre
#SELECT 	*
FROM 		centro_costo cc
INNER JOIN empresas e ON cc.id_empresa = e.id
WHERE e.rut = 90380000
AND 		cc.activo = 1
ORDER BY cc.codigo


#ITEM INGRESO
SELECT 	ii.id
			,ii.codigo
			,ii.nombre
#SELECT 	*
FROM 		item_ingreso ii
INNER JOIN empresas e ON ii.id_empresa = e.id
WHERE e.rut = 90380000
AND 		ii.activo = 1
ORDER BY ii.codigo


#ITEM GASTO
SELECT 	ig.id
			,ig.codigo
			,ig.nombre
#SELECT 	*
FROM 		item_gasto ig
INNER JOIN empresas e ON ig.id_empresa = e.id
WHERE e.rut = 90380000
AND 		ig.activo = 1
ORDER BY ig.codigo



# CUENTAS CORRIENTES
SELECT 	cc.id
			,cc.rut
			,cc.dv
			,cc.nombre
			,cc.tipocuenta
#SELECT 	*
FROM 		cuenta_corriente cc
INNER JOIN empresas e ON cc.idempresa = e.id
WHERE e.rut = 90380000
AND 		cc.activo = 1
ORDER BY cc.nombre






