									<div class="graph-visual tables-main">
											

											
														  <div class="graph">

									            <div class="row">


									            	<div class='col-md-6'>
								                            <div class="panel panel-inverse">                       
								                                <div class="panel-heading">
								                                      <h4 class="panel-title">Centro de Costo</h4>
								                                  </div>
								                      <div class="panel-body">
								                        <div class='row'>	


									                  	<form id="basicBootstrapForm" action="<?php echo base_url();?>rrhh/detalle_total" id="basicBootstrapForm" method="post"> 
									                    <div class="panel-body" >

									                      <div class='row'>
									                          <div class='col-md-6'>
									                            <div class="form-group">
																<select name="centrocosto" id="centrocosto" class="form-control">
																	<option value="0">Todos</option>
																	<?php foreach ($centros_costo as $centro_costo) { ?>
																		<?php $centrocosto_selected = $centro_costo->id_centro_costo == $idcentrocosto ? 'selected' : '';?>
																		<option value="<?php echo $centro_costo->id_centro_costo;?>" <?php echo $centrocosto_selected; ?>><?php echo $centro_costo->nombre;?></option>
																	<?php } ?>
																	
																</select>
									                            </div> 
									                          </div>
									                         
									                      </div>
									                      <div class="row">
									                      	<div class='col-md-3'>
									                      			<button type="submit" class="btn btn-primary">Buscar</button>&nbsp;&nbsp;
									                      	</div>
									                      </div>  
                
									                    </div><!-- /.box-body -->
									                    </form>




									                  </div>
									                </div>
									            </div>
									        </div>

									            </div>


                            <div class="panel panel-inverse">                       
                                <div class="panel-heading">
                                      <h4 class="panel-title">Detalle Remuneraciones</h4>
                                  </div>
                      <div class="panel-body">
                        <div class='row'>									            

																<div id="remuneraciones">
																<table class="table" id="detalle_remuneracion"> 
																	<thead> 
																		<tr>
																			<th><small>#</small></th>
																			<th><small>Mes</small></th> 
																			<th><small>A&ntilde;o</small></th> 
													                        <th><small>N&uacute;mero Colaboradores</small></th>
													                        <th><small>Remuneraci&oacute;n Total (L&iacute;quido)</small></th>
													                        <th><small>Detalle</small></th>
													                        <!--th>Planillas Imposiciones</th-->
													                        <th><small>Previred</small></th>
													                        <th><small>Pago a Bancos</small></th>
													                        <th><small>Libro Remuneraciones</small></th>
													                        <th><small>LRE</small></th>
													                        <th><small>Liquidaciones</small></th>
																		</tr> 
																	</thead> 
																	<tbody> 
																	<?php $i = 1; 
											                        $back_button = false;
											                        ?>
											                        <?php // echo "<pre>"; print_r($datosperiodo); exit; ?>
											                        <?php if(count($datosperiodo) > 0){ ?>
											                          <?php foreach ($datosperiodo as $periodo) { ?>
                       
											                           <tr>
											                            <td><small><?php echo $i;?></small></td>
											                            <td><small><?php echo month2string($periodo->mes);?></small></td>
											                            <td><small><?php echo $periodo->anno;?></small></td>
											                            <td><small><?php echo number_format($periodo->numtrabajadores,0,".",".");?></small></td>
											                            <td><small>$&nbsp;<?php echo number_format($periodo->sueldoliquido,0,".",".");?></small></td>
											                              <td><small>
											                              <center>
											                              <?php if(!is_null($periodo->cierre) && $periodo->numtrabajadores > 0){ ?>
											                              <a href="<?php echo base_url(); ?>rrhh/ver_remuneraciones_periodo/2/<?php echo $periodo->id_periodo."/".$idcentrocosto; ?>" data-toggle="tooltip" title="Ver Remuneraciones Personal"><span class="glyphicon glyphicon-search"></span></a>
											                              <?php }else{ ?>
											                              		-
											                              <?php } ?>
											                              </center></small>
											                              </td>
											                               <!--td>
											                              <center>
											                              <?php if(!is_null($periodo->cierre)  && $periodo->numtrabajadores > 0){ ?>
											                              <a href="<?php echo base_url(); ?>rrhh/ver_planillas_imposiciones/<?php echo $periodo->id_periodo."/".$idcentrocosto;?>" ><span class="glyphicon glyphicon-search"></span></a>  
											                              <?php }else{ ?>
											                              		-
											                              <?php } ?>
											                              </center>
											                              </td-->
											                              <td><small>
											                              <center>
											                              <?php if(!is_null($periodo->cierre)  && $periodo->numtrabajadores > 0 && is_null($idcentrocosto)){ ?>
											                              <a href="<?php echo base_url(); ?>rrhh/previred/<?php echo $periodo->id_periodo;?>/<?php echo $idcentrocosto;?>" target="_blank"><span class="glyphicon glyphicon-list-alt"></span></a>  
											                              <?php }else{ ?>
											                              		-
											                              <?php } ?>
											                              </center></small>
											                              </td>
											                              <td><small>
											                              <center>
											                              <?php if(!is_null($periodo->cierre)  && $periodo->numtrabajadores > 0 && is_null($idcentrocosto)){ ?>
											                              <a href="<?php echo base_url(); ?>rrhh/pago_bancos/<?php echo $periodo->id_periodo;?>" target="_blank"><span class="glyphicon glyphicon-list-alt"></span></a>  
											                              <?php }else{ ?>
											                              		-
											                              <?php } ?>
											                              </center></small>
											                              </td>
											                              <td><small>
											                              <center>
											                              <?php if(!is_null($periodo->cierre)  && $periodo->numtrabajadores > 0 && is_null($idcentrocosto)){ ?>
											                              <a href="<?php echo base_url(); ?>rrhh/libro/<?php echo $periodo->id_periodo;?>" ><span class="glyphicon glyphicon-book"></span></a>  
											                              <?php }else{ ?>
											                              		-
											                              <?php } ?>
											                              </center></small>
											                              </td>
											                               <td><small>
											                              <center>
											                              <?php if(!is_null($periodo->cierre)  && $periodo->numtrabajadores > 0 && is_null($idcentrocosto)){ ?>
											                              <a href="<?php echo base_url(); ?>rrhh/lre/<?php echo $periodo->id_periodo;?>" target="_blank"><span class="glyphicon glyphicon-list-alt"></span></a>  
											                              <?php }else{ ?>
											                              		-
											                              <?php } ?>
											                              </center></small>
											                              </td>  
											                              <td><small>
											                              	<center>
											                              	 <?php if(!is_null($periodo->cierre)  && $periodo->numtrabajadores > 0 ){ ?>
											                              		<a href="<?php echo base_url(); ?>rrhh/liquidaciones/<?php echo $periodo->id_periodo."/".$idcentrocosto; ?>" target="_blank"><span class="glyphicon glyphicon-paperclip"></span>

											                              	 <?php }else{ ?>
											                              		-
											                              <?php } ?>
											                              		</center></td>   </small>                     
											                          </tr>
											                          <?php $i++; } ?>
											                        <?php }else{ ?>
											                            <tr>
											                              <td colspan="9">No existe historial de remuneraciones en la empresa</td>
											                            </tr>
											                        <?php } ?>
																	</tbody> 
																</table> 
															</div>



</div>

                      </div><!-- /.box-body -->
                      <div class="panel-footer">
                      	<a href="<?php echo base_url(); ?>rrhh/calculo_remuneraciones" class="btn btn-success">Volver</a>
                      </div>

                 
                  </div> 
                  </div>		



												
													</div>
													


											</div>
									<!--/charts-inner-->

<script>
/*	$('#selector').change(function(){
			var baseurl = '<?php echo base_url();?>';
			var id_centro_costo = $(this).val();
			$.get("<?php echo base_url();?>rrhh/get_detalle_rrhh/"+id_centro_costo,function(data){			
			 		console.log(data)
			 		$('#remuneraciones').html(data)


			 });




});*/
</script>


<script>
        $('#detalle_remuneracion').dataTable({
            responsive: true,
            //dom: 'Bfrtip',
            //buttons: [{ extend: 'excelHtml5', className: 'btn-sm', text: 'Exportar a Excel'}],
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": true,
            "bSort": false,
            "bAutoWidth": false,
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
        /*setTimeout(redirige, 1500);
        function redirige(){
            location.href = '<?php //echo base_url();?>welcome/dashboard';
        }*/
        <?php } ?>


    });
</script>