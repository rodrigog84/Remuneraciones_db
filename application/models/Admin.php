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

}



