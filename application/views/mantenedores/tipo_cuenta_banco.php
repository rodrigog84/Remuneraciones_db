<!--sub-heard-part-->
								  <!--//sub-heard-part-->
								
                 <div class="graph-visual tables-main">
                  <!--
                   <a href="<?php echo base_url();?>mantenedores/add_tipo_cuenta_banco" type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Nueva Cuenta Bancaria</a>
                    -->
                   <a href="#"  class="btn btn-primary" id="opciones" title="Eliminar" data-toggle="modal" data-target="#myModal_add"><i class="fa fa-plus" aria-hidden="true"></i>Nueva Cuenta Bancaria</a>
                   <h3 class="inner-tittle two">Descripción</h3>
                   <div class="graph">														  	
                     <div class="tables">
                      <table id="listado" class="table"> 
                       <thead> 
                        <tr>
                         <th>#</th>
                         <th>Nombre</th>
                         <th>Banco</th>
                         <th>Alias</th>
                         <th>Opciones</th>
                       </tr> 
                     </thead> 
                     <tbody> 
                      <?php $i = 1; ?>
                        <?php foreach ($tipo_cuenta_banco as $tipo_cuenta) { ?>
                            <tr class="active" id="variable">
                               <td><small><h4 class="inner-tittle two"><?php echo $i ;?></small></h4></td>
                               <td><small><h4 class="inner-tittle two"><?php echo $tipo_cuenta->nombre;?></small></h4></td>
                               <td><small><h4 class="inner-tittle two"><?php echo $tipo_cuenta->nombre_banco;?></small></h4></td>
                               <td><small><h4 class="inner-tittle two"><?php echo $tipo_cuenta->alias;?></small></h4></td>
                               <td>
                                  <a href="#" data-idtipocuentabanco="<?php echo $tipo_cuenta->id_tipo_cuenta_banco;?>" class="btn btn-info edit-tipocuentabanco" id="edit-tipocuentabanco" title="Editar Banco" data-toggle="modal" data-target="#myModal_add"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                  <a href="#" data-idtipocuentabanco="<?php echo $tipo_cuenta->id_tipo_cuenta_banco;?>" class="btn btn-danger del-tipocuentabanco" id="del-tipocuentabanco" title="Eliminar" data-toggle="modal" data-target="#myModal_Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a>
                                </td>
                            </tr> 									                            
                          <?php $i++;?>
                        <?php } ?>																		
                      </tbody> 
                    </table> 
                  </div>												
                </div>
              </div>
              
              <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="myModal_Eliminar">
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="exampleModalLabel">Eliminar</h4>
                    </div>
                    <form action="<?php echo base_url();?>mantenedores/delete_tipo_cuenta_banco/" method="POST">
                      <div class="modal-body">
                        <h5 class="modal-body">¿Desea Eliminar?</h5>
                        <input type="hidden" name="id-tipocuentabanco" class="form-control" id="id-tipocuentabanco">
                    </div>
                    <div class="modal-footer">
                        <br>
                        <button href="#" type="submit" class="btn btn-info"><span><i class="fa fa-trash-o" aria-hidden="true"></i></span> Eliminar</button>
                        <a href="#" type="button" class="btn btn-danger" data-dismiss="modal"><span><i class="fa fa-times" aria-hidden="true"></i></span> Cancelar</a>    
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              

              
            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="myModal_add">
              <div class="modal-dialog " role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Tipo Cuenta Bancaria</h4>
                  </div>
                    <form action="<?php echo base_url();?>mantenedores/submit_tipo_cuenta_banco/" method="POST">
                      <div class="modal-body">
                          <div class='row'>
                            <div class='col-md-4'>
                              <div class="form-group">
                                  <label>Tipo de Cuenta:</label>
                                  
                              </div>
                            </div>
                            <div class='col-sm-8'>
                              <div class="form-group">
                                   <input type="text" name="nombre_cuenta" class="form-control" id="nombre_cuenta" placeholder="Introduce Tipo de Cuenta" required>
                                   <input type="hidden" name="idtipocuentabanco" class="form-control" id="idtipocuentabanco">
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-4'>
                                <div class="form-group">
                                  <label>Alias:</label>
                                </div>
                            </div>
                            <div class='col-sm-8'>
                              <div class="form-group">
                                   <input type="text" name="alias" class="form-control" id="alias" placeholder="Ej: OTC,CCT,ETC.." required>
                              </div>
                          </div>
                        </div>
                          <div class='row'>
                            <div class='col-sm-4'>
                                <div class="form-group">
                                  <label>Banco:</label>
                                </div>
                            </div>
                            <div class='col-sm-8'>
                              <div class="form-group">
                                   <select name="banco" id="banco" class="form-control" required>
                                      <option value="">Seleccione Banco</option>
                                          <?php foreach ($bancos as $banco) { ?>
                                            
                                            <option value="<?php echo $banco->id_banco;?>" >
                                            <?php echo $banco->nombre;?></option>
                                        <?php } ?>                                
                                  </select>



                              </div>
                          </div>
                        </div>

                        
                         
                      </div>
                      <div class="modal-footer">
                        <br>
                          <a href="#" type="button" class="btn btn-info" data-dismiss="modal"><span><i class="fa fa-mail-reply" aria-hidden="true"></i></span> Volver</a>
                          <button type="submit" class="btn btn-primary"> <span><i class="fa fa-check" aria-hidden="true"></i></span> Guardar</button>   

                      </div>
                    </form>
                    </div>
                  </div>
                </div>



             
<script>


$(function () {
        $('#listado').dataTable({
          "bLengthChange": true,
          "bFilter": true,
          "bInfo": true,
          "bSort": false,
          "bAutoWidth": false,
          "aLengthMenu" : [[5,10,15,30,45,100,-1],[5,10,15,30,45,100,'Todos']],
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
        
        <?php } ?>


    });
</script>   


  
<script>

    $('.edit-tipocuentabanco').on('click',function(){
      var idtipocuentabanco = $(this).data('idtipocuentabanco');
     // Send data to back-end

            $.ajax({
                type: "GET",
                url: "<?php echo base_url();?>mantenedores/get_tipocuentabanco/"+idtipocuentabanco,
                //dataType: "json",
                async: true,
            }).success(function(response) {

              var_json = $.parseJSON(response);
              $('#nombre_cuenta').val(var_json.nombre);
              $('#banco').val(var_json.id_banco);
              $('#alias').val(var_json.alias);                    
              $('#idtipocuentabanco').val(idtipocuentabanco);
              
            });
         //   $("#myModal_add").modal();

    })


  $('.del-tipocuentabanco').on('click',function(){
      var id_tipocuentabanco = $(this).data('idtipocuentabanco');
      $('#id-tipocuentabanco').val(id_tipocuentabanco);
              
           
      

    })

</script>