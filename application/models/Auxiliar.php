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
		$cargos_data = $this->db->select('c.id , c.idpersonal, c.fecinicio, c.fecfin, c.dias, c.comentarios, c.created_at')
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



public function generar_contenido_comprobante_solicitud($idpersonal,$idcartola){


			$cartola = $this->get_cartola_vacaciones($idpersonal,$idcartola);
			$this->load->model('rrhh_model');
			$personal = $this->rrhh_model->get_personal($idpersonal);

			$this->load->model('admin');
			$empresa = $this->admin->get_empresas($this->session->userdata('empresaid'));


			//$logo = $comunidad->logo == '' || is_null($comunidad->logo) ? 'img/logo4_1_80p_color.png' : 'uploads/logos/'. $this->session->userdata('comunidadid') . '/' . $comunidad->logo;

			//$logo = "images/logos/logo-ecomac-1.png";
			$logo = "";

			//$firma = $comunidad->firma == '' || is_null($comunidad->firma) ? '&nbsp;' : '<img src="uploads/firmas/'. $this->session->userdata('comunidadid') . '/' . $comunidad->firma . '" width="150px"> ';				
			$firma = "&nbsp;";


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
						background-color: #e3ece4; 
						border-collapse: collapse;
						font-family: DejaVuSansCondensed;
						font-size: 9pt; 
						line-height: 1.2;
						margin-top: 2pt; 
						margin-bottom: 5pt; 
						width: 70%;
						topntail: 0.02cm solid #495b4a; 
					}

					.theadClass { 
						font-weight: bold; 
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
						font-size: 11pt; 
						color: #080636;
						font-family: DejaVuSansCondensed, sans-serif; 
						margin-top: 10pt; 
						margin-bottom: 7pt;
						text-align: center;
						margin-collapse:collapse; page-break-after:avoid; }	

						punteada { 
    						border: 1px dashed #278e79; 
  						}									
					</style>
			</head>
					<body>';


			$contenido_comprobante = '
						<p><h4 class="header4"><br>Comprobante de Vacaciones<br><br><!--img src="' . $logo . '" width="100px"--></h4></p>
						<hr>
						<br>
						<div class="recto">
							<h4><b>Fecha:</b> ' . substr($cartola->created_at,8,2) . '/' . substr($cartola->created_at,5,2) . '/' . substr($cartola->created_at,0,4) . '</h4><br>
							<p align="justify">En cumplimiento a las disposiciones legales vigentes se deja constancia que a contar de las fechas que se indican el (la)
								trabajador (a): ' . $personal->nombre . ' ' . $personal->apaterno . ' ' . $personal->amaterno . ', cédula de Identidad ' . number_format($personal->rut,0,".",".") . '-' . $personal->dv . ',  hará uso de: ' . $cartola->dias . ' días hábiles de feriado anual con remuneración íntegra. Esto se hará efectivo entre los días <b>' . substr($cartola->fecinicio,8,2) . ' de ' . month2string(substr($cartola->fecinicio,5,2)) . ' de ' . substr($cartola->fecinicio,0,4) . '</b> y <b>' . substr($cartola->fecfin,8,2) . ' de ' . month2string(substr($cartola->fecfin,5,2)) . ' de ' . substr($cartola->fecfin,0,4) . '</b> inclusive.</p>
						</div>
		';


						if($firma == '&nbsp;'){
							$contenido_comprobante .= '<br><hr><br>
						<br>
						<br>
						<br>';
						}else{
							$contenido_comprobante .= '<br><hr>';
						}

				$contenido_comprobante .='
						<table width="100%" border="0">
							<tr>
								<td width="10%">&nbsp;</td>
								<td width="20%" style="border-bottom:1pt solid black;">&nbsp;</td>
								<td width="40%">&nbsp;</td>
								<td width="20%" style="border-bottom:1pt solid black;">' . $firma . '</td>
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



				$html .= $contenido_comprobante;
				$html .= '<br>
						  <p align="left" style="font-size:8px">COPIA EMPLEADOR</p>
						<hr class="punteada" />';
				$html .= $contenido_comprobante;
				$html .= '<br>
						  <p align="left" style="font-size:8px">COPIA TRABAJADOR</p>';



			$html .=	"</body>
						</html>";

						//echo $html; exit;
				
				//$this->db->where('id',$idegreso);
				//$this->db->update('gc_listado_pagos', array('pdf_content' => $html));			
				return $html;

								

	}	


	public function comprobante_solicitud($idpersonal,$idcartola){

			$this->load->model('admin');
			$datos_empresa = $this->admin->datos_empresa($this->session->userdata('empresaid'));

			$content = $this->generar_contenido_comprobante_solicitud($idpersonal,$idcartola);


			$mpdf = new \Mpdf\Mpdf(['default_font_size' => 7,
									'margin-top' => 16,
									'margin-bottom' => 16,
									'margin-header' => 9,
									'margin-footer' => 9,
									'margin-left' => 10,
									'margin-right' => 5,
									]);
		//	$mpdf->orientation = "L";


			/*$this->load->library("mpdf");
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
				);  */
			//echo $html; exit;
			$mpdf->SetTitle('Is RRHH - Comprobante Solicitud Vacaciones');
			$mpdf->SetHeader('Empresa '. $datos_empresa->nombre . ' - ' .$datos_empresa->comuna . ' - RUT: ' .number_format($datos_empresa->rut,0,".",".") . '-' .$datos_empresa->dv);
			$mpdf->WriteHTML($content);
			$mpdf->SetFooter('Para más información visite: http://www.arnou.cl');


			// SE ALMACENA EL ARCHIVO
			$nombre_archivo = date("Y")."_".date("m")."_".date("d")."_vacaciones_".$idpersonal.".pdf";
			$mpdf->Output($nombre_archivo, "I");
			
	}	


public function delete_vacaciones($idpersonal,$idcartola){

		$this->db->trans_start();
		$cartola = $this->get_cartola_vacaciones($idpersonal,$idcartola);


		if(is_null($cartola)){
			$this->db->trans_complete();
			return false;

		}else{

			$this->db->where('id', $idcartola);
			$this->db->where('idpersonal', $idpersonal);		
			$this->db->update('rem_cartola_vacaciones',array('active' => '0')); 

			$this->db->query('update rem_personal set diasvactomados = diasvactomados - ' . $cartola->dias . ' where id_personal = ' . $idpersonal);


			$this->db->trans_complete();
			return true;
		}

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



	public function add_licencia($array_datos){

		$this->db->trans_start();

		$date_fin_reposo = sumar_dias($array_datos['fec_inicio_reposo'],($array_datos['numero_dias']-1));
		$fecfinreposo = substr($date_fin_reposo,6,4)."-".substr($date_fin_reposo,3,2)."-".substr($date_fin_reposo,0,2);
		$fecinireposo = substr($array_datos['fec_inicio_reposo'],0,4)."-".substr($array_datos['fec_inicio_reposo'],4,2)."-".substr($array_datos['fec_inicio_reposo'],6,2);
		//var_dump_new($array_datos); 
		//var_dump_new($fecfinreposo);
		//exit;
		$array_movimiento = array(
								'idpersonal' => $array_datos['id_personal'],
								'idmovimiento' => 0,
								'movimientos' => 3,
								'comentarios' => 'Ingreso de Licencia Médica',
								'fecmovimiento' => $fecinireposo,
								'fechastamovimiento' => $fecfinreposo,
								'created_at' => date("Ymd H:i:s")
								);

		$this->load->model('rrhh_model');
		$result = $this->rrhh_model->add_movimiento_personal_licencia($array_movimiento);

		$array_movimiento_licencia = array();
		if($result == 5){ //periodo cerrado
				$this->db->trans_complete();
				return 6; //licencia no se puede agregar en el período
		}else if($result == 6){ // periodo inicio distinto a periodo fin, agregar 2 movimientos

			$periodos = periodos_entre_fechas($fecinireposo,$fecfinreposo);
			foreach ($periodos as $periodo_licencia) {

						$array_movimiento = array(
												'idpersonal' => $array_datos['id_personal'],
												'idmovimiento' => 0,
												'movimientos' => 3,
												'comentarios' => 'Ingreso de Licencia Médica',
												'fecmovimiento' => $periodo_licencia['fecha_desde'],
												'fechastamovimiento' => $periodo_licencia['fecha_hasta'],
												'created_at' => date("Ymd H:i:s")
												);
						//var_dump_new($array_movimiento); exit;
						$this->load->model('rrhh_model');
						$result = $this->rrhh_model->add_movimiento_personal_licencia($array_movimiento);
						$movimiento = $this->rrhh_model->get_max_movimiento_licencia_colaborador($array_datos['id_personal']);
						$idmovimiento = isset($movimiento->id_movimiento) ? $movimiento->id_movimiento : 0;
						array_push($array_movimiento_licencia,$idmovimiento);
			}

		}else{

			$movimiento = $this->rrhh_model->get_max_movimiento_licencia_colaborador($array_datos['id_personal']);
			//var_dump_new($movimiento);
			$idmovimiento = isset($movimiento->id_movimiento) ? $movimiento->id_movimiento : 0;
			//var_dump_new($idmovimiento);
			array_push($array_movimiento_licencia,$idmovimiento);

		}

		$array_datos['active'] = 1;
		$array_datos['updated_at'] = date('Ymd H:i:s');
		$array_datos['created_at'] = date('Ymd H:i:s');
		$this->db->insert('rem_licencias_medicas', $array_datos);
		//echo $this->db->last_query()." --- ";

		$idlicenciamedica = $this->db->insert_id();

		// actualiza id de licencia en los movimientos de personal
		$this->db->where_in('id',$array_movimiento_licencia);		
		$this->db->update('rem_lista_movimiento_personal', array('idlicenciamedica' => $idlicenciamedica ));

		$this->db->trans_complete();
		//exit;
		return 1;
		
	}

	public function mod_licencia($array_datos,$id_licencia_medica){

		$this->db->trans_start();
		$this->load->model('rrhh_model');


		// se obtienen datos de licencia
		$datos_licencia = $this->get_licencia_datos($id_licencia_medica);

		// se eliminan los movimientos del personal de cuando se creó licencia

		$movimiento_data = $this->db->select('id as id_movimiento',false)
						  ->from('rem_lista_movimiento_personal lm')
						  ->join('rem_personal p','lm.idpersonal = p.id_personal')
						  ->where('lm.idlicenciamedica',$id_licencia_medica)
						  ->where('lm.active',1)
						  ->where('lm.idmovimiento',3)
						  ->where('p.id_empresa',$this->session->userdata('empresaid'));


		$query = $this->db->get();
		$movimientos =  $query->result();
		foreach ($movimientos as $movimiento) {
			$this->rrhh_model->delete_movimiento_personal_licencia($array_datos['id_personal'],$movimiento->id_movimiento);
		}






		$date_fin_reposo = sumar_dias($array_datos['fec_inicio_reposo'],($array_datos['numero_dias']-1));
		$fecfinreposo = substr($date_fin_reposo,6,4)."-".substr($date_fin_reposo,3,2)."-".substr($date_fin_reposo,0,2);
		$fecinireposo = substr($array_datos['fec_inicio_reposo'],0,4)."-".substr($array_datos['fec_inicio_reposo'],4,2)."-".substr($array_datos['fec_inicio_reposo'],6,2);
		//var_dump_new($array_datos); exit;		



		//delete_movimiento_personal_licencia

		$array_movimiento = array(
								'idpersonal' => $array_datos['id_personal'],
								'idmovimiento' => 0,
								'movimientos' => 3,
								'comentarios' => 'Ingreso de Licencia Médica',
								'fecmovimiento' => $fecinireposo,
								'fechastamovimiento' => $fecfinreposo,
								'created_at' => date("Ymd H:i:s")
								);
		//var_dump_new($array_movimiento); exit;
		
		$result = $this->rrhh_model->add_movimiento_personal_licencia($array_movimiento);
		$array_movimiento_licencia = array();

		if($result == 5){ //periodo cerrado
				$this->db->trans_complete();
				return 6; //licencia no se puede agregar en el período
		}else if($result == 6){ // periodo inicio distinto a periodo fin, agregar tantos movimientos como periodos existan
			$periodos = periodos_entre_fechas($fecinireposo,$fecfinreposo);
			foreach ($periodos as $periodo_licencia) {

						$array_movimiento = array(
												'idpersonal' => $array_datos['id_personal'],
												'idmovimiento' => 0,
												'movimientos' => 3,
												'comentarios' => 'Ingreso de Licencia Médica',
												'fecmovimiento' => $periodo_licencia['fecha_desde'],
												'fechastamovimiento' => $periodo_licencia['fecha_hasta'],
												'created_at' => date("Ymd H:i:s")
												);
						//var_dump_new($array_movimiento); exit;
						$this->load->model('rrhh_model');
						$result = $this->rrhh_model->add_movimiento_personal_licencia($array_movimiento);
						$movimiento = $this->rrhh_model->get_max_movimiento_licencia_colaborador($array_datos['id_personal']);
						$idmovimiento = isset($movimiento->id_movimiento) ? $movimiento->id_movimiento : 0;
						array_push($array_movimiento_licencia,$idmovimiento);


			}
		}else{

			$movimiento = $this->rrhh_model->get_max_movimiento_licencia_colaborador($array_datos['id_personal']);
			//var_dump_new($movimiento);
			$idmovimiento = isset($movimiento->id_movimiento) ? $movimiento->id_movimiento : 0;
			//var_dump_new($idmovimiento);
			array_push($array_movimiento_licencia,$idmovimiento);

		}	


		$array_datos['updated_at'] = date('Ymd H:i:s');
		$this->db->where('id_licencia_medica',$id_licencia_medica);		
		$this->db->update('rem_licencias_medicas', $array_datos);


		// actualiza id de licencia en los movimientos de personal
		$this->db->where_in('id',$array_movimiento_licencia);		
		$this->db->update('rem_lista_movimiento_personal', array('idlicenciamedica' => $id_licencia_medica ));



		$this->db->trans_complete();
		return 1;
		
	}


	public function get_licencias(){

		$array_datos=array(	'p.id_personal',
							'p.nombre', 
							'p.apaterno', 
							'p.amaterno',
							'concat(cast(p.rut as varchar),\'-\',p.dv) as rut',
							'lic.numero_licencia',
							'lic.id_licencia_medica',
							'format(lic.fec_emision_licencia,\'dd/MM/yyyy\',\'en-US\') as fec_emision_licencia',
							'format(lic.fec_inicio_reposo,\'dd/MM/yyyy\',\'en-US\') as fec_inicio_reposo',
							'lic.estado',
							'numero_dias');
		$this->db->select($array_datos)
						  ->from('rem_personal p, rem_licencias_medicas lic')
						  ->where('lic.id_empresa', $this->session->userdata('empresaid'))
						  ->where('lic.id_empresa = p.id_empresa')
						  ->where('lic.id_personal = p.id_personal')
						   ->where('lic.active = 1')
		                  ->order_by('lic.fec_emision_licencia','desc');


		 $query = $this->db->get();
		 return $query->result();

	}


public function get_licencias_by_colaborador($idpersonal){

		$array_datos=array(	'p.id_personal',
							'p.nombre', 
							'p.apaterno', 
							'p.amaterno',
							'concat(cast(p.rut as varchar),\'-\',p.dv) as rut',
							'lic.numero_licencia',
							'lic.id_licencia_medica',
							'format(lic.fec_emision_licencia,\'dd/MM/yyyy\',\'en-US\') as fec_emision_licencia',
							'format(lic.fec_inicio_reposo,\'dd/MM/yyyy\',\'en-US\') as fec_inicio_reposo',
							'lic.estado',
							'numero_dias',
							'tl.nombre as tipo_licencia');
		 $this->db->select($array_datos)
						  ->from('rem_personal p')
						  ->join('rem_licencias_medicas lic','p.id_empresa =lic.id_empresa and p.id_personal = lic.id_personal')
						  ->join('rem_tipo_licencia tl','lic.tipo_licencia =tl.idtipolicencia')
						  ->where('lic.id_empresa', $this->session->userdata('empresaid'))
						   ->where('lic.active = 1')
						  ->where('lic.id_personal',$idpersonal)
		                  ->order_by('lic.fec_emision_licencia','desc');

		 $query = $this->db->get();
		 return $query->result();

	}



public function get_licencia_datos($id_licencia_medica){


		$array_campos = array(
				'p.id_licencia_medica',
				'p.id_personal', 
				'p.id_empresa',
				'p.estado', 
				'format(p.fec_emision_licencia,\'dd/MM/yyyy\',\'en-US\') as fec_emision_licencia',
				'format(p.fec_inicio_reposo,\'dd/MM/yyyy\',\'en-US\') as fec_inicio_reposo', 
				'p.edad',
				'p.sexo',
				'p.numero_dias',
				'p.numero_dias_palabras',
				'p.apaterno_hijo',
				'p.amaterno_hijo',
				'p.nombre_hijo',
				'format(p.fecnachijo,\'dd/MM/yyyy\',\'en-US\') as fecnachijo',
				'p.rut_hijo',
				'p.dv_hijo',
				'p.tipo_licencia',
				'p.recuperabilidad_laboral',
				'p.inicio_tramite_invalidez',
				'format(p.fecha_accidente_trabajo,\'dd/MM/yyyy\',\'en-US\') as fecha_accidente_trabajo',
				'p.horas',
				'p.minutos',
				'p.trayecto',
				'p.tipo_reposo',
				'p.lugar_reposo',
				'p.tipo_reposo_parcial',
				'p.justificar_otro_domicilio',
				'p.direccion_reposo',
				'p.telefono_reposo',
				'p.nombre_profesional',
				'p.apaterno_profesional',
				'p.amaterno_profesional',
				'p.rut_profesional',
				'p.dv_profesional',
				'p.especialidad_profesional',
				'p.tipo_profesional',
				'p.registro_profesional',
				'p.correo_profesional',
				'p.telefono_profesional',
				'p.direccion_emision_licencia',
				'p.fax_profesional',
				'p.diagnostico',
				'p.otro_diagnostico',
				'p.antecedentes_clinicos',
				'p.examenes_apoyo',
				'format(p.updated_at,\'dd/MM/yyyy\',\'en-US\') as updated_at',
				'format(p.created_at,\'dd/MM/yyyy\',\'en-US\') as created_at',
				'p.numero_licencia',
				'c.nombre as nombre',
				'c.apaterno as apaterno',
				'c.amaterno as amaterno',
				'c.fecnacimiento as fecnacimiento',
				'c.rut as rut',
				'c.dv as dv'
				//'format(c.fecnacimiento,\'dd/MM/yyyy\',\'en-US\') as fecnacimiento'			

			);
		
		$licencia_data = $this->db->select($array_campos)
						  ->from('rem_licencias_medicas p, rem_personal c')
						  ->where('p.id_empresa',$this->session->userdata('empresaid'))
						  ->where('p.id_personal = c.id_personal');
		$licencia_data = is_null($id_licencia_medica) ? $licencia_data : $licencia_data->where('p.id_licencia_medica',$id_licencia_medica);
		//$personal_data = !$centro_costo  ? $personal_data : $personal_data->where_in('idcentrocosto',$centro_costo);

		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		$datos =  $query->result();
		return $datos;
	}

	public function del_licencia_medica($id_licencia_medica){

		$this->db->trans_start();

		$datos_licencia = $this->get_licencia_datos($id_licencia_medica);
		//var_dump_new($datos_licencia[0]->id_personal); exit;		

		$this->load->model('rrhh_model');

		// se eliminan los movimientos del personal de cuando se creó licencia

		$movimiento_data = $this->db->select('id as id_movimiento',false)
						  ->from('rem_lista_movimiento_personal lm')
						  ->join('rem_personal p','lm.idpersonal = p.id_personal')
						  ->where('lm.idlicenciamedica',$id_licencia_medica)
						  ->where('lm.active',1)
						  ->where('lm.idmovimiento',3)
						  ->where('p.id_empresa',$this->session->userdata('empresaid'));


		$query = $this->db->get();
		$movimientos =  $query->result();
		foreach ($movimientos as $movimiento) {
			$this->rrhh_model->delete_movimiento_personal_licencia($datos_licencia[0]->id_personal,$movimiento->id_movimiento);
		}


		$this->db->where('id_licencia_medica',$id_licencia_medica);
		$this->db->update('rem_licencias_medicas',array('active' => 0));



		$this->db->trans_complete();
		return 2;
	}




}



