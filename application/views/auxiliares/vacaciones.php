
<div class="panel panel-inverse">                       
    <div class="panel-heading">
        <h4 class="panel-title">Detalle Vacaciones</h4>
    </div>  
    <div class="panel-body">



          <form id="basicBootstrapForm" action="<?php echo base_url();?>remuneraciones/submit_asistencia" id="basicBootstrapForm" method="post"> 

            <div class="row">

                <div class="col-md-12">
                          <table  class="table table-bordered table-striped dt-responsive">
                          <thead>
                            <tr>
                              <th rowspan="2">#</th>
                              <th rowspan="2">Rut</th>
                              <th rowspan="2">Nombre Trabajador</th>
                              <th colspan="3" ><center>D&iacute;as Devengados</center></th>
                              <th rowspan="2">Tomados</th>
                              <th rowspan="2">Saldo</th>
                              <th rowspan="2">Solicitar</th>
                              <th rowspan="2">Cartola</th>
                              <th rowspan="2">D&iacute;as Progresivos</th>
                            </tr>
                            <tr>
                             <th>Legales</th>
                              <th>Progresivos</th>
                              <th >Total Devengado</th>
                            </tr>

                          </thead>
                          <tbody>
                            <?php if(count($personal) > 0 ){ ?>
                              <?php $i = 1; ?>
                              <?php foreach ($personal as $trabajador) { ?>

                               <tr >
                                <td><small><?php echo $i ;?></small></td>
                                <td><small><?php echo $trabajador->rut == '' ? '' : number_format($trabajador->rut,0,".",".")."-".$trabajador->dv;?></small></td>
                                <td><small><?php echo $trabajador->nombre." ".$trabajador->apaterno." ".$trabajador->amaterno;?></small></td>
                                <td><small>
                                    <?php $dias_vacaciones = dias_vacaciones($trabajador->fecinicvacaciones,$trabajador->saldoinicvacaciones); ?>
                                    <center><span id="diasatrabajar_<?php echo $trabajador->id_personal;?>"  class="text-right" ><?php echo number_format($dias_vacaciones,2,",",".");?></span></center></small>
                                </td>
                                <td><small>
                                    <center><span id="diasatrabajar_<?php echo $trabajador->id_personal;?>"  class="text-right" ><?php echo $progresivos[$trabajador->id_personal];?></span></center></small>
                                </td>     
                                <td><small>
                                    <center><span id="diasatrabajar_<?php echo $trabajador->id_personal;?>"  class="text-right" ><?php echo number_format($dias_vacaciones + $progresivos[$trabajador->id_personal],2,",",".");?></span></center> </small>
                                </td>  
                                <td><small>
                                    <center><span id="diasatrabajar_<?php echo $trabajador->id_personal;?>"  class="text-right" ><?php echo $trabajador->diasvactomados;?></span></center></small>
                                </td>     
                                <td><small>
                                    <center><span id="diasatrabajar_<?php echo $trabajador->id_personal;?>"  class="text-right" ><?php echo number_format($dias_vacaciones + $progresivos[$trabajador->id_personal] - $trabajador->diasvactomados,2,",",".");?></span></center> </small>
                                </td>                                                                                            
                                <td >
                                    <center><a href="<?php echo base_url();?>auxiliares/solicita_vacaciones/<?php echo $trabajador->id_personal;?>" data-toggle="tooltip" title="Solicitar" ><i class="fa fa-suitcase"></i></a></center>
                                </td>
                                <td >
                                    <center><a href="<?php echo base_url();?>auxiliares/cartola_vacaciones/<?php echo $trabajador->id_personal;?>" data-toggle="tooltip" title="Cartola" ><i class="fa fa-calendar"></i></a></center>
                                </td>   
                                <td >
                                    <center><a href="<?php echo base_url();?>auxiliares/add_dia_progresivo/<?php echo $trabajador->id_personal;?>" data-toggle="tooltip" title="Cargar D&iacute;as Progresivos" ><i class="fa fa-plus-square-o"></i></a></center>
                                </td>                                                              
                              </tr>
                              <?php $i++;?>
                              <?php } ?>
                            <?php }else{ ?>
                            <tr>
                              <td colspan="4">No existen trabajadores en la empresa</td>
                            </tr>
                          <?php } ?>
                          </tbody>
                          </table>
                </div>


            </div>

          </form>          
        </div>
      </div>

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
      