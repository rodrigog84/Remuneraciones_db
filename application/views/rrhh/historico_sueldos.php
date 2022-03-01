 

                            <div class="panel panel-inverse">                       
                                <div class="panel-heading">
                                      <h4 class="panel-title">Remuneraciones Hist&oacute;ricas de <?php echo primera_mayuscula($personal->nombre)." ".primera_mayuscula($personal->apaterno)." ".primera_mayuscula($personal->amaterno); ?> </h4>
                                  </div>
                      <div class="panel-body">
                        <div class='row'>

								  <!--//sub-heard-part-->

									<div class="graph-visual tables-main">
																						
														  <div class="graph">

														  	
															<div class="tables">
																<table class="table" id="detalle_remuneracion"> 
																	<thead> 
																		<tr>
												                        <th>#</th>
												                        <th>Mes</th>
												                        <th>A&ntilde;o</th>
												                        <th>Sueldo Base</th>
												                        <th>Haberes</th>
												                        <th>Descuentos</th>
												                        <th>Liquido a Pagar</th>
												                        <th>Aportes Empresa</th>
												                        <th>Liquidaci&oacute;n</th>
												                        
																		</tr> 
																	</thead> 
																	<tbody> 
													                        <?php $i = 1; ?>
												                        <?php foreach ($remuneraciones as $remuneracion) { ?>
												                         <tr >
												                          <td><?php echo $i;?></td>
												                          <td><?php echo month2string($remuneracion->mes);?></td>
												                          <td><?php echo $remuneracion->anno;?></td>
												                          <td>$&nbsp;<?php echo number_format($remuneracion->sueldobase,0,".",".");?></td>
												                          <td>$&nbsp;<?php echo number_format($remuneracion->totalhaberes,0,".",".");?></td>
												                          <td>$&nbsp;<?php echo number_format($remuneracion->totaldescuentos,0,".",".");?></td>
												                          <td>$&nbsp;<?php echo number_format($remuneracion->sueldoliquido,0,".",".");?></td>
												                          <td>$&nbsp;<?php echo number_format($remuneracion->aportesegcesantia + $remuneracion->seginvalidez + $remuneracion->aportepatronal,0,".",".");?></td>
												                          <td><center><a href="<?php echo base_url(); ?>rrhh/liquidacion/<?php echo $remuneracion->id_remuneracion;?>" target="_blank"><span class="glyphicon glyphicon-paperclip"></span></a></center></td>
												                          
												                        </tr>
												                        <?php $i++; } ?>
																	</tbody> 
																</table> 
																
															</div>
												
													</div>
													
											</div>


</div>

                      </div><!-- /.box-body -->
                      <div class="panel-footer">
                      	<a href="<?php echo base_url().'rrhh/mantencion_personal'; ?>" class="btn btn-success">Volver</a>
                      </div>

                 
                  </div> 
                  </div>											
									<!--/charts-inner-->


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
            "aLengthMenu" : [[5,15,30,50,100,-1],[5,15,30,50,100,'Todos']],
          	"iDisplayLength": 50,            
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