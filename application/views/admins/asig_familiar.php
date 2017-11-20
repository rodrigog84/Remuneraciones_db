								<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   <ol class="breadcrumb m-b-0">
											<li><a href="inicio.html">Inicio</a></li>
											<li class="active">Asignación Familiar</li>
											
										</ol>
									   </div>
								  <!--//sub-heard-part-->
								
									<div class="graph-visual tables-main">
											
													<h3 class="inner-tittle two">Tabla de Asignación Familiar</h3>
													<form id="basicBootstrapForm" action="<?php echo base_url();?>admins/submit_asignacion_familiar" id="basicBootstrapForm" method="post"> 
													
														  <div class="graph">

														  	
															<div class="tables">
																<table class="table"> 
																	<thead> 
																		<tr>
																			<th style="width: 10px">#</th>
																			<th>Desde ($)</th> 
																			<th>Hasta ($)</th> 
																			<th>Monto Asignación Familiar</th> 
																		</tr> 
																	</thead> 
																	<tbody> 
											                    <?php $i = 1; ?>
											                    <?php foreach ($tabla_asig_familiar as $asig_familiar) { ?>			  <tr>
											                        <td><?php echo $i;?></td>
											                        <td class="form-group"><input type="text" class="form-control miles desde" name="desde_<?php echo $asig_familiar->id;?>" id="desde_<?php echo $asig_familiar->id;?>" placeholder="Ingrese Monto Desde" value="<?php echo $asig_familiar->desde; ?>"></td>
											                        <td class="form-group"><?php if($asig_familiar->hasta != 999999999){ ?><input type="text" class="form-control miles hasta" name="hasta_<?php echo $asig_familiar->id;?>" id="hasta_<?php echo $asig_familiar->id;?>" placeholder="Ingrese Monto Hasta" value="<?php echo $asig_familiar->hasta; ?>"><?php }else{ ?>Y m&aacute;s<?php } ?></td>
											                        <td class="form-group"><input type="text" class="form-control miles monto" name="monto_<?php echo $asig_familiar->id;?>" id="monto_<?php echo $asig_familiar->id;?>" placeholder="Ingrese Monto Asignaci&oacute;n Familiar" value="<?php echo $asig_familiar->monto; ?>"></td>
											                      </tr>
											                      <?php $i++; ?>
											                    <?php } ?>																		
																	</tbody> 
																</table> 
																<br>
																<button type="submit" class="btn btn-info">Guardar</button>&nbsp;&nbsp;
															</div>
												
													</div>
													</form>
													
											</div>
									<!--/charts-inner-->

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
            desde: {
                selector: '.desde',
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Monto desde requerido'
                    }
                }
            },
            hasta: {
                selector: '.hasta',
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Monto hasta requerido'
                    }
                }
            },
        }
    })
    
});

$(document).ready(function(){
 $('.miles').mask('000.000.000.000.000', {reverse: true})        

});

$(document).ready(function(){
 $('.miles_decimales').mask('#.###0,000', {reverse: true})        

});
</script>          									