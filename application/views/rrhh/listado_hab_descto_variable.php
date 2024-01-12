<!--sub-heard-part-->
								  <!--//sub-heard-part-->

  
 <?php if (count($errores_estructura) > 0 || count($errores_contenido) > 0 ){ ?>

         <div class="row">

            <div class="col-md-12">

                  <?php //var_dump_new($errores_estructura); ?>

                <ul class="nav nav-pills">
                  <li class="active"><a href="#nav-pills-tab-1" data-toggle="tab">Errores Estructura ( <?php echo count($errores_estructura);?> ) </a></li>
                  <li><a href="#nav-pills-tab-2" data-toggle="tab">Errores Contenido ( <?php echo count($errores_contenido);?> ) </a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade active in" id="nav-pills-tab-1">
                     


                  <div class="panel panel-inverse">
                      <div class="panel-heading">
                        <h4 class="panel-title">Listado de Errores de Estructura</h4>                    
                      </div><!-- /.box-header -->
                      <!-- form start -->


                        <div class="panel-body">
       
                              <div class='row'    >
                                <div class='col-md-12'>
                                          <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Tipo Error</th>
                            <th>Descripci&oacute;n Error</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          <?php foreach ($errores_estructura as $k => $error_estructura) { ?> 
                              <tr>
                                <td><?php echo $k+1; ?></td>
                                <td><?php echo $error_estructura['tipo']; ?></td>
                                <td><?php echo $error_estructura['descripcion']; ?></td>
                              </tr>

                          <?php } ?>
                         
                        </tbody>
                      </table>
                    </div>




                                </div>  
                              </div>   
                              

                                
                        </div><!-- /.box-body -->                  
                    </div><!-- /.box -->




                  </div>
                  <div class="tab-pane fade" id="nav-pills-tab-2">


                  <div class="panel panel-inverse">
                      <div class="panel-heading">
                        <h4 class="panel-title">Listado de Errores de Contenido</h4>                    
                      </div><!-- /.box-header -->
                      <!-- form start -->


                        <div class="panel-body">
       
                              <div class='row'    >
                                <div class='col-md-12'>
                                          <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Tipo Error</th>
                            <th>Columna Error</th>
                            <th>Valor</th>
                            <th>Descripci&oacute;n Error</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          <?php foreach ($errores_contenido as $k => $error_contenido) { ?> 
                              <tr>
                                <td><?php echo $k+1; ?></td>
                                <td><?php echo $error_contenido['tipo']; ?></td>
                                <td><?php echo $error_contenido['columna']; ?></td>
                                <td><?php echo $error_contenido['valor']; ?></td>
                                <td><?php echo $error_contenido['descripcion']; ?></td>
                              </tr>

                          <?php } ?>
                         
                        </tbody>
                      </table>
                    </div>




                                </div>  
                              </div>   
                              

                                
                        </div><!-- /.box-body -->                  
                    </div><!-- /.box -->





                  </div>
                </div>






            </div>

        
          </div>

 <?php } ?>


		
    						<div class="row">
       <div class='col-md-6'>

               <a href="<?php echo base_url();?>rrhh/hab_descto_variable" type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Haber / Descuento Variable</a>
        </div>
      </div><br>  

            <div class="panel panel-inverse">                       
                      <div class="panel-heading">
                            <h4 class="panel-title">Listado de Haberes y Descuentos</h4>
                        </div>
            <div class="panel-body">
              <div class='row'>


									<div class="graph-visual tables-main">

                          <!--a href="<?php echo base_url();?>rrhh/carga_masiva_haberes_descuentos" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-upload"></span>&nbsp;&nbsp;Carga Masiva</a--> 
													<h3 class="inner-tittle two">Descripción</h3>
														  <div class="graph">

														  	
															<div class="tables">
																<table id="listado" class="table"> 
																	<thead> 
																		<tr>
																			<th>#</th>
                            												<th>Rut</th>
                            												<th>Colaborador</th>
                                                    <th>Tipo Haber/Descuento</th>
                            												<th>Cod. Haber/Descuento</th>
                            												<th>Nombre Haber/Descuento</th>
                                                    <th>Monto</th>
                                                    <th>Periodo</th>
                                                    <th>&nbsp;</th>
																		</tr> 
																	</thead> 
																	<tbody> 
	                            										<?php $i = 1; ?>
                                                  <?php foreach ($haberes_descuentos as $haber_descuento) { ?>  
																		<tr class="active" id="variable">
											                              <td><small><?php echo $i ;?></small></td>
	                              										  <td><small><?php echo $haber_descuento->rut."-".$haber_descuento->dv;?></small>
	                              										  <td><small><?php echo $haber_descuento->apaterno." ".$haber_descuento->amaterno." ".$haber_descuento->nombre_colaborador;?></small></td>
                                                      <td><small><?php echo $haber_descuento->tipo;?></small></td>
	                              										  <td><small><?php echo $haber_descuento->codigo;?></small></td>
                                                      <td><small><?php echo $haber_descuento->nombre;?></small></td>
                                                      <td><small><?php echo number_format($haber_descuento->monto,0,".",".");?></small></td>
                                                      <td><small><?php echo $haber_descuento->periodo;?></small></td>
	                              										  <td><small><a href="<?php echo base_url(); ?>rrhh/delete_haber_descto/<?php echo $haber_descuento->id;?>" data-toggle="tooltip" title="Eliminar Haber/Descuento Variable"><i class="fa fa-lg fa-trash"></i></a></small></td>
																		</tr> 

											                            <?php $i++;?>
												                       <?php } ?>

																		
																	</tbody> 
																</table> 
															</div>
												
													</div>

											</div>
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
        /*setTimeout(redirige, 1500);
        function redirige(){
            location.href = '<?php //echo base_url();?>welcome/dashboard';
        }*/
        <?php } ?>


    });
</script>   

