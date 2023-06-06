--- SUELDO MINIMO
--- FUENTE: Calcular.cl
INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Sueldo Minimo' as nombre
			,326500 as valor
			,fecha
from		rem_calendario
where		FECHA BETWEEN '20210101' AND '20210430'


INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Sueldo Minimo' as nombre
			,337000 as valor
			,fecha
from		rem_calendario
where		FECHA BETWEEN '20210501' AND '20211231'




INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Sueldo Minimo' as nombre
			,350000 as valor
			,fecha
from		rem_calendario
where		FECHA BETWEEN '20220101' AND '20220430'


-- SIS
-- FUENTE: https://www.previred.com/web/previred/indicadores-previsionales

INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tasa SIS' as nombre
			,2.3 as valor
			,fecha
from		rem_calendario
where		FECHA BETWEEN '20210101' AND '20210331'



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tasa SIS' as nombre
			,1.94 as valor
			,fecha
from		rem_calendario
where		FECHA BETWEEN '20210401' AND '20210630'





INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tasa SIS' as nombre
			,1.94 as valor
			,fecha
from		rem_calendario
where		FECHA BETWEEN '20210401' AND '20210630'




INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tasa SIS' as nombre
			,2.21 as valor
			,fecha
from		rem_calendario
where		FECHA BETWEEN '20210701' AND '20210930'



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tasa SIS' as nombre
			,1.85 as valor
			,fecha
from		rem_calendario
where		FECHA BETWEEN '20211001' AND '20220430'



-- Tope Imponible AFP
-- FUENTE: https://www.previred.com/web/previred/indicadores-previsionales



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFP' as nombre
			,81.7 as valor
			,fecha
from		rem_calendario
where		FECHA BETWEEN '20210101' AND '20210131'




INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFP' as nombre
			,81.6 as valor
			,fecha
from		rem_calendario
where		FECHA BETWEEN '20210201' AND '20220430'





-- Tope Imponible AFC
-- FUENTE: https://www.previred.com/web/previred/indicadores-previsionales



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFC' as nombre
			,122.7 as valor
			,fecha
from		rem_calendario
where		FECHA BETWEEN '20210101' AND '20210131'




INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFC' as nombre
			,122.6 as valor
			,fecha
from		rem_calendario
where		FECHA BETWEEN '20210201' AND '20220430'


-- Tope Imponible IPS
-- FUENTE: https://www.previred.com/web/previred/indicadores-previsionales




INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible IPS' as nombre
			,60 as valor
			,fecha
from		rem_calendario
where		FECHA BETWEEN '20210101' AND '20220430'




INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFP' as nombre
			,81.6 as valor
			,fecha
from		rem_calendario
where		periodo = 202206



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible IPS' as nombre
			,60 as valor
			,fecha
from		rem_calendario
where		periodo = 202206


INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFC' as nombre
			,122.6 as valor
			,fecha
from		rem_calendario
where		periodo = 202206



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tasa SIS' as nombre
			,1.86 as valor
			,fecha
from		rem_calendario
where		periodo = 202206



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Sueldo Minimo' as nombre
			,350000 as valor
			,fecha
from		rem_calendario
where		periodo = 202206





INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFC' as nombre
			,122.6 as valor
			,fecha
from		rem_calendario
where		periodo = 202207



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tasa SIS' as nombre
			,1.86 as valor
			,fecha
from		rem_calendario
where		periodo = 202207



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible IPS' as nombre
			,60 as valor
			,fecha
from		rem_calendario
where		periodo = 202207



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Sueldo Minimo' as nombre
			,380000 as valor
			,fecha
from		rem_calendario
where		periodo = 202207




INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFP' as nombre
			,81.6 as valor
			,fecha
from		rem_calendario
where		periodo = 202207



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFC' as nombre
			,122.6 as valor
			,fecha
from		rem_calendario
where		periodo = 202208

update p
set			valor = 1.84
---select		*
from		rem_parametros p
where		nombre = 'Tasa SIS'
and			fecha between '20220701' and '20220731'



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tasa SIS' as nombre
			,1.84 as valor
			,fecha
from		rem_calendario
where		periodo = 202208



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible IPS' as nombre
			,60 as valor
			,fecha
from		rem_calendario
where		periodo = 202208




INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Sueldo Minimo' as nombre
			,380000 as valor
			,fecha
from		rem_calendario
where		periodo = 202208


INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFP' as nombre
			,81.6 as valor
			,fecha
from		rem_calendario
where		periodo = 202208





INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tasa SIS' as nombre
			,1.84 as valor
			,fecha
from		rem_calendario
where		periodo = 202209


INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tasa SIS' as nombre
			,1.84 as valor
			,fecha
from		rem_calendario
where		periodo = 202210




update	p
set			p.valor = 400000
--select	*
from	rem_parametros p
inner join rem_calendario c on p.fecha = c.FECHA
where	c.PERIODO = 202208
and		p.nombre = 'Sueldo Minimo'

INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Sueldo Minimo' as nombre
			,400000 as valor
			,fecha
from		rem_calendario
where		periodo = 202209



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Sueldo Minimo' as nombre
			,400000 as valor
			,fecha
from		rem_calendario
where		periodo = 202210





INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFC' as nombre
			,122.6 as valor
			,fecha
from		rem_calendario
where		periodo = 202209




INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFC' as nombre
			,122.6 as valor
			,fecha
from		rem_calendario
where		periodo = 202210



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Sueldo Minimo' as nombre
			,400000 as valor
			,fecha
from		rem_calendario
where		periodo = 202211




INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFP' as nombre
			,81.6 as valor
			,fecha
from		rem_calendario
where		periodo = 202211



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible IPS' as nombre
			,60 as valor
			,fecha
from		rem_calendario
where		periodo = 202211



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFC' as nombre
			,122.6 as valor
			,fecha
from		rem_calendario
where		periodo = 202211




INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tasa SIS' as nombre
			,1.54 as valor
			,fecha
from		rem_calendario
where		periodo = 202210



update p
set		valor = 1.54
--select	*
from	rem_parametros p
where	nombre = 'Tasa SIS'
and		fecha >= '20221001'


INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tasa SIS' as nombre
			,1.54 as valor
			,fecha
from		rem_calendario
where		periodo = 202211




INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Sueldo Minimo' as nombre
			,400000 as valor
			,fecha
from		rem_calendario
where		periodo = 202212




INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFP' as nombre
			,81.6 as valor
			,fecha
from		rem_calendario
where		periodo = 202212





INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible IPS' as nombre
			,60 as valor
			,fecha
from		rem_calendario
where		periodo = 202212




INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFC' as nombre
			,122.6 as valor
			,fecha
from		rem_calendario
where		periodo = 202212





INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tasa SIS' as nombre
			,1.54 as valor
			,fecha
from		rem_calendario
where		periodo = 202212




INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Sueldo Minimo' as nombre
			,410000 as valor
			,fecha
from		rem_calendario
where		periodo = 202301


INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Sueldo Minimo' as nombre
			,410000 as valor
			,fecha
from		rem_calendario
where		periodo = 202302




INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFP' as nombre
			,81.6 as valor
			,fecha
from		rem_calendario
where		periodo = 202301




INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFP' as nombre
			,81.6 as valor
			,fecha
from		rem_calendario
where		periodo = 202302



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible IPS' as nombre
			,60 as valor
			,fecha
from		rem_calendario
where		periodo = 202301





INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible IPS' as nombre
			,60 as valor
			,fecha
from		rem_calendario
where		periodo = 202302


INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFC' as nombre
			,122.6 as valor
			,fecha
from		rem_calendario
where		periodo = 202301



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFC' as nombre
			,122.6 as valor
			,fecha
from		rem_calendario
where		periodo = 202302



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tasa SIS' as nombre
			,1.55 as valor
			,fecha
from		rem_calendario
where		periodo = 202301



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tasa SIS' as nombre
			,1.55 as valor
			,fecha
from		rem_calendario
where		periodo = 202302




INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Sueldo Minimo' as nombre
			,410000 as valor
			,fecha
from		rem_calendario
where		periodo = 202303




INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Sueldo Minimo' as nombre
			,410000 as valor
			,fecha
from		rem_calendario
where		periodo = 202304





INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFP' as nombre
			,81.6 as valor
			,fecha
from		rem_calendario
where		periodo = 202303




INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFP' as nombre
			,81.6 as valor
			,fecha
from		rem_calendario
where		periodo = 202304





INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible IPS' as nombre
			,60 as valor
			,fecha
from		rem_calendario
where		periodo = 202303





INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible IPS' as nombre
			,60 as valor
			,fecha
from		rem_calendario
where		periodo = 202304



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFC' as nombre
			,122.6 as valor
			,fecha
from		rem_calendario
where		periodo = 202303



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tope Imponible AFC' as nombre
			,122.6 as valor
			,fecha
from		rem_calendario
where		periodo = 202304





INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tasa SIS' as nombre
			,1.55 as valor
			,fecha
from		rem_calendario
where		periodo = 202303



INSERT INTO rem_parametros (
			nombre
			,valor
			,fecha
			)

select		'Tasa SIS' as nombre
			,1.55 as valor
			,fecha
from		rem_calendario
where		periodo = 202304



#Para Cotizaciones a Pagar en Abril 2023 (Remuneraciones Marzo 2023).
#Donde dice "Remuneraciones Marzo 2023", se debe considerar ese periodo
# es decir que para pagar en abril se tomaran los indicadores de marzo


update		r
set			valor = 1.61
--select		*
from		rem_parametros r
where		nombre = 'Tasa SIS'
and			fecha >= '20230401'



update	r
set		valor = 440000
--select	*
from	rem_parametros r
where	nombre = 'Sueldo Minimo'
AND		FECHA IN (
select FECHA
from rem_calendario
where periodo = 202305
)


update	r
set		valor = 440000
--select	*
from	rem_parametros r
where	nombre = 'Sueldo Minimo'
AND		FECHA IN (
select FECHA
from rem_calendario
where periodo = 202306
)