<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   <ol class="breadcrumb m-b-0">
											<li><a href="inicio.html">Inicio</a></li>
											<li class="active">Calculo Remuneraciones</li>
											
										</ol>
									   </div>
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
																<table class="table"> 
																	<thead> 
																		<tr>
																			<th>#</th>
																			<th>Per&iacute;odo</th> 
																			<th>Estado</th> 
																			<th>Acci&oacute;n</th> 
																			<th>Ver Detalle Remunraciones</th> 
																			<th>Validar</th> 
																			

																		</tr> 
																	</thead> 
																	<tbody> 
														
																		<tr class="active" id="variable">
																			<td>1</td>
																			<td>Diciembre 2017</td> 
																			<td>Informaci&oacute;n Completa</td>
																			<td><a href="<?php echo base_url(); ?>rrhh/submit_calculo_remuneraciones/34" data-toggle="tooltip" title="Calculo Remuneraciones" class="btn btn-block btn-xs btn-primary">Calcular</a></td>
																			
																			<td>&nbsp;</td> 
																			<td>&nbsp;</td> 
																		</tr> 
																	</tbody> 
																</table> 
																
															</div>
												
													</div>
													
											</div>
									<!--/charts-inner-->

