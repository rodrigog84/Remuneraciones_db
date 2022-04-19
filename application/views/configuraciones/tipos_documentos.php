<!--sub-heard-part-->
								
									<a href="<?php echo base_url();?>configuraciones/add_formato_documento" type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</a>
									&nbsp;&nbsp;
                  <br><br>              								
									
	
                          <div class="panel panel-inverse">                       
                                <div class="panel-heading">
                                      <h4 class="panel-title">Listado de Tipos de Documento</h4>
                                  </div>
                      <div class="panel-body">
                        <div class='row'>										  	
											<div class="tables">
										<table id="listado" class="table"> 
											<thead> 
												<tr>
													<th>#</th>
                            <th>Documento</th>
    												<th>Tipo </th>
    												<th>Editar</th>
                            <th>Ver Ejemplo</th>

												</tr> 
											</thead> 
											<tbody> 
	                          	<?php if(count($formatosdocumentos) > 0 ){ ?>
	                            <?php $i = 1; ?>
	                            <?php foreach ($formatosdocumentos as $formatodocumento) { ?>				
								<tr class="active" id="variable">
	                              <td><small><?php echo $i ;?></small></td>
									  <td><small><?php echo $formatodocumento->nombre;?></small></td>		
                    <td><small><?php echo $formatodocumento->tipo;?></small></td>   					  
								<td>			
								<a href="<?php echo base_url();?>configuraciones/ver_formato_documento/<?php echo $formatodocumento->id_formato?>" class="opciones" id="opciones" title="Contrato"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true" role="button"></i></a></td>
                <td>			
                <a href="<?php echo base_url();?>configuraciones/ejemplo_formato_documento/<?php echo $formatodocumento->id_formato?>" class="opciones" id="opciones" title="Contrato" target='_blank'><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" role="button"></i></a>   


								</td>
								</tr> 

	                            <?php $i++;?>
		                       <?php } ?>
									<?php } ?>		
								
							</tbody> 
						</table> 
					</div>


						</div>

                      </div><!-- /.box-body -->

                 
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
              "sSearch":        "Buscar",
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
