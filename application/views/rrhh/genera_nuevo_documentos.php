
<form id="basicBootstrapForm" action="<?php echo base_url();?>Carga_masiva/graba_tipo_contratos" id="basicBootstrapForm" method="post" enctype="multipart/form-data">
<div class="row">
 <div class="col-md-6">
 <table class="table table-striped">
 <thead> 
  <tr>
    <td>
    <label for="caja">Tipo Documento</label>    
     <input type="text" name="nombre" id="nombre"  class="form-control1"  placeholder="" title="Nombre" required size="100">
    </td>
    <tr>
    <td>  
    <button type="submit" class="btn btn-success" name="cargar">Grabar</button>
    <td>
    <a href="<?php echo base_url();?>configuraciones/tipos_contrato_colaboradores" class="btn btn-default">Volver</a>
    </td>
    </td>  
    </tr>                     
  </tr> 
 </thead>       
</table>        
</form>          
 
