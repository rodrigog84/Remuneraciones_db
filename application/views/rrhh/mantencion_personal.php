<!--sub-heard-part-->
									  <!--div class="sub-heard-part">
									   		<ol class="breadcrumb m-b-0">
												<li><a href="<?php echo base_url();?>main/dashboard">Inicio</a></li>
												<li class="active">Ficha del Colaborador</li>
											</ol>
									   </div-->
								  <!--//sub-heard-part-->
									<div class="sub-heard-part">
										<ul class="nav nav-tabs">

	  										<li class="<?php echo $mantencion_personal; ?>"><a href="#personal" data-toggle="tab">Mantenci&oacute;n de Personal&nbsp;&nbsp;<i class="fa"></i> </a></li>
	  										<li class="<?php echo $ccostocargo; ?>"><a href="#ccostocargo" data-toggle="tab">Cargo/Centro de Costo&nbsp;&nbsp;<i class="fa"></i> </a></li>
	  										<li class="<?php echo $leyes_sociales; ?>"><a href="#leyes_sociales" data-toggle="tab">Previsi&oacute;n Afp&nbsp;&nbsp;<i class="fa"></i></a></li>
	  										<li class="<?php echo $apv; ?>"><a href="#apv" data-toggle="tab">A.P.V.&nbsp;&nbsp;<i class="fa"></i></a></li>
	  										<li class="<?php echo $salud; ?>"><a href="#cotizacion_salud" data-toggle="tab">Cotizaci&oacute;n de Salud&nbsp;&nbsp;<i class="fa"></i></a></li>
	  										<!--li><a href="#otros" data-toggle="tab">Otros&nbsp;&nbsp;<i class="fa"></i></a></li-->
										</ul>
									</div>								  
								
									<div class="graph-visual tables-main">
									<div class="graph">
										<div class="tab-content">
											<div class="tab-pane <?php echo $mantencion_personal; ?>" id="personal">
												 
													<section id="personales">										
											
													<h3 class="inner-tittle two">Ficha Colaborador 
														<a href="<?php echo base_url();?>rrhh/add_trabajador" type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Colaborador</a>
														&nbsp;&nbsp;
														<a href="<?php echo base_url();?>rrhh/carga_masiva_personal" type="submit" class="btn btn-info"><span class="glyphicon glyphicon-upload"></span>&nbsp;&nbsp;Carga Masiva</a>
														<a href="<?php echo base_url();?>rrhh/exporta_colaborador/" type="button" class="btn btn-success"><span class="fa fa-file-excel-o"></span>&nbsp;&nbsp;Exportar a Excel</a>
													</h3>

													  <div class="graph">

														  	
															<div class="tables">
																<table id="listado" class="table"> 
																	<thead> 
																		<tr>
																			<th>#</th>
                            												<th>Nombre Colaborador</th>
                            												<th>Rut</th>
                            												<th>Estado</th>
                            												<th>&Uacute;ltima Liquidaci&oacute;n</th>
                            												<th>Hist&oacute;rico Sueldos</th>
                            												<th>Licencias</th>
                            												<th>Vacaciones</th>
                            												<th>Documentos</th>
																			<th>Opciones</th>

																		</tr> 
																	</thead> 
																	<tbody> 
	                          										<?php if(count($personal) > 0 ){ ?>
	                            										<?php $i = 1; ?>
	                            										<?php foreach ($personal as $trabajador) { ?>				
																		<tr class="active" id="variable">
											                              <td><small><?php echo $i ;?></small></td>
	                              										  <td><small><?php echo $trabajador->apaterno." ".$trabajador->amaterno." ".$trabajador->nombre;?></small></td>
	                                									  <td><small><?php echo $trabajador->rut == '' ? '' : number_format($trabajador->rut,0,".",".")."-".$trabajador->dv;?></small></td>
	                                									  <td><small><?php echo $trabajador->active == 1 ? "Activo" : "Inactivo";?></small></td>
																		<td><small>
											                              	<center>
											                              		<a href="<?php echo base_url(); ?>rrhh/ultima_liquidacion/<?php echo $trabajador->id_personal;?>" target="_blank"><span class="glyphicon glyphicon-paperclip"></span>
											                             </center></small></td>
	                              										 <td><small>
											                              	<center>
											                              		<a href="<?php echo base_url(); ?>rrhh/historico_sueldos/<?php echo $trabajador->id_personal;?>"><span class="fa fa-list"></span>
											                             </center></small></td>
	                              										 <td><small>
											                              	<center>
											                              		<a href="<?php echo base_url(); ?>rrhh/licencias_colaborador/<?php echo $trabajador->id_personal;?>" ><span class="fa fa-list-ol"></span>
											                             </center></small></td>
	                              										 <td><small>
											                              	<center>
											                              		<a href="<?php echo base_url(); ?>auxiliares/cartola_vacaciones/<?php echo $trabajador->id_personal;?>"><span class="fa fa-calendar"></span>
											                             </center></small></td>
											                             <td><small>
											                              	<center>
											                              		<a href="<?php echo base_url(); ?>rrhh/crear_documentos_colaborador/<?php echo $trabajador->id_personal;?>"><span class="fa fa-file-pdf-o"></span>
											                             </center></small></td>
	                              										   
	                              										  
																			<td>
																				<!--<a href="<?php echo base_url();?>rrhh/mod_trabajador" class="btn btn-info opciones" id="opciones" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>-->
																				<a href="<?php echo base_url();?>rrhh/mod_trabajador/<?php echo $trabajador->id_personal ?>" class="opciones" id="opciones" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true" role="button"></i></a>&nbsp;&nbsp;
        																		<!--<a href="#" class="btn btn-info" role="button">Link Button</a>-->
        																		<a href="<?php echo base_url();?>rrhh/exporta_colaborador/<?php echo $trabajador->rut ?>" class="" id="Exportar_excel" title="Exportar a Excel"><i class="fa fa-file-excel-o" aria-hidden="true" type="button"></i></a>&nbsp;&nbsp;
        																		<a href="#" onclick="desactivar_colaborador(<?php echo $trabajador->rut;?>)" class="" id="Desactivar" title="Activar/Desactivar" data-toggle="modal" data-target="#myModalElim"><i class="glyphicon glyphicon-trash" aria-hidden="true" type="button"></i></a>

																			</td>
																		</tr> 

											                            <?php $i++;?>
												                       <?php } ?>
                          												<?php } ?>		
																		
																	</tbody> 
																</table>
															</div>

															</section>
														</div>	

												<div class="tab-pane <?php echo $ccostocargo; ?>" id="ccostocargo">
												 <form id="formpersonaldata" action="<?php echo base_url();?>rrhh/submit_personal_data" method="post" role="form" enctype="multipart/form-data">
													<section id="personales">										

													  <div class="graph">

														  	
															<div class="tables">
																<table id="listado" class="table"> 
																	<thead> 
																		<tr>
																			<th>#</th>
                            												<th>Nombre Colaborador</th>
                            												<th>Rut</th>
                            												<th>Cargo</th>
                            												<th>Centro de Costo</th>
                            												<th>Estado</th>
				
																		</tr> 
																	</thead> 
																	<tbody> 
	                          										<?php if(count($personal) > 0 ){ ?>
	                            										<?php $i = 1; ?>
	                            										<?php foreach ($personal as $trabajador) { ?>				
																		<tr class="active" id="variable">
											                              <td><small><?php echo $i ;?></small></td>
	                              										  <td><small><?php echo $trabajador->apaterno." ".$trabajador->amaterno." ".$trabajador->nombre;?></small></td>
	                                									  <td><small><?php echo $trabajador->rut == '' ? '' : number_format($trabajador->rut,0,".",".")."-".$trabajador->dv;?></small></td>
	                              										  <!--td><small><?php echo $trabajador->nombre_cargo;?></small></td-->
	                              										   <!--td><small><?php echo $trabajador->centro_costo;?></small></td-->
	                              										   <td><small>
																			<select name="cargo_<?php echo $trabajador->id_personal;?>" id="cargo_<?php echo $trabajador->id_personal;?>"  class="form-control input-sm"  >
											                                  <option value="">Seleccione un Cargo</option>
											                                  <?php foreach ($cargos as $cargo) { ?>
											                                      <?php if($cargo->idpadre != $label_cargo){
											                                              if($label_cargo != ''){
											                                                  echo "</optgroup>";
											                                              }
											                                              echo "<optgroup label='". $cargo->nombrepadre . "''>";
											                                              $label_cargo = $cargo->idpadre;
											                                      } ?>
											                                      <?php if(!($cargo->idpadre == '' && $cargo->hijos > 0)){ ?>
											                                        <?php $cargoselected = $cargo->id_cargos == $trabajador->idcargo ? "selected" : ""; ?>
											                                        <option value="<?php echo $cargo->id_cargos;?>" <?php echo $cargoselected;?> ><?php echo $cargo->nombre;?></option>
											                                      <?php } ?>
											                                  <?php } 
											                                        if($label_cargo != ''){
											                                          echo "</optgroup>";
											                                        }
											                                        ?>                                
											                              </select>
	                              										   </small></td>
	                              										   <td><small>
																				<select name="centrocosto_<?php echo $trabajador->id_personal;?>" id="centrocosto_<?php echo $trabajador->id_personal;?>" class="form-control input-sm">
																					<option value="">Seleccione Centro Costo</option>
										                                    		<?php foreach ($centros_costo as $centro_costo) { ?>
												                                      <?php $centrocostoselected = $centro_costo->id_centro_costo == $trabajador->idcentrocosto ? "selected" : ""; ?>
												                                      <option value="<?php echo $centro_costo->id_centro_costo;?>" <?php echo $centrocostoselected;?> ><?php echo $centro_costo->nombre;?></option>
												                                    <?php } ?>
																				</select>
	                              										   </small></td>
	                              										  <td><small><?php echo $trabajador->active == 1 ? "Activo" : "Inactivo";?></small></td>
																		</tr> 

											                            <?php $i++;?>
												                       <?php } ?>
                          												<?php } ?>		
																		
																	</tbody> 
																</table> 
																 <button type="submit" class="btn btn-primary <?php echo count($personal) == 0 ? 'disabled' : ''; ?>" >Guardar</button>&nbsp;&nbsp
															</div>

															</section>
														</form>
														</div>	


														<div class="tab-pane <?php echo $leyes_sociales; ?>" id="leyes_sociales" >
									                      
									                      <form id="formprevafp" action="<?php echo base_url();?>rrhh/submit_personal_afp" method="post" role="form" enctype="multipart/form-data">
									                      <section id="new">
									                        <h3 class="page-header">Listado de Colaboradores</h3>
									                        <table id="listado_prevision_afp" class="table table-bordered table-striped dt-responsive">
									                        <thead>
									                          <tr>
									                            <th rowspan="2"><small>#</small></th>
									                            <th rowspan="2"><small>Rut</small></th>
									                            <th rowspan="2"><small>Nombre Colaborador</small></th>
									                            <th colspan="3"><small>AFP</small></th>
									                            <th colspan="2"><small>Ahorro Voluntario</small></th>
									                          </tr>
									                          <tr>
									                            <th><small>Nombre</small></th>
									                            <th><small>% Obligatorio&nbsp;&nbsp;&nbsp;</small></th>
									                            <th><small>% Adicional</small></th>
									                            <th><small>Tipo Cotizaci&oacute;n</small></th>
									                            <th><small>Valor</small></th>
									                          </tr>
									                        </thead>
									                        <tbody>
									                          <?php if(count($personal) > 0 ){ ?>
									                            <?php $i = 1; ?>
									                            <?php foreach ($personal as $trabajador) { ?>

									                             <tr>
									                              <td><small><?php echo $i ;?></small></td>
									                              <td><small><?php echo $trabajador->rut == '' ? '' : number_format($trabajador->rut,0,".",".")."-".$trabajador->dv;?></small></td>
									                              <td><small><?php echo $trabajador->nombre." ".$trabajador->apaterno." ".$trabajador->amaterno;?></small></td>
									                              <td>
									                              		<div class="form-group">
									                                <?php $exregimen_afp = ""; ?>
									                                <?php $porc_afp = 0; ?>

									                                <select name="afp_<?php echo $trabajador->id_personal;?>" id="afp_<?php echo $trabajador->id_personal;?>"  class="form-control input-sm afp_list"  >
									                                    <option value="">Seleccione AFP</option>
									                                    <?php foreach ($afps as $afp) { ?>
									                                        <?php if($afp->exregimen != $exregimen_afp){
									                                                if($exregimen_afp != ''){
									                                                    echo "</optgroup>";
									                                                }

									                                                $tipo_sistema =  $afp->exregimen == 0 ? "Sistema Actual" : "Antiguo Sistema de Pensiones";
									                                                if($afp->exregimen == 0){
									                                                    $tipo_sistema = "Sistema Actual";
									                                                }else if($afp->exregimen == 1){
									                                                    $tipo_sistema = "Antiguo Sistema de Pensiones";
									                                                }else if($afp->exregimen == 2){
									                                                    $tipo_sistema = "Sin Cotizaci&oacute;n";
									                                                }
									                                                echo "<optgroup label='". $tipo_sistema . "'>";
									                                                $exregimen_afp = $afp->exregimen;
									                                        } ?>
									                                          <?php $afpselected = $afp->id_afp == $trabajador->idafp ? "selected" : ""; ?>
									                                          <?php $porc_afp = $afp->id_afp == $trabajador->idafp ? $afp->porc : $porc_afp; ?>
									                                          <option value="<?php echo $afp->id_afp;?>" <?php echo $afpselected;?> ><?php echo $afp->nombre;?></option>
									                                    <?php } 
									                                          if($exregimen_afp != ''){
									                                            echo "</optgroup>";
									                                          }
									                                          ?>                                
									                                </select>
									                                </div> 
									                              </td>
									                              <td class="text-right" ><b><span id="cotobligatoria_<?php echo $trabajador->id_personal;?>"  class="text-right input-sm" ><?php echo $porc_afp;?>&nbsp;%</span></b></td>
									                              <td>
									                              	<div class="form-group">
									                                	<input type="text" name="cotadic_<?php echo $trabajador->id_personal;?>" id="cotadic_<?php echo $trabajador->id_personal;?>" class="form-control input-sm cot_adic" value="<?php echo $trabajador->adicafp; ?>"  size="3" />  
									                                </div> 
									                           	  </td>
									                          		
									                              <td>
									                              	<div class="form-group">
									                                <select name="tipcotvol_<?php echo $trabajador->id_personal;?>" id="tipcotvol_<?php echo $trabajador->id_personal;?>" class="form-control  input-sm tipcotvol_list"  >
									                                <option value="pesos" <?php echo $trabajador->tipoahorrovol == 'pesos' ? 'selected' : ''; ?> >($) Pesos</option>
									                                <option value="porcentaje" <?php echo $trabajador->tipoahorrovol == 'porcentaje' ? 'selected' : ''; ?>>(%) Porcentaje</option>
									                                </select>
									                            	</div>
									                              </td>
									                              <td>
									                              	<div  class="form-group">

									                                <?php if($trabajador->tipoahorrovol == 'pesos' && !is_null($trabajador->ahorrovol)){
									                                        $ahorrovol = number_format($trabajador->ahorrovol,0,".",".");
									                                        $class1 = "miles";
									                                        $class2 = "cot_vol";
									                                      }else{
									                                        $ahorrovol = $trabajador->ahorrovol;
									                                        $class1 = "";
									                                        $class2 = "cot_vol";
									                                        } ?>
									                                <input type="text" name="cotvol_<?php echo $trabajador->id_personal;?>" id="cotvol_<?php echo $trabajador->id_personal;?>" class="form-control <?php echo $class1." ".$class2; ?> input-sm numeros" value="<?php echo $ahorrovol; ?>"  size="6" />   
									                            </div>
									                              </td>
									                            </tr>
									                            <?php $i++;?>
									                            <?php } ?>
									                          <?php }else{ ?>
									                            <tr>
									                              <td colspan="10">No existen Colaboradores en la empresa</td>
									                            </tr>
									                          <?php } ?>
									                        </tbody>
									                        </table>

									                        <button type="submit" class="btn btn-primary <?php echo count($personal) == 0 ? 'disabled' : ''; ?>" >Guardar</button>&nbsp;&nbsp;
									                    </section>    
									                    </form>                  
									                  </div> 		


													<div class="tab-pane <?php echo $apv; ?>" id="apv" >
								                      
								                      <form id="formapv" action="<?php echo base_url();?>rrhh/submit_personal_apv" method="post" role="form" enctype="multipart/form-data">
								                      <section id="new">
								                        <h3 class="page-header">Listado de Colaboradores</h3>
								                        <table  id="listado_apv_colaborador" class="table table-bordered table-striped dt-responsive">
								                        <thead>
								                          <tr>
								                            <th><small>#</small></th>
								                            <th><small>Rut</small></th>
								                            <th><small>Nombre Colaborador</small></th>
								                            <th><small>Instituci&oacute;n</small></th>
								                            <th><small>Nro. Contrato</small></th>
								                            <th><small>Tipo Cotizaci&oacute;n</small></th>
								                            <th><small>Valor</small></th>
								                            <th><small>Forma Pago</small></th>
								                            <th><small>Dep&oacute;sitos Convenidos ($)</small></th>
								                          </tr>
								                        </thead>
								                        <tbody>
								                          <?php if(count($personal) > 0 ){ ?>
								                            <?php $i = 1; ?>
								                            <?php foreach ($personal as $trabajador) { ?>

								                             <tr>
								                              <td><small><?php echo $i ;?></small></td>
								                              <td><small><?php echo $trabajador->rut == '' ? '' : number_format($trabajador->rut,0,".",".")."-".$trabajador->dv;?></small></td>
								                              <td><small><?php echo $trabajador->nombre." ".$trabajador->apaterno." ".$trabajador->amaterno;?></small></td>
								                              <td>
								                              	<div class="form-group">
								                                	<select style="width: 100%;" name="instapv_<?php echo $trabajador->id_personal;?>" id="instapv_<?php echo $trabajador->id_personal;?>"  class="form-control input-sm dapv_list"  >
								                                    <option value="">Seleccione Instituci&oacute;n</option>
								                                    <?php foreach ($apvs as $dapv) { ?>
								                                          <?php $apvselected = $dapv->id_apv == $trabajador->instapv ? "selected" : ""; ?>
								                                          <option value="<?php echo $dapv->id_apv;?>" <?php echo $apvselected;?> ><?php echo $dapv->nombre;?></option>
								                                      <?php  } ?>
								                              
								                                </select>
								                            	</div>
								                              </td>  
								                              <td>
								                              	<div class="form-group ">
								                                		<input type="text" name="nrocontratoapv_<?php echo $trabajador->id_personal;?>" id="nrocontratoapv_<?php echo $trabajador->id_personal;?>" class="form-control input-sm numeros nrocontratoapv" width="15px" value="<?php echo $trabajador->nrocontratoapv; ?>"  <?php echo is_null($trabajador->instapv) || $trabajador->instapv == 0 ? 'disabled' : ''; ?> size="3"/>   
								                              	</div>
								                              </td>

								                              <td>
								                              	<div class="form-group">
								                                	<select name="tipoapv_<?php echo $trabajador->id_personal;?>" id="tipoapv_<?php echo $trabajador->id_personal;?>" class="form-control input-sm apv_list"  <?php echo is_null($trabajador->instapv)|| $trabajador->instapv == 0  ? 'disabled' : ''; ?> >
								                                	<option value="pesos" <?php echo $trabajador->tipocotapv == 'pesos' ? 'selected' : ''; ?>>($) Pesos</option>
								                                	<option value="uf" <?php echo $trabajador->tipocotapv == 'uf' ? 'selected' : ''; ?> >U.F.</option>
								                                	<option value="porcentaje" <?php echo $trabajador->tipocotapv == 'porcentaje' ? 'selected' : ''; ?>>(%) Porc.</option>
								                                	</select>
								                                </div>
								                              </td>
								                              <td>
								                              	<div class="form-group">
								                                <?php if($trabajador->tipocotapv == 'pesos' && !is_null($trabajador->cotapv)){
								                                        $cotapv = number_format($trabajador->cotapv,0,".",".");
								                                        $class1 = "miles";
								                                        $class2 = "";
								                                      }else if($trabajador->tipocotapv == 'uf' && !is_null($trabajador->cotapv)){
								                                        $cotapv = number_format($trabajador->cotapv,2,",","");
								                                        $class1 = "";
								                                        $class2 = "miles_decimales";
								                                      }else{
								                                        $cotapv = $trabajador->cotapv;
								                                        $class1 = "";
								                                        $class2 = "";                                        
								                                        } ?>                              
								                                <input type="text" name="apv_<?php echo $trabajador->id_personal;?>" id="apv_<?php echo $trabajador->id_personal;?>" class="form-control input-sm numeros cot_apv <?php echo $class1." ".$class2; ?>" value="<?php echo $cotapv; ?>" <?php echo is_null($trabajador->instapv) || $trabajador->instapv == 0  ? 'disabled' : ''; ?> size="6" />   
								                              </div>
								                              </td>  
								                              <td>
								                              	<div class="form-group">
								                                <select name="formapagoapv_<?php echo $trabajador->id_personal;?>" id="formapagoapv_<?php echo $trabajador->id_personal;?>" class="form-control input-sm"  <?php echo is_null($trabajador->instapv) || $trabajador->instapv == 0 ? 'disabled' : ''; ?> >
								                                <option value="1" <?php echo is_null($trabajador->formapagoapv) || $trabajador->formapagoapv == 1 ? 'selected' : ''; ?> >Directa</option>
								                                <option value="2" <?php echo $trabajador->formapagoapv == 2 ? 'selected' : ''; ?> >Indirecta</option>
								                                </select>                              
								                              </div>
								                              </td>       
								                              <td>
								                              	<div class="form-group">
								                              <?php $depconvapv = is_null($trabajador->depconvapv) ? 0 : number_format($trabajador->depconvapv,0,".","."); ?>
								                                <input type="text" name="depconvapv_<?php echo $trabajador->id_personal;?>" id="depconvapv_<?php echo $trabajador->id_personal;?>" class="form-control input-sm miles depconvapv" value="<?php echo $depconvapv; ?>" <?php echo is_null($trabajador->instapv) || $trabajador->instapv == 0  ? 'disabled' : ''; ?> size="6" />   
								                              </div>
								                              </td>                                                      
								                            </tr>
								                            <?php $i++;?>
								                            <?php } ?>
								                          <?php }else{ ?>
								                            <tr>
								                              <td colspan="10">No existen Colaboradores en la empresa</td>
								                            </tr>
								                          <?php } ?>
								                        </tbody>
								                        </table>

								                        <button type="submit" class="btn btn-primary <?php echo count($personal) == 0 ? 'disabled' : ''; ?>" >Guardar</button>&nbsp;&nbsp;
								                    </section>    
								                    </form>                  
								                  </div>									                  												


								 					<div class="tab-pane <?php echo $salud; ?>" id="cotizacion_salud" >
								                      <form id="formsalud" action="<?php echo base_url();?>rrhh/submit_salud" method="post" role="form" enctype="multipart/form-data">
								                      <section id="new">
								                        <h3 class="page-header">Listado de Colaboradores</h3>
								                        <table  id="cotizacion_de_salud" class="table  table-striped dt-responsive">
								                        <thead>
								                          <tr>
								                            <th >#</th>
								                            <th >Rut</th>
								                            <th >Nombre Colaborador</th>
								                            <th >Isapre/Fonasa</th>
								                            <th >Sueldo Base</th>
								                            <th >7% Imponible</th>
								                            <th >Pactado (UF)</th>
								                            <!--th ><small>Valor Plan</small></th>
								                            <th ><small>Monto Descuento</small></th-->
								                          </tr>
								                        </thead>
								                        <tbody>
								                       
								                          <?php if(count($personal) > 0 ){ ?>
								                            <?php $i = 1; ?>
								                            <?php foreach ($personal as $trabajador) { ?>

								                             <tr >
								                              <td><?php echo $i ;?></td>
								                              <td><?php echo $trabajador->rut == '' ? '' : number_format($trabajador->rut,0,".",".")."-".$trabajador->dv;?></td>
								                              <td><?php echo $trabajador->nombre." ".$trabajador->apaterno." ".$trabajador->amaterno;?></td>
								                              <td class="form-group">
								                                <select name="isapre_<?php echo $trabajador->id_personal;?>" id="isapre_<?php echo $trabajador->id_personal;?>"  class="form-control isapre_list"  >
								                                    <option value="">Seleccione Instituci&oacute;n</option>
								                                    <?php foreach ($isapres as $isapre) { ?>
								                                      <?php $isapreselected = $isapre->id_isapre == $trabajador->idisapre ? "selected" : ""; ?>
								                                      <option value="<?php echo $isapre->id_isapre;?>" <?php echo $isapreselected;?> ><?php echo $isapre->nombre;?></option>
								                                    <?php } ?>                             
								                                </select>
								                              </td>
								                              <td>$&nbsp;<?php echo number_format($trabajador->sueldobase,0,".",".");?></td>
								                              <td>$&nbsp;<?php echo number_format((int)$trabajador->sueldobase*0.07,0,".",".");?></td>
								                              <td class="form-group">
								                              	<input type="text" name="pactado_<?php echo $trabajador->id_personal;?>" id="pactado_<?php echo $trabajador->id_personal;?>" class="form-control valor_pactado miles_decimales_isapre" value="<?php echo !is_null($trabajador->valorpactado) && $trabajador->valorpactado != 0 ? number_format($trabajador->valorpactado,4,",","") : ""; ?>" <?php echo is_null($trabajador->idisapre) || $trabajador->idisapre == 1 || $trabajador->idisapre == 0 ? "disabled" : ""; ?>  size="6" />
								                              </td>
								                              <!--td><b><span id="valorplan_<?php echo $trabajador->id;?>"  class="text-right input-sm" >$&nbsp;0</span></b></td>
								                              <td><b><span id="montodescuento_<?php echo $trabajador->id;?>"  class="text-right input-sm" >$&nbsp;0</span></b></td-->
								                            </tr>
								                            <?php $i++;?>
								                            <?php } ?>
								                          <?php }else{ ?>
								                            <tr>
								                              <td colspan="7">No existen colaboradores en la empresa</td>
								                            </tr>
								                          <?php } ?>
								                        </tbody>
								                        </table>

								                        <button type="submit" class="btn btn-primary <?php echo count($personal) == 0 ? 'disabled' : ''; ?>">Guardar</button>&nbsp;&nbsp;
								                    </section>    
								                    </form>  
								                  </div>   


												
													</div>





											</div>
										</div>


<script>


$(function () {
        $('#listado_prevision_afp,#cotizacion_de_salud,#listado_apv_colaborador').dataTable({
          "bLengthChange": true,
          "bFilter": true,
          "bInfo": true,
          "bSort": false,
          "bAutoWidth": false,
          "aLengthMenu" : [[5,15,30,50,100,-1],[5,15,30,50,100,'Todos']],
          "iDisplayLength": 50,
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

      });



$(document).ready(function() {

    var table = $('#listado').DataTable({
    	"bLengthChange": true,
          "bFilter": true,
          "bInfo": true,
          "bSort": false,
          "bAutoWidth": false,
          "aLengthMenu" : [[5,15,30,50,100,-1],[5,15,30,50,100,'Todos']],
          "iDisplayLength": 50,
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
                "sPrevious": "Anterior"}            } ,
        		initComplete: function () {
               		var div=$('#listado_wrapper');
    				/*div.find("#listado_filter").prepend("<label for='idEstado'>Estado:</label> <select id='idEstado' name='idEstado' class='form-control' required><option value='' selected='selected'>Todos</option><option value='Activo'>Activo</option><option value='Inactivo'>Inactivo</option></select>");
            		this.api().column(4).each(function () {
                	var column = this;
               		console.log(column.data());
                	$('#idEstado').on('change',function(){
                		var val=$(this).val();
                		column.search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                });
            });*/
        }
    });
    });


/*
$(function (){
      $('#listado').DataTable( {
        initComplete: function () {
            this.api().columns([0,1,2]).every( function () {
                var column = this;
                var select = $('<select><option value="     "></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );*/




</script>											
<script>

    $(document).ready(function() {
        <?php if(isset($message)){ ?>

          $.gritter.add({
            title: 'Atención',
            text: '<?php echo $message;?>',
            sticky: false,
            image: '<?php echo base_url();?>images/logos/<?php echo $classmessage == 'success' ? 'check_ok_accept_apply_1582.png' : 'alert-icon.png';?>',
            time: 5000,
            class_name: 'my-sticky-class'
        });
        /*setTimeout(redirige, 1500);
        function redirige(){
            location.href = '<?php //echo base_url();?>welcome/dashboard';
        }*/
        <?php } ?>


    });
</script>


<script>

$('.afp_list').change(function(){
    var id_elem = $(this).attr('id');
    var array_elem = id_elem.split("_");
    var idtrabajador = array_elem[1];

    if($(this).val() != ''){


      $.get("<?php echo base_url();?>rrhh/get_cot_obligatoria/"+$(this).val(),function(data){
               // Limpiamos el select
                    var_json = $.parseJSON(data);
                    $('#cotobligatoria_'+idtrabajador).html(var_json.porc+" %")
      });
      
    }else{
      $('#cotobligatoria_'+idtrabajador).html("0 %")
    }
}); 


$('.dapv_list').change(function(){

  var apv_select = $(this).val();
  var id_elem = $(this).attr('id');
  var array_elem = id_elem.split("_");
  var idtrabajador = array_elem[1]; 

  if(apv_select != ''){ //seleccionó institución
  
    $('#nrocontratoapv_'+idtrabajador).attr('disabled',false);
    $('#tipoapv_'+idtrabajador).attr('disabled',false);
    $('#apv_'+idtrabajador).attr('disabled',false);
    $('#formapagoapv_'+idtrabajador).attr('disabled',false);
    $('#depconvapv_'+idtrabajador).attr('disabled',false);
    
    

  }else{
    $('#nrocontratoapv_'+idtrabajador).val(0);
    $('#tipoapv_'+idtrabajador).val('pesos');
    $('#apv_'+idtrabajador).addClass("miles");   
    $('#apv_'+idtrabajador).removeClass("miles_decimales");   
    $('#apv_'+idtrabajador).mask('000.000.000.000.000', {reverse: true}); // agrega mascara
    $('#apv_'+idtrabajador).val(0);
    $('#formapagoapv_'+idtrabajador).val(1);
    $('#depconvapv_'+idtrabajador).val(0);

    $('#nrocontratoapv_'+idtrabajador).attr('disabled',true);
    $('#tipoapv_'+idtrabajador).attr('disabled',true);
    $('#apv_'+idtrabajador).attr('disabled',true);
    $('#formapagoapv_'+idtrabajador).attr('disabled',true);
    $('#depconvapv_'+idtrabajador).attr('disabled',true);
  }


});


$('.apv_list').change(function(){
    var id_elem = $(this).attr('id');
    var array_elem = id_elem.split("_");
    var idtrabajador = array_elem[1];
    $('#apv_'+idtrabajador).val("");

    if($(this).val() == 'porcentaje'){
      $('#apv_'+idtrabajador).removeClass("miles");   
      $('#apv_'+idtrabajador).removeClass("miles_decimales");   
      //$('#cotvol_'+idtrabajador).addClass("cot_vol");   
      $('#apv_'+idtrabajador).unmask(); //quita mascara

      //$('#formprevafp').formValidation('enableFieldValidators', 'cotvol', true, 'between'); //agregar validacion
      //$('#formprevafp').formValidation('enableFieldValidators', 'cotvol', true, 'numeric'); //agregar validacion
    }else if($(this).val() == 'uf'){
      $('#apv_'+idtrabajador).removeClass("miles");   
      $('#apv_'+idtrabajador).addClass("miles_decimales");   
      $('#apv_'+idtrabajador).mask('#.##0,00', {reverse: true}) 
      
    }else{
      $('#apv_'+idtrabajador).addClass("miles");   
      $('#apv_'+idtrabajador).removeClass("miles_decimales");   
      //$('#cotvol_'+idtrabajador).removeClass("cot_vol");   
      $('#apv_'+idtrabajador).mask('000.000.000.000.000', {reverse: true}); // agrega mascara
      //$('#formprevafp').formValidation('enableFieldValidators', 'cotvol', false, 'between'); //quitar validacion
      //$('#formprevafp').formValidation('enableFieldValidators', 'cotvol', false, 'numeric'); //quitar validacion      
    }

    
});  



$('.tipcotvol_list').change(function(){
    var id_elem = $(this).attr('id');
    var array_elem = id_elem.split("_");
    var idtrabajador = array_elem[1];
    $('#cotvol_'+idtrabajador).val("");

    if($(this).val() == 'porcentaje'){
      $('#cotvol_'+idtrabajador).removeClass("miles");   
      //$('#cotvol_'+idtrabajador).addClass("cot_vol");   
      $('#cotvol_'+idtrabajador).unmask(); //quita mascara

      //$('#formprevafp').formValidation('enableFieldValidators', 'cotvol', true, 'between'); //agregar validacion
      //$('#formprevafp').formValidation('enableFieldValidators', 'cotvol', true, 'numeric'); //agregar validacion
    }else{
      $('#cotvol_'+idtrabajador).addClass("miles");   
      //$('#cotvol_'+idtrabajador).removeClass("cot_vol");   
      $('#cotvol_'+idtrabajador).mask('000.000.000.000.000', {reverse: true}); // agrega mascara
      //$('#formprevafp').formValidation('enableFieldValidators', 'cotvol', false, 'between'); //quitar validacion
      //$('#formprevafp').formValidation('enableFieldValidators', 'cotvol', false, 'numeric'); //quitar validacion      
    }

    //$('#formprevafp').formValidation('updateStatus', 'cotvol', 'NOT_VALIDATED').formValidation('revalidateField', 'cotvol')
    //formValidation('revalidateField', 'cotvol');
    
});  



$('.isapre_list').change(function(){
    var id_elem = $(this).attr('id');
    var array_elem = id_elem.split("_");
    var idtrabajador = array_elem[1];
    
    if($(this).val() == 1 || $(this).val() == ''){ // si es fonasa o sin isapre, no se ingresa monto pactado
      $('#pactado_'+idtrabajador).attr('disabled',true);
      $('#pactado_'+idtrabajador).val('');
    }else{
      $('#pactado_'+idtrabajador).attr('disabled',false);
    }
    
});    


$(document).ready(function(){
 $('.miles_decimales').mask('#.##0,00', {reverse: true});        

 //$('.miles_decimales_isapre').mask('#.####0,0000', {reverse: true});       

});

  $('.numeros').keypress(function(event){
    if ((event.keyCode < 48 || event.keyCode > 57) && event.keyCode != 46){
      event.preventDefault();
    } 
  })  




	function desactivar_colaborador(rut){

		$.ajax({type: "GET",
		    		url: "<?php echo base_url();?>rrhh/verificar_trabajador/"+rut, 
		    		dataType: "json",
		    		success: function(personal){
		      			if(personal ==0){
		      				
								bootbox.confirm({
							    title: "Activar Colaborador",
							    message: "¿Desea realizar la activación de Colaborador?",
							    buttons: {
							        cancel: {
							            label: '<i class="fa fa-times"></i> Cancelar'
							        },
							        confirm: {
							            label: '<i class="fa fa-check"></i> Confirmar'
							        }
							    },
							    callback: function (result) {
							        //console.log('This was logged in the callback: ' + result);
							        if (result == true){
							    		window.location="<?php echo base_url();?>rrhh/activar_trabajador/"+rut;
							    	}
							    }

								});

						}else{
								bootbox.confirm({
							    title: "Desactivar Colaborador",
							    message: "¿Desea realizar la desactivación de Colaborador?",
							    buttons: {
							        cancel: {
							            label: '<i class="fa fa-times"></i> Cancelar'
							        },
							        confirm: {
							            label: '<i class="fa fa-check"></i> Confirmar'
							        }
							    },
							    callback: function (result) {
							        //console.log('This was logged in the callback: ' + result);
							        if (result == true){
							   		window.location="<?php echo base_url();?>rrhh/desactivar_trabajador/"+rut;
							    	}
							    }

								});


							}

		      		}
		     	}); 
		



		
	



};


$(document).ready(function() {
    $('#formprevafp').formValidation({
              framework: 'bootstrap',
              excluded: ':disabled',
              icon: {
                  valid: 'glyphicon glyphicon-ok',
                  invalid: 'glyphicon glyphicon-remove',
                  validating: 'glyphicon glyphicon-refresh'
              },
              fields: {
                /*afp_list: {
                  selector: '.afp_list',
                  row: '.form-group',
                  validators: {
                      notEmpty: {
                          message: 'Selecci&oacute;n de Afp es requerida'
                      }
                  }
                },*/
                cotadic: {
                    // The children's full name are inputs with class .childFullName
                    selector: '.cot_adic',
                    // The field is placed inside .col-xs-6 div instead of .form-group
                    row: '.form-group',
                    validators: {
                        between: {
                            min: 0,
                            max: 100,
                            message: 'Cotizaci&oacute;n adicional debe estar entre 0 y 100'
                        },
                        numeric: {
                            separator: '.',
                            message: 'Cotizaci&oacute;n adicional s&oacute;lo puede contener n&uacute;meros'
                        },

                    }
                },  
               
                 cotvol: {
                    // The children's full name are inputs with class .childFullName
                    selector: '.cot_vol',
                    // The field is placed inside .col-xs-6 div instead of .form-group
                    row: '.form-group',
                    validators: {
                      numeric: {
                          //enabled: false,
                          separator: '.',
                          message: 'Ahorro voluntario s&oacute;lo puede contener n&uacute;meros'
                      },                      
                      callback: {
                          message: 'Ahorro voluntario debe estar entre 0 y 100',
                          callback: function (value, validator, $field) {
                              var id_text = $field.attr('id');
                              var array_field = id_text.split("_");
                              idtrabajador = array_field[1];
                              if($('#tipcotvol_'+idtrabajador).val() == 'porcentaje'){
                                cotvol = parseFloat(value);
                                cotvol = parseInt(cotvol);
                                if(cotvol > 100){
                                  return  {
                                        valid: false,
                                        message: 'Ahorro voluntario debe estar entre 0 y 100'
                                    }

                                }else{
                                  return true;
                                }
                              }else{
                                return true;
                              }                               
                          }
                      } 

                    }
                },   
              }
          })
        .find('.miles').mask('000.000.000.000.000', {reverse: true});

		$('#formapv').formValidation({
              framework: 'bootstrap',
              excluded: ':disabled',
              icon: {
                  valid: 'glyphicon glyphicon-ok',
                  invalid: 'glyphicon glyphicon-remove',
                  validating: 'glyphicon glyphicon-refresh'
              },
              fields: {
                  nrocontratoapv: {
                    selector: '.nrocontratoapv',
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Nro. de contrato es requerido'
                        }
                    }
                  },    
                  depconvapv: {
                    selector: '.depconvapv',
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Monto Dep&oacute;sitos Convenidos es requerido'
                        }
                    }
                  },                                 
                 cot_apv: {
                    // The children's full name are inputs with class .childFullName
                    selector: '.cot_apv',
                    // The field is placed inside .col-xs-6 div instead of .form-group
                    row: '.form-group',
                    validators: {
                      /*numeric: {
                          //enabled: false,
                          separator: '.',
                          message: 'Ahorro voluntario s&oacute;lo puede contener n&uacute;meros'
                      },  */                    
                      callback: {
                          message: 'Ahorro APV debe estar entre 0 y 100',
                          callback: function (value, validator, $field) {
                              var id_text = $field.attr('id');
                              var array_field = id_text.split("_");
                              idtrabajador = array_field[1];
                              if($('#tipoapv_'+idtrabajador).val() == 'porcentaje'){
                                var array_value = value.split(".");
                                if(array_value.length > 2){
                                    return  {
                                          valid: false,
                                          message: 'Ahorro APV s&oacute;lo puede contener n&uacute;meros'
                                      }

                                }else{
                                  cot_apv = parseFloat(value);
                                  cot_apv = parseInt(cot_apv);                                  
                                  if(cot_apv > 100){
                                    return  {
                                          valid: false,
                                          message: 'Ahorro APV debe estar entre 0 y 100'
                                      }

                                  }else{
                                    return true;
                                  }

                                }



                              }else{
                                return true;
                              }                               
                          }
                      } 

                    }
                },                                
              }
          })
        .find('.miles').mask('000.000.000.000.000', {reverse: true});

 		$('#formsalud').formValidation({
              framework: 'bootstrap',
              excluded: ':disabled',
              icon: {
                  valid: 'glyphicon glyphicon-ok',
                  invalid: 'glyphicon glyphicon-remove',
                  validating: 'glyphicon glyphicon-refresh'
              },
              fields: {
                /*isapre_list: {
                  selector: '.isapre_list',
                  row: '.form-group',
                  validators: {
                      notEmpty: {
                          message: 'Selecci&oacute;n de Instituci&oacute;n de Salud es requerida'
                      }
                  }
                },*/
                valor_pactado: {
                  selector: '.valor_pactado',
                  row: '.form-group',
                  validators: {
                      notEmpty: {
                          message: 'Valor Pactado Cotizaci&oacute;n de Salud es requerida'
                      },
	                    regexp: {
	                            regexp: /^[0-9]+([,][0-9]+)?$/,
	                            message: 'Debe ingresar un valor decimal'
	                    }
                  }
                }
                


              }
          });           
});
</script>