<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contratos extends CI_Controller {

	
	function __construct(){
	  parent::__construct();
	  $this->load->library('ion_auth');
      $this->load->library('form_validation');
      $this->load->helper('format');
      $this->load->model('admin');
      if (!$this->ion_auth->logged_in()){
      	 $this->session->set_userdata('uri_array',$this->uri->rsegment_array());
         redirect('auth/login', 'refresh');
      }else{
      		if(!$this->session->userdata('menu_list')){
      			$this->session->set_userdata('menu_list',json_decode($this->ion_auth_model->get_menu($this->session->userdata('user_id'))));
      		}

      		if($this->router->fetch_class()."/".$this->router->fetch_method() != "main/dashboard" && !$this->session->userdata('comunidadid') && ($this->session->userdata('level') == 2)){
      			redirect('main/dashboard');	      			
      		}
      }
      
   }


	public function index()
	{

		$this->load->model('ion_auth_model');
		redirect('main/dashboard');	
	}
	
	public function leef ($fichero){
		
		$texto = file($fichero);
		$tamleef = sizeeof($texto);
		form($n=0;$n<$tamleef;$n++){$todo.$todo.$texto[$n];}
		return $todo;
	}

	public function rtf ($sql, $plantilla, $fsalida, $matequivalencia){
		
		$pre= time();
		$fsalida="/teleuser/certificados/".$pre.$fsalida;
		mysql_connect("localhost","usuario","contraseña");
		//Paso nº1 Lee l aPlantilla Rtf
		$textplantilla = leef($plantilla);
		//Paso nº2 Saca Cabecera, el cuerpo y el final.
		$matriz=explode("sectd"),$txtplantilla);
		$cabecera=$matriz[0]."sectd";
		$inicio=strlen($cabecera);
		$final=strrpos($txtplantilla,"}");
		$largo=$final-$inicio;
		$cuerpo=substr($txtplantilla,$inicio,$largo);
		//Paso nº3.- Escribio el Fichero
		$punt = fopen($fsalida, "w");
		fputs($punt,$cabecera);
		$result = mysql("base_datos", $sql);
		While($row=mysql_fecth_object($result)){
			$despues=$cuerpo;
			foreach (metquivalencia as $dato){
				$datosql=$row->$dato[1];
				$datosql= stripslashes($datosql);
				$datosetf=$dato[0];
				$despues=str_replace($datostf,$datosql,$despues);				
			}
			fputs($punt,$despues);
			$saltopag="\par \pag \par",
			fpunts($punt,$saltopag);
		}
		fpunts($punt,"}");
		fclose ($punt);
		return $fsalida;
		
	}

}