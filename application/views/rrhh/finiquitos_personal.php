<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   		<ol class="breadcrumb m-b-0">
												<li><a href="<?php echo base_url();?>main/dashboard">Inicio</a></li>
												<li class="active">Finiquitos Colaborador</li>
											</ol>
									   </div>
								  <!--//sub-heard-part-->
								
									<div class="graph-visual tables-main">
											
									
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
								<a href="<?php echo base_url();?>rrhh/finiquito_colaborador/<?php echo $trabajador->id_personal?>" class="btn btn-info opciones" id="opciones" title="Finiquito"><i class="fa fa-pencil-square-o" aria-hidden="true" role="button"></i></a>						
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