<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuraciones extends CI_Controller {

	
	function __construct(){
	  parent::__construct();
	  $this->load->library('ion_auth');
      $this->load->library('form_validation');
      $this->load->helper('format');
      $this->load->model('configuracion');
      $this->load->model('admin');
      $this->load->helper('download');
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

	public function tipos_contrato(){
		//if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$vars['mantencion_personal'] = 'active';				
			$vars['leyes_sociales'] = '';		
			$vars['salud'] = '';	
			$vars['otros'] = '';	
			$vars['apv'] = '';
			$resultid = $this->session->flashdata('personal_result');
			if($resultid == 1){
				$vars['message'] = "Documento Agregado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
				$vars['mantencion_personal'] = 'active';				
				$vars['leyes_sociales'] = '';		
				$vars['apv'] = '';		
				$vars['salud'] = '';		
				$vars['otros'] = '';	
			}
			$this->load->model('admin');
			$empresa = $this->admin->get_empresas($this->session->userdata('empresaid')); 

			
			$tipocontrato = $this->admin->get_contratos(); 

						
			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Acceso Carga Documentacion');

			$vars['content_menu'] = $content;
			$vars['tipocontrato'] = $tipocontrato;				
			$vars['content_view'] = 'rrhh/tipos_de_contratos';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['formValidation'] = true;
			$vars['gritter'] = true;

			$vars['empresa'] = $empresa;
			//$vars['personal'] = $personal;
			//$vars['afps'] = $afps;
			//$vars['apvs'] = $apvs;
			//$vars['isapres'] = $isapres;
			//$vars['cajas'] = $cajas;
			//$vars['mutuales'] = $mutuales;
			//$vars['parametros_generales'] = $parametros_generales;
			
			$template = "template";
			

			

			$this->load->view($template,$vars);	

		/*}else{
			$content = array(
						'menu' => 'Error 403',
						'title' => 'Error 403',
						'subtitle' => '403 error');


			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}*/	


	}


	public function plantilla_banco(){
			if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

				$plantillas_bancos = $this->configuracion->get_plantilla_banco();

							
				$content = array(
							'menu' => 'Remuneraciones',
							'title' => 'Remuneraciones',
							'subtitle' => 'Creación Plantillas Bancos');

				$vars['content_menu'] = $content;
							
				$vars['content_view'] = 'configuraciones/plantilla_banco';
				

				$template = "template";	
				$vars['plantillas_bancos'] = $plantillas_bancos;		

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


public function add_plantilla(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			

			$bancos = $this->admin->get_bancos();			
			$columnas = array(	'Rut',
								'Digito Verificador',
								'Apellido Paterno',
								'Apellido Materno',
								'Nombres',
								'Direccion',
								'Comuna',
								'Fecha de Pago',
								'Forma de Pago',
								'Codigo de Banco',
								'Oficina de Pago',
								'Numero Cuenta Banco',
								'Documento',
								'Monto a Pagar');

			$tablas = array('rut','dv','apaterno','amaterno','nombre','direccion','idcomuna','fecha_pago','alias','cod_sbif','oficina_pago','nrocuentabanco','documento','sueldoliquido');

			$numero_columnas = sizeof($columnas);

			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Creación Plantillas Bancos');
			
			$vars['columnas'] = $columnas;
			$vars['tablas'] =$tablas;
			$vars['numero_columnas'] = $numero_columnas;
			$vars['content_menu'] = $content;
			$vars['bancos'] = $bancos;
			$vars['content_view'] = 'configuraciones/add_plantilla';
			

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

	public function submit_plantilla_banco(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			
			//cabecera
			$nombre_plantilla = $this->input->post('nombre_plantilla');
			$banco = $this->input->post('banco');
			$id_plantilla_banco = $this->input->post('id_plantilla_banco');

			//detalle
			
			$seq = $this->input->post('seq');
			$nombre_campo = $this->input->post('nombre_campo');
			$tipo = $this->input->post('tipo');
			$largo = $this->input->post('largo');
			$inicio = $this->input->post('inicio');
			$fin = $this->input->post('fin');
			$Observacion = $this->input->post('Observacion');
			$nombre_tabla = $this->input->post('nombre_tabla');
			$active = $this->input->post('active');
			$array_active = array_fill(0, 13, '0');
			$id_det_plantilla_banco = $this->input->post('id_det_plantilla_banco');
/*
			$array_datos_detalle['seq'] = $this->input->post('seq');
			$array_datos_detalle['nombre_campo'] = $this->input->post('nombre_campo');
			$array_datos_detalle['tipo'] = $this->input->post('tipo');
			$array_datos_detalle['largo'] = $this->input->post('largo');
			$array_datos_detalle['inicio'] = $this->input->post('inicio');
			$array_datos_detalle['fin'] = $this->input->post('fin');
			$array_datos_detalle['Observacion'] = $this->input->post('Observacion');
			$array_datos_detalle['nombre_tabla'] = $this->input->post('nombre_tabla');
			$active = $this->input->post('active');
			$array_active = array_fill(0, 8, '0');
			$array_datos_detalle['id_det_plantilla_banco'] = $this->input->post('id_det_plantilla_banco');*/

			foreach ($active as $activo) {
			
				$valor = $activo -1;
				$array_active[$valor] = '1';
			};		
			$active = $array_active;
			
			
				
			$array_datos_maestro = array(
									'descripcion' => $nombre_plantilla,
									'id_banco' => $banco,
									'active' => 1);	
			

			
			$array_datos_detalle = array(
									'seq' => $seq,
									'nombre_campo' => $nombre_campo,
									'tipo' => $tipo,
									'largo' => $largo,
									'inicio' => $inicio,
									'fin' => $fin,
									'Observacion' => $Observacion,
									'nombre_tabla' => $nombre_tabla,
									'active' => $active,
									'id_det_plantilla_banco' => $id_det_plantilla_banco
								);
			//var_dump($array_datos_detalle);
			
			$plantilla_banco = $this->configuracion->add_plantilla_banco($array_datos_maestro,$array_datos_detalle,$id_plantilla_banco); 

			$this->session->set_flashdata('plantilla_banco_result', 1);
			redirect('configuraciones/plantilla_banco');	
			
			
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

	public function del_plantilla($id_plantilla_banco){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			$plantilla_banco = $this->configuracion->del_plantilla_banco($id_plantilla_banco); 
			
			$this->session->set_flashdata('plantilla_banco_result', 1);
			redirect('configuraciones/plantilla_banco');	
			
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


	public function exporta_plantilla($id_plantilla_banco){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
						
			$bancos = $this->admin->get_bancos();
			$datos_plantilla_banco = array();			
			$datos_plantilla_banco = $this->configuracion->get_det_plantilla_banco_export($id_plantilla_banco);
			$cabecera_plantilla_banco = $this->configuracion->get_plantilla_banco($id_plantilla_banco);
			$datos_personal = $this->configuracion->get_personal_plantilla($id_plantilla_banco);			
			$numero_datos_personal = count($datos_personal)-1;
			$nro_datos_plantilla_banco = sizeof($datos_plantilla_banco);
			$nombre_tabla = array();
			
			for ($i = 0; $i < $nro_datos_plantilla_banco ; $i++){ 				
				foreach ($datos_plantilla_banco as $dat_plantilla ) {
					$nombre_tabla[$i] = $dat_plantilla->nombre_tabla;
					$largo_campo[$i] = $dat_plantilla->largo;
				$i++;
				}
			
			}

			$plantilla_banco = $this->configuracion->exporta_plantilla_banco($datos_personal,$cabecera_plantilla_banco,$nombre_tabla,$largo_campo); 
			
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

	public function mod_plantilla($id_plantilla_banco){

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$datos_plantilla_banco = array();
			
			$datos_plantilla_banco = $this->configuracion->get_det_plantilla_banco($id_plantilla_banco);
			$cabecera_plantilla_banco = $this->configuracion->get_plantilla_banco($id_plantilla_banco);

			$bancos = $this->admin->get_bancos();			
			$columnas = array(	'Rut',
								'Digito Verificador',
								'Apellido Paterno',
								'Apellido Materno',
								'Nombres',
								'Direccion',
								'Comuna',
								'Fecha de Pago',
								'Forma de Pago',
								'Codigo de Banco',
								'Oficina de Pago',
								'Numero Cuenta Banco',
								'Documento',
								'Monto a Pagar');

			$tablas = array('rut','dv','apaterno','amaterno','nombre','direccion','idcomuna','fecha_pago','id_forma_pago','cod_sbif','oficina_pago','nrocuentabanco','documento','sueldoliquido');

			$numero_columnas = sizeof($columnas);

			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Modificar Plantillas Bancos');
			
			$vars['cabecera_plantilla_banco'] = $cabecera_plantilla_banco;
			$vars['datos_plantilla_banco'] = $datos_plantilla_banco;
			$vars['columnas'] = $columnas;
			$vars['tablas'] =$tablas;
			$vars['numero_columnas'] = $numero_columnas;
			$vars['content_menu'] = $content;
			$vars['bancos'] = $bancos;
			$vars['content_view'] = 'configuraciones/mod_plantilla';
			
			//var_dump($datos_plantilla_banco);

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



	public function datos_plantilla_banco($id_plantilla_banco){
	 
	
	$datos_det_plantilla = $this->configuraciones->get_det_plantilla_banco($id_plantilla_banco);
	//json_encode($datos_personal2);
	if ($datos_det_plantilla == 0){

				echo json_encode('0');
			}else{

			echo json_encode($datos_det_plantilla);
			}

	}



	public function tipos_contrato_colaboradores(){
		//if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

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
			}

			$this->load->model('admin');
			$empresa = $this->admin->get_empresas($this->session->userdata('empresaid'));

			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Acceso Carga Documentacion');

			$tipocontrato = $this->admin->get_tipo_contrato();
	
			$vars['tipocontrato'] = $tipocontrato;

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'rrhh/carga_contrato_archivos';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['formValidation'] = true;
			$vars['gritter'] = true;

			$vars['empresa'] = $empresa;
			$template = "template";		

			$this->load->view($template,$vars);	

	}

	public function genera_documentos(){
		//if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

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
			}

			$this->load->model('admin');
			$empresa = $this->admin->get_empresas($this->session->userdata('empresaid'));

			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Acceso Carga Documentacion');

			$tipocontrato = $this->admin->get_tipo_contrato();
	
			$vars['tipocontrato'] = $tipocontrato;

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'rrhh/genera_nuevo_documentos';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['formValidation'] = true;
			$vars['gritter'] = true;

			$vars['empresa'] = $empresa;
			$template = "template";

			

			$this->load->view($template,$vars);	


	}

	public function centrocosto(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			
			$resultid = $this->session->flashdata('centro_costo_result');
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

			}

			$centrocosto = $this->configuracion->centro_costo();
			
			//print_r($centrocosto);
			//exit; 


			$content = array(
						'menu' => 'Configuraciones Generales',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Centro de Costos');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'configuraciones/Centro_costo';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['gritter'] = true;

			$vars['centro_costo'] = $centrocosto;
			
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
				$vars['message'] = "Cargo ya existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';		

			}else if($resultid == 4){
				$vars['message'] = "Cargo a editar no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';		

			}

			$this->load->model('admin');
			$cargos = $this->admin->get_cargos_empresa();
			
			//print_r($centrocosto);
			//exit; 


			$content = array(
						'menu' => 'Configuraciones Generales',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Cargos');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'configuraciones/cargos';
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


public function add_cargo($idcargo = null){


			$cargo = array();
			if(!is_null($idcargo)){
					$this->load->model('admin');
					$cargos = $this->admin->get_cargos_empresa($idcargo);
								
			}


			if(is_null($idcargo)){
				$cargos = array();

			}else{
				if(count($cargos) == 0){ // no existe cargo
		            $this->session->set_flashdata('cargos_result', 4);
		            redirect('configuraciones/cargos');
				}else{
					$cargo = $cargos[0];
				} 

			}



            $datos_form = array(
                'idcargo' => count($cargos) == 0 ? 0 : $cargo->id_cargos,
                'nombre' => count($cargos) == 0 ? '' : $cargo->nombre,
            );


			//print_r($centro_costo);
			//exit;			

			$content = array(
						'menu' => 'Configuraciones Generales',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Cargos');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'configuraciones/add_cargo';
			$vars['formValidation'] = true;
			$vars['datos_form'] = $datos_form;
			$vars['gritter'] = true;

			$template = "template";			

			$this->load->view($template,$vars);	

	}	

	
public function submit_cargo(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){


 			$cargo = $this->input->post('nombrecargo');
            $idcargo = $this->input->post('idcargo');

            $array_datos = array(
                'idcargo' => $idcargo,
                'cargo' => $cargo,
            );

            $result = $this->configuracion->add_cargo($array_datos);
            $this->session->set_flashdata('cargos_result', $result);

            redirect('configuraciones/cargos');



		}else{
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}		


	}	


	public function hab_descto(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			
			$resultid = $this->session->flashdata('haber_descuento_result');
			if($resultid == 1){
				$vars['message'] = "Haber/Descuento Agregado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}else if($resultid == 2){
				$vars['message'] = "Haber/Descuento no puede ser editado";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';		

			}

			$haberes_descuentos = $this->configuracion->get_haberes_descuentos(); 


			$content = array(
						'menu' => 'Configuraciones',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Haberes / Descuentos');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'configuraciones/hab_descto';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['gritter'] = true;

			$vars['haberes_descuentos'] = $haberes_descuentos;
			
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


public function add_haber_descuento($idhaberdescto = null){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			
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
			}

			$haberes_descuentos = array();
			if(!is_null($idhaberdescto)){
					$haberes_descuentos = $this->configuracion->get_haberes_descuentos($idhaberdescto); 	
					if($haberes_descuentos->editable == 0){
							$this->session->set_flashdata('haber_descuento_result', 2);
							redirect('configuraciones/hab_descto');	


					}

			}
			

			$content = array(
						'menu' => 'Configuraciones',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Haberes / Descuentos');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'configuraciones/add_haber_descuento';
			$vars['formValidation'] = true;
			$vars['haberes_descuentos'] = $haberes_descuentos;
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
	
	public function add_centro_costo($idcentrocosto = null){
		//if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

						
			$resultid = $this->session->flashdata('centro_costo');
			if($resultid == 1){
				$vars['message'] = "Trabajador Agregado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
				$vars['mantencion_personal'] = 'active';				
				$vars['leyes_sociales'] = '';		
				$vars['apv'] = '';		
				$vars['salud'] = '';		
				$vars['otros'] = '';	
			}

			$centro_costo = array();
			if(!is_null($idcentrocosto)){
					$centro_costo = $this->configuracion->centro_costo($idcentrocosto); 	
			}
			
			//print_r($centro_costo);
			//exit;			

			$content = array(
						'menu' => 'Configuraciones Generales',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Centro de Costos');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'configuraciones/add_centro_de_costos';
			$vars['formValidation'] = true;
			$vars['centro_costo'] = $centro_costo;
			$vars['gritter'] = true;

			$template = "template";			

			$this->load->view($template,$vars);	

	}		


public function submit_haber_descuento(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			$tipo = $this->input->post('tipo');
			$codigo = $this->input->post('codigo');
			$descripcion = $this->input->post('descripcion');
			$tipocalculo = $this->input->post('tipocalculo');
			//$formacalculo = $this->input->post('formacalculo');
			$formacalculo = 'fijo';

			$datos = array();
			$datos['tipo'] = $tipo;
			$datos['codigo'] = $codigo;
			$datos['nombre'] = $descripcion;
			$datos['tipocalculo'] = $tipocalculo;
			$datos['formacalculo'] = $formacalculo;


			$datos['imponible'] = $this->input->post('imponible') == '' ? 0 : 1;
			$datos['reajustable'] = $this->input->post('reajustable') == '' ? 0 : 1;
			$datos['provision'] = $this->input->post('provision') == '' ? 0 : 1;
			$datos['embargable'] = $this->input->post('embargable') == '' ? 0 : 1;
			$datos['gratifica'] = $this->input->post('gratificacion') == '' ? 0 : 1;
			$datos['insoluto'] = $this->input->post('insoluto') == '' ? 0 : 1;
			$datos['retjudicial'] = $this->input->post('ret_judicial') == '' ? 0 : 1;
			$datos['tributable'] = $this->input->post('tributable') == '' ? 0 : 1;
			$datos['jornada'] = $this->input->post('jornada') == '' ? 0 : 1;
			$datos['finiquito'] = $this->input->post('finiquito') == '' ? 0 : 1;
			$datos['contable'] = $this->input->post('contable') == '' ? 0 : 1;
			$datos['sobregiro'] = $this->input->post('sobregiro') == '' ? 0 : 1;
			$datos['liqminimo'] = $this->input->post('liqminimo') == '' ? 0 : 1;
			$datos['semanacorrida'] = $this->input->post('semanacorrida') == '' ? 0 : 1;
			$datos['fijo'] = $this->input->post('fijo') == '' ? 0 : 1;
			$datos['proporcional'] = $this->input->post('proporcional') == '' ? 0 : 1;
			$datos['otros_aportes'] = $this->input->post('otros_aportes') == '' ? 0 : 1;

			
			$datos['editable'] = 1;
			$datos['visible'] = 1;
			$datos['valido'] = 1;
			$idhab = $this->input->post('idhab');


			$haberes_descuentos = $this->configuracion->add_haberes_descuentos($datos,$idhab); 

			$this->session->set_flashdata('haber_descuento_result', 1);
			redirect('configuraciones/hab_descto');	


		}else{
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}		


	}
	
	public function submit_centro_costo(){
		
			$codigo = $this->input->post('codigo');
			$descripcion = $this->input->post('nombre');
			$idcentro = $this->input->post('idcentro');

						
			$datos = array();
			$datos['codigo'] = $codigo;
			$datos['nombre'] = $descripcion;
			
			$haberes_descuentos = $this->configuracion->add_centro_costo($datos,$idcentro);

			if($idcentro==0){
				$this->session->set_flashdata('centro_costo_result', 1);
			redirect('configuraciones/centrocosto');
				
			}else{
				$this->session->set_flashdata('centro_costo_result', 2);
			redirect('configuraciones/centrocosto');	
				
			}

	}
			
}
