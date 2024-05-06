<form id="basicBootstrapForm" action="<?php echo base_url();?>rrhh/submit_hab_descto_variable" method="post" role="form" enctype="multipart/form-data">

                            <div class="panel panel-inverse">                       
                                <div class="panel-heading">
                                      <h4 class="panel-title">Per&iacute;odo</h4>
                                  </div>
                      <div class="panel-body">
                        <div class='row'>
                          <div class='col-md-4'>
                            <div class="form-group">
                                  <label for="caja">Meses</label>    
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
                          <div class='col-md-4'>
                            <div class="form-group">
                                                  <label for="anno">A&ntilde;o</label>
                                                  <select name="anno" id="anno" class="form-control periodo">
                                                    <?php for($i=(date('Y')-3);$i<=(date('Y')+2);$i++){ ?>
                                                    <?php $yearselected = $i == $anno ? "selected" : ""; ?>
                                                    <option value="<?php echo $i;?>" <?php echo $yearselected; ?>><?php echo $i;?></option>
                                                    <?php } ?>
                                                  </select>
                            </div>
                          </div>
                        </div>      
                      </div><!-- /.box-body -->

                 
                  </div> 



              <div class="panel panel-inverse">                       
                                <div class="panel-heading">
                                      <h4 class="panel-title">Tipo Carga</h4>
                                  </div>
                      <div class="panel-body">
                        <div class='row'>
                          <div class='col-md-4'>
                            <div class="form-group">
                                  <label for="caja">Tipo de Carga</label>    
                                  <select name="tipocarga" id="tipocarga" class="form-control">
                                      <option value="manual" selected >Manual</option>
                                      <option value="masiva" >Masiva</option>
                                    </select>
                            </div>  
                          </div>
                        </div>      
                      </div><!-- /.box-body -->

                 
                  </div> 

                            <div class="panel panel-inverse" id='carga_manual'>                       
                                <div class="panel-heading">
                                      <h4 class="panel-title">Datos Haber o Descuento</h4>
                                  </div>
                      <div class="panel-body">
                        <div class='row'>
                          <div class='col-md-4'>
                            <div class="form-group">
                                  <label for="caja">Tipo Hab/Des</label>    
                                  <select name="tipo" id="tipo"  class="form-control"  >
                                      <option value="">Seleccione Tipo</option>
                                      <option value="HABER">Haber</option>
                                      <option value="DESCUENTO">Descuento</option>                         
                                  </select>
                            </div>  
                          </div>
                          <div class='col-md-4'>
                            <div class="form-group">
                                  <label for="caja">Haber / Descuento</label>    
                                  <select name="hab_descto" id="hab_descto"  class="form-control busca_col"  >
                                      <option value="">Seleccione Haber / Descuento</option>
                                  </select>
                            </div>  
                          </div>    
                          <div class='col-md-4'>
                            <div class="form-group">
                                  <label for="caja">Centro de Costo</label>    
                                  <select name="centro_costo" id="centro_costo"  class="form-control busca_col"  >
                                      <option value="">Seleccione Centro de Costo</option>
                                      <?php foreach ($centros_costo as $centro_costo) { ?>
                                        <option value="<?php echo $centro_costo->id_centro_costo;?>"><?php echo "( " . $centro_costo->codigo. " ) " .$centro_costo->nombre;?></option>
                                      <?php } ?>
                                  </select>
                            </div>  
                          </div>                      
                        </div>
                        <div class="row" id="tabla_colaboradores"></div>

                            
                                                        <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>&nbsp;&nbsp;
                      </div>
                      </div><!-- /.box-body -->

                 
                  </div>


                  <div class="panel panel-inverse" id='carga_masiva'>                       
                                <div class="panel-heading">
                                      <h4 class="panel-title">Carga Masiva Haberes y Descuento</h4>
                                  </div>
                      <div class="panel-body">
                        <div class='row'    >
                          <div class='col-md-6'>
                            <div class="form-group">
                                 <label for="exampleInputFile">Archivo de Carga</label>
                                  <input type="file" id="userfile" name="userfile"><small>(*) Archivo formato .csv Separador: Punto y coma  ";"</small>
                            </div> 
                          </div> 
                           <div class='col-md-2'>
                            
                                <a href="<?php echo base_url(); ?>uploads/ejemploCargaHabDesctos.csv" data-toggle="tooltip" title="Ejemplo" class="btn btn-success">Descargar Ejemplo&nbsp;<i class="fa fa-file-excel-o"></i></a>


                          </div>   
                        </div> 


                            
                                                        <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>&nbsp;&nbsp;
                      </div>
                      </div><!-- /.box-body -->

                 
                  </div>


                  </div>
    </form>                   

<script>

    $(document).ready(function() {


      $('#carga_manual').show()
      $('#carga_masiva').hide()


      $('#tipocarga').on('change',function(){

            var tipocarga = $(this).val();
            if(tipocarga == 'manual'){
                $('#carga_manual').show()
                $('#carga_masiva').hide()
            }else if(tipocarga == 'masiva'){
                $('#carga_manual').hide()
                $('#carga_masiva').show()

            }else{
                $('#carga_manual').hide()
                $('#carga_masiva').hide()

            }


      })

      $('.periodo').change(function(){
          $('#basicBootstrapForm').formValidation('revalidateField', 'anno');
            var cerrado = false;
            $.ajax({url: "<?php echo base_url();?>rrhh/get_status_rem/asistencia/"+$('#mes').val()+"/"+$('#anno').val(),
              type: 'GET',
              async: false,
              success : function(data) {
                  var_json = $.parseJSON(data);
                  $('#span_status').html(var_json["label_text"]);
                  $('#span_status').attr('class',"label "+var_json["label_style"]);     
                  cerrado = var_json["status"] == 'cerrado' ? true : false;
              }});

            if(cerrado){
              $('#tipo').val('');
              $('#tabla_colaboradores').html('');
            }else{
              $('input').attr('readonly',false);
            }


           /* $.get("<?php echo base_url();?>rrhh/get_datos_remuneracion/"+$('#mes').val()+"/"+$('#anno').val(),function(data){
                     // Limpiamos el select
                          var_json = $.parseJSON(data);
                          $(".diastrabajo").each(
                              function(index,value){
                                  var id_text = $(this).attr('id');
                                  var array_field = id_text.split("_");
                                  idtrabajador = array_field[1];  

                                  var diastrabajo =  typeof(var_json["diastrabajo_"+idtrabajador]) != 'undefined' && var_json["diastrabajo_"+idtrabajador] != null ? var_json["diastrabajo_"+idtrabajador] : parseInt($('#diasatrabajar_'+idtrabajador).html());
                                  $(this).val(diastrabajo);
                              }
                              
                          );                    
            });*/
            
      });

      var cerrado = false;
      $.ajax({url: "<?php echo base_url();?>rrhh/get_status_rem/hab_descto/"+$('#mes').val()+"/"+$('#anno').val(),
        type: 'GET',
        async: false,
        success : function(data) {
            var_json = $.parseJSON(data);
            $('#span_status').html(var_json["label_text"]);
            $('#span_status').attr('class',"label "+var_json["label_style"]);     
            cerrado = var_json["status"] == 'cerrado' ? true : false;
        }});

      if(cerrado){
        $('#tabla_colaboradores').val('');
        $('#tabla_colaboradores').html('');
      }else{
        //$('input').attr('readonly',false);
      }      



  function replaceAll( text, busca, reemplaza ){
    
    while (text.toString().indexOf(busca) != -1)
        text = text.toString().replace(busca,reemplaza);
    return text;
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
            anno: {
                row: '.form-group',
                validators: {

                    remote: {
                        url: '<?php echo base_url();?>rrhh/estado_periodo/',
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
    .formValidation('revalidateField', 'anno');

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




        $('div#sel_all').on('click',function(){

        })

       

        $('.busca_col').on('change',function(){
          var hab_descto = $('#hab_descto').val();
          var centro_costo = $('#centro_costo').val();
          var mes = $('#mes').val();
          var anno = $('#anno').val();


          if(hab_descto != '' && centro_costo != ''){

                var table = "";
                var fila = 1;
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url();?>rrhh/get_colaboradores_hab_descto/',
                    dataType: 'json',
                    data : {
                            "centro_costo": centro_costo,
                            "hab_descto": hab_descto,
                            "mes": mes,
                            "anno": anno,
                          },                    
                }).success(function(response) {
                    

                      console.log(response)
                     table += '<table  class="table table-bordered table-striped dt-responsive">\
                          <thead>\
                            <tr>\
                              <th >#</th>\
                              <th ><input type="checkbox" id="sel_all" name="sel_all" ></th>\
                              <th >Rut</th>\
                              <th >Nombre</th>\
                              <th >Monto</th>\
                            </tr>\
                          </thead>\
                          <tbody>';

                          //fila = 1;
                          $.each(response,function(index,value){
                              
                                    var checked = value.hab_descto_check == 1 ? 'checked' : '';


                                    table += '<tr>\
                                       <td><small>' + fila + '</small></td>\
                                       <td><small><input type="checkbox" id="sel_col-' + value.id_personal + '" name="sel_col-' + value.id_personal + '" class="sel_col" ' + checked + '></small></td>\
                                       <td><small>' + value.rut + '-' + value.dv + '</small></td>\
                                       <td><small>' + value.nombre + ' ' + value.apaterno + ' ' + value.amaterno + '</small></td>\
                                       <td><small><input type="text" class="miles monto_habdescto" data-idpersonal="' + value.id_personal + '" name="monto_col-' + value.id_personal + '" id="monto_col-' + value.id_personal + '" value="' + value.hab_descto_monto + '"></small></td>\
                                      </tr>';
                                      fila++;


                          });

                          if(fila == 1){

                               table += '<tr ><td colspan="4">No existen colaboradores en el centro de costo seleccionado</td></tr>';


                          }
                       /* var fila = 1;
                        var_json = $.parseJSON(response);
                        console.log(var_json)
                        if(var_json.length > 0){
                              for(i=0;i<var_json.length;i++){
                                    table += '<tr>\
                                       <td><small>' + fila + '</small></td>\
                                       <td><small><input type="checkbox" id="sel_col-' + var_json[i].id_personal + '" name="sel_col-' + var_json[i].id_personal + '" class="sel_col"></small></td>\
                                       <td><small>' + var_json[i].rut + '-' + var_json[i].dv + '</small></td>\
                                       <td><small>' + var_json[i].nombre + ' ' + var_json[i].apaterno + ' ' + var_json[i].amaterno + '</small></td>\
                                       <td><small><input type="text" class="miles" name="monto_col-' + var_json[i].id_personal + '" id="monto_col-' + var_json[i].id_personal + '" value="0"></small></td>\
                                      </tr>';
                                      fila++;
                              }


                        }else{
                            table += '<tr ><td colspan="4">No existen colaboradores en el centro de costo seleccionado</td></tr>';

                        }*/



                          
                          table +='</tbody>\
                                  </table>';


                          $('#tabla_colaboradores').html(table);


                          $('#sel_all').on('click',function(){

                                  if($(this).is(':checked')){
                                      $('.sel_col').attr('checked','checked');
                                  }else{
                                      $('.sel_col').attr('checked',false);
                                  }
                          })


                          $('.monto_habdescto').on('input',function(){

                            var idpersonal = $(this).data('idpersonal');
                            var valor = $(this).val();
                            valor = replaceAll(valor,'.','')
                            
                            if(valor > 0){
                                $('#sel_col-'+idpersonal).attr('checked','checked')

                            }else{
                                $('#sel_col-'+idpersonal).attr('checked',false)

                            }

                          })                          
                       // Limpiamos el select
                        /*$('#hab_descto option').remove();
                        
                        
                        $('#hab_descto').append('<option value="">Seleccione Haber / Descuento</option>');
                        var_json = $.parseJSON(response);
                        for(i=0;i<var_json.length;i++){
                          $('#hab_descto').append('<option value="' + var_json[i].id + '">' + '( ' + var_json[i].codigo + ' ) ' +var_json[i].nombre + '</option>');
                        }*/


                });  

          }else{

              $('#tabla_colaboradores').html('');

          }


        })




        $('#tipo').on('change',function(){


              var tipo = $(this).val();

              if(tipo != ''){

                $.ajax({
                    type: "GET",
                    url: '<?php echo base_url();?>rrhh/get_hab_descto/'+tipo,
                }).success(function(response) {

                       // Limpiamos el select
                        $('#hab_descto option').remove();
                        
                        
                        $('#hab_descto').append('<option value="">Seleccione Haber / Descuento</option>');
                        var_json = $.parseJSON(response);
                        for(i=0;i<var_json.length;i++){
                          $('#hab_descto').append('<option value="' + var_json[i].id + '">' + '( ' + var_json[i].codigo + ' ) ' +var_json[i].nombre + '</option>');
                        }


                });   

              }else{
                $('#hab_descto option').remove();
                $('#hab_descto').append('<option value="">Seleccione Haber / Descuento</option>');

              }
                   
        })

    });


$(document).ready(function(){
 $('.miles').mask('000.000.000.000.000', {reverse: true})        

});


</script>                  