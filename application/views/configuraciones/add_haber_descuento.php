               <form id="basicBootstrapForm" action="<?php echo base_url();?>configuraciones/submit_haber_descuento" method="post">


                  <div class="panel panel-inverse">                       
                      <div class="panel-heading">
                            <h4 class="panel-title">Creaci&oacute;n Haberes y Descuentos Variables</h4>
                        </div>
            <div class="panel-body">
              								<div class='row'>


													<div class="graph-visual tables-main">
											

													
														  <div class="graph">
														  
															<div class="tables">
																<table class="table"> 
																	<thead> 
																		<tr>
																			<th>Tipo Hab/Des:</th> 
																			<th>Código:</th>
																			<th>Descripción</th> 
																		</tr> 
																	</thead> 
																	<tbody> 
																		<tr class="active" id="variable">
																			<td class="form-group">
																				<select name="tipo" id="tipo" class="tipo form-control">
																				<?php if(isset($haberes_descuentos->tipo)){ 
																						$haber_selected = $haberes_descuentos->tipo == 'HABER' ? 'selected' : '';
																						$descuento_selected = $haberes_descuentos->tipo == 'DESCUENTO' ? 'selected' : '';
																					}else{
																						$haber_selected = '';
																						$descuento_selected = '';
																					}

																				?>
																					<option value="">Seleccione.</option>
																					<option value="HABER" <?php echo $haber_selected;?>>Haber</option>
																					<option value="DESCUENTO" <?php echo $descuento_selected;?> >Descuento</option>
																				</select>
																			</td>

																			<td class="form-group">
																				<input type="text" name="codigo" id="codigo" maxlength="20" class="form-control codigo" id="codigo" placeholder="Código" value="<?php echo isset($haberes_descuentos->codigo) ? $haberes_descuentos->codigo : '';?>">
																			</td>

																			<td class="form-group">
																				<input type="text" name="descripcion" id="descripcion" class="descripcion  form-control" id="descripcion" placeholder="Descripción" value="<?php echo isset($haberes_descuentos->nombre) ? $haberes_descuentos->nombre : '';?>">
																			</td> 
																		</tr>  
																		
																	</tbody> 
																</table>

																<table class="table"> 
																	<thead> 
																		<tr>
																			<th>Tipo de Cálculo:</th> 
																			<th>Forma de Cálculo:</th> 
																		</tr> 
																	</thead> 
																	<tbody> 
																		<tr class="active" id="variable">
																			<td>
																				<div class="form-group">
																					<div class="col-sm-8">
																						<!--div class="radio block">
																							<label>
																								<input class="form-check-input" type="radio" name="tipocalculo" id="tc_calculado" value="calculado" > Calculado
																							</label>
																						</div-->
																						<div class="radio block">
																							<label>
																							<?php if(isset($haberes_descuentos->tipocalculo)){
																										$checked_inf = $haberes_descuentos->tipocalculo == 'informado' ? 'checked' : '';

																								}else{

																									$checked_inf = '';
																								}


																								?>
																								<input class="form-check-input" type="radio" name="tipocalculo" id="tc_informado" value="informado" <?php echo $checked_inf;?>> Informado
																							</label>
																						</div>
																						<div class="radio block">
																							<label>
																								<?php if(isset($haberes_descuentos->tipocalculo)){
																										$checked_tramo = $haberes_descuentos->tipocalculo == 'tramo' ? 'checked' : '';

																								}else{

																									$checked_tramo = '';
																								}


																								?>																							
																								<input class="form-check-input" type="radio" name="tipocalculo" id="tc_tramo" value="tramo" <?php echo $checked_tramo; ?>> Tramo
																							</label>
																						</div>
																						<!--div class="radio block">
																							<label>
																								<input class="form-check-input" type="radio" name="tipocalculo" id="tc_calc_inf" value="calculado_informado" > Cálculado/Informado
																							</label>
																						</div-->
																					</div>
																				</div>
																			</td>

																			<td>
																				<div class="form-group">
																					<div class="col-sm-8">
																						<div class="radio block">
																							<label>
																								<input class="form-check-input" type="radio" name="formacalculo" name="formacalculo" id="fc_fijo" value="fijo" disabled> Fijo
																							</label>
																						</div>
																						<div class="radio block">
																							<label>
																								<input class="form-check-input" type="radio" name="formacalculo" id="fc_proporcional"  value="proporcional" disabled > Proporcional
																							</label>
																						</div>
																						<div class="radio block">
																							<label>
																								<input class="form-check-input" type="radio" name="formacalculo" id="fc_diario" value="diario" disabled> Diario
																							</label>
																						</div>
																						<div class="radio block">
																							<label>
																								<?php if(isset($haberes_descuentos->formacalculo)){
																										$checked_ctacte = $haberes_descuentos->formacalculo == 'cuentacorriente' ? 'checked' : '';

																								}else{

																									$checked_ctacte = '';
																								}?>																							
																								<input class="form-check-input" type="radio" name="formacalculo" id="fc_ctacte"  value="cuentacorriente" <?php echo $checked_ctacte; ?>> Cuenta Corriente
																							</label>
																						</div>
																					</div>
																				</div>
																			</td> 
																		</tr>  	
																	</tbody> 
																</table> 

																<table class="table"> 
																	<thead> 
																		<tr>
																			<th>Características:</th> 
																			<th></th>
																			<!--th>INE:</th--> 
																		</tr> 
																	</thead> 
																	<tbody> 
																		<tr class="active" id="variable">
																			<td>
																				<div class="form-group">
																					<div class="col-sm-8">
																						<div class="radio block">
																							<label>
																								<?php if(isset($haberes_descuentos->imponible)){
																										$checked_imponible = $haberes_descuentos->imponible == 1 ? 'checked' : '';

																								}else{

																									$checked_imponible = '';
																								}?>																							
																								<input class="form-check-input" type="checkbox" name="imponible" id="imponible" value="imponible" <?php echo $checked_imponible;?>> Imponible
																							</label>
																						</div>
																						<div class="radio block">
																							<label>
																								<?php if(isset($haberes_descuentos->fijo)){
																										$checked_fijo = $haberes_descuentos->fijo == 1 ? 'checked' : '';

																								}else{

																									$checked_fijo = '';
																								}?>																								
																								<input class="form-check-input" type="checkbox" name="fijo" id="fijo" value="fijo" <?php echo $checked_fijo; ?> > Fijo
																							</label>
																						</div>
																						<div class="radio block">
																							<label>
																							<?php if(isset($haberes_descuentos->proporcional)){
																										$checked_prop = $haberes_descuentos->proporcional == 1 ? 'checked' : '';

																								}else{

																									$checked_prop = '';
																								}?>																								
																								<input class="form-check-input" type="checkbox" name="proporcional" id="proporcional" value="proporcional" <?php echo $checked_prop; ?> > Proporcional
																							</label>
																						</div>
																						<!--div class="radio block">
																							<label>
																								<input class="form-check-input" type="checkbox" name="embargable" id="embargable" value="embargable"> Embargable
																						</div-->
																						<!--div class="radio block">
																							<label>
																								<input class="form-check-input" type="checkbox" name="gratificacion" id="gratificacion" value="gratificacion"> Gratificación
																						</div-->
																						<div class="radio block">
																							<label>
																								<input class="form-check-input" type="checkbox" name="insoluto" id="insoluto" value="insoluto" disabled> Insoluto
																						</div>
																						<div class="radio block">
																							<label>
																							<?php if(isset($haberes_descuentos->semanacorrida)){
																										$checked_semanacorrida = $haberes_descuentos->semanacorrida == 1 ? 'checked' : '';

																								}else{

																									$checked_semanacorrida = '';
																								}?>	
																								<input class="form-check-input" type="checkbox" name="semanacorrida" id="semanacorrida" value="semanacorrida" <?php echo $checked_semanacorrida; ?> > Semana Corrida
																						</div>										<div class="radio block">
																							<label>

																								<input class="form-check-input" type="checkbox" name="reajustable" id="reajustable" value="reajustable" disabled> Reajustable
																							</label>
																						</div>												
																					</div>
																				</div>
																			</td>

																			<td>
																				<div class="form-group">
																					<div class="col-sm-8">
																						<div class="radio block">
																							<label>
																							<?php if(isset($haberes_descuentos->retjudicial)){
																										$checked_retjudicial = $haberes_descuentos->retjudicial == 1 ? 'checked' : '';

																								}else{

																									$checked_retjudicial = '';
																								}?>
																								<input class="form-check-input" type="checkbox" name="ret_judicial" id="ret_judicial" value="ret_judicial" <?php echo $checked_retjudicial ;?> > Ret. Judicial
																							</label>
																						</div>
																						<div class="radio block">
																							<label>
																							<?php if(isset($haberes_descuentos->tributable)){
																										$checked_trib = $haberes_descuentos->tributable == 1 ? 'checked' : '';

																								}else{

																									$checked_trib = '';
																								}?>
																								<input class="form-check-input" type="checkbox" name="tributable"  id="tributable" value="tributable" <?php echo $checked_trib; ?> > Tributable
																							</label>
																						</div>
																						<!--div class="radio block">
																							<label>
																								<input class="form-check-input" type="checkbox" name="jornada" id="jornada" value="jornada"> Jornada
																							</label>
																						</div-->
																						<div class="radio block">
																							<label>
																								<input class="form-check-input" type="checkbox" name="finiquito" id="finiquito" value="finiquito" disabled> Finiquito
																							</label>
																						</div>
																						<div class="radio block">
																							<label>
																								<input class="form-check-input" type="checkbox" name="contable" id="contable" value="contable" disabled> Contable
																						</div>
																						<div class="radio block">
																							<label>
																								<input class="form-check-input" type="checkbox" name="sobregiro" id="sobregiro" value="sobregiro" disabled> Sobregiro
																						</div>
																						<div class="radio block">
																							<label>
																								<input class="form-check-input" type="checkbox" name="provision" id="provision" value="provision" disabled> Provisión
																							</label>
																						</div>
																						<!--div class="radio block">
																							<label>
																								<input class="form-check-input" type="checkbox" name="liqminimo" id="liqminimo" value="liqminimo"> Liq.Minimo
																						</div-->
																					</div>
																				</div>
																			</td>
																			<td>
														
																				<div class="form-group">
																					<div class="col-sm-8">
																						<div class="radio block">
																							<label>
																								<?php if(isset($haberes_descuentos->otros_aportes)){
																										$checked_otros_aportes = $haberes_descuentos->otros_aportes == 1 ? 'checked' : '';

																								}else{

																									$checked_otros_aportes = '';
																								}?>
																								<input class="form-check-input" type="checkbox" name="otros_aportes"  id="otros_aportes" value="otros_aportes" <?php echo $checked_otros_aportes; ?> > Otros Aportes
																							</label>
																						</div>
																					</div>
																				</div>
																			</td>
																		</tr>  	
																	</tbody> 
																</table>


																<table class="table"> 
																	<thead> 
																		<tr>
																			<th>Centralizaci&oacute;n:</th> 
																			<th></th>
																			<!--th>INE:</th--> 
																		</tr> 
																	</thead> 
																	<tbody> 
																		<tr class="active" id="variable">
																			<td>
																				<div class="form-group">
																					
																					<div class="col-sm-6">
																						<label for="rut">Cuenta Contable</label>
																						<input list="datalistOptions" id="cuenta" name="cuenta" class="form-control" placeholder="Seleccione Cuenta" value='<?php echo $datos_select['cuenta'];?>' autocomplete="off" <?php echo $tiene_centralizacion ? '' : 'disabled'; ?> >
																						<datalist id="datalistOptions">
														                                    <?php foreach ($plan_cuentas as $cuenta) { ?>
														                                            <?php //echo '<pre>'; var_dump( $cuenta); exit; 
														                                            ?>
														                                            <option data-id="<?php echo $cuenta['idn4']; ?>" data-referencia='<?php echo $cuenta['referencia']; ?>' data-centro_costo='<?php echo $cuenta['centro_costo']; ?>' data-item_ingreso='<?php echo $cuenta['item_ingreso']; ?>' data-item_gasto='<?php echo $cuenta['item_gasto']; ?>' data-cuenta_corriente='<?php echo $cuenta['cuenta_corriente']; ?>' value='<?php echo $cuenta['nombren4']; ?>'><?php echo $cuenta['codigon4'] . ' | ' . $cuenta['nombren2'] . ' | ' . $cuenta['nombren3']; ?></option>

														                                    <?php } ?>
														                                </datalist>
														                                																				
																					</div>
																					<div class="col-sm-6">
																						<label for="rut">Centro de Costo</label>
																						<select id="centrocosto" name="centrocosto" class="form-control" disabled>
														                                    <option value="">Seleccione Centro de Costo</option>
														                                    <?php foreach ($centros_costo as $centro_costo) { ?>
															                                    <?php
															                                    	$ccosto_selected = '';
															                                    	if(isset($haberes_descuentos->idcentrocosto)){
															                                    			$ccosto_selected = $haberes_descuentos->idcentrocosto == $centro_costo['id'] ? 'selected' : '';

															                                    	}

															                                    ?>														                                    	
														                                        <option value="<?php echo $centro_costo['id']; ?>" <?php echo $ccosto_selected; ?>><?php echo $centro_costo['codigo'] . ' | ' . $centro_costo['nombre']; ?></option>
														                                    <?php } ?>
														                                </select>
														                                																				
																					</div>
																																						
																				</div>
																				<input type='hidden' id='cuenta_sel' name='cuenta_sel' value='<?php echo isset($haberes_descuentos->idcuentacontable) ? $haberes_descuentos->idcuentacontable: 0;?>'>	
																			</td>
																		</tr>  	
																		<tr class="active" id="variable">
																			<td>
																				<div class="form-group">
																					
																					
																					<div class="col-sm-6">
																						<label for="rut">Item Ingreso</label>
														                                <select id="itemingreso" name="itemingreso" class="form-control" disabled>
														                                    <option value="">Seleccione Item de Ingreso</option>
														                                    <?php foreach ($item_ingreso as $item_ing) { ?>
															                                    <?php
															                                    	$iingreso_selected = '';
															                                    	if(isset($haberes_descuentos->iditemingreso)){
															                                    			$iingreso_selected = $haberes_descuentos->iditemingreso == $item_ing['id'] ? 'selected' : '';

															                                    	}

															                                    ?>															                                    	
														                                        <option value="<?php echo $item_ing['id']; ?>" <?php echo $iingreso_selected; ?>><?php echo $item_ing['codigo'] . ' | ' . $item_ing['nombre']; ?></option>
														                                    <?php } ?>
														                                </select>
														                                																				
																					</div>		
																					<div class="col-sm-6">
																						<label for="rut">Item Gasto</label>
														                                <select id="itemgasto" name="itemgasto" class="form-control" disabled>
														                                    <option value="">Seleccione Item de Gasto</option>
														                                    <?php foreach ($item_gastos as $item_gas) { ?>
															                                    <?php
															                                    	$igasto_selected = '';
															                                    	if(isset($haberes_descuentos->iditemgasto)){
															                                    			$igasto_selected = $haberes_descuentos->iditemgasto == $item_gas['id'] ? 'selected' : '';

															                                    	}

															                                    ?>															                                    	
														                                        <option value="<?php echo $item_gas['id']; ?>" <?php echo $igasto_selected; ?>><?php echo $item_gas['codigo'] . ' | ' . $item_gas['nombre']; ?></option>
														                                    <?php } ?>
														                                </select>
														                                																				
																					</div>																																								
																				</div>
																			</td>
																		</tr>  
																		<tr class="active" id="variable">
																			<td>
																				<div class="form-group">
																					
																					
																					<div class="col-sm-6">
																						<label for="rut">Cuenta Corriente</label>
																						<input list="datalistOptionsCtaC" id="cuentacorriente" name="cuentacorriente" class="form-control"  value='<?php echo $datos_select['cuentacorriente'];?>' autocomplete="off" disabled>
														                                <datalist id="datalistOptionsCtaC">

														                                    <?php foreach ($cuentas_corrientes as $cuenta_corriente) { ?>
														                                        <?php $tipocuentas = "Funcionario";
														                                        if ($cuenta_corriente['tipocuenta'] == "P") {
														                                            $tipocuentas = "Proveedor";
														                                        }

														                                        if ($cuenta_corriente['tipocuenta'] == "C") {
														                                            $tipocuentas = "Cliente";
														                                        }

														                                        if ($cuenta_corriente['tipocuenta'] == "") {
														                                            $tipocuentas = "";
														                                        }

														                                        ?>

														                                        <option data-id="<?php echo $cuenta_corriente['id']; ?>" data-nomrut="<?php echo number_format($cuenta_corriente['rut'], 0, '.', '.') . '-' . $cuenta_corriente['dv'] . ' | ' . $cuenta_corriente['nombre']; ?>" data-nombre="<?php echo $cuenta_corriente['nombre']; ?>" value="<?php echo $cuenta_corriente['nombre']; ?>">
														                                            <?php echo number_format($cuenta_corriente['rut'], 0, '.', '.') . '-' . $cuenta_corriente['dv'] . ' | ' . $tipocuentas; ?>
														                                        </option>
														                                    <?php } ?>

														                                </datalist>
														                                <input type='hidden' id='cuenta_corriente' name='cuenta_corriente' value='<?php echo isset($haberes_descuentos->idcuentacorriente) ? $haberes_descuentos->idcuentacorriente: 0;?>'>
														                                
														                                																				
																					</div>		
																																								
																				</div>
																			</td>
																		</tr> 
																	</tbody> 
																</table>

																<br>
																
															</div>

													
															
													</div>
											</div>
											</div>
											</div>
											 <div class="panel-footer">
																<a href="<?php echo base_url(); ?>configuraciones/hab_descto" class = "btn btn-primary" >Volver</a>
																<button type = "submit" class = "btn btn-info" id="comando">Guardar
																</button>
																<input type="hidden" name="idhab" value="<?php echo isset($haberes_descuentos->id) ? $haberes_descuentos->id: 0 ;?>">

											  </div> 
 	
											</div>

											</form>


<script>



$(document).ready(function() {


selecciona_cuenta();

function selecciona_cuenta() {


        var value = $('#cuenta').val();




        //console.log($('#datalistOptions [value="' + value + '"]').data('id'));



        var cuenta_sel = $('#datalistOptions [value="' + value + '"]').data('id');

        if (cuenta_sel === undefined) {

            $('#cuenta_sel').val(0);
            $('#centrocosto').val('');
            $('#centrocosto').attr('disabled', 'disabled');

            $('#itemingreso').val('');
            $('#itemingreso').attr('disabled', 'disabled');

            $('#itemgasto').val('');
            $('#itemgasto').attr('disabled', 'disabled');


            $('#cuentacorriente').val('');
            $('#cuentacorriente').attr('disabled', 'disabled');

            /*$('#referencia').val('');
            $('#referencia').attr('disabled', 'disabled');*/

        } else {

            $('#cuenta_sel').val(cuenta_sel);
            var centro_costo = $('#datalistOptions [value="' + value + '"]').data('centro_costo');
            var item_ingreso = $('#datalistOptions [value="' + value + '"]').data('item_ingreso');
            var item_gasto = $('#datalistOptions [value="' + value + '"]').data('item_gasto');
            var cuenta_corriente = $('#datalistOptions [value="' + value + '"]').data('cuenta_corriente');
            var referencia = $('#datalistOptions [value="' + value + '"]').data('referencia');

            if (centro_costo == 1) {
                $('#centrocosto').attr('disabled', false);
            } else {
                $('#centrocosto').val('');
                $('#centrocosto').attr('disabled', 'disabled');
            }


            if (item_ingreso == 1) {
                $('#itemingreso').attr('disabled', false);
            } else {
                $('#itemingreso').val('');
                $('#itemingreso').attr('disabled', 'disabled');
            }


            if (item_gasto == 1) {
                $('#itemgasto').attr('disabled', false);
            } else {
                $('#itemgasto').val('');
                $('#itemgasto').attr('disabled', 'disabled');
            }


            if (cuenta_corriente == 1) {
                $('#cuentacorriente').attr('disabled', false);
            } else {
                $('#cuentacorriente').val('');
                $('#cuentacorriente').attr('disabled', 'disabled');
            }



            /*if (referencia == 1) {
                $('#referencia').attr('disabled', false);
            } else {
                $('#referencia').val('');
                $('#referencia').attr('disabled', 'disabled');
            }*/



        }


    }



    function valida_cuenta_Corriente() {
        var value = $('#cuentacorriente').val();
        var cuenta_sel = $('#datalistOptionsCtaC [value="' + value + '"]').data('id');


        if (cuenta_sel === undefined) {

            $('#cuenta_corriente').val(0);
        } else {

            $('#cuenta_corriente').val(cuenta_sel);
        }
    }




    $('#cuentacorriente').on('input', function() {


        valida_cuenta_Corriente();





    });

$('#cuenta').on('input', function() {

        selecciona_cuenta();
  });

$('#basicBootstrapForm').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {

            tipo: {
                // The children's full name are inputs with class .childFullName
                // The field is placed inside .col-xs-6 div instead of .form-group
                selector: '.tipo',
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Tipo es requerido'
                    },
                },

            },          
           
     		codigo: {
                selector: '.codigo',
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'C&oacute;digo Haber/Descuento es requerido'
                    },
                },

            }, 

     		descripcion: {
                selector: '.descripcion',
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Descripci&oacute;n es requerida'
                    },
                },

            }, 


     		tipocalculo: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Tipo C&aacute;lculo es requerido'
                    },
                },

            },   

   			formacalculo: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Forma C&aacute;lculo es requerido'
                    },
                },

            },   
            cuenta: {
                row: '.form-group',
                validators: {
                    callback: {
                        message: 'Cuenta Contable es requerida',
                        callback: function (value, validator, $field) {

                            var cuenta_sel = $('#cuenta_sel').val();
	                         /* return  {
	                                valid: false,
	                                message: 'Cuenta Contable es requerida'
	                            }*/

                            if(cuenta_sel != '0'){
                              return true;
                            }else{
                              return  {
                                    valid: false,
                                    message: 'Cuenta Contable es requerida'
                                }
                            }
                        }
                    }                    

                },

            },   

   			centrocosto: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Centro de Costo es requerido'
                    },
                },

            },                                  

   			itemingreso: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Item de Ingreso es requerido'
                    },
                },

            },

   			itemgasto: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Item de Gasto es requerido'
                    },
                },

            },   

            cuentacorriente: {
                row: '.form-group',
                validators: {
                    callback: {
                        message: 'Cuenta Corriente es requerida',
                        callback: function (value, validator, $field) {

                            var cuenta_corriente = $('#cuenta_corriente').val();
	                         /* return  {
	                                valid: false,
	                                message: 'Cuenta Contable es requerida'
	                            }*/

                            if(cuenta_corriente != '0'){
                              return true;
                            }else{
                              return  {
                                    valid: false,
                                    message: 'Cuenta Corriente es requerida'
                                }
                            }
                        }
                    }                    

                },

            },               


        }
    })
});



</script>											