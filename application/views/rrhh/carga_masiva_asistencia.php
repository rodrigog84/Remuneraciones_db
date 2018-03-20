        <!-- Main content -->
      
       
        <form id="basicBootstrapForm" action="<?php echo base_url();?>Carga_masiva/asistencia" id="basicBootstrapForm" method="post"   enctype="multipart/form-data">
         <div class="row">

            <div class="col-md-6">

              <div class="panel panel-inverse">
                <div class="panel-heading">
                  <h4 class="panel-title">Carga Masiva de Asistencia</h4>
                  <div class="pull-right box-tools">

                    <h4><a href="<?php echo base_url(); ?>carga_masiva/exportarExcelasistencia" data-toggle="tooltip" title="DEscarga Ejemplo" ><i class="fa fa-file-excel-o"></i></a></h4>
                  </div><!-- /. tools -->                                        
                </div><!-- /.box-header -->
                <!-- form start -->


                  <div class="panel-body">
                        <div class="form-group">
                              <label for="exampleInputFile">Archivo de Carga  - <a href="<?php echo base_url(); ?>rrhh/exportarExcelasistencia" data-toggle="tooltip" title="Ejemplo" target="_blank">Descargar Ejemplo</a></label>
                              <input type="file" id="userfile" name="userfile">
                        </div>  
                  </div><!-- /.box-body -->
                  <div class="panel-footer">
                    <button type="submit" class="btn btn-success" name="cargar">Cargar</button>

                    &nbsp;&nbsp;
                    <a href="<?php echo base_url();?>rrhh/asistencia" class="btn btn-default">Volver</a>
                  </div>                  
              </div><!-- /.box -->

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
