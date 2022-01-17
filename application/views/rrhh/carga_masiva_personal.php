        <!-- Main content -->
      
       
        <form id="basicBootstrapForm" action="<?php echo base_url();?>Carga_masiva/insertar" id="basicBootstrapForm" method="post"   enctype="multipart/form-data">
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
                                  <input type="file" id="userfile" name="userfile">
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
                            
                                <a href="<?php echo base_url(); ?>uploads/ejemploCarga.xls" data-toggle="tooltip" title="Ejemplo" class="btn btn-info">Ver Tablas Anexas&nbsp;<i class="fa fa-check"></i></a>


                          </div>  
                        </div>
                        <div class='row'    >
                          <div class='col-md-2'>
                            &nbsp;
                          </div>  
                        </div>
                        <div class='row'    >
                          <div class='col-md-2'>
                            
                                <a href="<?php echo base_url(); ?>uploads/ejemploCarga.xls" data-toggle="tooltip" title="Ejemplo" class="btn btn-success">Descargar Ejemplo&nbsp;<i class="fa fa-file-excel-o"></i></a>


                          </div>  
                        </div>  
                        

                          
                  </div><!-- /.box-body -->
                  



            </div>

        
          </div>


        
          </div>






      </form>



          
 <script>
$(document).ready(function() {
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
