        <!-- Main content -->
      
       
        <form id="basicBootstrapForm" action="<?php echo base_url();?>rrhh/carga_masiva_personal" id="basicBootstrapForm" method="post"   enctype="multipart/form-data">
         <div class="row">

            <div class="col-md-6">

              <div class="panel panel-inverse">
                <div class="panel-heading">
                  <h4 class="panel-title">Carga Masiva de Colaboradores</h4>
                  <div class="pull-right box-tools">

                    
                  </div><!-- /. tools -->                                        
                </div><!-- /.box-header -->
                <!-- form start -->


                  <div class="panel-body">
 
                        <div class='row'    >
                          <div class='col-md-6'>
                            <div class="form-group">
                                 <label for="exampleInputFile">Archivo de Carga</label>
                                  <input type="file" id="userfile" name="userfile"><small>(*) Archivo formato .csv Separador: Punto y coma  ";"</small>
                            </div> 
                          </div>  
                        </div>   
                        <div class='row'>
                          <div class='col-md-4'>

                                <div class="form-group">
                                    <div class="radio block">
                                                  <label>
                                                    <input class="form-check-input" type="radio" name="tipocarga" id="tc_light" value="light" checked> Carga Light
                                                  </label>

                                    </div>
                              </div>
                          </div>
                          <div class='col-md-4'>

                                <div class="form-group">
                                    <div class="radio block">
                                                
                                                  <label>
                                                    <input class="form-check-input" type="radio" name="tipocarga" name="tc_full" id="tc_full" value="full" disabled> Carga Full
                                                  </label>
                                    </div>
                              </div>
                          </div>
                         
                         </div>  

                          
                  </div><!-- /.box-body -->
                  <div class="panel-footer">
                    <button type="submit" class="btn btn-success" name="cargar">Cargar</button>
                    <input type="hidden" name="tipo" value="validacion">
                    &nbsp;&nbsp;
                    <a href="<?php echo base_url();?>rrhh/mantencion_personal" class="btn btn-default">Volver</a>
                  </div>                  
              </div><!-- /.box -->

            </div>



            <div class="col-md-6">




                  <div class="panel-body">
                        <div class='row'    >
                          <div class='col-md-2'>
                            &nbsp;
                          </div>  
                        </div>

                        <div class='row'    >
                          <div class='col-md-2'>
                            
                                <a href="<?php echo base_url();?>rrhh/ver_formato_carga_colaboradores" class="btn btn-primary">Ver Formato Carga&nbsp;<i class="fa fa-wrench"></i></a>


                          </div>  
                        </div> 
                        <div class='row'    >
                          <div class='col-md-2'>
                            &nbsp;
                          </div>  
                        </div>
                        <div class='row'    >
                          <div class='col-md-2'>
                            
                                <a href="<?php echo base_url();?>rrhh/ver_tablas_anexas_colaboradores" data-toggle="tooltip" title="Ejemplo" class="btn btn-info">Ver Tablas Anexas&nbsp;<i class="fa fa-check"></i></a>


                          </div>  
                        </div>
                        <div class='row'    >
                          <div class='col-md-2'>
                            &nbsp;
                          </div>  
                        </div>
                        <div class='row'    >
                          <div class='col-md-2'>
                            
                                <a href="<?php echo base_url(); ?>uploads/ejemploCarga.csv" data-toggle="tooltip" title="Ejemplo" class="btn btn-success">Descargar Ejemplo&nbsp;<i class="fa fa-file-excel-o"></i></a>


                          </div>  
                        </div>  
                        

                          
                  </div><!-- /.box-body -->
                  



            </div>

        
          </div>


  




      </form>







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



    $('#basicBootstrapForm').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            userfile: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Archivo de Carga'
                    }              
                }
            }, 
        }
    })
});
</script>
