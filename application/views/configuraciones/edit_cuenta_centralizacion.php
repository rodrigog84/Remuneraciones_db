               <form id="basicBootstrapForm" action="<?php echo base_url();?>configuraciones/submit_cuentas_centralizacion" method="post">

                  <div class="panel panel-inverse">                       
                      <div class="panel-heading">
                            <h4 class="panel-title">Cuenta:</h4>
                        </div>
            <div class="panel-body">
            		<b><?php echo $cuenta_centralizacion->nombre_sistema;?></b>
            </div>
        </div>


                  <div class="panel panel-inverse">                       
                      <div class="panel-heading">
                            <h4 class="panel-title">Editar Cuenta Centralizaci&oacute;n</h4>
                        </div>
            <div class="panel-body">

	            	<div class='row'>
	                          <div class='col-md-6'>
	                            <div class="form-group">
										<label for="rut">Cuenta Contable</label>
										<input list="datalistOptions" id="cuenta" name="cuenta" class="form-control" placeholder="Seleccione Cuenta" value='<?php echo $datos_select['cuenta'];?>' autocomplete="off"  >
										<datalist id="datalistOptions">
		                                    <?php foreach ($plan_cuentas as $cuenta) { ?>
		                                            <?php //echo '<pre>'; var_dump( $cuenta); exit; 
		                                            ?>
		                                            <option data-id="<?php echo $cuenta['idn4']; ?>" data-referencia='<?php echo $cuenta['referencia']; ?>' data-centro_costo='<?php echo $cuenta['centro_costo']; ?>' data-item_ingreso='<?php echo $cuenta['item_ingreso']; ?>' data-item_gasto='<?php echo $cuenta['item_gasto']; ?>' data-cuenta_corriente='<?php echo $cuenta['cuenta_corriente']; ?>' value='<?php echo $cuenta['nombren4']; ?>'><?php echo $cuenta['codigon4'] . ' | ' . $cuenta['nombren2'] . ' | ' . $cuenta['nombren3']; ?></option>

		                                    <?php } ?>
		         						</datalist>
		         						<input type='hidden' id='cuenta_sel' name='cuenta_sel' value='<?php echo isset($cuenta_centralizacion->idcuentacontable) ? $cuenta_centralizacion->idcuentacontable: 0;?>'>	
	                            </div>
	                          </div>
	                          <div class='col-md-6'>
	                            <div class="form-group">
									<label for="rut">Centro de Costo</label>
									<select id="centrocosto" name="centrocosto" class="form-control" disabled>
	                                    <option value="">Seleccione Centro de Costo</option>
	                                    <?php foreach ($centros_costo as $centro_costo) { ?>
		                                    <?php
		                                    	$ccosto_selected = '';
		                                    	if(isset($cuenta_centralizacion->idcentrocosto)){
		                                    			$ccosto_selected = $cuenta_centralizacion->idcentrocosto == $centro_costo['id'] ? 'selected' : '';

		                                    	}

		                                    ?>														                                    	
	                                        <option value="<?php echo $centro_costo['id']; ?>" <?php echo $ccosto_selected; ?>><?php echo $centro_costo['codigo'] . ' | ' . $centro_costo['nombre']; ?></option>
	                                    <?php } ?>
	                                </select>
	                            </div>
	                          </div>
	            	</div>


	           	<div class='row'>
	                          <div class='col-md-6'>
	                            <div class="form-group">
									<label for="rut">Item Ingreso</label>
	                                <select id="itemingreso" name="itemingreso" class="form-control" disabled>
	                                    <option value="">Seleccione Item de Ingreso</option>
	                                    <?php foreach ($item_ingreso as $item_ing) { ?>
		                                    <?php
		                                    	$iingreso_selected = '';
		                                    	if(isset($cuenta_centralizacion->iditemingreso)){
		                                    			$iingreso_selected = $cuenta_centralizacion->iditemingreso == $item_ing['id'] ? 'selected' : '';

		                                    	}

		                                    ?>															                                    	
	                                        <option value="<?php echo $item_ing['id']; ?>" <?php echo $iingreso_selected; ?>><?php echo $item_ing['codigo'] . ' | ' . $item_ing['nombre']; ?></option>
	                                    <?php } ?>
	                                </select>
	                            </div>
	                          </div>
	                          <div class='col-md-6'>
	                            <div class="form-group">
										<label for="rut">Item Gasto</label>
		                                <select id="itemgasto" name="itemgasto" class="form-control" disabled>
		                                    <option value="">Seleccione Item de Gasto</option>
		                                    <?php foreach ($item_gastos as $item_gas) { ?>
			                                    <?php
			                                    	$igasto_selected = '';
			                                    	if(isset($cuenta_centralizacion->iditemgasto)){
			                                    			$igasto_selected = $cuenta_centralizacion->iditemgasto == $item_gas['id'] ? 'selected' : '';

			                                    	}

			                                    ?>															                                    	
		                                        <option value="<?php echo $item_gas['id']; ?>" <?php echo $igasto_selected; ?>><?php echo $item_gas['codigo'] . ' | ' . $item_gas['nombre']; ?></option>
		                                    <?php } ?>
		                                </select>
	                            </div>
	                          </div>
	            	</div>

					<div class='row'>
	                          <div class='col-md-6'>
	                            <div class="form-group">
									<label for="rut">Cuenta Corriente</label>
									<input list="datalistOptionsCtaC" id="cuentacorriente" name="cuentacorriente" class="form-control"  value='<?php echo $datos_select['cuentacorriente'];?>' autocomplete="off" disabled>
	                                <datalist id="datalistOptionsCtaC">

	                                    <?php foreach ($cuentas_corrientes as $cuenta_corriente) { ?>
	                                        <?php $tipocuentas = "Funcionario";
	                                        if ($cuenta_corriente['tipocuenta'] == "P") {
	                                            $tipocuentas = "Proveedor";
	                                        }

	                                        if ($cuenta_corriente['tipocuenta'] == "C") {
	                                            $tipocuentas = "Cliente";
	                                        }

	                                        if ($cuenta_corriente['tipocuenta'] == "") {
	                                            $tipocuentas = "";
	                                        }

	                                        ?>

	                                        <option data-id="<?php echo $cuenta_corriente['id']; ?>" data-nomrut="<?php echo number_format($cuenta_corriente['rut'], 0, '.', '.') . '-' . $cuenta_corriente['dv'] . ' | ' . $cuenta_corriente['nombre']; ?>" data-nombre="<?php echo $cuenta_corriente['nombre']; ?>" value="<?php echo $cuenta_corriente['nombre']; ?>">
	                                            <?php echo number_format($cuenta_corriente['rut'], 0, '.', '.') . '-' . $cuenta_corriente['dv'] . ' | ' . $tipocuentas; ?>
	                                        </option>
	                                    <?php } ?>

	                                </datalist>
	                                <input type='hidden' id='cuenta_corriente' name='cuenta_corriente' value='<?php echo isset($cuenta_centralizacion->idcuentacorriente) ? $cuenta_centralizacion->idcuentacorriente: 0;?>'>
	                                
	                                		
	                            </div>
	                          </div>

	            	</div>            	


       
		</div>
		 <div class="panel-footer">
							<a href="<?php echo base_url(); ?>configuraciones/cuentas_centralizacion" class = "btn btn-primary" >Volver</a>
							<button type = "submit" class = "btn btn-info" id="comando">Guardar
							</button>
							<input type="hidden" name="idcuentacentralizacion" value="<?php echo isset($cuenta_centralizacion->id) ? $cuenta_centralizacion->id: 0 ;?>">

		  </div> 
 	
</div>

</form>


<script>



$(document).ready(function() {


selecciona_cuenta();

function selecciona_cuenta() {


        var value = $('#cuenta').val();




        //console.log($('#datalistOptions [value="' + value + '"]').data('id'));



        var cuenta_sel = $('#datalistOptions [value="' + value + '"]').data('id');

        if (cuenta_sel === undefined) {

            $('#cuenta_sel').val(0);
            $('#centrocosto').val('');
            $('#centrocosto').attr('disabled', 'disabled');

            $('#itemingreso').val('');
            $('#itemingreso').attr('disabled', 'disabled');

            $('#itemgasto').val('');
            $('#itemgasto').attr('disabled', 'disabled');


            $('#cuentacorriente').val('');
            $('#cuentacorriente').attr('disabled', 'disabled');

            /*$('#referencia').val('');
            $('#referencia').attr('disabled', 'disabled');*/

        } else {

            $('#cuenta_sel').val(cuenta_sel);
            var centro_costo = $('#datalistOptions [value="' + value + '"]').data('centro_costo');
            var item_ingreso = $('#datalistOptions [value="' + value + '"]').data('item_ingreso');
            var item_gasto = $('#datalistOptions [value="' + value + '"]').data('item_gasto');
            var cuenta_corriente = $('#datalistOptions [value="' + value + '"]').data('cuenta_corriente');
            var referencia = $('#datalistOptions [value="' + value + '"]').data('referencia');

            if (centro_costo == 1) {
                $('#centrocosto').attr('disabled', false);
            } else {
                $('#centrocosto').val('');
                $('#centrocosto').attr('disabled', 'disabled');
            }


            if (item_ingreso == 1) {
                $('#itemingreso').attr('disabled', false);
            } else {
                $('#itemingreso').val('');
                $('#itemingreso').attr('disabled', 'disabled');
            }


            if (item_gasto == 1) {
                $('#itemgasto').attr('disabled', false);
            } else {
                $('#itemgasto').val('');
                $('#itemgasto').attr('disabled', 'disabled');
            }


            if (cuenta_corriente == 1) {
                $('#cuentacorriente').attr('disabled', false);
            } else {
                $('#cuentacorriente').val('');
                $('#cuentacorriente').attr('disabled', 'disabled');
            }



            /*if (referencia == 1) {
                $('#referencia').attr('disabled', false);
            } else {
                $('#referencia').val('');
                $('#referencia').attr('disabled', 'disabled');
            }*/



        }


    }



    function valida_cuenta_Corriente() {
        var value = $('#cuentacorriente').val();
        var cuenta_sel = $('#datalistOptionsCtaC [value="' + value + '"]').data('id');


        if (cuenta_sel === undefined) {

            $('#cuenta_corriente').val(0);
        } else {

            $('#cuenta_corriente').val(cuenta_sel);
        }
    }




    $('#cuentacorriente').on('input', function() {


        valida_cuenta_Corriente();





    });

$('#cuenta').on('input', function() {

        selecciona_cuenta();
  });

$('#basicBootstrapForm').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {

            tipo: {
                // The children's full name are inputs with class .childFullName
                // The field is placed inside .col-xs-6 div instead of .form-group
                selector: '.tipo',
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Tipo es requerido'
                    },
                },

            },          
           
     		codigo: {
                selector: '.codigo',
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'C&oacute;digo Haber/Descuento es requerido'
                    },
                },

            }, 

     		descripcion: {
                selector: '.descripcion',
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Descripci&oacute;n es requerida'
                    },
                },

            }, 


     		tipocalculo: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Tipo C&aacute;lculo es requerido'
                    },
                },

            },   

   			formacalculo: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Forma C&aacute;lculo es requerido'
                    },
                },

            },   
            cuenta: {
                row: '.form-group',
                validators: {
                    callback: {
                        message: 'Cuenta Contable es requerida',
                        callback: function (value, validator, $field) {

                            var cuenta_sel = $('#cuenta_sel').val();
	                         /* return  {
	                                valid: false,
	                                message: 'Cuenta Contable es requerida'
	                            }*/

                            if(cuenta_sel != '0'){
                              return true;
                            }else{
                              return  {
                                    valid: false,
                                    message: 'Cuenta Contable es requerida'
                                }
                            }
                        }
                    }                    

                },

            },   

   			centrocosto: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Centro de Costo es requerido'
                    },
                },

            },                                  

   			itemingreso: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Item de Ingreso es requerido'
                    },
                },

            },

   			itemgasto: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Item de Gasto es requerido'
                    },
                },

            },   

            cuentacorriente: {
                row: '.form-group',
                validators: {
                    callback: {
                        message: 'Cuenta Corriente es requerida',
                        callback: function (value, validator, $field) {

                            var cuenta_corriente = $('#cuenta_corriente').val();
	                         /* return  {
	                                valid: false,
	                                message: 'Cuenta Contable es requerida'
	                            }*/

                            if(cuenta_corriente != '0'){
                              return true;
                            }else{
                              return  {
                                    valid: false,
                                    message: 'Cuenta Corriente es requerida'
                                }
                            }
                        }
                    }                    

                },

            },               


        }
    })
});



</script>											