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


<div class="panel panel-inverse">                       
    <div class="panel-heading">
        <h4 class="panel-title">Identificación del Colaborador</h4>
    </div>     

            
            <div class="panel-body">
                <div class="row">
                <div class="col-md-6">
                  <table class="table">
                    <tr>
                    <td>
                    <p><b>Nombre</b></p>
                    <p><i class="fa fa-circle-o text-light-blue"></i>&nbsp;&nbsp;<?php echo $personal->nombre." ".$personal->apaterno." ".$personal->amaterno; ?></p>
                    <p><b>Rut</b></p>
                    <p><i class="fa fa-circle-o text-light-blue"></i>&nbsp;&nbsp;<?php echo $personal->rut == '' ? '' : number_format($personal->rut,0,".",".")."-".$personal->dv;?></p>               
                   
                    </td>
                                       
                    </tr>
                    </table>
                </div><!-- /.box-body -->
                <div class="col-md-6">
                  <table class="table">
                    <tr>
                    <td>
                    <p><b>Edad</b></p>
                    <p><i class="fa fa-circle-o text-light-blue"></i>&nbsp;&nbsp;<?php echo $personal->edad; ?></p>
                    <p><b>Sexo</b></p>
                    <p><i class="fa fa-circle-o text-light-blue"></i>&nbsp;&nbsp;<?php echo $personal->sexo_traducido;?></p>               
                   
                    </td>
                                       
                    </tr>
                    </table>
                </div><!-- /.box-body -->
                </div>
            </div><!-- /.col (left) -->
</div>


<div class="panel panel-inverse">                       
      <div class="panel-heading">
            <h4 class="panel-title">Datos Licencia</h4>
        </div>
        <form   id="basicBootstrapForm"  method="post" action="<?php echo base_url();?>auxiliares/submit_licencia">
            <div class="panel-body">
              <div class='row'>

                  <div class="sub-heard-part">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#A1" data-toggle="tab">Datos Licencia&nbsp;&nbsp;<i class="fa"></i> </a></li>
                        <li><a href="#A2" data-toggle="tab">Tipo de Licencia&nbsp;&nbsp;<i class="fa"></i> </a></li>
                        <li><a href="#A3" data-toggle="tab">Caracter&iacute;sticas Reposo&nbsp;&nbsp;<i class="fa"></i> </a></li>
                        <li><a href="#A4" data-toggle="tab">Datos del Profesional&nbsp;&nbsp;<i class="fa"></i> </a></li>
                    </ul>
                  </div>
                  <div class="tab-content">
                      <div id="A1" class="tab-pane fade in active">
                          <div class="row">
                              <div class='col-md-6'>
                                  <div class="form-group">
                                      <label for="nombre">Numero de Licencia</label>  
                                       <input type="text" class="form-control" id="numero_licencia" name="numero_licencia" placeholder="Introducir Numero de Licencia" value="<?php echo $datos_form['numero_licencia']; ?>" >
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                  <label  for="numero_licencia">Fecha Emisión Licencia</label>
                                  <div class="input-group date form_date"  data-date="" data-date-format="dd MM yyyy" data-link-format="yyyy-mm-dd" >
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    <input type="text" class="form-control" id="fec_emision_licencia" name="fec_emision_licencia" value="<?php echo $datos_form['fec_emision_licencia']; ?>" placeholder="dd/mm/aaaa" readonly>
                                  </div>  
                                </div>  
                              </div>                              

                          </div>
                          <div class="row">                     
                            <div class="col-md-6">
                                <div class="form-group">
                                <label  for="numero_licencia">Fecha Inicio de Reposo</label>
                                <div class="input-group date form_date"  data-date="" data-date-format="dd MM yyyy" data-link-format="yyyy-mm-dd" >
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                  <input type="text" class="form-control" id="fec_inicio_reposo" name="fec_inicio_reposo" value="<?php echo $datos_form['fec_inicio_reposo']; ?>" placeholder="dd/mm/aaaa" readonly>
                                </div> 
                              </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label  for="numero_dias">Número de Días</label>
                                  <input type="text" class="form-control" id="numero_dias" name="numero_dias" value="<?php echo $datos_form['numero_dias']; ?>">
                              </div>  
                            </div>                    
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label  for="numero_dias">Número de Días en Palabras</label>
                                    <input type="text" class="form-control" id="numero_dias_palabras" name="numero_dias_palabras"  value="<?php echo $datos_form['numero_dias_palabras']; ?>" readonly>
                              </div>  
                            </div>  
                          </div>

                      </div>

                      <div id="A2" class="tab-pane fade">
                        <div class="row">                     
                          <div class="col-md-6">
                              <div class="form-group">
                              <label  for="tipo_licencia">Tipo de Licencia</label>
                                <select name="tipo_licencia" id="tipo_licencia" class="form-control">
                                <option value="">Seleccione Tipo Licencia</option>
                                <?php foreach ($tipos_licencia as $tipo_licencia) { ?>
                                  <?php $tipolicenciaselected = $tipo_licencia->idtipolicencia == $datos_form['tipo_licencia'] ? "selected" : ""; ?>
                                  <option value="<?php echo $tipo_licencia->idtipolicencia;?>" <?php echo $tipolicenciaselected;?> ><?php echo $tipo_licencia->nombre;?></option>
                                <?php } ?>
                              </select>
                            </div>  
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                              <label  for="responsabilidad_laboral">Recuperabilidad Laboral</label>
                                <select name="recuperabilidad_laboral" id="recuperabilidad_laboral" class="form-control">
                                <option value="1" <?php echo $datos_form['recuperabilidad_laboral'] == '1' ? 'selected' : '';?> >SI</option>
                                <option value="2" <?php echo $datos_form['recuperabilidad_laboral'] == '2' ? 'selected' : '';?>>NO</option>
                              </select>
                            </div>  
                          </div>                    
                        </div>
                        <div class="row">                     
                          <div class="col-md-6">
                              <div class="form-group">
                              <label  for="inicio_tramite_invalidez">Inicio Tramite de Invalidez</label>
                                <select name="inicio_tramite_invalidez" id="inicio_tramite_invalidez" class="form-control">
                                <option value="1" <?php echo $datos_form['inicio_tramite_invalidez'] == '1' ? 'selected' : '';?>>SI</option>
                                <option value="2" <?php echo $datos_form['inicio_tramite_invalidez'] == '2' ? 'selected' : '';?>>NO</option>
                              </select>
                            </div>  
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                <label  for="trayecto">Trayecto</label>
                                <select name="trayecto" id="trayecto" class="form-control" disabled>
                                <option value="1" <?php echo $datos_form['trayecto'] == '1' ? 'selected' : '';?>>SI</option>
                                <option value="2" <?php echo $datos_form['trayecto'] == '2' ? 'selected' : '';?>>NO</option>
                                </select>
                            </div>  
                          </div> 
                           
                                            
                        </div>
                        <div class="row">                     
                          <div class="col-md-6">
                              <div class="form-group">
                              <label  for="fecha_accidente_trabajo">Fecha Accidente</label>
                              <div class="input-group date "  data-date="" data-date-format="dd MM yyyy" data-link-format="yyyy-mm-dd" id="div_fec_acc_trab">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                <input type="text" class="form-control" id="fecha_accidente_trabajo" name="fecha_accidente_trabajo" placeholder="dd/mm/aaaa" readonly value="<?php //echo date("d/m/Y"); ?>" disabled>
                                <input type="hidden" id="fecha_accidente_trabajo_text" value="<?php echo $datos_form['fecha_accidente_trabajo']; ?>" >
                              </div>
                            </div>  
                          </div> 
                          <div class="col-md-3">
                              <div class="form-group">
                              <label for="horas">Horas</label>
                                <select name="horas" id="horas" class="form-control" disabled>
                                <?php $h = 1; ?>
                                <?php while ($h <= 24) { ?>
                                  <?php $hora_selected = $h == $datos_form['horas'] ? 'selected' : ''; ?>
                                <option value="<?php echo $h; ?>" <?php echo $hora_selected ?>><?php echo $h; ?></option>
                                <?php $h++; ?>
                                <?php  } ?>
                                </select>
                                 <input type="hidden" id="horas_text" value="<?php echo  date('H');  ?>" >
                            </div>  
                          </div> 
                          <div class="col-md-3">
                              <div class="form-group">
                              <label for="minutos">Minutos</label> 
                              <select name="minutos" id="minutos" class="form-control" disabled>
                                <?php $m = 1; ?>
                                <?php while ($m <= 60) { ?>
                                  <?php $minuto_selected = $m == $datos_form['minutos'] ? 'selected' : ''; ?>
                                <option value="<?php echo $m; ?>" <?php echo $minuto_selected ?>><?php echo $m; ?></option>
                                <?php $m++; ?>
                                <?php  } ?>
                                </select>
                                <input type="hidden" id="minutos_text" value="<?php echo  date('i');  ?>" >
                            </div>  
                          </div>                  
                        </div>
                        <!--div class="row">
                            <div class="col-md-2">
                              <b><i>Datos Hijo</i></b>
                            </div>  
                            <div class="col-md-10">
                              <hr>    
                            </div>      
                        </div--> 
                        <div class="row">                     
                          <div class="col-md-6">
                              <div class="form-group">
                              <label  for="rut_hijo">Rut Hijo</label>
                                <input type="text" class="form-control" id="rut_hijo" name="rut_hijo"  placeholder="98123456-7" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="<?php echo $datos_form['rut_hijo']; ?>" disabled >
                            </div>  
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                              <label  for="nombre_hijo">Nombres Hijo</label>
                                <input type="text" class="form-control" id="nombre_hijo" name="nombre_hijo" placeholder="Introducir Nombre Completo del Hijo" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="<?php echo $datos_form['nombre_hijo']; ?>" disabled>
                            </div>  
                          </div>                    
                        </div>  
                        <div class="row">                     
                          <div class="col-md-6">
                              <div class="form-group">
                              <label  for="apaterno_hijo">Apellido Paterno Hijo</label>
                              <input type="text" class="form-control" id="apaterno_hijo" name="apaterno_hijo" placeholder="Introducir Apellido Paterno" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="<?php echo $datos_form['apaterno_hijo']; ?>" disabled>
                            </div>  
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                              <label  for="amaterno_hijo">Apellido Materno Hijo</label>
                              <input type="text" class="form-control" id="amaterno_hijo" name="amaterno_hijo" placeholder="Introducir Apellido Materno" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="<?php echo $datos_form['amaterno_hijo']; ?>" disabled>
                            </div>  
                          </div>                    
                        </div> 
                        <div class="row">                     
                          <div class="col-md-6">
                              <div class="form-group">
                              <label  for="apaterno_hijo">Fecha Nacimiento Hijo</label>
                               <div class="input-group date "  data-date="" data-date-format="dd MM yyyy" data-link-format="yyyy-mm-dd" id="div_fec_nac_hijo">
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                <input type="text" class="form-control" id="fecnachijo" name="fecnachijo" placeholder="dd/mm/aaaa" readonly value="<?php echo $datos_form['fecnachijo']; ?>" disabled>
                              </div> 
                            </div>  
                          </div>
                   
                        </div>  







                       </div> 

                       <div id="A3" class="tab-pane fade">
                        <div class="row">  
                            <div class="col-md-6">
                              <div class="form-group">
                                <label  for="tipo_reposo">Tipo de Reposo</label>
                                <select name="tipo_reposo" id="tipo_reposo" class="form-control">
                                <option value="">Seleccione Tipo de Reposo</option>
                                <option value="1" <?php echo $datos_form['tipo_reposo'] == '1' ? 'selected' : '';?>>Reposo Laboral Total</option>
                                <option value="2" <?php echo $datos_form['tipo_reposo'] == '2' ? 'selected' : '';?>>Reposo Laboral Parcial</option>
                                </select>
                              </div> 
                            </div> 
                            <div class="col-md-6">
                              <div class="form-group">
                                <label  for="tipo_reposo_parcial">Tipo de Reposo Parcial</label>
                                <select name="tipo_reposo_parcial" id="tipo_reposo_parcial" class="form-control" disabled>
                                  <option value="">Seleccione Tipo de Reposo Parcial</option>
                                  <option value="A" <?php echo $datos_form['tipo_reposo_parcial'] == 'A' ? 'selected' : '';?>>Mañana</option>
                                  <option value="B" <?php echo $datos_form['tipo_reposo_parcial'] == 'B' ? 'selected' : '';?>>Tarde</option>
                                  <option value="C" <?php echo $datos_form['tipo_reposo_parcial'] == 'C' ? 'selected' : '';?>>Noche</option>
                                </select>
                              </div>
                            </div>  


                        </div>

                        
                      
                        <div class="row">  
                            <div class="col-md-6">
                              <div class="form-group">
                                <label  for="lugar_reposo">Lugar de Reposo</label>
                                <select name="lugar_reposo" id="lugar_reposo" class="form-control">
                                  <option value="">Seleccione Lugar de Reposo</option>
                                  <option value="1" <?php echo $datos_form['lugar_reposo'] == '1' ? 'selected' : '';?>>Su Domicilio</option>
                                  <option value="2" <?php echo $datos_form['lugar_reposo'] == '2' ? 'selected' : '';?>>Hospital</option>
                                  <option value="3" <?php echo $datos_form['lugar_reposo'] == '3' ? 'selected' : '';?>>Otro Domicilio</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-6">
                              <div class="form-group">
                                <label  for="justificar_otro_domicilio">Justificaci&oacute;n Otro Domicilio</label>
                                <input type="text" class="form-control" id="justificar_otro_domicilio" name="justificar_otro_domicilio" placeholder="Justificar si es Otro Domicilio" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="<?php echo $datos_form['justificar_otro_domicilio']; ?>" disabled>
                              </div>
                            </div>  


                        </div>



                        <div class="row">  
                            <div class="col-md-6">
                              <div class="form-group">
                                <label  for="direccion_otro_domicilio">Direccion, Calle, N° Dpto, Comuna Reposo</label>
                                <input type="text" class="form-control" id="direccion_reposo" name="direccion_reposo" placeholder="Direccion, Calle, N° Dpto, Comuna" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="<?php echo $datos_form['direccion_reposo']; ?>">
                              </div>
                            </div> 
                            <div class="col-md-6">
                              <div class="form-group">
                                <label  for="telefono">Tel&eacute;fono Reposo</label>
                                <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span> 
                                <input type="text" class="form-control" id="telefono_reposo" name="telefono_reposo" placeholder="Tel&eacute;fono Reposo" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"  value="<?php echo $datos_form['telefono_reposo']; ?>">
                                </div>
                              </div>
                            </div>  


                        </div>



                      </div>


                      <div id="A4" class="tab-pane fade">
                        <div class="row">  
                            <div class="col-md-6">
                              <div class="form-group">
                              <label  for="rut_profesional">RUT Profesional</label>
                             <input type="text" class="form-control" id="rut_profesional"  name="rut_profesional" placeholder="12345678-9" oninput="checkRut(this)" value="<?php echo $datos_form['rut_profesional']; ?>">
                             </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                              <label  for="nombre_profesional">Nombre Profesional</label>
                              <input type="text" class="form-control" id="nombre_profesional" name="nombre_profesional" placeholder="Introducir Nombre del Profesional" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="<?php echo $datos_form['nombre_profesional']; ?>">  
                              </div> 
                            </div>
                        </div>


                        <div class="row">  
                            <div class="col-md-6">
                              <div class="form-group">
                              <label  for="apaterno_profesional">Apellido Paterno Profesional</label>
                             <input type="text" class="form-control" id="apaterno_profesional" name="apaterno_profesional" placeholder="Introducir Apellido Paterno del Profesional" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="<?php echo $datos_form['apaterno_profesional']; ?>">
                             </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                              <label  for="amaterno_profesional">Apellido Materno Profesional</label>
                              <input type="text" class="form-control" id="amaterno_profesional"  name="amaterno_profesional" placeholder="Introducir Apellido Materno del Profesional" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="<?php echo $datos_form['amaterno_profesional']; ?>"> 
                              </div>
                            </div>
                        </div>


                        <div class="row">  
                            <div class="col-md-6">
                              <div class="form-group">
                              <label  for="especialidad_profesional">Especialidad</label>
                              <input type="text" class="form-control" id="especialidad_profesional"  name="especialidad_profesional" placeholder="Introducir especialidad del Profesional" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="<?php echo $datos_form['especialidad_profesional']; ?>">
                             </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                              <label  for="tipo_profesional">Tipo de Profesional</label>
                             <select name="tipo_profesional" id="tipo_profesional" class="form-control">
                              <option value="">Seleccione Tipo de Profesional</option>
                              <option value="1" <?php echo $datos_form['tipo_profesional'] == '1' ? 'selected' : '';?>>M&eacute;dico</option>
                              <option value="2" <?php echo $datos_form['tipo_profesional'] == '2' ? 'selected' : '';?>>Dentista</option>
                              <option value="3" <?php echo $datos_form['tipo_profesional'] == '3' ? 'selected' : '';?>>Matrona</option>
                              </select> 
                              </div>
                            </div>
                        </div>


                        <div class="row">  
                            <div class="col-md-6">
                              <div class="form-group">
                              <label  for="registro_profesional">Registro colegio Profesional</label>
                              <input type="text" class="form-control" id="registro_profesional"  name="registro_profesional" placeholder="Introducir Registro colegio Profesional" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="<?php echo $datos_form['registro_profesional']; ?>"> 
                             </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                              <label  for="correo_profesional">Correo Electronico Profesional</label>
                              <div class="input-group">
                               <span class="input-group-addon">@</span>
                               <input type="email" class="form-control" id="correo_profesional"  name="correo_profesional" placeholder="Introducir Correo del Profesional" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="<?php echo $datos_form['correo_profesional']; ?>">
                               </div>
                              </div>
                            </div>
                        </div> 


                        <div class="row">  
                            <div class="col-md-6">
                              <div class="form-group">
                              <label  for="telefono_profesional">Telefono Profesional</label>
                              <div class="input-group">
                              <span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span> 
                              <input type="number" class="form-control" id="telefono_profesional"  name="telefono_profesional" placeholder="Introducir Telefono del Profesional" value="<?php echo $datos_form['telefono_profesional']; ?>"> 
                              </div>
                             </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                              <label  for="direccion_profesional">Dirección Emisi&oacute;n licencias</label>
                              <input type="text" class="form-control" id="direccion_emision_licencia"  name="direccion_emision_licencia" placeholder="Introducir Dirección de Emisi&oacute;n Licencia" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="<?php echo $datos_form['direccion_emision_licencia']; ?>">
                              </div>
                            </div>
                        </div>                        



                      </div>                        






                  </div>   





                </div>
                </div>
                  <div class="panel-footer">
                          <!-- CAMPOS OCULTOS -->
                          <input type="hidden" class="form-control" id="id_trabajador" name="id_trabajador" value="<?php echo $personal->id_personal; ?>">
                          <input type="hidden" class="form-control" id="edad" name="edad" value="<?php echo $personal->edad; ?>">
                          <input type="hidden" class="form-control" id="sexo" name="sexo" value="<?php echo $personal->sexo; ?>">
                          <input type="hidden" class="form-control" id="idlicencia" name="idlicencia" value="<?php echo $datos_form['idlicencia']; ?>">                    
                            <a href="<?php echo base_url();?>auxiliares/licencias" class="btn btn-success">Volver</a>
                            <button type="submit" class="btn btn-info">Guardar</button>
                </div>
        </form>
      </div>

<script type="text/javascript">
    $(".form_date").datetimepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left",
        weekStart: true,
        startView: 2,
        minView: 2,
        forceParse: 0,
        language:  'es',     
    });



</script> 

<script>




  function evalua_tipo_reposo(){

    var tiporeposo = $('#tipo_reposo').val();
    if(tiporeposo == 2){
        $('#tipo_reposo_parcial').attr('disabled',false);

    }else{
        $('#basicBootstrapForm').formValidation('updateStatus', 'tipo_reposo_parcial','NOT_VALIDATED'); 
        $('#tipo_reposo_parcial').val('');
        $('#tipo_reposo_parcial').attr('disabled','disabled');

    }

  }

  $('#tipo_reposo').change(function(){
      evalua_tipo_reposo();
  })


  function evalua_lugar_reposo(){

    var lugarreposo = $('#lugar_reposo').val();
    if(lugarreposo == 3){
        $('#justificar_otro_domicilio').attr('disabled',false);

    }else{
        $('#basicBootstrapForm').formValidation('updateStatus', 'justificar_otro_domicilio','NOT_VALIDATED'); 
        $('#justificar_otro_domicilio').val('');
        $('#justificar_otro_domicilio').attr('disabled','disabled');

    }

  }

$('#lugar_reposo').change(function(){

    evalua_lugar_reposo();

  })

  

  function evalua_tipo_licencia(){


    var tipolicencia = $('#tipo_licencia').val();
    if(tipolicencia == 5){
        $('#trayecto').attr('disabled',false);
        $("#div_fec_acc_trab").addClass("form_date");    
        $("#div_fec_acc_trab").datetimepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayBtn: true,
            pickerPosition: "bottom-left",
            weekStart: true,
            startView: 2,
            minView: 2,
            forceParse: 0,
            language:  'es',     
        });         
        $('#fecha_accidente_trabajo').attr('disabled',false);
        $('#fecha_accidente_trabajo').val($('#fecha_accidente_trabajo_text').val());
        $('#horas').attr('disabled',false);
        $('#horas').val($('#horas_text').val());
        $('#minutos').attr('disabled',false);
        $('#minutos').val($('#minutos_text').val());


       $('#basicBootstrapForm').formValidation('updateStatus', 'rut_hijo','NOT_VALIDATED');  
        $('#basicBootstrapForm').formValidation('updateStatus', 'nombre_hijo','NOT_VALIDATED');
        $('#basicBootstrapForm').formValidation('updateStatus', 'apaterno_hijo','NOT_VALIDATED'); 
        $('#basicBootstrapForm').formValidation('updateStatus', 'amaterno_hijo','NOT_VALIDATED');  
        $('#basicBootstrapForm').formValidation('updateStatus', 'fecnachijo','NOT_VALIDATED');   


        $('#rut_hijo').val('');
        $('#nombre_hijo').val('');
        $('#apaterno_hijo').val('');
        $('#amaterno_hijo').val('');

        $('#rut_hijo').attr('disabled','disabled');
        $('#nombre_hijo').attr('disabled','disabled');
        $('#apaterno_hijo').attr('disabled','disabled');
        $('#amaterno_hijo').attr('disabled','disabled');
        $("#div_fec_nac_hijo").removeClass("form_date");  
        $('#div_fec_nac_hijo').datetimepicker('remove');  
        $('#fecnachijo').val('');
        $('#fecnachijo').attr('disabled','disabled');  



    }else if(tipolicencia == 3 || tipolicencia == 4){
       $('#rut_hijo').attr('disabled',false);
       $('#nombre_hijo').attr('disabled',false);
       $('#apaterno_hijo').attr('disabled',false);
       $('#amaterno_hijo').attr('disabled',false);
       $("#div_fec_nac_hijo").addClass("form_date");    
        $("#div_fec_nac_hijo").datetimepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayBtn: true,
            pickerPosition: "bottom-left",
            weekStart: true,
            startView: 2,
            minView: 2,
            forceParse: 0,
            language:  'es',     
        });         
        $('#fecnachijo').attr('disabled',false);




       $('#basicBootstrapForm').formValidation('updateStatus', 'trayecto','NOT_VALIDATED');  
        $('#basicBootstrapForm').formValidation('updateStatus', 'fecha_accidente_trabajo','NOT_VALIDATED');
        $('#basicBootstrapForm').formValidation('updateStatus', 'horas','NOT_VALIDATED'); 
        $('#basicBootstrapForm').formValidation('updateStatus', 'minutos','NOT_VALIDATED');     
        $('#trayecto').attr('disabled','disabled'); 
        $("#div_fec_acc_trab").removeClass("form_date");  
        $('#div_fec_acc_trab').datetimepicker('remove');  
        $('#fecha_accidente_trabajo').val('');
        
        $('#fecha_accidente_trabajo').attr('disabled','disabled');
        $('#horas').attr('disabled','disabled');
        $('#minutos').attr('disabled','disabled');

      
    }else{

      $('#basicBootstrapForm').formValidation('updateStatus', 'rut_hijo','NOT_VALIDATED');  
        $('#basicBootstrapForm').formValidation('updateStatus', 'nombre_hijo','NOT_VALIDATED');
        $('#basicBootstrapForm').formValidation('updateStatus', 'apaterno_hijo','NOT_VALIDATED'); 
        $('#basicBootstrapForm').formValidation('updateStatus', 'amaterno_hijo','NOT_VALIDATED');  
        $('#basicBootstrapForm').formValidation('updateStatus', 'fecnachijo','NOT_VALIDATED'); 

        $('#basicBootstrapForm').formValidation('updateStatus', 'trayecto','NOT_VALIDATED');  
        $('#basicBootstrapForm').formValidation('updateStatus', 'fecha_accidente_trabajo','NOT_VALIDATED');
        $('#basicBootstrapForm').formValidation('updateStatus', 'horas','NOT_VALIDATED'); 
        $('#basicBootstrapForm').formValidation('updateStatus', 'minutos','NOT_VALIDATED');     
        $('#trayecto').attr('disabled','disabled'); 
        $("#div_fec_acc_trab").removeClass("form_date");  
        $('#div_fec_acc_trab').datetimepicker('remove');  
        $('#fecha_accidente_trabajo').val('');
        
        $('#fecha_accidente_trabajo').attr('disabled','disabled');
        $('#horas').attr('disabled','disabled');
        $('#minutos').attr('disabled','disabled');


        $('#rut_hijo').val('');
        $('#nombre_hijo').val('');
        $('#apaterno_hijo').val('');
        $('#amaterno_hijo').val('');

        $('#rut_hijo').attr('disabled','disabled');
        $('#nombre_hijo').attr('disabled','disabled');
        $('#apaterno_hijo').attr('disabled','disabled');
        $('#amaterno_hijo').attr('disabled','disabled');
        $("#div_fec_nac_hijo").removeClass("form_date");  
        $('#div_fec_nac_hijo').datetimepicker('remove');  
        $('#fecnachijo').val('');
        $('#fecnachijo').attr('disabled','disabled');          

     
    }

  }


  $('#tipo_licencia').change(function(){
    
      evalua_tipo_licencia();

  }); 

  $("#numero_dias").on('input',function(event){

    var valor = $('#numero_dias').val();
    var letras = NumeroALetras(valor);
    if(letras == 'undefined  '){
      $('#numero_dias_palabras').val('');
    }else{
      $('#numero_dias_palabras').val(letras);

    }

});   


  function replaceAll( text, busca, reemplaza ){
  while (text.toString().indexOf(busca) != -1)
      text = text.toString().replace(busca,reemplaza);
  return text;
}



function VerificaRut(rut) {
    if (rut.toString().trim() != '') {
      
        var caracteres = new Array();
        var serie = new Array(2, 3, 4, 5, 6, 7);
        var dig = rut.toString().substr(rut.toString().length - 1, 1);
        rut = rut.toString().substr(0, rut.toString().length - 1);
        for (var i = 0; i < rut.length; i++) {
            caracteres[i] = parseInt(rut.charAt((rut.length - (i + 1))));
        }
 
        var sumatoria = 0;
        var k = 0;
        var resto = 0;
 
        for (var j = 0; j < caracteres.length; j++) {
            if (k == 6) {
                k = 0;
            }
            sumatoria += parseInt(caracteres[j]) * parseInt(serie[k]);
            k++;
        }
 
        resto = sumatoria % 11;
        dv = 11 - resto;
 
        if (dv == 10) {
            dv = "K";
        }
        else if (dv == 11) {
            dv = 0;
        }

        if (dv.toString().trim().toUpperCase() == dig.toString().trim().toUpperCase())
            return true;
        else
            return false;
    }
    else {
        return true;
    }
  }



FormValidation.Validator.validateRut = {
        validate: function(validator, $field, options) {
          var validador = true;
          $field.Rut();
          var rut = $field.val();
          var cleanRut = replaceAll(rut,".","");
          var cleanRut = replaceAll(cleanRut,"-","");
          if(VerificaRut(cleanRut)){
              return true;

          }else{
              return {
                  valid : false
              }

          }


        }
    };


 



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
                numero_licencia: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'N&uacute;mero Licencia es requerido'
                        }
                    }
                  },    
                  fec_emision_licencia: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Fecha Emisi&oacute;n Licencia es requerido'
                        }
                    }
                  }, 
                  fec_inicio_reposo: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Fecha Inicio Reposo es requerido'
                        }
                    }
                  },
                  numero_dias: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'N&uacute;mero de d&iacute;as es requerido'
                        },
                        regexp: {
                            regexp: /^[0-9]+([,][0-9]+)?$/,
                            message: 'Debe ingresar un valor num&eacute;rico'
                        }
                    }
                  },
                  tipo_licencia: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Tipo de Licencia es requerido'
                        }
                    }
                  },
                  recuperabilidad_laboral: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Recuperabilidad Laboral es requerido'
                        }
                    }
                  },
                  inicio_tramite_invalidez: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Inicio Tramite Invalidez es requerido'
                        }
                    }
                  }, 
                  trayecto: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Trayecto es requerido'
                        }
                    }
                  }, 
                  fecha_accidente_trabajo: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Fecha Accidente Trabajo es requerido'
                        }
                    }
                  }, 
                  horas: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Hora Accidente Trabajo es requerido'
                        }
                    }
                  }, 
                  minutos: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Minuto Accidente Trabajo es requerido'
                        }
                    }
                  },
                  rut_hijo: {
                        row: '.form-group',
                        validators: {
                            stringLength: {
                                min: 0,
                                max: 12,
                                message: 'El largo del Rut es Incorrecto'
                            },
                            validateRut: {
                              message: 'Rut Incorrecto'
                            }

                        }
                    },
                    tipo_reposo: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Tipo de Reposo es requerido'
                                  }
                                }
                    },                    
                    tipo_reposo_parcial: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Tipo de Reposo Parcial es requerido'
                                  }
                                }
                    },
                    lugar_reposo: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Lugar de Reposo Parcial es requerido'
                                  }
                                }
                    },
                    justificar_otro_domicilio: {
                    row: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'Justificaci&oacute;n otro domicilio es requerido'
                                  }
                                }
                    },
                    telefono_reposo: {
                              row: '.form-group',
                              validators: {
                                  integer: {
                                      message: 'Fono s&oacute;lo puede contener n&uacute;meros'
                                  }                
                              }
                          },  
                     rut_profesional: {
                        row: '.form-group',
                        validators: {
                            stringLength: {
                                min: 0,
                                max: 12,
                                message: 'El largo del Rut es Incorrecto'
                            },
                            validateRut: {
                              message: 'Rut Incorrecto'
                            }

                        }
                    },
                    correo_profesional: {
                          row: '.form-group',
                          validators: {
                              emailAddress: {
                                  message: 'El valor ingresado no es una direcci&oacute; de email valida'
                              }                    
                          }
                      }, 

                      telefono_profesional: {
                              row: '.form-group',
                              validators: {
                                  integer: {
                                      message: 'Fono s&oacute;lo puede contener n&uacute;meros'
                                  }                
                              }
                          }


                    
                    
               }
    })
 // Called when a field is invalid
        .on('err.field.fv', function(e, data) {
            // data.element --> The field element

            var $tabPane = data.element.parents('.tab-pane'),
                tabId    = $tabPane.attr('id');

                console.log(tabId);

            $('a[href="#' + tabId + '"][data-toggle="tab"]')
                .parent()
                .find('i')
                .removeClass('fa-check')
                .addClass('fa-times');

        })
        // Called when a field is valid
        .on('success.field.fv', function(e, data) {
            // data.fv      --> The FormValidation instance
            // data.element --> The field element

            var $tabPane = data.element.parents('.tab-pane'),
                tabId    = $tabPane.attr('id'),
                $icon    = $('a[href="#' + tabId + '"][data-toggle="tab"]')
                            .parent()
                            .find('i')
                            .removeClass('fa-check fa-times');

            // Check if all fields in tab are valid
            var isValidTab = data.fv.isValidContainer($tabPane);
            if (isValidTab !== null) {
                $icon.addClass(isValidTab ? 'fa-check' : 'fa-times');
            }
        })

 })



</script>        

<script> 
   //verifica campos que deben estar habilitados
   $(document).ready(function() {
      
        evalua_tipo_licencia();
        evalua_tipo_reposo();
        evalua_lugar_reposo();
        

   });


  </script>     