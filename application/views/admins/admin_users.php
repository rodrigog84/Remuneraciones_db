          <div>
              <a href="<?php echo base_url();?>admins/add_user" type="submit" class="btn btn-primary">Agregar Usuario</a>
          </div>
          <br>


<div class="panel panel-inverse">                       
    <div class="panel-heading">
        <h4 class="panel-title">Listado de Usuarios</h4>
    </div>     
    
<div class="panel-body">



          <div class="row">
            
              <div class="col-md-12">
                    
                    <table id="listado" class="table table-bordered table-striped dt-responsive">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Perfil</th>
                        <?php if($this->session->userdata('comunidadid') == ''){ ?>
                        <th>&nbsp;</th>   
                        <?php } ?>                     
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(count($users) > 0 ){ ?>
                        <?php $i = 1; ?>
                        <?php foreach ($users as $user) { ?>
                         <tr >
                          <td><?php echo $i ;?></td>
                          <td><?php echo $user->nombre;?></td>
                          <td><?php echo $user->email;?></td>
                          <td><?php echo $user->levelname;?></td>
                          <?php if($this->session->userdata('comunidadid') == ''){ ?>
                          <td>

                          <a href="<?php echo base_url();?>admins/add_user/<?php echo $user->id;?>" data-toggle="tooltip" title="Editar" ><span class="glyphicon glyphicon-edit"></span></a>
                          &nbsp;
                          &nbsp;
                          <a href="<?php echo base_url();?>admins/delete_user/<?php echo $user->id;?>" data-toggle="tooltip" title="Eliminar" ><span class="glyphicon glyphicon-trash"></span></a>
                          
                          </td>                          
                          <?php } ?>
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
<script>
      $(function () {
        $('#listado').dataTable({
          "bLengthChange": true,
          "bFilter": true,
          "bInfo": true,
          "bAutoWidth": false,
          "aLengthMenu" : [[10,20,30,45,100,-1],[10,20,30,45,100,'All']],
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
        /*setTimeout(redirige, 1500);
        function redirige(){
            location.href = '<?php //echo base_url();?>welcome/dashboard';
        }*/
        <?php } ?>


    });
</script>   