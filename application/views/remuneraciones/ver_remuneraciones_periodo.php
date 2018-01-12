<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   <ol class="breadcrumb m-b-0">
											<li><a href="<?php echo base_url();?>main/dashboard">Inicio</a></li>
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
												                        <th>Trabajador</th>
												                        <th>Sueldo Base</th>
												                        <th>Haberes</th>
												                        <th>Descuentos</th>
												                        <th>Liquido a Pagar</th>
												                        <th>Liquidaci&oacute;n</th>
												                        
																		</tr> 
																	</thead> 
																	<tbody> 
													                        <?php $i = 1; ?>
												                        <?php foreach ($remuneraciones as $remuneracion) { ?>
												                         <tr >
												                          <td><?php echo $i;?></td>
												                          <td><?php echo $remuneracion->nombre." ".$remuneracion->apaterno." ".$remuneracion->amaterno;?></td>
												                          <td>$&nbsp;<?php echo number_format($remuneracion->sueldobase,0,".",".");?></td>
												                          <td>$&nbsp;<?php echo number_format($remuneracion->totalhaberes,0,".",".");?></td>
												                          <td>$&nbsp;<?php echo number_format($remuneracion->totaldescuentos,0,".",".");?></td>
												                          <td>$&nbsp;<?php echo number_format($remuneracion->sueldoliquido,0,".",".");?></td>
												                          <td><center><a href="<?php echo base_url(); ?>rrhh/liquidacion/<?php echo $remuneracion->id_remuneracion;?>" target="_blank"><span class="glyphicon glyphicon-paperclip"></span></a></center></td>
												                          
												                        </tr>
												                        <?php $i++; } ?>
																	</tbody> 
																</table> 
																
															</div>
												
													</div>
													
											</div>
									<!--/charts-inner-->

