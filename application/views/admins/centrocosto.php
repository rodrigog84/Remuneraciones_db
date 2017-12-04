<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   <ol class="breadcrumb m-b-0">
											<li><a href="inicio.html">Inicio</a></li>
											<li class="active">Ingreso Centro Costo</li>
											
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

													<h3 class="inner-tittle two">Tabla de Ingreso Centro de Costo<button type="button" class="btn btn-primary btn-flat btn-pri" data-toggle="modal" data-target="#myModal_CENTROCOSTO" id="nuevo"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Ingreso</button></h3>

													
														  <div class="graph">

														  	
															<div class="tables">
																<table class="table"> 
																	<thead> 
																		<tr>
																			<th>#</th>
																			<th>Nombre Centro de Costo:</th> 
																			<th>Empresa:</th> 
																			<th>Codigo</th>					

																		</tr> 
																	</thead> 
																	<tbody> 
												                      <?php if(count($centrocosto) > 0 ){ ?>
												                        <?php $i = 1; ?>
												                        <?php foreach ($centrocostos as $centrocosto) { ?>																	
																		<tr class="active" id="variable">
																			<td><?php echo $i ;?></td>
																			<td><?php echo $centrodecosto->nombre;?></td> 
																			<td><?php echo $centrodecosto->idempresa;?></td>
																			<td><?php echo $centrodecosto->codigo;?></td>
																			<td>
																				<a href="#" data-idcentrodecosto="<?php echo $centrodecosto->id;?>" class="btn btn-info edit-centrocosto" id="opciones" data-toggle="modal" data-target="#myModal_CENTROCOSTO" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
        																		
        																		<a href="<?php echo base_url();?>centrocosto/delete_centrocosto/<?php echo $centrocosto->id;?>" data-toggle="tooltip"  class="btn btn-danger" id="opciones" title="Eliminar" data-toggle="modal" data-target="#myModal_Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a>
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

<!-- //Modal ingresar CENTROCOSTO -->
<form id="basicBootstrapForm" action="<?php echo base_url();?>Centro_costo/submit_centrocosto" id="basicBootstrapForm" method="post">
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="myModal_CENTROCOSTO">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel">Ingreso de Centro de Costo</h4>
	      </div>

	      <div class="modal-body">
	      	<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre de Centro de Costo:">
	      	<br>
	      	<input type="text" name="idempresa" class="form-control" id="idempresa" placeholder="Empresa:">
	      	<br>
			<input type="text" name="codigo" class="form-control" id="codigo" placeholder="Codigo:">
			<input type="hidden" name="idcentrodecosto" id="idcentrodecosto" value="0" >
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
$('.edit-centrocosto').on('click',function(){
	var idcentrodecosto = $(this).data('idcentrodecosto');
 // Send data to back-end

        $.ajax({
            type: "GET",
            url: '<?php echo base_url();?>Centro_costo/get_centrodecosto/'+idcentrodecosto,
            async: false,
        }).success(function(response) {

        	var_json = $.parseJSON(response);
        	$('#nombre').val(var_json.nombre);
        	$('#idempresa').val(var_json.idempresa);        	
        	$('#codigo').val(var_json.codigo);  
        	$('#idcentrodecosto').val(idcentrodecosto);
        	
        });

})



$('#nuevo').on('click',function(){
        	$('#nombre').val('');
        	$('#porc').val('');
        	$('#exregimen').prop('checked','');
        	$('#idcentrodecosto').val(0);
})


</script>