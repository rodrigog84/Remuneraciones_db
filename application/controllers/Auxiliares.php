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

		
}
