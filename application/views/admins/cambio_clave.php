
        <!-- Main content -->
<form id="basicBootstrapForm" action="<?php echo base_url();?>admins/submit_clave" id="basicBootstrapForm" method="post">
<div class="panel panel-inverse">                       
    <div class="panel-heading">
        <h4 class="panel-title">Cambio de Clave</h4>
    </div>     
<div class="panel-body">    


   
          <div class="row">
            <div class="col-md-12">
                        <div class="form-group">
                              <label for="password">Clave Actual</label>    
                               <input type="password" class="form-control" name="password_actual" id="password_actual" placeholder="Ingrese Password Actual" >
                        </div> 

                        <div class="form-group">
                              <label for="password">Nueva Clave</label>    
                               <input type="password" class="form-control" name="password_nueva" id="password_nueva" placeholder="Ingrese Nueva Password" >
                        </div> 

                        <div class="form-group">
                              <label for="repassword">Repetir Nueva Clave</label>    
                              <input type="password" class="form-control" onpaste="return false" name="repassword" id="repassword" placeholder="Repetir Nueva Password" >
                        </div>   
                 
              </div>
          </div>
          

</div>
<div class="panel-footer">
<button type="submit" class="btn btn-success">Actualiza Clave</button>

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

            password_actual: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Clave actual es requerida'
                    },
                    stringLength: {
                        min: 6,
                        max: 20,
                        message: 'La Password debe contener entre 6 y 20 caracteres'
                    },
                    blank: {}                      
                }
            },  


            password_nueva: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Clave nueva es requerida'
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
                        message: 'Confirmaci&oacute;n de Clave nueva es requerido'
                    },
                    identical: {
                        field: 'password_nueva',
                        message: 'Password y su confirmaci&oacute;n no son iguales'
                    }                    
                }
            },
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
            url: '<?php echo base_url();?>admins/validate_password_user',
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

