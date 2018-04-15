
<div class="graph-visual tables-main">
											
		<h3 class="inner-tittle two">Creación Comunas</h3>
		<div class="graph">
		<form id="basicBootstrapForm" action="<?php echo base_url();?>mantenedores/submit_comuna" method="post">
		<div class="tables">
		<table class="table"> 
		<thead> 
		<tr>
        <th >Provincia :</th>  
		<th >Comuna    :</th>
		</tr> 
		</thead> 
		<tbody> 
		<tr class="active" id="variable">
		<td class="form-group">
        <select name="provincia" id="idprovincia" class="form-control1" required>
        <?php foreach ($provincia as $provincia) { ?>
              <?php $provinciaselected = $provincia->idprovincia == $datos_form['idprovincia'] ? "selected" : ""; ?>
              <option value="<?php echo $provincia->idprovincia;?>" <?php echo $provinciaselected;?> ><?php echo $provincia->nombre;?></option>
            <?php } ?>
        </select>  
        <td>                    
		<input type="text" name="nombre" id="nombre" class="descripcion  form-control" id="nombre" placeholder="nombre" value="<?php echo isset($comuna->nombre) ? $comuna->nombre : '';?>" requiere>
		</tr>  
		</tbody> 
		</table>
		<br>
		<a href="<?php echo base_url(); ?>mantenedores/comuna" class = "btn btn-primary" >Volver</a>
		<button type = "submit" class = "btn btn-info" id="comando">Guardar
		</button>
		<input type="hidden" name="idcomuna" value="<?php echo isset($comuna->idcomuna) ? $comuna->idcomuna: 0 ;?>">
		</div>
</form>
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

            descripcion: {
                selector: '.nombre',
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Nombre es requerida'
                    },
                },

            }, 

             form-control1: {
                selector: '.nombre',
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Nombre es requerida'
                    },
                },

            }, 
   			          
           
        }
    })
});



</script>	

<script>
    
    $(function(){
        
        $.ajax({type: "GET",
                    url: "<?php echo base_url();?>rrhh/datos_personal/<?php echo $idrut;?>", 
                    dataType: "json",
                    success: function(datos_personal2){
                        $.each(datos_personal2,function(nombre) {
                        $("#nombre").val(this.nombre);
                        $("#rut").val(this.rut);
                        $("#apaterno").val(this.apaterno);
                        $("#amaterno").val(this.amaterno);
                        $("#direccion").val(this.direccion);
                        $("#email").val(this.email);    
                        $("#nacionalidad").val(this.idnacionalidad);
                        $("#sueldo_base").val(this.sueldobase);
                        $("#ecivil").val(this.idecivil);
                        $("#sexo").val(this.sexo);
                        $("#fechanacimiento").val(this.fecnacimiento);
                        $("#cargo").val(this.idcargo);
                        $("#isapre").val(this.idisapre);
                        $("#centro_costo").val(this.idcentrocosto);
                        $("#afp").val(this.idafp);
                        $("#datepicker2").val(this.fecingreso);
                        $("#fecha_inicio_vacaciones").val(this.fecinicvacaciones);
                        $("#vacaciones_legales").val(this.saldoinicvacaciones);
                        $("#vacaciones_progresivas").val(this.saldoinicvacprog);
                        $("#polera").val(this.tallapolera);
                        $("#pantalon").val(this.tallapantalon);
                        $("#titulo").val(this.titulo);
                        $("#licencia").val(this.idlicencia);
                        $("#estudios").val(this.idestudio);
                        $("#fono").val(this.fono);
                        $("#numero_contrato_apv").val(this.nrocontratoapv);
                        $("#apv").val(this.instapv);
                        $("#tipo_cotizacion").val(this.tipocotapv);
                        $("#monto_cotizacion_apv").val(this.cotapv);
                        $("#monto_pactado").val(this.valorpactado);
                        $("#categoria").val(this.id_categoria);
                        $("#lugar_pago").val(this.id_lugar_pago);
                        $("#sindicato").val(this.sindicato);
                        $("#jubilado").val(this.jubilado);
                        $("#regimen_pago").val(this.rol_privado);
                        $("#tramo").val(this.idasigfamiliar);
                        $("#semana_corrida").val(this.semana_corrida);
                        $("#tiporenta").val(this.tiporenta);
                        $("#idioma").val(this.ididioma);
                        $("#numficha").val(this.numficha);
                        $("#datepicker5").val(this.fecafp);
                        $("#datepicker6").val(this.fecafc);
                        $("#region").val(this.idregion);
                        $("#asig_individual").val(this.cargassimples);
                        $("#asig_por_invalidez").val(this.cargasinvalidas);
                        $("#asig_maternal").val(this.cargasmaternales);

                        if (this.segcesantia ==1){
                            $("#seguro_cesantia").val(this.segcesantia)
                            document.getElementById("seguro_cesantia").checked = true;
                            document.getElementById("datepicker6").disabled=false;

                        }else{
                            document.getElementById("seguro_cesantia").checked = false;
                            document.getElementById("datepicker6").disabled=true;
                        }
                        
                        }
                        )}
                        });
        });

</script>										