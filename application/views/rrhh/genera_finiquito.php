

<form id="basicBootstrapForm" action="<?php echo base_url();?>rrhh/submit_genera_finiquito" method="post" role="form" enctype="multipart/form-data">

                      <div class="panel panel-inverse">                       
                          <div class="panel-heading">
                                <h4 class="panel-title">Colaborador</h4>
                            </div>
                      <div class="panel-body">
                       <div class="graph-visual tables-main">
                    <div class="graph">
                    <div class="tab-content">
                      <div class="tab-pane active" id="datospersonales">
                        <section id="personales">
                          <div class='row'>
                                          <div class='col-md-6'>
                                            <div class="form-group">
                                              <label for="rut">Rut</label>
                                              <input type="text" name="rut" id="rut"  class="form-control"  placeholder="<?php echo $personal->rut."-".$personal->dv;?>" title="Escriba Rut" readonly  >
                                            </div>
                                          </div>
                                          <div class='col-md-6'>
                                            <div class="form-group">
                                                <label for="nombre">Fecha Ingreso</label>  
                                                 <input type="text" name="fechaingreso" id="fechaingreso" class="form-control" id="" placeholder="<?php echo $personal->fecingreso_format;?>" readonly >
                                            </div>
                                          </div>

                          </div>
                           <div class='row'>
                                          <div class='col-md-6'>
                                            <div class="form-group">
                                              <label for="rut">Nombre Completo</label>
                                              <input type="text" name="nombre" class="form-control" id="nombre" placeholder="<?php echo $personal->nombre." ".$personal->apaterno." ".$personal->amaterno;?>" disabled>
                                            </div>
                                          </div>
                                          <div class='col-md-6'>
                                            <div class="form-group">
                                                <label for="nombre">Dirección</label>  
                                                  <input type="text" name="direccion" id="direccion" class="form-control required" placeholder="<?php echo $personal->direccion;?>" data-toggle="modal" data-target="#myModalDireccion" size="40" disabled>
                                            </div>
                                          </div>

                          </div>
                          <div class='row'>
                                          <div class='col-md-6'>
                                            <div class="form-group">
                                              <label for="rut">Email</label>
                                              <input type="text" name="email" id="email" class="form-control" placeholder="<?php echo $personal->email;?>" disabled>
                                            </div>
                                          </div>
                                         

                          </div>                          

                         
                          </section>
                      </div>   
                      </div><!-- /.box-body -->                 
                  </div> 
                    <div class="panel panel-inverse">                       
                      <div class="panel-heading">
                        <h4 class="panel-title">Datos Generales</h4>
                      </div>
                      <div class="panel-body">
                        <div class='row'>
                          <!--div class='col-md-4'>
                            <div class="form-group">
                              <label for="caja">Tipo Finiquito</label>    
                               <select name="tipo" id="tipocontrato" class="form-control1" required>
                              <?php foreach ($tipocontrato as $tipo) { ?>
                                <?php $paisselected = $tipo->id == $datos_form['id_tipo_doc_colaborador'] ? "selected" : "Tipo Contrato"; ?>
                                <option value="<?php echo $tipo->tipo;?>" <?php echo $paisselected;?> ><?php echo $tipo->tipo;?></option>
                              <?php } ?>
                            </select>

                            </div>  
                          </div-->
                            

                           <div class='col-md-4'>
                             <tbody>
                              <td>
                                <input type="hidden" name="idtrabajador" id="idtrabajador" class="form-control1" required id="" value="<?php echo $personal->id_personal;?>">
                              </td>                           
                            </tbody>
                          
                          </div>                                                
                      </div><!-- /.box-body -->
                      <div class="row">
                        <div class="col-md-12">
                          <p class="text-center"></p>
                        </div>
                      </div>
                      <div class="row">
                        <div class='col-md-4'>
                          <div class="form-group">
                            <label for="rut">Art&iacute;culo Causal Finiquito</label>
                            <select class="form-control fecha_calc_dias" name="causalfiniquito" id="causalfiniquito">
                                <!--option value="">Seleccione Causal Finiquito</option-->
                                <?php foreach ($causales_finiquito as $causal_finiquito) { ?>
                                  <?php 
                                      if($idfiniquito != 0){
                                        $art_selected = $causal_finiquito->idcausal == $finiquito->idcausal ? 'selected' : ''; 
                                      }else{
                                        $art_selected = $causal_finiquito->articulo == 'Art. 161' ? 'selected' : ''; 
                                      }

                                  
                                  ?>
                                  <option value="<?php echo $causal_finiquito->idcausal;?>" <?php echo $art_selected; ?> data-articulo="<?php echo $causal_finiquito->articulo;?>"><?php echo str_pad($causal_finiquito->articulo,20,' ',STR_PAD_LEFT)." | ".$causal_finiquito->motivo;?></option>
                                <?php } ?>                            
                               </select>
                          </div>

                        </div>


                        <div class='col-md-4'>
                          <div class="form-group">
                            <label for="rut">Fecha Contrato</label>
                            <input placeholder="Fecha Contrato" name="fechacontrato" id="fechacontrato" class="form-control fecha_calc_dias" required  type="text" value="<?php echo $personal->fecrealcontrato_format;?>" onblur="if (this.value == '') {this.value = '';}" readonly />
                          </div>

                        </div>

                        <div class='col-md-4'>
                          <div class="form-group">
                            <label for="rut">Fecha Aviso Despido</label>

                            <input type="text" name="fechaaviso" id="fechaaviso" class="form-control fecha_calc_dias"  value="<?php echo $idfiniquito == 0 ? date('d/m/Y') : formato_fecha($finiquito->fechaaviso,'Y-m-d','d/m/Y') ;?>" readonly >

                          </div>

                        </div>                                                    
                      </div>


                      <div class="row">
                        <div class='col-md-4'>
                          <div class="form-group">
                            <label for="rut">Fecha Finiquito </label>
                            <input placeholder="Fecha Finiquito" name="fechafiniquito" id="fechafiniquito" class="form-control fecha_calc_dias" required  type="text" value="<?php echo $idfiniquito == 0 ? date('d/m/Y') : formato_fecha($finiquito->fechafiniquito,'Y-m-d','d/m/Y') ;?>" onblur="if (this.value == '') {this.value = '';}" readonly/>
                          </div>

                        </div>


                        <div class='col-md-4'>
                          <div class="form-group">
                            <label for="rut">Total d&iacute;as trabajados</label>
                            <input placeholder="D&iacute;as Trabajados" name="diastrabajados" id="diastrabajados" class="form-control" required  type="text" value="<?php echo $idfiniquito == 0 ? '' : $finiquito->totaldiastrabajados ;?>"  onblur="if (this.value == '') {this.value = '';}" readonly/>
                          </div>

                        </div>


                        <div class='col-md-4'>
                          <div class="form-group">
                            <label for="rut">Total d&iacute;as aviso</label>
                            <input placeholder="D&iacute;as Aviso" name="diasaviso" id="diasaviso" class="form-control" required  type="text" value="<?php echo $idfiniquito == 0 ? '' : $finiquito->totaldiasaviso ;?>"  onblur="if (this.value == '') {this.value = '';}" readonly/>
                          </div>

                        </div>                                                    
                      </div>    


                      <div class="row">
                        <div class='col-md-4'>
                          <div class="form-group">
                            <label for="rut">Factor c&aacute;lculo diario </label>
                            <input placeholder="Factor C&aacute;lculo Diario" name="fcalculodiario" id="fcalculodiario" class="form-control" required  type="text" value="<?php echo $idfiniquito == 0 ? '' : $finiquito->factorcalculodiario ;?>"  onblur="if (this.value == '') {this.value = '';}" readonly/>
                          </div>

                        </div>


                        <div class='col-md-4'>
                          <div class="form-group">
                            <label for="rut">A&ntilde;os de Servicio </label>
                            <input placeholder="A&ntilde;os de Servicio" name="annosservicio" id="annosservicio" class="form-control" required  type="text" value="<?php echo $idfiniquito == 0 ? '' : $finiquito->annosservicio ;?>"  onblur="if (this.value == '') {this.value = '';}" readonly/>
                          </div>

                        </div>                                                  
                      </div>                                          
                    </div>
                  </div>

                    <div class="panel panel-inverse">                       
                      <div class="panel-heading">
                        <h4 class="panel-title">Datos Vacaciones</h4>
                      </div>
                      <div class="panel-body">
                        <div class='row'>

                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Total Vacaciones </label>
                              <input placeholder="Total Vacaciones" name="totalvacaciones" id="totalvacaciones" class="form-control" required  type="text" value="<?php echo $idfiniquito == 0 ? (number_format($array_vacaciones['dias_vacaciones'] + $array_vacaciones['num_dias_progresivos'],2,",",".")) : str_replace('.',',',$finiquito->totalvacaciones);?>"  onblur="if (this.value == '') {this.value = '';}" readonly />
                            </div>

                          </div>


                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">D&iacute;as Vacaciones Tomados</label>
                              <input placeholder="D&iacute;as Vacaciones Tomados" name="vacacionestomados" id="vacacionestomados" class="form-control" required  type="text" value="<?php echo $idfiniquito == 0 ? $personal->diasvactomados : $finiquito->diasvacacionestomados; ?>"  onblur="if (this.value == '') {this.value = '';}" readonly />
                            </div>

                          </div>


                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Saldo Vacaciones</label>
                              <input placeholder="Saldo Vacaciones" name="saldovacaciones" id="saldovacaciones" class="form-control" required  type="text" value="<?php echo $idfiniquito == 0 ? number_format($array_vacaciones['dias_vacaciones'] + $array_vacaciones['num_dias_progresivos'] - $personal->diasvactomados,2,",",".") : str_replace('.',',',$finiquito->saldovacaciones); ?>"  onblur="if (this.value == '') {this.value = '';}" readonly />
                            </div>

                          </div>  


                        </div>


                        <div class='row'>

                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">D&iacute;as Inh&aacute;biles Posteriores </label>
                              <input placeholder="D&iacute;as Inh&aacute;biles Posteriores" name="diasinhabiles" id="diasinhabiles" class="form-control numeros" required  type="text" value="<?php echo $idfiniquito == 0 ? '0' : $finiquito->diasinhabilespost ;?>"  readonly />
                            </div>

                          </div>


                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Total Vacaciones Pendientes</label>
                              <input placeholder="Total Vacaciones Pendientes" name="totvacpendientes" id="totvacpendientes" class="form-control" required  type="text" value="<?php echo $idfiniquito == 0 ? (number_format($array_vacaciones['dias_vacaciones'] + $array_vacaciones['num_dias_progresivos'] - $personal->diasvactomados,2,",",".")) : $finiquito->totalvacacionespendientes; ?>"  onblur="if (this.value == '') {this.value = '';}" readonly/>
                            </div>

                          </div>

                        </div>                        
                      </div>
                    </div>


                     <div class="panel panel-inverse">                       
                      <div class="panel-heading">
                        <h4 class="panel-title">Contrato</h4>
                      </div>
                      <div class="panel-body">
                        <div class='row'>


                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Sueldo Base </label>
                              <input placeholder="" name="sueldobase" id="sueldobase" class="form-control" required  type="text" value="<?php echo $idfiniquito == 0 ? '0' : number_format($finiquito->sueldobase,0,'.','.');?>"  readonly />
                            </div>

                          </div>
                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Gratificaci&oacute;n</label>
                              <input placeholder="" name="gratificacion" id="gratificacion" class="form-control" required  type="text" value="<?php echo $idfiniquito == 0 ? '0' : number_format($finiquito->gratificacion,0,'.','.');?>"  readonly />
                            </div>
                          </div>


                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Comisiones</label>
                              <input placeholder="" name="comisiones" id="comisiones" class="form-control" required  type="text" value="<?php echo $idfiniquito == 0 ? '0' : number_format($finiquito->comisiones,0,'.','.');?>"  readonly />
                            </div>
                          </div>

                        
                        </div>

                        <div class='row'>
                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Movilizaci&oacute;n </label>
                              <input placeholder="" name="movilizacion" id="movilizacion" class="form-control" required  type="text" value="<?php echo $idfiniquito == 0 ? '0' : number_format($finiquito->movilizacion,0,'.','.');?>" readonly />
                            </div>

                          </div>    

                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Colaci&oacute;n</label>
                              <input placeholder="" name="colacion" id="colacion" class="form-control" required  type="text" value="<?php echo $idfiniquito == 0 ? '0' : number_format($finiquito->colacion,0,'.','.');?>"  readonly />
                            </div>

                          </div>


                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Base C&aacute;lculo Años Servicio/Mes Aviso</label>
                              <input placeholder="" name="vtotalcont" id="vtotalcont" class="form-control" required  type="text" value="<?php echo $idfiniquito == 0 ? '0' : number_format($finiquito->basecalculoannosservicio,0,'.','.');?>"  readonly />
                            </div>
                          </div>                         
                        </div>


                        <div class='row'>

                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Base C&aacute;lculo Vacaciones Proporcionales</label>
                              <input placeholder="" name="vtotalcont_vac" id="vtotalcont_vac" class="form-control" required  type="text" value="<?php echo $idfiniquito == 0 ? '0' : number_format($finiquito->basecalculovacaciones,0,'.','.');?>"  readonly />
                            </div>
                          </div>                         
                        </div>
                      </div>
                    </div>

          
                     <div class="panel panel-inverse">                       
                      <div class="panel-heading">
                        <h4 class="panel-title">Indemnizaciones</h4>
                      </div>
                      <div class="panel-body">
                        <div class='row'>



                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Indemnización Sustitutiva Mes de Aviso</label>
                              <input type="text" name="indmesaviso" id="indmesaviso" class="form-control miles required indemnizacion"  placeholder="Ingrese Monto" size="20" value="<?php echo $idfiniquito == 0 ? '0' : number_format($finiquito->indemnizacionmesaviso,0,'.','.');?>" readonly>
                               <p class="help-block"><small>(*) Aplica s&oacute;lo si no se di&oacute; aviso con 30 d&iacute;as de anticipaci&oacute;n y s&oacute;lo para causales del art&iacute;culo 161</small></p>
                            </div>


                          </div>


                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Indemnizacion Años de Servicio</label>
                              <input type="text" name="indannoservicio" id="indannoservicio" class="form-control miles required indemnizacion" placeholder="Ingrese Monto" value="<?php echo $idfiniquito == 0 ? '0' : number_format($finiquito->indemnizacionannosservicio,0,'.','.');?>" size="20" readonly>
                            </div>

                          </div>   



                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Indemnización Feriado Legal</label>
                              <input type="text" class="form-control miles indemnizacion" name="indferiadolegal" id="indferiadolegal" placeholder="Ingrese Indemnizaci&oacute;n Feriado Legal" value="<?php echo $idfiniquito == 0 ? '0' : number_format($finiquito->indemnizacionferiadolegal,0,'.','.');?>" readonly>
                            </div>

                          </div>


                        </div>


                        <div class='row'>

                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Remuneraci&oacute;n Pendiente </label>
                              <input type="text" name="rem_pendiente" id="rem_pendiente" class="form-control miles required indemnizacion" placeholder="Ingrese Monto" value="<?php echo $idfiniquito == 0 ? '0' : number_format($finiquito->rempendiente,0,'.','.');?>" size="20" <?php echo $idfiniquito == 0 ? '' : 'readonly';?>>
                            </div>

                          </div>



                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Indemnizacion Voluntaria</label>
                              <input type="text" class="form-control miles indemnizacion" name="indvoluntaria" id="indvoluntaria" placeholder="Ingrese Indemnizaci&oacute;n Voluntaria" value="<?php echo $idfiniquito == 0 ? '0' : number_format($finiquito->indemnizacionvoluntaria,0,'.','.');?>" <?php echo $idfiniquito == 0 ? '' : 'readonly';?>>
                            </div>

                          </div>


                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Desahucio</label>
                              <input type="text" name="desahucio" id="desahucio" class="form-control miles required indemnizacion" placeholder="Ingrese Monto" size="20" value="<?php echo $idfiniquito == 0 ? '0' : number_format($finiquito->desahucio,0,'.','.');?>" <?php echo $idfiniquito == 0 ? '' : 'readonly';?>>
                            </div>

                          </div>   

                        </div> 

                        <div class='row'>


                          <div class='col-md-4'>
                              <div class="form-group">
                                  <label for="indtotal">Total Indemnizaci&oacute;nes</label>
                                  <input type="text" class="form-control miles" name="indtotal" id="indtotal" value="<?php echo $idfiniquito == 0 ? '0' : number_format($finiquito->totalindemnizaciones,0,'.','.');?>" readOnly>
                                  <p class="help-block"><small>(*) Datos requeridos para LRE.  En caso de no ingresar ser&aacute;n informados en cero .</small></p>
                              </div>

                          </div>

                        </div> 

                      </div>
                    </div>
                        
                     <div class="panel panel-inverse">                       
                      <div class="panel-heading">
                        <h4 class="panel-title">Descuentos</h4>
                      </div>
                      <div class="panel-body">
                        <div class='row'>


                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Prestamo Empresa</label>
                              <input type="text" name="prestamo" id="prestamo" class="form-control miles required descuento" placeholder="Ingrese Monto" size="20"  value="<?php echo $idfiniquito == 0 ? '0' : number_format($finiquito->prestamoempresa,0,'.','.');?>" <?php echo $idfiniquito == 0 ? '' : 'readonly';?>>
                            </div>

                          </div>


                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Prestamo C.C.A.F</label>
                              <input type="text" name="cajacompensacion" id="cajacompensacion" class="form-control miles required descuento" placeholder="Ingrese Monto" size="20" value="<?php echo $idfiniquito == 0 ? '0' : number_format($finiquito->prestamoccaf,0,'.','.');?>" <?php echo $idfiniquito == 0 ? '' : 'readonly';?>>
                            </div>

                          </div>


                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Otros</label>
                              <input type="text" name="otros" id="otros" class="form-control miles required descuento" placeholder="Ingrese Monto" size="20" value="<?php echo $idfiniquito == 0 ? '0' : number_format($finiquito->otros,0,'.','.');?>" <?php echo $idfiniquito == 0 ? '' : 'readonly';?>>
                            </div>

                          </div> 


                        </div>


                        <div class='row'>


                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Total Descuentos</label>
                              <input type="number" name="totaldescuentos" id="totaldescuentos" class="form-control required" placeholder="Ingrese Monto" size="20" value="<?php echo $idfiniquito == 0 ? '0' : number_format($finiquito->totaldescuentos,0,'.','.');?>" readonly>
                            </div>

                          </div>




                        </div>

                      </div>
                    </div>


                    <div class="panel panel-inverse">                       
                      <div class="panel-heading">
                        <h4 class="panel-title">Totales</h4>
                      </div>
                      <div class="panel-body">
                        <div class='row'>


                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Total Indemnizaciones</label>
                              <input type="text" name="totalgenindemnizaciones" id="totalgenindemnizaciones" class="form-control required totalgen" placeholder="Ingrese Monto" size="20" readonly >
                            </div>

                          </div>


                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Total Descuentos</label>
                              <input type="text" name="totalgendescuentos" id="totalgendescuentos" class="form-control required totalgen" placeholder="Ingrese Monto" size="20" readonly>
                            </div>

                          </div>


                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="rut">Total Finiquito</label>
                              <input type="text" name="totalgenfiniquito" id="totalgenfiniquito" class="form-control required totalgen" placeholder="Ingrese Monto" size="20" readonly>
                            </div>

                          </div> 

                        </div>
                      </div>



                      <div class="panel-footer">
                        <?php if($idfiniquito == 0){ ?>
                       <button type="submit" class="btn btn-primary">Guardar</button>&nbsp;&nbsp;
                     <?php } ?>
                        <a  href="<?php echo base_url();?>auxiliares/calcular_finiquito"  class="btn btn-warning">Volver</a>
                      </div>

                    </div>

                  </div> 
                  </div>
    </form>                   




<script>

  /*  function obtiene_datos_finiquito(){
       console.log('datos')

        var idtrabajador = $('#idtrabajador').val();

       $.ajax({
            type: "GET",
            url: '<?php echo base_url();?>rrhh/get_datos_finiquito/'+idtrabajador,
            dataType: 'json',
            async: false,
        }).success(function(data) {
              console.log(data);
              //console.log(data.mes_aviso);

              $('#indmesaviso').val(data.mes_aviso);
              $('#indannoservicio').val(data.renta_antiguedad);
              $('#indferiadolegal').val(data.renta_vacaciones);
              if($('#indvoluntaria').val() == ''){
                    $('#indvoluntaria').val(0);  
              }
              

              sessionStorage.setItem('indmesaviso',data.mes_aviso);
              sessionStorage.setItem('indannoservicio',data.renta_antiguedad);

              
              activa_desactiva_finiquito();
              calcular_finiquito();
        });




    }

    */

    function calcular_finiquito(){

        var rem_pendiente = $('#rem_pendiente').val();
        var indmesaviso = $('#indmesaviso').val();
        var indannoservicio = $('#indannoservicio').val();
        var indferiadolegal = $('#indferiadolegal').val();
        var indvoluntaria = $('#indvoluntaria').val();
        var desahucio = $('#desahucio').val();

        rem_pendiente = rem_pendiente == '' ? 0 : parseInt(replaceAll(rem_pendiente, ".", ""));
        indmesaviso = indmesaviso == '' ? 0 : parseInt(replaceAll(indmesaviso, ".", ""));
        indannoservicio = indannoservicio == '' ? 0 : parseInt(replaceAll(indannoservicio, ".", ""));
        indferiadolegal = indferiadolegal == '' ? 0 : parseInt(replaceAll(indferiadolegal, ".", ""));
        indvoluntaria = indvoluntaria == '' ? 0 : parseInt(replaceAll(indvoluntaria, ".", ""));
        desahucio = desahucio == '' ? 0 : parseInt(replaceAll(desahucio, ".", ""));

        var indtotal = rem_pendiente + indmesaviso + indannoservicio + indferiadolegal + indvoluntaria + desahucio;

        $('#indtotal').val(number_format(indtotal, 0, '.', '.'));    

        $('#totalgenindemnizaciones').val(number_format(indtotal, 0, '.', '.'));    

        calcular_total_gen();

    }


    function calcular_descuento(){

        var prestamo = $('#prestamo').val();
        var cajacompensacion = $('#cajacompensacion').val();
        var otros = $('#otros').val();


        prestamo = prestamo == '' ? 0 : parseInt(replaceAll(prestamo, ".", ""));
        cajacompensacion = cajacompensacion == '' ? 0 : parseInt(replaceAll(cajacompensacion, ".", ""));
        otros = otros == '' ? 0 : parseInt(replaceAll(otros, ".", ""));


        var totaldescuentos = prestamo + cajacompensacion + otros;

        $('#totaldescuentos').val(number_format(totaldescuentos, 0, '.', '.'));    

        $('#totalgendescuentos').val(number_format(totaldescuentos, 0, '.', '.'));  


        calcular_total_gen();  

    }




    function calcular_total_gen(){

        var totalgenindemnizaciones = $('#totalgenindemnizaciones').val();
        var totalgendescuentos = $('#totalgendescuentos').val();

        totalgenindemnizaciones = totalgenindemnizaciones == '' ? 0 : parseInt(replaceAll(totalgenindemnizaciones, ".", ""));
        totalgendescuentos = totalgendescuentos == '' ? 0 : parseInt(replaceAll(totalgendescuentos, ".", ""));

        var totalgen = totalgenindemnizaciones - totalgendescuentos;
        $('#totalgenfiniquito').val(number_format(totalgen, 0, '.', '.'));  

    }

    function calcular_total_vacaciones(){


        var saldovacaciones = $('#saldovacaciones').val();
        var diasinhabiles = $('#diasinhabiles').val();

        saldovacaciones = saldovacaciones == '' ? 0 : parseFloat(replaceAll(replaceAll(saldovacaciones, ".", ""),",","."));
        diasinhabiles = diasinhabiles == '' ? 0 : parseFloat(replaceAll(replaceAll(diasinhabiles, ".", ""),",","."));

        var totvacpendientes = saldovacaciones + diasinhabiles;
        $('#totvacpendientes').val(number_format(totvacpendientes, 2, '.', '.'));


    }

    $('.descuento').on('input',function(){

                calcular_descuento();


    })


    $('.indemnizacion').on('input',function(){

                calcular_finiquito();


    })


   /* function activa_desactiva_finiquito(){

        var causalfiniquito = $('#causalfiniquito').val();

        if(causalfiniquito == 14 || causalfiniquito == ''){ //necesidades de la empresa

                $('#indmesaviso').attr('readonly',false);
                //$('#indmesaviso').val(sessionStorage.getItem('indmesaviso'));
                $('#indannoservicio').attr('readonly',false);
                //$('#indannoservicio').val(sessionStorage.getItem('indannoservicio'));

        }else if(causalfiniquito == 15){ //liquidacion de bienes

                $('#indmesaviso').attr('readonly','readonly');
                $('#indmesaviso').val(0);
                $('#indannoservicio').attr('readonly',false);
                //$('#indannoservicio').val(sessionStorage.getItem('indannoservicio'));

        }else{ //lo demas

                $('#indmesaviso').attr('readonly','readonly');
                $('#indmesaviso').val(0);


                $('#indannoservicio').attr('readonly','readonly');
                $('#indannoservicio').val(0);
        }



    }
  */


  /*  $('#causalfiniquito').on('change',function(){

        obtiene_datos_finiquito();        
    })

  */

  $(function() {

<?php if($idfiniquito == 0){ ?>

    $( "#fechaingreso,#fechafiniquito,#fechaaviso").datetimepicker({
        format: "dd/mm/yyyy",
        //format: "yyyy-mm-dd",
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left",
        weekStart: true,
        startView: 2,
        minView: 2,
        forceParse: 0,
        language:  'es', 
});

<?php } ?>




    $('#diasinhabiles').on('input',function(){

                calcular_total_vacaciones();


    })



  });
</script>  
<script>

    $(document).ready(function() {



      $('.fecha_calc_dias').change(function(){


        $('#indmesaviso').attr('readonly','readonly');


        var causal_finiquito = $('#causalfiniquito').find(':selected').data('articulo');

        var fechacontrato = $('#fechacontrato').val();
        var fechafiniquito = $('#fechafiniquito').val();
        var fechaaviso = $('#fechaaviso').val();

       // var fecha1 = 
        //console.log((fechacontrato.format('yyyy-mm-dd')));
        var fecha1 = moment(fechacontrato.substring(6)+'-'+fechacontrato.substring(3,5)+'-'+fechacontrato.substring(0,2));
        var fecha2 = moment(fechafiniquito.substring(6)+'-'+fechafiniquito.substring(3,5)+'-'+fechafiniquito.substring(0,2));

       // console.log(fechacontrato)
      //  console.log(fechacontrato.substring(6)+'-'+fechacontrato.substring(3,5)+'-'+fechacontrato.substring(0,2));
        //console.log(fecha2.diff(fecha1, 'days'), ' dias de diferencia');
        var diastrabajados = fecha2.diff(fecha1, 'days')+1;
        $('#diastrabajados').val(diastrabajados);
        var factor_calculo_diario = Math.round((diastrabajados/365)*10)/10;
        var annos_servicio = Math.round((diastrabajados/365));
        var vac_otorgadas = annos_servicio*15;
        annos_servicio = annos_servicio > 11 ? 11 : annos_servicio;

        $('#fcalculodiario').val(factor_calculo_diario);
        $('#annosservicio').val(annos_servicio);


        var art_161 = false;
        var art_163 = false;
        if($('#causalfiniquito').val() != ''){
          if (causal_finiquito.indexOf("161") >= 0){
            art_161 = true;
          
          }   

          if (causal_finiquito.indexOf("163") >= 0){
            art_163 = true;
          
          }                        
        }

       //console.log(causal_finiquito);


        var fecha1 = moment(fechaaviso.substring(6)+'-'+fechaaviso.substring(3,5)+'-'+fechaaviso.substring(0,2));
        var fecha2 = moment(fechafiniquito.substring(6)+'-'+fechafiniquito.substring(3,5)+'-'+fechafiniquito.substring(0,2));



       var fechafiniquito_consulta = fechafiniquito.substring(6)+fechafiniquito.substring(3,5)+fechafiniquito.substring(0,2);
       var saldovacaciones = parseInt($('#saldovacaciones').val());
       var idtrabajador = $('#idtrabajador').val();

       $.ajax({
            type: "GET",
            url: '<?php echo base_url();?>rrhh/get_valores_finiquito/'+idtrabajador+'/'+fechafiniquito_consulta+'/'+saldovacaciones,
            dataType: 'json',
            async: false,
        }).success(function(data) {
          $('#diasinhabiles').val(data.dias_inhabiles);
          $('#sueldobase').val(number_format(data.sueldobase, 0, '.', '.'));
          $('#gratificacion').val(number_format(data.gratificacion, 0, '.', '.'));
          $('#comisiones').val(number_format(data.comisiones, 0, '.', '.'));
          $('#movilizacion').val(number_format(data.movilizacion, 0, '.', '.'));
          $('#colacion').val(number_format(data.colacion, 0, '.', '.'));
          calcular_total_vacaciones();
        });


        //var fecha1 = moment(fechaaviso);
        //var fecha2 = moment(fechafiniquito);

        var diasaviso = fecha2.diff(fecha1, 'days');
        $('#diasaviso').val(diasaviso);
        var vtotalcont = parseInt(replaceAll($('#sueldobase').val(), ".", "")) + parseInt(replaceAll($('#gratificacion').val(), ".", "")) +  parseInt(replaceAll($('#comisiones').val(), ".", "")) +  parseInt(replaceAll($('#movilizacion').val(), ".", "")) +  parseInt(replaceAll($('#colacion').val(), ".", ""));
        var vtotalcont_vac = parseInt(replaceAll($('#sueldobase').val(), ".", "")) +  parseInt(replaceAll($('#comisiones').val(), ".", "")) +  parseInt(replaceAll($('#movilizacion').val(), ".", "")) +  parseInt(replaceAll($('#colacion').val(), ".", ""));


        $('#vtotalcont').val(number_format(vtotalcont, 0, '.', '.'));
        $('#vtotalcont_vac').val(number_format(vtotalcont_vac, 0, '.', '.'));


        if(diasaviso <= 30 && art_161){

            $('#indmesaviso').val(number_format(vtotalcont, 0, '.', '.'))
        }else{
            $('#indmesaviso').val(0)

        }


        var ind_annos_servicio =  parseInt(vtotalcont)*parseInt(annos_servicio);
        if(art_161 || art_163){
            
            $('#indannoservicio').val(number_format(ind_annos_servicio, 0, '.', '.'));
        }else{
            $('#indannoservicio').val(0)
        }





        var ind_feriado_legal =  parseInt(vtotalcont_vac)/30*parseFloat($('#totvacpendientes').val());


        $('#indferiadolegal').val(number_format(ind_feriado_legal, 0, '.', '.'));
         calcular_descuento();
        calcular_finiquito();
      });


       $('.fecha_calc_dias').trigger('change');

      $('#vacacionestomados').on('input',function(){

        var vac_otorgadas = $('#totalvacaciones').val();
        var vac_tomadas = $(this).val();

        var saldo_vacaciones = vac_otorgadas - vac_tomadas;

        $('#saldovacaciones').val(saldo_vacaciones);

      });


      $('')


     

      var cerrado = false;
     
  
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




        $('div#sel_all').on('click',function(){

        })

       

    });


$(document).ready(function(){
 $('.miles').mask('000.000.000.000.000', {reverse: true})    


   $('.numeros').keypress(function(event){
    if ((event.keyCode < 48 || event.keyCode > 57) && event.keyCode != 44){
      event.preventDefault();
    } 
  })      

});




</script>   

             