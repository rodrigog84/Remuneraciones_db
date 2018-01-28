<?php 

?>




<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   <ol class="breadcrumb m-b-0">
											<li><a href="<?php echo base_url();?>main/dashboard">Inicio</a></li>
											<li class="active">Calculo Remuneraciones</li>
											
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

											
														  <div class="graph">

														  	
															<div class="tables">
																<p>Seleccione Centro de Costo:</p>
																<select name="selector" id="selector" class="form-control2">
																	<option value="0">Todos</option>
																	<?php foreach ($centros_costo as $centro_costo) { ?>
																		<option value="<?php echo $centro_costo->id_centro_costo;?>"><?php echo $centro_costo->nombre;?></option>
																	<?php } ?>
																	
																</select>
																<br>
																<br>
																<br>
																<br>
																<div id="remuneraciones">
																<table class="table"> 
																	<thead> 
																		<tr>
																			<th>#</th>
																			<th>Mes</th> 
																			<th>A&ntilde;o</th> 
													                        <th>N&uacute;mero Trabajadores</th>
													                        <th>Remuneraci&oacute;n Total (L&iacute;quido)</th>
													                        <th>Detalle Remuneraciones</th>
													                        <th>Previred</th>
													                        <th>Libro Remuneraciones</th>
													                        <th>Estado</th>
																		</tr> 
																	</thead> 
																	<tbody> 
																	<?php $i = 1; 
											                        $back_button = false;
											                        ?>
											                        <?php if(count($datosperiodo) > 0){ ?>
											                          <?php foreach ($datosperiodo as $periodo) { ?>
											                            <?php if($idperiodo == $periodo->id_periodo){ 
											                                $class_color = "class = 'success'";
											                                $back_button = true;
											                            }else{
											                                $class_color = "";

											                              }?>                          
											                           <tr <?php echo $class_color; ?> >
											                            <td><?php echo $i;?></td>
											                            <td><?php echo date2string($periodo->mes,$periodo->anno) == 'Saldo Inicial' ? 'Saldo' : month2string($periodo->mes);?></td>
											                            <td><?php echo date2string($periodo->mes,$periodo->anno) == 'Saldo Inicial' ? 'Inicial' : $periodo->anno;?></td>
											                            <td><?php echo number_format($periodo->numtrabajadores,0,".",".");?></td>
											                            <td>$&nbsp;<?php echo number_format($periodo->sueldoliquido,0,".",".");?></td>
											                              <td>
											                              <center>
											                              <?php if(!is_null($periodo->cierre)){ ?>
											                              <a href="<?php echo base_url(); ?>rrhh/ver_remuneraciones_periodo/<?php echo $periodo->id_periodo; ?>" data-toggle="tooltip" title="Ver Remuneraciones Personal"><span class="glyphicon glyphicon-search"></span></a>
											                              <?php } ?>
											                              </center>
											                              </td>
											                              <td>
											                              <center>
											                              <?php if(!is_null($periodo->cierre)){ ?>
											                              <a href="<?php echo base_url(); ?>rrhh/previred/<?php echo $periodo->id_periodo;?>" target="_blank"><span class="glyphicon glyphicon-list-alt"></span></a>  
											                              <?php } ?>
											                              </center>
											                              </td>
											                              <td>
											                              <center>
											                              <?php if(!is_null($periodo->cierre)){ ?>
											                              <a href="<?php echo base_url(); ?>rrhh/libro/<?php echo $periodo->id_periodo;?>" target="_blank"><span class="glyphicon glyphicon-book"></span></a>  
											                              <?php } ?>
											                              </center>
											                              </td>  
											                              <td><span class="<?php echo is_null($periodo->aprueba) ? 'text-yellow fa fa-exclamation ' : 'text-green fa fa-check';?>" data-toggle="tooltip" title="<?php echo is_null($periodo->aprueba) ? 'En revisi&oacute;n' : 'Aprobada';?>"/></span></td>                        
											                          </tr>
											                          <?php $i++; } ?>
											                        <?php }else{ ?>
											                            <tr>
											                              <td colspan="9">No existe historial de remuneraciones en la comunidad</td>
											                            </tr>
											                        <?php } ?>
																	</tbody> 
																</table> 
															</div>
																
															</div>
												
													</div>
													
											</div>
									<!--/charts-inner-->

<script>
	$('#selector').change(function(){
			var baseurl = '<?php echo base_url();?>';
			var id_centro_costo = $(this).val();
			$.get("<?php echo base_url();?>rrhh/get_detalle_rrhh/"+id_centro_costo,function(data){			
			 		console.log(data)
			 		$('#remuneraciones').html(data)


			 });


			/*var id = $('#selector').val();
			   $.post(baseurl+"cpersona/getPersona",
	        function(data){
	          //alert(data);
	          var p = JSON.parse(data);
	          $.each(p, function(i,item){
	          	$('#personas').append(
	          			'<tr>'+
							'<td>'+item.nombre+'</td>'+
							'<td>'+item.appaterno+'</td>'+
							'<td>'+item.apmaterno+'</td>'+
							'<td>'+item.rut+'</td>'+
							'<td>'+item.email+'</td>'+
							'<td>'+item.ciudad+'</td>'+
							'<td>'+item.ciudad+'</td>'+
						'</tr>'
	          		);
	          });

	        });*/

/*});*/

});
</script>