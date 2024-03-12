<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   <ol class="breadcrumb m-b-0">
											<li><a href="inicio.html">Inicio</a></li>
											<li class="active">Calculo Remuneraciones</li>
											
										</ol>
									   </div>
								  <!--//sub-heard-part-->

									<div class="graph-visual tables-main">
											
									        <?php if(isset($message)): ?>
									         <div class="row">
									            <div class="col-md-12">
									                      <div class="alert alert-<?php echo $classmessage; ?> alert-dismissable">
									                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									                        <h4><i class="icon fa <?php echo $icon;?>"></i> Alerta!</h4>
									                        <?php echo $message;?>
									                      </div>
									            </div>            
									          </div>
									          <?php endif; ?>

											<form id="basicBootstrapForm" action="<?php echo base_url();?>rrhh/submit_asistencia" id="basicBootstrapForm" method="post"> 
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
									                  <!--a href="<?php echo base_url();?>rrhh/carga_masiva_asistencia" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-upload"></span>&nbsp;&nbsp;Carga Masiva</a-->
									                </div>


									            </div>



								            <div class="row">

								                <div class="col-md-12">

								                	<div class="panel panel-inverse">                       
						                                <div class="panel-heading">
						                                      <h4 class="panel-title">B&uacute;squeda Trabajador</h4>
						                                  </div>


						                                  	<div class="panel-body" >
											  					<div class='row'>

											                            <div class="col-md-5">
											                                        <div class="form-group">
											                                              <label for="password">Selecci&oacute;n Trabajador</label>    
											                                               <!--select name="productodetalle" id="productodetalle" class="form-control" >
											                                                <option value="">Seleccione Hora Bloque</option>
											                                                </select-->
											                                                <input type="text" name="trabajador" id="trabajador" class="form-control editables" onClick='this.select()'  placeholder="Ingrese Trabajador" />
											                                                <!--small class="help-block" id="mje_cliente" style="color:red">&nbsp;</small-->
											                                                <input type="hidden" name="idtrabajador" id="idtrabajador" class="form-control"  />
											                                        </div> 

											                                 
											                              </div> 

											                               <div class="col-md-2">
											                                          <div class="form-group">
											                                               <label for="minutos">D&iacute;as a Trabajar</label>
																							<input type="text" name="general_diasatrabajar" id="general_diasatrabajar" class="form-control"  readonly="readonly" value="0" />
											                                          </div> 

											                                                
											                                </div>

												                               <div class="col-md-2">
											                                          <div class="form-group">
											                                               <label for="minutos">Licencias</label>
																							<input type="text" name="general_diaslicencia" id="general_diaslicencia" class="form-control" onClick='this.select()'   value="0" readonly />
											                                          </div> 

											                                                
											                                </div>
										                              



											                            <div class="col-md-2">
											                                        <div class="form-group">
											                                              <label for="password">D&iacute;as Trabajados</label>    
											                                               <!--select name="productodetalle" id="productodetalle" class="form-control" >
											                                                <option value="">Seleccione Hora Bloque</option>
											                                                </select-->
											                                                <input type="text" name="general_diastrabajo" id="general_diastrabajo" class="form-control editables asistencia_ingreso" onClick='this.select()'  placeholder="Ingrese D&iacute;as Trabajo" disabled />
											                                        </div> 
											                                 
											                              </div>              
											                              <div class="col-md-1">
											                                          <div class="form-group">
											                                               <label for="minutos">&nbsp;</label>
											                                                <br>
											                                                <button type="button" id='add_info_trabajador' class="btn btn-info align-self-end" title="Agregar"><i class="fa fa-plus fa-lg" aria-hidden="true"  role="button"></i></button>
											                                                <input type="hidden" class="form-control " id="idlineadetalle" name="idlineadetalle" value='0'>
											                                          </div> 

											                                                
											                                </div>

											                    </div>
											                </div>

											             </div>
											         </div>

											     </div>




									            <div class="row">

									                <div class="col-md-12">

									                	<div class="panel panel-inverse">                       
							                                <div class="panel-heading">
							                                      <h4 class="panel-title">Ingreso de Asistencia</h4>
							                                  </div>

									                  
											
														  <div class="graph">

														  	
															<div class="tables">
																<table class="table"> 
																	<thead> 
										                            <tr>
										                              <th >#</th>
										                              <th >Rut</th>
										                              <th >Nombre Trabajador</th>
										                              <th >D&iacute;as a Trabajar</th>
										                              <th >Licencias</th>
										                              <th >Dias Trabajados</th>
									                            	</tr>
																	</thead> 
											                          <tbody>
											                            <?php if(count($personal) > 0 ){ ?>
											                              <?php $i = 1; ?>
											                              <?php foreach ($personal as $trabajador) { ?>
											                               <?php
											                               	 if(isset($datos_remuneracion[$trabajador->id_personal])){

											                               	 	//SI TIENE UN DATO YA INGRESADO, CONSIDERA ESE VALOR 
											                               	 	$dias_trabajo_mes = $datos_remuneracion[$trabajador->id_personal];
											                               	 	//$dias_trabajo_mes = ($dias_periodo - $licencias[$trabajador->id_personal]) < $dias_trabajo_mes ? ($dias_periodo - $licencias[$trabajador->id_personal]) :  $dias_trabajo_mes;


											                               	 }else{

											                               	 	if($trabajador->diastrabajo == 30 && $licencias[$trabajador->id_personal] > 0){
											                               	 		$dias_trabajo_mes = $dias_periodo - $licencias[$trabajador->id_personal];

											                               	 	}else{

											                               	 		$dias_trabajo_mes = $trabajador->diastrabajo - $licencias[$trabajador->id_personal];
											                               	 	}

											                               	 }


											                               ?>
											                               <tr >
											                                <td><?php echo $i ;?></td>
											                                <td><?php echo $trabajador->rut == '' ? '' : number_format($trabajador->rut,0,".",".")."-".$trabajador->dv;?></td>
											                                <td><?php echo $trabajador->nombre." ".$trabajador->apaterno." ".$trabajador->amaterno;?></td>
											                                <td>
											                                    <b><span id="diasatrabajar_<?php echo $trabajador->id_personal;?>"  class="text-right" ><?php echo $trabajador->diastrabajo;?></span></b>   
											                                </td>
											                                 <td>
											                                    <b><span id="diaslicencia_<?php echo $trabajador->id_personal;?>"  class="diaslicencia text-right" ><?php echo $licencias[$trabajador->id_personal];?></span></b>   
											                                </td>
											                                <td class="form-group">
											                                  <input type="text" name="diastrabajo_<?php echo $trabajador->id_personal;?>" id="diastrabajo_<?php echo $trabajador->id_personal;?>" class="diastrabajo numeros editables" value="<?php echo str_replace(".",",",$dias_trabajo_mes); ?>"  />   
											                                </td>
											                              </tr>
											                              <?php $i++;?>
											                              <?php } ?>
											                            <?php }else{ ?>
											                            <tr>
											                              <td colspan="4">No existen trabajadores en la comunidad</td>
											                            </tr>
											                          <?php } ?>
											                          </tbody>
																</table> 
																<input type='hidden' name='dias_periodo' id='dias_periodo' value='<?php echo $dias_periodo;?>'>
															</div>
										                    <?php if(count($personal) > 0 ){ ?>
										                    <div class="panel-footer">
										                      <button type="submit" class="btn btn-primary">Guardar</button>&nbsp;&nbsp;
										                    </div>
										                    <?php } ?>															
												
													</div>

												</div>
												</div>
												</div>
												</form>  
											</div>
									<!--/charts-inner-->


<script>


$('#add_info_trabajador').on('click',function(){

	add_info_trabajador();

})

function add_info_trabajador(){

	var idtrabajador = $('#idtrabajador').val();
	var dias_trabajo = $('#general_diastrabajo').val();
	$('#diastrabajo_'+idtrabajador).val(dias_trabajo);


	$('#trabajador').val('')
	$('#general_diastrabajo').val('');
	$('#general_diasatrabajar').val(0);
	$('#general_diaslicencia').val(0);
	$('#idtrabajador').val(0)



	$('.asistencia_ingreso').attr('disabled',true);
}


$('#trabajador').keypress(function(event){
  var keycode = (event.keyCode ? event.keyCode : event.which);

  if(keycode == '13'){
    event.preventDefault();
    $('#general_diastrabajo').focus();
  }
});

$('#general_diastrabajo').keypress(function(event){
  var keycode = (event.keyCode ? event.keyCode : event.which);

  if(keycode == '13'){
    event.preventDefault();

    add_info_trabajador()
    $('#trabajador').focus();
  }
});




var availableTagsTrabajadores = [
<?php foreach ($personal as $trabajador) { ?>
    {"label":"<?php echo $trabajador->rut.'-'.$trabajador->dv. ' | ' . trim(addslashes($trabajador->nombre." ".$trabajador->apaterno." ".$trabajador->amaterno));?>","value":"<?php echo  $trabajador->rut.'-'.$trabajador->dv. ' | ' . trim(addslashes($trabajador->nombre." ".$trabajador->apaterno." ".$trabajador->amaterno)); ?>", "id":<?php echo $trabajador->id_personal;?>},
<?php } ?>
];
$('#trabajador').autocomplete({
    source: availableTagsTrabajadores,
    select: function (event, ui) {  selecciona_trabajador(ui.item.id,ui.item.value); }
}); 


	function selecciona_trabajador(item_sel,item_value){

		console.log(item_sel)
		console.log(item_value)

		$('#general_diastrabajo').focus();
		$('#general_diastrabajo').val($('#diastrabajo_'+item_sel).val())
		$('#general_diasatrabajar').val($('#diasatrabajar_'+item_sel).html())
		$('#general_diaslicencia').val($('#diaslicencia_'+item_sel).html())


		$('#idtrabajador').val(item_sel);
		$('.asistencia_ingreso').attr('disabled',false);


		//console.log('aaaa')
	}


  function replaceAll( text, busca, reemplaza ){
  while (text.toString().indexOf(busca) != -1)
      text = text.toString().replace(busca,reemplaza);
  return text;
}


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
        $('.editables').attr('readonly',true);
      }else{
        $('.editables').attr('readonly',false);
      }



      $.ajax({url: "<?php echo base_url();?>rrhh/get_datos_licencia/"+$('#mes').val()+"/"+$('#anno').val(),
		        type: 'GET',
		        async: false,
		        success : function(data) {
		        	
		        	var_json_lic = $.parseJSON(data);
                 	console.log(var_json_lic.dias_licencia)
                 	var dias_licencia = var_json_lic.dias_licencia;

                 	$.each(dias_licencia,function(index,value){

                                          //console.log(index)
                                          //console.log(value)
                                          $('#diaslicencia_'+index).html(value)

                                      });
                 	/*var_json_lic = $.parseJSON(data);
                 	$('#diaslicencia_'+idtrabajador).html(var_json_lic['dias_licencia']);*/
		        }});

     /*  $(".diaslicencia").each(
                        function(index,value){
                            var id_text = $(this).attr('id');
                            var array_field = id_text.split("_");
                            idtrabajador = array_field[1];  
                           // console.log(idtrabajador);
                             $.ajax({url: "<?php echo base_url();?>rrhh/get_datos_licencia/"+$('#mes').val()+"/"+$('#anno').val()+"/"+idtrabajador,
						        type: 'GET',
						        async: false,
						        success : function(data) {
	                             	var_json_lic = $.parseJSON(data);
	                             	$('#diaslicencia_'+idtrabajador).html(var_json_lic['dias_licencia']);
						        }});
                        }
                        
                    );

		*/


      var dias_periodo = 0
      $.ajax({url: "<?php echo base_url();?>rrhh/get_dias_periodo/"+$('#mes').val()+"/"+$('#anno').val(),
        type: 'GET',
        async: false,
        success : function(data) {

        	dias_periodo = data;
        	$('#dias_periodo').val(dias_periodo)

        }});



      $.get("<?php echo base_url();?>rrhh/get_datos_remuneracion/"+$('#mes').val()+"/"+$('#anno').val(),function(data){
               // Limpiamos el select

               		dias_periodo = parseInt(dias_periodo)
               		//console.log(dias_periodo)
                    var_json = $.parseJSON(data);
                   // console.log(var_json);
                    $(".diastrabajo").each(
                        function(index,value){
                            var id_text = $(this).attr('id');
                            var array_field = id_text.split("_");
                            idtrabajador = array_field[1];  

                            diastrabajo = 0;



							if(parseInt($('#diasatrabajar_'+idtrabajador).html()) == 30 && parseInt($('#diaslicencia_'+idtrabajador).html()) > 0){
								max_dias_trabajo = dias_periodo - parseInt($('#diaslicencia_'+idtrabajador).html())
							}else{
								max_dias_trabajo = parseInt($('#diasatrabajar_'+idtrabajador).html()) - parseInt($('#diaslicencia_'+idtrabajador).html());
							}

                           	if(typeof(var_json["diastrabajo_"+idtrabajador]) != 'undefined' && var_json["diastrabajo_"+idtrabajador] != null){
                           		diastrabajo = var_json["diastrabajo_"+idtrabajador] > max_dias_trabajo ? max_dias_trabajo : var_json["diastrabajo_"+idtrabajador];
                           	}else{
                           		diastrabajo = max_dias_trabajo;
                           	}
                            /*var diastrabajo =  typeof(var_json["diastrabajo_"+idtrabajador]) != 'undefined' && var_json["diastrabajo_"+idtrabajador] != null ? var_json["diastrabajo_"+idtrabajador] : parseInt($('#diasatrabajar_'+idtrabajador).html()) - parseInt($('#diaslicencia_'+idtrabajador).html());*/

                            //console.log(idtrabajador+' '+parseInt($('#diasatrabajar_'+idtrabajador).html())+' '+parseInt($('#diaslicencia_'+idtrabajador).html())+' '+diastrabajo)
                            $(this).val(replaceAll(diastrabajo,'.',','));
                        }
                        
                    );                    
      });
      
});


$(document).ready(function() {

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
        $('.editables').attr('readonly',true);
      }else{
        $('.editables').attr('readonly',false);
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
            lectura: {
                // The children's full name are inputs with class .childFullName
                selector: '.diastrabajo',
                // The field is placed inside .col-xs-6 div instead of .form-group
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Informaci&oacute;n de Asistencia es requerida'
                    },
                    numeric: {
                        separator: ',',
                        message: 'Asistencia s&oacute;lo puede contener n&uacute;meros'
                    },
                    callback: {
                        message: 'Asistencia debe ser menor o igual a d&iacute;as a trabajar',
                        callback: function (value, validator, $field) {
                            var id_text = $field.attr('id');
                            var array_field = id_text.split("_");
                            idtrabajador = array_field[1];


                            var dias_periodo = parseInt($('#dias_periodo').val());
                            var asistencia_trabajador = $('#diasatrabajar_'+idtrabajador).html() == '' ? 0 : parseInt($('#diasatrabajar_'+idtrabajador).html());
                            var licencias_trabajador = $('#diaslicencia_'+idtrabajador).html() == '' ? 0 : parseInt($('#diaslicencia_'+idtrabajador).html());
                            var asistencia_actual = $('#diastrabajo_'+idtrabajador).val() == '' ? 0 : parseInt($('#diastrabajo_'+idtrabajador).val());


                            //si trabaja 30 dias, y tiene licencia, se considera el total de d[ias del mes
   							if(parseInt($('#diasatrabajar_'+idtrabajador).html()) == 30 && licencias_trabajador > 0){
								max_dias_trabajo = dias_periodo - licencias_trabajador;
							}else{
								max_dias_trabajo = asistencia_trabajador - licencias_trabajador;
							}
                         


                            if(asistencia_actual <= max_dias_trabajo){
                              return true;
                            }else{
                              return  {
                                    valid: false,
                                    message: 'Asistencia debe ser menor o igual a d&iacute;as a trabajar'
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

            },

            general_diastrabajo: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Informaci&oacute;n de Asistencia es requerida'
                    },
                    numeric: {
                        separator: ',',
                        message: 'Asistencia s&oacute;lo puede contener n&uacute;meros'
                    },
                    callback: {
                        message: 'Asistencia debe ser menor o igual a d&iacute;as a trabajar',
                        callback: function (value, validator, $field) {
                            var id_text = $field.attr('id');
                            var array_field = id_text.split("_");
                            idtrabajador = array_field[1];

                            var dias_periodo = parseInt($('#dias_periodo').val());
                            var asistencia_trabajador = $('#general_diasatrabajar').val() == '' ? 0 : parseInt($('#general_diasatrabajar').val());
                            var licencias_trabajador = $('#general_diaslicencia').val() == '' ? 0 : parseInt($('#general_diaslicencia').val());
                            var asistencia_actual = $('#general_diastrabajo').val() == '' ? 0 : parseInt($('#general_diastrabajo').val());  
                          
                            //si trabaja 30 dias, y tiene licencia, se considera el total de d[ias del mes
   							if(parseInt(asistencia_trabajador) == 30 && licencias_trabajador > 0){
								max_dias_trabajo = dias_periodo - licencias_trabajador;
							}else{
								max_dias_trabajo = asistencia_trabajador - licencias_trabajador;
							}


                            if(asistencia_actual <= max_dias_trabajo){
                              return true;
                            }else{
                              return  {
                                    valid: false,
                                    message: 'Asistencia debe ser menor o igual a d&iacute;as a trabajar'
                                }
                            }
                        }
                    }                   

                },

            }


        }
    })
    .formValidation('revalidateField', 'anno');

});


  $('.numeros').keypress(function(event){
    if ((event.keyCode < 48 || event.keyCode > 57) && event.keyCode != 44){
      event.preventDefault();
    } 
  })   

</script>
