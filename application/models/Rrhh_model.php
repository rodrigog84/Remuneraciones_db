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



public function get_centro_costo(){
		$this->db->select('id_centro_costo, id_empresa, nombre')
						  ->from('rem_centro_costo')
						  ->where('id_empresa', $this->session->userdata('empresaid'))
		                  ->order_by('nombre','asc');
		 $query = $this->db->get();
		 return $query->result();

	}



public function get_colaborador_sin_centro_costo(){
		$this->db->select('id_personal, rut')
						  ->from('rem_personal')
						  ->where('id_empresa', $this->session->userdata('empresaid'))
						  ->where('idcentrocosto', 0)
		                  ->order_by('nombre','asc');
		 $query = $this->db->get();
		 return $query->result();

	}


public function get_colaborador_sin_afp(){
		$this->db->select('id_personal, rut')
						  ->from('rem_personal')
						  ->where('id_empresa', $this->session->userdata('empresaid'))
						  ->where('(idafp = 0 or idafp is null)')
		                  ->order_by('nombre','asc');
		 $query = $this->db->get();
		// echo $this->db->last_query(); exit;
		 return $query->result();

	}


public function get_colaborador_sin_isapre(){
		$this->db->select('id_personal, rut')
						  ->from('rem_personal')
						  ->where('id_empresa', $this->session->userdata('empresaid'))
						  ->where('(idisapre = 0 or idisapre is null)')
		                  ->order_by('nombre','asc');
		 $query = $this->db->get();
		 return $query->result();

	}
	/*public function get_centro_costo_periodo_abierto($idperiodo = null){
		$data_periodo = $this->db->select('cc.nombre, pr.id_periodo, pr.id_empresa, pr.id_centro_costo')
						  ->from('rem_periodo_remuneracion pr')
						  ->join('rem_centro_costo as cc','pr.id_centro_costo = cc.id_centro_costo')
						  ->where('pr.id_empresa', $this->session->userdata('empresaid'))
		                  ->where('pr.aprueba is null')
		                  ->where('pr.cierre is not null')
		                  ->order_by('pr.id_centro_costo','desc');

		$data_periodo = is_null($idperiodo)	? $data_periodo : $data_periodo->where('pr.id_periodo',$idperiodo);

		$query = $this->db->get();
		return $query->result() ;
	}	*/


	public function get_centro_costo_periodo_abierto($idperiodo = null){

		$sql_centro_costo = $idperiodo != null ? "pr.id_periodo = " . $idperiodo . " and " : "";
		$data_periodo = "select id_centro_costo, nombre 
						from rem_centro_costo 
						where id_empresa =".$this->session->userdata('empresaid')." 
						and valido is not null 
						and id_centro_costo in (select distinct idcentrocosto from rem_personal where id_empresa = ".$this->session->userdata('empresaid')." and active = 1)						
						and id_centro_costo  in (select pr.id_centro_costo  
													from rem_periodo_remuneracion as pr
													where " . $sql_centro_costo . " pr.id_empresa =".$this->session->userdata('empresaid')."
													
													and cierre is not null)"; 
    //	echo $data_periodo; 
    	$query= $this->db->query($data_periodo);
   		return $query->result();
	}

	Public function get_centro_costo_no_calculado($mes,$anno){
		$data_periodo = "select id_centro_costo, nombre 
						from rem_centro_costo 
						where id_empresa =".$this->session->userdata('empresaid')." 
						and valido is not null 
						and id_centro_costo in (select distinct idcentrocosto from rem_personal where id_empresa = ".$this->session->userdata('empresaid')." and active = 1)						
						and id_centro_costo not in (select pr.id_centro_costo  
													from rem_periodo_remuneracion as pr
													join rem_periodo as p on pr.id_periodo = p.id_periodo
													where p.mes =".$mes." 
													and p.anno = ".$anno."
													and pr.id_empresa =".$this->session->userdata('empresaid')."
													
													and cierre is not null)"; 
    //	echo $data_periodo; 
    	$query= $this->db->query($data_periodo);
   		return $query->result();
    	
	}


	public function get_ultima_remuneracion($idpersonal){

		$data_periodo = "	select		r.id_remuneracion
							from		rem_remuneracion r
							where		r.id_empresa = ".$this->session->userdata('empresaid')."
							and			r.idpersonal = ".$idpersonal."
							and			r.id_periodo = (
														select		p.id_periodo
														from		rem_periodo p
														inner join (
																		select		max(cast(
																							(cast(p.anno as varchar) +
																							case when p.mes < 10 then '0' + cast(mes as varchar)
																								 else cast(p.mes as varchar)
																							end) as int)) as periodo
																		from		rem_periodo p
																		inner join	rem_periodo_remuneracion pr on p.id_periodo = pr.id_periodo and pr.id_empresa = ".$this->session->userdata('empresaid')." and pr.aprueba is not null
																		inner join	rem_remuneracion r on pr.id_periodo = r.id_periodo and pr.id_empresa = r.id_empresa
																		where		r.idpersonal = ".$idpersonal." 
																	) m on p.anno = left(m.periodo,4) and p.mes = cast(right(m.periodo,2) as int)
														)"; 
    //	echo $data_periodo; 
    	$query= $this->db->query($data_periodo);
   		return $query->result();


	}



	public function get_centro_costo_pendiente($idperiodo =null){

		$data_periodo = "select id_centro_costo, nombre 
						from rem_centro_costo 
						where id_empresa =".$this->session->userdata('empresaid')." 
						and valido is not null 
						and id_centro_costo in (select distinct idcentrocosto from rem_personal where id_empresa = ".$this->session->userdata('empresaid')." and active = 1)						
						 and id_centro_costo not in (select pr.id_centro_costo  
													from rem_periodo_remuneracion as pr
													where pr.id_periodo = ".$idperiodo."
													and pr.id_empresa =".$this->session->userdata('empresaid')."
													
													and cierre is not null)";

        $query= $this->db->query($data_periodo);
   		if($query->num_rows() == 0){
			return 0;
		}else{

   		return $query->result();
   	}

	}



	public function get_periodos_remuneracion_abiertos_resumen($idperiodo = null){
		$data_periodo = $this->db->select('p.id_periodo, p.mes, p.anno,count(distinct "id_centro_costo") as ccostocalculados,  (select count( distinct idcentrocosto) from rem_personal where id_empresa = ' . $this->session->userdata('empresaid') . ' and active = 1) as ccostoexistentes',false)
						  ->from('rem_periodo as p')
						  ->join('rem_periodo_remuneracion as pr','p.id_periodo = pr.id_periodo')
						  ->where('pr.id_empresa', $this->session->userdata('empresaid'))
		                  ->where('pr.aprueba is null')
		                  ->where('pr.cierre is not null')
		                  ->where('pr.id_centro_costo in (select distinct idcentrocosto from rem_personal where id_empresa = ' . $this->session->userdata('empresaid') . ' and active = 1)')
		                  ->group_by('p.id_periodo, p.mes, p.anno')
		                  ->order_by('p.anno','asc')
		                  ->order_by('p.mes','asc');

		$data_periodo = is_null($idperiodo)	? $data_periodo : $data_periodo->where('pr.id_periodo',$idperiodo);

		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		
		return is_null($idperiodo) ? $query->result() : $query->row();
	}


	public function get_periodos_remuneracion_abiertos($idperiodo = null){
		$data_periodo = $this->db->select('p.id_periodo, p.mes, p.anno, pr.cierre, pr.aprueba, pr.anticipo')
						  ->from('rem_periodo as p')
						  ->join('rem_periodo_remuneracion as pr','p.id_periodo = pr.id_periodo')
						  ->where('pr.id_empresa', $this->session->userdata('empresaid'))
		                  ->where('pr.aprueba is null')
		                  ->where('pr.cierre is not null')
		                  ->group_by('p.id_periodo, p.mes,p.anno, pr.cierre, pr.aprueba, pr.anticipo')
		                  ->order_by('p.anno','desc')
		                  ->order_by('p.mes','desc');

		$data_periodo = is_null($idperiodo)	? $data_periodo : $data_periodo->where('pr.id_periodo',$idperiodo);

		$query = $this->db->get();

		return is_null($idperiodo) ? $query->result() : $query->row();
	}	


public function verificar_personal($rut){

		$this->db->trans_start();

		$this->db->select('p.id_personal, p.active')
						  ->from('rem_personal as p')
		                  ->where('p.rut', $rut)
		                  ->where('p.id_empresa', $this->session->userdata('empresaid'))
		                  ->where('p.active = 1');		
		$query = $this->db->get();
		$datos = $query->row();
		if($query->num_rows() == 0){
			return 0;
		}
		else{
			return 1;
		

		}
		$this->db->trans_complete();
}


public function desactivar_personal($rut){

		$this->db->trans_start();

		$this->db->select('p.id_personal, p.active')
						  ->from('rem_personal as p')
		                  ->where('p.rut', $rut)
		                  ->where('p.id_empresa', $this->session->userdata('empresaid'))
		                  ->where('p.active = 1');		
		$query = $this->db->get();
		$datos = $query->row();
		if($query->num_rows() == 0){
			return 0;
		}else{
			$this->db->where('rut', $rut);
			$this->db->where('id_empresa', $this->session->userdata('empresaid'));
			$this->db->update('rem_personal',array('active' => '0')); 
			$this->db->trans_complete();
			return 1;

		}



}



public function actualiza_datos_colaborador($idpersonal,$valor,$parametro){

		$this->db->trans_start();
			
		$this->db->where('id_personal', $idpersonal);
		$this->db->where('id_empresa', $this->session->userdata('empresaid'));
		$this->db->update('rem_personal',array($parametro => $valor)); 
		
		$this->db->trans_complete();

		return 1;
}


public function activar_personal($rut){

		$this->db->trans_start();

		$this->db->select('p.id_personal, p.active')
						  ->from('rem_personal as p')
		                  ->where('p.rut', $rut)
		                  ->where('p.id_empresa', $this->session->userdata('empresaid'))
		                  ->where('p.active = 0');		
		$query = $this->db->get();
		$datos = $query->row();
		if($query->num_rows() == 0){
			return 0;
		}else{
			$this->db->where('rut', $rut);
			$this->db->where('id_empresa', $this->session->userdata('empresaid'));
			$this->db->update('rem_personal',array('active' => '1')); 
			$this->db->trans_complete();
			return 1;

		}
}


public function edit_personal($array_datos,$idtrabajador){


		$this->db->trans_start();

		//echo "<pre>";
		//var_dump($array_datos); exit;

		$this->db->select('p.id_personal, p.active')
						  ->from('rem_personal as p')
		                  ->where('p.id_personal', $idtrabajador)
		                  ->where('p.id_empresa', $this->session->userdata('empresaid'));		
		$query = $this->db->get();
		$datos = $query->row();


		if($query->num_rows() == 1){ // nuevo trabajador no existe


				$this->db->select('p.id_personal, p.active')
						  ->from('rem_personal as p')
						  ->where('p.rut', $array_datos['rut'])
		                  ->where('p.id_personal != ' . $idtrabajador)
		                  ->where('p.id_empresa', $this->session->userdata('empresaid'));		
				$query = $this->db->get();
				$datos = $query->row();
				if($query->num_rows() > 0){
					return -1;

				}else{
					$this->db->where('id_personal', $idtrabajador);
					$this->db->where('id_empresa', $this->session->userdata('empresaid'));
					$this->db->update('rem_personal',$array_datos); 
					$this->db->trans_complete();
					return 1;

				}



			}

}



public function add_personal($array_datos,$idtrabajador){


		$this->db->trans_start();

		$this->db->select('p.id_personal, p.active')
						  ->from('rem_personal as p')
		                  ->where('p.rut', $array_datos['rut'])
		                  ->where('p.id_empresa', $this->session->userdata('empresaid'));		
		$query = $this->db->get();
		$datos = $query->row();
		if($query->num_rows() == 0){ // nuevo trabajador no existe
			if($idtrabajador == 0){
				$array_datos['updated_at'] = date('Ymd H:i:s');
				$array_datos['created_at'] = date('Ymd H:i:s');
				$this->db->insert('rem_personal', $array_datos);
				$idpersonal = $this->db->insert_id();


				$this->db->trans_complete();
				return 1;
			}else{
				$this->db->select('p.id, p.active')
								  ->from('gc_personal as p')
				                  ->where('p.id', $idtrabajador)
				                  ->where('p.idcomunidad', $this->session->userdata('empresaid'));	
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
				$this->db->where('idcomunidad', $this->session->userdata('empresaid'));		
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
				$this->db->where('idcomunidad', $this->session->userdata('empresaid'));		
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



	public function get_datos_remuneracion_by_periodo($idperiodo,$idtrabajador = null){

		$personal_data = $this->db->select('r.id_remuneracion, r.idpersonal, r.id_periodo, r.diastrabajo, r.horasdescuento, r.montodescuento, r.horasextras50, r.montohorasextras50, r.horasextras100, r.montohorasextras100, r.anticipo, r.aguinaldo, r.sueldobase, r.gratificacion, r.movilizacion, r.sueldonoimponible, r.sueldoimponible, r.totalleyessociales, r.otrosdescuentos')
						  ->from('rem_remuneracion r')
						  ->join('rem_personal pe','r.idpersonal = pe.id_personal')
						  ->where('pe.id_empresa',$this->session->userdata('empresaid'))
						  ->where('pe.active = 1')
						  ->where('r.id_periodo',$idperiodo)						  
		                  ->order_by('pe.nombre');
		$personal_data = is_null($idtrabajador) ? $personal_data : $personal_data->where('r.idpersonal',$idtrabajador);  		                  
		$query = $this->db->get();
		$datos = is_null($idtrabajador) ? $query->result() : $query->row();
		return $datos;
	}	



	public function save_hab_descto_variable($array_datos_hab_descto){

		$this->db->trans_start();

		//var_dump_new($array_datos_hab_descto); //exit;

		$lista_montos = $array_datos_hab_descto['lista_montos'];
		$mes = $array_datos_hab_descto['mes'];
		$anno = $array_datos_hab_descto['anno'];
	// evaluar si existe periodo
		$this->db->select('p.id_periodo')
						  ->from('rem_periodo as p')
		                  ->where('p.mes', $mes)
		                  ->where('p.anno', $anno);
		$query = $this->db->get();
		$datos_periodo = $query->row();
		$idperiodo = 0;
		if($query->num_rows() == 0){ // si no existe periodo, se crea
				$data = array(
			      	'mes' => $mes,
			      	'anno' =>  $anno
				);
				$this->db->insert('rem_periodo', $data);	
				$idperiodo = $this->db->insert_id();
		}else{
				$idperiodo = $datos_periodo->id_periodo;
		}


		$this->load->model('configuracion');
		$datos_hab_descto = $this->configuracion->get_haberes_descuentos($array_datos_hab_descto['id_hab_descto']);

		$array_hab_descto = $this->get_haberes_descuentos_totales_validos($array_datos_hab_descto['id_hab_descto'],$idperiodo);
		//var_dump_new($datos_hab_descto);
		//var_dump_new($array_hab_descto); 
		//exit;
		$listado_col = $array_datos_hab_descto['listado_col'];
		foreach ($listado_col as $idpersonal) {

			$ingresa = true;

			foreach ($array_hab_descto as $haber_descuento) { //verifica si el bono ya existe o no
				if($haber_descuento->idpersonal == $idpersonal){
					$ingresa = false;
				}

			}


			if($ingresa){

				$array_datos = array(
									'idconf' => $array_datos_hab_descto['id_hab_descto'],
									'idpersonal' => $idpersonal,
									'descripcion' => $datos_hab_descto->nombre,
									'monto' => str_replace(".","",$lista_montos[$idpersonal]),
									'idperiodo' => $idperiodo,
									'created_at' => date('Ymd H:i:s'),
									'updated_at' => date('Ymd H:i:s')
								);
				$this->db->insert('rem_bonos_personal',$array_datos);

			}else{



				$this->db->where('idconf', $array_datos_hab_descto['id_hab_descto']);
	            $this->db->where('idpersonal', $idpersonal);
	            $this->db->where('idperiodo', $idperiodo);
	            $this->db->update('rem_bonos_personal', array('monto' => str_replace(".","",$lista_montos[$idpersonal])));


			}


		}


		$this->db->trans_complete();
		return 1;

	}



    public function save_documentos_colaborador($datos_documento)
    {


        $this->db->trans_start();
        	$this->load->model('admin');

        	
        	$formatosdocumentos = $this->admin->get_formatos_documentos($datos_documento['tipo_documento']);

        	$pdf_content = $formatosdocumentos[0]->txt_documento;

        	$personal = $this->admin->get_personal_total($datos_documento['id_trabajador']);
        	//var_dump_new($personal); exit;

        	$pdf_content = str_replace("@FechaActual",date('d/m/Y'),$pdf_content);
        	$pdf_content = str_replace("@TextoFechaActual",date('d') . ' de ' . month2string((int)date('m')) . ' de ' . date('Y'),$pdf_content);
			$pdf_content = str_replace("@Nombre",$personal->nombre.' '.$personal->apaterno.' '.$personal->amaterno,$pdf_content);
			$pdf_content = str_replace("@Rut",$personal->rut.'-'.$personal->dv,$pdf_content);
			$pdf_content = str_replace("@Direccion",$personal->direccion.', '.$personal->nombrecomuna,$pdf_content);
			$pdf_content = str_replace("@FechaNacimiento",$personal->fecnacimiento_format,$pdf_content);
			$pdf_content = str_replace("@Cargo",$personal->nombrecargo,$pdf_content);
			$pdf_content = str_replace("@SueldoBase",'$ ' . number_format($personal->sueldobase,0,'.','.'),$pdf_content);
			$pdf_content = str_replace("@TextoSueldoBase",valorEnLetras($personal->sueldobase),$pdf_content);
			$tipo_contrato = '';
			if($personal->tipocontrato == 'I'){
				$tipo_contrato = 'Indefinido';
			}else if($personal->tipocontrato == 'F'){
				$tipo_contrato = 'Plazo Fijo';
			}

			$pdf_content = str_replace("@TipoContrato",$tipo_contrato,$pdf_content);
			$pdf_content = str_replace("@FechaIngreso",$personal->fecingreso_format,$pdf_content);



        	

        	/* reemplazar valores por los datos *****/
            $array_datos = array(
                'id_formato' => $datos_documento['tipo_documento'],
                'id_personal' => $datos_documento['id_trabajador'],
                'pdf_content' => $pdf_content
            );

            $this->db->insert('rem_documentos_colaborador', $array_datos);
        $this->db->trans_complete();
        return 1;
    }	



    public function delete_documentos_colaborador($idtrabajador,$iddocumento)
    {


        $this->db->trans_start();

			$this->db->where('id_documento', $iddocumento);
            $this->db->where('id_personal', $idtrabajador);
            $this->db->update('rem_documentos_colaborador', array('activo' => 0));

        $this->db->trans_complete();
        return 1;
    }	




	public function save_hab_descto_variable2($array_datos_hab_descto,$mes,$anno){

		$this->db->trans_start();

		
		//$lista_montos = $array_datos_hab_descto['lista_montos'];
		
	// evaluar si existe periodo
		$this->db->select('p.id_periodo')
						  ->from('rem_periodo as p')
		                  ->where('p.mes', $mes)
		                  ->where('p.anno', $anno);
		$query = $this->db->get();
		$datos_periodo = $query->row();
		$idperiodo = 0;
		if($query->num_rows() == 0){ // si no existe periodo, se crea
				$data = array(
			      	'mes' => $mes,
			      	'anno' =>  $anno
				);
				$this->db->insert('rem_periodo', $data);
				$idperiodo = $this->db->insert_id();
		}else{
				$idperiodo = $datos_periodo->id_periodo;
		}

		foreach ($array_datos_hab_descto as $idpersonal) {

			
			$this->db->select('p.idconf, p.idpersonal, p.valido, p.idperiodo')
				  ->from('rem_bonos_personal p')
				  ->where('p.idconf',$idpersonal['id_hab_descto'])
				  ->where('p.idpersonal', $idpersonal['idtrabajador'])
				  ->where('p.idperiodo', $idperiodo)
				  ->where('p.valido',1);
            $query = $this->db->get();
            $datos_bonos = $query->row();
			
			$array_datos = array(
				'idconf' => $idpersonal['id_hab_descto'],
				'idpersonal' => $idpersonal['idtrabajador'],
				'descripcion' => $idpersonal['nombre'],
				'monto' => $idpersonal['lista_montos'],
				'idperiodo' => $idperiodo,
				'created_at' => date('Ymd H:i:s'),
			);
			
			if($query->num_rows() == 0){ 

		      $this->db->insert('rem_bonos_personal',$array_datos);
		       //print_r($array_datos);	


		    }else{	

		       $array_datos['updated_at'] = date("Ymd H:i:s");
		       $this->db->where('idpersonal', $idpersonal['idtrabajador']);
			   $this->db->where('idperiodo', $idperiodo);
			   $this->db->where('idconf', $idpersonal['id_hab_descto']);
			   $this->db->update('rem_bonos_personal', $array_datos);

			 		    }		 

			//print_r($array_datos);
		}

		
    
		$this->db->trans_complete();
		return 1;

	}

	public function get_datos_remuneracion($mes,$anno,$idtrabajador = null){

		$personal_data = $this->db->select('r.idpersonal, r.id_periodo, r.diastrabajo, r.horasdescuento, r.montodescuento, r.valorhorasextras50, r.horasextras50, r.montohorasextras50, r.valorhorasextras100, r.horasextras100, r.montohorasextras100, r.anticipo, r.aguinaldo, r.sueldobase, r.gratificacion, r.movilizacion, r.valorhora')
						  ->from('rem_remuneracion r')
						  ->join('rem_personal pe','r.idpersonal = pe.id_personal')
						  ->join('rem_periodo p','r.id_periodo = p.id_periodo')
						  ->where('pe.id_empresa',$this->session->userdata('empresaid'))
						  ->where('pe.active = 1')
						  ->where('p.mes',$mes)
						  ->where('p.anno',$anno)
		                  ->order_by('pe.nombre');
		$personal_data = is_null($idtrabajador) ? $personal_data : $personal_data->where('r.idpersonal',$idtrabajador);  		                  
		$query = $this->db->get();
		$datos = is_null($idtrabajador) ? $query->result() : $query->row();
		return $datos;
	}	



	public function get_estado_periodo($mes,$anno){

		$this->db->select('pr.anticipo, pr.cierre')
						  ->from('rem_periodo_remuneracion as pr')
						  ->join('rem_periodo as p','pr.id_periodo = p.id_periodo')
		                  ->where('p.mes', $mes)
		                  ->where('p.anno', $anno)
		                  ->where('pr.id_empresa', $this->session->userdata('empresaid'))
		                  ->order_by('pr.cierre');
		                  //->where('pr.cierre is null');
		$query = $this->db->get();
		$datos_periodo = $query->row();
		if($query->num_rows() == 0){
			return 2;
		}else{
			
			if(is_null($datos_periodo->cierre)){
				return is_null($datos_periodo->anticipo) ? 1 : 3;  #EL 3 aplica sólo en cálculo de anticipo
			}else{
				return 0;
			}
		}
	}


public function save_asistencia($array_trabajadores,$mes,$anno){


		$this->db->trans_start();

		// evaluar si existe periodo
		$this->db->select('p.id_periodo')
						  ->from('rem_periodo as p')
		                  ->where('p.mes', $mes)
		                  ->where('p.anno', $anno);
		$query = $this->db->get();
		$datos_periodo = $query->row();
		//$idperiodo = 0;
		//if(count($datos_periodo) == 0){ // si no existe periodo, se crea
		if($query->num_rows() == 0){ // si no existe periodo, se crea
				$data = array(
			      	'mes' => $mes,
			      	'anno' =>  $anno
				);
				$this->db->insert('rem_periodo', $data);
				$idperiodo = $this->db->insert_id();
		}else{
				$idperiodo = $datos_periodo->id_periodo;
		}


		// evaluar si existe periodo remuneraciones
		$this->db->select('r.id_periodo')
						  ->from('rem_periodo_remuneracion as r')
		                  ->where('r.id_periodo', $idperiodo)
		                  ->where('r.id_empresa', $this->session->userdata('empresaid'));
		$query = $this->db->get();
		$datos_periodo_remuneracion = $query->row();
		if($query->num_rows() == 0){ // si no existe periodo, se crea
				$data = array(
			      	'id_periodo' => $idperiodo,
			      	'id_empresa' => $this->session->userdata('empresaid')
				);
				$this->db->insert('rem_periodo_remuneracion', $data);
		}

		//print_r($array_trabajadores);
		//exit;


		foreach ($array_trabajadores as $idtrabajador => $info_trabajador) {

			/*print_r("---");
			print_r($idtrabajador);
			print_r("---");
			print_r($info_trabajador);
			print_r("---");
			print_r($idperiodo);*/

			$this->db->select('r.id_periodo')
							  ->from('rem_remuneracion as r')
			                  ->where('r.idpersonal', $idtrabajador)
			                  ->where('r.id_periodo', $idperiodo);
			$query = $this->db->get();
			$datos_remuneracion = $query->row();
			if($query->num_rows() == 0){ // si no existe periodo, se crea

					$data = array(
				      	'idpersonal' => $idtrabajador,
				      	'id_periodo' => $idperiodo,
				      	'diastrabajo' => $info_trabajador,
				      	'id_empresa' => $this->session->userdata('empresaid'),
				      	'created_at' => date("Ymd H:i:s")

					);
					$this->db->insert('rem_remuneracion', $data);
			}else{
					$data = array(
				      	'diastrabajo' => $info_trabajador
					);				
					$this->db->where('idpersonal', $idtrabajador);
					$this->db->where('id_periodo', $idperiodo);
					$this->db->update('rem_remuneracion',$data); 

			}
		}

		//exit;

		$this->db->trans_complete();
		return 1;
	}	



public function save_horas_extraordinarias($array_trabajadores,$mes,$anno){

		$this->db->trans_start();

		// evaluar si existe periodo
		$this->db->select('p.id_periodo')
						  ->from('rem_periodo as p')
		                  ->where('p.mes', $mes)
		                  ->where('p.anno', $anno);
		$query = $this->db->get();
		$datos_periodo = $query->row();
		$idperiodo = 0;
		if($query->num_rows() == 0){ // si no existe periodo, se crea
				$data = array(
			      	'mes' => $mes,
			      	'anno' =>  $anno
				);
				$this->db->insert('rem_periodo', $data);
				$idperiodo = $this->db->insert_id();
		}else{
				$idperiodo = $datos_periodo->id_periodo;
		}



		// evaluar si existe periodo remuneraciones
		$this->db->select('r.id_periodo')
						  ->from('rem_periodo_remuneracion as r')
		                  ->where('r.id_periodo', $idperiodo)
		                  ->where('r.id_empresa', $this->session->userdata('empresaid'));
		$query = $this->db->get();
		$datos_periodo_remuneracion = $query->row();
		if($query->num_rows() == 0){ // si no existe periodo, se crea
				$data = array(
			      	'id_periodo' => $idperiodo,
			      	'id_empresa' => $this->session->userdata('empresaid')
				);
				$this->db->insert('rem_periodo_remuneracion', $data);
		}



		foreach ($array_trabajadores as $idtrabajador => $info_trabajador) {

			$this->db->select('r.id_periodo')
							  ->from('rem_remuneracion as r')
			                  ->where('r.idpersonal', $idtrabajador)
			                  ->where('r.id_periodo', $idperiodo);
			$query = $this->db->get();
			$datos_remuneracion = $query->row();
			if($query->num_rows() == 0){ // si no existe periodo, se crea

					$data = array(
						'idpersonal' => $idtrabajador,
				      	'id_periodo' => $idperiodo,
				      	'horasextras50' => $info_trabajador['horas50'],
				      	'montohorasextras50' => $info_trabajador['monto50'],
				      	'horasextras100' => $info_trabajador['horas100'],
				      	'montohorasextras100' => $info_trabajador['monto100'],				      	
				      	'id_empresa' => $this->session->userdata('empresaid'),
				      	'created_at' => date("Ymd H:i:s")

					);
					$this->db->insert('rem_remuneracion', $data);
			}else{
					$data = array(
				      	'horasextras50' => $info_trabajador['horas50'],
				      	'montohorasextras50' => $info_trabajador['monto50'],
				      	'horasextras100' => $info_trabajador['horas100'],
				      	'montohorasextras100' => $info_trabajador['monto100']	
					);				
					$this->db->where('idpersonal', $idtrabajador);
					$this->db->where('id_periodo', $idperiodo);
					$this->db->update('rem_remuneracion',$data); 

			}			

			
		}

		$this->db->trans_complete();
		return 1;
	}

	public function save_horas_extraordinarias_masiva($array_trabajadores,$mes,$anno){

		$this->db->trans_start();

		// evaluar si existe periodo
		$this->db->select('p.id_periodo')
						  ->from('rem_periodo as p')
		                  ->where('p.mes', $mes)
		                  ->where('p.anno', $anno);
		$query = $this->db->get();
		$datos_periodo = $query->row();
		$idperiodo = 0;
		if($query->num_rows() == 0){ // si no existe periodo, se crea
				$data = array(
			      	'mes' => $mes,
			      	'anno' =>  $anno
				);
				$this->db->insert('rem_periodo', $data);
				$idperiodo = $this->db->insert_id();
		}else{
				$idperiodo = $datos_periodo->id_periodo;
		}



		// evaluar si existe periodo remuneraciones
		$this->db->select('r.id_periodo')
						  ->from('rem_periodo_remuneracion as r')
		                  ->where('r.id_periodo', $idperiodo)
		                  ->where('r.id_empresa', $this->session->userdata('empresaid'));
		$query = $this->db->get();
		$datos_periodo_remuneracion = $query->row();
		if($query->num_rows() == 0){ // si no existe periodo, se crea
				$data = array(
			      	'id_periodo' => $idperiodo,
			      	'id_empresa' => $this->session->userdata('empresaid')
				);
				$this->db->insert('rem_periodo_remuneracion', $data);
		}



		foreach ($array_trabajadores as $info_trabajador) {

			$this->db->select('r.id_periodo')
							  ->from('rem_remuneracion as r')
			                  ->where('r.idpersonal', $info_trabajador['idtrabajador'])
			                  ->where('r.id_periodo', $idperiodo);
			$query = $this->db->get();
			$datos_remuneracion = $query->row();
			if($query->num_rows() == 0){ // si no existe periodo, se crea

					$data = array(
						'idpersonal' => $info_trabajador['idtrabajador'],
				      	'id_periodo' => $idperiodo,
				      	'horasextras50' => $info_trabajador['horas2'],
				      	'montohorasextras50' => $info_trabajador['montohorasextras50'],
				      	'horasextras100' => $info_trabajador['horas1'],
				      	'montohorasextras100' => $info_trabajador['montohorasextras100'],				      	
				      	'id_empresa' => $this->session->userdata('empresaid'),
				      	'created_at' => date("Ymd H:i:s")

					);
					$this->db->insert('rem_remuneracion', $data);
			}else{
					$data = array(
				      	'horasextras50' => $info_trabajador['horas50'],
				      	'montohorasextras50' => $info_trabajador['monto50'],
				      	'horasextras100' => $info_trabajador['horas100'],
				      	'montohorasextras100' => $info_trabajador['monto100']	
					);				
					$this->db->where('idpersonal', $info_trabajador['idtrabajador']);
					$this->db->where('id_periodo', $idperiodo);
					$this->db->update('rem_remuneracion',$data); 

			}			

			
		}

		$this->db->trans_complete();
		return 1;
	}



	public function save_anticipo($array_trabajadores,$mes,$anno){

		$this->db->trans_start();

		// evaluar si existe periodo
		$this->db->select('p.id_periodo')
						  ->from('rem_periodo as p')
		                  ->where('p.mes', $mes)
		                  ->where('p.anno', $anno);
		$query = $this->db->get();
		$datos_periodo = $query->row();
		$idperiodo = 0;
		if($query->num_rows() == 0){ // si no existe periodo, se crea
				$data = array(
			      	'mes' => $mes,
			      	'anno' =>  $anno
				);
				$this->db->insert('rem_periodo', $data);
				$idperiodo = $this->db->insert_id();
		}else{
				$idperiodo = $datos_periodo->id_periodo;
		}


		// evaluar si existe periodo remuneraciones
		$this->db->select('r.id_periodo')
						  ->from('rem_periodo_remuneracion as r')
		                  ->where('r.id_periodo', $idperiodo)
		                  ->where('r.id_empresa', $this->session->userdata('empresaid'));
		$query = $this->db->get();
		$datos_periodo_remuneracion = $query->row();
		if($query->num_rows() == 0){ // si no existe periodo, se crea
				$data = array(
			      	'id_periodo' => $idperiodo,
			      	'id_empresa' => $this->session->userdata('empresaid')
				);
				$this->db->insert('rem_periodo_remuneracion', $data);
		}




		foreach ($array_trabajadores as $idtrabajador => $info_trabajador) {

			$this->db->select('r.id_periodo')
							  ->from('rem_remuneracion as r')
			                  ->where('r.idpersonal', $idtrabajador)
			                  ->where('r.id_periodo', $idperiodo);
			$query = $this->db->get();
			$datos_remuneracion = $query->row();
			if($query->num_rows() == 0){ // si no existe periodo, se crea
					$data = array(
				      	'idpersonal' => $idtrabajador,
				      	'id_periodo' => $idperiodo,
				      	'anticipo' => $info_trabajador['anticipo'],
				      	'aguinaldo' => $info_trabajador['aguinaldo'],
				      	'id_empresa' => $this->session->userdata('empresaid'),
				      	'created_at' => date("Ymd H:i:s")

					);
					$this->db->insert('rem_remuneracion', $data);
			}else{
					$data = array(
				      	'anticipo' => $info_trabajador['anticipo'],
				      	'aguinaldo' => $info_trabajador['aguinaldo'],
					);				
					$this->db->where('idpersonal', $idtrabajador);
					$this->db->where('id_periodo', $idperiodo);
					$this->db->update('rem_remuneracion',$data); 

			}
		}

		$this->db->trans_complete();
		return 1;
	}

	public function save_anticipo_masiva($array_trabajadores,$mes,$anno){

		$this->db->trans_start();
		// evaluar si existe periodo
		$this->db->select('p.id_periodo')
						  ->from('rem_periodo as p')
		                  ->where('p.mes', $mes)
		                  ->where('p.anno', $anno);
		$query = $this->db->get();
		$datos_periodo = $query->row();
		$idperiodo = 0;
		if($query->num_rows() == 0){ // si no existe periodo, se crea
				$data = array(
			      	'mes' => $mes,
			      	'anno' =>  $anno
				);
				$this->db->insert('rem_periodo', $data);
				$idperiodo = $this->db->insert_id();
		}else{
				$idperiodo = $datos_periodo->id_periodo;
		}


		// evaluar si existe periodo remuneraciones
		$this->db->select('r.id_periodo')
						  ->from('rem_periodo_remuneracion as r')
		                  ->where('r.id_periodo', $idperiodo)
		                  ->where('r.id_empresa', $this->session->userdata('empresaid'));
		$query = $this->db->get();
		$datos_periodo_remuneracion = $query->row();
		if($query->num_rows() == 0){ // si no existe periodo, se crea
				$data = array(
			      	'id_periodo' => $idperiodo,
			      	'id_empresa' => $this->session->userdata('empresaid')
				);
				$this->db->insert('rem_periodo_remuneracion', $data);
		}




		foreach ($array_trabajadores as $idtrabajador => $info_trabajador) {


            $idtrabajador = $info_trabajador['idtrabajador'];

			$this->db->select('r.id_periodo')
							  ->from('rem_remuneracion as r')
			                  ->where('r.idpersonal', $idtrabajador)
			                  ->where('r.id_periodo', $idperiodo);
			$query = $this->db->get();
			$datos_remuneracion = $query->row();

			//print_r($info_trabajador);
			//print_r($idtrabajador);
		    //exit;

			if($query->num_rows() == 0){ // si no existe periodo, se crea
					$data = array(
				      	'idpersonal' => $info_trabajador['idtrabajador'],
				      	'id_periodo' => $idperiodo,
				      	'anticipo' => $info_trabajador['anticipos'],
				      	'aguinaldo' => $info_trabajador['aguinaldo'],
				      	'id_empresa' => $this->session->userdata('empresaid'),
				      	'created_at' => date("Ymd H:i:s")

					);
					$this->db->insert('rem_remuneracion', $data);
			}else{
					$data = array(
				      	'anticipo' => $info_trabajador['anticipos'],
				      	'aguinaldo' => $info_trabajador['aguinaldo'],
					);				
					$this->db->where('idpersonal', $idtrabajador);
					$this->db->where('id_periodo', $idperiodo);
					$this->db->update('rem_remuneracion',$data); 

			}
		}

		$this->db->trans_complete();
		return 1;
	}

	public function get_personal_datos($rut = null,$idtrabajador = null){


		$array_campos = array(
				'id_personal', 
				'id_empresa', 
				'concat(cast(rut as varchar),\'-\',dv) as rut', 
				'dv', 
				'nombre', 
				'apaterno', 
				'amaterno', 
				'format(fecnacimiento,\'dd/MM/yyyy\',\'en-US\') as fecnacimiento', 
				'sexo', 
				'idecivil', 
				'nacionalidad', 
				'direccion', 
				'idregion', 
				'idcomuna', 
				'fono', 
				'email', 
				'format(fecingreso,\'dd/MM/yyyy\',\'en-US\') as fecingreso', 
				'fecingreso as fecingreso_sformat',
				'idcargo', 
				'tipocontrato', 
				'parttime', 
				'segcesantia', 
				'pensionado', 
				'diastrabajo', 
				'horasdiarias', 
				'horassemanales', 
				'sueldobase', 
				'tipogratificacion', 
				'gratificacion', 
				'asigfamiliar', 
				'cargassimples', 
				'cargasinvalidas', 
				'cargasmaternales', 
				'cargasretroactivas', 
				'idasigfamiliar',
				'movilizacion', 
				'colacion', 
				'idafp', 
				'adicafp', 
				'tipoahorrovol', 
				'ahorrovol', 
				'tipocotapv', 
				'cotapv', 
				'idisapre', 
				'valorpactado',
				'idnacionalidad',
				/*'COALESCE((select sum(monto) as monto from rem_bonos_personal where idpersonal = p.id and fijo = 1 and imponible = 1),0) as bonos_fijos',*/
				'0 as bonos_fijos',
				//'DATEDIFF(YY,fecafc,getdate()) as annos_afc',
				'format(fecafc,\'dd/MM/yyyy\',\'en-US\') as fecafc',
				'DATEDIFF(MM,fecinicvacaciones,getdate()) as meses_vac',
				'format(fecinicvacaciones,\'dd/MM/yyyy\',\'en-US\') as fecinicvacaciones',
				'saldoinicvacaciones',
				'diasvactomados',
				'diasprogresivos',
				'diasprogtomados',
				'saldoinicvacprog',
				'idcentrocosto',
				'tallapolera',
				'tallapantalon',
				'titulo',
				'idlicencia',
				'idestudio',
				'instapv',
				'nrocontratoapv',
				'jubilado',
				'sindicato',
				'rol_privado',
				'id_lugar_pago',
				'id_categoria',
				'semana_corrida',
				'tiporenta',
				'ididioma',
				'numficha',
				'format(fecafp,\'dd/MM/yyyy\',\'en-US\') as fecafp',
				'idbanco',
				'id_forma_pago',
				'nrocuentabanco',
				'tipodocumento',
				'cbeneficio',
				'format(fecha_retiro,\'dd/MM/yyyy\',\'en-US\') as fecha_retiro',
				'format(fecha_finiquito,\'dd/MM/yyyy\',\'en-US\') as fecha_finiquito',
				'id_motivo_egreso',
				'id_tipocc',
				'id_seccion',
				'id_situacion',
				'id_clase',
				'id_ine',
				'id_zona',
				'format(fecrealcontrato,\'dd/MM/yyyy\',\'en-US\') as fecrealcontrato',
				'format(primervenc,\'dd/MM/yyyy\',\'en-US\') as primervenc',
				'fun',
				'format(fecvencplan,\'dd/MM/yyyy\',\'en-US\') as fecvencplan',
				'format(fecapvc,\'dd/MM/yyyy\',\'en-US\') as fecapvc',
				'format(fectermsubsidio,\'dd/MM/yyyy\',\'en-US\') as fectermsubsidio',
				'concat(cast(rut_pago as varchar),\'-\',dv_pago) as rut_pago', 
				'dv_pago', 
				'nombre_pago',
				'email_pago',
				'usuario_windows',
				'idjefe',
				'idreemplazo',
				'formapagoapv',
				'regimenapv',
				'trabajo_pesado',
				'format(plazo_contrato,\'dd/MM/yyyy\',\'en-US\') as plazo_contrato',
				'id_plantilla_banco',
				'id_tipo_cuenta_bancaria',
				'anticipo_permanente',
				'anticipo'
				

				

			);
		
		$personal_data = $this->db->select($array_campos)
						  ->from('rem_personal p')
						  ->where('p.id_empresa',$this->session->userdata('empresaid'))
						  //->where('p.active is not null')
						  ->where('p.active',1)
						 // ->where_in('idcentrocosto',$centro_costo)
		                  ->order_by('p.nombre');
		$personal_data = is_null($rut) ? $personal_data : $personal_data->where('p.rut',$rut);
		$personal_data = is_null($idtrabajador) ? $personal_data : $personal_data->where('p.id_personal',$idtrabajador);
		//$personal_data = !$centro_costo  ? $personal_data : $personal_data->where_in('idcentrocosto',$centro_costo);

		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		$datos =  $query->result();
		return $datos;
	}

	public function get_personal($idtrabajador = null,$centro_costo =false){


		$array_campos = array(
				'id_personal', 
				'id_empresa', 
				'rut', 
				'dv', 
				'nombre', 
				'apaterno', 
				'amaterno', 
				'fecnacimiento', 
				'sexo', 
				"case when sexo = 'F' then 'Femenino' 
					  when sexo = 'M' then 'Masculino'
					  else 'S/I'
				end as sexo_traducido",
				'idecivil', 
				'nacionalidad', 
				'direccion', 
				'idregion', 
				'idcomuna', 
				'fono', 
				'email', 
				'fecingreso', 
				'fecingreso as fecingreso_sformat',
				'idcargo', 
				'tipocontrato', 
				'parttime', 
				'segcesantia', 
				'pensionado', 
				'diastrabajo', 
				'horasdiarias', 
				'horassemanales', 
				'sueldobase', 
				'tipogratificacion', 
				'gratificacion', 
				'asigfamiliar', 
				'cargassimples', 
				'cargasinvalidas', 
				'cargasmaternales', 
				'cargasretroactivas', 
				'idasigfamiliar',
				'movilizacion', 
				'colacion', 
				'idafp', 
				'adicafp', 
				'tipoahorrovol', 
				'ahorrovol', 
				'tipocotapv', 
				'cotapv', 
				'idisapre', 
				'valorpactado',
				"COALESCE((select sum(per.monto) as monto from rem_bonos_personal per
							inner join rem_conf_haber_descuento h on per.idconf = h.id
 							where per.valido = 1 and per.idpersonal = p.id_personal and h.tipo = 'HABER' and h.fijo = 1 and h.imponible = 1),0) as bonos_fijos",
				'DATEDIFF(YY,fecafc,getdate()) as annos_afc',
				'DATEDIFF(MM,fecinicvacaciones,getdate()) as meses_vac',
				'fecinicvacaciones',
				'saldoinicvacaciones',
				'diasvactomados',
				'diasprogresivos',
				'diasprogtomados',
				'saldoinicvacprog',
				'idcentrocosto',
				'semana_corrida',
				 "case when fecnacimiento is null then 'S/I' else (((365* year(getdate()))-(365*(year(fecnacimiento))))+ (month(getdate())-month(fecnacimiento))*30
				+(day(getdate()) -  day(fecnacimiento)))/365 end as edad"
			);
		
		//var_dump_new($array_campos); exit;
		$personal_data = $this->db->select($array_campos)
						  ->from('rem_personal p')
						  ->where('p.id_empresa',$this->session->userdata('empresaid'))
						  ->where('p.active = 1')
						 // ->where_in('idcentrocosto',$centro_costo)
		                  ->order_by('p.nombre');
		$personal_data = is_null($idtrabajador) ? $personal_data : $personal_data->where('p.id_personal',$idtrabajador);
		$personal_data = !$centro_costo  ? $personal_data : $personal_data->where_in('idcentrocosto',$centro_costo);

		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		$datos = is_null($idtrabajador) ? $query->result() : $query->row();
		return $datos;
	}
	
	public function get_personal_paso($idtrabajador = null,$centro_costo =false){


		$array_campos = array(
				'id_personal', 
				'id_empresa', 
				'rut', 
				'dv', 
				'nombre', 
				'apaterno', 
				'amaterno', 
				'fecnacimiento', 
				'sexo', 
				'idecivil', 
				'nacionalidad', 
				'direccion', 
				'idregion', 
				'idcomuna', 
				'fono', 
				'email', 
				'fecingreso', 
				'fecingreso as fecingreso_sformat',
				'idcargo', 
				'tipocontrato', 
				'parttime', 
				'segcesantia', 
				'pensionado', 
				'diastrabajo', 
				'horasdiarias', 
				'horassemanales', 
				'sueldobase', 
				'tipogratificacion', 
				'gratificacion', 
				'asigfamiliar', 
				'cargassimples', 
				'cargasinvalidas', 
				'cargasmaternales', 
				'cargasretroactivas', 
				'idasigfamiliar',
				'movilizacion', 
				'colacion', 
				'idafp', 
				'adicafp', 
				'tipoahorrovol', 
				'ahorrovol', 
				'tipocotapv', 
				'cotapv', 
				'idisapre', 
				'valorpactado',
				'COALESCE((select sum(p.monto) as monto from rem_bonos_personal p
							inner join rem_conf_haber_descuento h on p.idconf = h.id
 							where p.idpersonal = p.id and h.tipo = "HABER" and h.fijo = 1 and h.imponible = 1),0) as bonos_fijos',				
				'0 as bonos_fijos',
				'DATEDIFF(YY,fecafc,getdate()) as annos_afc,
				DATEDIFF(MM,fecinicvacaciones,getdate()) as meses_vac,
				fecinicvacaciones,
				saldoinicvacaciones,
				diasvactomados,
				diasprogresivos,
				diasprogtomados,
				saldoinicvacprog,
				idcentrocosto'
			);
		
		$personal_data = $this->db->select($array_campos)
						  ->from('rem_personal p')
						  ->where('p.id_empresa',$this->session->userdata('empresaid'))
						  ->where('p.active = 1')
						 // ->where_in('idcentrocosto',$centro_costo)
		                  ->order_by('p.nombre');
		$personal_data = is_null($idtrabajador) ? $personal_data : $personal_data->where('p.id',$idtrabajador);
		$personal_data = !$centro_costo  ? $personal_data : $personal_data->where_in('idcentrocosto',$centro_costo);

		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		$datos = is_null($idtrabajador) ? $query->result() : $query->row();
		return $datos;
	}	


	public function set_datos_iniciales_periodo_rem($mes,$anno,$centro_costo){

		$this->db->trans_start();
				// evaluar si existe periodo
		$this->db->select('p.id_periodo')
						  ->from('rem_periodo as p')
		                  ->where('p.mes', $mes)
		                  ->where('p.anno', $anno);
		$query = $this->db->get();
		$datos_periodo = $query->row();
		$idperiodo = 0;
		if($query->num_rows() == 0){ // si no existe periodo, se crea
				$data = array(
			      	'mes' => $mes,
			      	'anno' =>  $anno
				);
				$this->db->insert('rem_periodo', $data);
				$idperiodo = $this->db->insert_id();
		}else{
				$idperiodo = $datos_periodo->id_periodo;
		}


		// evaluar si existe periodo remuneraciones
		$this->db->select('r.id_periodo')
						  ->from('rem_periodo_remuneracion as r')
		                  ->where('r.id_periodo', $idperiodo)
		                  ->where('id_centro_costo',$centro_costo)
		                  ->where('r.id_empresa', $this->session->userdata('empresaid'));
		$query = $this->db->get();
		$datos_periodo_remuneracion = $query->row();
		if($query->num_rows() == 0){ // si no existe periodo, se crea
				$data = array(
			      	'id_periodo' => $idperiodo,
			      	'id_empresa' => $this->session->userdata('empresaid'),
			      	'id_centro_costo' => $centro_costo
				);
				$this->db->insert('rem_periodo_remuneracion', $data);
				//echo $this->db->last_query();
		}


		##CUALQUIER DATO CARGADO LO BORRA
		/*$this->db->where('id_empresa', $this->session->userdata('empresaid'));
		$this->db->where('idperiodo', $idperiodo);
		$this->db->delete('rem_remuneracion');*/


		$personal = $this->get_personal(null,$centro_costo); 
		foreach ($personal as $trabajador) {

			$this->db->select('r.id_periodo')
							  ->from('rem_remuneracion as r')
			                  ->where('r.idpersonal', $trabajador->id_personal)
			                  ->where('r.id_periodo', $idperiodo)
			                  ->where('r.id_empresa', $this->session->userdata('empresaid'));
			$query = $this->db->get();
			$datos_remuneracion = $query->row();
			if($query->num_rows() == 0){ // si no existe periodo, se crea

					$datos_licencia = $this->rrhh_model->get_licencia_medica($trabajador->id_personal); 
			        $dias_licencia = 0;
			        foreach ($datos_licencia as $licencia) {
			           $dias_licencia = $dias_licencia + dias_mes_rango(substr($licencia->fec_inicio_reposo,0,10),substr($licencia->fin_reposo,0,10),$anno.str_pad($mes,2,"0",STR_PAD_LEFT));

			        }
			        $dias_trabajo = 30 - $dias_licencia;				

					$data = array(
				      	'idpersonal' => $trabajador->id_personal,
				      	'id_periodo' => $idperiodo,
				      	'id_empresa' => $this->session->userdata('empresaid'),
				      	'idcentrocosto' => $trabajador->idcentrocosto,
				      	'diastrabajo' => $dias_trabajo,
				      	'created_at' => date("Y-m-d H:i:s")

					);
					$this->db->insert('rem_remuneracion', $data);
					//echo $this->db->last_query(); exit;
			}/*else{
					$data = array(
				      	'diastrabajo' => $info_trabajador
					);				
					$this->db->where('idpersonal', $idtrabajador);
					$this->db->where('idperiodo', $idperiodo);
					$this->db->update('gc_remuneracion',$data); 

			}*/
		}

		$this->db->trans_complete();
		return $idperiodo;
	}


	public function get_periodos($empresaid,$idperiodo = null,$idcentrocosto = null){
		$sql_centro_costo = is_null($idcentrocosto) ? '' : "and pe.idcentrocosto = " . $idcentrocosto;

		$periodo_data = $this->db->select('p.id_periodo, p.periodo, p.mes, p.anno, pr.anticipo, max(pr.cierre) as cierre, pr.aprueba, (select count(*) from rem_remuneracion r inner join rem_personal pe on r.idpersonal = pe.id_personal where r.id_periodo = p.id_periodo and pe.id_empresa = ' . $empresaid . ' ' . $sql_centro_costo .' and r.active = 1) as numtrabajadores, (select sum(sueldoimponible) from rem_remuneracion r inner join rem_personal pe on r.idpersonal = pe.id_personal where r.id_periodo = p.id_periodo and pe.id_empresa = ' . $empresaid . ' ' . $sql_centro_costo .' and r.active = 1) as sueldoimponible ', false)
						  ->from('rem_periodo as p')
						  ->join('rem_periodo_remuneracion as pr','p.id_periodo = pr.id_periodo')
		                  ->where('pr.id_empresa', $empresaid)
		                  ->group_by('p.id_periodo, p.periodo, p.mes, p.anno, pr.anticipo, pr.aprueba, p.updated_at')
		                  ->order_by('p.updated_at desc');
		$comunidades_data = is_null($idperiodo) ? $periodo_data : $periodo_data->where('pr.id_periodo',$idperiodo);
		$comunidades_data = is_null($idcentrocosto) ? $periodo_data : $periodo_data->where('pr.id_centro_costo',$idcentrocosto);
		$query = $this->db->get();
		$datos = is_null($idperiodo) ? $query->result() : $query->row();	
		//echo $this->db->last_query(); exit;			                  
		return $datos;

	}	


	public function aprobar_remuneracion($idperiodo){

		$this->db->where('id_periodo', $idperiodo);
		//$this->db->where('id_centro_costo', $centro_costo);
		$this->db->where('id_empresa', $this->session->userdata('empresaid'));
		$this->db->update('rem_periodo_remuneracion',array('aprueba' => date("Ymd H:i:s"))); 
		return 1;
	}

	public function selector($select){

		$this->db->where('id_empresa', $select);
		return $select();
	}



	public function get_remuneraciones_reversa($idperiodo,$centro_costo){
		$periodo_data = $this->db->select('r.id_remuneracion')
						  ->from('rem_remuneracion as r')
						  ->join('rem_periodo_remuneracion as pr','r.id_periodo = pr.id_periodo and pr.id_empresa = ' . $this->session->userdata('empresaid'))
		                  ->where('r.id_empresa', $this->session->userdata('empresaid'))
		                  ->where('r.id_periodo', $idperiodo)
		                  ->where('r.idcentrocosto',$centro_costo)
		                  ->where('pr.cierre is not null')
		                  ->where('pr.aprueba is null')
		                  ->order_by('r.id_remuneracion asc');
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		return $query->result();


	}


	public function rechazar_remuneracion($idperiodo,$centro_costo){


		$this->db->trans_start();
		#obtengo remuneraciones del periodo para la comunidad (me aseguro que sea un periodo ya calculado y no aprobado)
		$remuneraciones = $this->get_remuneraciones_reversa($idperiodo,$centro_costo);

		//echo "<pre>";
		if(count($remuneraciones) > 0){
		//if(count($remuneraciones) > 0){ // SÓLO REALIZA REVERSA EN CASO DE QUE EL PERÍODO CORRESPONDA

			foreach ($remuneraciones as $remuneracion) {
				#elimino los bonos cargados a la remuneracion
				$this->db->delete('rem_bonos_remuneracion', array('idremuneracion' => $remuneracion->id_remuneracion)); 

				$this->db->delete('rem_haber_descuento_remuneracion', array('idremuneracion' => $remuneracion->id_remuneracion)); 

				#devuelvo los valores de las cargas retroactivas
				$this->db->query("update p
								  set 
								  p.asigfamiliar = r.montocargaretroactiva,
								  p.cargasretroactivas = r.cargasretroactivas
								  from	rem_personal p
								  inner join rem_remuneracion r on p.id_personal = r.idpersonal
								  where r.id_remuneracion = " . $remuneracion->id_remuneracion);		



			}

			#quitamos la marca de remuneracion calculada (permite volver a calcular)
			$this->db->where('id_periodo', $idperiodo);
			$this->db->where('id_empresa', $this->session->userdata('empresaid'));
			$this->db->where('id_centro_costo', $centro_costo);
			$this->db->update('rem_periodo_remuneracion',array('cierre' => null)); 
		}


		$this->db->trans_complete();

		return 1;
	}	

	public function update_caja_mutual($array_datos){


		$this->db->where('id_empresa', $this->session->userdata('empresaid'));
		$this->db->update('rem_empresa',$array_datos); 
		return 1;
	}	


	public function get_haberes_descuentos($idtrabajador,$imponible = null,$tipo = null,$idperiodo = null){

			if(!is_null($imponible)){
					$campo_imponible = $imponible == true ? 1 : 0;	
			}		
		

			//OBTIENE LOS HABERES DEL TRABAJADOR
			/*$haberes_data = $this->db->select('d.monto, h.imponible, h.nombre')
							  ->from('rem_haber_descuento_personal_tmp d')
							  ->join('rem_conf_haber_descuento as h','d.idconfhd = h.id')
			                  ->where('d.id_personal',$idtrabajador);*/
			
			$haberes_data = $this->db->select('d.monto, h.imponible, h.nombre, d.idperiodo, h.formacalculo, h.tributable, h.semanacorrida, h.fijo, h.proporcional')
							  ->from('rem_bonos_personal d')
							  ->join('rem_conf_haber_descuento as h','d.idconf = h.id')
							  ->join('rem_personal as p','d.idpersonal = p.id_personal')
			                  ->where('d.idpersonal',$idtrabajador)
			                  ->where('d.valido',1)
			                  ->where('p.id_empresa',$this->session->userdata('empresaid'));

			$haberes_data = is_null($imponible) ? $haberes_data : $haberes_data->where('h.imponible',$campo_imponible);  	
			$haberes_data = is_null($tipo) ? $haberes_data : $haberes_data->where('h.tipo',$tipo);  	
			$haberes_data = is_null($idperiodo) ? $haberes_data : $haberes_data->where('d.idperiodo',$idperiodo);  
			$query = $this->db->get();
			//echo $this->db->last_query(); exit;
			return $query->result();		
	}


	public function get_haberes_descuentos_totales_validos($idhaber = null,$idperiodo = null){

			$haberes_desctos_data = $this->db->select('bp.id, hd.codigo, hd.tipo, bp.idpersonal, p.rut, p.dv, p.nombre as nombre_colaborador, p.apaterno, p.amaterno,  hd.nombre , bp.monto, pe.periodo')
							  ->from('rem_bonos_personal bp')
							  ->join('rem_personal as p','bp.idpersonal = p.id_personal')
							  ->join('rem_periodo as pe','bp.idperiodo = pe.id_periodo')
							  ->join('rem_conf_haber_descuento as hd','bp.idconf = hd.id')
							  ->join('rem_periodo_remuneracion as pr','bp.idperiodo = pr.id_periodo and p.idcentrocosto = pr.id_centro_costo','LEFT')
			                  ->where('p.id_empresa',$this->session->userdata('empresaid'))
			                  //->where('(pr.aprueba is null or hd.fijo = 1)')
			                  ->where('pr.aprueba is null')
			                  //->where('pr.id_periodo is not null')
			                  ->where('bp.valido',1)
			                  ->order_by('pe.periodo','desc')
			                  ->order_by('p.apaterno','asc')
			                  ->order_by('p.amaterno','asc')
			                  ->order_by('p.nombre','asc');

			$haberes_data = is_null($idhaber) ? $haberes_desctos_data : $haberes_desctos_data->where('bp.idconf',$idhaber);
			$haberes_data = is_null($idperiodo) ? $haberes_desctos_data : $haberes_desctos_data->where('bp.idperiodo',$idperiodo);
			$query = $this->db->get();

			
			//echo $this->db->last_query(); exit;
			return $query->result();		
	}	


	public function get_bonos_by_remuneracion($idremuneracion,$imponible = null,$tipo = null){

		if(!is_null($imponible)){
			$campo_imponible = $imponible == true ? 1 : 0;	
		}
		
		$bonos_data = $this->db->select('id, descripcion, imponible, monto')
						  ->from('rem_haber_descuento_remuneracion')
						  ->where('idremuneracion',$idremuneracion)
		                  ->order_by('id');

		$bonos_data = is_null($imponible) ? $bonos_data : $bonos_data->where('imponible',$campo_imponible); 
		$bonos_data = is_null($tipo) ? $bonos_data : $bonos_data->where('tipo',$tipo);  			 		                  
		$query = $this->db->get();
		return $query->result();
	}	


	public function dias_habiles($idperiodo){

		$periodo =  $this->get_periodos($this->session->userdata('empresaid'),$idperiodo);
		//var_dump_new($periodo); exit;

		$periodo_number = $periodo->periodo;
		//var_dump_new($periodo_number); exit;

		
		$diashabiles_data = $this->db->select('COUNT(DISTINCT FECHA) AS cantidad',FALSE)
						  ->from('rem_calendario')
						  ->where('periodo',$periodo_number)
						  ->where_in('tipo_dia',array('H','S'));

		$query_diashabiles = $this->db->get();
		$result_diashabiles =  $query_diashabiles->row();

		$dias_habiles = $result_diashabiles->cantidad; 



		
		$diasinhabiles_data = $this->db->select('COUNT(DISTINCT FECHA) AS cantidad',FALSE)
						  ->from('rem_calendario')
						  ->where('periodo',$periodo_number)
						  ->where_in('tipo_dia',array('D','F'));

		$query_diasinhabiles = $this->db->get();
		$result_diasinhabiles =  $query_diasinhabiles->row();

		$dias_inhabiles = $result_diasinhabiles->cantidad; 



		$array_dias = array('dias_habiles' => $dias_habiles,
					   'dias_inhabiles' => $dias_inhabiles);

		return $array_dias;

	}



/*	public function dias_habiles($idperiodo){

		$periodo =  $this->get_periodos($this->session->userdata('empresaid'),$idperiodo);


		$fec_ini = $periodo->anno."-".str_pad($periodo->mes,2,"0",STR_PAD_LEFT)."-01";
		$fec_fin = $periodo->anno."-".str_pad($periodo->mes,2,"0",STR_PAD_LEFT)."-".ultimo_dia_mes($periodo->anno,$periodo->mes);
		$dias_habiles = bussiness_days($fec_ini,$fec_fin,'habil','SUM');  //cantidad de dias habilles del mes
		$dias_inhabiles = bussiness_days($fec_ini,$fec_fin,'domingos','SUM'); // cntidad de domingos del mes

		$dias_feriados = $this->admin->get_cantidad_feriado($fec_ini,$fec_fin);

		var_dump_new($dias_feriados);
		var_dump_new($dias_habiles);
		var_dump_new($dias_inhabiles);

		// habiles, son los lunes a viernes menos feriados
		$dias_habiles = $dias_habiles[$periodo->anno."-".str_pad($periodo->mes,2,"0",STR_PAD_LEFT)] - $dias_feriados->cantidad;

		var_dump_new($dias_habiles);

		// inhabiles, son los domingos mas feriados
		$dias_inhabiles = $dias_inhabiles[$periodo->anno."-".str_pad($periodo->mes,2,"0",STR_PAD_LEFT)] + $dias_feriados->cantidad;

		var_dump_new($dias_inhabiles); exit;

		$array_dias = array('dias_habiles' => $dias_habiles,
					   'dias_inhabiles' => $dias_inhabiles);

		return $array_dias;

	}*/


	public function calcular_remuneraciones($idperiodo,$centro_costo){
		//var_dump_new($centro_costo); exit;
		$this->db->trans_start();

		$periodo =  $this->get_periodos($this->session->userdata('empresaid'),$idperiodo);


		// CALCULAMOS DIAS HÁBILES E INHABILES DEL MES
		$array_dias =  $this->dias_habiles($idperiodo);
		//var_dump_new($array_dias); exit;
		$this->load->model('admin');
		//$periodo = $this->admin->get_periodo_by_id($idperiodo);
	
		$idperiodo_ant = $this->admin->get_periodo_anterior($idperiodo);
		$dias_periodo = $this->admin->get_num_dias_periodo($idperiodo);
		$dias_periodo = $dias_periodo < 30 ? 30 : $dias_periodo;
		
		$empresa = $this->admin->get_empresas($this->session->userdata('empresaid')); 

		$tabla_impuesto = $this->admin->get_tabla_impuesto();
		
		$parametros = array();
		$parametros['uf'] = $this->admin->get_indicadores_by_periodo($idperiodo,'UF');
		$parametros['topeimponible'] = $this->admin->get_indicadores_by_periodo($idperiodo,'Tope Imponible AFP');
		$parametros['topeimponibleips'] = $this->admin->get_indicadores_by_periodo($idperiodo,'Tope Imponible IPS');
		$parametros['topeimponibleafc'] = $this->admin->get_indicadores_by_periodo($idperiodo,'Tope Imponible AFC');
		$parametros['sueldominimo'] = $this->admin->get_indicadores_by_periodo($idperiodo,'Sueldo Minimo');
		$parametros['utm'] = $this->admin->get_indicadores_by_periodo($idperiodo,'UTM');
		$parametros['tasasis'] = $this->admin->get_indicadores_by_periodo($idperiodo,'Tasa SIS');

		//$parametros = $this->admin->get_parametros_generales();
		$monto_total_sueldos = 0;
		$tope_legal_gratificacion = ($parametros['sueldominimo']*4.75)/12;



		$array_pago_afp = array();
		$array_pago_isapre = array();
		$array_descuentos = array();
		$array_prestamos = array();
		$dia_mes =  $periodo->mes == 2 ? 28 : 30;
		$perint = $periodo->periodo;


		$suma_aporte_patronal = 0;
		$suma_asig_familiar = 0;
		$suma_ips = 0;
		$suma_impuesto = 0;
		$tope_imponible = (int)($parametros['uf']*$parametros['topeimponible']);
		$tope_imponible_ips = (int)($parametros['uf']*$parametros['topeimponibleips']);
		$tope_imponible_afc = (int)($parametros['uf']*$parametros['topeimponibleafc']);

		$this->db->query('update r 
							set r.active = 0
							from rem_remuneracion r 
						    inner join rem_personal p on r.idpersonal = p.id_personal
                            where p.id_empresa = ' . $this->session->userdata('empresaid') . ' and r.id_periodo = ' . $idperiodo . '
                            and p.idcentrocosto = ' . $centro_costo);



		$personal = $this->get_personal(null,$centro_costo); 


		foreach ($personal as $trabajador) { // calculo de sueldos por cada trabajador
			//var_dump_new($trabajador); exit;
			$datos_remuneracion = $this->get_datos_remuneracion_by_periodo($idperiodo,$trabajador->id_personal);


			//var_dump_new($datos_remuneracion);// exit;

			$datos_bonos = array();
			//$datos_bonos = $this->get_bonos($trabajador->id); // se modifica esto porque aún no existen bonos
			$bonos_imponibles = 0;
			$bonos_no_imponibles = 0;

			//OBTIENE LOS HABERES DEL TRABAJADOR
			$datos_hd = $this->get_haberes_descuentos($trabajador->id_personal,null,'HABER',$idperiodo);	



            $movimientos = $this->get_lista_movimientos($trabajador->id_personal, null, $idperiodo, 3);

            $dias_licencia = 0;
            foreach ($movimientos as $movimiento) {
                
                $dias = dias_transcurridos($movimiento->fecmovimiento,$movimiento->fechastamovimiento) + 1; // se agrega uno porque se considera el día inicial
                $dias_licencia += $dias;
            }




			$diastrabajo = $trabajador->parttime == 1 ? $trabajador->diastrabajo : 30;

			 


			$dias_trabajados =  $datos_remuneracion->diastrabajo > ($dias_periodo - $dias_licencia) ?  ($dias_periodo - $dias_licencia) : $datos_remuneracion->diastrabajo;
			$dias_trabajados = $dias_trabajados < 0 ? 0 : $dias_trabajados;


			$sueldo_base_mes = round(($trabajador->sueldobase/$diastrabajo)*$dias_trabajados,0);

			/*if($trabajador->id_personal == 20462){
				var_dump_new($datos_remuneracion->diastrabajo);
				var_dump_new($dias_periodo);
				var_dump_new($diastrabajo);
				var_dump_new($dias_trabajados);
				var_dump_new($dias_licencia);
				var_dump_new($sueldo_base_mes);
				var_dump_new($trabajador);
				var_dump_new($datos_remuneracion); exit;
			}*/
			
			$movilizacion_mes = round(($trabajador->movilizacion/$diastrabajo)*$dias_trabajados,0);
			$colacion_mes = round(($trabajador->colacion/$diastrabajo)*$dias_trabajados,0);

			$bonos_no_imponibles_tributables = 0;
			$haberes_semana_corrida = 0;
			foreach ($datos_hd as $bono) {

				$tiene_bono = false;
				if($bono->fijo == 1){ // se suma siempre
					$tiene_bono = true;
				}else{ // validar si corresponde al período

					$tiene_bono = $bono->idperiodo == $idperiodo ? true : false; // el bono corresponde al periodo que estamos calculando.  Entonces si aplica el bono
				}			

				//NO PUEDE SER FIJO Y PROPORCIONAL????
				if($tiene_bono){

					$valor_bono = $bono->proporcional == 1 ? round(($bono->monto/$diastrabajo)*$dias_trabajados,0) : $bono->monto;

					if($bono->imponible == 1){
						$bonos_imponibles += $valor_bono;

					}else{

						$bonos_no_imponibles += $valor_bono;
						$bonos_no_imponibles_tributables += $bono->tributable == 1 ? $valor_bono : 0;
					}			

					if($bono->semanacorrida == 1){
						$haberes_semana_corrida += $valor_bono;

					}

					$data_bono = array(
								'idremuneracion' => $datos_remuneracion->id_remuneracion,
								'descripcion' => $bono->nombre,
								'imponible' => $bono->imponible,
								'monto' => $valor_bono,
								'tipo' => 'HABER'
								);
					$this->db->insert('rem_haber_descuento_remuneracion', $data_bono);
				}
			}			


			$monto_semana_corrida = 0;
			//CALCULO SEMANA CORRIDA
			if($trabajador->semana_corrida == 'SI'){
				$monto_semana_corrida = round(($haberes_semana_corrida/$array_dias['dias_habiles'])*$array_dias['dias_inhabiles'],0);
			}	



			$datos_afp = $this->admin->get_afp($trabajador->idafp);
			//var_dump_new($datos_afp); exit;


			//$valor_hora = $trabajador->parttime == 1 ? ((($trabajador->sueldobase + $trabajador->bonos_fijos)/$trabajador->diastrabajo)/$trabajador->horasdiarias) : ((($trabajador->sueldobase + $trabajador->bonos_fijos)/30)*7)/45;
			$valor_hora = $trabajador->parttime == 1 ? ((($trabajador->sueldobase)/$trabajador->diastrabajo)/$trabajador->horasdiarias) : ((($trabajador->sueldobase)/30)*7)/$trabajador->horassemanales;
			$valor_hora = round($valor_hora,0);
			//calculo total haberes
			$valor_hora50 =  round($valor_hora*1.5,0);
			$valor_hora100 = round($valor_hora*2,0);


			$monto_horas50 = round($datos_remuneracion->horasextras50*$valor_hora50,0);
			$monto_horas100 = round($datos_remuneracion->horasextras100*$valor_hora100,0);





			$porc_com_afp = $datos_afp->porc > 0 ? $datos_afp->porc - 10 : 0;
			$porc_cot_oblig = $datos_afp->exregimen == 2 ? 0 : 0.1;
			

			//$gratificacion = $trabajador->sueldobase*0.25;


			//Calculo asignación familiar
			$num_cargas_simples = $trabajador->cargassimples;
			$num_cargas_maternales = $trabajador->cargasmaternales;

			$num_cargas = $num_cargas_simples + $num_cargas_maternales;
			$monto_ingresos = $trabajador->sueldobase + $trabajador->bonos_fijos;

			$asig_familiar = $trabajador->asigfamiliar; //Monto cargas retroactivas




			if(!is_null($trabajador->idasigfamiliar) && $trabajador->idasigfamiliar != 0){ //BUSCA MONTO DE ASIGNACION FAMILIAR EN BASE A TRAMO SELECCIONADO




				$tramo_asig_familiar = $this->admin->get_tabla_asig_familiar($trabajador->idasigfamiliar);
				$letra_tramo_asig_familiar = $tramo_asig_familiar->tramo;


				$array_asig_familiar_periodo = $this->admin->get_tabla_asig_familiar_periodo($perint,$letra_tramo_asig_familiar);

				$asig_familiar_periodo = $array_asig_familiar_periodo[0];
				$asig_familiar += $asig_familiar_periodo->monto*$num_cargas;

				$dias_calculo_asig = $dias_trabajados + $dias_licencia;

				//https://www.dt.gob.cl/portal/1628/w3-article-95276.html
				if($dias_calculo_asig < 25){
						$asig_familiar = round(($asig_familiar/30)*$dias_calculo_asig,0);

				}


			}


			/*$tramo_asig_familiar = $this->get_tabla_asig_familiar($trabajador->idasigfamiliar);
			foreach ($tabla_asig_familiar as $rango_asig_familiar) {

				if($monto_ingresos >= $rango_asig_familiar->desde && $monto_ingresos <= $rango_asig_familiar->hasta){
					
					$asig_familiar += $rango_asig_familiar->monto*$num_cargas;

					break;
				}
			}*/

			$suma_asig_familiar += $asig_familiar;


			#AGUINALDO INGRESADO EN LÍQUIDO.  SE NECESITA ALMACENAR EL BRUTO
			$aguinaldo_bruto = round($datos_remuneracion->aguinaldo*1.25,0);


			$gratificacion = 0;
			if($trabajador->tipogratificacion == 'SG'){
				$gratificacion = 0;
			}else if($trabajador->tipogratificacion == 'MF'){
				$gratificacion = $trabajador->gratificacion;
			}else if($trabajador->tipogratificacion == 'TL'){
				$monto_calculo_gratificacion = $sueldo_base_mes +  $bonos_imponibles + $monto_semana_corrida + $monto_horas50 + $monto_horas100;
				//$gratificacion_esperada = round($sueldo_base_mes/4,0);

				$gratificacion_esperada = round($monto_calculo_gratificacion/4,0);


				$gratificacion = $gratificacion_esperada > $tope_legal_gratificacion ? $tope_legal_gratificacion : $gratificacion_esperada;
			}


			$total_haberes = $sueldo_base_mes + $gratificacion + $movilizacion_mes + $colacion_mes + $bonos_imponibles + $bonos_no_imponibles + $monto_horas50 + $monto_horas100 + $aguinaldo_bruto + $asig_familiar + $monto_semana_corrida;
			$sueldo_imponible = $sueldo_base_mes + $gratificacion + $bonos_imponibles + $monto_horas50 + $monto_horas100 + $aguinaldo_bruto + $monto_semana_corrida;

			$sueldo_no_imponible = $total_haberes - $sueldo_imponible;



			#CALCULA SUELDO SOBRE EL CUAL SE CALCULARÁN LAS IMPOSICIONES, CONSIDERANDO EL TOPE LEGAL
			$sueldo_imponible_imposiciones = $sueldo_imponible > $tope_imponible ? $tope_imponible : $sueldo_imponible;
			$sueldo_imponible_afc = $sueldo_imponible > $tope_imponible_afc ? $tope_imponible_afc : $sueldo_imponible;
			$sueldo_imponible_ips = $sueldo_imponible > $tope_imponible_ips ? $tope_imponible_ips : $sueldo_imponible;


			$sueldo_imponible_afp = $datos_afp->exregimen == 1 ? $sueldo_imponible_ips : $sueldo_imponible_imposiciones;

			$cot_obligatoria = round($sueldo_imponible_afp*$porc_cot_oblig,0);
			$comision_afp = round($sueldo_imponible_afp*($porc_com_afp/100),0);
			$adic_afp = round($sueldo_imponible*($trabajador->adicafp/100),0);


			// SOLO SE PAGA POR 11 AÑOS


			if($trabajador->pensionado == 1){
				$segcesantia = 0;
			}else{
				$segcesantia = $trabajador->tipocontrato == 'I' && $trabajador->segcesantia == 1 && $trabajador->annos_afc <= 11 ? round($sueldo_imponible_afc*0.006,0) : 0;
			}
			//echo $segcesantia; exit;
			$cot_salud_oblig = $trabajador->idisapre != 1 ? round($sueldo_imponible_imposiciones*0.07,0) : 0;

			if($trabajador->idisapre == 1){ //FONASA
				$salud_total = round($sueldo_imponible_imposiciones*0.07,0);
				//$cot_fonasa = $trabajador->idisapre == 1 ? round($sueldo_imponible_imposiciones*0.064,0) : 0;
				//$cot_inp = $trabajador->idisapre == 1 ? round($sueldo_imponible_imposiciones*0.006,0) : 0;		

				//$cot_fonasa = $trabajador->idisapre == 1 ? round($sueldo_imponible_imposiciones*0.039,0) : 0;
				//$cot_inp = $trabajador->idisapre == 1 ? round($sueldo_imponible_imposiciones*0.031,0) : 0;		

                $cot_fonasa = $trabajador->idisapre == 1 ? round($sueldo_imponible_imposiciones * PORCT_FONASA, 0) : 0;
                $cot_inp = $trabajador->idisapre == 1 ? round($sueldo_imponible_imposiciones * PORCT_INP, 0) : 0;					

				$dif_salud = $salud_total - ($cot_fonasa + $cot_inp);
				$cot_fonasa += $dif_salud; 

			}else{
				$cot_fonasa = 0;
				$cot_inp = 0;
			}




			if($trabajador->idisapre == 1){
				$adic_isapre = 0;
				$cot_adic_isapre = 0; // tributable
				$adic_salud = 0;					
			}else{
				//$dif_isapre = round($trabajador->valorpactado*$parametros->uf,0) - $cot_salud_oblig;
				$dif_isapre = $dias_trabajados > 0 ? (round($trabajador->valorpactado * $parametros['uf'], 0) - $cot_salud_oblig) : 0;
				//echo $trabajador->valorpactado; exit;
				$adic_isapre = $dif_isapre > 0 ? $dif_isapre : 0;

				if($adic_isapre > 0){
					$tope_salud_tributable = round(($parametros['topeimponible']*0.07)*$parametros['uf'],0);
					$sobre_tope = ($cot_salud_oblig + $adic_isapre) - $tope_salud_tributable;
					if($sobre_tope > 0){ // nos pasamos del tope
						$cot_adic_isapre = $adic_isapre - $sobre_tope; // tributable
						$adic_salud = $sobre_tope;
					}else{
						$cot_adic_isapre = 0; // tributable
						$adic_salud = $adic_isapre;
					}

				}else{
						$cot_adic_isapre = 0; // tributable
						$adic_salud = 0;					
				}
			}

			$ahorrovol = 0;
			if($trabajador->tipoahorrovol == 'pesos'){
				$ahorrovol = $trabajador->ahorrovol;	
			}else if($trabajador->tipoahorrovol == 'porcentaje'){

				// REVISAR TOPE
				$ahorrovol = round($sueldo_imponible*($trabajador->ahorrovol/100),0);	
			}

			$cotapv = 0;
			//echo $trabajador->cotapv." - ". $parametros->uf . " -  ". $trabajador->tipocotapv."<br>";
			//print_r($parametros);
			//echo $parametros->uf; exit;
			if($trabajador->tipocotapv == 'pesos'){
				$cotapv = $trabajador->cotapv;	
			}else if($trabajador->tipocotapv == 'porcentaje'){
				//REVISAR TOPE
				$cotapv = round($sueldo_imponible*($trabajador->cotapv/100),0);	
			}else if($trabajador->tipocotapv == 'uf'){
				$cotapv = round($trabajador->cotapv*$parametros['uf'],0);
			}


			$descuentos = round($valor_hora*$datos_remuneracion->horasdescuento,0);


			
			//MONTO SEMANA CORRIDA ESTÁ CONSIDERADO DENTRO DE SUELDO IMPONIBLE
			$base_tributaria = $sueldo_imponible + $bonos_no_imponibles_tributables - $cot_obligatoria - $comision_afp - $adic_afp - $segcesantia - $cot_salud_oblig - $cot_adic_isapre - $adic_salud - $cot_fonasa - $cot_inp;

			$impuesto = 0;
			foreach ($tabla_impuesto as $rango) {
				//echo $base_tributaria." - ".$rango->desde." - ".$rango->hasta." - ".$rebaja."<br>";
				$desde = $rango->desde*$parametros['utm'];
				$hasta = $rango->hasta*$parametros['utm'];
				$rebaja = $rango->rebaja*$parametros['utm'];


				$rango_desde = round(($desde/$diastrabajo)*$dias_trabajados,0);
				$rango_hasta = round(($hasta/$diastrabajo)*$dias_trabajados,0);
				$rango_rebaja = round(($rebaja/$diastrabajo)*$dias_trabajados,0);
				//if($base_tributaria >= $rango->desde && $base_tributaria <= $rango->hasta){
				//if($base_tributaria >= $rango_desde && $base_tributaria <= $rango_hasta){
				if($base_tributaria >= $desde && $base_tributaria <= $hasta){
					
					/*
			if($trabajador->id_personal == 20379){
				var_dump_new($base_tributaria);
				var_dump_new($rango->factor);
				var_dump_new($rango_rebaja);
				var_dump_new($parametros['utm']);
				var_dump_new($rango_desde);
				var_dump_new($rango_hasta);exit;
			}*/

					//$impuesto = round($base_tributaria*$rango->factor - $rango->rebaja,0);
					//$impuesto = round($base_tributaria*$rango->factor - $rango_rebaja,0);
					$impuesto = round($base_tributaria*$rango->factor - $rebaja,0);

					break;
				}
			}

			//exit;

			$datos_d = $this->get_haberes_descuentos($trabajador->id_personal,null,'DESCUENTO',$idperiodo);			


			//$datos_descuentos = $this->get_descuento($idperiodo,'D',$trabajador->id);
			$datos_descuentos = array();
			$monto_descuento = 0;


			foreach ($datos_d as $info_descuento) {

					$monto_descuento += $info_descuento->monto;
					$data_bono = array(
								'idremuneracion' => $datos_remuneracion->id_remuneracion,
								'descripcion' => $info_descuento->nombre,
								'imponible' => $info_descuento->imponible,
								'monto' => $info_descuento->monto,
								'tipo' => 'DESCUENTO'
								);
					$this->db->insert('rem_haber_descuento_remuneracion', $data_bono);
			}



			foreach ($datos_descuentos as $info_descuento) {
				$monto_descuento += $info_descuento->monto;
				if(!array_key_exists($info_descuento->tipodescuento,$array_descuentos)){
					$array_descuentos[$info_descuento->tipodescuento] = 0;
				}
				$array_descuentos[$info_descuento->tipodescuento] += $info_descuento->monto; // suma montos por tipo de descuento
			}


			//$datos_prestamos = $this->get_descuento($idperiodo,'P',$trabajador->id);
			$datos_prestamos = array();
			$monto_prestamos = 0;
			foreach ($datos_prestamos as $info_prestamos) {
				$monto_prestamos += $info_prestamos->monto;
				if(!array_key_exists($info_prestamos->tipodescuento,$array_prestamos)){
					$array_prestamos[$info_prestamos->tipodescuento] = 0;
				}
				$array_prestamos[$info_prestamos->tipodescuento] += $info_prestamos->monto; // suma montos por tipo de descuento				
			}



			$total_descuentos = $cot_obligatoria + $comision_afp + $adic_afp + $segcesantia + $cot_salud_oblig + $cot_fonasa + $cot_inp + $adic_isapre + $impuesto + $ahorrovol + $cotapv + $datos_remuneracion->anticipo + $descuentos + $monto_descuento + $monto_prestamos + $datos_remuneracion->aguinaldo;
			$total_descuentos_legales = $cot_obligatoria + $comision_afp + $adic_afp + $segcesantia + $cot_salud_oblig + $cot_fonasa + $cot_inp + $adic_isapre + $impuesto + $ahorrovol + $cotapv;
			$total_leyes_sociales = $cot_obligatoria + $comision_afp + $adic_afp + $segcesantia + $cot_salud_oblig + $cot_fonasa + $cot_inp + $adic_isapre + $ahorrovol + $cotapv;
			$otros_descuentos = $total_descuentos - $total_leyes_sociales;			
			$descuentos_no_legales = $total_descuentos - $total_descuentos_legales;		

			$sueldo_liquido = $total_haberes - $total_descuentos;
			$sueldo_liquido = $sueldo_liquido < 0 ? 0 : $sueldo_liquido;

			if($trabajador->pensionado == 1){
				$seginvalidez = 0;
			}else{
				if($dias_trabajados < 30){

					//$sueldo_calculo_sis = $sueldo_base_mes +  $aguinaldo_bruto + $bonos_imponibles + $monto_semana_corrida   + $monto_horas50 + $monto_horas100;
					$sueldo_calculo_sis = $sueldo_base_mes +  $gratificacion + $aguinaldo_bruto + $bonos_imponibles + $monto_semana_corrida   + $monto_horas50 + $monto_horas100;

					
				}else{
					$sueldo_calculo_sis = $sueldo_imponible_imposiciones;
				}

				$sueldo_calculo_sis = $sueldo_calculo_sis > $sueldo_imponible_afp ? $sueldo_imponible_afp : $sueldo_calculo_sis;
				$seginvalidez = round($sueldo_calculo_sis*($parametros['tasasis']/100),0);

			}
			#$seginvalidez = $trabajador->pensionado == 1 ? 0 : round($sueldo_imponible*($parametros->tasasis/100),0);
			#SI TRABAJADOR TIENE LICENCIA MEDIDA, ENTONCES SE CALCULA POR SUELDO IMPONIBLE PROPORCIONAL A DIAS TRABAJADOS
			#Y POR DIAS NO TRABAJADOS, EL PROPORCIONAL AL SUELDO IMPONIBLE ANTEIOR.  SI NO EXISTE, EN BASE AL CONTRATO

			#1.- VERIFICAR SI TIENE LICENCIA EN EL PERÍODO
			$movimientos = $this->get_lista_movimientos($trabajador->id_personal,null,$idperiodo,3);

			//$movimientos = array();
			//$tiene_licencia = count($movimientos) > 0 ? true : false;
			$tiene_licencia = count($movimientos)  > 0 ? true : false;
			//ocupo esta query para sacar el ultimo sueldo imponible, sino tomar suedo base según contrato.
			/*select r.sueldoimponible from gc_remuneracion r
inner join gc_periodo p on r.id_periodo = p.id
where idpersonal = 41 and diastrabajo > 0
order by p.anno desc, p.mes desc
limit 1		*/	
//echo $sueldo_imponible_afc." -- ". $trabajador->tipocontrato; exit;
			$aportesegcesantia = 0;
			if($trabajador->segcesantia == 1){
				if($trabajador->annos_afc <= 11){
					$aportesegcesantia = $trabajador->tipocontrato == 'F' ? round($sueldo_imponible_afc*0.03,0) : round($sueldo_imponible_afc*0.024,0);
				}else{
					$aportesegcesantia = $trabajador->tipocontrato == 'F' ? round($sueldo_imponible_afc*0.002,0) : round($sueldo_imponible_afc*0.008,0);
				}
			}else{
				$aportesegcesantia = 0;	
			}	
			//echo $aportesegcesantia; exit;

			if($tiene_licencia && $dias_trabajados < 30){ // SI TIENE LICENCIA SE DEBE SUMAR AL SEGURO LOS DÍAS NO TRABAJADOS POR EL PROPORCIONAL 

				// veo si tiene sueldo imponible del mes anterior
				$datos_remuneracion_ant = $this->get_datos_remuneracion_by_periodo($idperiodo_ant,$trabajador->id_personal);
				if(!is_null($datos_remuneracion_ant)){

					//$parametros_ant['topeimponibleafc'] = $this->admin->get_indicadores_by_periodo($idperiodo_ant,'Tope Imponible AFC');
					//$parametros_ant['uf'] = $this->admin->get_indicadores_by_periodo($idperiodo_ant,'UF');
					//$parametros_ant['topeimponible'] = $this->admin->get_indicadores_by_periodo($idperiodo_ant,'Tope Imponible AFP');
					//$parametros_ant['tasasis'] = $this->admin->get_indicadores_by_periodo($idperiodo_ant,'Tasa SIS');

					//$tope_imponible_afc_ant = (int)($parametros_ant['uf']*$parametros_ant['topeimponibleafc']);
					//$tope_imponible_ant = (int)($parametros_ant['uf']*$parametros_ant['topeimponible']);

					

					#OBTENEMOS EL SUELDO IMPONIBLE DEL MES ANTERIOR
					$sueldo_imponible_ant = $datos_remuneracion_ant->sueldoimponible;
					
					#CALCULAMOS EL PROPORCIONAL
					$imponibles_no_trabajo = round(($sueldo_imponible_ant/$diastrabajo)*($diastrabajo-$dias_trabajados),0);	

				}else{

					$imponibles_no_trabajo = round((($trabajador->sueldobase + $aguinaldo_bruto + $bonos_imponibles + $gratificacion)/$diastrabajo)*($diastrabajo-$dias_trabajados),0);

				}

				$imponibles_no_trabajo_afc = $imponibles_no_trabajo > $tope_imponible_afc ? $tope_imponible_afc : $imponibles_no_trabajo;
				$imponibles_no_trabajo_sis = $imponibles_no_trabajo > $tope_imponible ? $tope_imponible : $imponibles_no_trabajo;
										

				if($trabajador->segcesantia == 1){
					if($trabajador->annos_afc <= 11){

						$aportesegcesantia += $trabajador->tipocontrato == 'F' ? round($imponibles_no_trabajo_afc*0.03,0) : round($imponibles_no_trabajo_afc*0.024,0);
						
					}else{
						$aportesegcesantia += $trabajador->tipocontrato == 'F' ? round($imponibles_no_trabajo_afc*0.002,0) : round($imponibles_no_trabajo_afc*0.008,0);
					}
				}else{
					$aportesegcesantia = 0;	
				}	

				$seginvalidez += round($imponibles_no_trabajo_sis*($parametros['tasasis']/100),0);

			}

							

			//$aportepatronal = is_null($empresa->idmutual) ? 0 : round($sueldo_imponible_afp*($empresa->porcmutual/100),0);
			$aportepatronal = round($sueldo_imponible_afp*($empresa->porcmutual/100),0);
			$suma_aporte_patronal += $aportepatronal;
			$suma_impuesto += $impuesto;

			$data_remuneracion = array(
					'ufperiodo' => $parametros['uf'],
					'sueldobase' => $sueldo_base_mes,
					'diastrabajo' => $dias_trabajados,
					'valorhora' => $valor_hora,
					'montodescuento' => $descuentos,
					'tipogratificacion' => $trabajador->tipogratificacion,
					'gratificacion' => $gratificacion,
					'movilizacion' => $movilizacion_mes,
					'colacion' => $colacion_mes,
					'bonosimponibles' => $bonos_imponibles,
					'bonosnoimponibles' => $bonos_no_imponibles,
					'valorhorasextras50' => $valor_hora50,
					'montohorasextras50' => $monto_horas50,
					'valorhorasextras100' => $valor_hora100,
					'montohorasextras100' => $monto_horas100,
					'aguinaldobruto' => $aguinaldo_bruto,
					'cargasretroactivas' => $trabajador->cargasretroactivas,
					'montocargaretroactiva' => $trabajador->asigfamiliar,
					'asigfamiliar' => $asig_familiar,
					'totalhaberes' => $total_haberes,
					'semana_corrida' => $monto_semana_corrida,
					'sueldoimponible' => $sueldo_imponible,
					'sueldonoimponible' => $sueldo_no_imponible,
					'sueldoimponibleimposiciones' => $sueldo_imponible_imposiciones,
					'sueldoimponibleafc' => $sueldo_imponible_afc,
					'sueldoimponibleips' => $sueldo_imponible_ips,
					'cotizacionobligatoria' => $cot_obligatoria,
					'comisionafp' => $comision_afp,
					'porccomafp' => $porc_com_afp,
					'porcadicafp' => $trabajador->adicafp,					
					'adicafp' => $adic_afp,
					'segcesantia' => $segcesantia,					
					'cotizacionsalud' => $cot_salud_oblig,
					'fonasa' => $cot_fonasa,
					'inp' => $cot_inp,
					'valorpactado' => $trabajador->valorpactado,
					'adicisapre' => $adic_isapre,
					'cotadicisapre' => $cot_adic_isapre,
					'adicsalud' => $adic_salud,
					'basetributaria' => $base_tributaria,				
					'impuesto' => $impuesto,
					'tipoahorrovol' => $trabajador->tipoahorrovol,
					'ahorrovol' => $trabajador->ahorrovol,
					'montoahorrovol' => $ahorrovol,
					'tipocotapv' => $trabajador->tipocotapv,					
					'cotapv' => $trabajador->cotapv,					
					'montocotapv' => $cotapv,					
					'descuentos' => $monto_descuento,	
					'prestamos' => $monto_prestamos,
					'totalleyessociales' => $total_leyes_sociales,
					'otrosdescuentos' => $otros_descuentos,
					'totaldescuentoslegales' => $total_descuentos_legales,
					'descuentosnolegales' => $descuentos_no_legales,
					'totaldescuentos' => $total_descuentos,
					'sueldoliquido' => $sueldo_liquido,
					'seginvalidez' => $seginvalidez,
					'aportesegcesantia' => $aportesegcesantia,
					'aportepatronal' => $aportepatronal,
					'idcentrocosto' => $trabajador->idcentrocosto,
					'pdf_content' => null,				
					'active' => 1,
					'idafp_rem' => $trabajador->idafp,
					'idisapre_rem' => $trabajador->idisapre,
					'idmutual_rem' => $empresa->idmutual,
					'idcaja_rem' => $empresa->idcaja
				);

			$this->db->where('idpersonal', $datos_remuneracion->idpersonal);
			$this->db->where('id_periodo', $datos_remuneracion->id_periodo);
			$this->db->where('id_empresa', $this->session->userdata('empresaid'));
			$this->db->update('rem_remuneracion',$data_remuneracion); 	

			// VUELVE A CERO LA ASIGNACION FAMILIAR POR CARGAS RETROACTIVAS
			$this->db->where('id_personal', $trabajador->id_personal);
			$this->db->update('rem_personal',array('asigfamiliar' => 0,
												'cargasretroactivas' => 0)); 	


			// AGREGA CUENTA CON SUELDO LIQUIDO
			//$cuenta_sueldo = $sueldo_liquido - $datos_remuneracion->aguinaldo;
			$cuenta_sueldo = $sueldo_liquido;



       		//calculamos los montos destinados a afp
		}

 		// CERRAR PERIODO
		$this->db->where('id_periodo', $idperiodo);
		$this->db->where('id_empresa', $this->session->userdata('empresaid'));
		$this->db->where_in('id_centro_costo', $centro_costo);
		$this->db->update('rem_periodo_remuneracion',array('cierre' => date("Y-m-d H:i:s"))); 

		$this->db->trans_complete();
		return 1;
	}	



	public function get_periodos_cerrados($empresaid,$idperiodo = null,$idcentrocosto = null){
		$sql_centro_costo = is_null($idcentrocosto) ? '' : 'and pe.idcentrocosto = ' . $idcentrocosto;
		$sql_centro_costo_rem = is_null($idcentrocosto) ? '' : 'and r.idcentrocosto = ' . $idcentrocosto;


		$periodo_data = $this->db->select('p.id_periodo, p.mes, p.anno, pr.cierre, pr.aprueba, pr.cierre as cierre,  (select count(*) from rem_remuneracion r inner join rem_personal pe on r.idpersonal = pe.id_personal where r.id_periodo = p.id_periodo and pe.id_empresa = ' . $empresaid . ' and r.active = 1 ' . $sql_centro_costo_rem . ') as numtrabajadores, (select sum(sueldoimponible) from rem_remuneracion r inner join rem_personal pe on r.idpersonal = pe.id_personal where r.id_periodo = p.id_periodo and pe.id_empresa = ' . $empresaid . ' and r.active = 1 ' . $sql_centro_costo . ') as sueldoimponible, (select sum(sueldoliquido) from rem_remuneracion r inner join rem_personal pe on r.idpersonal = pe.id_personal where r.id_periodo = p.id_periodo and pe.id_empresa = ' . $empresaid . ' and r.active = 1 ' . $sql_centro_costo . ') as sueldoliquido', false)
						  ->from('rem_periodo as p')
						  ->join('rem_periodo_remuneracion as pr','p.id_periodo = pr.id_periodo')
						  ->where('pr.id_empresa', $empresaid)
		                  ->where('pr.cierre is not null')
		                  ->group_by('p.id_periodo, p.mes, p.anno, pr.cierre, pr.aprueba, pr.cierre ')
		                  ->order_by('p.anno desc')
		                  ->order_by('p.mes desc');
		$periodo_data = is_null($idperiodo) ? $periodo_data : $periodo_data->where('pr.id_periodo',$idperiodo);
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		//$datos = is_null($idperiodo) ? $query->result() : $query->row();				                  
		$datos = $query->result();				                  
		return $datos;

	}



public function get_planillas_imposiciones($idperiodo,$idcentrocosto,$tipo){


		$idempresa = $this->session->userdata('empresaid');
		if($tipo == 'ISAPRE'){
			$campo = 'idisapre_rem';
			$alias = 'i';
		}else if($tipo == 'AFP'){
			$campo = 'idafp_rem';
			$alias = 'a';
		}else if($tipo == 'CAJA'){
			$campo = 'idcaja_rem';
			$alias = 'c';
		}else if($tipo == 'MUTUAL'){
			$campo = 'idmutual_rem';
			$alias = 'm';
		}
	
		$this->db->select($alias.'.nombre, count(*) as cantidad', false)
						  ->from('rem_remuneracion as r')
						  ->join('rem_personal as p','r.idpersonal = p.id_personal')
						  ->join('rem_afp as a','r.idafp_rem = a.id_afp','LEFT')
						  ->join('rem_isapre as i','r.idisapre_rem = i.id_isapre','LEFT')
						  ->join('rem_mutual_seguridad as m','r.idmutual_rem = m.id_mutual_seguridad','LEFT')
						  ->join('rem_cajas_compensacion as c','r.idcaja_rem = c.id_cajas_compensacion','LEFT')
						  ->where('p.id_empresa', $idempresa)
		                  ->where('r.id_periodo',$idperiodo)
		                  ->group_by($alias.'.nombre')
		                  ->order_by($alias.'.nombre');
		
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		//$datos = is_null($idperiodo) ? $query->result() : $query->row();				                  
		$datos = $query->result();				                  
		return $datos;

	}	


public function get_periodos_cerrados_detalle($empresaid,$idperiodo = null,$idcentrocosto = null){


		$lista_centro_costos_validos = is_null($idperiodo) ? 'select id_centro_costo from rem_centro_costo where id_empresa = ' . $empresaid : 'select pr.id_centro_costo  
													from rem_periodo_remuneracion as pr
													where pr.id_periodo = ' . $idperiodo. ' and pr.id_empresa = ' . $empresaid . '		
													and cierre is not null';
		$sql_centro_costo = is_null($idcentrocosto) ? 'and pe.idcentrocosto in (' . $lista_centro_costos_validos . ')' : 'and pe.idcentrocosto = ' . $idcentrocosto;
		$sql_centro_costo_rem = is_null($idcentrocosto) ? 'and pe.idcentrocosto in (' . $lista_centro_costos_validos . ')' : 'and r.idcentrocosto = ' . $idcentrocosto;


		$periodo_data = $this->db->select('p.id_periodo, p.mes, p.anno, max(pr.cierre) as cierre, pr.aprueba, (select count(*) from rem_remuneracion r inner join rem_personal pe on r.idpersonal = pe.id_personal where r.id_periodo = p.id_periodo and pe.id_empresa = ' . $empresaid . ' and r.active = 1 ' . $sql_centro_costo_rem . ') as numtrabajadores, (select sum(sueldoimponible) from rem_remuneracion r inner join rem_personal pe on r.idpersonal = pe.id_personal where r.id_periodo = p.id_periodo and pe.id_empresa = ' . $empresaid . ' and r.active = 1 ' . $sql_centro_costo . ') as sueldoimponible, (select sum(sueldoliquido) from rem_remuneracion r inner join rem_personal pe on r.idpersonal = pe.id_personal where r.id_periodo = p.id_periodo and pe.id_empresa = ' . $empresaid . ' and r.active = 1 ' . $sql_centro_costo . ') as sueldoliquido', false)
						  ->from('rem_periodo as p')
						  ->join('rem_periodo_remuneracion as pr','p.id_periodo = pr.id_periodo')
						  ->where('pr.id_empresa', $empresaid)
		                  ->where('pr.cierre is not null')
		                  ->group_by('p.id_periodo, p.mes, p.anno, pr.aprueba')
		                  ->order_by('p.anno desc')
		                  ->order_by('p.mes desc');
		$periodo_data = is_null($idperiodo) ? $periodo_data : $periodo_data->where('pr.id_periodo',$idperiodo);
		$query = $this->db->get();
		//	echo $this->db->last_query(); exit;
		//$datos = is_null($idperiodo) ? $query->result() : $query->row();				                  
		$datos = $query->result();				                  
		return $datos;

	}	


public function get_periodos_aprobados_detalle($empresaid,$idperiodo = null,$idcentrocosto = null){
		$sql_centro_costo = is_null($idcentrocosto) ? '' : 'and pe.idcentrocosto = ' . $idcentrocosto;
		$sql_centro_costo_rem = is_null($idcentrocosto) ? '' : 'and r.idcentrocosto = ' . $idcentrocosto;


		$periodo_data = $this->db->select('p.id_periodo, p.mes, p.anno, max(pr.cierre) as cierre, pr.aprueba, (select count(*) from rem_remuneracion r inner join rem_personal pe on r.idpersonal = pe.id_personal where r.id_periodo = p.id_periodo and pe.id_empresa = ' . $empresaid . ' and r.active = 1 ' . $sql_centro_costo_rem . ') as numtrabajadores, (select sum(sueldoimponible) from rem_remuneracion r inner join rem_personal pe on r.idpersonal = pe.id_personal where r.id_periodo = p.id_periodo and pe.id_empresa = ' . $empresaid . ' and r.active = 1 ' . $sql_centro_costo . ') as sueldoimponible, (select sum(sueldoliquido) from rem_remuneracion r inner join rem_personal pe on r.idpersonal = pe.id_personal where r.id_periodo = p.id_periodo and pe.id_empresa = ' . $empresaid . ' and r.active = 1 ' . $sql_centro_costo . ') as sueldoliquido', false)
						  ->from('rem_periodo as p')
						  ->join('rem_periodo_remuneracion as pr','p.id_periodo = pr.id_periodo')
						  ->where('pr.id_empresa', $empresaid)
		                  ->where('pr.aprueba is not null')
		                  ->group_by('p.id_periodo, p.mes, p.anno, pr.aprueba')
		                  ->order_by('p.anno desc')
		                  ->order_by('p.mes desc');
		$periodo_data = is_null($idperiodo) ? $periodo_data : $periodo_data->where('pr.id_periodo',$idperiodo);
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		//$datos = is_null($idperiodo) ? $query->result() : $query->row();				                  
		$datos = $query->result();				                  
		return $datos;

	}		
	/*public function get_periodos_cerrados($empresaid,$idperiodo = null,$idcentrocosto = null){
		$sql_centro_costo = is_null($idcentrocosto) ? 'and pe.idcentrocosto = cc.id_centro_costo' : 'and pe.idcentrocosto = ' . $idcentrocosto;
		$sql_centro_costo_rem = is_null($idcentrocosto) ? 'and pe.idcentrocosto = cc.id_centro_costo' : 'and r.idcentrocosto = ' . $idcentrocosto;


		$periodo_data = $this->db->select('p.id_periodo, p.mes, p.anno, pr.cierre, pr.aprueba, pr.cierre as cierre,  (select count(*) from rem_remuneracion r inner join rem_personal pe on r.idpersonal = pe.id_personal where r.id_periodo = p.id_periodo and pe.id_empresa = ' . $empresaid . ' and r.active = 1 ' . $sql_centro_costo_rem . ') as numtrabajadores, (select sum(sueldoimponible) from rem_remuneracion r inner join rem_personal pe on r.idpersonal = pe.id_personal where r.id_periodo = p.id_periodo and pe.id_empresa = ' . $empresaid . ' and r.active = 1 ' . $sql_centro_costo . ') as sueldoimponible, (select sum(sueldoliquido) from rem_remuneracion r inner join rem_personal pe on r.idpersonal = pe.id_personal where r.id_periodo = p.id_periodo and pe.id_empresa = ' . $empresaid . ' and r.active = 1 ' . $sql_centro_costo . ') as sueldoliquido ,cc.nombre as centro_costo', false)
						  ->from('rem_periodo as p')
						  ->join('rem_periodo_remuneracion as pr','p.id_periodo = pr.id_periodo')
						  ->join('rem_centro_costo as cc','pr.id_centro_costo = cc.id_centro_costo and cc.id_empresa = ' . $empresaid)
		                  ->where('pr.id_empresa', $empresaid)
		                  ->where('pr.cierre is not null')
		                  ->where('(select count(*) from rem_remuneracion r inner join rem_personal pe on r.idpersonal = pe.id_personal where r.id_periodo = p.id_periodo and pe.id_empresa = 117 and r.active = 1 ' . $sql_centro_costo_rem . ' )  > 0')
		                  ->group_by('p.id_periodo, p.mes, p.anno, pr.cierre, pr.aprueba, pr.cierre , cc.nombre, cc.id_centro_costo')
		                  ->order_by('p.anno desc')
		                  ->order_by('p.mes desc');
		$periodo_data = is_null($idperiodo) ? $periodo_data : $periodo_data->where('pr.id_periodo',$idperiodo);
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		//$datos = is_null($idperiodo) ? $query->result() : $query->row();				                  
		$datos = $query->result();				                  
		return $datos;

	}*/




	public function get_remuneraciones_by_periodo($idperiodo,$sinsueldo = null,$idcentrocosto = null){
		
		$periodo_data = $this->db->select('r.id_remuneracion, r.id_periodo, pe.id_personal as idtrabajador, p.mes, p.anno, pe.nombre, pe.apaterno, pe.amaterno, pe.sexo, pe.nacionalidad, pe.fecingreso as fecingreso, pe.rut, pe.dv, i.nombre as prev_salud, pe.idisapre, pe.valorpactado, c.nombre as cargo, a.id_afp as idafp, a.nombre as afp, a.porc, r.sueldobase, r.gratificacion, r.bonosimponibles, r.valorhorasextras50, r.montohorasextras50, r.valorhorasextras100, r.montohorasextras100, r.aguinaldo, r.aguinaldobruto, r.diastrabajo, r.totalhaberes, r.totaldescuentos, r.sueldoliquido, r.horasextras50, r.horasextras100, r.horasdescuento, pe.cargassimples, pe.cargasinvalidas, pe.cargasmaternales, pe.cargasretroactivas, r.sueldoimponible, r.movilizacion, r.colacion, r.bonosnoimponibles, r.asigfamiliar, r.totalhaberes, r.basetributaria, r.cotizacionobligatoria, r.comisionafp, r.adicafp, r.segcesantia, r.cotizacionsalud, r.fonasa, r.inp, r.adicisapre, r.cotadicisapre, r.adicsalud, r.impuesto, r.montoahorrovol, r.montocotapv, r.anticipo, r.montodescuento, pr.cierre, r.sueldonoimponible, r.totalleyessociales, r.otrosdescuentos, r.descuentosnolegales, r.montocargaretroactiva, r.seginvalidez, pe.idasigfamiliar, r.valorpactado as valorpactadoperiodo, ap.id_apv as idapv, pe.nrocontratoapv, pe.formapagoapv, pe.depconvapv, co.idmutual, r.aportepatronal, co.idcaja, pe.segcesantia as afilsegcesantia, r.semana_corrida, r.aportesegcesantia, r.sueldoimponibleimposiciones, r.sueldoimponibleafc, r.sueldoimponibleips, pe.direccion, com.nombre as comuna, pe.parttime, pe.idregion, pe.idcomuna, a.codlre, i.codlre as codlreisapre, ccaf.codlre as codlrecaja, m.codprevired as codlremutual, pr.cierre, pr.aprueba,  f.tramo as tramo_asig_familiar, f.tramo, r.totaldescuentoslegales, cc.codigo as codcentrocosto')
						  ->from('rem_periodo as p')
						  ->join('rem_remuneracion as r','r.id_periodo = p.id_periodo')
						  ->join('rem_personal as pe','pe.id_personal = r.idpersonal')
						  ->join('rem_centro_costo as cc','pe.idcentrocosto = cc.id_centro_costo','LEFT')
						  ->join('rem_empresa as co','pe.id_empresa = co.id_empresa')
						  ->join('rem_periodo_remuneracion as pr','r.id_periodo = pr.id_periodo and r.idcentrocosto = pr.id_centro_costo and pr.cierre is not null')
						  ->join('rem_isapre as i','pe.idisapre = i.id_isapre')
						  ->join('rem_cargos as c','pe.idcargo = c.id_cargos','left')
						  ->join('rem_afp as a','pe.idafp = a.id_afp')
						  ->join('rem_apv as ap','pe.instapv = ap.id_apv','left')						  
						  ->join('rem_comuna as com','pe.idcomuna = com.idcomuna','left')
						  ->join('rem_cajas_compensacion as ccaf', 'co.idcaja = ccaf.id_cajas_compensacion', 'left')
						  ->join('rem_mutual_seguridad as m', 'co.idmutual = m.id_mutual_seguridad', 'left')
						  ->join('rem_tabla_asig_familiar as f', 'pe.idasigfamiliar = f.id_tabla_asig_familiar', 'left')
		                  ->where('pe.id_empresa', $this->session->userdata('empresaid'))
		                  ->where('pr.id_empresa', $this->session->userdata('empresaid'))
		                  ->where('r.id_periodo', $idperiodo)
		                  //->where('pe.idcentrocosto',1)
		                  ->where('r.active = 1')
		                  //->where('r.sueldoliquido <> 0')  //valida que se haya creado sueldo
		                  ->order_by('pe.nombre asc');

		$periodo_data = is_null($sinsueldo) ? $periodo_data->where('r.sueldoliquido <> 0') : $periodo_data;	
		$periodo_data = is_null($idcentrocosto) ? $periodo_data : $periodo_data->where('pe.idcentrocosto',$idcentrocosto);		                  
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		return $query->result();


	}	



	public function get_remuneraciones_by_colaborador($idpersonal,$sinsueldo = null){
		
		$periodo_data = $this->db->select('r.id_remuneracion, r.id_periodo, pe.id_personal as idtrabajador, p.mes, p.anno, pe.nombre, pe.apaterno, pe.amaterno, pe.sexo, pe.nacionalidad, pe.fecingreso as fecingreso, pe.rut, pe.dv, i.nombre as prev_salud, pe.idisapre, pe.valorpactado, c.nombre as cargo, a.id_afp as idafp, a.nombre as afp, a.porc, r.sueldobase, r.gratificacion, r.bonosimponibles, r.valorhorasextras50, r.montohorasextras50, r.valorhorasextras100, r.montohorasextras100, r.aguinaldo, r.aguinaldobruto, r.diastrabajo, r.totalhaberes, r.totaldescuentos, r.sueldoliquido, r.horasextras50, r.horasextras100, r.horasdescuento, pe.cargassimples, pe.cargasinvalidas, pe.cargasmaternales, pe.cargasretroactivas, r.sueldoimponible, r.movilizacion, r.colacion, r.bonosnoimponibles, r.asigfamiliar, r.totalhaberes, r.cotizacionobligatoria, r.comisionafp, r.adicafp, r.segcesantia, r.cotizacionsalud, r.fonasa, r.inp, r.adicisapre, r.cotadicisapre, r.adicsalud, r.impuesto, r.montoahorrovol, r.montocotapv, r.anticipo, r.montodescuento, pr.cierre, r.sueldonoimponible, r.totalleyessociales, r.otrosdescuentos, r.descuentosnolegales, r.montocargaretroactiva, r.seginvalidez, pe.idasigfamiliar, r.valorpactado as valorpactadoperiodo, ap.id_apv as idapv, pe.nrocontratoapv, pe.formapagoapv, pe.depconvapv, co.idmutual, r.aportepatronal, co.idcaja, pe.segcesantia as afilsegcesantia, r.semana_corrida, r.aportesegcesantia, r.sueldoimponibleimposiciones, r.sueldoimponibleafc, r.sueldoimponibleips, pe.direccion, com.nombre as comuna, pe.parttime, pe.idregion, pe.idcomuna, a.codlre, i.codlre as codlreisapre, ccaf.codlre as codlrecaja, m.codprevired as codlremutual, f.tramo as tramo_asig_familiar')
						  ->from('rem_periodo as p')
						  ->join('rem_remuneracion as r','r.id_periodo = p.id_periodo')
						  ->join('rem_personal as pe','pe.id_personal = r.idpersonal')
						  ->join('rem_empresa as co','pe.id_empresa = co.id_empresa')
						  ->join('rem_periodo_remuneracion as pr','r.id_periodo = pr.id_periodo and r.idcentrocosto = pr.id_centro_costo and pr.aprueba is not null')
						  ->join('rem_isapre as i','pe.idisapre = i.id_isapre')
						  ->join('rem_cargos as c','pe.idcargo = c.id_cargos','left')
						  ->join('rem_afp as a','pe.idafp = a.id_afp')
						  ->join('rem_apv as ap','pe.instapv = ap.id_apv','left')						  
						  ->join('rem_comuna as com','pe.idcomuna = com.idcomuna','left')
						  ->join('rem_cajas_compensacion as ccaf', 'co.idcaja = ccaf.id_cajas_compensacion', 'left')
						  ->join('rem_mutual_seguridad as m', 'co.idmutual = m.id_mutual_seguridad', 'left')
						  ->join('rem_tabla_asig_familiar as f', 'pe.idasigfamiliar = f.id_tabla_asig_familiar', 'left')
		                  ->where('pe.id_empresa', $this->session->userdata('empresaid'))
		                  ->where('pr.id_empresa', $this->session->userdata('empresaid'))
		                  ->where('r.idpersonal', $idpersonal)
		                  //->where('pe.idcentrocosto',1)
		                  ->where('r.active = 1')
		                  //->where('r.sueldoliquido <> 0')  //valida que se haya creado sueldo
		                  ->order_by('p.anno desc, p.mes desc');

		$periodo_data = is_null($sinsueldo) ? $periodo_data->where('r.sueldoliquido <> 0') : $periodo_data;			                  
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		return $query->result();


	}	


	public function get_remuneracion_colaborador(){
		
		$periodo_data = $this->db->select('r.id_remuneracion, r.id_periodo, pe.id_personal as idtrabajador, p.mes, p.anno, pe.nombre, pe.apaterno, pe.amaterno, pe.sexo, pe.nacionalidad, pe.fecingreso as fecingreso, pe.rut, pe.dv, i.nombre as prev_salud, pe.idisapre, pe.valorpactado, c.nombre as cargo, a.id_afp as idafp, a.nombre as afp, a.porc, r.sueldobase, r.gratificacion, r.bonosimponibles, r.valorhorasextras50, r.montohorasextras50, r.valorhorasextras100, r.montohorasextras100, r.aguinaldo, r.aguinaldobruto, r.diastrabajo, r.totalhaberes, r.totaldescuentos, r.sueldoliquido, r.horasextras50, r.horasextras100, r.horasdescuento, pe.cargassimples, pe.cargasinvalidas, pe.cargasmaternales, pe.cargasretroactivas, r.sueldoimponible, r.movilizacion, r.colacion, r.bonosnoimponibles, r.asigfamiliar, r.totalhaberes, r.cotizacionobligatoria, r.comisionafp, r.adicafp, r.segcesantia, r.cotizacionsalud, r.fonasa, r.inp, r.adicisapre, r.cotadicisapre, r.adicsalud, r.impuesto, r.montoahorrovol, r.montocotapv, r.anticipo, r.montodescuento, pr.cierre, r.sueldonoimponible, r.totalleyessociales, r.otrosdescuentos, r.descuentosnolegales, r.montocargaretroactiva, r.seginvalidez, pe.idasigfamiliar, r.valorpactado as valorpactadoperiodo, ap.id_apv as idapv, pe.nrocontratoapv, pe.formapagoapv, pe.depconvapv, co.idmutual, r.aportepatronal, co.idcaja, pe.segcesantia as afilsegcesantia, r.semana_corrida, r.aportesegcesantia, r.sueldoimponibleimposiciones')
						  ->from('rem_periodo as p')
						  ->join('rem_remuneracion as r','r.id_periodo = p.id_periodo')
						  ->join('rem_personal as pe','pe.id_personal = r.idpersonal')
						  ->join('rem_empresa as co','pe.id_empresa = co.id_empresa')
						  ->join('rem_periodo_remuneracion as pr','r.id_periodo = pr.id_periodo and r.idcentrocosto = pr.id_centro_costo')
						  ->join('rem_isapre as i','pe.idisapre = i.id_isapre')
						  ->join('rem_cargos as c','pe.idcargo = c.id_cargos')
						  ->join('rem_afp as a','pe.idafp = a.id_afp')
						  ->join('rem_apv as ap','pe.instapv = ap.id_apv','left')						  
		                  //->where('pe.id_empresa', $this->session->userdata('empresaid'))
		                  //->where('pr.id_empresa', $this->session->userdata('empresaid'))
		                  ->where('pe.id_personal', 10270)
		                  ->where('pe.id_empresa', 117)
		                  ->where('pr.id_empresa', 117)
		                  
		                  //->where('pe.idcentrocosto',1)
		                  ->where('r.active = 1')
		                  //->where('r.sueldoliquido <> 0')  //valida que se haya creado sueldo
		                  ->order_by('pe.nombre asc');

		                 
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		return $query->result();


	}

public function exporta_colaborador($datos_colaborador){

			$this->load->library('PHPExcel');
	  	    $this->phpexcel->setActiveSheetIndex(0);
	        $sheet = $this->phpexcel->getActiveSheet();
	        $sheet->setTitle("libro_colaboradores");

	        //var_dump($datos_colaborador);


			$this->load->model('admin');
			$datos_empresa = $this->admin->datos_empresa($this->session->userdata('empresaid'));
			//echo "<pre>";
			//print_r($this->session->all_userdata());
			//print_r($datos_empresa); exit;

			/********* COMIENZA A CREAR EXCEL *******/
	        // DATOS INICIALES
			$sheet->getColumnDimension('A')->setWidth(5);


	        $sheet->mergeCells('B2:D2');
	        $sheet->setCellValue('B2', 'Libro Colaboradores');
	        $sheet->getColumnDimension('B')->setWidth(20);
	        $sheet->setCellValue('B3', 'Nombre Empresa');
	        $sheet->setCellValue('C3',html_entity_decode($this->session->userdata('empresanombre')));
	        $sheet->mergeCells('C3:D3');
	        $sheet->setCellValue('B4', 'Rut Empresa');
	        $sheet->setCellValue('C4',number_format($datos_empresa->rut,0,".",".") . '-' .$datos_empresa->dv);	        
	        $sheet->mergeCells('C4:D4');
	        $sheet->setCellValue('B5', 'Direccion Empresa');
	        $sheet->setCellValue('C5',$datos_empresa->direccion.", ".$datos_empresa->comuna);	        	        
	        $sheet->mergeCells('C5:D5');
	        $sheet->setCellValue('B6', 'Fecha emision Reporte');
	        $sheet->setCellValue('C6',date('d/m/Y') );
	        $sheet->mergeCells('C6:D6');
	        
 
			$sheet->getStyle("B2:B6")->getFont()->setBold(true);
			$sheet->getStyle("B2:D6")->getFont()->setSize(10);    	

			//D7E4BC


			/****************** TABLA INICIAL ****************/

			/*************************todos los bordes internos *************************************/
			$sheet->getStyle("B2:D6")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


			/*************************bordes cuadro principal (externo) *************************************/
			$sheet->getStyle("B2:D2")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
			$sheet->getStyle("B2:D2")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
			$sheet->getStyle("B6:D6")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
			$sheet->getStyle("B2:B6")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
			$sheet->getStyle("B2:B6")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
			$sheet->getStyle("D2:D6")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
		
			/**********************************************************************************************************/			        
				
			/***** COLOR TABLA ****************/
			$sheet->getStyle("B2:D2")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$sheet->getStyle("B2:D2")->getFill()->getStartColor()->setRGB('FA8D72');

			$sheet->getStyle("B2:B6")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$sheet->getStyle("B2:B6")->getFill()->getStartColor()->setRGB('FA8D72');			


			$i = 8;

			$array_columna = array(	'B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI',
				'AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP',
				'BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV');

			
			
			$array_nombre_columna = array('#',
				'Rut',
				'Nombre Completo', 
				'Fecha Nacimiento', 
				'Sexo', 
				'idecivil', 
				'Nacionalidad', 
				'Direccion', 
				'Region', 
				'Comuna', 
				'Telefono', 
				'Email', 
				'Fecha de Ingreso', 
				'Cargo', 
				'Tipo Contrato', 
				'Part Time', 
				'Seguro Cesantia', 
				'Pensionado', 
				'Dias Trabajo', 
				'Horas Diarias', 
				'Horas Semanales', 
				'Sueldo Base', 
				'Tipo Gratificacion', 
				'Gratificacion', 
				'Asignación Familiar', 
				'Cargas Simples', 
				'Cargas Invalidas', 
				'Cargas Maternales', 
				'Cargas Retroactivas', 
				'id Asignación Familiar',
				'Movilización', 
				'Colación', 
				'id AFP', 
				'Adic AFP', 
				'Tipo Ahorro voluntario', 
				'Ahorro Voluntario', 
				'Tipo Cotización APV', 
				'Cotización APV', 
				'id Isapre', 
				'Valor Pactado',
				'id Nacionalidad',
				'Bonos Fijos',
				'Fecha AFC',
				'Meses Vacaciones',
				'Fecha Inicio Vacaciones',
				'Saldo Inicio Vacaciones',
				'Dias Vacaciones Tomados',
				'Dias Progresivos',
				'Dias Progresivos Tomados',
				'Saldo Inicio Vacaciones Programadas',
				'id Centro Costo',
				'Talla Polera',
				'Talla Pantalon',
				'Titulo',
				'id Licencia',
				'id Estudio',
				'inst APV',
				'Numero Contrato APV',
				'Jubilado',
				'Sindicato',
				'Rol Privado',
				'id Lugar Pago',
				'id Categoria',
				'Semana Corrida',
				'Tipo Renta',
				'id Idioma',
				'Numero Ficha',
				'Fecha AFP',
				'id Banco',
				'id Forma Pago',
				'Numero Cuenta Banco',
				'Tipo Documento',
				'C Beneficio',
				'Fecha Retiro',
				'Fecha Finiquito',
				'id Motivo Egreso',
				'id Tipo cc',
				'id Seccion',
				'id Situacion',
				'id Clase',
				'id Ine',
				'id Zona',
				'Fecha Real Contrato',
				'Primer Vencimiento',
				'Fun',
				'Fec Vencimiento Plan',
				'fec apvc',
				'Fecha Termino Subsidio',
				'Rut Pago', 
				'dv Pago', 
				'Nombre Pago',
				'Email Pago',
				'Usuario Windows',
				'id Jefe',
				'id Reemplazo',
				'Forma Pago APV',
				'Regimen APV',
				'Trabajo Pesado',
				'Plazo Contrato');



			//ENCABEZADO REPORTE
			
/*
			$contador = count($array_nombre_columna);
			echo $contador;
			for ($y = 0; $y > $contador; $y++) {
   				//echo $array_nombre_columna[$y];
   				//echo " \n ";
   				//var_dump($array_nombre_columna);
				$sheet->getColumnDimension($array_columna[$y])->setAutoSize(true);
				$sheet->setCellValue($array_nombre_columna[$y] . $i, $array_columna[$y]);
			}*/
             		
			 $sheet->getColumnDimension('B')->setWidth(10);
			 $sheet->setCellValue('B'.$i, '#');
			 $sheet->getColumnDimension('C')->setWidth(15);
			 $sheet->setCellValue('C'.$i, 'Rut');
			 $sheet->getColumnDimension('D')->setWidth(35);
			 $sheet->setCellValue('D'.$i, 'Nombre Completo');
			 $sheet->getColumnDimension('E')->setWidth(15);
			 $sheet->setCellValue('E'.$i, 'Fecha Nacimiento');
			 $sheet->getColumnDimension('F')->setWidth(15);			
			 $sheet->setCellValue('F'.$i, 'Sexo');
			 $sheet->getColumnDimension('G')->setWidth(15);			
			 $sheet->setCellValue('G'.$i, 'idecivil');	
			 $sheet->getColumnDimension('H')->setWidth(15);			
			 $sheet->setCellValue('H'.$i, 'Nacionalidad');	
			 $sheet->getColumnDimension('I')->setWidth(15);			
			 $sheet->setCellValue('I'.$i, 'Dirección');		
			 $sheet->getColumnDimension('J')->setWidth(15);			
			 $sheet->setCellValue('J'.$i, 'Regíon');				 			 			 		 
			 $sheet->getColumnDimension('K')->setWidth(15);			
			 $sheet->setCellValue('K'.$i, 'Comuna');	
			 $sheet->getColumnDimension('L')->setWidth(15);			
			 $sheet->setCellValue('L'.$i, 'Telefono');	
			 $sheet->getColumnDimension('M')->setWidth(15);			
			 $sheet->setCellValue('M'.$i, 'Email');	
			 $sheet->getColumnDimension('N')->setWidth(15);			
			 $sheet->setCellValue('N'.$i, 'Fecha Ingreso');				 
			 $sheet->getColumnDimension('O')->setWidth(15);			
			 $sheet->setCellValue('O'.$i, 'Cargo');	
			 $sheet->getColumnDimension('P')->setWidth(15);			
			 $sheet->setCellValue('P'.$i, 'Tipo Contrato');		
			 $sheet->getColumnDimension('Q')->setWidth(15);			
			 $sheet->setCellValue('Q'.$i, 'Part Time');				 			 
			 $sheet->getColumnDimension('R')->setWidth(15);			
			 $sheet->setCellValue('R'.$i, 'Seguro Cesantia');				 			 
			 $sheet->getColumnDimension('S')->setWidth(15);			
			 $sheet->setCellValue('S'.$i, 'Pensionado');				 			 
			 $sheet->getColumnDimension('T')->setWidth(15);			
			 $sheet->setCellValue('T'.$i, 'Dias Trabajo');				 			 
			 $sheet->getColumnDimension('U')->setWidth(15);			
			 $sheet->setCellValue('U'.$i, 'Horas Diarias');	
			 $sheet->getColumnDimension('V')->setWidth(15);			
			 $sheet->setCellValue('V'.$i, 'Horas Semanales');	
			 $sheet->getColumnDimension('W')->setWidth(15);			
			 $sheet->setCellValue('W'.$i, 'Sueldo Base');	
			 $sheet->getColumnDimension('X')->setWidth(15);			
			 $sheet->setCellValue('X'.$i, 'Tipo Gratificacion');	
			 $sheet->getColumnDimension('Y')->setWidth(15);			
			 $sheet->setCellValue('Y'.$i, 'Gratificacion');	
			 $sheet->getColumnDimension('Z')->setWidth(15);			
			 $sheet->setCellValue('Z'.$i, 'Asignación Familiar');	


			 $sheet->getColumnDimension('AA')->setWidth(15);			
			 $sheet->setCellValue('AA'.$i, 'Cargas Simples');	
			 $sheet->getColumnDimension('AB')->setWidth(15);			
			 $sheet->setCellValue('AB'.$i, 'Cargas Invalidas');	
			 $sheet->getColumnDimension('AC')->setWidth(15);			
			 $sheet->setCellValue('AC'.$i, 'Cargas Maternales');	
			 $sheet->getColumnDimension('AD')->setWidth(15);			
			 $sheet->setCellValue('AD'.$i, 'Cargas Retroactivas');	
			 $sheet->getColumnDimension('AE')->setWidth(15);			
			 $sheet->setCellValue('AE'.$i, 'id Asignación Familiar');	
			 $sheet->getColumnDimension('AF')->setWidth(15);			
			 $sheet->setCellValue('AF'.$i, 'Movilización');	
			 $sheet->getColumnDimension('AG')->setWidth(15);			
			 $sheet->setCellValue('AG'.$i, 'Colación');	
			 $sheet->getColumnDimension('AH')->setWidth(15);			
			 $sheet->setCellValue('AH'.$i, 'id AFP');	
			 $sheet->getColumnDimension('AI')->setWidth(15);			
			 $sheet->setCellValue('AI'.$i, 'Adic AFP');				 			 			 			 		
			 $sheet->getColumnDimension('AJ')->setWidth(15);			
			 $sheet->setCellValue('AJ'.$i, 'Tipo Ahorro voluntario');				 			 			 			 		
			 $sheet->getColumnDimension('AK')->setWidth(15);	
			 $sheet->setCellValue('AK'.$i, 'Ahorro Voluntario');	 
			 $sheet->getColumnDimension('AL')->setWidth(15);			
			 $sheet->setCellValue('AL'.$i, 'Tipo Cotización APV');	 
			 $sheet->getColumnDimension('AM')->setWidth(15);			
			 $sheet->setCellValue('AM'.$i, 'Cotización APV');	 
			 $sheet->getColumnDimension('AN')->setWidth(15);			
			 $sheet->setCellValue('AN'.$i, 'id Isapre');
			 $sheet->getColumnDimension('AO')->setWidth(15);			
			 $sheet->setCellValue('AO'.$i, 'Valor Pactado');
			 $sheet->getColumnDimension('AP')->setWidth(15);			
			 $sheet->setCellValue('AP'.$i, 'id Nacionalidad');
			 $sheet->getColumnDimension('AQ')->setWidth(15);			
			 $sheet->setCellValue('AQ'.$i, 'Bonos Fijos');
			 $sheet->getColumnDimension('AR')->setWidth(15);			
			 $sheet->setCellValue('AR'.$i, 'Fecha AFC');
			 $sheet->getColumnDimension('AS')->setWidth(15);			
			 $sheet->setCellValue('AS'.$i, 'Meses Vacaciones');
			 $sheet->getColumnDimension('AT')->setWidth(15);			
			 $sheet->setCellValue('AT'.$i, 'Fecha Inicio Vacaciones');
			 $sheet->getColumnDimension('AU')->setWidth(15);			
			 $sheet->setCellValue('AU'.$i, 'Saldo Inicio Vacaciones');
			 $sheet->getColumnDimension('AV')->setWidth(15);			
			 $sheet->setCellValue('AV'.$i, 'Dias Vacaciones Tomados');
			 $sheet->getColumnDimension('AW')->setWidth(15);			
			 $sheet->setCellValue('AW'.$i, 'Dias Progresivos');
			 $sheet->getColumnDimension('AX')->setWidth(15);			
			 $sheet->setCellValue('AX'.$i, 'Dias Progresivos Tomados');
			 $sheet->getColumnDimension('AY')->setWidth(15);			
			 $sheet->setCellValue('AY'.$i, 'Saldo Inicio Vacaciones Programadas');
			 $sheet->getColumnDimension('AZ')->setWidth(15);			
			 $sheet->setCellValue('AZ'.$i, 'id Centro Costo');		 

			 $sheet->getColumnDimension('BA')->setWidth(15);			
			 $sheet->setCellValue('BA'.$i, 'Talla Polera');	
			 $sheet->getColumnDimension('BB')->setWidth(15);			
			 $sheet->setCellValue('BB'.$i, 'Talla Pantalon');	
			 $sheet->getColumnDimension('BC')->setWidth(15);			
			 $sheet->setCellValue('BC'.$i, 'Titulo');	
			 $sheet->getColumnDimension('BD')->setWidth(15);			
			 $sheet->setCellValue('BD'.$i, 'id Licencia');	
			 $sheet->getColumnDimension('BE')->setWidth(15);			
			 $sheet->setCellValue('BE'.$i, 'id Estudio');	
			 $sheet->getColumnDimension('BF')->setWidth(15);			
			 $sheet->setCellValue('BF'.$i, 'inst APV');	
			 $sheet->getColumnDimension('BG')->setWidth(15);			
			 $sheet->setCellValue('BG'.$i, 'Numero Contrato APV');	
			 $sheet->getColumnDimension('BH')->setWidth(15);			
			 $sheet->setCellValue('BH'.$i, 'Jubilado');	
			 $sheet->getColumnDimension('BI')->setWidth(15);			
			 $sheet->setCellValue('BI'.$i, 'Sindicato');				 			 			 			 		
			 $sheet->getColumnDimension('BJ')->setWidth(15);			
			 $sheet->setCellValue('BJ'.$i, 'Rol Privado');				 			 			 			 		
			 $sheet->getColumnDimension('BK')->setWidth(15);	
			 $sheet->setCellValue('BK'.$i, 'id Lugar Pago');	 
			 $sheet->getColumnDimension('BL')->setWidth(15);			
			 $sheet->setCellValue('BL'.$i, 'id Categoria');	 
			 $sheet->getColumnDimension('BM')->setWidth(15);			
			 $sheet->setCellValue('BM'.$i, 'Semana Corrida');	 
			 $sheet->getColumnDimension('BN')->setWidth(15);			
			 $sheet->setCellValue('BN'.$i, 'Tipo Renta');
			 $sheet->getColumnDimension('BO')->setWidth(15);			
			 $sheet->setCellValue('BO'.$i, 'id Idioma');
			 $sheet->getColumnDimension('BP')->setWidth(15);			
			 $sheet->setCellValue('BP'.$i, 'Numero Ficha');
			 $sheet->getColumnDimension('BQ')->setWidth(15);			
			 $sheet->setCellValue('BQ'.$i, 'Fecha AFP');
			 $sheet->getColumnDimension('BR')->setWidth(15);			
			 $sheet->setCellValue('BR'.$i, 'id Banco');
			 $sheet->getColumnDimension('BS')->setWidth(15);			
			 $sheet->setCellValue('BS'.$i, 'id Forma Pago');
			 $sheet->getColumnDimension('BT')->setWidth(15);			
			 $sheet->setCellValue('BT'.$i, 'Numero Cuenta Banco');
			 $sheet->getColumnDimension('BU')->setWidth(15);			
			 $sheet->setCellValue('BU'.$i, 'Tipo Documento');
			 $sheet->getColumnDimension('BV')->setWidth(15);			
			 $sheet->setCellValue('BV'.$i, 'C Beneficio');
			 $sheet->getColumnDimension('BW')->setWidth(15);			
			 $sheet->setCellValue('BW'.$i, 'Fecha Retiro');
			 $sheet->getColumnDimension('BX')->setWidth(15);			
			 $sheet->setCellValue('BX'.$i, 'Fecha Finiquito');
			 $sheet->getColumnDimension('BY')->setWidth(15);			
			 $sheet->setCellValue('BY'.$i, 'id Motivo Egreso');
			 $sheet->getColumnDimension('BZ')->setWidth(15);			
			 $sheet->setCellValue('BZ'.$i, 'id Tipo cc');
			 $sheet->getColumnDimension('CA')->setWidth(15);			
			 $sheet->setCellValue('CA'.$i, 'id Seccion');	
			 $sheet->getColumnDimension('CB')->setWidth(15);			
			 $sheet->setCellValue('CB'.$i, 'id Situacion');	
			 $sheet->getColumnDimension('CC')->setWidth(15);			
			 $sheet->setCellValue('CC'.$i, 'id Clase');	
			 $sheet->getColumnDimension('CD')->setWidth(15);			
			 $sheet->setCellValue('CD'.$i, 'id Ine');	
			 $sheet->getColumnDimension('CE')->setWidth(15);			
			 $sheet->setCellValue('CE'.$i, 'id Zona');	
			 $sheet->getColumnDimension('CF')->setWidth(15);			
			 $sheet->setCellValue('CF'.$i, 'Fecha Real Contrato');	
			 $sheet->getColumnDimension('CG')->setWidth(15);			
			 $sheet->setCellValue('CG'.$i, 'Primer Vencimiento');	
			 $sheet->getColumnDimension('CH')->setWidth(15);			
			 $sheet->setCellValue('CH'.$i, 'Fun');	
			 $sheet->getColumnDimension('CI')->setWidth(15);			
			 $sheet->setCellValue('CI'.$i, 'Fec Vencimiento Plan'); 			 		
			 $sheet->getColumnDimension('CJ')->setWidth(15);			
			 $sheet->setCellValue('CJ'.$i, 'fec apvc'); 			 			 		
			 $sheet->getColumnDimension('CK')->setWidth(15);	
			 $sheet->setCellValue('CK'.$i, 'Fecha Termino Subsidio');	 
			 $sheet->getColumnDimension('CL')->setWidth(15);			
			 $sheet->setCellValue('CL'.$i, 'Rut Pago');	 
			 $sheet->getColumnDimension('CM')->setWidth(15);			
			 $sheet->setCellValue('CM'.$i, 'dv Pago');	 
			 $sheet->getColumnDimension('CN')->setWidth(15);			
			 $sheet->setCellValue('CN'.$i, 'Nombre Pago');
			 $sheet->getColumnDimension('CO')->setWidth(15);			
			 $sheet->setCellValue('CO'.$i, 'Email Pago');
			 $sheet->getColumnDimension('CP')->setWidth(15);			
			 $sheet->setCellValue('CP'.$i, 'Usuario Windows');
			 $sheet->getColumnDimension('CQ')->setWidth(15);			
			 $sheet->setCellValue('CQ'.$i, 'id Jefe');
			 $sheet->getColumnDimension('CR')->setWidth(15);			
			 $sheet->setCellValue('CR'.$i, 'id Reemplazo');
			 $sheet->getColumnDimension('CS')->setWidth(15);			
			 $sheet->setCellValue('CS'.$i, 'Forma Pago APV');
			 $sheet->getColumnDimension('CT')->setWidth(15);			
			 $sheet->setCellValue('CT'.$i, 'Regimen APV');
			 $sheet->getColumnDimension('CU')->setWidth(15);			
			 $sheet->setCellValue('CU'.$i, 'Trabajo Pesado');
			 $sheet->getColumnDimension('CV')->setWidth(15);			
			 $sheet->setCellValue('CV'.$i, 'Plazo Contrato');
			



			 $columnaFinal = 98;
			 $mergeTotal = 99;
			 $columnaTotales = 98;
			 $sheet->getStyle("B".$i.":".ordenLetrasExcel($columnaFinal).$i)->getFont()->setBold(true);
			 $i++;
			 
			$filaInicio = $i-1; 
			
			//$sheet->getStyle("B7:I7")->getFont()->setSize(11);  
			$linea = 1;


			
/*
			$contador = count($array_nombre_columna);
			echo $contador;
			for ($x = 0; $x < $contador; $x++) {
				$array_get_colaboradores = array("linea","$colaborador->rut","$colaborador->apaterno"+ " " + "$colaborador->amaterno"+ " " +"$colaborador->nombre");
   				foreach ($datos_colaborador as $colaborador) {

   					//$array_get_colaboradores = array("$linea","$colaborador->rut","$colaborador->apaterno"+ " " + "$colaborador->amaterno"+ " " +"$colaborador->nombre");/*,"$colaborador->fecnacimiento","$colaborador->sexo","$colaborador->idecivil","$colaborador->nacionalidad","$colaborador->direccion","$colaborador->idregion","$colaborador->idcomuna","$colaborador->fono","$colaborador->email","$colaborador->fecingreso","$colaborador->idcargo",$colaborador->tipocontrato,$colaborador->parttime,$colaborador->segcesantia,$colaborador->pensionado,$colaborador->diastrabajo,$colaborador->horasdiarias,$colaborador->horassemanales,$colaborador->sueldobase,$colaborador->tipogratificacion,$colaborador->gratificacion,$colaborador->asigfamiliar,$colaborador->cargassimples,$colaborador->cargasinvalidas,$colaborador->cargasmaternales,$colaborador->cargasretroactivas,$colaborador->idasigfamiliar,$colaborador->movilizacion,$colaborador->colacion,$colaborador->idafp,$colaborador->adicafp,$colaborador->tipoahorrovol,$colaborador->ahorrovol,$colaborador->tipocotapv,$colaborador->cotapv,$colaborador->idisapre,$colaborador->valorpactado,$colaborador->idnacionalidad,$colaborador->bonos_fijos,$colaborador->fecafc,$colaborador->meses_vac,$colaborador->fecinicvacaciones,$colaborador->saldoinicvacaciones,$colaborador->diasvactomados,$colaborador->diasprogresivos,$colaborador->diasprogtomados,$colaborador->saldoinicvacprog,$colaborador->idcentrocosto,$colaborador->tallapolera,$colaborador->tallapantalon,$colaborador->titulo,$colaborador->idlicencia,$colaborador->idestudio,$colaborador->instapv,$colaborador->nrocontratoapv,$colaborador->jubilado,$colaborador->sindicato,$colaborador->rol_privado,$colaborador->id_lugar_pago,$colaborador->id_categoria,$colaborador->semana_corrida,$colaborador->tiporenta,$colaborador->ididioma,$colaborador->numficha,$colaborador->fecafp,$colaborador->idbanco,$colaborador->id_forma_pago,$colaborador->nrocuentabanco,$colaborador->tipodocumento,$colaborador->cbeneficio,$colaborador->fecha_retiro,$colaborador->fecha_finiquito,$colaborador->id_motivo_egreso,$colaborador->id_tipocc,$colaborador->id_seccion,$colaborador->id_situacion,$colaborador->id_clase,$colaborador->id_ine,$colaborador->id_zona,$colaborador->fecrealcontrato,$colaborador->primervenc,$colaborador->fun,$colaborador->fecvencplan,$colaborador->fecapvc,$colaborador->fectermsubsidio,$colaborador->rut_pago,$colaborador->dv_pago,$colaborador->nombre_pago,$colaborador->email_pago,$colaborador->usuario_windows,$colaborador->idjefe,$colaborador->idreemplazo,$colaborador->formapagoapv,$colaborador->regimenapv,$colaborador->trabajo_pesado,$colaborador->plazo_contrato);
   					
   					$sheet->setCellValue($array_nombre_columna[$x]. $i,$array_get_colaboradores[$x]);

   				 	//var_dump($array_get_colaboradores[$x]);
   					echo $array_get_colaboradores[1];

   					$i++;
   					
					$linea++;
				}
				
				
			}*/

            foreach ($datos_colaborador as $colaborador) {

	            //	$sheet->setCellValue("B".$i,$linea);
				$sheet->setCellValue("B".$i,$linea);
            	$sheet->setCellValue("C".$i,$colaborador->rut."-".$colaborador->dv);
            	$sheet->setCellValue("D".$i,$colaborador->nombre." ".$colaborador->apaterno." ".$colaborador->amaterno);
            	$sheet->setCellValue("E".$i,$colaborador->fecnacimiento);
            	$sheet->setCellValue("F".$i,$colaborador->sexo);
            	$sheet->getStyle('F'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("G".$i,$colaborador->idecivil);
            	$sheet->getStyle('G'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("H".$i,$colaborador->nacionalidad);
            	$sheet->getStyle('H'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("I".$i,$colaborador->direccion);
            	$sheet->getStyle('I'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("J".$i,$colaborador->idregion);
            	$sheet->getStyle('J'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("K".$i,$colaborador->idcomuna);
            	$sheet->setCellValue("L".$i,$colaborador->fono);
            	$sheet->setCellValue("M".$i,$colaborador->email);
            	$sheet->setCellValue("N".$i,$colaborador->fecingreso);
            	$sheet->setCellValue("O".$i,$colaborador->idcargo);
            	$sheet->getStyle('O'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("P".$i,$colaborador->tipocontrato);
            	$sheet->setCellValue("Q".$i,$colaborador->parttime);
            	$sheet->getStyle('Q'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("R".$i,$colaborador->segcesantia);
            	$sheet->getStyle('R'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("S".$i,$colaborador->pensionado);
            	$sheet->getStyle('S'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("T".$i,$colaborador->diastrabajo);
            	$sheet->getStyle('T'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("U".$i,$colaborador->horasdiarias);
            	$sheet->getStyle('U'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("V".$i,$colaborador->horassemanales);
            	$sheet->getStyle('V'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("W".$i,$colaborador->sueldobase);
            	$sheet->getStyle('W'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("X".$i,$colaborador->tipogratificacion);
            	$sheet->getStyle('X'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("Y".$i,$colaborador->gratificacion);
            	$sheet->getStyle('Y'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("Z".$i,$colaborador->asigfamiliar);
            	$sheet->getStyle('Z'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	
            	$sheet->setCellValue("AA".$i,$colaborador->cargassimples);
            	$sheet->getStyle('AA'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AB".$i,$colaborador->cargasinvalidas);
            	$sheet->getStyle('AB'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AC".$i,$colaborador->cargasmaternales);
            	$sheet->getStyle('AC'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AD".$i,$colaborador->cargasretroactivas);
            	$sheet->getStyle('AD'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AE".$i,$colaborador->idasigfamiliar);
            	$sheet->getStyle('AE'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AF".$i,$colaborador->movilizacion);
            	$sheet->getStyle('AF'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("AG".$i,$colaborador->colacion);
            	$sheet->getStyle('AG'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AH".$i,$colaborador->idafp);
            	$sheet->getStyle('AH'.$i)->getNumberFormat()->setFormatCode('#,##0');  
            	$sheet->setCellValue("AI".$i,$colaborador->adicafp);
            	$sheet->getStyle('AI'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AJ".$i,$colaborador->tipoahorrovol);
            	$sheet->getStyle('AJ'.$i)->getNumberFormat()->setFormatCode('#,##0');  
            	$sheet->setCellValue("AK".$i,$colaborador->ahorrovol);
            	$sheet->getStyle('AK'.$i)->getNumberFormat()->setFormatCode('#,##0');    
            	$sheet->setCellValue("AL".$i,$colaborador->tipocotapv);
            	$sheet->getStyle('AL'.$i)->getNumberFormat()->setFormatCode('#,##0');  
            	$sheet->setCellValue("AM".$i,$colaborador->cotapv);
            	$sheet->getStyle('AM'.$i)->getNumberFormat()->setFormatCode('#,##0');  
            	$sheet->setCellValue("AN".$i,$colaborador->idisapre);
            	$sheet->getStyle('AN'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("AO".$i,$colaborador->valorpactado);
            	$sheet->getStyle('AO'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AP".$i,$colaborador->idnacionalidad);
            	$sheet->setCellValue("AQ".$i,$colaborador->bonos_fijos);
            	$sheet->getStyle('AQ'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("AR".$i,$colaborador->fecafc);
            	$sheet->getStyle('AR'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AS".$i,$colaborador->meses_vac);
            	$sheet->getStyle('AS'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AT".$i,$colaborador->fecinicvacaciones);
            	$sheet->getStyle('AT'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AU".$i,$colaborador->saldoinicvacaciones);
            	$sheet->getStyle('AU'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AV".$i,$colaborador->diasvactomados);
            	$sheet->getStyle('AV'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AW".$i,$colaborador->diasprogresivos);
            	$sheet->getStyle('AW'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AX".$i,$colaborador->diasvactomados);
            	$sheet->getStyle('AX'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("AY".$i,$colaborador->saldoinicvacprog);
            	$sheet->getStyle('AY'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AZ".$i,$colaborador->idcentrocosto);
            	$sheet->getStyle('AZ'.$i)->getNumberFormat()->setFormatCode('#,##0'); 




            	$sheet->setCellValue("BA".$i,$colaborador->tallapolera);
            	$sheet->getStyle('BA'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("BB".$i,$colaborador->tallapantalon);
            	$sheet->getStyle('BB'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("BC".$i,$colaborador->titulo);
            	$sheet->getStyle('BC'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("BD".$i,$colaborador->idlicencia);
            	$sheet->getStyle('BD'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("BE".$i,$colaborador->idestudio);
            	$sheet->getStyle('BE'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("BF".$i,$colaborador->instapv);
            	$sheet->getStyle('BF'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BG".$i,$colaborador->nrocontratoapv);
            	$sheet->getStyle('BG'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BH".$i,$colaborador->jubilado);
            	$sheet->getStyle('BH'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BI".$i,$colaborador->sindicato);
            	$sheet->getStyle('BI'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BJ".$i,$colaborador->rol_privado);
            	$sheet->getStyle('BJ'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BK".$i,$colaborador->id_lugar_pago);
            	$sheet->getStyle('BK'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BL".$i,$colaborador->id_categoria);
            	$sheet->getStyle('BL'.$i)->getNumberFormat()->setFormatCode('#,##0');        
            	$sheet->setCellValue("BM".$i,$colaborador->semana_corrida);
            	$sheet->getStyle('BM'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BN".$i,$colaborador->tiporenta);
            	$sheet->getStyle('BN'.$i)->getNumberFormat()->setFormatCode('#,##0');  
            	$sheet->setCellValue("BO".$i,$colaborador->ididioma);
            	$sheet->getStyle('BO'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BP".$i,$colaborador->numficha);
            	$sheet->getStyle('BP'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BQ".$i,$colaborador->fecafp);
            	$sheet->getStyle('BQ'.$i)->getNumberFormat()->setFormatCode('#,##0');

            	$sheet->setCellValue("BR".$i,$colaborador->idbanco);
            	$sheet->getStyle('BR'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("BS".$i,$colaborador->id_forma_pago);
            	$sheet->getStyle('BS'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("BT".$i,$colaborador->nrocuentabanco);
            	$sheet->getStyle('BT'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("BU".$i,$colaborador->tipodocumento);
            	$sheet->getStyle('BU'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BV".$i,$colaborador->cbeneficio);
            	$sheet->getStyle('BV'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BW".$i,$colaborador->fecha_retiro);
            	$sheet->getStyle('BW'.$i)->getNumberFormat()->setFormatCode('#,##0');  

            	$sheet->setCellValue("BX".$i,$colaborador->fecha_finiquito);
            	$sheet->getStyle('BX'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BY".$i,$colaborador->id_motivo_egreso);
            	$sheet->getStyle('BY'.$i)->getNumberFormat()->setFormatCode('#,##0');

            	$sheet->setCellValue("BZ".$i,$colaborador->id_tipocc);
            	$sheet->getStyle('BZ'.$i)->getNumberFormat()->setFormatCode('#,##0');

            	$sheet->setCellValue("CA".$i,$colaborador->id_seccion);
            	$sheet->getStyle('CA'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CB".$i,$colaborador->id_situacion);
            	$sheet->getStyle('CB'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("CC".$i,$colaborador->id_clase);
            	$sheet->getStyle('CC'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("CD".$i,$colaborador->id_ine);
            	$sheet->getStyle('CD'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CE".$i,$colaborador->id_zona);
            	$sheet->getStyle('CE'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CF".$i,$colaborador->fecrealcontrato);
            	$sheet->getStyle('CF'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CG".$i,$colaborador->primervenc);
            	$sheet->getStyle('CG'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CH".$i,$colaborador->fun);
            	$sheet->getStyle('CH'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CI".$i,$colaborador->fecvencplan);
            	$sheet->getStyle('CI'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CJ".$i,$colaborador->fecapvc);
            	$sheet->getStyle('CJ'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CK".$i,$colaborador->fectermsubsidio);
            	$sheet->getStyle('CK'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CL".$i,$colaborador->rut_pago);
            	$sheet->getStyle('CL'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CM".$i,$colaborador->dv_pago);
            	$sheet->getStyle('CM'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CN".$i,$colaborador->nombre_pago);
            	$sheet->getStyle('CN'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CO".$i,$colaborador->email_pago);
            	$sheet->getStyle('CO'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CP".$i,$colaborador->usuario_windows);
            	$sheet->getStyle('CP'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CQ".$i,$colaborador->idjefe);
            	$sheet->getStyle('CQ'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CR".$i,$colaborador->idreemplazo);
            	$sheet->getStyle('CR'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("CS".$i,$colaborador->formapagoapv);
            	$sheet->getStyle('CS'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CT".$i,$colaborador->regimenapv);
            	$sheet->getStyle('CT'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CU".$i,$colaborador->trabajo_pesado);
            	$sheet->getStyle('CU'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CV".$i,$colaborador->plazo_contrato);
            	$sheet->getStyle('CV'.$i)->getNumberFormat()->setFormatCode('#,##0');       

 	            	            	

	 			if($i % 2 != 0){
	 				//echo "consulta 4: -- i : ".$i. "  -- mod : ". ($i % 2)."<br>";
					$sheet->getStyle("B".$i.":".ordenLetrasExcel($columnaFinal).$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
					$sheet->getStyle("B".$i.":".ordenLetrasExcel($columnaFinal).$i)->getFill()->getStartColor()->setRGB('F7F9FD');	  				
	 			}	            	
            	$i++;
            	$linea++;
              }
             $i--;



			         	
			$sheet->getStyle("B" . $filaInicio . ":".ordenLetrasExcel($columnaFinal).$i)->getFont()->setSize(10);

			/*************************todos los bordes internos *************************************/
			$sheet->getStyle("B".$filaInicio.":".ordenLetrasExcel($columnaFinal).$i)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


			/*************************bordes cuadro principal (externo) *************************************/
					for($j=1;$j<=$columnaFinal;$j++){ //borde superior
						$sheet->getStyle(ordenLetrasExcel($j).$filaInicio)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
					}
			
					for($j=1;$j<=$columnaFinal;$j++){ //borde inferior
						$sheet->getStyle(ordenLetrasExcel($j).$i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
					}
			
					for($n=$filaInicio;$n<=$i;$n++){ //borde izquierdo
						$sheet->getStyle("B".$n)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
					}
			
					for($n=$filaInicio;$n<=$i;$n++){ //borde derecho
						$sheet->getStyle(ordenLetrasExcel($columnaFinal).$n)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
					}
			
			/**********************************************************************************************************/			        
				

			/***************************** Segundo borde superior********************************************************/
			
					for($j=1;$j<=$columnaFinal;$j++){ //borde inferior
						$sheet->getStyle(ordenLetrasExcel($j).$filaInicio)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
					}
			
			/******************************************************************************************************/
			

		/***************************** Penultimo borde izquierdo ********************************************************/
			
					for($n=$filaInicio;$n<=$i;$n++){ //borde derecho
						$sheet->getStyle("B".$n)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
					}
			
		/******************************************************************************************************/			



		/***************************** Penultimo borde derecho ********************************************************/
			
					for($n=$filaInicio;$n<=$i;$n++){ //borde derecho
						$sheet->getStyle(ordenLetrasExcel($columnaFinal).$n)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
					}
			
		/******************************************************************************************************/			

			/***************************** Color fila superior********************************************************/
			
					for($j=1;$j<=$columnaFinal;$j++){ //color fondo inferior
						$sheet->getStyle(ordenLetrasExcel($j).$filaInicio)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
						$sheet->getStyle(ordenLetrasExcel($j).$filaInicio)->getFill()->getStartColor()->setRGB('E8EDFF');
					}
			
			/******************************************************************************************************/


		/***************************** Color primera columna ********************************************************/
						$sheet->getStyle("B".$filaInicio.":B".$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
						$sheet->getStyle("B".$filaInicio.":B".$i)->getFill()->getStartColor()->setRGB('E8EDFF');
			
			/******************************************************************************************************/


		/***************************** Color montos ********************************************************/

					/*	$sheet->getStyle("Q".$filaInicio.":Q".$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
						$sheet->getStyle("Q".$filaInicio.":Q".$i)->getFill()->getStartColor()->setRGB('E8EDFF');
	
						$sheet->getStyle("AC".$filaInicio.":AC".$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
						$sheet->getStyle("AC".$filaInicio.":AC".$i)->getFill()->getStartColor()->setRGB('E8EDFF');	

						$sheet->getStyle("AI".$filaInicio.":AI".$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
						$sheet->getStyle("AI".$filaInicio.":AI".$i)->getFill()->getStartColor()->setRGB('E8EDFF');									
						$sheet->getStyle("AJ".$filaInicio.":AJ".$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
						$sheet->getStyle("AJ".$filaInicio.":AJ".$i)->getFill()->getStartColor()->setRGB('E8EDFF');	


						$sheet->getStyle("CU".$filaInicio.":CU".$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
						$sheet->getStyle("CU".$filaInicio.":CU".$i)->getFill()->getStartColor()->setRGB('E8EDFF');	*/										
			/******************************************************************************************************/


			$sheet->setSelectedCells('E1'); //celda seleccionada



	        header("Content-Type: application/vnd.ms-excel");
	        $nombreArchivo = 'libro_colaboradores';
	        header("Content-Disposition: attachment; filename=\"$nombreArchivo.xls\"");
	        header("Cache-Control: max-age=0");
	        // Genera Excel
	        $writer = new PHPExcel_Writer_Excel5($this->phpexcel); //objeto de PHPExcel, para escribir en el excel
	        //$writer = new PHPExcel_Writer_Excel2007($this->phpexcel); //objeto de PHPExcel, para escribir en el excel
	        // Escribir
	        //$writer->setIncludeCharts(TRUE);			
	        $writer->save('php://output');
	        echo "hhhh";
	        exit;			
	}		








public function get_remuneraciones_by_id($idremuneracion){
		$periodo_data = $this->db->select('r.id_remuneracion, r.id_periodo, pe.id_personal as idtrabajador, p.mes, p.anno, pe.nombre, pe.apaterno, pe.amaterno, pe.fecingreso as fecingreso, pe.rut, pe.dv, i.nombre as prev_salud, pe.idisapre, pe.valorpactado, c.nombre as cargo, a.nombre as afp, a.porc, r.sueldobase, r.gratificacion, r.bonosimponibles, r.valorhorasextras50, r.montohorasextras50, r.valorhorasextras100, r.montohorasextras100, r.aguinaldo, r.aguinaldobruto, r.diastrabajo, r.totalhaberes, r.totaldescuentos, r.sueldoliquido, r.horasextras50, r.horasextras100, r.horasdescuento, pe.cargassimples, pe.cargasinvalidas, pe.cargasmaternales, pe.cargasretroactivas, r.sueldoimponible, r.movilizacion, r.colacion, r.bonosnoimponibles, r.asigfamiliar, r.totalhaberes, r.cotizacionobligatoria, r.comisionafp, r.adicafp, r.segcesantia, r.cotizacionsalud, r.fonasa, r.inp, r.adicisapre, r.cotadicisapre, r.adicsalud, r.impuesto, r.montoahorrovol, r.montocotapv, r.anticipo, r.montodescuento, pr.cierre, r.semana_corrida,  r.sueldonoimponible, r.totalleyessociales, r.otrosdescuentos, r.descuentosnolegales, r.descuentos, r.prestamos, pr.id_periodo, pr.cierre, pr.aprueba, f.tramo, r.totaldescuentoslegales, r.basetributaria')
						  ->from('rem_periodo as p')
						  ->join('rem_remuneracion as r','r.id_periodo = p.id_periodo')
						  ->join('rem_personal as pe','pe.id_personal = r.idpersonal')
						  ->join('rem_periodo_remuneracion as pr','r.id_periodo = pr.id_periodo and pr.id_empresa = ' . $this->session->userdata('empresaid') . ' and pe.idcentrocosto = pr.id_centro_costo')
						  ->join('rem_isapre as i','pe.idisapre = i.id_isapre')
						  ->join('rem_cargos as c','pe.idcargo = c.id_cargos','left')
						  ->join('rem_afp as a','pe.idafp = a.id_afp')
						  ->join('rem_tabla_asig_familiar as f','pe.idasigfamiliar = f.id_tabla_asig_familiar','left')
		                  ->where('pe.id_empresa', $this->session->userdata('empresaid'))
		                  ->where('r.id_remuneracion', $idremuneracion);

		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		return $query->row();


	}	

	public function get_remuneraciones_by_colaborador_2($idremuneracion){
		$periodo_data = $this->db->select('r.id_remuneracion, r.id_periodo, pe.id_personal as idtrabajador, p.mes, p.anno, pe.nombre, pe.apaterno, pe.amaterno, pe.fecingreso as fecingreso, pe.rut, pe.dv, i.nombre as prev_salud, pe.idisapre, pe.valorpactado, c.nombre as cargo, a.nombre as afp, a.porc, r.sueldobase, r.gratificacion, r.bonosimponibles, r.valorhorasextras50, r.montohorasextras50, r.valorhorasextras100, r.montohorasextras100, r.aguinaldo, r.aguinaldobruto, r.diastrabajo, r.totalhaberes, r.totaldescuentos, r.sueldoliquido, r.horasextras50, r.horasextras100, r.horasdescuento, pe.cargassimples, pe.cargasinvalidas, pe.cargasmaternales, pe.cargasretroactivas, r.sueldoimponible, r.movilizacion, r.colacion, r.bonosnoimponibles, r.asigfamiliar, r.totalhaberes, r.cotizacionobligatoria, r.comisionafp, r.adicafp, r.segcesantia, r.cotizacionsalud, r.fonasa, r.inp, r.adicisapre, r.cotadicisapre, r.adicsalud, r.impuesto, r.montoahorrovol, r.montocotapv, r.anticipo, r.montodescuento, pr.cierre, r.semana_corrida,  r.sueldonoimponible, r.totalleyessociales, r.otrosdescuentos, r.descuentosnolegales, r.descuentos, r.prestamos, pr.id_periodo, pr.cierre, pr.aprueba')
						  ->from('rem_periodo as p')
						  ->join('rem_remuneracion as r','r.id_periodo = p.id_periodo')
						  ->join('rem_personal as pe','pe.id_personal = r.idpersonal')
						  ->join('rem_periodo_remuneracion as pr','r.id_periodo = pr.id_periodo and pr.id_empresa = 117')
						  ->join('rem_isapre as i','pe.idisapre = i.id_isapre')
						  ->join('rem_cargos as c','pe.idcargo = c.id_cargos')
						  ->join('rem_afp as a','pe.idafp = a.id_afp')
		                  ->where('pe.id_empresa', 117)
		                  ->where('r.id_remuneracion', $idremuneracion);

		$query = $this->db->get();
		return $query->row();


	}

	private function get_pdf_content($idremuneracion){

		$this->db->select('pdf_content ')
						  ->from('rem_remuneracion ')
						  ->where('id_remuneracion',$idremuneracion);
		$query = $this->db->get();
		return $query->row();
	}


	public function liquidaciones($datos_remuneraciones){
			//echo count($datos_remuneraciones); exit;
		
			$this->load->model('admin');
			$datos_empresa = $this->admin->datos_empresa($this->session->userdata('empresaid'));


			//Variable para PDF 		

			$mpdf = new \Mpdf\Mpdf(['default_font_size' => 7,
									'margin-top' => 16,
									'margin-bottom' => 16,
									'margin-header' => 9,
									'margin-footer' => 9,
									'margin-left' => 10,
									'margin-right' => 5,
									]);
		//	$mpdf->orientation = "L";
				//$this->load->library("Mpdf");
			/*$this->mpdf->Mpdf(
				'',    // mode - default ''
				'',    // format - A4, for example, default ''
				8,     // font size - default 0
				'',    // default font family
				10,    // margin_left
				5,    // margin right
				16,    // margin top
				16,    // margin bottom
				9,     // margin header
				9,     // margin footer
				'L'    // L - landscape, P - portrait
				);
			  */
	
			//echo $html; exit;
			$mpdf->SetTitle('Is RRHH - Liquidación de Sueldos');
			$mpdf->SetHeader('Empresa '. $datos_empresa->nombre . ' - ' .$datos_empresa->comuna . ' - RUT: ' .number_format($datos_empresa->rut,0,".",".") . '-' .$datos_empresa->dv);
			$mpdf->SetFooter('http://www.arnou.cl');
			$cantidad = count($datos_remuneraciones);
			$i = 0;

			foreach ($datos_remuneraciones as $datos_remuneracion) {

					//var_dump_new($datos_remuneracion); exit;
					$content = $this->get_pdf_content($datos_remuneracion->id_remuneracion);

					if($content->pdf_content == ''){ // EN CASO QUE POR ALGUN MOTIVO FALLARA LA EJECUCION INICIAL, SE CREA AHORA
						$this->generar_contenido_comprobante($datos_remuneracion);
						$content = $this->get_pdf_content($datos_remuneracion->id_remuneracion);
					}

					$mpdf->WriteHTML($content->pdf_content);
				   if(is_null($datos_remuneracion->aprueba)){
						$mpdf->SetWatermarkText('BORRADOR');
						$mpdf->watermark_font = 'DejaVuSansCondensed';
						$mpdf->showWatermarkText = true;
					}					
					$i++;

					if($i < $cantidad){
						$mpdf->AddPage();
					}					

			}


			$nombre_archivo = date("Y")."_".date("m")."_".date("d")."_sueldos_total.pdf";
			$mpdf->Output($nombre_archivo, "I");
			
	}


	public function liquidacion($datos_remuneracion){

			//var_dump_new($datos_remuneracion); exit;
			$this->load->model('admin');
			$datos_empresa = $this->admin->datos_empresa($this->session->userdata('empresaid'));
			$content = $this->get_pdf_content($datos_remuneracion->id_remuneracion);
			
			$datos_periodo = $this->admin->get_periodo_by_id($datos_remuneracion->id_periodo);





			//if($content->pdf_content == ''){ // EN CASO QUE POR ALGUN MOTIVO FALLARA LA EJECUCION INICIAL, SE CREA AHORA
				$this->generar_contenido_comprobante($datos_remuneracion);
				$content = $this->get_pdf_content($datos_remuneracion->id_remuneracion);
			//}

			//Variable para PDF 		

			$mpdf = new \Mpdf\Mpdf(['default_font_size' => 7,
									'margin-top' => 16,
									'margin-bottom' => 16,
									'margin-header' => 9,
									'margin-footer' => 9,
									'margin-left' => 10,
									'margin-right' => 5,
									]);
		//	$mpdf->orientation = "L";
				//$this->load->library("Mpdf");
			/*$this->mpdf->Mpdf(
				'',    // mode - default ''
				'',    // format - A4, for example, default ''
				8,     // font size - default 0
				'',    // default font family
				10,    // margin_left
				5,    // margin right
				16,    // margin top
				16,    // margin bottom
				9,     // margin header
				9,     // margin footer
				'L'    // L - landscape, P - portrait
				);
			  */
	
			//echo $html; exit;
			$mpdf->SetTitle('Is RRHH - Liquidación de Sueldos');
			$mpdf->SetHeader('Empresa '. $datos_empresa->nombre . ' - ' .$datos_empresa->comuna . ' - RUT: ' .number_format($datos_empresa->rut,0,".",".") . '-' .$datos_empresa->dv);
			$mpdf->SetFooter('http://www.arnou.cl');
			$mpdf->WriteHTML($content->pdf_content);

			if(is_null($datos_remuneracion->aprueba)){
				$mpdf->SetWatermarkText('BORRADOR');
				$mpdf->watermark_font = 'DejaVuSansCondensed';
				$mpdf->showWatermarkText = true;
			}

			$nombre_archivo = date("Y")."_".date("m")."_".date("d")."_sueldos_".$datos_remuneracion->id.".pdf";
			$mpdf->Output($nombre_archivo, "I");
			
	}	



	public function imprime_documentos_colaborador($documento){

			//var_dump_new($documento[0]); exit;
			$this->load->model('admin');
			$datos_empresa = $this->admin->datos_empresa($this->session->userdata('empresaid'));
			$content = $documento[0];
		

			/*if($content->pdf_content == ''){ // EN CASO QUE POR ALGUN MOTIVO FALLARA LA EJECUCION INICIAL, SE CREA AHORA
				$this->generar_contenido_comprobante($datos_remuneracion);
				$content = $this->get_pdf_content($datos_remuneracion->id_remuneracion);
			}*/

			//Variable para PDF 		

			$mpdf = new \Mpdf\Mpdf(['default_font_size' => 11,
									'margin-top' => 16,
									'margin-bottom' => 16,
									'margin-header' => 9,
									'margin-footer' => 9,
									'margin-left' => 10,
									'margin-right' => 5,
									]);
		//	$mpdf->orientation = "L";
				//$this->load->library("Mpdf");
			/*$this->mpdf->Mpdf(
				'',    // mode - default ''
				'',    // format - A4, for example, default ''
				8,     // font size - default 0
				'',    // default font family
				10,    // margin_left
				5,    // margin right
				16,    // margin top
				16,    // margin bottom
				9,     // margin header
				9,     // margin footer
				'L'    // L - landscape, P - portrait
				);
			  */
	
			//echo $html; exit;
			$mpdf->SetTitle('Arnou RRHH - Documento Colaborador');
			$mpdf->SetHeader('Empresa '. $datos_empresa->nombre . ' - ' .$datos_empresa->comuna . ' - RUT: ' .number_format($datos_empresa->rut,0,".",".") . '-' .$datos_empresa->dv);
			$mpdf->SetFooter('http://www.arnou.cl');
			$mpdf->WriteHTML($content->pdf_content);


			$nombre_archivo = date("Y")."_".date("m")."_".date("d")."_doctocolaborador_".$content->id_personal.".pdf";
			$mpdf->Output($nombre_archivo, "I");
			
	}		

	public function generar_contrato($personal,$tipo,$fecha,$idtrabajador){	
	
	       	$this->db->select('id_formato_doc_colaborador,formato_pdf')
									->from('rem_formato_doc_colaborador')
									->where('id_tipo_doc_colaborador',$tipo)
									->where('id_empresa',$this->session->userdata('empresaid'));

			$query = $this->db->get();
			$result = $query->row();			

			$direccionsucursal="Américo Vespucio N º 727";
			$nombrereemplazado="POR DEFINIR";
			$nombrecolaborador=$personal->nombre." ".$personal->apaterno." ".$personal->amaterno;

			$rut =$personal->rut."-".$personal->dv;

			//print_r($nombrecolaborador);

			//exit;

			$html_pdf = $result->formato_pdf;
			$tipo_formato = $result->id_formato_doc_colaborador;

			$html_pdf = str_replace("NOMBRECOLABORADOR",$nombrecolaborador,$html_pdf);
			$html_pdf = str_replace("FECHACONTRATO",$fecha,$html_pdf);
			$html_pdf = str_replace("NACIONALIDAD",$personal->nacionalidad,$html_pdf);	
			$html_pdf = str_replace("RUTCOLABORADOR",$rut,$html_pdf);
			$html_pdf = str_replace("ESTADOCIVIL",$personal->idecivil,$html_pdf);
			$html_pdf = str_replace("FECHANACIMIENTO",$personal->fecnacimiento,$html_pdf);
			$html_pdf = str_replace("DIRECCION",$personal->direccion,$html_pdf);
			$html_pdf = str_replace("DIRECCIONSUCURSAL",$direccionsucursal,$html_pdf);

			//$html_pdf = str_replace("@nombreremplazado",$nombreremplazado,$html_pdf);


			$valorenletras = valorenletras($personal->sueldobase);

			$html_pdf = str_replace("SUELDOBASE",$personal->sueldobase,$html_pdf);
			$html_pdf = str_replace("FECHAINGRESO",$personal->fecingreso,$html_pdf);
			$html_pdf = str_replace("VALORENLETRAS",$valorenletras,$html_pdf);
		
			$this->load->library("mpdf");
			$this->mpdf->mPDF(
				'',    // mode - default ''
				'',    // format - A4, for example, default ''
				8,     // font size - default 0
				'',    // default font family
				10,    // margin_left
				5,    // margin right
				16,    // margin top
				16,    // margin bottom
				9,     // margin header
				9,     // margin footer
				'L'    // L - landscape, P - portrait
				);
			  
	
			//echo $html; exit;
			$this->mpdf->SetTitle('Is RRHH - Contrato de Trabajo');
			//$this->mpdf->SetHeader('Empresa '. $datos_empresa->nombre . ' - ' .$datos_empresa->comuna . ' - RUT: ' .number_format($datos_empresa->rut,0,".",".") . '-' .$datos_empresa->dv);
			$this->mpdf->WriteHTML($html_pdf);

			// SE ALMACENA EL ARCHIVO
			$nombre_archivo = date("Y")."_".date("m")."_".date("d")."_contrato_".$rut.".pdf";

			$this->mpdf->Output($nombre_archivo, "I");
			
			$array_contrato = array(
				'pdf_documento_colaborador' => $html_pdf,
				'id_personal' => $idtrabajador,
				'id_empresa' => $this->session->userdata('empresaid'),
				'id_tipo_doc_colaborador' => $tipo,
				'id_formato_doc_colaborador' => $tipo_formato,
				'created_by' => $fecha,	
				'created_at' => date('Ymd H:i:s'),
				'updated_at' => date('Ymd H:i:s')
			);			

			$this->db->insert('rem_doc_colaborador',$array_contrato);	

			
	}

	public function generar_carta($personal,$tipo,$fecha,$idtrabajador){	
	
	       	$this->db->select('id_formato_doc_colaborador,formato_pdf')
									->from('rem_formato_doc_colaborador')
									->where('id_tipo_doc_colaborador',$tipo)
									->where('id_empresa',$this->session->userdata('empresaid'));

			$query = $this->db->get();
			$result = $query->row();			

			$direccionsucursal="Américo Vespucio N º 727";
			$nombrereemplazado="POR DEFINIR";
			$nombrecolaborador=$personal->nombre." ".$personal->apaterno." ".$personal->amaterno;

			$rut =$personal->rut."-".$personal->dv;

			
			$html_pdf = $result->formato_pdf;
			$tipo_formato = $result->id_formato_doc_colaborador;

			$html_pdf = str_replace("NOMBRECOLABORADOR",$nombrecolaborador,$html_pdf);
			$html_pdf = str_replace("FECHAEMISION",$fecha,$html_pdf);
			$html_pdf = str_replace("RUTCOLABORADOR",$rut,$html_pdf);
			$html_pdf = str_replace("DIRECCIONCOLABORADOR",$personal->direccion,$html_pdf);
			$html_pdf = str_replace("FECHATERMINO",$fecha,$html_pdf);

			
			$this->load->library("mpdf");
			$this->mpdf->mPDF(
				'',    // mode - default ''
				'',    // format - A4, for example, default ''
				8,     // font size - default 0
				'',    // default font family
				10,    // margin_left
				5,    // margin right
				16,    // margin top
				16,    // margin bottom
				9,     // margin header
				9,     // margin footer
				'L'    // L - landscape, P - portrait
				);
			  
	
			//echo $html; exit;
			$this->mpdf->SetTitle('Is RRHH - Contrato de Trabajo');
			//$this->mpdf->SetHeader('Empresa '. $datos_empresa->nombre . ' - ' .$datos_empresa->comuna . ' - RUT: ' .number_format($datos_empresa->rut,0,".",".") . '-' .$datos_empresa->dv);
			$this->mpdf->WriteHTML($html_pdf);

			// SE ALMACENA EL ARCHIVO
			$nombre_archivo = date("Y")."_".date("m")."_".date("d")."_contrato_".$rut.".pdf";

			$this->mpdf->Output($nombre_archivo, "I");
			
			$array_contrato = array(
				'pdf_documento_colaborador' => $html_pdf,
				'id_personal' => $idtrabajador,
				'id_empresa' => $this->session->userdata('empresaid'),
				'id_tipo_doc_colaborador' => $tipo,
				'id_formato_doc_colaborador' => $tipo_formato,
				'created_by' => $fecha,	
				'created_at' => date('Ymd H:i:s'),
				'updated_at' => date('Ymd H:i:s')
			);			

			$this->db->insert('rem_doc_colaborador',$array_contrato);	

			
	}

	public function generar_contrato_personal($tipo){
	
	    	
	       	$this->db->select('pdf_documento_colaborador')
									->from('rem_doc_colaborador')
									->where('id_doc_colaborador',$tipo)
									->where('id_empresa',$this->session->userdata('empresaid'));

			$query = $this->db->get();
			$result = $query->row();			
			//print_r($nombrecolaborador);

			//exit;

			$html_pdf = $result->pdf_documento_colaborador;
			
			$this->load->library("mpdf");
			$this->mpdf->mPDF(
				'',    // mode - default ''
				'',    // format - A4, for example, default ''
				8,     // font size - default 0
				'',    // default font family
				10,    // margin_left
				5,    // margin right
				16,    // margin top
				16,    // margin bottom
				9,     // margin header
				9,     // margin footer
				'L'    // L - landscape, P - portrait
				);
			  
	
			//echo $html; exit;
			$this->mpdf->SetTitle('Is RRHH - Contrato de Trabajo');
			//$this->mpdf->SetHeader('Empresa '. $datos_empresa->nombre . ' - ' .$datos_empresa->comuna . ' - RUT: ' .number_format($datos_empresa->rut,0,".",".") . '-' .$datos_empresa->dv);
			$this->mpdf->WriteHTML($html_pdf);

			// SE ALMACENA EL ARCHIVO
			$nombre_archivo = date("Y")."_".date("m")."_".date("d")."_contrato_".$rut.".pdf";

			$this->mpdf->Output($nombre_archivo, "I");
			
			
			
	}

	public function generar_carta_personal($tipo){
	
	    	
	       	$this->db->select('pdf_documento_colaborador')
									->from('rem_doc_colaborador')
									->where('id_doc_colaborador',$tipo)
									->where('id_empresa',$this->session->userdata('empresaid'));

			$query = $this->db->get();
			$result = $query->row();			
			//print_r($nombrecolaborador);

			//exit;

			$html_pdf = $result->pdf_documento_colaborador;
			
			$this->load->library("mpdf");
			$this->mpdf->mPDF(
				'',    // mode - default ''
				'',    // format - A4, for example, default ''
				8,     // font size - default 0
				'',    // default font family
				10,    // margin_left
				5,    // margin right
				16,    // margin top
				16,    // margin bottom
				9,     // margin header
				9,     // margin footer
				'L'    // L - landscape, P - portrait
				);
			  
	
			//echo $html; exit;
			$this->mpdf->SetTitle('Is RRHH - Contrato de Trabajo');
			//$this->mpdf->SetHeader('Empresa '. $datos_empresa->nombre . ' - ' .$datos_empresa->comuna . ' - RUT: ' .number_format($datos_empresa->rut,0,".",".") . '-' .$datos_empresa->dv);
			$this->mpdf->WriteHTML($html_pdf);

			// SE ALMACENA EL ARCHIVO
			$nombre_archivo = date("Y")."_".date("m")."_".date("d")."_contrato_".$rut.".pdf";

			$this->mpdf->Output($nombre_archivo, "I");
			
			
			
	}

	public function generar_tipo_documento($tipo){
	
	    	
	       	$this->db->select('id_formato_doc_colaborador,formato_pdf')
									->from('rem_formato_doc_colaborador')
									->where('id_formato_doc_colaborador',$tipo)
									->where('id_empresa',$this->session->userdata('empresaid'));

			$query = $this->db->get();
			$result = $query->row();						
			//print_r($nombrecolaborador);

			//exit;

			$html_pdf = $result->formato_pdf;
			
			$this->load->library("mpdf");
			$this->mpdf->mPDF(
				'',    // mode - default ''
				'',    // format - A4, for example, default ''
				8,     // font size - default 0
				'',    // default font family
				10,    // margin_left
				5,    // margin right
				16,    // margin top
				16,    // margin bottom
				9,     // margin header
				9,     // margin footer
				'L'    // L - landscape, P - portrait
				);
			  
	
			//echo $html; exit;
			$this->mpdf->SetTitle('Is RRHH - Documento Tipo');
			//$this->mpdf->SetHeader('Empresa '. $datos_empresa->nombre . ' - ' .$datos_empresa->comuna . ' - RUT: ' .number_format($datos_empresa->rut,0,".",".") . '-' .$datos_empresa->dv);
			$this->mpdf->WriteHTML($html_pdf);

			// SE ALMACENA EL ARCHIVO
			$nombre_archivo = date("Y")."_".date("m")."_".date("d")."_contrato_".$rut.".pdf";

			$this->mpdf->Output($nombre_archivo, "I");
			
			
			
	}


public function generar_contenido_comprobante($datos_remuneracion){


			$html = '<html>
					<head>
					<style type="text/css">
					.rounded {
					 border:0.1mm solid #220044;
					 background-color: #FAFAFA;
					 background-clip: border-box;
					 padding: 1em;
						}

					.recto {
					 border:0.1mm solid #000000;
					 background-color: #FAFAFA;
					 background-clip: border-box;
					 padding: 1em;
						}


					.tableClass { 
						background-color: #ffffff; 
						border-collapse: collapse;
						font-family: DejaVuSansCondensed;
						font-size: 9pt; 
						line-height: 1.2;
						margin-top: 2pt; 
						margin-bottom: 5pt; 
						width: 70%;
						topntail: 0.02cm solid #ffffff; 
					}

					.theadClass { 
						vertical-align: bottom; 
					}

					.tdClass { 
						padding-left: 4mm; 
						vertical-align: top; 
						text-align:left;
						padding-right: 4mm; 
						padding-top: 0.5mm; 
						padding-bottom: 0.5mm;
						border-top: 1px solid #FFFFFF; 
					}

					.tdClassCenter { 
						padding-left: 4mm; 
						vertical-align: top; 
						text-align:center;
						padding-right: 4mm; 
						padding-top: 0.5mm; 
						padding-bottom: 0.5mm;
						border-top: 1px solid #FFFFFF; 
					}					

					.tdClassNumber { 
						text-align:right;
					}

					.headerRow td, .headerRow th { 
						background-gradient: linear #E6B4AA #ffffff 0 1 0 0.2; 
						padding: 1mm; 
						text-align: left;
					}	

					.header4 { 
						font-weight: ; 
						font-size: 13pt; 
						color: #080636;
						font-family: DejaVuSansCondensed, sans-serif; 
						margin-top: 10pt; 
						margin-bottom: 7pt;
						text-align: center;
						margin-collapse:collapse; page-break-after:avoid; }										
					</style>
			</head>
					<body>';


			$monto_prevision = $datos_remuneracion->idisapre == 1 ? ' 7% ' : $datos_remuneracion->valorpactado . ' UF ';

			$titulo_fecha_contrato = $this->session->userdata('empresaid') == 140 ? '&nbsp;' : 'Fecha Contrato:';
			$dato_fecha_contrato = $this->session->userdata('empresaid') == 140 ? '&nbsp;' : $datos_remuneracion->fecingreso;
			
			$html .= '
						<p><h4 class="header4">Liquidaci&oacute;n de Remuneraciones ' . date2string($datos_remuneracion->mes,$datos_remuneracion->anno) . '<!--br><br><img src="img/logo4_1_80p_color.png" width="100px"--></h4></p>
						<hr>
						<br>
						<div class="recto">
						<table class="" width="100%"  >
						<thead class="theadClass">
						<tr class="headerRow">
						<th width="100%" colspan="4"><p>Datos Trabajador</p></th>
						</tr>
						</thead>
						<tbody>
						<tr>
						<td class="tdClass" ><b><i>Nombre:</i></b></td>
						<td class="tdClass" >' . $datos_remuneracion->nombre. ' ' . $datos_remuneracion->apaterno . ' ' . $datos_remuneracion->amaterno . '</td>
						<td class="tdClass" ><b><i>' . $titulo_fecha_contrato . '</i></b></td>
						<td class="tdClass" >' . $dato_fecha_contrato . '</td>						
						</tr>
						<tr>
						<td class="tdClass" ><b><i>Rut:</i></b></td>
						<td class="tdClass" >' . number_format($datos_remuneracion->rut,0,".","."). '-' . $datos_remuneracion->dv . '</td>
						<td class="tdClass" ><b><i>Previsi&oacute;n Salud:</i></b></td>
						<td class="tdClass" >' . $datos_remuneracion->prev_salud . ' ' . $monto_prevision . ' </td>						
						</tr>
						<tr>
						<td class="tdClass" ><b><i>Cargo:</i></b></td>
						<td class="tdClass" >' . $datos_remuneracion->cargo . '</td>
						<td class="tdClass" ><b><i>AFP:</i></b></td>
						<td class="tdClass" >' . $datos_remuneracion->afp . ' ' . $datos_remuneracion->porc . '% </td>						
						</tr>
						</tbody>
						</table>
						</div>
						<br>
						<div class="recto">
						<table class="" width="100%"  >
						<thead class="theadClass">
						<tr class="headerRow">
						<th width="100%" colspan="4"><p>Datos Complementarios</p></th>
						</tr>
						</thead>
						<tbody>
						<tr>
						<td class="tdClass" ><b><i>Nro. d&iacute;as trabajados:</i></b></td>
						<td class="tdClass" >' . $datos_remuneracion->diastrabajo . '</td>
						<td class="tdClass" ><b><i>Horas Extras 50%:</i></b></td>
						<td class="tdClass" >' . round($datos_remuneracion->horasextras50,1) . ' </td>					
						</tr>
						<tr>
						<td class="tdClass" ><b><i>Horas Descuento:</i></b></td>
						<td class="tdClass" >' . $datos_remuneracion->horasdescuento . ' </td>						
						<td class="tdClass" ><b><i>Horas Extras 100%:</i></b></td>
						<td class="tdClass" >' . round($datos_remuneracion->horasextras100,1) . ' </td>												
						</tr>
						<tr>
						<td class="tdClass" ><b><i>Num. Cargas Familiares:</i></b></td>
						<td class="tdClass" >' . round($datos_remuneracion->cargassimples+$datos_remuneracion->cargasmaternales,1) . ' </td>									
						<td class="tdClass" ><b><i>Tramo Asignaci&oacute;n Familiar:</i></b></td>
						<td class="tdClass" >' . $datos_remuneracion->tramo . ' </td>								
						</tr>

						</tbody>
						</table>
						</div>
						<br>
						<div class="recto">
						<table class="" width="100%"  >
						<thead class="theadClass">
						<tr class="headerRow">
						<th width="70%" ><p>Detalle Haberes</p></th>
						<th width="30%" ><p>&nbsp;</p></th>
						</tr>
						</thead>
						<tbody>';

						

						if($datos_remuneracion->sueldobase > 0){
							$html .= '<tr>
									<td class="tdClass" >Sueldo Base</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->sueldobase,0,".",".") . '</td>
									</tr>';
						}

						if($datos_remuneracion->gratificacion > 0){
							$html .= '<tr>
									<td class="tdClass" >Gratificaci&oacute;n Legal</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->gratificacion,0,".",".") . '</td>
									</tr>';
						}						


						$datos_hd = $this->get_bonos_by_remuneracion($datos_remuneracion->id_remuneracion,true,'HABER');

						//$datos_hd = $this->get_haberes_descuentos($datos_remuneracion->idtrabajador,true,'HABER',$datos_remuneracion->id_periodo);

						foreach ($datos_hd as $bono_imponible) {

							$html .= '<tr>
									<td class="tdClass" >' . $bono_imponible->descripcion . '</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($bono_imponible->monto,0,".",".") . '</td>
									</tr>';

						}


						if($datos_remuneracion->semana_corrida > 0){
							$html .= '<tr>
									<td class="tdClass" >Semana Corrida</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->semana_corrida,0,".",".") . '</td>
									</tr>';
						}						


						//$datos_bonos_imponibles = array();

						/*foreach ($datos_bonos_imponibles as $bono_imponible) {

							$html .= '<tr>
									<td class="tdClass" >' . $bono_imponible->descripcion . '</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($bono_imponible->monto,0,".",".") . '</td>
									</tr>';

						}*/

						/*if($datos_remuneracion->bonosimponibles > 0){
							$html .= '<tr>
									<td class="tdClass" >Bonos Imponibles</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->bonosimponibles,0,".",".") . '</td>
									</tr>';
						}*/												
						
						if($datos_remuneracion->montohorasextras50 > 0){
							$html .= '<tr>
									<td class="tdClass" >Horas Extras (50%)</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->montohorasextras50,0,".",".") . '</td>
									</tr>';
						}																		

						if($datos_remuneracion->montohorasextras100 > 0){
							$html .= '<tr>
									<td class="tdClass" >Horas Extras (100%)</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->montohorasextras100,0,".",".") . '</td>
									</tr>';
						}																								

						if($datos_remuneracion->aguinaldo > 0){
							$html .= '<tr>
									<td class="tdClass" >Aguinaldo</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->aguinaldobruto,0,".",".") . '</td>
									</tr>';
						}	

						if($datos_remuneracion->sueldoimponible > 0){
							$html .= '<tr>
									<td class="tdClass" ><b>Total Imponible</b></td>
									<td class="tdClass tdClassNumber" ><b>$ ' . number_format($datos_remuneracion->sueldoimponible,0,".",".") . '</b></td>
									</tr>';
						}

				$html .= '<tr>
						<td class="tdClass">&nbsp;</td>
						<td class="tdClass">&nbsp;</td>
						</tr>';

						if($datos_remuneracion->movilizacion > 0){
							$html .= '<tr>
									<td class="tdClass" >Movilizaci&oacute;n</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->movilizacion,0,".",".") . '</td>
									</tr>';
						}

						if($datos_remuneracion->colacion > 0){
							$html .= '<tr>
									<td class="tdClass" >Colaci&oacute;n</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->colacion,0,".",".") . '</td>
									</tr>';
						}


						if($datos_remuneracion->asigfamiliar > 0){
							$html .= '<tr>
									<td class="tdClass" >Asignaci&oacute;n Familiar</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->asigfamiliar,0,".",".") . '</td>
									</tr>';
						}

						/*if($datos_remuneracion->bonosnoimponibles > 0){
							$html .= '<tr>
									<td class="tdClass" >Bonos No Imponibles</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->bonosnoimponibles,0,".",".") . '</td>
									</tr>';
						}*/

						//$datos_bonos_no_imponibles = $this->get_bonos_by_remuneracion($datos_remuneracion->id,false);


						$datos_hd = $this->get_bonos_by_remuneracion($datos_remuneracion->id_remuneracion,false,'HABER');

						//$datos_hd = $this->get_haberes_descuentos($datos_remuneracion->idtrabajador,false,'HABER',$datos_remuneracion->id_periodo);

						foreach ($datos_hd as $bono_no_imponible) {

							$html .= '<tr>
									<td class="tdClass" >' . $bono_no_imponible->descripcion . '</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($bono_no_imponible->monto,0,".",".") . '</td>
									</tr>';

						}


						/*$datos_bonos_no_imponibles = array();

						foreach ($datos_bonos_no_imponibles as $bono_no_imponible) {

							$html .= '<tr>
									<td class="tdClass" >' . $bono_no_imponible->descripcion . '</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($bono_no_imponible->monto,0,".",".") . '</td>
									</tr>';

						}	*/											

						if($datos_remuneracion->sueldonoimponible > 0){
							$html .= '<tr>
									<td class="tdClass" ><b>Total No Imponible</b></td>
									<td class="tdClass tdClassNumber" ><b>$ ' . number_format($datos_remuneracion->sueldonoimponible,0,".",".") . '</b></td>
									</tr>';
						}


						if($datos_remuneracion->totalhaberes > 0){
							$html .= '<tr>
									<td class="tdClass" ><b>Total Haberes</b></td>
									<td class="tdClass tdClassNumber" ><b>$ ' . number_format($datos_remuneracion->totalhaberes,0,".",".") . '</b></td>
									</tr>';
						}

				$html.=	'</tbody>
						</table>
						</div>
						<br>
						<div class="recto">
						<table class="" width="100%"  >
						<thead class="theadClass">
						<tr class="headerRow">
						<th width="70%" ><p>Detalle Descuentos</p></th>
						<th width="30%" ><p>&nbsp;</p></th>
						</tr>
						</thead>
						<tbody>';

						if($datos_remuneracion->cotizacionobligatoria > 0){
							$html .= '<tr>
									<td class="tdClass" >Cotizaci&oacute;n AFP Obligatoria</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->cotizacionobligatoria,0,".",".") . '</td>
									</tr>';
						}

						if($datos_remuneracion->comisionafp > 0){
							$html .= '<tr>
									<td class="tdClass" >Comisi&oacute;n AFP</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->comisionafp,0,".",".") . '</td>
									</tr>';
						}						

						if($datos_remuneracion->adicafp > 0){
							$html .= '<tr>
									<td class="tdClass" >Adicional AFP</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->adicafp,0,".",".") . '</td>
									</tr>';
						}						


						if($datos_remuneracion->montoahorrovol > 0){
							$html .= '<tr>
									<td class="tdClass" >Ahorro Voluntario</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->montoahorrovol,0,".",".") . '</td>
									</tr>';
						}


						if($datos_remuneracion->montocotapv > 0){
							$html .= '<tr>
									<td class="tdClass" >APV</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->montocotapv,0,".",".") . '</td>
									</tr>';
						}

						if($datos_remuneracion->cotizacionsalud > 0){
							$html .= '<tr>
									<td class="tdClass" >Cotizaci&oacute;n Salud Obligatoria</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->cotizacionsalud,0,".",".") . '</td>
									</tr>';
						}																		

						if($datos_remuneracion->cotadicisapre > 0){
							$html .= '<tr>
									<td class="tdClass" >Cotizaci&oacute;n Adicional Isapre</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->cotadicisapre,0,".",".") . '</td>
									</tr>';
						}																														


						if($datos_remuneracion->adicsalud > 0){
							$html .= '<tr>
									<td class="tdClass" >Adicional Salud</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->adicsalud,0,".",".") . '</td>
									</tr>';
						}																								


						if(($datos_remuneracion->fonasa + $datos_remuneracion->inp) > 0){
							$html .= '<tr>
									<td class="tdClass" >Fonasa</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->fonasa+$datos_remuneracion->inp,0,".",".") . '</td>
									</tr>';


						}


						if($datos_remuneracion->segcesantia > 0){
							$html .= '<tr>
									<td class="tdClass" >Seguro de Cesant&iacute;a</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->segcesantia,0,".",".") . '</td>
									</tr>';
						}	


						if($datos_remuneracion->impuesto > 0){
							$html .= '<tr>
									<td class="tdClass" >Impuesto</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->impuesto,0,".",".") . '</td>
									</tr>';
						}



						if($datos_remuneracion->totaldescuentoslegales > 0){
							$html .= '<tr>
									<td class="tdClass" ><b>Total Descuentos Legales</b></td>
									<td class="tdClass tdClassNumber" ><b>$ ' . number_format($datos_remuneracion->totaldescuentoslegales,0,".",".") . '</b></td>
									</tr>';
						}

						$html .= '<tr>
								<td class="tdClass">&nbsp;</td>
								<td class="tdClass">&nbsp;</td>
								</tr>';						





						if($datos_remuneracion->anticipo > 0){
							$html .= '<tr>
									<td class="tdClass" >Anticipo</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->anticipo,0,".",".") . '</td>
									</tr>';
						}


						if($datos_remuneracion->aguinaldo > 0){
							$html .= '<tr>
									<td class="tdClass" >Descuento por Aguinaldo</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->aguinaldo,0,".",".") . '</td>
									</tr>';
						}							


						if($datos_remuneracion->montodescuento > 0){
							$html .= '<tr>
									<td class="tdClass" >Horas Descuento</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($datos_remuneracion->montodescuento,0,".",".") . '</td>
									</tr>';
						}

						//$datos_descuentos = $this->get_descuento($datos_remuneracion->idperiodo,'D',$datos_remuneracion->idtrabajador);

						$datos_d = $this->get_bonos_by_remuneracion($datos_remuneracion->id_remuneracion,null,'DESCUENTO');

						//$datos_d = $this->get_haberes_descuentos($datos_remuneracion->idtrabajador,null,'DESCUENTO',$datos_remuneracion->id_periodo);

						foreach ($datos_d as $info_descuento) {

							$html .= '<tr>
									<td class="tdClass" >' . $info_descuento->descripcion . '</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($info_descuento->monto,0,".",".") . '</td>
									</tr>';

						}

						/*$datos_descuentos = array();



						foreach ($datos_descuentos as $info_descuento) {

							$html .= '<tr>
									<td class="tdClass" >' . $info_descuento->descripcion . '</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($info_descuento->monto,0,".",".") . '</td>
									</tr>';

						}*/


						//$datos_prestamos = $this->get_descuento($datos_remuneracion->idperiodo,'P',$datos_remuneracion->idtrabajador);

						$datos_prestamos = array();

						foreach ($datos_prestamos as $info_prestamos) {

							$html .= '<tr>
									<td class="tdClass" >' . $info_prestamos->descripcion . '</td>
									<td class="tdClass tdClassNumber" >$ ' . number_format($info_prestamos->monto,0,".",".") . '</td>
									</tr>';

						}


						if($datos_remuneracion->descuentosnolegales > 0){
							$html .= '<tr>
									<td class="tdClass" ><b>Total Otros Descuentos</b></td>
									<td class="tdClass tdClassNumber" ><b>$ ' . number_format($datos_remuneracion->descuentosnolegales,0,".",".") . '</b></td>
									</tr>';
						}

						if($datos_remuneracion->totaldescuentos > 0){
							$html .= '<tr>
									<td class="tdClass" ><b>Total Descuentos</b></td>
									<td class="tdClass tdClassNumber" ><b>$ ' . number_format($datos_remuneracion->totaldescuentos,0,".",".") . '</b></td>
									</tr>';
						}

				$html.=	'</tbody>
						</table>
						</div>
						<br>
						<div class="recto">
						<table class="" width="100%"  >
						<thead class="theadClass">
						<tr class="headerRow">
						<th width="70%" ><p>Base Tributaria</p></th>
						<th width="30%" class="tdClassNumber" style="text-align: right;"><b>$ ' . number_format($datos_remuneracion->basetributaria,0,".",".") . '</b></th>
						</tr>
						</thead>
						</table>
						</div>						
						<br>
						<div class="recto">
						<table class="" width="100%"  >
						<thead class="theadClass">
						<tr class="headerRow">
						<th width="70%" ><p>L&iacute;quido a Pagar (Total Haberes - Total Descuentos)</p></th>
						<th width="30%" class="tdClassNumber" style="text-align: right;"><b>$ ' . number_format($datos_remuneracion->sueldoliquido,0,".",".") . '</b></th>
						</tr>
						</thead>
						</table>
						</div>
						<hr>
						<p style="text-align:left;font-size: 12px;" ><b>Son: '.valorEnLetras($datos_remuneracion->sueldoliquido).'</b></p>
						<br>
						<table width="100%" border="0">
							<tr>
								<td width="10%">&nbsp;</td>
								<td width="20%" style="border-bottom:1pt solid black;">&nbsp;</td>
								<td width="40%">&nbsp;</td>
								<td width="20%" style="border-bottom:1pt solid black;">&nbsp;</td>
								<td width="10%">&nbsp;</td>
							</tr>
							<tr>
								<td width="10%">&nbsp;</td>
								<td width="20%" style="text-align:center">Firma Trabajador</td>
								<td width="40%">&nbsp;</td>
								<td width="20%" style="text-align:center">Firma Empleador</td>
								<td width="10%">&nbsp;</td>
							</tr>							
						</table>

		';

			$html .=	"</body>
						</html>";

							//echo $html; exit;

						//echo "<pre>";
						//print_r($datos_remuneracion);
				
				$this->db->where('id_remuneracion',$datos_remuneracion->id_remuneracion);
				$this->db->update('rem_remuneracion', array('pdf_content' => $html));			
				//echo $this->db->last_query();

	}	



public function get_lista_movimientos($idpersonal = null,$idmovimiento = null,$idperiodo = null,$tipomovimiento = null){


		#SI BUSCO POR PERIODO
		if(!is_null($idperiodo)){
			$datos_periodo = $this->get_periodos($this->session->userdata('empresaid'),$idperiodo);
			$mes = $datos_periodo->mes;
			$anno = $datos_periodo->anno;
		}

		$movimiento_data = $this->db->select('lm.id, lm.idmovimiento, mp.nombre as movimiento, lm.fecmovimiento, lm.fechastamovimiento, lm.comentario, mp.rango, mp.codprevired')
						  ->from('rem_lista_movimiento_personal lm')
						  ->join('rem_movimientos_personal mp','lm.idmovimiento = mp.id')
						  ->join('rem_personal p','lm.idpersonal = p.id_personal')
						  ->where('lm.idpersonal',$idpersonal)
						  ->where('lm.active',1)
						  ->where('p.id_empresa',$this->session->userdata('empresaid'))
		                  ->order_by('lm.fecmovimiento','asc');

		$movimiento_data = is_null($idmovimiento) ? $movimiento_data : $movimiento_data->where('lm.id',$idmovimiento);  
		$movimiento_data = is_null($tipomovimiento) ? $movimiento_data : $movimiento_data->where('mp.id',$tipomovimiento);  

		
		#SI BUSCO POR PERIODO
		if(!is_null($idperiodo)){
			$movimiento_data = $movimiento_data->where('month(lm.fecmovimiento)',$mes);
			$movimiento_data = $movimiento_data->where('year(lm.fecmovimiento)',$anno);
		}


		$query = $this->db->get();
		return is_null($idmovimiento) ? $query->result() : $query->row();
	}


	public function get_max_movimiento_licencia_colaborador($idpersonal){



		$movimiento_data = $this->db->select('max(id) as id_movimiento',false)
						  ->from('rem_lista_movimiento_personal lm')
						  ->join('rem_personal p','lm.idpersonal = p.id_personal')
						  ->where('lm.idpersonal',$idpersonal)
						  ->where('lm.active',1)
						  ->where('lm.idmovimiento',3)
						  ->where('p.id_empresa',$this->session->userdata('empresaid'));


		$query = $this->db->get();
		return $query->row();
	}

	public function get_movimiento($idmovimiento = null,$sinlicencia = false){

		$movimiento_data = $this->db->select('id, nombre, rango, codprevired')
						  ->from('rem_movimientos_personal')
						  ->where('active = 1')
		                  ->order_by('codprevired','asc');
		$movimiento_data = is_null($idmovimiento) ? $movimiento_data : $movimiento_data->where('id',$idmovimiento);  
		$movimiento_data = $sinlicencia ? $movimiento_data->where('id <> 3') : $movimiento_data;  		                  
		$query = $this->db->get();
		$datos = is_null($idmovimiento) ? $query->result() : $query->row();
		return $datos;
	}



	public function get_licencia_medica($idpersonal = null){

		$movimiento_data = $this->db->select('id_personal, fec_inicio_reposo, numero_dias, dateadd(dd,numero_dias-1,fec_inicio_reposo) as fin_reposo',false)
						  ->from('rem_licencias_medicas')
						  ->where('id_empresa',$this->session->userdata('empresaid'));

		$movimiento_data = is_null($idpersonal) ? $movimiento_data : $movimiento_data->where('id_personal',$idpersonal);
			                  //	echo "asdasd"; exit;
		$query = $this->db->get();
		$datos = $query->result();
		return $datos;
	}



	public function add_movimiento_personal($array_datos){

		$this->db->trans_start();

		//var_dump_new($array_datos); exit; 
		# YA SEA PARA EDITAR O AGREGAR, EL PERIODO AGREGADO NO PUEDE SER DE UN PERIODO CERRADO
		$mes = substr($array_datos['fecmovimiento'],5,2);
		$anno = substr($array_datos['fecmovimiento'],0,4);
		$this->load->model('admin');
		$periodo = $this->admin->get_periodo_by_mes($mes,$anno);
		if(!is_null($periodo)){
			$idperiodo = $periodo->id_periodo;
			$periodo_cerrado = $this->get_periodos_cerrados($this->session->userdata('empresaid'),$idperiodo);
			//if(!is_null($periodo_cerrado)){
			if(count($periodo_cerrado) > 0){

				$this->db->trans_complete();
				return 5;
			}

		}

		$mes_hasta = substr($array_datos['fechastamovimiento'],5,2);
		$anno_hasta = substr($array_datos['fechastamovimiento'],0,4);
		//var_dump_new($mes_hasta);
		//var_dump_new($anno_hasta);

		if($anno.$mes != $anno_hasta.$mes_hasta){
			return 6;
		}

		
		//echo $array_datos['idmovimiento']; exit;

		if($array_datos['idmovimiento'] == 0){


			// validar si movimiento corresponde a un período ya cerrado

			$array_movimiento = array(
							'idpersonal' => $array_datos['idpersonal'],
							'idmovimiento' => $array_datos['movimientos'],
							'comentario' => $array_datos['comentarios'],
							//'fecmovimiento' => formato_fecha($array_datos['fecmovimiento'],'d/m/Y','Y-m-d'),
							'fecmovimiento' => str_replace("-","",$array_datos['fecmovimiento']),
							'fechastamovimiento' => str_replace("-","",$array_datos['fechastamovimiento']),
							'active' => 1,
							'created_at' => $array_datos['created_at'],
							'updated_at' => $array_datos['created_at']
							);
			$this->db->insert('rem_lista_movimiento_personal',$array_movimiento);

			//echo $this->db->last_query()."----";
			//echo $this->db->last_query()." --- ";

			//echo $this->db->insert_id()." ---  ";

			$this->db->trans_complete();
			return 1;

		}else{

			$movimiento_realizado = $this->get_lista_movimientos($array_datos['idpersonal'],$array_datos['idmovimiento']);
			//var_dump_new($movimiento_realizado); exit;
			if(is_null($movimiento_realizado)){
				$this->db->trans_complete();
				return 3;
			}else{

				// validar si movimiento corresponde a un período ya cerrado
				$mes = substr($movimiento_realizado->fecmovimiento,5,2);
				$anno = substr($movimiento_realizado->fecmovimiento,0,4);

				$periodo = $this->admin->get_periodo_by_mes($mes,$anno);

				if(!is_null($periodo)){
					$idperiodo = $periodo->id_periodo;
					$periodo_cerrado = $this->get_periodos_cerrados($this->session->userdata('empresaid'),$idperiodo);
					if(count($periodo_cerrado) > 0){
						$this->db->trans_complete();
						return 4;
					}

				}



							
				$array_movimiento = array(
								'idpersonal' => $array_datos['idpersonal'],
								'idmovimiento' => $array_datos['movimientos'],
								'comentario' => $array_datos['comentarios'],
								'fecmovimiento' => str_replace("-","",$array_datos['fecmovimiento']),
								'fechastamovimiento' => str_replace("-","",$array_datos['fechastamovimiento'])
								);

				$this->db->where('id',$array_datos['idmovimiento']);
				$this->db->where('idpersonal',$array_datos['idpersonal']);				
				$this->db->update('rem_lista_movimiento_personal',$array_movimiento);
				$this->db->trans_complete();
				return 2;				

			}



		}
		return 1;
	}

// se crea esta función, quitando los trans_start, debido a que al llamarlos desde otra función que también los usa, no genera las transacciones
public function add_movimiento_personal_licencia($array_datos){

		//$this->db->trans_start();

		//var_dump_new($array_datos); exit; 
		# YA SEA PARA EDITAR O AGREGAR, EL PERIODO AGREGADO NO PUEDE SER DE UN PERIODO CERRADO
		$mes = substr($array_datos['fecmovimiento'],5,2);
		$anno = substr($array_datos['fecmovimiento'],0,4);
		$this->load->model('admin');
		$periodo = $this->admin->get_periodo_by_mes($mes,$anno);
		if(!is_null($periodo)){
			$idperiodo = $periodo->id_periodo;
			$periodo_cerrado = $this->get_periodos_cerrados($this->session->userdata('empresaid'),$idperiodo);
			//if(!is_null($periodo_cerrado)){
			if(count($periodo_cerrado) > 0){

				//$this->db->trans_complete();
				return 5;
			}

		}

		$mes_hasta = substr($array_datos['fechastamovimiento'],5,2);
		$anno_hasta = substr($array_datos['fechastamovimiento'],0,4);
		//var_dump_new($mes_hasta);
		//var_dump_new($anno_hasta);

		if($anno.$mes != $anno_hasta.$mes_hasta){
			return 6;
		}

		
		//echo $array_datos['idmovimiento']; exit;

		if($array_datos['idmovimiento'] == 0){


			// validar si movimiento corresponde a un período ya cerrado

			$array_movimiento = array(
							'idpersonal' => $array_datos['idpersonal'],
							'idmovimiento' => $array_datos['movimientos'],
							'comentario' => $array_datos['comentarios'],
							//'fecmovimiento' => formato_fecha($array_datos['fecmovimiento'],'d/m/Y','Y-m-d'),
							'fecmovimiento' => str_replace("-","",$array_datos['fecmovimiento']),
							'fechastamovimiento' => str_replace("-","",$array_datos['fechastamovimiento']),
							'active' => 1,
							'created_at' => $array_datos['created_at'],
							'updated_at' => $array_datos['created_at']
							);
			$this->db->insert('rem_lista_movimiento_personal',$array_movimiento);

			//echo $this->db->last_query()."----";
			//echo $this->db->last_query()." --- ";

			//echo $this->db->insert_id()." ---  ";

			//$this->db->trans_complete();
			return 1;

		}else{

			$movimiento_realizado = $this->get_lista_movimientos($array_datos['idpersonal'],$array_datos['idmovimiento']);
			//var_dump_new($movimiento_realizado); exit;
			if(is_null($movimiento_realizado)){
			//	$this->db->trans_complete();
				return 3;
			}else{

				// validar si movimiento corresponde a un período ya cerrado
				$mes = substr($movimiento_realizado->fecmovimiento,5,2);
				$anno = substr($movimiento_realizado->fecmovimiento,0,4);

				$periodo = $this->admin->get_periodo_by_mes($mes,$anno);

				if(!is_null($periodo)){
					$idperiodo = $periodo->id_periodo;
					$periodo_cerrado = $this->get_periodos_cerrados($this->session->userdata('empresaid'),$idperiodo);
					if(count($periodo_cerrado) > 0){
					//	$this->db->trans_complete();
						return 4;
					}

				}



							
				$array_movimiento = array(
								'idpersonal' => $array_datos['idpersonal'],
								'idmovimiento' => $array_datos['movimientos'],
								'comentario' => $array_datos['comentarios'],
								'fecmovimiento' => str_replace("-","",$array_datos['fecmovimiento']),
								'fechastamovimiento' => str_replace("-","",$array_datos['fechastamovimiento'])
								);

				$this->db->where('id',$array_datos['idmovimiento']);
				$this->db->where('idpersonal',$array_datos['idpersonal']);				
				$this->db->update('rem_lista_movimiento_personal',$array_movimiento);
			//	$this->db->trans_complete();
				return 2;				

			}



		}
		return 1;
	}	


public function delete_movimiento_personal_licencia($idpersonal,$idmovimiento){
		//$this->db->trans_start();

		$movimiento = $this->get_lista_movimientos($idpersonal,$idmovimiento);

		if(is_null($movimiento)){ // movimiento no existe
			//$this->db->trans_complete();
			return 2;

		}

		// validar si movimiento corresponde a un período ya cerrado
		$mes = substr($movimiento->fecmovimiento,5,2);
		$anno = substr($movimiento->fecmovimiento,0,4);

		$this->load->model('admin');
		$periodo = $this->admin->get_periodo_by_mes($mes,$anno);

		if(!is_null($periodo)){
			$idperiodo = $periodo->id_periodo;
			$periodo_cerrado = $this->get_periodos_cerrados($this->session->userdata('empresaid'),$idperiodo);

			if(count($periodo_cerrado) > 0){
				//$this->db->trans_complete();
				return 3;
			}

		}

		
		$this->db->where('id', $idmovimiento);
		$this->db->where('idpersonal', $idpersonal);
		$this->db->update('rem_lista_movimiento_personal',array('active' => '0')); 

		//$this->db->trans_complete();

		return 1;

	}	





public function delete_movimiento_personal($idpersonal,$idmovimiento){
		$this->db->trans_start();

		$movimiento = $this->get_lista_movimientos($idpersonal,$idmovimiento);

		if(is_null($movimiento)){ // movimiento no existe
			$this->db->trans_complete();
			return 2;

		}

		// validar si movimiento corresponde a un período ya cerrado
		$mes = substr($movimiento->fecmovimiento,5,2);
		$anno = substr($movimiento->fecmovimiento,0,4);

		$this->load->model('admin');
		$periodo = $this->admin->get_periodo_by_mes($mes,$anno);

		if(!is_null($periodo)){
			$idperiodo = $periodo->id_periodo;
			$periodo_cerrado = $this->get_periodos_cerrados($this->session->userdata('empresaid'),$idperiodo);

			if(count($periodo_cerrado) > 0){
				$this->db->trans_complete();
				return 3;
			}

		}

		
		$this->db->where('id', $idmovimiento);
		$this->db->where('idpersonal', $idpersonal);
		$this->db->update('rem_lista_movimiento_personal',array('active' => '0')); 

		$this->db->trans_complete();

		return 1;

	}	


public function delete_haber_descto_variable($id_hab_descto){
		$this->db->trans_start();

		$this->db->query("update b
						  set b.valido = 0
						  from rem_bonos_personal b 
						  inner join rem_personal p on b.idpersonal = p.id_personal
						  where p.id_empresa = '" . $this->session->userdata('empresaid') . "' and b.id = " . $id_hab_descto);

		$this->db->trans_complete();

		return 1;

	}		



	public function update_personal_leyes_sociales($array_trabajadores){


		$this->db->trans_start();

		foreach ($array_trabajadores as $idtrabajador => $info_trabajador) {

			$trabajador_data = array(
								'idafp' => $info_trabajador['afp'] == '' ? null : $info_trabajador['afp'],
								'adicafp' => $info_trabajador['cotadic'],
								'tipoahorrovol' => $info_trabajador['tipcotvol'],
								'ahorrovol' => $info_trabajador['tipcotvol'] == 'pesos' ? str_replace(".", "", $info_trabajador['cotvol']) : $info_trabajador['cotvol']
								);

			$this->db->where('id_personal', $idtrabajador);
			$this->db->update('rem_personal',$trabajador_data); 
		}

		$this->db->trans_complete();
		return 1;
	}	


	public function update_personal_data($array_trabajadores){


		$this->db->trans_start();

		foreach ($array_trabajadores as $idtrabajador => $info_trabajador) {

			$trabajador_data = array(
								'idcargo' => $info_trabajador['cargo'] == '' ? 0 : $info_trabajador['cargo'],
								'idcentrocosto' => $info_trabajador['centrocosto'] == '' ? 0 : $info_trabajador['centrocosto']
								);

			$this->db->where('id_personal', $idtrabajador);
			$this->db->update('rem_personal',$trabajador_data); 
		}

		$this->db->trans_complete();
		return 1;
	}	


	public function update_personal_apv($array_trabajadores){


		$this->db->trans_start();

		foreach ($array_trabajadores as $idtrabajador => $info_trabajador) {

			if(isset($info_trabajador['tipoapv'])){
				if($info_trabajador['tipoapv'] == 'pesos'){
					$info_trabajador['apv'] = str_replace(".", "", $info_trabajador['apv']);
				}else if($info_trabajador['tipoapv'] == 'uf'){
					$info_trabajador['apv'] = str_replace(".", "", $info_trabajador['apv']);
					$info_trabajador['apv'] = str_replace(",", ".", $info_trabajador['apv']);
				}
			}

			if(isset($info_trabajador['depconvapv'])){
				$info_trabajador['depconvapv'] = str_replace(".", "", $info_trabajador['depconvapv']);	
			}
			
			

			$trabajador_data = array(
								'instapv' => $info_trabajador['instapv'] != '' ?  $info_trabajador['instapv'] : null,
								'nrocontratoapv' => isset($info_trabajador['nrocontratoapv']) ? $info_trabajador['nrocontratoapv'] : 0,
								'tipocotapv' => isset($info_trabajador['tipoapv']) ? $info_trabajador['tipoapv'] : 'pesos',
								'cotapv' => isset($info_trabajador['apv']) ? $info_trabajador['apv'] : 0,
								'formapagoapv' => isset($info_trabajador['formapagoapv']) ? $info_trabajador['formapagoapv'] : null,
								'depconvapv' => isset($info_trabajador['depconvapv']) ? $info_trabajador['depconvapv'] : 0,
								);

			$this->db->where('id_personal', $idtrabajador);
			$this->db->update('rem_personal',$trabajador_data); 
		}

		$this->db->trans_complete();
		return 1;
	}


public function update_personal_salud($array_trabajadores){


		$this->db->trans_start();

		foreach ($array_trabajadores as $idtrabajador => $info_trabajador) {
			$info_trabajador['pactado'] = $info_trabajador['isapre'] == 1 ? 0 : str_replace(",", ".", $info_trabajador['pactado']);

			$trabajador_data = array(
								'idisapre' => $info_trabajador['isapre'] == '' ? null : $info_trabajador['isapre'],
								'valorpactado' => $info_trabajador['pactado']
								);

			$this->db->where('id_personal', $idtrabajador);
			$this->db->update('rem_personal',$trabajador_data); 
		}
		$this->db->trans_complete();
		return 1;
	}	



public function lre($datos_remuneracion,$periodo)
    {


        $this->load->model('admin');
        $datos_empresa = $this->admin->datos_empresa($this->session->userdata('empresaid'));
   
         //echo "<pre>";
         //var_dump($datos_remuneracion); exit;

        $nombre_archivo = $datos_empresa->rut . $datos_empresa->dv . "_" . $periodo->anno . $periodo->mes .".csv";

        $path_archivo = "./uploads/tmp/";
        $file = fopen($path_archivo . $nombre_archivo, "w");

        
        $encabezado = "Rut trabajador(1101);Fecha inicio contrato(1102);Fecha término de contrato(1103);Causal término de contrato(1104);Región prestación de servicios(1105);Comuna prestación de servicios(1106);Tipo impuesto a la renta(1170);Técnico extranjero exención cot. previsionales(1146);Código tipo de jornada(1107);Persona con Discapacidad - Pensionado por Invalidez(1108);Pensionado por vejez(1109);AFP(1141);IPS (ExINP)(1142);FONASA - ISAPRE(1143);AFC(1151);CCAF(1110);Org. administrador ley 16.744(1152);Nro cargas familiares legales autorizadas(1111);Nro de cargas familiares maternales(1112);Nro de cargas familiares invalidez(1113);Tramo asignación familiar(1114);Rut org sindical 1(1171);Rut org sindical 2(1172);Rut org sindical 3(1173);Rut org sindical 4(1174);Rut org sindical 5(1175);Rut org sindical 6(1176);Rut org sindical 7(1177);Rut org sindical 8(1178);Rut org sindical 9(1179);Rut org sindical 10(1180);Nro días trabajados en el mes(1115);Nro días de licencia médica en el mes(1116);Nro días de vacaciones en el mes(1117);Subsidio trabajador joven(1118);Puesto Trabajo Pesado(1154);APVI(1155);APVC(1157);Indemnización a todo evento(1131);Tasa indemnización a todo evento(1132);Sueldo(2101);Sobresueldo(2102);Comisiones(2103);Semana corrida(2104);Participación(2105);Gratificación(2106);Recargo 30% día domingo(2107);Remun. variable pagada en vacaciones(2108);Remun. variable pagada en clausura(2109);Aguinaldo(2110);Bonos u otras remun. fijas mensuales(2111);Tratos(2112);Bonos u otras remun. variables mensuales o superiores a un mes(2113);Ejercicio opción no pactada en contrato(2114);Beneficios en especie constitutivos de remun(2115);Remuneraciones bimestrales(2116);Remuneraciones trimestrales(2117);Remuneraciones cuatrimestral(2118);Remuneraciones semestrales(2119);Remuneraciones anuales(2120);Participación anual(2121);Gratificación anual(2122);Otras remuneraciones superiores a un mes(2123);Pago por horas de trabajo sindical(2124);Sueldo empresarial (2161);Subsidio por incapacidad laboral por licencia médica(2201);Beca de estudio(2202);Gratificaciones de zona(2203);Otros ingresos no constitutivos de renta(2204);Colación(2301);Movilización(2302);Viáticos(2303);Asignación de pérdida de caja(2304);Asignación de desgaste herramienta(2305);Asignación familiar legal(2311);Gastos por causa del trabajo(2306);Gastos por cambio de residencia(2307);Sala cuna(2308);Asignación trabajo a distancia o teletrabajo(2309);Depósito convenido hasta UF 900(2347);Alojamiento por razones de trabajo(2310);Asignación de traslación(2312);Indemnización por feriado legal(2313);Indemnización años de servicio(2314);Indemnización sustitutiva del aviso previo(2315);Indemnización fuero maternal(2316);Pago indemnización a todo evento(2331);Indemnizaciones voluntarias tributables(2417);Indemnizaciones contractuales tributables(2418);Cotización obligatoria previsional (AFP o IPS)(3141);Cotización obligatoria salud 7%(3143);Cotización voluntaria para salud(3144);Cotización AFC - trabajador(3151);Cotizaciones técnico extranjero para seguridad social fuera de Chile(3146);Descuento depósito convenido hasta UF 900 anual(3147);Cotización APVi Mod A(3155);Cotización APVi Mod B hasta UF50(3156);Cotización APVc Mod A(3157);Cotización APVc Mod B hasta UF50(3158);Impuesto retenido por remuneraciones(3161);Impuesto retenido por indemnizaciones(3162);Mayor retención de impuestos solicitada por el trabajador(3163);Impuesto retenido por reliquidación remun. devengadas otros períodos(3164);Diferencia impuesto reliquidación remun. devengadas en este período(3165);Retención préstamo clase media 2020 (Ley 21.252) (3166);Rebaja zona extrema DL 889 (3167);Cuota sindical 1(3171);Cuota sindical 2(3172);Cuota sindical 3(3173);Cuota sindical 4(3174);Cuota sindical 5(3175);Cuota sindical 6(3176);Cuota sindical 7(3177);Cuota sindical 8(3178);Cuota sindical 9(3179);Cuota sindical 10(3180);Crédito social CCAF(3110);Cuota vivienda o educación(3181);Crédito cooperativas de ahorro(3182);Otros descuentos autorizados y solicitados por el trabajador(3183);Cotización adicional trabajo pesado - trabajador(3154);Donaciones culturales y de reconstrucción(3184);Otros descuentos(3185);Pensiones de alimentos(3186);Descuento mujer casada(3187);Descuentos por anticipos y préstamos(3188);AFC - Aporte empleador(4151);Aporte empleador seguro accidentes del trabajo y Ley SANNA(4152);Aporte empleador indemnización a todo evento(4131);Aporte adicional trabajo pesado - empleador(4154);Aporte empleador seguro invalidez y sobrevivencia(4155);APVC - Aporte Empleador(4157);Total haberes(5201);Total haberes imponibles y tributables(5210);Total haberes imponibles no tributables(5220);Total haberes no imponibles y no tributables(5230);Total haberes no imponibles y tributables(5240);Total descuentos(5301);Total descuentos impuestos a las remuneraciones(5361);Total descuentos impuestos por indemnizaciones(5362);Total descuentos por cotizaciones del trabajador(5341);Total otros descuentos(5302);Total aportes empleador(5410);Total líquido(5501);Total indemnizaciones(5502);Total indemnizaciones tributables(5564);Total indemnizaciones no tributables(5565)\r\n"; //  total indemnizaciones no tributables 

        fputs($file, utf8_decode($encabezado));

        foreach ($datos_remuneracion as $remuneracion) {

        		//var_dump_new($remuneracion); 

               // echo $remuneracion->codlrecaja."<br>";
                /***************/
                $tipojornada = $remuneracion->parttime == 0 ? 101 : 201;
                $pensionadovejez = $remuneracion->idafp == 7 ? 1 : 0;


                $movimientos = $this->get_lista_movimientos($remuneracion->idtrabajador, null, $remuneracion->id_periodo, 3);

                $dias_licencia = 0;
                foreach ($movimientos as $movimiento) {
                    
                    $dias = dias_transcurridos($movimiento->fecmovimiento,$movimiento->fechastamovimiento) + 1; // se agrega uno porque se considera el día inicial
                    $dias_licencia += $dias;
                }                


                if(($dias_licencia + $remuneracion->diastrabajo ) > 30){
                        $dias_licencia = 30 - $remuneracion->diastrabajo;
                }


                $ahorrovol = $remuneracion->montoahorrovol > 0 ? 1 : 0;


                // Categoría 1: Identificación del Trabajador
                $linea  = $remuneracion->rut."-".$remuneracion->dv.";"; // rut
                $linea .= $remuneracion->fecingreso.";";// fecha inicio contrato
                $linea .= ";"; // fecha termino contrato
                $linea .= ";"; // causal termino contrato
                $linea .= $remuneracion->idregion.";"; // region prestacion servicios
                $linea .= $remuneracion->idcomuna.";"; // comuna prestacion servicios
                $linea .= "1;"; // tipo impuesto a la renta 
                $linea .= "0;"; // Técnico extranjero exención de cotizaciones previsionales (ley 18.156)
                $linea .= $tipojornada.";"; // Código tipo de jornada
                $linea .= "0;"; //  Persona con discapacidad/pensionado por invalidez
                $linea .= $pensionadovejez.";"; //  Pensionado por vejez
                $linea .= $remuneracion->codlre == '' ? "0;" : $remuneracion->codlre .";"; //  AFP
                $linea .= "0;"; //  IPS (ExINP) (*)
                $linea .= $remuneracion->codlreisapre == '' ? "0;" : $remuneracion->codlreisapre.";"; //   FONASA / ISAPRE 
                $linea .= $remuneracion->afilsegcesantia.";"; //  AFC
                $linea .= $remuneracion->codlrecaja == '' ? "0;" : $remuneracion->codlrecaja .";"; //  CCAF
                $linea .= $remuneracion->codlremutual == '' ? "0;" : $remuneracion->codlremutual.";"; //  Org. administrador ley 16.744
                $linea .= $remuneracion->cargassimples.";"; //  Número cargas familiares legales autorizadas
                $linea .= $remuneracion->cargasmaternales.";"; //  Número de cargas familiares maternales 
                $linea .= $remuneracion->cargasinvalidas.";"; //  Número de cargas familiares invalidez
                $linea .= ($remuneracion->tramo_asig_familiar == '' ? 'S' : $remuneracion->tramo_asig_familiar).";"; //  Tramo asignación familiar
                $linea .= ";"; //  Rut organización sindical 1
                $linea .= ";"; //  Rut organización sindical 2
                $linea .= ";"; //  Rut organización sindical 3
                $linea .= ";"; //  Rut organización sindical 4
                $linea .= ";"; //  Rut organización sindical 5
                $linea .= ";"; //  Rut organización sindical 6
                $linea .= ";"; //  Rut organización sindical 7
                $linea .= ";"; //  Rut organización sindical 8
                $linea .= ";"; //  Rut organización sindical 9
                $linea .= ";"; //  Rut organización sindical 10
                $linea .= $remuneracion->diastrabajo.";"; //  Número días trabajados en el mes
                $linea .= $dias_licencia.";"; //  Número días de licencia médica en el mes 
                $linea .= "0;"; //  Número días de vacaciones en el mes ******
                $linea .= "0;"; //  Subsidio trabajador joven
                $linea .= "0;"; //  Puesto trabajo pesado 
                $linea .= $ahorrovol.";"; //  Ahorro previsional voluntario individual 
                $linea .= "0;"; //   Ahorro previsional voluntario colectivo
                $linea .= "0;"; //  Indemnización a todo evento (Art. 164)
                $linea .= ";"; //  Tasa indemnización a todo evento (Art. 164) 

                // Categoría 2: Haberes
                //Subcategoría N°1: Haberes imponibles y tributables

                $linea .= $remuneracion->sueldobase.";"; //  Sueldo
                $linea .= "0;"; //  Sobresueldo
                $linea .= "0;"; //  Comisiones (mensual) 
                $linea .= "0;"; //  Semana corrida mensual (Art. 45) 
                $linea .= "0;"; //  Participación (mensual) 
                $linea .= $remuneracion->gratificacion.";"; //  Gratificación (mensual)  
                $linea .= "0;"; //  Recargo 30% día domingo (Art. 38) 
                $linea .= "0;"; //  Remuneración variable pagada en vacaciones (Art. 71)
                $linea .= "0;"; //  Remuneración variable pagada en clausura (Art. 38 DFL 2) 
                $linea .= $remuneracion->aguinaldobruto.";"; //  Aguinaldo
                $linea .= $remuneracion->bonosimponibles.";"; //  Bonos u otras remuneraciones fijas mensuales
                $linea .= "0;"; //  Tratos (mensual)
                $linea .= "0;"; //  Bonos u otras remuneraciones variables mensuales o superiores a un mes 
                $linea .= "0;"; //  Ejercicio opción no pactada en contrato (Art. 17 N°8 LIR)  
                $linea .= "0;"; //  Beneficios en especie constitutivos de remuneración 
                $linea .= "0;"; //  Remuneraciones bimestrales (devengo en dos meses)  
                $linea .= "0;"; //  Remuneraciones trimestrales (devengo en tres meses) 
                $linea .= "0;"; //  Remuneraciones cuatrimestral (devengo en cuatro meses
                $linea .= "0;"; //  Remuneraciones semestrales (devengo en seis meses)  
                $linea .= "0;"; //  Remuneraciones anuales (devengo en doce meses)
                $linea .= "0;"; //  Participación anual (devengo en doce meses) 
                $linea .= "0;"; //  Gratificación anual (devengo en doce meses) 
                $linea .= "0;"; //  Otras remuneraciones superiores a un mes 
                $linea .= "0;"; //  Pago por horas de trabajo sindical
                $linea .= "0;";  //  Sueldo empresarial (2161)

                //Subcategoría N°2: Haberes imponibles y no tributables
  
                $linea .= "0;"; //  Subsidio por incapacidad laboral por licencia médica - total mensual  
                $linea .= "0;"; //  Beca de estudio (Art. 17 N°18 LIR) 
                $linea .= "0;"; //  Gratificaciones de zona (Art. 17 N°27) 
                $linea .= "0;"; //  Otros ingresos no constitutivos de renta (Art. 17 N°29 LIR)

                //Subcategoría N°3: Haberes no imponibles y no tributables

                $linea .= $remuneracion->colacion.";"; //  Colación total mensual (Art. 41)
                $linea .= $remuneracion->movilizacion.";"; //  Movilización total mensual (Art. 41)
                $linea .= "0;"; //  Viáticos total mensual (Art. 41)
                $linea .= "0;"; //  Asignación de pérdida de caja total mensual (Art. 41)
                $linea .= "0;"; //  Asignación de desgaste herramienta total mensual (Art. 41)
                $linea .= $remuneracion->asigfamiliar.";"; //  Asignación familiar legal total mensual (Art. 41) 
                $linea .= "0;"; //  Gastos por causa del trabajo (Art. 41)  
                $linea .= "0;"; //  Gastos por cambio de residencia (Art. 53)
                $linea .= "0;"; //  Sala cuna (Art. 203)  
                $linea .= "0;"; //  Asignación trabajo a distancia o teletrabajo
                $linea .= "0;"; //  Depósito convenido hasta UF 900 
                $linea .= "0;"; //  Alojamiento por razones de trabajo (Art. 17 N°14 LIR)
                $linea .= "0;"; //  Asignación de traslación (Art. 17 N°15 LIR)  
                $linea .= "0;"; //  BIndemnización por feriado legal 
                $linea .= "0;"; //  Indemnización años de servicio 
                $linea .= "0;"; //  Indemnización sustitutiva del aviso previo
                $linea .= "0;"; //  Indemnización fuero maternal (Art. 163 bis)
                $linea .= "0;"; //  Indemnización a todo evento (Art. 164)  


                // Subcategoría N°4: Haberes no imponibles y tributables
                $linea .= "0;"; //  Indemnizaciones voluntarias tributables
                $linea .= "0;"; //  Indemnizaciones contractuales tributables

                //Categoría 3: Descuentos
                $linea .= ($remuneracion->cotizacionobligatoria + $remuneracion->comisionafp).";"; //  Cotización obligatoria previsional (AFP o IPS
                $linea .= ($remuneracion->cotizacionsalud + $remuneracion->fonasa + $remuneracion->inp).";"; //  Cotización obligatoria salud 7%  
                $linea .= $remuneracion->adicsalud.";"; //  Cotización voluntaria para salud
                $linea .= $remuneracion->segcesantia.";"; //  Cotización AFC - trabajador
                $linea .= "0;"; //  Cotizaciones técnico extranjero para seguridad social fuera de Chile
                $linea .= "0;"; //  Descuento depósito convenido hasta UF 900 anual 
                $linea .= "0;"; //  Cotización ahorro previsional voluntario individual modalidad A
                $linea .= "0;"; //   Cotización ahorro previsional voluntario individual modalidad B hasta UF 50
                $linea .= "0;"; //  Cotización ahorro previsional voluntario colectivo modalidad A 
                $linea .= "0;"; //  Cotización ahorro previsional voluntario colectivo modalidad B hasta UF 50 
                $linea .= $remuneracion->impuesto.";"; //  Impuesto retenido por remuneraciones 
                $linea .= "0;"; //  Impuesto retenido por indemnizaciones
                $linea .= "0;"; //  Mayor retención de impuestos solicitada por el trabajador
                $linea .= "0;"; //  Impuesto retenido por reliquidación remuneraciones devengadas en otros períodos
                $linea .= "0;"; //  Diferencia de impuesto por reliquidación remuneraciones devengadas en este período
                $linea .= "0;"; //  Retención préstamo clase media 2020 (Ley 21.252) (3166)
                $linea .= "0;"; //  Rebaja zona extrema DL 889 (3167)                
                $linea .= "0;"; //  Cuota sindical 1
                $linea .= "0;"; //  Cuota sindical 2 
                $linea .= "0;"; //  Cuota sindical 3 
                $linea .= "0;"; //  Cuota sindical 4 
                $linea .= "0;"; //  Cuota sindical 5 
                $linea .= "0;"; //  Cuota sindical 6 
                $linea .= "0;"; //  Cuota sindical 7 
                $linea .= "0;"; //  Cuota sindical 8 
                $linea .= "0;"; //  Cuota sindical 9 
                $linea .= "0;"; //  Cuota sindical 10 
                $linea .= "0;"; //  Crédito social CCAF 
                $linea .= "0;"; //  Cuota vivienda o educación (Art. 58) 
                $linea .= "0;"; //  Crédito cooperativas de ahorro (Art 54. Ley Coop.)
                $linea .= "0;"; //  Otros descuentos autorizados y solicitados por el trabajador 
                $linea .= "0;"; //  Cotización adicional trabajo pesado - trabajador
                $linea .= "0;"; //  Donaciones culturales y de reconstrucción 
                $linea .= "0;"; //  Otros descuentos (Art. 58)  
                $linea .= "0;"; //  Pensiones de alimentos 
                $linea .= "0;"; //  Descuento mujer casada (Art. 59) 
                $linea .= $remuneracion->otrosdescuentos.";"; //  Descuentos por anticipos y préstamos 

                //Categoría 4: Aportes del Empleador
                $linea .= $remuneracion->aportesegcesantia.";"; //  Aporte AFC - empleador 
                $linea .= $remuneracion->aportepatronal.";"; //  Aporte empleador seguro accidentes del trabajo y Ley SANNA (Ley 16.744)
                $linea .= "0;"; //  Aporte empleador indemnización a todo evento (Art. 164)
                $linea .= "0;"; //  Aporte adicional trabajo pesado - empleador 
                $linea .= $remuneracion->seginvalidez.";"; //  Aporte empleador seguro invalidez y sobrevivencia
                $linea .= "0;"; //  Aporte empleador ahorro previsional voluntario colectivo

                //Categoría 5: Totales
                //Subcategoría N°1: Haberes
                $linea .= $remuneracion->totalhaberes.";"; //  Total haberes
                $linea .= $remuneracion->sueldoimponible.";"; //  Total haberes imponibles y tributables
                $linea .= "0;"; //  Total haberes imponibles no tributables
                $linea .= ($remuneracion->totalhaberes - $remuneracion->sueldoimponible).";"; //  Total haberes no imponibles y no tributables
                $linea .= "0;"; //  Total haberes no imponibles y tributables

                //Subcategoría N°2: Descuentos
                $linea .= $remuneracion->totaldescuentos.";"; //  Total descuentos
                $linea .= $remuneracion->impuesto.";"; //  Total descuentos impuestos a las remuneraciones
                $linea .= "0;"; //  Total descuentos impuestos por indemnizaciones
                $linea .= $remuneracion->totalleyessociales.";"; //  Total descuentos por cotizaciones del trabajador
                $linea .= $remuneracion->otrosdescuentos.";"; //  Total otros descuentos

                //Subcategoría N°3: Aportes
                $linea .= ($remuneracion->aportepatronal + $remuneracion->aportesegcesantia + $remuneracion->seginvalidez).";"; //  Total aportes empleador

                //Subcategoría N°4: Otros resultados totales
                $linea .= $remuneracion->sueldoliquido.";"; //  Total líquido
                $linea .= "0;"; //  Total indemnizaciones
                $linea .= "0;"; //  Total indemnizaciones tributables
                $linea .= "0;"; //  total indemnizaciones no tributables 


                $linea .= "\r\n";
                //$linea = $rut.$dv.$apaterno.$amaterno.$nombres."\r\n";
                fputs($file, utf8_decode($linea));
               // echo $linea."<br>";
        }

        //exit;
        fclose($file);

        $data_archivo = basename($path_archivo . $nombre_archivo);
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename=' . $data_archivo);
        header('Content-Length: ' . filesize($path_archivo . $nombre_archivo));
        readfile($path_archivo . $nombre_archivo);


        unlink($path_archivo . $nombre_archivo);
    }



public function previred($datos_remuneracion){

			$this->load->model('admin');
			$nombre_archivo = $this->session->userdata('empresaid')."_previred_".date("Ymd").".txt";
			$path_archivo = "./uploads/tmp/";
			$file = fopen($path_archivo.$nombre_archivo, "w");
			$this->load->model('admin');

			foreach ($datos_remuneracion as $remuneracion) {



				$idperiodo = $remuneracion->id_periodo;
				$idtrabajador = $remuneracion->idtrabajador;


				$movimientos_personal = $this->get_lista_movimientos($idtrabajador,null,$idperiodo); 
				$cod_mov_personal = "00";
				$array_lineas_trabajador = array();
				$i = 0;
				foreach ($movimientos_personal as $movimiento_personal) {
					if(count($array_lineas_trabajador) == 0){
						$array_lineas_trabajador[$i]['tipo_linea'] = "00";
						$array_lineas_trabajador[$i]['codprevired'] = str_pad($movimiento_personal->codprevired,2,"0",STR_PAD_LEFT);
						$array_lineas_trabajador[$i]['fechadesde'] = formato_fecha($movimiento_personal->fecmovimiento,'Y-m-d','d-m-Y');
						$array_lineas_trabajador[$i]['fechahasta'] = formato_fecha($movimiento_personal->fechastamovimiento,'Y-m-d','d-m-Y');
					}else{
						$array_lineas_trabajador[$i]['tipo_linea'] = "01";
						$array_lineas_trabajador[$i]['codprevired'] = str_pad($movimiento_personal->codprevired,2,"0",STR_PAD_LEFT);
						$array_lineas_trabajador[$i]['fechadesde'] = formato_fecha($movimiento_personal->fecmovimiento,'Y-m-d','d-m-Y');
						$array_lineas_trabajador[$i]['fechahasta'] = formato_fecha($movimiento_personal->fechastamovimiento,'Y-m-d','d-m-Y');			
					}

					$i++;
				}

				if(count($array_lineas_trabajador) == 0){
						$array_lineas_trabajador[0]['tipo_linea'] = "00";
						$array_lineas_trabajador[0]['codprevired'] = "00";
						$array_lineas_trabajador[$i]['fechadesde'] = "00-00-0000";
						$array_lineas_trabajador[$i]['fechahasta'] = "00-00-0000";						
				}

				/*$rut = str_pad($remuneracion->rut,11,"0",STR_PAD_LEFT);
				$dv = $remuneracion->dv;
				$apaterno = str_pad(substr($remuneracion->apaterno,0,30),30," ",STR_PAD_RIGHT);
				$amaterno = str_pad(substr($remuneracion->amaterno,0,30),30," ",STR_PAD_RIGHT);
				$nombres = str_pad(substr($remuneracion->nombre,0,30),30," ",STR_PAD_RIGHT);*/
				$asigfamiliar = $remuneracion->asigfamiliar - $remuneracion->montocargaretroactiva;

				$dato_afp = $this->admin->get_afp($remuneracion->idafp);


				$codprev_apv = is_null($remuneracion->idapv) ? 0 : $this->admin->get_apv($remuneracion->idapv)->codprevired;
				$codprev_mutual = is_null($remuneracion->idmutual) ? 0 : $this->admin->get_mutual_seguridad($remuneracion->idmutual)->codprevired;
				$codprev_ccaf = is_null($remuneracion->idcaja) ? 0 : $this->admin->get_cajas_compensacion($remuneracion->idcaja)->codprevired;

				if($dato_afp->exregimen == 0){
					$reg_previsional = "AFP";
					$tipo_trabajador = 0;
				}else if($dato_afp->exregimen == 1){
					$reg_previsional = "INP";
					$tipo_trabajador = 0;
				}else if($dato_afp->exregimen == 2){
					$reg_previsional = "SIP";
					$tipo_trabajador = 2;
				}else{
					$reg_previsional = "   ";
					$tipo_trabajador = 0;
				}


				$dato_isapre = $this->admin->get_isapre($remuneracion->idisapre);


				if(is_null($remuneracion->idasigfamiliar)){
					$tramo_asig_familiar = "D";
				}else{

					$tramo_asig_familiar = $remuneracion->idasigfamiliar == 0 ? "D" : $this->admin->get_tabla_asig_familiar($remuneracion->idasigfamiliar)->tramo;
				}
				

				$formapagoapv = is_null($remuneracion->formapagoapv) ? "0" : $remuneracion->formapagoapv;

				if($dato_afp->exregimen == 1){
					$sueldoimponible_afp = ($remuneracion->cotizacionobligatoria+$remuneracion->comisionafp+$remuneracion->seginvalidez) > 0 ? $remuneracion->sueldoimponibleips : 0;
				}else{
					$sueldoimponible_afp = ($remuneracion->cotizacionobligatoria+$remuneracion->comisionafp+$remuneracion->seginvalidez) > 0 ? $remuneracion->sueldoimponibleimposiciones : 0;
				}

				
				$sueldoimponible_isapre = $remuneracion->cotizacionsalud > 0 ? $remuneracion->sueldoimponibleimposiciones : 0;
				//$sueldoimponible_mutual = $codprev_mutual != 0 ? $remuneracion->sueldoimponibleimposiciones : 0;
				$sueldoimponible_mutual = $codprev_mutual != 0 ? $remuneracion->sueldoimponible : 0;

				$sueldoimponible_ccaf = $codprev_ccaf != 0 ? $remuneracion->sueldoimponibleimposiciones : 0;
				$sueldoimponible_segcesantia = $remuneracion->afilsegcesantia == 1 ? $remuneracion->sueldoimponibleafc : 0;
				$cotccaffon = $codprev_ccaf == 0 ? 0 : $remuneracion->inp;

				//var_dump_new($codprev_ccaf);
				//var_dump_new($remuneracion->inp);
				//var_dump_new($cotccaffon); exit;

				$aportepatronal = $codprev_mutual == 0 ? 0 : $remuneracion->aportepatronal;
				$cotizacionisl = $codprev_mutual == 0 ? $remuneracion->aportepatronal : 0;

				//Si esta en fonasa y no tiene caja de compensacion, el monto se va al isl en vez de la ccaf
				//$cotizacionisl_fonasa = ($codprev_ccaf == 0 && $remuneracion->inp > 0) ? $remuneracion->inp : 0;
				$cotizacionisl_fonasa = 0;
				$sueldoimponible_fonasa = ( (($remuneracion->fonasa+$remuneracion->inp) > 0) || $cotizacionisl > 0)  ? $remuneracion->sueldoimponibleimposiciones : 0;

				$asigfamiliar_ccaf = $codprev_ccaf != 0 ? $asigfamiliar : 0;
				$asigfamiliar_mes = $codprev_ccaf != 0 ? $remuneracion->asigfamiliar : 0;



				$cotizacion_fonasa = $codprev_ccaf == 0 ? $remuneracion->fonasa+$remuneracion->inp : $remuneracion->fonasa;

				$monto_prestamos = 0;
				/*$prestamos = $this->get_descuento($remuneracion->idperiodo,'P',$remuneracion->idtrabajador);
				foreach ($prestamos as $prestamo) {
					$monto_prestamos += $prestamo->tipodescuento == 2 ? $prestamo->monto : 0;
				}*/


				foreach ($array_lineas_trabajador as $linea_trabajador) {


					$diastrabajo = $linea_trabajador['tipo_linea'] == "00" ? $remuneracion->diastrabajo : 0;
					$tramo_asig_familiar = $linea_trabajador['tipo_linea'] == "00" ? $tramo_asig_familiar : " ";
					$cargassimples = $linea_trabajador['tipo_linea'] == "00" ? $remuneracion->cargassimples : 0;
					$cargasmaternales = $linea_trabajador['tipo_linea'] == "00" ? $remuneracion->cargasmaternales : 0;
					$cargasinvalidas = $linea_trabajador['tipo_linea'] == "00" ? $remuneracion->cargasinvalidas : 0;
					$asigfamiliar  = $linea_trabajador['tipo_linea'] == "00" ? $asigfamiliar : 0;
					$montocargaretroactiva = $linea_trabajador['tipo_linea'] == "00" ? $remuneracion->montocargaretroactiva : 0;
					$solicitud_trabajador_joven = $linea_trabajador['tipo_linea'] == "00" ? "N" : " ";

					$sueldoimponible_afp  = $linea_trabajador['tipo_linea'] == "00" ? $sueldoimponible_afp : 0;
					$cot_obligatoria_afp  = $linea_trabajador['tipo_linea'] == "00" ? $remuneracion->cotizacionobligatoria+$remuneracion->comisionafp : 0;

					$cot_obligatoria_ips = $dato_afp->exregimen == 1 ? $cot_obligatoria_afp : 0;
					$cot_obligatoria_afp = $dato_afp->exregimen == 1 ? 0 : $cot_obligatoria_afp;
					$tasa_ips = $dato_afp->exregimen == 1 ? $remuneracion->porc : 0;

					$cot_obligatoria_afp  = $linea_trabajador['tipo_linea'] == "00" ? $cot_obligatoria_afp : 0;
					$cot_obligatoria_ips  = $linea_trabajador['tipo_linea'] == "00" ? $cot_obligatoria_ips : 0;

					$codcentrocosto = $linea_trabajador['tipo_linea'] == "00" ? $remuneracion->codcentrocosto : "";

					$seginvalidez = $linea_trabajador['tipo_linea'] == "00" ? $remuneracion->seginvalidez : 0;
					$montoahorrovol = $linea_trabajador['tipo_linea'] == "00" ? $remuneracion->montoahorrovol : 0;
					$fecdesdeafp = $linea_trabajador['tipo_linea'] == "00" ? "00-00-0000" : "          ";
					$fechastaafp = $linea_trabajador['tipo_linea'] == "00" ? "00-00-0000" : "          ";


					$dv_afiliado_voluntario = $linea_trabajador['tipo_linea'] == "00" ? "0" : " ";
					$fecdesdeafilvol = $linea_trabajador['tipo_linea'] == "00" ? "00-00-0000" : "          ";
					$fechastaafilvol = $linea_trabajador['tipo_linea'] == "00" ? "00-00-0000" : "          ";
					$cotizacion_fonasa = $linea_trabajador['tipo_linea'] == "00" ? $cotizacion_fonasa : 0;

					$moneda_plan_pactado = $linea_trabajador['tipo_linea'] == "00" ? "2" : "0";
					$valorpactadoperiodo = $linea_trabajador['tipo_linea'] == "00" ? $remuneracion->valorpactadoperiodo : 0;
					$cotizacionsalud = $linea_trabajador['tipo_linea'] == "00" ? $remuneracion->cotizacionsalud : 0;
					$adicisapre = $linea_trabajador['tipo_linea'] == "00" ? $remuneracion->adicisapre : 0;

					$monto_prestamos = $linea_trabajador['tipo_linea'] == "00" ? $monto_prestamos : 0;
					$cotccaffon = $linea_trabajador['tipo_linea'] == "00" ? $cotccaffon : 0;
					$asigfamiliar_mes = $linea_trabajador['tipo_linea'] == "00" ? $asigfamiliar_mes : 0;
					$asigfamiliar_ccaf = $linea_trabajador['tipo_linea'] == "00" ? $asigfamiliar_ccaf : 0;

					$aportepatronal = $linea_trabajador['tipo_linea'] == "00" ? $aportepatronal : 0;

					$sueldoimponible_segcesantia = $linea_trabajador['tipo_linea'] == "00" ? $sueldoimponible_segcesantia : 0;
					$segcesantia = $linea_trabajador['tipo_linea'] == "00" ? $remuneracion->segcesantia : 0;
					$aportesegcesantia = $linea_trabajador['tipo_linea'] == "00" ? $remuneracion->aportesegcesantia : 0;

					

					

					// DATOS DEL TRABAJADOR
					$linea  = str_pad($remuneracion->rut,11,"0",STR_PAD_LEFT); // rut
					$linea .= $remuneracion->dv; // dv
					$linea .= str_pad(substr(sanear_string($remuneracion->apaterno),0,30),30," ",STR_PAD_RIGHT); //apaterno
					$linea .= str_pad(substr(sanear_string($remuneracion->amaterno),0,30),30," ",STR_PAD_RIGHT); //amaterno
					$linea .= str_pad(substr(sanear_string($remuneracion->nombre),0,30),30," ",STR_PAD_RIGHT); //nombre
					$linea .= $remuneracion->sexo; //sexo
					$linea .= $remuneracion->nacionalidad == "C" ? 0 : 1; //nacionalidad
					$linea .= "01"; //tipo pago
					$linea .= str_pad($remuneracion->mes,2,"0",STR_PAD_LEFT).$remuneracion->anno; //periodo desde
					$linea .= str_pad($remuneracion->mes,2,"0",STR_PAD_LEFT).$remuneracion->anno; //periodo hasta
					$linea .= $reg_previsional; //regimen previsional 
					$linea .= $tipo_trabajador; //tipo trabajador (ver que pasa con pensionados activos y pensionados y cotiza)
					$linea .= str_pad($diastrabajo,2,"0",STR_PAD_LEFT); //dias trabajados
					$linea .= $linea_trabajador['tipo_linea']; //tipo de linea ***** VER PARA MOVIMIENTOS DEL PERSONAL
					$linea .= $linea_trabajador['codprevired']; //Código Movimiento de Personal
					$linea .= $linea_trabajador['fechadesde']; //Fecha Desde Código Movimiento de Personal 
					$linea .= $linea_trabajador['fechahasta']; //Fecha Hasta Código Movimiento de Personal 
					$linea .= $tramo_asig_familiar; //Tramo asignacion familiar 
					$linea .= str_pad($cargassimples,2,"0",STR_PAD_LEFT); //cargas simples
					$linea .= substr($cargasmaternales,-1); //cargas maternales
					$linea .= substr($cargasinvalidas,-1); //cargas inválidas
					$linea .= str_pad(substr($asigfamiliar,-6),6,"0",STR_PAD_LEFT); //monto asignacion familiar
					$linea .= str_pad(substr($montocargaretroactiva,-6),6,"0",STR_PAD_LEFT); //monto asignacion retroactiva
					$linea .= "000000"; //monto reintegro de cargas familiares 
					$linea .= $solicitud_trabajador_joven; //Solicitud Trabajador Joven 


					// DATOS AFP
					$linea .= str_pad($dato_afp->codprevired,2,"0",STR_PAD_LEFT); //cod afp
					$linea .= str_pad($sueldoimponible_afp,8,"0",STR_PAD_LEFT); //sueldo imponible
					$linea .= str_pad($cot_obligatoria_afp,8,"0",STR_PAD_LEFT); //cotizacion
					$linea .= str_pad($seginvalidez,8,"0",STR_PAD_LEFT); //seguro invalidez
					$linea .= str_pad($montoahorrovol,8,"0",STR_PAD_LEFT); //monto ahorro voluntario
					$linea .= "00000000"; //Renta imponible sustituta 
					$linea .= "00,00"; //tasa pactada  
					$linea .= "000000000"; //aporte indemnizacion  
					$linea .= "00"; //nro. periodos  
					$linea .= $fecdesdeafp; //periodo desde   
					$linea .= $fechastaafp; //periodo hasta  
					$linea .= "                                        "; //puesto de trabajo pesado  
					$linea .= "00,00"; //cotizacion trabajo pesado  
					$linea .= "000000"; //monto cotizacion trabajo pesado  


					//Datos Ahorro Previsional Voluntario Individual (PENDIENTE HASTA IMPLEMENTAR OPCIONES DE APV)
					//$linea .= str_pad($dato_afp->codprevired,3,"0",STR_PAD_LEFT); //cod institucion APVI (se asume que es la misma de la APV??)
					$linea .= str_pad($codprev_apv,3,"0",STR_PAD_LEFT); //cod institucion APVI 
					$linea .= str_pad(substr($remuneracion->nrocontratoapv,-20),20,"0",STR_PAD_LEFT); //nro contrato apvi  
					$linea .= $formapagoapv; //forma de pago apv 
					$linea .= str_pad(substr($remuneracion->montocotapv,-8),8,"0",STR_PAD_LEFT); //monto cotizacion apvi
					//$linea .= "00000000"; //monto cotizacion apvi
					$linea .= str_pad(substr($remuneracion->depconvapv,-8),8,"0",STR_PAD_LEFT);; //Cotización Depósitos Convenidos  *****************


					//Datos Ahorro Previsional Voluntario Colectivo
					$linea .= "000"; //Código Institución Autorizada APVC  
					$linea .= "                    "; //nro contrato APVC  
					$linea .= "0"; //forma de pago apvc  
					$linea .= "00000000"; //Cotización Trabajador APVC  
					$linea .= "00000000"; //Cotización Empleador APVC  


					//Datos Afiliado Voluntario
					$linea .= "00000000000"; // RUT Afiliado Voluntario 
					$linea .= $dv_afiliado_voluntario; // DV Afiliado Voluntario 
					$linea .= "                              "; //Apellido Paterno 
					$linea .= "                              "; //Apellido Materno 
					$linea .= "                              "; //Nombres 
					$linea .= "00"; // Código Movimiento de Personal 
					$linea .= $fecdesdeafilvol; //Fecha desde   
					$linea .= $fechastaafilvol; //Fecha hasta 
					$linea .= "00"; // Código de la AFP 
					$linea .= "00000000"; //Monto Capitalización Voluntaria  
					$linea .= "00000000"; //Monto Ahorro Voluntario 
					$linea .= "00"; // Número de periodos de cotización 


					//Datos IPS - ISL - FONASA  (FALTA ANALIZAR DE AQUI HACIA ABAJO)
					$linea .= "0000"; // Código EX-Caja Régimen 
					//$linea .= "00,00"; //Tasa Cotización Ex-Caja Previsión  
					$linea .= str_pad(str_replace(".",",",$tasa_ips),5,"0",STR_PAD_LEFT); //Tasa Cotización Ex-Caja Previsión  
					$linea .= str_pad($sueldoimponible_fonasa,8,"0",STR_PAD_LEFT); //Renta Imponible IPS ******REVISAR, al parecer hay un tope
					$linea .= str_pad($cot_obligatoria_ips,8,"0",STR_PAD_LEFT); //Cot Obligatoria IPS (Cuando esta en INP se llena este dato)					
					$linea .= "00000000"; //Renta Imponible Desahucio 
					$linea .= "0000"; // Código Ex-Caja Régimen Desahucio 
					$linea .= "00,00"; //Tasa Cotización Desahucio Ex-Cajas de Previsión 
					$linea .= "00000000"; //Cotización Desahucio 
					$linea .= str_pad($cotizacion_fonasa,8,"0",STR_PAD_LEFT); //Cotización Fonasa 
					//$linea .= str_pad($remuneracion->fonasa,8,"0",STR_PAD_LEFT); //Cotización Fonasa 
					$linea .= str_pad($cotizacionisl,8,"0",STR_PAD_LEFT);; //Cotización Acc. Trabajo (ISL) *****************
					$linea .= "00000000"; //Bonificación Ley 15.386 
					$linea .= "00000000"; //Descuento por cargas familiares de ISL 
					$linea .= "00000000"; //Bonos Gobierno 


					//Datos Salud
					$linea .= str_pad($dato_isapre->codprevired,2,"0",STR_PAD_LEFT); // Código Institución de Salud 
					$linea .= "                "; // Número del FUN (REVISAR SI SON BLANCOS O VACÍOS)
					$linea .= str_pad($sueldoimponible_isapre,8,"0",STR_PAD_LEFT); //Renta Imponible Isapre 
					$linea .= $moneda_plan_pactado; //Moneda del plan pactado Isapre 
					$linea .= str_pad(str_replace(".",",",$valorpactadoperiodo),8,"0",STR_PAD_LEFT); //Cotización Pactada 
					$linea .= str_pad($cotizacionsalud,8,"0",STR_PAD_LEFT); //Cotización Obligatoria Isapre 
					$linea .= str_pad($adicisapre,8,"0",STR_PAD_LEFT); //Cotización Adicional Voluntaria 
					$linea .= "00000000"; //Monto Garantía Explícita de Salud GES (Uso Futuro) 



					//Datos Caja de Compensación (AQUI VOY)


					$linea .= str_pad($codprev_ccaf,2,"0",STR_PAD_LEFT);; // Código CCAF 
					$linea .= str_pad($sueldoimponible_ccaf,8,"0",STR_PAD_LEFT); //Renta Imponible CCAF 
					$linea .= str_pad($monto_prestamos,8,"0",STR_PAD_LEFT); //Créditos Personales CCAF 
					$linea .= "00000000"; //Descuento Dental CCAF *****************
					$linea .= "00000000"; //Descuentos por Leasing (Programa Ahorro) *****************
					$linea .= "00000000"; //Descuentos por seguro de vida CCAF*****************
					$linea .= "00000000"; //Otros descuentos CCAF *****************
					$linea .= str_pad($cotccaffon,8,"0",STR_PAD_LEFT); //Cotización a CCAF de no afiliados a Isapres
					$linea .= str_pad($asigfamiliar_mes,8,"0",STR_PAD_LEFT); //Descuento Cargas Familiares CCAF 
					$linea .= "00000000"; //Otros descuentos CCAF 1 (Uso Futuro) *****************
					$linea .= "00000000"; //Otros descuentos CCAF 2 (Uso Futuro) *****************
					$linea .= "00000000"; //Bonos Gobierno (Uso Futuro) *****************
					$linea .= "                    "; //Código de Sucursal (Uso Futuro) (VER SI ES BLANCO O CEROS) *****************



					//Datos Mutualidad
					$linea .= str_pad($codprev_mutual,2,"0",STR_PAD_LEFT);; // Código Mutualidad
					$linea .= str_pad($sueldoimponible_mutual,8,"0",STR_PAD_LEFT); //Renta Imponible Mutual 
					$linea .= str_pad($aportepatronal,8,"0",STR_PAD_LEFT); //Cotización Accidente del Trabajo (MUTUAL) 
					$linea .= "000"; // Código Mutualidad (VER QUE PASA EN LINEAS ADICIONALES POR MOV PERSONAL) *****************

					//Datos Administradora de Seguro de Cesantía

					$linea .= str_pad($sueldoimponible_segcesantia,8,"0",STR_PAD_LEFT); //Renta Imponible Seguro Cesantía (Informar Renta Total Imponible) 
					$linea .= str_pad($segcesantia,8,"0",STR_PAD_LEFT); //Aporte Trabajador Seguro Cesantía 
					$linea .= str_pad($aportesegcesantia,8,"0",STR_PAD_LEFT); //Aporte Empleador Seguro Cesantía 

					//Datos Pagador de Subsidios
					$linea .= "00000000000"; //Rut Pagadora Subsidio
					$linea .= " "; //Rut Pagadora Subsidio 


					//Otros Datos de la Empresa

					$linea .= str_pad($codcentrocosto,20," ",STR_PAD_LEFT); //Centro de Costos, Sucursal, Agencia, Obra, Región 




					$linea .= "\r\n";
					//$linea = $rut.$dv.$apaterno.$amaterno.$nombres."\r\n";
					fputs($file,$linea);

				}

			}

			
			fclose($file);

			//exit;

			$data_archivo = basename($path_archivo.$nombre_archivo);
			header('Content-Type: text/plain');
			header('Content-Disposition: attachment; filename=' . $data_archivo);
			header('Content-Length: ' . filesize($path_archivo.$nombre_archivo));
			readfile($path_archivo.$nombre_archivo);		


			unlink($path_archivo.$nombre_archivo);
	}		




public function pago_bancos($datos_remuneracion){

			$this->load->model('admin');
			$nombre_archivo = $this->session->userdata('empresaid')."_Pago_Bancos_".date("Ymd").".txt";
			$path_archivo = "./uploads/tmp/";
			$file = fopen($path_archivo.$nombre_archivo, "w");
			$this->load->model('admin');

			foreach ($datos_remuneracion as $remuneracion) {
				//echo "<pre>";
				//print_r($remuneracion); //exit;

				$sueldo_liquido = $remuneracion->sueldoliquido < 0 ? 0 : $remuneracion->sueldoliquido;
				// DATOS DEL TRABAJADOR
				$linea  = str_pad($remuneracion->rut,8,"0",STR_PAD_LEFT); // rut
				$linea .= $remuneracion->dv; // dv
				$linea .= str_pad(substr(sanear_string($remuneracion->apaterno),0,15),15," ",STR_PAD_RIGHT); //apaterno
				$linea .= str_pad(substr(sanear_string($remuneracion->amaterno),0,15),15," ",STR_PAD_RIGHT); //amaterno
				$linea .= str_pad(substr(sanear_string($remuneracion->nombre),0,15),15," ",STR_PAD_RIGHT); //nombre
				$linea .= str_pad(substr(sanear_string($remuneracion->direccion),0,35),35," ",STR_PAD_RIGHT); //dirección
				$linea .= str_pad(substr(sanear_string($remuneracion->comuna),0,15),15," ",STR_PAD_RIGHT); //comuna
				$linea .= '17082018'; //Fecha de Pago
				$linea .= 'CCT'; //Forma de Pago
				$linea .= '016'; //Código de Banco
				$linea .= '044'; //Oficina de Pago
				$linea .= '00000000000000000000'; //Número de cuenta(20)
				$linea .= '00001'; //Documento (5)
				$linea .= str_pad(abs($sueldo_liquido),10,"0",STR_PAD_LEFT); //Monto a Pagar


				$linea .= "\r\n";
				//$linea = $rut.$dv.$apaterno.$amaterno.$nombres."\r\n";
				fputs($file,$linea);

			}

			
			fclose($file);

			//exit;

			$data_archivo = basename($path_archivo.$nombre_archivo);
			header('Content-Type: text/plain');
			header('Content-Disposition: attachment; filename=' . $data_archivo);
			header('Content-Length: ' . filesize($path_archivo.$nombre_archivo));
			readfile($path_archivo.$nombre_archivo);		


			unlink($path_archivo.$nombre_archivo);
	}	



}