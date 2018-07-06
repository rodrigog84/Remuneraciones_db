
									
									<div class="graph-visual tables-main">

											          <div class="panel panel-inverse"> 											
										            <div class="panel-heading">
											                <h4 class="panel-title">Impuesto &Uacute;nico</h4>
											            </div>
													<form id="basicBootstrapForm" action="<?php echo base_url();?>admins/submit_impuesto_unico" id="basicBootstrapForm" method="post"> 
													
													  	
															<div class="panel-body">
																<table class="table"> 
																	<thead> 
																		<tr>
																			<th style="width: 10px">#</th>
																			<th>Desde (UTM)</th> 
																			<th>Hasta (UTM)</th> 
																			<th>Factor</th> 
																			<th>Rebajas (UTM)</th> 
																			

																		</tr> 
																	</thead> 
																	<tbody> 
												                    <?php $i = 1; ?>
												                    <?php foreach ($tabla_impuesto as $impuesto) { ?>														
																		<tr class="active" id="variable">
																			<td><?php echo $i;?></td>
																			<td class="form-group"><input type="text" class="form-control miles_decimales2 desde" name="desde_<?php echo $impuesto->id_tabla_impuesto;?>" id="desde_<?php echo $impuesto->id_tabla_impuesto;?>" placeholder="Ingrese Monto Desde" value="<?php echo number_format($impuesto->desde,2,",","."); ?>"></td>
                        <td class="form-group"><?php if($impuesto->hasta != 999999999){ ?><input type="text" class="form-control miles_decimales2 hasta" name="hasta_<?php echo $impuesto->id_tabla_impuesto;?>" id="hasta_<?php echo $impuesto->id_tabla_impuesto;?>" placeholder="Ingrese Monto Hasta" value="<?php echo number_format($impuesto->hasta,2,",","."); ?>"><?php }else{ ?>Y m&aacute;s<?php } ?></td>
                        <td class="form-group"><input type="text" class="form-control miles_decimales factor" name="factor_<?php echo $impuesto->id_tabla_impuesto;?>" id="factor_<?php echo $impuesto->id_tabla_impuesto;?>" placeholder="Ingrese Factor" value="<?php echo number_format($impuesto->factor,3,".",","); ?>"></td>
                        <td class="form-group"><input type="text" class="form-control miles_decimales2 rebaja" name="rebaja_<?php echo $impuesto->id_tabla_impuesto;?>" id="rebaja_<?php echo $impuesto->id_tabla_impuesto;?>" placeholder="Ingrese Monto Rebaja" value="<?php echo number_format($impuesto->rebaja,2,",","."); ?>"></td>				
																		</tr> 
												                      <?php $i++; ?>
												                    <?php } ?>																		
																	</tbody> 
																</table> 
																<br>
																 <button type="submit" class="btn btn-info">Guardar</button>&nbsp;&nbsp;
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


$(document).ready(function(){
 $('.miles_decimales2').mask('#.##0,00', {reverse: true})        

});
</script>          									



<script>

    $(document).ready(function() {
        <?php if(isset($message)){ ?>

        $.gritter.add({
            title: 'Atención',
            text: '<?php echo $message;?>',
            sticky: false,
            image: '<?php echo base_url();?>images/logos/alert-icon.png',
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