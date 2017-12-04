<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   <ol class="breadcrumb m-b-0">
											<li><a href="inicio.html">Inicio</a></li>
											<li class="active">Ingreso Estudios</li>
											
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

													<h3 class="inner-tittle two">Tabla de Ingreso Estudios<button type="button" class="btn btn-primary btn-flat btn-pri" data-toggle="modal" data-target="#myModal_ESTUDIOS" id="nuevo"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Ingreso</button></h3>

													
														  <div class="graph">

														  	
															<div class="tables">
																<table class="table"> 
																	<thead> 
																		<tr>
																			<th>#</th>
																			<th>Nombre Estudio:</th> 
																			<th>Empresa:</th> 
																			<th>Codigo</th>					

																		</tr> 
																	</thead> 
																	<tbody> 
												                      <?php if(count($estudios) > 0 ){ ?>
												                        <?php $i = 1; ?>
												                        <?php foreach ($estudios as $estudio) { ?>																	
																		<tr class="active" id="variable">
																			<td><?php echo $i ;?></td>
																			<td><?php echo $estudio->nombre;?></td> 
																			<td><?php echo $estudio->idempresa;?></td>
																			<td><?php echo $estudio->codigo;?></td>
																			<td>
																				<a href="#" data-idestudios="<?php echo $estudio->id;?>" class="btn btn-info edit-estudio" id="opciones" data-toggle="modal" data-target="#myModal_ESTUDIO" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
        																		
        																		<a href="<?php echo base_url();?>estudios/delete_estudios/<?php echo $estudio->id;?>" data-toggle="tooltip"  class="btn btn-danger" id="opciones" title="Eliminar" data-toggle="modal" data-target="#myModal_Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a>
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
									<!--/charts-inner-->

<!-- //Modal ingresar ESTUDIOS -->
<form id="basicBootstrapForm" action="<?php echo base_url();?>Estudios/submit_estudios" id="basicBootstrapForm" method="post">
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="myModal_ESTUDIOS">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel">Ingreso Estudios</h4>
	      </div>

	      <div class="modal-body">
	      	<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre Estudios:">
	      	<br>
	      	<input type="text" name="idempresa" class="form-control" id="idempresa" placeholder="Empresa:">
	      	<br>
			<input type="text" name="codigo" class="form-control" id="codigo" placeholder="Codigo:">
			<input type="hidden" name="idestudios" id="idestudios" value="0" >
			<br>
			<br>
			<button type = "submit" class = "btn btn-info" id="comando">Ingresar</button>
			<button type = "button" class = "btn btn-danger" data-dismiss="modal"  id="comando">Cancelar</button>
	      </div>
	    </div>
	  </div>
	</div>	
</form>								

<script>
$('.edit-estudios').on('click',function(){
	var idestudios = $(this).data('idestudios');
 // Send data to back-end

        $.ajax({
            type: "GET",
            url: '<?php echo base_url();?>Estudios/get_estudios/'+idestudios,
            async: false,
        }).success(function(response) {

        	var_json = $.parseJSON(response);
        	$('#nombre').val(var_json.nombre);
        	$('#idempresa').val(var_json.idempresa);        	
        	$('#codigo').val(var_json.codigo);  
        	$('#idestudios').val(idestudios);
        	
        });

})



$('#nuevo').on('click',function(){
        	$('#nombre').val('');
        	$('#porc').val('');
        	$('#exregimen').prop('checked','');
        	$('#idestudios').val(0);
})


</script>