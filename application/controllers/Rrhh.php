<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rrhh extends CI_Controller {

	
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

      		if($this->router->fetch_class()."/".$this->router->fetch_method() != "main/dashboard" && !$this->session->userdata('empresaid') && ($this->session->userdata('level') == 1)){
      			redirect('main/dashboard');	      			
      		}
      }
      
   }


	public function index()
	{

		$this->load->model('ion_auth_model');
		redirect('main/dashboard');	
	}



	public function mantencion_personal(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$vars['mantencion_personal'] = 'active';				
			$vars['leyes_sociales'] = '';		
			$vars['salud'] = '';	
			$vars['otros'] = '';	
			$vars['apv'] = '';
			$resultid = $this->session->flashdata('personal_result');
			if($resultid == 1){
				$vars['message'] = "Trabajador Agregado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
				$vars['mantencion_personal'] = 'active';				
				$vars['leyes_sociales'] = '';		
				$vars['apv'] = '';		
				$vars['salud'] = '';		
				$vars['otros'] = '';	
			}elseif($resultid == 2){
				$vars['message'] = "Error al agregar Trabajador. Trabajador ya existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
				$vars['mantencion_personal'] = 'active';				
				$vars['leyes_sociales'] = '';		
				$vars['apv'] = '';		
				$vars['salud'] = '';
				$vars['otros'] = '';							
			}elseif($resultid == 3){
				$vars['message'] = "Leyes sociales actualizadas correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';
				$vars['mantencion_personal'] = '';				
				$vars['apv'] = '';		
				$vars['leyes_sociales'] = 'active';		
				$vars['salud'] = '';	
				$vars['otros'] = '';						
			}elseif($resultid == 4){
				$vars['message'] = "Datos de Cotizaciones de Salud actualizados correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';	
				$vars['mantencion_personal'] = '';				
				$vars['apv'] = '';		
				$vars['leyes_sociales'] = '';		
				$vars['salud'] = 'active';							
				$vars['otros'] = '';	
			}elseif($resultid == 5){
				$vars['message'] = "Mutual de Seguridad/Caja de Compensaci&oacute;n actualizados correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
				$vars['mantencion_personal'] = '';				
				$vars['apv'] = '';		
				$vars['leyes_sociales'] = '';		
				$vars['salud'] = '';							
				$vars['otros'] = 'active';											
			}elseif($resultid == 6){
				$vars['message'] = "Trabajador Editado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
				$vars['mantencion_personal'] = 'active';				
				$vars['apv'] = '';		
				$vars['leyes_sociales'] = '';		
				$vars['salud'] = '';	
				$vars['otros'] = '';							
			}elseif($resultid == 7){
				$vars['message'] = "A.P.V. Editado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
				$vars['mantencion_personal'] = '';				
				$vars['apv'] = 'active';		
				$vars['leyes_sociales'] = '';		
				$vars['salud'] = '';	
				$vars['otros'] = '';							
			}

			$this->load->model('admin');
			$empresa = $this->admin->get_empresas($this->session->userdata('empresaid')); 


			$this->load->model('admin');
			$personal = $this->admin->get_personal_total(); 
			//$afps = $this->admin->get_afp(); 
			//$apvs = $this->admin->get_apv(); 
			//$isapres = $this->admin->get_isapre(); 
			//$cajas = $this->admin->get_cajas_compensacion(); 
			//$mutuales = $this->admin->get_mutual_seguridad(); 

			//$parametros_generales = $this->admin->get_parametros_generales(); 


			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Personal');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'rrhh/mantencion_personal';
			$vars['dataTables'] = true;
			$vars['mask'] = true;
			$vars['formValidation'] = true;
			$vars['empresa'] = $empresa;
			$vars['personal'] = $personal;
			//$vars['afps'] = $afps;
			//$vars['apvs'] = $apvs;
			//$vars['isapres'] = $isapres;
			//$vars['cajas'] = $cajas;
			//$vars['mutuales'] = $mutuales;
			//$vars['parametros_generales'] = $parametros_generales;
			
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


	public function add_trabajador($idtrabajador = null)
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){


			/***** CARGA DE DATOS PARA FORMULARIO ***/
			$this->load->model('admin');
			$empresa = $this->admin->get_empresas($this->session->userdata('empresaid'));
			$regiones = $this->admin->get_regiones();
			$estados_civiles = $this->admin->get_estado_civil();
			$cargos = $this->admin->get_cargos();
			$paises = $this->admin->get_paises();
			$idiomas = $this->admin->get_idiomas();
			$personal = $this->admin->get_personal_total();
			
			$tramos_asig_familiar = $this->admin->get_tabla_asig_familiar();

			/**** CARGA DE DATOS TRABAJADOR ****/
			$trabajador = is_null($idtrabajador) ?  array() : $this->admin->get_personal_total($idtrabajador); 
			if(!is_null($idtrabajador) && count($trabajador) == 0){ // si estoy editando, pero ingreso un trabajador que no está, vuelvo al principio
				redirect('rrhh/mantencion_personal');	
			}
			$bonos = is_null($idtrabajador) ?  array() : $this->admin->get_bonos($idtrabajador); 
			//$parametros = $this->remuneracion->get_parametros_generales();



			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Agregar Trabajador');


			$datos_form = array(
								'idtrabajador' =>  is_null($idtrabajador) ? 0 : $trabajador->id,	
	       						'rut' => is_null($idtrabajador) ? "" : number_format($trabajador->rut,0,".",".")."-".$trabajador->dv,
								'nombre' => is_null($idtrabajador) ? "" : $trabajador->nombre,
								'apaterno' => is_null($idtrabajador) ? "" : $trabajador->apaterno,
								'amaterno' => is_null($idtrabajador) ? "" : $trabajador->amaterno,
								'fecnacimiento' => is_null($idtrabajador) ? "" : $trabajador->fecnacimiento,
								'sexo' => is_null($idtrabajador) ? "" : $trabajador->sexo,
								'idecivil' => is_null($idtrabajador) ? "" : $trabajador->idecivil,
								'nacionalidad' => is_null($idtrabajador) ? "" : $trabajador->nacionalidad,
								'direccion' => is_null($idtrabajador) ? "" : $trabajador->direccion,
								'idregion' => is_null($idtrabajador) ? "" : $trabajador->idregion,
								'idcomuna' => is_null($idtrabajador) ? "" : $trabajador->idcomuna,
								'fono' => is_null($idtrabajador) ? "" : $trabajador->fono,
								'email' => is_null($idtrabajador) ? "" : $trabajador->email,
								'fecingreso' => is_null($idtrabajador) ? "" : $trabajador->fecingreso,
								'fecafc' => is_null($idtrabajador) ? "" : $trabajador->fecafc,
								'fecinicvacaciones' => is_null($idtrabajador) ? "" : $trabajador->fecinicvacaciones,
								'saldoinicvacaciones' => is_null($idtrabajador) ? "" : $trabajador->saldoinicvacaciones,
								'saldoinicvacprog' => is_null($idtrabajador) ? "" : $trabajador->saldoinicvacprog,
								'idcargo' => is_null($idtrabajador) ? "" : $trabajador->idcargo,
								'pensionado' => is_null($idtrabajador) ? "" : $trabajador->pensionado,
								'tipocontrato' => is_null($idtrabajador) ? "" : $trabajador->tipocontrato,
								'parttime' => is_null($idtrabajador) ? "" : $trabajador->parttime,
								'diastrabajo' => is_null($idtrabajador) ? "" : $trabajador->diastrabajo,
								'horasdiarias' => is_null($idtrabajador) ? "" : $trabajador->horasdiarias,
								'horassemanales' => is_null($idtrabajador) ? "" : $trabajador->horassemanales,
								'sueldobase' => is_null($idtrabajador) ? "" : number_format($trabajador->sueldobase,0,".","."),
								'tipogratificacion' => is_null($idtrabajador) ? "" : $trabajador->tipogratificacion,
								'gratificacion' => is_null($idtrabajador) ? "" : number_format($trabajador->gratificacion,0,".","."),
								'cargassimples' => is_null($idtrabajador) ? "" : $trabajador->cargassimples,
								'cargasinvalidas' => is_null($idtrabajador) ? "" : $trabajador->cargasinvalidas,
								'cargasmaternales' => is_null($idtrabajador) ? "" : $trabajador->cargasmaternales,
								'cargasretroactivas' => is_null($idtrabajador) ? "" : $trabajador->cargasretroactivas,
								'idasigfamiliar' => is_null($idtrabajador) ? "" : $trabajador->idasigfamiliar,
								'asigfamiliar' => is_null($idtrabajador) ? "" : number_format($trabajador->asigfamiliar,0,".","."),
								'segcesantia' => is_null($idtrabajador) ? "" : $trabajador->segcesantia,
								'movilizacion' => is_null($idtrabajador) ? "" : number_format($trabajador->movilizacion,0,".","."),
								'colacion' => is_null($idtrabajador) ? "" : number_format($trabajador->colacion,0,".","."),
								'active' => is_null($idtrabajador) ? "1" : $trabajador->active,
								);
			

			$vars['content_menu'] = $content;				
			$vars['regiones'] = $regiones;
			$vars['estados_civiles'] = $estados_civiles;			
			$vars['cargos'] = $cargos;
			$vars['paises'] = $paises;
			$vars['idiomas'] = $idiomas;
			$vars['personal'] = $personal;
			$vars['tramos_asig_familiar'] = $tramos_asig_familiar;
			$vars['content_view'] = 'rrhh/add_trabajador';
			$vars['datos_form'] = $datos_form;
			$vars['bonos'] = $bonos;
			$vars['formValidation'] = true;
			$vars['datetimepicker'] = true;
			//$vars['icheck'] = true;
			$vars['jqueryRut'] = true;
			$vars['mask'] = true;
			$vars['inputmask'] = true;


			$template = "template";
			$this->load->view($template,$vars);	


		}else{
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}

	}



}

