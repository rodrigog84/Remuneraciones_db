<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   		<ol class="breadcrumb m-b-0">
												<li><a href="<?php echo base_url();?>main/dashboard">Inicio</a></li>
												<li class="active">Tipo de Contratos Colaborador</li>
											</ol>
									   </div>
								  <!--//sub-heard-part-->
								
									<div class="graph-visual tables-main">
									<h3 class="inner-tittle two">Nuevo Contrato <a href="<?php echo base_url();?>configuraciones/tipos_contrato_colaboradores" type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</a>
														&nbsp;&nbsp;
														
													</h3>
											
									
									<h3 class="inner-tittle two">Descripción</h3>
										  <div class="graph">

										  	
											<div class="tables">
										<table id="listado" class="table"> 
											<thead> 
												<tr>
													<th>#</th>
    												<th>Tipo Contrato</th>
    												<th>Opciones</th>

												</tr> 
											</thead> 
											<tbody> 
	                          	<?php if(count($tipocontrato) > 0 ){ ?>
	                            <?php $i = 1; ?>
	                            <?php foreach ($tipocontrato as $contrato) { ?>				
								<tr class="active" id="variable">
	                              <td><small><?php echo $i ;?></small></td>
									  <td><small><?php echo $contrato->tipo;?></small></td>							  
								<td>			
								<a href="" class="btn btn-info opciones" id="opciones" title="Contrato"><i class="fa fa-pencil-square-o" aria-hidden="true" role="button"></i></a>						
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
<script>

    $(document).ready(function() {
        <?php if(isset($message)){ ?>

        $.gritter.add({
            title: 'Atención',
            text: '<?php echo $message;?>',
            sticky: false,
            image: '<?php echo base_url();?>images/logos/alert-icon.png',
            time: 5000,
            class_name: 'my-sticky-class'
        });
        /*setTimeout(redirige, 1500);
        function redirige(){
            location.href = '<?php //echo base_url();?>welcome/dashboard';
        }*/
        <?php } ?>


    });
</script>


<script>
	function desactivar_colaborador(rut){

		$.ajax({type: "GET",
		    		url: "<?php echo base_url();?>rrhh/verificar_trabajador/"+rut, 
		    		dataType: "json",
		    		success: function(personal){
		      			if(personal ==0){
		      				
								bootbox.confirm({
							    title: "Activar Colaborador",
							    message: "¿Desea realizar la activación de Colaborador?",
							    buttons: {
							        cancel: {
							            label: '<i class="fa fa-times"></i> Cancelar'
							        },
							        confirm: {
							            label: '<i class="fa fa-check"></i> Confirmar'
							        }
							    },
							    callback: function (result) {
							        //console.log('This was logged in the callback: ' + result);
							        if (result == true){
							    		window.location="<?php echo base_url();?>rrhh/activar_trabajador/"+rut;
							    	}
							    }

								});

						}else{
								bootbox.confirm({
							    title: "Desactivar Colaborador",
							    message: "¿Desea realizar la desactivación de Colaborador?",
							    buttons: {
							        cancel: {
							            label: '<i class="fa fa-times"></i> Cancelar'
							        },
							        confirm: {
							            label: '<i class="fa fa-check"></i> Confirmar'
							        }
							    },
							    callback: function (result) {
							        //console.log('This was logged in the callback: ' + result);
							        if (result == true){
							   		window.location="<?php echo base_url();?>rrhh/desactivar_trabajador/"+rut;
							    	}
							    }

								});


							}

		      		}
		     	}); 
		



		
	



};
</script>