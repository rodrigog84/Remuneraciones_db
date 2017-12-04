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

class Rrhh_model extends CI_Model
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



public function add_personal($array_datos,$idtrabajador){


		$this->db->trans_start();

		$this->db->select('p.id, p.active')
						  ->from('rem_personal as p')
		                  ->where('p.rut', $array_datos['rut'])
		                  ->where('p.idempresa', $this->session->userdata('empresaid'));		
		$query = $this->db->get();
		$datos = $query->row();
		if(count($datos) == 0){ // nuevo trabajador no existe
			if($idtrabajador == 0){
				$array_datos['created_at'] = date('Y-m-d H:i:s');
				$this->db->insert('rem_personal', $array_datos);
				$idpersonal = $this->db->insert_id();


				$this->db->trans_complete();
				return 1;
			}else{
				$this->db->select('p.id, p.active')
								  ->from('gc_personal as p')
				                  ->where('p.id', $idtrabajador)
				                  ->where('p.idcomunidad', $this->session->userdata('comunidadid'));	
				$query = $this->db->get();
				$trabajador = $query->row();
				$cambio_estado = false;
				if($trabajador->active == 1 && $array_datos['active'] == 0){
					$cambio_estado = true;
					$mensaje = "Desactivación Trabajador";
				}else if($trabajador->active == 0 && $array_datos['active'] == 1){
					$cambio_estado = true;
					$mensaje = "Activación Trabajador";					
				}else{
					$cambio_estado = false;
				}


				unset($array_datos['rut']);
				unset($array_datos['dv']);
				$this->db->where('id', $idtrabajador);
				$this->db->where('idcomunidad', $this->session->userdata('comunidadid'));		
				$this->db->update('gc_personal',$array_datos); 




				$this->db->delete('gc_bonos_personal', array('idpersonal' => $idtrabajador)); 
				foreach ($array_bonos as $bono) {
					$bono['idpersonal'] = $idtrabajador;
					$this->db->insert('gc_bonos_personal', $bono);

				}


				if($cambio_estado){
					$this->cambio_estado($idtrabajador,$mensaje,$array_datos['active']);
				}

				$this->db->trans_complete();
				return 1;
			}
		}else{ // ya existe trabajador

			if($idtrabajador != 0){

				unset($array_datos['rut']);
				unset($array_datos['dv']);
				$this->db->where('id', $idtrabajador);
				$this->db->where('idcomunidad', $this->session->userdata('comunidadid'));		
				$this->db->update('gc_personal',$array_datos); 		

				$this->db->delete('gc_bonos_personal', array('idpersonal' => $idtrabajador)); 
				foreach ($array_bonos as $bono) {
					$bono['idpersonal'] = $idtrabajador;
					$this->db->insert('gc_bonos_personal', $bono);

				}

				$this->db->trans_complete();
				return 1;
			}else{
				$this->db->trans_complete();
				return -1;	
			}
			
		}

	}	



}