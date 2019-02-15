<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	
	function __construct(){
	  parent::__construct();
	  $this->load->library('ion_auth');
      $this->load->library('form_validation');
      $this->load->helper('format');
      
      if (!$this->ion_auth->logged_in()){
      	 $this->session->set_userdata('uri_array',$this->uri->rsegment_array());
         redirect('auth/login', 'refresh');
      }else{
      		if(!$this->session->userdata('menu_list')){
      			$this->session->set_userdata('menu_list',json_decode($this->ion_auth_model->get_menu($this->session->userdata('user_id'))));
      		}
      		if($this->router->fetch_class()."/".$this->router->fetch_method() != "main/dashboard" && !$this->session->userdata('comunidadid') && ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3)){
				      		redirect('main/dashboard');      			
      		}
      }
      
   }


	public function index()
	{

		$this->load->model('ion_auth_model');
		redirect('main/dashboard');	
	}


	//TODOS TIENEN ACCESO AL DASHBOARD
	public function dashboard($unidad_id = '')
	{

		$this->load->model('ion_auth_model');	
		$this->load->model('admin');
		$this->load->model('rrhh_model');
		$this->load->model('auxiliar');
		$afp = $this->admin->get_afp();	
		$cant_afp = sizeof($afp);	
		$colaboradores = $this->rrhh_model->get_personal_datos();
		$num_colaboradores = sizeof($colaboradores);
		$centro_costo = $this->rrhh_model->get_centro_costo();
		$num_centro_costo = sizeof($centro_costo);
		$num_masculino=0;
		$num_femenino=0;
		$parametros_generales = $this->admin->get_parametros_generales();
		$licencia = $this->auxiliar->get_licencias();
		$num_licencia = sizeof($licencia);
		
		$parametros_generales->uf=number_format($parametros_generales->uf, 2, ',', '.');
		$parametros_generales->utm=number_format($parametros_generales->utm, 2, ',', '.');
		$parametros_generales->sueldominimo=number_format($parametros_generales->sueldominimo, 0, ',', '.');
		$parametros_generales->topeimponible=number_format($parametros_generales->topeimponible, 2, ',', '.');
		$parametros_generales->topeimponibleafc=number_format($parametros_generales->topeimponibleafc, 2, ',', '.');
		//$datosperiodo = $this->rrhh_model->get_periodos($this->session->userdata('empresaid'));
		$pago_remuneraciones = array(18.5, 20, 15, 16, 17, 16.5, 18.1, 18.5, 19, 19.6, 19.4, 20);
		
		
		$contadores = array();
		for ($i = 0; $i<$cant_afp;$i++){
				

				$contadores[$afp[$i]->id_afp] = 0;
		}

		for ($i = 0; $i < $num_colaboradores; $i++){
			$contadores[$colaboradores[$i]->idafp] += 1;
		}

		for ($i = 0; $i<$cant_afp;$i++){
			$arreglo_afp[$i] = array( 'name' => $afp[$i]->nombre , 'y' =>  $contadores[$afp[$i]->id_afp], 'drilldown' => $afp[$i]->nombre);
		}
		
		
		$contador_cc = array();
		for ($i = 0; $i<$num_centro_costo;$i++){
				

				$contador_cc[$centro_costo[$i]->id_centro_costo] = 0;
		}

		for ($i = 0; $i < $num_colaboradores; $i++){
			$contador_cc[$colaboradores[$i]->idcentrocosto] += 1;
		}

		for ($i = 0; $i<$num_centro_costo;$i++){
			$arreglo_cc[$i] = array( 'name' => $centro_costo[$i]->nombre , 'y' =>  $contador_cc[$centro_costo[$i]->id_centro_costo]);
		}
		


		//echo json_encode($arreglo_cc);

		//echo json_encode($datosperiodo);
		//echo json_encode($arreglo_afp);

		//var_dump($arreglo_afp);
		//echo json_encode($cantidad_personal_afp);
		//echo json_encode($cantidad_afp);
//exit;
		
		
		foreach ($colaboradores as $colaborador) {
			# code...
			if($colaborador->sexo == 'M'){
				$num_masculino = $num_masculino + 1;
			}
			if ($colaborador->sexo == 'F'){
				$num_femenino = $num_femenino + 1;
			}
		}
		
		$content = array(
					'menu' => 'Dashboard',
					'title' => 'Dashboard',
					'subtitle' => 'Panel de Control');


		
		$vars['content_menu'] = $content;
		$vars['content_view'] = 'dashboard';

		$template = "template";

		if($this->session->userdata('level') == 2){
			// SI YA SELECCIONO COMUNIDAD, NO ES NECESARIO ELEGIR NUEVAMENTE
			$unidad_id = $unidad_id == '' && $this->session->userdata('empresaid') ? $this->session->userdata('empresaid') : $unidad_id;
			//$num_colaboradores = $this->rrhh_model->get_personal_datos('null');

			$empresas_asignadas = $unidad_id != '' ? $this->admin->empresas_asignadas($this->session->userdata('user_id'),$this->session->userdata('level'),$unidad_id) : $this->admin->empresas_asignadas($this->session->userdata('user_id'),$this->session->userdata('level'));

			$num_empresas = count($this->admin->empresas_asignadas($this->session->userdata('user_id'),$this->session->userdata('level')));

			if(count($empresas_asignadas) > 1){ // EN CASO DE TENER MÁS DE UNA COMUNIDAD LO ENVÍA A LA PÁGINA DE SELECCIÓN
				$content = array(
							'menu' => 'Selecci&oacute;n Empresa',
							'title' => 'Empresas',
							'subtitle' => 'Selecci&oacute;n de Empresa');
				
				
				$vars['arreglo_afp'] = $arreglo_afp;
				$vars['pago_remuneraciones'] = $pago_remuneraciones;
				$vars['num_licencia'] = $num_licencia;
				$vars['parametros_generales'] = $parametros_generales;
				$vars['num_masc'] = $num_masculino;
				$vars['num_fem'] = $num_femenino;
				$vars['num_colaboradores'] = $num_colaboradores;
				$vars['num_centro_costo'] = $num_centro_costo;
				$vars['content_menu'] = $content;
				$vars['empresas'] = $empresas_asignadas;
				$vars['arreglo_cc'] = $arreglo_cc;
				$vars['content_view'] = 'admins/asigna_empresa';
				$template = "template_lock";

				//$this->load->view('template_lock',$vars);	
			}else if(count($empresas_asignadas) == 1){ 			
				$this->session->set_userdata('empresaid',$empresas_asignadas->id_empresa);
				$this->session->set_userdata('empresanombre',$empresas_asignadas->nombre);


			}else{
				redirect('auth/logout');	
			}

		}

		if ($this->session->userdata('level') == 2 ){
			if ($unidad_id != null ){
										
				$unidad_id = $unidad_id == '' && $this->session->userdata('empresaid') ? $this->session->userdata('empresaid') : $unidad_id;
				$mes = $this->session->flashdata('asistencia_mes') == '' ? date('m') : $this->session->flashdata('asistencia_mes');
				$anno = $this->session->flashdata('asistencia_anno') == '' ? date('Y') : $this->session->flashdata('asistencia_anno');
				
				$periodos_remuneracion = $this->rrhh_model->get_periodos_remuneracion_abiertos_resumen(); 
				//$num_colaboradores = count($this->rrhh_model->get_personal_datos('null'));
				
		
				if ($periodos_remuneracion == null){
					$mes_curso = $mes;
					$anno_curso = $anno;
				}else{
					$mes_curso = $periodos_remuneracion[0]->mes;
					$anno_curso = $periodos_remuneracion[0]->anno;
				}
				
				$mes = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');

				$mes_curso = $mes[$mes_curso - 1];
				
				$periodo_actual = "".$mes_curso." ".$anno_curso;
				$vars['parametros_generales'] = $parametros_generales;
				$vars['periodo_actual'] = $periodo_actual;
				$vars['num_colaboradores'] = $num_colaboradores;
				$vars['num_centro_costo'] = $num_centro_costo;
				$vars['num_masc'] = $num_masculino;
				$vars['num_fem'] = $num_femenino;
				$vars['num_licencia'] = $num_licencia;
				$vars['pago_remuneraciones'] = $pago_remuneraciones;
				$vars['arreglo_afp'] = $arreglo_afp;
				$vars['arreglo_cc'] = $arreglo_cc;
				}else{
					$periodo_actual = "";
					$vars['periodo_actual'] = $periodo_actual;
					$vars['num_colaboradores'] = $num_colaboradores;
					$vars['num_centro_costo'] = $num_centro_costo;
					$vars['num_masc'] = $num_masculino;
					$vars['num_fem'] = $num_femenino;
					$vars['parametros_generales'] = $parametros_generales;
					$vars['num_licencia'] = $num_licencia;
					$vars['pago_remuneraciones'] = $pago_remuneraciones;
					$vars['arreglo_afp'] = $arreglo_afp;
					$vars['arreglo_cc'] = $arreglo_cc;
				}

			}else{
				//$num_colaboradores = count($this->rrhh_model->get_personal_datos('null'));
				$periodo_actual = "";
				$vars['periodo_actual'] = $periodo_actual;
				$vars['num_colaboradores'] = $num_colaboradores;
				$vars['num_centro_costo'] = $num_centro_costo;
				$vars['num_masc'] = $num_masculino;
				$vars['num_fem'] = $num_femenino;
				$vars['parametros_generales'] = $parametros_generales;
				$vars['num_licencia'] = $num_licencia;
				$vars['pago_remuneraciones'] = $pago_remuneraciones;
				$vars['arreglo_afp'] = $arreglo_afp;
				$vars['arreglo_cc'] = $arreglo_cc;
			}

		/*** SI YA SE HABIA SELECCIONADO UN MODULO, REDIRECCIONA ****/
  		/*if(count($this->session->userdata('uri_array')) > 0){
  			$uri_array = $this->session->userdata('uri_array');
  			$url = $uri_array[1].'/'.$uri_array[2];
  			for($i = 3;$i <= count($uri_array); $i++){
  				$url .= "/".$uri_array[$i];
  			}
  			$this->session->unset_userdata('uri_array');
  			redirect($url);

  		}		*/		
  		$vars['highchartsGraph'] = true;
		$this->load->view($template,$vars);			
		

	}



	public function destroy_data_session(){
		$this->session->unset_userdata('empresaid');
		$this->session->unset_userdata('empresanombre');
		//$this->session->unset_userdata('preloader');
		redirect('main/dashboard');
	}

		
}
