
				


                            <div class="panel panel-inverse">                       
                                <div class="panel-heading">
                                      <h4 class="panel-title">Planillas Imposiciones</h4>
                                  </div>
                      <div class="panel-body">
                        <div class='row'>

								  <!--//sub-heard-part-->

									<div class="graph-visual tables-main">
											
									        <?php if(isset($message)): ?>
									         <div class="row">
									            <div class="col-md-12">
									                      <div class="alert alert-<?php echo $classmessage; ?> alert-dismissable">
									                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									                        <h4><i class="icon fa <?php echo $icon;?>"></i> Alerta!</h4>
									                        <?php echo $message;?>
									                      </div>
									            </div>            
									          </div>
									          <?php endif; ?>

											
														  <div class="graph">

														  	
															<div class="tables">
																<table class="table" id="detalle_remuneracion"> 
																	<thead> 
																		<tr>
												                        <th>#</th>
												                        <th>Tipo</th>
												                        <th>Instituci&oacute;n</th>
												                        <th>Cantidad Colaboradores</th>
												                        <th><center>Descargar</center></th>
																		</tr> 
																	</thead> 
																	<tbody> 
													                        <?php $i = 1; ?>
												                        <?php foreach ($isapres_planillas as $isapre) { ?>
												                         <tr >
												                          <td><?php echo $i;?></td>
												                          <td>Isapre</td>
												                          <td><?php echo $isapre->nombre;?></td>   
												                          <td><?php echo $isapre->cantidad;?></td>        
												                          <td><center><a href="<?php echo base_url(); ?>rrhh/planilla_imposiciones/isapre" target="_blank"><span class="glyphicon glyphicon-book"></span></a></center></td>
												                          
												                        </tr>
												                        <?php $i++;?>
												                        <?php } ?>
												                         <?php foreach ($afps_planillas as $afp) { ?>
												                         <tr >
												                          <td><?php echo $i;?></td>
												                          <td>Afp</td>
												                          <td><?php echo $afp->nombre;?></td>   
												                          <td><?php echo $afp->cantidad;?></td>              
												                          <td><center><a href="<?php echo base_url(); ?>rrhh/planilla_imposiciones/afp" target="_blank"><span class="glyphicon glyphicon-book"></span></a></center></td>
												                          
												                        </tr>
												                        <?php $i++;?>
												                        <?php } ?>


												                          <?php foreach ($caja_planillas as $caja) { ?>
												                         <tr >
												                          <td><?php echo $i;?></td>
												                          <td>Caja</td>
												                          <td><?php echo $caja->nombre;?></td> 
												                          <td><?php echo $caja->cantidad;?></td>                
												                          <td><center><a href="<?php echo base_url(); ?>rrhh/planilla_imposiciones/afp" target="_blank"><span class="glyphicon glyphicon-book"></span></a></center></td>
												                          
												                        </tr>
												                        <?php $i++;?>
												                        <?php } ?>


												                        <?php foreach ($mutual_planillas as $mutual) { ?>
												                         <tr >
												                          <td><?php echo $i;?></td>
												                          <td>Mutual</td>
												                          <td><?php echo $mutual->nombre;?></td>   
												                          <td><?php echo $mutual->cantidad;?></td>              
												                          <td><center><a href="<?php echo base_url(); ?>rrhh/planilla_imposiciones/afp" target="_blank"><span class="glyphicon glyphicon-book"></span></a></center></td>
												                          
												                        </tr>
												                        <?php $i++;?>
												                        <?php } ?>
												                        
																	</tbody> 
																</table> 
																
															</div>
												
													</div>
													
											</div>


</div>

                      </div><!-- /.box-body -->
                      <div class="panel-footer">
                      	<a href="<?php echo base_url(); ?>rrhh/detalle/<?php echo $idperiodo."/".$idcentrocosto;?>" class="btn btn-success">Volver</a>
                      </div>

                 
                  </div> 
                  </div>											
									<!--/charts-inner-->


<script>
        $('#detalle_remuneracion').dataTable({
            responsive: true,
            //dom: 'Bfrtip',
            //buttons: [{ extend: 'excelHtml5', className: 'btn-sm', text: 'Exportar a Excel'}],
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": true,
            "bSort": false,
            "bAutoWidth": false,
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

</script>        