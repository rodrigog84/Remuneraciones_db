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
                        </tr>
                        <tr>
                          <td>Art&iacute;culo Causal Finiquito </td>
                          <td> <select class="form-control" name="causal_finiquito" id="causal_finiquito">
                                <option value="">Seleccione Causal Finiquito</option>
                                <?php foreach ($causales_finiquito as $causal) { ?>
                                  
                                  <option value="<?php echo $causal->idcausal;?>" ><?php echo $causal->motivo;?></option>
                                <?php } ?>                            
                               </select>
                           </td>
                        </tr>
                        <tr>
                          <td>Fecha Contrato </td>
                          <td><input placeholder="Fecha Contrato" name="fechacontrato" id="fechacontrato" class="form-control fecha_calc_dias" required  type="text" value="" onblur="if (this.value == '') {this.value = '';}" />
                           </td>
                        </tr>
                        <tr>
                          <td>Fecha Finiquito </td>
                          <td><input placeholder="Fecha Finiquito" name="fechafiniquito" id="fechafiniquito" class="form-control fecha_calc_dias" required  type="text" value="" onblur="if (this.value == '') {this.value = '';}" />
                           </td>
                        </tr>
                        <tr>
                          <td>Total d&iacute;as trabajados </td>
                          <td><input placeholder="D&iacute;as Trabajados" name="diastrabajados" id="diastrabajados" class="form-control" required  type="text" value=""  onblur="if (this.value == '') {this.value = '';}" />
                           </td>
                        </tr>
                        <tr>
                          <td>Factor c&aacute;lculo diario </td>
                          <td><input placeholder="Factor C&aacute;lculo Diario" name="fcalculodiario" id="fcalculodiario" class="form-control" required  type="text" value=""  onblur="if (this.value == '') {this.value = '';}" />
                           </td>
                        </tr>
                        <tr>
                          <td>A&ntilde;os de Servicio </td>
                          <td><input placeholder="A&ntilde;os de Servicio" name="annosservicio" id="annosservicio" class="form-control" required  type="text" value=""  onblur="if (this.value == '') {this.value = '';}" />
                           </td>
                        </tr>
                        <tr class="active" class="info">
                          <th><p class="text-center">DATOS VACACIONES</p></th>
                          <th>&nbsp;</th>
                        </tr>
                        <tr>
                          <td>Total Vacaciones </td>
                          <td><input placeholder="Total Vacaciones" name="totalvacaciones" id="totalvacaciones" class="form-control" required  type="text" value=""  onblur="if (this.value == '') {this.value = '';}" />
                           </td>
                        </tr>
                        <tr>
                          <td>D&iacute;as Vacaciones Tomados </td>
                          <td><input placeholder="D&iacute;as Vacaciones Tomados" name="vacacionestomados" id="vacacionestomados" class="form-control" required  type="text" value=""  onblur="if (this.value == '') {this.value = '';}" />
                           </td>
                        </tr>
                        <tr>
                          <td>Saldo Vacaciones </td>
                          <td><input placeholder="Saldo Vacaciones" name="saldovacaciones" id="saldovacaciones" class="form-control" required  type="text" value=""  onblur="if (this.value == '') {this.value = '';}" />
                           </td>
                        </tr>
                        <tr>
                          <td>D&iacute;as Inh&aacute;biles Posteriores </td>
                          <td><input placeholder="D&iacute;as Inh&aacute;biles Posteriores" name="diasihabiles" id="diasihabiles" class="form-control" required  type="text" value=""  onblur="if (this.value == '') {this.value = '';}" />
                           </td>
                        </tr>
                        <tr>
                          <td>Total Vacaciones Pendientes </td>
                          <td><input placeholder="Total Vacaciones Pendientes" name="totvacpendientes" id="totvacpendientes" class="form-control" required  type="text" value=""  onblur="if (this.value == '') {this.value = '';}" />
                           </td>
                        </tr>
                        <tr class="active" class="info">
                          <th><p class="text-center">HABERES</p></th>
                          <th>CALCULO</th>
                        </tr>
                        
                       
                        <tr>
                          <td>Vacaciones Proporcionales <small><?php echo $personal->saldoinicvacprog;?></small> días habíles </td>
                          <td> $ 228.388 </td>
                        </tr>
                        <tr>
                          <td>Indemnizacion Aviso Previo </td>
                          <td> $ 228.388 </td>  
                        </tr> 
                        <tr>
                          <td>Indemnizacion Años de Servicio </td>
                          <td> $ 228.388 </td>  
                        </tr> 
                        <tr>
                          <td>Indemnizacion Voluntaria </td>
                          <td><input type="number" name="indem_vol" id="indem_vol" class="form-control required" placeholder="Ingrese Monto" size="20"></td>  
                        </tr> 
                        <tr>
                          <td>Desahucio </td>
                          <td> <input type="number" name="desaucio" id="desaucio" class="form-control required" placeholder="Ingrese Monto" size="20" ></td>  
                        </tr> 
                        <tr class="active" class="info">
                          <th>TOTAL HABERES</th>
                          <th>$TOTAL</th>
                        </tr> 
                        <tr class="active" class="info">
                          <th><p class="text-center">DESCUENTOS</p></th>
                          <th>CALCULO</th>
                        </tr>
                          <td>Prestamo Empresa </td>
                          <td><input type="number" name="prestamo" id="prestamo" class="form-control required" placeholder="Ingrese Monto" size="20" ></td>
                        <tr>
                          <td>Prestamo C.C.A.F </td>
                          <td><input type="number" name="cajacompensacion" id="cajacompensacion" class="form-control required" placeholder="Ingrese Monto" size="20" ></td>  
                        </tr> 
                        <tr>
                          <td>Otros </td>
                          <td><input type="number" name="otros" id="otros" class="form-control required" placeholder="Ingrese Monto" size="20" ></td>  
                        </tr> 
                        <tr class="active" class="info">
                          <th>TOTAL DESCUENTOS</th>
                          <th>$TOTAL</th>
                        </tr>
                        <tr class="active" class="info">
                          <th>SALDO LIQUIDO A PAGAR</th>
                          <th>$TOTAL</th>
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
    $( "#fechacontrato,#fechaingreso,#fechafiniquito").datetimepicker({
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
  });
</script>  
<script>

    $(document).ready(function() {

      $('.fecha_calc_dias').change(function(){
        console.log($('#fechacontrato').val());
        console.log($('#fechafiniquito').val());
        var fechacontrato = $('#fechacontrato').val();
        var fechafiniquito = $('#fechafiniquito').val();
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
          $('#fcalculodiario').val(factor_calculo_diario);
          $('#annosservicio').val(annos_servicio);
          $('#totalvacaciones').val(vac_otorgadas);
        }else{
          $('#diastrabajados').val(0);          
          $('#fcalculodiario').val(0);
          $('#annosservicio').val(0);
          $('#totalvacaciones').val(0);
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

             