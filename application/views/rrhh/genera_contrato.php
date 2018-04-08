<form id="basicBootstrapForm" action="<?php echo base_url();?>rrhh/submit_genera_contrato" method="post" role="form" enctype="multipart/form-data">

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
                          <table class="table table-striped">
                            <thead> 
                              <tr> 
                                <th>Rut:</th> 
                                <th>Fecha Ingreso:</th>
                                <th>Sueldo Base:</th>            
                              </tr> 
                            </thead>
                            <tbody>
                              <td>
                                <input type="text" name="rut" id="rut"  class="form-control1"  placeholder="<?php echo $personal->rut == '' ? '' : number_format($personal->rut,0,".",".")."-".$personal->dv;?>" title="Escriba Rut" disabled  >
                              </td>
                              <td>
                                <input placeholder="<?php echo $personal->fecingreso ;?>" name="fechaingreso" id="fechaingreso" class="form-control1" required id="datepicker" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" disabled />
                               
                              </td>
                              <td>
                                <input type="text" name="sueldobase" id="sueldobase" class="form-control1" id="" placeholder="<?php echo $personal->sueldobase;?>" disabled >
                              </td>
                              
                            </tbody>  
                          </table>

                          <table class="table table-striped">
                            <thead> 
                              <tr> 
                                <th>Nombre Completo:</th> 
                                <th>Apellido Parterno:</th>
                                <th>Apellido Materno:</th>                                  
                              </tr> 
                            </thead>
                            <tbody>
                              <td >
                                <div class="form-group">
                                <input type="text" name="nombre" class="form-control1" id="nombre" placeholder="<?php echo $personal->nombre;?>" disabled>
                                </div>
                              </td>
                              <td class="form-group">
                                <input type="text" name="apaterno" class="form-control1" id="apaterno" placeholder="<?php echo $personal->apaterno;?>" disabled>
                              </td>
                              <td class="form-group">
                                <input type="text" name="amaterno" class="form-control1" id="amaterno" placeholder="<?php echo $personal->amaterno;?>" disabled>
                              </td>
                            </tbody>
                          </table>                          
                          <table class="table table-striped">
                            <thead> 
                              <tr> 
                                <th>Dirección:</th> 
                                <th>Email:</th>
                                    
                              </tr> 
                            </thead>
                            <tbody>
                              <td>
                                <input type="text" name="direccion" id="direccion" class="form-control1 required" placeholder="<?php echo $personal->direccion;?>" data-toggle="modal" data-target="#myModalDireccion" size="40" disabled>
                              </td>
                              <td>
                                <input type="text" name="email" id="email" class="form-control1" placeholder="<?php echo $personal->email;?>" disabled>
                              </td>
                            </tbody>
                          </table>
                          </section>
                      </div>   
                      </div><!-- /.box-body -->                 
                  </div> 
                    <div class="panel panel-inverse">                       
                      <div class="panel-heading">
                        <h4 class="panel-title">Genera Documento</h4>
                      </div>
                      <div class="panel-body">
                        <div class='row'>
                          <div class='col-md-4'>
                            <div class="form-group">
                              <label for="caja">Tipo Documento</label>    
                               <select name="tipo" id="tipocontrato" class="form-control1" required>
                              <?php foreach ($tipocontrato as $tipo) { ?>
                                <?php $paisselected = $tipo->id == $datos_form['id_tipo_doc_colaborador'] ? "selected" : "Tipo Contrato"; ?>
                                <option value="<?php echo $tipo->id_tipo_doc_colaborador;?>" <?php echo $paisselected;?> ><?php echo $tipo->nom_documento;?></option>
                              <?php } ?>
                            </select>

                            </div>  
                          </div>
                           <div class='col-md-4'>
                             <thead> 
                              <tr> 
                                <th>Fecha Documento:</th> 
                              </tr> 
                            </thead>
                            <tbody>
                              <td>
                                <input placeholder="Fecha Contrato" name="fechacontrato" id="fechacontrato" class="form-control1" required  type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" />
                              </td>  
                              
                                                   
                            </tbody>
                          
                          </div>  

                           <div class='col-md-4'>
                             <thead> 
                              <tr> 
                                <th></th> 
                              </tr> 
                            </thead>
                            <tbody>
                              <td>
                                <input type="hidden" name="idtrabajador" id="idtrabajador" class="form-control1" required id="" value="<?php echo $personal->id_personal;?>">
                              </td>                           
                            </tbody>
                          
                          </div>  

                         <div class="panel-body">
                        <div class="row" id=""></div>    
                        <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Generar</button>&nbsp;&nbsp;&nbsp;&nbsp;
                         <a  href="<?php echo base_url();?>rrhh/contratos"  class="btn btn-default">Volver</a>
                       </div>
                      </div><!-- /.box-body -->

                 
                  </div> 
                  </div>
  </form> 
<script>
  $(function() {
    $( "#fechacontrato,#fechaingreso").datepicker({
  dateFormat: "dd/mm/yy"
});
  });
</script>  


             