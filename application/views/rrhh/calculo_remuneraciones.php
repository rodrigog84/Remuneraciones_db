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
												<form id="basicBootstrapForm" action="<?php echo base_url();?>rrhh/submit_calculo_remuneraciones" id="basicBootstrapForm" method="post" > 
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
									                          <div class='col-md-6'>
																<div class="form-group" >
																	<label for="centro_costo">Centro de Costo</label>
																	<select  name="centro_costo[]" id="centro_costo" class="form-control periodo selectpicker" multiple="multiple" >
																	
																		<?php foreach ($centros_costo as $centro_costo) { ?>
	       																<?php $centrocostoselected = $centro_costo->id == $datos_form['idcentrocosto'] ? "selected" : ""; ?>
	        																<option value="<?php echo $centro_costo->id_centro_costo;?>" <?php echo $centrocostoselected;?> ><?php echo $centro_costo->nombre;?></option>
	        																<?php } ?>
																	</select>
																</div>
															  </div>
									                      </div>
									                      <div class="row">
									                      	<div class='col-md-3'>
									                      			<button type="submit" class="btn btn-primary">Calcular</button>&nbsp;&nbsp;
									                      	</div>
									                      </div>                    
									                    </div><!-- /.box-body -->
									                  </div>
									                </div>


									            </div>
									            </form>
											
														  <div class="graph">

														  	
															<div class="tables">
																<table class="table"> 
																	<thead> 
																		<tr>
																			<th>#</th>
																			<th>Per&iacute;odo</th> 
																			<th>Estado</th> 
																			<!--th>Acci&oacute;n</th--> 
																			<th>Ver Detalle Remunraciones</th> 
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
																			<!--td>
																					<?php if($periodo->estado == 'Informaci&oacute;n Completa' && is_null($periodo->cierre)){ ?>
																					<a href="<?php echo base_url(); ?>rrhh/submit_calculo_remuneraciones/<?php echo $periodo->id; ?>" data-toggle="tooltip" title="Calculo Remuneraciones" class="btn btn-block btn-xs btn-primary">Calcular</a>
																					<?php }else{ ?>
                            																&nbsp;
                         															<?php } ?>
																			</td-->
																			
																			<td>
																				<?php if($periodo->estado == 'Informaci&oacute;n Completa' && !is_null($periodo->cierre)){ ?>
                             														<center><a href="<?php echo base_url(); ?>rrhh/detalle/<?php echo $periodo->id_periodo; ?>" data-toggle="tooltip" title="Ver Per&iacute;odo"><span class="glyphicon glyphicon-search"></span></a></center>
                        														<?php }else{  ?>
                           															&nbsp;
                        														<?php } ?>
																			</td> 
																			<td>
																				<?php if($periodo->estado == 'Informaci&oacute;n Completa' && !is_null($periodo->cierre)){ ?>
                            															<a href="#" data-href="<?php echo base_url(); ?>rrhh/aprueba_remuneraciones/<?php echo $periodo->id_periodo; ?>" data-toggle="modal" data-target="#confirm-publish" title="Aprobar" class="btn btn-xs btn-success"><span class="fa fa-check"></span></a>
                            														<!--<a href="<?php echo base_url(); ?>rrhh/rechaza_remuneraciones/<?php echo $periodo->id_periodo; ?>" data-toggle="tooltip" title="Rechazar" class="btn btn-xs btn-danger"><span class="fa fa-times"></span></a>-->
                            														<a href="#" onclick="mostrar_modal(<?php echo $periodo->id_periodo;?>)"  title="Rechazar" class="btn btn-xs btn-danger"><span class="fa fa-check"></span></a>
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
									<!--/charts-inner-->

    <div class="modal fade" id="confirm-publish" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirmar Aprobaci&oacute;n</h4>
                </div>
            
                <div class="modal-body">
                    <p>Se traspasar&aacute; la informaci&oacute;n de remuneraciones.&nbsp;&nbsp;Una vez aprobado, no podr&aacute; reversar la transacci&oacute;n.</p>
                    <p>Desea continuar?</p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-success btn-ok">Aprobar</a>
                </div>
            </div>
        </div>
    </div>

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
								<!--<input type="text" name="id_periodo" value="fdfdffdsgtrsfdghtryh"> -->
								<select  name="centro_costo2[]" id="get_centro_costo" class="form-control selectpicker" multiple="multiple" style="width: 100px;" >
									<?php foreach ($centros_costo as $centro_costo) { ?>
	       							<?php $centrocostoselected = $centro_costo->id == $datos_form['idcentrocosto'] ? "selected" : ""; ?>
	        						<option value="<?php echo $centro_costo->id_centro_costo;?>" <?php echo $centrocostoselected;?> ><?php echo $centro_costo->nombre;?></option>
	        						<?php } ?>
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

        	
           //$(this).find('.btn-danger').attr('href', $(e.relatedTarget).data('href'));
           document.forms.f1.submit();
            
            
        });
    </script>
    <script>
    	function mostrar_modal(id_periodo_js){
         
        	document.forms.f1.id_periodo2.value=id_periodo_js;
        	$("#refuse-publish").modal();

                	
         
          } 
            
        ;
    </script>


<script>

$('.periodo').change(function(){
    $('#basicBootstrapForm').formValidation('revalidateField', 'anno');
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
        $('input').attr('readonly',true);
      }else{
        $('input').attr('readonly',false);
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



<!-- Initialize the plugin: -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#centro_costo').multiselect({
        	nonSelectedText: "No hay Selección",
        	allSelectedText: 'Todos'


        	});
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#get_centro_costo').multiselect({
        	nonSelectedText: "No hay Selección",
        	allSelectedText: 'Todos'
        });
    });
</script>