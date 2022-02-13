          <form id="basicBootstrapForm" action="<?php echo base_url();?>rrhh/submit_anticipos" id="basicBootstrapForm" method="post"> 
            <div class="row">

                                  <div class="col-md-6">
                                   <div class="panel panel-inverse">
                                      <div class="panel-heading">
                                        <h3 class="panel-title">Per&iacute;odo&nbsp;&nbsp;<span class="label " id="span_status"></span></h3>
                                      </div><!-- /.box-header -->

                                      <div class="panel-body" >
                                        <div class='row'>
                                            <div class='col-md-6'>
                                              <div class="form-group">
                                                  <label for="mes">Meses</label>
                                                  <select name="mes" id="mes" class="form-control periodo">
                                                    <option value="1" <?php echo $mes == 1 ? "selected" : ""; ?>>Enero</option>
                                                    <option value="2" <?php echo $mes == 2 ? "selected" : ""; ?>>Febrero</option>
                                                    <option value="3" <?php echo $mes == 3 ? "selected" : ""; ?>>Marzo</option>
                                                    <option value="4" <?php echo $mes == 4 ? "selected" : ""; ?>>Abril</option>
                                                    <option value="5" <?php echo $mes == 5 ? "selected" : ""; ?>>Mayo</option>
                                                    <option value="6" <?php echo $mes == 6 ? "selected" : ""; ?>>Junio</option>
                                                    <option value="7" <?php echo $mes == 7 ? "selected" : ""; ?>>Julio</option>
                                                    <option value="8" <?php echo $mes == 8 ? "selected" : ""; ?>>Agosto</option>
                                                    <option value="9" <?php echo $mes == 9 ? "selected" : ""; ?>>Septiembre</option>
                                                    <option value="10" <?php echo $mes == 10 ? "selected" : ""; ?>>Octubre</option>
                                                    <option value="11" <?php echo $mes == 11 ? "selected" : ""; ?>>Noviembre</option>
                                                    <option value="12" <?php echo $mes == 12 ? "selected" : ""; ?>>Diciembre</option>
                                                  </select>
                                              </div> 
                                            </div>
                                            <div class='col-md-6'>
                                              <div class="form-group">
                                                  <label for="anno">A&ntilde;o</label>
                                                  <select name="anno" id="anno" class="form-control periodo">
                                                    <?php for($i=(date('Y')-2);$i<=(date('Y')+2);$i++){ ?>
                                                    <?php $yearselected = $i == $anno ? "selected" : ""; ?>
                                                    <option value="<?php echo $i;?>" <?php echo $yearselected; ?>><?php echo $i;?></option>
                                                    <?php } ?>
                                                  </select>
                                              </div>
                                            </div>  
                                        </div>                    
                                      </div><!-- /.box-body -->
                                    </div>
                                    <!--a href="<?php echo base_url();?>rrhh/carga_masiva_anticipos" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-upload"></span>&nbsp;&nbsp;Carga Masiva</a--> 

                                  </div>


                              </div>   


            <div class="row">

                <div class="col-md-12">

                  <div class="panel panel-inverse">                       
                        <div class="panel-heading">
                              <h4 class="panel-title">Ingreso de Anticipos</h4>
                          </div>

                    <div class="box-body" >
                          <table  class="table table-bordered table-striped dt-responsive">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Rut</th>
                              <th>Nombre Trabajador</th>
                              <th>Sueldo Base</th>
                              <th>Anticipo</th>
                              <th>Aguinaldo</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if(count($personal) > 0 ){ ?>
                              <?php $i = 1; ?>
                              <?php $total_anticipo = 0; ?>
                              <?php $total_aguinaldo = 0; ?>
                              <?php foreach ($personal as $trabajador) { ?>

                               <tr >
                                <td><?php echo $i ;?></td>
                                <td><?php echo $trabajador->rut == '' ? '' : number_format($trabajador->rut,0,".",".")."-".$trabajador->dv;?></td>
                                <td><?php echo $trabajador->nombre." ".$trabajador->apaterno." ".$trabajador->amaterno;?></td>
                                <td>
                                  <?php echo number_format($trabajador->sueldobase,0,".",".");?>
                                  <input type="hidden" name="sueldobase_<?php echo $trabajador->id_personal;?>" id="sueldobase_<?php echo $trabajador->id_personal;?>"  value="<?php echo $trabajador->sueldobase; ?>"  />
                                </td>
                                <td class="form-group">
                                    <input type="text" name="anticipo_<?php echo $trabajador->id_personal;?>" id="anticipo_<?php echo $trabajador->id_personal;?>" class="anticipo miles" value="<?php echo isset($datos_remuneracion['anticipo'][$trabajador->id_personal]) ? $datos_remuneracion['anticipo'][$trabajador->id_personal] : 0; ?>"  />   
                                </td>
                                <td class="form-group">
                                    <input type="text" name="aguinaldo_<?php echo $trabajador->id_personal;?>" id="aguinaldo_<?php echo $trabajador->id_personal;?>" class="aguinaldo miles" value="<?php echo isset($datos_remuneracion['aguinaldo'][$trabajador->id_personal]) ? $datos_remuneracion['aguinaldo'][$trabajador->id_personal] : 0; ?>"  />   
                                </td>                                
                              </tr>
                              <?php $i++;?>
                              <?php $total_anticipo += isset($datos_remuneracion['anticipo'][$trabajador->id_personal]) ? $datos_remuneracion['anticipo'][$trabajador->id_personal] : 0; ?>
                              <?php $total_aguinaldo += isset($datos_remuneracion['aguinaldo'][$trabajador->id_personal]) ? $datos_remuneracion['aguinaldo'][$trabajador->id_personal] : 0; ?>
                              <?php } ?>
                            <?php }else{ ?>
                            <tr>
                              <td colspan="6">No existen trabajadores en la comunidad</td>
                            </tr>
                          <?php } ?>
                          </tbody>
                          <?php if(count($personal) > 0 ){ ?>
                          <tfoot>
                            <tr>
                              <th colspan="4">Totales</th>
                              <th><span id="total_anticipo" ><?php echo number_format($total_anticipo,0,".","."); ?></span></th>
                              <th><span id="total_aguinaldo"><?php echo number_format($total_aguinaldo,0,".","."); ?></span></th>
                            </tr>
                          </tfoot>                           
                          <?php } ?>
                          </table>
                    </div><!-- /.box-body -->
                    <?php if(count($personal) > 0 ){ ?>
                      <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      </div>
                    <?php } ?>
                  </div>
                </div>


            </div>

          </form>          

<script>

$('.periodo').change(function(){
    $('#basicBootstrapForm').formValidation('revalidateField', 'anno');
      var cerrado = false;

      $.ajax({url: "<?php echo base_url();?>rrhh/get_status_rem/anticipos/"+$('#mes').val()+"/"+$('#anno').val(),
        type: 'GET',
        async: false,
        success : function(data) {
            var_json = $.parseJSON(data);
            $('#span_status').html(var_json["label_text"]);
            $('#span_status').attr('class',"label "+var_json["label_style"]);     
            cerrado = var_json["status"] == 'cerrado' ? true : false;
        }});


        if(cerrado){
          $('input').attr('readonly',true);
        }else{
          $('input').attr('readonly',false);
        }
 

      $.get("<?php echo base_url();?>rrhh/get_datos_remuneracion/"+$('#mes').val()+"/"+$('#anno').val(),function(data){
               // Limpiamos el select
                    var_json = $.parseJSON(data);
                    total_anticipo = 0;
                    total_aguinaldo = 0;
                    
                    $(".anticipo").each(
                        function(index,value){
                            var id_text = $(this).attr('id');
                            var array_field = id_text.split("_");
                            idtrabajador = array_field[1];  
                            var anticipo =  typeof(var_json["anticipo_"+idtrabajador]) != 'undefined' &&  var_json["anticipo_"+idtrabajador] != null ? var_json["anticipo_"+idtrabajador] : 0;
                            var aguinaldo =  typeof(var_json["aguinaldo_"+idtrabajador]) != 'undefined' &&  var_json["aguinaldo_"+idtrabajador] != null ? var_json["aguinaldo_"+idtrabajador] : 0;
                            $('#anticipo_'+idtrabajador).val(number_format(anticipo,0,'.','.'));
                            $('#aguinaldo_'+idtrabajador).val(number_format(aguinaldo,0,'.','.'));
                            total_anticipo += parseInt(anticipo);
                            total_aguinaldo += parseInt(aguinaldo);
                        }
                        
                    );                    

                    $('#total_anticipo').html(number_format(total_anticipo,0,'.','.')); 
                    $('#total_aguinaldo').html(number_format(total_aguinaldo,0,'.','.')); 
      });
      
});


$(document).ready(function() {

      var cerrado = false;

      $.ajax({url: "<?php echo base_url();?>rrhh/get_status_rem/anticipos/"+$('#mes').val()+"/"+$('#anno').val(),
        type: 'GET',
        async: false,
        success : function(data) {
            var_json = $.parseJSON(data);
            $('#span_status').html(var_json["label_text"]);
            $('#span_status').attr('class',"label "+var_json["label_style"]);     
            cerrado = var_json["status"] == 'cerrado' ? true : false;
        }});

        if(cerrado){
          $('input').attr('readonly',true);
        }else{
          $('input').attr('readonly',false);
        }

    $('#basicBootstrapForm').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {

            aguinaldo: {
                // The children's full name are inputs with class .childFullName
                selector: '.aguinaldo',
                // The field is placed inside .col-xs-6 div instead of .form-group
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Informaci&oacute;n de Aguinaldo es requerida'
                    },
                },

            },          
            anticipo: {
                // The children's full name are inputs with class .childFullName
                selector: '.anticipo',
                // The field is placed inside .col-xs-6 div instead of .form-group
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Informaci&oacute;n de Anticipo es requerida'
                    },
                    callback: {
                        message: 'Anticipo debe ser menor a sueldo base',
                        callback: function (value, validator, $field) {
                            var id_text = $field.attr('id');
                            var array_field = id_text.split("_");
                            idtrabajador = array_field[1];
                            var sueldobase = $('#sueldobase_'+idtrabajador).val() == '' ? 0 : parseInt($('#sueldobase_'+idtrabajador).val());
                            var anticipo = $('#anticipo_'+idtrabajador).val() == '' ? "0" : $('#anticipo_'+idtrabajador).val();                            


                            anticipo = parseInt(replaceAll(anticipo,".",""));
                            if(anticipo < sueldobase){
                              return true;
                            }else{
                              return  {
                                    valid: false,
                                    message: 'Anticipo debe ser menor a sueldo base'
                                }
                            }
                        }
                    }                    

                },

            },
            anno: {
                row: '.form-group',
                validators: {

                    remote: {
                        url: '<?php echo base_url();?>rrhh/estado_periodo/anticipo',
                        // Send { email: 'its value', username: 'its value' } to the back-end
                        data: function(validator, $field, value) {
                            return {
                                mes: $('#mes').val()
                            };
                        },
                        message: 'Per&iacute;odo cerrado o no permitido para la empresa ',
                        type: 'POST'
                    }
                },

            }
        }
    })
    .formValidation('revalidateField', 'anno')
});


$(document).ready(function(){
 $('.miles').mask('000.000.000.000.000', {reverse: true})        

});


$(".anticipo").on('input',function(event){

    // SUMA DE ANTICIPO
    var total_anticipo = 0;
    $(".anticipo").each(
        function(index,value){
          total_anticipo += parseFloat(replaceAll($(this).val(),".",""));
        }
        
    );   
    $('#total_anticipo').html(number_format(total_anticipo,0,'.','.')); 

});   


$(".aguinaldo").on('input',function(event){
    // SUMA DE ANTICIPO
    var total_aguinaldo = 0;
    $(".aguinaldo").each(
        function(index,value){
          total_aguinaldo += parseFloat(replaceAll($(this).val(),".",""));
        }
        
    );   
    $('#total_aguinaldo').html(number_format(total_aguinaldo,0,'.','.')); 

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
