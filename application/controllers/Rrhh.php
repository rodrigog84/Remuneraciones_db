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

   public function finiquitos(){
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
			}
			$this->load->model('admin');
			$empresa = $this->admin->get_empresas($this->session->userdata('empresaid')); 


			$this->load->model('admin');
			$personal = $this->admin->get_personal_total(); 
			
			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Personal');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'rrhh/finiquitos_personal';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['formValidation'] = true;
			$vars['gritter'] = true;

			$vars['empresa'] = $empresa;
			$vars['personal'] = $personal;
			
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


	public function index()
	{

		$this->load->model('ion_auth_model');
		redirect('main/dashboard');	
	}

	public function exportarExcelasistencia(){
            	
            header("Content-type: application/vnd.ms-excel"); 
            header("Content-disposition: attachment; filename=asistencia.xls"); 
            
            $personal = $this->rrhh_model->get_personal();

            echo '<table>';
            echo "<tr>";
                echo "<td>RUT</td>";               
                echo "<td>DV</td>";
                echo "<td>NOMBRES</td>";
                echo "<td>DIAS</td>";
                echo "<td>MES</td>";
                echo "<td>ANO</td>";   
              echo "</tr>";

                          
              foreach($personal as $v){
              	 echo "<tr>";
                 echo "<td>".$v->rut."</td>";
                 echo "<td>".$v->dv."</td>";
                 echo "<td>".$v->nombre." ".$v->apaterno." ".$v->amaterno."</td>";
                 echo "</tr>";
               }	
         echo '</table>';
         exit;

    }

    public function exportarExcelpersonal(){
            	
            header("Content-type: application/vnd.ms-excel"); 
            header("Content-disposition: attachment; filename=personal.xls"); 
            
            $personal = $this->rrhh_model->get_personal();

            echo '<table>';
            echo "<tr>";
                echo "<td>ID EMPRESA</td>"; 
                echo "<td>RUT</td>";               
                echo "<td>DV</td>";
                echo "<td>NOMBRES</td>";
                echo "<td>A PATERNO</td>";
                echo "<td>A MATERNO</td>";
                echo "<td>FECHA NACIMIENTO</td>";
                echo "<td>SEXO</td>";   
                echo "<td>IDCIVIL</td>";
                echo "<td>NACIONALIDAD</td>";
                echo "<td>DIRECCION</td>";
                echo "<td>ID REGION</td>";
                echo "<td>ID COMUNA</td>";
                echo "<td>FONO</td>";
                echo "<td>E MAIL</td>";
                echo "<td>FCHA INGRESO</td>";
                echo "<td>ID CARGO</td>";
                echo "<td>FECHA INIC. VACACIONES</td>";
                echo "<td>SALDO INIC. VACACIONES</td>";
                echo "<td>SALDO INIC. VAC. PROGRESIVAS</td>";
                echo "<td>DIAS PROGRESIVOS</td>";
                echo "<td>DIAS VACAC. TOMADOS</td>";
                echo "<td>DIAS PROG. TOMADOS</td>";
                echo "<td>TIPO CONTRATO</td>";
                echo "<td>PARTTIME</td>";
                echo "<td>SEG. CESANTIA</td>";
                echo "<td>FECAFC</td>";
                echo "<td>DIAS TRABAJO</td>";
                echo "<td>HORAS DIARIAS</td>";
                echo "<td>HORAS SEMANALES</td>";
                echo "<td>SUELDO BASE</td>";
                echo "<td>TIPO GRATIFICACION</td>";
                echo "<td>GRATIFICACION</td>";
                echo "<td>ASIG. FAMILIAR</td>";
                echo "<td>CARGAS SIMPLES</td>";
                echo "<td>CARGAS INVALIDAS</td>";
                echo "<td>CARGAS MATERNALES</td>";
                echo "<td>CARGAS RETROACTIVAS</td>";
                echo "<td>ID ASIG. FAMILIAR</td>";
                echo "<td>MOVILIZACION</td>";
                echo "<td>COLACION</td>";
                echo "<td>PENSIONADO</td>";
                echo "<td>ID AFP</td>";
                echo "<td>ADIC.AFP</td>";
                echo "<td>TIPO AHORR. VOL.</td>";
                echo "<td>AHORRO VOL.</td>";
                echo "<td>INST. APV</td>";
                echo "<td>NRO. CONTRATO APV</td>";
                echo "<td>TIPO COTIZ.APV</td>";
                echo "<td>COTIZ. APV</td>";
                echo "<td>FORMA PAGO APV</td>";
                echo "<td>DEP. CONV. APV</td>";
                echo "<td>ID ISAPRE</td>";
                echo "<td>VALOR PACTADO</td>";
                echo "<td>ACTIVE</td>";
                echo "<td>FECHA CREACION</td>";
                echo "<td>FECHA ACTUALIZACION</td>";
                echo "<td>NUM. FICHA</td>";
                echo "<td>ID NACIONALIDAD</td>";
                echo "<td>TIPO RENTA</td>";
                echo "<td>ID ESTUDIO</td>";
                echo "<td>TITULO</td>";
                echo "<td>ID IDIOMA</td>";
                echo "<td>ID JEFE</td>";
                echo "<td>ID LICENCIA</td>";
                echo "<td>TIPO DOCUMENTO</td>";
                echo "<td>TALLA POLERA</td>";
                echo "<td>TALLA PANTALON</td>";
                echo "<td>ID CENTRO COSTO</td>";
                echo "<td>C. BENEFICIO</td>";
                echo "<td>ID REEMPLAZO</td>";
                echo "<td>FECHA MODIFICACION</td>";
                echo "<td>ID BANCO</td>";
                echo "<td>NRO CTA BANCO</td>";
                echo "<td>SEMANA CORRIDA</td>";
                echo "<td>ID CATEGORIA</td>";
                echo "<td>ID LUGAR PAGO</td>";
                echo "<td>SINDICATO</td>";
                echo "<td>ROL PRIVADO</td>";
                echo "<td>JUBILADO</td>";
                echo "<td>FECHA AFP</td>";
                echo "<td>ID FORMA DE PAGO</td>";
                echo "<td>FECHA RETIRO</td>";
                echo "<td>FECHA FINIQUITO</td>";
                echo "<td>ID MOTIVO EGRESO</td>";
                echo "<td>ID TIPO CC</td>";
                echo "<td>ID SECCION</td>";
                echo "<td>ID SITUACION</td>";
                echo "<td>ID CLASE</td>";
                echo "<td>ID INE</td>";
                echo "<td>ID ZONA</td>";
                echo "<td>FECHA REAL CONTRATO</td>";
                echo "<td>PRIMER VENCIMIENTO</td>";
                echo "<td>FUN</td>";
                echo "<td>FECHA VENC. PLAN</td>";
                echo "<td>FECHA APVC</td>";
                echo "<td>FECHA TERM SUBSIDIO</td>";
                echo "<td>RUT PAGO</td>";
                echo "<td>DEVOLUC. PAGO</td>";
                echo "<td>NOMBRE PAGO</td>";
                echo "<td>EMAIL PAGO</td>";
                echo "<td>USUARIO WINDOWS</td>";
                echo "<td>REGIMEN APV</td>";
                echo "<td>TRABAJO PESADO</td>";
                echo "<td>PLAZO CONTRATO</td>";
                echo "<td>ID PLANTILLA BANCO</td>";
                echo "<td>ID TIPO CTA BANCARIA</td>";                
              echo "</tr>";

                          
             /* foreach($personal as $v){
              	 echo "<tr>";
                 echo "<td>".$v->rut."</td>";
                 echo "<td>".$v->dv."</td>";
                 echo "<td>".$v->nombre." ".$v->apaterno." ".$v->amaterno."</td>";
                 echo "</tr>";
               }	*/
         echo '</table>';
         exit;

    }


    public function exportarExcelanticipos(){
            	
            header("Content-type: application/vnd.ms-excel"); 
            header("Content-disposition: attachment; filename=anticipos.xls"); 
            
            $personal = $this->rrhh_model->get_personal();

            echo '<table>';
            echo "<tr>";
                echo "<td>RUT</td>";               
                echo "<td>DV</td>";
                echo "<td>NOMBRE</td>";
                echo "<td>ANTICIPOS</td>";
                echo "<td>AGUINALDO</td>";
                echo "<td>MES</td>";
                echo "<td>ANO</td>";   
              echo "</tr>";
              
              foreach($personal as $v){
              	echo "<tr>";
                 echo "<td>".$v->rut."</td>";
                 echo "<td>".$v->dv."</td>";
                 echo "<td>".$v->nombre." ".$v->apaterno." ".$v->amaterno."</td>";
                 echo "</tr>";
               }	
         echo '</table>';
         exit;

    }

    public function exportarExcelhorasextras(){
            	
            header("Content-type: application/vnd.ms-excel"); 
            header("Content-disposition: attachment; filename=horasextras.xls"); 
            
            $personal = $this->rrhh_model->get_personal();

            echo '<table>';
            echo "<tr>";
                echo "<td>RUT</td>";               
                echo "<td>DV</td>";
                echo "<td>NOMBRE</td>";
                echo "<td>HORAS 100%</td>";
                echo "<td>HORAS 50%</td>";
                echo "<td>MES</td>";
                echo "<td>ANO</td>";   
              echo "</tr>";
              
              foreach($personal as $v){
              	echo "<tr>";
                 echo "<td>".$v->rut."</td>";
                 echo "<td>".$v->dv."</td>";
                 echo "<td>".$v->nombre." ".$v->apaterno." ".$v->amaterno."</td>";
                 echo "</tr>";
               }	
         echo '</table>';
         exit;

    }

    public function exportarHaberesDescto(){
            	
            header("Content-type: application/vnd.ms-excel"); 
            header("Content-disposition: attachment; filename=haberesdescuentos.xls"); 
            
            $personal = $this->rrhh_model->get_personal();

            echo '<table>';
            echo "<tr>";
                echo "<td>RUT</td>";               
                echo "<td>DV</td>";
                echo "<td>NOMBRE</td>";
                echo "<td>CODIGO HAB/DESC</td>";
                echo "<td>MONTO</td>";
                echo "<td>MES</td>";
                echo "<td>ANO</td>";   
              echo "</tr>";
              
              foreach($personal as $v){
              	echo "<tr>";
                 echo "<td>".$v->rut."</td>";
                 echo "<td>".$v->dv."</td>";
                 echo "<td>".$v->nombre." ".$v->apaterno." ".$v->amaterno."</td>";
                 echo "</tr>";
               }	
         echo '</table>';
         exit;

    }




	public function get_cot_obligatoria($idafp){

		$this->load->model('admin');
		$afp = $this->admin->get_afp($idafp);
		echo json_encode($afp);

	}	



public function submit_personal_data(){
    if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

      $array_elem = $this->input->post(NULL,true);
      //var_dump_new($array_elem); exit;
      $array_trabajadores = array();
      foreach($array_elem as $elem => $value_elem){
        $arr_el = explode("_",$elem);
        if($arr_el[0] == 'cargo' || $arr_el[0] == 'centrocosto'){
          $array_trabajadores[$arr_el[1]][$arr_el[0]] = $value_elem;
        }
      }


      $this->load->model('rrhh_model');
      $this->rrhh_model->update_personal_data($array_trabajadores);

      $this->session->set_flashdata('personal_result', 10);
      redirect('rrhh/mantencion_personal'); 


    }else{
      $vars['content_view'] = 'forbidden';
      $this->load->view('template',$vars);

    }   


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

			$this->load->model('rrhh_model');
			$this->rrhh_model->update_personal_leyes_sociales($array_trabajadores);

			$this->session->set_flashdata('personal_result', 3);
			redirect('rrhh/mantencion_personal');	


		}else{
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}		


	}	

	public function submit_personal_apv(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$array_elem = $this->input->post(NULL,true);

			$array_trabajadores = array();
			foreach($array_elem as $elem => $value_elem){
				$arr_el = explode("_",$elem);
				if($arr_el[0] == 'instapv'  || $arr_el[0] == 'nrocontratoapv'  || $arr_el[0] == 'formapagoapv'  || $arr_el[0] == 'depconvapv'  || $arr_el[0] == 'tipoapv'  || $arr_el[0] == 'apv'){
					$array_trabajadores[$arr_el[1]][$arr_el[0]] = $value_elem;
				}
			}

			$this->load->model('rrhh_model');
			$this->rrhh_model->update_personal_apv($array_trabajadores);

			$this->session->set_flashdata('personal_result', 7);
			redirect('rrhh/mantencion_personal');	


		}else{
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}		


	}


public function submit_salud(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$array_elem = $this->input->post(NULL,true);
			$array_trabajadores = array();
			foreach($array_elem as $elem => $value_elem){
				$arr_el = explode("_",$elem);
				if($arr_el[0] == 'isapre' || $arr_el[0] == 'pactado'){
					$array_trabajadores[$arr_el[1]][$arr_el[0]] = $value_elem;
				}
			}

			$this->load->model('rrhh_model');
			$this->rrhh_model->update_personal_salud($array_trabajadores);

			$this->session->set_flashdata('personal_result', 4);
			redirect('rrhh/mantencion_personal');	


		}else{
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}		


	}		



	public function mantencion_personal(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$vars['mantencion_personal'] = 'active';			
      $vars['ccostocargo'] = ''; 	
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
        $vars['ccostocargo'] = '';    		
				$vars['leyes_sociales'] = '';		
				$vars['apv'] = '';		
				$vars['salud'] = '';		
				$vars['otros'] = '';	
			}elseif($resultid == 2){
				$vars['message'] = "Error al agregar Trabajador. Trabajador ya existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
				$vars['mantencion_personal'] = 'active';	
        $vars['ccostocargo'] = '';   			
				$vars['leyes_sociales'] = '';		
				$vars['apv'] = '';		
				$vars['salud'] = '';
				$vars['otros'] = '';							
			}elseif($resultid == 3){
				$vars['message'] = "Leyes sociales actualizadas correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';
				$vars['mantencion_personal'] = '';	
        $vars['ccostocargo'] = '';   			
				$vars['apv'] = '';		
				$vars['leyes_sociales'] = 'active';		
				$vars['salud'] = '';	
				$vars['otros'] = '';						
			}elseif($resultid == 4){
				$vars['message'] = "Datos de Cotizaciones de Salud actualizados correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';	
				$vars['mantencion_personal'] = '';		
        $vars['ccostocargo'] = '';   		
				$vars['apv'] = '';		
				$vars['leyes_sociales'] = '';		
				$vars['salud'] = 'active';							
				$vars['otros'] = '';	
			}elseif($resultid == 5){
				$vars['message'] = "Mutual de Seguridad/Caja de Compensaci&oacute;n actualizados correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
				$vars['mantencion_personal'] = '';		
        $vars['ccostocargo'] = '';   		
				$vars['apv'] = '';		
				$vars['leyes_sociales'] = '';		
				$vars['salud'] = '';							
				$vars['otros'] = 'active';											
			}elseif($resultid == 6){
				$vars['message'] = "Trabajador Editado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
				$vars['mantencion_personal'] = 'active';		
        $vars['ccostocargo'] = '';   		
				$vars['apv'] = '';		
				$vars['leyes_sociales'] = '';		
				$vars['salud'] = '';	
				$vars['otros'] = '';							
			}elseif($resultid == 7){
				$vars['message'] = "A.P.V. Editado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
				$vars['mantencion_personal'] = '';			
        $vars['ccostocargo'] = '';   	
				$vars['apv'] = 'active';		
				$vars['leyes_sociales'] = '';		
				$vars['salud'] = '';	
				$vars['otros'] = '';							
			}elseif($resultid == 8){
				$vars['message'] = "Colaboradores Cargados correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}elseif($resultid == 9){
        $vars['message'] = "Carga Masiva realizada correctamente";
        $vars['classmessage'] = 'success';
        $vars['icon'] = 'fa-check'; 
        $vars['mantencion_personal'] = 'active';    
        $vars['ccostocargo'] = '';       
        $vars['apv'] = '';    
        $vars['leyes_sociales'] = '';   
        $vars['salud'] = '';              
        $vars['otros'] = '';  
      }elseif($resultid == 10){
        $vars['message'] = "Datos del Trabajador actualizados correctamente";
        $vars['classmessage'] = 'success';
        $vars['icon'] = 'fa-check'; 
        $vars['mantencion_personal'] = '';   
        $vars['ccostocargo'] = 'active';        
        $vars['apv'] = '';    
        $vars['leyes_sociales'] = '';   
        $vars['salud'] = '';              
        $vars['otros'] = '';  
       }elseif($resultid == 11){
        $vars['message'] = "Error al imprimir liquidac&oacute;n. Debe seleccionar colaborador";
        $vars['classmessage'] = 'danger';
        $vars['icon'] = 'fa-ban';
        $vars['mantencion_personal'] = 'active';  
        $vars['ccostocargo'] = '';        
        $vars['leyes_sociales'] = '';   
        $vars['apv'] = '';    
        $vars['salud'] = '';
        $vars['otros'] = '';              
      }elseif($resultid == 12){
        $vars['message'] = "Error al imprimir liquidac&oacute;n. No existen liquidaciones para el colaborador seleccionado";
        $vars['classmessage'] = 'danger';
        $vars['icon'] = 'fa-ban';
        $vars['mantencion_personal'] = 'active';  
        $vars['ccostocargo'] = '';        
        $vars['leyes_sociales'] = '';   
        $vars['apv'] = '';    
        $vars['salud'] = '';
        $vars['otros'] = '';              
      }elseif($resultid == 13){
        $vars['message'] = "Error al ver informaci&oacute;n hist&oacute;rica. Debe seleccionar colaborador";
        $vars['classmessage'] = 'danger';
        $vars['icon'] = 'fa-ban';
        $vars['mantencion_personal'] = 'active';  
        $vars['ccostocargo'] = '';        
        $vars['leyes_sociales'] = '';   
        $vars['apv'] = '';    
        $vars['salud'] = '';
        $vars['otros'] = '';             
      }elseif($resultid == 14){
        $vars['message'] = "Error al ver informaci&oacute;n hist&oacute;rica. No existe colaborador";
        $vars['classmessage'] = 'danger';
        $vars['icon'] = 'fa-ban';
        $vars['mantencion_personal'] = 'active';  
        $vars['ccostocargo'] = '';        
        $vars['leyes_sociales'] = '';   
        $vars['apv'] = '';    
        $vars['salud'] = '';
        $vars['otros'] = '';             
      }elseif($resultid == 15){
        $vars['message'] = "Error al ver Licencias. Debe seleccionar colaborador";
        $vars['classmessage'] = 'danger';
        $vars['icon'] = 'fa-ban';
        $vars['mantencion_personal'] = 'active';  
        $vars['ccostocargo'] = '';        
        $vars['leyes_sociales'] = '';   
        $vars['apv'] = '';    
        $vars['salud'] = '';
        $vars['otros'] = '';             
      }elseif($resultid == 16){
        $vars['message'] = "Error al ver Licencias. No existe colaborador";
        $vars['classmessage'] = 'danger';
        $vars['icon'] = 'fa-ban';
        $vars['mantencion_personal'] = 'active';  
        $vars['ccostocargo'] = '';        
        $vars['leyes_sociales'] = '';   
        $vars['apv'] = '';    
        $vars['salud'] = '';
        $vars['otros'] = '';             
      }elseif($resultid == 17){
        $vars['message'] = "Error al editar colaborador. Debe seleccionar colaborador";
        $vars['classmessage'] = 'danger';
        $vars['icon'] = 'fa-ban';
        $vars['mantencion_personal'] = 'active';  
        $vars['ccostocargo'] = '';        
        $vars['leyes_sociales'] = '';   
        $vars['apv'] = '';    
        $vars['salud'] = '';
        $vars['otros'] = '';              
      }elseif($resultid == 18){
        $vars['message'] = "Error al editar colaborador. Colaborador no existe";
        $vars['classmessage'] = 'danger';
        $vars['icon'] = 'fa-ban';
        $vars['mantencion_personal'] = 'active';  
        $vars['ccostocargo'] = '';        
        $vars['leyes_sociales'] = '';   
        $vars['apv'] = '';    
        $vars['salud'] = '';
        $vars['otros'] = '';              
      }

			$this->load->model('admin');
			
			$empresa = $this->admin->get_empresas($this->session->userdata('empresaid')); 


			
			//$personal = $this->admin->get_personal_total(); 
			$personal = $this->admin->get_cargo_colaborador(null,true);
			$afps = $this->admin->get_afp(); 
			$apvs = $this->admin->get_apv(); 
			$isapres = $this->admin->get_isapre(); 

      $cargos = $this->admin->get_cargos_empresa();
      $centros_costo = $this->admin->get_centro_costo();

      //var_dump_new($personal); exit;
			//$cajas = $this->admin->get_cajas_compensacion(); 
			//$mutuales = $this->admin->get_mutual_seguridad(); 

			//$parametros_generales = $this->admin->get_parametros_generales(); 


			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Personal');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'rrhh/mantencion_personal';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['formValidation'] = true;
			$vars['gritter'] = true;
			$vars['centros_costo'] = $centros_costo;
      $vars['cargos'] = $cargos;
			$vars['personal'] = $personal;
      $vars['empresa'] = $empresa;
			$vars['afps'] = $afps;
			$vars['apvs'] = $apvs;
			$vars['isapres'] = $isapres;
			//$vars['cajas'] = $cajas;
			//$vars['mutuales'] = $mutuales;
			//$vars['parametros_generales'] = $parametros_generales;
			
			$template = "template";
			//var_dump_new($vars); exit;

			

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

	public function contratos(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

		
			$this->load->model('admin');
			$personal = $this->admin->get_personal_total(); 


			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Contratos');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'rrhh/contratos_personal';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['formValidation'] = true;
			$vars['gritter'] = true;

			$vars['personal'] = $personal;
			
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

	public function cartas(){
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
			}

			$this->load->model('admin');
			$empresa = $this->admin->get_empresas($this->session->userdata('empresaid')); 


			$this->load->model('admin');
			$personal = $this->admin->get_personal_total(); 
			

			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Personal');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'rrhh/cartas_personal';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['formValidation'] = true;
			$vars['gritter'] = true;

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


	
	public function carga_masiva_paso(){
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
			}elseif($resultid == 8){
				$vars['message'] = "Colaboradores Cargados correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}

			$this->load->model('admin');
			$empresa = $this->admin->get_empresas($this->session->userdata('empresaid')); 

			
			$personal = $this->admin->get_personal_total_paso(); 
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
			$vars['content_view'] = 'rrhh/carga_masiva_paso';
			$vars['datatable'] = true;
			$vars['mask'] = true;
			$vars['formValidation'] = true;
			$vars['gritter'] = true;

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



	public function carga_masiva_personal()
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){


			$content = array(
						'menu' => 'Administraci&oacute;n',
						'title' => 'Administraci&oacute;n',
						'subtitle' => 'Carga Masiva de Colaboradores');       



      set_time_limit(0); // quita limite de tiempo al hacer carga

      $array_errores_estructura = array();
      $array_errores_contenido = array();
      $tipo = $this->input->post('tipo');
      $lista_personal_sin_confirmar = array();
      if($tipo != ''){
            if($tipo == 'validacion'){


                    $config['upload_path'] = "./uploads/cargas/colaboradores/";

                    if (!file_exists($config['upload_path'])) {
                        mkdir($config['upload_path'], 0777, true);
                    }

                    $config['file_name'] = date("Ymd") . "_" . date("His") . "_" . randomstring(5) . "_COL_" . $this->input->post('empresaid');
                    $config['allowed_types'] = "*";
                    $config['max_size'] = "10240";

                    $this->load->library('upload', $config);
                    $this->upload->do_upload("userfile");
                    $dataupload = $this->upload->data();

                    $extension = $dataupload['file_ext'];

                    $error_carga = false;


                    if ($extension != '.csv') {
                        $error_carga = true;
                        $msg = "Archivo debe tener formato csv";

                        $vars['message'] = $msg;
                        $vars['classmessage'] = 'danger';
                        $vars['icon'] = 'fa-ban';
                    }                    



                    if (!$error_carga) {

                          $definicion_encabezado[0] = "Rut";
                          $definicion_encabezado[1] = "Dv";
                          $definicion_encabezado[2] = "Nombres";
                          $definicion_encabezado[3] = "Apellidop";
                          $definicion_encabezado[4] = "Apellidom";
                          $definicion_encabezado[5] = "FecNacimiento";
                          $definicion_encabezado[6] = "Sexo";
                          $definicion_encabezado[7] = "EstadoCivil";
                          $definicion_encabezado[8] = "Nacionalidad";
                          $definicion_encabezado[9] = "Direccion";
                          $definicion_encabezado[10] = "Region";
                          $definicion_encabezado[11] = "Comuna";
                          $definicion_encabezado[12] = "Fono";
                          $definicion_encabezado[13] = "Email";
                          $definicion_encabezado[14] = "FechaIngreso";
                          $definicion_encabezado[15] = "Fecinicvacaciones";
                          $definicion_encabezado[16] = "Saldoinicvacaciones";
                          $definicion_encabezado[17] = "Saldoinicvacprog";
                          $definicion_encabezado[18] = "Tipocontrato";
                          $definicion_encabezado[19] = "Parttime";
                          $definicion_encabezado[20] = "Segcesantia";
                          $definicion_encabezado[21] = "FecAfc";
                          $definicion_encabezado[22] = "Pensionado";
                          $definicion_encabezado[23] = "Diastrabajo";
                          $definicion_encabezado[24] = "Horasdiarias";
                          $definicion_encabezado[25] = "Horassemanales";
                          $definicion_encabezado[26] = "Sueldobase";
                          $definicion_encabezado[27] = "Tipogratificacion";
                          $definicion_encabezado[28] = "Montogratificacion";
                          $definicion_encabezado[29] = "Cargassimples";
                          $definicion_encabezado[30] = "Cargasinvalidas";
                          $definicion_encabezado[31] = "Cargasmaternales";
                          $definicion_encabezado[32] = "Tramoasigfamiliar";
                          $definicion_encabezado[33] = "Movilizacion";
                          $definicion_encabezado[34] = "Colacion";


                          $array_datos_requeridos = array(1,2,3,4,5,6,7,8,9,10,11,12,15,16,17,18,19,20,21,23,24,25,26,27,28,29,30,31,32,34,35);
                          // campo 33, sólo si 30 es mayor a cero
                          $array_numericos = array(1,9,11,12,17,18,24,27,29,30,31,32,34,35);


                          $array_decimal = array(25,26);

                          $array_fechas = array(6,15,16); 
                          // campo 22, sólo si 21 es 1

                          $array_sn = array(20,21,23); 

                          $array_valores_dv = array('1','2','3','4','5','6','7','8','9','0','K');


                          $array_valores_sexo = array('M','F');

                          $array_valores_estado_civil = array('S','C','V','D');

                          $array_valores_tipo_contrato = array('F','I');


                          $array_valores_tipo_gratificacion = array('SG','TL','MF');

                          $array_valores_tramos_asigfamiliar = array('A','B','C','D');


                          $array_rut_ingresados = array();



                          //header('Content-type: text/plain; charset=ISO-8859-1');
                          
                          $columnas_requeridas = 35;
                          $cant_errores_estructura = 0;
                          $cant_errores_contenido = 0;
                          $fila = 1;
                          if (($gestor = fopen($config['upload_path'] . $dataupload['orig_name'], "r")) !== FALSE) {
                              while (($datos = fgetcsv($gestor, 0, ";")) !== FALSE) {
                                  $numero = count($datos);

                                  // validar encabezado


                                  //echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
                                 
                                  for ($c=0; $c < $numero; $c++) {



                                      // comenzar validaciones


                                    // 1.- Validar Estructura.
                                    //      Validar que todas las filas contengan 35 campos
                                    //      Validar nombres encabezados


                                    if($fila == 1){

                                        if($datos[$c] != utf8_encode($definicion_encabezado[$c])){

                                                  $array_errores_estructura[$cant_errores_estructura]['tipo'] = "Error en fila de encabezados";
                                                  $array_errores_estructura[$cant_errores_estructura]['descripcion'] = "Se esperaba valor \"" . $definicion_encabezado[$c] . "\" en vez de \"" . utf8_encode($datos[$c]). "\" ";
                                                  $cant_errores_estructura++;

                                        }
                                      

                                    }            
                                   
                                    // rut

                                    if($fila > 1){




                                      //validación de datos vacíos
                                      if(in_array($c+1,$array_datos_requeridos) && $datos[$c] == ''){

                                              $array_errores_contenido[$cant_errores_contenido]['tipo'] = "Error en fila " . $fila;
                                              $array_errores_contenido[$cant_errores_contenido]['columna'] = $definicion_encabezado[$c];
                                              $array_errores_contenido[$cant_errores_contenido]['valor'] = $datos[$c];
                                              $array_errores_contenido[$cant_errores_contenido]['descripcion'] = "Dato es Requerido";
                                              $cant_errores_contenido++;

                                      } 

                                      // Si tiene cargas familiares simples y no está ingresado el tramo
                                      if(($c+1) == 33 && $datos[$c] == '' && $datos[29] > 0){

                                              $array_errores_contenido[$cant_errores_contenido]['tipo'] = "Error en fila " . $fila;
                                              $array_errores_contenido[$cant_errores_contenido]['columna'] = $definicion_encabezado[$c];
                                              $array_errores_contenido[$cant_errores_contenido]['valor'] = $datos[$c];
                                              $array_errores_contenido[$cant_errores_contenido]['descripcion'] = "Dato es Requerido si tiene cargas simples";
                                              $cant_errores_contenido++;

                                      }


                                       if(($c+1) == 33 && $datos[$c] != ''){

                                            if(!in_array($datos[$c],$array_valores_tramos_asigfamiliar)){

                                                    $array_errores_contenido[$cant_errores_contenido]['tipo'] = "Error en fila " . $fila;
                                                    $array_errores_contenido[$cant_errores_contenido]['columna'] = $definicion_encabezado[$c];
                                                    $array_errores_contenido[$cant_errores_contenido]['valor'] = $datos[$c];
                                                    $array_errores_contenido[$cant_errores_contenido]['descripcion'] = "Valor Tramo Asig. Familiar Incorrecto";
                                                    $cant_errores_contenido++;


                                            }


                                      }


                                                                           
                                      //var_dump_new($c);
                                      //var_dump_new($datos[$c]);
                                      //var_dump_new(is_numeric($datos[$c]));
                                      //validación de datos numéricos
                                      if(in_array($c+1,$array_numericos) && !is_numeric($datos[$c])){
                                              $array_errores_contenido[$cant_errores_contenido]['tipo'] = "Error en fila " . $fila;
                                              $array_errores_contenido[$cant_errores_contenido]['columna'] = $definicion_encabezado[$c];
                                              $array_errores_contenido[$cant_errores_contenido]['valor'] = $datos[$c];
                                              $array_errores_contenido[$cant_errores_contenido]['descripcion'] = "Valor debe ser numérico";
                                              $cant_errores_contenido++;

                                      }   


                                      if(in_array($c+1,$array_decimal) && !ctype_digit(str_replace(".","",str_replace(",","", $datos[$c])) )){

                                              $array_errores_contenido[$cant_errores_contenido]['tipo'] = "Error en fila " . $fila;
                                              $array_errores_contenido[$cant_errores_contenido]['columna'] = $definicion_encabezado[$c];
                                              $array_errores_contenido[$cant_errores_contenido]['valor'] = $datos[$c];
                                              $array_errores_contenido[$cant_errores_contenido]['descripcion'] = "Valor debe ser decimal ";
                                              $cant_errores_contenido++;

                                      }                                        

                                      // valores si o no
                                      if(in_array($c+1,$array_sn) && !in_array($datos[$c],array('S','N'))){
                                              $array_errores_contenido[$cant_errores_contenido]['tipo'] = "Error en fila " . $fila;
                                              $array_errores_contenido[$cant_errores_contenido]['columna'] = $definicion_encabezado[$c];
                                              $array_errores_contenido[$cant_errores_contenido]['valor'] = $datos[$c];
                                              $array_errores_contenido[$cant_errores_contenido]['descripcion'] = "Valor debe ser S o N";
                                              $cant_errores_contenido++;

                                      }       



                                      // validación de fechas
                                      if(in_array($c+1,$array_fechas)){
                                            //echo $fila." --- ";
                                            $array_datos_fecha = explode("-",$datos[$c]);
                                            //var_dump_new($datos[$c]);
                                            //var_dump_new($array_datos_fecha);

                                            if(isset($array_datos_fecha[0]) && isset($array_datos_fecha[1]) && isset($array_datos_fecha[2])){

                                                if(!checkdate($array_datos_fecha[1], $array_datos_fecha[0], $array_datos_fecha[2])){
                                                    $array_errores_contenido[$cant_errores_contenido]['tipo'] = "Error en fila " . $fila;
                                                    $array_errores_contenido[$cant_errores_contenido]['columna'] = $definicion_encabezado[$c];
                                                    $array_errores_contenido[$cant_errores_contenido]['valor'] = $datos[$c];
                                                    $array_errores_contenido[$cant_errores_contenido]['descripcion'] = "Valor debe ser Fecha";
                                                    $cant_errores_contenido++;


                                                }



                                            }else{


                                                    $array_errores_contenido[$cant_errores_contenido]['tipo'] = "Error en fila " . $fila;
                                                    $array_errores_contenido[$cant_errores_contenido]['columna'] = $definicion_encabezado[$c];
                                                    $array_errores_contenido[$cant_errores_contenido]['valor'] = $datos[$c];
                                                    $array_errores_contenido[$cant_errores_contenido]['descripcion'] = "Valor debe ser Fecha";
                                                    $cant_errores_contenido++;

                                            }


                                            

                                      }    



                                      if(($c+1) == 22 && $datos[20] == 'S'){

                                            $array_datos_fecha = explode("-",$datos[$c]);
                                            //var_dump_new($datos[$c]);
                                            //var_dump_new($array_datos_fecha);

                                            if(isset($array_datos_fecha[0]) && isset($array_datos_fecha[1]) && isset($array_datos_fecha[2])){

                                                if(!checkdate($array_datos_fecha[1], $array_datos_fecha[0], $array_datos_fecha[2])){
                                                    $array_errores_contenido[$cant_errores_contenido]['tipo'] = "Error en fila " . $fila;
                                                    $array_errores_contenido[$cant_errores_contenido]['columna'] = $definicion_encabezado[$c];
                                                    $array_errores_contenido[$cant_errores_contenido]['valor'] = $datos[$c];
                                                    $array_errores_contenido[$cant_errores_contenido]['descripcion'] = "Valor debe ser Fecha si está afiliado a Seguro de Cesantía";
                                                    $cant_errores_contenido++;


                                                }



                                            }else{


                                                    $array_errores_contenido[$cant_errores_contenido]['tipo'] = "Error en fila " . $fila;
                                                    $array_errores_contenido[$cant_errores_contenido]['columna'] = $definicion_encabezado[$c];
                                                    $array_errores_contenido[$cant_errores_contenido]['valor'] = $datos[$c];
                                                    $array_errores_contenido[$cant_errores_contenido]['descripcion'] = "Valor debe ser Fecha si está afiliado a Seguro de Cesantía";
                                                    $cant_errores_contenido++;

                                            }
                                          


                                      }



                                      if(($c+1) == 2 && !in_array($datos[$c],$array_valores_dv)){

                                                    $array_errores_contenido[$cant_errores_contenido]['tipo'] = "Error en fila " . $fila;
                                                    $array_errores_contenido[$cant_errores_contenido]['columna'] = $definicion_encabezado[$c];
                                                    $array_errores_contenido[$cant_errores_contenido]['valor'] = $datos[$c];
                                                    $array_errores_contenido[$cant_errores_contenido]['descripcion'] = "Valor DV Incorrecto";
                                                    $cant_errores_contenido++;


                                      }


                                      if(($c+1) == 7 && !in_array($datos[$c],$array_valores_sexo)){

                                                    $array_errores_contenido[$cant_errores_contenido]['tipo'] = "Error en fila " . $fila;
                                                    $array_errores_contenido[$cant_errores_contenido]['columna'] = $definicion_encabezado[$c];
                                                    $array_errores_contenido[$cant_errores_contenido]['valor'] = $datos[$c];
                                                    $array_errores_contenido[$cant_errores_contenido]['descripcion'] = "Valor Sexo Incorrecto";
                                                    $cant_errores_contenido++;


                                      }


                                      if(($c+1) == 8 && !in_array($datos[$c],$array_valores_estado_civil)){

                                                    $array_errores_contenido[$cant_errores_contenido]['tipo'] = "Error en fila " . $fila;
                                                    $array_errores_contenido[$cant_errores_contenido]['columna'] = $definicion_encabezado[$c];
                                                    $array_errores_contenido[$cant_errores_contenido]['valor'] = $datos[$c];
                                                    $array_errores_contenido[$cant_errores_contenido]['descripcion'] = "Valor Estado Civil Incorrecto";
                                                    $cant_errores_contenido++;


                                      }


                                      if(($c+1) == 19 && !in_array($datos[$c],$array_valores_tipo_contrato)){

                                                    $array_errores_contenido[$cant_errores_contenido]['tipo'] = "Error en fila " . $fila;
                                                    $array_errores_contenido[$cant_errores_contenido]['columna'] = $definicion_encabezado[$c];
                                                    $array_errores_contenido[$cant_errores_contenido]['valor'] = $datos[$c];
                                                    $array_errores_contenido[$cant_errores_contenido]['descripcion'] = "Valor Tipo Contrato Incorrecto";
                                                    $cant_errores_contenido++;


                                      }


                                      if(($c+1) == 28 && !in_array($datos[$c],$array_valores_tipo_gratificacion)){

                                                    $array_errores_contenido[$cant_errores_contenido]['tipo'] = "Error en fila " . $fila;
                                                    $array_errores_contenido[$cant_errores_contenido]['columna'] = $definicion_encabezado[$c];
                                                    $array_errores_contenido[$cant_errores_contenido]['valor'] = $datos[$c];
                                                    $array_errores_contenido[$cant_errores_contenido]['descripcion'] = "Valor Tipo Gratificacion Incorrecto";
                                                    $cant_errores_contenido++;


                                      }

                                      if(($c+1) == 1 && in_array($datos[$c],$array_rut_ingresados)){


                                                $array_errores_contenido[$cant_errores_contenido]['tipo'] = "Error en fila " . $fila;
                                                $array_errores_contenido[$cant_errores_contenido]['columna'] = $definicion_encabezado[$c];
                                                $array_errores_contenido[$cant_errores_contenido]['valor'] = $datos[$c];
                                                $array_errores_contenido[$cant_errores_contenido]['descripcion'] = "Rut duplicado";
                                                $cant_errores_contenido++;


                                            
                                      }else{
                                            array_push($array_rut_ingresados,$datos[$c]); 
                                      }



                                    } // if($fila > 1){
                                                                        

                                    // 2.-  Validar contenido
                                    //      Validar Valores
                                    //      Mostrar tabla con todos los errores
                                    //      Mostrar por cada error:
                                    //                                Nro Error
                                    //                                Linea Error
                                    //                                Rut Colaborador
                                    //                                Nombre Colaborador
                                    //                                Nombre Columna incorrecta
                                    //                                Valor de columna Incorrecta




                                     // echo $datos[$c] . "<br />\n";

                                  }


                                  

                                  // validar cantidad de columnas
                                  if ($numero != $columnas_requeridas){
                                      $fila_error = $fila == 1 ? "de encabezados" : $fila;
                                      $array_errores_estructura[$cant_errores_estructura]['tipo'] = "Error en fila " . $fila_error;
                                      $array_errores_estructura[$cant_errores_estructura]['descripcion'] = "Se esperan " . $columnas_requeridas . " campos";
                                      $cant_errores_estructura++;

                                  }


                                    if($fila > 1 && $cant_errores_estructura == 0){



                                        $array_datos = array(
                                                            "Rut"                     => $datos[0],
                                                            "Dv"                      => $datos[1],
                                                            "Nombres"                 => utf8_encode($datos[2]),
                                                            "Apellidop"               => utf8_encode($datos[3]),
                                                            "Apellidom"               => utf8_encode($datos[4]),
                                                            "FecNacimiento"           => $datos[5],
                                                            "Sexo"                    => $datos[6],
                                                            "EstadoCivil"             => $datos[7],
                                                            "Nacionalidad"            => $datos[8],
                                                            "Direccion"               => utf8_encode($datos[9]),
                                                            "Region"                  => $datos[10],
                                                            "Comuna"                  => $datos[11],
                                                            "Fono"                    => $datos[12],
                                                            "Email"                   => $datos[13],
                                                            "FechaIngreso"            => $datos[14],
                                                            "Fecinicvacaciones"       => $datos[15],
                                                            "Saldoinicvacaciones"     => $datos[16],
                                                            "Saldoinicvacprog"        => $datos[17],
                                                            "Tipocontrato"            => $datos[18],
                                                            "Parttime"                => $datos[19],
                                                            "Segcesantia"             => $datos[20],
                                                            "FecAfc"                  => $datos[21],
                                                            "Pensionado"              => $datos[22],
                                                            "Diastrabajo"             => $datos[23],
                                                            "Horasdiarias"            => str_replace(",",".",$datos[24]),
                                                            "Horassemanales"          => str_replace(",",".",$datos[25]),
                                                            "Sueldobase"              => $datos[26],
                                                            "Tipogratificacion"       => $datos[27],
                                                            "Montogratificacion"      => $datos[28],
                                                            "Cargassimples"           => $datos[29],
                                                            "Cargasinvalidas"         => $datos[30],
                                                            "Cargasmaternales"        => $datos[31],
                                                            "Tramoasigfamiliar"       => $datos[32],
                                                            "Movilizacion"            => $datos[33],
                                                            "Colacion"                => $datos[34],
                                                      );

                                      array_push($lista_personal_sin_confirmar, $array_datos);
                                      }


                                   $fila++;

                              }
                              fclose($gestor);
                          }
                         // exit;
                          $this->session->set_flashdata('lista_personal_sin_confirmar', $lista_personal_sin_confirmar);
                          //echo count($lista_personal_sin_confirmar);
                          //var_dump_new($lista_personal_sin_confirmar); exit;


                    }


               // echo "validacion"; exit;

            }




      }

     
      $vars['errores_estructura'] = $array_errores_estructura;
      $vars['errores_contenido'] = $array_errores_contenido;
      $vars['lista_personal_sin_confirmar'] = $lista_personal_sin_confirmar;


		  $vars['gritter'] = true;
			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'rrhh/carga_masiva_personal';
			$vars['formValidation'] = true;
			//$vars['dataTables'] = true;
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


public function confirma_carga_personal()
    {

        if ($this->ion_auth->is_allowed($this->router->fetch_class(), $this->router->fetch_method())) {

            //exit;
            $arr_data = $this->session->flashdata('lista_personal_sin_confirmar');
            $lista_propiedades = array();
            $lista_usuarios = array();
            /******** ANALISIS DE DATOS************/
            foreach ($arr_data as $colaborador) {

                $array_fec_nacimiento = explode("-",$colaborador['FecNacimiento']);
                $array_fec_ini_vacaciones = explode("-",$colaborador['Fecinicvacaciones']);
                $array_fec_ingreso = explode("-",$colaborador['FechaIngreso']);
                $array_fec_afc = explode("-",$colaborador['FecAfc']);

                if($colaborador['EstadoCivil'] == 'S'){
                  $estadoCivil = 1;
                }else if ($colaborador['EstadoCivil'] == 'C'){
                    $estadoCivil = 2;
                }else if ($colaborador['EstadoCivil'] == 'V'){
                    $estadoCivil = 3;
                }else if ($colaborador['EstadoCivil'] == 'D'){
                    $estadoCivil = 4;
                }else{
                    $estadoCivil = 1;
                }

                if($colaborador['Tramoasigfamiliar'] == 'A'){
                  $idasigfamiliar = 1;
                }else if ($colaborador['Tramoasigfamiliar'] == 'B'){
                    $idasigfamiliar = 2;
                }else if ($colaborador['Tramoasigfamiliar'] == 'C'){
                    $idasigfamiliar = 3;
                }else if ($colaborador['Tramoasigfamiliar'] == 'D'){
                    $idasigfamiliar = 4;
                }else{
                    $idasigfamiliar = 0;
                }


               $array_datos = array(
                'id_empresa' => $this->session->userdata('empresaid'),
                'rut' => $colaborador['Rut'],
                'dv' => $colaborador['Dv'],
                'numficha' => 1,
                'nombre' => utf8_encode($colaborador['Nombres']),
                'apaterno' => utf8_encode($colaborador['Apellidop']),
                'amaterno' => utf8_encode($colaborador['Apellidom']),
                'fecnacimiento' => $array_fec_nacimiento[2].$array_fec_nacimiento[1].$array_fec_nacimiento[0],
                'idnacionalidad' => $colaborador['Nacionalidad'],
                'nacionalidad' => $colaborador['Nacionalidad'] == 46 ? 'C' : 'E', //ELIMINAR DESPUES
                'idecivil' =>$estadoCivil, //Cambiar $colaborador['EstadoCivil'],
                'sexo' => $colaborador['Sexo'],
                'direccion' => utf8_encode($colaborador['Direccion']),
                'email' => utf8_encode($colaborador['Email']),
                'tiporenta' => 'Mensual',
                'idcargo' => 0,
                'idestudio' => 0,
                'titulo' => '',
                'ididioma' => 0,
                'idjefe' => 0,
                'idreemplazo' => 0,
                'idlicencia' => 0,
                'tallapolera' => '',
                'tallapantalon' => '',
                'tipodocumento' => '',
                'idcentrocosto' => 0,
                'cbeneficio' => NULL,
                'fono' => $colaborador['Fono'],
                'idafp' => 0,
                'idisapre' => 0,
                'sueldobase' => $colaborador['Sueldobase'],
                'tipogratificacion' => $colaborador['Tipogratificacion'],
                'gratificacion' => $colaborador['Montogratificacion'],
                'movilizacion' => $colaborador['Movilizacion'],
                'colacion' => $colaborador['Colacion'],
                'idasigfamiliar' => $idasigfamiliar, // Cambiar
                'valorpactado' => 0,  //Valor Isapre
                'segcesantia' => $colaborador['Segcesantia'] == 'S' ? 1 : 0,
                'pensionado' => $colaborador['Pensionado'] == 'S' ? 1 : 0,
                'fecinicvacaciones' =>  $array_fec_ini_vacaciones[2].$array_fec_ini_vacaciones[1].$array_fec_ini_vacaciones[0],
                'saldoinicvacaciones' => $colaborador['Saldoinicvacaciones'],
                'saldoinicvacprog' => $colaborador['Saldoinicvacprog'],
                'tipocontrato' => $colaborador['Tipocontrato'],
                'plazo_contrato' => NULL,
                'fecingreso' => $array_fec_ingreso[2].$array_fec_ingreso[1].$array_fec_ingreso[0],
                'fecha_retiro' => NULL,
                'fecha_finiquito' => NULL,
                
                'id_lugar_pago' => 0,
                'id_categoria' => 0,
                'jubilado' => NULL,
                'rol_privado' => 'NO',
                'sindicato' => 'NO',
                'semana_corrida' => 'NO',
                'fecafp' => NULL,
                'fecafc' => $array_fec_afc[2].$array_fec_afc[1].$array_fec_afc[0],
                'idregion' => $colaborador['Region'],
                'idcomuna' => $colaborador['Comuna'],
                'cargassimples' => $colaborador['Cargassimples'],
                'cargasinvalidas' => $colaborador['Cargasinvalidas'],
                'cargasmaternales' => $colaborador['Cargasmaternales'],
                'idbanco' => 0,
                'id_plantilla_banco' => 0,
                'id_tipo_cuenta_bancaria' => 0,
                'id_forma_pago' => 0,
                'nrocuentabanco' => '',
                'instapv' => 0,
                'nrocontratoapv' => '',
                'tipocotapv' => NULL,
                'cotapv' => 0,
                'regimenapv' => NULL,
                'formapagoapv' => NULL,
                'trabajo_pesado' => 0,

                'id_motivo_egreso' => 0,
                'id_tipocc' => 0,
                'id_seccion' => 0,
                'id_situacion' => 0,
                'id_clase' => 0,
                'id_ine' => 0,
                'id_zona' => 0,
                'fecrealcontrato' => $array_fec_ingreso[2].$array_fec_ingreso[1].$array_fec_ingreso[0],
                'primervenc' => NULL,
                'fun' => 0,
                'fecvencplan' => NULL,
                'fecapvc' => NULL,
                'fectermsubsidio' => NULL,
                'rut_pago' => NULL,
                'dv_pago' => NULL,                
                'nombre_pago' => '',
                'email_pago' => '',
                'usuario_windows' => '',
                //DATOS POR DEFECTO
                'diasprogresivos' => 0,
                'diasvactomados' => 0,
                'diasprogtomados' => 0,
                'parttime' =>$colaborador['Parttime'] == 'S' ? 1 : 0,
                //'pensionado' => 0,
                'diastrabajo' => $colaborador['Diastrabajo'],
                'horasdiarias' => $colaborador['Horasdiarias'],
                'horassemanales' => $colaborador['Horassemanales'],
                'cargasretroactivas' => 0,
                'asigfamiliar' => 0,
                'active' => 1,
                'adicafp' => 0
                );
           


            $result = $this->rrhh_model->add_personal($array_datos,0);

            } //end foreach
            $this->session->set_flashdata('personal_result', 9);
            redirect('rrhh/mantencion_personal');
        } else {
            $content = array(
                'menu' => 'Error 403',
                'title' => 'Error 403',
                'subtitle' => '403 error'
            );


            $vars['content_menu'] = $content;
            $vars['content_view'] = 'forbidden';
            $this->load->view('template', $vars);
        }
    }




public function ver_formato_carga_colaboradores()
  {

    if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){


      $content = array(
            'menu' => 'Administraci&oacute;n',
            'title' => 'Administraci&oacute;n',
            'subtitle' => 'Formato Carga Masiva Colaboradores');       
    
      $vars['content_menu'] = $content;       
      $vars['content_view'] = 'rrhh/ver_formato_carga_colaboradores';
      $vars['formValidation'] = true;
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



  public function ver_tablas_anexas_colaboradores()
  {

    if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){


      $content = array(
            'menu' => 'Administraci&oacute;n',
            'title' => 'Administraci&oacute;n',
            'subtitle' => 'Formato Carga Masiva Colaboradores');   

        $this->load->model('Mantenedores_model');

        $nacionalidad = $this->Mantenedores_model->get_nacionalidad();
        $regiones = $this->Mantenedores_model->get_regiones();
        $comunas = $this->Mantenedores_model->get_comuna_lista();

          
    
      $vars['content_menu'] = $content;       
      $vars['content_view'] = 'rrhh/ver_tablas_anexas_colaboradores';
      $vars['formValidation'] = true;
      $vars['dataTables'] = true;
      $vars['nacionalidad'] = $nacionalidad;
      $vars['regiones'] = $regiones;
      $vars['comunas'] = $comunas;
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


	public function carga_masiva_asistencia()
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$mes  = $this->input->post('mes');
			$anno  = $this->input->post('anno');

			//echo $mes." -- ".$anno; exit;
			$content = array(
						'menu' => 'Administraci&oacute;n',
						'title' => 'Administraci&oacute;n',
						'subtitle' => 'Carga Masiva de Asistencia');

       
		
			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'rrhh/carga_masiva_asistencia';
			$vars['formValidation'] = true;
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

	public function carga_masiva_horas_extras()
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$mes  = $this->input->post('mes');
			$anno  = $this->input->post('anno');

			//echo $mes." -- ".$anno; exit;
			$content = array(
						'menu' => 'Administraci&oacute;n',
						'title' => 'Administraci&oacute;n',
						'subtitle' => 'Carga Masiva Horas Extras');

       
		
			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'rrhh/carga_masiva_horas_extras';
			$vars['formValidation'] = true;
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

	public function carga_masiva_haberes_descuentos()
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$mes  = $this->input->post('mes');
			$anno  = $this->input->post('anno');

			//echo $mes." -- ".$anno; exit;
			$content = array(
						'menu' => 'Administraci&oacute;n',
						'title' => 'Administraci&oacute;n',
						'subtitle' => 'Carga Masiva Haberes y Descuentos');

       
		
			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'rrhh/carga_masiva_haberes_descuentos';
			$vars['formValidation'] = true;
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

	public function carga_masiva_anticipos()
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$mes  = $this->input->post('mes');
			$anno  = $this->input->post('anno');

			//echo $mes." -- ".$anno; exit;
			$content = array(
						'menu' => 'Administraci&oacute;n',
						'title' => 'Administraci&oacute;n',
						'subtitle' => 'Carga Masiva Anticipos');

       
		
			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'rrhh/carga_masiva_anticipos';
			$vars['formValidation'] = true;
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


public function datos_personal($rut=null){

	$datos_personal2 = $this->rrhh_model->get_personal_datos($rut);
	//echo json_encode($datos_personal2); exit;
	if ($datos_personal2 == 0){

				echo json_encode('0');
			}else{

			echo json_encode($datos_personal2);
			}

}

public function datos_personal_lic($idpersonal=null){

	$datos_personal2 = $this->rrhh_model->get_personal($idpersonal);
	echo json_encode($datos_personal2);
		
}


//public function mod_trabajador($rut = null,$idtrabajador = null)
public function mod_trabajador($idtrabajador = null)
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

           
      if(is_null($idtrabajador)){
            $this->session->set_flashdata('personal_result', 17);
            redirect('rrhh/mantencion_personal');        
      }

      $trabajador = $this->admin->get_personal_total($idtrabajador); 

      if(is_null($trabajador)){
            $this->session->set_flashdata('personal_result', 18);
            redirect('rrhh/mantencion_personal');        
      }




			/***** CARGA DE DATOS PARA FORMULARIO ***/
			$this->load->model('admin');
			$this->load->model('rrhh_model');
			$this->load->model('configuracion');
			$this->load->model('Mantenedores_model');
			$empresa = $this->admin->get_empresas($this->session->userdata('empresaid'));
			$regiones = $this->admin->get_regiones();
			$estados_civiles = $this->admin->get_estado_civil();
			$cargos = $this->admin->get_cargos_empresa();
			$paises = $this->admin->get_paises();
			$idiomas = $this->admin->get_idiomas();
			$personal = $this->admin->get_personal_total();
			$licencias = $this->admin->get_licencia_conducir();
			$estudios = $this->admin->get_estudios();
			$centros_costo = $this->admin->get_centro_costo();
			$afps = $this->admin->get_afp();
			$isapres = $this->admin->get_isapre();
			$datos_personal = $this->rrhh_model->get_personal_datos(null,$idtrabajador);
			$pantalon = $this->admin->get_vestuario_pantalon();			
			$polera = $this->admin->get_vestuario_polera();
			$apv = $this->admin->get_apv();
			$bancos = $this->admin->get_bancos();
			$forma_pago = $this->admin->get_forma_pago();
			$tramos_asig_familiar = $this->admin->get_tabla_asig_familiar();
			$jornada_trabajo = $this->admin->get_jornada_trabajo();
			$categoria = $this->admin->get_categoria();
			$lugar_pago= $this->admin->get_lugar_pago();
			$motivo_egreso= $this->admin->get_motivo_egreso();
			$tipo_cc= $this->admin->get_tipo_cc();
			$secciones= $this->admin->get_seccion();
			$situacion_laboral= $this->admin->get_situacion_laboral();
			$clases= $this->admin->get_clases();
			$cod_ine= $this->admin->get_ine();
			$zonas_brechas= $this->admin->get_zona_brecha();
			$plantillas_bancos = $this->configuracion->get_plantilla_banco();
			$tipo_cuenta_banco = $this->Mantenedores_model->get_tipo_cuenta_banco(null);
			//var_dump($motivo_egreso); exit;


			/**** CARGA DE DATOS TRABAJADOR ****/
			$bonos = is_null($idtrabajador) ?  array() : $this->admin->get_bonos($idtrabajador); 
			//$parametros = $this->remuneracion->get_parametros_generales();



			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Modificar Colaborador');

     // echo "<pre>";
     // print_r($trabajador); exit;

			$datos_form = array(
								'idtrabajador' =>  is_null($idtrabajador) ? 0 : $trabajador->id_personal,	
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
                'anticipo_permanente' =>  is_null($idtrabajador) ? "" : $trabajador->anticipo_permanente,
                'anticipo' =>  is_null($idtrabajador) ? "" : $trabajador->anticipo,
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
			$vars['content_view'] = 'rrhh/mod_trabajador';
			$vars['datos_form'] = $datos_form;
			$vars['bonos'] = $bonos;
			$vars['formValidation'] = true;
			$vars['datetimepicker'] = true;
			$vars['pantalon'] = $pantalon;
			$vars['polera'] = $polera;
			$vars['apv'] = $apv;
			$vars['categorias'] = $categoria;
			$vars['lugar_pago'] = $lugar_pago;
			$vars['bancos'] = $bancos;
			$vars['plantillas_bancos'] = $plantillas_bancos;
			$vars['forma_pago'] = $forma_pago;
			$vars['motivo_egreso'] = $motivo_egreso;
			$vars['tipo_cc'] = $tipo_cc;
			$vars['secciones'] = $secciones;
			$vars['situacion_laboral'] = $situacion_laboral;
			$vars['clases'] = $clases;
			$vars['tramos_asig_familiar'] = $tramos_asig_familiar;
			$vars['jornada_trabajo'] = $jornada_trabajo;
			$vars['cod_ine'] = $cod_ine;
			$vars['zonas_brechas'] = $zonas_brechas;
			$vars['tipo_cuenta_banco'] = $tipo_cuenta_banco;
			$vars['icheck'] = true;
			$vars['jqueryRut'] = true;
			$vars['mask'] = true;
			$vars['inputmask'] = true;
			$vars['maleta'] = true;
			$vars['idrut'] = $trabajador->rut;
      $vars['idtrabajador'] = $idtrabajador;
			$template = "template";
			$this->load->view($template,$vars);	
			//json_encode($datos_personal);

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


	public function validate_sueldo_minimo($data = '')
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			$sueldobase = str_replace(".","",$this->input->post('sueldo_base'));
			$horassemanales = $this->input->post('horassemanales');
			
			$parttime = $this->input->post('parttime');

			$this->load->model('admin');
			//$parametros_generales = $this->admin->get_parametros_generales();
      $parametros_generales = $this->admin->get_indicadores_by_day(date('Y-m-d'),'Sueldo Minimo');
      $parametros = $parametros_generales[0];


      

			$valor_hora = $parametros->valor/45;
			$sueldominimo_proporcional = (int)($valor_hora*str_replace(",",".",$horassemanales));
      $data = array();
			if($parttime == 'on'){
				$data['result'] = "ok";
			}else{
				//if($sueldobase < $parametros_generales->sueldominimo){
				if($sueldobase < $sueldominimo_proporcional){
					$data['result'] = "error";
					$data['fields']['sueldo_base'] = "Sueldo Base no puede ser menor a Sueldo M&iacute;nimo";	
				}else{
					$data['result'] = "ok";
				}
			}

			echo json_encode($data);

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
			$this->load->model('Mantenedores_model');
			$this->load->model('configuracion');

			$empresa = $this->admin->get_empresas($this->session->userdata('empresaid'));
			$regiones = $this->admin->get_regiones();
			$estados_civiles = $this->admin->get_estado_civil();
			$cargos = $this->admin->get_cargos_empresa();
			$paises = $this->admin->get_paises();
			$idiomas = $this->admin->get_idiomas();
			$personal = $this->admin->get_personal_total();
			$licencias = $this->admin->get_licencia_conducir();
			$estudios = $this->admin->get_estudios();
			$centros_costo = $this->admin->get_centro_costo();
			$afps = $this->admin->get_afp();
			$isapres = $this->admin->get_isapre();
			$pantalon = $this->admin->get_vestuario_pantalon();			
			$polera = $this->admin->get_vestuario_polera();
			$apv = $this->admin->get_apv();
			$bancos = $this->admin->get_bancos();
			$forma_pago = $this->admin->get_forma_pago();
			$tramos_asig_familiar = $this->admin->get_tabla_asig_familiar();
			$jornada_trabajo = $this->admin->get_jornada_trabajo();
			$categoria = $this->admin->get_categoria();
			$lugar_pago= $this->admin->get_lugar_pago();
			$motivo_egreso= $this->admin->get_motivo_egreso();
			$tipo_cc= $this->admin->get_tipo_cc();
			$secciones= $this->admin->get_seccion();
			$situacion_laboral= $this->admin->get_situacion_laboral();
			$clases= $this->admin->get_clases();
			$cod_ine= $this->admin->get_ine();
			$zonas_brechas= $this->admin->get_zona_brecha();
			$plantillas_bancos = $this->configuracion->get_plantilla_banco();
			$tipo_cuenta_banco = $this->Mantenedores_model->get_tipo_cuenta_banco(null);

			//$zonas_brechas= $this->admin->get_zona_brecha();



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
						'subtitle' => 'Agregar Colaborador');


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
								'id_nacionalidad' => is_null($idtrabajador) ? 46 : $trabajador->id_nacionalidad,
								'ididioma' => is_null($idtrabajador) ? 1 : $trabajador->ididioma,
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
			$vars['apv'] = $apv;
			$vars['content_view'] = 'rrhh/add_trabajador';
			$vars['datos_form'] = $datos_form;
			$vars['bonos'] = $bonos;
			$vars['formValidation'] = true;
			$vars['datetimepicker'] = true;
			$vars['categorias'] = $categoria;
			$vars['lugar_pago'] = $lugar_pago;
			$vars['bancos'] = $bancos;
			$vars['forma_pago'] = $forma_pago;
			$vars['motivo_egreso'] = $motivo_egreso;
			$vars['tipo_cc'] = $tipo_cc;
			$vars['secciones'] = $secciones;
			$vars['situacion_laboral'] = $situacion_laboral;
			$vars['clases'] = $clases;
			$vars['tramos_asig_familiar'] = $tramos_asig_familiar;
			$vars['jornada_trabajo'] = $jornada_trabajo;
			$vars['cod_ine'] = $cod_ine;
			$vars['zonas_brechas'] = $zonas_brechas;
			//$vars['zonas_brechas'] = $zonas_brechas;
			$vars['icheck'] = true;
			$vars['jqueryRut'] = true;
			$vars['mask'] = true;
			$vars['inputmask'] = true;
			$vars['maleta'] = true;
			$vars['pantalon'] = $pantalon;
			$vars['polera'] = $polera;
			$vars['plantillas_bancos'] = $plantillas_bancos;
			$vars['tipo_cuenta_banco'] = $tipo_cuenta_banco;

			$template = "template";
			$this->load->view($template,$vars);	


		}else{
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}

	}



	public function verificar_trabajador($rut=null){

		$personal = $this->rrhh_model->verificar_personal($rut);
					
			

		echo json_encode($personal);
	}

	public function desactivar_trabajador($rut=null){

		$personal = $this->rrhh_model->desactivar_personal($rut);
		redirect('rrhh/mantencion_personal');

	}


	public function activar_trabajador($rut=null){

		$personal = $this->rrhh_model->activar_personal($rut);
		redirect('rrhh/mantencion_personal');

	}

public function editar_trabajador(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			//echo "<pre>";
			//print_r($this->input->post(NULL,true)); // EXIT;
			$idtrabajador = $this->input->post("idtrabajador");
       		$rut = str_replace(".","",$this->input->post("rut"));
			$arrayRut = explode("-",$rut);
     // var_dump_new($arrayRut); exit;

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
			$sueldo_base = str_replace(".","",$this->input->post('sueldo_base'));
			$fecinicvacaciones = $this->input->post('fecha_inicio_vacaciones');
			$tipogratificacion = $this->input->post('tipogratificacion');
			$gratificacion = str_replace(".","",$this->input->post('gratificacion'));
			$movilizacion = str_replace(".","",$this->input->post('movilizacion'));
			$colacion = str_replace(".","",$this->input->post('colacion'));
			$saldoinicvacaciones = $this->input->post('vacaciones_legales');
			$saldoinicvacprog = $this->input->post('vacaciones_progresivas');
			$fecingreso = $this->input->post('datepicker2');
			$fecha_retiro = $this->input->post('fecha_retiro');
			$fecha_finiquito = $this->input->post('datepicker4');
			$fecrealcontrato = $this->input->post('fecha_real');
			$primervenc = $this->input->post('vencimiento_1');

			$anticipo_permanente = $this->input->post('anticipo_permanente') == 'on' ? 1 : 0;
      $anticipo = str_replace(".","",$this->input->post('anticipo'));

			$fecha_inicio_vacaciones = $this->input->post('fecha_inicio_vacaciones');
			$tipocontrato = $this->input->post('tipocontrato');
			$plazo_contrato = $this->input->post('plazo_contrato');

			$tallapantalon = $this->input->post('pantalon');
			$tallapolera = $this->input->post('polera');
			$tramo = $this->input->post('tramo');
			$monto_pactado = str_replace(",",".",$this->input->post('monto_pactado'));
			$categoria = $this->input->post('categoria');
			$lugar_pago = $this->input->post('lugar_pago');

			$jubilado = $this->input->post('jubilado');
			$pensionado = $this->input->post('pensionado') == 'on' ? 1 : 0;
			//$regimen_pago = $this->input->post('regimen_pago');
			$regimen_pago = "NO";
			$sindicato = $this->input->post('sindicato');
			$semana_corrida = $this->input->post('semana_corrida');
			$fecafp = $this->input->post('datepicker5');
			$fecafc = $this->input->post('datepicker6');
			$fecvencplan = $this->input->post('datepicker9');
			$fecapvc = $this->input->post('datepicker10');
			$fectermsubsidio = $this->input->post('datepicker11');

			
			//var_dump($fecvencplan); exit;
				
			$seguro_cesantia = $this->input->post('seguro_cesantia') == 'on' || $this->input->post('seguro_cesantia') == '1' ? 1 : 0;
			$parttime = $this->input->post('parttime') == 'on' ? 1 : 0;

			
			$region = $this->input->post('region');
			$comuna = $this->input->post('comuna');


			$asig_individual = $this->input->post('asig_individual');
			$asig_por_invalidez = $this->input->post('asig_por_invalidez');
			$asig_maternal = $this->input->post('asig_maternal');
			$banco = $this->input->post('banco');
			$plantilla_banco = $this->input->post('plantilla_banco');
			$tipo_cuenta_bancaria = $this->input->post('tipo_cuenta_bancaria');
			$forma_pago = $this->input->post('forma_pago');
			$cta_bancaria = $this->input->post('cta_bancaria');
			$apv = $this->input->post('apv');
			$numero_contrato_apv = $this->input->post('numero_contrato_apv');
			$tipo_cotizacion = $this->input->post('tipo_cotizacion');

			$cotapv = $this->input->post('monto_cotizacion_apv');

			if(isset($tipo_cotizacion)){
				if($tipo_cotizacion == 'pesos'){
					$cotapv = str_replace(".", "", $cotapv);
				}else if($tipo_cotizacion == 'uf'){
					$cotapv = str_replace(".", "", $cotapv);
					$cotapv = str_replace(",", ".", $cotapv);
				}
			}


			

			$regimenapv = $this->input->post('regimen_apv');
			$formapagoapv = $this->input->post('formapago_apv');

			$trabajo_pesado = $this->input->post('trabajo_pesado');


			$diastrabajo = $this->input->post('diastrabajo');
      $horasdiarias = str_replace(",",".",$this->input->post('horasdiarias')); 
      $horassemanales = str_replace(",",".",$this->input->post('horassemanales'));

			
			$motivo_egreso = $this->input->post('motivo_egreso');
			$tipo_cc = $this->input->post('tipo_cc');
			$seccion = $this->input->post('seccion');
			$situacion_laboral = $this->input->post('situacion_laboral');
			$clase = $this->input->post('clase');
			$codigo_ine = $this->input->post('codigo_ine');
			$zona_brecha = $this->input->post('zona_brecha');
			$numero_fun = $this->input->post('numero_fun');



			$rut_pago = str_replace(".","",$this->input->post("rutfp"));
			$arrayRutPago = explode("-",$rut_pago);
			$nombre_pago = $this->input->post('nombrefp');
			$email_pago = $this->input->post('emailfp');
			$usuario_windows = $this->input->post('usuario_windows');

			
			
			

			

			

			
			if($fecingreso !=null){
				$date = DateTime::createFromFormat('d/m/Y', $fecingreso);
				$fecingreso = $date->format('Ymd');
			}else{
				$fecingreso = null;
				//$seguro_cesantia =0;
			}

			if($fecha_retiro !=null){
				$date = DateTime::createFromFormat('d/m/Y', $fecha_retiro);
				$fecha_retiro = $date->format('Ymd');
			}else{
				$fecha_retiro = null;
				//$seguro_cesantia =0;
			}


			if($plazo_contrato !=null){
				$date = DateTime::createFromFormat('d/m/Y', $plazo_contrato);
				$plazo_contrato = $date->format('Ymd');
			}else{
				$plazo_contrato = null;
				//$seguro_cesantia =0;
			}


			if($fecha_finiquito !=null){
				$date = DateTime::createFromFormat('d/m/Y', $fecha_finiquito);
				$fecha_finiquito = $date->format('Ymd');
			}else{
				$fecha_finiquito = null;
				//$seguro_cesantia =0;
			}

			if($fecnacimiento !=null){
				$date = DateTime::createFromFormat('d/m/Y', $fecnacimiento);
				$fecnacimiento = $date->format('Ymd');
			}else{
				$fecnacimiento = null;
				//$seguro_cesantia =0;
			}


			if($fecha_inicio_vacaciones !=null){
				$date = DateTime::createFromFormat('d/m/Y', $fecha_inicio_vacaciones);
				$fecha_inicio_vacaciones = $date->format('Ymd');			
			}else{
				$fecha_inicio_vacaciones = null;
				//$seguro_cesantia =0;
			}


			if($fecrealcontrato !=null){
				$date = DateTime::createFromFormat('d/m/Y', $fecrealcontrato);
				$fecrealcontrato = $date->format('Ymd');			
			}else{
				$fecrealcontrato = null;
				//$seguro_cesantia =0;
			}



			if($primervenc !=null){
				$date = DateTime::createFromFormat('d/m/Y', $primervenc);
				$primervenc = $date->format('Ymd');			
			}else{
				$primervenc = null;
				//$seguro_cesantia =0;
			}



			if($fecvencplan !=null){
				$date = DateTime::createFromFormat('d/m/Y', $fecvencplan);
				$fecvencplan = $date->format('Ymd');			
			}else{
				$fecvencplan = null;
				//$seguro_cesantia =0;
			}



			if($fecapvc !=null){
				$date = DateTime::createFromFormat('d/m/Y', $fecapvc);
				$fecapvc = $date->format('Ymd');			
			}else{
				$fecapvc = null;
				//$seguro_cesantia =0;
			}



			if($fectermsubsidio !=null){
				$date = DateTime::createFromFormat('d/m/Y', $fectermsubsidio);
				$fectermsubsidio = $date->format('Ymd');			
			}else{
				$fectermsubsidio = null;
				//$seguro_cesantia =0;
			}



			if($fecafp !=null){

				$date = DateTime::createFromFormat('d/m/Y', $fecafp);
				$fecafp = $date->format('Ymd');
			}else{
				$fecafp = null;
				
			}

			if($fecafc !=null){

				$date = DateTime::createFromFormat('d/m/Y', $fecafc);
				$fecafc = $date->format('Ymd');
			}else{
				$fecafc = null;
				//$seguro_cesantia =0;
			}
			

			$array_datos = array(
								'id_empresa' => $this->session->userdata('empresaid'),
	       						'rut' => $arrayRut[0],
	       						'dv' => $arrayRut[1],
	       						'numficha' => $numficha,
								'nombre' => $nombre,
								'apaterno' => $apaterno,
								'amaterno' => $amaterno,
								'fecnacimiento' => $fecnacimiento,//substr($fecnacimiento,6,4).substr($fecnacimiento,0,2).substr($fecnacimiento,3,2),
								'idnacionalidad' => $idnacionalidad,
								'nacionalidad' => 'C', //ELIMINAR DESPUES
								'idecivil' => $idecivil,
								'sexo' => $sexo,
								'direccion' => $direccion,
								'email' => $email,
								'tiporenta' => $tiporenta,
								'idcargo' => $idcargo == '' ? 0 : $idcargo,
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
								'tipogratificacion' => $tipogratificacion,
								'gratificacion' => $gratificacion,
								'movilizacion' => $movilizacion,
								'colacion' => $colacion,
                'anticipo_permanente' => $anticipo_permanente,
                'anticipo' => $anticipo,
								'idasigfamiliar' => $tramo,
								'valorpactado' => $monto_pactado,
								'segcesantia' => $seguro_cesantia,
								'pensionado' => $pensionado,
								'fecinicvacaciones' => $fecha_inicio_vacaciones,
								'saldoinicvacaciones' => $saldoinicvacaciones,
								'saldoinicvacprog' => $saldoinicvacprog,
								'tipocontrato' => $tipocontrato,
								'plazo_contrato' => $plazo_contrato,
								'fecingreso' => $fecingreso,
								'fecha_retiro' => $fecha_retiro,
								'fecha_finiquito' => $fecha_finiquito,
								
								'id_lugar_pago' => $lugar_pago,
								'id_categoria' => $categoria,
								'jubilado' => $jubilado,
								'rol_privado' => $regimen_pago,
								'sindicato' => $sindicato,
								'semana_corrida' => $semana_corrida,
								'fecafp' => $fecafp,
								'fecafc' => $fecafc,
								'idregion' => $region,
								'idcomuna' => $comuna,
								'cargassimples' => $asig_individual,
								'cargasinvalidas' => $asig_por_invalidez,
								'cargasmaternales' => $asig_maternal,
								'idbanco' => $banco,
								'id_plantilla_banco' => $plantilla_banco,
								'id_tipo_cuenta_bancaria' => $tipo_cuenta_bancaria,
								'id_forma_pago' => $forma_pago,
								'nrocuentabanco' => $cta_bancaria,
								'instapv' => $apv,
								'nrocontratoapv' => $numero_contrato_apv,
								'tipocotapv' => $tipo_cotizacion,
								'cotapv' => $cotapv,
								'regimenapv' => $regimenapv,
								'formapagoapv' => $formapagoapv,
								'trabajo_pesado' => $trabajo_pesado,
								'id_motivo_egreso' => $motivo_egreso,
								'id_tipocc' => $tipo_cc,
								'id_seccion' => $seccion,
								'id_situacion' => $situacion_laboral,
								'id_clase' => $clase,
								'id_ine' => $codigo_ine,
								'id_zona' => $zona_brecha,
								'fecrealcontrato' => $fecrealcontrato,
								'primervenc' => $primervenc,
								'fun' => $numero_fun,
								'fecvencplan' => $fecvencplan,
								'fecapvc' => $fecapvc,
								'fectermsubsidio' => $fectermsubsidio,
	       						'rut_pago' => $idtrabajador == 0 ? $arrayRutPago[0] : "",
	       						'dv_pago' => $idtrabajador == 0 ? $arrayRutPago[1] : "",								
								'nombre_pago' => $nombre_pago,
								'email_pago' => $email_pago,
								'usuario_windows' => $usuario_windows,

								
								

								
								
																							
								
								//DATOS POR DEFECTO
								
									
								'diasprogresivos' => 0,
								'diasvactomados' => 0,
								'diasprogtomados' => 0,
								
								'parttime' => $parttime,
								//'pensionado' => 0,
								'diastrabajo' => $diastrabajo,
								'horasdiarias' => $horasdiarias,
								'horassemanales' => $horassemanales,
								//'sueldobase' => 250000,
								
								
								
								'cargasretroactivas' => 0,
								
								'asigfamiliar' => 0,
								
								
								'active' => 1,

								//OTROS
								'adicafp' => 0,);

			//var_dump($array_datos); exit;


			$result = $this->rrhh_model->edit_personal($array_datos,$idtrabajador);

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
    $content = array(
            'menu' => 'Error 403',
            'title' => 'Error 403',
            'subtitle' => '403 error');


      $vars['content_menu'] = $content;       
      $vars['content_view'] = 'forbidden';
      $this->load->view('template',$vars);
		}		


	}	


	public function submit_trabajador(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			//echo "<pre>";
			//print_r($this->input->post(NULL,true));  exit;
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
			$sueldo_base = str_replace(".","",$this->input->post('sueldo_base'));
			$fecinicvacaciones = $this->input->post('fecha_inicio_vacaciones');
			$tipogratificacion = $this->input->post('tipogratificacion');
			$gratificacion = str_replace(".","",$this->input->post('gratificacion'));
			$movilizacion = str_replace(".","",$this->input->post('movilizacion'));
			$colacion = str_replace(".","",$this->input->post('colacion'));
			$saldoinicvacaciones = $this->input->post('vacaciones_legales');
			$saldoinicvacprog = $this->input->post('vacaciones_progresivas');
			$fecingreso = $this->input->post('datepicker2');
			$fecha_retiro = $this->input->post('fecha_retiro');
			$fecha_finiquito = $this->input->post('datepicker4');
			$fecrealcontrato = $this->input->post('fecha_real');
			$primervenc = $this->input->post('vencimiento_1');

			

			$fecha_inicio_vacaciones = $this->input->post('fecha_inicio_vacaciones');
			$tipocontrato = $this->input->post('tipocontrato');
			$plazo_contrato = $this->input->post('plazo_contrato');
			$tallapantalon = $this->input->post('pantalon');
			$tallapolera = $this->input->post('polera');
			$tramo = $this->input->post('tramo');
			//$monto_pactado = $this->input->post('monto_pactado');
			$monto_pactado = str_replace(",",".",$this->input->post('monto_pactado'));
			$categoria = $this->input->post('categoria');
			$lugar_pago = $this->input->post('lugar_pago');

			$jubilado = $this->input->post('jubilado');
			$pensionado = $this->input->post('pensionado') == 'on' ? 1 : 0;
			//$regimen_pago = $this->input->post('regimen_pago');
			$regimen_pago = "NO";
			$sindicato = $this->input->post('sindicato');
			$semana_corrida = $this->input->post('semana_corrida');
			$fecafp = $this->input->post('datepicker5');
			$fecafc = $this->input->post('datepicker6');
			$fecvencplan = $this->input->post('datepicker9');
			$fecapvc = $this->input->post('datepicker10');
			$fectermsubsidio = $this->input->post('datepicker11');

			
			//var_dump($fecvencplan); exit;
			
			//$seguro_cesantia = $this->input->post('seguro_cesantia') == 'on' ? 1 : 0;
			$seguro_cesantia = $this->input->post('seguro_cesantia') == 'on' || $this->input->post('seguro_cesantia') == '1' ? 1 : 0;
			$parttime = $this->input->post('parttime') == 'on' ? 1 : 0;

			
			$region = $this->input->post('region');
			$comuna = $this->input->post('comuna');


			$asig_individual = $this->input->post('asig_individual');
			$asig_por_invalidez = $this->input->post('asig_por_invalidez');
			$asig_maternal = $this->input->post('asig_maternal');
			$banco = $this->input->post('banco');
			$tipo_cuenta_bancaria = $this->input->post('tipo_cuenta_bancaria');
			$plantilla_banco = $this->input->post('plantilla_banco');
			$forma_pago = $this->input->post('forma_pago');
			$cta_bancaria = $this->input->post('cta_bancaria');
			$apv = $this->input->post('apv');
			$numero_contrato_apv = $this->input->post('numero_contrato_apv');
			$tipo_cotizacion = $this->input->post('tipo_cotizacion');
			$cotapv = $this->input->post('monto_cotizacion_apv');

			if(isset($tipo_cotizacion)){
				if($tipo_cotizacion == 'pesos'){
					$cotapv = str_replace(".", "", $cotapv);
				}else if($tipo_cotizacion == 'uf'){
					$cotapv = str_replace(".", "", $cotapv);
					$cotapv = str_replace(",", ".", $cotapv);
				}
			}



			$regimenapv = $this->input->post('regimen_apv');
			$formapagoapv = $this->input->post('formapago_apv');


			$trabajo_pesado = $this->input->post('trabajo_pesado');

			$diastrabajo = $this->input->post('diastrabajo');
			$horasdiarias = str_replace(",",".",$this->input->post('horasdiarias')); 
			$horassemanales = str_replace(",",".",$this->input->post('horassemanales'));

			$motivo_egreso = $this->input->post('motivo_egreso');
			$tipo_cc = $this->input->post('tipo_cc');
			$seccion = $this->input->post('seccion');
			$situacion_laboral = $this->input->post('situacion_laboral');
			$clase = $this->input->post('clase');
			$codigo_ine = $this->input->post('codigo_ine');
			$zona_brecha = $this->input->post('zona_brecha');
			$numero_fun = $this->input->post('numero_fun');



			$rut_pago = str_replace(".","",$this->input->post("rutfp"));
			$arrayRutPago = explode("-",$rut_pago);
			$nombre_pago = $this->input->post('nombrefp');
			$email_pago = $this->input->post('emailfp');
			$usuario_windows = $this->input->post('usuario_windows');

			
			
			

			

			

			
			if($fecingreso !=null){
				$date = DateTime::createFromFormat('d/m/Y', $fecingreso);
				$fecingreso = $date->format('Ymd');
			}else{
				$fecingreso = null;
				//$seguro_cesantia =0;
			}

			if($fecha_retiro !=null){
				$date = DateTime::createFromFormat('d/m/Y', $fecha_retiro);
				$fecha_retiro = $date->format('Ymd');
			}else{
				$fecha_retiro = null;
				//$seguro_cesantia =0;
			}


			if($plazo_contrato !=null){
				$date = DateTime::createFromFormat('d/m/Y', $plazo_contrato);
				$plazo_contrato = $date->format('Ymd');
			}else{
				$plazo_contrato = null;
				//$seguro_cesantia =0;
			}

			if($fecha_finiquito !=null){
				$date = DateTime::createFromFormat('d/m/Y', $fecha_finiquito);
				$fecha_finiquito = $date->format('Ymd');
			}else{
				$fecha_finiquito = null;
				//$seguro_cesantia =0;
			}

			if($fecnacimiento !=null){
				$date = DateTime::createFromFormat('d/m/Y', $fecnacimiento);
				$fecnacimiento = $date->format('Ymd');
			}else{
				$fecnacimiento = null;
				//$seguro_cesantia =0;
			}


			if($fecha_inicio_vacaciones !=null){
				$date = DateTime::createFromFormat('d/m/Y', $fecha_inicio_vacaciones);
				$fecha_inicio_vacaciones = $date->format('Ymd');			
			}else{
				$fecha_inicio_vacaciones = null;
				//$seguro_cesantia =0;
			}


			if($fecrealcontrato !=null){
				$date = DateTime::createFromFormat('d/m/Y', $fecrealcontrato);
				$fecrealcontrato = $date->format('Ymd');			
			}else{
				$fecrealcontrato = null;
				//$seguro_cesantia =0;
			}



			if($primervenc !=null){
				$date = DateTime::createFromFormat('d/m/Y', $primervenc);
				$primervenc = $date->format('Ymd');			
			}else{
				$primervenc = null;
				//$seguro_cesantia =0;
			}



			if($fecvencplan !=null){
				$date = DateTime::createFromFormat('d/m/Y', $fecvencplan);
				$fecvencplan = $date->format('Ymd');			
			}else{
				$fecvencplan = null;
				//$seguro_cesantia =0;
			}



			if($fecapvc !=null){
				$date = DateTime::createFromFormat('d/m/Y', $fecapvc);
				$fecapvc = $date->format('Ymd');			
			}else{
				$fecapvc = null;
				//$seguro_cesantia =0;
			}




			if($fectermsubsidio !=null){
				$date = DateTime::createFromFormat('d/m/Y', $fectermsubsidio);
				$fectermsubsidio = $date->format('Ymd');			
			}else{
				$fectermsubsidio = null;
				//$seguro_cesantia =0;
			}



			if($fecafp !=null){

				$date = DateTime::createFromFormat('d/m/Y', $fecafp);
				$fecafp = $date->format('Ymd');
			}else{
				$fecafp = null;
				
			}

			if($fecafc !=null){

				$date = DateTime::createFromFormat('d/m/Y', $fecafc);
				$fecafc = $date->format('Ymd');
			}else{
				$fecafc = null;
				//$seguro_cesantia =0;
			}

			$array_datos = array(
								'id_empresa' => $this->session->userdata('empresaid'),
	       						'rut' => $idtrabajador == 0 ? $arrayRut[0] : "",
	       						'dv' => $idtrabajador == 0 ? $arrayRut[1] : "",
	       						'numficha' => $numficha,
								'nombre' => $nombre,
								'apaterno' => $apaterno,
								'amaterno' => $amaterno,
								'fecnacimiento' => $fecnacimiento,//substr($fecnacimiento,6,4).substr($fecnacimiento,0,2).substr($fecnacimiento,3,2),
								'idnacionalidad' => $idnacionalidad,
								'nacionalidad' => 'C', //ELIMINAR DESPUES
								'idecivil' => $idecivil,
								'sexo' => $sexo,
								'direccion' => $direccion,
								'email' => $email,
								'tiporenta' => $tiporenta,
                'idcargo' => $idcargo == '' ? 0 : $idcargo,
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
								'tipogratificacion' => $tipogratificacion,
								'gratificacion' => $gratificacion,
								'movilizacion' => $movilizacion,
								'colacion' => $colacion,
								'idasigfamiliar' => $tramo,
								'valorpactado' => $monto_pactado,
								'segcesantia' => $seguro_cesantia,
								'pensionado' => $pensionado,
								'fecinicvacaciones' => $fecha_inicio_vacaciones,
								'saldoinicvacaciones' => $saldoinicvacaciones,
								'saldoinicvacprog' => $saldoinicvacprog,
								'tipocontrato' => $tipocontrato,
								'plazo_contrato' => $plazo_contrato,
								'fecingreso' => $fecingreso,
								'fecha_retiro' => $fecha_retiro,
								'fecha_finiquito' => $fecha_finiquito,
								
								'id_lugar_pago' => $lugar_pago,
								'id_categoria' => $categoria,
								'jubilado' => $jubilado,
								'rol_privado' => $regimen_pago,
								'sindicato' => $sindicato,
								'semana_corrida' => $semana_corrida,
								'fecafp' => $fecafp,
								'fecafc' => $fecafc,
								'idregion' => $region,
								'idcomuna' => $comuna,
								'cargassimples' => $asig_individual,
								'cargasinvalidas' => $asig_por_invalidez,
								'cargasmaternales' => $asig_maternal,
								'idbanco' => $banco,
								'id_plantilla_banco' => $plantilla_banco,
								'id_tipo_cuenta_bancaria' => $tipo_cuenta_bancaria,
								'id_forma_pago' => $forma_pago,
								'nrocuentabanco' => $cta_bancaria,
								'instapv' => $apv,
								'nrocontratoapv' => $numero_contrato_apv,
								'tipocotapv' => $tipo_cotizacion,
								'cotapv' => $cotapv,
								'regimenapv' => $regimenapv,
								'formapagoapv' => $formapagoapv,
								'trabajo_pesado' => $trabajo_pesado,

								'id_motivo_egreso' => $motivo_egreso,
								'id_tipocc' => $tipo_cc,
								'id_seccion' => $seccion,
								'id_situacion' => $situacion_laboral,
								'id_clase' => $clase,
								'id_ine' => $codigo_ine,
								'id_zona' => $zona_brecha,
								'fecrealcontrato' => $fecrealcontrato,
								'primervenc' => $primervenc,
								'fun' => $numero_fun,
								'fecvencplan' => $fecvencplan,
								'fecapvc' => $fecapvc,
								'fectermsubsidio' => $fectermsubsidio,
	       						'rut_pago' => $idtrabajador == 0 ? $arrayRutPago[0] : "",
	       						'dv_pago' => $idtrabajador == 0 ? $arrayRutPago[1] : "",								
								'nombre_pago' => $nombre_pago,
								'email_pago' => $email_pago,
								'usuario_windows' => $usuario_windows,

								
								

								
								
																							
								
								//DATOS POR DEFECTO
								
									
								'diasprogresivos' => 0,
								'diasvactomados' => 0,
								'diasprogtomados' => 0,
								
								'parttime' => $parttime,
								//'pensionado' => 0,
								'diastrabajo' => $diastrabajo,
								'horasdiarias' => $horasdiarias,
								'horassemanales' => $horassemanales,
								//'sueldobase' => 250000,
								
								
								
								'cargasretroactivas' => 0,
								
								'asigfamiliar' => 0,
								
								
								'active' => 1,

								//OTROS
								'adicafp' => 0

								);



			$result = $this->rrhh_model->add_personal($array_datos,$idtrabajador);
			//EXIT;
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
    $content = array(
            'menu' => 'Error 403',
            'title' => 'Error 403',
            'subtitle' => '403 error');


      $vars['content_menu'] = $content;       
      $vars['content_view'] = 'forbidden';
      $this->load->view('template',$vars);

		}		


	}	


	public function mut_caja()
	{
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			$resultid = $this->session->flashdata('mut_caja_result');
			if($resultid == 1){
				$vars['message'] = "Mutual/Caja actualizada correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}
			$this->load->model('admin');
			$empresa = $this->admin->get_empresas($this->session->userdata('empresaid')); 
			$cajas = $this->admin->get_cajas_compensacion(); 
			$mutuales = $this->admin->get_mutual_seguridad(); 
			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Asignaci&oacute;n Familiar');


			$vars['formValidation'] = true;
			$vars['mask'] = true;			
			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'admins/mut_caja';
			$vars['gritter'] = true;
			$vars['cajas'] = $cajas;
			$vars['mutuales'] = $mutuales;			
			$vars['empresa'] = $empresa;	
			
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


	public function submit_mut_caja(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$array_datos = array(
							'idcaja' => $this->input->post('caja') == '' ? null :  $this->input->post('caja'),
							'idmutual' => $this->input->post('mutual') == '' ? null :  $this->input->post('mutual'),
							'porcmutual' => $this->input->post('porcmutual') == '' ? null :  $this->input->post('porcmutual')
							);
			$this->rrhh_model->update_caja_mutual($array_datos);

			$this->session->set_flashdata('mut_caja_result', 1);
			redirect('rrhh/mut_caja');	


		}else{
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}		


	}				

	public function centro_costo_periodo_abierto($idperiodo){
		if($idperiodo == null){}
			

		else{
			$centro_costo_periodo = $this->rrhh_model->get_centro_costo_periodo_abierto($idperiodo);
					
			echo json_encode($centro_costo_periodo);
		}
		
	}



	public function centro_costo_pendiente($idperiodo){

		
			$centro_costo_pendiente = $this->rrhh_model->get_centro_costo_pendiente($idperiodo);
			
			if ($centro_costo_pendiente == 0){

				echo json_encode('0');
			}else{

			echo json_encode($centro_costo_pendiente);
			}
		
	}

	public function centro_costo_no_calculado($mes,$anno){

		
			$centro_costo_no_calculado = $this->rrhh_model->get_centro_costo_no_calculado($mes,$anno);
					
			echo json_encode($centro_costo_no_calculado);
		
		
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
			}else if($resultid == 5){
        $vars['message'] = "Error al Calcular Remuneraciones. No se encuentran algunos indicadores para el per&iacute;odo seleccionado";
        $vars['classmessage'] = 'danger';
        $vars['icon'] = 'fa-ban';         
      }
			$mes = $this->session->flashdata('asistencia_mes') == '' ? date('m') : $this->session->flashdata('asistencia_mes');
			$anno = $this->session->flashdata('asistencia_anno') == '' ? date('Y') : $this->session->flashdata('asistencia_anno');
			$this->load->model('admin');
			//$centros_costo = $this->admin->get_centro_costo(null,'trabajadores');
			$centros_costo = $this->rrhh_model->get_centro_costo_no_calculado($mes,$anno);
			$periodos_remuneracion = $this->rrhh_model->get_periodos_remuneracion_abiertos_resumen(); 
			

			if ($periodos_remuneracion == null){
				$mes_curso = $mes;
				$anno_curso = $anno;
			}else{
				$mes_curso = $periodos_remuneracion[0]->mes;
				$anno_curso = $periodos_remuneracion[0]->anno;
			}

			$personal = $this->rrhh_model->get_personal(); 
			
			$array_remuneracion_trabajador = array();
			$mensajes = array();
			$mensaje_html = array();


      /***** ANALIZAR DATOS DE EMPRESA *****/


      $lista_centros_costo = $this->rrhh_model->get_centro_costo();
      $cant_centros_costo = count($lista_centros_costo);
      $cant_mensajes = 0;
      $array_mensajes = array();
      if($cant_centros_costo == 0){
          $array_mensajes[$cant_mensajes] = "No existen centros de costo creados";
          $cant_mensajes++;
      }

      $lista_col_sin_ccosto = $this->rrhh_model->get_colaborador_sin_centro_costo();
      $cant_col_sin_ccosto = count($lista_col_sin_ccosto);
      if($cant_col_sin_ccosto > 0){
          $array_mensajes[$cant_mensajes] = "<b>" . $cant_col_sin_ccosto."</b> Colaboradores sin centro de costo asociado"; 
          $cant_mensajes++;
      }

      $lista_col_sin_afp = $this->rrhh_model->get_colaborador_sin_afp();
      $cant_col_sin_afp = count($lista_col_sin_afp);
      if($cant_col_sin_afp > 0){
          $array_mensajes[$cant_mensajes] = "<b>" . $cant_col_sin_afp."</b> Colaboradores sin AFP asociada"; 
          $cant_mensajes++;
      }


      $lista_col_sin_isapre = $this->rrhh_model->get_colaborador_sin_isapre();
      $cant_col_sin_isapre = count($lista_col_sin_isapre);
      if($cant_col_sin_isapre > 0){
          $array_mensajes[$cant_mensajes] = "<b>" . $cant_col_sin_isapre."</b> Colaboradores sin Instituci&oacute;n de Salud asociada"; 
          $cant_mensajes++;
      }

      

        // mensaje afp
          // mensaje isapre



  


			
			/*var_dump(json_encode($periodos_remuneracion));
				die();*/
			foreach ($periodos_remuneracion as $periodo) {
				//$mensajes[$periodos->id] = array();


				//$centro_costo_periodo = $this->rrhh_model->get_centro_costo_periodo_abierto($periodo->id_periodo);
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

				$periodo->estado = $estado;

				/*$mensaje_html[$periodos->id] = "";
				if(count($mensajes[$periodos->id]) > 0){
					$mensaje_html[$periodos->id] .= "<ul>";
					foreach ($mensajes[$periodos->id] as $mensaje) {
						$mensaje_html[$periodos->id] .= "<li>" . $mensaje . "</li>";
					}
					$mensaje_html[$periodos->id] .= "</ul>";
				}*/

			}

	
     // var_dump_new($periodos_remuneracion); exit;

			//$estado = "Informaci&oacute;n Completa";
			//$periodos->estado = $estado;
			//$periodos_remuneracion->estado = $estado;
			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Calculo Remuneraci&oacute;n');

			$vars['mes_curso'] = $mes_curso;
			$vars['anno_curso'] = $anno_curso;
      $vars['mensajes'] = $array_mensajes;


			$vars['content_menu'] = $content;				
			$vars['mes'] = $mes;	
			$vars['anno'] = $anno;	
			$vars['periodos_remuneracion'] = $periodos_remuneracion;	
			$vars['formValidation'] = true;
			$vars['centros_costo'] = $centros_costo;
      $vars['gritter'] = true;
			//$vars['multipleSelect'] = true;
			//$vars['centro_costo_periodo'] = $centro_costo_periodo;	
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


public function get_datos_licencia($mes,$anno,$idtrabajador = null){

      $array_licencia = array();
      if($idtrabajador){
          $datos_licencia = $this->rrhh_model->get_licencia_medica($idtrabajador); 
          $dias_licencia = 0;
          foreach ($datos_licencia as $licencia) {
             $dias_licencia = $dias_licencia + dias_mes_rango(substr($licencia->fec_inicio_reposo,0,10),substr($licencia->fin_reposo,0,10),$anno.str_pad($mes,2,"0",STR_PAD_LEFT));

          }
          $array_licencia['dias_licencia'][$idtrabajador] = $dias_licencia;

      }else{

          $dias_licencia = array();
          $datos_licencia = $this->rrhh_model->get_licencia_medica();
           foreach ($datos_licencia as $licencia) {
             if(!isset($dias_licencia[$licencia->id_personal])){
                $dias_licencia[$licencia->id_personal] = 0;
             }

             $dias_licencia[$licencia->id_personal] = $dias_licencia[$licencia->id_personal] + dias_mes_rango(substr($licencia->fec_inicio_reposo,0,10),substr($licencia->fin_reposo,0,10),$anno.str_pad($mes,2,"0",STR_PAD_LEFT));

                $array_licencia['dias_licencia'][$licencia->id_personal] = $dias_licencia[$licencia->id_personal];

          }

          //$array_licencia[$idtrabajador]['dias_licencia'] = $dias_licencia;

          //var_dump_new($array_licencia);
      }

      echo json_encode($array_licencia);
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

      //var_dump($_POST); exit;

			//if($mes == '' || $anno == ''){
			if(empty($mes) && empty($anno)){
				$this->session->set_flashdata('calculo_remuneraciones_result', 2);
				redirect('rrhh/calculo_remuneraciones');	
			}else{
				#EN CASO QUE NO EXISTAN DATOS INICIALES, SE CARGAN AHORA
        //var_dump_new($centro_costo);
				foreach ($centro_costo as $centros_costo) {
					//var_dump_new($centros_costo);
					$idperiodo = $this->rrhh_model->set_datos_iniciales_periodo_rem($mes,$anno,$centros_costo); 
				}
				

			}
      //exit;


			set_time_limit(0);
			$datos_remuneracion = $this->rrhh_model->get_datos_remuneracion_by_periodo($idperiodo); 
      //var_dump_new($datos_remuneracion);
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
      //var_dump_new($periodo_remuneracion);
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
          //var_dump_new($centro_costo); exit;


        $parametros = array();
        $parametros['uf'] = $this->admin->get_indicadores_by_periodo($idperiodo,'UF');
        $parametros['topeimponible'] = $this->admin->get_indicadores_by_periodo($idperiodo,'Tope Imponible AFP');
        $parametros['topeimponibleips'] = $this->admin->get_indicadores_by_periodo($idperiodo,'Tope Imponible IPS');
        $parametros['topeimponibleafc'] = $this->admin->get_indicadores_by_periodo($idperiodo,'Tope Imponible AFC');
        $parametros['sueldominimo'] = $this->admin->get_indicadores_by_periodo($idperiodo,'Sueldo Minimo');
        $parametros['utm'] = $this->admin->get_indicadores_by_periodo($idperiodo,'UTM');
        $parametros['tasasis'] = $this->admin->get_indicadores_by_periodo($idperiodo,'Tasa SIS');


        if($parametros['uf'] == -1 || $parametros['topeimponible'] == -1 ||  $parametros['topeimponibleips'] == -1 ||  $parametros['topeimponibleafc'] == -1 ||  $parametros['sueldominimo'] == -1 ||  $parametros['utm'] == -1){
              $this->session->set_flashdata('calculo_remuneraciones_result', 5);
              redirect('rrhh/calculo_remuneraciones');


        }



          foreach ($centro_costo as $centros_costo) {
				    $this->rrhh_model->calcular_remuneraciones($idperiodo,$centros_costo); 
            }          
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



	public function detalle($idperiodo = null,$idcentrocosto = null)
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){


			/*if(is_null($idperiodo)){
				redirect('main/dashboard/');

			}*/

			$idcentrocosto = is_null($this->input->post('centrocosto'))  ? $idcentrocosto : $this->input->post('centrocosto');

			$idcentrocosto = $idcentrocosto == 0 ? null : $idcentrocosto;
      

//var_dump_new($idperiodo);
  //    var_dump_new($idcentrocosto); exit;


			$datosperiodo = $this->rrhh_model->get_periodos_cerrados_detalle($this->session->userdata('empresaid'),$idperiodo,$idcentrocosto);


			//var_dump($datosperiodo); exit;
			//$centros_costo = $this->rrhh_model->get_centro_costo();
			$centros_costo = $this->rrhh_model->get_centro_costo_periodo_abierto($idperiodo);

 //echo "asdasd"; exit;
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



  public function detalle_total($idcentrocosto = null)
  {

    if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){


      $resultid = $this->session->flashdata('detalle_total_result');
      if($resultid == 1){
        $vars['message'] = "Error al imprimir liquidaciones.  No se especifica per&iacute;odo";
        $vars['classmessage'] = 'danger';
        $vars['icon'] = 'fa-ban';   
      }else if($resultid == 2){
        $vars['message'] = "Error al imprimir liquidaciones.  Per&iacute;odo no se encuentra cerrado";
        $vars['classmessage'] = 'danger';
        $vars['icon'] = 'fa-ban';   
      }else if($resultid == 3){
        $vars['message'] = "Error al imprimir liquidaciones.  No se encontraron datos para el per&iacute;odo";
        $vars['classmessage'] = 'danger';
        $vars['icon'] = 'fa-ban';   
      }


      $idcentrocosto = is_null($this->input->post('centrocosto'))  ? $idcentrocosto : $this->input->post('centrocosto');

      $idcentrocosto = $idcentrocosto == 0 ? null : $idcentrocosto;
      
      $datosperiodo = $this->rrhh_model->get_periodos_aprobados_detalle($this->session->userdata('empresaid'),null,$idcentrocosto);


      //var_dump($datosperiodo); exit;
      //$centros_costo = $this->rrhh_model->get_centro_costo();
      $centros_costo = $this->rrhh_model->get_centro_costo();

 //echo "asdasd"; exit;
      $content = array(
            'menu' => 'Remuneraciones',
            'title' => 'Remuneraciones',
            'subtitle' => 'Detalle Remuneraciones');

          
      $vars['content_menu'] = $content;       
      $vars['content_view'] = 'remuneraciones/detalle_total';
      $vars['datosperiodo'] = $datosperiodo;
      $vars['centros_costo'] = $centros_costo;
      $vars['idcentrocosto'] = $idcentrocosto;
      $vars['gritter'] = true;

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


  public function liquidaciones($idperiodo = null,$idcentrocosto = null)
  {

    if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
      set_time_limit(0);
      if(is_null($idperiodo)){
        $this->session->set_flashdata('detalle_total_result',1);
        redirect('rrhh/detalle_total/'); 
      }


      //no es necesario validar centro de costo.  Si no viene, se imprime todo
      $periodo = $this->rrhh_model->get_periodos($this->session->userdata('empresaid'), $idperiodo,$idcentrocosto);
     // var_dump_new($periodo); exit;
      if(is_null($periodo->cierre)){
        $this->session->set_flashdata('detalle_total_result',2);
        redirect('rrhh/detalle_total/'); 
      }


      $remuneraciones = $this->rrhh_model->get_remuneraciones_by_periodo($idperiodo,null,$idcentrocosto);

      if(count($remuneraciones) == 0){
        $this->session->set_flashdata('detalle_total_result',3);
        redirect('rrhh/detalle_total/');
      }
      $datosdetalle = $this->rrhh_model->liquidaciones($remuneraciones);
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

	public function listado_hab_descto_variable(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$resultid = $this->session->flashdata('hab_descto_variable_result');
			if($resultid == 1){
				$vars['message'] = "Haber/Descuento Agregado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}elseif($resultid == 2){
				$vars['message'] = "Error al agregar Haber y/o Descuentos Variables";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 3){
				$vars['message'] = "Error al eliminar Haber y/o Descuentos Variable";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 4){
				$vars['message'] = "Haber/Descuento Eliminado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}

			$haberes_descuentos = $this->rrhh_model->get_haberes_descuentos_totales_validos(); 

			$content = array(
						'menu' => 'Configuraciones',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Haberes / Descuentos');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'rrhh/listado_hab_descto_variable';
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


	public function delete_haber_descto($id_hab_descto = '')
	{
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){



			if($id_hab_descto == ''){
				$this->session->set_flashdata('hab_descto_variable_result',3);
				redirect('rrhh/listado_hab_descto_variable');	
			}


			$result = $this->rrhh_model->delete_haber_descto_variable($id_hab_descto);


			$this->session->set_flashdata('hab_descto_variable_result',4);
			redirect('rrhh/listado_hab_descto_variable');	
			
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

      //var_dump_new($periodo); exit;
			if(is_null($periodo->cierre)){
				redirect('main/dashboard/');
			}else{
				$remuneraciones = $this->rrhh_model->get_remuneraciones_by_periodo($idperiodo,true,$idcentrocosto);


				if(count($remuneraciones) == 0){ // SI NO ENCUENTRO NINGUNA REMUNERACION (QUIERE DECIR QUE NO EXISTIAN TRABAJADORES EN ESE PERIODO)
					redirect('main/dashboard/');
				}else{
          $this->load->model('excel_model');
					$datosdetalle = $this->excel_model->libro($remuneraciones);
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


public function exporta_colaborador($idpersonal = null)
	{
		
		//if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			set_time_limit(0);

			//$periodo = $this->rrhh_model->get_periodos($this->session->userdata('empresaid'),$idperiodo);
			$datos_colaborador = $this->rrhh_model->get_personal_datos($idpersonal);
      $this->load->model('excel_model');
			if(is_null($idpersonal)){
				//redirect('main/dashboard/');
				$datosdetalle = $this->excel_model->exporta_colaborador($datos_colaborador);
			}else{
				
					$datosdetalle = $this->excel_model->exporta_colaborador($datos_colaborador);
				}

		
			exit;


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



public function lre($idperiodo = null,$idcentrocosto = null)
    {

         if ($this->ion_auth->is_allowed($this->router->fetch_class(), $this->router->fetch_method())) {

            set_time_limit(0);
            
      
            $periodo = $this->rrhh_model->get_periodos($this->session->userdata('empresaid'), $idperiodo,$idcentrocosto);

            if (is_null($periodo->cierre)) {
                redirect('main/dashboard/');
            } else {
                $remuneraciones = $this->rrhh_model->get_remuneraciones_by_periodo($idperiodo,true,$idcentrocosto);
                if (count($remuneraciones) == 0) { // SI NO ENCUENTRO NINGUNA REMUNERACION (QUIERE DECIR QUE NO EXISTIAN TRABAJADORES EN ESE PERIODO)
                    redirect('main/dashboard/');
                } else {
                    $datosdetalle = $this->rrhh_model->lre($remuneraciones,$periodo);
                }
            }


            exit;
        } else {
            $content = array(
                'menu' => 'Error 403',
                'title' => 'Error 403',
                'subtitle' => '403 error'
            );


            $vars['content_menu'] = $content;
            $vars['content_view'] = 'forbidden';
            $this->load->view('template', $vars);
        }
    }


public function previred($idperiodo = null,$idcentrocosto = null)
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			set_time_limit(0);
        //var_dump($this->session->userdata('empresaid'));
        //var_dump($idperiodo); exit;
			$periodo = $this->rrhh_model->get_periodos($this->session->userdata('empresaid'),$idperiodo,$idcentrocosto);
			//var_dump($periodo); exit;
			if(is_null($periodo->cierre)){
				redirect('main/dashboard/');
			}else{
				$remuneraciones = $this->rrhh_model->get_remuneraciones_by_periodo($idperiodo,true,$idcentrocosto);
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

	public function pago_bancos($id_periodo = null){

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$this->load->model('configuracion');
			$bancos = $this->admin->get_bancos();			
			$datos_plantilla_banco = array();			
			
			$cabecera_plantilla_banco = $this->configuracion->get_plantilla_banco();	

			//echo "<pre>";
			//print_r($cabecera_plantilla_banco); exit;
			//var_dump($cabecera_plantilla_banco);

			foreach ($cabecera_plantilla_banco as $cabecera ) {
					$datos_personal = $this->configuracion->get_personal_plantilla($id_periodo, $cabecera->id_plantilla_banco);
					//print_r($datos_personal); exit;
					if($datos_personal != null){
						$datos_plantilla_banco = $this->configuracion->get_det_plantilla_banco_export($cabecera->id_plantilla_banco);									
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
						//echo "pasa<br>"; 
						$plantilla_banco = $this->configuracion->exporta_plantilla_banco($datos_personal,$cabecera->descripcion,$nombre_tabla,$largo_campo);
					}	
			 
			}
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

/*
	public function pago_bancos($idperiodo = null)
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
					$datosdetalle = $this->rrhh_model->pago_bancos($remuneraciones);
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

	}*/


	public function ver_remuneraciones_periodo($tipo_visualiza,$idperiodo = '',$idcentrocosto = null)
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$idcentrocosto = is_null($this->input->post('centrocosto'))  ? $idcentrocosto : $this->input->post('centrocosto');
			$idcentrocosto = $idcentrocosto == 0 ? null : $idcentrocosto;

      if(is_null($tipo_visualiza)){
        redirect('main/dashboard/');
      }

      if($tipo_visualiza == 1){
        $url_back = "rrhh/detalle/".$idperiodo."/".$idcentrocosto;
      }else if($tipo_visualiza == 2){
        $url_back = "rrhh/detalle_total";
      }else{
        redirect('main/dashboard/');
      }

			$remuneraciones = $this->rrhh_model->get_remuneraciones_by_periodo($idperiodo,true,$idcentrocosto);
      //var_dump_new($remuneraciones); exit;
			$datosperiodo = $this->rrhh_model->get_periodos($this->session->userdata('empresaid'),$idperiodo);
			//$centros_costo = $this->rrhh_model->get_centro_costo();
			$centros_costo = $this->rrhh_model->get_centro_costo_periodo_abierto($idperiodo);


			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Ver Remuneraciones Per&iacute;odo');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'remuneraciones/ver_remuneraciones_periodo';
			$vars['remuneraciones'] = $remuneraciones;
			$vars['datosperiodo'] = $datosperiodo;
      $vars['url_back'] = $url_back;
			$vars['idcentrocosto'] = $idcentrocosto;
			$vars['centros_costo'] = $centros_costo;

			$vars['idperiodo'] = $idperiodo;

			

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







public function ver_planillas_imposiciones($idperiodo = '',$idcentrocosto = null)
  {

    if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

      if($idperiodo == ''){
        redirect('main/dashboard/');
      }

      $idcentrocosto = is_null($this->input->post('centrocosto'))  ? $idcentrocosto : $this->input->post('centrocosto');
      $idcentrocosto = $idcentrocosto == 0 ? null : $idcentrocosto;



      $isapres_planillas = $this->rrhh_model->get_planillas_imposiciones($idperiodo,$idcentrocosto,'ISAPRE');
      $afps_planillas = $this->rrhh_model->get_planillas_imposiciones($idperiodo,$idcentrocosto,'AFP');
      $caja_planillas = $this->rrhh_model->get_planillas_imposiciones($idperiodo,$idcentrocosto,'CAJA');
      $mutual_planillas = $this->rrhh_model->get_planillas_imposiciones($idperiodo,$idcentrocosto,'MUTUAL');

     
      //$centros_costo = $this->rrhh_model->get_centro_costo();


      $content = array(
            'menu' => 'Remuneraciones',
            'title' => 'Remuneraciones',
            'subtitle' => 'Ver Planillas Imposiciones');

      $vars['content_menu'] = $content;       
      $vars['content_view'] = 'remuneraciones/ver_planillas_imposiciones';
      $vars['idcentrocosto'] = $idcentrocosto;
      $vars['isapres_planillas'] = $isapres_planillas;
      $vars['afps_planillas'] = $afps_planillas;
      $vars['caja_planillas'] = $caja_planillas;
      $vars['mutual_planillas'] = $mutual_planillas;

      $vars['idperiodo'] = $idperiodo;

      

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


public function ver_remuneraciones_colaborador($idperiodo = '',$idcentrocosto = null)
	{

		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$remuneraciones = $this->rrhh_model->get_remuneracion_colaborador();
			//$datosperiodo = $this->rrhh_model->get_periodos($this->session->userdata('empresaid'),$idperiodo);

			$content = array(
						'menu' => 'Ver',
						'title' => 'Ver',
						'subtitle' => 'Propiedades');

			$vars['content_menu'] = $content;				
			$vars['content_view'] = 'remuneraciones/ver_remuneraciones_colaborador';
			$vars['remuneraciones'] = $remuneraciones;
			//$vars['datosperiodo'] = $datosperiodo;

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
      set_time_limit(0);
			$remuneracion = $this->rrhh_model->get_remuneraciones_by_id($idremuneracion);
			//echo "<pre>";
     // var_dump($remuneracion);
 			//print_r(count(get_object_vars($remuneracion))); exit;
			if(!isset($remuneracion)){ // SI NO ENCUENTRO NINGUNA REMUNERACION (CORRESPONDE A OTRA EMPRESA POR EJEMPLO)
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


  public function ultima_liquidacion($idpersonal = null)
  {

    if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
      set_time_limit(0);
      
      //echo "<pre>";
     // print_r($remuneracion);
      //print_r(count(get_object_vars($remuneracion))); exit;
     if(is_null($idpersonal)){ // SI NO ENCUENTRO NINGUNA REMUNERACION (CORRESPONDE A OTRA EMPRESA POR EJEMPLO)
            $this->session->set_flashdata('personal_result', 11);
           redirect('rrhh/mantencion_personal'); 
     }

     $ultima_remuneracion = $this->rrhh_model->get_ultima_remuneracion($idpersonal);
     

     if(count($ultima_remuneracion) == 0){
          $this->session->set_flashdata('personal_result', 12);
           redirect('rrhh/mantencion_personal'); 
     }

     $idremuneracion = $ultima_remuneracion[0]->id_remuneracion;
     $remuneracion = $this->rrhh_model->get_remuneraciones_by_id($idremuneracion);
     $datosdetalle = $this->rrhh_model->liquidacion($remuneracion);

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




public function historico_sueldos($idpersonal = null)
  {

    if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){


     if(is_null($idpersonal)){ // SI NO ENCUENTRO NINGUNA REMUNERACION (CORRESPONDE A OTRA EMPRESA POR EJEMPLO)
            $this->session->set_flashdata('personal_result', 13);
           redirect('rrhh/mantencion_personal'); 
     }

     $personal = $this->rrhh_model->get_personal($idpersonal);
      if(is_null($personal)){
        $this->session->set_flashdata('personal_result', 14);
        redirect('rrhh/mantencion_personal');  
      }



     $remuneraciones = $this->rrhh_model->get_remuneraciones_by_colaborador($idpersonal,null);
     //var_dump_new($remuneraciones); exit;
      $content = array(
            'menu' => 'Remuneraciones',
            'title' => 'Remuneraciones',
            'subtitle' => 'Ver Hist&oacute;rico Sueldos');

      $vars['content_menu'] = $content;       
      $vars['content_view'] = 'rrhh/historico_sueldos';
      $vars['remuneraciones'] = $remuneraciones;
      $vars['personal'] = $personal;

      

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



 public function licencias_colaborador($idpersonal = null)
  {

    if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
  
      //echo "<pre>";
     // print_r($remuneracion);
      //print_r(count(get_object_vars($remuneracion))); exit;
     if(is_null($idpersonal)){ // SI NO ENCUENTRO NINGUNA REMUNERACION (CORRESPONDE A OTRA EMPRESA POR EJEMPLO)
            $this->session->set_flashdata('personal_result', 15);
           redirect('rrhh/mantencion_personal'); 
     }

     $personal = $this->rrhh_model->get_personal($idpersonal);
      if(is_null($personal)){
        $this->session->set_flashdata('personal_result', 16);
        redirect('rrhh/mantencion_personal');  
      }


     $this->load->model('auxiliar'); 
     $licencias = $this->auxiliar->get_licencias_by_colaborador($idpersonal);
  
     $content = array(
            'menu' => 'Remuneraciones',
            'title' => 'Remuneraciones',
            'subtitle' => 'Ver Licencias Colaborador');

      $vars['content_menu'] = $content;       
      $vars['content_view'] = 'rrhh/licencias_colaborador';
      $vars['licencias'] = $licencias;
      $vars['personal'] = $personal;

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



 

public function liquidacion_colaborador($idremuneracion = null)
	{

		
			// se reemplaza provisoriamente mientras se validan las variables de session
			//$remuneracion = $this->rrhh_model->get_remuneraciones_by_id($idremuneracion);
			$remuneracion = $this->rrhh_model->get_remuneraciones_by_colaborador($idremuneracion);

			if(count($remuneracion) == 0){ // SI NO ENCUENTRO NINGUNA REMUNERACION (CORRESPONDE A OTRA COMUNIDAD POR EJEMPLO)
				redirect('main/dashboard/');
			}else if(is_null($remuneracion->cierre)){
				redirect('main/dashboard/'); // SI NO ES UN PERIODO CERRADO, SE ENVÍA AL DASHBOARD
			}else{
				//$datamensaje['mensaje'] = "BORRADOR";
				$datosdetalle = $this->rrhh_model->liquidacion($remuneracion);
			}

			exit;


		

	}	



	public function aprueba_remuneraciones($idperiodo = 0){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			
			$idperiodo = $this->input->post('id_periodo3');

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


	public function rechaza_remuneraciones($idperiodo = 0){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			set_time_limit(0);

			$centro_costo = $this->input->post('centro_costo2');
			$id_periodo = $this->input->post('id_periodo2');
      var_dump_new($_POST);
			foreach ($centro_costo as $centros_costo) {
				# code...
				$publicar = $this->rrhh_model->rechazar_remuneracion($id_periodo,$centros_costo);
			}
			

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
			}elseif($resultid == 3){
				$vars['message'] = "Asistencia Cargada Correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-ban';
			}

			//$this->load->model('admin');
			//$comunidad = $this->admin->get_comunidades($this->session->userdata('comunidadid')); 

			$mes = $this->session->flashdata('asistencia_mes') == '' ? date('m') : $this->session->flashdata('asistencia_mes');
			$anno = $this->session->flashdata('asistencia_anno') == '' ? date('Y') : $this->session->flashdata('asistencia_anno');



			$personal = $this->rrhh_model->get_personal(); 
			$datos_remuneracion = $this->rrhh_model->get_datos_remuneracion($mes,$anno); 
      //echo "<pre>";
      //var_dump($personal); exit;
      $licencias = array();
      foreach ($personal as $trabajador) {
        $datos_licencia = $this->rrhh_model->get_licencia_medica($trabajador->id_personal); 
        
        //echo $anno.$mes;
        //dias_mes_rango()
       // var_dump($datos_licencia); 
        $dias_licencia = 0;
        foreach ($datos_licencia as $licencia) {
            //print_r($licencia);
            //echo "<br>".$dias_licencia."<br>";
           $dias_licencia = $dias_licencia + dias_mes_rango(substr($licencia->fec_inicio_reposo,0,10),substr($licencia->fin_reposo,0,10),$anno.str_pad($mes,2,"0",STR_PAD_LEFT));

        }
        $licencias[$trabajador->id_personal] = $dias_licencia;
        //echo $dias_licencia."<br>"; 


      }
      
      //var_dump_new($licencias); exit;
     // exit;

			$array_remuneracion_trabajador = array();
			foreach ($datos_remuneracion as $remuneracion) {
				$array_remuneracion_trabajador[$remuneracion->idpersonal] = $remuneracion->diastrabajo;
       
        //print_r($datos_licencia);
			}

      //exit;
			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Asistencia');

			$vars['content_menu'] = $content;				
			$vars['personal'] = $personal;	
			$vars['datos_remuneracion'] = $array_remuneracion_trabajador;	
      $vars['licencias'] = $licencias; 
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
			}elseif($resultid == 3){
				$vars['message'] = "Horas Extraordinarias agregadas correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';
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



	public function anticipos($resultid = '')
	{
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){


			$resultid = $this->session->flashdata('anticipos_result');
			if($resultid == 1){
				$vars['message'] = "Anticipos agregados correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}elseif($resultid == 2){
				$vars['message'] = "Error al agregar Anticipos";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 3){
				$vars['message'] = "Error al traspasar datos anticipos";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 4){
				$vars['message'] = "Datos de Anticipos traspasados correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}elseif($resultid == 5){
				$vars['message'] = "Error al reversar traspaso de anticipos";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';	
			}elseif($resultid == 6){
				$vars['message'] = "Traspaso de Anticipos reversados correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}elseif($resultid == 7){
				$vars['message'] = "Error al reversar traspaso de anticipos.  Ya existen pagos asociados";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';	
			}elseif($resultid == 8){
				$vars['message'] = "Error al reversar traspaso de anticipos.  Cuentas ya autorizadas en gasto com&uacute;n";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';	
			}

			//$this->load->model('admin');
			//$comunidad = $this->admin->get_comunidades($this->session->userdata('comunidadid')); 

			$mes = $this->session->flashdata('anticipos_mes') == '' ? date('m') : $this->session->flashdata('anticipos_mes');
			$anno = $this->session->flashdata('anticipos_anno') == '' ? date('Y') : $this->session->flashdata('anticipos_anno');



			$personal = $this->rrhh_model->get_personal(); 
			$datos_remuneracion = $this->rrhh_model->get_datos_remuneracion($mes,$anno); 
			$array_remuneracion_trabajador = array();
			foreach ($datos_remuneracion as $remuneracion) {
				$array_remuneracion_trabajador['anticipo'][$remuneracion->idpersonal] = $remuneracion->anticipo;
				$array_remuneracion_trabajador['aguinaldo'][$remuneracion->idpersonal] = $remuneracion->aguinaldo;
			}


			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Anticipos');

			$vars['content_menu'] = $content;				
			$vars['personal'] = $personal;	
			$vars['datos_remuneracion'] = $array_remuneracion_trabajador;	
			$vars['mes'] = $mes;	
			$vars['anno'] = $anno;	
			$vars['content_view'] = 'rrhh/anticipos';
			$vars['formValidation'] = true;
			$vars['maleta'] = true;	
			$vars['mask'] = true;
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



	public function get_status_rem($tipo_status,$mes,$anno){


		if($tipo_status == 'calculo'){


      $lista_centros_costo = $this->rrhh_model->get_centro_costo();
      $lista_col_sin_ccosto = $this->rrhh_model->get_colaborador_sin_centro_costo();


      $cant_centros_costo = count($lista_centros_costo); 
      $cant_col_sin_ccosto = count($lista_col_sin_ccosto);


      

      //obtiene centros de costo sin calcular
			$centros_costo = $this->rrhh_model->get_centro_costo_no_calculado($mes,$anno);
      // si no existen centros de costo sin calcular, se asume que está listo
      // esto es incorrecto en caso de que colaboradores no estén asociados a un centro de costo

      //asociar a un centro de costo genérico
      if($cant_centros_costo == 0){
          $estado_periodo = 1; // no existen centros de costo
      }else if ($cant_col_sin_ccosto > 0){
          $estado_periodo = 3;  // existen colaboradores sin centros de costo
      }else if (count($centros_costo) > 0){
          $estado_periodo = 2; //existen centro de costo, colaboradores están asociados, pero no se han calculado
      }else{
          $estado_periodo = 0;
      }
			//$estado_periodo = count($centros_costo) > 0 ? 2 : 0;
		}else{
			$estado_periodo = $this->rrhh_model->get_estado_periodo($mes,$anno);
		}
		
		//OPCIONES:  ES NUEVO, YA SE CREO, YA ESTÁ CERRADO
    if($estado_periodo == 1){
      if($tipo_status == 'calculo'){
        $array_result['label_style'] = 'label-danger';
        $array_result['label_text'] = 'No existen centros de costo creados';
        $array_result['status'] = 'nuevo';
      }else{
        $array_result['label_style'] = 'label-success';
        $array_result['label_text'] = 'Datos ingresados (puede editar informaci&oacute;n)';
        $array_result['status'] = 'ingresado';    
      }           
    }else if($estado_periodo == 3){ // NO EXISTE, ES NUEVO

        $array_result['label_style'] = 'label-danger';
        $array_result['label_text'] = 'Existen colaboradores sin centro de costo asociado';
        $array_result['status'] = 'nuevo';
    }else if($estado_periodo == 2){ // NO EXISTE, ES NUEVO
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

					if(count(get_object_vars($datos_remuneracion)) == 0){
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
   // var_dump_new ($_POST); exit;
		if($valid){

			if($tipo_status == 'calculo'){

        $lista_centros_costo = $this->rrhh_model->get_centro_costo();
        $lista_col_sin_ccosto = $this->rrhh_model->get_colaborador_sin_centro_costo();

        $cant_centros_costo = count($lista_centros_costo); 
        $cant_col_sin_ccosto = count($lista_col_sin_ccosto);

				$centros_costo = $this->rrhh_model->get_centro_costo_no_calculado($this->input->post('mes'),$this->input->post('anno'));

        if($cant_centros_costo == 0){
            $estado_periodo = 5; // no existen centros de costo
        }else if ($cant_col_sin_ccosto > 0){
            $estado_periodo = 4;  // existen colaboradores sin centros de costo
        }else if (count($centros_costo) > 0){
            $estado_periodo = 2; //existen centro de costo, colaboradores están asociados, pero no se han calculado
        }else{
            $estado_periodo = 0;
        }


				 //$estado_periodo = count($centros_costo) > 0 ? 2 : 0;
			}else{
				$estado_periodo = $this->rrhh_model->get_estado_periodo($this->input->post('mes'),$this->input->post('anno'));	
			}
			//echo "estado_periodo:".$estado_periodo;


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
					$array_trabajadores[$arr_el[1]] =  str_replace(",",".",$value_elem);
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

    //  var_dump_new($array_elem); exit;
			foreach($array_elem as $elem => $value_elem){
				$arr_el = explode("_",$elem);
				if($arr_el[0] == 'horas50'){
					$array_trabajadores[$arr_el[1]]['horas50'] = str_replace(",",".",$value_elem);
				}

				if($arr_el[0] == 'monto50'){
					$array_trabajadores[$arr_el[1]]['monto50'] = str_replace($value_elem,".","");
				}

				if($arr_el[0] == 'horas100'){
					$array_trabajadores[$arr_el[1]]['horas100'] = str_replace(",",".",$value_elem);
				}

				if($arr_el[0] == 'monto100'){
					$array_trabajadores[$arr_el[1]]['monto100'] = str_replace($value_elem,".","");
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




public function submit_anticipos(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$mes = $this->input->post('mes');
			$anno = $this->input->post('anno');

			//if($mes == '' || $anno == ''){
			if(empty($mes) && empty($anno)){	
				$this->session->set_flashdata('anticipos_result', 2);
				redirect('rrhh/anticipos');	
			}


			$array_elem = $this->input->post(NULL,true);
			$array_trabajadores = array();
			foreach($array_elem as $elem => $value_elem){
				$arr_el = explode("_",$elem);
				if($arr_el[0] == 'anticipo'){
					$array_trabajadores[$arr_el[1]]['anticipo'] = str_replace(".","",$value_elem);
				}

				if($arr_el[0] == 'aguinaldo'){
					$array_trabajadores[$arr_el[1]]['aguinaldo'] = str_replace(".","",$value_elem);
				}

			}


			$this->rrhh_model->save_anticipo($array_trabajadores,$mes,$anno);

			$this->session->set_flashdata('anticipos_result', 1);
			$this->session->set_flashdata('anticipos_mes', $mes);
			$this->session->set_flashdata('anticipos_anno', $anno);
			redirect('rrhh/anticipos');	


		}else{
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}		


	}	


	public function hab_descto_variable(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			
			$mes = $this->session->flashdata('hab_descto_mes') == '' ? date('m') : $this->session->flashdata('hab_descto_mes');
			$anno = $this->session->flashdata('hab_descto_anno') == '' ? date('Y') : $this->session->flashdata('hab_descto_anno');




			$this->load->model('admin');
			$centros_costo = $this->admin->get_centro_costo();
			$content = array(
						'menu' => 'Configuraciones',
						'title' => 'Configuraciones',
						'subtitle' => 'Creaci&oacute;n Haberes / Descuentos');

			$vars['content_menu'] = $content;				
			$vars['centros_costo'] = $centros_costo;	
			$vars['mes'] = $mes;	
			$vars['anno'] = $anno;							
			$vars['content_view'] = 'rrhh/hab_descto_variable';
			$vars['formValidation'] = true;
			$vars['maleta'] = true;	
			$vars['mask'] = true;			
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

	public function submit_genera_contrato(){

		$tipo = $this->input->post("tipo");
		$fecha = $this->input->post("fechacontrato");
		$idtrabajador = $this->input->post("idtrabajador");

		$personal = $this->admin->get_personal_total($idtrabajador);

		$this->rrhh_model->generar_contrato($personal,$tipo,$fecha,$idtrabajador);

		redirect('rrhh/contrato_colaborador/',$idtrabajador);


		
	}

	public function submit_genera_carta(){

		$tipo = $this->input->post("tipo");
		$fecha = $this->input->post("fechacontrato");
		$idtrabajador = $this->input->post("idtrabajador");

		$personal = $this->admin->get_personal_total($idtrabajador);

		$this->rrhh_model->generar_carta($personal,$tipo,$fecha,$idtrabajador);

		//redirect('rrhh/contrato_colaborador/',$idtrabajador);


		
	}

	public function submit_genera_contrato_personal($tipo){

		
		$this->rrhh_model->generar_contrato_personal($tipo);

		//redirect('rrhh/contrato_colaborador/',$idtrabajador);


		
	}

	public function submit_genera_carta_personal($tipo){

		
		$this->rrhh_model->generar_contrato_personal($tipo);

		//redirect('rrhh/contrato_colaborador/',$idtrabajador);


		
	}

	public function submit_genera_finiquito_personal($tipo){

		
		$this->rrhh_model->generar_contrato_personal($tipo);

		//redirect('rrhh/contrato_colaborador/',$idtrabajador);


		
	}

	public function submit_genera_tipo_documento($tipo){

		
		$this->rrhh_model->generar_tipo_documento($tipo);

		//redirect('rrhh/contrato_colaborador/',$idtrabajador);


		
	}

	
	public function submit_genera_finiquito(){

		$tipo = $this->input->post("tipo");
		$fecha = $this->input->post("fechacontrato");
		$idtrabajador = $this->input->post("idtrabajador");

		$personal = $this->admin->get_personal_total($idtrabajador);



		
		
	}

	public function submit_hab_descto_variable(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$array_post = $this->input->post(NULL,true);

			$tipo = $this->input->post('tipo');
			$id_hab_descto = $this->input->post('hab_descto');
			$array_col = array();
			$array_montos = array();
			foreach ($array_post as $key => $value) {
				$array_key = explode("-",$key);
				if($array_key[0] == 'sel_col'){
					array_push($array_col,$array_key[1]);
				}

				if($array_key[0] == 'monto_col'){
					$array_montos[$array_key[1]] = $value;
				}
			}

			$mes = $this->input->post('mes');
			$anno = $this->input->post('anno');

			if(empty($mes) || empty($anno) || empty($tipo) || empty($id_hab_descto) ){	
				$this->session->set_flashdata('hab_descto_variable_result', 2);
				redirect('rrhh/hab_descto_variable');	
			}
			

			$array_datos_hab_descto = array('id_hab_descto' => $id_hab_descto,
											 'mes' => $mes,
											 'anno' => $anno,
											 'listado_col' => $array_col,
											 'lista_montos' => $array_montos );


			$this->rrhh_model->save_hab_descto_variable($array_datos_hab_descto);

			$this->session->set_flashdata('hab_descto_variable_result', 1);
			$this->session->set_flashdata('hab_descto_mes', $mes);
			$this->session->set_flashdata('hab_descto_anno', $anno);
			redirect('rrhh/listado_hab_descto_variable');	


		}else{
			$vars['content_view'] = 'forbidden';
			$this->load->view('template',$vars);

		}		


	}
	
		


	function get_hab_descto($tipo = null){

			$this->load->model('configuracion');

			$haberes_desctos = $this->configuracion->get_haberes_descuentos(null,$tipo);

			echo json_encode($haberes_desctos);


	}



public function mov_personal($resultid = '')
	{
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){


			$resultid = $this->session->flashdata('movimientos_personal_result');
			if($resultid == 1){
				$vars['message'] = "Movimiento agregado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}elseif($resultid == 2){
				$vars['message'] = "Error al agregar movimiento.  Trabajador no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 3){
				$vars['message'] = "Error al ver movimientos.  Trabajador no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 4){
				$vars['message'] = "Error al eliminar movimiento.  Movimiento no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 5){
				$vars['message'] = "Error al agregar/editar movimiento.  Per&iacute;odo asociado ya se encuentra cerrado";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 6){
				$vars['message'] = "Error al agregar/editar movimiento.  Fechas del movimiento deben corresponder al mismo per&iacute;odo";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 7){
				$vars['message'] = "Error al agregar movimiento.  Debe indicar per&iacute;odo";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}


			$personal = $this->rrhh_model->get_personal(); 



			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Movimientos del Personal');

			$vars['content_menu'] = $content;				
			$vars['personal'] = $personal;	
			$vars['content_view'] = 'rrhh/mov_personal';
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



 public function documentos_colaborador($resultid = '')
  {
    if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){


      $resultid = $this->session->flashdata('documentos_colaborador_result');
      if($resultid == 1){
        $vars['message'] = "Error al crear documento.  Colaborador no existe";
        $vars['classmessage'] = 'danger';
        $vars['icon'] = 'fa-ban';
      }else if($resultid == 2){
        $vars['message'] = "Error al eliminar documento.  Debe indicar Colaborador";
        $vars['classmessage'] = 'danger';
        $vars['icon'] = 'fa-ban';
      }else if($resultid == 3){
        $vars['message'] = "Error al imprimir documento.  Debe indicar Colaborador";
        $vars['classmessage'] = 'danger';
        $vars['icon'] = 'fa-ban';
      }        


      $personal = $this->rrhh_model->get_personal(); 



      $content = array(
            'menu' => 'Remuneraciones',
            'title' => 'Remuneraciones',
            'subtitle' => 'Documentos del Colaborador');

      $vars['content_menu'] = $content;       
      $vars['personal'] = $personal;  
      $vars['content_view'] = 'rrhh/documentos_colaborador';
      $vars['datatable'] = true;
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


public function crear_documentos_colaborador($idtrabajador = null){
    
    if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){  


      $resultid = $this->session->flashdata('crear_documentos_colaborador_result');
      if($resultid == 1){
        $vars['message'] = "Documento Creado Correctamente";
        $vars['classmessage'] = 'success';
        $vars['icon'] = 'fa-check';
      }else if($resultid == 2){
        $vars['message'] = "Error al eliminar Documento.  Debe indicar documento";
        $vars['classmessage'] = 'danger';
        $vars['icon'] = 'fa-ban';
      }else if($resultid == 3){
        $vars['message'] = "Error al eliminar Documento.  Documento no existe";
        $vars['classmessage'] = 'danger';
        $vars['icon'] = 'fa-ban';
      }else if($resultid == 4){
        $vars['message'] = "Documento eliminado correctamente";
        $vars['classmessage'] = 'success';
        $vars['icon'] = 'fa-check';
      }else if($resultid == 5){
        $vars['message'] = "Error al imprimir documento. Documento no existe";
        $vars['classmessage'] = 'danger';
        $vars['icon'] = 'fa-ban';
      }




      if(is_null($idtrabajador)){
        $this->session->set_flashdata('documentos_colaborador_result', 1);
        redirect('rrhh/documentos_colaborador'); 

      }

      $this->load->model('admin');
      $formatos_documentos = $this->admin->get_formatos_documentos();
      //var_dump_new($formatos_documentos); exit;


      $documentos_colaborador = $this->admin->get_documentos_colaborador($idtrabajador);
      //var_dump_new($documentos_colaborador); exit;




      $this->load->model('rrhh_model');
      $personal = $this->rrhh_model->get_personal($idtrabajador);
      //var_dump_new($personal); exit;


      if(is_null($personal)){
        $this->session->set_flashdata('documentos_colaborador_result', 1);
        redirect('rrhh/documentos_colaborador'); 
      }


      $content = array(
            'menu' => 'Remuneraciones',
            'title' => 'Remuneraciones',
            'subtitle' => 'Crear Documento Colaborador');

      $vars['content_menu'] = $content; 

      
      $vars['content_view'] = 'rrhh/crear_documentos_colaborador';
      $vars['formValidation'] = true;
      $vars['personal'] = $personal;
      $vars['formatos_documentos'] = $formatos_documentos;
      $vars['documentos_colaborador'] = $documentos_colaborador;
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


public function submit_documento_colaborador()
    {

       if ($this->ion_auth->is_allowed($this->router->fetch_class(), $this->router->fetch_method())) {


        
        $tipo_documento = $this->input->post('tipo_documento');
        $id_trabajador = $this->input->post('id_trabajador');



            $datos_documento = array(
                'tipo_documento' => $tipo_documento,
                'id_trabajador' => $id_trabajador
            );


            $this->rrhh_model->save_documentos_colaborador($datos_documento);

            $this->session->set_flashdata('crear_documentos_colaborador_result', 1);

            redirect('rrhh/crear_documentos_colaborador/'.$id_trabajador);

        } else {
            $content = array(
                'menu' => 'Error 403',
                'title' => 'Error 403',
                'subtitle' => '403 error'
            );


            $vars['content_menu'] = $content;
            $vars['content_view'] = 'forbidden';
            $this->load->view('template', $vars);
        }
    }  


public function ver_documento_colaborador($idtrabajador = null,$iddocumento = null)
  {

    if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
      set_time_limit(0);



      if(is_null($idtrabajador)){
          $this->session->set_flashdata('documentos_colaborador_result', 3);
          redirect('rrhh/documentos_colaborador'); 

        }


      if(is_null($iddocumento)){
            $this->session->set_flashdata('crear_documentos_colaborador_result', 5);
            redirect('rrhh/crear_documentos_colaborador/'.$idtrabajador);
      }
     // $iddocumento = 9999;

      $this->load->model('admin');
      $documento = $this->admin->get_documentos_colaborador($idtrabajador,$iddocumento);
      //var_dump_new($documento); exit;
       if(count($documento) == 0){
            $this->session->set_flashdata('crear_documentos_colaborador_result', 5);
            redirect('rrhh/crear_documentos_colaborador/'.$idtrabajador);
      }

      $datosdetalle = $this->rrhh_model->imprime_documentos_colaborador($documento);
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



public function del_documento_colaborador($idtrabajador = null,$iddocumento = null)
    {

       if ($this->ion_auth->is_allowed($this->router->fetch_class(), $this->router->fetch_method())) {



        if(is_null($idtrabajador)){
            $this->session->set_flashdata('documentos_colaborador_result', 2);
            redirect('rrhh/documentos_colaborador'); 

          }


        if(is_null($iddocumento)){

          $this->session->set_flashdata('crear_documentos_colaborador_result', 2);

          redirect('rrhh/crear_documentos_colaborador/'.$idtrabajador); 

        }


          //$iddocumento = 1212;
        $documentos_colaborador = $this->admin->get_documentos_colaborador($idtrabajador,$iddocumento);
         // var_dump_new($documentos_colaborador); exit;
          if(count($documentos_colaborador) == 0 ){
                $this->session->set_flashdata('crear_documentos_colaborador_result', 3);                
                redirect('rrhh/crear_documentos_colaborador/'.$idtrabajador); 

          }

        

          $this->rrhh_model->delete_documentos_colaborador($idtrabajador,$iddocumento);
          $this->session->set_flashdata('crear_documentos_colaborador_result', 4);
          redirect('rrhh/crear_documentos_colaborador/'.$idtrabajador);

        } else {
            $content = array(
                'menu' => 'Error 403',
                'title' => 'Error 403',
                'subtitle' => '403 error'
            );


            $vars['content_menu'] = $content;
            $vars['content_view'] = 'forbidden';
            $this->load->view('template', $vars);
        }
    }  


	public function get_colaboradores($centrocosto){

			$personal = $this->rrhh_model->get_personal(null,$centrocosto);


      
			echo json_encode($personal);


	}




  public function get_colaboradores_hab_descto(){

    //var_dump_new($_POST); exit;

      $centrocosto = $this->input->post("centro_costo");
      $hab_descto = $this->input->post("hab_descto"); 
      $mes = $this->input->post("mes"); 
      $anno = $this->input->post("anno");    

      $personal = $this->rrhh_model->get_personal(null,$centrocosto);

      $this->load->model('admin');
      $periodo = $this->admin->get_periodo_by_mes($mes,$anno);
      $idperiodo = isset($periodo->id_periodo) ? $periodo->id_periodo : 0;

      $array_hab_descto = $this->rrhh_model->get_haberes_descuentos_totales_validos($hab_descto,$idperiodo);
      //var_dump_new($personal);
      //var_dump_new($array_hab_descto); exit;


      foreach ($personal as $persona) {
        $persona->hab_descto_check = 0;
        $persona->hab_descto_monto = 0;

        foreach ($array_hab_descto as $haber_descuento) {
            if($persona->id_personal == $haber_descuento->idpersonal){
                $persona->hab_descto_check = 1;
                $persona->hab_descto_monto = $haber_descuento->monto;                

            }

        }
        
      }

      //var_dump_new($personal);
      
      echo json_encode($personal);


  }


	public function ver_movimiento_personal($idpersonal = null)
	{
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

			$resultid = $this->session->flashdata('ver_movimientos_personal_result');
			if($resultid == 1){
				$vars['message'] = "Movimiento eliminado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}elseif($resultid == 2){
				$vars['message'] = "Error al eliminar/editar movimiento.  Movimiento no existe";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 3){
				$vars['message'] = "Error al eliminar/editar movimiento.  Per&iacute;odo asociado ya se encuentra cerrado";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 4){
				$vars['message'] = "Movimiento agregado/editado correctamente";
				$vars['classmessage'] = 'success';
				$vars['icon'] = 'fa-check';		
			}elseif($resultid == 5){
				$vars['message'] = "Error al agregar/editar movimiento.  Per&iacute;odo asociado ya se encuentra cerrado";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}elseif($resultid == 6){
				$vars['message'] = "Error al agregar/editar movimiento.  Fechas del movimiento deben corresponder al mismo per&iacute;odo";
				$vars['classmessage'] = 'danger';
				$vars['icon'] = 'fa-ban';
			}

			if(is_null($idpersonal)){
				$this->session->set_flashdata('movimientos_personal_result', 3);
				redirect('rrhh/mov_personal');	
			}
	

			$personal = $this->rrhh_model->get_personal($idpersonal);

			if(is_null($personal)){
				$this->session->set_flashdata('movimientos_personal_result', 3);
				redirect('rrhh/mov_personal');	
			}

			$movimientos = $this->rrhh_model->get_lista_movimientos($idpersonal);

			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Agregar movimiento del Personal');




			$mes = $this->session->flashdata('descuentos_mes') == '' ? date('m') : $this->session->flashdata('descuentos_mes');
			$anno = $this->session->flashdata('descuentos_anno') == '' ? date('Y') : $this->session->flashdata('descuentos_anno');

			$vars['mes'] = $mes;	
			$vars['anno'] = $anno;	

			//$saldo_vacaciones = 0;
			$vars['content_menu'] = $content;				
			$vars['personal'] = $personal;	
			$vars['movimientos'] = $movimientos;
			$vars['content_view'] = 'rrhh/ver_movimiento_personal';
			$vars['formValidation'] = true;
			$vars['datetimepicker'] = true;
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


public function add_movimiento_personal($idpersonal = null,$idmovimiento = null)
	{
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			if(is_null($idpersonal)){
				$this->session->set_flashdata('movimientos_personal_result', 2);
				redirect('remuneraciones/movimientos_personal');	
			}

			$personal = $this->rrhh_model->get_personal($idpersonal);

			if(is_null($personal)){
				$this->session->set_flashdata('movimientos_personal_result', 2);
				redirect('rrhh/mov_personal');	
			}





			$movimientos = $this->rrhh_model->get_movimiento(null,true);
			if(!is_null($idmovimiento)){
				$movimiento_realizado = $this->rrhh_model->get_lista_movimientos($idpersonal,$idmovimiento);

				if(is_null($movimiento_realizado)){
					$this->session->set_flashdata('ver_movimientos_personal_result', 2);
					redirect('rrhh/ver_movimiento_personal/'.$idpersonal);	
				}
				$url_back = "rrhh/ver_movimiento_personal/".$idpersonal;
				$vars['fechadesde'] = $movimiento_realizado->fecmovimiento;
				$vars['fechahasta'] = $movimiento_realizado->fechastamovimiento;

				$mes = substr($movimiento_realizado->fecmovimiento,5,2);
				$anno = substr($movimiento_realizado->fecmovimiento,0,4);
				$vars['minDate'] = "01/".str_pad($mes,2,"0",STR_PAD_LEFT)."/".$anno;
				$vars['maxDate'] = ultimo_dia_mes($mes,$anno)."/".str_pad($mes,2,"0",STR_PAD_LEFT)."/".$anno;





			}else{

				$mes = $this->input->post('mes');
				$anno = $this->input->post('anno');
				if(empty($mes) || empty($anno)){
					$this->session->set_flashdata('movimientos_personal_result', 7);
					redirect('rrhh/mov_personal');	
				}



				$movimiento_realizado = array();
				$url_back = "rrhh/ver_movimiento_personal/".$idpersonal;
				$vars['fechadesde'] = date("Y-m-d");
				$vars['fechahasta'] = date("Y-m-d");
				$vars['minDate'] = "01/".str_pad($mes,2,"0",STR_PAD_LEFT)."/".$anno;
				$vars['maxDate'] = ultimo_dia_mes($mes,$anno)."/".str_pad($mes,2,"0",STR_PAD_LEFT)."/".$anno;

			}


			$vars['mes'] = $mes;
			$vars['anno'] = $anno;			

			$content = array(
						'menu' => 'Remuneraciones',
						'title' => 'Remuneraciones',
						'subtitle' => 'Agregar movimiento del Personal');





			//$saldo_vacaciones = 0;
			$vars['content_menu'] = $content;				
			$vars['personal'] = $personal;	
			$vars['movimientos'] = $movimientos;
			$vars['movimiento_realizado'] = $movimiento_realizado;
			$vars['url_back'] = $url_back;
			$vars['content_view'] = 'rrhh/add_movimiento_personal';
			$vars['formValidation'] = true;
			
			$vars['datetimepicker'] = true;
			$vars['daterangepicker2'] = true;	
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

	public function submit_movimiento_personal(){
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			$idpersonal = $this->input->post('idpersonal');
			$comentarios = $this->input->post('comentarios');	
			$movimientos = $this->input->post('movimientos');	
			$idmovimiento = $this->input->post('idmovimiento');	

			//print_r($this->input->post(NULL,true)); exit;

			$array_datos = array(
								'idpersonal' => $idpersonal,
								'idmovimiento' => $idmovimiento,
								'idpersonal' => $idpersonal,
								'movimientos' => $movimientos,
								'comentarios' => $comentarios,
								'fecmovimiento' => $this->input->post("fechadesde"),
								'fechastamovimiento' => $this->input->post("fechahasta"),
								'created_at' => date("Ymd H:i:s")
								);

			$result = $this->rrhh_model->add_movimiento_personal($array_datos);


			if($result == 1){
				$this->session->set_flashdata('ver_movimientos_personal_result', 4);
				#$this->session->set_flashdata('movimientos_personal_result', 1);
				#redirect('remuneraciones/movimientos_personal');	
				redirect('rrhh/ver_movimiento_personal/'.$idpersonal);
			}else if($result == 2){
				$this->session->set_flashdata('ver_movimientos_personal_result', 4);
				redirect('rrhh/ver_movimiento_personal/'.$idpersonal);	
			}else if($result == 3){
				$this->session->set_flashdata('ver_movimientos_personal_result', 2);
				redirect('rrhh/ver_movimiento_personal/'.$idpersonal);	
			}else if($result == 4){
				$this->session->set_flashdata('ver_movimientos_personal_result', 3);
				redirect('rrhh/ver_movimiento_personal/'.$idpersonal);	
			}else if($result == 5){
				#$this->session->set_flashdata('movimientos_personal_result', 5);
				#redirect('remuneraciones/movimientos_personal');	
				$this->session->set_flashdata('ver_movimientos_personal_result', 5);
				redirect('rrhh/ver_movimiento_personal/'.$idpersonal);	
			}else if($result == 6){
				#$this->session->set_flashdata('movimientos_personal_result', 6);
				#redirect('remuneraciones/movimientos_personal');	
				$this->session->set_flashdata('ver_movimientos_personal_result', 6);
				redirect('rrhh/ver_movimiento_personal/'.$idpersonal);	
			}
			
			
			

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


	public function delete_movimiento_personal($idpersonal = '',$idmovimiento = '')
	{
		if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){



			if($idpersonal == '' || $idmovimiento == ''){
				$this->session->set_flashdata('movimientos_personal_result',4);
				redirect('rrhh/movimientos_personal');	
			}


			$result = $this->rrhh_model->delete_movimiento_personal($idpersonal,$idmovimiento);


			if($result == 1){
				$this->session->set_flashdata('ver_movimientos_personal_result', 1);
			}else if($result == 2){
				$this->session->set_flashdata('ver_movimientos_personal_result', 2);
			}else if($result == 3){
				$this->session->set_flashdata('ver_movimientos_personal_result', 3);				
			}
			redirect('rrhh/ver_movimiento_personal/'.$idpersonal);	

			
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

public function prueba(){
	//if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){
			//$mes = $this->input->post('mes');
			//$anno = $this->input->post('anno');
			$centro_costo = $this->input->post('centro_costo2');
			$id_periodo = $this->input->post('id_periodo2');
			
			//var_dump($centro_costo);
			//var_dump($this->rrhh_model->get_personal(null,$centro_costo));
			echo $id_periodo;
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

public function contrato_colaborador($rut){

	//if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

	$content = array(
						'menu' => 'Contratos',
						'title' => 'Contrato Colaborador',
						'subtitle' => 'Contratos');
	$vars['rut'] = $rut;

	$personal = $this->admin->get_personal_total($rut);
	$tipocontrato = $this->admin->get_tipo_contrato();

	$contratos_personal = $this->admin->get_personal_contrato($rut); 
	
	
	 
	$vars['personal'] = $personal;
	$vars['contratopersonal'] = $contratos_personal;
	$vars['tipocontrato'] = $tipocontrato;
	$vars['contrato'] = 1;
	$vars['content_menu'] = $content;				
	$vars['content_view'] = 'forbidden';
	$vars['content_view'] = 'rrhh/contrato_colaborador';
	$this->load->view('template',$vars);

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

public function carta_colaborador($rut){

	
	$content = array(
						'menu' => 'Cartas',
						'title' => 'Cartas Colaborador',
						'subtitle' => 'Cartas');
	$vars['rut'] = $rut;

	$personal = $this->admin->get_personal_total($rut);
	$tipocontrato = $this->admin->get_tipo_contrato();

	$contratos_personal = $this->admin->get_personal_carta($rut); 
	
	
	 
	$vars['personal'] = $personal;
	$vars['contratopersonal'] = $contratos_personal;
	$vars['tipocontrato'] = $tipocontrato;
	$vars['contrato'] = 1;
	$vars['content_menu'] = $content;				
	$vars['content_view'] = 'forbidden';
	$vars['content_view'] = 'rrhh/cartas_colaborador';
	$this->load->view('template',$vars);

	

}

public function documento_colaborador($tipo){

	//if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

	
	$idtipo = $tipo;

	$content = array(
						'menu' => 'Documentos',
						'title' => 'Documentos Colaborador',
						'subtitle' => 'Documentos');
	//$vars['rut'] = $rut;

	$tipocontrato = $this->admin->get_tipo_documento($idtipo);

	//print_r($tipocontrato);
	//exit;

	
	 
	//$vars['personal'] = $personal;
	//$vars['contratopersonal'] = $contratos_personal;
	$vars['tipocontrato'] = $tipocontrato;
	$vars['contrato'] = 1;
	$vars['content_menu'] = $content;				
	$vars['content_view'] = 'forbidden';
	$vars['content_view'] = 'rrhh/documentos_colaborador';
	$this->load->view('template',$vars);

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

public function documento_tipo($tipo){

	//if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

	
	$idtipo = $tipo;

	$content = array(
						'menu' => 'Documentos',
						'title' => 'Tipos Documentos',
						'subtitle' => 'Documentos');
	
	$tipocontrato = $this->admin->get_tipo_documento($idtipo);

	$vars['tipocontrato'] = $tipocontrato;
	$vars['contrato'] = 1;
	$vars['content_menu'] = $content;				
	$vars['content_view'] = 'forbidden';
	$vars['content_view'] = 'rrhh/documentos_tipo';
	$this->load->view('template',$vars);

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

public function finiquito_colaborador($rut){

	//if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

	$content = array(
						'menu' => 'Feniquitos',
						'title' => 'Finiquito Colaborador',
						'subtitle' => 'Finiquitos');
	$vars['rut'] = $rut;

	$personal = $this->admin->get_personal_total($rut);
	$tipocontrato = $this->admin->get_tipo_contrato();

	$contratos_personal = $this->admin->get_personal_finiquitos($rut); 
	
	
	 
	$vars['personal'] = $personal;
	$vars['contratopersonal'] = $contratos_personal;
	$vars['tipocontrato'] = $tipocontrato;
	$vars['contrato'] = 1;
	$vars['content_menu'] = $content;				
	$vars['content_view'] = 'forbidden';
	$vars['content_view'] = 'rrhh/finiquito_colaborador';
	$this->load->view('template',$vars);

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



public function genera_contrato($idpersonal){

	//if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

	$idtipo = 1;

	
	$content = array(
						'menu' => 'Contratos',
						'title' => 'Genera Documento Colaborador',
						'subtitle' => 'Documento Colaboradores');
	
	$personal = $this->admin->get_personal_total($idpersonal);	
	
	//$idtipo = 1;
	 

	$tipocontrato = $this->admin->get_tipo_documento($idtipo);

		
	$vars['personal'] = $personal;
	$vars['tipocontrato'] = $tipocontrato;
	$vars['contrato'] = 1;
	$vars['content_menu'] = $content;				
	$vars['content_view'] = 'forbidden';
	$vars['content_view'] = 'rrhh/genera_contrato';
	$this->load->view('template',$vars);

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

public function genera_carta($idpersonal){

	//if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

	$idtipo = 3;

	
	$content = array(
						'menu' => 'Contratos',
						'title' => 'Genera Documento Colaborador',
						'subtitle' => 'Documento Colaboradores');
	
	$personal = $this->admin->get_personal_total($idpersonal);	
	
	//$idtipo = 1;
	 

	$tipocontrato = $this->admin->get_tipo_documento($idtipo);

		
	$vars['personal'] = $personal;
	$vars['tipocontrato'] = $tipocontrato;
	$vars['contrato'] = 1;
	$vars['content_menu'] = $content;				
	$vars['content_view'] = 'forbidden';
	$vars['content_view'] = 'rrhh/genera_carta';
	$this->load->view('template',$vars);	

}

public function genera_finiquito($idpersonal){

	//if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){

	$idtipo = 2;

  $this->load->model('auxiliar');

	$content = array(
						'menu' => 'Finiquito',
						'title' => 'Genera Finiquito Colaborador',
						'subtitle' => 'Finiquitos Colaboradores');
	
	$personal = $this->admin->get_personal_total($idpersonal); 
  $dias_progresivos = $this->auxiliar->get_dias_progresivos($idpersonal);
  $array_vacaciones['dias_vacaciones'] = dias_vacaciones($personal->fecinicvacaciones,$personal->saldoinicvacaciones);
  $array_vacaciones['num_dias_progresivos'] = num_dias_progresivos($personal->fecinicvacaciones,$personal->saldoinicvacprog,$dias_progresivos);
  $parametros = $this->admin->get_parametros_generales();

  if($personal->tipogratificacion == 'SG'){
        $gratificacion = 0;
  }else if($personal->tipogratificacion == 'MF'){
        $gratificacion = $personal->gratificacion;
  }else if($personal->tipogratificacion == 'TL'){
        $tope_legal_gratificacion = ($parametros->sueldominimo*4.75)/12;
        $gratificacion_esperada = $personal->sueldobase*0.25;

       //echo $personal->tipogratificacion;  exit;
        $gratificacion = $gratificacion_esperada > $tope_legal_gratificacion ? $tope_legal_gratificacion : $gratificacion_esperada;

  }





 // $vacaciones = $this->auxiliar->get_cartola_vacaciones($idpersonal);



  $dias_tomados = 0;
 /* foreach ($vacaciones as $vacacion) {
    $dias_tomados += $vacacion->dias;
  }*/

 // echo"..-". $saldo_dias;

	//print_r($vacaciones);

	//exit;

	$tipocontrato = $this->admin->get_tipo_documento($idtipo);
  $causales_finiquito = $this->admin->get_causal_finiquito();
	
	$vars['personal'] = $personal;
	$vars['tipocontrato'] = $tipocontrato;
  $vars['dias_tomados'] = $dias_tomados;

  $vars['array_vacaciones'] = $array_vacaciones;
  $vars['causales_finiquito'] = $causales_finiquito;
  $vars['gratificacion'] = $gratificacion;
	$vars['contrato'] = 1;
  $vars['datetimepicker'] = true;
  $vars['maleta'] = true;
  $vars['mask'] = true;
	$vars['content_menu'] = $content;				
	$vars['content_view'] = 'forbidden';
	$vars['content_view'] = 'rrhh/genera_finiquito';
	$this->load->view('template',$vars);

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

	public function get_tipo_cuenta_banco($id_banco){


		$this->load->model('Mantenedores_model');
		
		$tipo_cuenta = $this->Mantenedores_model->get_tipo_cuenta_banco(null,$id_banco);

		//$arrayComunas = array();
		//$arrayComunas[''] = "Seleccione Comuna";
		//foreach ($comunas as $comuna) {
		//	$arrayComunas[$comuna->idcomuna] = $comuna->nombre;
		//}
		echo json_encode($tipo_cuenta);



	}


  public function actualiza_datos_colaborador(){
    
    if($this->ion_auth->is_allowed($this->router->fetch_class(),$this->router->fetch_method())){  

      var_dump($_POST);
      $idpersonal = $this->input->post('idpersonal');
      $valor = $this->input->post('valor');
      $parametro = $this->input->post('parametro');

      $data_produccion = $this->rrhh_model->actualiza_datos_colaborador($idpersonal,$valor,$parametro);


      $data['result'] = 1;

      echo json_encode($data);


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