
<div class="graph-visual tables-main">
											
		<h3 class="inner-tittle two">Creación Empresas</h3>
		<div class="graph">
		<form id="basicBootstrapForm" action="<?php echo base_url();?>mantenedores/submit_empresas" method="post">
		<div class="tables">
		<table class="table"> 
		<thead> 
		<tr>
        <th >Nombre : <input type="text" name="nombre" id="nombre" class="descripcion  form-control" id="nombre" placeholder="nombre" value="<?php echo isset($empresa->nombre) ? $empresa->nombre : '';?>" required></th>        
		<th>Rut   :<input type="text" size="15" name="rut" id="rut" class="form-control" id="rut" placeholder="12.262.247-9" oninput="checkRut(this)" value="<?php echo isset($empresa->rut) ? $empresa->rut : '';?>" required></th>
        <th >Direccion   : <input type="text" name="direccion" id="direccion" class="descripcion  form-control" id="direccion" placeholder="direccion" value="<?php echo isset($empresa->direccion) ? $empresa->direccion : '';?>" required>
        </th>
        </tr>
        <tr>
        <th >Comuna : <select name="comuna" id="comuna" class="form-control" required>
        <?php foreach ($comuna as $comuna) { ?>
              <?php $comunaselected = $comuna->idcomuna == $datos_form['idcomuna'] ? "selected" : ""; ?>
              <option value="<?php echo $comuna->idcomuna;?>" <?php echo $comunaselected;?> ><?php echo $comuna->nombre;?></option>
            <?php } ?>
        </select>  
        </th>  
        <th >Region  :  <select name="region" id="region" class="form-control" required>
        <?php foreach ($region as $region) { ?>
              <?php $regionselected = $region->id_region == $datos_form['id_region'] ? "selected" : ""; ?>
              <option value="<?php echo $region->id_region;?>" <?php echo $regionselected;?> ><?php echo $region->nombre;?></option>
            <?php } ?>
        </select>  
        </th>
        <th >Fono   : <input type="text" name="fono" id="fono" class="descripcion  form-control" id="fono" placeholder="fono" value="<?php echo isset($empresa->fono) ? $empresa->fono : '';?>" requiere>
        </th>
		</tr> 


        <tr>

        <?php $rol_privado = isset($empresa->rol_privado) ? $empresa->rol_privado : 0; ?>
        <th >Tiene Rol Privado : <select name="rol_privado" id="rol_privado" class="form-control" required>
              <option value="1" <?php echo $rol_privado == 1 ? 'selected' : ''; ?>>SI</option>
              <option value="0" <?php echo $rol_privado != 1 ? 'selected' : ''; ?>>NO</option>
        </select>  
        </th>  
        </tr>         
		</thead> 
		<tbody> 
		<tr class="active" id="variable">
		</tr>  
		</tbody> 
		</table>
		<br>
		<a href="<?php echo base_url(); ?>mantenedores/empresas" class = "btn btn-primary" >Volver</a>
		<button type = "submit" class = "btn btn-info" id="comando">Guardar
		</button>
		<input type="hidden" name="idempresas" value="<?php echo isset($empresa->id_empresa) ? $empresa->id_empresa: 0 ;?>">
		</div>
</form>
</div>
</div>
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

									