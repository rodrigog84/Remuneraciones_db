<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Centro_costo extends CI_Controller {

	
	function __construct(){
	  parent::__construct();
	  $this->load->library('ion_auth');
      $this->load->library('form_validation');
      $this->load->helper('format');
      $this->load->model('admin');
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

	
	public function centrocosto()
	{	

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			$resultid = $this->session->flashdata('centrocosto_result');
			if($resultid == 1){
				$vars['message'] = "Centro Costo Agregada correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';				
			}elseif($resultid == 2){
				$vars['message'] = "Error al agregar Centro de Costo. Centro de Costo ya existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 3){
				$vars['message'] = "Centro de Costos Editada correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';				
			}elseif($resultid == 4){
				$vars['message'] = "Error al eliminar Centro de Costos. Centro de Costos no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';				
			}elseif($resultid == 5){
				$vars['message'] = "Centro de Costos Eliminada correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';								
			}


			

			$centrocostos = $this->admin->get_centro_costo();

			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Administraci&oacute;n de Centro de Costos');

			
			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'admins/centrocosto';
			$vars['centrocostos'] = $centrocostos;
			$vars['dataTables'] = true;
			
			
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


	public function add_centrocosto($idcentrocosto = 0)
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$this->load->model('remuneracion');
			$centrodecosto = $this->remuneracion->get_centrodecosto($idcentrodecosto);

			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Administraci&oacute;n de Centro de Costos');

			$datos_form = array(
							'idcentrocosto' => count($centrocosto) == 0 ? 0 : $centrocosto->id,
							'nombre' => count($centrocosto) == 0 ? '' : $centrocosto->nombre,
							'idempresa' => count($centrocosto) == 0 ? '' : $centrocosto->idempresa,
							'codigo' => count($centrocosto) == 0 ? 0 : $centrocosto->codigo
							);
			
			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'remuneraciones/add_centrocosto';
			$vars['titulo'] = $idcentrocosto == '' ? "Agregar Centro Costo" : "Editar Centro Costo";
			$vars['datos_form'] = $datos_form;
			$vars['formValidation'] = true;
			$vars['mask'] = true;
			$vars['icheck'] = true;		
			
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



	public function submit_centrocosto(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$nombre = $this->input->post('nombre');	
			$idempresa = $this->input->post('idempresa');	
			$codigo = $this->input->post('codigo');	
			$idcentrocosto = $this->input->post('idcentrocosto');

			$array_datos = array(
								'nombre' => $nombre,
								'idempresa' => $porc,
								'codigo' => $exregimen,
								'idcentrocosto' => $idcentrocosto);


			$result = $this->admin->add_centrodecosto($array_datos);

			if($result == -1){
				$this->session->set_flashdata('centrodecosto_result', 2);	
			}else{
				if($idcentrodecosto == 0){
					$this->session->set_flashdata('centrodecosto_result', 1);	
				}else{
					$this->session->set_flashdata('centrodecosto_result', 3);	
				}
			}

			
			redirect('Centro_costo/centrocosto');	


		}else{
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}		


	}


	public function delete_centrocosto($idcentrocosto = 0)
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$result = $this->admin->delete_centrocosto($idcentrocosto);
			var_dump($result);
			if($result == -1){
				$this->session->set_flashdata('centrocosto_result', 4);	
			}else{
				$this->session->set_flashdata('centrocosto_result', 5);	
				
			}

			redirect('admins/centrocosto');	

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

	public function get_centrocosto($idcentrocosto = null){


		$datos = $this->admin->get_centrocosto($idcentrocosto);

		//print_r($datos);
		echo json_encode($datos);
	}

}