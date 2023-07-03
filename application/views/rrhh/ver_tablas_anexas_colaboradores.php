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
                <table class="table" id='tabla_paises'>
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
                <table class="table"  id='tabla_regiones'>
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
                <table class="table"  id='tabla_comunas'>
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

<script>


$(document).ready(function() {

    var table = $('#tabla_paises,#tabla_regiones,#tabla_comunas').DataTable({
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
                "sPrevious": "Anterior"}            } ,
            initComplete: function () {
                  var div=$('#listado_wrapper');
            /*div.find("#listado_filter").prepend("<label for='idEstado'>Estado:</label> <select id='idEstado' name='idEstado' class='form-control' required><option value='' selected='selected'>Todos</option><option value='Activo'>Activo</option><option value='Inactivo'>Inactivo</option></select>");
                this.api().column(4).each(function () {
                  var column = this;
                  console.log(column.data());
                  $('#idEstado').on('change',function(){
                    var val=$(this).val();
                    column.search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                });
            });*/
        }
    });
    });




</script>