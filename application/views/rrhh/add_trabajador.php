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


<!--sub-heard-part--><form id="basicBootstrapForm" action="<?php echo base_url();?>rrhh/submit_trabajador" id="basicBootstrapForm" method="post">
<!--sub-heard-part-->
								<div class="sub-heard-part">
									<ul class="nav nav-tabs">
  										<li class="active"><a href="#datospersonales" data-toggle="tab">Datos Personales </a></li>
  										<li><a href="#datosempresa" data-toggle="tab"> Datos Empresa</a></li>
  										<li><a href="#datosllss" data-toggle="tab">L.L.S.S</a></li>
  										<li><a href="#pago" data-toggle="tab">Forma Pago</a></li>
  										<li><a href="#otros" data-toggle="tab">Otros</a></li>
  										<li><a href="#configuracion" data-toggle="tab">Configuraciones</a></li>
									</ul>
								</div>
								<!--//sub-heard-part-->
								
								<div class="graph-visual tables-main">
									<h3 class="inner-tittle two">Nuevo Colaborador </h3>
									<div class="graph">
										<div class="tab-content">
											<div class="tab-pane active" id="datospersonales">
												<section id="personales">
													<!--div class='row'>
							                          <div class='col-md-6'>
							                            <div class="form-group">
							                              <label for="apaterno">Apellido Paterno</label>
							                              <input type="text" class="form-control1" name="apaterno" id="apaterno" placeholder="Apellido Paterno" value="<?php echo $datos_form['apaterno'];?>"  >
							                            </div>
							                          </div>
							                          <div class='col-md-6'>
							                            <div class="form-group">
							                                <label for="amaterno">Apellido Materno</label>  
							                                 <input type="text" id="amaterno" name="amaterno" class="form-control1" placeholder="Apellido Materno" value="<?php echo $datos_form['amaterno'];?>">
							                            </div>
							                          </div>   
							                        </div-->

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>Rut:</th> 
																<th>Número de Ficha:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="rut" id="rut"  class="form-control1"  placeholder="98.123.456-7" title="Escriba Rut" >
															</td>
															<td>
																<input type="text" name="numficha" id="numficha" class="form-control1" id="" placeholder="Número de Ficha">
															</td>
														</tbody>	
													</table>

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>Nombre Completo:</th> 
																<th>Apellido Parterno:</th>
																<th>Apellido Materno:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td >
																<div class="form-group">
																<input type="text" name="nombre" class="form-control1" id="nombre" placeholder="Nombre Completo">
																</div>
															</td>
															<td class="form-group">
																<input type="text" name="apaterno" class="form-control1" id="apaterno" placeholder="Apellido Parterno">
															</td>
															<td class="form-group">
																<input type="text" name="amaterno" class="form-control1" id="amaterno" placeholder="Apellido Materno">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>Fecha de Nacimiento:</th> 
																<th>Nacionalidad:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td>
																<input placeholder="Fecha de Nacimiento" name="fechanacimiento" id="fechanacimiento" class="form-control1" id="datepicker" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" />
															</td>
															<td>
																<select name="nacionalidad" id="nacionalidad" class="form-control1">
																	<option>Seleccione Nacionalidad</option>
						                                    		<?php foreach ($paises as $pais) { ?>
								                                      <?php $paisselected = $pais->id == $datos_form['id_nacionalidad'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $pais->id_paises;?>" <?php echo $paisselected;?> ><?php echo $pais->nombre;?></option>
								                                    <?php } ?>
																</select>
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>Estado Civil:</th> 
																<th>Sexo:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td>
																<select name="ecivil" id="ecivil" class="form-control1">
							                                   <option value="">Seleccione Estado Civil</option>
								                                    <?php foreach ($estados_civiles as $estado_civil) { ?>
								                                      <?php $ecivilselected = $estado_civil->id == $datos_form['idecivil'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $estado_civil->id_estado_civil;?>" <?php echo $ecivilselected;?> ><?php echo $estado_civil->nombre;?></option>
								                                    <?php } ?>
																</select>
															</td>
															<td>
								                                <select name="sexo" id="sexo"  class="form-control1">
								                                    <option value="">Seleccione Sexo</option>
								                                    <option value="M" <?php echo $datos_form['sexo'] == 'M' ? 'selected' : ''; ?>>Masculino</option>
								                                    <option value="F" <?php echo $datos_form['sexo'] == 'F' ? 'selected' : ''; ?>>Femenino</option>
								                                </select> 
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>Dirección:</th> 
																<th>Email:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="direccion" id="direccion" class="form-control1" placeholder="Dirección" data-toggle="modal" data-target="#myModalDireccion">
															</td>
															<td>
																<input type="text" name="email" id="email" class="form-control1" placeholder="Email">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>Tipo de Renta:</th> 
																<th>Cargo:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td>
																<select name="tiporenta" id="tiporenta" class="form-control1">
																	<option value="">Seleccione Tipo Renta</option>
																	<option value="Mensual">Mensual</option>
																	<option value="Diaria">Diaria</option>
																	<option value="Semanal">Semanal</option>
																</select>
															</td>
															<td>
														 <?php $label_cargo = ""; ?>

							                              <select name="cargo" id="cargo"  class="form-control1"  >
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
							                                        <?php $cargoselected = $cargo->id == $datos_form['idcargo'] ? "selected" : ""; ?>
							                                        <option value="<?php echo $cargo->id_cargos;?>" <?php echo $cargoselected;?> ><?php echo $cargo->nombre;?></option>
							                                      <?php } ?>
							                                  <?php } 
							                                        if($label_cargo != ''){
							                                          echo "</optgroup>";
							                                        }
							                                        ?>                                
							                              </select>
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>Estudios:</th> 
																<th>Titulo:</th>
																<th>Idioma:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td>
																<select name="estudios" id="estudios" class="form-control1">
																	<option>Seleccione Nivel Educacional</option>
						                                    		<?php foreach ($estudios as $estudio) { ?>
								                                      <?php $estudioselected = $estudio->id == $datos_form['idestudio'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $estudio->id_estudios;?>" <?php echo $estudioselected;?> ><?php echo $estudio->nombre;?></option>
								                                    <?php } ?>
																</select>
															</td>
															<td>
																<input type="text" name="titulo" id="titulo" class="form-control1" placeholder="Titulo">
															</td>
															<td>
																<select name="idioma" id="idioma" class="form-control1">
																	<option>Seleccione Idioma</option>
						                                    		<?php foreach ($idiomas as $idioma) { ?>
								                                      <?php $idiomaselected = $idioma->id == $datos_form['ididioma'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $idioma->id_idioma;?>" <?php echo $idiomaselected;?> ><?php echo $idioma->nombre;?></option>
								                                    <?php } ?>
																</select>
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>Jefe o Supervisor:</th> 
																<th>Reemplazo de:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td>
																<select name="jefe" id="jefe" class="form-control1">
																	<option>Seleccione Jefe o Supervisor</option>
						                                    		<?php foreach ($personal as $trabajador) { ?>
								                                      <?php $jefeselected = $trabajador->id == $datos_form['idjefe'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $trabajador->id_personal;?>" <?php echo $jefeselected;?> ><?php echo $trabajador->nombre." ".$trabajador->apaterno." ".$trabajador->amaterno;?></option>
								                                    <?php } ?>
																</select>
															</td>
															<td>
																<select name="reemplazo" id="reemplazo" class="form-control1">
																	<option>Seleccione Reemplazo</option>
						                                    		<?php foreach ($personal as $trabajador) { ?>
								                                      <?php $jefeselected = $trabajador->id == $datos_form['idjefe'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $trabajador->id_personal;?>" <?php echo $jefeselected;?> ><?php echo $trabajador->nombre." ".$trabajador->apaterno." ".$trabajador->amaterno;?></option>
								                                    <?php } ?>
																</select>
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>Licencia:</th> 
																<th>Talla de Polera:</th>
																<th>Talla de Pantalón:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td>
																<select name="licencia" id="licencia" class="form-control1">
																	<option>Seleccione Tipo Licencia</option>
						                                    		<?php foreach ($licencias as $licencia) { ?>
								                                      <?php $licenciaselected = $licencia->id == $datos_form['idlicencia'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $licencia->id_licencia_conducir;?>" <?php echo $licenciaselected;?> ><?php echo $licencia->nombre;?></option>
								                                    <?php } ?>
																</select>
															</td>
															<td>
																<input type="text" name="polera" id="polera" class="form-control1" placeholder="Talla de Polera">
															</td>
															<td>
																<input type="text" name="pantalon" id="pantalon" class="form-control1" placeholder="Talla de Pantalón">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>Tipo de Documento:</th> 
																<th>Centro de Costo:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="tipo_documento" id="tipo_documento" class="form-control1" placeholder="Tipo de Documento">
															</td>
															<td>
																<select name="centro_costo" id="centro_costo" class="form-control1">
																	<option>Seleccione Centro Costo</option>
						                                    		<?php foreach ($centros_costo as $centro_costo) { ?>
								                                      <?php $centrocostoselected = $centro_costo->id == $datos_form['idcentrocosto'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $centro_costo->id_centro_costo;?>" <?php echo $centrocostoselected;?> ><?php echo $centro_costo->nombre;?></option>
								                                    <?php } ?>
																</select>
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>C de Beneficio:</th> 
																<th>Número de Celular:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="beneficio" id="beneficio" class="form-control1" placeholder="C de Beneficio">
															</td>
															<td>
																<input type="text" name="fono" id="fono" class="form-control1" placeholder="Número de Celular">
															</td>
														</tbody>
													</table>
												</section>
											</div>
											<!--Datos de la Empresa-->
											<div class="tab-pane" id="datosempresa">
												<section class="empresa">
													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Clase:</th>
																<th>Sueldo Base:</th> 
																<th>Tipo C.C:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="clase" class="form-control1" id="clase" placeholder="Clases">
															</td>
															<td>
																<input type="text" name="sueldo_base" class="form-control1" id="sueldo_base" placeholder="Sueldo Base">
															</td>
															<td>
																<input type="text" name="tipo_cc" class="form-control1" id="tipo_cc" placeholder="Tipo CC">
															</td>
		
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Categoria:</th> 
																<th>Lugar de Pago:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="categoria" class="form-control1" id="categoria" placeholder="Categoria">
															</td>
															<td>
																<input type="text" name="lugar_pago" class="form-control1" id="lugar_pago" placeholder="Lugar de Pago" data-toggle="modal" data-target="#myModalPago">
															</td>
		
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Fecha de Ingreso:</th> 
																<th>Fecha de Retiro:</th>
																<th>Fecha de Finiquito:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input placeholder="Fecha Ingreso" class="form-control1" id="datepicker2" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" />
															</td>
															<td>
																<input placeholder="Fecha Retiro" class="form-control1" id="datepicker3" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" />
															</td>
															<td>
																<input placeholder="Fecha de Finiquito" class="form-control1" id="datepicker4" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" />
															</td>
		
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Fecha Inicio Cálculo Vacaciones:</th> 
																<th>Saldo Inicial Días Vacaciones Legales:</th>
																<th>Saldo Inicial Días Vacaciones Progresivas:</th>
																
															</tr> 
														</thead>
														<tbody>
															<td>
																<input placeholder="Fecha Inicio Vacaciones" class="form-control1" id="fecha_inicio_vacaciones" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" />
															</td>
															<td>
																<input type="text" name="seccion" class="form-control1" id="vacaciones_legales" placeholder="Sección">
															</td>
															<td>
																<input type="text" name="seccion" class="form-control1" id="vacaciones_progresivas" placeholder="Sección">
															</td>
		
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Motivo de Egreso:</th> 
																<th>Tipo de Contrato:</th>
																<th>Jornada de Trabajo:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<select name="selector1" id="selector1" class="form-control1">
																	<option>Seleccione</option>
																	<option>Dolore, ab unde modi est!</option>
																	<option>Illum, fuga minus sit eaque.</option>
																	<option>Consequatur ducimus maiores voluptatum minima.</option>
																</select>
															</td>
															<td>
																<select name="selector1" id="selector1" class="form-control1">
																	<option>Seleccione</option>
																	<option>Dolore, ab unde modi est!</option>
																	<option>Illum, fuga minus sit eaque.</option>
																	<option>Consequatur ducimus maiores voluptatum minima.</option>
																</select>
															</td>
															<td>
																<select name="selector1" id="selector1" class="form-control1">
																	<option>Seleccione</option>
																	<option>Dolore, ab unde modi est!</option>
																	<option>Illum, fuga minus sit eaque.</option>
																	<option>Consequatur ducimus maiores voluptatum minima.</option>
																</select>
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Sección:</th> 
																<th>Código Ine:</th>
																<th>Sindicato:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="seccion" class="form-control1" id="seccion" placeholder="Sección">
															</td>
															<td>
																<input type="text" name="codigo_ine" class="form-control1" id="codigo_ine" placeholder="Código Ine">
															</td>
															<td>
																<input type="text" name="sindicato" class="form-control1" id="sindicato" placeholder="Sindicato">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Régimen de Pago:</th> 
																<th>Sitio Laboral:</th>
																<th>Zona Brecha:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="regimen_pago" class="form-control1" id="regimen_pago" placeholder="Régimen de Pago">
															</td>
															<td>
																<input type="text" name="sitio_laboral" class="form-control1" id="sitio_laboral" placeholder="Sitio Laboral">
															</td>
															<td>
																<input type="text" name="zona_brecha" class="form-control1" id="zona_brecha" placeholder="Zona Brecha">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Fecha Real:</th> 
																<th>1er Vencimiento:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input placeholder="Fecha Real" class="form-control1" id="fecha_real" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" />
															</td>
															<td>
																<input placeholder="1er Vencimiento" class="form-control1" id="vencimiento_1" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" />
															</td>
														</tbody>
													</table>
												</section>
											</div>

											<div class="tab-pane" id="datosllss">
												<section class="llss">
													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Código Regimen:</th> 
																<th>Jubilados:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<select name="selector1" id="selector1" class="form-control1">
																	<option>Seleccione.</option>
																	<option>Dolore, ab unde modi est!</option>
																	<option>Illum, fuga minus sit eaque.</option>
																	<option>Consequatur ducimus maiores voluptatum min</option>
																</select>
															</td>
															<td>
																<select name="selector1" id="selector1" class="form-control1">
																	<option>Seleccione.</option>
																	<option>Dolore, ab unde modi est!</option>
																	<option>Illum, fuga minus sit eaque.</option>
																	<option>Consequatur ducimus maiores voluptatum min</option>
																</select>
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>L. Pago Cotiz:</th> 
																<th>A.F.P:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<select name="selector1" id="selector1" class="form-control1">
																	<option>Seleccione.</option>
																	<option>Dolore, ab unde modi est!</option>
																	<option>Illum, fuga minus sit eaque.</option>
																	<option>Consequatur ducimus maiores voluptatum min</option>
																</select>
															</td>
															<td>
																<select name="afp" id="afp" class="form-control1">
																	<option>Seleccione AFP</option>
						                                    		<?php foreach ($afps as $afp) { ?>
								                                      <?php $afpselected = $afp->id == $datos_form['idafp'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $afp->id_afp;?>" <?php echo $afpselected;?> ><?php echo $afp->nombre;?></option>
								                                    <?php } ?>
								                                   </select>
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Fecha Incorporación AFP:</th> 
																<th>Fecha Seguro Cesantia:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input placeholder="Fecha Incorp.AFP" class="form-control1" id="datepicker5" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" />
															</td>
															<td>
																<input placeholder="Fecha Seguro Cesantia" class="form-control1" id="datepicker6" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" />
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>Cese AFC:</th>
																<th>Isapre:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<input type="text" name="cese" class="form-control1" id="cese" placeholder="Cese AFC">
															</td>
															<td>
																<select name="isapre" id="isapre" class="form-control1">
																	<option>Seleccione Isapre</option>
						                                    		<?php foreach ($isapres as $isapre) { ?>
								                                      <?php $isapreselected = $isapre->id == $datos_form['idisapre'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $isapre->id_isapre;?>" <?php echo $isapreselected;?> ><?php echo $isapre->nombre;?></option>
								                                    <?php } ?>
								                                   </select>
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>Número FUN:</th>
																<th>Vencimiento de Plan:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<input type="text" name="numero_fun" class="form-control1" id="numero_fun" placeholder="Número FUN">
															</td>

															<td>
																<input placeholder="Vencimiento Plan" class="form-control1" id="datepicker9" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" />
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>Tramo p/Asig. Fami:</th>
																<th>Trabajo Pesado/Insalub:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<input type="text" name="tramo" class="form-control1" id="tramo" placeholder="Tramo p/Asig. Familiar">
															</td>
															<td>
																<input type="text" name="trabajo_pesado" class="form-control1" id="trabajo_pesado" placeholder="Trabajo Pesado/Insalub">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>Estado APVC:</th>
																<th>Fecha APVC:</th>
																<th>Término de Subsidio:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<input type="text" name="estado_apvc" class="form-control1" id="estado_apvc" placeholder="Estado APVC">
															</td>
															<td>
																<input placeholder="Fecha APVC" class="form-control1" id="datepicker10" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" />
															</td>
															<td>
																<input placeholder="Término de Subsidio" class="form-control1" id="datepicker11" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" />
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>C.C.A.F:</th>
																<th>Zona A. Familiar:</th>
																<th>Jornada de Trabajo:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<input type="text" name="ccaf" class="form-control1" id="ccaf" placeholder="C.C.A.F">
															</td>
															<td>
																<input type="text" name="zona_familiar" class="form-control1" id="zona_familiar" placeholder="Zona A. Familiar">
															</td>
															<td>
																<select name="selector1" id="selector1" class="form-control1">
																	<option>Seleccione.</option>
																	<option>Dolore, ab unde modi est!</option>
																	<option>Illum, fuga minus sit eaque.</option>
																	<option>Consequatur ducimus maiores voluptatum min</option>
																</select>
															</td>
														</tbody>
													</table>
												</section>
											</div>

											<div class="tab-pane" id="pago">
												<section class="formapago">
													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Forma de Pago:</th> 
																<th>Banco:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<select name="selector1" id="selector1" class="form-control1">
																	<option>Seleccione.</option>
																	<option>Dolore, ab unde modi est!</option>
																	<option>Illum, fuga minus sit eaque.</option>
																	<option>Consequatur ducimus maiores voluptatum min</option>
																</select>
															</td>
															<td>
																<select name="selector1" id="selector1" class="form-control1">
																	<option>Seleccione.</option>
																	<option>Dolore, ab unde modi est!</option>
																	<option>Illum, fuga minus sit eaque.</option>
																	<option>Consequatur ducimus maiores voluptatum min</option>
																</select>
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Número de Cuenta:</th> 
																<th>Rut:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="cta_bancaria" class="form-control1" id="cta_bancaria" placeholder="Nº Cuenta Bancaria">
															</td>
															<td>
																<input type="text" name="rutfp" class="form-control1" id="rutfp" placeholder="Rut">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Nombre Completo:</th> 
																<th>Email:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="nombrefp" class="form-control1" id="nombrefp" placeholder="Nombre Completo">
															</td>
															<td>
																<input type="text" name="emailfp" class="form-control1" id="emailfp" placeholder="Email">
															</td>
														</tbody>
													</table>
												</section>
											</div>

											<div class="tab-pane" id="otros">
												<section class="otros">
													<table class="table table-striped">
														<thead>
															<tr>
																<th>Número Funcionario SAP:</th>
																<th>Número de Tarjeta:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<input type="text" name="funcionario" class="form-control1" id="funcionario" placeholder="Número Funcionario SAP">
															</td>
															<td>
																<input type="text" name="tarjeta" class="form-control1" id="tarjeta" placeholder="Número de Tarjeta">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>Imprime Tickets:</th>
																<th>Horas de Trabajo:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<select name="selector1" id="selector1" class="form-control1">
																	<option>Seleccione.</option>
																	<option>Dolore, ab unde modi est!</option>
																	<option>Illum, fuga minus sit eaque.</option>
																	<option>Consequatur ducimus maiores voluptatum min</option>
																</select>
															</td>
															<td>
																<input type="text" name="horas_trabajo" class="form-control1" id="horas_trabajo" placeholder="Horas de Trabajo">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>Código de Anexo:</th>
																<th>2do Vencimiento:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<input type="text" name="codigo_anexo" class="form-control1" id="codigo_anexo" placeholder="Código de Anexo">
															</td>
															<td>
																<input placeholder="2do Vencimiento" class="form-control1" id="datepicker12" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" />
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>Anticipo Ind Monto:</th>
																<th>Anticipo Ind Días:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<input type="text" name="anticipo_monto" class="form-control1" id="anticipo_monto" placeholder="0">
															</td>
															<td>
																<input type="text" name="anticipo_dias" class="form-control1" id="anticipo_dias" placeholder="0">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>Autoriz Firma Doc:</th>
																<th>Sucursal Entrenam:</th>
																<th>Código Ocupación:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<select name="selector1" id="selector1" class="form-control1">
																	<option>Seleccione.</option>
																	<option>Dolore, ab unde modi est!</option>
																	<option>Illum, fuga minus sit eaque.</option>
																	<option>Consequatur ducimus maiores voluptatum min</option>
																</select>
															</td>
															<td>
																<input type="text" name="sucursal_entrenamiento" class="form-control1" id="sucursal_entrenamiento" placeholder="Sucursal Entrenamiento">
															</td>
															<td>
																<input type="text" name="codigo_ocupacion" class="form-control1" id="codigo_ocupacion" placeholder="0">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>Evaluador:</th>
																<th>Usuario Windows:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<input type="text" name="evaluador" class="form-control1" id="evaluador" placeholder="Evaluador">
															</td>
															<td>
																<input type="text" name="usuario_windows" class="form-control1" id="usuario_windows" placeholder="Usuario Windows">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>Cuenta Contable:</th>
																<th>Nivel de Sence:</th>
																<th>Franquicia Sence %:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<input type="text" name="cuenta_contable" class="form-control1" id="cuenta_contable" placeholder="0">
															</td>
															<td>
																<input type="text" name="nivel_sence" class="form-control1" id="nivel_sence" placeholder="0">
															</td>
															<td>
																<input type="text" name="franquicia" class="form-control1" id="franquicia" placeholder="0,00 %">
															</td>
														</tbody>
													</table>
												</section>
											</div>

											<div class="tab-pane" id="configuracion">
												<section class="configuracion">
													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Vacaciones:</th> 
																<th>Cheque Restaurante:</th>
																<th>Licencias Médicas</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="vacaciones" class="form-control1" id="vacaciones" placeholder="Vacaciones" data-toggle="modal" data-target="#myModal12">
															</td>
															<td>
																<input type="text" name="cheque_restau" class="form-control1" id="cheque_restau" placeholder="Cheque Restaurante" data-toggle="modal" data-target="#myModal9">
															</td>
															<td>
																<input type="text" name="licencia_medica" class="form-control1" id="licencia" placeholder="Licencias Médicas" data-toggle="modal" data-target="#myModal10">
															</td>
														</tbody>
													</table>
												</section>
											</div>
										</div>
										<br>
										<br>
										<button type="submit" class="btn btn-info">Guardar</button>
										
										<a href="<?php echo base_url();?>rrhh/mantencion_personal" class="btn btn-success">Volver</a>	
									</div>
								</div>

							</form>
<script>
function VerificaRut(rut) {
    if (rut.toString().trim() != '') {
      
        var caracteres = new Array();
        var serie = new Array(2, 3, 4, 5, 6, 7);
        var dig = rut.toString().substr(rut.toString().length - 1, 1);
        rut = rut.toString().substr(0, rut.toString().length - 1);
        for (var i = 0; i < rut.length; i++) {
            caracteres[i] = parseInt(rut.charAt((rut.length - (i + 1))));
        }
 
        var sumatoria = 0;
        var k = 0;
        var resto = 0;
 
        for (var j = 0; j < caracteres.length; j++) {
            if (k == 6) {
                k = 0;
            }
            sumatoria += parseInt(caracteres[j]) * parseInt(serie[k]);
            k++;
        }
 
        resto = sumatoria % 11;
        dv = 11 - resto;
 
        if (dv == 10) {
            dv = "K";
        }
        else if (dv == 11) {
            dv = 0;
        }

        if (dv.toString().trim().toUpperCase() == dig.toString().trim().toUpperCase())
            return true;
        else
            return false;
    }
    else {
        return false;
    }
  }


  function replaceAll( text, busca, reemplaza ){
  while (text.toString().indexOf(busca) != -1)
      text = text.toString().replace(busca,reemplaza);
  return text;
}




$(document).ready(function(){

  $('.numeros').keypress(function(event){
    if ((event.keyCode < 48 || event.keyCode > 57) && event.keyCode != 46){
      event.preventDefault();
    } 
  })   
});


/*

$(document).ready(function() {
    $('#basicBootstrapForm').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            lectura: {
                // The children's full name are inputs with class .childFullName
                selector: '.apaterno',
                // The field is placed inside .col-xs-6 div instead of .form-group
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Informaci&oacute;n de Horas Extraordinarias es requerida'
                    },
                },

            },
        }
    })
    
});*/
</script>

<!--date-piker-->
<link rel="stylesheet" href="css/jquery-ui.css" />
<script src="js/jquery-ui.js"></script>
<script>
	$(function() {
		$( "#datepicker,#datepicker2,#datepicker3,#datepicker4,#datepicker5,#datepicker6,#datepicker7,#datepicker8,#datepicker9,#datepicker10,#datepicker11,#datepicker12,#feriados,#fecha_real,#vencimiento_1,#fechanacimiento,#fecha_inicio_vacaciones").datepicker();
	});
</script>
<!--date-piker-->								