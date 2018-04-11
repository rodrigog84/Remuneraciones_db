/<!--sub-heard-part-->
								  <!--//sub-heard-part-->
								
									<div class="graph-visual tables-main">
											
													<a href="<?php echo base_url();?>configuraciones/add_centro_costo" type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Centro de Costo</a>
													<h3 class="inner-tittle two">Descripción</h3>
														  <div class="graph">														  	
															<div class="tables">
																<table id="listado" class="table"> 
																	<thead> 
																		<tr>
																			<th>#</th>
                												<th>C&oacute;digo</th>
                												<th>Nombre</th>
                                        <th>Opciones</th>
																		</tr> 
																	</thead> 
																	<tbody> 
	                            			<?php $i = 1; ?>
	                            			<?php foreach ($centro_costo as $centro_costo) { ?>
																		<tr class="active" id="variable">
											              <td><small><?php echo $i ;?></small></td>
	                              		<td><small><?php echo $centro_costo->codigo;?></small>
	                              		<td><small><?php echo $centro_costo->nombre;?></small></td>
                                    <td>
                                    <a href="<?php echo base_url();?>configuraciones/add_centro_costo/<?php echo $centro_costo->id_centro_costo?>" class="btn btn-info opciones" id="opciones" title="Ediar Centro de Costo"><i class="fa fa-pencil-square-o" aria-hidden="true" role="button"></i></a>
                                    </td>
                                    </tr> 									                            <?php $i++;?>						                            <?php } ?>																		
																	</tbody> 
																</table> 
															</div>												
													</div>
											</div>

<script>


$(function () {
        $('#listado').dataTable({
          "bLengthChange": true,
          "bFilter": true,
          "bInfo": true,
          "bSort": false,
          "bAutoWidth": false,
          "aLengthMenu" : [[5,10,15,30,45,100,-1],[5,10,15,30,45,100,'Todos']],
          "iDisplayLength": 10,
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
<script>

    $(document).ready(function() {
        <?php if(isset($message)){ ?>

        $.gritter.add({
            title: 'Atención',
            text: '<?php echo $message;?>',
            sticky: false,
            image: '<?php echo base_url();?>images/logos/<?php echo $classmessage == 'success' ? 'check_ok_accept_apply_1582.png' : 'alert-icon.png';?>',
            time: 5000,
            class_name: 'my-sticky-class'
        });
        /*setTimeout(redirige, 1500);
        function redirige(){
            location.href = '<?php //echo base_url();?>welcome/dashboard';
        }*/
        <?php } ?>


    });
</script>   

