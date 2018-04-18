/<!--sub-heard-part-->
								  <!--//sub-heard-part-->
								
									<div class="graph-visual tables-main">
											
													<a href="<?php echo base_url();?>mantenedores/add_region" type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Nuevo Idioma</a>
                          <a href="<?php echo base_url();?>exportarmantenedores/exportarExcelIdioma" class = "btn btn-primary" type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Exporta Excel</a>
                          <h3 class="inner-tittle two">Descripción</h3>
														  <div class="graph">														  	
															<div class="tables">
																<table id="listado" class="table"> 
																	<thead> 
																		<tr>
																			<th>#</th>
                												<th>Nombre</th>
                                        <th>Opciones</th>
																		</tr> 
																	</thead> 
																	<tbody> 
	                            			<?php $i = 1; ?>
	                            			<?php foreach ($idioma as $idioma) { ?>
																		<tr class="active" id="variable">
											              <td><small><h4 class="inner-tittle two"><?php echo $i ;?></small></h4></td>
	                              		<td><small><h4 class="inner-tittle two"><?php echo $idioma->nombre;?></small></h4></td>
                                    <td>
                                    <a href="<?php echo base_url();?>mantenedores/add_idioma/<?php echo $idioma->id_idioma?>" class="btn btn-info opciones" id="opciones" title="Editar Idioma"><i class="fa fa-pencil-square-o" aria-hidden="true" role="button"></i></a>
                                    <a href="#"  class="btn btn-danger" id="opciones" title="Eliminar" data-toggle="modal" data-target="#myModal_Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </td>
                                    </tr> 									                            <?php $i++;?>						                            <?php } ?>																		
																	</tbody> 
																</table> 
															</div>												
													</div>
											</div>
              <form action="<?php echo base_url();?>mantenedores/delete_regiones/" method="GET">
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
                          <a href="<?php echo base_url();?>mantenedores/delete_idioma/<?php echo $idioma->id_idioma;?>" type="button" class="btn btn-info"><span><i class="fa fa-trash-o" aria-hidden="true"></i></span> Eliminar</a>
                          <a href="#" type="button" class="btn btn-danger" data-dismiss="modal"><span><i class="fa fa-times" aria-hidden="true"></i></span> Cancelar</a>    
                        </div>
                    </div>
                  </div>
              </div>
</form>


<script>


$(function () {
        $('#listado').dataTable({
          "bLengthChange": true,
          "bFilter": true,
          "bInfo": true,
          "bSort": false,
          "bAutoWidth": false,
          "aLengthMenu" : [[5,10,15,30,45,100,-1],[5,10,15,30,45,100,'Todos']],
          "iDisplayLength": 10,
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
<script>

    $(document).ready(function() {
        <?php if(isset($message)){ ?>

        $.gritter.add({
            title: 'Atención',
            text: '<?php echo $message;?>',
            sticky: false,
            image: '<?php echo base_url();?>images/logos/<?php echo $classmessage == 'success' ? 'check_ok_accept_apply_1582.png' : 'alert-icon.png';?>',
            time: 5000,
            class_name: 'my-sticky-class'
        });
        
        <?php } ?>


    });
</script>   

