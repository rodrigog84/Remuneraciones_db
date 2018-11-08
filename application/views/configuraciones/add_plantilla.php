
<form id="datos_plantilla_banco" name="datos_plantilla_banco"  action="<?php echo base_url();?>configuraciones/submit_plantilla_banco" method="post">
<div class="container">
		<div class="panel panel-default">
			
			<div class="panel-heading">Creación de Plantilla de Banco
			</div>
			<div class="panel-body">
				<div class="row">					      			
					<div class="form-group col-md-5">
						<label  for="nombre_plantilla">Nombre Plantilla</label>
							<input type="input" class="form-control" id="nombre_plantilla" name="nombre_plantilla" placeholder="Introducir Nombre de Plantilla" required>	
					</div>					
					<div class="form-group col-md-3">
					    <label  for="banco">Banco</label>
						    <select name="banco" id="banco" class="form-control" required="">
								<option value="">Seleccione Banco</option>
                        		<?php foreach ($bancos as $banco) { ?>
                                  <?php $bancoselected = $banco->id_banco == $datos_form['id_banco'] ? "selected" : ""; ?>
                                  <option value="<?php echo $banco->id_banco;?>" <?php echo $bancoselected;?> ><?php //echo $banco->cod_sbif.' - '.$banco->nombre;?>
                                  <?php echo $banco->nombre;?></option>
                                <?php } ?>																
                            </select>
					</div>
				</div> 
			</div>		
		</div>
</div>


<div class ="container">
		<div class="panel panel-default">
			<div class="panel-heading">Asignación de Campos
				<!--<button type="button" class="btn btn-info  btn-sm" id="Agregar" onclick='agregar_fila("")' >Agregar </button>-->
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table id="tabla_plantilla" class="table">
			            <thead>
			                <tr>
			                	<th>#</th>
			                    <th>Seq</th>
			                    <th>Nombre de Campo</th>
			                    <th>Tipo</th>
			                    <th>Largo</th>
			                    <th>Inicio</th>
			                    <th>Fin</th>
			                    <th>Obeservaciones</th>
			                    <th>Activar</th>
			                </tr>
			            </thead>
			            <tbody>                
			               	<?php $contador = 1; ?>
			               	<?php for ($i = 0; $i < $numero_columnas; $i++) {?>
				                <tr>
				                	<td>
				                		<div class="form-group ">
				                			<?php echo $contador;?>
				                		</div>
				                	</td>
				                	<td>
				                		<div class="form-group ">
											<input type="input" class="form-control" id="seq" name="seq[<?php echo $i;?>]" placeholder="" required value="<?php echo $contador;?>">
										</div>	
									</td>
				                	<td>
				                		<div class="form-group ">
											<input type="hidden" class="form-control" id="nombre_campo" name="nombre_campo[<?php echo $i;?>]" value="<?php echo $columnas[$i] ?>">
											<?php echo $columnas[$i]; ?>
											<input type="hidden" class="form-control" id="nombre_tabla" name="nombre_tabla[<?php echo $i;?>]" value="<?php echo $tablas[$i] ?>">

										</div>	
									</td>
				                	<td>
				                		<div class="form-group ">
											<select name="tipo[<?php echo $i;?>]" id="tipo" class="form-control1">
												<option value="9">Numérico</option>
												<option value="X">Alfanumérico</option>
										</select>
										</div>
									</td>		                	
				                	<td>
				                		<div class="form-group ">
				                			<div class="form-group">
												<input type="number" class="form-control" id=largo" name="largo[<?php echo $i;?>]" placeholder="" required>
											</div>
										</div>
									</td>		                	
				                	<td>
				                		<div class="form-group ">
											<input type="number" class="form-control" id="inicio" name="inicio[<?php echo $i;?>]" placeholder="<?php echo $i;?>" required>
										</div>
									</td>		                	
				                	<td>
				                		<div class="form-group ">
											<input type="number" class="form-control" id="fin" name="fin[<?php echo $i;?>]"  placeholder="" required>
										</div>
									</td>
				                	<td>
				                		<div class="form-group ">
											<input type="input" class="form-control" id="Observacion" name="Observacion[<?php echo $i;?>]" placeholder="">
										</div>	
									</td>
				                	<td>
				                		<input type="checkbox" name="active[<?php echo $i;?>]" id="active" class="minimal" value="<?php echo $contador;?>"> 
				                		</a>
				                	</td>
				                </tr>
				            	<?php $contador++; ?>    
			                <?php }; ?>				
								

						
						</tbody>

				</table>
				</div>
			</div>
			 	

		
</div>

	<div class="form-group">
		<div class="col-lg-offset-2 col-lg-10">
  			<a href="<?php echo base_url();?>configuraciones/plantilla_banco" class="btn btn-success">Volver</a>
  			<button type="submit" class="btn btn-info">Guardar</button>
		</div>
	</div>      
</form>




<script> 
function alertaChecked(){ 
     
    if(event.target.checked){ 
        alert('checked'); 
    }else{ 
        alert('unchecked'); 
    } 
} 
</script> 