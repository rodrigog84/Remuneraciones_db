
          <form id="basicBootstrapForm" action="<?php echo base_url();?>rrhh/decjurada_rentas" id="basicBootstrapForm" method="post"> 

            <?php 

                $muestra = true;
                if($this->session->userdata('rol_privado_empresa') == 1){
                    if($this->session->userdata('rol_privado_user') == 0){ // si la empresa maneja rol privado y el usuario no, se quitan los trabajadores con rol privado

                      $muestra = false;
                    }


                }
            
              ?>


              <?php if($muestra){ ?>

              <div class="row">
                                  <div class="col-md-6">
                                    <div class="panel panel-inverse">
                                      <div class="panel-heading">
                                        <h3 class="panel-title">Per&iacute;odo&nbsp;&nbsp;<span class="label " id="span_status"></span></h3>
                                      </div><!-- /.box-header -->

                                      <div class="panel-body" >
                                        <div class='row'>
                                            <div class='col-md-6'>
                                              <div class="form-group">
                                                <label for="anno">A&ntilde;o</label>
                                                <select name="anno" id="anno" class="form-control periodo">
                                                  <?php for($i=(date('Y')-3);$i<=date('Y') -1;$i++){ ?>
                                                  <?php $yearselected = $i == $anno ? "selected" : ""; ?>
                                                  <option value="<?php echo $i;?>" <?php echo $yearselected; ?>><?php echo $i;?></option>
                                                  <?php } ?>
                                                </select>
                                                <b><small>(*) DJ se calcular&aacute; s&oacute;lo sobre per&iacute;odos aprobados</small></b>
                                              </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                          <div class='col-md-3'>
                                              <button type="submit" class="btn btn-primary btn-block">Generar</button>
                                          </div>


                                          <?php if(count($encabezado) > 0){ ?>

                                                <div class='col-md-3'>
                                                  <a href="<?php echo base_url();?>rrhh/decjurada_rentas_exportar/<?php echo $anno;?>" class="btn btn-success btn-block">Exportar</a>
                                                </div>                  

                                          <?php } ?>                                          
                                        </div>                    
                                      </div><!-- /.box-body -->
                                    </div>
                                  </div>


             </div>

           <?php }else{ ?>
            <div class="alert alert-info fade in m-b-15">
                <strong>Atenci&oacute;n!</strong>
                Opci&oacute;n disponible s&oacute;lo para usuarios con rol privado
              </div>


           <?php } ?>

        <?php if(count($encabezado) > 0){ ?>


              <div class="row">
                                  <div class="col-md-9">
                                    <div class="panel panel-inverse">
                                      <div class="panel-heading">
                                        <h3 class="panel-title">Declaraci&oacute;n Jurada Anual sobre Rentas<span class="label " id="span_status"></span></h3>
                                          <?php if(count($encabezado) > 0 ){ ?>
                                            <?php $linea = $encabezado[0]; ?>
                                          <?php } ?>                                        
                                      </div><!-- /.box-header -->

                                      <div class="panel-body" >
                                        <div class='row'>
                                            <div class='col-md-12'>


                                                  <table class="table table-bordered table-striped dt-responsive">
                                                  <thead>
                                                    <tr>
                                                      <th >Renta Total Neta Pagada (Art. 42 Nro. 1, Ley de Renta)</th>
                                                      <th>$&nbsp;<?php echo number_format($linea->rentatotalsinactualizar,0,'.','.'); ?></th>
                                                    </tr>

                                                    <tr>
                                                      <th >Impuesto Unico de Segunda Categoria Retenido Por Renta Total Neta Pagada Durante el A&ntilde;o</th>
                                                      <th>$&nbsp;<?php echo number_format($linea->impuestorentasinactualizar,0,'.','.'); ?></th>
                                                    </tr>

                                                    <tr>
                                                      <th >Impuesto Unico de Segunda Categoria Retenido Por Rentas Accesorias Y/O Complementarias Pagada Entre Ene-Abr.  A&ntilde;o Sgte</th>
                                                      <th>$&nbsp;<?php echo number_format($linea->impuestorentaaccesoria,0,'.','.'); ?></th>
                                                    </tr>

                                                    <tr>
                                                      <th >Renta Total No Gravada</th>
                                                      <th>$&nbsp;<?php echo number_format($linea->rentanogravadasinactualizar,0,'.','.'); ?></th>
                                                    </tr>

                                                    <tr>
                                                      <th >Renta Total Exenta</th>
                                                      <th>$&nbsp;<?php echo number_format($linea->rentaexenta,0,'.','.'); ?></th>
                                                    </tr>

                                                    <tr>
                                                      <th >Rebaja por Zonas Extremas (FRANQUICIA D.L.889)</th>
                                                      <th>$&nbsp;<?php echo number_format($linea->rebajazonasextremas,0,'.','.'); ?></th>
                                                    </tr>

                                                    <tr>
                                                      <th >Leyes Sociales</th>
                                                      <th>$&nbsp;<?php echo number_format($linea->leyessociales,0,'.','.'); ?></th>
                                                    </tr>
                                                    <tr>
                                                      <th >Total Remuneraci&oacute;n Imponible Para Efectos Previsionales Actualizada A Todos los Trabajadores</th>
                                                      <th>$&nbsp;<?php echo number_format($linea->sueldoimponible,0,'.','.'); ?></th>
                                                    </tr>
                                                  </thead>
                                                  </table>


                                            </div>

                                        </div>                   
                                      </div><!-- /.box-body -->
                                    </div>
                                  </div>


             </div>
        <br>

              

                <?php } ?>
           </form>          


