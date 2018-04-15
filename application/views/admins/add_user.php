          <form id="basicBootstrapForm" action="<?php echo base_url();?>admins/submit_user" id="basicBootstrapForm" method="post">   


<div class="panel panel-inverse">                       
    <div class="panel-heading">
        <h4 class="panel-title"><?php echo $titulo; ?></h4>
    </div>     
<div class="panel-body">    

          <div class="row">
            <div class="col-md-12">
                    <div class='row'>
                      <div class='col-md-6'>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>  
                             <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese Nombre" value="<?php echo $datos_form['nombre']; ?>">
                        </div>
                      </div>
                      <div class='col-md-6'>
                        <div class="form-group">
                            <label for="apellido">Apellido</label>  
                             <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Ingrese Apellido" value="<?php echo $datos_form['apellido']; ?>">
                        </div>
                      </div>   
                    </div>                 

                    <div class='row'>
                      <div class='col-md-6'>
                        <div class="form-group">
                              <label for="email">Email</label>    
                              <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Ingrese Email" value="<?php echo $datos_form['email']; ?>" <?php if($titulo == "Editar Usuario"){ echo "disabled"; } ?> >
                              </div>
                        </div> 
                      </div>
                      <div class='col-md-6'>
                        <div class="form-group">
                            <label for="perfil">Perfil</label>   
                            <select name="perfil" id="perfil"  class="form-control" >
                                <option value="">Seleccione Perfil</option>
                                <?php foreach ($perfiles as $perfil) { ?>
                                  <?php $perfilselected = $perfil->id == $datos_form['perfil'] ? "selected" : ""; ?>
                                  <option value="<?php echo $perfil->id;?>" <?php echo $perfilselected;?> ><?php echo $perfil->description;?></option>
                                <?php } ?>
                            </select> 
                        </div>
                      </div>  
                    </div>

                   <div class='row'>
                      <div class='col-md-6'>
                        <div class="form-group">
                              <label for="password">Password</label>    
                               <input type="password" class="form-control" name="password" id="password" placeholder="Ingrese Password" <?php if($titulo == "Editar Usuario"){ echo "disabled"; } ?> >
                        </div> 
                      </div>
                      <div class='col-md-6'>
                        <div class="form-group">
                              <label for="repassword">Repetir Password</label>    
                              <input type="password" class="form-control" onpaste="return false" name="repassword" id="repassword" placeholder="Repetir Password" <?php if($titulo == "Editar Usuario"){ echo "disabled"; } ?>>
                        </div>   
                      </div>                      
                    </div>


                  <input type="hidden" name="iduser" value="<?php echo $datos_form['iduser']; ?>" >
              </div>
          </div>
</div>
</div>          



<div class="panel panel-inverse">                       
    <div class="panel-heading">
        <div class="panel-heading-btn">
            <a  id="add_row" class="btn btn-xs btn-icon btn-circle btn-danger" ata-toggle="tooltip" title="Agregar"><i class="fa fa-plus"></i></a>
        </div>    
        <h4 class="panel-title">Asociar Empresa
        <!--div class="pull-right box-tools">
          <a id="add_row" class="btn btn-info btn-sm" data-toggle="tooltip" title="Agregar"><i class="fa fa-plus"></i></a>
        </div--><!-- /. tools -->   
        </h4>
         
    </div>     
    
<div class="panel-body">


          <div class="row">
            <div class="col-md-12">
                          <!--a id="add_row" class="btn btn-primary">Agregar</a-->
                            <table class="table table-bordered table-hover table-sortable" id="tab_logic">
                              <thead>
                                <tr >
                                  <th class="text-center">Empresa</th>
                                  <th>&nbsp;</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <tr id='addr0' data-id="0" class="hidden">
                                  <td class="form-group" data-name="comunidad-"> <!-- DEFINE EL NOMBRE QUE TENDRAN LOS ELEMENTOS CREADOS -->
                                  <select name="comunidad-0" id="comunidad-0" class="form-control comunidad" >
                                      <option value="">Seleccione Empresa</option>
                                      <?php foreach ($empresas as $empresa) { ?>
                                        <?php $empresaselected = $empresa->id_empresa == $datos_form['id_empresa'] ? "selected" : ""; ?>
                                        <?php //$muestracomunidad = $this->session->userdata('comunidadid') == '' || $this->session->userdata('comunidadid') == $comunidad->id ? true : false; ?>
                                        <?php $muestracomunidad = true; ?>

                                        <?php if($muestracomunidad){ ?>
                                          <option value="<?php echo $empresa->id_empresa;?>" <?php echo $empresaselected;?> ><?php echo $empresa->nombre;?></option>
                                        <?php } ?>
                                      <?php } ?>
                                  </select>
                                  </td>
                                  <td data-name="del">
                                      <!--button nam"del0" class='btn btn-danger glyphicon glyphicon-remove row-remove'></button-->
                                      <center><a href="#" data-toggle="tooltip" title="Eliminar" class="row-remove" ><span class="glyphicon glyphicon-trash"></span></a></center>
                                  </td>
                                </tr>
                                <?php if($datos_form['perfil'] == 2){ // administrador comunidad ?>
                                  <?php $i = 1; ?>
                                  <?php foreach ($listado_empresas as $empresas_sel) { ?>
                                    <?php //var_dump($empresas_sel); ?>

                                      <tr id='addr<?php echo $i;?>' data-id="<?php echo $i;?>" class="delement">
                                      <td class="form-group" data-name="comunidad-"> <!-- DEFINE EL NOMBRE QUE TENDRAN LOS ELEMENTOS CREADOS -->
                                      <select name="comunidad-<?php echo $i;?>" id="comunidad-<?php echo $i;?>" class="form-control comunidad" >
                                          <option value="">Seleccione Empresa</option>
                                          <?php foreach ($empresas as $empresa) { ?>
                                          <?php $empresaselected = $empresa->id_empresa == $empresas_sel ? "selected" : ""; ?>
                                          <?php //$muestracomunidad = $this->session->userdata('comunidadid') == '' || $this->session->userdata('comunidadid') == $comunidad->id ? true : false; ?>
                                          <?php $muestracomunidad = true; ?>
                                            <?php if($muestracomunidad){ ?>
                                          <option value="<?php echo $empresa->id_empresa;?>" <?php echo $empresaselected;?> ><?php echo $empresa->nombre;?></option>
                                            <?php } ?>
                                          <?php } ?>
                                      </select>
                                      </td>
                                      <td data-name="del" class="form-group">
                                          <center><a href="#" data-toggle="tooltip" title="Eliminar" class="row-remove" ><span class="glyphicon glyphicon-trash"></span></a></center>
                                      </td>
                                    </tr>
                                    <?php $i++; ?>
                                  <?php } ?>
                                <?php } ?>
                              </tbody>
                            </table>
                  <input type="hidden" name="iduser" value="<?php echo $datos_form['iduser']; ?>" >
          </div> 
          </div>
</div>          
<div class="panel-footer">
                    <button type="submit" class="btn btn-success">Guardar Usuario</button>
                    &nbsp;&nbsp;
                    <a href="<?php echo base_url();?>admins/admin_users" class="btn btn-default">Volver</a>

</div>
</div>


          </form>         

<script>


$("#tab_logic").on('change','.comunidad',function(event){
    var select_comunidad = $(this);
});



$("#perfil").on('change',function(event){
  $(".comunidad").prop('selectedIndex', 0);
  if($(this).val() == 2){
   // $('#basicBootstrapForm').formValidation('updateStatus', 'propiedad','NOT_VALIDATED'); //quita validacion
    $(".comunidad").prop("disabled",false);
    $("#add_row").prop("disabled",false);
   // $('#basicBootstrapForm').formValidation('revalidateField', 'comunidad');
  }else if($(this).val() ==  1){
   // $('#basicBootstrapForm').formValidation('updateStatus', 'comunidad','NOT_VALIDATED'); //quita validacion
   // $('#basicBootstrapForm').formValidation('updateStatus', 'propiedad','NOT_VALIDATED'); //quita validacion
    $(".comunidad").prop("disabled",true);
    $("#add_row").prop("disabled",true);
    $("#tab_logic tr.delement").remove();
  }
});


</script>



<script>

$(document).ready(function() {

  if($('#perfil').val() == 2){
    $(".comunidad").prop("disabled",false);

    $.each($("#tab_logic tr"), function() {
        $(this).find("td a.row-remove").on("click", function() {
             $(this).closest("tr").remove();
        });
    });

  }else if($('#perfil').val() ==  1){
    $(".comunidad").prop("disabled",true);
  }


/********************** TABLA DINAMICA **********/


  $("#add_row").on("click", function() {

        if($('#perfil').val() != 1){ // debe ser distinto a administrador de sistemas
          // Dynamic Rows Code
          
          // Get max row id and set new id
          var newid = 0;
          $.each($("#tab_logic tr"), function() {
              if (parseInt($(this).data("id")) > newid) {
                  newid = parseInt($(this).data("id"));
              }
          });
          newid++;
          
          var tr = $("<tr></tr>", {
              id: "addr"+newid,
              "data-id": newid,
              class:'delement'
          });
          
          // loop through each td and create new elements with name of newid
          $.each($("#tab_logic tbody tr:nth(0) td"), function() {
              var cur_td = $(this);
              
              var children = cur_td.children();
              
              // add new td and element if it has a nane
              if ($(this).data("name") != undefined) {
                  var td = $("<td></td>", {
                      "data-name": $(cur_td).data("name"),
                      class:'form-group'
                  });
                  
                  var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                  c.attr("name", $(cur_td).data("name") + newid);
                  c.attr("id", $(cur_td).data("name") + newid);
                  c.appendTo($(td));
                  td.appendTo($(tr));
              } else {
                  var td = $("<td></td>", {
                      'text': $('#tab_logic tr').length
                  }).appendTo($(tr));
              }
          });
          
          // add delete button and td
          /*
          $("<td></td>").append(
              $("<button class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>")
                  .click(function() {
                      $(this).closest("tr").remove();
                  })
          ).appendTo($(tr));
          */
          
          // add the new row
          $(tr).appendTo($('#tab_logic'));
          $(tr).find("td a.row-remove").on("click", function() {
               $(this).closest("tr").remove();
          });
        }


});




    // Sortable Code
    var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
    
        $helper.children().each(function(index) {
            $(this).width($originals.eq(index).width())
        });
        
        return $helper;
    };
  
   /* $(".table-sortable tbody").sortable({
        helper: fixHelperModified      
    }).disableSelection();*/

    //$(".table-sortable thead").disableSelection();



    $("#add_row").trigger("click");



/***************************************************/

    $('#basicBootstrapForm').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nombre: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Nombre es requerido'
                    }
                }
            },

            apellido: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Apellido es requerido'
                    }
                }
            },            

            email: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Email Propiedad es requerido'
                    },
                    emailAddress: {
                        message: 'El valor ingresado no es una direcci&oacute; de email valida'
                    },
                    blank: {}                   
                }
            },  

            perfil: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Perfil es requerido'
                    }
                }
            },            


            password: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Password es requerido'
                    },
                    stringLength: {
                        min: 6,
                        max: 20,
                        message: 'La Password debe contener entre 6 y 20 caracteres'
                    }
                }
            },                           

            repassword: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Confirmaci&oacute;n de Password es requerido'
                    },
                    identical: {
                        field: 'password',
                        message: 'Password y su confirmaci&oacute;n no son iguales'
                    }                    
                }
            },


            /*comunidad: {
                // The children's full name are inputs with class .childFullName
                selector: '.comunidad',
                // The field is placed inside .col-xs-6 div instead of .form-group
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Comunidad es requerida'
                    },
                },

            }*/

        }
    })

    .on('success.form.fv', function(e) { /**** VALIDAR EN SERVIDOR VIA AJAX ******/
        // Prevent default form submission
        e.preventDefault();

        var $form = $(e.target),                    // The form instance
            fv    = $form.data('formValidation');   // FormValidation instance

        // Send data to back-end
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>admins/validate_email_user',
            data: $form.serialize(),
            dataType: 'json'
        }).success(function(response) {
            // We will display the messages from server if they're available

            // If there is error returned from server

              if (response.result === 'error') {
                  //console.log(response.fields);
                  for (var field in response.fields) {

                      fv
                          // Show the custom message
                          .updateMessage(field, 'blank', response.fields[field])
                          // Set the field as invalid
                          .updateStatus(field, 'INVALID', 'blank');
                  }
              } else {
                  // Do whatever you want here
                  // such as showing a modal ...
                  fv.defaultSubmit();
              }            
        });
    });          

});
</script>  

