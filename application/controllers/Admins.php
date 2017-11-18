<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller {

	
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





	public function submit_personal_afp(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$array_elem = $this->input->post(NULL,true);
			$array_trabajadores = array();
			foreach($array_elem as $elem => $value_elem){
				$arr_el = explode("_",$elem);
				if($arr_el[0] == 'afp' || $arr_el[0] == 'cotadic'  || $arr_el[0] == 'tipcotvol'  || $arr_el[0] == 'cotvol'){
					$array_trabajadores[$arr_el[1]][$arr_el[0]] = $value_elem;
				}
			}

			$this->load->model('remuneracion');
			$this->remuneracion->update_personal_leyes_sociales($array_trabajadores);

			$this->session->set_flashdata('personal_result', 3);
			redirect('remuneraciones/personal');	


		}else{
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}		


	}	




	public function afp()
	{	

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			$resultid = $this->session->flashdata('afp_result');
			if($resultid == 1){
				$vars['message'] = "AFP Agregada correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';				
			}elseif($resultid == 2){
				$vars['message'] = "Error al agregar AFP. AFP ya existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 3){
				$vars['message'] = "AFP Editada correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';				
			}elseif($resultid == 4){
				$vars['message'] = "Error al eliminar AFP. AFP no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';				
			}elseif($resultid == 5){
				$vars['message'] = "AFP Eliminada correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';								
			}


			

			$afps = $this->admin->get_afp();

			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Administraci&oacute;n de Afp');

			
			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'admins/afp';
			$vars['afps'] = $afps;
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


	public function add_afp($idafp = 0)
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$this->load->model('remuneracion');
			$afp = $this->remuneracion->get_afp($idafp);

			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Administraci&oacute;n de Afp');

			$datos_form = array(
							'idafp' => count($afp) == 0 ? 0 : $afp->id,
							'nombre' => count($afp) == 0 ? '' : $afp->nombre,
							'porc' => count($afp) == 0 ? '' : $afp->porc,
							'exregimen' => count($afp) == 0 ? 0 : $afp->exregimen
							);
			
			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'remuneraciones/add_afp';
			$vars['titulo'] = $idafp == '' ? "Agregar Afp" : "Editar Afp";
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



	public function submit_afp(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$nombre = $this->input->post('nombre');	
			$porc = $this->input->post('porc');	
			$exregimen = $this->input->post('exregimen') == 'on' ? 1 : 0;	
			$idafp = $this->input->post('idafp');

			$array_datos = array(
								'nombre' => $nombre,
								'porc' => $porc,
								'exregimen' => $exregimen,
								'idafp' => $idafp);


			$result = $this->admin->add_afp($array_datos);

			if($result == -1){
				$this->session->set_flashdata('afp_result', 2);	
			}else{
				if($idafp == 0){
					$this->session->set_flashdata('afp_result', 1);	
				}else{
					$this->session->set_flashdata('afp_result', 3);	
				}
			}

			
			redirect('admins/afp');	


		}else{
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}		


	}


	public function delete_afp($idafp = 0)
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$result = $this->admin->delete_afp($idafp);
			var_dump($result);
			if($result == -1){
				$this->session->set_flashdata('afp_result', 4);	
			}else{
				$this->session->set_flashdata('afp_result', 5);	
				
			}

			redirect('admins/afp');	

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

