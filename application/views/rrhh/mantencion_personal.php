<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   		<ol class="breadcrumb m-b-0">
												<li><a href="<?php echo base_url();?>main/dashboard">Inicio</a></li>
												<li class="active">Ficha del Colaborador</li>
											</ol>
									   </div>
								  <!--//sub-heard-part-->
								
									<div class="graph-visual tables-main">
											
													<h3 class="inner-tittle two">Ficha Colaborador <a href="<?php echo base_url();?>rrhh/add_trabajador" type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Colaborador</a>
														&nbsp;&nbsp;
														<a href="<?php echo base_url();?>rrhh/carga_masiva_personal" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-upload"></span>&nbsp;&nbsp;Carga Masiva</a>
													</h3>

													<h3 class="inner-tittle two">Descripción</h3>
														  <div class="graph">

														  	
															<div class="tables">
																<table id="listado" class="table"> 
																	<thead> 
																		<tr>
																			<th>#</th>
                            												<th>Nombre Trabajador</th>
                            												<th>Rut</th>
                            												<th>Direcci&oacute;n</th>
                            												<th>Estado</th>
																			<th>Opciones</th>

																		</tr> 
																	</thead> 
																	<tbody> 
	                          										<?php if(count($personal) > 0 ){ ?>
	                            										<?php $i = 1; ?>
	                            										<?php foreach ($personal as $trabajador) { ?>				
																		<tr class="active" id="variable">
											                              <td><small><?php echo $i ;?></small></td>
	                              										  <td><small><?php echo $trabajador->nombre." ".$trabajador->apaterno." ".$trabajador->amaterno;?></small></td>
	                                									  <td><small><?php echo $trabajador->rut == '' ? '' : number_format($trabajador->rut,0,".",".")."-".$trabajador->dv;?></small></td>
	                              										  <td><small><?php echo $trabajador->direccion;?></small></td>
	                              										  <td><small><?php echo $trabajador->active == 1 ? "Activo" : "Inactivo";?></small></td>
																			<td>
																				<button type="button" class="btn btn-info opciones" id="opciones" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
        																		
        																		<button type="button" class="btn btn-danger" id="opciones" title="Eliminar" data-toggle="modal" data-target="#myModalElim"><i class="fa fa-times" aria-hidden="true"></i></button>
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


<script>


$(function () {
        $('#listado').dataTable({
          "bLengthChange": true,
          "bFilter": true,
          "bInfo": true,
          "bSort": false,
          "bAutoWidth": false,
          "aLengthMenu" : [[5,15,30,45,100,-1],[5,15,30,45,100,'Todos']],
          "iDisplayLength": 5,
          "oLanguage": {
              "sLengthMenu": "_MENU_ Registros por p&aacute;gina",
              "sZeroRecords": "No se encontraron registros",
              "sInfo": "Mostrando del _START_ al _END_ de _TOTAL_ registros",
              "sInfoEmpty": "Mostrando 0 de 0 registros",
              "sInfoFiltered": "(filtrado de _MAX_ registros totales)",
              "sSearch":        "Buscar:",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":    "Último",
                "sNext":    "Siguiente",
                "sPrevious": "Anterior"
            }              
          }          
        });
      });


</script>											