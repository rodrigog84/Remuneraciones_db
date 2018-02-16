<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Carga_masiva extends CI_Controller {

	  public function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->config('ion_auth', TRUE);
			$this->load->helper('cookie');
			$this->load->helper('date');
			$this->lang->load('ion_auth');
			$this->load->helper('format');
			$this->load->model('rrhh_model');
		}

	  public function insertar(){

		//LUEGO DE SUBIR EL ARCHIVO	
		$config['upload_path'] = "./uploads/cargas/";

		//VALIDA QUE CARPETA EXISTA
		if(!file_exists($config['upload_path'])){
			mkdir($config['upload_path'],0777,true);
		}

        $config['file_name'] = date("Ymd")."_".date("His")."_";
        $config['allowed_types'] = "*";
        $config['max_size'] = "10240";

        //carga libreria para cargar archivos
        $this->load->library('upload', $config);

        //Campo a leer
        $this->upload->do_upload("userfile");
   		$dataupload = $this->upload->data();

   		
		//cargamos el archivo
   		$archivotmp = $dataupload['file_ext'];	  	
		//obtenemos el archivo .csv


    	$gestor = fopen("./uploads/cargas/" . $dataupload['file_name'], "r");
    	$i = 0;


	    while (($datos = fgetcsv($gestor, 10000, ";")) !== FALSE) {


			if($i != 0){ 
	       
			       //$datos = explode(";",$linea); 
			       //print_r($datos);
			       $rut = $datos[0];
			       $dv = utf8_encode($datos[1]);
			       $ficha = $datos[2];
			       $apellidop = utf8_encode($datos[3]);
			       $apellidom = utf8_encode($datos[4]);
			       $nombres = utf8_encode($datos[5]);
			       $sexo = utf8_encode($datos[6]);
			       $estadocivil = ($datos[7]);
			       $nacionalidad = utf8_encode($datos[8]);
			       $fechanacimiento = $datos[9];
			       $direccion = utf8_encode($datos[10]);
			       $region = utf8_encode($datos[11]);
			       $comuna = utf8_encode($datos[12]);
			       $email = utf8_encode($datos[13]);
			       $fono = utf8_encode($datos[14]);
			       $fechaingreso = $datos[15];
			       $tipocontrato = utf8_encode($datos[16]);
			       $diastrabajo = utf8_encode($datos[17]);
			       $sueldobase = utf8_encode($datos[18]);
			       $tipoGrat = utf8_encode($datos[19]);
			       $MontoMov= $datos[20];
			       $Montocol= $datos[21];
			       $CentrodeCosto= $datos[22];
			       $AFP= $datos[23];
			       $MontoCotizad= $datos[24];
			       $MontoAhVoluntario= $datos[25];
			       $TramoAsigFam= utf8_encode($datos[26]);
			       $NroCargasSimples= $datos[27];
			       $NroCargasMat= $datos[28];
			       $NroCargasIn= $datos[29];
			       $NroCargasRet= $datos[30];
			       $APV= utf8_encode($datos[31]);
			       $NroContratoAPV= $datos[32];
			       $TipoCotizAPV= utf8_encode($datos[33]);
			       $MontoCotizAPV= $datos[34];
			       $FormadePagoAPV= utf8_encode($datos[35]);
			       $DepConvAPV= $datos[36];
			       $InstituSalud= utf8_encode($datos[37]);
			       $MontopactadoUF= $datos[38];
			       $AfiliadoSeguroCesantía= utf8_encode($datos[39]);
			       $BancoPagoSueldo= utf8_encode($datos[40]);
			       $NroCuentaBanco= $datos[41];
			       //$idempresa= utf8_encode($datos[42]);
			       $idempresa = $this->session->userdata('empresaid');

			       $array_datos = array(
						'id_empresa' => $idempresa,
			       		'rut' => $rut,
			       		'dv' => $dv,			       		
						'nombre' => $nombres,
						'apaterno' => $apellidop,
						'amaterno' => $apellidom,
						'fecnacimiento' => substr($fechanacimiento,6,4)."-".substr($fechanacimiento,3,2)."-".substr($fechanacimiento,0,2),
						'sexo' => $sexo,
						'idecivil' => 1,
						'nacionalidad' => 'C', //ELIMINAR DESPUES
						'direccion' => $direccion,
						'idregion' => 1,
						'idcomuna' => 1, 
						'fono' => $fono,
						'email' => $email,
						'fecingreso' => substr($fechaingreso,6,4)."-".substr($fechaingreso,3,2)."-".substr($fechaingreso,0,2),
						'idcargo' => 1,
						'fecinicvacaciones' => '2017-09-05',
						'saldoinicvacaciones' => 0,
						'saldoinicvacprog' => 0,
						'diasprogresivos' => 0,
						'diasvactomados' => 0,
						'diasprogtomados' => 0,
						'tipocontrato' => 'I',
						'parttime' => 0,
						'segcesantia' => 0,
						'fecafc' => '2018-02-01',
						'diastrabajo' => 30,
						'horasdiarias' => 8,
						'horassemanales' => 45,
						'sueldobase' => $sueldobase,
						'tipogratificacion' => 'SG',
						'gratificacion' => 0,
						'asigfamiliar' => 0,
						'cargassimples' => 0,
						'cargasinvalidas' => 0,
						'cargasmaternales' => 0,
						'cargasretroactivas' => 0,
						'idasigfamiliar' => NULL,
						'movilizacion' => 0,
						'colacion' => 0,
						'pensionado' => 0,
						'idafp' => 1,
						'adicafp' => 0,
						'tipoahorrovol' => 0,
						'ahorrovol' => 0,
						'instapv' => 0,
						'nrocontratoapv' => 0,
						'tipocotapv' => 0,
						'cotapv' => 0,
						'formapagoapv' => 0,
						'depconvapv' => 0,
						'idisapre' => 0,
						'valorpactado' => 0,
						'active' => 1,
						'numficha' => $ficha,
						'idnacionalidad' => 1,
						'tiporenta' => 0,
						'idestudio' => 1,
						'titulo' => 'universitario',
						'ididioma' => 1,
						'idjefe' => 1,						
						'idlicencia' => 1,
						'tipodocumento' => 'F',
						'tallapolera' => 'L',
						'tallapantalon' => '48',						
						'idcentrocosto' => 1,
						'cbeneficio' => 1,
						'idreemplazo' => 1,						
					);
		       	   //guardamos en base de datos la línea leida
		       	 //print_r($array_datos);
		       	  $array_datos['updated_at'] = date('Y-m-d H:i:s');
				  $array_datos['created_at'] = date('Y-m-d H:i:s');
				  $this->db->insert('rem_personal_paso', $array_datos);
			     
	   		 }
	   		 $i++;
		}

		$this->session->set_flashdata('personal_result',8);
		redirect('rrhh/carga_masiva_paso');

	}

	public function asistencia(){

		//LUEGO DE SUBIR EL ARCHIVO	
		$config['upload_path'] = "./uploads/cargas/";

		//VALIDA QUE CARPETA EXISTA
		if(!file_exists($config['upload_path'])){
			mkdir($config['upload_path'],0777,true);
		}

        $config['file_name'] = date("Ymd")."_".date("His")."_";
        $config['allowed_types'] = "*";
        $config['max_size'] = "10240";

        //carga libreria para cargar archivos
        $this->load->library('upload', $config);

        //Campo a leer
        $this->upload->do_upload("userfile");
   		$dataupload = $this->upload->data();

   		
		//cargamos el archivo
   		$archivotmp = $dataupload['file_ext'];	  	
		//obtenemos el archivo .csv


    	$gestor = fopen("./uploads/cargas/" . $dataupload['file_name'], "r");
    	$i = 0;

    	$array_trabajadores = array();
	    while (($datos = fgetcsv($gestor, 10000, ";")) !== FALSE) {


			if($i != 0){ 
	       
			       $rut = $datos[0];
			       $dv = utf8_encode($datos[1]);
			       $dias = $datos[2];
			       $mes = $datos[3];
			       $anno = $datos[4];

			       $idempresa = $this->session->userdata('empresaid');

					$this->db->select('id_personal')
									  ->from('rem_personal')
					                  ->where('rut', $rut)
					                  ->where('id_empresa', $idempresa);
					$query = $this->db->get();
					$id_personal = $query->row()->id_personal;
					
					$array_trabajadores[$id_personal] = $dias;
					

			     
	   		 }
	   		 $i++;
		}

		$this->rrhh_model->save_asistencia($array_trabajadores,$mes,$anno);

		$this->session->set_flashdata('asistencia_result',3);
		redirect('rrhh/asistencia');

	}

}