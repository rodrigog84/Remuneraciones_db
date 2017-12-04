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

													<h3 class="inner-tittle two">Tabla de Ingreso de AFP <button type="button" class="btn btn-primary btn-flat btn-pri" data-toggle="modal" data-target="#myModal_AFP" id="nuevo"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Ingreso</button></h3>

													
														  <div class="graph">

														  	
															<div class="tables">
																<table class="table"> 
																	<thead> 
																		<tr>
																			<th>#</th>
																			<th>Nombre de AFP:</th> 
																			<th>Porcentaje:</th> 
																			<th>Ex Régimen</th> 
																			<th>Opciones</th> 
																			

																		</tr> 
																	</thead> 
																	<tbody> 
												                      <?php if(count($afps) > 0 ){ ?>
												                        <?php $i = 1; ?>
												                        <?php foreach ($afps as $afp) { ?>																	
																		<tr class="active" id="variable">
																			<td><?php echo $i ;?></td>
																			<td><?php echo $afp->nombre;?></td> 
																			<td><?php echo $afp->porc." %";?></td>
																			<td><?php echo $afp->exregimen == 1 ? 'SI': 'NO';?></td>
																			<td>
																				<a href="#" data-idafp="<?php echo $afp->id;?>" class="btn btn-info edit-afp" id="opciones" data-toggle="modal" data-target="#myModal_AFP" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
        																		
        																		<a href="<?php echo base_url();?>admins/delete_afp/<?php echo $afp->id;?>" data-toggle="tooltip"  class="btn btn-danger" id="opciones" title="Eliminar" data-toggle="modal" data-target="#myModal_Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a>
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

<!-- //Modal ingresar AFP -->
<form id="basicBootstrapForm" action="<?php echo base_url();?>admins/submit_afp" id="basicBootstrapForm" method="post">
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="myModal_AFP">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel">Ingreso de AFP</h4>
	      </div>

	      <div class="modal-body">
	      	<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre de AFP:">
	      	<br>
	      	<input type="text" name="porc" class="form-control" id="porc" placeholder="Porcentaje:">
	      	<br>
			<div class="checkbox-inline"><label><input type="checkbox" name="exregimen" id="exregimen"> Ex-Régimen</label></div>
			<input type="hidden" name="idafp" id="idafp" value="0" >
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
$('.edit-afp').on('click',function(){
	var idafp = $(this).data('idafp');
 // Send data to back-end

        $.ajax({
            type: "GET",
            url: '<?php echo base_url();?>admins/get_afp/'+idafp,
            async: false,
        }).success(function(response) {

        	var_json = $.parseJSON(response);
        	$('#nombre').val(var_json.nombre);
        	$('#porc').val(var_json.porc);
        	
        	if(var_json.exregimen == 1){
        		$('#exregimen').prop('checked','checked');
        	}else{
        		$('#exregimen').prop('checked','');
        	}
        	$('#idafp').val(idafp);
        	
        });

})



$('#nuevo').on('click',function(){
        	$('#nombre').val('');
        	$('#porc').val('');
        	$('#exregimen').prop('checked','');
        	$('#idafp').val(0);
})


</script>