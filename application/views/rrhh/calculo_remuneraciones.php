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
												<form id="basicBootstrapForm" action="<?php echo base_url();?>rrhh/submit_calculo_remuneraciones" name="basicBootstrapForm" method="post" > 
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
									                                  <option value="1" <?php echo $mes_curso == 1 ? "selected" : ""; ?>>Enero</option>
									                                  <option value="2" <?php echo $mes_curso == 2 ? "selected" : ""; ?>>Febrero</option>
									                                  <option value="3" <?php echo $mes_curso == 3 ? "selected" : ""; ?>>Marzo</option>
									                                  <option value="4" <?php echo $mes_curso == 4 ? "selected" : ""; ?>>Abril</option>
									                                  <option value="5" <?php echo $mes_curso == 5 ? "selected" : ""; ?>>Mayo</option>
									                                  <option value="6" <?php echo $mes_curso == 6 ? "selected" : ""; ?>>Junio</option>
									                                  <option value="7" <?php echo $mes_curso == 7 ? "selected" : ""; ?>>Julio</option>
									                                  <option value="8" <?php echo $mes_curso == 8 ? "selected" : ""; ?>>Agosto</option>
									                                  <option value="9" <?php echo $mes_curso == 9 ? "selected" : ""; ?>>Septiembre</option>
									                                  <option value="10" <?php echo $mes_curso == 10 ? "selected" : ""; ?>>Octubre</option>
									                                  <option value="11" <?php echo $mes_curso == 11 ? "selected" : ""; ?>>Noviembre</option>
									                                  <option value="12" <?php echo $mes_curso == 12 ? "selected" : ""; ?>>Diciembre</option>
									                                </select>
									                            </div> 
									                          </div>
									                          <div class='col-md-6'>
									                            <div class="form-group">
									                                <label for="anno">A&ntilde;o</label>
									                                <select name="anno" id="anno" class="form-control periodo">
									                                  <?php for($i=(date('Y')-2);$i<=(date('Y')+2);$i++){ ?>
									                                  <?php $yearselected = $i == $anno_curso ? "selected" : ""; ?>
									                                  <option value="<?php echo $i;?>" <?php echo $yearselected; ?>><?php echo $i;?></option>
									                                  <?php } ?>
									                                </select>
									                            </div>
									                          </div> 
									                          <div class='col-md-6'>
																<div class="form-group" >
																	<label for="centro_costo">Centro de Costo</label>
																	<select  name="centro_costo[]" id="centro_costo" class="form-control selectpicker data-selected-text-format='count'" data-size="5" multiple="multiple" >
																		
																		<?php foreach ($centros_costo as $centro_costo) { ?>
	       																<?php $centrocostoselected = $centro_costo->id_centro_costo == $datos_form['idcentrocosto'] ? "selected" : ""; ?>
	        																<option value="<?php echo $centro_costo->id_centro_costo;?>" <?php echo $centrocostoselected;?> ><?php echo $centro_costo->nombre;?></option>
	        																<?php } ?>
																	</select>
																</div>
															  </div>
									                      </div>
									                      <div class="row">
									                      	<div class='col-md-3'>
									                      		  <?php if(count($mensajes) == 0){ ?>
									                      			<button name="button_submit" id="button_submit" type="button" class="btn btn-primary"  >Calcular</button>&nbsp;&nbsp;
									                      		  <?php  } ?>
									                      	</div>
									                      </div>                    
									                    </div><!-- /.box-body -->
									                  </div>
									                </div>


									            </div>
									            </form>

									            <?php if(count($mensajes) > 0){ ?>


														<div class="row">

												            <div class="col-md-12">
												              <div class="alert alert-danger fade in m-b-15">
												                <strong>Atenci&oacute;n!</strong>
												                Existe informaci&oacute;n pendiente que es requerida para calcular remuneraciones
												                <span class="close" data-dismiss="alert">&times;</span>
												              </div>

												                <div class="panel panel-inverse">
												                      <div class="panel-heading">
												                        <h4 class="panel-title">Listado de datos Pendientes</h4>                    
												                      </div><!-- /.box-header -->
												                      <!-- form start -->


												                        <div class="panel-body">
												       
												                              <div class='row'    >
												                                <div class='col-md-12'>
												                                          <div class="table-responsive">
												                      <table class="table" id="detallecarga">
												                        <thead>
												                          <tr>
												                            <th>#</th>
												                            <th>Mensaje</th>			
												                          </tr>
												                        </thead>
												                        <tbody>
												                          
												                          <?php
												                              $i = 1; 
												                              foreach ($mensajes as  $mensaje) { ?> 
												                              <tr>
												                                <td><?php echo $i; ?></td>
												                                <td><?php echo $mensaje; ?></td>
												                              </tr>

												                          <?php $i++;
												                                  } ?>
												                         
												                        </tbody>
												                      </table>
												                    </div>




												                                </div>  
												                              </div>   
												                              

												                                
												                        </div><!-- /.box-body -->  


												                    </div><!-- /.box -->


												            </div>

												        
												      </div>									            	


									            <?php } ?>

                            <div class="panel panel-inverse">                       
                                <div class="panel-heading">
                                      <h4 class="panel-title">Remuneraciones Calculadas</h4>
                                  </div>									            

											<div class="panel-body">
									             <div class='row'>

									            	<div class="graph-visual tables-main">
											
														  <div class="graph">

														  	
															<div class="tables">
																<table class="table"> 
																	<thead> 
																		<tr>
																			<th>#</th>
																			<th>Per&iacute;odo</th> 
																			<th>Estado</th>
																			<th>Centros de Costo Calculados</th> 
																			<!--th>Acci&oacute;n</th--> 
																			<th>Ver Detalle Remuneraciones</th> 
																			<th>Validar</th> 
																			

																		</tr> 
																	</thead> 
																	<tbody> 
                    												<?php if(count($periodos_remuneracion) > 0){ ?>	
                    													<?php $i = 1; ?>	
                      													<?php foreach($periodos_remuneracion as $periodo){ ?>
                      																												
																		<tr class="active" id="variable">
																			<td><?php echo $i;?></td>
																			<td><?php echo date2string($periodo->mes,$periodo->anno); ?></td> 
																			 <td><span class="<?php echo $periodo->estado == 'Informaci&oacute;n Completa' ? 'text-green' : 'text-red';?>" /><?php echo $periodo->estado; ?></span>&nbsp;&nbsp;
                        													<?php if($periodo->estado == 'Falta Informaci&oacute;n'){ ?><i class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-content="<?php echo $mensaje_html[$periodo->id];?>" title="Datos Pendientes:"></i><?php } ?>
                        													</td>
                        													<td><center><?php echo $periodo->ccostocalculados."/".$periodo->ccostoexistentes;?></center></td>
																			<!--td>
																					<?php if($periodo->estado == 'Informaci&oacute;n Completa' && is_null($periodo->cierre)){ ?>
																					<a href="<?php echo base_url(); ?>rrhh/submit_calculo_remuneraciones/<?php echo $periodo->id; ?>" data-toggle="tooltip" title="Calculo Remuneraciones" class="btn btn-block btn-xs btn-primary">Calcular</a>
																					<?php }else{ ?>
                            																&nbsp;
                         															<?php } ?>
																			</td-->
																			
																			<td>
																				<?php if($periodo->estado == 'Informaci&oacute;n Completa' ){ ?>
                             														<center><a href="<?php echo base_url(); ?>rrhh/detalle/<?php echo $periodo->id_periodo; ?>" data-toggle="tooltip" title="Ver Per&iacute;odo"><span class="glyphicon glyphicon-search"></span></a></center>
                        														<?php }else{  ?>
                           															&nbsp;
                        														<?php } ?>
																			</td> 
																			<td>
																				<?php if($periodo->estado == 'Informaci&oacute;n Completa'){ ?>
                            															<!--<a href="#" data-href="<?php echo base_url(); ?>rrhh/aprueba_remuneraciones/<?php echo $periodo->id_periodo; ?>" data-toggle="modal" data-target="#confirm-publish" title="Aprobar" class="btn btn-xs btn-success"><span class="fa fa-check"></span></a>-->

                            															<a href="#" onclick="mostrar_modal_return(<?php echo $periodo->id_periodo;?>)" title="Aprobar" class="btn btn-xs btn-success"><span class="fa fa-check"></span></a>



                            															<!--<a href="<?php echo base_url(); ?>rrhh/rechaza_remuneraciones/<?php echo $periodo->id_periodo; ?>" data-toggle="tooltip" title="Rechazar" class="btn btn-xs btn-danger"><span class="fa fa-times"></span></a>-->
                            															<a href="#" onclick="mostrar_modal(<?php echo $periodo->id_periodo;?>)"  title="Rechazar" class="btn btn-xs btn-danger"><span class="fa fa-times"></span></a>
                          														<?php }else{ ?>
                            															&nbsp;
                          														<?php } ?>																				

																			</td> 
																		</tr> 
																			<?php 
																				$i++;
																			} ?>
                    												<?php }else{ ?>
                    															<tr>
                      																<td colspan="6">No existen per&iacute;odos para C&aacute;lculo de Remuneraciones</td>
                    															</tr>
                    												<?php } ?>
																	</tbody> 
																</table> 
																
															</div>
												
													</div>
													
											</div>

										</div>
									</div>
								</div>
									<!--/charts-inner-->
<!-- MODAL DE APROBACIÓN DE REMUNERACIONES -->
    <div class="modal fade" id="confirm-publish" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirmar Aprobaci&oacute;n</h4>
                </div>
            
                <div class="modal-body">
                    <p>Se traspasar&aacute; la informaci&oacute;n de remuneraciones.&nbsp;&nbsp;Una vez aprobado, no podr&aacute; reversar la transacci&oacute;n.</p>
                    <form name="f3" action="<?php echo base_url();?>rrhh/aprueba_remuneraciones" id="f3" method="post">
                    <input type="hidden" name="id_periodo3" value="<?php echo $periodo->id_periodo; ?>">

                    <p>Desea continuar?</p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <a id="b3" class="btn btn-success btn-ok">Aprobar</a>
                </div>
            </div>
        </div>
    </div>
 <!-- MODAL DE VALIDACIÓN DE APROBACION DE REMUNERACIONES -->
 	<div class="modal fade" id="return-publish" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Atenci&oacute;n</h4>
                </div>
            
                <div class="modal-body">
                    
                    <p style="font-size:14px;">Se deben calcular todos los Centros de Costos para aprobar</p>
                    <div id="texto_modal"> </div>
                    <form name="f2" action="<?php echo base_url();?>rrhh/rechaza_remuneraciones" id="f2" method="post">
                    <input type="hidden" name="prueba" value="<?php echo $periodo->id_periodo; ?>">
                    </form>
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Volver</button>
                </div>
            </div>
        </div>
    </div>




<!-- MODAL DE RECHAZO DE REMUNERACIÓN POR CENTRO DE COSCO -->
    <div class="modal fade" id="refuse-publish" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Rechazar Remuneraci&oacute;n</h4>
                </div>
            
                <div class="modal-body">
                    <p>Seleccione Centro de Costo que desea rechazar</p>
                 										
								
                 				<form name="f1" action="<?php echo base_url();?>rrhh/rechaza_remuneraciones" id="f1" method="post">
                 				<input type="hidden" name="id_periodo2" value="<?php echo $periodo->id_periodo; ?>">
                 				<!--<input type="hidden" name="prueba" >-->
								<select  name="centro_costo2[]" id="centro_costo2" class="form-control selectpicker" multiple="multiple" style="width: 100px;" >
								</select><br><br>
								</form>
						
					
                <p>Desea continuar?</p>    
                </div>
                
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <a id="b1" class="btn btn-danger">Rechazar</a>
                </div>
            </div>
        </div>
    </div>




   <script type="text/javascript">
$(document).ready(function(){
    $('[data-toggle="popover"]').popover({
      trigger : 'hover',
    html: true,});   
});
</script>
<style type="text/css">
  .bs-example{
      margin: 300px 50px;
    }
</style>


<script>
        $('#confirm-publish').on('show.bs.modal', function(e) {

            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
        });
</script>


 <script>
        $('#b1').click(function(){  
        	var x =document.getElementById("centro_costo2").selectedIndex; 
        	if(x==-1){
        		bootbox.alert("Debe seleccionar un Centro de Costo");
        	}else{
        		document.forms.f1.submit();	
        	}
        });


        $('#b3').click(function(){  
        	
        		document.forms.f3.submit();	
        	}
        
        );


 </script>

<script>
	function mostrar_modal_return(id_periodo_aprobar){
		
		//document.forms.f2.prueba.value=id_periodo_aprobar;
		document.forms.f3.id_periodo3.value=id_periodo_aprobar;
		$.ajax({type: "GET",
		    		url: "<?php echo base_url();?>rrhh/centro_costo_pendiente/"+id_periodo_aprobar, 
		    		dataType: "json",
		    		success: function(centro_costo_pendiente){
		      			if(centro_costo_pendiente ==0){
		      				$("#confirm-publish").modal();

						}else{
							$.each(centro_costo_pendiente,function(id_centro_costo) {
		        			$('#texto_modal').text("Centro de costo pendiente: "+this.nombre+"");	        			
		     			});
						 	
						 	$("#return-publish").modal();
							}

		      		}
		     	}); 

		
	};




</script>





 <script>

    	function mostrar_modal(id_periodo_js){
			document.forms.f1.id_periodo2.value=id_periodo_js; 
			//document.forms.f1.prueba.value=document.getElementById("centro_costo2").selectedIndex;      	
        	$("#centro_costo2").html('')
        	$('#centro_costo2').multiselect('rebuild');
        	$.ajax({type: "GET",
		    		url: "<?php echo base_url();?>rrhh/centro_costo_periodo_abierto/"+id_periodo_js, 
		    		dataType: "json",
		    		success: function(centro_costo_periodo){
		      			$.each(centro_costo_periodo,function(id_centro_costo) {
		        			$("#centro_costo2").append('<option value='+this.id_centro_costo+'>'+this.nombre+'</option>');
		        			$('#centro_costo2').multiselect('rebuild');		        			
		     			});        
    				},
				    error: function(centro_costo_periodo) {
				      alert('error'+id_periodo_js);
				    }
				  });      	        	
        	$("#refuse-publish").modal();

          };

    </script>


<script>

$('.periodo').change(function(){
 
   $('#basicBootstrapForm').formValidation('revalidateField', 'anno');
      
     // var id_select = document.getElementById("centro_costo").selectedIndex; 
          var cerrado = false;
	      $("#centro_costo").html('');
	      $('#centro_costo').multiselect('rebuild');
	        	$.ajax({type: "GET",
			    		url: "<?php echo base_url();?>rrhh/centro_costo_no_calculado/"+$('#mes').val()+"/"+$('#anno').val(), 
			    		dataType: "json",
			    		success: function(centro_costo_no_calculado){
			      			$.each(centro_costo_no_calculado,function(id_centro_costo) {
			        			$("#centro_costo").append('<option value='+this.id_centro_costo+'>'+this.nombre+'</option>');
			        			$('#centro_costo').multiselect('rebuild');		        			
			     			});        
	    				}});

	      $.ajax({url: "<?php echo base_url();?>rrhh/get_status_rem/calculo/"+$('#mes').val()+"/"+$('#anno').val(),
	        type: 'GET',
	        async: false,
	        success : function(data) {
	            var_json = $.parseJSON(data);
	            $('#span_status').html(var_json["label_text"]);
	            $('#span_status').attr('class',"label "+var_json["label_style"]);     
	            cerrado = var_json["status"] == 'cerrado' ? true : false;
	        }});
	  
	      if(cerrado ){
			$('#button_submit').attr('disabled',true);
		  	$('input').attr('readonly',true);	

	      }else{
	        $('#button_submit').attr('disabled',false);
	        $('input').attr('readonly',false);
	      }      
});


       $('#button_submit').click(function(){  
        	var x =document.getElementById("centro_costo").selectedIndex; 
        	if(x==-1){
        		//alert("Debe seleccionar un Centro de Costo");
        		bootbox.alert("Debe seleccionar un Centro de Costo");
        	}else{
        		document.forms.basicBootstrapForm.submit();	
        	}
        });





$(document).ready(function() {

      var cerrado = false;
     
      $.ajax({url: "<?php echo base_url();?>rrhh/get_status_rem/calculo/"+$('#mes').val()+"/"+$('#anno').val(),
        type: 'GET',
        async: false,
        success : function(data) {
            var_json = $.parseJSON(data);
            $('#span_status').html(var_json["label_text"]);
            $('#span_status').attr('class',"label "+var_json["label_style"]);     
            cerrado = var_json["status"] == 'cerrado' ? true : false;
        }});
      
	      if(cerrado){
		  	$('#button_submit').attr('disabled',true);
		  	$('input').attr('readonly',true);	

	      }else{
	        $('#button_submit').attr('disabled',false);
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
            anno: {
                row: '.form-group',
                validators: {

                    remote: {
                        url: '<?php echo base_url();?>rrhh/estado_periodo/calculo',
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



<!-- Initialize the plugin: -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#centro_costo').multiselect({
        	nonSelectedText: "No hay Selección",
        	allSelectedText: 'Todos',
        	includeSelectAllOption: true,
        	selectAllText: 'Seleccionar Todo'
        	});

    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#centro_costo2').multiselect({
        	nonSelectedText: "No hay Selección",
        	allSelectedText: 'Todos',
        	includeSelectAllOption: true,
        	selectAllText: 'Seleccionar Todo'

        });
        
    });
</script>


