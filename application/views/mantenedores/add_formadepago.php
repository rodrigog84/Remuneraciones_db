<div class="graph-visual tables-main">
											
		<h3 class="inner-tittle two">Creación Formas de Pagos</h3>
		<div class="graph">
		<form id="basicBootstrapForm" action="<?php echo base_url();?>mantenedores/submit_formapago" method="post">
		<div class="tables">
		<table class="table"> 
		<thead> 
		<tr>
		<th >Nombre :</th>
		</tr> 
		</thead> 
		<tbody> 
		<tr class="active" id="variable">
		<td class="form-group">
		<input type="text" name="nombre" id="nombre" class="descripcion  form-control" id="descripcion" placeholder="descripcion" value="<?php echo isset($idformapago->descripcion) ? $idformapago->descripcion : '';?>">
		</tr>  
		</tbody> 
		</table>
		<br>
		<a href="<?php echo base_url(); ?>mantenedores/formadepago" class = "btn btn-primary" >Volver</a>
		<button type = "submit" class = "btn btn-info" id="comando">Guardar
		</button>
		<input type="hidden" name="idformapago" value="<?php echo isset($idformapago->id_forma_pago) ? $idformapago->id_forma_pago: 0 ;?>">
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

            descripcion: {
                selector: '.descripcion',
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