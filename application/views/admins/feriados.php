<!--sub-heard-part-->
<div class="sub-heard-part">
	<ol class="breadcrumb m-b-0">
		<li><a href="inicio.html">Inicio</a></li>
		<li class="active">Días Feriados</li>
	</ol>
</div>
<!--//sub-heard-part-->
								
<div class="graph-visual tables-main">
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
	
	<h3 class="inner-tittle two">Tabla de Días Feriados <button type="button" class="btn btn-primary btn-flat btn-pri btn-lg" data-toggle="modal" data-target="#myModal_feriado" id="nuevo"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Ingreso</button></h3>

	<div class="graph">
		<div class="tables">
			<table id="listado"  class="table"> 
				<thead> 
					<tr>
						<th>#</th>
						<th>Fecha Feriado</th>
						<th>Opciones</th>
					</tr> 
				</thead> 
				<tbody> 
					<?php if(count($feriados) > 0 ){ ?>
					<?php $i = 1; ?>
					<?php foreach ($feriados as $feriado) { ?>																	
					<tr class="active" id="variable">
						<td><?php echo $i ;?></td>
						<td><?php echo $feriado->fecha;?></td>
																			
						<td>
							<a href="#" data-idferiado="<?php echo $feriado->id_feriado;?>" class="btn btn-info edit-feriado" id="opciones" data-toggle="modal" data-target="#myModal_feriado" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
        																		
        					<a href="#"  class="btn btn-danger" id="opciones" title="Eliminar" data-toggle="modal" data-target="#myModal_Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a>
						</td>
					</tr> 
					<?php $i++;?>
					<?php } ?>
					<?php } ?>																	 
				</tbody> 
			</table> 
		</div>
	</div>
</div>


<!-- //Modal Eliminar -->
<form action="<?php echo base_url();?>admins/delete_feriado/" method="GET">
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="myModal_Eliminar">
  		<div class="modal-dialog modal-sm" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title" id="exampleModalLabel">Eliminar</h4>
      			</div>

      			<div class="modal-body">
      				<h4 class="modal-body">¿Deseas Eliminar?</h4>
      				<br>
      				<a href="<?php echo base_url();?>admins/delete_feriado/<?php echo $feriado->id_feriado;?>" type="button" class="btn btn-info"><span><i class="fa fa-trash-o" aria-hidden="true"></i></span> Eliminar</a>
      				<a href="#" type="button" class="btn btn-danger" data-dismiss="modal"><span><i class="fa fa-times" aria-hidden="true"></i></span> Cancelar</a>		
      			</div>
    		</div>
  		</div>
	</div>
</form>

<!-- //Modal Eliminar -->


<!-- //Modal ingresar feriados -->
<form id="basicBootstrapForm" action="<?php echo base_url();?>admins/submit_feriado" id="basicBootstrapForm" method="post">
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="myModal_feriado">
  		<div class="modal-dialog modal-sm" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title" id="exampleModalLabel">Nuevo Feriado</h4>
      			</div>

      			<div class="modal-body">
      
            		<div class="input-group date form_date"  data-date="" data-date-format="dd MM yyyy" data-link-format="yyyy-mm-dd" >
                		<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                 		<input class="form-control" size="16" type="text" readonly name="fecha" placeholder="Ingrese Feriado">    
            		</div>  
      				<input type="hidden" name="idferiado" id="idferiado" value="0" >
					<button type = "submit" class = "btn btn-info" id="comando">Ingresar</button>
					<button type = "button" class = "btn btn-danger" data-dismiss="modal"  id="comando">Cancelar</button>
      			</div>
    		</div>
  		</div>
	</div>
</form>
<!-- //Modal ingresar feriados -->

<script>
    $(".form_date").datetimepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left",
        weekStart: true,
        startView: 2,
        minView: 2,
        forceParse: 0,
        language:  'es',     
    });      

	$('.edit-feriado').on('click',function(){
		var idferiado = $(this).data('idferiado');
 		// Send data to back-end

        $.ajax({
            type: "GET",
            url: '<?php echo base_url();?>admins/get_feriado/'+idferiado,
            async: false,
        }).success(function(response) {

        	var_json = $.parseJSON(response);
        	$('#fecha').val(var_json.fecha);
        	$('#idferiado').val(idferiado);
        	
        });

	})

	$('#nuevo').on('click',function(){
    	$('#fecha').val('');
    	$('#idferiado').val(0);
	})    
</script>           											