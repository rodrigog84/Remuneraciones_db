<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   <ol class="breadcrumb m-b-0">
											<li><a href="inicio.html">Inicio</a></li>
											<li class="active">Ingreso ISAPRE</li>
											
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

													<h3 class="inner-tittle two">Tabla de Ingreso de ISAPRE <button type="button" class="btn btn-primary btn-flat btn-pri" data-toggle="modal" data-target="#myModal_ISAPRE" id="nuevo"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Ingreso</button></h3>

													
														  <div class="graph">

														  	
															<div class="tables">
																<table class="table"> 
																	<thead> 
																		<tr>
																			<th>#</th>
																			<th>Nombre de ISAPRE:</th> 
																			<th>Codigo Previred:</th> 
																																	

																		</tr> 
																	</thead> 
																	<tbody> 
												                      <?php if(count($isapres) > 0 ){ ?>
												                        <?php $i = 1; ?>
												                        <?php foreach ($isapres as $isapre) { ?>																	
																		<tr class="active" id="variable">
																			<td><?php echo $i ;?></td>
																			<td><?php echo $isapre->nombre;?></td> 
																			<td><?php echo $isapre->codprevired;?></td>
																			
																			<td>
																				<a href="#" data-idisapre="<?php echo $isapre->id_isapre;?>" class="btn btn-info edit-isapre" id="opciones" data-toggle="modal" data-target="#myModal_ISAPRE" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
        																		
        																		<a href="<?php echo base_url();?>admins/delete_isapre/<?php echo $isapre->id_isapre;?>" data-toggle="tooltip"  class="btn btn-danger" id="opciones" title="Eliminar" data-toggle="modal" data-target="#myModal_Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a>
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
<form id="basicBootstrapForm" action="<?php echo base_url();?>admins/submit_isapre" id="basicBootstrapForm" method="post">
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="myModal_ISAPRE">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel">Ingreso de ISAPRE</h4>
	      </div>

	      <div class="modal-body">
	      	<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre de ISAPRE:">
	      	<br>
	      	<input type="text" name="codprevired" class="form-control" id="codprevired" placeholder="Codigo Previred:">
	      	<br>
     <!--       <div class="checkbox-inline"><label><input type="checkbox" name="exregimen" id="exregimen"> Ex-Régimen</label></div>
		    <input type="hidden" name="idafp" id="idafp" value="0" >
	-->
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
$('.edit-isapre').on('click',function(){
	var idisapre = $(this).data('idisapre');
 // Send data to back-end

        $.ajax({
            type: "GET",
            url: '<?php echo base_url();?>admins/get_isapre/'+idisapre,
            async: false,
        }).success(function(response) {

        	var_json = $.parseJSON(response);
        	$('#nombre').val(var_json.nombre);
        	$('#codprevired').val(var_json.codprevired);
        	
        	if(var_json.exregimen == 1){
        		$('#exregimen').prop('checked','checked');
        	}else{
        		$('#exregimen').prop('checked','');
        	}
        	$('#idisapre').val(idisapre);
        	
        });

})



$('#nuevo').on('click',function(){
        	$('#nombre').val('');
        	$('#codprevired').val('');
        	$('#idisapre').val(0);
})


</script>