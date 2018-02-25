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

class Auxiliar extends CI_Model
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

	public function get_dias_progresivos($idpersonal = null,$iddia = null){
		$cargos_data = $this->db->select('id , idpersonal, fechainicio, dias')
						  ->from('rem_dias_progresivos')
						  ->where('idpersonal',$idpersonal)
						  ->where('active',1)
		                  ->order_by('fechainicio');
		
		$cargos_data = is_null($iddia) ? $cargos_data : $cargos_data->where('id',$iddia);  	
		$query = $this->db->get();
		return  is_null($iddia) ? $query->result() : $query->row();
	}	


	public function get_cartola_vacaciones($idpersonal = null,$idcartola = null){
		$cargos_data = $this->db->select('c.id , c.idpersonal, c.fecinicio, c.fecfin, c.dias, c.comentarios')
						  ->from('rem_cartola_vacaciones c')
						  ->join('rem_personal p','c.idpersonal = p.id_personal')
						  ->where('p.id_empresa',$this->session->userdata('empresaid'))
						  ->where('c.idpersonal',$idpersonal)
						  ->where('c.active = 1')
		                  ->order_by('c.fecinicio');
		$cargos_data = is_null($idcartola) ? $cargos_data : $cargos_data->where('c.id',$idcartola);  	
		$query = $this->db->get();
		return  is_null($idcartola) ? $query->result() : $query->row();
	}	



	public function add_dia_progresivo($array_datos){

		$this->db->trans_start();

		if($array_datos['idcartola'] == 0){

			$this->db->query("update rem_personal set diasprogresivos = diasprogresivos + " . $array_datos['dias'] . " where id_personal = " . $array_datos['idpersonal']);
			/*$personal = $this->get_personal($array_datos['idpersonal']);
			$diasprogresivos =  $personal->diasprogresivos;*/

			$array_dia_progresivo = array(
							'idpersonal' => $array_datos['idpersonal'],
							'fechainicio' => $array_datos['periodo'],
							'dias' => $array_datos['dias'],
							'active' => 1,
							'created_at' => str_replace("-","",$array_datos['created_at']),
							'updated_at' => str_replace("-","",$array_datos['created_at'])
							);
			$this->db->insert('rem_dias_progresivos',$array_dia_progresivo);
		}else{

			$cartola = $this->get_dias_progresivos($array_datos['idpersonal'],$array_datos['idcartola']);

			if(is_null($cartola)){
				$this->db->trans_complete();
				return 2;
			}else{

				$diff_dias = $array_datos['dias'] - $cartola->dias;
				/*if($diff_dias > $num_dias){
					$this->db->trans_complete();
					return false;
				}*/

				$array_update = array( 'fechainicio' => $array_datos['periodo'],
						  'idpersonal' => $array_datos['idpersonal'],
						  'dias' => $array_datos['dias'],
						  );

				$this->db->where('id',$array_datos['idcartola']);
				$this->db->where('idpersonal',$array_datos['idpersonal']);
				$this->db->update('rem_dias_progresivos',$array_update);

				$this->load->model('rrhh_model');
				$personal = $this->rrhh_model->get_personal($array_datos['idpersonal']);
				$dias_vacaciones = dias_vacaciones($personal->fecinicvacaciones,$personal->saldoinicvacaciones);
				$dias_progresivos = $this->get_dias_progresivos($array_datos['idpersonal']);
				$num_dias_progresivos = num_dias_progresivos($personal->fecinicvacaciones,$personal->saldoinicvacprog,$dias_progresivos);
				$saldo_vacaciones = $dias_vacaciones + $num_dias_progresivos - $personal->diasvactomados;


				if($saldo_vacaciones < 0){

					$array_update['dias'] = $cartola->dias;
					$this->db->where('id',$array_datos['idcartola']);
					$this->db->where('idpersonal',$array_datos['idpersonal']);	
					$this->db->update('rem_dias_progresivos',$array_update); 
					$this->db->trans_complete();
					return 3;
				}	

				$this->db->query('update rem_personal set diasprogresivos = diasprogresivos + ' . $diff_dias . ' where id_personal = ' . $array_datos['idpersonal']);				
			}


		}

		$this->db->trans_complete();
		return 1;
	}



	public function delete_dias_progresivos($idpersonal,$idcartola){

		$this->db->trans_start();
		$cartola = $this->get_dias_progresivos($idpersonal,$idcartola);


		if(is_null($cartola)){
			$this->db->trans_complete();
			return 2;

		}else{






			$this->db->where('id', $idcartola);
			$this->db->where('idpersonal', $idpersonal);		
			$this->db->update('rem_dias_progresivos',array('active' => '0')); 

			$this->load->model('rrhh_model');
			$personal = $this->rrhh_model->get_personal($idpersonal);
			$dias_vacaciones = dias_vacaciones($personal->fecinicvacaciones,$personal->saldoinicvacaciones);
			$dias_progresivos = $this->get_dias_progresivos($idpersonal);
			$num_dias_progresivos = num_dias_progresivos($personal->fecinicvacaciones,$personal->saldoinicvacprog,$dias_progresivos);
			$saldo_vacaciones = $dias_vacaciones + $num_dias_progresivos - $personal->diasvactomados;


			if($saldo_vacaciones < 0){
				$this->db->where('id', $idcartola);
				$this->db->where('idpersonal', $idpersonal);		
				$this->db->update('rem_dias_progresivos',array('active' => '1')); 
				$this->db->trans_complete();
				return 3;
			}			

			$this->db->query('update rem_personal set diasprogresivos = diasprogresivos - ' . $cartola->dias . ' where id_personal = ' . $idpersonal);


			$this->db->trans_complete();
			return 1;
		}

	}	



public function solicita_vacaciones($array_datos){

		$this->db->trans_start();

		$this->load->model('rrhh_model');
		$personal = $this->rrhh_model->get_personal($array_datos['idpersonal']);
		$dias_vacaciones = dias_vacaciones($personal->fecinicvacaciones,$personal->saldoinicvacaciones);


		$dias_progresivos = $this->get_dias_progresivos($array_datos['idpersonal']);
		$num_dias_progresivos = num_dias_progresivos($personal->fecinicvacaciones,$personal->saldoinicvacprog,$dias_progresivos);

		$saldo_vacaciones = $dias_vacaciones + $num_dias_progresivos - $personal->diasvactomados;


		$num_dias = (int)$saldo_vacaciones;
		if($array_datos['idcartola'] == 0){
			
			if($array_datos['dias'] > $num_dias){
				$this->db->trans_complete();
				return false;
			}

			$array_insert = array('idpersonal' => $array_datos['idpersonal'],
						  'fecinicio' => str_replace("-","",$array_datos['fecinicio']),
						  'fecfin' => str_replace("-","",$array_datos['fecfin']),
						  'dias' => $array_datos['dias'],
						  'comentarios' => $array_datos['comentarios'],
						  'active' => 1,
						  'created_at' => str_replace("-","",$array_datos['created_at']),
						  'update_at' => str_replace("-","",$array_datos['created_at'])
						  );

			#CREA CARTOLAS
			$this->db->insert('rem_cartola_vacaciones', $array_insert);

			$this->db->query('update rem_personal set diasvactomados = diasvactomados + ' . $array_datos['dias'] . ' where id_personal = ' . $array_datos['idpersonal']);
			
		}else{

			$cartola = $this->get_cartola_vacaciones($array_datos['idpersonal'],$array_datos['idcartola']);

			if(is_null($cartola)){
				$this->db->trans_complete();
				return false;
			}else{

				$diff_dias = $array_datos['dias'] - $cartola->dias;
				if($diff_dias > $num_dias){
					$this->db->trans_complete();
					return false;
				}

				$array_update = array( 'fecinicio' => $array_datos['fecinicio'],
						  'fecfin' => $array_datos['fecfin'],
						  'dias' => $array_datos['dias'],
						  'comentarios' => $array_datos['comentarios']
						  );

				$this->db->where('id',$array_datos['idcartola']);
				$this->db->where('idpersonal',$array_datos['idpersonal']);
				$this->db->update('rem_cartola_vacaciones',$array_update);


				$this->db->query('update rem_personal set diasvactomados = diasvactomados + ' . $diff_dias . ' where id_personal = ' . $array_datos['idpersonal']);				
			}



		}

		$this->db->trans_complete();
		return true;

	}	



}



