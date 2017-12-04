<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Model
*
* Version: 2.5.2
*
* Author:  Ben Edmunds
* 		   ben.edmunds@gmail.com
*	  	   @benedmunds
*
* Added Awesomeness: Phil Sturgeon
*
* Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
*
* Created:  10.01.2009
*
* Last Change: 3.22.13
*
* Changelog:
* * 3-22-13 - Additional entropy added - 52aa456eef8b60ad6754b31fbdcc77bb
*
* Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
* Original Author name has been kept but that does not mean that the method has not been modified.
*
* Requirements: PHP5 or above
*
*/

class Admin extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->config('ion_auth', TRUE);
		$this->load->helper('cookie');
		$this->load->helper('date');
		$this->lang->load('ion_auth');
		$this->load->helper('format');
	}


	public function get_afp($idafp = null){
		$afp_data = $this->db->select('id, nombre, porc, exregimen, codprevired')
						  ->from('rem_afp a')
						  ->where('a.active = 1')
						  ->order_by('a.exregimen')
		                  ->order_by('a.nombre');
		$afp_data = is_null($idafp) ? $afp_data : $afp_data->where('a.id',$idafp);  		                  
		$query = $this->db->get();

		$datos = is_null($idafp) ? $query->result() : $query->row();
		return $datos;
	}	


    public function get_isapre($idisapre = null){
		$isapre_data = $this->db->select('id, nombre, active, codprevired')
						  ->from('rem_isapre a')
						  ->where('a.active = 1')
						  ->order_by('a.nombre')
		                  ->order_by('a.codprevired');
		$isapre_data = is_null($idisapre) ? $isapre_data : $isapre_data->where('a.id',$idisapre);  		                  
		$query = $this->db->get();

		$datos = is_null($idisapre) ? $query->result() : $query->row();
		return $datos;
	}	

	public function add_afp($array_datos){


		$this->db->select('a.id')
						  ->from('rem_afp as a')
		                  ->where('upper(a.nombre)', strtoupper($array_datos['nombre']))
		                  ->where('a.active = 1');		

		$query = $this->db->get();
		$datos = $query->row();
		if(count($datos) == 0){ // nueva afp  no existe
			if($array_datos['idafp'] == 0){
				$data = array(
			      	'nombre' => $array_datos['nombre'],
			      	'porc' => $array_datos['porc'],
			      	'exregimen' => $array_datos['exregimen'],
			      	'codprevired' => 0,
			      	'active' => 1,
			      	'updated_at' => date('Ymd H:i:s'),
			      	'created_at' => date('Ymd H:i:s')
				);

				$this->db->insert('rem_afp', $data);
				$idafp = $this->db->insert_id();

				return 1;
			}else{
				$data = array(
			      	'nombre' => $array_datos['nombre'],
			      	'porc' => $array_datos['porc'],
			      	'exregimen' => $array_datos['exregimen']
				);


				$this->db->where('id', $array_datos['idafp']);
				$this->db->update('rem_afp',$data); 
				return 1;
			}
		}else{ // ya existe proveedor nuevo

			if($array_datos['idafp'] != 0){
				$data = array(
			      	'nombre' => $array_datos['nombre'],
			      	'porc' => $array_datos['porc'],
			      	'exregimen' => $array_datos['exregimen']		      	
				);


				$this->db->where('id', $array_datos['idafp']);
				$this->db->update('rem_afp',$data); 
				return 1;
			}else{
				return -1;	
			}
			
		}

	}	



	public function delete_afp($idafp){


		$this->db->where('id', $idafp);
		$this->db->update('rem_afp',array('active' => '0')); 

		return 1;
		/*if($this->db->affected_rows() > 0){ 
			return 1;
		}else{ 
			return -1;
		}*/



	}	




	public function get_tabla_impuesto(){

		$this->db->select('id, desde, hasta, factor, rebaja, tasa_maxima')
						  ->from('rem_tabla_impuesto')
		                  ->order_by('desde','asc');

		$query = $this->db->get();
		return $query->result();
	}	


	public function edit_tabla_impuesto($array_impuesto){

		foreach ($array_impuesto as $key => $impuesto) {
			$datos = array(
					'desde' => str_replace(".","",$impuesto['desde']),
					'hasta' => isset($impuesto['hasta']) ? str_replace(".","",$impuesto['hasta']) : 999999999,
					'factor' => str_replace(",",".",$impuesto['factor']),
					'rebaja' => str_replace(".","",$impuesto['rebaja']),
					);

			$this->db->where('id', $key);
			$this->db->update('rem_tabla_impuesto',$datos); 
		}
		
		return 1;
	}	



	public function get_tabla_asig_familiar($idtramo = null){

		$tramo_data = $this->db->select('id, tramo, desde, hasta, monto')
						  ->from('rem_tabla_asig_familiar')
		                  ->order_by('desde','asc');
		$tramo_data = is_null($idtramo) ? $tramo_data : $tramo_data->where('id',$idtramo);  		                  
		$query = $this->db->get();
		return is_null($idtramo) ? $query->result() : $query->row();
		//return $query->result();
	}		



	public function edit_tabla_asig_familiar($array_asig_familiar){

		foreach ($array_asig_familiar as $key => $asig_familiar) {
			$datos = array(
					'desde' => str_replace(".","",$asig_familiar['desde']),
					'hasta' => isset($asig_familiar['hasta']) ? str_replace(".","",$asig_familiar['hasta']) : 999999999,
					'monto' => str_replace(".","",$asig_familiar['monto'])
					);

			$this->db->where('id', $key);
			$this->db->update('rem_tabla_asig_familiar',$datos); 
		}
		
		return 1;
	}



	public function get_feriado($idferiado = null){

		$feriado_data = $this->db->select('id, CONVERT(varchar, fecha, 103) as fecha, fecha as fecha_sformat',false)
						  ->from('rem_feriado f')
						  ->where('f.active = 1')
		                  ->order_by('f.fecha','desc');
		$feriado_data = is_null($idferiado) ? $feriado_data : $feriado_data->where('f.id',$idferiado);  		                  
		$query = $this->db->get();
		$datos = is_null($idferiado) ? $query->result() : $query->row();
		return $datos;
	}




	public function add_feriado($array_datos){


		$this->db->select('f.id')
						  ->from('rem_feriado as f')
		                  ->where('f.fecha', strtoupper($array_datos['fecha']))
		                  ->where('f.active = 1');		

		$query = $this->db->get();
		$datos = $query->row();
		if(count($datos) == 0){ // nueva afp  no existe
			if($array_datos['idferiado'] == 0){
				$data = array(
			      	'fecha' => $array_datos['fecha'],
			      	'active' => 1,
			      	'created_at' => date('Ymd H:i:s')
				);

				$this->db->insert('rem_feriado', $data);
				$idferiado = $this->db->insert_id();

				return 1;
			}else{
				$data = array(
			      	'fecha' => $array_datos['fecha']
				);


				$this->db->where('id', $array_datos['idferiado']);
				$this->db->update('rem_feriado',$data); 
				return 1;
			}
		}else{ // ya existe feriado

			if($array_datos['idferiado'] != 0){
				$data = array(
			      	'fecha' => $array_datos['fecha']
				);


				$this->db->where('id', $array_datos['idferiado']);
				$this->db->update('rem_feriado',$data); 
				return 1;
			}else{
				return -1;	
			}
			
		}

	}	



	public function delete_feriado($idferiado){


		$this->db->where('id', $idferiado);
		$this->db->update('rem_feriado',array('active' => '0')); 

		return 1;
		/*if($this->db->affected_rows() > 0){ // se eliminó proveedor correctamente
			return 1;
		}else{ // no hubo eliminación de proveedor
			return -1;
		}*/



	}	



	public function empresas_asignadas($userid,$levelid,$empresaid = null){

		$empresa_data = $this->db->select('c.id, c.nombre ')
						  ->from('rem_empresa as c')
						  ->join('rem_usuario_empresa as uc','c.id = uc.idempresa')
		                  ->where('uc.idusuario', $userid)
		                  ->where('c.active = 1')
		                  ->order_by('c.nombre asc');
		$empresa_data = is_null($empresaid) ? $empresa_data : $empresa_data->where('c.id',$empresaid);  				                 
		$query = $this->db->get();
		$datos = $query->num_rows() == 1 ? $datos = $query->row() : $query->result();
		return $datos;

	}


}



