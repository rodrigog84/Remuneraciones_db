								<!--custom-widgets-->
							<div class="inner_content_w3_agile_info">
					<!-- /agile_top_w3_grids-->
					   <div class="agile_top_w3_grids">
					          <ul class="ca-menu">
									<li>
										<a href="#">
											
											<i class="fa fa-building-o" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main">Empresas</h4>
												<h3 class="ca-sub">Nueva Empresa</h3>
											</div>
										</a>
									</li>
									<li>
										<a href="#">
										  <i class="fa fa-user" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main one">Personal</h4>
												<h3 class="ca-sub one">Creacion Colaborador</h3>
											</div>
										</a>
									</li>
									<li>
										<a href="#">
											<i class="fa fa-archive" aria-hidden="true"></i>
											<div class="ca-content">
											<h4 class="ca-main two">Contratos</h4>
												<h3 class="ca-sub two">Creacion de Contratos</h3>
											</div>
										</a>
									</li>
									<li>
										<a href="#">
											<i class="fa fa-suitcase" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main three">Finiquitos</h4>
												<h3 class="ca-sub three">Creacion de Finiquitos</h3>
											</div>
										</a>
									</li>
									<div class="clearfix"></div>
								</ul>
					   </div>
					
				    </div>
				    <br>
					<br>
								
								<h2 class="inner-tittle">Gráfico de Barra</h2>
								<div class="graph">
									<div id="chartdiv5"></div>	
								</div>

								<script>
									var chart = AmCharts.makeChart("chartdiv5", {
										"type": "serial",
										"theme": "light",
										"legend": {
											"equalWidths": false,
											"useGraphSettings": true,
											"valueAlign": "left",
											"valueWidth": 120
										},
										"dataProvider": [{
											"date": "2012-01-01",
											"distance": 227,
											"townName": "New York",
											"townName2": "New York",
											"townSize": 25,
											"latitude": 40.71,
											"duration": 408
										}, {
											"date": "2012-01-02",
											"distance": 371,
											"townName": "Washington",
											"townSize": 14,
											"latitude": 38.89,
											"duration": 482
											}, {
												"date": "2012-01-03",
												"distance": 433,
												"townName": "Wilmington",
												"townSize": 6,
												"latitude": 34.22,
												"duration": 562
											}, {
												"date": "2012-01-04",
												"distance": 345,
												"townName": "Jacksonville",
												"townSize": 7,
												"latitude": 30.35,
												"duration": 379
											}, {
												"date": "2012-01-05",
												"distance": 480,
												"townName": "Miami",
												"townName2": "Miami",
												"townSize": 10,
												"latitude": 25.83,
												"duration": 501
											}, {
												"date": "2012-01-06",
												"distance": 386,
												"townName": "Tallahassee",
												"townSize": 7,
												"latitude": 30.46,
												"duration": 443
											}, {
												"date": "2012-01-07",
												"distance": 348,
												"townName": "New Orleans",
												"townSize": 10,
												"latitude": 29.94,
												"duration": 405
											}, {
												"date": "2012-01-08",
												"distance": 238,
												"townName": "Houston",
												"townName2": "Houston",
												"townSize": 16,
												"latitude": 29.76,
												"duration": 309
											}, {
												"date": "2012-01-09",
												"distance": 218,
												"townName": "Dalas",
												"townSize": 17,
												"latitude": 32.8,
												"duration": 287
											}, {
												"date": "2012-01-10",
												"distance": 349,
												"townName": "Oklahoma City",
												"townSize": 11,
												"latitude": 35.49,
												"duration": 485
											}, {
												"date": "2012-01-11",
												"distance": 603,
												"townName": "Kansas City",
												"townSize": 10,
												"latitude": 39.1,
												"duration": 890
											}, {
												"date": "2012-01-12",
												"distance": 534,
												"townName": "Denver",
												"townName2": "Denver",
												"townSize": 18,
												"latitude": 39.74,
												"duration": 810
											}, {
												"date": "2012-01-13",
												"townName": "Salt Lake City",
												"townSize": 12,
												"distance": 425,
												"duration": 670,
												"latitude": 40.75,
												"dashLength": 8,
												"alpha": 0.4
											}, {
												"date": "2012-01-14",
												"latitude": 36.1,
												"duration": 470,
												"townName": "Las Vegas",
												"townName2": "Las Vegas"
											}, {
												"date": "2012-01-15"
											}, {
												"date": "2012-01-16"
											}, {
												"date": "2012-01-17"
											}, {
												"date": "2012-01-18"
											}, {
												"date": "2012-01-19"
											}],
											"valueAxes": [{
												"id": "distanceAxis",
												"axisAlpha": 0,
												"gridAlpha": 0,
												"position": "left",
												"title": "distancia"
											}, {
												"id": "latitudeAxis",
												"axisAlpha": 0,
												"gridAlpha": 0,
												"labelsEnabled": false,
												"position": "right"
											}, {
												"id": "durationAxis",
												"duration": "mm",
												"durationUnits": {
													"hh": "h ",
													"mm": "min"
												},
												"axisAlpha": 0,
												"gridAlpha": 0,
												"inside": true,
												"position": "right",
												"title": "duracion"
											}],
											"graphs": [{
												"alphaField": "alpha",
												"balloonText": "[[value]] miles",
												"dashLengthField": "dashLength",
												"fillAlphas": 0.7,
												"legendPeriodValueText": "total: [[value.sum]] mi",
												"legendValueText": "[[value]] mi",
												"title": "distancia",
												"type": "column",
												"valueField": "distance",
												"valueAxis": "distanceAxis"
											}, {
												"balloonText": "latitude:[[value]]",
												"bullet": "round",
												"bulletBorderAlpha": 1,
												"useLineColorForBulletBorder": true,
												"bulletColor": "#FFFFFF",
												"bulletSizeField": "townSize",
												"dashLengthField": "dashLength",
												"descriptionField": "townName",
												"labelPosition": "right",
												"labelText": "[[townName2]]",
												"legendValueText": "[[description]]/[[value]]",
												"title": "latitud / ciudad",
												"fillAlphas": 0,
												"valueField": "latitude",
												"valueAxis": "latitudeAxis"
											}, {
												"bullet": "square",
												"bulletBorderAlpha": 1,
												"bulletBorderThickness": 1,
												"dashLengthField": "dashLength",
												"legendValueText": "[[value]]",
												"title": "duracion",
												"fillAlphas": 0,
												"valueField": "duration",
												"valueAxis": "durationAxis"
											}],
											"chartCursor": {
												"categoryBalloonDateFormat": "DD",
												"cursorAlpha": 0.1,
												"cursorColor":"#052963",
												"fullWidth":true,
												"valueBalloonsEnabled": false,
												"zoomable": false
											},
											"dataDateFormat": "YYYY-MM-DD",
											"categoryField": "date",
											"categoryAxis": {
												"dateFormats": [{
													"period": "DD",
													"format": "DD"
												}, {
													"period": "WW",
													"format": "MMM DD"
												}, {
													"period": "MM",
													"format": "MMM"
												}, {
													"period": "YYYY",
													"format": "YYYY"
												}],
												"parseDates": true,
												"autoGridCount": false,
												"axisColor": "#555555",
												"gridAlpha": 0.1,
												"gridColor": "#FFFFFF",
												"gridCount": 50
											},
											"export": {
												"enabled": true
											 }
											});
									</script>

									<br><br
		 
									<div class="bottom-grids">
										<div class="dev-table">    
											<div class="col-md-4 dev-col">                                    

                                            <div class="dev-widget dev-widget-transparent">
                                                <h2 class="inner one">Server Usage</h2>
                                                <p>Today server usage in percentages</p>                                        
                                                <div class="dev-stat"><span class="counter">68</span>%</div>                                                                                
                                                <div class="progress progress-bar-xs">
                                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                                                </div>                                        
                                                <p>We Todayly recommend you change your plan to <strong>Pro</strong>. Click here to get more details.</p>

                                                <a href="#" class="dev-drop">Take a closer look <span class="fa fa-angle-right pull-right"></span></a>
                                            </div>

                                        </div>
                                        <div class="col-md-4 dev-col mid">                                    

                                            <div class="dev-widget dev-widget-transparent dev-widget-success">
                                                 <h3 class="inner">Today Earnings</h3>
                                                <p>This is Today earnings per last year</p>                                        
                                                <div class="dev-stat">$<span class="counter">75,332</span></div>                                                                                
                                                <div class="progress progress-bar-xs">
                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 79%;"></div>
                                                </div>                                        
                                                <p>We happy to notice you that you become an Elite customer, and you can get some custom sugar.</p>

                                                <a href="#" class="dev-drop">Take a closer look <span class="fa fa-angle-right pull-right"></span></a>
                                            </div>

                                        </div>
                                        <div class="col-md-4 dev-col">                                    

                                            <div class="dev-widget dev-widget-transparent dev-widget-danger">
                                                 <h3 class="inner">Your Balance</h3>
                                                <p>All your earnings for this time</p>
                                                <div class="dev-stat">$<span class="counter">5,321</span></div>                                                                                
                                                <div class="progress progress-bar-xs">
                                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                                                </div>                                        
                                                <p>You can withdraw this money in end of each month. Also you can spend it on our marketplace.</p>

                                                <a href="#" class="dev-drop">Take a closer look <span class="fa fa-angle-right pull-right"></span></a>                                        
                                            </div>

                                        </div>
										<div class="clearfix"></div>		
										
										</div>
										</div>
									<!--//bottom-grids-->
									