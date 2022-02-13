                  <div class="panel panel-inverse">                       
                      <div class="panel-heading">
                            <h4 class="panel-title">Creaci&oacute;n Haberes y Descuentos Variables</h4>
                        </div>
            <div class="panel-body">
              								<div class='row'>


													<div class="graph-visual tables-main">
											

													
														  <div class="graph">
														  <form id="basicBootstrapForm" action="<?php echo base_url();?>configuraciones/submit_haber_descuento" method="post">

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
																				<input type="text" name="codigo" id="codigo" class="form-control codigo" id="codigo" placeholder="Código" value="<?php echo isset($haberes_descuentos->codigo) ? $haberes_descuentos->codigo : '';?>">
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
																<br>
																
															</div>

														</form>
															
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


<script>



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
           
        }
    })
});



</script>											