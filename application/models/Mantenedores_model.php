<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mantenedores_model extends CI_Model
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



	public function get_nacionalidad(){
		$this->db->select('id_paises, iso, nombre')
						  ->from('rem_paises')
						  ->order_by('nombre','asc');
		 $query = $this->db->get();
		 return $query->result();

	}

	public function get_regiones(){
		$this->db->select('id_region, nombre')
						  ->from('rem_region')
						  ->order_by('nombre','asc');
		 $query = $this->db->get();
		 return $query->result();

	}

	public function get_idioma(){
		$this->db->select('id_idioma, nombre')
						  ->from('rem_idioma')
						  ->order_by('nombre','asc');
		 $query = $this->db->get();
		 return $query->result();

	}

	public function get_categoria(){
		$this->db->select('id_categoria, nombre')
						  ->from('rem_categoria')
						  ->order_by('nombre','asc');
		 $query = $this->db->get();
		 return $query->result();

	}

	public function get_cargos(){
		$this->db->select('id_cargos, nombre, activo')
						  ->from('rem_cargos')
						  ->where('activo = 1')
						  ->order_by('nombre','asc');
		 $query = $this->db->get();
		 return $query->result();

	}

	public function get_bancos(){
		$this->db->select('id_banco, cod_sbif, nombre, activo')
						  ->from('rem_banco')
						  ->where('activo = 1')
						  ->order_by('nombre','asc');
		 $query = $this->db->get();
		 return $query->result();

	}

	public function get_lugarpago(){
		$this->db->select('id_lugar_pago, nombre, activo')
						  ->from('rem_lugar_pago')
						  ->where('activo = 1')
						  ->order_by('nombre','asc');
		 $query = $this->db->get();
		 return $query->result();

	}

	public function get_formadepago(){
		$this->db->select('id_forma_pago, descripcion, activo')
						  ->from('rem_formas_pago')
						  ->where('activo = 1')
						  ->order_by('descripcion','asc');
		 $query = $this->db->get();
		 return $query->result();

	}

	public function get_estudios(){
		$this->db->select('id_estudios, nombre, valido')
						  ->from('rem_estudios')
						  ->where('valido = 1')
						  ->order_by('nombre','asc');
		 $query = $this->db->get();
		 return $query->result();

	}

	public function get_estadocivil(){
		$this->db->select('id_estado_civil, nombre, activo')
						  ->from('rem_estado_civil')
						  ->where('activo = 1')
						  ->order_by('nombre','asc');
		 $query = $this->db->get();
		 return $query->result();

	}

	public function get_licenciaconducir(){
		$this->db->select('id_licencia_conducir, nombre, valido')
						  ->from('rem_licencia_conducir')
						  ->where('valido = 1')
						  ->order_by('nombre','asc');
		 $query = $this->db->get();
		 return $query->result();

	}

	public function get_empresa(){
		$this->db->select('d.id_empresa, d.nombre, d.rut, d.dv, d.direccion , d.active, c2.nombre as nombrecomuna, c3.nombre as nombreregion')
			  ->from('rem_empresa d')
			  ->join('rem_comuna c2','d.idcomuna = c2.idcomuna','left')
			  ->join('rem_region c3','d.idregion = c3.id_region','left')
			  ->where('d.active = 1')
			  ->order_by('nombre');
		 $query = $this->db->get();
		 return $query->result();

	}

	public function get_comuna(){
		$this->db->select('d.idcomuna, d.idprovincia, d.nombre, c2.nombre as provincia')
			  ->from('rem_comuna d')
			  ->join('rem_provincia c2','d.idprovincia = c2.idprovincia','left')
			  ->order_by('nombre');
		 $query = $this->db->get();
		 return $query->result();

	}

	public function nacionalidad($idnacionalidad = null){

		$nacionalidad_data = $this->db->select('d.id_paises, d.iso, d.created_at, d.nombre')
			  ->from('rem_paises d')
			  ->order_by('nombre');
		$nacionalidad_data = is_null($idnacionalidad) ? $nacionalidad_data : $nacionalidad_data->where('id_paises',$idnacionalidad);  		
		$query = $this->db->get();
		$datos = is_null($idnacionalidad) ? $query->result() : $query->row();
		return $datos;

	}

	public function regiones($idregiones = null){

		$regiones_data = $this->db->select('d.id_region, d.created_at, d.nombre')
			  ->from('rem_region d')
			  ->order_by('nombre');
		$regiones_data = is_null($idregiones) ? $regiones_data : $regiones_data->where('id_region',$idregiones);  		
		$query = $this->db->get();
		$datos = is_null($idregiones) ? $query->result() : $query->row();
		return $datos;

	}

	public function idioma($ididioma = null){

		$idioma_data = $this->db->select('d.id_idioma, d.created_at, d.nombre')
			  ->from('rem_idioma d')
			  ->order_by('nombre');
		$idioma_data = is_null($ididioma) ? $idioma_data : $idioma_data->where('id_idioma',$ididioma);  		
		$query = $this->db->get();
		$datos = is_null($ididioma) ? $query->result() : $query->row();
		return $datos;

	}

	public function categoria($idcategoria = null){

		$categoria_data = $this->db->select('d.id_categoria, d.created_at, d.nombre')
			  ->from('rem_categoria d')
			  ->order_by('nombre');
		$categoria_data = is_null($idcategoria) ? $categoria_data : $categoria_data->where('id_categoria',$idcategoria);  		
		$query = $this->db->get();
		$datos = is_null($idcategoria) ? $query->result() : $query->row();
		return $datos;

	}

	public function cargos($idcargo = null){


		$cargos_data = $this->db->select('d.id_cargos, d.created_at, d.nombre, d.activo')
			  ->from('rem_cargos d')
			  ->where('d.activo = 1')
			  ->order_by('nombre');
		$cargos_data = is_null($idcargo) ? $cargos_data : $cargos_data->where('id_cargos',$idcargo);  		
		$query = $this->db->get();
		$datos = is_null($idcargo) ? $query->result() : $query->row();
		return $datos;

	}

	public function bancos($idbanco = null){


		$bancos_data = $this->db->select('d.id_banco, d.cod_sbif, d.updated_at, d.nombre, d.activo')
			  ->from('rem_banco d')
			  ->where('d.activo = 1')
			  ->order_by('nombre');
		$bancos_data = is_null($idbanco) ? $bancos_data : $bancos_data->where('id_banco',$idbanco);  		
		$query = $this->db->get();
		$datos = is_null($idbanco) ? $query->result() : $query->row();
		return $datos;

	}

	public function lugarpago($idlugarpago = null){


		$lugarpago_data = $this->db->select('d.id_lugar_pago, d.updated_at, d.nombre, d.activo')
			  ->from('rem_lugar_pago d')
			  ->where('d.activo = 1')
			  ->order_by('nombre');
		$lugarpago_data = is_null($idlugarpago) ? $lugarpago_data : $lugarpago_data->where('id_lugar_pago',$idlugarpago);  		
		$query = $this->db->get();
		$datos = is_null($idlugarpago) ? $query->result() : $query->row();
		return $datos;

	}

	public function formapago($idformapago = null){


		$formapago_data = $this->db->select('d.id_forma_pago, d.updated_at, d.descripcion, d.activo')
			  ->from('rem_formas_pago d')
			  ->where('d.activo = 1')
			  ->order_by('descripcion');
		$formapago_data = is_null($idformapago) ? $formapago_data : $formapago_data->where('id_forma_pago',$idformapago);  		
		$query = $this->db->get();
		$datos = is_null($idformapago) ? $query->result() : $query->row();
		return $datos;

	}

	public function estudios($idestudios = null){

		$estudios_data = $this->db->select('d.id_estudios, d.nombre, d.valido')
			  ->from('rem_estudios d')
			  ->where('d.valido = 1')
			  ->order_by('nombre');
		$estudios_data = is_null($idestudios) ? $estudios_data : $estudios_data->where('id_estudios',$idestudios);  		
		$query = $this->db->get();
		$datos = is_null($idestudios) ? $query->result() : $query->row();
		return $datos;

	}

	public function estadocivil($idestadocivil = null){

		$estadocivil_data = $this->db->select('d.id_estado_civil, d.nombre, d.activo')
			  ->from('rem_estado_civil d')
			  ->where('d.activo = 1')
			  ->order_by('nombre');
		$estadocivil_data = is_null($idestadocivil) ? $estadocivil_data : $estadocivil_data->where('id_estado_civil',$idestadocivil);  		
		$query = $this->db->get();
		$datos = is_null($idestadocivil) ? $query->result() : $query->row();
		return $datos;

	}

	public function licenciaconducir($idlicenciaconducir = null){

		$licenciaconducir_data = $this->db->select('d.id_licencia_conducir, d.nombre, d.valido')
			  ->from('rem_licencia_conducir d')
			  ->where('d.valido = 1')
			  ->order_by('nombre');
		$licenciaconducir_data = is_null($idlicenciaconducir) ? $licenciaconducir_data : $licenciaconducir_data->where('id_licencia_conducir',$idlicenciaconducir);  		
		$query = $this->db->get();
		$datos = is_null($idlicenciaconducir) ? $query->result() : $query->row();
		return $datos;

	}

	public function empresa($idempresa = null){

		$empresa_data = $this->db->select('d.id_empresa, d.nombre, d.rut, d.dv, d.direccion , d.active, c2.nombre as nombrecomuna, c3.nombre as nombreregion')
			  ->from('rem_empresa d')
			  ->join('rem_comuna c2','d.idcomuna = c2.idcomuna','left')
			  ->join('rem_region c3','d.region = c3.id_region','left')
			  ->where('d.active = 1')
			  ->order_by('nombre');
		$empresa_data = is_null($idempresa) ? $empresa_data : $empresa_data->where('id_empresa',$idempresa);  		
		$query = $this->db->get();
		$datos = is_null($idempresa) ? $query->result() : $query->row();
		return $datos;

	}




	public function comuna($idcomuna = null){

		$comuna_data = $this->db->select('d.idcomuna, d.idprovincia, d.nombre, c2.nombre as provincia')
			  ->from('rem_comuna d')
			  ->join('rem_provincia c2','d.idprovincia = c2.idprovincia','left')
			  ->order_by('nombre');
		$comuna_data = is_null($idcomuna) ? $comuna_data : $comuna_data->where('idcomuna',$idcomuna);  		
		$query = $this->db->get();
		$datos = is_null($idcomuna) ? $query->result() : $query->row();
		return $datos;

	}

	public function provincia($idprovincia = null){

		$provincia_data = $this->db->select('d.idprovincia, d.idregion, d.nombre, c2.nombre as region')
			  ->from('rem_provincia d')
			  ->join('rem_region c2','d.idregion = c2.id_region','left')
			  ->order_by('nombre');
		$provincia_data = is_null($idprovincia) ? $provincia_data : $provincia_data->where('idprovincia',$idprovincia);  		
		$query = $this->db->get();
		$datos = is_null($idprovincia) ? $query->result() : $query->row();
		return $datos;

	}

	public function add_nacionalidad($datos,$idnacionalidad){

		var_dump($idnacionalidad); 
		if($idnacionalidad == 0){

			       
	        $array_datos = array(
			'nombre' => $datos['nombre'],
			'iso' => $datos['iso'],
			'created_at' => date('Ymd H:i:s'),
			'updated_at' => date('Ymd H:i:s')			
			);

			$this->db->insert('rem_paises',$array_datos);	  

		}else{

			$array_datos = array(
			'nombre' => $datos['nombre'],
			'iso' => $datos['iso'],
			'updated_at' => date('Ymd H:i:s'),
					
		     );

			$this->db->where('id_paises',$idnacionalidad);
			$this->db->update('rem_paises',$array_datos);
			
		}
	}

	public function add_regiones($datos,$idregiones){

		var_dump($idregiones); 
		if($idregiones == 0){

			       
	        $array_datos = array(
			'nombre' => $datos['nombre'],
			'created_at' => date('Ymd H:i:s'),
			'updated_at' => date('Ymd H:i:s')			
			);

			$this->db->insert('rem_region',$array_datos);	  

		}else{

			$array_datos = array(
			'nombre' => $datos['nombre'],
			'updated_at' => date('Ymd H:i:s'),
					
		     );

			$this->db->where('id_region',$idregiones);
			$this->db->update('rem_region',$array_datos);
			
		}
	}

	public function add_idioma($datos,$ididioma){

		var_dump($ididioma); 
		if($ididioma == 0){			       
	        $array_datos = array(
			'nombre' => $datos['nombre'],
			'created_at' => date('Ymd H:i:s'),
			'updated_at' => date('Ymd H:i:s')			
			);

			$this->db->insert('rem_idioma',$array_datos);	  

		}else{

			$array_datos = array(
			'nombre' => $datos['nombre'],
			'updated_at' => date('Ymd H:i:s'),
					
		     );

			$this->db->where('id_idioma',$ididioma);
			$this->db->update('rem_idioma',$array_datos);
			
		}
	}

	public function add_categoria($datos,$idcategoria){

		var_dump($idcategoria); 
		if($idcategoria == 0){			       
	        $array_datos = array(
	        'nombre' => $datos['nombre'],
			'created_at' => date('Ymd H:i:s'),
			'update_at' => date('Ymd H:i:s')			
			);

			$this->db->insert('rem_categoria',$array_datos);	  

		}else{

			$array_datos = array(
			'nombre' => $datos['nombre'],
			'update_at' => date('Ymd H:i:s'),
					
		     );

			$this->db->where('id_categoria',$idcategoria);
			$this->db->update('rem_categoria',$array_datos);
			
		}
	}

	public function add_cargos($datos,$idcargo){

		var_dump($idcargo); 
		if($idcargo == 0){			       
	        $array_datos = array(
			'nombre' => $datos['nombre'],
			'activo' => 1,
			'created_at' => date('Ymd H:i:s'),
			'updated_at' => date('Ymd H:i:s')			
			);

			$this->db->insert('rem_cargos',$array_datos);	  

		}else{

			$array_datos = array(
			'nombre' => $datos['nombre'],
			'updated_at' => date('Ymd H:i:s'),
					
		     );

			$this->db->where('id_cargos',$idcargo);
			$this->db->update('rem_cargos',$array_datos);
			
		}
	}

	public function add_bancos($datos,$idbanco){

		
		var_dump($idbanco); 
		if($idbanco == 0){			       
	        $array_datos = array(
			'nombre' => $datos['nombre'],
			'cod_sbif' => $datos['codigo'],
			'activo' => 1,
			'updated_at' => date('Ymd H:i:s')			
			);

			$this->db->insert('rem_banco',$array_datos);	  

		}else{

			$array_datos = array(
			'nombre' => $datos['nombre'],
			'cod_sbif' => $datos['codigo'],
			'updated_at' => date('Ymd H:i:s'),
					
		     );

			$this->db->where('id_banco',$idbanco);
			$this->db->update('rem_banco',$array_datos);
			
		}
	}

	public function add_lugarpago($datos,$idlugarpago){

		var_dump($idlugarpago); 
		if($idlugarpago == 0){			       
	        $array_datos = array(
	        'nombre' => $datos['nombre'],
	        'activo' => 1,
			'created_at' => date('Ymd H:i:s'),
			'created_by' => date('Ymd H:i:s'),
			'updated_at' => date('Ymd H:i:s')			
			);

			$this->db->insert('rem_lugar_pago',$array_datos);	  

		}else{

			$array_datos = array(
			'nombre' => $datos['nombre'],
			'updated_at' => date('Ymd H:i:s'),
					
		     );

			$this->db->where('id_lugar_pago',$idlugarpago);
			$this->db->update('rem_lugar_pago',$array_datos);
			
		}
	}

	public function add_formapago($datos,$idformapago){

		var_dump($idformapago); 
		if($idformapago == 0){			       
	        $array_datos = array(
	        'descripcion' => $datos['descripcion'],
	        'activo' => 1,
			
			);

			$this->db->insert('rem_formas_pago',$array_datos);	  

		}else{

			$array_datos = array(
			'descripcion' => $datos['descripcion']
					
		     );

			$this->db->where('id_forma_pago',$idformapago);
			$this->db->update('rem_formas_pago',$array_datos);
			
		}
	}

	public function add_estudios($datos,$idestudios){

		var_dump($idestudios); 
		if($idestudios == 0){			       
	        $array_datos = array(
	        'nombre' => $datos['nombre'],
	        'valido' => 1,
	        'created_at' => date('Ymd H:i:s'),
			'updated_at' => date('Ymd H:i:s')	
			
			);

			$this->db->insert('rem_estudios',$array_datos);	  

		}else{

			$array_datos = array(
			'nombre' => $datos['nombre'],
			'updated_at' => date('Ymd H:i:s')					
		     );

			$this->db->where('id_estudios',$idestudios);
			$this->db->update('rem_estudios',$array_datos);
			
		}
	}

	public function add_estadocivil($datos,$idestadocivil){

		var_dump($idestadocivil); 
		if($idestadocivil == 0){			       
	        $array_datos = array(
	        'nombre' => $datos['nombre'],
	        'activo' => 1,
	        'created_at' => date('Ymd H:i:s'),
			'updated_at' => date('Ymd H:i:s')	
			
			);

			$this->db->insert('rem_estado_civil',$array_datos);	  

		}else{

			$array_datos = array(
			'nombre' => $datos['nombre'],
			'updated_at' => date('Ymd H:i:s')					
		     );

			$this->db->where('id_estado_civil',$idestadocivil);
			$this->db->update('rem_estado_civil',$array_datos);
			
		}
	}

	public function add_licenciaconducir($datos,$idlicenciaconducir){

		var_dump($idlicenciaconducir); 
		if($idlicenciaconducir == 0){			       
	        $array_datos = array(
	        'nombre' => $datos['nombre'],
	        'valido' => 1,
	        'created_at' => date('Ymd H:i:s'),
			'updated_at' => date('Ymd H:i:s')	
			
			);

			$this->db->insert('rem_licencia_conducir',$array_datos);	  

		}else{

			$array_datos = array(
			'nombre' => $datos['nombre'],
			'updated_at' => date('Ymd H:i:s')					
		     );

			$this->db->where('id_licencia_conducir',$idlicenciaconducir);
			$this->db->update('rem_licencia_conducir',$array_datos);
			
		}
	}

	public function add_comuna($datos,$idcomuna){

		print_r($datos);
		exit;

		var_dump($idcomuna); 
		if($idcomuna == 0){

			       
	        $array_datos = array(
			'nombre' => $datos['nombre'],
			'idprovincia' => $datos['idprovincia']				
			);

			$this->db->insert('rem_comuna',$array_datos);	  

		}else{

			$array_datos = array(
			'nombre' => $datos['nombre'],
			'idprovincia' => $datos['idprovincia']								
		     );

			$this->db->where('idcomuna',$idcomuna);
			$this->db->update('rem_comuna',$array_datos);
			
		}
	}

	public function delete_comuna($idcomuna){


		//$this->db->where('id_paises', $idpais);
		//$this->db->update('rem_paises',array('active' => '0')); 

		return 1;
		/*if($this->db->affected_rows() > 0){ // se eliminó proveedor correctamente
			return 1;
		}else{ // no hubo eliminación de proveedor
			return -1;
		}*/



	}

	public function delete_paises($idpais){


		//$this->db->where('id_paises', $idpais);
		//$this->db->update('rem_paises',array('active' => '0')); 

		return 1;
		/*if($this->db->affected_rows() > 0){ // se eliminó proveedor correctamente
			return 1;
		}else{ // no hubo eliminación de proveedor
			return -1;
		}*/



	}

	public function delete_regiones($idregiones){


		//$this->db->where('id_paises', $idpais);
		//$this->db->update('rem_paises',array('active' => '0')); 

		return 1;
		/*if($this->db->affected_rows() > 0){ // se eliminó proveedor correctamente
			return 1;
		}else{ // no hubo eliminación de proveedor
			return -1;
		}*/



	}

	public function delete_idioma($ididioma){


		//$this->db->where('id_paises', $idpais);
		//$this->db->update('rem_paises',array('active' => '0')); 

		return 1;
		/*if($this->db->affected_rows() > 0){ // se eliminó proveedor correctamente
			return 1;
		}else{ // no hubo eliminación de proveedor
			return -1;
		}*/



	}

	public function delete_categoria($idcategoria){


		//$this->db->where('id_paises', $idpais);
		//$this->db->update('rem_paises',array('active' => '0')); 

		return 1;
		/*if($this->db->affected_rows() > 0){ // se eliminó proveedor correctamente
			return 1;
		}else{ // no hubo eliminación de proveedor
			return -1;
		}*/



	}

	public function delete_cargos($idcargo){


		//$this->db->where('id_paises', $idpais);
		//$this->db->update('rem_paises',array('active' => '0')); 

		return 1;
		/*if($this->db->affected_rows() > 0){ // se eliminó proveedor correctamente
			return 1;
		}else{ // no hubo eliminación de proveedor
			return -1;
		}*/



	}

	public function delete_bancos($idbanco){


		//$this->db->where('id_paises', $idpais);
		//$this->db->update('rem_paises',array('active' => '0')); 

		return 1;
		/*if($this->db->affected_rows() > 0){ // se eliminó proveedor correctamente
			return 1;
		}else{ // no hubo eliminación de proveedor
			return -1;
		}*/



	}

	public function delete_lugardepago($idlugardepago){


		//$this->db->where('id_paises', $idpais);
		//$this->db->update('rem_paises',array('active' => '0')); 

		return 1;
		/*if($this->db->affected_rows() > 0){ // se eliminó proveedor correctamente
			return 1;
		}else{ // no hubo eliminación de proveedor
			return -1;
		}*/



	}

	public function delete_formadepago($idformapago){


		//$this->db->where('id_paises', $idpais);
		//$this->db->update('rem_paises',array('active' => '0')); 

		return 1;
		/*if($this->db->affected_rows() > 0){ // se eliminó proveedor correctamente
			return 1;
		}else{ // no hubo eliminación de proveedor
			return -1;
		}*/



	}

	public function delete_estudio($idestudio){


		//$this->db->where('id_paises', $idpais);
		//$this->db->update('rem_paises',array('active' => '0')); 

		return 1;
		/*if($this->db->affected_rows() > 0){ // se eliminó proveedor correctamente
			return 1;
		}else{ // no hubo eliminación de proveedor
			return -1;
		}*/



	}

	public function delete_estadocivil($idestadocivil){


		//$this->db->where('id_paises', $idpais);
		//$this->db->update('rem_paises',array('active' => '0')); 

		return 1;
		/*if($this->db->affected_rows() > 0){ // se eliminó proveedor correctamente
			return 1;
		}else{ // no hubo eliminación de proveedor
			return -1;
		}*/



	}

	public function delete_licenciaconducir($idlicenciaconducir){


		//$this->db->where('id_paises', $idpais);
		//$this->db->update('rem_paises',array('active' => '0')); 

		return 1;
		/*if($this->db->affected_rows() > 0){ // se eliminó proveedor correctamente
			return 1;
		}else{ // no hubo eliminación de proveedor
			return -1;
		}*/



	}


	
		
}
