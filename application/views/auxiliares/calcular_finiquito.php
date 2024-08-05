<div class="panel panel-inverse">                       
    <div class="panel-heading">
        <h4 class="panel-title">Listado de Colaboradores</h4>
    </div>


                    <div class="panel-body">
                          <table  class="table table-bordered table-striped dt-responsive" id="listado">
                          <thead>
                            <tr>
                              <th >#</th>
                              <th >Rut</th>
                              <th >Nombre Trabajador</th>
                              <th ><center>Ver</center></th>
                              <!--th ><center>Movimientos</center></th-->
                            </tr>
                          </thead>
                          <tbody>
                            <?php if(count($personal) > 0 ){ ?>
                              <?php $i = 1; ?>
                              <?php foreach ($personal as $trabajador) { ?>

                               <tr >
                                <td><?php echo $i ;?></td>
                                <td><?php echo $trabajador->rut == '' ? '' : number_format($trabajador->rut,0,".",".")."-".$trabajador->dv;?></td>
                                <td><?php echo $trabajador->nombre." ".$trabajador->apaterno." ".$trabajador->amaterno;?></td>
                                <td >
                                    <?php if(is_null($trabajador->idfiniquito)){ ?>
                                    <center><a href="<?php echo base_url();?>auxiliares/genera_finiquito/<?php echo $trabajador->id_personal;?>" data-toggle="tooltip" title="Crear Finiquito" ><i class="fa fa-plus-square fa-lg"></i></a></center>
                                <?php  }else{ ?>
                                       <center><a href="<?php echo base_url();?>auxiliares/genera_finiquito/<?php echo $trabajador->id_personal.'/'.$trabajador->idfiniquito;?>" data-toggle="tooltip" title="Editar Finiquito" ><i class="fa fa-edit fa-lg"></i></a></center>
                                <?php } ?>
                                </td>                                
                                <!--td >
                                    <center><a href="<?php echo base_url();?>remuneraciones/add_movimiento_personal/<?php echo $trabajador->id;?>" data-toggle="tooltip" title="Agregar Movimiento" ><i class="fa fa-plus-square"></i></a></center>
                                </td-->
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
                    </div><!-- /.box-body -->


</div>            

     

<script>


$(function () {
        $('#listado').dataTable({
          "bLengthChange": true,
          "bFilter": true,
          "bInfo": true,
          "bSort": false,
          "bAutoWidth": false,
          "aLengthMenu" : [[10,15,30,45,100,-1],[10,15,30,45,100,'Todos']],
          "iDisplayLength": 10,
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
        
        <?php } ?>


    });
</script>