<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rrhh extends CI_Controller {

	
	function __construct(){
	  parent::__construct();
	  $this->load->library('ion_auth');
      $this->load->library('form_validation');
      $this->load->helper('format');
      $this->load->model('admin');
      $this->load->model('rrhh_model');
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
			$licencias = $this->admin->get_licencia_conducir();
			$estudios = $this->admin->get_estudios();
			$centros_costo = $this->admin->get_centro_costo();
			$afps = $this->admin->get_afp();
			$isapres = $this->admin->get_isapre();
			
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
			$vars['licencias'] = $licencias;
			$vars['estudios'] = $estudios;
			$vars['centros_costo'] = $centros_costo;
			$vars['tramos_asig_familiar'] = $tramos_asig_familiar;
			$vars['afps'] = $afps;
			$vars['isapres'] = $isapres;
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


	public function submit_trabajador(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			//echo "<pre>";
			//print_r($this->input->post(NULL,true));  EXIT;
			$idtrabajador = $this->input->post("idtrabajador");
       		$rut = str_replace(".","",$this->input->post("rut"));
			$arrayRut = explode("-",$rut);
			$numficha = $this->input->post('numficha');
			$nombre = $this->input->post('nombre');
			$apaterno = $this->input->post('apaterno');
			$amaterno = $this->input->post('amaterno');
			$fecnacimiento = $this->input->post('fechanacimiento');
			$idnacionalidad = $this->input->post('nacionalidad');
			$idecivil = $this->input->post('ecivil');
			$sexo = $this->input->post('sexo');
			$direccion = $this->input->post('direccion');
			$email = $this->input->post('email');
			$tiporenta = $this->input->post('tiporenta');
			$idcargo = $this->input->post('cargo');
			$idestudio = $this->input->post('estudios');
			$titulo = $this->input->post('titulo');
			$ididioma = $this->input->post('idioma');
			$idjefe = $this->input->post('jefe');
			$idreemplazo = $this->input->post('reemplazo');
			$idlicencia = $this->input->post('licencia');
			$tallapolera = $this->input->post('polera');
			$tallapantalon = $this->input->post('pantalon');
			$tipodocumento = $this->input->post('tipo_documento');
			$idcentrocosto = $this->input->post('centro_costo');
			$cbeneficio = $this->input->post('beneficio');
			$fono = $this->input->post('fono');
			$afp = $this->input->post('afp');
			$isapre = $this->input->post('isapre');
			$sueldo_base = $this->input->post('sueldo_base');
			


			/*$idregion = $this->input->post('region');
			$idcomuna = $this->input->post('comuna');
			$fecingreso = $this->input->post('fechaingreso');
			$fecafc = $this->input->post('fechaafc');
			$fecinicvacaciones = $this->input->post('fecinicvacaciones');
			$saldoinicvacaciones = $this->input->post('saldoinicvacaciones');
			$saldoinicvacprog = $this->input->post('saldoinicvacprog');			
			$pensionado = $this->input->post('pensionado') == 'on' ? 1 : 0;
			$tipocontrato = $this->input->post('tipocontrato');
			$parttime = $this->input->post('parttime') == 'on' ? 1 : 0;
			$segcesantia = $this->input->post('segcesantia') == 'on' ? 1 : 0;
			$diastrabajo = $this->input->post('diastrabajo');
			$horasdiarias = $this->input->post('horasdiarias');
			$horassemanales = $this->input->post('horassemanales');
			$sueldobase = str_replace(".","",$this->input->post('sueldobase'));
			$tipogratificacion = $this->input->post('tipogratificacion');
			$gratificacion = str_replace(".","",$this->input->post('gratificacion'));
			$cargassimples = $this->input->post('cargassimples');
			$cargasinvalidas = $this->input->post('cargasinvalidas');
			$cargasmaternales = $this->input->post('cargasmaternales');
			$cargasretroactivas = $this->input->post('cargasretroactivas');
			$tramo_asigfamiliar = $this->input->post('tramo_asigfamiliar') == '' ? null : $this->input->post('tramo_asigfamiliar');
			$asigfamiliar = str_replace(".","",$this->input->post('asigfamiliar'));
			$movilizacion = str_replace(".","",$this->input->post('movilizacion'));
			$colacion = str_replace(".","",$this->input->post('colacion'));
			$activo = $this->input->post('activo') == 'on' ? 1 : 0;*/

			$array_datos = array(
								'idempresa' => $this->session->userdata('empresaid'),
	       						'rut' => $idtrabajador == 0 ? $arrayRut[0] : "",
	       						'dv' => $idtrabajador == 0 ? $arrayRut[1] : "",
	       						'nombre' => $numficha,
								'nombre' => $nombre,
								'apaterno' => $apaterno,
								'amaterno' => $amaterno,
								'fecnacimiento' => substr($fecnacimiento,6,4)."-".substr($fecnacimiento,3,2)."-".substr($fecnacimiento,0,2),
								'idnacionalidad' => $idnacionalidad,
								'nacionalidad' => 'C', //ELIMINAR DESPUES
								'idecivil' => $idecivil,
								'sexo' => $sexo,
								'direccion' => $direccion,
								'email' => $email,
								'tiporenta' => $tiporenta,
								'idcargo' => $idcargo,
								'idestudio' => $idestudio,
								'titulo' => $titulo,
								'ididioma' => $ididioma,
								'idjefe' => $idjefe,
								'idreemplazo' => $idreemplazo,
								'idlicencia' => $idlicencia,
								'tallapolera' => $tallapolera,
								'tallapantalon' => $tallapantalon,
								'tipodocumento' => $tipodocumento,
								'idcentrocosto' => $idcentrocosto,
								'cbeneficio' => $cbeneficio,
								'fono' => $fono,
								'idafp' => $afp,
								'idisapre' => $isapre,
								'sueldobase' => $sueldo_base,
								
								//DATOS POR DEFECTO
								'idregion' => 1,
								'idcomuna' => 1,
								'fecingreso' => '2017-09-05',
								'fecinicvacaciones' => '2017-09-05',
								'saldoinicvacaciones' => 0,
								'saldoinicvacprog' => 0,
								'diasprogresivos' => 0,
								'diasvactomados' => 0,
								'diasprogtomados' => 0,
								'tipocontrato' => 'I',
								'parttime' => 0,
								'segcesantia' => 0,
								'pensionado' => 0,
								'diastrabajo' => 30,
								'horasdiarias' => 8,
								'horassemanales' => 45,
								//'sueldobase' => 250000,
								'tipogratificacion' => 'SG',
								'gratificacion' => 0,
								'cargassimples' => 0,
								'cargasinvalidas' => 0,
								'cargasmaternales' => 0,
								'cargasretroactivas' => 0,
								'idasigfamiliar' => NULL,
								'asigfamiliar' => 0,
								'movilizacion' => 0,
								'colacion' => 0,
								'active' => 1,

								//OTROS
								'adicafp' => 0,



								/*'idregion' => $idregion,
								'idcomuna' => $idcomuna,
								'fono' => $fono,
								'fecingreso' => substr($fecingreso,6,4)."-".substr($fecingreso,3,2)."-".substr($fecingreso,0,2),
								'fecafc' => $segcesantia == 1 ? substr($fecafc,6,4)."-".substr($fecafc,3,2)."-".substr($fecafc,0,2) : null,
								'fecinicvacaciones' => substr($fecinicvacaciones,6,4)."-".substr($fecinicvacaciones,3,2)."-".substr($fecinicvacaciones,0,2),
								'saldoinicvacaciones' => $saldoinicvacaciones,
								'saldoinicvacprog' => $saldoinicvacprog,
								'tipocontrato' => $tipocontrato,
								'parttime' => $parttime,
								'segcesantia' => $segcesantia,
								'pensionado' => $pensionado,
								'diastrabajo' => $diastrabajo,
								'horasdiarias' => $horasdiarias,
								'horassemanales' => $horassemanales,
								'sueldobase' => $sueldobase,
								'tipogratificacion' => $tipogratificacion,
								'gratificacion' => $gratificacion,
								'cargassimples' => $cargassimples,
								'cargasinvalidas' => $cargasinvalidas,
								'cargasmaternales' => $cargasmaternales,
								'cargasretroactivas' => $cargasretroactivas,
								'idasigfamiliar' => $tramo_asigfamiliar,
								'asigfamiliar' => $asigfamiliar,
								'movilizacion' => $movilizacion,
								'colacion' => $colacion,
								'active' => $activo
								*/

								);
			$result = $this->rrhh_model->add_personal($array_datos,$idtrabajador);

			if($result == -1){
				$this->session->set_flashdata('personal_result', 2);
			}else{
				if($idtrabajador == 0){
					$this->session->set_flashdata('personal_result', 1);
				}else{
					$this->session->set_flashdata('personal_result', 6);
				}
			}
			redirect('rrhh/mantencion_personal');	



		}else{
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}		


	}	




	public function calculo_remuneraciones($resultid = '')
	{
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){


			$resultid = $this->session->flashdata('calculo_remuneraciones_result');
			if($resultid == 1){
				$vars['message'] = "Remuneraciones calculadas correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}elseif($resultid == 2){
				$vars['message'] = "Error al Calcular Remuneraciones. Falta informaci&oacute;n para per&iacute;odo seleccionado";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}else if($resultid == 3){
				$vars['message'] = "Remuneracion aprobada";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';					
			}else if($resultid == 4){
				$vars['message'] = "Remuneracion rechazada.  Puede corregir los valores necesarios para calcular nuevamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';					
			}
			$mes = $this->session->flashdata('asistencia_mes') == '' ? date('m') : $this->session->flashdata('asistencia_mes');
			$anno = $this->session->flashdata('asistencia_anno') == '' ? date('Y') : $this->session->flashdata('asistencia_anno');
			$this->load->model('admin');
			$centros_costo = $this->admin->get_centro_costo();
			$periodos_remuneracion = $this->rrhh_model->get_periodos_remuneracion_abiertos(); 
			//echo "<pre>";
			//print_r($periodos_remuneracion); exit;
			$personal = $this->rrhh_model->get_personal(); 
			
			$array_remuneracion_trabajador = array();
			$mensajes = array();
			$mensaje_html = array();
			foreach ($periodos_remuneracion as $periodos) {
				//$mensajes[$periodos->id] = array();

				
				$estado = "Informaci&oacute;n Completa";
				/*if(is_null($periodos->cierre)){
					foreach ($personal as $trabajador) {
						if(is_null($trabajador->idafp)){
		                   	   if(!in_array("Informaci&oacute;n Afp", $mensajes[$periodos->id])){
		                   	   		array_push($mensajes[$periodos->id],"Informaci&oacute;n Afp");
		                   	   }				
		                       $estado = "Falta Informaci&oacute;n";
		                   	   //break;
		                }

		                if(is_null($trabajador->tipoahorrovol)){						
		                		
		                   	   if(!in_array("Informaci&oacute;n Afp", $mensajes[$periodos->id])){
		                   	   		array_push($mensajes[$periodos->id],"Informaci&oacute;n Afp");
		                   	   }	                	
		                       $estado = "Falta Informaci&oacute;n";
		                   	   //break;
						}


						if(is_null($trabajador->idisapre)){						
		                   	   if(!in_array("Informaci&oacute;n Cotizaci&oacute;n de Salud", $mensajes[$periodos->id])){
		                   	   		array_push($mensajes[$periodos->id],"Informaci&oacute;n Cotizaci&oacute;n de Salud");
		                   	   }	
		                       $estado = "Falta Informaci&oacute;n";
		                   	   //break;						                	
						}

						$datos_remuneracion = $this->remuneracion->get_datos_remuneracion($periodos->mes,$periodos->anno,$trabajador->id); 
						if(count($datos_remuneracion) == 0){
		                   	   if(!in_array("Informaci&oacute;n Asistencia", $mensajes[$periodos->id])){
		                   	   		array_push($mensajes[$periodos->id],"Informaci&oacute;n Asistencia");
		                   	   }										
		                   	   if(!in_array("Informaci&oacute;n Descuentos", $mensajes[$periodos->id])){
		                   	   		array_push($mensajes[$periodos->id],"Informaci&oacute;n Descuentos");
		                   	   }										
		                   	   if(!in_array("Informaci&oacute;n Horas Extras", $mensajes[$periodos->id])){
		                   	   		array_push($mensajes[$periodos->id],"Informaci&oacute;n Horas Extras");
		                   	   }		
		                   	   if(!in_array("Informaci&oacute;n Anticipos/Aguinaldo", $mensajes[$periodos->id])){
		                   	   		array_push($mensajes[$periodos->id],"Informaci&oacute;n Anticipos/Aguinaldo");
		                   	   }												                   	   															
		                       $estado = "Falta Informaci&oacute;n";
		                   	   //break;
						}else{
							if(is_null($datos_remuneracion->diastrabajo)){
		                   	   if(!in_array("Informaci&oacute;n Asistencia", $mensajes[$periodos->id])){
		                   	   		array_push($mensajes[$periodos->id],"Informaci&oacute;n Asistencia");
		                   	   }										
		                       $estado = "Falta Informaci&oacute;n";
		                   	   //break;
							}

							if( 
							   is_null($datos_remuneracion->horasdescuento) || 
							   is_null($datos_remuneracion->montodescuento)
							   ){
		                   	   if(!in_array("Informaci&oacute;n Descuentos", $mensajes[$periodos->id])){
		                   	   		array_push($mensajes[$periodos->id],"Informaci&oacute;n Descuentos");

		                   	   }										
		                       $estado = "Falta Informaci&oacute;n";
		                   	   //break;
							}

							if(is_null($datos_remuneracion->horasextras50) || 
							   is_null($datos_remuneracion->montohorasextras50) || 
							   is_null($datos_remuneracion->horasextras100) || 
							   is_null($datos_remuneracion->montohorasextras100)
							   ){
		                   	   if(!in_array("Informaci&oacute;n Horas Extras", $mensajes[$periodos->id])){
		                   	   		array_push($mensajes[$periodos->id],"Informaci&oacute;n Horas Extras");
		                   	   }										
		                       $estado = "Falta Informaci&oacute;n";
		                   	   //break;
							}

							if(is_null($periodos->anticipo)){
								if(is_null($datos_remuneracion->anticipo) || 
								   is_null($datos_remuneracion->aguinaldo)){
				                   	   if(!in_array("Informaci&oacute;n Anticipos/Aguinaldo", $mensajes[$periodos->id])){
				                   	   		array_push($mensajes[$periodos->id],"Informaci&oacute;n Anticipos/Aguinaldo");
				                   	   }										
				                       $estado = "Falta Informaci&oacute;n";
				                   	   //break;
								}
							}
						} // end else


					} // end foreach


				}
						*/

				$periodos->estado = $estado;

				/*$mensaje_html[$periodos->id] = "";
				if(count($mensajes[$periodos->id]) > 0){
					$mensaje_html[$periodos->id] .= "<ul>";
					foreach ($mensajes[$periodos->id] as $mensaje) {
						$mensaje_html[$periodos->id] .= "<li>" . $mensaje . "</li>";
					}
					$mensaje_html[$periodos->id] .= "</ul>";
				}*/

			}

	


			//$estado = "Informaci&oacute;n Completa";
			//$periodos->estado = $estado;
			//$periodos_remuneracion->estado = $estado;
			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Calculo Remuneraci&oacute;n');

			$vars['content_menu'] = $content;				
			$vars['mes'] = $mes;	
			$vars['anno'] = $anno;	
			$vars['periodos_remuneracion'] = $periodos_remuneracion;	
			$vars['formValidation'] = true;
			$vars['centros_costo'] = $centros_costo;
			//$vars['mensaje_html'] = $mensaje_html;	
			$vars['content_view'] = 'rrhh/calculo_remuneraciones';

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



	public function get_datos_remuneracion($mes,$anno){
		$datos_remuneracion = $this->rrhh_model->get_datos_remuneracion($mes,$anno);
		$array_remuneracion_trabajador = array();
		foreach ($datos_remuneracion as $remuneracion) {
			$array_remuneracion_trabajador["valorhora_".$remuneracion->idpersonal] = $remuneracion->valorhora;
			$array_remuneracion_trabajador["diastrabajo_".$remuneracion->idpersonal] = $remuneracion->diastrabajo;
			$array_remuneracion_trabajador["horasdescuento_".$remuneracion->idpersonal] = $remuneracion->horasdescuento;
			$array_remuneracion_trabajador["montodescuento_".$remuneracion->idpersonal] = $remuneracion->montodescuento;
			$array_remuneracion_trabajador["valorhorasextras50_".$remuneracion->idpersonal] = $remuneracion->valorhorasextras50;
			$array_remuneracion_trabajador["horasextras50_".$remuneracion->idpersonal] = $remuneracion->horasextras50;
			$array_remuneracion_trabajador["montohorasextras50_".$remuneracion->idpersonal] = $remuneracion->montohorasextras50;
			$array_remuneracion_trabajador["valorhorasextras100_".$remuneracion->idpersonal] = $remuneracion->valorhorasextras100;
			$array_remuneracion_trabajador["horasextras100_".$remuneracion->idpersonal] = $remuneracion->horasextras100;
			$array_remuneracion_trabajador["montohorasextras100_".$remuneracion->idpersonal] = $remuneracion->montohorasextras100;
			$array_remuneracion_trabajador["anticipo_".$remuneracion->idpersonal] = $remuneracion->anticipo;
			$array_remuneracion_trabajador["aguinaldo_".$remuneracion->idpersonal] = $remuneracion->aguinaldo;
		}		
		echo json_encode($array_remuneracion_trabajador);
	}	


	public function submit_calculo_remuneraciones($idperiodo=null){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){


			$mes = $this->input->post('mes');
			$anno = $this->input->post('anno');
			$centro_costo = $this->input->post('centro_costo');

			//if($mes == '' || $anno == ''){
			if(empty($mes) && empty($anno)){
				$this->session->set_flashdata('calculo_remuneraciones_result', 2);
				redirect('rrhh/calculo_remuneraciones');	
			}else{
				#EN CASO QUE NO EXISTAN DATOS INICIALES, SE CARGAN AHORA
				$idperiodo = $this->rrhh_model->set_datos_iniciales_periodo_rem($mes,$anno,$centro_costo); 

			}



			set_time_limit(0);
			$datos_remuneracion = $this->rrhh_model->get_datos_remuneracion_by_periodo($idperiodo); 

			#SIGNIFICA QUE AÚN NO SE CARGA, POR TANTO SE CARGARÁN DATOS INICIALES
			/*if(count($datos_remuneracion) == 0){
				$this->load->model('admin');
				$datos_periodo = $this->admin->get_periodo_by_id($idperiodo);
				//echo "<pre>";
				//print_r($datos_periodo); exit;
				if(count($datos_periodo) == 0){
						$this->session->set_flashdata('calculo_remuneraciones_result', 2);
						redirect('rrhh/calculo_remuneraciones');
				}
				$this->rrhh_model->set_datos_iniciales_periodo_rem($datos_periodo->mes,$datos_periodo->anno); 
				$datos_remuneracion = $this->rrhh_model->get_datos_remuneracion_by_periodo($idperiodo); 
			}*/

			$periodo_remuneracion = $this->rrhh_model->get_periodos_remuneracion_abiertos($idperiodo); 
			/*$estado = "Informaci&oacute;n Completa";
			foreach ($datos_remuneracion as $remuneracion) {
				if(is_null($remuneracion->diastrabajo) || 
				   is_null($remuneracion->horasdescuento) || 
				   is_null($remuneracion->montodescuento) || 
				   is_null($remuneracion->horasextras50) || 
				   is_null($remuneracion->montohorasextras50) || 
				   is_null($remuneracion->horasextras100) || 
				   is_null($remuneracion->montohorasextras100) || 
				   (is_null($remuneracion->anticipo) && is_null($periodo_remuneracion->anticipo)) || 
				   is_null($remuneracion->aguinaldo) && is_null($periodo_remuneracion->anticipo)){
                   $estado = "Falta Informaci&oacute;n";
               	   break;
				}
			}			
		*/

			//if($estado == 'Falta Informaci&oacute;n'){ // no permite calcular remuneraciones
			//	$this->session->set_flashdata('calculo_remuneraciones_result', 2);
			//	

			//}else{
				 $this->rrhh_model->calcular_remuneraciones($idperiodo,$centro_costo); 
				 $this->session->set_flashdata('calculo_remuneraciones_result', 1);

			//}
			redirect('rrhh/calculo_remuneraciones');	

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


	public function get_detalle_rrhh($idcentrocosto = null){

		$idcentrocosto = $idcentrocosto == '0' ? null : $idcentrocosto;
		$datosperiodo = $this->rrhh_model->get_periodos_cerrados($this->session->userdata('empresaid'),null,$idcentrocosto);


		
		$contenido ='<table class="table"> 
						<thead> 
							<tr>
								<th>#</th>
								<th>Mes</th> 
								<th>A&ntilde;o</th> 
								<th>N&uacute;mero Trabajadores</th>
								<th>Remuneraci&oacute;n Total (L&iacute;quido)</th>
								<th>Detalle Remuneraciones</th>
								<th>Libro Remuneraciones</th>
								<th>Estado</th>
							</tr> 
						</thead> 
						<tbody>'; 
							$i = 1; 
							$back_button = false;
											                        
							if(count($datosperiodo) > 0){
								foreach ($datosperiodo as $periodo) { 
									$class_aprueba = is_null($periodo->aprueba) ? 'text-yellow fa fa-exclamation ' : 'text-green fa fa-check';
									$class_texto = is_null($periodo->aprueba) ? 'En revisi&oacute;n' : 'Aprobada';
									$mes_texto = date2string($periodo->mes,$periodo->anno) == 'Saldo Inicial' ? 'Saldo' : month2string($periodo->mes);
									$anno_texto = date2string($periodo->mes,$periodo->anno) == 'Saldo Inicial' ? 'Inicial' : $periodo->anno;
									$class_color = "";
									$contenido .= '<tr ' . $class_color. ' >
									<td>' . $i . '</td>
									<td>' . $mes_texto . '</td>
									<td>' .  $anno_texto  . '</td>
									<td>' . number_format($periodo->numtrabajadores,0,".",".") . '</td>
									<td>$&nbsp;' . number_format($periodo->sueldoliquido,0,".",".") . '</td>
									<td><center>';
										if(!is_null($periodo->cierre)){ 
											$contenido .= '<a href="' . base_url(). 'rrhh/ver_remuneraciones_periodo/' . $periodo->id_periodo  . '/' . $idcentrocosto . '" data-toggle="tooltip" title="Ver Remuneraciones Personal"><span class="glyphicon glyphicon-search"></span></a>';
										}
										$contenido .= '</center>
									</td>
									<td><center>';
										if(!is_null($periodo->cierre)){
											$contenido .= '<a href="' . base_url(). 'rrhh/libro/' . $periodo->id_periodo . '/' . $idcentrocosto . '" target="_blank"><span class="glyphicon glyphicon-book"></span></a>';
										}
										$contenido .= '</center>
									</td>  
									<td><span class="' . $class_aprueba . '" data-toggle="tooltip" title="' . $class_texto . '"/></span></td>                        
								</tr>';
								$i++; } 
								}else{ 
									$contenido .= '<tr>
										<td colspan="9">No existe historial de remuneraciones en la comunidad</td>
									</tr>';
								} 
								$contenido .= '</tbody> 
					</table> ';

		echo $contenido;



	}



	public function detalle($idperiodo = null)
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){



			$idcentrocosto = $this->input->post('centrocosto');



			$datosperiodo = $this->rrhh_model->get_periodos_cerrados($this->session->userdata('empresaid'),null,$idcentrocosto);
			$centros_costo = $this->rrhh_model->get_centro_costo();


			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Detalle Remuneraciones');

			
			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'remuneraciones/detalle';
			$vars['datosperiodo'] = $datosperiodo;
			$vars['centros_costo'] = $centros_costo;
			$vars['idperiodo'] = $idperiodo;
			$vars['idcentrocosto'] = $idcentrocosto;

			$vars['datatable'] = true;
			//$vars['dataTables'] = true;
			
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



	public function libro($idperiodo = null,$idcentrocosto = null)
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			set_time_limit(0);

			$periodo = $this->rrhh_model->get_periodos($this->session->userdata('empresaid'),$idperiodo);
			
			if(is_null($periodo->cierre)){
				redirect('main/dashboard/');
			}else{
				$remuneraciones = $this->rrhh_model->get_remuneraciones_by_periodo($idperiodo,true,$idcentrocosto);
				if(count($remuneraciones) == 0){ // SI NO ENCUENTRO NINGUNA REMUNERACION (QUIERE DECIR QUE NO EXISTIAN TRABAJADORES EN ESE PERIODO)
					redirect('main/dashboard/');
				}else{
					$datosdetalle = $this->rrhh_model->libro($remuneraciones);
				}

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


public function previred($idperiodo = null)
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			set_time_limit(0);

			$periodo = $this->rrhh_model->get_periodos($this->session->userdata('empresaid'),$idperiodo);
			
			if(is_null($periodo->cierre)){
				redirect('main/dashboard/');
			}else{
				$remuneraciones = $this->rrhh_model->get_remuneraciones_by_periodo($idperiodo,true);
				if(count($remuneraciones) == 0){ // SI NO ENCUENTRO NINGUNA REMUNERACION (QUIERE DECIR QUE NO EXISTIAN TRABAJADORES EN ESE PERIODO)
					redirect('main/dashboard/');
				}else{
					$datosdetalle = $this->rrhh_model->previred($remuneraciones);
				}

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



	public function ver_remuneraciones_periodo($idperiodo = '',$idcentrocosto = null)
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$remuneraciones = $this->rrhh_model->get_remuneraciones_by_periodo($idperiodo,null,$idcentrocosto);
			$datosperiodo = $this->rrhh_model->get_periodos($this->session->userdata('empresaid'),$idperiodo);

			$content = array(
						'menu' => 'Ver',
						'title' => 'Ver',
						'subtitle' => 'Propiedades');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'remuneraciones/ver_remuneraciones_periodo';
			$vars['remuneraciones'] = $remuneraciones;
			$vars['datosperiodo'] = $datosperiodo;

			$vars['datatable'] = true;
			
			
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


	public function liquidacion($idremuneracion = null)
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$remuneracion = $this->rrhh_model->get_remuneraciones_by_id($idremuneracion);

			if(count($remuneracion) == 0){ // SI NO ENCUENTRO NINGUNA REMUNERACION (CORRESPONDE A OTRA COMUNIDAD POR EJEMPLO)
				redirect('main/dashboard/');
			}else if(is_null($remuneracion->cierre)){
				redirect('main/dashboard/'); // SI NO ES UN PERIODO CERRADO, SE ENVÍA AL DASHBOARD
			}else{
				//$datamensaje['mensaje'] = "BORRADOR";
				$datosdetalle = $this->rrhh_model->liquidacion($remuneracion);
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




	public function aprueba_remuneraciones($idperiodo){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			$publicar = $this->rrhh_model->aprobar_remuneracion($idperiodo);

			$this->session->set_flashdata('calculo_remuneraciones_result', 3);
			redirect('rrhh/calculo_remuneraciones');	
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


	public function rechaza_remuneraciones($idperiodo){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			set_time_limit(0);
			$publicar = $this->rrhh_model->rechazar_remuneracion($idperiodo);

			$this->session->set_flashdata('calculo_remuneraciones_result', 4);
			redirect('rrhh/calculo_remuneraciones');	
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



	public function asistencia($resultid = '')
	{
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){


			$resultid = $this->session->flashdata('asistencia_result');
			if($resultid == 1){
				$vars['message'] = "Asistencia agregada correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}elseif($resultid == 2){
				$vars['message'] = "Error al agregar asistencia";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}

			//$this->load->model('admin');
			//$comunidad = $this->admin->get_comunidades($this->session->userdata('comunidadid')); 

			$mes = $this->session->flashdata('asistencia_mes') == '' ? date('m') : $this->session->flashdata('asistencia_mes');
			$anno = $this->session->flashdata('asistencia_anno') == '' ? date('Y') : $this->session->flashdata('asistencia_anno');



			$personal = $this->rrhh_model->get_personal(); 
			$datos_remuneracion = $this->rrhh_model->get_datos_remuneracion($mes,$anno); 

			$array_remuneracion_trabajador = array();
			foreach ($datos_remuneracion as $remuneracion) {
				$array_remuneracion_trabajador[$remuneracion->idpersonal] = $remuneracion->diastrabajo;
			}


			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Asistencia');

			$vars['content_menu'] = $content;				
			$vars['personal'] = $personal;	
			$vars['datos_remuneracion'] = $array_remuneracion_trabajador;	
			$vars['mes'] = $mes;	
			$vars['anno'] = $anno;	
			$vars['content_view'] = 'rrhh/asistencia';
			$vars['formValidation'] = true;

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


	public function horas_extraordinarias($resultid = '')
	{
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){


			$resultid = $this->session->flashdata('horas_extraordinarias_result');
			if($resultid == 1){
				$vars['message'] = "Horas Extraordinarias agregadas correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}elseif($resultid == 2){
				$vars['message'] = "Error al agregar Horas Extraordinarias";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}

			//$this->load->model('admin');
			//$comunidad = $this->admin->get_comunidades($this->session->userdata('comunidadid')); 

			$mes = $this->session->flashdata('horas_extraordinarias_mes') == '' ? date('m') : $this->session->flashdata('horas_extraordinarias_mes');
			$anno = $this->session->flashdata('horas_extraordinarias_anno') == '' ? date('Y') : $this->session->flashdata('horas_extraordinarias_anno');



			$personal = $this->rrhh_model->get_personal(); 

			$datos_remuneracion = $this->rrhh_model->get_datos_remuneracion($mes,$anno); 
			$array_remuneracion_trabajador = array();
			foreach ($datos_remuneracion as $remuneracion) {
				$array_remuneracion_trabajador['horasextras50'][$remuneracion->idpersonal] = $remuneracion->horasextras50;
				$array_remuneracion_trabajador['montohorasextras50'][$remuneracion->idpersonal] = $remuneracion->montohorasextras50;

				$array_remuneracion_trabajador['horasextras100'][$remuneracion->idpersonal] = $remuneracion->horasextras100;
				$array_remuneracion_trabajador['montohorasextras100'][$remuneracion->idpersonal] = $remuneracion->montohorasextras100;
			}

			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Horas Extraordinarias');

			$vars['content_menu'] = $content;				
			$vars['personal'] = $personal;	
			$vars['datos_remuneracion'] = $array_remuneracion_trabajador;	
			$vars['mes'] = $mes;	
			$vars['anno'] = $anno;	
			$vars['content_view'] = 'rrhh/horas_extraordinarias';
			$vars['formValidation'] = true;
			$vars['maleta'] = true;	
			$vars['mask'] = true;

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


	public function get_status_rem($tipo_status,$mes,$anno){

		$estado_periodo = $this->rrhh_model->get_estado_periodo($mes,$anno);

		//OPCIONES:  ES NUEVO, YA SE CREO, YA ESTÁ CERRADO

		if($estado_periodo == 2){ // NO EXISTE, ES NUEVO
			if($tipo_status == 'calculo'){
				$array_result['label_style'] = 'label-primary';
				$array_result['label_text'] = 'Per&iacute;odo en condiciones de calcular';
				$array_result['status'] = 'nuevo';	
			}else{
				$array_result['label_style'] = 'label-primary';
				$array_result['label_text'] = 'Per&iacute;odo Nuevo (sin datos)';
				$array_result['status'] = 'nuevo';				
			}

		}else if($estado_periodo == 0){ // NO EXISTE, ES NUEVO
			$array_result['label_style'] = 'label-danger';
			$array_result['label_text'] = 'Per&iacute;odo Cerrado';			
			$array_result['status'] = 'cerrado';
		}else{
			if($tipo_status == 'calculo'){
				$array_result['label_style'] = 'label-primary';
				$array_result['label_text'] = 'Per&iacute;odo en condiciones de calcular';
				$array_result['status'] = 'nuevo';					
			}else{

				$datos_pendientes = false;
				$personal = $this->rrhh_model->get_personal(); 
				foreach ($personal as $trabajador) {
					$datos_remuneracion = $this->rrhh_model->get_datos_remuneracion($mes,$anno,$trabajador->id_personal); 
					if(count($datos_remuneracion) == 0){
	                   $datos_pendientes = true;
	               	   break;
					}else{
						if($tipo_status == 'asistencia'){
						 if(is_null($datos_remuneracion->diastrabajo)){
		                   $datos_pendientes = true;
		               	   break;
		               	  }
		               	}else if($tipo_status == 'horas_descuentos'){
						 if(is_null($datos_remuneracion->horasdescuento) || 
							   is_null($datos_remuneracion->montodescuento)){
		                   $datos_pendientes = true;
		               	   break;
		               	  }	               		
		               	}else if($tipo_status == 'horas_extraordinarias'){
						 if(is_null($datos_remuneracion->horasextras50) || 
							   is_null($datos_remuneracion->montohorasextras50) || 
							   is_null($datos_remuneracion->horasextras100) || 
							   is_null($datos_remuneracion->montohorasextras100)){
		                   $datos_pendientes = true;
		               	   break;
		               	  }	 

		               	}else if($tipo_status == 'anticipos'){
						 if(is_null($datos_remuneracion->anticipo) || 
							   is_null($datos_remuneracion->aguinaldo)){
		                   $datos_pendientes = true;
		               	   break;
		               	  }	 


		               	}
					}
				}

				if($datos_pendientes){
					$array_result['label_style'] = 'label-warning';
					$array_result['label_text'] = 'Per&iacute;odo con datos pendientes ';
					$array_result['status'] = 'pendiente';
				}else{

					if($tipo_status == 'anticipos'){
						if($estado_periodo == 1){
							$array_result['label_style'] = 'label-success';
							$array_result['label_text'] = 'Datos ingresados (puede editar informaci&oacute;n)';
							$array_result['status'] = 'ingresado';
						}else{
							$array_result['label_style'] = 'label-danger';
							$array_result['label_text'] = 'Datos de Anticipo ya traspasados';			
							$array_result['status'] = 'cerrado';
						}


					}else{
						$array_result['label_style'] = 'label-success';
						$array_result['label_text'] = 'Datos ingresados (puede editar informaci&oacute;n)';
						$array_result['status'] = 'ingresado';
					}

				}
			}

		}


		$array_result['estado'] = $estado_periodo;

		echo json_encode($array_result);
	}	

	public function estado_periodo($tipo_status = null){

		$this->load->model('admin');

		//NO SE CONSIDERARÁ AÚN EL PERÍODO DE INICIO
		//$valid = $this->admin->get_permite_periodo($this->input->post('mes'),$this->input->post('anno'));
		$valid = true;
		if($valid){
			$estado_periodo = $this->rrhh_model->get_estado_periodo($this->input->post('mes'),$this->input->post('anno'));


			if(is_null($tipo_status)){
				$valid = $estado_periodo == 1 || $estado_periodo == 2 || $estado_periodo == 3 ? true : false;
			}else{
				$valid = $estado_periodo == 1 || $estado_periodo == 2 ? true : false;
			}
		}


		echo json_encode(array(
		    'valid' => $valid
		));
	}	


	public function submit_asistencia(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$mes = $this->input->post('mes');
			$anno = $this->input->post('anno');

			//if($mes == '' || $anno == ''){
			if(empty($mes) && empty($anno)){
				$this->session->set_flashdata('asistencia_result', 2);
				redirect('rrhh/asistencia');	
			}


			$array_elem = $this->input->post(NULL,true);
			$array_trabajadores = array();
			foreach($array_elem as $elem => $value_elem){
				$arr_el = explode("_",$elem);
				if($arr_el[0] == 'diastrabajo'){
					$array_trabajadores[$arr_el[1]] = $value_elem;
				}
			}

			$this->rrhh_model->save_asistencia($array_trabajadores,$mes,$anno);

			$this->session->set_flashdata('asistencia_result', 1);
			$this->session->set_flashdata('asistencia_mes', $mes);
			$this->session->set_flashdata('asistencia_anno', $anno);
			redirect('rrhh/asistencia');	


		}else{
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}		


	}	


	public function submit_horas_extraordinarias(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$mes = $this->input->post('mes');
			$anno = $this->input->post('anno');

			//if($mes == '' || $anno == ''){
			if(empty($mes) && empty($anno)){	
				$this->session->set_flashdata('horas_extraordinarias_result', 2);
				redirect('rrhh/horas_extraordinarias');	
			}


			$array_elem = $this->input->post(NULL,true);
			$array_trabajadores = array();
			foreach($array_elem as $elem => $value_elem){
				$arr_el = explode("_",$elem);
				if($arr_el[0] == 'horas50'){
					$array_trabajadores[$arr_el[1]]['horas50'] = $value_elem;
				}

				if($arr_el[0] == 'monto50'){
					$array_trabajadores[$arr_el[1]]['monto50'] = $value_elem;
				}

				if($arr_el[0] == 'horas100'){
					$array_trabajadores[$arr_el[1]]['horas100'] = $value_elem;
				}

				if($arr_el[0] == 'monto100'){
					$array_trabajadores[$arr_el[1]]['monto100'] = $value_elem;
				}				
			}


			$this->rrhh_model->save_horas_extraordinarias($array_trabajadores,$mes,$anno);

			$this->session->set_flashdata('horas_extraordinarias_result', 1);
			$this->session->set_flashdata('horas_extraordinarias_mes', $mes);
			$this->session->set_flashdata('horas_extraordinarias_anno', $anno);
			redirect('rrhh/horas_extraordinarias');	


		}else{
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}		


	}	


public function prueba(){
	//if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			$mes = $this->input->post('mes');
			$anno = $this->input->post('anno');
			$centro_costo = $this->input->post('centro_costo');
			
			var_dump($this->rrhh_model->get_personal(null,$centro_costo));
			
			$data['titulo'] = $centro_costo;
			$this->load->view('rrhh/prueba',$data);
	//}else{
		
		/*$vars['content_view'] = 'rrhh/prueba';
		$this->load->view('template',$vars);
		$data['titulo'] = $centros_costo;
		$this->load->view('rrhh/prueba',$data);*/
		/*$data['titulo'] = 'hola';
		$this->load->view('rrhh/prueba',$data);
	}*/
}
}