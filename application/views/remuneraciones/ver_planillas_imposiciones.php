
				


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
												                        <th><center>Descargar</center></th>
																		</tr> 
																	</thead> 
																	<tbody> 
													                        <?php $i = 1; ?>
												                        
												                         <tr >
												                          <td>1</td>
												                          <td>ISAPRE</td>
												                          <td>Colmena</td>         
												                          <td><center><a href="<?php echo base_url(); ?>rrhh/liquidacion/" target="_blank"><span class="glyphicon glyphicon-book"></span></a></center></td>
												                          
												                        </tr>

												                        <tr >
												                          <td>2</td>
												                          <td>ISAPRE</td>
												                          <td>Nueva M&aacute;s Vida</td>         
												                          <td><center><a href="<?php echo base_url(); ?>rrhh/liquidacion/" target="_blank"><span class="glyphicon glyphicon-book"></span></a></center></td>
												                          
												                        </tr>
												                        <tr >
												                          <td>3</td>
												                          <td>Fonasa</td>
												                          <td>Fonasa</td>         
												                          <td><center><a href="<?php echo base_url(); ?>rrhh/liquidacion/" target="_blank"><span class="glyphicon glyphicon-book"></span></a></center></td>
												                          
												                        </tr>
												                         <tr >
												                          <td>4</td>
												                          <td>Mutual</td>
												                          <td>ACHS</td>         
												                          <td><center><a href="<?php echo base_url(); ?>rrhh/liquidacion/" target="_blank"><span class="glyphicon glyphicon-book"></span></a></center></td>
												                          
												                        </tr>

												                         <tr >
												                          <td>5</td>
												                          <td>Caja</td>
												                          <td>Caja Los Andes</td>         
												                          <td><center><a href="<?php echo base_url(); ?>rrhh/liquidacion/" target="_blank"><span class="glyphicon glyphicon-book"></span></a></center></td>
												                          
												                        </tr>

												                         <tr >
												                          <td>6</td>
												                          <td>AFP</td>
												                          <td>Habitat</td>         
												                          <td><center><a href="<?php echo base_url(); ?>rrhh/liquidacion/" target="_blank"><span class="glyphicon glyphicon-book"></span></a></center></td>
												                          
												                        </tr>
												                        
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