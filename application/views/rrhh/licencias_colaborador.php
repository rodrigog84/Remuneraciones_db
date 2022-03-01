		


            <div class="panel panel-inverse">                       
                      <div class="panel-heading">
                            <h4 class="panel-title">Listado de Licencias M&eacute;dicas de <?php echo primera_mayuscula($personal->nombre)." ".primera_mayuscula($personal->apaterno)." ".primera_mayuscula($personal->amaterno); ?></h4>
                        </div>
            <div class="panel-body">
     <div class='row'>

    <div class="graph-visual tables-main">
	<div class="graph">
		<div class="tables">
			<table id="tabla_licencias" name="tabla_licencias" class="table"> 
				<thead class="thead-inverse"> 
					<tr>
						<th scope="col">#</th>
	                    <th scope="col">Rut</th>
	                    <th scope="col">Numero Licencia</th>
	                    <th scope="col">Fecha Emisi&oacute;n Licencia</th>
	                    <th scope="col">Fecha Inicio Reposo</th>
	                    <th scope="col">Numero Días</th>
	                    <th scope="col">Tipo Licencia</th>
	                    <!--th scope="col">Estado</th-->
					</tr> 
				</thead>
				<tbody>
					<?php if(count($licencias) > 0 ){ ?>
	                    <?php $i = 1; ?>
	                        <?php foreach ($licencias as $licencia) { ?>				
								<tr class="active" id="variable">
									<td><small><?php echo $i ;?></small></td>
	                                <td><small><?php echo $licencia->rut;?></small></td>
	                              	<td><small><?php echo $licencia->numero_licencia;?></small></td>
	                              	<td><small><?php echo $licencia->fec_emision_licencia;?></small></td>
	                              	<td><small><?php echo $licencia->fec_inicio_reposo;?></small></td>
	                              	<td><small><?php echo $licencia->numero_dias;?></small></td>
	                              	<td><small><?php echo $licencia->tipo_licencia;?></small></td>
								</tr> 
							<?php $i++;?>
						<?php } ?>
                     <?php } ?>	



				</tbody>
			</table>
		</div>
	</div>
	</div>

</div>
</div>



                      <div class="panel-footer">
                      	<a href="<?php echo base_url().'rrhh/mantencion_personal'; ?>" class="btn btn-success">Volver</a>
                      </div>
</div>


<script>


$(document).ready(function() {
         var table = $('#tabla_licencias').DataTable({
          "bLengthChange": true,
          "bFilter": true,
          "bInfo": true,
          "bSort": false,
          "bAutoWidth": false,
          "aLengthMenu" : [[5,15,30,50,100,-1],[5,15,30,50,100,'Todos']],
          "iDisplayLength": 50,
          "columnDefs": [
		        {"className": "dt-center", "targets": "_all"}
		      ],
          "oLanguage": {
              "sLengthMenu": "_MENU_ Registros por p&aacute;gina",
              "sZeroRecords": "No se encontraron registros",
              "sInfo": "Mostrando del _START_ al _END_ de _TOTAL_ registros",
              "sInfoEmpty": "Mostrando 0 de 0 registros",
              "sInfoFiltered": "(filtrado de _MAX_ registros totales)",
              "sSearch":        "Buscar:",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":    "Último",
                "sNext":    "Siguiente",
                "sPrevious": "Anterior"
            }              
          }          
        });
      });


</script>	

<script type="text/javascript">
	
function eliminar_licencia(rut){

bootbox.confirm({
	    title: "Eliminar Licencia",
	    message: "¿Desea Eliminar Licencia?",
	    size: 'small',
	    buttons: {
	        cancel: {
	            label: '<i class="fa fa-times"></i> Cancelar'
	        },
	        confirm: {
	            label: '<i class="fa fa-check"></i> Confirmar'
	        }
	    },
	    callback: function (result) {
	        //console.log('This was logged in the callback: ' + result);
	        if (result == true){
	   		window.location="<?php echo base_url();?>auxiliares/del_licencia/"+rut;
	    	}
	    }

		})
}

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