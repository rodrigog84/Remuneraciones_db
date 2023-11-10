		
<div class="sub-heard-part">
		<td>
		<font color="Green" face="arial">
			<h3 align="left"><i>Nombre : <?php echo $personal->nombre." ".$personal->apaterno." ".$personal->amaterno;?> Rut : <?php echo $personal->rut."-".$personal->dv;?></i></h3>
		</font>
			<h5 class="inner-tittle two">Finiquito &nbsp;&nbsp; <a href="<?php echo base_url();?>rrhh/genera_finiquito/<?php echo $personal->id_personal?>" type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Generar</a>&nbsp;&nbsp;
			<a  href="<?php echo base_url();?>rrhh/finiquitos"  class="btn btn-default">Volver</a></h5>			
			 
		<div class="graph-visual tables-main">		
								<h3 class="inner-tittle two">Descripción</h3>
									  <div class="graph">							  	
										<div class="tables">
								<table id="listado" class="table"> 
												<thead> 
													<tr>
														<th>#</th>
        												<th>Tipo Finiquito</th>
        												<th>Fecha</th>
        												<th>Ver</th>

													</tr> 
												</thead> 
												<tbody> 
	                          	<?php if(count($contratopersonal) > 0 ){ ?>
	                            <?php $i = 1; ?>
	                            <?php foreach ($contratopersonal as $documentos) { ?>				
								<tr class="active" id="variable">
	                              <td><small><?php echo $i ;?></small></td>
									  <td><small><?php echo $documentos->documento;?></small></td>
									  <td><small><?php echo $documentos->created_by;?></small></td>
								<td>			
								<a target="_blank" href="<?php echo base_url();?>rrhh/submit_genera_finiquito_personal/<?php echo $documentos->id_doc_colaborador?>" class="btn btn-info opciones" id="opciones" title="Ver Documento"><i class="fa fa-pencil-square-o" aria-hidden="true" role="button"></i></a>						
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

