<form id="formotros" action="<?php echo base_url();?>rrhh/submit_mut_caja" method="post" role="form" enctype="multipart/form-data">
                            <div class="panel panel-inverse">                       
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
                  </div>
    </form>                   

<script>

    $(document).ready(function() {
        <?php if(isset($message)){ ?>

        $.gritter.add({
            title: 'Atención',
            text: '<?php echo $message;?>',
            sticky: false,
            image: '<?php echo base_url();?>images/logos/alert-icon.png',
            time: 5000,
            class_name: 'my-sticky-class'
        });
        /*setTimeout(redirige, 1500);
        function redirige(){
            location.href = '<?php //echo base_url();?>welcome/dashboard';
        }*/
        <?php } ?>



        $('div#sel_all').on('click',function(){

            console.log("asdasdasdasd");

        })

       

        $('.busca_col').on('change',function(){
          var hab_descto = $('#hab_descto').val();
          var centro_costo = $('#centro_costo').val();

          if(hab_descto != '' && centro_costo != ''){

                var table = "";
                var fila = 1;
                $.ajax({
                    type: "GET",
                    url: '<?php echo base_url();?>rrhh/get_colaboradores/' + centro_costo,
                }).success(function(response) {
                    
                     table += '<table  class="table table-bordered table-striped dt-responsive">\
                          <thead>\
                            <tr>\
                              <th >#</th>\
                              <th ><input type="checkbox" id="sel_all" name="sel_all" ></th>\
                              <th >Rut</th>\
                              <th >Nombre</th>\
                            </tr>\
                          </thead>\
                          <tbody>';

                        var_json = $.parseJSON(response);

                        if(var_json.length > 0){
                              for(i=0;i<var_json.length;i++){
                                    table += '<tr>\
                                       <td><small>' + fila + '</small></td>\
                                       <td><small><input type="checkbox" id="sel_col-' + var_json[i].rut + '" name="sel_col-' + var_json[i].rut + '" class="sel_col"></small></td>\
                                       <td><small>' + var_json[i].rut + '-' + var_json[i].dv + '</small></td>\
                                       <td><small>' + var_json[i].nombre + '</small></td>\
                                      </tr>';
                                      fila++;
                              }


                        }else{
                            table += '<tr ><td colspan="4">No existen colaboradores en el centro de costo seleccionado</td></tr>';

                        }



                          
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



</script>                  