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
									                  <div class="panel panel-primary">
									                    <div class="panel-header">
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
									                  <a href="<?php echo base_url();?>rrhh/carga_masiva_asistencia" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-upload"></span>&nbsp;&nbsp;Carga Masiva</a>
									                </div>


									            </div>

									            <div class="row">

									                <div class="col-md-12">
									                  <div class="box box-primary">

									                    <div class="box-header">
									                      <h3 class="box-title">Ingreso de Asistencia</h3>  
									                    </div><!-- /.box-header -->

											
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
											                                  <input type="text" name="diastrabajo_<?php echo $trabajador->id_personal;?>" id="diastrabajo_<?php echo $trabajador->id_personal;?>" class="diastrabajo" value="<?php echo isset($datos_remuneracion[$trabajador->id_personal]) ? $datos_remuneracion[$trabajador->id_personal] : $trabajador->diastrabajo - $licencias[$trabajador->id_personal]; ?>"  />   
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
																
															</div>
										                    <?php if(count($personal) > 0 ){ ?>
										                    <div class="box-footer">
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
        $('input').attr('readonly',true);
      }else{
        $('input').attr('readonly',false);
      }


       $(".diaslicencia").each(
                        function(index,value){
                            var id_text = $(this).attr('id');
                            var array_field = id_text.split("_");
                            idtrabajador = array_field[1];  
                            console.log(idtrabajador);
                             $.ajax({url: "<?php echo base_url();?>rrhh/get_datos_licencia/"+$('#mes').val()+"/"+$('#anno').val()+"/"+idtrabajador,
						        type: 'GET',
						        async: false,
						        success : function(data) {
	                         		console.log(idtrabajador + ' - ' + data);
	                             	var_json_lic = $.parseJSON(data);
	                             	console.log(var_json_lic);
	                             	console.log($('#diaslicencia_'+idtrabajador).html());
	                             	$('#diaslicencia_'+idtrabajador).html(var_json_lic['dias_licencia']);
						        }});
                        }
                        
                    );



      $.get("<?php echo base_url();?>rrhh/get_datos_remuneracion/"+$('#mes').val()+"/"+$('#anno').val(),function(data){
               // Limpiamos el select
                    var_json = $.parseJSON(data);
                   // console.log(var_json);
                    $(".diastrabajo").each(
                        function(index,value){
                            var id_text = $(this).attr('id');
                            var array_field = id_text.split("_");
                            idtrabajador = array_field[1];  

                            var diastrabajo =  typeof(var_json["diastrabajo_"+idtrabajador]) != 'undefined' && var_json["diastrabajo_"+idtrabajador] != null ? var_json["diastrabajo_"+idtrabajador] : parseInt($('#diasatrabajar_'+idtrabajador).html()) - parseInt($('#diaslicencia_'+idtrabajador).html());
                            $(this).val(diastrabajo);
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
            lectura: {
                // The children's full name are inputs with class .childFullName
                selector: '.diastrabajo',
                // The field is placed inside .col-xs-6 div instead of .form-group
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Informaci&oacute;n de Asistencia es requerida'
                    },
                    integer: {
                        separator: '.',
                        message: 'Asistencia s&oacute;lo puede contener n&uacute;meros'
                    },
                    callback: {
                        message: 'Asistencia debe ser menor o igual a d&iacute;as a trabajar',
                        callback: function (value, validator, $field) {
                            var id_text = $field.attr('id');
                            var array_field = id_text.split("_");
                            idtrabajador = array_field[1];
                            var asistencia_trabajador = $('#diasatrabajar_'+idtrabajador).html() == '' ? 0 : parseInt($('#diasatrabajar_'+idtrabajador).html());
                            var licencias_trabajador = $('#diaslicencia_'+idtrabajador).html() == '' ? 0 : parseInt($('#diaslicencia_'+idtrabajador).html());
                            var asistencia_actual = $('#diastrabajo_'+idtrabajador).val() == '' ? 0 : parseInt($('#diastrabajo_'+idtrabajador).val());                            
                            if(asistencia_actual <= (asistencia_trabajador - licencias_trabajador)){
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

            }
        }
    })
    .formValidation('revalidateField', 'anno');

});

</script>
