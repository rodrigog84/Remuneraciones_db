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

class Configuracion extends CI_Model
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

	public function get_haberes_descuentos($idhaberdescto = null,$tipo = null){

		$habdescto_data = $this->db->select('d.id, d.codigo, d.tipo, d.nombre, d.editable, d.visible, d.tipocalculo, d.formacalculo, d.imponible, d.fijo, d.proporcional, d.semanacorrida, d.tributable, d.retjudicial, d.otros_aportes')
						  ->from('rem_conf_haber_descuento d')
						  ->join('rem_conf_haber_descuento_empresa de','d.id = de.idconfhd and de.idempresa = ' . $this->session->userdata('empresaid'),'left')
						  ->where('valido = 1')
						  ->where('(editable = 0 or de.idempresa = ' . $this->session->userdata('empresaid') . ')')
						  ->order_by('nombre');
		$habdescto_data = is_null($idhaberdescto) ? $habdescto_data : $habdescto_data->where('id',$idhaberdescto);  		
		$habdescto_data = is_null($tipo) ? $habdescto_data : $habdescto_data->where('d.tipo',$tipo);  		                  
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		$datos = is_null($idhaberdescto) ? $query->result() : $query->row();
		return $datos;

	}

	public function centro_costo($idcentrocosto = null){

		$centrocosto_data = $this->db->select('d.id_centro_costo, d.codigo, d.id_empresa, d.created_at, d.nombre')
			  ->from('rem_centro_costo d')
			  ->where('valido = 1')
			  ->where('(d.id_empresa = ' . $this->session->userdata('empresaid') . ')')
			  ->order_by('nombre');
		$centrocosto_data = is_null($idcentrocosto) ? $centrocosto_data : $centrocosto_data->where('id_centro_costo',$idcentrocosto);  		
		$query = $this->db->get();
		$datos = is_null($idcentrocosto) ? $query->result() : $query->row();
		return $datos;

	}


	public function add_haberes_descuentos($datos,$idhab){

		var_dump($idhab); 
		if($idhab == 0){
			//echo "1"; exit;
			$this->db->insert('rem_conf_haber_descuento',$datos);
			$idhaberdescto = $this->db->insert_id();


			$array_hdemp = array('idconfhd' => $idhaberdescto,
								 'idempresa' => $this->session->userdata('empresaid'));
			$this->db->insert('rem_conf_haber_descuento_empresa',$array_hdemp);

		}else{
			//echo "2"; exit;

			$array_datos = array(
						'tipo' => $datos['tipo'],
						'nombre' => $datos['nombre'],
						'tipocalculo' => $datos['tipocalculo'],
						'formacalculo' => $datos['formacalculo'],
						'codigo' => $datos['codigo'],
						'imponible' => $datos['imponible'],
						'fijo' => $datos['fijo'],
						'proporcional' => $datos['proporcional'],
						'semanacorrida' => $datos['semanacorrida'],
						'retjudicial' => $datos['retjudicial'],
						'tributable' => $datos['tributable'],
				);


			$this->db->where('id',$idhab);
			$this->db->update('rem_conf_haber_descuento',$array_datos);
		}

	}

	public function add_centro_costo($datos,$idcentro){

		var_dump($idcentro); 
		if($idcentro == 0){

			       
	        $array_datos = array(
			'nombre' => $datos['nombre'],
			'codigo' => $datos['codigo'],
			'valido' => 1,
			'id_empresa' => $this->session->userdata('empresaid'),
			'created_at' => date('Ymd H:i:s'),
			'updated_at' => date('Ymd H:i:s')			
			);

			$this->db->insert('rem_centro_costo',$array_datos);
	        	

	  

		}else{

			$array_datos = array(
			'nombre' => $datos['nombre'],
			'codigo' => $datos['codigo'],
			'id_empresa' => $this->session->userdata('empresaid'),
			'updated_at' => date('Ymd H:i:s'),
					
		     );

			$this->db->where('id_centro_costo',$idcentro);
			$this->db->update('rem_centro_costo',$array_datos);
			
		}



	}




public function add_plantilla_banco($array_datos_maestro,$array_datos_detalle,$id_plantilla_banco){


		$this->db->trans_start();
		$datos = $this->db->select('id_plantilla_banco, active')
						  ->from('rem_plantilla_banco')
		                  ->where('id_banco', $array_datos_maestro['id_banco'])
		                  ->where('id_empresa', $this->session->userdata('empresaid'));		
		
		$datos = is_null($id_plantilla_banco)	? $datos : $datos->where('id_plantilla_banco',$id_plantilla_banco);
		$query = $this->db->get();
		$datos = is_null($id_plantilla_banco) ? $query->result() : $query->row();


		if(count($datos) == 0){ // nuevo trabajador no existe
			if(count($datos) == 0){
				$array_datos_maestro['updated_at'] = date('Ymd H:i:s');
				$array_datos_maestro['created_at'] = date('Ymd H:i:s');
				$array_datos_maestro['id_empresa'] = $this->session->userdata('empresaid');

				$this->db->insert('rem_plantilla_banco', $array_datos_maestro);
				$id_plantilla_banco = $this->db->insert_id();

				$array_datos_detalle['id_plantilla_banco'] = $id_plantilla_banco;
			
				$array_datos_detalle['updated_at'] = date('Ymd H:i:s');
				$array_datos_detalle['created_at'] = date('Ymd H:i:s');

				//var_dump($array_datos_detalle);

								

				for ($i = 0; $i < 14; $i++){

					$array_datos = array(
							'seq' => $array_datos_detalle['seq'][$i],
							'nombre_campo' => $array_datos_detalle['nombre_campo'][$i],
							'tipo' => $array_datos_detalle['tipo'][$i],
							'largo' => $array_datos_detalle['largo'][$i],
							'inicio' => $array_datos_detalle['inicio'][$i],
							'fin' => $array_datos_detalle['fin'][$i],
							'Observacion' => $array_datos_detalle['Observacion'][$i],
							'active' => $array_datos_detalle['active'][$i],
							'nombre_tabla' => $array_datos_detalle['nombre_tabla'][$i],
							'id_plantilla_banco' => $array_datos_detalle['id_plantilla_banco'],
							'updated_at' => $array_datos_detalle['updated_at'],
							'created_at' => $array_datos_detalle['created_at']

					);
				

					$this->db->insert('rem_det_plantilla_banco', $array_datos);
				}

				//	};
				$this->db->trans_complete();
				//return 1;
			}else{

				$array_datos_maestro['updated_at'] = date('Ymd H:i:s');
				
	
				$this->db->where('id_plantilla_banco',$id_plantilla_banco);
				$this->db->update('rem_plantilla_banco',$array_datos_maestro);
				
				$array_datos_detalle['updated_at'] = date('Ymd H:i:s');
				for ($i = 0; $i < 14; $i++){
					
					$array_datos = array(
							'seq' => $array_datos_detalle['seq'][$i],
							'nombre_campo' => $array_datos_detalle['nombre_campo'][$i],
							'tipo' => $array_datos_detalle['tipo'][$i],
							'largo' => $array_datos_detalle['largo'][$i],
							'inicio' => $array_datos_detalle['inicio'][$i],
							'fin' => $array_datos_detalle['fin'][$i],
							'Observacion' => $array_datos_detalle['Observacion'][$i],						
							'nombre_tabla' => $array_datos_detalle['nombre_tabla'][$i],
							'active' => $array_datos_detalle['active'][$i],					
							'updated_at' => $array_datos_detalle['updated_at']						

					);
					
					$this->db->where('id_plantilla_banco',$id_plantilla_banco);
					$this->db->where('id_det_plantilla_banco',$array_datos_detalle['id_det_plantilla_banco'][$i]);
					$this->db->update('rem_det_plantilla_banco',$array_datos);
				
				}
				
				$this->db->trans_complete();
				return 1;

			}

			
		}else{ 
				$array_datos_maestro['updated_at'] = date('Ymd H:i:s');
				
	
				$this->db->where('id_plantilla_banco',$id_plantilla_banco);
				$this->db->update('rem_plantilla_banco',$array_datos_maestro);
				
				$array_datos_detalle['updated_at'] = date('Ymd H:i:s');
				for ($i = 0; $i < 14; $i++){
					
					$array_datos = array(
							'seq' => $array_datos_detalle['seq'][$i],
							'nombre_campo' => $array_datos_detalle['nombre_campo'][$i],
							'tipo' => $array_datos_detalle['tipo'][$i],
							'largo' => $array_datos_detalle['largo'][$i],
							'inicio' => $array_datos_detalle['inicio'][$i],
							'fin' => $array_datos_detalle['fin'][$i],
							'Observacion' => $array_datos_detalle['Observacion'][$i],						
							'nombre_tabla' => $array_datos_detalle['nombre_tabla'][$i],
							'active' => $array_datos_detalle['active'][$i],					
							'updated_at' => $array_datos_detalle['updated_at']						

					);
					
					$this->db->where('id_plantilla_banco',$id_plantilla_banco);
					$this->db->where('id_det_plantilla_banco',$array_datos_detalle['id_det_plantilla_banco'][$i]);
					$this->db->update('rem_det_plantilla_banco',$array_datos);
				
				}
				
				$this->db->trans_complete();
				return 1;	
		}

	}	



	//FUNCION ORIGINAL
	/*public function exporta_plantilla_banco($datos_personal,$nombre_banco,$nombre_tabla,$largo_campo){

			$nombre_archivo = $this->session->userdata('empresaid')."_".$nombre_banco."_".date("Ymd").".txt";
			$path_archivo = "./uploads/tmp/";
			$file = fopen($path_archivo.$nombre_archivo, "w");
			
			$numero_columnas = sizeof($nombre_tabla);

			foreach ($datos_personal as $dat) {
			
				$linea = str_pad(substr(sanear_string($dat->$nombre_tabla[0]),0,20),$largo_campo[0]," ",STR_PAD_RIGHT);
				for ($i = 1 ; $i < $numero_columnas ; $i++){
					
					//$dat->$nombre_tabla[$i] = ($dat->$nombre_tabla[$i] =='cod_sbif' ) ? '016' : '1' ;

					$linea .= str_pad(substr(sanear_string($dat->$nombre_tabla[$i]),0,20),$largo_campo[$i]," ",STR_PAD_RIGHT);					
				
				};

				$linea .= "\r\n";
				fputs($file,$linea);

			}

			
			fclose($file);
					
			$data_archivo = basename($path_archivo.$nombre_archivo);
			header('Content-Type: text/plain');
			header('Content-Disposition: attachment; filename=' . $data_archivo);
			header('Content-Length: ' . filesize($path_archivo.$nombre_archivo));
			readfile($path_archivo.$nombre_archivo);		


			unlink($path_archivo.$nombre_archivo);

	}*/
	

	public function exporta_plantilla_banco($datos_personal,$nombre_banco,$nombre_tabla,$largo_campo){

			$nombre_archivo = $this->session->userdata('empresaid')."_".$nombre_banco."_".date("Ymd").".txt";
			$path_archivo = "./uploads/tmp/";
			$file = fopen($path_archivo.$nombre_archivo, "w");
			
			//echo "<pre>";
			//print_r($datos_personal);// exit;
			//dato fijo, después modificar
			$this->load->model('admin');
			$empresa = $this->admin->get_empresas($this->session->userdata('empresaid'));
			echo "<pre>";
			var_dump($empresa); //exit;
			$linea_encabezado = "01"; //Tipo Registro
			$linea_encabezado .= str_pad($empresa->rut,9,"0",STR_PAD_LEFT);//RUT
			$linea_encabezado .= $empresa->dv;//DV
			$linea_encabezado .= "001";//codigo convenio**** (VER QUE VALOR CORRESPONDE)
			$linea_encabezado .= "00001";//NRO NOMINA**** (VER QUE VALOR CORRESPONDE)
			$linea_encabezado .= str_pad(substr(sanear_string($empresa->nombre),0,25),25," ",STR_PAD_RIGHT);//NOMBRE DE NOMINA
			$linea_encabezado .= "01";//codigo DE NOMINA (PESOS)
			$linea_encabezado .= "20190531";//FECHA DEL PAGO
			$linea_encabezado .= "0000000000000";//MONTO PAGO
			$linea_encabezado .= "   ";//ESPACIOS EN BLANCO
			$linea_encabezado .= "N";//TIPO ENDOSO VALE VISTA
			$linea_encabezado .= "                                                                                                                                                                                                                                                                                                                                    ";//ESPACIOS EN BLANCO
			$linea_encabezado .= "0101";//TIPO DE PAGO
			//$linea .= "\r\n";

			fputs($file,$linea_encabezado);
			$numero_columnas = sizeof($nombre_tabla);

			foreach ($datos_personal as $dat) {
			//	echo "<pre>";
			//	print_r($datos_personal);
				//print_R($nombre_tabla); exit;

				//$linea = str_pad(substr(sanear_string($dat->$nombre_tabla[0]),0,20),$largo_campo[0]," ",STR_PAD_RIGHT);

				$cod_medio_pago = $dat->$nombre_tabla[0] == '16128023' ? '070' : '010';
				$linea = "02076605109K001  00001".$cod_medio_pago.str_pad(substr(sanear_string($dat->$nombre_tabla[0]),0,20),$largo_campo[0]," ",STR_PAD_RIGHT);
				$nombre = '';
				for ($i = 1 ; $i < $numero_columnas ; $i++){
					if($i == 2 || $i == 3 || $i == 4|| $i == 6){
						//$nombre .= $dat->$nombre_tabla[$i]." ";
					}else{
						if($i == 5){

							$linea .= str_pad(sanear_string($dat->$nombre_tabla[2])." " . sanear_string($dat->$nombre_tabla[3]) . " " .sanear_string($dat->$nombre_tabla[4]),60," ",STR_PAD_RIGHT)."0                                   ";
							$linea .= "                                     BC".$dat->$nombre_tabla[9].str_pad((float)$dat->$nombre_tabla[11],22," ",STR_PAD_RIGHT)."000".str_pad((float)$dat->$nombre_tabla[13],11,"0",STR_PAD_LEFT)."00";
							$linea .="Sueldo Liquido                                                                                                                                                                                ";
						}else if ($i == 1){
							$linea .= str_pad(substr(sanear_string($dat->$nombre_tabla[$i]),0,20),$largo_campo[$i]," ",STR_PAD_RIGHT);	

						}
							
					}
					//$dat->$nombre_tabla[$i] = ($dat->$nombre_tabla[$i] =='cod_sbif' ) ? '016' : '1' ;

								
				
				};

				$linea .= "\r\n";
				fputs($file,$linea);

			}

			//echo "<pre>";
			//echo $linea; 
			fclose($file);
					
			$data_archivo = basename($path_archivo.$nombre_archivo);
			header('Content-Type: text/plain');
			header('Content-Disposition: attachment; filename=' . $data_archivo);
			header('Content-Length: ' . filesize($path_archivo.$nombre_archivo));
			readfile($path_archivo.$nombre_archivo);		


			unlink($path_archivo.$nombre_archivo);

	}

	public function del_plantilla_banco($id_plantilla_banco){

		$this->db->trans_start();
		$this->db->delete('rem_plantilla_banco', array('id_plantilla_banco' => $id_plantilla_banco));
		$this->db->delete('rem_det_plantilla_banco', array('id_plantilla_banco' => $id_plantilla_banco)); 

		$this->db->trans_complete();
		return 1;

			}



	public function get_plantilla_banco($id_plantilla_banco=null){

		$banco_data = $this->db->select("p.id_plantilla_banco, p.id_banco,p.active,p.descripcion, b.nombre")
						  ->from('rem_plantilla_banco p, rem_banco b')
						  ->where('p.active = 1')
						  ->where('p.id_banco = b.id_banco')
						  ->where('p.id_empresa',$this->session->userdata('empresaid'))
		                  ->order_by('nombre asc');

		 $banco_data = is_null($id_plantilla_banco) ? $banco_data : $banco_data->where('p.id_plantilla_banco',$id_plantilla_banco); 


			                  
		$query = $this->db->get();
		$datos = is_null($id_plantilla_banco) ? $query->result() : $query->row();
		return $datos;

	}	


	public function get_det_plantilla_banco($id_plantilla_banco=null){

		$banco_data = $this->db->select('d.id_plantilla_banco,d.id_det_plantilla_banco,d.seq,d.nombre_campo,d.tipo,d.largo,d.inicio,d.fin,
										d.Observacion,d.nombre_tabla,d.active')
						  ->from('rem_plantilla_banco p, rem_det_plantilla_banco d')
						  ->where('p.id_plantilla_banco',$id_plantilla_banco)
						  ->where('p.id_plantilla_banco = d.id_plantilla_banco')
						  ->where('p.id_empresa',$this->session->userdata('empresaid'))
						  ->where('p.active = 1')
						  ->order_by('d.id_det_plantilla_banco asc');
		               			                  
		
		$query = $this->db->get();
		//$datos = is_null($id_plantilla_banco) ? $query->result() : $query->row();
		
		//return $datos;
		return $query->result();
		
            
	}



	public function get_det_plantilla_banco_export($id_plantilla_banco=null){

		$banco_data = $this->db->select('d.id_plantilla_banco,d.id_det_plantilla_banco,d.seq,d.nombre_campo,d.tipo,d.largo,d.inicio,d.fin,
										d.Observacion,d.nombre_tabla,d.active')
						  ->from('rem_plantilla_banco p, rem_det_plantilla_banco d')
						  ->where('p.id_plantilla_banco',$id_plantilla_banco)
						  ->where('p.id_plantilla_banco = d.id_plantilla_banco')
						  ->where('p.id_empresa',$this->session->userdata('empresaid'))
						  ->where('p.active = 1')
						  ->where('d.active = 1')
						  ->order_by('d.seq asc');
		               			                  
		
		$query = $this->db->get();
		//$datos = is_null($id_plantilla_banco) ? $query->result() : $query->row();
		
		//return $datos;
		return $query->result();
		
            
	}

	public function get_personal_plantilla($id_periodo, $id_plantilla_banco){

		$doc = 'doc';
		$oficina_pago = '041';
		$banco_data = $this->db->select(	'p.rut,
											p.dv,
											p.apaterno,
											p.amaterno,
											p.nombre,
											p.direccion,
											com.nombre as idcomuna,
											fp.descripcion as id_forma_pago,
											rem.sueldoliquido,
											RIGHT(REPLICATE(\'0\', 20)+ CAST(nrocuentabanco AS VARCHAR(20)),20) as nrocuentabanco,
											p.id_plantilla_banco, 
											ban.cod_sbif,
											tip.alias, 
											\'00001\' as documento, 																				
											\'044\' as oficina_pago, 
											replace(CONVERT(VARCHAR(10), GETDATE(), 103),\'/\',\'\') as fecha_pago
											')
				  ->from('rem_personal p, rem_formas_pago fp, rem_comuna com, rem_remuneracion rem, rem_banco ban, rem_tipo_cuenta_banco tip')
				  ->where('p.id_plantilla_banco',$id_plantilla_banco)
				  ->where('rem.id_periodo',$id_periodo)
				  ->where('p.id_empresa',$this->session->userdata('empresaid'))
				  ->where('p.id_forma_pago = fp.id_forma_pago')
				  ->where('p.idcomuna = com.idcomuna')
				  ->where('p.id_forma_pago',3)
				  ->where('p.id_personal = rem.idpersonal')
				  ->where('p.idbanco = ban.id_banco')
				  ->where('p.id_tipo_cuenta_bancaria = tip.id_tipo_cuenta_banco');

		/*$query = $this->db->get();
		$datos = is_null($id_banco) ? $query->result() : $query->row();
		return $datos;*/
		$query = $this->db->get();
		//$datos = is_null($id_plantilla_banco) ? $query->result() : $query->row();
		
		//return $datos;
		return $query->result();
	}


}



