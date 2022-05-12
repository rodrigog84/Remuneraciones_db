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

									            <div class="row">


									            	<div class='col-md-6'>
								                            <div class="panel panel-inverse">                       
								                                <div class="panel-heading">
								                                      <h4 class="panel-title">Centro de Costo</h4>
								                                  </div>
								                      <div class="panel-body">
								                        <div class='row'>	


									                  	<form id="basicBootstrapForm" action="<?php echo base_url();?>rrhh/detalle/<?php echo $idperiodo;?>" id="basicBootstrapForm" method="post"> 
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
                                      <h4 class="panel-title">Detalle Remuneraciones</h4>
                                  </div>
                      <div class="panel-body">
                        <div class='row'>									            

																<div id="remuneraciones">
																<table class="table" id="detalle_remuneracion"> 
																	<thead> 
																		<tr>
																			<th>#</th>
																			<th>Mes</th> 
																			<th>A&ntilde;o</th> 
													                        <th>N&uacute;mero Colaboradores</th>
													                        <th>Remuneraci&oacute;n Total (L&iacute;quido)</th>
													                        <th>Previred</th>
													                        <th>Libro Remuneraciones</th>
													                        <th>Liquidaciones</th>
													                        <th>Detalle Remuneraciones</th>
													                        <th>Estado</th>
																		</tr> 
																	</thead> 
																	<tbody> 
																	<?php $i = 1; 
											                        $back_button = false;
											                        ?>
											                        <?php // echo "<pre>"; print_r($datosperiodo); exit; ?>
											                        <?php if(count($datosperiodo) > 0){ ?>
											                          <?php foreach ($datosperiodo as $periodo) { ?>

											                            <?php if($idperiodo == $periodo->id_periodo){ 
											                                $class_color = "class = 'success'";
											                                $back_button = true;
											                            }else{
											                                $class_color = "";

											                              }?>                          
											                           <tr <?php echo $class_color; ?> >
											                            <td><?php echo $i;?></td>
											                            <td><?php echo date2string($periodo->mes,$periodo->anno) == 'Saldo Inicial' ? 'Saldo' : month2string($periodo->mes);?></td>
											                            <td><?php echo date2string($periodo->mes,$periodo->anno) == 'Saldo Inicial' ? 'Inicial' : $periodo->anno;?></td>
											                            <td><?php echo number_format($periodo->numtrabajadores,0,".",".");?></td>
											                            <td>$&nbsp;<?php echo number_format($periodo->sueldoliquido,0,".",".");?></td>
											                            	<td>
											                              <center>
											                              	<?php if(!is_null($periodo->cierre)  && $periodo->numtrabajadores > 0){ ?>
											                              <a href="<?php echo base_url(); ?>rrhh/previred/<?php echo $periodo->id_periodo;?>/<?php echo $idcentrocosto;?>" target="_blank"><span class="glyphicon glyphicon-list-alt"></span></a>  
											                              <?php } ?>
											                              </center>
											                              </td>
											                              <td>
											                              <center>
											                              <?php if(!is_null($periodo->cierre)  && $periodo->numtrabajadores > 0){ ?>
											                              <a href="<?php echo base_url(); ?>rrhh/libro/<?php echo $periodo->id_periodo."/".$idcentrocosto;?>" ><span class="glyphicon glyphicon-book"></span></a>  
											                              <?php } ?>
											                              </center>
											                              </td>
											                              <td>
											                              	<center>
											                              		<a href="<?php echo base_url(); ?>rrhh/liquidaciones/<?php echo $periodo->id_periodo."/".$idcentrocosto; ?>" target="_blank"><span class="glyphicon glyphicon-paperclip"></span>
											                              		</center></td>
											                              <td>
											                              <center>
											                              <?php if(!is_null($periodo->cierre) && $periodo->numtrabajadores > 0){ ?>
											                              <a href="<?php echo base_url(); ?>rrhh/ver_remuneraciones_periodo/1/<?php echo $periodo->id_periodo."/".$idcentrocosto; ?>" data-toggle="tooltip" title="Ver Remuneraciones Personal"><span class="glyphicon glyphicon-search"></span></a>
											                              <?php }else{ ?>
											                              		-
											                              <?php } ?>
											                              </center>
											                              </td>

											                          
											                              <td><center><span class="<?php echo is_null($periodo->aprueba) ? 'text-yellow fa fa-exclamation ' : 'text-green fa fa-check';?>" data-toggle="tooltip" title="<?php echo is_null($periodo->aprueba) ? 'En revisi&oacute;n' : 'Aprobada';?>"/></span></center></td>                        
											                          </tr>
											                          <?php $i++; } ?>
											                        <?php }else{ ?>
											                            <tr>
											                              <td colspan="9">No existe historial de remuneraciones en la empresa</td>
											                            </tr>
											                        <?php } ?>
																	</tbody> 
																</table> 
															</div>



</div>

                      </div><!-- /.box-body -->
                      <div class="panel-footer">
                      	<a href="<?php echo base_url(); ?>rrhh/calculo_remuneraciones" class="btn btn-success">Volver</a>
                      </div>

                 
                  </div> 
                  </div>		



												
													</div>
													


											</div>
									<!--/charts-inner-->

<script>
/*	$('#selector').change(function(){
			var baseurl = '<?php echo base_url();?>';
			var id_centro_costo = $(this).val();
			$.get("<?php echo base_url();?>rrhh/get_detalle_rrhh/"+id_centro_costo,function(data){			
			 		console.log(data)
			 		$('#remuneraciones').html(data)


			 });




});*/
</script>


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