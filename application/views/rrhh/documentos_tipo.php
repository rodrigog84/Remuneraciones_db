<form id="basicBootstrapForm"  method="post" role="form" enctype="multipart/form-data">

<div class="sub-heard-part">
		<td>
		 <a  href="<?php echo base_url();?>configuraciones/tipos_contrato"  class="btn btn-default">Volver</a>
		<div class="panel-body">
		<h4 class="inner-tittle two">Tipos Documentos</h4>			    
		</div>			
		</td>					
		<div class="graph-visual tables-main">		
								<h5 class="inner-tittle two">Descripción</h5>
									  <div class="graph">							  	
										<div class="tables">
											<table id="listado" class="table"> 
												<thead> 
													<tr>
														<th>#</th>
        												<th>Tipo Contrato</th>
        												<th>Fecha</th>
        												<th>Ver</th>
													</tr> 
												</thead> 
												<tbody> 
	                          	<?php if(count($tipocontrato) > 0 ){ ?>
	                            <?php $i = 1; ?>
	                            <?php foreach ($tipocontrato as $documentos) { ?>				
								<tr class="active" id="variable">
	                              <td><small><?php echo $i ;?></small></td>
									  <td><small><?php echo $documentos->nom_documento;?></small></td>
									  <td><small><?php echo $documentos->created_at;?></small></td>
								<td>			
								<a target="_blank" href="<?php echo base_url();?>rrhh/submit_genera_tipo_documento/<?php echo $documentos->id_formato_doc_colaborador?>" class="btn btn-info opciones" id="opciones" title="Ver Documento"><i class="fa fa-pencil-square-o" aria-hidden="true" role="button"></i></a>						
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
</form>
<!--

