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



	public function get_periodos_remuneracion_abiertos($idperiodo = null){
		$data_periodo = $this->db->select('p.id, p.mes, p.anno, pr.cierre, pr.aprueba, pr.anticipo')
						  ->from('rem_periodo as p')
						  ->join('rem_periodo_remuneracion as pr','p.id = pr.idperiodo')
						  ->where('pr.idempresa', $this->session->userdata('empresaid'))
		                  ->where('pr.aprueba is null')
		                  ->order_by('p.anno','desc')
		                  ->order_by('p.mes','desc');

		$data_periodo = is_null($idperiodo)	? $data_periodo : $data_periodo->where('pr.idperiodo',$idperiodo);

		$query = $this->db->get();
		return is_null($idperiodo) ? $query->result() : $query->row();
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
				$array_datos['updated_at'] = date('Y-m-d H:i:s');
				$array_datos['created_at'] = date('Y-m-d H:i:s');
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

		$personal_data = $this->db->select('r.id, r.idpersonal, r.idperiodo, r.diastrabajo, r.horasdescuento, r.montodescuento, r.horasextras50, r.montohorasextras50, r.horasextras100, r.montohorasextras100, r.anticipo, r.aguinaldo, r.sueldobase, r.gratificacion, r.movilizacion, r.sueldonoimponible, r.totalleyessociales, r.otrosdescuentos')
						  ->from('rem_remuneracion r')
						  ->join('rem_personal pe','r.idpersonal = pe.id')
						  ->where('pe.idempresa',$this->session->userdata('empresaid'))
						  ->where('pe.active = 1')
						  ->where('r.idperiodo',$idperiodo)						  
		                  ->order_by('pe.nombre');
		$personal_data = is_null($idtrabajador) ? $personal_data : $personal_data->where('r.idpersonal',$idtrabajador);  		                  
		$query = $this->db->get();
		$datos = is_null($idtrabajador) ? $query->result() : $query->row();
		return $datos;
	}	




	public function get_personal($idtrabajador = null){
		$array_campos = array(
				'id', 
				'idempresa', 
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
				/*'COALESCE((select sum(monto) as monto from rem_bonos_personal where idpersonal = p.id and fijo = 1 and imponible = 1),0) as bonos_fijos',*/
				'0 as bonos_fijos',
				'DATEDIFF(YY,fecafc,getdate()) as annos_afc,
				DATEDIFF(MM,fecinicvacaciones,getdate()) as meses_vac,
				fecinicvacaciones,
				saldoinicvacaciones,
				diasvactomados,
				diasprogresivos,
				diasprogtomados,
				saldoinicvacprog'
			);
		
		$personal_data = $this->db->select($array_campos)
						  ->from('rem_personal p')
						  ->where('p.idempresa',$this->session->userdata('empresaid'))
						  ->where('p.active = 1')
		                  ->order_by('p.nombre');
		$personal_data = is_null($idtrabajador) ? $personal_data : $personal_data->where('p.id',$idtrabajador);  		                  
		$query = $this->db->get();
		$datos = is_null($idtrabajador) ? $query->result() : $query->row();
		return $datos;
	}	


	public function set_datos_iniciales_periodo_rem($mes,$anno){

		$this->db->trans_start();
				// evaluar si existe periodo
		$this->db->select('p.id')
						  ->from('rem_periodo as p')
		                  ->where('p.mes', $mes)
		                  ->where('p.anno', $anno);
		$query = $this->db->get();
		$datos_periodo = $query->row();
		$idperiodo = 0;
		if(count($datos_periodo) == 0){ // si no existe periodo, se crea
				$data = array(
			      	'mes' => $mes,
			      	'anno' =>  $anno
				);
				$this->db->insert('rem_periodo', $data);
				$idperiodo = $this->db->insert_id();
		}else{
				$idperiodo = $datos_periodo->id;
		}


		// evaluar si existe periodo remuneraciones
		$this->db->select('r.idperiodo')
						  ->from('rem_periodo_remuneracion as r')
		                  ->where('r.idperiodo', $idperiodo)
		                  ->where('r.idempresa', $this->session->userdata('empresaid'));
		$query = $this->db->get();
		$datos_periodo_remuneracion = $query->row();
		if(count($datos_periodo_remuneracion) == 0){ // si no existe periodo, se crea
				$data = array(
			      	'idperiodo' => $idperiodo,
			      	'idempresa' => $this->session->userdata('empresaid')
				);
				$this->db->insert('rem_periodo_remuneracion', $data);
		}


		##CUALQUIER DATO CARGADO LO BORRA
		$this->db->where('idempresa', $this->session->userdata('empresaid'));
		$this->db->where('idperiodo', $idperiodo);
		$this->db->delete('rem_remuneracion');


		$personal = $this->get_personal(); 
		foreach ($personal as $trabajador) {

			$this->db->select('r.idperiodo')
							  ->from('rem_remuneracion as r')
			                  ->where('r.idpersonal', $trabajador->id)
			                  ->where('r.idperiodo', $idperiodo)
			                  ->where('r.idempresa', $this->session->userdata('empresaid'));
			$query = $this->db->get();
			$datos_remuneracion = $query->row();
			if(count($datos_remuneracion) == 0){ // si no existe periodo, se crea

					$data = array(
				      	'idpersonal' => $trabajador->id,
				      	'idperiodo' => $idperiodo,
				      	'idempresa' => $this->session->userdata('empresaid'),
				      	'created_at' => date("Y-m-d H:i:s")

					);
					$this->db->insert('rem_remuneracion', $data);
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
	}


	public function get_periodos($empresaid,$idperiodo = null){

		$periodo_data = $this->db->select('p.id, p.mes, p.anno, pr.anticipo, pr.cierre, pr.aprueba, pr.cierre,  (select count(*) from rem_remuneracion r inner join rem_personal pe on r.idpersonal = pe.id where r.idperiodo = p.id and pe.idempresa = ' . $empresaid . ' and r.active = 1) as numtrabajadores, (select sum(sueldoimponible) from rem_remuneracion r inner join rem_personal pe on r.idpersonal = pe.id where r.idperiodo = p.id and pe.idempresa = ' . $empresaid . ' and r.active = 1) as sueldoimponible ', false)
						  ->from('rem_periodo as p')
						  ->join('rem_periodo_remuneracion as pr','p.id = pr.idperiodo')
		                  ->where('pr.idempresa', $empresaid)
		                  ->order_by('p.updated_at desc');
		$comunidades_data = is_null($idperiodo) ? $periodo_data : $periodo_data->where('pr.idperiodo',$idperiodo);
		$query = $this->db->get();
		$datos = is_null($idperiodo) ? $query->result() : $query->row();				                  
		return $datos;

	}	




	public function calcular_remuneraciones($idperiodo){

		$this->db->trans_start();

		$periodo =  $this->get_periodos($this->session->userdata('empresaid'),$idperiodo);
		$this->load->model('admin');
		//$periodo = $this->admin->get_periodo_by_id($idperiodo);
		$empresa = $this->admin->get_empresas($this->session->userdata('empresaid')); 

		$tabla_impuesto = $this->get_tabla_impuesto();
		


		$parametros = $this->get_parametros_generales();
		$monto_total_sueldos = 0;
		$tope_legal_gratificacion = ($parametros->sueldominimo*4.75)/12;

		$this->load->model('account');

		$array_pago_afp = array();
		$array_pago_isapre = array();
		$array_descuentos = array();
		$array_prestamos = array();
		$dia_mes =  $periodo->mes == 2 ? 28 : 30;
		$suma_aporte_patronal = 0;
		$suma_asig_familiar = 0;
		$suma_ips = 0;
		$suma_impuesto = 0;
		$tope_imponible = (int)($parametros->uf*$parametros->topeimponible);

		$this->db->query('update rem_remuneracion r 
						  inner join gc_personal p on r.idpersonal = p.id
						  set r.active = 0
						  where p.idempresa = ' . $this->session->userdata('empresaid') . ' and r.idperiodo = ' . $idperiodo );

		$personal = $this->get_personal(); 
		foreach ($personal as $trabajador) { // calculo de sueldos por cada trabajador
			$datos_remuneracion = $this->get_datos_remuneracion_by_periodo($idperiodo,$trabajador->id);

			$datos_bonos = array();
			//$datos_bonos = $this->get_bonos($trabajador->id);
			$bonos_imponibles = 0;
			$bonos_no_imponibles = 0;

			$diastrabajo = $trabajador->parttime == 1 ? $trabajador->diastrabajo : 30;
			$sueldo_base_mes = round(($trabajador->sueldobase/$diastrabajo)*$datos_remuneracion->diastrabajo,0);


			$movilizacion_mes = round(($trabajador->movilizacion/$diastrabajo)*$datos_remuneracion->diastrabajo,0);
			$colacion_mes = round(($trabajador->colacion/$diastrabajo)*$datos_remuneracion->diastrabajo,0);

			

			foreach ($datos_bonos as $bono) {
				$tiene_bono = false;
				if($bono->fijo == 1){ // se suma siempre
					$tiene_bono = true;
				}else{ // validar si corresponde al período
					$array_fecha_bono = explode("/",$bono->fecha);
					$mes_bono = (int)$array_fecha_bono[1];
					$anno_bono = $array_fecha_bono[2];
					$tiene_bono = $mes_bono == $periodo->mes && $anno_bono == $periodo->anno ? true : false; // el bono corresponde al periodo que estamos calculando.  Entonces si aplica el bono
				}

				if($tiene_bono){
					
					$valor_bono = $bono->proporcional == 1 ? round(($bono->monto/$diastrabajo)*$datos_remuneracion->diastrabajo,0) : $bono->monto;
					if($bono->imponible == 1){
						$bonos_imponibles += $valor_bono;

					}else{
						$bonos_no_imponibles += $valor_bono;
					}				
					$data_bono = array(
								'idremuneracion' => $datos_remuneracion->id,
								'descripcion' => $bono->descripcion,
								'imponible' => $bono->imponible,
								'monto' => $valor_bono
								);
					$this->db->insert('rem_bonos_remuneracion', $data_bono);
				}
			}

			$datos_afp = $this->admin->get_afp($trabajador->idafp);
			//$valor_hora = $trabajador->parttime == 1 ? ((($trabajador->sueldobase + $trabajador->bonos_fijos)/$trabajador->diastrabajo)/$trabajador->horasdiarias) : ((($trabajador->sueldobase + $trabajador->bonos_fijos)/30)*7)/45;
			$valor_hora = $trabajador->parttime == 1 ? ((($trabajador->sueldobase)/$trabajador->diastrabajo)/$trabajador->horasdiarias) : ((($trabajador->sueldobase)/30)*7)/45;
			$valor_hora = round($valor_hora,0);
			//calculo total haberes
			$valor_hora50 =  round($valor_hora*1.5,0);
			$valor_hora100 = round($valor_hora*2,0);
			$monto_horas50 = $datos_remuneracion->horasextras50*$valor_hora50;
			$monto_horas100 = $datos_remuneracion->horasextras100*$valor_hora100;






			$porc_com_afp = $datos_afp->porc > 0 ? $datos_afp->porc - 10 : 0;
			$porc_cot_oblig = $datos_afp->exregimen == 2 ? 0 : 0.1;
			

			//$gratificacion = $trabajador->sueldobase*0.25;


			//Calculo asignación familiar
			$num_cargas_simples = $trabajador->cargassimples;
			$num_cargas_maternales = $trabajador->cargasmaternales;

			$num_cargas = $num_cargas_simples + $num_cargas_maternales;
			$monto_ingresos = $trabajador->sueldobase + $trabajador->bonos_fijos;

			$asig_familiar = $trabajador->asigfamiliar;

			if(!is_null($trabajador->idasigfamiliar)){ //BUSCA MONTO DE ASIGNACION FAMILIAR EN BASE A TRAMO SELECCIONADO
				$tramo_asig_familiar = $this->admin->get_tabla_asig_familiar($trabajador->idasigfamiliar);
				$asig_familiar += $tramo_asig_familiar->monto*$num_cargas;
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
				$monto_calculo_gratificacion = $sueldo_base_mes +  $bonos_imponibles + $monto_horas50 + $monto_horas100;
				//$gratificacion_esperada = round($sueldo_base_mes/4,0);

				$gratificacion_esperada = round($monto_calculo_gratificacion/4,0);


				$gratificacion = $gratificacion_esperada > $tope_legal_gratificacion ? $tope_legal_gratificacion : $gratificacion_esperada;
			}


			$total_haberes = $sueldo_base_mes + $gratificacion + $movilizacion_mes + $colacion_mes + $bonos_imponibles + $bonos_no_imponibles + $monto_horas50 + $monto_horas100 + $aguinaldo_bruto + $asig_familiar;
			$sueldo_imponible = $sueldo_base_mes + $gratificacion + $bonos_imponibles + $monto_horas50 + $monto_horas100 + $aguinaldo_bruto;

			$sueldo_no_imponible = $total_haberes - $sueldo_imponible;



			#CALCULA SUELDO SOBRE EL CUAL SE CALCULARÁN LAS IMPOSICIONES, CONSIDERANDO EL TOPE LEGAL
			$sueldo_imponible_imposiciones = $sueldo_imponible > $tope_imponible ? $tope_imponible : $sueldo_imponible;

			$cot_obligatoria = round($sueldo_imponible_imposiciones*$porc_cot_oblig,0);
			$comision_afp = round($sueldo_imponible_imposiciones*($porc_com_afp/100),0);
			$adic_afp = round($sueldo_imponible*($trabajador->adicafp/100),0);


			// SOLO SE PAGA POR 11 AÑOS
			$segcesantia = $trabajador->tipocontrato == 'I' && $trabajador->segcesantia == 1 && $trabajador->annos_afc <= 11 ? round($sueldo_imponible*0.006,0) : 0;


			$cot_salud_oblig = $trabajador->idisapre != 1 ? round($sueldo_imponible_imposiciones*0.07,0) : 0;

			if($trabajador->idisapre == 1){ //FONASA
				$salud_total = round($sueldo_imponible_imposiciones*0.07,0);
				$cot_fonasa = $trabajador->idisapre == 1 ? round($sueldo_imponible_imposiciones*0.064,0) : 0;
				$cot_inp = $trabajador->idisapre == 1 ? round($sueldo_imponible_imposiciones*0.006,0) : 0;				

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
				$dif_isapre = round($trabajador->valorpactado*$parametros->uf,0) - $cot_salud_oblig;
				$adic_isapre = $dif_isapre > 0 ? $dif_isapre : 0;

				if($adic_isapre > 0){
					$tope_salud_tributable = round(($parametros->topeimponible*0.07)*$parametros->uf,0);
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
				$ahorrovol = round($sueldo_imponible*($trabajador->ahorrovol/100),0);	
			}

			$cotapv = 0;
			//echo $trabajador->cotapv." - ". $parametros->uf . " -  ". $trabajador->tipocotapv."<br>";
			//print_r($parametros);
			//echo $parametros->uf; exit;
			if($trabajador->tipocotapv == 'pesos'){
				$cotapv = $trabajador->cotapv;	
			}else if($trabajador->tipocotapv == 'porcentaje'){
				$cotapv = round($sueldo_imponible*($trabajador->cotapv/100),0);	
			}else if($trabajador->tipocotapv == 'uf'){
				$cotapv = round($trabajador->cotapv*$parametros->uf,0);
			}


			$descuentos = round($valor_hora*$datos_remuneracion->horasdescuento,0);


			

			$base_tributaria = $sueldo_imponible - $cot_obligatoria - $comision_afp - $adic_afp - $segcesantia - $cot_salud_oblig - $cot_adic_isapre - $cot_fonasa - $cot_inp;

			$impuesto = 0;
			foreach ($tabla_impuesto as $rango) {
				//echo $base_tributaria." - ".$rango->desde." - ".$rango->hasta." - ".$rebaja."<br>";
				$rango_desde = round(($rango->desde/$diastrabajo)*$datos_remuneracion->diastrabajo,0);
				$rango_hasta = round(($rango->hasta/$diastrabajo)*$datos_remuneracion->diastrabajo,0);
				$rango_rebaja = round(($rango->rebaja/$diastrabajo)*$datos_remuneracion->diastrabajo,0);
				//if($base_tributaria >= $rango->desde && $base_tributaria <= $rango->hasta){
				if($base_tributaria >= $rango_desde && $base_tributaria <= $rango_hasta){
					
					//$impuesto = round($base_tributaria*$rango->factor - $rango->rebaja,0);
					$impuesto = round($base_tributaria*$rango->factor - $rango_rebaja,0);

					break;
				}
			}

			//exit;


			$datos_descuentos = $this->get_descuento($idperiodo,'D',$trabajador->id);
			$monto_descuento = 0;
			foreach ($datos_descuentos as $info_descuento) {
				$monto_descuento += $info_descuento->monto;
				if(!array_key_exists($info_descuento->tipodescuento,$array_descuentos)){
					$array_descuentos[$info_descuento->tipodescuento] = 0;
				}
				$array_descuentos[$info_descuento->tipodescuento] += $info_descuento->monto; // suma montos por tipo de descuento
			}


			$datos_prestamos = $this->get_descuento($idperiodo,'P',$trabajador->id);
			$monto_prestamos = 0;
			foreach ($datos_prestamos as $info_prestamos) {
				$monto_prestamos += $info_prestamos->monto;
				if(!array_key_exists($info_prestamos->tipodescuento,$array_prestamos)){
					$array_prestamos[$info_prestamos->tipodescuento] = 0;
				}
				$array_prestamos[$info_prestamos->tipodescuento] += $info_prestamos->monto; // suma montos por tipo de descuento				
			}



			$total_descuentos = $cot_obligatoria + $comision_afp + $adic_afp + $segcesantia + $cot_salud_oblig + $cot_fonasa + $cot_inp + $adic_isapre + $impuesto + $ahorrovol + $cotapv + $datos_remuneracion->anticipo + $descuentos + $monto_descuento + $monto_prestamos + $datos_remuneracion->aguinaldo;
			$total_leyes_sociales = $cot_obligatoria + $comision_afp + $adic_afp + $segcesantia + $cot_salud_oblig + $cot_fonasa + $cot_inp + $adic_isapre + $impuesto + $ahorrovol + $cotapv;
			$otros_descuentos = $total_descuentos - $total_leyes_sociales;			

			$sueldo_liquido = $total_haberes - $total_descuentos;

			if($trabajador->pensionado == 1){
				$seginvalidez = 0;
			}else{
				if($datos_remuneracion->diastrabajo < 30){

					$sueldo_calculo_sis = $trabajador->sueldobase + $aguinaldo_bruto + $bonos_imponibles;
				}else{
					$sueldo_calculo_sis = $sueldo_imponible;
				}

				$seginvalidez = round($sueldo_calculo_sis*($parametros->tasasis/100),0);

			}
			#$seginvalidez = $trabajador->pensionado == 1 ? 0 : round($sueldo_imponible*($parametros->tasasis/100),0);
			#SI TRABAJADOR TIENE LICENCIA MEDIDA, ENTONCES SE CALCULA POR SUELDO IMPONIBLE PROPORCIONAL A DIAS TRABAJADOS
			#Y POR DIAS NO TRABAJADOS, EL PROPORCIONAL AL SUELDO IMPONIBLE ANTEIOR.  SI NO EXISTE, EN BASE AL CONTRATO

			#1.- VERIFICAR SI TIENE LICENCIA EN EL PERÍODO
			$movimientos = $this->get_lista_movimientos($trabajador->id,null,$idperiodo,3);
			$tiene_licencia = count($movimientos) > 0 ? true : false;

			//ocupo esta query para sacar el ultimo sueldo imponible, sino tomar suedo base según contrato.
			/*select r.sueldoimponible from gc_remuneracion r
inner join gc_periodo p on r.idperiodo = p.id
where idpersonal = 41 and diastrabajo > 0
order by p.anno desc, p.mes desc
limit 1		*/	
			$aportesegcesantia = 0;
			if($trabajador->segcesantia == 1){
				if($trabajador->annos_afc <= 11){
					$aportesegcesantia = $trabajador->tipocontrato == 'F' ? round($sueldo_imponible*0.03,0) : round($sueldo_imponible*0.024,0);
				}else{
					$aportesegcesantia = $trabajador->tipocontrato == 'F' ? round($sueldo_imponible*0.002,0) : round($sueldo_imponible*0.008,0);
				}
			}else{
				$aportesegcesantia = 0;	
			}	
			//echo $aportesegcesantia; exit;

			if($tiene_licencia && $datos_remuneracion->diastrabajo < 30){ // SI TIENE LICENCIA SE DEBE SUMAR AL SEGURO LOS DÍAS NO TRABAJADOS POR EL PROPORCIONAL 
				$imponibles_no_trabajo = round((($trabajador->sueldobase + $aguinaldo_bruto + $bonos_imponibles + $gratificacion)/$diastrabajo)*(30-$datos_remuneracion->diastrabajo),0);
				if($trabajador->segcesantia == 1){
					if($trabajador->annos_afc <= 11){
						
						$aportesegcesantia += $trabajador->tipocontrato == 'F' ? round($imponibles_no_trabajo*0.03,0) : round($imponibles_no_trabajo*0.024,0);
					}else{
						$aportesegcesantia += $trabajador->tipocontrato == 'F' ? round($imponibles_no_trabajo*0.002,0) : round($imponibles_no_trabajo*0.008,0);
					}
				}else{
					$aportesegcesantia = 0;	
				}	

			}

							

			$aportepatronal = is_null($empresa->idmutual) ? 0 : round($sueldo_imponible*($empresa->porcmutual/100),0);
			$suma_aporte_patronal += $aportepatronal;
			$suma_impuesto += $impuesto;

			$data_remuneracion = array(
					'ufperiodo' => $parametros->uf,
					'sueldobase' => $sueldo_base_mes,
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
					'sueldoimponible' => $sueldo_imponible,
					'sueldonoimponible' => $sueldo_no_imponible,
					'sueldoimponibleimposiciones' => $sueldo_imponible_imposiciones,
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
					'totaldescuentos' => $total_descuentos,
					'sueldoliquido' => $sueldo_liquido,
					'seginvalidez' => $seginvalidez,
					'aportesegcesantia' => $aportesegcesantia,
					'aportepatronal' => $aportepatronal,
					'pdf_content' => null,				
					'active' => 1
				);
			$this->db->where('idpersonal', $datos_remuneracion->idpersonal);
			$this->db->where('idperiodo', $datos_remuneracion->idperiodo);
			$this->db->update('gc_remuneracion',$data_remuneracion); 	

			// VUELVE A CERO LA ASIGNACION FAMILIAR POR CARGAS RETROACTIVAS
			$this->db->where('id', $trabajador->id);
			$this->db->update('gc_personal',array('asigfamiliar' => 0,
												'cargasretroactivas' => 0)); 	


			// AGREGA CUENTA CON SUELDO LIQUIDO
			//$cuenta_sueldo = $sueldo_liquido - $datos_remuneracion->aguinaldo;
			$cuenta_sueldo = $sueldo_liquido;
			
       		$datos_cuenta = array(
       						'formapago' => 'gc',
       						'nombreproveedor' => $trabajador->nombre." ".$trabajador->apaterno." ".$trabajador->amaterno,
       						'documento' =>  date("Ym").$trabajador->id,
       						'tipodoc' =>  $cuenta_sueldo >= 0 ? 8 : 4, //SI ES NEGATIVO ES NOTA DE CRÉDITO
       						'fecdocumento' => $periodo->anno."-".str_pad($periodo->mes,2,"0",STR_PAD_LEFT)."-".$dia_mes,
       						'concepto' =>  52, //revisar
       						'descripcion' => "Remuneraciones " .date2string($periodo->mes,$periodo->anno),
       						'monto' => abs($cuenta_sueldo),
       						'idperiodo' => $idperiodo
			       			);
       		$this->account->add_cuenta_remuneracion($datos_cuenta);



       		if(is_null($periodo->anticipo)){  #SOLO SE CREAN LAS CUENTAS SI NO SE TRASPASARON DATOS
	       		if($datos_remuneracion->anticipo > 0){ // AGREGA CUENTA POR ANTICIPO
		       		$datos_cuenta = array(
		       						'formapago' => 'gc',
		       						'nombreproveedor' => $trabajador->nombre." ".$trabajador->apaterno." ".$trabajador->amaterno,
		       						'documento' =>  date("Ym").$trabajador->id,
		       						'tipodoc' =>  9,
		       						'fecdocumento' => $periodo->anno."-".str_pad($periodo->mes,2,"0",STR_PAD_LEFT)."-15",
		       						'concepto' =>  53, //revisar
		       						'descripcion' => "Anticipo Remuneraciones " .date2string($periodo->mes,$periodo->anno),
		       						'monto' => $datos_remuneracion->anticipo,
		       						'idperiodo' => $idperiodo
					       			);
		       		$this->account->add_cuenta_remuneracion($datos_cuenta);

	       		}

	       		if($datos_remuneracion->aguinaldo > 0){

	 	       		$datos_cuenta = array(
		       						'formapago' => 'gc',
		       						'nombreproveedor' => $trabajador->nombre." ".$trabajador->apaterno." ".$trabajador->amaterno,
		       						'documento' =>  date("Ym").$trabajador->id,
		       						'tipodoc' =>  10,
		       						'fecdocumento' => $periodo->anno."-".str_pad($periodo->mes,2,"0",STR_PAD_LEFT)."-".$dia_mes,
		       						'concepto' =>  54, //revisar
		       						'descripcion' => "Aguinaldo Remuneraciones " .date2string($periodo->mes,$periodo->anno),
		       						'monto' => $datos_remuneracion->aguinaldo,
		       						'idperiodo' => $idperiodo
					       			);
		       		$this->account->add_cuenta_remuneracion($datos_cuenta);      			
	       		}
       		}

       		//calculamos los montos detinados a afp

       		if($datos_afp->exregimen != 2){ // omitimos No Cotiza y Pensionado
				$monto_afp = $cot_obligatoria + $comision_afp;
				if(!array_key_exists($trabajador->idafp, $array_pago_afp)){
					$array_pago_afp[$trabajador->idafp]['monto_afp'] = 0;	
					$array_pago_afp[$trabajador->idafp]['monto_sis'] = 0;	
					$array_pago_afp[$trabajador->idafp]['monto_afc'] = 0;	
					$array_pago_afp[$trabajador->idafp]['nombre'] = $datos_afp->nombre;	
				}
				
				$array_pago_afp[$trabajador->idafp]['monto_afp'] += $monto_afp;	
				$array_pago_afp[$trabajador->idafp]['monto_sis'] += $seginvalidez;	
				$array_pago_afp[$trabajador->idafp]['monto_afc'] += $aportesegcesantia + $segcesantia; //SE SUMA APORTE EMPRESA + APORTE EMPLEADOR	
			}


			// calculamos montos destinados a isapre y ips
			if($trabajador->idisapre == 1){
				$suma_ips += $cot_fonasa + $cot_inp;
			}else{
				if(!array_key_exists($trabajador->idisapre, $array_pago_isapre)){
					$datos_isapre = $this->get_isapre($trabajador->idisapre);

					$array_pago_isapre[$trabajador->idisapre]['monto'] = 0;	
					$array_pago_isapre[$trabajador->idisapre]['nombre'] = $datos_isapre->nombre;	
				}	

				$array_pago_isapre[$trabajador->idisapre]['monto'] += $cot_salud_oblig + $adic_isapre;			
			}			

			// CALCULA TOTAL A PAGAR POR CONDOMINIO.  LA SUMA PASARÁ A GGCC
			$monto_total_sueldos += $sueldo_imponible;	

		}


		// AGREGAR DESCUENTOS A GASTO COMUN
		foreach ($array_descuentos as $idtipodescuento => $monto_otros_descuentos) {

				$tipo_descuento = $this->get_tipo_descuento($idtipodescuento);

 	       		$datos_cuenta = array(
	       						'formapago' => 'gc',
	       						'nombreproveedor' => "Otros Descuentos",
	       						'documento' =>  date("Ym").$idtipodescuento,
	       						'tipodoc' =>  12,
	       						'fecdocumento' => $periodo->anno."-".str_pad($periodo->mes,2,"0",STR_PAD_LEFT)."-".$dia_mes,
	       						'concepto' =>  80, //revisar
	       						'descripcion' => "Otros Descuentos " .date2string($periodo->mes,$periodo->anno),
	       						'monto' => $monto_otros_descuentos,
	       						'idperiodo' => $idperiodo
				       			);
	       		$this->account->add_cuenta_remuneracion($datos_cuenta);   
		   	       		 
		}


		// AGREGAR PRESTAMOS A GASTO COMUN
		foreach ($array_prestamos as $idtipodescuento => $monto_descto_prestamos) {

				$tipo_descuento = $this->get_tipo_descuento($idtipodescuento);

 	       		$datos_cuenta = array(
	       						'formapago' => 'gc',
	       						'nombreproveedor' => "Prestamos ".$tipo_descuento->nombre,
	       						'documento' =>  date("Ym").$idtipodescuento,
	       						'tipodoc' =>  12,
	       						'fecdocumento' => $periodo->anno."-".str_pad($periodo->mes,2,"0",STR_PAD_LEFT)."-".$dia_mes,
	       						'concepto' =>  80, //revisar
	       						'descripcion' => "Prestamos " .$tipo_descuento->nombre ." " .date2string($periodo->mes,$periodo->anno),
	       						'monto' => $monto_descto_prestamos,
	       						'idperiodo' => $idperiodo
				       			);
	       		$this->account->add_cuenta_remuneracion($datos_cuenta);   
		   	       		 
		}		




		foreach ($array_pago_afp as $idafp => $pagoafp) {

				if($pagoafp['monto_afp'] > 0){
	 	       		$datos_cuenta = array(
		       						'formapago' => 'gc',
		       						'nombreproveedor' => "AFP ".$pagoafp['nombre'],
		       						'documento' =>  date("Ym").$idafp,
		       						'tipodoc' =>  11,
		       						'fecdocumento' => $periodo->anno."-".str_pad($periodo->mes,2,"0",STR_PAD_LEFT)."-".$dia_mes,
		       						'concepto' =>  55, //revisar
		       						'descripcion' => "Pagos Previsionales AFP Remuneraciones " .date2string($periodo->mes,$periodo->anno),
		       						'monto' => $pagoafp['monto_afp'],
		       						'idperiodo' => $idperiodo
					       			);
		       		$this->account->add_cuenta_remuneracion($datos_cuenta);   
	       		}

	       		if( $pagoafp['monto_afc'] > 0){
		       		$datos_cuenta = array(
	       						'formapago' => 'gc',
	       						'nombreproveedor' => "AFP ".$pagoafp['nombre']." (AFC)",
	       						'documento' =>  date("Ym"),
	       						'tipodoc' =>  11,
	       						'fecdocumento' => $periodo->anno."-".str_pad($periodo->mes,2,"0",STR_PAD_LEFT)."-".$dia_mes,
	       						'concepto' =>  55, //revisar
	       						'descripcion' => "Pagos Previsionales Seguro de Cesant&iacute;a Remuneraciones " .date2string($periodo->mes,$periodo->anno),
	       						'monto' => $pagoafp['monto_afc'],
	       						'idperiodo' => $idperiodo
				       			);
	       			$this->account->add_cuenta_remuneracion($datos_cuenta); 
       			}

       			if($pagoafp['monto_sis'] > 0){
		       		$datos_cuenta = array(
	       						'formapago' => 'gc',
	       						'nombreproveedor' => "AFP ".$pagoafp['nombre']." (SIS)",
	       						'documento' =>  date("Ym"),
	       						'tipodoc' =>  11,
	       						'fecdocumento' => $periodo->anno."-".str_pad($periodo->mes,2,"0",STR_PAD_LEFT)."-".$dia_mes,
	       						'concepto' =>  55, //revisar
	       						'descripcion' => "Pagos Previsionales Seguro de Invalidez y Sobrevivencia Remuneraciones " .date2string($periodo->mes,$periodo->anno),
	       						'monto' => $pagoafp['monto_sis'],
	       						'idperiodo' => $idperiodo
				       			);
	       			$this->account->add_cuenta_remuneracion($datos_cuenta);         		   	       		 
       			}
		}



		foreach ($array_pago_isapre as $idisapre => $pagoisapre) {

				if($pagoisapre['monto'] > 0){
	 	       		$datos_cuenta = array(
		       						'formapago' => 'gc',
		       						'nombreproveedor' => "Isapre ".$pagoisapre['nombre'],
		       						'documento' =>  date("Ym").$idisapre,
		       						'tipodoc' =>  11,
		       						'fecdocumento' => $periodo->anno."-".str_pad($periodo->mes,2,"0",STR_PAD_LEFT)."-".$dia_mes,
		       						'concepto' =>  55, //revisar
		       						'descripcion' => "Pagos Previsionales Isapre Remuneraciones " .date2string($periodo->mes,$periodo->anno),
		       						'monto' => $pagoisapre['monto'],
		       						'idperiodo' => $idperiodo
					       			);
		       		$this->account->add_cuenta_remuneracion($datos_cuenta);   
	       		}
        		   	       		 
		}

		$cargo_ips = $suma_ips - $suma_asig_familiar;

   		if($cargo_ips > 0){

	       		$datos_cuenta = array(
       						'formapago' => 'gc',
       						'nombreproveedor' => 'IPS',
       						'documento' =>  date("Ym"),
       						'tipodoc' =>  11,
       						'fecdocumento' => $periodo->anno."-".str_pad($periodo->mes,2,"0",STR_PAD_LEFT)."-".$dia_mes,
       						'concepto' =>  55, //revisar
       						'descripcion' => "Pagos Previsionales IPS Remuneraciones " .date2string($periodo->mes,$periodo->anno),
       						'monto' => $cargo_ips,
       						'idperiodo' => $idperiodo
			       			);
       		$this->account->add_cuenta_remuneracion($datos_cuenta);      			
   		}		

   		if($suma_aporte_patronal > 0){

	       		$datos_cuenta = array(
       						'formapago' => 'gc',
       						'nombreproveedor' => 'Mutual de Seguridad',
       						'documento' =>  date("Ym"),
       						'tipodoc' =>  11,
       						'fecdocumento' => $periodo->anno."-".str_pad($periodo->mes,2,"0",STR_PAD_LEFT)."-".$dia_mes,
       						'concepto' =>  55, //revisar
       						'descripcion' => "Pagos Previsionales Mutual de Seguridad Remuneraciones " .date2string($periodo->mes,$periodo->anno),
       						'monto' => $suma_aporte_patronal,
       						'idperiodo' => $idperiodo
			       			);
       		$this->account->add_cuenta_remuneracion($datos_cuenta);      			
   		}		



   		if($suma_impuesto > 0){

	       		$datos_cuenta = array(
       						'formapago' => 'gc',
       						'nombreproveedor' => 'Impuesto Segunda Categoría',
       						'documento' =>  date("Ym"),
       						'tipodoc' =>  14,
       						'fecdocumento' => $periodo->anno."-".str_pad($periodo->mes,2,"0",STR_PAD_LEFT)."-".$dia_mes,
       						'concepto' =>  123, //revisar
       						'descripcion' => "Pago Impuesto Remuneraciones " .date2string($periodo->mes,$periodo->anno),
       						'monto' => $suma_impuesto,
       						'idperiodo' => $idperiodo
			       			);
       		$this->account->add_cuenta_remuneracion($datos_cuenta);      			
   		}	

   		/*$cargo_ips = $suma_seg_invalidez - $suma_asig_familiar;
   		if($cargo_ips > 0){

	       		$datos_cuenta = array(
       						'formapago' => 'gc',
       						'nombreproveedor' => 'IPS',
       						'documento' =>  date("Ym"),
       						'tipodoc' =>  11,
       						'fecdocumento' => $periodo->anno."-".str_pad($periodo->mes,2,"0",STR_PAD_LEFT)."-".$dia_mes,
       						'concepto' =>  55, //revisar
       						'descripcion' => "Pagos Previsionales IPS Remuneraciones " .date2string($periodo->mes,$periodo->anno),
       						'monto' => $cargo_ips
			       			);
       		$this->account->add_cuenta_remuneracion($datos_cuenta);      			
   		}	*/


   		/*if($suma_seg_cesantia > 0){

	       		$datos_cuenta = array(
       						'formapago' => 'gc',
       						'nombreproveedor' => 'AFC Chile',
       						'documento' =>  date("Ym"),
       						'tipodoc' =>  11,
       						'fecdocumento' => $periodo->anno."-".str_pad($periodo->mes,2,"0",STR_PAD_LEFT)."-".$dia_mes,
       						'concepto' =>  55, //revisar
       						'descripcion' => "Pagos Previsionales Seguro de Cesant&iacute;a Remuneraciones " .date2string($periodo->mes,$periodo->anno),
       						'monto' => $suma_seg_cesantia
			       			);
       		$this->account->add_cuenta_remuneracion($datos_cuenta);      			
   		}*/

		/*if($monto_total_sueldos > 0){ // AGREGAR CUENTA EN GGCC

       		$parametros = array(
       						'idcargo' => 0,
       						'nombreproveedor' => "Remuneraciones " .date2string($periodo->mes,$periodo->anno),
       						'fecpago' => date("Y-m-d"),
       						'monto' => $monto_total_sueldos,
       						'descripcion' => "Remuneraciones " .date2string($periodo->mes,$periodo->anno),
       						'nombrearchivo' => '',
       						'nombrerealarchivo' => ''
			       			);

       		$this->load->model('account');
			$this->account->add_otros_cargos($parametros);



		}*/

		// CERRAR PERIODO
		$this->db->where('idperiodo', $idperiodo);
		$this->db->where('idcomunidad', $this->session->userdata('empresaid'));
		$this->db->update('gc_periodo_remuneracion',array('cierre' => date("Y-m-d H:i:s"))); 

		$this->db->trans_complete();
		return 1;
	}	


}