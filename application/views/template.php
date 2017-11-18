<!DOCTYPE HTML>
<html>
<head>
<title>IS RR.HH</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Augment Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="<?php echo base_url();?>css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="<?php echo base_url();?>css/style.css" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url();?>css/style_grid.css" rel="stylesheet" type="text/css" media="all" />

<!-- Graph CSS -->
<link href="<?php echo base_url();?>css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
<script src="<?php echo base_url();?>js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url();?>js/amcharts.js"></script>	
<script src="<?php echo base_url();?>js/serial.js"></script>	
<script src="<?php echo base_url();?>js/light.js"></script>	
<script src="<?php echo base_url();?>js/radar.js"></script>	
<link href="<?php echo base_url();?>css/barChart.css" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url();?>css/fabochart.css" rel='stylesheet' type='text/css' />
<!--clock init-->
<script src="<?php echo base_url();?>js/css3clock.js"></script>
<!--Easy Pie Chart-->
<!--skycons-icons-->
<script src="<?php echo base_url();?>js/skycons.js"></script>

<script src="<?php echo base_url();?>js/jquery.easydropdown.js"></script>

<!--//skycons-icons-->
</head> 
<body>
	<div class="page-container">
		<div class="left-content">
	   		<div class="inner-content">
				<div class="header-section">
					<div class="top_menu">
						<div class="main-search">
							<form>
								<input type="text" value="Search" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Buscar';}" class="text"/>
								<input type="submit" value="">
							</form>
							<div class="close"><img src="images/cross.png" /></div>
						</div>
						<div class="srch"><button></button></div>
						<script type="text/javascript">
							$('.main-search').hide();
							$('button').click(function (){
								$('.main-search').show();
								$('.main-search text').focus();
							});
							$('.close').click(function(){
								('.main-search').hide();
							});
						</script>

						<div class="profile_details_left">
							<ul class="nofitications-dropdown">
								
								<li class="dropdown note">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-power-off" aria-hidden="true"></i> <span class="badge"></span></a>
									<ul class="dropdown-menu two first">
										<li>
											<div class="notification_header">
												<h3>Cerrar Sesión</h3> 
											</div>
										</li>
										<li>
											<a href="<?php echo base_url();?>auth/logout">
												<div class="user_img">
													<img src="images/cerrar.png" alt="cerrar">
												</div>
												<div class="notification_desc">
												
													<p><span>Cerrar Sesión</span></p>
												</div>
												<div class="clearfix"></div>	
											</a>
										</li>
									</ul>
								</li>
										
								
							
							</div>
							<div class="clearfix"></div>	
							<!--//profile_details-->
						</div>
						<!--//menu-right-->
					<div class="clearfix"></div>
				</div>
					<!-- //header-ends -->
						<div class="outter-wp">
								<!--custom-widgets-->
									<!--//bottom-grids-->
										<?php $this->load->view($content_view); ?>
						</div>
									<!--/charts-inner-->
					</div>
										<!--//outer-wp-->
					</div>
									 <!--footer section start-->
										<footer>
										   <p>&copy 2017 IS RR.HH | Diseñado por  <a href="https://consisa.cl/" target="_blank">Grupo Consisa.</a></p>
										</footer>
									<!--footer section end-->
								</div>
							</div>
				<!--//content-inner-->



<!-- //Modal Parametros configuracion -->
<div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="myModal13">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Parámetros</h4>
      </div>

      <div class="modal-body">
      	<table class="table">
    <thead> 
		<tr> 
			<th>Sueldo Minimo:</th> 
			<th>Valor UF:</th>
			
		</tr> 
	</thead>
	<tbody>
		<td><input class="form-control miles" name="sueldominimo" id="sueldominimo" placeholder="Ingrese Sueldo Mínimo" data-fv-field="sueldominimo" autocomplete="off" type="text"></td>
		
		<td><input class="form-control miles_decimales" name="uf" id="uf" placeholder="Ingrese Valor UF" data-fv-field="uf" autocomplete="off" type="text"></td>
			
	</tbody>

</table>

<table class="table">
    <thead> 
		<tr> 
			<th>Tope Imponible (UF):</th> 
			<th>Tasa Seguro de Invalidez (SIS):</th>
			
		</tr> 
	</thead>
	<tbody>
		<td><input class="form-control miles_decimales" name="topeimponible" id="topeimponible" placeholder="Ingrese Tope Imponible" autocomplete="off" type="text"></td>

		<td><input class="form-control" name="tasasis" id="tasasis" placeholder="Ingrese Valor SIS" data-fv-field="tasasis" type="text"></td>
			
	</tbody>
</table>

	
		<br>		
		<button type = "button" class = "btn btn-info" id="comando">Guardar</button>
		<button type = "button" class = "btn btn-danger" data-dismiss="modal"  id="comando">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- //Modal Parametros -->


			<!--/sidebar-menu-->
				<div class="sidebar-menu">
					<header class="logo">
					<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="inicio.html"> <span id="logo"> <h1>Configuración</h1></span> 
					<!--<img id="logo" src="" alt="Logo"/>--> 
				  </a> 
				</header>
			<div style="border-top:1px solid rgba(69, 74, 84, 0.7)"></div>
			<!--/down-->
			
							   <!--//down-->
                           <div class="menu">
									<ul id="menu" >
										<li><a href="<?php echo base_url();?>main/dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
										<?php foreach ($this->session->userdata('menu_list') as $menu): ?>
										                <?php 
										                  if($menu->menuleaf == 0 && $menu->cant_visible > 0){
										                      $show_menu = true;
										                      $menuhref = "#";
										                  }else if($menu->menuleaf == 0 && $menu->cant_visible == 0){
										                      $show_menu = false;
										                  }else{
										                      $show_menu = true;
										                      $menuhref = $menu->app[0]->appfunction;
										                  }
										                

										                ?>

										                <?php if($show_menu){ ?>
										                  <?php $angle_left = $menu->menuleaf == 0 ? "fa-angle-right" : ""; ?>
										                  <li class="menu-academico">
										                    <a href="<?php echo base_url().$menuhref; ?>">
										                      <i class="fa <?php echo $menu->menuimg;?>"></i>
										                      <span><?php echo $menu->menuname;?></span>
										                      <span class="fa <?php echo $angle_left; ?>" style="float: right"></span>
										                    </a>
										                    <?php if($menu->menuleaf == 0): ?>
										                      <ul class="menu-academico-sub">
										                        <?php foreach ($menu->app as $app): ?>
										                            <?php if($app->appvisible == 1): ?>
										                         <li><a href="<?php echo base_url().$app->appfunction; ?>"><!--i class="fa fa-circle-o"></i--><?php echo $app->appname; ?></a></li> 
										                            <?php endif; ?>
										                        <?php endforeach; ?>
										                      </ul>
										                    <?php endif; ?>
										                  </li>
										                <?php } ?>
										            <?php endforeach; ?>
								</ul>
								</div>
							  </div>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<link rel="stylesheet" href="<?php echo base_url();?>css/vroom.css">
<script type="text/javascript" src="<?php echo base_url();?>js/vroom.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/TweenLite.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/CSSPlugin.min.js"></script>
<script src="<?php echo base_url();?>js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url();?>js/scripts.js"></script>

<!-- Bootstrap Core JavaScript -->
   <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>

     <!-- /Script Modal -->
<script>
	$('#myModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)  
})
</script>
<!-- /Script Modal -->
</body>
</html>