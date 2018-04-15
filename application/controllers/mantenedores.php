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


	public function add_comuna($idcomuna = null, $idprovincia = null){	
						
			$comuna = array();
			if(!is_null($idcomuna)){
					$comuna = $this->Mantenedores_model->comuna($idcomuna);						
			}

			$provincia = array();
			if(!is_null($idprovincia)){
					$provincia = $this->Mantenedores_model->provincia($idprovincia);
					//print_r($provincia);
					//print_r("--");
					//exit;					
			}else{
				$provincia = $this->Mantenedores_model->provincia();
				
			}		
			
		 			
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

	


}