        <!-- Main content -->



<form id="basicBootstrapForm" action="<?php echo base_url();?>admins/submit_correccion_monetaria" id="basicBootstrapForm" method="post">
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">B&uacute;squedas</h4>
            </div>

                <div class="panel-body">
                    <div class="form-group">
                        <label for="anno">A&ntilde;o</label>
                        <select name="anno" id="anno" class="form-control periodo">
                          <?php for($i=(date('Y')-3);$i<=date('Y') - 1;$i++){ ?>
                          <?php $yearselected = $i == $anno ? "selected" : ""; ?>
                          <option value="<?php echo $i;?>" <?php echo $yearselected; ?>><?php echo $i;?></option>
                          <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary ">Buscar</button>
                </div>

            
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Tabla Impuesto &Uacute;nico</h4>
            </div>
            <div class="panel-body">
                  <table class="table table-bordered table-striped dt-responsive">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Mes ($)</th>
                      <th>Factor</th>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach ($meses as $key_mes => $mes) { ?>
                      <?php if(isset($tabla_correccion_monetaria[$key_mes])){
                          $factor = $tabla_correccion_monetaria[$key_mes];
                      }else{
                          $factor = 0;
                      }
                      ?>
                      <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $mes;?></td>
                        <td class="form-group"><input type="text" class="form-control  factor" name="factor_<?php echo $key_mes;?>" id="factor_<?php echo $key_mes;?>" placeholder="Ingrese Factor" value="<?php echo number_format($factor,3,".",","); ?>"></td>
                      </tr>
                      <?php $i++; ?>
                    <?php } ?>
                  </table>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>&nbsp;&nbsp;
            </div>

        </div>
    </div>
</div>
</form>



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

            factor: {
                selector: '.factor',
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Factor es requerido'
                    },
                    numeric: {
                        separator: '.',
                        message: 'Monto s&oacute;lo puede contener n&uacute;meros'
                    },

                }
            },            
        }
    })
    
});


$('#anno').on('change',function(){

    
    var anno = $(this).val();

   $.ajax({
        type: "POST",
        url: '<?php echo base_url();?>admins/get_correccion_monetaria',
        data : {
                  "anno" : anno             
                },            
        dataType: 'json'
    }).success(function(response) {

        console.log(response)

      $('.factor').each(function(){
          $(this).val(number_format(0,3,'.',','));
      })


      $.each(response,function(index,value){

            console.log(index)
            console.log(value)
            console.log(value.mes_orig)
            console.log(value.dic)

            var mes_orig = value.mes_orig;
            var factor = value.dic;

            $('#factor_'+mes_orig).val(number_format(factor,3,'.',','));

      });             
        
    });    


})


$(document).ready(function(){
 $('.miles').mask('000.000.000.000.000', {reverse: true})        

});

$(document).ready(function(){
 $('.miles_decimales').mask('#.###0,000', {reverse: true})        

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