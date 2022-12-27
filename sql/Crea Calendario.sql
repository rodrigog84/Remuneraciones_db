-------------------------------------------------------------------------------------
--DISE�O DE LA TABLA CALENDARIO--
--NOMBRE:	rem_calendario--
--CAMPOS:	FECHA, A�O, MES, DIA, NOMBRE_DIA, NUM_DIA_SEMANA, SEMANA, 
--			TRIMESTRE, TIPO_DIA, DIA_TOTAL_MES, NOMBRE_MES, PERIODO, DIAS_FALTANTES--
-------------------------------------------------------------------------------------
/*
--CREACI�N DE TABLA--
CREATE TABLE rem_calendario	(
							FECHA					DATE			--FECHA DEL D�A
							,A�O					INT				--A�O
							,MES					INT				--N�MERO DE MES
							,DIA					INT				--N�MERO DE D�A
							,NOMBRE_DIA				NVARCHAR(10)	--NOMBRE DEL D�A DE LA SEMANA
							,NUM_DIA_SEMANA			INT				--N�MERO DE D�A DE LA SEMANA (EJEM: LUNES 1, MARTES 2....)
							,SEMANA					INT				--N�MERO DE SEMANA DEL A�O
							,TRIMESTRE				INT				--TRIMESTRE DEL A�O
							,TIPO_DIA				NVARCHAR(1)		--H->HABIL, S->SABADO, D->DOMINGO, F->FESTIVO
							,DIA_TOTAL_MES			INT				--D�AS TOTALES DEL MES
							,DIA_HABILES_MES		INT				--D�AS H�BILES TOTALES DEL MES
							,NOMBRE_MES				NVARCHAR(10)	--NOMBRE DEL MES
							,PERIODO				INT				--A�O CONCATENADO CON MES (EJEM: 201510 -> OCUTBRE 2015)
							,NUM_DIA_HABIL			INT				--N�MERO DE D�A H�BIL
							,DIAS_HABILES_CIERRE	INT				--D�AS H�BILES QUE FALTAN EN EL MES
							,CIERRE_SI_NO			NVARCHAR(2)		--SI EL D�A ES O NO CIERRE DE MES
							,SEMANA_MES				INT				--N�MERO DE SEMANA DEL A�O
							) ON [PRIMARY]
--FIN CREACI�N DE TABLA--
------************------

CREATE UNIQUE CLUSTERED INDEX IDX_CALENDARIO_FECHA ON rem_calendario (FECHA)
*/

-------------------------------------------------------------------
--PROCEDIMIENTO PARA LLENAR EL CALENDARIO CON LOS DATOS PRIMARIOS--
-------------------------------------------------------------------
DECLARE
	--@V_DIAS_TOT			INT				--DIAS TOTALES A INSERTAR
	--,@V_DIAS_INSERT		INT				--DIA QUE VA EN EL INSERT
	@V_DIA				INT				--GUARDA EL N�MERO DE D�A DE LA SEMANA
	--,@V_DIA_SEM         INT				--D�A DE LA SEMANA DEL PRIMER D�A A INSERTAR
	,@V_PERIODO         INT				--GUARDA EL PERIODO A INSERTAR
	,@V_FECHA_INI		DATE			--FECHA INICIAL A INSERTAR
	,@V_FECHA_INI_FIJO		DATE		--FECHA INICIAL A INSERTAR (ESTA QUEDA FIJA)
	,@V_FECHA_FIN		DATE			--FECHA FINAL A INSERTAR
	,@V_TIPO_DIA		NVARCHAR(1)		--VARIABLE PARA EL TIPO DE D�A
	,@V_NOMBRE_DIA		NVARCHAR(10)	--NOMBRE DEL D�A


BEGIN
	
	--VARIABLES QUE DEBO LLENAR ANTES DE EJECUTAR--
	SET @V_FECHA_INI	=	'20230101'	--D�A INICIAL A INSERTAR
	SET @V_FECHA_FIN	=	'20231231' --D�A FINAL A INSERTAR
	SET	@V_FECHA_INI_FIJO = @V_FECHA_INI
	--SET @V_DIAS_TOT		= (SELECT  DATEDIFF(DAY,@V_FECHA_INI,@V_FECHA_FIN))	--CUENTA LOS D�AS TOTALES A INSERTAR
	--SET	@V_DIA_SEM		= 1	--COLOCAR EL N�MERO DE D�A DE LA SEMANA DEL D�A INICIAL A INSERTAR
	--SET	@V_DIAS_INSERT	= 1	--EN UNO PARA INSERTAR DESDE EL PRIMER DIA

	WHILE (@V_FECHA_INI <= @V_FECHA_FIN)
    BEGIN    
		
		SET @V_DIA = DATEPART(dW, @V_FECHA_INI)	

		--VEO QUE TIPO DE D�A ESTOY INSERTANDO--
		IF @V_DIA <= 5
			SET @V_TIPO_DIA = 'H'
		ELSE
		BEGIN
			if @V_DIA = 6
					SET @V_TIPO_DIA = 'S'
			ELSE
					SET @V_TIPO_DIA = 'D'
		END

		--VEO QUE NOMBRE DE DIA ES--
		IF @V_DIA = 1
			SET @V_NOMBRE_DIA = 'LUNES'
		ELSE
			IF @V_DIA = 2
				SET @V_NOMBRE_DIA = 'MARTES'
			ELSE
				IF @V_DIA = 3
					SET @V_NOMBRE_DIA = 'MIERCOLES'
				ELSE
					IF @V_DIA = 4
						SET @V_NOMBRE_DIA = 'JUEVES'
					ELSE
						IF @V_DIA = 5
							SET @V_NOMBRE_DIA = 'VIERNES'
						ELSE
							IF @V_DIA = 6
								SET @V_NOMBRE_DIA = 'SABADO'
							ELSE
								SET @V_NOMBRE_DIA = 'DOMINGO'
		
		IF (DATEPART(MM, @V_FECHA_INI) < 10) 
			SET @V_PERIODO = CONCAT(DATEPART(YYYY, @V_FECHA_INI),0,DATEPART(MM, @V_FECHA_INI))
		ELSE
			SET @V_PERIODO = CONCAT(DATEPART(YYYY, @V_FECHA_INI),DATEPART(MM, @V_FECHA_INI))


		--INSERO LO QUE
		INSERT INTO rem_calendario	(
									FECHA					--1.-  FECHA DEL D�A
									,A�O					--2.-  A�O
									,MES					--3.-  N�MERO DE MES
									,DIA					--4.-  N�MERO DE D�A
									,NOMBRE_DIA				--5.-  NOMBRE DEL D�A DE LA SEMANA
									,NUM_DIA_SEMANA			--6.-  N�MERO DE D�A DE LA SEMANA (EJEM: LUNES 1, MARTES 2....)
									,SEMANA					--7.-  N�MERO DE SEMANA DEL A�O
									,TRIMESTRE				--8.-  TRIMESTRE DEL A�O
									,TIPO_DIA				--9.-  H->HABIL, S->SABADO, D->DOMINGO, F->FESTIVO
									,DIA_TOTAL_MES			--10.- D�AS TOTALES DEL MES
									--,DIA_HABILES_MES		--11.- D�AS H�BILES TOTALES DEL MES
									,NOMBRE_MES				--12.- NOMBRE DEL MES
									,PERIODO				--13.- A�O CONCATENADO CON MES (EJEM: 201510 -> OCUTBRE 2015)
									--,NUM_DIA_HABIL			--14.- N�MERO DE D�A H�BIL
									--,DIAS_HABILES_CIERRE	--15.- D�AS H�BILES QUE FALTAN EN EL MES
									,CIERRE_SI_NO			--16
									)
		VALUES  (
				@V_FECHA_INI															--1
				,DATEPART(YYYY, @V_FECHA_INI)											--2
				,DATEPART(MM, @V_FECHA_INI)												--3
				,DATEPART(DD, @V_FECHA_INI)												--4
				,@V_NOMBRE_DIA															--5
				,DATEPART(dW, @V_FECHA_INI)												--6
				,DATEPART(WK, @V_FECHA_INI)												--7
				,DATEPART(QQ, @V_FECHA_INI)												--8
				,@V_TIPO_DIA															--9
				,DATEPART(DD,DATEADD(s,-1,DATEADD(mm, DATEDIFF(m,0,@V_FECHA_INI)+1,0)))	--10
				,DATENAME(month, @V_FECHA_INI)											--12
				,@V_PERIODO																--13
				,'NO'																	--16
				)

		SET @V_DIA = @V_DIA+1;

		--DEJO EL D�A DE LA SEMANA QUE CORRESPONDE PERO SI LLEGO AL 7 VUELVO A 1 (LUNES)
		if @V_DIA < 7
				SET @V_DIA = @V_DIA+1;
		ELSE
				SET @V_DIA = 1;
		
		--SET	@V_DIAS_INSERT	= @V_DIAS_INSERT + 1
		SET	@V_FECHA_INI	= DATEADD(DAY,1,@V_FECHA_INI)
		

	END
END

--FIN LLENADO DE CALENDARIO CON DATOS PRIMARIOS--
------************------


------------
--FERIADOS--
------------


--2023--
UPDATE 	rem_calendario
SET 	TIPO_DIA = 'F'
WHERE 	FECHA in	(
					 '20230101'
					,'20230102'
					,'20230407'
					,'20230408'
					,'20230501'
					,'20230521'
					,'20230621'
					,'20230626'
					,'20230716'
					,'20230815'
					,'20230918'
					,'20230919'
					,'20231009'
					,'20231027'
					,'20231101'
					,'20231208'
					,'20231225'
	--				,'31
					)

/*
--2022--
UPDATE 	rem_calendario
SET 	TIPO_DIA = 'F'
WHERE 	FECHA in	(
					 '20220101'
					,'20220415'
					,'20220416'
					,'20220501'
					,'20220521'
					,'20220621'
					,'20220627'
					,'20220716'
					,'20220815'
					,'20220918'
					,'20220919'
					,'20221010'
					,'20221031'
					,'20221101'
					,'20221208'
					,'20221225'
	--				,'31
					)


--2021--
UPDATE 	rem_calendario
SET 	TIPO_DIA = 'F'
WHERE 	FECHA in	(
					 '20210101'
					,'20210402'
					,'20210403'
					,'20210404'
					,'20210501'
					,'20210521'
					,'20210629'
					,'20210716'
					,'20210815'
					,'20210918'
					,'20210919'
					,'20211012'
					,'20211031'
					,'20211101'
					,'20211208'
					,'20211225'
	--				,'31/12/2021'	--FERIADO BANCARIO
					)

--2020--
UPDATE 	rem_calendario
SET 	TIPO_DIA = 'F'
WHERE 	FECHA in	(
					 '20200101'
					,'20200410'
					,'20200411'
					,'20200412'
					,'20200501'
					,'20200521'
					,'20200607'
					,'20200702'
					,'20200716'
					,'20200815'
					,'20200820'
					,'20200918'
					,'20200919'
					,'20201015'
					,'20201031'
					,'20201101'
					,'20201208'
					,'20201225'
	--				,'31/12/2020'	--FERIADO BANCARIO
					)
*/

--FIN LLENADO DE FERIADOS--
------************------					


----------------
--DIAS HABILES--
----------------
DECLARE
	
	--@V_PERIODO          INT				--GUARDA EL PERIODO A INSERTAR
	--,@V_FECHA_INI		DATE			--FECHA INICIAL A INSERTAR
	--,@V_FECHA_FIN		DATE			--FECHA FINAL A INSERTAR
	@V_HABILES_MES		INT				--PARA GUARDAR EL TOTAL DE HABILES DEL MES
	,@V_NUM_DIA_HABIL	INT				--PARA GUARDAR EN QUE DIA HABIL ESTOY PARADO


BEGIN
	
	--VARIABLES QUE DEBO LLENAR ANTES DE EJECUTAR--
--	SET @V_FECHA_INI	=	CONVERT(DATE,'01/01/2015')	--D�A INICIAL A INSERTAR
--	SET @V_FECHA_FIN	=	CONVERT(DATE,'31/12/2022')	--D�A FINAL A INSERTAR
	SET	@V_FECHA_INI = @V_FECHA_INI_FIJO
	--WHILE (@V_DIAS_INSERT <= @V_DIAS_TOT)
    WHILE (@V_FECHA_INI <= @V_FECHA_FIN)
    BEGIN
		
		IF (DATEPART(MM, @V_FECHA_INI) < 10) 
			SET @V_PERIODO = CONCAT(DATEPART(YYYY, @V_FECHA_INI),0,DATEPART(MM, @V_FECHA_INI))
		ELSE
			SET @V_PERIODO = CONCAT(DATEPART(YYYY, @V_FECHA_INI),DATEPART(MM, @V_FECHA_INI))    
		
		--TRAIGO LOS DIAS HABILES DEL MES Y SU DIA HABIL

		SET @V_HABILES_MES	 =	(
								SELECT	COUNT(*) DIAS_HABILES_MES
								FROM	rem_calendario
								WHERE	TIPO_DIA = 'H'
								AND		PERIODO = @V_PERIODO
								)
		
		SET @V_NUM_DIA_HABIL =	(
								SELECT	COUNT(*) NUM_DIA_HABIL
								FROM	rem_calendario	DIA
								WHERE	TIPO_DIA = 'H'
								AND		FECHA <= @V_FECHA_INI
								AND		PERIODO = @V_PERIODO
								)

		UPDATE	rem_calendario
		SET		DIA_HABILES_MES			= @V_HABILES_MES
				,NUM_DIA_HABIL			= @V_NUM_DIA_HABIL
				,DIAS_HABILES_CIERRE	= (@V_HABILES_MES - @V_NUM_DIA_HABIL)
		WHERE	FECHA	= @V_FECHA_INI
		AND		PERIODO = @V_PERIODO

		SET	@V_FECHA_INI	= DATEADD(DAY,1,@V_FECHA_INI)
	
	END
END
--FIN LLENADO DE DIAS HABILES--
------************------

SET	@V_FECHA_INI = @V_FECHA_INI_FIJO
----------------------------
--NUMERO DE SEMANA DEL MES--
----------------------------
UPDATE	CAL
SET		CAL.SEMANA_MES = CAL.SEMANA-(MIN_SEMANA.MIN_SEMANA-1)
FROM	rem_calendario	CAL
		,(
		SELECT	MIN(SEMANA)	MIN_SEMANA
				,MES
				,A�O
		FROM	rem_calendario
		GROUP BY MES
				,A�O
		)MIN_SEMANA
WHERE	CAL.MES = MIN_SEMANA.MES
AND		CAL.A�O = MIN_SEMANA.A�O
AND		CAL.FECHA BETWEEN @V_FECHA_INI AND @V_FECHA_FIN

	
-----------------------------------
--SI EL DIA ES O NO CIERRE DE MES--
-----------------------------------
UPDATE	CAL
SET		CAL.CIERRE_SI_NO = 'SI'
FROM	(
		SELECT	MAX(FECHA) FECHA
				,PERIODO
		FROM	rem_calendario
		WHERE	TIPO_DIA = 'H'
		GROUP BY PERIODO
		)ULT
		,rem_calendario	CAL
WHERE	CAL.FECHA	= ULT.FECHA
AND		CAL.PERIODO = ULT.PERIODO
AND		CAL.FECHA BETWEEN @V_FECHA_INI AND @V_FECHA_FIN



-----------------------------------
--ACTUALIZA MESES AL ESPA�OL--
-----------------------------------


update		r
set			NOMBRE_MES = 'Enero'
--SELECT		*
FROM		rem_calendario r
WHERE		NOMBRE_MES = 'January'

update		r
set			NOMBRE_MES = 'Febrero'
--SELECT		*
FROM		rem_calendario r
WHERE		NOMBRE_MES = 'February'

update		r
set			NOMBRE_MES = 'Marzo'
--SELECT		*
FROM		rem_calendario r
WHERE		NOMBRE_MES = 'March'

update		r
set			NOMBRE_MES = 'Abril'
--SELECT		*
FROM		rem_calendario r
WHERE		NOMBRE_MES = 'April'

update		r
set			NOMBRE_MES = 'Mayo'
--SELECT		*
FROM		rem_calendario r
WHERE		NOMBRE_MES = 'May'

update		r
set			NOMBRE_MES = 'Junio'
--SELECT		*
FROM		rem_calendario r
WHERE		NOMBRE_MES = 'June'

update		r
set			NOMBRE_MES = 'Julio'
--SELECT		*
FROM		rem_calendario r
WHERE		NOMBRE_MES = 'July'

update		r
set			NOMBRE_MES = 'Agosto'
--SELECT		*
FROM		rem_calendario r
WHERE		NOMBRE_MES = 'August'

update		r
set			NOMBRE_MES = 'Septiembre'
--SELECT		*
FROM		rem_calendario r
WHERE		NOMBRE_MES = 'September'

update		r
set			NOMBRE_MES = 'Octubre'
--SELECT		*
FROM		rem_calendario r
WHERE		NOMBRE_MES = 'October'

update		r
set			NOMBRE_MES = 'Noviembre'
--SELECT		*
FROM		rem_calendario r
WHERE		NOMBRE_MES = 'November'

update		r
set			NOMBRE_MES = 'Diciembre'
--SELECT		*
FROM		rem_calendario r
WHERE		NOMBRE_MES = 'December'