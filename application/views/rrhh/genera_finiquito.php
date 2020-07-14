<form target="_blank" id="basicBootstrapForm" action="<?php echo base_url();?>rrhh/submit_genera_finiquito" method="post" role="form" enctype="multipart/form-data">

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
                                                 <input type="text" name="fechaingreso" id="fechaingreso" class="form-control" id="" placeholder="<?php echo $personal->fecingreso;?>" readonly >
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
                        <h4 class="panel-title">Genera Finiquitos</h4>
                      </div>
                      <div class="panel-body">
                        <div class='row'>
                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="caja">Tipo Finiquito</label>    
                               <select name="tipo" id="tipocontrato" class="form-control1" required>
                              <?php foreach ($tipocontrato as $tipo) { ?>
                                <?php $paisselected = $tipo->id == $datos_form['id_tipo_doc_colaborador'] ? "selected" : "Tipo Contrato"; ?>
                                <option value="<?php echo $tipo->tipo;?>" <?php echo $paisselected;?> ><?php echo $tipo->tipo;?></option>
                              <?php } ?>
                            </select>

                            </div>  
                          </div>
                            

                           <div class='col-md-4'>
                             <tbody>
                              <td>
                                <input type="hidden" name="idtrabajador" id="idtrabajador" class="form-control1" required id="" value="<?php echo $personal->id_personal;?>">
                              </td>                           
                            </tbody>
                          
                          </div>                                                
                      </div><!-- /.box-body -->

                      <div class="container">
                      <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                              <table class="table users table-hover">
                                <thead>
                        <tr class="active" class="info">
                          <th><p class="text-center">DATOS GENERALES</p></th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                        </tr>
                        <tr>
                          <td>Art&iacute;culo Causal Finiquito </td>
                          <td> <select class="form-control fecha_calc_dias" name="causal_finiquito" id="causal_finiquito">
                                <option value="">Seleccione Causal Finiquito</option>
                                <?php foreach ($causales_finiquito as $causal) { ?>
                                  
                                  <option value="<?php echo $causal->idcausal;?>" data-articulo="<?php echo $causal->articulo;?>"><?php echo $causal->articulo." - ".$causal->motivo;?></option>
                                <?php } ?>                            
                               </select>
                           </td>
                           <th>&nbsp;</th>
                        </tr>
                        <tr>
                          <td>Fecha Contrato </td>
                          <td><input placeholder="Fecha Contrato" name="fechacontrato" id="fechacontrato" class="form-control fecha_calc_dias" required  type="text" value="<?php echo $personal->fecrealcontrato;?>" onblur="if (this.value == '') {this.value = '';}" readonly />
                           </td>
                           <th>&nbsp;</th>
                        </tr>
                        <tr>
                          <td>Fecha Aviso Despido </td>
                          <td><input placeholder="Fecha Aviso Despido" name="fechaaviso" id="fechaaviso" class="form-control fecha_calc_dias" required  type="text" value="" onblur="if (this.value == '') {this.value = '';}"  />
                           </td>
                           <th>&nbsp;</th>
                        </tr>
                        <tr>
                          <td>Fecha Finiquito </td>
                          <td><input placeholder="Fecha Finiquito" name="fechafiniquito" id="fechafiniquito" class="form-control fecha_calc_dias" required  type="text" value="" onblur="if (this.value == '') {this.value = '';}" />
                           </td>
                           <th>&nbsp;</th>
                        </tr>
                        <tr>
                          <td>Total d&iacute;as trabajados </td>
                          <td><input placeholder="D&iacute;as Trabajados" name="diastrabajados" id="diastrabajados" class="form-control" required  type="text" value=""  onblur="if (this.value == '') {this.value = '';}" />
                           </td>
                           <th>&nbsp;</th>
                        </tr>
                         <tr>
                          <td>Total d&iacute;as aviso </td>
                          <td><input placeholder="D&iacute;as Aviso" name="diasaviso" id="diasaviso" class="form-control" required  type="text" value=""  onblur="if (this.value == '') {this.value = '';}" />
                           </td>
                           <th>&nbsp;</th>
                        </tr>
                        <tr>
                          <td>Factor c&aacute;lculo diario </td>
                          <td><input placeholder="Factor C&aacute;lculo Diario" name="fcalculodiario" id="fcalculodiario" class="form-control" required  type="text" value=""  onblur="if (this.value == '') {this.value = '';}" />
                           </td>
                           <th>&nbsp;</th>
                        </tr>
                        <tr>
                          <td>A&ntilde;os de Servicio </td>
                          <td><input placeholder="A&ntilde;os de Servicio" name="annosservicio" id="annosservicio" class="form-control" required  type="text" value=""  onblur="if (this.value == '') {this.value = '';}" />
                           </td>
                           <th>&nbsp;</th>
                        </tr>
                        <tr class="active" class="info">
                          <th><p class="text-center">DATOS VACACIONES</p></th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                        </tr>
                        <tr>
                          <td>Total Vacaciones </td>
                          <td><input placeholder="Total Vacaciones" name="totalvacaciones" id="totalvacaciones" class="form-control" required  type="text" value="<?php echo number_format($array_vacaciones['dias_vacaciones'] + $array_vacaciones['num_dias_progresivos'],2,",",".");?>"  onblur="if (this.value == '') {this.value = '';}" />
                           </td>
                           <th>&nbsp;</th>
                        </tr>
                        <tr>
                          <td>D&iacute;as Vacaciones Tomados </td>
                          <td><input placeholder="D&iacute;as Vacaciones Tomados" name="vacacionestomados" id="vacacionestomados" class="form-control" required  type="text" value="<?php echo $personal->diasvactomados; ?>"  onblur="if (this.value == '') {this.value = '';}" />
                           </td>
                           <th>&nbsp;</th>
                        </tr>
                        <tr>
                          <td>Saldo Vacaciones </td>
                          <td><input placeholder="Saldo Vacaciones" name="saldovacaciones" id="saldovacaciones" class="form-control" required  type="text" value="<?php echo number_format($array_vacaciones['dias_vacaciones'] + $array_vacaciones['num_dias_progresivos'] - $personal->diasvactomados,2,",","."); ?>"  onblur="if (this.value == '') {this.value = '';}" />
                           </td>
                           <th>&nbsp;</th>
                        </tr>
                        <tr>
                          <td>D&iacute;as Inh&aacute;biles Posteriores </td>
                          <td><input placeholder="D&iacute;as Inh&aacute;biles Posteriores" name="diasinhabiles" id="diasinhabiles" class="form-control" required  type="text" value="0"  onblur="if (this.value == '') {this.value = '';}" />
                           </td>
                           <th>&nbsp;</th>
                        </tr>
                        <tr>
                          <td>Total Vacaciones Pendientes </td>
                          <td><input placeholder="Total Vacaciones Pendientes" name="totvacpendientes" id="totvacpendientes" class="form-control" required  type="text" value="<?php echo number_format($array_vacaciones['dias_vacaciones'] + $array_vacaciones['num_dias_progresivos'] - $personal->diasvactomados,2,",","."); ?>"  onblur="if (this.value == '') {this.value = '';}" />
                           </td>
                           <th>&nbsp;</th>
                        </tr>


                        <tr class="active" class="info">
                          <th width="20%"><p class="text-center">CONTRATO</p></th>
                          <th width="20%">&nbsp;</th>
                          <th width="60%">&nbsp;</th>
                        </tr>
                        
                       
                        <tr>
                          <td width="20%" width="20%">Sueldo Base </td>
                          <td width="20%"> $ <?php echo number_format($personal->sueldobase,0,".",".");?></td>
                          <td width="60%">&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="20%">Gratificaci&oacute;n </td>
                          <td width="20%"> $ <?php echo number_format($gratificacion,0,".",".");?></td>  
                          <td width="60%"><small><i>Si gratificaci&oacute;n corresponde, se calcula el 25% del sueldo m&iacute;nimo o tope legal</i></small></td>
                        </tr> 
                        <tr>
                          <td width="20%">Movilizaci&oacute;n </td>
                          <td width="20%"> $ <?php echo number_format($personal->movilizacion,0,".",".");?></td>
                           <td width="60%">&nbsp;</td>  
                        </tr> 
                        <tr>
                          <td width="20%">Colaci&oacute;n </td>
                           <td width="20%"> $ <?php echo number_format($personal->colacion,0,".",".");?></td>   
                           <td width="60%">&nbsp;</td>
                        </tr> 
                         <tr>
                          <td width="20%"><b>Valor Total Contrato</b> </td>
                           <td width="20%" width="20%"><b> $ <?php echo number_format($personal->sueldobase + $gratificacion + $personal->movilizacion + $personal->colacion,0,".",".");?></b>
                            <input type="hidden" id="vtotalcont" value="<?php echo round($personal->sueldobase + $gratificacion + $personal->movilizacion + $personal->colacion,0);?>"></td>   
                           <td width="60%">&nbsp;</td>
                        </tr> 
                      
                       


                        <tr class="active" class="info">
                         <th width="20%"><p class="text-center">INDENMIZACIONES</p></th>
                          <th width="20%">&nbsp;</th>
                          <th width="60%">&nbsp;</th>
                        </tr>
                        <tr>
                          <td width="20%">Remuneraci&oacute;n Pendiente </td>
                          <td width="20%"><input type="text" name="rem_pendiente" id="rem_pendiente" class="form-control miles required" placeholder="Ingrese Monto" size="20"></td>  
                          <thd width="60%">&nbsp;</th>
                        </tr> 
                        <tr>
                          <td width="20%">Indemnizacion Aviso Previo </td>
                           <td width="20%"><input type="text" name="ind_aviso" id="ind_aviso" class="form-control miles required" placeholder="Ingrese Monto" size="20"></td>   
                          <td width="60%"><small><i>Aplica s&oacute;lo si no se di&oacute; aviso con 30 d&iacute;as de anticipaci&oacute;n y s&oacute;lo para causales del art&iacute;culo 161</i></small></td>
                        </tr> 

                        <tr>
                          <td width="20%">Indemnizacion Años de Servicio </td>
                          <td width="20%"><input type="text" name="ind_anno_Serv" id="ind_anno_Serv" class="form-control miles required" placeholder="Ingrese Monto" size="20"> </td>  
                          <td width="60%">&nbsp;</th>
                        </tr> 

                        <tr>
                          <td width="20%">Vacaciones Proporcionales <small><?php echo $personal->saldoinicvacprog;?></small> días habíles </td>
                          <td width="20%"> $ 228.388 </td>
                          <td width="60%">&nbsp;</th>
                        </tr>
                       
                        
                        <tr>
                          <td width="20%">Indemnizacion Voluntaria </td>
                          <td width="20%"><input type="number" name="indem_vol" id="indem_vol" class="form-control required" placeholder="Ingrese Monto" size="20"></td>  
                          <td width="60%">&nbsp;</th>
                        </tr> 
                        <tr>
                          <td width="20%">Desahucio </td>
                          <td width="20%"> <input type="number" name="desaucio" id="desaucio" class="form-control required" placeholder="Ingrese Monto" size="20" ></td>  
                          <td width="60%">&nbsp;</th>
                        </tr> 
                        <tr class="active" class="info">
                          <th>TOTAL HABERES</th>
                          <th>$TOTAL</th>
                          <th>&nbsp;</th>
                        </tr> 
                        <tr class="active" class="info">
                          <th><p class="text-center">DESCUENTOS</p></th>
                          <th>CALCULO</th>
                          <th>&nbsp;</th>
                        </tr>
                          <td>Prestamo Empresa </td>
                          <td><input type="number" name="prestamo" id="prestamo" class="form-control required" placeholder="Ingrese Monto" size="20" ></td>
                          <th>&nbsp;</th>
                        <tr>
                          <td>Prestamo C.C.A.F </td>
                          <td><input type="number" name="cajacompensacion" id="cajacompensacion" class="form-control required" placeholder="Ingrese Monto" size="20" ></td>  
                          <th>&nbsp;</th>
                        </tr> 
                        <tr>
                          <td>Otros </td>
                          <td><input type="number" name="otros" id="otros" class="form-control required" placeholder="Ingrese Monto" size="20" ></td> 
                          <th>&nbsp;</th>
                        </tr> 
                        <tr class="active" class="info">
                          <th>TOTAL DESCUENTOS</th>
                          <th>$TOTAL</th>
                          <th>&nbsp;</th>
                        </tr>
                        <tr class="active" class="info">
                          <th>SALDO LIQUIDO A PAGAR</th>
                          <th>$TOTAL</th>
                          <th>&nbsp;</th>
                        </tr>           
                             
                      </thead>
                      </table>  
                      </div>
                      </div>
                      </div>
                      </div>

                        <div class="panel-body">
                        <div class="row" id=""></div>    
                        <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Generar</button>&nbsp;&nbsp;
                        <a  href="<?php echo base_url();?>rrhh/finiquitos"  class="btn btn-default">Volver</a>
                      </div>
                      </div><!-- /.box-body -->

                 
                  </div> 
                  </div>
    </form>                   




<script>
  $(function() {
    $( "#fechacontrato,#fechaingreso,#fechafiniquito,#fechaaviso").datetimepicker({
       // format: "dd/mm/yyyy",
        format: "yyyy-mm-dd",
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left",
        weekStart: true,
        startView: 2,
        minView: 2,
        forceParse: 0,
        language:  'es', 
});


    $('#diasinhabiles').on('change',function(){
      var saldovacaciones = parseFloat(replaceAll($('#saldovacaciones').val(),',','.'));
      var diasinhabiles = parseFloat(replaceAll($('#diasinhabiles').val(),',','.'));
      console.log(saldovacaciones);
      console.log(diasinhabiles);
      $('#totvacpendientes').val(saldovacaciones + diasinhabiles);
    })
  });
</script>  
<script>

    $(document).ready(function() {

      $('.fecha_calc_dias').change(function(){

        var fechacontrato = $('#fechacontrato').val();
        var fechafiniquito = $('#fechafiniquito').val();
        var fechaaviso = $('#fechaaviso').val();
        if(fechacontrato != '' && fechafiniquito != ''){

         // var fecha1 = 
          //console.log((fechacontrato.format('yyyy-mm-dd')));
          var fecha1 = moment(fechacontrato);
          var fecha2 = moment(fechafiniquito);

          //console.log(fecha2.diff(fecha1, 'days'), ' dias de diferencia');
          var diastrabajados = fecha2.diff(fecha1, 'days')+1;
          $('#diastrabajados').val(diastrabajados);
          var factor_calculo_diario = Math.round((diastrabajados/360)*10)/10;
          var annos_servicio = Math.round((diastrabajados/360));
          var vac_otorgadas = annos_servicio*15;
          annos_servicio = annos_servicio > 11 ? 11 : annos_servicio;

          $('#fcalculodiario').val(factor_calculo_diario);
          $('#annosservicio').val(annos_servicio);
          $('#totalvacaciones').val(vac_otorgadas);
        }else{
          $('#diastrabajados').val(0);          
          $('#fcalculodiario').val(0);
          $('#annosservicio').val(0);
          $('#totalvacaciones').val(0);
        }

        if(fechaaviso != '' && fechafiniquito != ''){

          var causal_finiquito = $('#causal_finiquito').find(':selected').data('articulo');
          var art_161 = false;
          if (causal_finiquito.indexOf("161") >= 0){
            art_161 = true;
          
          }
         //console.log(causal_finiquito);

          var fecha1 = moment(fechaaviso);
          var fecha2 = moment(fechafiniquito);

          var diasaviso = fecha2.diff(fecha1, 'days')+1;
          $('#diasaviso').val(diasaviso);
          var vtotalcont = $('#vtotalcont').val();
          var ind_aviso = diasaviso <= 30 && art_161 ? vtotalcont : 0;
          $('#ind_aviso').val(number_format(ind_aviso, 0, '.', '.'));


        }else{
             $('#diasaviso').val(0);   

        }


      });

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

});




</script>   

             