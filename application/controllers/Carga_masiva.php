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


	  public function contratos_archivos(){

	  	$tipocontrato = $this->input->post('tipocontrato');
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

   		$pdf = file_get_contents($config['upload_path'].$config['file_name'].$dataupload['file_ext']);

   		$pdf = iconv('','UTF-8',$pdf);

   		//print_r($pdf);

   		//exit;

   		$idempresa=$this->session->userdata('empresaid');

		$array_datos2 = array(
			'tipo' => $tipocontrato,
			'id_empresa' => $idempresa
					);

		$array_datos2['updated_at'] = date("Ymd H:i:s");
		$array_datos2['created_at'] = date("Ymd H:i:s");
				  //$array_datos['created_by'] = $createdby;
		$this->db->insert('rem_tipo_doc_colaborador', $array_datos2);
		$id = $this->db->insert_id();

		//exit;

		$array_datos = array(
			'id_tipo_doc_colaborador' => $id,
			'id_empresa' => $idempresa,
			'formato_pdf' => $pdf,
					);

		$array_datos['updated_at'] = date("Ymd H:i:s");
		$array_datos['created_at'] = date("Ymd H:i:s");
				  //$array_datos['created_by'] = $createdby;
		$this->db->insert('rem_formato_doc_colaborador', $array_datos);


		//$this->session->set_flashdata('personal_result',8);
		redirect('configuraciones/tipos_contrato');

 	

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
			       $rut = (int)$datos[0];
			       $dv = utf8_encode($datos[1]);
			       $nombres = utf8_encode($datos[2]);			       
			       $apellidop = utf8_encode($datos[3]);
			       $apellidom = utf8_encode($datos[4]);
			       $fechanacimiento = $datos[5];
			       $sexo = utf8_encode($datos[6]);
			       $estadocivil = ($datos[7]);
			       $nacionalidad = utf8_encode($datos[8]);
			       $direccion = utf8_encode($datos[9]);
			       $region = $datos[10];
			       $comuna = $datos[11];
			       $fono = $datos[12];
			       $email = $datos[13];			      
			       $fechaingreso = $datos[14];
			       $idcargo = $datos[15];
			       $fecinicvacaciones = $datos[16];
			       $saldoinicvacaciones = $datos[17];
			       $saldoinicvacprog = $datos[18];
			       $diasprogresivos = $datos[19];
			       $diasvactomad = $datos[20];
			       $diasprogtomados = $datos[21];
			       $tipocontrato = utf8_encode($datos[22]);
			       $parttime = $datos[23];
			       $segcesantia = $datos[24];
			       $fecafc = $datos[25];
			       $diastrabajo = $datos[26];
			       $horasdiarias = $datos[27];
			       $horassemanales = $datos[28];
			       $sueldobase = $datos[29];
			       $tipogratificacion = utf8_encode($datos[30]);
			       $gratificacion = $datos[31];
			       $asigfamiliar = $datos[32];
			       $cargassimples = $datos[33];
			       $cargasinvalidas = $datos[34];
			       $cargasmaternales = $datos[35];
			       $cargasretroactivas = $datos[36];
			       $idasigfamiliar = $datos[37];
			       $movilizacion = $datos[38];
			       $colacion = $datos[39];
			       $pensionado = $datos[40];
			       $idafp = $datos[41];
			       $adicafp = $datos[42];
			       $tipoahorrovol = utf8_encode($datos[43]);
			       $ahorrovol = $datos[44];
			       $instapv = $datos[45];
			       $nrocontratoapv = $datos[46];
			       $tipocotapv = $datos[47];
			       $cotapv = $datos[48];
			       $formapagoapv = $datos[49];
			       $depconvapv = $datos[50];
			       $idisapre = $datos[51];
			       $valorpactado = (float)$datos[52];
			       $active = $datos[53];
			       $created_at = $datos[54];
			       $updated_at = $datos[55];
			       $numficha = $datos[56];
			       $idnacionalidad = $datos[57];
			       $tiporenta = $datos[58];
			       $idestudio = $datos[59];
			       $titulo = $datos[60];
			       $ididioma = $datos[61];
			       $idjefe = $datos[62];
			       $idlicencia = $datos[63];
			       $tipodocumento = $datos[64];
			       $tallapolera = $datos[65];
			       $tallapantalon = $datos[66];
			       $idcentrocosto = $datos[67];
			       $cbeneficio = $datos[68];
			       $idreemplazo = $datos[69];
			       $createdby = $datos[70];
			       $idbanco = $datos[71];
			       $nrocuentabanco = $datos[72];
			       $idempresa = $this->session->userdata('empresaid');

			       $array_datos = array(
						'id_empresa' => $idempresa,
			       		'rut' => $rut,
			       		'dv' => $dv,			       		
						'nombre' => $nombres,
						'apaterno' => $apellidop,
						'amaterno' => $apellidom,
						'fecnacimiento' => $fechanacimiento,
						'sexo' => $sexo,
						'idecivil' => $estadocivil,
						'nacionalidad' => $nacionalidad, 
						'direccion' => $direccion,
						'idregion' => $region,
						'idcomuna' => $comuna, 
						'fono' => $fono,
						'email' => $email,
						'fecingreso' => $fechaingreso,
						'idcargo' => $idcargo,
						'fecinicvacaciones' => $fecinicvacaciones,
						'saldoinicvacaciones' => $saldoinicvacaciones,
						'saldoinicvacprog' => $saldoinicvacprog,
						'diasprogresivos' => $diasprogresivos,
						'diasvactomados' => $diasvactomad,
						'diasprogtomados' => $diasprogtomados,
						'tipocontrato' => $tipocontrato,
						'parttime' => $parttime,
						'segcesantia' => $segcesantia,
						'fecafc' => $fecafc,
						'diastrabajo' => $diastrabajo,
						'horasdiarias' => $horasdiarias,
						'horassemanales' => $horassemanales,
						'sueldobase' => $sueldobase,
						'tipogratificacion' => $tipogratificacion,
						'gratificacion' => $gratificacion,
						'asigfamiliar' => $asigfamiliar,
						'cargassimples' => $cargassimples,
						'cargasinvalidas' => $cargasinvalidas,
						'cargasmaternales' => $cargasmaternales,
						'cargasretroactivas' => $cargasretroactivas,
						'idasigfamiliar' => $idasigfamiliar,
						'movilizacion' => $movilizacion,
						'colacion' => $colacion,
						'pensionado' => $pensionado,
						'idafp' => (int)$idafp,
						'adicafp' => $adicafp,
						'tipoahorrovol' => $tipoahorrovol,
						'ahorrovol' => $ahorrovol,
						'instapv' => $instapv,
						'nrocontratoapv' => $nrocontratoapv,
						'tipocotapv' => $tipocotapv,
						'cotapv' => $cotapv,
						'formapagoapv' => $formapagoapv,
						'depconvapv' => $depconvapv,
						'idisapre' => $idisapre,
						'valorpactado' => $valorpactado,
						'active' => $active,
						'numficha' => $numficha,
						'idnacionalidad' => $idnacionalidad,
						'tiporenta' => $tiporenta,
						'idestudio' => $idestudio,
						'titulo' => $titulo,
						'ididioma' => $ididioma,
						'idjefe' => $idjefe,						
						'idlicencia' => $idlicencia,
						'tipodocumento' => $tipodocumento,
						'tallapolera' => $tallapolera,
						'tallapantalon' => $tallapantalon,						
						'idcentrocosto' => $idcentrocosto,
						'cbeneficio' => $cbeneficio,
						'idreemplazo' => $idreemplazo,
						'created_by' => $createdby,
						//'idbanco' => $idbanco,
						//'nrocuentabanco' => $nrocuentabanco,					
					);
		       	   //guardamos en base de datos la línea leida
		       	  //qprint_r($array_datos);
		       	  $array_datos['updated_at'] = date("Ymd H:i:s");
				  $array_datos['created_at'] = date("Ymd H:i:s");
				  //$array_datos['created_by'] = $createdby;
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
			       $nombres = $datos[2];
			       $dias = $datos[3];
			       $mes = $datos[4];
			       $anno = $datos[5];

			       $idempresa = $this->session->userdata('empresaid');

					$this->db->select('id_personal')
									  ->from('rem_personal')
					                  ->where('rut', $rut)
					                  ->where('id_empresa', $idempresa);
					$query = $this->db->get();

					if(isset($query->row()->id_personal)){
						$id_personal = $query->row()->id_personal;
						$array_trabajadores[$id_personal] = $dias;						

					}

					

			     
	   		 }
	   		 $i++;
		}

		$this->rrhh_model->save_asistencia($array_trabajadores,$mes,$anno);

		//print_r($array_trabajadores);
		//exit;

		$this->session->set_flashdata('asistencia_result',3);
		redirect('rrhh/asistencia');

	}

	public function anticipos(){

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
			       $nombres = $datos[2];
			       $anticipos = $datos[3];
			       $aguinaldo = $datos[4];
			       $mes = $datos[5];
			       $anno = $datos[6];

			       $idempresa = $this->session->userdata('empresaid');		      

					$this->db->select('id_personal')
									  ->from('rem_personal')
					                  ->where('rut', $rut)
					                  ->where('id_empresa', $idempresa);
					$query = $this->db->get();

					if(isset($query->row()->id_personal)){

						$id_personal = $query->row()->id_personal;

						$array_trabajadores[$i]['idtrabajador'] = $id_personal;
					    $array_trabajadores[$i]['anticipos'] = $anticipos;
						$array_trabajadores[$i]['aguinaldo'] = $aguinaldo;
							

					}

					

			     
	   		 }
	   		 $i++;
		}

		$this->rrhh_model->save_anticipo_masiva($array_trabajadores,$mes,$anno);

		
		$this->session->set_flashdata('anticipos_result',1);
		redirect('rrhh/anticipos');

	}

	public function horasextras(){

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
			       $nombres = $datos[2];
			       $horas1 = $datos[3];
			       $horas2 = $datos[4];
			       $mes = $datos[5];
			       $anno = $datos[6];

			        $idempresa = $this->session->userdata('empresaid');

					$this->db->select('id_personal')
									  ->from('rem_personal')
					                  ->where('rut', $rut)
					                  ->where('id_empresa', $idempresa);
					$query = $this->db->get();

					if(isset($query->row()->id_personal)){
					
					$id_personal = $query->row()->id_personal;



					$this->db->select('valorhorasextras100,valorhorasextras50')
									  ->from('rem_remuneracion')
					                  ->where('idpersonal', $id_personal)
					                  ->where('id_empresa', $idempresa);
					$query = $this->db->get();

					
					$monto100 = $query->row()->valorhorasextras100;
					$monto50 = $query->row()->valorhorasextras50;
					$montohorasextras100 = ($monto100 * $horas2 );
				    $montohorasextras50 = ($monto50 * $horas1 );
				    $array_trabajadores[$i]['idtrabajador'] = $id_personal;
				    $array_trabajadores[$i]['horas50'] = $horas2;
					$array_trabajadores[$i]['monto50'] = $montohorasextras50;
					$array_trabajadores[$i]['horas100'] = $horas1;
					$array_trabajadores[$i]['monto100'] = $montohorasextras100;

				}
									
								     
	   		 }
	   		 $i++;
		}

		//print_r($array_trabajadores);
		//exit;

		$this->rrhh_model->save_horas_extraordinarias_masiva($array_trabajadores,$mes,$anno);

		$this->session->set_flashdata('horas_extraordinarias_result',3);
		redirect('rrhh/horas_extraordinarias');

	}

}