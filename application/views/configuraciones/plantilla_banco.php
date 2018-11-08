<div class="container">

	<a class="btn btn-primary" href="<?php echo base_url();?>configuraciones/add_plantilla"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Plantilla</a>

	<div class="graph">
		<div class="tables">
			<table id="tabla_plantillas" class="table"> 
				<thead class="thead-inverse"> 
					<tr>
						<th scope="col">#</th>
	                    <th scope="col">Plantilla Banco</th>
	                    <th scope="col">Banco</th>
	                    <th scope="col">Estado</th>
	                    <th scope="col">Opciones</th>
					</tr> 
				</thead>
				<tbody>
					<?php if(count($plantillas_bancos) > 0){ ?>	
						<?php $i = 1; ?>	
						<?php foreach($plantillas_bancos as $plantillas){ ?>
						<tr class="active" id="variable">	
							<td><?php echo $i; ?></td>
							<td><?php echo $plantillas->descripcion; ?></td>
							<td><?php echo $plantillas->nombre; ?></td>
							<td><?php echo $plantillas->active; ?></td>
							
							<td>
								<a href="<?php echo base_url();?>configuraciones/mod_plantilla/<?php echo $plantillas->id_plantilla_banco ?>" class="btn btn-info btn-xs opciones" id="opciones" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true" role="button"></i></a>
	        																		
								<a href="<?php echo base_url();?>configuraciones/exporta_plantilla/<?php echo $plantillas->id_plantilla_banco ?>" class="btn btn-success btn-xs" id="Exportar_excel" title="Exportar"><i class="glyphicon glyphicon-save-file" aria-hidden="true" type="button"></i></a>
								
								<a href="<?php echo base_url();?>configuraciones/del_plantilla/<?php echo $plantillas->id_plantilla_banco ?>" class="btn btn-danger btn-xs" id="Desactivar" title="Activar/Desactivar"><i class="fa fa-times" aria-hidden="true" type="button"></i></a>
        					</td>

						</tr>
						<?php $i++ ?>
					<?php }; ?>
					<?php }; ?>





				</tbody>
			</table>
		</div>
	</div>


</div>



<script>


$(function () {
        $('#tabla_plantillas').dataTable({
          "bLengthChange": true,
          "bFilter": true,
          "bInfo": true,
          "bSort": false,
          "bAutoWidth": false,
          "aLengthMenu" : [[5,15,30,45,100,-1],[5,15,30,45,100,'Todos']],
          "iDisplayLength": 5,
          "oLanguage": {
              "sLengthMenu": "_MENU_ Registros por p&aacute;gina",
              "sZeroRecords": "No se encontraron registros",
              "sInfo": "Mostrando del _START_ al _END_ de _TOTAL_ registros",
              "sInfoEmpty": "Mostrando 0 de 0 registros",
              "sInfoFiltered": "(filtrado de _MAX_ registros totales)",
              "sSearch":        "Buscar:",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":    "Último",
                "sNext":    "Siguiente",
                "sPrevious": "Anterior"
            }              
          }          
        });
      });


</script>	