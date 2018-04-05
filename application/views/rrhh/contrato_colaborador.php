<form id="basicBootstrapForm" action="<?php echo base_url();?>rrhh/genera_contrato/<?php echo $personal->id_personal?>" method="post" role="form" enctype="multipart/form-data">

<div class="sub-heard-part">
		<td>
		<font color="Green" face="arial">
			<h3 align="left"><i>Nombre : <?php echo $personal->nombre." ".$personal->apaterno." ".$personal->amaterno;?> Rut : <?php echo $personal->rut == '' ? '' : number_format($personal->rut,0,".",".")."-".$personal->dv;?></i></h3>
		</font>			    
			<td>
			<div class="panel-body">
			    <div class="row" id=""></div>    
			    <div class="box-footer">
			    <label for="caja">CONTRATO      :</label>
			    <button type="submit" class="btn btn-primary">Generar</button>&nbsp;&nbsp;&nbsp;&nbsp;
			    <a  href="<?php echo base_url();?>rrhh/contratos"  class="btn btn-default">Volver</a>
			   </div>

			  </div>
			</div>

			</td>
			</td>
			
						
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
								<a href="<?php echo base_url();?>rrhh/submit_genera_contrato_personal/<?php echo $documentos->id_doc_colaborador?>" class="btn btn-info opciones" id="opciones" title="Contrato"><i class="fa fa-pencil-square-o" aria-hidden="true" role="button"></i></a>						
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

