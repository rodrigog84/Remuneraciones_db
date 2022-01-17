        <!-- Main content -->
      <div class="row">
         <div class="col-md-2">
         <a href="<?php echo base_url();?>rrhh/carga_masiva_personal" class="btn btn-default">Volver</a>       
         </div>
      </div><br>
         <div class="row">

            <div class="col-md-12">


<ul class="nav nav-pills">
            <li class="active"><a href="#nav-pills-tab-1" data-toggle="tab">Ver Tabla Anexa N° 1</a></li>
            <li><a href="#nav-pills-tab-2" data-toggle="tab">Ver Tabla Anexa N° 2</a></li>
            <li><a href="#nav-pills-tab-3" data-toggle="tab">Ver Tabla Anexa N° 3</a></li>

          </ul>
          <div class="tab-content">
            <div class="tab-pane fade active in" id="nav-pills-tab-1">
               


            <div class="panel panel-inverse">
                <div class="panel-heading">
                  <h4 class="panel-title">Tabla Pa&iacute;ses</h4>                    
                </div><!-- /.box-header -->
                <!-- form start -->


                  <div class="panel-body">
 
                        <div class='row'    >
                          <div class='col-md-12'>
                                    <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>C&oacute;digo Pa&iacute;s</th>
                      <th>Nombre Pa&iacute;s</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php foreach ($nacionalidad as $pais) { ?> 
                        <tr class="<?php echo $pais->nombre == 'Chile' ? 'info' : '';?>">
                          <td><?php echo $pais->id_paises; ?></td>
                          <td><?php echo $pais->nombre; ?></td>
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
                  <h4 class="panel-title">Tabla Regiones</h4>                    
                </div><!-- /.box-header -->
                <!-- form start -->


                  <div class="panel-body">
 
                        <div class='row'    >
                          <div class='col-md-12'>
                                    <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>C&oacute;digo Regi&oacute;n</th>
                      <th>Nombre Regi&oacute;n</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php foreach ($regiones as $region) { ?> 
                        <tr >
                          <td><?php echo $region->id_region; ?></td>
                          <td><?php echo $region->nombre; ?></td>
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
            <div class="tab-pane fade" id="nav-pills-tab-3">


              <div class="panel panel-inverse">
                <div class="panel-heading">
                  <h4 class="panel-title">Tabla Comunas</h4>                    
                </div><!-- /.box-header -->
                <!-- form start -->


                  <div class="panel-body">
 
                        <div class='row'    >
                          <div class='col-md-12'>
                                    <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>C&oacute;digo Comuna</th>
                      <th>Nombre Comuna</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php foreach ($comunas as $comuna) { ?> 
                        <tr >
                          <td><?php echo $comuna->idcomuna; ?></td>
                          <td><?php echo $comuna->nombre; ?></td>
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


        
          </div>

