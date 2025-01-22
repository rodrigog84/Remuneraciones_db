
<div class='row'>


<div class="col-md-6">

<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">Identificación del Colaborador</h4>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <td>
                            <p><b>Nombre</b></p>
                            <p><i class="fa fa-circle-o text-light-blue"></i>&nbsp;&nbsp;<?php echo $personal->nombre . " " . $personal->apaterno . " " . $personal->amaterno; ?></p>
                            <p><b>Rut</b></p>
                            <p><i class="fa fa-circle-o text-light-blue"></i>&nbsp;&nbsp;<?php echo $personal->rut == '' ? '' : number_format($personal->rut, 0, ".", ".") . "-" . $personal->dv; ?></p>
                        </td>
                    </tr>
                </table>
            </div><!-- /.box-body -->
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <td>
                            <p><b>Edad</b></p>
                            <p><i class="fa fa-circle-o text-light-blue"></i>&nbsp;&nbsp;<?php echo $personal->edad; ?></p>
                            <p><b>Sexo</b></p>
                            <p><i class="fa fa-circle-o text-light-blue"></i>&nbsp;&nbsp;<?php echo $personal->sexo_traducido; ?></p>
                            <input type="hidden" id='idpersonal' value="<?php echo $personal->id_personal;?>">
                        </td>

                    </tr>
                </table>
            </div><!-- /.box-body -->
        </div>
    </div><!-- /.col (left) -->
</div>
    </div><!-- /.col (left) -->

</div>
<div class='row'>

<div class="col-md-6">


                 <div class="panel panel-inverse">                       
                      <div class="panel-heading">
                            <h4 class="panel-title">Listado Centros de Costo</h4>
                        </div>
            <div class="panel-body">
              <div class='row'>                         

                                    <div class="graph-visual tables-main">
                                            

                                                          <div class="graph">                                                           
                                                            <div class="tables">
                                                                <table id="listado" class="table"> 
                                                                    <thead> 
                                                                        <tr>
                                                                <th>C&oacute;digo</th>
                                                                <th>Nombre</th>
                                        <th>Porcentaje Distribuci&oacute;n</th>
                                                                        </tr> 
                                                                    </thead> 
                                                                    <tbody> 
                                            <?php $i = 1; ?>
                                            <?php foreach ($centro_costo as $centro_costo) { ?>
                                                                        <tr class="active" id="variable">
                                        <td><small><?php echo $centro_costo->codigo;?></small>
                                        <td><small><?php echo $centro_costo->nombre;?></small></td>
                                    <td>
                                      <div class="form-group">
                                            <input type="text" name="distribucion_<?php echo $centro_costo->id_centro_costo;?>" data-idpersonal="<?php echo $personal->id_personal;?>" data-idcentrocosto="<?php echo $centro_costo->id_centro_costo;?>"  id="distribucion_<?php echo $centro_costo->id_centro_costo;?>" class="form-control input-sm distribucion dato_actualiza_input numeros" value="<?php echo isset($distribucion[$centro_costo->id_centro_costo]) ? $distribucion[$centro_costo->id_centro_costo] : 0; ?>"  size="3" />  
                                       </div> 
                                    </td>
                                    </tr>                                                               <?php $i++;?>                                                   <?php } ?>                                                                      
                                                                    </tbody> 
                                                                </table> 
                                                            </div>                                              
                                                    </div>
                                            </div>
                </div>
                </div>
                </div>  


</div>
</div>

<div class='row'>

<div class="col-md-6">

        <div class="panel-footer">
            <!-- CAMPOS OCULTOS -->
            <a href="<?php echo base_url(); ?>rrhh/distribucion_colaborador" class="btn btn-success">Volver</a>
        </div>
</div>
</div>


</div>


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
                    tipo_documento: {
                        row: '.form-group',
                        validators: {
                            notEmpty: {
                                message: 'Tipo de Documento es requerido'
                            }
                        }
                    }

                }
            })



          $('.numeros').keypress(function(event){
            if ((event.keyCode < 48 || event.keyCode > 57) && event.keyCode != 46){
              event.preventDefault();
            } 
          })  


        // Lógica para validar la suma de los valores de los campos
        $('.dato_actualiza_input').on('input', function() {
            let total = 0;

            var idpersonal = $('#idpersonal').val()
            // Sumar todos los valores de los campos con clase dato_actualiza_input
            $('.dato_actualiza_input').each(function() {
                let val = parseFloat($(this).val()) || 0; // Convertir a número o usar 0 si está vacío
                total += val;
            });

            // Verificar si la suma supera 100
            if (total > 100) {
                //alert('La suma de los valores no puede superar 100.');
                  Swal.fire({
                      title: 'Advertencia!',
                      text: 'La distribución por centro de costo no puede superar 100',
                      icon: 'error',
                      confirmButtonText: 'Aceptar'
                    })                
                $(this).val(''); // Vaciar el valor del campo que causó la superación
            }




            // Si la suma es válida, realizar la llamada AJAX
            let data = [];

            // Recopilar los valores de los campos y sus IDs correspondientes
            $('.dato_actualiza_input').each(function() {
                console.log($(this).val())

                let valor = parseFloat($(this).val()) || 0; // Convertir a número o usar 0

                console.log(valor)
                let idCentroCosto = $(this).data('idcentrocosto'); // Obtener el atributo data-idcentrocosto

                console.log(idCentroCosto)


                data.push({ idcentrocosto: idCentroCosto, valor: valor });

               // console.log(data)
            });


            //console.log(data)

            console.log(JSON.stringify(data))
            // Realizar la llamada AJAX
           $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>rrhh/guarda_distribucion_colaborador_ccosto',
                data: JSON.stringify(data), // Enviar datos en formato JSON       
                data : {
                  "idpersonal" : idpersonal,
                  "centro_costo" : JSON.stringify(data)
                 },   
                dataType: 'json'
            }).success(function(response) {

                
            });




        });




        $('.distribucion').on('input',function(){

            if(parseFloat($(this).val()) > 100){

                $(this).val(100);
            }

            var str = $(this).val();
            var ch = '.';
             
            var count = str.split(ch).length - 1;
            if(count > 1){
                $(this).val(0)
            }


        })



    })
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