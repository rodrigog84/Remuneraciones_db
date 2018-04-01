
<div class="sub-heard-part">
		<td>
		<font color="Green" face="arial">
			<h3 align="left"><i>Nombre : <?php echo $personal->nombre." ".$personal->apaterno." ".$personal->amaterno;?> Rut : <?php echo $personal->rut == '' ? '' : number_format($personal->rut,0,".",".")."-".$personal->dv;?></i></h3>
		</font>
		    
			<h5 class="inner-tittle two">
			 <div class="panel-body">
                        <div class='row'>
                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="caja">Tipo Contrato      :</label>    
                               <select name="tipo" id="tipocontrato" class="form-control1" required>
                              <?php foreach ($tipocontrato as $tipo) { ?>
                                <?php $paisselected = $tipo->id == $datos_form['id_tipo_doc_colaborador'] ? "selected" : "Tipo Contrato"; ?>
                                <option value="<?php echo $tipo->id_tipo_doc_colaborador;?>" <?php echo $paisselected;?> ><?php echo $tipo->tipo;?></option>
                              <?php } ?>
                            </select>

                            </div>  
                          </div><a href="<?php echo base_url();?>rrhh/genera_contrato/<?php echo $personal->id_personal?>/<?php echo $tipo->id_tipo_doc_colaborador;?>" type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Generar</a>

			
			</h5>		
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
          										<?php //if(count($contrato) > 0 ){ ?>
            										<?php //$i = 1; ?>
            										<?php //foreach ($personal as $trabajador) { ?>				
													<tr class="active" id="variable">
						                              <td><td>
              										  <td></small></td>
                									  <td></small></td>
              										  <td>
															<a href="" class="btn btn-info opciones" id="opciones" title="Contrato"><i class="fa fa-pencil-square-o" aria-hidden="true" role="button"></i></a>
        																		<!--<a href="#" class="btn btn-info" role="button">Link Button</a>-->
        																		
																</td>
															</tr> 

								                            <?php// $i++;?>
									                       <?php //} ?>
              												<?php //} ?>		
															
														</tbody> 
													</table> 
										</div>
							
								</div>
						</div>
</div>
<!--

