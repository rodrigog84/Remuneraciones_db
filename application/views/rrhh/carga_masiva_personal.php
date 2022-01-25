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

 <?php }else if(count($lista_personal_sin_confirmar) > 0 ){ ?>

      <div class="row">

            <div class="col-md-12">
              <div class="alert alert-warning fade in m-b-15">
                <strong>Atenci&oacute;n!</strong>
                Informaci&oacute;n a&uacute;n no ha sido cargada.  Favor confirmar para realizar carga de colaboradores
                <span class="close" data-dismiss="alert">&times;</span>
              </div>

                <div class="panel panel-inverse">
                      <div class="panel-heading">
                        <h4 class="panel-title">Listado Colaboradores</h4>                    
                      </div><!-- /.box-header -->
                      <!-- form start -->


                        <div class="panel-body">
       
                              <div class='row'    >
                                <div class='col-md-12'>
                                          <div class="table-responsive">
                      <table class="table" id="detallecarga">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Rut</th>
                            <th>Dv</th>
                            <th>Nombres</th>
                            <th>Ap. Paterno</th>
                            <th>Ap. Materno</th>
                            <th>Fec. Nacimiento</th>
                            <th>Sexo</th>
                            <th>Estado Civil</th>
                            <th>Nacionalidad</th>
                            <th>Direcci&oacute;n</th>
                            <th>Regi&oacute;n</th>
                            <th>Comuna</th>
                            <th>Fono</th>
                            <th>Email</th>
                            <th>Fecha Ingreso</th>
                            <th>Fec. Inic. Vacaciones</th>
                            <th>Saldo Inic. Vacaciones</th>
                            <th>Saldo Inic. Vac. Progresivas</th>
                            <th>Tipo Contrato</th>
                            <th>Part Time</th>
                            <th>Seguro Cesant&iacute;a</th>
                            <th>Fecha AFC</th>
                            <th>Pensionado</th>
                            <th>D&iacute;as Trabajo</th>
                            <th>Horas Diarias</th>
                            <th>Horas Semanales</th>
                            <th>Sueldo Base</th>
                            <th>Tipo Gratificaci&oacute;n</th>
                            <th>Monto Gratificaci&oacute;n</th>
                            <th>Cargas Simples</th>
                            <th>Cargas Inv&aacute;lidas</th>
                            <th>Cargas Maternales</th>
                            <th>Tramo Asig. Familiar</th>
                            <th>Movilizaci&oacute;n</th>
                            <th>Colaci&oacute;n</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          <?php
                              $i = 1; 
                              foreach ($lista_personal_sin_confirmar as  $personal) { ?> 
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $personal['Rut']; ?></td>
                                <td><?php echo $personal['Dv']; ?></td>
                                <td><?php echo $personal['Nombres']; ?></td>
                                <td><?php echo $personal['Apellidop']; ?></td>
                                <td><?php echo $personal['Apellidom']; ?></td>
                                <td><?php echo $personal['FecNacimiento']; ?></td>
                                <td><?php echo $personal['Sexo']; ?></td>
                                <td><?php echo $personal['EstadoCivil']; ?></td>
                                <td><?php echo $personal['Nacionalidad']; ?></td>
                                <td><?php echo $personal['Direccion']; ?></td>
                                <td><?php echo $personal['Region']; ?></td>
                                <td><?php echo $personal['Comuna']; ?></td>
                                <td><?php echo $personal['Fono']; ?></td>
                                <td><?php echo $personal['Email']; ?></td>
                                <td><?php echo $personal['FechaIngreso']; ?></td>
                                <td><?php echo $personal['Fecinicvacaciones']; ?></td>
                                <td><?php echo $personal['Saldoinicvacaciones']; ?></td>
                                <td><?php echo $personal['Saldoinicvacprog']; ?></td>
                                <td><?php echo $personal['Tipocontrato']; ?></td>
                                <td><?php echo $personal['Parttime']; ?></td>
                                <td><?php echo $personal['Segcesantia']; ?></td>
                                <td><?php echo $personal['FecAfc']; ?></td>
                                <td><?php echo $personal['Pensionado']; ?></td>
                                <td><?php echo $personal['Diastrabajo']; ?></td>
                                <td><?php echo $personal['Horasdiarias']; ?></td>
                                <td><?php echo $personal['Horassemanales']; ?></td>
                                <td><?php echo $personal['Sueldobase']; ?></td>
                                <td><?php echo $personal['Tipogratificacion']; ?></td>
                                <td><?php echo $personal['Montogratificacion']; ?></td>
                                <td><?php echo $personal['Cargassimples']; ?></td>
                                <td><?php echo $personal['Cargasinvalidas']; ?></td>
                                <td><?php echo $personal['Cargasmaternales']; ?></td>
                                <td><?php echo $personal['Tramoasigfamiliar']; ?></td>
                                <td><?php echo $personal['Movilizacion']; ?></td>
                                <td><?php echo $personal['Colacion']; ?></td>
                              </tr>

                          <?php $i++;
                                  } ?>
                         
                        </tbody>
                      </table>
                    </div>




                                </div>  
                              </div>   
                              

                                
                        </div><!-- /.box-body -->   
                      <div class="panel-footer">
                        <a href="#" data-href="<?php echo base_url(); ?>rrhh/confirma_carga_personal" title="Cargar Colaboradores" class="btn btn-success" data-toggle="modal" data-target="#confirm-publish">Confirmar Carga</a>
                        &nbsp;&nbsp;
                        <a href="<?php echo base_url();?>rrhh/carga_masiva_personal" class="btn btn-default">Volver</a>
                      </div>


                    </div><!-- /.box -->


            </div>

        
      </div>


 <?php } ?>



<!-- MODAL DE RECHAZO DE REMUNERACIÓN POR CENTRO DE COSCO -->
    <div class="modal fade" id="confirm-publish" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirmar Carga</h4>
                </div>
            
                <div class="modal-body">
                    
                   <p>Se cargar&aacute;n los colaboradores tal como se muestran en la tabla.&nbsp;&nbsp;Una vez cargado, no se podr&aacute; podr&aacute; reversar la operaci&oacute;n, y cualquier cambio se deber&aacute; realizar uno a uno.</p>
                    <p>Desea continuar?</p>
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-success btn-ok" id="botoncrear">Cargar Colaboradores</a>
                </div>
            </div>
        </div>
    </div>





          
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



        $('#detallecarga').dataTable({
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


});
</script>
   <script>
        $('#confirm-publish').on('show.bs.modal', function(e) {

            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
        });

        $('#botoncrear').on('click',function(){
            $(this).attr('disabled','disabled');

        })
    </script>
