<div class="panel panel-inverse">                       
    <div class="panel-heading">
        <h4 class="panel-title">Informaci&oacute;n Trabajador</h4>
    </div>  
    <div class="panel-body">


          <div class="row">

            <div class="col-md-9">
                  <table class="table">
                    <tr>
                    <td>
                    <p><b>Nombre</b></p>
                    <p><i class="fa fa-circle-o text-light-blue"></i>&nbsp;&nbsp;<?php echo $personal->nombre." ".$personal->apaterno." ".$personal->amaterno; ?></p>
                    <p><b>D&iacute;as Legales Devengados</b></p>
                    <p><i class="fa fa-circle-o text-light-blue"></i>&nbsp;&nbsp;<?php echo number_format($dias_vacaciones,2,",","."); ?></p>                    
                    <p><b>D&iacute;as Tomados</b></p>
                    <p><i class="fa fa-circle-o text-light-blue"></i>&nbsp;&nbsp;<?php echo $personal->diasvactomados; ?></p>               
                   
                    </td>
                    <td>
                    <p><b>Fecha Ingreso</b></p>
                    <p><i class="fa fa-circle-o text-light-blue"></i>&nbsp;&nbsp;<?php echo $personal->fecingreso; ?></p>
                  <p><b>D&iacute;as Progresivos Devengados</b></p>
                  <p><i class="fa fa-circle-o text-light-blue"></i>&nbsp;&nbsp;<?php echo number_format($num_dias_progresivos,2,",","."); ?></p>               
                  <p><b>Saldo Vacaciones</b></p>
                  <p><i class="fa fa-circle-o text-light-blue"></i>&nbsp;&nbsp;<?php echo number_format($dias_vacaciones + $num_dias_progresivos - $personal->diasvactomados,2,",","."); ?></p>               

                    </td>
                    <td>
                    <p><b>Fecha Inicio C&aacute;lculo</b></p>
                    <p><i class="fa fa-circle-o text-light-blue"></i>&nbsp;&nbsp;<?php echo formato_fecha($personal->fecinicvacaciones,'Y-m-d','d/m/Y'); ?></p>
                  <p><b>D&iacute;as Totales Devengados</b></p>
                  <p><i class="fa fa-circle-o text-light-blue"></i>&nbsp;&nbsp;<?php echo number_format($dias_vacaciones + $num_dias_progresivos,2,",","."); ?></p>               
                    </td>                    
                    </tr>
                    </table>
            </div><!-- /.col (left) -->
          </div>


</div>
</div>

         <div class="row">
            <div class="col-md-12">
                    <div class="alert alert-<?php echo $classinfo;?> alert-dismissable">
                      Tiene un saldo de <?php echo number_format($saldo_vacaciones,2,",",".");?> d&iacute;as de vacaciones
                    </div>
            </div>
          </div>  



<div class="panel panel-inverse">                       
    <div class="panel-heading">
        <h4 class="panel-title">Solicitar Vacaciones</h4>
    </div>  
  <form id="basicBootstrapForm" action="<?php echo base_url();?>auxiliares/submit_solicita_vacaciones" method="post" role="form" >  
    <div class="panel-body">

          <div class="row">
            
            <div class="col-md-12">

                <!-- form start -->

                    <div class='row'>
                      <div class='col-md-6'>
                        <div class="form-group">
                            <label for="periodo">Rango de Fechas</label>
                            <div class="input-group">
                                   <a href="#" class="btn btn-default pull-right" id="daterange-btn">
                                    <span class="glyphicon glyphicon-calendar"></span><span id="label_rango"><?php echo $fechadesde == '1900-01-01' ? 'Seleccionar Rango de Fechas' : month2string(substr($fechadesde,5,2)). ' ' . substr($fechadesde,8,2) . ', '.substr($fechadesde,0,4) . ' - ' . month2string(substr($fechahasta,5,2)). ' ' . substr($fechahasta,8,2) . ', '.substr($fechahasta,0,4); ?></span>
                                    <i class="fa fa-caret-down"></i>
                                  </a>
                            </div>
                        </div> 
                        <div class="form-group">
                              <label for="documento">D&iacute;as Solicitados</label>    
                              <input type="text" class="form-control" name="diassolicita" id="diassolicita" placeholder="" value="<?php echo $diassolicita;?>" readonly>
                        </div>   
                        <div class="form-group">
                            <label for="descripcion">Comentarios</label>    
                            <textarea class="form-control" rows="3" name="comentarios" id="comentarios" placeholder="Comentarios"><?php echo $comentario; ?></textarea>
                        </div>  

                      </div> 
                    </div>                 



                    <input type="hidden" name="idpersonal" id="idpersonal" value="<?php echo $personal->id_personal;?>" >


              

            </div>
          </div> 

  </div>
  <div class="panel-footer">
    <button type="submit" class="btn btn-success"><?php echo $titulo; ?></button>
    &nbsp;&nbsp;
    <a href="<?php echo base_url();?>remuneraciones/vacaciones" class="btn btn-default">Volver</a> 
    <input type="hidden" id="fechadesde" name="fechadesde" value="<?php echo $fechadesde;?>" />
    <input type="hidden" id="fechahasta" name="fechahasta" value="<?php echo $fechahasta;?>" />
    <input type="hidden" id="idcartola" name="idcartola" value="<?php echo $idcartola;?>" />                                       
  </div>
  </form>

</div>

 

   <script>


    $(function(){

            //var start = moment().add(1, 'day');
            //var end = moment().add(1, 'day');

            //var start = moment().format("<?php echo $fechadesde;?>", "YYYY-MM-DD");
            //var end = moment().format("<?php echo $fechadesde;?>", "YYYY-MM-DD");         

            var start = "<?php echo formato_fecha($fechadesde,'Y-m-d','d/m/Y');?>";
            var end = "<?php echo formato_fecha($fechahasta,'Y-m-d','d/m/Y');?>";         
            var min = moment().add(1, 'day');
          var some_date_range = [<?php echo $string_feriados; ?>];            
        //Date range picker
        $('#daterange-btn').daterangepicker(
                {
              locale: {
                  format: 'DD/MM/YYYY',
                  "applyLabel": "Aceptar",
                  "cancelLabel": "Cancelar",
                  "fromLabel": "Desde",
                  "toLabel": "Hasta",
                  "customRangeLabel": "Custom",
                  "daysOfWeek": [
                      "Do",
                      "Lu",
                      "Ma",
                      "Mi",
                      "Ju",
                      "Vi",
                      "Sa"
                  ],
                  "monthNames": [
                      "Enero",
                      "Febrero",
                      "Marzo",
                      "Abril",
                      "Mayo",
                      "Junio",
                      "Julio",
                      "Agosto",                      
                      "Septiembre",
                      "Octubre",
                      "Noviembre",
                      "Diciembre"
                  ],
                  "firstDay": 1
              },                  
                  isInvalidDate: function(date) {
                      for(var ii = 0; ii < some_date_range.length; ii++){
                        if (date.format('YYYY-MM-DD') == some_date_range[ii]){
                          return true;
                        }
                      }
                      if(date.day() == 0 || date.day() == 6)
                          return true;
                          
                      return false;
                  },
                  startDate: start,
                  endDate: end,
                  //minDate: min,
                  opens: "right",
                  drops: "up",
                },
        function (start, end ) {


          var dias_solicita = moment().weekdayCalc(
            start, end, [1,2,3,4,5],some_date_range
          );
          
          $('#fechadesde').val(start.format('YYYY-MM-DD'));
          $('#fechahasta').val(end.format('YYYY-MM-DD'));
          $('#diassolicita').val(dias_solicita);
          $('#label_rango').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          $('#basicBootstrapForm').formValidation('revalidateField', 'diassolicita');
        }




        );  

      });

  </script>



<script>
$(document).ready(function() {
    $('#basicBootstrapForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            diassolicita: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Debe indicar fechas'
                    },
                    between: {
                        min: 1,
                        max: <?php echo (int)$max_vacaciones; ?>,
                        message: 'D&iacute;as de vacaciones debe estar entre 0 y <?php echo (int)$max_vacaciones;?> d&iacute;as'
                    },                    
                }
            },
        }
    });      

});



</script>    