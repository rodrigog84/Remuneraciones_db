<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mantenedores extends CI_Controller {

	
	function __construct(){
	  parent::__construct();
	  $this->load->library('ion_auth');
      $this->load->library('form_validation');
      $this->load->helper('format');
      $this->load->model('Mantenedores_model');
      if (!$this->ion_auth->logged_in()){
      	 $this->session->set_userdata('uri_array',$this->uri->rsegment_array());
         redirect('auth/login', 'refresh');
      }else{
      		if(!$this->session->userdata('menu_list')){
      			$this->session->set_userdata('menu_list',json_decode($this->ion_auth_model->get_menu($this->session->userdata('user_id'))));
      		}

      		if($this->router->fetch_class()."/".$this->router->fetch_method() != "main/dashboard" && !$this->session->userdata('comunidadid') && ($this->session->userdata('level') == 2)){
      			redirect('main/dashboard');	      			
      		}
      }
      
   }


	public function index()
	{

		$this->load->model('ion_auth_model');
		redirect('main/dashboard');	
	}

	public function nacionalidad(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			
			$resultid = $this->session->flashdata('nacionalidad_result');
			if($resultid == 1){
				$vars['message'] = "Centro de costo Agregado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}else if($resultid == 2){
				$vars['message'] = "Centro de Costo editado Correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		

			}else if($resultid == 3){
				$vars['message'] = "Centro de Costo Ya existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';		

			}elseif($resultid == 4){
				$vars['message'] = "Error al eliminar Pais. Pais no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';				
			}elseif($resultid == 5){
				$vars['message'] = "Pais Eliminado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';								
			}

			$nacionalidad = $this->Mantenedores_model->get_nacionalidad();
		

			$content = array(
						'menu' => 'Configuraciones Generales',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Paises');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/nacionalidad';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['gritter'] = true;

			$vars['nacionalidad'] = $nacionalidad;
			
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

	public function region(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			
			$resultid = $this->session->flashdata('regiones_result');
			if($resultid == 1){
				$vars['message'] = "Region Agregada correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}else if($resultid == 2){
				$vars['message'] = "Region editado Correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		

			}else if($resultid == 3){
				$vars['message'] = "Region Ya existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';		

			}elseif($resultid == 4){
				$vars['message'] = "Error al eliminar Region. Pais no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';				
			}elseif($resultid == 5){
				$vars['message'] = "Region Eliminado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';								
			}

			$regiones = $this->Mantenedores_model->get_regiones();


			$content = array(
						'menu' => 'Configuraciones Generales',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Regiones');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/regiones';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['gritter'] = true;

			$vars['regiones'] = $regiones;
			
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

	public function idioma(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			
			$resultid = $this->session->flashdata('idioma_result');
			if($resultid == 1){
				$vars['message'] = "Idioma Agregado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}else if($resultid == 2){
				$vars['message'] = "Idioma editado Correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		

			}else if($resultid == 3){
				$vars['message'] = "Idioma Ya existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';		

			}elseif($resultid == 4){
				$vars['message'] = "Error al eliminar Idioma. Pais no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';				
			}elseif($resultid == 5){
				$vars['message'] = "Idioma Eliminado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';								
			}

			$idioma = $this->Mantenedores_model->get_idioma();


			$content = array(
						'menu' => 'Configuraciones Generales',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Idiomas');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/idioma';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['gritter'] = true;

			$vars['idioma'] = $idioma;
			
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

	public function categorias(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			
			$resultid = $this->session->flashdata('categorias_result');
			if($resultid == 1){
				$vars['message'] = "Categoria Agregado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}else if($resultid == 2){
				$vars['message'] = "Categoria editado Correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		

			}else if($resultid == 3){
				$vars['message'] = "Categoria Ya existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';		

			}elseif($resultid == 4){
				$vars['message'] = "Error al eliminar Categoria. Pais no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';				
			}elseif($resultid == 5){
				$vars['message'] = "Categoria Eliminado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';								
			}

			$categoria = $this->Mantenedores_model->get_categoria();


			$content = array(
						'menu' => 'Configuraciones Generales',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Categorias');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/categoria';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['gritter'] = true;

			$vars['idcategoria'] = $categoria;
			
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

	public function cargos(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			
			$resultid = $this->session->flashdata('cargos_result');
			if($resultid == 1){
				$vars['message'] = "Cargo Agregado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}else if($resultid == 2){
				$vars['message'] = "Cargo editado Correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		

			}else if($resultid == 3){
				$vars['message'] = "Cargo Ya existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';		

			}elseif($resultid == 4){
				$vars['message'] = "Error al eliminar Cargo. Pais no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';				
			}elseif($resultid == 5){
				$vars['message'] = "Cargo Eliminado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';								
			}

			$cargos = $this->Mantenedores_model->get_cargos();

			$content = array(
						'menu' => 'Configuraciones Generales',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Cargos');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/cargo';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['gritter'] = true;

			$vars['cargos'] = $cargos;
			
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

	public function bancos(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			
			$resultid = $this->session->flashdata('bancos_result');
			if($resultid == 1){
				$vars['message'] = "Banco Agregado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}else if($resultid == 2){
				$vars['message'] = "Banco editado Correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		

			}else if($resultid == 3){
				$vars['message'] = "Banco Ya existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';		

			}elseif($resultid == 4){
				$vars['message'] = "Error al eliminar Banco. Pais no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';				
			}elseif($resultid == 5){
				$vars['message'] = "Banco Eliminado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';								
			}

			$bancos = $this->Mantenedores_model->get_bancos();

			$content = array(
						'menu' => 'Configuraciones Generales',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Bancos');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/bancos';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['gritter'] = true;

			$vars['bancos'] = $bancos;
			
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

	public function lugardepago(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			
			$resultid = $this->session->flashdata('lugardepago_result');
			if($resultid == 1){
				$vars['message'] = "Lugar de Pago Agregado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}else if($resultid == 2){
				$vars['message'] = "Lugar de Pago editado Correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		

			}else if($resultid == 3){
				$vars['message'] = "Lugar de Pago Ya existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';		

			}elseif($resultid == 4){
				$vars['message'] = "Error al eliminar Lugar de Pago. Pais no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';				
			}elseif($resultid == 5){
				$vars['message'] = "Lugar de Pago Eliminado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';								
			}

			$lugardepago = $this->Mantenedores_model->get_lugarpago();

			$content = array(
						'menu' => 'Configuraciones Generales',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Lugares de Pago');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/lugarpago';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['gritter'] = true;

			$vars['lugardepago'] = $lugardepago;
			
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

	public function formadepago(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			
			$resultid = $this->session->flashdata('formadepago_result');
			if($resultid == 1){
				$vars['message'] = "Forma de Pago Agregado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}else if($resultid == 2){
				$vars['message'] = "Forma de Pago editado Correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		

			}else if($resultid == 3){
				$vars['message'] = "Forma de Pago Ya existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';		

			}elseif($resultid == 4){
				$vars['message'] = "Error al eliminar Forma de Pago. Pais no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';				
			}elseif($resultid == 5){
				$vars['message'] = "Forma de Pago Eliminado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';								
			}

			$formadepago = $this->Mantenedores_model->get_formadepago();

			$content = array(
						'menu' => 'Configuraciones Generales',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Formas de Pago');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/formaspago';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['gritter'] = true;

			$vars['formadepago'] = $formadepago;
			
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

	public function estudios(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			
			$resultid = $this->session->flashdata('estudios_result');
			if($resultid == 1){
				$vars['message'] = "Estudios correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}else if($resultid == 2){
				$vars['message'] = "Estudios editado Correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		

			}else if($resultid == 3){
				$vars['message'] = "Estudios Ya existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';		

			}elseif($resultid == 4){
				$vars['message'] = "Error al eliminar Estudios. Pais no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';				
			}elseif($resultid == 5){
				$vars['message'] = "Estudios Eliminado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';								
			}

			$estudios = $this->Mantenedores_model->get_estudios();

			$content = array(
						'menu' => 'Configuraciones Generales',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Estudios');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/estudios';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['gritter'] = true;

			$vars['estudios'] = $estudios;
			
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

	public function estadocivil(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			
			$resultid = $this->session->flashdata('estadocivil_result');
			if($resultid == 1){
				$vars['message'] = "Estado Civil correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}else if($resultid == 2){
				$vars['message'] = "Estado Civil editado Correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		

			}else if($resultid == 3){
				$vars['message'] = "Estado Civil Ya existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';		

			}elseif($resultid == 4){
				$vars['message'] = "Error al eliminar Estado Civil. Pais no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';				
			}elseif($resultid == 5){
				$vars['message'] = "Estado Civil Eliminado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';								
			}

			$estadocivil = $this->Mantenedores_model->get_estadocivil();

			$content = array(
						'menu' => 'Configuraciones Generales',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Estado Civil');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/estadocivil';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['gritter'] = true;

			$vars['estadocivil'] = $estadocivil;
			
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

	public function licenciasconducir(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			
			$resultid = $this->session->flashdata('licenciaconducir_result');
			if($resultid == 1){
				$vars['message'] = "Licencias de Conducir correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}else if($resultid == 2){
				$vars['message'] = "Licencias de Conducir editado Correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		

			}else if($resultid == 3){
				$vars['message'] = "Licencias de Conducir Ya existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';		

			}elseif($resultid == 4){
				$vars['message'] = "Error al eliminar Licencias de Conducir. Pais no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';				
			}elseif($resultid == 5){
				$vars['message'] = "Licencias de Conducir Eliminado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';								
			}

			$licenciaconducir = $this->Mantenedores_model->get_licenciaconducir();

			$content = array(
						'menu' => 'Configuraciones Generales',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Licencias de Conducir');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/licenciaconducir';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['gritter'] = true;

			$vars['licenciaconducir'] = $licenciaconducir;
			
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

	public function empresas(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			
			$resultid = $this->session->flashdata('empresas_result');
			if($resultid == 1){
				$vars['message'] = "Empresa Creada correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}else if($resultid == 2){
				$vars['message'] = "Empresa editado Correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		

			}else if($resultid == 3){
				$vars['message'] = "Empresa Ya existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';		

			}elseif($resultid == 4){
				$vars['message'] = "Error al eliminar Empresa. Pais no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';				
			}elseif($resultid == 5){
				$vars['message'] = "Empresa Eliminado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';								
			}

			$empresa = $this->Mantenedores_model->get_empresa();

			$content = array(
						'menu' => 'Configuraciones Generales',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Empresas');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/empresas';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['gritter'] = true;

			$vars['empresas'] = $empresa;
			
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

	public function comuna(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){			
			$resultid = $this->session->flashdata('comuna_result');
			if($resultid == 1){
				$vars['message'] = "Comuna Agregada correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}else if($resultid == 2){
				$vars['message'] = "Comuna editado Correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		

			}else if($resultid == 3){
				$vars['message'] = "Comuna Ya existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';		

			}elseif($resultid == 4){
				$vars['message'] = "Error al eliminar Comuna. Pais no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';				
			}elseif($resultid == 5){
				$vars['message'] = "Comuna Eliminado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';								
			}

			$comuna = $this->Mantenedores_model->get_comuna();


			$content = array(
						'menu' => 'Configuraciones Generales',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Comunas');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/comuna';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['gritter'] = true;

			$vars['comuna'] = $comuna;
			
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

		public function add_nacionalidad($idnacionalidad = null){
		
						
			$nacionalidad = array();
			if(!is_null($idnacionalidad)){
					$nacionalidad = $this->Mantenedores_model->nacionalidad($idnacionalidad); 	
			}
			
			$content = array(
				'menu' => 'Configuraciones Generales',
				'title' => 'Configuraciones',
				'subtitle' => 'Creaci&oacute;n Paises');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/add_nacionalidad';
			$vars['formValidation'] = true;
			$vars['paises'] = $nacionalidad;
			$vars['gritter'] = true;

			$template = "template";			

			$this->load->view($template,$vars);	
	}

	public function add_region($idregiones = null){
		
						
			$regiones = array();
			if(!is_null($idregiones)){
					$regiones = $this->Mantenedores_model->regiones($idregiones); 	
			}
			
			$content = array(
				'menu' => 'Configuraciones Generales',
				'title' => 'Configuraciones',
				'subtitle' => 'Creaci&oacute;n Regiones');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/add_regiones';
			$vars['formValidation'] = true;
			$vars['regiones'] = $regiones;
			$vars['gritter'] = true;

			$template = "template";			

			$this->load->view($template,$vars);	
	}

	public function add_idioma($ididioma = null){
		
						
			$idioma = array();
			if(!is_null($ididioma)){
					$idioma = $this->Mantenedores_model->idioma($ididioma); 	
			}
			
			$content = array(
				'menu' => 'Configuraciones Generales',
				'title' => 'Configuraciones',
				'subtitle' => 'Creaci&oacute;n Idioma');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/add_idioma';
			$vars['formValidation'] = true;
			$vars['idioma'] = $idioma;
			$vars['gritter'] = true;

			$template = "template";			

			$this->load->view($template,$vars);	
	}

	public function add_categoria($idcategoria = null){
		
						
			$idcategorias = array();
			if(!is_null($idcategoria)){
					$idcategorias = $this->Mantenedores_model->categoria($idcategoria); 	
			}
			
			$content = array(
				'menu' => 'Configuraciones Generales',
				'title' => 'Configuraciones',
				'subtitle' => 'Creaci&oacute;n Categorias');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/add_categoria';
			$vars['formValidation'] = true;
			$vars['idcategoria'] = $idcategorias;
			$vars['gritter'] = true;

			$template = "template";			

			$this->load->view($template,$vars);	
	}

	public function add_cargos($idcargo = null){

		   	   						
			$idcargos = array();
			if(!is_null($idcargo)){
					$idcargos = $this->Mantenedores_model->cargos($idcargo); 	
			}

						
			$content = array(
				'menu' => 'Configuraciones Generales',
				'title' => 'Configuraciones',
				'subtitle' => 'Creaci&oacute;n Cargos');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/add_cargos';
			$vars['formValidation'] = true;
			$vars['idcargo'] = $idcargos;
			$vars['gritter'] = true;

			$template = "template";			

			$this->load->view($template,$vars);	
	}

	public function add_bancos($idbanco = null){

		   	   						
			$idbancos = array();
			if(!is_null($idbanco)){
					$idbancos = $this->Mantenedores_model->bancos($idbanco); 	
			}

						
			$content = array(
				'menu' => 'Configuraciones Generales',
				'title' => 'Configuraciones',
				'subtitle' => 'Creaci&oacute;n Banco');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/add_bancos';
			$vars['formValidation'] = true;
			$vars['idbanco'] = $idbancos;
			$vars['gritter'] = true;

			$template = "template";			

			$this->load->view($template,$vars);	
	}

	public function add_lugardepago($idlugarpago = null){

		   	   						
			$idlugarpagos = array();
			if(!is_null($idlugarpago)){
					$idlugarpagos = $this->Mantenedores_model->lugarpago($idlugarpago); 	
			}

						
			$content = array(
				'menu' => 'Configuraciones Generales',
				'title' => 'Configuraciones',
				'subtitle' => 'Creaci&oacute;n Lugares de Pagos');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/add_lugardepago';
			$vars['formValidation'] = true;
			$vars['lugardepago'] = $idlugarpagos;
			$vars['gritter'] = true;

			$template = "template";			

			$this->load->view($template,$vars);	
	}

	public function add_formasdepago($idformapago = null){
		   	   						
			$idformapagos = array();
			if(!is_null($idformapagos)){
					$idformapagos = $this->Mantenedores_model->formapago($idformapago); 	
			}

						
			$content = array(
				'menu' => 'Configuraciones Generales',
				'title' => 'Configuraciones',
				'subtitle' => 'Creaci&oacute;n Formas de Pagos');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/add_formadepago';
			$vars['formValidation'] = true;
			$vars['idformapago'] = $idformapagos;
			$vars['gritter'] = true;

			$template = "template";			

			$this->load->view($template,$vars);	
	}

	public function add_estudios($idestudios = null){
		   	   						
			$estudios = array();
			if(!is_null($idestudios)){
					$estudios = $this->Mantenedores_model->estudios($idestudios); 	
			}

						
			$content = array(
				'menu' => 'Configuraciones Generales',
				'title' => 'Configuraciones',
				'subtitle' => 'Creaci&oacute;n Estudios');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/add_estudios';
			$vars['formValidation'] = true;
			$vars['idestudios'] = $estudios;
			$vars['gritter'] = true;

			$template = "template";			

			$this->load->view($template,$vars);	
	}

	public function add_estadocivil($idestadocivil = null){
		   	   						
			$estadocivil = array();
			if(!is_null($idestadocivil)){
					$estadocivil = $this->Mantenedores_model->estadocivil($idestadocivil); 	
			}

						
			$content = array(
				'menu' => 'Configuraciones Generales',
				'title' => 'Configuraciones',
				'subtitle' => 'Creaci&oacute;n Estado Civil');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/add_estadocivil';
			$vars['formValidation'] = true;
			$vars['idestadocivil'] = $estadocivil;
			$vars['gritter'] = true;

			$template = "template";			

			$this->load->view($template,$vars);	
	}

	public function add_licenciaconducir($idlicenciaconducir = null){
		   	   						
			$licenciaconducir = array();
			if(!is_null($idlicenciaconducir)){
					$licenciaconducir = $this->Mantenedores_model->licenciaconducir($idlicenciaconducir); 	
			}

						
			$content = array(
				'menu' => 'Configuraciones Generales',
				'title' => 'Configuraciones',
				'subtitle' => 'Creaci&oacute;n Licencia de Conducir');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/add_licenciaconducir';
			$vars['formValidation'] = true;
			$vars['licenciaconducir'] = $licenciaconducir;
			$vars['gritter'] = true;

			$template = "template";			

			$this->load->view($template,$vars);	
	}

	public function add_empresas($idempresa = null){
		   	   						
			$empresas = array();
			if(!is_null($idempresa)){
					$empresas = $this->Mantenedores_model->empresa($idempresa); 	
			}

			$comuna = $this->Mantenedores_model->get_comuna();
			$region = $this->Mantenedores_model->get_regiones();


						
			$content = array(
				'menu' => 'Configuraciones Generales',
				'title' => 'Configuraciones',
				'subtitle' => 'Creaci&oacute;n Empresas');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/add_empresas';
			$vars['formValidation'] = true;
			$vars['empresa'] = $empresas;
			$vars['comuna'] = $comuna;
			$vars['region'] = $region;
			$vars['gritter'] = true;

			$template = "template";			

			$this->load->view($template,$vars);	
	}


	public function add_comuna($idcomuna = null, $idprovincia = null){	
						
			$comuna = array();
			if(!is_null($idcomuna)){
					$comuna = $this->Mantenedores_model->comuna($idcomuna);						
			}

			$provincia = array();
			if(!is_null($idprovincia)){
					$provincia = $this->Mantenedores_model->provincia($idprovincia);
							
			}else{
				$provincia = $this->Mantenedores_model->provincia();
				
			}	
			

			//print_r($provincia);
			//exit;
			
					 			
			$content = array(
				'menu' => 'Configuraciones Generales',
				'title' => 'Configuraciones',
				'subtitle' => 'Creaci&oacute;n Comunas');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'mantenedores/add_comuna';
			$vars['formValidation'] = true;
			$vars['comuna'] = $comuna;
			$vars['provincia'] = $provincia;
			$vars['gritter'] = true;

			$template = "template";			

			$this->load->view($template,$vars);	
	}




	public function submit_nacionalidad(){
		
			$iso = $this->input->post('iso');
			$descripcion = $this->input->post('nombre');
			$idnacionalidad = $this->input->post('idnacionalidad');

						
			$datos = array();
			$datos['iso'] = $iso;
			$datos['nombre'] = $descripcion;
			
			$nacionalidad = $this->Mantenedores_model->add_nacionalidad($datos,$idnacionalidad);

			if($idcentro==0){
				$this->session->set_flashdata('nacionalidad', 1);
			redirect('mantenedores/nacionalidad');
				
			}else{
				$this->session->set_flashdata('nacionalidad', 2);
			redirect('mantenedores/nacionalidad');	
				
			}

	}

	public function submit_regiones(){
		
			$descripcion = $this->input->post('nombre');
			$idregiones = $this->input->post('idregiones');

									
			$datos = array();
			$datos['nombre'] = $descripcion;
			
			$regiones = $this->Mantenedores_model->add_regiones($datos,$idregiones);

			if($idregiones==0){
				$this->session->set_flashdata('regiones_result', 1);
			redirect('mantenedores/region');
				
			}else{
				$this->session->set_flashdata('regiones_result', 2);
			redirect('mantenedores/region');	
				
			}

	}

	public function submit_idioma(){
		
			$descripcion = $this->input->post('nombre');
			$ididioma = $this->input->post('ididioma');

									
			$datos = array();
			$datos['nombre'] = $descripcion;
			
			$idioma = $this->Mantenedores_model->add_regiones($datos,$ididioma);

			if($idioma==0){
				$this->session->set_flashdata('idioma_result', 1);
			redirect('mantenedores/idioma');
				
			}else{
				$this->session->set_flashdata('idioma_result', 2);
			redirect('mantenedores/idioma');	
				
			}

	}

	public function submit_categoria(){
		
			$descripcion = $this->input->post('nombre');
			$idcategoria = $this->input->post('idcategoria');

									
			$datos = array();
			$datos['nombre'] = $descripcion;
			
			$idcategoria = $this->Mantenedores_model->add_categoria($datos,$idcategoria);

			if($idcategoria==0){
				$this->session->set_flashdata('categorias_result', 1);
			redirect('mantenedores/categorias');
				
			}else{
				$this->session->set_flashdata('categorias_result', 2);
			redirect('mantenedores/categorias');	
				
			}

	}

	public function submit_cargos(){
		
			$descripcion = $this->input->post('nombre');
			$idcargo = $this->input->post('idcargo');

									
			$datos = array();
			$datos['nombre'] = $descripcion;
			
			$idcargo = $this->Mantenedores_model->add_cargos($datos,$idcargo);

			if($idcargo==0){
				$this->session->set_flashdata('cargos_result', 1);
			redirect('mantenedores/cargo');
				
			}else{
				$this->session->set_flashdata('cargos_result', 2);
			redirect('mantenedores/cargo');	
				
			}

	}

	public function submit_bancos(){
		
			$descripcion = $this->input->post('nombre');
			$codigo = $this->input->post('codigo');
			$idbanco = $this->input->post('idbanco');

									
			$datos = array();
			$datos['nombre'] = $descripcion;
			$datos['codigo'] = $codigo;
			
			$idbanco = $this->Mantenedores_model->add_bancos($datos,$idbanco);

			if($idbanco==0){
				$this->session->set_flashdata('bancos_result', 1);
			redirect('mantenedores/bancos');
				
			}else{
				$this->session->set_flashdata('bancos_result', 2);
			redirect('mantenedores/bancos');	
				
			}

	}

	public function submit_lugarpago(){
		
			$descripcion = $this->input->post('nombre');
			$idlugarpago = $this->input->post('idlugardepago');
									
			$datos = array();
			$datos['nombre'] = $descripcion;
			
			$idbanco = $this->Mantenedores_model->add_lugarpago($datos,$idlugarpago);

			if($idlugarpago==0){
				$this->session->set_flashdata('lugardepago_result', 1);
			redirect('mantenedores/lugardepago');
				
			}else{
				$this->session->set_flashdata('lugardepago_result', 2);
			redirect('mantenedores/lugardepago');	
				
			}

	}

	public function submit_formapago(){
		
			$descripcion = $this->input->post('nombre');
			$idformapago = $this->input->post('idformapago');
									
			$datos = array();
			$datos['descripcion'] = $descripcion;
			
			$idformapago = $this->Mantenedores_model->add_formapago($datos,$idformapago);

			if($idformapago==0){
				$this->session->set_flashdata('formadepago_result', 1);
			redirect('mantenedores/formadepago');
				
			}else{
				$this->session->set_flashdata('formadepago_result', 2);
			redirect('mantenedores/formadepago');	
				
			}

	}

	public function submit_estudios(){
		
			$descripcion = $this->input->post('nombre');
			$idestudios = $this->input->post('idestudios');
												
			$datos = array();
			$datos['nombre'] = $descripcion;
			
			$idestudios = $this->Mantenedores_model->add_estudios($datos,$idestudios);

			if($idformapago==0){
				$this->session->set_flashdata('estudios_result', 1);
			redirect('mantenedores/estudios');
				
			}else{
				$this->session->set_flashdata('estudios_result', 2);
			redirect('mantenedores/esrudios');	
				
			}

	}

	public function submit_estadocivil(){
		
			$descripcion = $this->input->post('nombre');
			$idestadocivil = $this->input->post('idestadocivil');
												
			$datos = array();
			$datos['nombre'] = $descripcion;
			
			$idestadocivil = $this->Mantenedores_model->add_estadocivil($datos,$idestadocivil);

			if($idestadocivil==0){
				$this->session->set_flashdata('estadocivil_result', 1);
			redirect('mantenedores/estadocivil');
				
			}else{
				$this->session->set_flashdata('estadocivil_result', 2);
			redirect('mantenedores/estadocivil');	
				
			}

	}

	public function submit_licenciaconducir(){
		
			$descripcion = $this->input->post('nombre');
			$idlicenciaconducir = $this->input->post('idlicenciaconducir');
												
			$datos = array();
			$datos['nombre'] = $descripcion;
			
			$licenciaconducir = $this->Mantenedores_model->add_licenciaconducir($datos,$idlicenciaconducir);

			if($licenciaconducir==0){
				$this->session->set_flashdata('licenciaconducir_result', 1);
			redirect('mantenedores/licenciasconducir');
				
			}else{
				$this->session->set_flashdata('licenciaconducir_result', 2);
			redirect('mantenedores/licenciasconducir');	
				
			}

	}

	public function submit_empresas(){
		
			$descripcion = $this->input->post('nombre');
			$rut = $this->input->post('rut');
			$direccion = $this->input->post('direccion');
			$idcomuna = $this->input->post('idcomuna');
			$idregion = $this->input->post('idregion');
			$fono = $this->input->post('fono');
			$idempresas = $this->input->post('idempresas');
												
			$datos = array();
			$datos['nombre'] = $descripcion;
			$datos['rut'] = $rut;
			$datos['direccion'] = $direccion;
			$datos['idcomuna'] = $idcomuna;
			$datos['idregion'] = $idregion;
			$datos['fono'] = $fono;
			
			$empresas = $this->Mantenedores_model->add_empresas($datos,$idempresas);

			if($licenciaconducir==0){
				$this->session->set_flashdata('empresas_result', 1);
			redirect('mantenedores/empresas');
				
			}else{
				$this->session->set_flashdata('empresas_result', 2);
			redirect('mantenedores/empresas');	
				
			}

	}

	public function submit_comuna(){
		
			$descripcion = $this->input->post('nombre');
			$idcomuna = $this->input->post('idcomuna');
			$idprovincia = $this->input->post('idprovincia');

												
			$datos = array();
			$datos['nombre'] = $descripcion;
			$datos['idprovincia'] = $idprovincia;
			
			$comuna = $this->Mantenedores_model->add_comuna($datos,$idcomuna);

			if($idcomuna==0){
				$this->session->set_flashdata('comuna_result', 1);
			redirect('mantenedores/comuna');
				
			}else{
				$this->session->set_flashdata('comuna_result', 2);
			redirect('mantenedores/comuna');	
				
			}

	}

	public function delete_paises($idpaises = 0)
	{

		$result = $this->Mantenedores_model->delete_paises($idpaises);
			if($result == -1){
				$this->session->set_flashdata('nacionalidad_result', 4);	
			}else{
				$this->session->set_flashdata('nacionalidad_result', 5);	
				
			}

			redirect('mantenedores/nacionalidad');				
		
	}

	public function delete_regiones($idregiones = 0)
	{

		$result = $this->Mantenedores_model->delete_regiones($idregiones);
			if($result == -1){
				$this->session->set_flashdata('regiones_result', 4);	
			}else{
				$this->session->set_flashdata('regiones_result', 5);	
				
			}

			redirect('mantenedores/region');				
		
	}

	public function delete_idioma($ididioma = 0)
	{

		$result = $this->Mantenedores_model->delete_idioma($ididioma);
			if($result == -1){
				$this->session->set_flashdata('idioma_result', 4);	
			}else{
				$this->session->set_flashdata('idioma_result', 5);	
				
			}

			redirect('mantenedores/idioma');				
		
	}

	public function delete_cargos($idcargo = 0)
	{

		$result = $this->Mantenedores_model->delete_cargos($idcargo);
			if($result == -1){
				$this->session->set_flashdata('cargos_result', 4);	
			}else{
				$this->session->set_flashdata('cargos_result', 5);	
				
			}

			redirect('mantenedores/cargos');				
		
	}

	public function delete_bancos($idbanco = 0)
	{

		$result = $this->Mantenedores_model->delete_bancos($idbanco);
			if($result == -1){
				$this->session->set_flashdata('bancos_result', 4);	
			}else{
				$this->session->set_flashdata('bancos_result', 5);	
				
			}

			redirect('mantenedores/bancos');				
		
	}

	public function delete_lugardepago($idlugardepago = 0)
	{

		$result = $this->Mantenedores_model->delete_lugardepago($idlugardepago);
			if($result == -1){
				$this->session->set_flashdata('lugardepago_result', 4);	
			}else{
				$this->session->set_flashdata('lugardepago_result', 5);	
				
			}

			redirect('mantenedores/bancos');				
		
	}

	public function delete_formapago($idformapago = 0)
	{

		$result = $this->Mantenedores_model->delete_formadepago($idformapago);
			if($result == -1){
				$this->session->set_flashdata('formadepago_result', 4);	
			}else{
				$this->session->set_flashdata('formadepago_result', 5);	
				
			}

			redirect('mantenedores/formadepago');				
		
	}

	public function delete_estudios($idestudios = 0)
	{

		$result = $this->Mantenedores_model->delete_estudios($idestudios);
			if($result == -1){
				$this->session->set_flashdata('estudios_result', 4);	
			}else{
				$this->session->set_flashdata('estudios_result', 5);	
				
			}

			redirect('mantenedores/estudios');				
		
	}

	public function delete_estadocivil($idestadocivil = 0)
	{

		$result = $this->Mantenedores_model->delete_estadocivil($idestadocivil);
			if($result == -1){
				$this->session->set_flashdata('estadocivil_result', 4);	
			}else{
				$this->session->set_flashdata('estadocivil_result', 5);	
				
			}

			redirect('mantenedores/estadocivil');				
		
	}

	public function delete_licenciaconducir($idlicenciaconducir = 0)
	{

		$result = $this->Mantenedores_model->delete_licenciaconducir($idlicenciaconducir);
			if($result == -1){
				$this->session->set_flashdata('licenciaconducir_result', 4);	
			}else{
				$this->session->set_flashdata('licenciaconducir_result', 5);	
				
			}

			redirect('mantenedores/licenciasconducir');				
		
	}

	


}