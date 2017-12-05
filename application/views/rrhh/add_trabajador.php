<!--sub-heard-part-->
<form id="basicBootstrapForm" action="<?php echo base_url();?>remuneraciones/submit_trabajador" id="basicBootstrapForm" method="post">
	<div class="sub-heard-part">
		<ul class="nav nav-tabs">
  			<li class="active"><a href="#datospersonales" data-toggle="tab">Datos Personales</a></li>
  			<li><a href="#datosempresa" data-toggle="tab">Datos Empresa</a></li>
  			<li><a href="#datosllss" data-toggle="tab">L.L.S.S</a></li>
  			<li><a href="#pago" data-toggle="tab">Forma Pago</a></li>
  			<li><a href="#" data-toggle="tab">Otros</a></li>
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
						<table class="table table-striped">
							<thead> 
								<tr> 
									<th>Rut:</th> 
									<th>Número de Ficha:</th>
																		
								</tr> 
							</thead>
							<tbody>
								<td>
									<input type="text" name="rut" class="form-control" id="" placeholder="98.123.456-7" title="Escriba Rut" required"Escriba Rut">
								</td>
								<td>
									<input type="text" name="rut" class="form-control" id="" placeholder="Número de Ficha">
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
								<td>
									<input type="text" name="rut" class="form-control" id="" placeholder="Nombre Completo">
								</td>
								<td>
									<input type="text" name="apellido_paterno" class="form-control" id="apellido_paterno" placeholder="Apellido Parterno">
								</td>
								<td>
									<input type="text" name="apellido_materno" class="form-control" id="apellido_materno" placeholder="Apellido Materno">
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
									<input placeholder="Fecha de Nacimiento" class="form-control" id="datepicker" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" required=""/>
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
									<th>Estado Civil:</th> 
									<th>Sexo:</th>
																		
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
									<th>Dirección:</th> 
									<th>Email:</th>
																		
								</tr> 
							</thead>
							<tbody>
								<td>
									<input type="text" name="direccion" id="direccion" class="form-control" placeholder="Dirección" data-toggle="modal" data-target="#myModalDireccion">
								</td>
								<td>
									<input type="text" name="email" id="email" class="form-control" placeholder="Email">
								</td>
							</tbody>
						</table>

						<table class="table table-striped">
			<thead> 
				<tr> 
					<th>Tipo de Renta:</th> 
					<th>Empresa:</th>
					<th>Cargo:</th>
																		
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
				<td>
					<input type="text" name="cargo" id="cargo" class="form-control" placeholder="Cargo">
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
					<th>Jefe o Supervisor:</th> 
					<th>Reemplazo de:</th>
																		
				</tr> 
			</thead>
			<tbody>
				<td>
					<input type="text" name="jefe" id="jefe" class="form-control" placeholder="Jefe o Supervisor">
				</td>
				<td>
					<input type="text" name="reemplazo" id="reemplazo" class="form-control" placeholder="Reemplazo">
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
					<select name="selector1" id="selector1" class="form-control1">
						<option>Seleccione.</option>
						<option>Dolore, ab unde modi est!</option>
						<option>Illum, fuga minus sit eaque.</option>
						<option>Consequatur ducimus maiores voluptatum min</option>
					</select>
				</td>
				<td>
					<input type="text" name="polera" id="polera" class="form-control" placeholder="Talla de Polera">
				</td>
				<td>
					<input type="text" name="pantalon" id="pantalon" class="form-control" placeholder="Talla de Pantalón">
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
					<input type="text" name="tipo_documento" id="tipo_documento" class="form-control" placeholder="Tipo de Documento">
				</td>
				<td>
					<input type="text" name="centro_costo" id="centro_costo" class="form-control" placeholder="Centro de Costo">
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
					<input type="text" name="beneficio" id="beneficio" class="form-control" placeholder="C de Beneficio">
				</td>
				<td>
					<input type="text" name="numero_celular" id="numero_celular" class="form-control" placeholder="Número de Celular">
				</td>
			</tbody>
						</table>
				</section>
			</div>

											<div class="tab-pane" id="datosempresa">
												<section class="empresa">
													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Clase:</th> 
																<th>Tipo C.C:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="clase" class="form-control" id="clase" placeholder="Clases">
															</td>
															<td>
																<input type="text" name="tipo_cc" class="form-control" id="tipo_cc" placeholder="Tipo CC">
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
																<input type="text" name="categoria" class="form-control" id="categoria" placeholder="Categoria">
															</td>
															<td>
																<input type="text" name="lugar_pago" class="form-control" id="lugar_pago" placeholder="Lugar de Pago" data-toggle="modal" data-target="#myModalPago">
															</td>
		
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Fecha de Ingreso:</th> 
																<th>Fecha de Retiro:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input placeholder="Fecha Ingreso" class="form-control" id="datepicker2" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" required=""/>
															</td>
															<td>
																<input placeholder="Fecha Retiro" class="form-control" id="datepicker3" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" required=""/>
															</td>
		
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Motivo de Egreso:</th> 
																<th>Tipo de Contrato:</th>
																<th>Fecha de Finiquito:</th>
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
																<input placeholder="Fecha de Finiquito" class="form-control" id="datepicker4" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" required=""/>
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
																<th>Fecha Incorporación AFP:</th> 
																<th>Fecha Seguro Cesantia:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input placeholder="Fecha Incorp.AFP" class="form-control" id="datepicker5" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" required=""/>
															</td>
															<td>
																<input placeholder="Fecha Seguro Cesantia" class="form-control" id="datepicker6" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" required=""/>
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
																<input type="text" name="cta_bancaria" class="form-control" id="cta_bancaria" placeholder="Nº Cuenta Bancaria">
															</td>
															<td>
																<input type="text" class="form-control"  placeholder="Rut">
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
																<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre Completo">
															</td>
															<td>
																<input type="text" name="email" class="form-control" id="email" placeholder="Email">
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
																<input type="text" name="vacaciones" class="form-control" id="vacaciones" placeholder="Vacaciones" data-toggle="modal" data-target="#myModal12">
															</td>
															<td>
																<input type="text" name="cheque_restau" class="form-control" id="cheque_restau" placeholder="Cheque Restaurante" data-toggle="modal" data-target="#myModal9">
															</td>
															<td>
																<input type="text" name="licencia" class="form-control" id="licencia" placeholder="Licencias Médicas" data-toggle="modal" data-target="#myModal10">
															</td>
														</tbody>
													</table>
												</section>
											</div>
										</div>
										<br>
										<br>
										<a href="#" type="button" class="btn btn-info">Guardar</a>
										<a href="colaborador.html" type="button" class="btn btn-success">Volver</a>	
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
            desde: {
                selector: '.desde',
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Monto desde requerido'
                    }
                }
            },
            hasta: {
                selector: '.hasta',
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Monto hasta requerido'
                    }
                }
            },
        }
    })
    
});
</script>								