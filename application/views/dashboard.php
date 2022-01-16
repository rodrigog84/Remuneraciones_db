

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
                <div class="col-md-3 col-sm-6">
                    <div class="widget widget-stats bg-blue">
                        <div class="stats-icon"><i class="fa fa-money"></i></div>
                        <div class="stats-info">
                            <h4>Periodo de Remuneraciones</h4>
                            <p><?php echo $periodo_actual?></p>   
                        </div>
                        <div class="stats-link">
                            <a href="<?php echo base_url();?>rrhh/calculo_remuneraciones">Ver Detalle <i class="fa fa-arrow-circle-o-right"></i></a>
                        </div>
                    </div>
                </div>
               
               
                <!-- end col-3 -->
            </div>

            <!-- end row -->
            <!-- begin row -->
            <div class="row">
                <!-- begin col-8 -->
                <div class="col-md-8">
                    <div class="panel panel-inverse" data-sortable-id="index-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Monto Pago Remuneraciones &Uacute;ltimos 12 meses</h4>
                        </div>
                        <div class="panel-body">
                            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto" class="height-sm"></div>
                        </div>
                    </div>
                    
                    <div class="panel panel-inverse" data-sortable-id="index-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Colaboradores por A.F.P</h4>
                        </div>
                        <div class="panel-body">
                            <div id="container3" style="min-width: 310px; height: 400px; margin: 0 auto" class="height-sm"></div>
                        </div>
                    </div>   

                     <div class="panel panel-inverse" data-sortable-id="index-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Tabla Asignaci&oacute;n Familiar</h4>
                        </div>
                        <div class="panel-body">
                           
                                                            <div class="tables">
                                                                <table class="table"> 
                                                                    <thead> 
                                                                        <tr>
                                                                            <th style="width: 10px">#</th>
                                                                            <th>Desde ($)</th> 
                                                                            <th>Hasta ($)</th> 
                                                                            <th>Monto Asignación Familiar ($)</th> 
                                                                        </tr> 
                                                                    </thead> 
                                                                    <tbody> 
                                                                <?php $i = 1; ?>
                                                                <?php foreach ($tabla_asig_familiar as $asig_familiar) { ?>           <tr>
                                                                    <td><?php echo $i;?></td>
                                                                    <td class="form-group"><?php echo number_format($asig_familiar->desde,0,".","."); ?></td>
                                                                    <td class="form-group"><?php if($asig_familiar->hasta != 999999999){ ?><?php echo number_format($asig_familiar->hasta,0,".","."); ?><?php }else{ ?>Y m&aacute;s<?php } ?></td>
                                                                    <td class="form-group"><?php echo number_format($asig_familiar->monto,0,".","."); ?></td>
                                                                  </tr>
                                                                  <?php $i++; ?>
                                                                <?php } ?>                                                                      
                                                                    </tbody> 
                                                                </table> 
                                                              </div>

                        </div>
                    </div>                  


                        <!--div class="panel panel-inverse" data-sortable-id="index-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Tabla Impuesto &Uacute;nico</h4>
                        </div>
                        <div class="panel-body">
                           
                                                            <div class="tables">
                                                                

                                                                <table class="table"> 
                                                                    <thead> 
                                                                        <tr>
                                                                            <th style="width: 10px">#</th>
                                                                            <th>Desde (UTM)</th> 
                                                                            <th>Hasta (UTM)</th> 
                                                                            <th>Factor</th> 
                                                                            <th>Rebajas (UTM)</th> 
                                                                            

                                                                        </tr> 
                                                                    </thead> 
                                                                    <tbody> 
                                                                    <?php $i = 1; ?>
                                                                    <?php foreach ($tabla_impuesto as $impuesto) { ?>                                                       
                                                                        <tr class="active" id="variable">
                                                                            <td><?php echo $i;?></td>
                                                                            <td class="form-group"><input type="text" class="form-control miles_decimales2 desde" name="desde_<?php echo $impuesto->id_tabla_impuesto;?>" id="desde_<?php echo $impuesto->id_tabla_impuesto;?>" placeholder="Ingrese Monto Desde" value="<?php echo number_format($impuesto->desde,2,",","."); ?>"></td>
                        <td class="form-group"><?php if($impuesto->hasta != 999999999){ ?><input type="text" class="form-control miles_decimales2 hasta" name="hasta_<?php echo $impuesto->id_tabla_impuesto;?>" id="hasta_<?php echo $impuesto->id_tabla_impuesto;?>" placeholder="Ingrese Monto Hasta" value="<?php echo number_format($impuesto->hasta,2,",","."); ?>"><?php }else{ ?>Y m&aacute;s<?php } ?></td>
                        <td class="form-group"><input type="text" class="form-control miles_decimales factor" name="factor_<?php echo $impuesto->id_tabla_impuesto;?>" id="factor_<?php echo $impuesto->id_tabla_impuesto;?>" placeholder="Ingrese Factor" value="<?php echo number_format($impuesto->factor,3,".",","); ?>"></td>
                        <td class="form-group"><input type="text" class="form-control miles_decimales2 rebaja" name="rebaja_<?php echo $impuesto->id_tabla_impuesto;?>" id="rebaja_<?php echo $impuesto->id_tabla_impuesto;?>" placeholder="Ingrese Monto Rebaja" value="<?php echo number_format($impuesto->rebaja,2,",","."); ?>"></td>               
                                                                        </tr> 
                                                                      <?php $i++; ?>
                                                                    <?php } ?>                                                                      
                                                                    </tbody> 
                                                                </table>

                                                              </div>

                        </div>
                    </div--> 

                </div>
                <!-- end col-8 -->
                <!-- begin col-4 -->
                <div class="col-md-4">
                    <div class="panel panel-inverse" data-sortable-id="index-6">
                        <div class="panel-heading">
                            
                            <h4 class="panel-title">Colaboradores por Sexo</h4>
                        </div>
                        <div class="panel-body p-t-0">
                            <div id="container2" style="min-width: 310px; height: 310px; margin: 0 auto"></div>
                        </div>
                    </div>
                    
                    <div class="panel panel-inverse" data-sortable-id="index-7">
                        <div class="panel-heading">
                            <h4 class="panel-title">Colaboradores por Centro de Costo</h4>
                        </div>
                        <div class="panel-body">
                            <div id="container4" class="height-sm"></div>
                        </div>
                    </div>
                    <div class="panel panel-inverse" data-sortable-id="index-8">
                        <div class="panel-heading">
                            <h4 class="panel-title">Indicadores</h4>
                        </div>
                        <div class="panel-body">
                            <div id="container" class="height">
                               
                               <table class="table table-borderless">
                                   
                                    <tr>
                                        <td class="text-left">Unidad de Fomento (UF):</td>
                                        <td class="text-right">$<?php echo $parametros_generales->uf;?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Unidad Tributaria Mensual(UTM):</td>
                                        <td class="text-right">$<?php echo $parametros_generales->utm;?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Sueldo Minimo</td>
                                        <td class="text-right">$<?php echo $parametros_generales->sueldominimo;?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Tope Imponible AFP:</td>
                                        <td class="text-right"><?php echo $parametros_generales->topeimponible;?> UF</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Tope Imponible IPS:</td>
                                        <td class="text-right"><?php echo $parametros_generales->topeimponibleips;?> UF</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Tope Seguro de Cesantía:</td>
                                        <td class="text-right"><?php echo $parametros_generales->topeimponibleafc;?> UF</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Tasa SIS:</td>
                                        <td class="text-right"><?php echo $parametros_generales->tasasis;?>%</td>
                                    </tr>
                                       <tr>
                                        <td class="text-left">Tasa Mutualidad:</td>
                                        <td class="text-right"><?php echo $empresa->porcmutual;?>%</td>
                                    </tr>

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
        text: 'Fuente: arnou.cl'
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
        text: 'Fuente: arnou.cl'
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

            /*[
                {
                    "name": "Capital",
                    "y": 62.74,
                    "drilldown": "Capital"
                },
                {
                    "name": "Cuprum",
                    "y": 10.57,
                    "drilldown": "Cuprum"
                },
                {
                    "name": "Habitat",
                    "y": 7.23,
                    "drilldown": "Habitat"
                },
                {
                    "name": "Modelo",
                    "y": 5.58,
                    "drilldown": "Modelo"
                },
                {
                    "name": "PlanVital",
                    "y": 4.02,
                    "drilldown": "PlanVital"
                },
                {
                    "name": "Provida",
                    "y": 1.92,
                    "drilldown": "Provida"
                },
                {
                    "name": "No Cotiza",
                    "y": 7.62,
                    "drilldown": "No Cotiza"
                }
            ]*/
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