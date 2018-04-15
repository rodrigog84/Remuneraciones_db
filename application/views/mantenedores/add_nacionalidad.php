<div class="graph-visual tables-main">
											
		<h3 class="inner-tittle two">Creación Paises</h3>
		<div class="graph">
		<form id="basicBootstrapForm" action="<?php echo base_url();?>mantenedores/submit_nacionalidad" method="post">
		<div class="tables">
		<table class="table"> 
		<thead> 
		<tr>
		<th >ISO :</th> 
		<th >Nombre :</th>
		</tr> 
		</thead> 
		<tbody> 
		<tr class="active" id="variable">
		<td class="form-group">
		<input type="text" name="iso" id="iso" class="form-control codigo" id="iso" placeholder="Codigo ISO" size="4" value="<?php echo isset($paises->iso) ? $paises->iso : '';?>">
		</td>
		<td class="form-group">
		<input type="text" name="nombre" id="nombre" class="descripcion  form-control" id="nombre" placeholder="nombre" value="<?php echo isset($paises->nombre) ? $paises->nombre : '';?>">
		</td> 
		</tr>  
		</tbody> 
		</table>
		<br>
		<a href="<?php echo base_url(); ?>mantenedores/nacionalidad" class = "btn btn-primary" >Volver</a>
		<button type = "submit" class = "btn btn-info" id="comando">Guardar
		</button>
		<input type="hidden" name="idnacionalidad" value="<?php echo isset($paises->id_paises) ? $paises->id_paises: 0 ;?>">
		</div>
</form>
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

            codigo: {
                selector: '.iso',
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'C&oacute;digo ISO es requerido'
                    },
                },

            }, 

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