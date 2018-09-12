
								  <!--//sub-heard-part-->

 <div class="row">


									            	<div class='col-md-6'>
								                            <div class="panel panel-inverse">                       
								                                <div class="panel-heading">
								                                      <h4 class="panel-title">Centro de Costo</h4>
								                                  </div>
								                      <div class="panel-body">
								                        <div class='row'>	


									                  	<form id="basicBootstrapForm" action="<?php echo base_url();?>rrhh/ver_remuneraciones_periodo/<?php echo $idperiodo."/".$idcentrocosto;?>" id="basicBootstrapForm" method="post"> 
									                    <div class="panel-body" >

									                      <div class='row'>
									                          <div class='col-md-6'>
									                            <div class="form-group">
																<select name="centrocosto" id="centrocosto" class="form-control">
																	<option value="0">Todos</option>
																	<?php foreach ($centros_costo as $centro_costo) { ?>
																		<?php $centrocosto_selected = $centro_costo->id_centro_costo == $idcentrocosto ? 'selected' : '';?>
																		<option value="<?php echo $centro_costo->id_centro_costo;?>" <?php echo $centrocosto_selected; ?>><?php echo $centro_costo->nombre;?></option>
																	<?php } ?>
																	
																</select>
									                            </div> 
									                          </div>
									                         
									                      </div>
									                      <div class="row">
									                      	<div class='col-md-3'>
									                      			<button type="submit" class="btn btn-primary">Buscar</button>&nbsp;&nbsp;
									                      	</div>
									                      </div>  
                
									                    </div><!-- /.box-body -->
									                    </form>




									                  </div>
									                </div>
									            </div>
									        </div>

									            </div>


                            <div class="panel panel-inverse">                       
                                <div class="panel-heading">
                                      <h4 class="panel-title">Remuneraciones Per&iacute;odo</h4>
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
												                        <th>Colaborador</th>
												                        <th>Sueldo Base</th>
												                        <th>Haberes</th>
												                        <th>Descuentos</th>
												                        <th>Liquido a Pagar</th>
												                        <th>Aportes Empresa</th>
												                        <th>Liquidaci&oacute;n</th>
												                        
																		</tr> 
																	</thead> 
																	<tbody> 
													                        <?php $i = 1; ?>
												                        <?php foreach ($remuneraciones as $remuneracion) { ?>
												                         <tr >
												                          <td><?php echo $i;?></td>
												                          <td><?php echo $remuneracion->apaterno." ".$remuneracion->amaterno." ".$remuneracion->nombre;?></td>
												                          <td>$&nbsp;<?php echo number_format($remuneracion->sueldobase,0,".",".");?></td>
												                          <td>$&nbsp;<?php echo number_format($remuneracion->totalhaberes,0,".",".");?></td>
												                          <td>$&nbsp;<?php echo number_format($remuneracion->totaldescuentos,0,".",".");?></td>
												                          <td>$&nbsp;<?php echo number_format($remuneracion->sueldoliquido,0,".",".");?></td>
												                          <td>$&nbsp;<?php echo number_format($remuneracion->aportesegcesantia + $remuneracion->seginvalidez + $remuneracion->aportepatronal,0,".",".");?></td>
												                          <td><center><a href="<?php echo base_url(); ?>rrhh/liquidacion/<?php echo $remuneracion->id_remuneracion;?>" target="_blank"><span class="glyphicon glyphicon-paperclip"></span></a></center></td>
												                          
												                        </tr>
												                        <?php $i++; } ?>
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