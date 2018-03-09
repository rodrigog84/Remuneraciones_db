
<div class="sub-heard-part">
		<td>
		<font color="Green" face="arial">
			<h3 align="left"><i>Nombre : <?php echo $rut;?> Rut : <?php echo $rut;?></i></h3>
		</font>
			<h3 class="inner-tittle two">Generar &nbsp;&nbsp; <a href="<?php echo base_url();?>rrhh/add_trabajador" type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Contrato</a>
			&nbsp;&nbsp;
			<a href="<?php echo base_url();?>rrhh/carga_masiva_personal" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-upload"></span>&nbsp;&nbsp;Anexo</a>
			</h3>		
		<div class="graph-visual tables-main">
											
													
								<h3 class="inner-tittle two">Descripción</h3>
									  <div class="graph">

									  	
										<div class="tables">
											<table id="listado" class="table"> 
												<thead> 
													<tr>
														<th>#</th>
        												<th>Tipo Contrato</th>
        												<th>Fecha</th>
        												<th>Estado</th>
														<th>Ver</th>

													</tr> 
												</thead> 
												<tbody> 
          										<?php if(count($personal) > 0 ){ ?>
            										<?php $i = 1; ?>
            										<?php foreach ($personal as $trabajador) { ?>				
													<tr class="active" id="variable">
						                              <td><td>
              										  <td></small></td>
                									  <td></small></td>
              										  <td>
															<a href="" class="btn btn-info opciones" id="opciones" title="Contrato"><i class="fa fa-pencil-square-o" aria-hidden="true" role="button"></i></a>
        																		<!--<a href="#" class="btn btn-info" role="button">Link Button</a>-->
        																		
																</td>
															</tr> 

								                            <?php $i++;?>
									                       <?php } ?>
              												<?php } ?>		
															
														</tbody> 
													</table> 
										</div>
							
								</div>
						</div>
</div>
<!--

