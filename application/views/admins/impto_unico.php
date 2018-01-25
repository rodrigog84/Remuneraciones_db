									<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   <ol class="breadcrumb m-b-0">
											<li><a href="inicio.html">Inicio</a></li>
											<li class="active">Impuesto Único</li>
											
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
													<h3 class="inner-tittle two">Tabla de Impuesto Único</h3>
													<form id="basicBootstrapForm" action="<?php echo base_url();?>admins/submit_impuesto_unico" id="basicBootstrapForm" method="post"> 
													
														  <div class="graph">

														  	
															<div class="tables">
																<table class="table"> 
																	<thead> 
																		<tr>
																			<th style="width: 10px">#</th>
																			<th>Desde ($)</th> 
																			<th>Hasta ($)</th> 
																			<th>Factor</th> 
																			<th>Rebajas ($)</th> 
																			

																		</tr> 
																	</thead> 
																	<tbody> 
												                    <?php $i = 1; ?>
												                    <?php foreach ($tabla_impuesto as $impuesto) { ?>														
																		<tr class="active" id="variable">
																			<td><?php echo $i;?></td>
																			<td class="form-group"><input type="text" class="form-control miles desde" name="desde_<?php echo $impuesto->id_tabla_impuesto;?>" id="desde_<?php echo $impuesto->id_tabla_impuesto;?>" placeholder="Ingrese Monto Desde" value="<?php echo $impuesto->desde; ?>"></td>
                        <td class="form-group"><?php if($impuesto->hasta != 999999999){ ?><input type="text" class="form-control miles hasta" name="hasta_<?php echo $impuesto->id_tabla_impuesto;?>" id="hasta_<?php echo $impuesto->id_tabla_impuesto;?>" placeholder="Ingrese Monto Hasta" value="<?php echo $impuesto->hasta; ?>"><?php }else{ ?>Y m&aacute;s<?php } ?></td>
                        <td class="form-group"><input type="text" class="form-control miles_decimales factor" name="factor_<?php echo $impuesto->id_tabla_impuesto;?>" id="factor_<?php echo $impuesto->id_tabla_impuesto;?>" placeholder="Ingrese Factor" value="<?php echo number_format($impuesto->factor,3,".",","); ?>"></td>
                        <td class="form-group"><input type="text" class="form-control miles rebaja" name="rebaja_<?php echo $impuesto->id_tabla_impuesto;?>" id="rebaja_<?php echo $impuesto->id_tabla_impuesto;?>" placeholder="Ingrese Monto Rebaja" value="<?php echo $impuesto->rebaja; ?>"></td>				
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