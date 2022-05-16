<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guest extends CI_Controller {


	function __construct(){
	  parent::__construct();
	  $this->load->library('ion_auth');
	  $this->load->helper('format');

      
   }


	public function add_empresa($idcomunidad = 0)
	{

			$resultid = $this->session->flashdata('empresas_result');
			if($resultid == 1){
				$vars['message'] = "No fue posible Registrar Empresa.  Empresa ya existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';		
			}elseif($resultid == 2){
				$vars['message'] = "Empresa Registrada Correctamente.   Se han enviado los datos de acceso al mail indicado en el registro";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';
			}elseif($resultid == 3){
				$vars['message'] = "Empresa Registrada Correctamente.   Email indicado ya existe en nuestros registros.  Se asoci&oacute; la empresa al usuario ya existente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';
			}



			$this->load->model('admin');
			$regiones = $this->admin->get_regiones();

			$content = array(
						'menu' => 'Administraci&oacute;n',
						'title' => 'Administraci&oacute;n',
						'subtitle' => 'Administraci&oacute;n de Empresas');
			
			$vars['content_menu'] = $content;				
			$vars['regiones'] = $regiones;
			$vars['content_view'] = 'guest/add_empresa';
			$vars['titulo'] = "Registrate como empresa y prueba nuestro servicio por 2 meses";
			$vars['formValidation'] = true;
			$vars['jqueryRut'] = true;
			$vars['mask'] = true;
			$vars['datetimepicker'] = true;
			$vars['gritter'] = true;
			
			$template = "template_guest";
			

			$this->load->view($template,$vars);	


	}


	public function submit_empresa(){


			//$nuevo_proveedor = $this->input->post('proveedor');
			$nombreempresa = $this->input->post('nombreempresa');

       		$rutempresa = str_replace(".","",$this->input->post("rutempresa"));
			$arrayRut = explode("-",$rutempresa);

			$direccion = $this->input->post('direccion');	
			$idregion = $this->input->post('region');	
			$idcomuna = $this->input->post('comuna');	

			$fono = $this->input->post('fono');	

			$nombre_responsable = $this->input->post('nombreusuario');
			$apellido_responsable = $this->input->post('apellidousuario');		

			$email = $this->input->post('email');	

			$this->load->model('Mantenedores_model');
			$existe = $this->Mantenedores_model->valida_existe_empresa($arrayRut[0]);


			$fecinicio = date("Ymd");
			//VER SI SE DEFINE UN DIA DEL MES ESPECÍFICO PARA EL VENCIMIENTO, O DIAS CORRIDOS DESDE INICIO
			$fecvencimiento = date('Ymd', strtotime('+' . PERIODOS_GRATIS . ' month', strtotime(date("Y-m-d"))));

       		$datos = array(
            		'nombre' => strtolower($nombreempresa),
            		'rut' => $arrayRut[0],
            		'dv' => $arrayRut[1],
            		'direccion' => strtolower($direccion),
            		'fono' => $fono,
            		'idcomuna' => $idcomuna,
            		'idregion' => $idregion,
            		'fecinicio' => $fecinicio,
            		'fecvencimiento' => $fecvencimiento,
        			);

			if (!$existe) {
 

            		$idempresa = $this->Mantenedores_model->add_empresa($datos, '0');

            		if ($idempresa) {
                    		//$this->session->set_flashdata('empresas_result', 1);
            		}
        	} else {
        		// si ya existe empresa, volver
  					$this->session->set_flashdata('empresas_result', 1);
  					redirect("guest/add_empresa", 'refresh');
        	}

   

			$this->load->model('admin');
			$this->load->model('ion_auth_model');

			//var_dump($idcomunidad); 
			$array_empresas = array($idempresa);
			//var_dump($array_comunidades);  exit;

			$existe_mail = $this->admin->valida_existe_mail_user($email);
			//var_dump_new($existe_mail); exit;

			if(!$existe_mail){ // si no existe se crea

					//creacion de password
					$password = randomstring_mm(10);

					$additional_data = array(
									'first_name' => $nombre_responsable,
									'last_name'  => $apellido_responsable,
									'company'    => '',
									'phone'      => '',
									//'inicpass'   => $password
								);


					$userid = $this->ion_auth->register($email, $password, $email, $additional_data);// creacion de usuario
					//echo "usuario creado: ".$userid."<br>";
					$result = $this->ion_auth->update_level($userid,2); //actualiza perfil

					//$this->ion_auth->asocia_propiedad($userid,$array_propiedades,false);
					
					$this->ion_auth->asocia_empresa($userid,$array_empresas);

					$this->admin->mail_creacion_usuario($userid,$password);		

					$this->session->set_flashdata('empresas_result', 2);
  					redirect("guest/add_empresa", 'refresh');

		
			}else{// si ya existe se asocia
				$replace = false;
				if($existe_mail->active == 0){
					$replace = true;
					$password = randomstring_mm(10);

					$additional_data = array(
									'first_name' => $nombre_responsable,
									'last_name'  => $apellido_responsable,
									'company'    => '',
									'phone'      => '',
									'inicpass'   => $password
								);									
					$this->ion_auth->update($existe_mail->id, $additional_data);
					$result = $this->ion_auth->update_level($existe_mail->id,2);
					$this->ion_auth->update_password($existe_mail->id, $password); 
					$this->ion_auth->activate($existe_mail->id);	

					// envio de mail
					$this->admin->mail_creacion_usuario($existe_mail->id,$password);	
					$this->ion_auth->asocia_empresa($existe_mail->id,$array_empresas,false);	
					$this->session->set_flashdata('empresas_result', 2);
  					redirect("guest/add_empresa", 'refresh');


				}else{
					//var_dump($usuario_mail->id);
					//var_dump($array_comunidades); exit;

					$this->ion_auth->asocia_empresa($existe_mail->id,$array_empresas,false);
					$this->session->set_flashdata('empresas_result', 3);
  					redirect("guest/add_empresa", 'refresh');
					//we should display a confirmation page here instead of the 

				}
				//print_r($array_propiedades);
				//echo "usuario asociado: ".$usuario_mail->id."<br>";
				
			}			


	}	


public function get_comunas($idregion){

		$this->load->model('admin');
		$comunas = $this->admin->get_comunas_by_region($idregion);
		//$arrayComunas = array();
		//$arrayComunas[''] = "Seleccione Comuna";
		//foreach ($comunas as $comuna) {
		//	$arrayComunas[$comuna->idcomuna] = $comuna->nombre;
		//}
		echo json_encode($comunas);
		//echo form_dropdown('comuna',$arrayComunas ,'',"class='form-control' id='comuna'"); 

	}		


}