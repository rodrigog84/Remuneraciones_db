<!--sub-heard-part-->
<div class="alert alert-info fade in m-b-15">
                <strong>Atenci&oacute;n!</strong>
                Utilice los siguientes c&oacute;digos dentro del texto, y estos ser&aacute;n reemplazados cuando sean asociados a un colaborador.
                <span class="close" data-dismiss="alert">&times;</span>
              </div>	


  <form id="basicBootstrapForm" action="<?php echo base_url(); ?>configuraciones/submit_documentos" method="post">
  <div class='row'>  
<div class="col-md-4">
                          <div class="panel panel-inverse">                       
                                <div class="panel-heading">
                                      <h4 class="panel-title">Listado de Tipos de Documento</h4>
                                  </div>
                      <div class="panel-body">
                        <div class='row'>                       
                          <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipo_documento">Tipo de Documento</label>
                                    <select name="tipo_documento" id="tipo_documento" class="form-control">
                                        <option value="">Seleccione Tipo Documento</option>
                                        <?php foreach ($tiposdocumentos as $tipodocumento) { ?>
                                            <?php $tipodocumentoselected = $tipodocumento->id_tipo_documento == $datos_documento['id_tipo_documento'] ? "selected" : ""; ?>
                                            <option value="<?php echo $tipodocumento->id_tipo_documento; ?>" <?php echo $tipodocumentoselected; ?>><?php echo $tipodocumento->tipo; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>                      

                        </div><!-- /.box-body -->
                 
                      </div>
                    </div>
                  </div>

<div class="col-md-4">
                          <div class="panel panel-inverse">                       
                                <div class="panel-heading">
                                      <h4 class="panel-title">C&oacute;digos  Datos Generales  para agregar en el texto</h4>
                                  </div>
                      <div class="panel-body">
                        <div class='row'>                       
                          <div class="col-md-12">

                                <ul>
                                  <li><b>{FechaActual}</b>: Fecha Actual en formato dd/mm/aaaa</li>
                                  <li><b>{TextoFechaActual}</b>: Fecha Actual en texto</li>
                                  <li><b>{Nombre}</b>: Nombre Completo Colaborador</li>
                                  <li><b>{Rut}</b>: Rut del Colaborador</li>
                                  <li><b>{Direccion}</b>: Direcci&oacute;n del Colaborador</li>
                                  <li><b>{FechaNacimiento}</b>: Fecha de Nacimiento del Colaborador</li>
                                  <li><b>{Nacionalidad}</b>: Pa&iacute;s de origen del colaborador</li>
                                  <li><b>{Cargo}</b>: Cargo del Colaborador</li>
                                  <li><b>{Telefono}</b>: Tel&eacute;fono del Colaborador</li>
                                  <li><b>{Email}</b>: Correo Electr&oacute;nico del Colaborador</li>
                                  <li><b>{EstadoCivil}</b>: Estado Civil del Colaborador</li>
                                  <li><b>{SueldoBase}</b>: Sueldo Base del Colaborador</li>
                                  <li><b>{TextoSueldoBase}</b>: Sueldo Base del Colaborador como texto</li>
                                  <li><b>{TipoContrato}</b>: Tipo de Contrato del Colaborador (Plazo Fijo o Indefinido)</li>
                                  <li><b>{FechaIngreso}</b>: Fecha de Ingreso a la Empresa</li>
                                  <li><b>{Afp}</b>: Nombre de la AFP a la que est&aacute; asociada el Colaborador</li>
                                  <li><b>{InstitucionSalud}</b>: Instituci&oacute;n de Salud a la que pertenece el Colaborador</li>
                                </ul>



                            </div>                      

                        </div><!-- /.box-body -->
                 
                      </div>
                    </div>
                  </div>   



<div class="col-md-4">
                          <div class="panel panel-inverse">                       
                                <div class="panel-heading">
                                      <h4 class="panel-title">C&oacute;digos Finiquito para agregar en el texto </h4>
                                  </div>
                      <div class="panel-body">
                        <div class='row'>                       
                          <div class="col-md-12">

                                <ul>
                                  <li><b>{CausalFiniquito}</b>: Causal del Finiquito</li>
                                  <li><b>{FechaContrato}</b>: Fecha contrato del Colaborador</li>
                                  <li><b>{FechaAvisoDespido}</b>: Fecha Despido del Colaborador</li>
                                  <li><b>{FechaFiniquito}</b>: Fecha Finiquito del Colaborador</li>
                                  <li><b>{TotalDiasTrabajados}</b>: D&iacute;as Trabajados total del Colaborador</li>
                                  <li><b>{TotalDiasAviso}</b>: D&iacute;as de aviso del despido del Colaborador</li>
                                  <li><b>{FactorCalculoDiario}</b>: Factor de c&aacute;lculo diario utilizado para el colaborador</li>
                                  <li><b>{AñosServicio}</b>: Años de servicio del Colaborador</li>
                                  <li><b>{TotalVacaciones}</b>: Total Vacaciones acumuladas del Colaborador</li>
                                  <li><b>{DiasVacacionesTomados}</b>: Total Vacaciones utilizadas por el Colaborador</li>
                                  <li><b>{SaldoVacaciones}</b>: Saldo Final Vacaciones Colaborador</li>
                                  <li><b>{DiasInhabiles}</b>: D&iacute;as Inh&aacute;biles Posteriores del Colaborador</li>
                                  <li><b>{TotalVacacionesPendientes}</b>: Total Vacaciones Pendientes del Colaborador</li>
                                  <li><b>{BaseCalculoAñosServicio}</b>: Base de C&aacute;lculo utilizada para c&aacute;lculo de A&ntilde;os de Servicio</li>
                                  <li><b>{BaseCalculoVacacionesProporcionales}</b>: Base de C&aacute;lculo utilizada para c&aacute;lculo de Vacaciones Proporcionales</li>
                                  <li><b>{IndemnizacionMesAviso}</b>: Monto Indemnizaci&oacute;n Mes de Aviso</li>
                                  <li><b>{IndemnizacionAñosServicio}</b>: Monto Indemnizaci&oacute;n A&ntilde;os de Servicio</li>
                                  <li><b>{IndemnizacionFeriadoLegal}</b>: Monto Indemnizaci&oacute;n Feriado Legal</li>
                                  <li><b>{RemuneracionPendiente}</b>: Monto Remuneraci&oacute;n Pendiente</li>
                                  <li><b>{IndemnizacionVoluntaria}</b>: Monto Indemnizaci&oacute;n Voluntaria</li>
                                  <li><b>{Desahucio}</b>: Monto Desahucio</li>
                                  <li><b>{TotalIndemnizacion}</b>: Monto Total Indemnizaciones</li>
                                  <li><b>{DescuentoPrestamoEmpresa}</b>: Monto Descuento por Pr&eacute;stamo Empresa</li>
                                  <li><b>{DescuentoPrestamoCcaf}</b>: Monto Descuento por Pr&eacute;stamo CCAF</li>
                                  <li><b>{OtrosDescuentos}</b>: Monto Otros Descuentos</li>
                                  <li><b>{TotalDescuentos}</b>: Monto Total Descuentos</li>
                                  <li><b>{MontoFiniquito}</b>: Monto Total Finiquito</li>
                                </ul>



                            </div>                      

                        </div><!-- /.box-body -->
                 
                      </div>
                    </div>
                  </div>                                 
                </div> 

							
          								
									
	
                          <div class="panel panel-inverse">                       
                                <div class="panel-heading">
                                      <h4 class="panel-title"><?php echo $datos_documento['txt_encabeza']; ?></h4>
                                  </div>
                      <div class="panel-body">
                        <div class='row'>										  	
                                <div class='col-md-12'>
                                        <div class="form-group">
                                            <label for="documento">Nombre Documento</label>
                                            <input type="text" class="form-control" name="nombre_documento" id="nombre_documento" placeholder="Agrega un Nombre del Documento" value="<?php echo $datos_documento['nombre']; ?>">
                                        </div>
                                </div>					
						            </div>
                        <div class='row'> 
                          <div class='col-md-12'>
                                          <div class="form-group">
                                              <label for="documento">&nbsp;</label>
                                              <textarea class="textarea ckeditor" id="txt_formato" onkeypress="alert('You triggered the onkeypress event.')" name="txt_formato" placeholder="Agrega Texto Aqu&iacute;" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $datos_documento['txt_documento']; ?>

                                            </textarea>

                                          </div>
                                      </div>
                        </div>


                      </div><!-- /.box-body -->

                    <div class="panel-footer">
                        <!-- CAMPOS OCULTOS -->
                      <input type="hidden" name="iddocumento" id="iddocumento" value="<?php echo $datos_documento['id']; ?>">
                       <a href="<?php echo base_url(); ?>configuraciones/tipos_documentos" class="btn btn-success">Volver</a>
                        <button type="submit" class="btn btn-info"><?php echo $datos_documento['txt_button']; ?></button>
                    </div>                      

                 
                  </div> 
</div>  


<script>

function escribe_texto(){

  console.log("asdasdasd");
}

CKEDITOR.replace('txt_formato', {
              toolbar: [  
                            { name: 'clipboard', 
                              items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] 
                            },                      
                            {
                                name: 'basicstyles',
                                items: ['Bold', 'Italic',  '-', 'RemoveFormat']
                            },
                             { 
                                name: 'paragraph', 
                                items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'BidiLtr', 'BidiRtl', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', ] },   
                                { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                            


                    ],
});





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
                    tipo_documento: {
                        row: '.form-group',
                        validators: {
                            notEmpty: {
                                message: 'Tipo de Documento es requerido'
                            }
                        }
                    },
                      nombre_documento: {
                        row: '.form-group',
                        validators: {
                            notEmpty: {
                                message: 'Nombre del Documento es requerido'
                            }
                        }
                    },
                }
            })


    })



</script>



