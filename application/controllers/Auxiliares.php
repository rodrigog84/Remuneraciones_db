<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auxiliares extends CI_Controller {

	
	function __construct(){
	  parent::__construct();
	  $this->load->library('ion_auth');
      $this->load->library('form_validation');
      $this->load->helper('format');
      $this->load->model('auxiliar');
      if (!$this->ion_auth->logged_in()){
      	 $this->session->set_userdata('uri_array',$this->uri->rsegment_array());
         redirect('auth/login', 'refresh');
      }else{
      		if(!$this->session->userdata('menu_list')){
      			$this->session->set_userdata('menu_list',json_decode($this->ion_auth_model->get_menu($this->session->userdata('user_id'))));
      		}

      		if($this->router->fetch_class()."/".$this->router->fetch_method() != "main/dashboard" && !$this->session->userdata('comunidadid') && ($this->session->userdata('level') == 1)){
      			redirect('main/dashboard');	      			
      		}
      }
      
   }


	public function index()
	{

		$this->load->model('ion_auth_model');
		redirect('main/dashboard');	
	}

	

	public function vacaciones($resultid = '')
	{
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){


			$resultid = $this->session->flashdata('vacaciones_result');
			if($resultid == 1){
				$vars['message'] = "Vacaciones solicitadas correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}elseif($resultid == 2){
				$vars['message'] = "Error al solicitar vacaciones.  Debe indicar trabajador";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 3){
				$vars['message'] = "Error al solicitar vacaciones.  Solicita m&aacutes de lo permitido";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 4){
				$vars['message'] = "Error en visualizaci&oacute;n de cartola.  Debe indicar trabajador";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 5){
				$vars['message'] = "Error al eliminar vacaciones.  Favor intente nuevamente";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 6){
				$vars['message'] = "Error al agregar dia progresivo.  Debe indicar trabajador";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 7){
				$vars['message'] = "Error al solicitar vacaciones.  Trabajador no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 8){
				$vars['message'] = "Error al agregar dia progresivo.  Trabajador no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 9){
				$vars['message'] = "D&iacute;a progresivo agregado/editardo correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';	
			}elseif($resultid == 10){
				$vars['message'] = "Error al eliminar/editar d&iacute;as progresivos autorizados.  Favor intente nuevamente";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 11){
				$vars['message'] = "Error al eliminar/editar d&iacute;as progresivos autorizados.  D&iacute;as ya fueron tomados";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}

			$this->load->model('rrhh_model');
			$personal = $this->rrhh_model->get_personal(); 

			$array_progresivos = array();
			foreach ($personal as $trabajador) {
				$dias_progresivos = $this->auxiliar->get_dias_progresivos($trabajador->id_personal);
				$num_dias_progresivos = num_dias_progresivos($trabajador->fecinicvacaciones,$trabajador->saldoinicvacprog,$dias_progresivos);
				$array_progresivos[$trabajador->id_personal] = $num_dias_progresivos;
			}


			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Vacaciones');

			$vars['content_menu'] = $content;				
			$vars['personal'] = $personal;	
			$vars['progresivos'] = $array_progresivos;	
			$vars['content_view'] = 'auxiliares/vacaciones';
			$vars['formValidation'] = true;
			$vars['gritter'] = true;


			$template = "template";
			

			$this->load->view($template,$vars);	

		}else{
			$content = array(
						'menu' => 'Error 403',
						'title' => 'Error 403',
						'subtitle' => '403 error');


			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}

	}		



public function cartola_vacaciones($idpersonal = '')
	{
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$resultid = $this->session->flashdata('cartola_vacaciones_result');
			if($resultid == 1){
				$vars['message'] = "Solicitud de Vacaciones eliminadas correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}elseif($resultid == 2){
				$vars['message'] = "Error al eliminar vacaciones.  Solicitud no existe o no corresponde";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 3){
				$vars['message'] = "Error al editar vacaciones.  Solicitud no existe o no corresponde";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 4){
				$vars['message'] = "D&iacute;as progresivos eliminados correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}elseif($resultid == 5){
				$vars['message'] = "Error al eliminar d&iacute;as progresivos.  Cartola no existe no existe o no corresponde";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 6){
				$vars['message'] = "Error al eliminar d&iacute;as progresivos.  D&iacute;as ya fueron tomados";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}

			if($idpersonal == ''){
				$this->session->set_flashdata('vacaciones_result', 4);
				redirect('auxiliares/vacaciones');	
			}
			
			$this->load->model('rrhh_model');
			$personal = $this->rrhh_model->get_personal($idpersonal);
			$cartola = $this->auxiliar->get_cartola_vacaciones($idpersonal);
			$dias_progresivos = $this->auxiliar->get_dias_progresivos($idpersonal);

			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Cartola Vacaciones');

			$dias_vacaciones = dias_vacaciones($personal->fecinicvacaciones,$personal->saldoinicvacaciones);

			$cartola_progresivos = cartola_dias_progresivos($personal->fecinicvacaciones,$personal->saldoinicvacprog,$dias_progresivos);



			$cartola_devengada = cartola_vacaciones($personal->fecinicvacaciones,$personal->saldoinicvacaciones,$cartola_progresivos);

			$num_dias_progresivos = num_dias_progresivos($personal->fecinicvacaciones,$personal->saldoinicvacprog,$dias_progresivos);

			$saldo_vacaciones = $dias_vacaciones - $personal->diasvactomados;
			//$saldo_vacaciones = 0;
			$vars['classinfo'] = $saldo_vacaciones <= 0 ? 'danger' : 'success';
			$vars['content_menu'] = $content;				
			$vars['personal'] = $personal;	
			$vars['cartola'] = $cartola;	
			$vars['cartola_devengada'] = $cartola_devengada;	
			$vars['dias_vacaciones'] = $dias_vacaciones;
			$vars['num_dias_progresivos'] = $num_dias_progresivos;

			$vars['cartola_dias_progresivos'] = $dias_progresivos;
			$vars['saldo_vacaciones'] = $saldo_vacaciones;
			$vars['content_view'] = 'auxiliares/cartola_vacaciones';
			$vars['formValidation'] = true;
			$vars['gritter'] = true;
			//$vars['moment'] = true;	

			$template = "template";
			

			$this->load->view($template,$vars);	

		}else{
			$content = array(
						'menu' => 'Error 403',
						'title' => 'Error 403',
						'subtitle' => '403 error');


			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}

	}	

	public function comprobante_solicitud($idpersonal = null,$idcartola = null)
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			if(is_null($idpersonal) || is_null($idcartola)){
				redirect('main/dashboard/');				
			}

			$cartola = $this->auxiliar->get_cartola_vacaciones($idpersonal,$idcartola);



			if(count($cartola) == 0){ // SI NO ENCUENTRO NINGUNA CARTOLA (CORRESPONDE A OTRA COMUNIDAD POR EJEMPLO)
				redirect('main/dashboard/');
			}else{
				$datosdetalle = $this->auxiliar->comprobante_solicitud($idpersonal,$idcartola);
			}

			exit;


		}else{
			$content = array(
						'menu' => 'Error 403',
						'title' => 'Error 403',
						'subtitle' => '403 error');


			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}

	}

	public function delete_vacaciones($idpersonal = '',$idcartola = '')
	{
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){



			if($idpersonal == '' || $idcartola == ''){
				$this->session->set_flashdata('vacaciones_result',5);
				redirect('auxiliares/vacaciones');	
			}

			$result = $this->auxiliar->delete_vacaciones($idpersonal,$idcartola);


			if($result){
				$this->session->set_flashdata('cartola_vacaciones_result', 1);
			}else{
				$this->session->set_flashdata('cartola_vacaciones_result', 2);
			}
			redirect('auxiliares/cartola_vacaciones/'.$idpersonal);	

			
		}else{
			$content = array(
						'menu' => 'Error 403',
						'title' => 'Error 403',
						'subtitle' => '403 error');


			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}

	}

	public function add_dia_progresivo($idpersonal = '',$idcartola = null)
	{
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){



			if($idpersonal == ''){
				$this->session->set_flashdata('vacaciones_result', 6);
				redirect('auxiliares/vacaciones');	
			}
	
			$this->load->model('rrhh_model');

			$personal = $this->rrhh_model->get_personal($idpersonal);


			if(is_null($personal)){
				$this->session->set_flashdata('vacaciones_result', 8);
				redirect('auxiliares/vacaciones');					
			}

			$periodos = get_periodos_vacaciones($personal->fecinicvacaciones);


			$dias_vacaciones = dias_vacaciones($personal->fecinicvacaciones,$personal->saldoinicvacaciones);
			$saldo_vacaciones = $dias_vacaciones - $personal->diasvactomados;

			//$vars['dia_progresivo'] = $dia_progresivo;	


			$dias_progresivos = $this->auxiliar->get_dias_progresivos($idpersonal);
			$num_dias_progresivos = num_dias_progresivos($personal->fecinicvacaciones,$personal->saldoinicvacprog,$dias_progresivos);



			if(!is_null($idcartola)){
				$dia_prog_selec = $this->auxiliar->get_dias_progresivos($idpersonal,$idcartola);
				$titulo_guardar = "Editar";
				$url_back = base_url()."auxiliares/cartola_vacaciones/".$idpersonal;

			}else{
				$idcartola = 0;
				$dia_prog_selec = array();
				$titulo_guardar = "Agregar";
				$url_back = base_url()."auxiliares/vacaciones";

			}

			$vars['num_dias_progresivos'] = $num_dias_progresivos;



			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Agregar d&iacute;a progresivo');






			$vars['classinfo'] = $saldo_vacaciones <= 0 ? 'danger' : 'success';
			$vars['content_menu'] = $content;				
			$vars['personal'] = $personal;	
			$vars['periodos'] = $periodos;	
			$vars['idcartola'] = $idcartola;
			$vars['dias_progresivos'] = $dias_progresivos;
			
			$vars['dia_prog_selec'] = $dia_prog_selec;
			$vars['titulo_guardar'] = $titulo_guardar;
			$vars['url_back'] = $url_back;
			$vars['formValidation'] = true;
			$vars['content_view'] = 'auxiliares/add_dia_progresivo';

			$template = "template";
			

			$this->load->view($template,$vars);	

		}else{
			$content = array(
						'menu' => 'Error 403',
						'title' => 'Error 403',
						'subtitle' => '403 error');


			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}

	}


	public function submit_dia_progresivo(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$idpersonal = $this->input->post('idpersonal');
			$periodo = $this->input->post('periodo');	
			$diassolicita = $this->input->post('diassolicita');	
			$idcartola = $this->input->post('idcartola');


			$array_datos = array(
								'idpersonal' => $idpersonal,
								'periodo' => $periodo,
								'dias' => $diassolicita,
								'idcartola' => $idcartola,
								'created_at' => date("Y-m-d H:i:s")
								);


			$result = $this->auxiliar->add_dia_progresivo($array_datos);


			if($result == 1){
				$this->session->set_flashdata('vacaciones_result', 9);
			}else if($result == 2){
				$this->session->set_flashdata('vacaciones_result', 10);
			}else if($result == 3){
				$this->session->set_flashdata('vacaciones_result', 11);
			}
			
			redirect('auxiliares/vacaciones');	

		}else{
			$content = array(
						'menu' => 'Error 403',
						'title' => 'Error 403',
						'subtitle' => '403 error');


			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);


		}		


	}



public function delete_dias_progresivos($idpersonal = '',$idcartola = '')
	{
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){



			if($idpersonal == '' || $idcartola == ''){
				$this->session->set_flashdata('vacaciones_result',10);
				redirect('remuneraciones/vacaciones');	
			}

			$result = $this->auxiliar->delete_dias_progresivos($idpersonal,$idcartola);


			if($result == 1){
				$this->session->set_flashdata('cartola_vacaciones_result', 4);
			}else if($result == 2){
				$this->session->set_flashdata('cartola_vacaciones_result', 5);
			}else if($result == 3){
				$this->session->set_flashdata('cartola_vacaciones_result', 6);				
			}
			redirect('auxiliares/cartola_vacaciones/'.$idpersonal);	

			
		}else{
			$content = array(
						'menu' => 'Error 403',
						'title' => 'Error 403',
						'subtitle' => '403 error');


			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}

	}	


public function solicita_vacaciones($idpersonal = '',$idcartola = null)
	{
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			if($idpersonal == ''){
				$this->session->set_flashdata('vacaciones_result', 2);
				redirect('auxiliares/vacaciones');	
			}
	
			$this->load->model('rrhh_model');

			$personal = $this->rrhh_model->get_personal($idpersonal);

			if(is_null($personal)){
				$this->session->set_flashdata('vacaciones_result', 7);
				redirect('auxiliares/vacaciones');					
			}
			$this->load->model('admin');
			$feriados = $this->admin->get_feriado();

			$dias_vacaciones = dias_vacaciones($personal->fecinicvacaciones,$personal->saldoinicvacaciones);
			//$saldo_vacaciones = $dias_vacaciones - $personal->diasvactomados;

			$dias_progresivos = $this->auxiliar->get_dias_progresivos($idpersonal);
			$num_dias_progresivos = num_dias_progresivos($personal->fecinicvacaciones,$personal->saldoinicvacprog,$dias_progresivos);
			$saldo_vacaciones = $dias_vacaciones + $num_dias_progresivos - $personal->diasvactomados;

			$vars['num_dias_progresivos'] = $num_dias_progresivos;

			if(!is_null($idcartola)){
				$cartola = $this->auxiliar->get_cartola_vacaciones($idpersonal,$idcartola);

				if(is_null($cartola)){
					$this->session->set_flashdata('vacaciones_result', 2);
					redirect('auxiliares/cartola_vacaciones');	

				}else{

					$vars['fechadesde'] = $cartola->fecinicio;
					$vars['fechahasta'] = $cartola->fecfin;	
					$vars['diassolicita'] = $cartola->dias;	
					$vars['comentario'] = $cartola->comentarios;	
					$vars['titulo'] = "Editar Solicitud";	
					$vars['max_vacaciones'] = $saldo_vacaciones + $cartola->dias;	


				}
			}else{
				$vars['fechadesde'] = date("Y-m-d",strtotime("+ 1 day"));
				$vars['fechahasta'] = date("Y-m-d",strtotime("+ 1 day"));	
				$vars['diassolicita'] = 0;	
				$vars['comentario'] = "";
				$vars['titulo'] = "Solicitar";	
				$vars['max_vacaciones'] = $saldo_vacaciones;	

			}
			

			$array_feriados = array();
			 foreach ($feriados as $feriado) {
			 	array_push($array_feriados,$feriado->fecha_sformat);
			 }

			 $string_feriados = "'".implode("','",$array_feriados)."'";

			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Solicita Vacaciones');





			//$saldo_vacaciones = 0;
			$vars['classinfo'] = $saldo_vacaciones <= 0 ? 'danger' : 'success';
			$vars['content_menu'] = $content;				
			$vars['personal'] = $personal;	
			$vars['dias_vacaciones'] = $dias_vacaciones;
			$vars['saldo_vacaciones'] = $saldo_vacaciones;
			$vars['string_feriados'] = $string_feriados;
			$vars['idcartola'] = is_null($idcartola) ? 0 : $idcartola;
			$vars['content_view'] = 'auxiliares/solicita_vacaciones';
			$vars['formValidation'] = true;
			$vars['datetimepicker'] = true;
			$vars['daterangepicker2'] = true;	
			//$vars['confirmation'] = true;
			//$vars['moment'] = true;	

			$template = "template";
			

			$this->load->view($template,$vars);	

		}else{
			$content = array(
						'menu' => 'Error 403',
						'title' => 'Error 403',
						'subtitle' => '403 error');


			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}

	}		



public function submit_solicita_vacaciones(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){


			$diassolicita = $this->input->post('diassolicita');	
			$comentarios = $this->input->post('comentarios');
			$idpersonal = $this->input->post('idpersonal');
			$fechadesde = $this->input->post('fechadesde');
			$fechahasta = $this->input->post('fechahasta');
			$idcartola = $this->input->post('idcartola');

			$array_datos = array(
								'idpersonal' => $idpersonal,
								'fecinicio' => $fechadesde,
								'fecfin' => $fechahasta,
								'dias' => $diassolicita,
								'comentarios' => $comentarios,
								'idcartola' => $idcartola,
								'created_at' => date("Y-m-d H:i:s")
								);

			$result = $this->auxiliar->solicita_vacaciones($array_datos);

			/*
			$this->session->set_flashdata('descuentos_mes', $mes);
			$this->session->set_flashdata('descuentos_anno', $anno);*/

			if($result){
				$this->session->set_flashdata('vacaciones_result', 1);
			}else{
				$this->session->set_flashdata('vacaciones_result', 3);
			}
			
			redirect('auxiliares/vacaciones');	

		}else{
			$content = array(
						'menu' => 'Error 403',
						'title' => 'Error 403',
						'subtitle' => '403 error');


			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);


		}		


	}


	public function licencias(){
		
			

			$licencia = $this->auxiliar->get_licencias();

			$content = array(
						'menu' => 'Licencias Medicas',
						'title' => 'Licencias Medicas',
						'subtitle' => 'Licencias Medicas');

			$vars['datatable'] = true;
			$vars['content_menu'] = $content;	
			$vars['content_view'] = 'auxiliares/licencias';
			$vars['licencia'] = $licencia;

			$template = "template";
			

			$this->load->view($template,$vars);	


	}

	public function get_licencias(){

		$licencia = $this->auxiliar->get_licencias();
		return $licencia;


	}

	public function add_licencias(){
		
			
			$content = array(
						'menu' => 'Licencias Medicas',
						'title' => 'Licencias Medicas',
						'subtitle' => 'Licencias Medicas');

			$vars['content_menu'] = $content;	
			$vars['content_view'] = 'auxiliares/add_licencias';

			$template = "template";
			

			$this->load->view($template,$vars);	


	}


	public function edit_licencias($id_licencia_medica=null){
		
		
		$datos_licencia2 = $this->auxiliar->get_licencia_datos($id_licencia_medica);

		foreach ($datos_licencia2 as $datos ) {
	# code...

		 
		
		
		$cumpleanos = new DateTime($datos->fecnacimiento);
	    $hoy = new DateTime();	    
	    $annos = $hoy->diff($cumpleanos);
	    $edad = $annos->y;
	    $nombre = $datos->nombre;
	    $apaterno = $datos->apaterno;
	    $amaterno = $datos->amaterno;
	    $rut = $datos->rut.'-'.$datos->dv;
	   // echo $edad;
	    }
	    
		$content = array(
					'menu' => 'Licencias Medicas',
					'title' => 'Licencias Medicas',
					'subtitle' => 'Editar Licencias Medicas');
		$vars['id_licencia_medica'] = $id_licencia_medica;
		$vars['edad'] = $edad;
		$vars['nombre'] = $nombre;
		$vars['apaterno'] = $apaterno;
		$vars['amaterno'] = $amaterno;
		$vars['rut'] = $rut;
		$vars['content_menu'] = $content;
		$vars['id_licencia_medica'] = $id_licencia_medica;	
		$vars['content_view'] = 'auxiliares/mod_licencias';

		$template = "template";
		$this->load->view($template,$vars);	
	}


	public function del_licencia($id_licencia_medica){

		$licencia = $this->auxiliar->del_licencia_medica($id_licencia_medica);

		redirect('auxiliares/licencias');	


	}

	public function datos_licencia($id_licencia_medica=null){

		$datos_licencia2 = $this->auxiliar->get_licencia_datos($id_licencia_medica);

		echo json_encode($datos_licencia2);

	}

	public function submit_licencia(){


		// A1
		$numero_licencia = $this->input->post("numero_licencia");
		$idtrabajador = $this->input->post("id_trabajador");
		$fec_emision_licencia = $this->input->post("fec_emision_licencia");
		$fec_inicio_reposo = $this->input->post("fec_inicio_reposo");
		$edad = $this->input->post("edad");
		$sexo = $this->input->post("sexo");
		$numero_dias = $this->input->post("numero_dias");
		$numero_dias_palabras = $this->input->post("numero_dias_palabras");
		// A2
		$apaterno_hijo = $this->input->post("apaterno_hijo");		
		$amaterno_hijo = $this->input->post("amaterno_hijo");
		$nombre_hijo = $this->input->post("nombre_hijo");
		$fecnachijo = $this->input->post("fecnachijo");
		$rut_hijo = str_replace(".","",$this->input->post("rut_hijo"));
		$arrayRutHijo = explode("-",$rut_hijo);
		// A3
		$tipo_licencia = $this->input->post("tipo_licencia");
		$responsabilidad_laboral = $this->input->post("responsabilidad_laboral");
		$inicio_tramite_invalidez = $this->input->post("inicio_tramite_invalidez");
		$fecha_accidente_trabajo = $this->input->post("fecha_accidente_trabajo");
		$horas = $this->input->post("horas");
		$minutos = $this->input->post("minutos");
		$trayecto = $this->input->post("trayecto");
		// A4
		$tipo_reposo = $this->input->post("tipo_reposo");
		$lugar_reposo = $this->input->post("lugar_reposo");
		$tipo_reposo_parcial = $this->input->post("tipo_reposo_parcial");
		$justificar_otro_domicilio = $this->input->post("justificar_otro_domicilio");
		$direccion_otro_domicilio = $this->input->post("direccion_otro_domicilio");
		$telefono_contacto = $this->input->post("telefono_contacto");
		// A5
		$nombre_profesional = $this->input->post("nombre_profesional");
		$apaterno_profesional = $this->input->post("apaterno_profesional");
		$amaterno_profesional = $this->input->post("amaterno_profesional");
		$rut_profesional = str_replace(".","",$this->input->post("rut_profesional"));
		$arrayRutProfesional = explode("-",$rut_profesional);
		$especialidad_profesional = $this->input->post("especialidad_profesional");
		$tipo_profesional = $this->input->post("tipo_profesional");
		$registro_profesional = $this->input->post("registro_profesional");
		$correo_profesional = $this->input->post("correo_profesional");
		$telefono_profesional = $this->input->post("telefono_profesional");
		$direccion_profesional = $this->input->post("direccion_profesional");
		$fax_profesional = $this->input->post("fax_profesional");
		// A6
		$diagnostico = $this->input->post("diagnostico");
		$otro_diagnostico = $this->input->post("otro_diagnostico");
		$antecedentes_clinicos = $this->input->post("antecedentes_clinicos");
		$examenes_apoyo = $this->input->post("examenes_apoyo");
	
		
		// SE REGULARIZA LOS CAMPOS FECHA DEL FORMATO dd/mm/yyyy A yyyy/mm/dd DE LA BD	
		if($fec_emision_licencia != NULL){
			$date = DateTime::createFromFormat('d/m/Y', $fec_emision_licencia);
			$fec_emision_licencia = $date->format('Ymd');
		}else{
			$fec_emision_licencia = NULL;
		}
		
		if($fec_inicio_reposo != NULL){
			$date = DateTime::createFromFormat('d/m/Y', $fec_inicio_reposo);
			$fec_inicio_reposo = $date->format('Ymd');
		}else{
			$fec_inicio_reposo =NULL;
		}
		
		if ($fecnachijo != NULL){
			$date = DateTime::createFromFormat('d/m/Y', $fecnachijo);
			$fecnachijo = $date->format('Ymd');
		}else{
			$fecnachijo = NULL;

		}
		if ($fecha_accidente_trabajo != NULL){
			$date = DateTime::createFromFormat('d/m/Y', $fecha_accidente_trabajo);
			$fecha_accidente_trabajo = $date->format('Ymd');
		}else{
			$fecha_accidente_trabajo =NULL;
		}
		


		$array_datos = array( 'estado' => 'I',
							//CAMPOS OCULTOS
								'id_personal' => $idtrabajador,
							//A1
								'numero_licencia' => $numero_licencia,			
								'id_empresa' => $this->session->userdata('empresaid'),	       						
								'fec_emision_licencia' => $fec_emision_licencia,
								'fec_inicio_reposo' => $fec_inicio_reposo,
								'edad' => $edad,
								'sexo' => $sexo,
								'numero_dias' => $numero_dias,
								'numero_dias_palabras' => $numero_dias_palabras,
							 //A2
							    'apaterno_hijo' => $apaterno_hijo,	
								'amaterno_hijo' => $amaterno_hijo,
								'nombre_hijo' => $nombre_hijo,
								'fecnachijo' => $fecnachijo,
								'rut_hijo' => $arrayRutHijo[0],
								'dv_hijo' => $arrayRutHijo[1], 
							 //A3
								'tipo_licencia' => $tipo_licencia,
								'responsabilidad_laboral' => $responsabilidad_laboral,
								'inicio_tramite_invalidez' => $inicio_tramite_invalidez,
								'fecha_accidente_trabajo' => $fecha_accidente_trabajo,
								'horas' => $horas,
								'minutos' => $minutos,
								'trayecto' => $trayecto,
							 //A4
								'tipo_reposo' => $tipo_reposo,
								'lugar_reposo' => $lugar_reposo,
								'tipo_reposo_parcial' => $tipo_reposo_parcial,
								'justificar_otro_domicilio' => $justificar_otro_domicilio,
								'direccion_otro_domicilio' => $direccion_otro_domicilio,
								'telefono_contacto' => $telefono_contacto,
							 //A5
								'nombre_profesional' => $nombre_profesional,
								'apaterno_profesional' => $apaterno_profesional,
								'amaterno_profesional' => $amaterno_profesional,
								'rut_profesional' => $arrayRutProfesional[0],
								'dv_profesional' => $arrayRutProfesional[1],
								'especialidad_profesional' => $especialidad_profesional,
								'tipo_profesional' => $tipo_profesional,
								'registro_profesional' => $registro_profesional,
								'correo_profesional' => $correo_profesional,
								'telefono_profesional' => $telefono_profesional,
								'direccion_profesional' => $direccion_profesional,
								'fax_profesional' => $fax_profesional,
							 //A6
								'diagnostico' => $diagnostico,
								'otro_diagnostico' => $otro_diagnostico,
								'antecedentes_clinicos' => $antecedentes_clinicos,
								'examenes_apoyo' => $examenes_apoyo
							);



		$result = $this->auxiliar->add_licencia($array_datos);

			if($result == -1){
				$this->session->set_flashdata('personal_result', 2);
			}else{
				if($idtrabajador == 0){
					$this->session->set_flashdata('personal_result', 1);
				}else{
					$this->session->set_flashdata('personal_result', 6);
				}
			}
			redirect('auxiliares/licencias');

	}

public function submit_mod_licencia(){


		// A1
		$numero_licencia = $this->input->post("numero_licencia");
		$idtrabajador = $this->input->post("id_trabajador");
		$fec_emision_licencia = $this->input->post("fec_emision_licencia");
		$fec_inicio_reposo = $this->input->post("fec_inicio_reposo");
		$edad = $this->input->post("edad");
		$sexo = $this->input->post("sexo");
		$numero_dias = $this->input->post("numero_dias");
		$numero_dias_palabras = $this->input->post("numero_dias_palabras");
		// A2
		$apaterno_hijo = $this->input->post("apaterno_hijo");		
		$amaterno_hijo = $this->input->post("amaterno_hijo");
		$nombre_hijo = $this->input->post("nombre_hijo");
		$fecnachijo = $this->input->post("fecnachijo");
		$rut_hijo = str_replace(".","",$this->input->post("rut_hijo"));
		$arrayRutHijo = explode("-",$rut_hijo);
		// A3
		$tipo_licencia = $this->input->post("tipo_licencia");
		$responsabilidad_laboral = $this->input->post("responsabilidad_laboral");
		$inicio_tramite_invalidez = $this->input->post("inicio_tramite_invalidez");
		$fecha_accidente_trabajo = $this->input->post("fecha_accidente_trabajo");
		$horas = $this->input->post("horas");
		$minutos = $this->input->post("minutos");
		$trayecto = $this->input->post("trayecto");
		// A4
		$tipo_reposo = $this->input->post("tipo_reposo");
		$lugar_reposo = $this->input->post("lugar_reposo");
		$tipo_reposo_parcial = $this->input->post("tipo_reposo_parcial");
		$justificar_otro_domicilio = $this->input->post("justificar_otro_domicilio");
		$direccion_otro_domicilio = $this->input->post("direccion_otro_domicilio");
		$telefono_contacto = $this->input->post("telefono_contacto");
		// A5
		$nombre_profesional = $this->input->post("nombre_profesional");
		$apaterno_profesional = $this->input->post("apaterno_profesional");
		$amaterno_profesional = $this->input->post("amaterno_profesional");
		$rut_profesional = str_replace(".","",$this->input->post("rut_profesional"));
		$arrayRutProfesional = explode("-",$rut_profesional);
		$especialidad_profesional = $this->input->post("especialidad_profesional");
		$tipo_profesional = $this->input->post("tipo_profesional");
		$registro_profesional = $this->input->post("registro_profesional");
		$correo_profesional = $this->input->post("correo_profesional");
		$telefono_profesional = $this->input->post("telefono_profesional");
		$direccion_profesional = $this->input->post("direccion_profesional");
		$fax_profesional = $this->input->post("fax_profesional");
		// A6
		$diagnostico = $this->input->post("diagnostico");
		$otro_diagnostico = $this->input->post("otro_diagnostico");
		$antecedentes_clinicos = $this->input->post("antecedentes_clinicos");
		$examenes_apoyo = $this->input->post("examenes_apoyo");
		$id_licencia_medica = $this->input->post("id_licencia_medica2");
	
				
		// SE REGULARIZA LOS CAMPOS FECHA DEL FORMATO dd/mm/yyyy A yyyy/mm/dd DE LA BD	
		if($fec_emision_licencia != NULL){
			$date = DateTime::createFromFormat('d/m/Y', $fec_emision_licencia);
			$fec_emision_licencia = $date->format('Ymd');
		}else{
			$fec_emision_licencia = NULL;
		}
		
		if($fec_inicio_reposo != NULL){
			$date = DateTime::createFromFormat('d/m/Y', $fec_inicio_reposo);
			$fec_inicio_reposo = $date->format('Ymd');
		}else{
			$fec_inicio_reposo =NULL;
		}
		
		if ($fecnachijo != NULL){
			$date = DateTime::createFromFormat('d/m/Y', $fecnachijo);
			$fecnachijo = $date->format('Ymd');
		}else{
			$fecnachijo = NULL;

		}
		if ($fecha_accidente_trabajo != NULL){
			$date = DateTime::createFromFormat('d/m/Y', $fecha_accidente_trabajo);
			$fecha_accidente_trabajo = $date->format('Ymd');
		}else{
			$fecha_accidente_trabajo =NULL;
		}
		
		

		$array_datos = array('estado' => 'I',
							//CAMPOS OCULTOS
								'id_personal' => $idtrabajador,
							//A1
								'numero_licencia' => $numero_licencia,			
								'id_empresa' => $this->session->userdata('empresaid'),	       						
								'fec_emision_licencia' => $fec_emision_licencia,
								'fec_inicio_reposo' => $fec_inicio_reposo,
								'edad' => $edad,
								'sexo' => $sexo,
								'numero_dias' => $numero_dias,
								'numero_dias_palabras' => $numero_dias_palabras,
							 //A2
							    'apaterno_hijo' => $apaterno_hijo,	
								'amaterno_hijo' => $amaterno_hijo,
								'nombre_hijo' => $nombre_hijo,
								'fecnachijo' => $fecnachijo,
								'rut_hijo' => $arrayRutHijo[0],
								'dv_hijo' => $arrayRutHijo[1], 
							 //A3
								'tipo_licencia' => $tipo_licencia,
								'responsabilidad_laboral' => $responsabilidad_laboral,
								'inicio_tramite_invalidez' => $inicio_tramite_invalidez,
								'fecha_accidente_trabajo' => $fecha_accidente_trabajo,
								'horas' => $horas,
								'minutos' => $minutos,
								'trayecto' => $trayecto,
							 //A4
								'tipo_reposo' => $tipo_reposo,
								'lugar_reposo' => $lugar_reposo,
								'tipo_reposo_parcial' => $tipo_reposo_parcial,
								'justificar_otro_domicilio' => $justificar_otro_domicilio,
								'direccion_otro_domicilio' => $direccion_otro_domicilio,
								'telefono_contacto' => $telefono_contacto,
							 //A5
								'nombre_profesional' => $nombre_profesional,
								'apaterno_profesional' => $apaterno_profesional,
								'amaterno_profesional' => $amaterno_profesional,
								'rut_profesional' => $arrayRutProfesional[0],
								'dv_profesional' => $arrayRutProfesional[1],
								'especialidad_profesional' => $especialidad_profesional,
								'tipo_profesional' => $tipo_profesional,
								'registro_profesional' => $registro_profesional,
								'correo_profesional' => $correo_profesional,
								'telefono_profesional' => $telefono_profesional,
								'direccion_profesional' => $direccion_profesional,
								'fax_profesional' => $fax_profesional,
							 //A6
								'diagnostico' => $diagnostico,
								'otro_diagnostico' => $otro_diagnostico,
								'antecedentes_clinicos' => $antecedentes_clinicos,
								'examenes_apoyo' => $examenes_apoyo
							);

		
		
		$result = $this->auxiliar->mod_licencia($array_datos,$id_licencia_medica);

			if($result == -1){
				$this->session->set_flashdata('personal_result', 2);
			}else{
				if($idtrabajador == 0){
					$this->session->set_flashdata('personal_result', 1);
				}else{
					$this->session->set_flashdata('personal_result', 6);
				}
			}
			redirect('auxiliares/licencias');
	
	}

		
}
