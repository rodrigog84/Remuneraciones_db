
<div class="graph-visual tables-main">
											
		<h3 class="inner-tittle two">Creación Empresas</h3>
		<div class="graph">
		<form id="basicBootstrapForm" action="<?php echo base_url();?>mantenedores/submit_empresas" method="post">
		<div class="tables">
		<table class="table"> 
		<thead> 
		<tr>
        <th >Nombre : <input type="text" name="nombre" id="nombre" class="descripcion  form-control" id="nombre" placeholder="nombre" value="<?php echo isset($empresa->nombre) ? $empresa->nombre : '';?>" requiere>        
		<th  size="15">Rut   : <input type="text" size="15" name="rut" id="rut" class="form-control" id="rut" placeholder="12.262.247-9" value="<?php echo isset($empresa->rut) ? $empresa->rut : '';?>" requiere>  
        </th>
        <th >Direccion   : <input type="text" name="direccion" id="direccion" class="descripcion  form-control" id="direccion" placeholder="direccion" value="<?php echo isset($empresa->direccion) ? $empresa->direccion : '';?>" requiere>
        </th>
        <tr>
        <th >Comuna : <select name="comuna" id="comuna" class="form-control1" required>
        <?php foreach ($comuna as $comuna) { ?>
              <?php $comunaselected = $comuna->idcomuna == $datos_form['idcomuna'] ? "selected" : ""; ?>
              <option value="<?php echo $comuna->idcomuna;?>" <?php echo $comunaselected;?> ><?php echo $comuna->nombre;?></option>
            <?php } ?>
        </select>  
        </th>  
        <th >Region  :  <select name="region" id="region" class="form-control1" required>
        <?php foreach ($region as $region) { ?>
              <?php $regionselected = $region->id_region == $datos_form['id_region'] ? "selected" : ""; ?>
              <option value="<?php echo $region->id_region;?>" <?php echo $regionselected;?> ><?php echo $region->nombre;?></option>
            <?php } ?>
        </select>  
        </th>
        <th >Fono   : <input type="text" name="fono" id="fono" class="descripcion  form-control" id="fono" placeholder="fono" value="<?php echo isset($empresa->fono) ? $empresa->fono : '';?>" requiere>
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

            descripcion: {
                selector: '.nombre',
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Nombre es requerida'
                    },
                },

            },        
   			          
           
        }
    })
});

</script>	

									