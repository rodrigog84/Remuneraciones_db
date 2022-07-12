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