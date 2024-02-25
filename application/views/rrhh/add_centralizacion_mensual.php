<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   <ol class="breadcrumb m-b-0">
											<li><a href="inicio.html">Inicio</a></li>
											<li class="active">Centralizar</li>
											
										</ol>
									   </div>
								  <!--//sub-heard-part-->

									<div class="graph-visual tables-main">
											
									        <?php if(isset($message)): ?>
									         <!--div class="row">
									            <div class="col-md-12">
									                      <div class="alert alert-<?php echo $classmessage; ?> alert-dismissable">
									                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									                        <h4><i class="icon fa <?php echo $icon;?>"></i> Alerta!</h4>
									                        <?php echo $message;?>
									                      </div>
									            </div>            
									          </div-->
									          <?php endif; ?>
												<form id="basicBootstrapForm" action="<?php echo base_url();?>rrhh/submit_centralizacion_mensual" name="basicBootstrapForm" method="post" > 
									            <div class="row">

									                <div class="col-md-6">
									                  <div class="panel panel-inverse">
									                    <div class="panel-heading">
									                      <h3 class="panel-title">Per&iacute;odo&nbsp;&nbsp;</h3>
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
									                      </div>
									                      <div class="row">
									                      	<div class='col-md-3'>
									                      		  <?php if(count($mensajes) == 0){ ?>
									                      			<button name="button_submit" id="button_submit" type="submit" class="btn btn-primary"  >Centralizar</button>&nbsp;&nbsp;
									                      		  <?php  } ?>
									                      	</div>
									                      	<div class='col-md-3'>
									                      		  <a href="<?php echo base_url().'rrhh/centralizacion_mensual' ?>" class="btn btn-success">Volver</a>
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
												                Existen configuraciones pendientes que son requeridas para calcular la centralizaci&oacute;n mensual
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


									            <?php if(count($array_asiento_contable['DEBE']) > 0 || count($array_asiento_contable['HABER']) > 0 ){ ?>


														<div class="row">

												            <div class="col-md-12">
												              <div class="alert alert-info fade in m-b-15">
												                <strong>Atenci&oacute;n!</strong>
												                Este asiento a&uacute;n no es v&aacute;lido.  Es necesario confirmar para generarlo correctamente
												                <span class="close" data-dismiss="alert">&times;</span>
												              </div>

												                <div class="panel panel-inverse">
												                      <div class="panel-heading">
												                        <h4 class="panel-title">Asiento Contable</h4>                    
												                      </div><!-- /.box-header -->
												                      <!-- form start -->


												                        <div class="panel-body">
												       
												                              <div class='row'    >
												                                <div class='col-md-12'>
												                                          <div class="table-responsive">
												                      <table class="table" id="detallecarga">
												                        <thead>
												                          <tr>
												                            <th colspan='2'>Debe</th>
												                            <th colspan='2'>Haber</th>			
												                          </tr>
												                        </thead>
												                        <tbody>
												                          
												                          <?php
												                          	  $count_debe = count($array_asiento_contable['DEBE']);
																			  $count_haber = count($array_asiento_contable['HABER']);

																			  $cantidad_registros = 0;
																			  if($count_debe >= $count_haber){
																			  	$cantidad_registros = $count_debe;
																			  }else{
																			  	$cantidad_registros = $count_haber;
																			  }


												                              $i = 0;
												                              $total_debe = 0;
												                              $total_haber = 0;
												                              while($i <= $cantidad_registros){
													                              $debe = false;
													                              $haber = false;
													                              if(isset($array_asiento_contable['DEBE'][$i])){
													                              	$debe = true;
													                              }
													                              if(isset($array_asiento_contable['HABER'][$i])){
													                              	$haber = true;
													                              }												 

													                              if($debe || $haber){ ?>
													                              	<tr>
													                              <?php } ?>

													                              <?php if($debe){ ?>
													                              		<td><?php echo $array_asiento_contable['DEBE'][$i]['nomcuentacontable'];?></td>
													                              		<td align ="right"><?php echo '$ ' . number_format($array_asiento_contable['DEBE'][$i]['monto'],0,'.','.');?></td>

													                              		<?php $total_debe += $array_asiento_contable['DEBE'][$i]['monto']; ?>
													                              <?php }else{ ?>

													                              		<td colspan='2'></td>
													                              <?php } ?>

													                              <?php if($haber){ ?>
														                              		<td><?php echo $array_asiento_contable['HABER'][$i]['nomcuentacontable'];?></td>
														                              		<td align ="right"><?php echo '$ ' . number_format($array_asiento_contable['HABER'][$i]['monto'],0,'.','.');?></td>
														                              		<?php $total_haber += $array_asiento_contable['HABER'][$i]['monto']; ?>
														                              <?php }else{ ?>

														                              		<td colspan='2'></td>
														                              <?php } ?>
													                             <?php if($debe || $haber){ ?>
													                              	</tr>
													                              <?php } ?>

													                          	  <?php $i++; ?>
													                          <?php } ?>
												                         
												                        </tbody>
												                        <tfooter>
												                        	<tr>
												                            <th>Total Debe</th>
												                            <td align="right"><b>$&nbsp;<?php echo number_format($total_debe,0,'.','.');?></b></th>
												                            <th >Total Haber</th>	
												                            <td align ="right"><b>$&nbsp;<?php echo number_format($total_haber,0,'.','.');?></b></th>		
												                          </tr>
												                        </tfooter>
												                      </table>
												                    </div>




												                                </div>  
												                              </div>   
												                              


												                                
												                        </div><!-- /.box-body -->  
												                        <div class="panel-footer">
												                         <input type='hidden' name='asiento' id='asiento' value='<?php echo json_encode($array_asiento_contable);?>' >
												                         <input type='hidden' name='mes_asiento' id='mes_asiento' value='<?php echo $mes_curso;?>' >
												                         <input type='hidden' name='anno_asiento' id='anno_asiento' value='<?php echo $anno_curso;?>' >
													                      <button name="button_confirmar" id="button_confirmar" type="button" class="btn btn-warning"  >Confirmar</button>&nbsp;&nbsp;
													                    </div><!-- /.box-header -->


												                    </div><!-- /.box -->


												            </div>

												        
												      </div>									            	


									            <?php } ?>


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

	$('#button_confirmar').on('click',function(){


          Swal.fire({
              title: 'Está Seguro(a) que desea generar el asiento contable con esta informaci&oacute;n?',
              text: '',
            // footer: '<a href="#">Why do I have this issue?</a>',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",              
              confirmButtonText: 'Aceptar'
            }).then((result) => {

              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {

              		data = $('#asiento').val()
              		mes_asiento = $('#mes_asiento').val()
              		anno_asiento = $('#anno_asiento').val()
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url();?>rrhh/crea_asiento_centralizacion/',
                        dataType: 'json',
                        data : {
                                "data": data,
                                "mes": mes_asiento,
                                "anno": anno_asiento,
                              },
                        async: false,
                    }).success(function(data) {
                    		console.log('asasasas')
                        
                    });              	

              			location.href='<?php echo base_url(); ?>/rrhh/centralizacion_mensual'
              }

          });



	})



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

$('.periodo').change(function(){
 
   $('#basicBootstrapForm').formValidation('revalidateField', 'anno');
      
     // var id_select = document.getElementById("centro_costo").selectedIndex; 
          var aprobado = false;

	      $.ajax({url: "<?php echo base_url();?>rrhh/get_status_rem/centralizacion/"+$('#mes').val()+"/"+$('#anno').val(),
	        type: 'GET',
	        async: false,
	        success : function(data) {
	        	console.log(data)
	            var_json = $.parseJSON(data);
	            $('#span_status').html(var_json["label_text"]);
	            $('#span_status').attr('class',"label "+var_json["label_style"]);     
	            aprobado = var_json["status"] == 'aprobado' ? true : false;
	        }});
	  
	      if(aprobado){
	        $('#button_submit').attr('disabled',false);
	        $('input').attr('readonly',false);
	      }else{
		  	$('#button_submit').attr('disabled',true);
		  	$('input').attr('readonly',true);	

	      }         
});





$(document).ready(function() {

      var aprobado = false;
     
      $.ajax({url: "<?php echo base_url();?>rrhh/get_status_rem/centralizacion/"+$('#mes').val()+"/"+$('#anno').val(),
        type: 'GET',
        async: false,
        success : function(data) {
            var_json = $.parseJSON(data);
            $('#span_status').html(var_json["label_text"]);
            $('#span_status').attr('class',"label "+var_json["label_style"]);     
            aprobado = var_json["status"] == 'aprobado' ? true : false;
        }});
      
	      if(aprobado){
	        $('#button_submit').attr('disabled',false);
	        $('input').attr('readonly',false);
	      }else{
		  	$('#button_submit').attr('disabled',true);
		  	$('input').attr('readonly',true);	

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
                        url: '<?php echo base_url();?>rrhh/estado_periodo/centralizacion',
                        // Send { email: 'its value', username: 'its value' } to the back-end
                        data: function(validator, $field, value) {
                            return {
                                mes: $('#mes').val()
                            };
                        },
                        message: 'Per&iacute;odo no valido para calculo de centralizacion',
                        type: 'POST'
                    }
                },

            }
        }
    })
    .formValidation('revalidateField', 'anno');

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