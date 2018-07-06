<!--<?php if(isset($message)): ?>
     <div class="row">
        <div class="col-md-12">
                  <div class="alert alert-<?php echo $classmessage; ?> alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa <?php echo $icon;?>"></i> Alerta!</h4>
                <?php echo $message;?>
              </div>
    </div>            
  </div>
  <?php endif; ?>-->


<!--sub-heard-part--><form id="basicBootstrapForm" action="<?php echo base_url();?>rrhh/editar_trabajador" id="basicBootstrapForm" method="post">
<!--sub-heard-part-->	
								<div class="sub-heard-part">
									<ul class="nav nav-tabs">
  										<li class="active"><a href="#datospersonales" data-toggle="tab">Datos Personales&nbsp;&nbsp;<i class="fa"></i> </a></li>
  										<li><a href="#datosempresa" data-toggle="tab"> Datos Empresa&nbsp;&nbsp;<i class="fa"></i></a></li>
  										<li><a href="#datosllss" data-toggle="tab">L.L.S.S&nbsp;&nbsp;<i class="fa"></i></a></li>
  										<li><a href="#pago" data-toggle="tab">Forma Pago&nbsp;&nbsp;<i class="fa"></i></a></li>
  										<!--li><a href="#otros" data-toggle="tab">Otros&nbsp;&nbsp;<i class="fa"></i></a></li-->
  										<li><a href="#configuracion" data-toggle="tab">Configuraciones&nbsp;&nbsp;<i class="fa"></i></a></li>
									</ul>
								</div>
								<!--//sub-heard-part-->
								
								<div class="graph-visual tables-main">
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

							                        <div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Rut Colaborador</label>
								                             	<input type="text" name="rut" id="rut"  class="form-control"  placeholder="98123456-7" title="Escriba Rut" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                                <label for="nombre">Número de Ficha</label>  
								                                 <input type="text" name="numficha" id="numficha" class="form-control" id="" placeholder="Número de Ficha" >
								                            </div>
								                          </div>

							                        </div>

													<div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Nombre Completo</label>
								                             	<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre Completo" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                                <label for="nombre">Apellido Parterno</label>  
								                                 <input type="text" name="apaterno" class="form-control" id="apaterno" placeholder="Apellido Parterno" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
								                            </div>
								                          </div>

							                        </div>							                        

													<div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Apellido Materno</label>
								                             	<input type="text" name="amaterno" class="form-control" id="amaterno" placeholder="Apellido Materno" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                                <label for="nombre">Fecha de Nacimiento</label> 
								                                <div class="input-group">
								                                <div class="input-group-addon">
								                                  <span class="glyphicon glyphicon-calendar"></span>
								                                </div> 
								                                 <input placeholder="Fecha de Nacimiento" name="fechanacimiento" id="fechanacimiento" class="form-control mask_date" required type="text" value="" onchange="calculaedad(this.value)"> <span id="edad" style="font-style:italic"></span>
								                                 </div>
								                            </div>
								                          </div>

							                        </div>	

													<div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Nacionalidad</label>
								                             	<select name="nacionalidad" id="nacionalidad" class="form-control" required>
																	<option value="">Seleccione Nacionalidad</option>
						                                    		<?php foreach ($paises as $pais) { ?>
								                                      <?php $paisselected = $pais->id == $datos_form['id_nacionalidad'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $pais->id_paises;?>" <?php echo $paisselected;?> ><?php echo $pais->nombre;?></option>
								                                    <?php } ?>
																</select>
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                                <label for="nombre">Estado Civil</label> 
								                                <select name="ecivil" id="ecivil" class="form-control" required>
							                                   <option value="">Seleccione Estado Civil</option>
								                                    <?php foreach ($estados_civiles as $estado_civil) { ?>
								                                      <?php $ecivilselected = $estado_civil->id == $datos_form['idecivil'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $estado_civil->id_estado_civil;?>" <?php echo $ecivilselected;?> ><?php echo $estado_civil->nombre;?></option>
								                                    <?php } ?>
																</select>
								                            </div>
								                          </div>

							                        </div>


													<div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Sexo</label>
								                             	<select name="sexo" id="sexo"  class="form-control" required>
								                                    <option value="">Seleccione Sexo</option>
								                                    <option value="M" <?php echo $datos_form['sexo'] == 'M' ? 'selected' : ''; ?>>Masculino</option>
								                                    <option value="F" <?php echo $datos_form['sexo'] == 'F' ? 'selected' : ''; ?>>Femenino</option>
								                                </select> 
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                                <label for="nombre">Dirección</label> 
								                                <input type="text" name="direccion" id="direccion" class="form-control required" placeholder="Dirección" size ="85"  onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
								                            </div>
								                          </div>

							                        </div>	
													<div class='row'>

								                          <div class='col-md-6'>
								                            <div class="form-group">
								                                <label for="nombre">Región</label> 
								                                <select name="region" id="region" class="form-control">
								                                	<option value="">Seleccione Regi&oacute;n</option>
																	<?php foreach ($regiones as $region) { ?>
								                                      <?php $regionselected = $region->id == $datos_form['idregion'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $region->id_region;?>" <?php echo $regionselected;?> ><?php echo $region->nombre;?></option>
								                                    <?php } ?>
																</select>
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              
								                              <label for="comuna">Comuna</label> 
								                                <select name="comuna" id="comuna"  class="form-control">
								                                  <option value="">Seleccione Comuna</option>
								                                </select>
								                                <input type="hidden" id="idcomuna"  >
								                            </div> 
								                          </div>

								                          


							                        </div>	

													<div class='row'>
								                          				
														<div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Email</label>
								                                <div class="input-group">
                                    							<span class="input-group-addon">@</span>
								                             	<input type="text" name="email" id="email" class="form-control" placeholder="Email" size="40" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
								                             	</div>
								                            </div>
								                          </div>

								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Tipo de Renta</label>
								                             	<select name="tiporenta" id="tiporenta" class="form-control">
																	<option value="">Seleccione Tipo Renta</option>
																	<option value="Mensual">Mensual</option>
																	<option value="Diaria">Diaria</option>
																	<option value="Semanal">Semanal</option>
																</select>
								                            </div>
								                          </div>
								                          

							                        </div>	


							                        <div class='row'>
														<div class='col-md-6'>
								                            <div class="form-group">
								                                <label for="nombre">Cargo</label> 
								                                <select name="cargo" id="cargo"  class="form-control"  >
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
								                            </div>
								                          </div>							                        	
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Estudios</label>
								                             	<select name="estudios" id="estudios" class="form-control">
																	<option value="">Seleccione Nivel Educacional</option>
						                                    		<?php foreach ($estudios as $estudio) { ?>
								                                      <?php $estudioselected = $estudio->id == $datos_form['idestudio'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $estudio->id_estudios;?>" <?php echo $estudioselected;?> ><?php echo $estudio->nombre;?></option>
								                                    <?php } ?>
																</select>
								                            </div>
								                          </div>


							                        </div>	

													<div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                                <label for="nombre">Titulo</label> 
								                                <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Titulo" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
								                            </div>
								                          </div>														
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Idioma</label>
								                             	<select name="idioma" id="idioma" class="form-control">
																	<option value="">Seleccione Idioma</option>
						                                    		<?php foreach ($idiomas as $idioma) { ?>
								                                      <?php $idiomaselected = $idioma->id == $datos_form['ididioma'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $idioma->id_idioma;?>" <?php echo $idiomaselected;?> ><?php echo $idioma->nombre;?></option>
								                                    <?php } ?>
																</select>
								                            </div>
								                          </div>


							                        </div>

													<div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                                <label for="nombre">Jefe o Supervisor</label> 
								                                <select name="jefe" id="jefe" class="form-control">
																	<option value="">Seleccione Jefe o Supervisor</option>
						                                    		<?php foreach ($personal as $trabajador) { ?>
								                                      <?php $jefeselected = $trabajador->id == $datos_form['idjefe'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $trabajador->id_personal;?>" <?php echo $jefeselected;?> ><?php echo $trabajador->nombre." ".$trabajador->apaterno." ".$trabajador->amaterno;?></option>
								                                    <?php } ?>
																</select>
								                            </div>
								                          </div>														
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Reemplazo de</label>
								                             	<select name="reemplazo" id="reemplazo" class="form-control">
																	<option value="">Seleccione Reemplazo</option>
						                                    		<?php foreach ($personal as $trabajador) { ?>
								                                      <?php $jefeselected = $trabajador->id == $datos_form['idjefe'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $trabajador->id_personal;?>" <?php echo $jefeselected;?> ><?php echo $trabajador->nombre." ".$trabajador->apaterno." ".$trabajador->amaterno;?></option>
								                                    <?php } ?>
																</select>
								                            </div>
								                          </div>


							                        </div>	


													<div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                                <label for="nombre">Licencia</label> 
								                                <select name="licencia" id="licencia" class="form-control">
																	<option value="">Seleccione Tipo Licencia</option>
						                                    		<?php foreach ($licencias as $licencia) { ?>
								                                      <?php $licenciaselected = $licencia->id == $datos_form['idlicencia'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $licencia->id_licencia_conducir;?>" <?php echo $licenciaselected;?> ><?php echo $licencia->nombre;?></option>
								                                    <?php } ?>
																</select>
								                            </div>
								                          </div>														
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Talla de Polera</label>
								                             	<select name="polera" id="polera" class="form-control">
																	<option  value="">Seleccione Talla</option>
						                                    		<?php foreach ($polera as $tpolera) { ?>
								                                      <?php $poleraselected = $tpolera->id_vestuario == $datos_form['idvestuario'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $tpolera->id_vestuario;?>" <?php echo $poleraselected;?>><?php echo $tpolera->talla;?></option>
								                                    <?php } ?>
																</select>
								                            </div>
								                          </div>


							                        </div>								                        						   
													<div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                                <label for="nombre">Talla de Pantal&oacute;n</label> 
								                                <select name="pantalon" id="pantalon" class="form-control">
																	<option value="">Seleccione Talla</option>
						                                    		<?php foreach ($pantalon as $tpantalon) { ?>
								                                      <?php $pantalonselected = $tpantalon->id_vestuario == $datos_form['idvestuario'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $tpantalon->id_vestuario;?>" <?php echo $pantalonselected;?>><?php echo $tpantalon->talla;?></option>
								                                    <?php } ?>
																</select>
								                            </div>
								                          </div>														
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Tipo de Documento</label>
								                             	<input type="text" name="tipo_documento" id="tipo_documento" class="form-control" placeholder="Tipo de Documento" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
								                            </div>
								                          </div>


							                        </div>


													<div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                                <label for="nombre">Centro de Costo</label> 
								                                <select name="centro_costo" id="centro_costo" class="form-control">
																	<option value="">Seleccione Centro Costo</option>
						                                    		<?php foreach ($centros_costo as $centro_costo) { ?>
								                                      <?php $centrocostoselected = $centro_costo->id == $datos_form['idcentrocosto'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $centro_costo->id_centro_costo;?>" <?php echo $centrocostoselected;?> ><?php echo $centro_costo->nombre;?></option>
								                                    <?php } ?>
																</select>
								                            </div>
								                          </div>														
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">C de Beneficio</label>
								                             	<input type="text" name="beneficio" id="beneficio" class="form-control" placeholder="C de Beneficio" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
								                            </div>
								                          </div>
								                         
							                        </div>								                        					

														<div class='row'>
								                          
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                                <label for="nombre">N&uacute;mero de Celular</label> 
							                                    <div class="input-group">
							                                      <span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span>  								                                
								                                <input type="text" name="fono" id="fono" class="form-control" placeholder="Número de Celular">
								                            	</div>
								                            </div>
								                          </div>

							                        </div>								                        			                                             								
												
												</section>
											</div>
											<!--Datos de la Empresa-->
											<div class="tab-pane" id="datosempresa">
												<section class="empresa">
													<div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Clase</label>
																<select name="clase" id="clase" class="form-control">
																	<option value="">Seleccione Clase</option>
						                                    		<?php foreach ($clases as $clase) { ?>
								                                      <?php $claseselected = $clase->id_clase == $datos_form['id_clase'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $clase->id_clase;?>" <?php echo $claseselected;?> ><?php echo $clase->nombre;?></option>
								                                    <?php } ?>
								                                   </select>

								                            </div>
								                          </div>

														<div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="parttime">Part Time</label> <br>
								                              <input type="checkbox" name="parttime" id="parttime" class="minimal" <?php echo $datos_form['parttime'] == 1 ? "checked" : ""; ?> />   

								                            </div>  
								                          </div>								                          
								                          

							                        </div>

												<div class='row'>
												 <div class='col-md-6'>
								                            <div class="form-group">
								                                <label for="nombre">Sueldo Base</label>  
								                                 <input type="text" name="sueldo_base" class="form-control" id="sueldo_base" placeholder="Sueldo Base">
								                            </div>
								                          </div>

						                          <div class='col-md-6'>
						                            <div class="form-group">
						                              <label for="diastrabajo">D&iacute;as de Trabajo</label>
						                              <input type="text" class="form-control" name="diastrabajo" id="diastrabajo" placeholder="Ingrese D&iacute;as de Trabajo" value="<?php echo $datos_form['diastrabajo']; ?>" >                            
						                            </div> 
						                          </div>	

						                          						                          
						                        </div>

						                        <div class='row'>

						                          <div class='col-md-6'>
						                            <div class="form-group">
						                              <label for="horasdiarias">Horas Diarias</label>
						                              <input type="text" class="form-control" name="horasdiarias" id="horasdiarias" placeholder="Ingrese Horas Diarias" value="<?php echo $datos_form['horasdiarias']; ?>" >                            
						                            </div> 
						                          </div>


						                          <div class='col-md-6'>
						                            <div class="form-group">
						                              <label for="horassemanales">Horas Semanales</label>
						                              <input type="text" class="form-control" name="horassemanales" id="horassemanales" placeholder="Ingrese Horas Semanales" value="<?php echo $datos_form['horassemanales']; ?>" >   
						                            </div> 
						                          </div>

						                          

						                        </div>                        

						                        <div class='row'>
						                          <div class='col-md-6'>
						                            <div class="form-group">
						                                <label for="tipogratificacion">Tipo Gratificaci&oacute;n</label>   
						                                <select name="tipogratificacion" id="tipogratificacion"  class="form-control">
						                                    <option value="">Seleccione Tipo de Gratificaci&oacute;n</option>
						                                    <option value="SG" <?php echo $datos_form['tipogratificacion'] == 'SG' ? 'selected' : ''; ?>>Sin Gratificaci&oacute;n</option>
						                                    <option value="TL" <?php echo $datos_form['tipogratificacion'] == 'TL' ? 'selected' : ''; ?>>Tope Legal</option>
						                                    <option value="MF" <?php echo $datos_form['tipogratificacion'] == 'MF' ? 'selected' : ''; ?>>Monto Fijo</option>
						                                </select> 
						                            </div> 
						                          </div>


						                          <div class='col-md-6'>
						                            <div class="form-group">
						                              <label for="gratificacion">Monto Gratificaci&oacute;n</label>
						                              <input type="text" class="form-control miles" name="gratificacion" id="gratificacion" placeholder="Ingrese Monto Gratificaci&oacute;n" value="<?php echo $datos_form['gratificacion'] == 0 ? '' : $datos_form['gratificacion']; ?>" <?php echo $datos_form['tipogratificacion'] == 'MF' ? '' : 'disabled'; ?> >                            
						                            </div> 
						                          </div>


						                         
						                          
						                        </div>

													<div class='row'>
														 <div class='col-md-6'>
						                            <div class="form-group">
						                                <label for="movilizacion">Valor Movilizaci&oacute;n</label>   
						                                <input type="text" class="form-control miles" name="movilizacion" id="movilizacion" placeholder="Ingrese Valor Movilizaci&oacute;n" value="<?php echo $datos_form['movilizacion']; ?>" >                            
						                            </div> 
						                          </div>


														<div class='col-md-6'>
								                            <div class="form-group">
								                                <label for="colacion">Valor Colaci&oacute;n</label>   
								                                <input type="text" class="form-control miles" name="colacion" id="colacion" placeholder="Ingrese Valor Colaci&oacute;n" value="<?php echo $datos_form['colacion']; ?>" >                            
								                            </div> 
								                         </div>


								                          
								                          

							                        </div>
													<div class='row'>

														<div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Tipo C.C</label>
																	<select name="tipo_cc" id="tipo_cc" class="form-control">
																	<option value="">Seleccione Tipo CC</option>
						                                    		<?php foreach ($tipo_cc as $tip_cc) { ?>
								                                      <?php $tipoccselected = $tip_cc->id_tipocc == $datos_form['id_tipocc'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $tip_cc->id_tipocc;?>" <?php echo $tipoccselected;?> ><?php echo $tip_cc->nombre;?></option>
								                                    <?php } ?>
								                                   </select>	

								                            </div>
								                          </div>

														<div class='col-md-6'>
								                            <div class="form-group">
								                                <label for="nombre">Categoria</label>  
								                                 <select name="categoria" id="categoria" class="form-control">
																	<option value="">Seleccione Categoria</option>
						                                    		<?php foreach ($categorias as $categoria) { ?>
								                                      <?php $categoriaselected = $categoria->id == $datos_form['idcategoria'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $categoria->id_categoria;?>" <?php echo $categoriaselected;?> ><?php echo $categoria->nombre;?></option>
								                                    <?php } ?>
																</select>
								                            </div>
								                          </div>


								                          
								                          

							                        </div>
							                        <div class='row'>

							                        	<div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Lugar de Pago</label>
								                             	<select name="lugar_pago" id="lugar_pago" class="form-control">
																	<option value="">Seleccione Lugar de Pago</option>
						                                    		<?php foreach ($lugar_pago as $lugar_pagos) { ?>
								                                      <?php $lugarpagosselected = $lugar_pagos->id == $datos_form['idlugarpago'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $lugar_pagos->id_lugar_pago;?>" <?php echo $lugarpagosselected;?> ><?php echo $lugar_pagos->nombre;?></option>
								                                    <?php } ?>
																</select>

								                            </div>
								                          </div>


							                        	<div class='col-md-6'>
								                            <div class="form-group">
								                                <label for="nombre">Fecha de Ingreso</label>  
								                                <div class="input-group">
								                                <div class="input-group-addon">
								                                  <span class="glyphicon glyphicon-calendar"></span>
								                                </div> 
								                                 <input placeholder="Fecha Ingreso" class="form-control mask_date" id="datepicker2" name="datepicker2" type="text" value=""  data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
								                                 </div>
								                            </div>
								                          </div>
								                          
								                          

							                        </div>
							                        <div class='row'>

							                        	<div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Fecha de Retiro</label>
								                              <div class="input-group">
								                                <div class="input-group-addon">
								                                  <span class="glyphicon glyphicon-calendar"></span>
								                                </div>
								                             	<input placeholder="Fecha Retiro" class="form-control mask_date" id="fecha_retiro" name="fecha_retiro" type="text" value="" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask >
								                             	</div>
								                            </div>
								                          </div>

							                        	<div class='col-md-6'>
								                            <div class="form-group">
								                                <label for="nombre">Fecha de Finiquito</label>  
								                                <div class="input-group">
								                                <div class="input-group-addon">
								                                  <span class="glyphicon glyphicon-calendar"></span>
								                                </div>
								                                 <input placeholder="Fecha de Finiquito" class="form-control mask_date" id="datepicker4"  name="datepicker4" type="text" value="" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
								                                 </div>
								                            </div>
								                          </div>


								                          
								                          

							                        </div>
							                        <div class='row'>

							                        	<div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Fecha Inicio Cálculo Vacaciones</label>
								                              <div class="input-group">
								                                <div class="input-group-addon">
								                                  <span class="glyphicon glyphicon-calendar"></span>
								                                </div>
								                             	<input placeholder="Fecha Inicio Vacaciones" class="form-control mask_date" id="fecha_inicio_vacaciones" name="fecha_inicio_vacaciones"   size="30" type="text" value="" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
								                             	</div>
								                            </div>
								                          </div>

							                        	<div class='col-md-6'>
								                            <div class="form-group">
								                            	<label for="rut">Saldo Inicial Días Vacaciones Legales</label>
								                                <input type="text" class="form-control" id="vacaciones_legales" name="vacaciones_legales" placeholder="Saldo Inicial Vacaciones Legales" size="30" value="0">
								                            </div>
								                          </div>


								                          
								                          

							                        </div>

							                        <div class='row'>

							                        	<div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Saldo Inicial Días Vacaciones Progresivas</label>
								                             	<input type="text" name="vacaciones_progresivas" class="form-control" id="vacaciones_progresivas" placeholder="Saldo Inicial Vacaciones Progresivas" size="30" value="0">

								                            </div>
								                          </div>

							                        	<div class='col-md-6'>
								                            <div class="form-group">
								                            	<label for="rut">Motivo de Egreso</label>
																<select name="motivo_egreso" id="motivo_egreso" class="form-control">
																	<option value="">Seleccione Motivo Egreso</option>
						                                    		<?php foreach ($motivo_egreso as $motivo) { ?>
								                                      <?php $motivoselected = $motivo->id_motivo == $datos_form['id_motivo'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $motivo->id_motivo;?>" <?php echo $motivoselected;?> ><?php echo $motivo->nombre;?></option>
								                                    <?php } ?>
																</select>
								                            </div>
								                          </div>


								                          
								                          

							                        </div>		

													<div class='row'>


														<div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Tipo de Contrato</label>
																<select name="tipocontrato" id="tipocontrato" class="form-control">
																	<option value="">Seleccione Tipo de Contrato</option>
																	<option  value="F">Plazo Fijo</option>
																	<option  value="I">Indefinido</option>
																	
																</select>

								                            </div>
								                          </div>

														<div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Sección</label>
																<select name="seccion" id="seccion" class="form-control">
																	<option value="">Seleccione Secci&oacute;n</option>
						                                    		<?php foreach ($secciones as $seccion) { ?>
								                                      <?php $seccionselected = $seccion->id_seccion == $datos_form['id_seccion'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $seccion->id_seccion;?>" <?php echo $seccionselected;?> ><?php echo $seccion->nombre;?></option>
								                                    <?php } ?>
								                                   </select>	

								                            </div>
								                          </div>

								                         
								                          
							                        </div>		

							                        <div class='row'>
							                        	 <div class='col-md-6'>
								                            <div class="form-group">
								                            	<label for="rut">Código Ine</label>
																<select name="codigo_ine" id="codigo_ine" class="form-control">
																	<option value="">Seleccione C&oacute;digo INE</option>
						                                    		<?php foreach ($cod_ine as $ine) { ?>
								                                      <?php $ineselected = $ine->id_ine == $datos_form['id_ine'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $ine->id_ine;?>" <?php echo $ineselected;?> ><?php echo $ine->nombre;?></option>
								                                    <?php } ?>
								                                   </select>																
								                            </div>
								                          </div>
							                        	<div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Sindicato</label>
																<select name="sindicato" id="sindicato" class="form-control">
																	<option value="SI">SI</option>
																	<option value="NO">NO</option>
																
																</select>

								                            </div>
								                          </div>


								                          
								                          
							                        </div>			


							                        <div class='row'>

							                        	<div class='col-md-6'>
								                            <div class="form-group">
								                            	<label for="rut">Rol Privado</label>
																<select name="regimen_pago" id="regimen_pago" class="form-control">
																	<option value="SI">SI</option>
																	<option value="NO">NO</option>
																
																</select>
								                            </div>
								                          </div>
							                        	<div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Semana Corrida</label>
																<select name="semana_corrida" id="semana_corrida" class="form-control">
																	<option value="SI">SI</option>
																	<option value="NO">NO</option>
																
																</select>
								                            </div>
								                          </div>

								                          
								                          
							                        </div>		


							                         <div class='row'>


							                         	<div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Situaci&oacute;n Laboral</label>
																<select name="situacion_laboral" id="situacion_laboral" class="form-control">
																	<option value="">Seleccione Situaci&oacute;n Laboral</option>
						                                    		<?php foreach ($situacion_laboral as $situacion) { ?>
								                                      <?php $situacionselected = $situacion->id_situacion == $datos_form['id_situacion'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $situacion->id_situacion;?>" <?php echo $situacionselected;?> ><?php echo $situacion->nombre;?></option>
								                                    <?php } ?>
								                                   </select>
								                            </div>
								                          </div>
								                          
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Zona Brecha</label>
																<select name="zona_brecha" id="zona_brecha" class="form-control">
																	<option value="">Seleccione Zona Brecha</option>
						                                    		<?php foreach ($zonas_brechas as $zona_brecha) { ?>
								                                      <?php $zonabrechaselected = $zona_brecha->id_zona == $datos_form['id_zona'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $zona_brecha->id_zona;?>" <?php echo $zonabrechaselected;?> ><?php echo $zona_brecha->nombre;?></option>
								                                    <?php } ?>
								                                   </select>
								                            </div>
								                          </div>


								                          
								                          
							                        </div>							                        					       
							                        <div class='row'>
							                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Fecha Real Contrato</label>
								                              <div class="input-group">
								                                <div class="input-group-addon">
								                                  <span class="glyphicon glyphicon-calendar"></span>
								                                </div>
																<input placeholder="Fecha Real" class="form-control mask_date" id="fecha_real" name="fecha_real" type="text" value="" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
																</div>

								                            </div>
								                          </div>
							                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">1er Vencimiento</label>
								                              <div class="input-group">
								                                <div class="input-group-addon">
								                                  <span class="glyphicon glyphicon-calendar"></span>
								                                </div>
																<input placeholder="1er Vencimiento" class="form-control mask_date" id="vencimiento_1" name="vencimiento_1" type="text" value="" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
																</div>
								                            </div>
								                      </div>


							                          
							                        </div>                

												</section>
											</div>

											<div class="tab-pane" id="datosllss">
												<section class="llss">

													 <div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">L. Pago Cotiz</label>
																<input type="text" name="pago_cotiza" class="form-control" id="pago_cotiza" placeholder="L. Pago Cotiz">
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">A.F.P</label>
																<select name="afp" id="afp" class="form-control">
																	<option value="">Seleccione AFP</option>
						                                    		<?php foreach ($afps as $afp) { ?>
								                                      <?php $afpselected = $afp->id == $datos_form['idafp'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $afp->id_afp;?>" <?php echo $afpselected;?> ><?php echo $afp->nombre;?></option>
								                                    <?php } ?>
								                                   </select>																

								                            </div>
								                          </div>

							                        </div>

													 <div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Pensionado</label><br>
																<input type="checkbox" name="pensionado" id="pensionado" class="minimal" />   
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Fecha Incorporación AFP</label>
								                              <div class="input-group">
								                                <div class="input-group-addon">
								                                  <span class="glyphicon glyphicon-calendar"></span>
								                                </div>
																<input placeholder="Fecha Incorp.AFP" class="form-control mask_date" id="datepicker5" name="datepicker5" type="text" value="" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>		
															</div>										

								                            </div>
								                          </div>

							                        </div>



													 <div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Seguro Cesantia</label><br>
																<input class="minimal" id="seguro_cesantia" name="seguro_cesantia" type="checkbox" onchange="habilitar(this.checked);" > 
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Fecha Ingreso AFC</label>
								                              <div class="input-group">
								                                <div class="input-group-addon">
								                                  <span class="glyphicon glyphicon-calendar"></span>
								                                </div>
																<input placeholder="Fecha Ingreso AFC" class="form-control  mask_date" id="datepicker6" name="datepicker6" type="text" value="" disabled data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>		
															</div>	


																													

								                            </div>
								                          </div>

							                        </div>

 													<div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Cese AFC</label>
																<input type="text" name="cese" class="form-control" id="cese" placeholder="Cese AFC" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"> 
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Isapre</label>
																<select name="isapre" id="isapre" class="form-control">
																	<option value="">Seleccione Isapre</option>
						                                    		<?php foreach ($isapres as $isapre) { ?>
								                                      <?php $isapreselected = $isapre->id == $datos_form['idisapre'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $isapre->id_isapre;?>" <?php echo $isapreselected;?> ><?php echo $isapre->nombre;?></option>
								                                    <?php } ?>
								                                   </select>									

								                            </div>
								                          </div>

							                        </div>	

							                     	<div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Monto Pactado Plan Isapre (UF)</label>
																<input type="number" min="0" max="99" minlength="1" maxlength="2" step="0.01" name="monto_pactado"  class="form-control" id="monto_pactado" placeholder="">
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Número FUN</label>
																<input type="text" name="numero_fun" class="form-control" id="numero_fun" placeholder="Número FUN">								

								                            </div>
								                          </div>

							                        </div>
							                     	<div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Vencimiento de Plan</label>
								                            <div class="input-group">
								                                <div class="input-group-addon">
								                                  <span class="glyphicon glyphicon-calendar"></span>
								                                </div>
																<input placeholder="Vencimiento Plan" class="form-control mask_date" id="datepicker9" name="datepicker9" type="text" value="" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
															</div>
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">A.P.V.</label>
																<select name="apv" id="apv" class="form-control" >
																	<option value="">Seleccione APV</option>
						                                    		<?php foreach ($apv as $apvs) { ?>
								                                      <?php $apvselected = $apvs->id_apv == $datos_form['idapv'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $apvs->id_apv;?>" <?php echo $apvselected;?> ><?php echo $apvs->nombre;?></option>
								                                    <?php } ?>
								                                   </select>								

								                            </div>
								                          </div>

							                        </div>
													<div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Numero Contrato A.P.V.</label>
																<input type="number" name="numero_contrato_apv" class="form-control" id="numero_contrato_apv" placeholder="Numero Contrato">
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Tipo Cotización A.P.V.</label>
																<select name="tipo_cotizacion" id="tipo_cotizacion" class="form-control">
																	<option value="pesos">PESO</option>
																	<option value="uf">UF</option>
																	<option value="porcentaje">PORCENTAJE</option>
																</select>							

								                            </div>
								                          </div>

							                        </div>	
							                        <div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Monto Cotización A.P.V.</label>
																<input type="text" name="monto_cotizacion_apv" maxlength="2" class="form-control" id="monto_cotizacion_apv" placeholder="Monto Cotizacion">
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Nro. Cargas Simples</label>
																<input type="number" name="asig_individual" class="form-control cargas_familiares" id="asig_individual" placeholder="">
								                            </div>
								                          </div>								                          
								                         

							                        </div>							                        
							                        <div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Nro. Cargas Inv&aacute;lidas</label>
																<input type="number" name="asig_por_invalidez" class="form-control" id="asig_por_invalidez" placeholder="">
								                            </div>
								                          </div>							                        	
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Nro. Cargas Maternales</label>
																<input type="number" name="asig_maternal" class="form-control cargas_familiares" id="asig_maternal" placeholder="">
								                            </div>
								                          </div>								                          


							                        </div>	
							                        <div class='row'>
 														<div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Tramo p/Asig. Fami</label>
																<select name="tramo" id="tramo" class="form-control" disabled>
																	<option value="">Seleccione tramo</option>
						                                    		<?php foreach ($tramos_asig_familiar as $tramo) { ?>
								                                      <?php $tramoselected = $tramo->id_tabla_asig_familiar == $datos_form['id_tabla_asig_familiar'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $tramo->id_tabla_asig_familiar;?>" <?php echo $tramoselected;?> ><?php echo 'TRAMO '.$tramo->tramo;?></option>
								                                    <?php } ?>																
								                                </select>							

								                            </div>
								                          </div>

														<div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Trabajo Pesado/Insalub</label>
																<input type="text" name="trabajo_pesado" class="form-control" id="trabajo_pesado" placeholder="Trabajo Pesado/Insalub">
								                            </div>
								                          </div>
							                        </div>	

							                        <div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Estado APVC</label>
																<input type="text" name="estado_apvc" class="form-control" id="estado_apvc" placeholder="Estado APVC" >
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Fecha APVC</label>
								                              <div class="input-group">
								                                <div class="input-group-addon">
								                                  <span class="glyphicon glyphicon-calendar"></span>
								                                </div>
																<input placeholder="Fecha APVC" class="form-control mask_date" id="datepicker10" name="datepicker10" type="text" value="" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask >
																</div>
								                            </div>
								                          </div>

							                        </div>

							                        <div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Término de Subsidio</label>
								                              <div class="input-group">
								                                <div class="input-group-addon">
								                                  <span class="glyphicon glyphicon-calendar"></span>
								                                </div>
																<input placeholder="Término de Subsidio" class="form-control mask_date" id="datepicker11" name="datepicker11" type="text" value="" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
																</div>
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Zona A. Familiar</label>
																<input type="text" name="zona_familiar" class="form-control" id="zona_familiar" placeholder="Zona A. Familiar">
								                            </div>
								                          </div>

							                        </div>
							                        <!--div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Jornada de Trabajo</label>
																<select name="jornada_trabajo" id="jornada_trabajo" class="form-control">
																	<option value="">Seleccione Jornada de Trabajo</option>
						                                    		<?php foreach ($jornada_trabajo as $jornada) { ?>
								                                      <?php $jornadaselected = $jornada->id_jornada == $datos_form['id_jornada'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $jornada->id_jornada;?>" <?php echo $jornadaselected;?> ><?php echo $jornada->nombre;?></option>
								                                    <?php } ?>
																</select>																
								                            </div>
								                          </div>

							                        </div-->

												</section>
											</div>

											<div class="tab-pane" id="pago">
												<section class="formapago">
													<div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Forma de Pago</label>
																<select name="forma_pago" id="forma_pago" class="form-control">
																	<option value="">Seleccione Forma de Pago</option>
						                                    		<?php foreach ($forma_pago as $pago) { ?>
								                                      <?php $pagoselected = $pago->id_forma_pago == $datos_form['id_forma_pago'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $pago->id_forma_pago;?>" <?php echo $pagoselected;?> ><?php echo $pago->descripcion;?></option>
								                                    <?php } ?>
																</select>
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Banco</label>
																<select name="banco" id="banco" class="form-control">
																	<option value="">Seleccione Banco</option>
						                                    		<?php foreach ($bancos as $banco) { ?>
								                                      <?php $bancoselected = $banco->id_banco == $datos_form['id_banco'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $banco->id_banco;?>" <?php echo $bancoselected;?> ><?php echo $banco->cod_sbif.' - '.$banco->nombre;?></option>
								                                    <?php } ?>																
								                                </select>
								                            </div>
								                          </div>

							                        </div>

							                        <div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Número de Cuenta</label>
																<input type="text" name="cta_bancaria" class="form-control" id="cta_bancaria" placeholder="Nº Cuenta Bancaria">
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Rut</label>
																<input type="text" name="rutfp" class="form-control" id="rutfp" placeholder="Rut">
								                            </div>
								                          </div>

							                        </div>
													
													<div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Nombre Completo</label>
																<input type="text" name="nombrefp" class="form-control" id="nombrefp" placeholder="Nombre Completo" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Email</label>
								                                <div class="input-group">
                                    							<span class="input-group-addon">@</span>
																<input type="text" name="emailfp" class="form-control" id="emailfp" placeholder="Email" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
																</div>
								                            </div>
								                          </div>

							                        </div>
													

													
												</section>
											</div>

											<div class="tab-pane" id="otros">
												<section class="otros">

												<div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Número Funcionario SAP</label>
																<input type="text" name="funcionario" class="form-control" id="funcionario" placeholder="Número Funcionario SAP">
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Número de Tarjeta</label>
																<input type="text" name="tarjeta" class="form-control" id="tarjeta" placeholder="Número de Tarjeta">
								                            </div>
								                          </div>

							                        </div>

							                        <div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Imprime Tickets</label>
																<select name="selector1" id="selector1" class="form-control">
																	<option>Seleccione.</option>
																	<option>Dolore, ab unde modi est!</option>
																	<option>Illum, fuga minus sit eaque.</option>
																	<option>Consequatur ducimus maiores voluptatum min</option>
																</select>
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Código de Anexo</label>
																<input type="text" name="codigo_anexo" class="form-control" id="codigo_anexo" placeholder="Código de Anexo">
								                            </div>
								                          </div>							                          
								                          
							                        </div>
													
							                        													
							                        <div class='row'>

								                          
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">2do Vencimiento</label>
																<input placeholder="2do Vencimiento" class="form-control" id="datepicker12" type="text" value="" >
								                            </div>
								                          </div>

								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Anticipo Ind Monto</label>
																<input type="text" name="anticipo_monto" class="form-control" id="anticipo_monto" placeholder="0">
								                            </div>
								                          </div>


							                        </div>
													
													<div class='row'>
								                          
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Anticipo Ind Días</label>
																<input type="text" name="anticipo_dias" class="form-control" id="anticipo_dias" placeholder="0">
								                            </div>
								                          </div>

								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Autoriz Firma Doc</label>
																<select name="selector1" id="selector1" class="form-control">
																	<option>Seleccione.</option>
																	<option>Dolore, ab unde modi est!</option>
																	<option>Illum, fuga minus sit eaque.</option>
																	<option>Consequatur ducimus maiores voluptatum min</option>
																</select>
								                            </div>
								                          </div>

							                        </div>

							                        <div class='row'>
								                          
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Sucursal Entrenam</label>
																<input type="text" name="sucursal_entrenamiento" class="form-control" id="sucursal_entrenamiento" placeholder="Sucursal Entrenamiento">
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Código Ocupación</label>
																<input type="text" name="codigo_ocupacion" class="form-control" id="codigo_ocupacion" placeholder="0">
								                            </div>
								                          </div>
							                        </div>

							                         <div class='row'>
								                          
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Evaluador</label>
																<input type="text" name="evaluador" class="form-control" id="evaluador" placeholder="Evaluador">
								                            </div>
								                          </div>

								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Usuario Windows</label>
																<input type="text" name="usuario_windows" class="form-control" id="usuario_windows" placeholder="Usuario Windows">
								                            </div>
								                          </div>

							                        </div>
							                        <div class='row'>
								                          
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Cuenta Contable</label>
																<input type="text" name="cuenta_contable" class="form-control" id="cuenta_contable" placeholder="0">
								                            </div>
								                          </div>

								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Nivel de Sence</label>
																<input type="text" name="nivel_sence" class="form-control" id="nivel_sence" placeholder="0">
								                            </div>
								                          </div>


							                        </div>

							                        <div class='row'>
								                          
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Franquicia Sence %</label>
																<input type="text" name="franquicia" class="form-control" id="franquicia" placeholder="0,00 %">
								                            </div>
								                          </div>

							                        </div>
													
													
												</section>
											</div>

											<div class="tab-pane" id="configuracion">
												<section class="configuracion">

													<div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Mostrar Vacaciones</label>
																<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#vacaciones">
																	 <span class="glyphicon glyphicon-plane" aria-hidden="true"></span>
																</button>
								                            </div>
								                          </div>
								                          <div class='col-md-6'>
									                           <div class="form-group">
								                              <label for="rut">Cheque Restaurante</label>
																<input type="text" name="cheque_restau" class="form-control" id="cheque_restau" placeholder="Cheque Restaurante" data-toggle="modal" data-target="#myModal9">
								                            </div>
								                          </div>

							                        </div>

							                        <div class='row'>
								                          <div class='col-md-6'>
								                            <div class="form-group">
								                              <label for="rut">Licencias Médicas</label>
																<input type="text" name="licencia_medica" class="form-control" id="licencia" placeholder="Licencias Médicas" data-toggle="modal" data-target="#myModal10">
								                            </div>
								                          </div>
								                          

							                        </div>

												</section>
											</div>
										</div>		<br>
										<br>
										<button type="submit" class="btn btn-info">Guardar</button>
										
										<a href="<?php echo base_url();?>rrhh/mantencion_personal" class="btn btn-success">Volver</a>	
									</div>
								</div>
							
							</form>



<div class="modal fade bs-example-modal-lg" id="vacaciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				Vacaciones
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel"></h4>
			</div>
			<div class="modal-body">
				 <div class="panel panel-inverse">                       
				    <div class="panel-heading">
				        <h4 class="panel-title">Detalle Vacaciones</h4>
				    </div>  
				    <div class="panel-body">
					 <form id="basicBootstrapForm" action="" id="basicBootstrapForm" method="post"> 
			            <div class="row">
			                <div class="col-md-12">
			                          <table  class="table table-bordered table-striped dt-responsive">
			                          <thead>
			                            <tr>
			                              <th rowspan="2">#</th>
			                              <th rowspan="2">Rut</th>
			                              <th rowspan="2">Nombre Trabajador</th>
			                              <th colspan="3" ><center>D&iacute;as Devengados</center></th>
			                              <th rowspan="2">Tomados</th>
			                              <th rowspan="2">Saldo</th>
			                              <th rowspan="2">Solicitar</th>
			                              <th rowspan="2">Cartola</th>
			                              <th rowspan="2">D&iacute;as Progresivos</th>
			                            </tr>
			                            <tr>
			                             <th>Legales</th>
			                              <th>Progresivos</th>
			                              <th>Total Devengado</th>
			                            </tr>

			                          </thead>
			                          <tbody>
			                          </tbody>
			                      </table>
							</div>
						</div>
						</form>
				 </div>
      			</div>
			</div>
			<div class="modal-footer">
				 <button type="button" class="btn btn-default" data-dismiss="modal">Volver</button>
			</div>
		</div>
	</div>
</div>



<script>



  function replaceAll( text, busca, reemplaza ){
  while (text.toString().indexOf(busca) != -1)
      text = text.toString().replace(busca,reemplaza);
  return text;
}




$(document).ready(function(){
	$.ajax({type: "GET",
		    		url: "<?php echo base_url();?>rrhh/datos_personal/<?php echo $idrut;?>", 
		    		dataType: "json",
		    		async: false,
		    		success: function(datos_personal2){
		      			$.each(datos_personal2,function(nombre) {
		      			$("#nombre").val(this.nombre);
		      			$("#rut").val(this.rut);
		      			$("#apaterno").val(this.apaterno);
		      			$("#amaterno").val(this.amaterno);
		      			$("#direccion").val(this.direccion);
		      			$("#email").val(this.email);	
        				$("#nacionalidad").val(this.idnacionalidad);
        				$("#sueldo_base").val(this.sueldobase);
        				


        				$("#ecivil").val(this.idecivil);
        				$("#sexo").val(this.sexo);
        				$("#fechanacimiento").val(this.fecnacimiento);
        				$("#cargo").val(this.idcargo);
        				$("#isapre").val(this.idisapre);
        				$("#centro_costo").val(this.idcentrocosto);
        				$("#afp").val(this.idafp);
        				$("#datepicker2").val(this.fecingreso);
        				$("#fecha_real").val(this.fecrealcontrato);
        				$("#vencimiento_1").val(this.primervenc);

        				$("#fecha_retiro").val(this.fecha_retiro);
        				$("#datepicker4").val(this.fecha_finiquito);
        				$("#fecha_inicio_vacaciones").val(this.fecinicvacaciones);
        				$("#vacaciones_legales").val(this.saldoinicvacaciones);
        				$("#vacaciones_progresivas").val(this.saldoinicvacprog);
        				$("#polera").val(this.tallapolera);
        				$("#pantalon").val(this.tallapantalon);
        				$("#titulo").val(this.titulo);

        				if(this.idlicencia == 0){
        					$("#licencia").val('');	
        				}else{
        					$("#licencia").val(this.idlicencia);	
        				}



        				if(this.idestudio == 0){
        					$("#estudios").val('');	
        				}else{
        					$("#estudios").val(this.idestudio);	
        				}

        				$("#fono").val(this.fono);
        				$("#numero_contrato_apv").val(this.nrocontratoapv);

        				if(this.instapv == 0){
        					$("#apv").val('');	
        				}else{
        					$("#apv").val(this.instapv);	
        				}


        				$("#tipo_cotizacion").val(this.tipocotapv);
        				$("#monto_cotizacion_apv").val(this.cotapv);
        				$("#monto_pactado").val(this.valorpactado);

        				if(this.id_categoria == 0){
        					$("#categoria").val('');	
        				}else{
        					$("#categoria").val(this.id_categoria);	
        				}

        				if(this.id_lugar_pago == 0){
        					$("#lugar_pago").val('');	
        				}else{
        					$("#lugar_pago").val(this.id_lugar_pago);	
        				}
        				
        				$("#sindicato").val(this.sindicato);
        				$("#jubilado").val(this.jubilado);
        				$("#regimen_pago").val(this.rol_privado);
        				$("#tramo").val(this.idasigfamiliar);
        				$("#semana_corrida").val(this.semana_corrida);
        				$("#tiporenta").val(this.tiporenta);
        				$("#idioma").val(this.ididioma);
        				$("#numficha").val(this.numficha);
        				$("#datepicker5").val(this.fecafp);
        				$("#datepicker6").val(this.fecafc);
        				$("#datepicker9").val(this.fecvencplan);
        				$("#datepicker10").val(this.fecapvc);
        				$("#datepicker11").val(this.fectermsubsidio);

        				
        				$("#region").val(this.idregion);
        				
        				$("#asig_individual").val(this.cargassimples);
        				$("#asig_por_invalidez").val(this.cargasinvalidas);
        				$("#asig_maternal").val(this.cargasmaternales);

        				var cargas = parseInt(this.cargassimples) + parseInt(this.cargasinvalidas) + parseInt(this.cargasmaternales);



        				$("#banco").val(this.idbanco);
        				$("#forma_pago").val(this.id_forma_pago);
        				$("#cta_bancaria").val(this.nrocuentabanco);
        				$("#tipo_documento").val(this.tipodocumento);
        				$("#tipogratificacion").val(this.tipogratificacion);
        				$("#beneficio").val(this.cbeneficio);
        				$("#movilizacion").val(this.movilizacion);
        				$("#colacion").val(this.colacion);
        				$("#tipocontrato").val(this.tipocontrato);




        				$("#motivo_egreso").val(this.id_motivo_egreso);
        				if(this.id_motivo_egreso == 0){
        					$("#motivo_egreso").val('');
        				}else{
        					$("#motivo_egreso").val(this.id_motivo_egreso);	
        				}


        				
        				if(this.id_seccion == 0){
        					$("#seccion").val('');
        				}else{
        					$("#seccion").val(this.id_seccion);	
        				}

        				if(this.id_situacion == 0){
        					$("#situacion_laboral").val('');
        				}else{
        					$("#situacion_laboral").val(this.id_situacion);	
        				}


        				if(this.id_clase == 0){
        					$("#clase").val('');
        				}else{
        					$("#clase").val(this.id_clase);	
        				}


        				if(this.id_tipocc == 0){
        					$("#tipo_cc").val('');
        				}else{
        					$("#tipo_cc").val(this.id_tipocc);	
        				}

        				if(this.id_ine == 0){
        					$("#codigo_ine").val('');
        				}else{
        					$("#codigo_ine").val(this.id_ine);	
        				}


        				if(this.id_zona == 0){
        					$("#zona_brecha").val('');
        				}else{
        					$("#zona_brecha").val(this.id_zona);	
        				}


        				$("#numero_fun").val(this.fun);
        				$("#rutfp").val(this.rut_pago);
        				$("#nombrefp").val(this.nombre_pago);
        				$("#emailfp").val(this.email_pago);
        				$("#diastrabajo").val(this.diastrabajo);
        				$("#horasdiarias").val(this.horasdiarias);
        				$("#horassemanales").val(this.horassemanales);
        				$("#usuario_windows").val(this.usuario_windows);
        				if(this.idjefe == 0){
        					$("#jefe").val('');
        				}else{
        					$("#jefe").val(this.idjefe);	
        				}
        				
        				if(this.idreemplazo == 0){
        					$("#reemplazo").val('');
        				}else{
        					$("#reemplazo").val(this.idreemplazo);	
        				}
        				
        				

        				
        				
        				$("#idcomuna").val(this.idcomuna);
						
        				
        				if (this.pensionado ==1){
        					//$("#pensionado").val(this.pensionado)
        					//$("#pensionado").prop('checked','checked');
        					$("#pensionado").iCheck('check');

        				}else{
        					//$("#pensionado").prop('checked',false);
        					$("#pensionado").iCheck('uncheck');
        				}        				

						if (this.parttime ==1){
        					//$("#pensionado").val(this.pensionado)
        					//$("#pensionado").prop('checked','checked');
        					$("#parttime").iCheck('check');

        				}else{
        					//$("#pensionado").prop('checked',false);
        					$("#parttime").iCheck('uncheck');
        				}        				

        				if (this.segcesantia ==1){
        					$("#seguro_cesantia").val(this.segcesantia)
        					//document.getElementById("seguro_cesantia").checked = true;
        					$("#seguro_cesantia").iCheck('check');
        					document.getElementById("datepicker6").disabled=false;

        				}else{
        					//document.getElementById("seguro_cesantia").checked = false;
        					$("#seguro_cesantia").iCheck('uncheck');
        					
        					$('#datepicker6').val('');
        					document.getElementById("datepicker6").disabled=true;
        				}


        				if(this.tipogratificacion == 'MF'){
        					$('#gratificacion').prop('disabled','');
        					$("#gratificacion").val(this.gratificacion);
        				}else{
        					$('#gratificacion').prop('disabled','disabled');
        				}
        				
						if(cargas > 0){
						    $('#tramo').attr('disabled',false);
						  }else{
						    $("#tramo").prop('selectedIndex', 0);
						    $('#tramo').attr('disabled',true);
						  }        				
        				
        				$('#gratificacion').mask('000.000.000.000.000', {reverse: true});
        				$('#movilizacion').mask('000.000.000.000.000', {reverse: true});
        				$('#colacion').mask('000.000.000.000.000', {reverse: true});
        				$('#sueldo_base').mask('000.000.000.000.000', {reverse: true});


        				}
        				)}
        				});

    if($('#region').val() != ''){
      $.get("<?php echo base_url();?>admins/get_comunas/"+$('#region').val(),function(data){
               // Limpiamos el select
                    $('#comuna option').remove();
                    var_json = $.parseJSON(data);
                    $('#comuna').append('<option value="">Seleccione Comuna</option>');
                    for(i=0;i<var_json.length;i++){
                      $('#comuna').append('<option value="' + var_json[i].idcomuna + '">' + var_json[i].nombre + '</option>');
                    }


	    			//console.log($('#idcomuna').val());
    				$("#comuna").val($('#idcomuna').val());                     
      });
      // seleccionar comuna

    }	


  $('.numeros').keypress(function(event){
    if ((event.keyCode < 48 || event.keyCode > 57) && event.keyCode != 46){
      event.preventDefault();
    } 
  })


});



</script>
<script language="JavaScript">

		function calculaedad(Fecha){
			var fecha_nueva = Fecha.split("/");

			fecha = new Date(fecha_nueva[2],fecha_nueva[1],fecha_nueva[0])
			hoy = new Date()
			
			ed = parseInt((hoy -fecha)/365/24/60/60/1000)
			if (ed >=0){
				$("#edad").text("Edad: "+ ed +" Año(s)");
			}else{
				$("#edad").text("");
			}
		
		
		}

</script>


<script>
    


$('.cargas_familiares').on('input',function(){
  var num_cargas_familiares = 0;
  $(".cargas_familiares").each(function() {
    var cargas = $(this).val() == "" ? 0 : parseInt($(this).val());
    num_cargas_familiares += cargas;
    //console.log($(this).attr('id'));
  });
  
  if(num_cargas_familiares > 0){
    $('#tramo').attr('disabled',false);
  }else{
    $("#tramo").prop('selectedIndex', 0);
    $('#tramo').attr('disabled',true);
  }

});    

$('#region').change(function(){

    if($(this).val() != ''){

      $.get("<?php echo base_url();?>admins/get_comunas/"+$(this).val(),function(data){
               // Limpiamos el select
                    $('#comuna option').remove();
                    var_json = $.parseJSON(data);
                    $('#comuna').append('<option value="">Seleccione Comuna</option>');
                    for(i=0;i<var_json.length;i++){
                      $('#comuna').append('<option value="' + var_json[i].idcomuna + '">' + var_json[i].nombre + '</option>');
                    }
                    $('#basicBootstrapForm').formValidation('revalidateField', 'comuna');
      });
      
    }
});

$('#tipogratificacion').on('change',function(){
  if($(this).val() == 'MF'){
    $('#gratificacion').attr('disabled',false);
    $('#gratificacion').val('');
  }else{
    $('#basicBootstrapForm').formValidation('updateStatus', 'gratificacion','NOT_VALIDATED');     
    $('#gratificacion').val('');

    $('#gratificacion').attr('disabled','disabled');
    

  }


});




</script>


<!--date-piker-->
<!--link rel="stylesheet" href="css/jquery-ui.css" /-->
<!--script src="js/jquery-ui.js"></script-->
<script>
	$(function() {
		$( "#datepicker,#datepicker3,#datepicker7,#datepicker8,#datepicker12,#feriados").datepicker( {dateFormat: "dd/mm/yy"});
	});


	/*$(function() {
		$( "#fechanacimiento").datepicker( {
				dateFormat: "dd/mm/yy",
				changeMonth: true,
      			changeYear: true
		});
	});	
*/

        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });


</script>
<!--date-piker-->		




<script>
		function habilitar(value)
		{
			if(value==true)
			{
				// habilitamos
				document.getElementById("seguro_cesantia").value = 1;
				document.getElementById("datepicker6").disabled=false;
			}else if(value==false){
				// deshabilitamos
				document.getElementById("seguro_cesantia").value = 0;
				document.getElementById("datepicker6").disabled=true;
				
			}
		}
</script>

<script>
function checkRut(rut) {
    // Despejar Puntos
    var valor = rut.value.replace('.','');
    // Despejar Guión
    valor = valor.replace('-','');
    
    // Aislar Cuerpo y Dígito Verificador
    cuerpo = valor.slice(0,-1);
    dv = valor.slice(-1).toUpperCase();
    
    // Formatear RUN
    rut.value = cuerpo + '-'+ dv
    
    // Si no cumple con el mínimo ej. (n.nnn.nnn)
    if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}
    
    // Calcular Dígito Verificador
    suma = 0;
    multiplo = 2;
    
    // Para cada dígito del Cuerpo
    for(i=1;i<=cuerpo.length;i++) {
    
        // Obtener su Producto con el Múltiplo Correspondiente
        index = multiplo * valor.charAt(cuerpo.length - i);
        
        // Sumar al Contador General
        suma = suma + index;
        
        // Consolidar Múltiplo dentro del rango [2,7]
        if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
  
    }
    
    // Calcular Dígito Verificador en base al Módulo 11
    dvEsperado = 11 - (suma % 11);
    
    // Casos Especiales (0 y K)
    dv = (dv == 'K')?10:dv;
    dv = (dv == 0)?11:dv;
    
    // Validar que el Cuerpo coincide con su Dígito Verificador
    if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }
    
    // Si todo sale bien, eliminar errores (decretar que es válido)
    rut.setCustomValidity('');
}

FormValidation.Validator.validateRut = {
        validate: function(validator, $field, options) {
          var validador = true;
          $field.Rut();
          var rut = $field.val();
          var cleanRut = replaceAll(rut,".","");
          var cleanRut = replaceAll(cleanRut,"-","");
          if(VerificaRut(cleanRut)){
              return true;

          }else{
              return {
                  valid : false
              }

          }


        }
    };


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
            rut: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Rut Trabajador es requerido'
                    },
                    stringLength: {
                        min: 0,
                        max: 12,
                        message: 'El largo del Rut es Incorrecto'
                    },
                    validateRut: {
                      message: 'Rut Incorrecto'
                    }

                }
            },
			numficha: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'N&uacute;mero de Ficha es requerido'
                  }
             }
            },
           nombre: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Nombre Trabajador es requerido'
                    }
                }
            },

            apaterno: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Apellido Paterno Trabajador es requerido'
                    }
                }
            },

            amaterno: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Apellido Materno Trabajador es requerido'
                    }
                }
            },

            fechanacimiento: {
                row: '.form-group',
                validators: {
                    date: {
                        format: 'DD/MM/YYYY',
                        message: 'El valor no es una fecha v&aacute;lida'
                    },
                    notEmpty: {
                        message: 'Fecha de Nacimiento es requerido'
                    }                    
                }
            },
            nacionalidad: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Nacionalidad es requerida'
                    }
                }
            },

            ecivil: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Estado Civil es requerido'
                    }
                }
            },

            sexo: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Sexo es requerido'
                    }
                }
            },

            direccion: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Direcci&oacute;n Trabajador es requerida'
                    }
                }
            },

            region: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Regi&oacute;n Comunidad es requerido'
                    }
                }
            },

            comuna: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Comuna es requerida'
                    }
                }
            },


            email: {
                row: '.form-group',
                validators: {
                    emailAddress: {
                        message: 'El valor ingresado no es una direcci&oacute; de email valida'
                    }                    
                }
            },                   

            tiporenta: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Tipo Renta es requerido'
                    }
                }
            },            

            cargo: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Cargo es requerido'
                    }
                }
            }, 

            centro_costo: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Centro de Costo es requerido'
                    }
                }
            },
            // FIN VALIDACIONES PRIMERA PESTAÑA


            /*sueldo_base: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Sueldo Base es requerido'
                    }
                }
            },*/

  			sueldo_base: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Sueldo Base es requerido'
                    },
                    // The bank validator doesn't have any option
                    blank: {}  
                }
                                  
            },

			tipogratificacion: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Tipo Gratificaci&oacute;n es requerido'
                    }
                }
            },
            
            gratificacion: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Monto Gratificaci&oacute;n es requerido'
                    }
                }
            },

            movilizacion: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Monto Movilizaci&oacute;n es requerido'
                    }
                }
            },

            colacion: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Monto Colaci&oacute;n es requerido'
                    }
                }
            },

            datepicker2: {
                row: '.form-group',
                validators: {
                    date: {
                        format: 'DD/MM/YYYY',
                        message: 'El valor no es una fecha v&aacute;lida'
                    },
                    notEmpty: {
                        message: 'Fecha de Ingreso es requerido'
                    }                    
                }
            },


            fecha_retiro: {
                row: '.form-group',
                validators: {
                    date: {
                        format: 'DD/MM/YYYY',
                        message: 'El valor no es una fecha v&aacute;lida'
                    }                  
                }
            },


            datepicker4: {
                row: '.form-group',
                validators: {
                    date: {
                        format: 'DD/MM/YYYY',
                        message: 'El valor no es una fecha v&aacute;lida'
                    }                  
                }
            },

            fecha_inicio_vacaciones: {
                row: '.form-group',
                validators: {
                    date: {
                        format: 'DD/MM/YYYY',
                        min: 'datepicker2',
                        message: 'El valor no es una fecha v&aacute;lida'
                    },
                    notEmpty: {
                        message: 'Fecha Inicio C&aacute;lculo de vacaciones es requerido'
                    }                    
                }
            },

             vacaciones_legales: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Saldo inicial de vacaciones legales es requerido'
                    },
                    numeric: {
                        separator: '.',
                        message: 'Saldo inicial de vacaciones legales s&oacute;lo puede contener n&uacute;meros'
                    }                 
                },

            },


           vacaciones_progresivas: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Saldo inicial de vacaciones progresivas es requerido'
                    },
                    numeric: {
                        separator: '.',
                        message: 'Saldo inicial de vacaciones progresivas s&oacute;lo puede contener n&uacute;meros'
                    }                 
                },

            },


			tipocontrato: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Tipo de Contrato es requerido'
                    }
                }
            },     


            fecha_real: {
                row: '.form-group',
                validators: {
                    date: {
                        format: 'DD/MM/YYYY',
                        message: 'El valor no es una fecha v&aacute;lida'
                    },
                    notEmpty: {
                        message: 'Fecha Real de Contrato es requerido'
                    }                    
                }
            },         


            vencimiento_1: {
                row: '.form-group',
                validators: {
                    date: {
                        format: 'DD/MM/YYYY',
                        message: 'El valor no es una fecha v&aacute;lida'
                    }                  
                }
            },


			   
            // FIN VALIDACIONES SEGUNDA PESTAÑA
            afp: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Afp es requerida'
                    }
                }
            },   


            datepicker5: {
                row: '.form-group',
                validators: {
                    date: {
                        format: 'DD/MM/YYYY',
                        message: 'El valor no es una fecha v&aacute;lida'
                    },
                    notEmpty: {
                        message: 'Fecha de Ingreso AFP es requerido'
                    }                    
                }
            },      


            datepicker6: {
                row: '.form-group',
                validators: {
                    date: {
                        format: 'DD/MM/YYYY',
                        message: 'El valor no es una fecha v&aacute;lida'
                    },
                    notEmpty: {
                        message: 'Fecha de Ingreso AFC es requerido'
                    }                    
                }
            },

            isapre: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Isapre es requerida'
                    }
                }
            },  


            monto_pactado: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Monto Pactado es requerido'
                    }
                }
            },  

            asig_individual: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Nro. Cargas Simples es requerido'
                    }
                }
            }, 

            asig_por_invalidez: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Nro. Cargas Inv&aacute;lidas es requerido'
                    }
                }
            }, 


            asig_maternal: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Nro. Cargas Maternales es requerido'
                    }
                }
            },
             


            tramo: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Tramo es requerido'
                    }
                }
            },


            tramo: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Tramo es requerido'
                    }
                }
            },

            diastrabajo: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'D&iacute;as de Trabajo es requerido'
                    },
                    between: {
                        min: 0,
                        max: 30,
                        message: 'D&iacute;as de Trabajo debe estar entre 0 y 30'
                    },
                }
            }, 

            horasdiarias: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Horas Diarias es requerido'
                    },
                    integer: {
                        message: 'El valor ingresado no es num&eacute;rico',
                    },
                    between: {
                        min: 0,
                        max: 24,
                        message: 'Horas Diarias debe estar entre 0 y 24'
                    },
                }
            }, 

            horassemanales: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Horas Semanales es requerido'
                    },
                    integer: {
                        message: 'El valor ingresado no es num&eacute;rico',
                    }                    
                }
            }, 

           /* fechaafc: {
                row: '.form-group',
                validators: {
                    date: {
                        format: 'DD/MM/YYYY',
                        min: 'fechaingreso',
                        message: 'El valor no es una fecha v&aacute;lida'
                    },
                    notEmpty: {
                        message: 'Fecha AFC es requerido'
                    }                    
                }
            },

            cargo: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Cargo es requerido'
                    }
                }
            },

            


          


                      


            diastrabajo: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'D&iacute;as de Trabajo es requerido'
                    },
                    between: {
                        min: 0,
                        max: 30,
                        message: 'D&iacute;as de Trabajo debe estar entre 0 y 30'
                    },
                }
            },            

            horasdiarias: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Horas Diarias es requerido'
                    },
                    integer: {
                        message: 'El valor ingresado no es num&eacute;rico',
                    },
                    between: {
                        min: 0,
                        max: 24,
                        message: 'Horas Diarias debe estar entre 0 y 24'
                    },
                }
            },  

            horassemanales: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Horas Semanales es requerido'
                    },
                    integer: {
                        message: 'El valor ingresado no es num&eacute;rico',
                    }                    
                }
            },                       


            sueldobase: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Sueldo Base es requerido'
                    },
                    // The bank validator doesn't have any option
                    blank: {}  
                }
                                  
            },


            tipogratificacion: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Tipo de Gratificaci&oacute;n es requerido'
                    }
                }
            },  

            gratificacion: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Gratificaci&oacute;n es requerido'
                    },
                }
                                  
            },            

            cargassimples: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Nro. de Cargas Simples es Requerido'
                    },
                    greaterThan: {
                        value: 0,
                        message: 'El valor debe ser mayor o igual a cero'
                    }
                }
            },  


            cargasinvalidas: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Nro. de Cargas Inv&aacute;lidas es Requerido'
                    },
                    greaterThan: {
                        value: 0,
                        message: 'El valor debe ser mayor o igual a cero'
                    }
                }
            },  


            cargasmaternales: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Nro. de Cargas Maternales es Requerido'
                    },
                    greaterThan: {
                        value: 0,
                        message: 'El valor debe ser mayor o igual a cero'
                    }
                }
            },  

            cargasretroactivas: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Nro. de Cargas Retroactivas es Requerido'
                    },
                    greaterThan: {
                        value: 0,
                        message: 'El valor debe ser mayor o igual a cero'
                    }
                }
            },  

            asigfamiliar: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Asignaci&oacute;n Familiar es requerido'
                    },
                }
                                  
            },               


            tramo_asigfamiliar: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Tramo Asignaci&oacute;n Familiar es requerido'
                    },
                }
                                  
            },      


            movilizacion: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Movilizaci&oacute;n es requerido'
                    }
                }
            },

            colacion: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Colaci&oacute;n es requerido'
                    }
                }
            },


            */
        }
    })

       // Called when a field is invalid
        .on('err.field.fv', function(e, data) {
            // data.element --> The field element

            var $tabPane = data.element.parents('.tab-pane'),
                tabId    = $tabPane.attr('id');

            $('a[href="#' + tabId + '"][data-toggle="tab"]')
                .parent()
                .find('i')
                .removeClass('fa-check')
                .addClass('fa-times');
        })
        // Called when a field is valid
        .on('success.field.fv', function(e, data) {
            // data.fv      --> The FormValidation instance
            // data.element --> The field element

            var $tabPane = data.element.parents('.tab-pane'),
                tabId    = $tabPane.attr('id'),
                $icon    = $('a[href="#' + tabId + '"][data-toggle="tab"]')
                            .parent()
                            .find('i')
                            .removeClass('fa-check fa-times');

            // Check if all fields in tab are valid
            var isValidTab = data.fv.isValidContainer($tabPane);
            if (isValidTab !== null) {
                $icon.addClass(isValidTab ? 'fa-check' : 'fa-times');
            }
        })
        .on('success.form.fv', function(e) { /**** VALIDAR EN SERVIDOR VIA AJAX ******/
        // Prevent default form submission
        e.preventDefault();

        var $form = $(e.target),                    // The form instance
            fv    = $form.data('formValidation');   // FormValidation instance

        // Send data to back-end
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>rrhh/validate_sueldo_minimo',
            data: $form.serialize(),
            dataType: 'json'
        }).success(function(response) {
            // We will display the messages from server if they're available

            // If there is error returned from server
              if (response.result === 'error') {
                  //console.log(response.fields);
                  for (var field in response.fields) {

                      fv
                          // Show the custom message
                          .updateMessage(field, 'blank', response.fields[field])
                          // Set the field as invalid
                          .updateStatus(field, 'INVALID', 'blank');
                  }
              } else {
                  // Do whatever you want here
                  // such as showing a modal ...
                  fv.defaultSubmit();
              }            
        });
        
    }) 
	       
   
        $(".mask_date").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});


$(".mask_date").on('blur',function(event){
    //if($(this).val() == ''){
      $('#basicBootstrapForm').formValidation('revalidateField', 'fechanacimiento');
      $('#basicBootstrapForm').formValidation('revalidateField', 'datepicker2');
      //$('#basicBootstrapForm').formValidation('revalidateField', 'fecha_retiro');
      $('#basicBootstrapForm').formValidation('revalidateField', 'datepicker6');
      //console.log( $("#fechaafc").attr('disabled'));
      if($(this).attr('id') == 'datepicker2' && $("#datepicker6").attr('disabled') != 'disabled' && $("#datepicker6").val() == ''){ //si ingresamos fecha ingreso y aun no ingresamos fecha AFC, se copia
        $("#datepicker6").val($(this).val());
        $('#basicBootstrapForm').formValidation('updateStatus', 'datepicker6','NOT_VALIDATED');
      }
    //}

  });



$("#parttime").on('ifToggled',function(event){
   $('#basicBootstrapForm').formValidation('updateStatus', 'sueldo_base','NOT_VALIDATED'); //quita validacion
});


$("#seguro_cesantia").on('ifChecked',function(event){
  $("#datepicker6").attr('disabled',false);
  $("#datepicker6").val($("#datepicker2").val());
});


$("#seguro_cesantia").on('ifUnchecked',function(event){
  $('#basicBootstrapForm').formValidation('updateStatus', 'datepicker6','NOT_VALIDATED');
  $("#datepicker6").val('');
  $("#datepicker6").attr('disabled',true);

});    


   }); 


	
</script>


