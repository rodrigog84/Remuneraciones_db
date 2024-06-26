<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Par&aacute;metros</h4>
            </div>
            <form id="basicBootstrapForm" action="<?php echo base_url(); ?>admins/submit_parametros_generales" id="basicBootstrapForm" method="post">
                <div class="panel-body">
                    <div class="form-group">
                        <label for="sueldominimo">Sueldo M&iacute;nimo</label>
                        <input type="text" class="form-control miles" name="sueldominimo" id="sueldominimo" placeholder="Ingrese Sueldo M&iacute;nimo" value="<?php echo $parametros_generales->sueldominimo; ?>">
                    </div>
                    <div class="form-group">
                        <label for="uf">Valor UF</label>
                        <input type="text" class="form-control miles_decimales" name="uf" id="uf" placeholder="Ingrese Valor UF" value="<?php echo number_format($parametros_generales->uf, 2, ",", "."); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="uf">Valor UTM</label>
                        <input type="text" class="form-control miles" name="utm" id="utm" placeholder="Ingrese Valor UF" value="<?php echo $parametros_generales->utm; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="uf">Tope Imponible AFP (UF)</label>
                        <input type="text" class="form-control miles_decimales" name="topeimponible" id="topeimponible" placeholder="Ingrese Tope Imponible" value="<?php echo number_format($parametros_generales->topeimponible, 2, ",", ""); ?>">
                    </div>
                    <div class="form-group">
                        <label for="uf">Tope Imponible IPS (EX - INP) (UF)</label>
                        <input type="text" class="form-control miles_decimales" name="topeimponibleips" id="topeimponibleips" placeholder="Ingrese Tope Imponible" value="<?php echo number_format($parametros_generales->topeimponibleips, 2, ",", ""); ?>">
                    </div>
                    <div class="form-group">
                        <label for="uf">Tope Imponible AFC (UF)</label>
                        <input type="text" class="form-control miles_decimales" name="topeimponibleafc" id="topeimponibleafc" placeholder="Ingrese Tope Imponible" value="<?php echo number_format($parametros_generales->topeimponibleafc, 2, ",", ""); ?>">
                    </div>
                    <div class="form-group">
                        <label for="uf">Tasa Seguro de Invalidez y Sobrevivencia (SIS)</label>
                        <input type="text" class="form-control" name="tasasis" id="tasasis" placeholder="Ingrese Valor SIS" value="<?php echo $parametros_generales->tasasis; ?>">
                    </div>


                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-success">Actualiza Datos</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    // Post parametros
    const postParametros = async (data) => {
        try {
            let form = new FormData()
            form.append('nombre', data.nombre);
            form.append('valor', data.valor);
            form.append('fecha', data.fecha);
            const response = await axios.post('http://localhost/Remuneraciones_db/procesos/post_parametros', form)
            console.log(response);
        } catch (err) {
            console.log(`Error: ${err}`);
        }
    }

    const indicadores = async (indicador) => {
        try {
            // Define fechas
            let fecha = new Date();
            const ultimoDia = new Date(fecha.getFullYear(), fecha.getMonth() + 1, 0);
            const ultimoDiaPasado = new Date(fecha.getFullYear(), fecha.getMonth, 0);

            // Define fecha segun indicador
            switch (indicador) {
                case 'uf':
                    if (fecha.getDate() > 10) {
                        fecha = ultimoDia.toLocaleDateString('es-CL')
                    } else {
                        fecha = ultimoDiaPasado.toLocaleDateString('es-CL');
                    }
                    break;
                default:
                    fecha = fecha.toLocaleDateString('es-CL')
                    break;
            }

            // Get Parametros de API Mindicador
            let response = await fetch(`https://mindicador.cl/api/${indicador}/${fecha}`);
            response = await response.json();

            const data = {
                nombre: response.codigo,
                valor: response.serie[0].valor,
                fecha: new Date(response.serie[0].fecha).toLocaleDateString('es-CL')
            }

            // Post parametros
            postParametros(data);
        } catch (err) {
            console.log(`Error: ${err}`);
        }
    }


    ['uf', 'utm'].map(indicadores)
</script>

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
                    sueldominimo: {
                        row: '.form-group',
                        validators: {
                            notEmpty: {
                                message: 'Sueldo M&iacute;nimo requerido'
                            }
                        }
                    },


                    uf: {
                        row: '.form-group',
                        validators: {
                            notEmpty: {
                                message: 'Valor UF requerido'
                            }
                        }
                    },

                    tasasis: {
                        row: '.form-group',
                        validators: {
                            notEmpty: {
                                message: 'Tasa SIS es requerida'
                            },
                            between: {
                                min: 0,
                                max: 100,
                                message: 'Tasa debe estar entre 0 y 100'
                            },
                            numeric: {
                                separator: '.',
                                message: 'Monto s&oacute;lo puede contener n&uacute;meros'
                            },
                        }
                    }
                }
            })
            .find('.miles').mask('000.000.000.000.000', {
                reverse: true
            })

    });

    $(document).ready(function() {
        $('.miles_decimales').mask('#.##0,00', {
            reverse: true
        })

    });
</script>


<script>
    $(document).ready(function() {
        <?php if (isset($message)) { ?>

            $.gritter.add({
                title: 'Atención',
                text: '<?php echo $message; ?>',
                sticky: false,
                image: '<?php echo base_url(); ?>images/logos/alert-icon.png',
                time: 5000,
                class_name: 'my-sticky-class'
            });
            /*setTimeout(redirige, 1500);
            function redirige(){
                location.href = '<?php //echo base_url();
                                    ?>welcome/dashboard';
            }*/
        <?php } ?>


    });
</script>
