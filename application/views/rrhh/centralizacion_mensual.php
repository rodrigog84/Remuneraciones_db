		
    						<div class="row">
       <div class='col-md-6'>

               <a class="btn btn-primary" href="<?php echo base_url();?>rrhh/add_centralizacion_mensual"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Centralizaci&oacute;n</a>
        </div>
      </div><br>  
<div class="alert alert-info fade in m-b-15">
                <strong>Atenci&oacute;n!</strong>
                Centralizaci&oacute;n s&oacute;lo se puede realizar a per&iacute;odos con remuneraciones ya aprobadas.
                <span class="close" data-dismiss="alert">&times;</span>
              </div>
	

            <div class="panel panel-inverse">                       
                      <div class="panel-heading">
                            <h4 class="panel-title">Listado de Centralizaciones</h4>
                        </div>
            <div class="panel-body">
              <div class='row'>


	<div class="graph">
		<div class="tables">
			<table id="tabla_centralizaciones" name="tabla_centralizaciones" class="table"> 
				<thead class="thead-inverse"> 
					<tr>
						<th scope="col">#</th>
	                    <th scope="col">Per&iacute;odo</th>
	                    <th scope="col">Monto Debe ($)</th>
	                    <th scope="col">Monto Haber ($)</th>
	                    <th scope="col">Nro. Comprobante</th>
	                    <th scope="col">Ver</th>
	                    <th scope="col">Estado</th>
	                    <th scope="col">Acci&oacute;n</th>
					</tr> 
				</thead>
				<tbody>
					<?php if(count($centralizaciones) > 0 ){ ?>
	                    <?php $i = 1; ?>
	                        <?php foreach ($centralizaciones as $centralizacion) { ?>
                          <?php if(is_null($centralizacion->aprobado)){
                                $estado = 'Calculado';
                                $color = 'info';
                          }else{
                                $estado = 'Aprobado';
                                $color = 'success';
                          } ?>
								<tr class="active" id="variable">
									<td><?php echo $i ;?></td>
	                              	<td><?php echo month2string($centralizacion->mes)." de ".$centralizacion->anno;?></td>
	                                <td><?php echo number_format($centralizacion->totaldebe,0,'.','.');?></td>
	                              	<td><?php echo number_format($centralizacion->totalhaber,0,'.','.');?></td>
	                              	<td><?php echo $centralizacion->nrocomprobante;?></td>
	                              	<td><center>
                                        <a href="#"   onclick='ver_centralizacion(this);return false;' id='ver_centralizacion-<?php echo $centralizacion->id;?>' data-idcentralizacion="<?php echo $centralizacion->id;?>"  data-mes="<?php echo month2string($centralizacion->mes);?>" data-anno="<?php echo $centralizacion->anno;?>"><span class="glyphicon glyphicon-search"></span></a>  
                                        </center></td>
	                              	<td><span class="label label-<?php echo $color;?>"><?php echo $estado;?></span></td>
                                  <td>
                                    <?php if($estado == 'Calculado'){ ?>
                                      <a href="#" onclick="aprobar_centralizacion(<?php echo $centralizacion->id;?>)" title="Aprobar" class="btn btn-xs btn-success"><span class="fa fa-check"></span></a>
                                      <a href="#" onclick="rechazar_centralizacion(<?php echo $centralizacion->id;?>)" title="Rechazar" class="btn btn-xs btn-danger"><span class="fa fa-times"></span></a>
                                    <?php }else{ ?>
                                        &nbsp;
                                    <?php } ?>

                                  </td>

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



 <div class="modal fade " id="centralizacion_mensual_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Asiento Contable Centralizaci&oacute;n: <span id='periodocentralizacion'></span></h4>
                </div>
            
                <div class="modal-body">

                    <div id='tabla_asiento'></div>

                </div>
                
                <div class="modal-footer">

                    <button type='button' id='btcambiaestado' class="btn btn-success btn-ok"  data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>  


<script>




 function ver_centralizacion(elem){

  
     var idcentralizacion = $('#'+elem.id).data('idcentralizacion');
     var mes = $('#'+elem.id).data('mes');
     var anno = $('#'+elem.id).data('anno');
     console.log(elem)
     console.log(elem.id)
     console.log(idcentralizacion)

     $('#centralizacion_mensual_modal').modal('show')


        $.ajax({type: "GET",
                url: "<?php echo base_url();?>rrhh/get_centralizacion/"+idcentralizacion, 
                dataType: "json",
                async: false,
                success: function(data){
                    var encabezado = mes + " de " + anno;
                    $('#periodocentralizacion').html(encabezado)
                    var len_debe = data.asiento.DEBE.length;
                    var len_haber = data.asiento.HABER.length;
                    console.log(data)
                    var table_html = '';
                    if(len_debe > 0 || len_haber > 0){

                          table_html = '<div class="row"> \
                                        <div class="col-md-12">\
                                            <div class="panel panel-inverse">\
                                                  <div class="panel-heading">\
                                                    <h4 class="panel-title">Asiento Contable</h4>\
                                                  </div>\
                                                    <div class="panel-body">\
                                                          <div class="row"    >\
                                                            <div class="col-md-12">\
                                                                      <div class="table-responsive">\
                                                  <table class="table" id="detallecarga">\
                                                    <thead>\
                                                      <tr>\
                                                        <th colspan="2">Debe</th>\
                                                        <th colspan="2">Haber</th>\
                                                      </tr>\
                                                    </thead>\
                                                    <tbody>';

                        var cantidad_registros = 0;
                        if(len_debe >= len_haber){
                          cantidad_registros = len_debe;
                        }else{
                          cantidad_registros = len_haber;
                        }   

                        var i =0;
                        var total_debe = 0;
                        var total_haber = 0;
                        while (i <= cantidad_registros){
                          var debe = false;
                          var haber = false;
                          if (data.asiento.DEBE[i] !== undefined){
                              debe = true;
                          }

                          if (data.asiento.HABER[i] !== undefined){
                              haber = true;
                          }


                          if(debe || haber){
                              table_html += '<tr>';
                          }

                         if(debe){

                              table_html += '<td>' + data.asiento.DEBE[i].nomcuentacontable + '</td>\
                                            <td align ="right">$&nbsp;' + number_format(data.asiento.DEBE[i].monto,0,'.','.') + '</td>';

                              total_debe += data.asiento.DEBE[i].monto
                          }else{

                              table_html += '<td colspan="2"></td>'
                          }


                         if(haber){

                              table_html += '<td>' + data.asiento.HABER[i].nomcuentacontable + '</td>\
                                            <td align ="right">$&nbsp;' + number_format(data.asiento.HABER[i].monto,0,'.','.') + '</td>';

                              total_haber += data.asiento.HABER[i].monto
                          }else{

                              table_html += '<td colspan="2"></td>'
                          }

                          if(debe || haber){
                              table_html += '</tr>';
                          }


                          i++;
                        }    

                        table_html += '</tbody>\
                                                <tfooter>\
                                                  <tr>\
                                                    <th>Total Debe</th>\
                                                    <td align="right"><b>$&nbsp;' + number_format(total_debe,0,'.','.') + '</th>\
                                                    <th >Total Haber</th>\
                                                    <td align ="right"><b>$&nbsp;' + number_format(total_haber,0,'.','.') + '</b></th>\
                                                  </tr>\
                                                </tfooter>\
                                              </table>';                                                                 

                    }

                    $('#tabla_asiento').html(table_html)

                  }
              }); 
      

 }



  function aprobar_centralizacion(idcentralizacion){
    


          Swal.fire({
              title: 'Está Seguro(a) que desea aprobar la centralizaci&oacute;n?',
              text: 'Una vez aprobada no será posible reversar',
            // footer: '<a href="#">Why do I have this issue?</a>',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",              
              confirmButtonText: 'Aceptar'
            }).then((result) => {

              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {

                  $.ajax({type: "GET",
                          url: "<?php echo base_url();?>rrhh/aprobar_centralizacion/"+idcentralizacion+"/a", 
                          dataType: "json",
                          async: false,
                          success: function(data){


                            }
                        }); 
                
                  location.reload();
              }

          });    



    
  };


  function rechazar_centralizacion(idcentralizacion){
    


          Swal.fire({
              title: 'Está Seguro(a) que desea rechazar la centralizaci&oacute;n?',
              text: 'Será necesario volver a calcular',
            // footer: '<a href="#">Why do I have this issue?</a>',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",              
              confirmButtonText: 'Aceptar'
            }).then((result) => {

              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {

                  $.ajax({type: "GET",
                          url: "<?php echo base_url();?>rrhh/aprobar_centralizacion/"+idcentralizacion+"/r", 
                          dataType: "json",
                          async: false,
                          success: function(data){


                            }
                        }); 
                
                  location.reload();
              }

          });    



    
  };


$(document).ready(function() {
         var table = $('#tabla_centralizaciones').DataTable({
          "bLengthChange": true,
          "bFilter": true,
          "bInfo": true,
          "bSort": false,
          "bAutoWidth": false,
          "aLengthMenu" : [[5,15,30,45,100,-1],[5,15,30,45,100,'Todos']],
          "iDisplayLength": 15,
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