							  <!--//sub-heard-part-->

									<div class="graph-visual tables-main">
											
											<form id="basicBootstrapForm" action="<?php echo base_url();?>rrhh/submit_horas_extraordinarias" id="basicBootstrapForm" method="post"> 
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
									                  <!--a href="<?php echo base_url();?>rrhh/carga_masiva_horas_extras" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-upload"></span>&nbsp;&nbsp;Carga Masiva</a--> 

									                  <input type="hidden" name='dias_habiles' id='dias_habiles' value='<?php echo $dias_habiles;?>' >
									                  <input type="hidden" name='dias_inhabiles' id='dias_inhabiles' value='<?php echo $dias_inhabiles;?>' >
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

											                            <div class="col-md-7">
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
											                                              <label for="password">Horas 50%</label>    
											                                               <!--select name="productodetalle" id="productodetalle" class="form-control" >
											                                                <option value="">Seleccione Hora Bloque</option>
											                                                </select-->
											                                                <input type="text" name="general_horas50" id="general_horas50" class="form-control editables horas miles_decimales numeros horas_ingreso " onClick='this.select()'  placeholder="Ingrese Num Horas" disabled />
											                                        </div> 
											                                 
											                              </div>          

											                            <div class="col-md-2">
											                                        <div class="form-group">
											                                              <label for="password">Horas 100%</label>    
											                                               <!--select name="productodetalle" id="productodetalle" class="form-control" >
											                                                <option value="">Seleccione Hora Bloque</option>
											                                                </select-->
											                                                <input type="text" name="general_horas100" id="general_horas100" class="form-control editables horas miles_decimales numeros horas_ingreso" onClick='this.select()'  placeholder="Ingrese Num Horas" disabled />
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
							                                      <h4 class="panel-title">Ingreso de Horas Extraordinarias</h4>
							                                  </div>

											
														  <div class="graph">

														  	
															<div class="tables">
																<table class="table"> 
																	<thead> 
											                         <tr>
											                              <th rowspan="2"><small>#</small></th>
											                              <th rowspan="2" ><small>Rut</small></th>
											                              <th rowspan="2"><small>Nombre Trabajador</small></th>
											                              <!--th rowspan="2" ><small>Sueldo Base</small></th>
											                              <th rowspan="2" ><small>Valor por Hora ($)</small></th-->
											                              <th colspan="3" ><small>Horas al 50 %</small></th>
											                              <th colspan="3" ><small>Horas al 100 %</small></th>
											                            </tr>
											                            <tr>
											                              <th ><small>Valor Hora</small></th>
											                              <th ><small>Horas</small></th>
											                              <th ><small>Monto ($)</small></th>
											                              <th ><small>Valor Hora</small></th>
											                              <th ><small>Horas</small></th>
											                              <th ><small>Monto ($)</small></th>                              
											                             </tr>
																	</thead> 
											                          <tbody>
											                           <?php if(count($personal) > 0 ){ ?>
											                           		<?php// var_dump_new($personal); exit; ?>

											                              <?php $i = 1; ?>
											                              <?php $total_horas_50 = 0; ?>
											                              <?php $total_horas_100 = 0; ?>
											                              <?php //var_dump_new($personal); exit; ?>
											                              <?php foreach ($personal as $trabajador) { ?>

											                              <?php if($trabajador->tiporenta == 'Mensual'){ ?>
											                              	<?php $valorhora = $trabajador->parttime == 1 ? round((($trabajador->sueldobase)/$trabajador->diastrabajo)/$trabajador->horasdiarias,0) : round(((($trabajador->sueldobase)/30)*7)/$trabajador->horassemanales,0); ?>
											                              	<?php $valorhora50 = round($valorhora*1.5,0); ?>
											                              	<?php $valorhora100 = round($valorhora*2,0); ?>
											                              <?php }else if($trabajador->tiporenta == 'Diaria'){ ?>

											                              	<?php if($trabajador->semana_corrida == 'SI'){
											                              				//$semanacorrida = $trabajador->sueldobase;
											                              				$semanacorrida = round(($trabajador->sueldobase/$dias_habiles)*$dias_inhabiles,0);
											                              		  }else{
											                              		  		$semanacorrida = 0;
											                              		  }
											                              	?>

											                              	<?php //$semanacorrida = 0; ?>
											                              	<?php $valorhora = round(( (($trabajador->sueldobase*$trabajador->diastrabajosemanal) + $semanacorrida)/$trabajador->horassemanales),0); ?>
											                              	<?php $valorhora50 = round($valorhora*1.5,0); ?>
											                              	<?php $valorhora100 = round($valorhora*2,0); ?>

											                              <?php } ?>
											                               <tr >
											                                <td><small><?php echo $i ;?></small></td>
											                                <td><small><?php echo $trabajador->rut == '' ? '' : number_format($trabajador->rut,0,".",".")."-".$trabajador->dv;?></small></td>
											                                <td><small><?php echo $trabajador->nombre." ".$trabajador->apaterno." ".$trabajador->amaterno;?></small></td>
											                                <!--td><small><?php echo number_format($trabajador->sueldobase,0,".",".");?></small></td-->
											                                <!--td>
											                                  <span id="spanvalorhora_<?php echo $trabajador->id_personal;?>"  class="text-right input-sm" ><?php echo number_format($valorhora,0,",",".");?></span> 

											                                </td-->
											                                  <input type="hidden" name="semanacorrida_<?php echo $trabajador->id_personal;?>" id="semanacorrida_<?php echo $trabajador->id_personal;?>" class="form-control" value="<?php echo $trabajador->semana_corrida; ?>"  />
											                                  <input type="hidden" name="tiporenta_<?php echo $trabajador->id_personal;?>" id="tiporenta_<?php echo $trabajador->id_personal;?>" class="form-control" value="<?php echo $trabajador->tiporenta; ?>"  />
											                                  <input type="hidden" name="sueldobase_<?php echo $trabajador->id_personal;?>" id="sueldobase_<?php echo $trabajador->id_personal;?>" class="form-control" value="<?php echo $trabajador->sueldobase; ?>"  />
											                                  <input type="hidden" name="diastrabajosemanal_<?php echo $trabajador->id_personal;?>" id="diastrabajosemanal_<?php echo $trabajador->id_personal;?>" class="form-control" value="<?php echo $trabajador->diastrabajosemanal; ?>"  />
											                                  <input type="hidden" name="horassemanales_<?php echo $trabajador->id_personal;?>" id="horassemanales_<?php echo $trabajador->id_personal;?>" class="form-control" value="<?php echo $trabajador->horassemanales; ?>"  />
											                                  <input type="hidden" name="valorhora_<?php echo $trabajador->id_personal;?>" id="valorhora_<?php echo $trabajador->id_personal;?>" class="form-control" value="<?php echo round($valorhora,0); ?>"  />
											                                  <input type="hidden" name="montoactualmensual_<?php echo $trabajador->id_personal;?>" id="montoactualmensual_<?php echo $trabajador->id_personal;?>" class="form-control" value="<?php echo $valorhora; ?>"  />                                
											                                  <input type="hidden" name="montoactual_<?php echo $trabajador->id_personal;?>" id="montoactual_<?php echo $trabajador->id_personal;?>" class="form-control" value="<?php echo $valorhora; ?>"  />                                
											                                <td>
											                                  <span id="spanvalorhora50_<?php echo $trabajador->id_personal;?>"  class="text-right input-sm" ><?php echo number_format($valorhora50,0,",",".");?></span> 
											                                  <input type="hidden" name="montoactual50_<?php echo $trabajador->id_personal;?>" id="montoactual50_<?php echo $trabajador->id_personal;?>" class="form-control" value="<?php echo $valorhora50; ?>"  />
											                                </td>                                
											                                <td class="form-group">
											                                    <input type="text" name="horas50_<?php echo $trabajador->id_personal;?>" id="horas50_<?php echo $trabajador->id_personal;?>" class="horas50 horas miles_decimales numeros input-sm editables" value="<?php echo isset($datos_remuneracion['horasextras50'][$trabajador->id_personal]) ? str_replace(".",",",$datos_remuneracion['horasextras50'][$trabajador->id_personal]) : 0; ?>"  />   
											                                </td>
											                                <td class="form-group">
											                                  <input type="hidden" name="monto50_<?php echo $trabajador->id_personal;?>" class="monto50" id="monto50_<?php echo $trabajador->id_personal;?>" value="<?php echo isset($datos_remuneracion['horasextras50'][$trabajador->id_personal]) ? $datos_remuneracion['horasextras50'][$trabajador->id_personal]*$valorhora50 : 0; ?>"  />   
											                                  <b><span id="spanmonto50_<?php echo $trabajador->id_personal;?>"  class="text-right input-sm" ><?php echo isset($datos_remuneracion['horasextras50'][$trabajador->id_personal]) ? number_format($datos_remuneracion['horasextras50'][$trabajador->id_personal]*$valorhora50,0,".",".") : 0;?></span></b>   
											                                </td>
											                                <td>
											                                  <span id="spanvalorhora100_<?php echo $trabajador->id_personal;?>"  class="text-right input-sm" ><?php echo number_format($valorhora100,0,",",".");?></span> 
											                                  <input type="hidden" name="montoactual100_<?php echo $trabajador->id_personal;?>" id="montoactual100_<?php echo $trabajador->id_personal;?>" class="form-control" value="<?php echo $valorhora100; ?>"  />
											                                </td>                                                                
											                                <td class="form-group">
											                                    <input type="text" name="horas100_<?php echo $trabajador->id_personal;?>" id="horas100_<?php echo $trabajador->id_personal;?>" class="horas100 horas miles_decimales numeros input-sm editables" value="<?php echo isset($datos_remuneracion['horasextras100'][$trabajador->id_personal]) ? str_replace(".",",",$datos_remuneracion['horasextras100'][$trabajador->id_personal]) : 0; ?>"  />   
											                                </td>
											                                <td class="form-group">
											                                  <input type="hidden" name="monto100_<?php echo $trabajador->id_personal;?>" class="monto100" id="monto100_<?php echo $trabajador->id_personal;?>" value="<?php echo isset($datos_remuneracion['horasextras100'][$trabajador->id_personal]) ? $datos_remuneracion['horasextras100'][$trabajador->id_personal]*$valorhora100 : 0; ?>"  />   
											                                  <b><span id="spanmonto100_<?php echo $trabajador->id_personal;?>"  class="text-right input-sm" ><?php echo isset($datos_remuneracion['horasextras100'][$trabajador->id_personal]) ? number_format($datos_remuneracion['horasextras100'][$trabajador->id_personal]*$valorhora100,0,".",".") : 0;?></span></b>   
											                                </td>                                
											                              </tr>
											                              <?php $i++;?>
											                              <?php $total_horas_50 += isset($datos_remuneracion['horasextras50'][$trabajador->id_personal]) ? $datos_remuneracion['horasextras50'][$trabajador->id_personal]*$valorhora50 : 0; ?>
											                              <?php $total_horas_100 += isset($datos_remuneracion['horasextras100'][$trabajador->id_personal]) ? $datos_remuneracion['horasextras100'][$trabajador->id_personal]*$valorhora100 : 0; ?>
											                              <?php } ?>
											                            <?php }else{ ?>
											                            <tr>
											                              <td colspan="11">No existen trabajadores en la comunidad</td>
											                            </tr>
											                          <?php } ?>
											                          </tbody>
																		<?php if(count($personal) > 0 ){ ?>
												                            <tfoot>
												                              <tr>
												                                <th colspan="3">Totales</th>
												                                <th>&nbsp;</th>
												                                <!--th>&nbsp;</th>
												                                <th>&nbsp;</th-->
												                                <th>&nbsp;</th>
												                                <th><span id="total_horas_50" class="input-sm"><?php echo number_format($total_horas_50,0,".","."); ?></span></th>
												                                <th>&nbsp;</th>
												                                <th>&nbsp;</th>
												                                <th ><span id="total_horas_100" class="input-sm"><?php echo number_format($total_horas_100,0,".","."); ?></span></th>
												                              </tr>
												                            </tfoot> 
												                          <?php } ?>											                          
																</table> 
																
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

$('.periodo').change(function(){
    $('#basicBootstrapForm').formValidation('revalidateField', 'anno');
      var cerrado = false;
      $.ajax({url: "<?php echo base_url();?>rrhh/get_status_rem/horas_extraordinarias/"+$('#mes').val()+"/"+$('#anno').val(),
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


      $.ajax({url: "<?php echo base_url();?>rrhh/get_dias_habiles_periodo/"+$('#mes').val()+"/"+$('#anno').val(),
        type: 'GET',
        async: false,
        success : function(data) {
                  var_json = $.parseJSON(data);
                  $('#dias_habiles').val(var_json["dias_habiles"]);       
                  $('#dias_inhabiles').val(var_json["dias_inhabiles"]);    
        }});
    

      $.get("<?php echo base_url();?>rrhh/get_datos_remuneracion/"+$('#mes').val()+"/"+$('#anno').val(),function(data){
               // Limpiamos el select
               		//console.log(data)
                   var_json = $.parseJSON(data);
                      var total_horas_50 = 0;
                      var total_horas_100 = 0;
                      $(".horas50").each(
                          function(index,value){


                              var id_text = $(this).attr('id');
                              var array_field = id_text.split("_");
                              idtrabajador = array_field[1]; 

                              var horasextras50 =  typeof(var_json["horasextras50_"+idtrabajador]) != 'undefined' &&  var_json["horasextras50_"+idtrabajador] != null ? var_json["horasextras50_"+idtrabajador] : 0;
                              var horasextras100 =  typeof(var_json["horasextras100_"+idtrabajador]) != 'undefined' &&  var_json["horasextras100_"+idtrabajador] != null ? var_json["horasextras100_"+idtrabajador] : 0;
                              if(cerrado){
                                var valorhora =  typeof(var_json["valorhora_"+idtrabajador]) != 'undefined' &&  var_json["valorhora_"+idtrabajador] != null ? var_json["valorhora_"+idtrabajador] : 0;
                                var valorhora50 =  typeof(var_json["valorhorasextras50_"+idtrabajador]) != 'undefined' &&  var_json["valorhorasextras50_"+idtrabajador] != null ? var_json["valorhorasextras50_"+idtrabajador] : 0;
                                var valorhora100 =  typeof(var_json["valorhorasextras100_"+idtrabajador]) != 'undefined' &&  var_json["valorhorasextras100_"+idtrabajador] != null ? var_json["valorhorasextras100_"+idtrabajador] : 0;
                                var montohorasextras50 =  typeof(var_json["montohorasextras50_"+idtrabajador]) != 'undefined' && var_json["montohorasextras50_"+idtrabajador] != null ? var_json["montohorasextras50_"+idtrabajador] : 0;
                                var montohorasextras100 =  typeof(var_json["montohorasextras100_"+idtrabajador]) != 'undefined' && var_json["montohorasextras100_"+idtrabajador] != null ? var_json["montohorasextras100_"+idtrabajador] : 0;

                              }else{

                              	if($('#tiporenta_'+idtrabajador).val() == 'Mensual'){
                              		$('#montoactual_'+idtrabajador).val($('#montoactualmensual_'+idtrabajador).val());
                              		montoactual = $('#montoactualmensual_'+idtrabajador).val();
                              	}else if($('#tiporenta_'+idtrabajador).val() == 'Diaria'){
                              		var sueldobase = parseInt($('#sueldobase_'+idtrabajador).val());
                              		var diastrabajosemanal = parseInt($('#diastrabajosemanal_'+idtrabajador).val());
                              		var horassemanales = parseInt($('#horassemanales_'+idtrabajador).val());

                              		if($('#semanacorrida_'+idtrabajador).val() == 'SI'){
                              			var dias_habiles = parseInt($('#dias_habiles').val());
                              			var dias_inhabiles = parseInt($('#dias_inhabiles').val());
                              			
                              			var semanacorrida = parseInt(Math.round((sueldobase/dias_habiles)*dias_inhabiles));
                              		}else{
                              			var semanacorrida = 0;
                              		}

                              		montoactual = parseInt(Math.round(((sueldobase*diastrabajosemanal) + semanacorrida)/horassemanales));
                              		/*console.log(sueldobase)
                              		console.log(dias_habiles)
                              		console.log(dias_inhabiles)
                              		console.log(diastrabajosemanal)
                              		console.log($('#semanacorrida_'+idtrabajador).val());
                              		
                              		console.log(semanacorrida)
                              		console.log(horassemanales)
                              		console.log(montoactual)
                              		console.log('---------------------')*/
	                              	$('#montoactual_'+idtrabajador).val(montoactual);	

                              	}

                                var valorhora =  montoactual;
                                var valorhora50 = parseInt(valorhora*1.5);
                                var valorhora100 =  parseInt(valorhora*2);

                                var montohorasextras50 = horasextras50*valorhora50;
                                var montohorasextras100 = horasextras100*valorhora100;


                              }

                              $('#spanvalorhora_'+idtrabajador).html(number_format(valorhora,0,'.','.'));
                              $('#valorhora_'+idtrabajador).val(valorhora);
                              $('#spanvalorhora50_'+idtrabajador).html(number_format(valorhora50,0,'.','.'));
                              $('#valorhora50_'+idtrabajador).val(valorhora50);
                              $('#spanvalorhora100_'+idtrabajador).html(number_format(valorhora100,0,'.','.'));
                              $('#valorhora100_'+idtrabajador).val(valorhora100);

                              horasextras50 = replaceAll(horasextras50,'.',',')
                              horasextras100 = replaceAll(horasextras100,'.',',')
                              $('#horas50_'+idtrabajador).val(horasextras50);
                              $('#monto50_'+idtrabajador).val(montohorasextras50);
                              $('#spanmonto50_'+idtrabajador).html(number_format(montohorasextras50,0,'.','.'));
                              $('#horas100_'+idtrabajador).val(horasextras100);
                              $('#monto100_'+idtrabajador).val(montohorasextras100);
                              $('#spanmonto100_'+idtrabajador).html(number_format(montohorasextras100,0,'.','.'));                            




                              total_horas_50 += parseFloat(montohorasextras50);
                              total_horas_100 += parseFloat(montohorasextras100);
                          }
                          
                      );  
                      $('#total_horas_50').html(number_format(total_horas_50,0,'.','.')); 
                      $('#total_horas_100').html(number_format(total_horas_100,0,'.','.'));                                    
      });
      

 
});


$(document).ready(function() {

      var cerrado = false;
      $.ajax({url: "<?php echo base_url();?>rrhh/get_status_rem/horas_extraordinarias/"+$('#mes').val()+"/"+$('#anno').val(),
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

 		$.get("<?php echo base_url();?>rrhh/get_datos_remuneracion/"+$('#mes').val()+"/"+$('#anno').val(),function(data){
                 // Limpiamos el select
                      var_json = $.parseJSON(data);
                      var total_horas_50 = 0;
                      var total_horas_100 = 0;
                      $(".horas50").each(
                          function(index,value){
                              var id_text = $(this).attr('id');
                              var array_field = id_text.split("_");
                              idtrabajador = array_field[1]; 


                              var horasextras50 =  typeof(var_json["horasextras50_"+idtrabajador]) != 'undefined' &&  var_json["horasextras50_"+idtrabajador] != null ? var_json["horasextras50_"+idtrabajador] : 0;
                              var horasextras100 =  typeof(var_json["horasextras100_"+idtrabajador]) != 'undefined' &&  var_json["horasextras100_"+idtrabajador] != null ? var_json["horasextras100_"+idtrabajador] : 0;
                              if(cerrado){
                                var valorhora =  typeof(var_json["valorhora_"+idtrabajador]) != 'undefined' &&  var_json["valorhora_"+idtrabajador] != null ? var_json["valorhora_"+idtrabajador] : 0;
                                var valorhora50 =  typeof(var_json["valorhorasextras50_"+idtrabajador]) != 'undefined' &&  var_json["valorhorasextras50_"+idtrabajador] != null ? var_json["valorhorasextras50_"+idtrabajador] : 0;
                                var valorhora100 =  typeof(var_json["valorhorasextras100_"+idtrabajador]) != 'undefined' &&  var_json["valorhorasextras100_"+idtrabajador] != null ? var_json["valorhorasextras100_"+idtrabajador] : 0;
                                var montohorasextras50 =  typeof(var_json["montohorasextras50_"+idtrabajador]) != 'undefined' && var_json["montohorasextras50_"+idtrabajador] != null ? var_json["montohorasextras50_"+idtrabajador] : 0;
                                var montohorasextras100 =  typeof(var_json["montohorasextras100_"+idtrabajador]) != 'undefined' && var_json["montohorasextras100_"+idtrabajador] != null ? var_json["montohorasextras100_"+idtrabajador] : 0;

                              }else{
                                var valorhora =  $('#montoactual_'+idtrabajador).val();
                                var valorhora50 =  $('#montoactual50_'+idtrabajador).val();
                                var valorhora100 =  $('#montoactual100_'+idtrabajador).val();

                                var montohorasextras50 = horasextras50*valorhora50;
                                var montohorasextras100 = horasextras100*valorhora100;
                              }

                              $('#spanvalorhora_'+idtrabajador).html(number_format(valorhora,0,'.','.'));
                              $('#valorhora_'+idtrabajador).val(valorhora);
                              $('#spanvalorhora50_'+idtrabajador).html(number_format(valorhora50,0,'.','.'));
                              $('#valorhora50_'+idtrabajador).val(valorhora50);
                              $('#spanvalorhora100_'+idtrabajador).html(number_format(valorhora100,0,'.','.'));
                              $('#valorhora100_'+idtrabajador).val(valorhora100);

                              horasextras50 = replaceAll(horasextras50,'.',',')
                              horasextras100 = replaceAll(horasextras100,'.',',')

                              $('#horas50_'+idtrabajador).val(horasextras50);
                              $('#monto50_'+idtrabajador).val(montohorasextras50);
                              $('#spanmonto50_'+idtrabajador).html(number_format(montohorasextras50,0,'.','.'));
                              $('#horas100_'+idtrabajador).val(horasextras100);
                              $('#monto100_'+idtrabajador).val(montohorasextras100);
                              $('#spanmonto100_'+idtrabajador).html(number_format(montohorasextras100,0,'.','.'));                            




                              total_horas_50 += parseFloat(montohorasextras50);
                              total_horas_100 += parseFloat(montohorasextras100);
                          }
                          
                      );  
                      $('#total_horas_50').html(number_format(total_horas_50,0,'.','.')); 
                      $('#total_horas_100').html(number_format(total_horas_100,0,'.','.'));                   
        });        
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
                selector: '.horas',
                // The field is placed inside .col-xs-6 div instead of .form-group
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Informaci&oacute;n de Horas Extraordinarias es requerida'
                    },
                    numeric: {
                        separator: ',',
                        message: 'Horas extraordinarias s&oacute;lo puede contener n&uacute;meros'
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



$('#add_info_trabajador').on('click',function(){

	add_info_trabajador();

})

function add_info_trabajador(){

	var idtrabajador = $('#idtrabajador').val();
	var horas50 = $('#general_horas50').val();
	var horas100 = $('#general_horas100').val();
	$('#horas50_'+idtrabajador).val(horas50);
	$('#horas100_'+idtrabajador).val(horas100);

	$('#horas50_' + idtrabajador).trigger('input');
	$('#horas100_' + idtrabajador).trigger('input');

	$('#trabajador').val('')
	$('#general_horas50').val('');
	$('#general_horas100').val('');
	$('#idtrabajador').val(0)
	$('.horas_ingreso').attr('disabled',true);

}


$('#trabajador').keypress(function(event){
  var keycode = (event.keyCode ? event.keyCode : event.which);

  if(keycode == '13'){
    event.preventDefault();
    $('#general_horas50').focus();
  }
});

$('#general_horas50').keypress(function(event){
  var keycode = (event.keyCode ? event.keyCode : event.which);

  if(keycode == '13'){
    event.preventDefault();
    $('#general_horas100').focus();
  }
});


$('#general_horas100').keypress(function(event){
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


		$('#general_horas50').focus();
		$('#general_horas50').val($('#horas50_'+item_sel).val())
		$('#general_horas100').val($('#horas100_'+item_sel).val())


		$('#idtrabajador').val(item_sel);
		$('.horas_ingreso').attr('disabled',false);
		//console.log('aaaa')
	}




  function replaceAll( text, busca, reemplaza ){
  while (text.toString().indexOf(busca) != -1)
      text = text.toString().replace(busca,reemplaza);
  return text;
}

$(".horas50").on('input',function(event){
    var id_text =  $(this).attr('id');
    var array_field = id_text.split("_");
    idtrabajador = array_field[1];
    var horas50 = $('#horas50_'+idtrabajador).val() == '' ? 0 : $('#horas50_'+idtrabajador).val();
    var m_hora50 = Math.round(parseFloat($('#valorhora_'+idtrabajador).val())*1.5,0);

    var valor50 = parseFloat(replaceAll(horas50,',','.'))*m_hora50;

    $('#spanmonto50_'+idtrabajador).html(number_format(valor50,0,'.','.')); 
    $('#monto50_'+idtrabajador).val(number_format(valor50,0,'.','.')); 


    // SUMA DE HORAS 50
    var total_horas_50 = 0;
    $(".monto50").each(
        function(index,value){
          total_horas_50 += parseFloat(replaceAll($(this).val(),'.',''));
        }
        
    );   
    $('#total_horas_50').html(number_format(total_horas_50,0,'.','.')); 

});   


$(".horas100").on('input',function(event){
    var id_text =  $(this).attr('id');
    var array_field = id_text.split("_");
    idtrabajador = array_field[1];
    var horas100 = $('#horas100_'+idtrabajador).val() == '' ? 0 : $('#horas100_'+idtrabajador).val();
    var m_hora100 = Math.round(parseFloat($('#valorhora_'+idtrabajador).val())*2,0);
    var valor100 = parseFloat(replaceAll(horas100,',','.'))*m_hora100;
    $('#spanmonto100_'+idtrabajador).html(number_format(valor100,0,'.','.')); 
    $('#monto100_'+idtrabajador).val(number_format(valor100,0,'.','.')); 

    // SUMA DE HORAS 100
    var total_horas_100 = 0;
    $(".monto100").each(
        function(index,value){
          total_horas_100 += parseFloat(replaceAll($(this).val(),'.',''));
        }
        
    );  
    $('#total_horas_100').html(number_format(total_horas_100,0,'.','.'));   

});   



/*$(document).ready(function(){
 $('.miles_decimales').mask('#.##0,00', {reverse: true})        

});*/

  $('.numeros').keypress(function(event){
    if ((event.keyCode < 48 || event.keyCode > 57) && event.keyCode != 44){
      event.preventDefault();
    } 
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
        /*setTimeout(redirige, 1500);
        function redirige(){
            location.href = '<?php //echo base_url();?>welcome/dashboard';
        }*/
        <?php } ?>


    });
</script>   