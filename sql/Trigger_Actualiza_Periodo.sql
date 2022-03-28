CREATE TRIGGER dbo.actualiza_periodo ON dbo.rem_periodo AFTER INSERT, UPDATE
AS BEGIN

update		r
set			periodo = cast(cast(anno as varchar) +
					case when mes < 10 then '0'+cast(mes as varchar)
						 else cast(mes as varchar)
					end as int)
--select		*
FROM		rem_periodo r
WHERE		periodo is null


END
