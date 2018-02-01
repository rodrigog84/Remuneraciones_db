<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Carga_masiva extends CI_Controller {

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
			       $estadocivil = utf8_encode($datos[7]);
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
						'idempresa' => $idempresa,
			       		'rut' => $rut,
			       		'dv' => $dv,
			       		'numficha' => $ficha,
						'nombre' => $nombres,
						'apaterno' => $apellidop,
						'amaterno' => $apellidom,
						'fecnacimiento' => substr($fechanacimiento,6,4)."-".substr($fechanacimiento,3,2)."-".substr($fechanacimiento,0,2),
						'idnacionalidad' => $nacionalidad,
						'nacionalidad' => 'C', //ELIMINAR DESPUES
						'idecivil' => $estadocivil,
						'sexo' => $sexo,
						'direccion' => $direccion,
						'email' => $email,
						'tiporenta' => '1',
						'idcargo' => '1',
						'idestudio' => '1',
						'titulo' => 'universitario',
						'ididioma' => 'espanol',
						'idjefe' => '1',
						'idreemplazo' => '1',
						'idlicencia' => '1',
						'tallapolera' => 'L',
						'tallapantalon' => '48',
						'tipodocumento' => 'F',
						'idcentrocosto' => '1',
						'cbeneficio' => '1',
						'fono' => $fono,
						'idafp' => $AFP,
						'idisapre' => '1',
						'sueldobase' => $sueldobase,
										
										//DATOS POR DEFECTO
						'idregion' => 1,
						'idcomuna' => 1,
						'fecingreso' => substr($fechaingreso,6,4)."-".substr($fechaingreso,3,2)."-".substr($fechaingreso,0,2),
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

						'adicafp' => 0,
					);
		       	   //guardamos en base de datos la línea leida
			      //$this->db->insert('rem_personal', $array_datos); 
	        	
	   		 }
	   		 $i++;
		}

		$this->session->set_flashdata('personal_result',8);
		redirect('rrhh/carga_masiva_paso');

	}
	

}