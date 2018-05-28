<div class="container">

	<a class="btn btn-primary" href="<?php echo base_url();?>auxiliares/add_licencias"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Licencia</a>

	<div class="graph">
		<div class="tables">
			<table id="tabla_licencias" class="table"> 
				<thead class="thead-inverse"> 
					<tr>
						<th scope="col">#</th>
	                    <th scope="col">Nombre Colaborador</th>
	                    <th scope="col">Rut</th>
	                    <th scope="col">Numero Licencia</th>
	                    <th scope="col">Fecha Licencia</th>
	                    <th scope="col">Estado</th>
					</tr> 
				</thead>
				<tbody>
					<?php if(count($licencia) > 0 ){ ?>
	                    <?php $i = 1; ?>
	                        <?php foreach ($licencia as $licencias) { ?>				
								<tr class="active" id="variable">
									<td><small><?php echo $i ;?></small></td>
	                              	<td><small><?php echo $licencias->apaterno." ".$licencias->amaterno." ".$licencias->nombre;?></small></td>
	                                <td><small><?php echo $licencias->rut;?></small></td>
	                              	<td><small><?php echo $licencias->numero_licencia;?></small></td>
	                              	<td><small><?php echo $licencias->fec_emision_licencia;?></small></td>
	                              	<td><small><?php if ($licencias->estado == 'I'){
	                              			echo 'INGRESADA';
	                              	}elseif($licencias->estado == 'A'){
	                              			echo 'APROBADA';
	                              	}?></small></td>
								</tr> 
							<?php $i++;?>
						<?php } ?>
                     <?php } ?>	



				</tbody>
			</table>
		</div>
	</div>


</div>



<script>


$(function () {
        $('#tabla_licencias').dataTable({
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