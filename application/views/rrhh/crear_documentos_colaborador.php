
<div class='row'>

<div class="col-md-6">
<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">Generaci&oacute;n de Documento</h4>
    </div>
    <form id="basicBootstrapForm" method="post" action="<?php echo base_url(); ?>rrhh/submit_documento_colaborador">
        <div class="panel-body">
            <div class='row'>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo_documento">Tipos de Documento</label>
                        <?php $label_formato = ''; ?>
                        <select name="tipo_documento" id="tipo_documento" class="form-control">
                            <option value="">Seleccione Tipo Documento</option>
                            <?php foreach ($formatos_documentos as $formato_documento) { ?>
                                      <?php if($formato_documento->id_tipo_documento != $label_formato){
                                          if($label_formato != ''){
                                              echo "</optgroup>";
                                          }
                                          echo "<optgroup label='". $formato_documento->tipo . "''>";
                                          $label_formato = $formato_documento->id_tipo_documento;
                                        } ?>
                                  
                                    <?php //$cargoselected = $cargo->id_cargos == $datos_form['idcargo'] ? "selected" : ""; ?>
                                    <option value="<?php echo $formato_documento->id_formato;?>" <?php //echo $cargoselected;?> ><?php echo $formato_documento->nombre;?></option>
                              <?php } 
                                    if($label_formato != ''){
                                      echo "</optgroup>";
                                    }
                                    ?>   
                        </select>
                    </div>
                </div>

            </div>
            <div class='row'>
                <div class="col-md-6">
                    &nbsp;
                </div>

            </div>            
        </div>
        <div class="panel-footer">
            <!-- CAMPOS OCULTOS -->
            <input type="hidden" class="form-control" id="id_trabajador" name="id_trabajador" value="<?php echo $personal->id_personal; ?>">
            <a href="<?php echo base_url(); ?>rrhh/documentos_colaborador" class="btn btn-success">Volver</a>
            <button type="submit" class="btn btn-info">Crear</button>
        </div>
    </form>
</div>
</div>    
<div class="col-md-6">

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
                            <p><i class="fa fa-circle-o text-light-blue"></i>&nbsp;&nbsp;<?php echo $personal->nombre . " " . $personal->apaterno . " " . $personal->amaterno; ?></p>
                            <p><b>Rut</b></p>
                            <p><i class="fa fa-circle-o text-light-blue"></i>&nbsp;&nbsp;<?php echo $personal->rut == '' ? '' : number_format($personal->rut, 0, ".", ".") . "-" . $personal->dv; ?></p>
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
                            <p><i class="fa fa-circle-o text-light-blue"></i>&nbsp;&nbsp;<?php echo $personal->sexo_traducido; ?></p>

                        </td>

                    </tr>
                </table>
            </div><!-- /.box-body -->
        </div>
    </div><!-- /.col (left) -->
</div>
    </div><!-- /.col (left) -->

</div>
<div class='row'>

<div class="col-md-12">
<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">Listado de Documentos del Colaborador</h4>
    </div>
    <div class="panel-body">
            <div class='row'>

                          <table  class="table table-bordered table-striped dt-responsive" id="listado">
                          <thead>
                            <tr>
                              <th >#</th>
                              <th >Documento</th>
                              <th >Tipo de Documento</th>
                              <th >Fecha Creaci&oacute;n</th>
                              <th >Ver</th>
                              <th >Eliminar</th>
                              <!--th ><center>Movimientos</center></th-->
                            </tr>
                          </thead>
                          <tbody>
                            <?php if(count($documentos_colaborador) > 0 ){ ?>
                              <?php $i = 1; ?>
                              <?php foreach ($documentos_colaborador as $documento) { ?>

                               <tr >
                                <td><?php echo $i ;?></td>
                                <td><?php echo $documento->documento;?></td>
                                <td><?php echo $documento->tipo;?></td>
                                <td><?php echo $documento->fecha_creacion;?></td>
                                <td >
                                    <center><a href="<?php echo base_url();?>rrhh/ver_documento_colaborador/<?php echo $personal->id_personal;?>/<?php echo $documento->id_documento;?>" data-toggle="tooltip" title="Ver Documento" target='_blank'><i class="fa fa-file-pdf-o fa-lg"></i></a></center>
                                </td>  
                                <td >
                                    <center><a href="<?php echo base_url();?>rrhh/del_documento_colaborador/<?php echo $personal->id_personal;?>/<?php echo $documento->id_documento;?>" data-toggle="tooltip" title="Eliminar Documento" ><i class="fa fa-trash fa-lg"></i></a></center>
                                </td>                               
                                <!--td >
                                    <center><a href="<?php echo base_url();?>remuneraciones/add_movimiento_personal/<?php echo $trabajador->id;?>" data-toggle="tooltip" title="Agregar Movimiento" ><i class="fa fa-plus-square"></i></a></center>
                                </td-->
                              </tr>
                              <?php $i++;?>
                              <?php } ?>
                            <?php }else{ ?>
                            <tr>
                              <td colspan="6">No existen Documentos para el Colaborador</td>
                            </tr>
                          <?php } ?>
                          </tbody>
                          </table>                
            </div>
    </div>
</div>
</div>
</div>


<script>


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
                    }

                }
            })
    })
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