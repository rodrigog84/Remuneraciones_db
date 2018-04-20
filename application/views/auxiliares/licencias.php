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


<div class="container">
	<form id="buscar_colaborador" name="buscar_colaborador">
		<table class="table table-striped">
			<thead> 
				<tr> 
					<th>Rut:   <input type="text" name="rut" id="rut"  class="form-control1"  placeholder="98123456-7" title="Escriba Rut" required oninput="checkRut(this)">
						<button class="btn btn-danger-sm"> Buscar <span class="glyphicon glyphicon-search"></span></button>	
					</th> 
				</tr> 
			</thead>
			<tbody>
			</tbody>	
		</table>
	</form>
</div>

<div class="container">
	<form  class="form" role="form" id="ingresar_licencia2" name="ingresar_licencia2"  method="post" action="<?php echo base_url();?>auxiliares/submit_licencia">
		
			<div class="sub-heard-part">
				<ul class="nav nav-tabs">
  					<li class="active"><a href="#A1" data-toggle="tab">A1.Identificación del Trabajador</a></li>
  					<li><a href="#A2" data-toggle="tab">A2.Identificación del Hijo</a></li>
  					<li><a href="#A3" data-toggle="tab">A3.Tipo de Licencia</a></li>
  					<li><a href="#A4" data-toggle="tab">A4.Caracteristicas de Reposo</a></li>
  					<li><a href="#A5" data-toggle="tab">A5.Identificación del Profesional</a></li>
  					<li><a href="#A6" data-toggle="tab">A6.Diagnóstico Principal</a></li>

				</ul>
			</div>

				<!--   A1 Identificación del Trabajador  -->
				<div class="tab-content">
				    <div id="A1" class="tab-pane fade in active">
				      	<div class="row">	
					      	<div class="form-group col-md-3">
								<label  for="nombre">Nombre Completo</label>
									<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introducir Nombre" required>	
							</div>
							<div class="form-group col-md-3">
							    <label  for="apaterno">Apellido Paterno</label>
								    <input type="text" class="form-control" id="apaterno" placeholder="Introducir Apellido Paterno">
							</div>
							
							<div class="form-group col-md-3">
							    <label  for="apaterno">Apellido Materno</label>
								    <input type="text" class="form-control" id="amaterno" name="amaterno" placeholder="Introducir Apellido Materno">
							 </div>						
							 <div class="form-group col-md-3">
							    <label  for="rut">Rut</label>
								    <input type="text" class="form-control" id="rut" name="rut" placeholder="12345678-9" oninput="checkRut(this)">
							 </div>	
						 </div> 	  
						 <div class="form-group">
						    <label  for="fec_emision_licencia">Fecha Emisión Licencia</label>
							    <input type="text" class="form-control" id="fec_emision_licencia" name="fec_emision_licencia" placeholder="Introducir Apellido Paterno">
						</div>
						<div class="form-group">
						    <label  for="fec_inicio_reposo">Fecha Inicio de Reposo</label>
							    <input type="text" class="form-control" id="fec_inicio_reposo" name="fec_inicio_reposo" placeholder="Introducir Fecha Inicio de Reposo">
						</div>
						<div class="form-group">
						    <label  for="Edad">Edad</label>
							    <input type="number" class="form-control" id="edad" name="edad" placeholder="Introducir Apellido Paterno">
						</div>
						<div class="form-group">
						    <label  for="sexo">Sexo</label>
							    <select name="sexo" id="sexo" class="form-control1">
									<option value="M">M. MASCULINO</option>
									<option value="F">F. FEMENINO</option>
								</select>
						</div>
						<div class="row">
							<div class="form-group col-md-2">
							    <label  for="numero_dias">Número de Días</label>
								    <input type="number" class="form-control" id="numero_dias" name="numero_dias">
							</div>
							<div class="form-group col-md-10">
							    <label  for="numero_dias_palabras">Número de Días en Palabras</label>
								    <input type="text" class="form-control" id="numero_dias_palabras" name="numero_dias_palabras" placeholder="Introducir Número de Días en Palabras" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
							</div>
						</div>	
				    </div>
				    

				     <!--   A2 Identificación del Hijo  -->
				    <div id="A2" class="tab-pane fade">
						
						<div class="form-group">
						    <label  for="nombre_hijo">Nombre Completo</label>
							    <input type="text" class="form-control" id="nombre_hijo" name="nombre_hijo" placeholder="Introducir Nombre Completo del Hijo" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
						</div>
				      	<div class="form-group">
						    <label  for="apaterno_hijo">Apellido Paterno</label>
							    <input type="text" class="form-control" id="apaterno_hijo" name="apaterno_hijo" placeholder="Introducir Apellido Paterno" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
						</div>
						<div class="form-group">
						    <label  for="amaterno_hijo">Apellido Materno</label>
							    <input type="text" class="form-control" id="amaterno_hijo" name="amaterno_hijo" placeholder="Introducir Apellido Materno" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
						</div>					  	
						<div class="form-group">
						    <label  for="fecnachijo">Fecha Nacimiento</label>
							    <input type="text" class="form-control" id="fecnachijo" name="fecnachijo" placeholder="Introducir Fecha de Nacimiento del Hijo">
						</div>
						<div class="form-group">
						    <label  for="rut_hijo">RUT</label>
							    <input type="text" class="form-control" id="rut_hijo" name="rut_hijo" placeholder="Introducir RUT del Hijo" oninput="checkRut(this)">
						</div>
				    
				    </div>

				    <!--   A3 TIPO DE LICENCIA  -->
				    <div id="A3" class="tab-pane fade">
				    	<div class="form-group">
						    <label  for="tipo_licencia">Tipo de Licencia</label>
							    <select name="tipo_licencia" id="tipo_licencia" class="form-control1">
									<option value="1">1. ENFERMEDAD O ACCIDENTE COMUN</option>
									<option value="2">2. PRORROGA MEDICINA PREVENTIVA</option>
									<option value="3">3. LICENCIA MATERNAL PRE Y POST NATAL</option>
									<option value="4">4. ENFERMEDAD GRAVE HIJO MENOR DE 1 AÑO</option>
									<option value="5">5. ACCIDENTE DEL TRABAJO DEL TRAYECTO</option>
									<option value="6">6. ENFERMEDAD PROFESIONAL</option>
									<option value="7">7. PATOLOGIAS DEL EMBARAZO</option>
								</select>
						 </div>

						 <div class="form-group">
						    <label  for="responsabilidad_laboral">Responsabilidad Laboral</label>
						    <select name="responsabilidad_laboral" id="responsabilidad_laboral" class="form-control1">
								<option value="SI">1. SI</option>
								<option value="NO">2. NO</option>
							</select>
						 </div>

						 <div class="form-group">
						    <label  for="inicio_tramite_invalidez">Inicio Tramite de Invalidez</label>
						    <select name="inicio_tramite_invalidez" id="inicio_tramite_invalidez" class="form-control1">
								<option value="SI">1. SI</option>
								<option value="NO">2. NO</option>
							</select>
						 </div>


						 <div class="form-group">
							    <label  for="fecha_accidente_trabajo">Fecha Accidente del Trabajo o del Trayecto</label>
							    <input type="text" class="form-control" id="fecha_accidente_trabajo" name="fecha_accidente_trabajo" placeholder="Fecha Accidente del Trabajo o del Trayecto">
						</div>

						 <div class="form-group">
							<div class="col-8">
							    <label for="horas">Horas Minutos</label>
							    <input type="text" class="form-control" id="horas" name="horas" placeholder="Fecha Accidente del Trabajo o del Trayecto">
							</div>    
							 <div class="col-4">
							    <input type="text" class="form-control" id="minutos" name="minutos" placeholder="Fecha Accidente del Trabajo o del Trayecto">
							</div>
						</div>
					
						<div class="form-group">
						    <label  for="trayecto">Trayecto</label>
						    <select name="trayecto" id="trayecto" class="form-control1">
								<option value="SI">1. SI</option>
								<option value="NO">2. NO</option>
							</select>
						 </div>			 
				    </div>

				    <!--   A4 CARACTERISTICAS DEL REPOSO  -->
				    <div id="A4" class="tab-pane fade">
				     	<div class="form-group">
						    <label  for="tipo_reposo">Tipo de Reposo</label>
						    <select name="tipo_reposo" id="tipo_reposo" class="form-control1">
								<option value="1">1. REPOSO LABORAL TOTAL</option>
								<option value="2">2. REPOSO LABORAL PARCIAL</option>
							</select>
						 </div>						 
						 <div class="form-group">
						    <label  for="lugar_reposo">Lugar de Reposo</label>
						    <select name="lugar_reposo" id="lugar_reposo" class="form-control1">
								<option value="A">A. MAÑANA</option>
								<option value="B">B. TARDE</option>
								<option value="C">C. NOCHE</option>
							</select>
						 </div>
						 <div class="form-group">
						    <label  for="tipo_reposo_parcial">Tipo de Reposo Parcial</label>
						    <select name="tipo_reposo_parcial" id="tipo_reposo_parcial" class="form-control1">
								<option value="1">1. SU DOMICILIO</option>
								<option value="2">2. HOSPITAL</option>
								<option value="3">3. OTRO DOMICILIO</option>
							</select>
						 </div>
						 <div class="form-group">
							    <label  for="justificar_otro_domicilio">Justificar si es Otro(3)</label>
							    <input type="text" class="form-control" id="justificar_otro_domicilio" name="justificar_otro_domicilio" placeholder="Justificar si es Otro Domicilio" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
						 </div>
						 <div class="form-group"> 
							    <label  for="direccion_otro_domicilio">Direccion, Calle, N° Dpto, Comuna</label>
							    <input type="text" class="form-control" id="direccion_otro_domicilio" name="direccion_otro_domicilio" placeholder="Direccion, Calle, N° Dpto, Comuna" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
						 </div>
						 <div class="form-group"> 
							    <label  for="telefono_contacto">Telefono Personal o de Contacto</label>
							    <input type="number" class="form-control" id="telefono_contacto" name="telefono_contacto" placeholder="Ingrese Numero de 9 digitos">
						 </div>

				    </div>
				    


				    <!--   A5 CARACTERISTICAS DEL PROFESIONAL  -->
				    <div id="A5" class="tab-pane fade">
				    	<div class="form-group">
							<label  for="nombre_profesional">Nombre Profesional</label>
								<input type="text" class="form-control" id="nombre_profesional" name="nombre_profesional" placeholder="Introducir Nombre del Profesional" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">	
						</div>
						<div class="form-group">
						    <label  for="apaterno_profesional">Apellido Paterno Profesional</label>
							    <input type="text" class="form-control" id="apaterno_profesional" name="apaterno_profesional" placeholder="Introducir Apellido Paterno del Profesional" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
						</div>
						<div class="form-group">
						    <label  for="amaterno_profesional">Apellido Materno Profesional</label>
							    <input type="text" class="form-control" id="amaterno_profesional"  name="amaterno_profesional" placeholder="Introducir Apellido Materno del Profesional" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
						 </div>
						 <div class="form-group">
						    <label  for="rut_profesional">Rut Profesional</label>
							    <input type="text" class="form-control" id="rut_profesional"  name="rut_profesional" placeholder="Introducir Rut del Profesional" oninput="checkRut(this)">
						 </div>
						 <div class="form-group">
						    <label  for="especialidad_profesional">Especialidad</label>
							    <input type="text" class="form-control" id="especialidad_profesional"  name="especialidad_profesional" placeholder="Introducir especialidad del Profesional" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
						 </div>
						 <div class="form-group">
						    <label  for="tipo_profesional">Tipo de Reposo Parcial</label>
						    <select name="tipo_profesional" id="tipo_profesional" class="form-control1">
								<option value="1">1. MEDICO</option>
								<option value="2">2. DENTISTA</option>
								<option value="3">3. MATRONA</option>
							</select>
						 </div>
						 <div class="form-group">
						    <label  for="registro_profesional">Registro colegio Profesional</label>
							    <input type="text" class="form-control" id="registro_profesional"  name="registro_profesional" placeholder="Introducir Registro colegio Profesional" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"> 
						 </div>
						 <div class="form-group">
						    <label  for="correo_profesional">Correo Electronico Profesional</label>
							    <input type="email" class="form-control" id="correo_profesional"  name="correo_profesional" placeholder="Introducir Correo del Profesional" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
						 </div>
						 <div class="form-group">
						    <label  for="telefono_profesional">Telefono Profesional</label>
							    <input type="number" class="form-control" id="telefono_profesional"  name="telefono_profesional" placeholder="Introducir Telefono del Profesional">
						 </div>
						 <div class="form-group">
						    <label  for="direccion_profesional">Dirección del Profesional</label>
							    <input type="text" class="form-control" id="direccion_profesional"  name="direccion_profesional" placeholder="Introducir Dirección del Profesional" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
						 </div>
						 <div class="form-group">
						    <label  for="fax_profesional">Fax del Profesional</label>
							    <input type="number" class="form-control" id="fax_profesional"  name="fax_profesional" placeholder="Introducir Fax del Profesional" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
						 </div>				      
				    </div>

				    <!--   A6 DIAGNOSTICO PRINCIPAL  -->
				    <div id="A6" class="tab-pane fade">
				       	<div class="form-group">
						    <label  for="diagnostico">Diagnostico Principal</label>
							    <input type="text" class="form-control" id="diagnostico"  name="diagnostico" placeholder="Introducir Diagnostico" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
						</div>
						<div class="form-group">
						    <label  for="otro_diagnostico">Otros Diagnosticos</label>
							    <input type="text" class="form-control" id="otro_diagnostico"  name="otro_diagnostico" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
						</div>	
						<div class="form-group">
						    <label  for="antecedentes_clinicos">Antecedentes Clinicos</label>
							    <input type="text" class="form-control" id="antecedentes_clinicos"  name="antecedentes_clinicos" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
						</div>	
						<div class="form-group">
						    <label  for="examenes_apoyo">Examenes Apoyo Diagnostico</label>
							    <input type="text" class="form-control" id="examenes_apoyo"  name="examenes_apoyo" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
						</div>	


				    </div>
				  </div>

				<div class="form-group">
				    		<div class="col-lg-offset-2 col-lg-10">
				      			<a href="<?php echo base_url();?>auxiliares/licencias" class="btn btn-success">Volver</a>
				      			<button type="submit" class="btn btn-info">Guardar</button>
				    		</div>
				</div>

		

	</form>
</div>

<!--date-piker-->
<link rel="stylesheet" href="css/jquery-ui.css" />
<script src="js/jquery-ui.js"></script>
<script>
	$(function() {
		$( "#fec_emision_licencia,#fec_inicio_reposo,#fecnachijo,#fecha_accidente_trabajo").datepicker({
  dateFormat: "dd/mm/yy"
});
	});
</script>
<!--date-piker-->

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
</script>