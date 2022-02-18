
<div class='row'>
  <div class='col-md-6'>
<form id="formotros" action="<?php echo base_url();?>configuraciones/submit_cargo" method="post" role="form" enctype="multipart/form-data">
                            <div class="panel panel-inverse">                       
                                <div class="panel-heading">
                                      <h4 class="panel-title">Cargos</h4>
                                  </div>
                      <div class="panel-body">
                        <div class='row'>
                          <div class='col-md-12'>
                            <div class="form-group">
                                  <label for="caja">Nombre Cargo</label>    
                                  <input name="nombrecargo" id="nombrecargo"  class="form-control" placeholder="Ingrese Nombre Cargo" value="<?php echo $datos_form['nombre']; ?>">
                            </div>  
                          </div>
                        </div>     
                        <input type="hidden" name="idcargo" value="<?php echo $datos_form['idcargo']; ?>" > 
                        <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>&nbsp;&nbsp;
                        <a href="<?php echo base_url(); ?>configuraciones/cargos" class = "btn btn-info" >Volver</a>
                      </div>
                      </div><!-- /.box-body -->

                 
                  </div> 
                  </div>
    </form>             
</div> 
</div>          

<script>


  $('#formotros').formValidation({
              framework: 'bootstrap',
              excluded: ':disabled',
              icon: {
                  valid: 'glyphicon glyphicon-ok',
                  invalid: 'glyphicon glyphicon-remove',
                  validating: 'glyphicon glyphicon-refresh'
              },
              fields: {
                nombrecargo: {
                    // The field is placed inside .col-xs-6 div instead of .form-group
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Nombre del cargo es requerido'
                        },                      

                    }
                },                 
              }
          }) 
</script>                  