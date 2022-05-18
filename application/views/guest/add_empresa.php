                <!-- begin register-header -->
                <h4 class="register-header">
                    Registra tu Empresa Aqu&iacute;
                    <!--small>Create your Color Admin Account. It’s free and always will be.</small-->
                </h4>
                <!-- end register-header -->
                <!-- begin register-content -->
                <div class="register-content">
                    <form  id="basicBootstrapForm" action="<?php echo base_url();?>guest/submit_empresa" method="POST" class="margin-bottom-0">
                        <div class='row'>
                                  <div class='col-md-12'>
                                    <div class="form-group">
                                      <label for="rut">Nombre Empresa</label>
                                       <input type="text" class="form-control" name="nombreempresa" id="nombreempresa" placeholder="Ingrese Nombre Empresa" />
                                    </div>
                                  </div>
                            </div>  


                        <div class='row'>
                                  <div class='col-md-6'>
                                    <div class="form-group">
                                      <label for="rut">Rut</label>
                                       <input type="text" class="form-control" name="rutempresa" id="rutempresa" placeholder="Ingrese Rut Empresa" />
                                    </div>
                                  </div>
                                  <div class='col-md-6'>
                                    <div class="form-group">
                                        <label for="region">Fono</label>  
                                         <input type="text" name="fono" id="fono" class="form-control" id="" placeholder="Ingrese Fono Empresa" >
                                    </div>
                                  </div>

                            </div>     
                            <div class='row'>
                                  <div class='col-md-6'>
                                    <div class="form-group">
                                        <label for="region">Regi&oacute;n</label>  
                                        <select name="region" id="region" class="form-control">
                                            <option value="">Seleccione Regi&oacute;n</option>
                                            <?php foreach ($regiones as $region) { ?>
                                              <?php $regionselected = $region->id_region == $datos_form['idregion'] ? "selected" : ""; ?>
                                              <option value="<?php echo $region->id_region;?>" <?php echo $regionselected;?> ><?php echo $region->nombre;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                  </div>
                                  <div class='col-md-6'>
                                    <div class="form-group">
                                        <label for="region">Comuna</label>  
                                         <select name="comuna" id="comuna"  class="form-control">
                                          <option value="">Seleccione Comuna</option>
                                        </select>
                                        <input type="hidden" id="idcomuna"  >
                                    </div>
                                  </div>

                            </div> 
                             <div class='row'>
                                  <div class='col-md-12'>
                                    <div class="form-group">
                                      <label for="rut">Direcci&oacute;n Empresa</label>
                                       <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese Nombre Empresa" />
                                    </div>
                                  </div>
                            </div> 
                            <div class='row'>
                                  <div class='col-md-6'>
                                    <div class="form-group">
                                        <label for="region">Nombre Usuario Sistema</label>  
                                         <input type="text" name="nombreusuario" id="nombreusuario" class="form-control" id="" placeholder="Ingrese Nombre Usuario" >
                                    </div>
                                  </div>
                                  <div class='col-md-6'>
                                    <div class="form-group">
                                        <label for="region">Apellido Usuario Sistema</label>  
                                         <input type="text" name="apellidousuario" id="apellidousuario" class="form-control" id="" placeholder="Ingrese Apellido Usuario" >
                                    </div>
                                  </div>

                            </div>  
                            <div class='row'>
                                  <div class='col-md-12'>
                                    <div class="form-group">
                                        <label for="region">Email</label>  
                                         <input type="text" name="email" id="email" class="form-control" id="" placeholder="Ingrese Email" >
                                    </div>
                                  </div>
                            </div>                   
                        <div class="register-buttons">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Registrate</button>
                            <input type='hidden' name='codvendedor' id='codvendedor' value="<?php echo $codvendedor;?>">
                        </div>
                        <div class="m-t-20 m-b-40 p-b-40">
                            Ya eres miembro? Click <a href="<?php echo base_url(); ?>">aqu&iacute;</a> para Ingresar.
                        </div>
                        <hr />
                        <p class="text-center text-inverse">
                            &copy; 2022 Arnou - Todos los derechos reservados
                        </p>
                    </form>
                </div>



<script>


$(document).ready(function() {



$('#region').change(function(){

    if($(this).val() != ''){

      $.get("<?php echo base_url();?>guest/get_comunas/"+$(this).val(),function(data){
               // Limpiamos el select
                    $('#comuna option').remove();
                    var_json = $.parseJSON(data);
                    $('#comuna').append('<option value="">Seleccione Comuna</option>');
                    for(i=0;i<var_json.length;i++){
                      $('#comuna').append('<option value="' + var_json[i].idcomuna + '">' + var_json[i].nombre + '</option>');
                    }
                    $('#basicBootstrapForm').formValidation('revalidateField', 'comuna');
      });
      
    }
});



function VerificaRut(rut) {
    if (rut.toString().trim() != '') {
      
        var caracteres = new Array();
        var serie = new Array(2, 3, 4, 5, 6, 7);
        var dig = rut.toString().substr(rut.toString().length - 1, 1);
        rut = rut.toString().substr(0, rut.toString().length - 1);
        for (var i = 0; i < rut.length; i++) {
            caracteres[i] = parseInt(rut.charAt((rut.length - (i + 1))));
        }
 
        var sumatoria = 0;
        var k = 0;
        var resto = 0;
 
        for (var j = 0; j < caracteres.length; j++) {
            if (k == 6) {
                k = 0;
            }
            sumatoria += parseInt(caracteres[j]) * parseInt(serie[k]);
            k++;
        }
 
        resto = sumatoria % 11;
        dv = 11 - resto;
 
        if (dv == 10) {
            dv = "K";
        }
        else if (dv == 11) {
            dv = 0;
        }

        if (dv.toString().trim().toUpperCase() == dig.toString().trim().toUpperCase())
            return true;
        else
            return false;
    }
    else {
        return false;
    }
  }



function replaceAll( text, busca, reemplaza ){
  while (text.toString().indexOf(busca) != -1)
      text = text.toString().replace(busca,reemplaza);
  return text;
}



    FormValidation.Validator.validateRut = {
        validate: function(validator, $field, options) {
          var validador = true;
          $field.Rut();
          var rut = $field.val();
          var cleanRut = replaceAll(rut,".","");
          var cleanRut = replaceAll(cleanRut,"-","");
          if(VerificaRut(cleanRut)){
              return true;

          }else{
              return {
                  valid : false
              }

          }


        }
    };



     $('#basicBootstrapForm').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                nombreempresa: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Nombre Empresa es requerido'
                        }
                    }
                },
                rutempresa: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Rut Empresa es requerido'
                        },
                        stringLength: {
                            min: 0,
                            max: 12,
                            message: 'El largo del Rut es Incorrecto'
                        },
                        validateRut: {
                          message: 'Rut Incorrecto'
                        }

                    }
                },
              fono: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Fono Empresa es requerido'
                        },                        
                        integer: {
                            message: 'Fono s&oacute;lo puede contener n&uacute;meros'
                        }                
                    }
                },     
                region: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Regi&oacute;n Empresa es requerido'
                        }
                    }
                },

                comuna: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Comuna Empresa es requerida'
                        }
                    }
                },                              
                direccion: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Direcci&oacute;n Comunidad es requerido'
                        }
                    }
                },

                 nombreusuario: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Nombre Usuario es requerido'
                        }
                    }
                },

                apellidousuario: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Apellido Usuario es requerido'
                        }
                    }
                },                     
                email: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Email Comunidad es requerido'
                        },
                        emailAddress: {
                            message: 'El valor ingresado no es una direcci&oacute; de email valida'
                        }                    
                    }
                },  

   
          
            }
        })

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
            time: 8000,
            class_name: 'my-sticky-class'
        });
        /*setTimeout(redirige, 1500);
        function redirige(){
            location.href = '<?php //echo base_url();?>welcome/dashboard';
        }*/
        <?php } ?>


    });
</script>