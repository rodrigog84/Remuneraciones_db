<div class="row">

     <!-- end col-3 -->
                <!-- begin col-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="widget widget-stats bg-purple">
                        <div class="stats-icon"><i class="fa fa-users"></i></div>
                        <div class="stats-info">
                            <h4>N&uacute;mero Colaboradores</h4>
                            <!--<p>504</p>-->
                            <p><?php echo $num_colaboradores;  ?> </p>
                        </div>
                        <div class="stats-link">
                            <a href="<?php echo base_url();?>rrhh/mantencion_personal">Ver Detalle <i class="fa fa-arrow-circle-o-right"></i></a>
                        </div>
                    </div>
                </div>

 <!-- end col-3 -->
                <!-- begin col-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="widget widget-stats bg-red">
                        <div class="stats-icon"><i class="fa fa-building"></i></div>
                        <div class="stats-info">
                            <h4>Centros de Costo</h4>
                            <p><?php echo $num_centro_costo;  ?> </p>
                        </div>
                        <div class="stats-link">
                            <a href="<?php echo base_url();?>configuraciones/centrocosto">Ver Detalle <i class="fa fa-arrow-circle-o-right"></i></a>
                        </div>
                    </div>
                </div>                
                <!-- begin col-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="widget widget-stats bg-green">
                        <div class="stats-icon"><i class="fa fa-medkit"></i></div>
                        <div class="stats-info">
                            <h4>Licencias Medicas</h4>
                            <p><?php echo $num_licencia;  ?></p>    
                        </div>
                        <div class="stats-link">
                            <a href="<?php echo base_url();?>auxiliares/licencias">Ver Detalle <i class="fa fa-arrow-circle-o-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- end col-3 -->
                <!-- begin col-3 -->
                
               
               
                <!-- end col-3 -->
            </div>

            <!-- end row -->
            <!-- begin row -->
            <div class="row">
                <!-- begin col-8 -->
                
                <!-- end col-8 -->
                <!-- begin col-4 -->
                <div class="col-md-4">
                    
                    <div class="panel panel-inverse" data-sortable-id="index-8">
                        <div class="panel-heading">
                            <h4 class="panel-title">Indicadores</h4>
                        </div>
                        <div class="panel-body">
                            <div id="container8" class="height-sm">
                               
                               <table class="table table-borderless">
                                   
                                    <tr>
                                        <td class="text-left"><small>UF Hoy (<?php echo $fechoy_format;?>):</small></td>
                                        <td class="text-right" id="uf"><small>$<?php echo $parametros_generales['uf']; ?></small></td>
                                    </tr>
                                    <tr>
                                    <td class="text-left"><small>UF Fin Per&iacute;odo (<?php echo $parametros_generales['max_uf_fecha'];?>):</small></td>
                                        <td class="text-right" id="uf"><small>$<?php echo $parametros_generales['max_uf_valor']; ?></small></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left"><small>Unidad Tributaria Mensual(UTM):</small></td>
                                        <td class="text-right" id=""><small>$<?php echo $parametros_generales['utm']; ?></small></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left"><small>Sueldo Minimo</small></td>
                                        <td class="text-right"><small>$<?php echo $parametros_generales['sueldominimo']; ?></small></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left"><small>Tope Imponible AFP:</small></td>
                                        <td class="text-right"><small><?php echo $parametros_generales['topeimponible']; ?> UF</small></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left"><small>Tope Imponible IPS:</small></td>
                                        <td class="text-right"><small><?php echo $parametros_generales['topeimponibleips']; ?> UF</small></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left"><small>Tope Seguro de Cesantía:</small></td>
                                        <td class="text-right"><small><?php echo $parametros_generales['topeimponibleafc']; ?> UF</small></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left"><small>Tasa SIS:</small></td>
                                        <td class="text-right"><small><?php echo $parametros_generales['tasasis']; ?>%</small></td>
                                    </tr>
                                   <!--  <tr>
                                        <td class="text-left">Tasa Mutualidad:</td>
                                       <td class="text-right"><?php echo $empresa->porcmutual;?>%</td>
                                    </tr>-->

                               </table>

                            </div>

                        </div>
                      
                    </div>
                    
                  
                </div>
                <!-- end col-4 -->
            </div>

<script>



$(function () {


    var num_masc = <?php echo $num_masc; ?>;
    var num_fem = <?php echo $num_fem; ?>;
    var remuneraciones_anual = <?php echo json_encode($pago_remuneraciones); ?>;
    var arreglo_cc = <?php echo json_encode($arreglo_cc); ?>;
    var arreglo_afp = <?php echo json_encode($arreglo_afp); ?>;

    var meses_x_montopago = <?php echo json_encode($meses_x_montopago);  ?>;

   // var meses_x_montopago = <?php echo json_encode($meses_x_montopago); ?>;
    

    $('#container').highcharts({
        chart: {
        type: 'column'
    },
    title: {
        text: 'Remuneración Últimos 12 Meses'
    },
    subtitle: {
        text: 'Fuente: Info-sys.cl'
    },
    xAxis: {
        categories: meses_x_montopago,/*[
            'Ene',
            'Feb',
            'Mar',
            'Abr',
            'May',
            'Jun',
            'Jul',
            'Ago',
            'Sep',
            'Oct',
            'Nov',
            'Dic'
        ],*/
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Monto Pagado(MM$)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} MM$</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Monto Pagado',
        data: remuneraciones_anual
        //data: [18.5, 20, 15, 16, 17, 16.5, 18.1, 18.5, 19, 19.6, 19.4, 20]


    }]
    });



   $('#container2').highcharts({
     
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Colaboradores por Sexo'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [{
            name: 'Hombres',
            y:  num_masc, 
            sliced: true,
            selected: true
        }, {
            name: 'Mujeres',
            y: num_fem
        }]
    }]


    });






    $('#container3').highcharts({
   chart: {
        type: 'column'
    },
    title: {
        text: 'Colaboradores por AFP'
    },
    subtitle: {
        text: 'Fuente: info-sys.cl'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Num. Colaboradores'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        

        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }

        }

    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },

    "series": [
        {
            "name": "Browsers",
            "colorByPoint": true,
            "data": arreglo_afp

            
        }
    ],

    });




 $('#container4').highcharts({
     
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Colaboradores por Centro de Costo'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: arreglo_cc
         /*[{
            name: 'Chrome',
            y: 61.41,
            sliced: true,
            selected: true
        }, {
            name: 'Centro Costo 1',
            y: 11.84
        }, {
            name: 'Centro Costo 2',
            y: 10.85
        }, {
            name: 'Centro Costo 3',
            y: 4.67
        }, {
            name: 'Centro Costo 4',
            y: 4.18
        }]*/
    }]


    });

});


</script>            