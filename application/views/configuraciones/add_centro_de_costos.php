      <div class="panel panel-inverse">                       
          <div class="panel-heading">
                <h4 class="panel-title">Creaci&oacute;n Centros de Costo</h4>
            </div>
<div class="panel-body">
  <div class='row'>

<div class="graph-visual tables-main">
											
		<div class="graph">
		<form id="basicBootstrapForm" action="<?php echo base_url();?>configuraciones/submit_centro_costo" method="post">
		<div class="tables">
		<table class="table"> 
		<thead> 
		<tr>
		<th >Codigo :</th> 
		<th >Nombre :</th>
		</tr> 
		</thead> 
		<tbody> 
		<tr class="active" id="variable">
		<td class="form-group">
		<input type="text" name="codigo" id="codigo" class="form-control codigo" id="codigo" placeholder="Código" size="4" value="<?php echo isset($centro_costo->codigo) ? $centro_costo->codigo : '';?>">
		</td>
		<td class="form-group">
		<input type="text" name="nombre" id="nombre" class="descripcion  form-control" id="nombre" placeholder="nombre" value="<?php echo isset($centro_costo->nombre) ? $centro_costo->nombre : '';?>">
		</td> 
		</tr>  
		</tbody> 
		</table>
		<br>
		<a href="<?php echo base_url(); ?>configuraciones/centrocosto" class = "btn btn-primary" >Volver</a>
		<button type = "submit" class = "btn btn-info" id="comando">Guardar
		</button>
		<input type="hidden" name="idcentro" value="<?php echo isset($centro_costo->id_centro_costo) ? $centro_costo->id_centro_costo: 0 ;?>">
		</div>
</form>
</div>
</div>

</div>
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
                        message: 'C&oacute;digo Centro de Costo es requerido'
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