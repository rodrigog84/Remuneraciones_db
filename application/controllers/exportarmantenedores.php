<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Exportarmantenedores extends CI_Controller {
	
	function __construct(){
	  parent::__construct();
	  $this->load->library('ion_auth');
      $this->load->library('form_validation');
      $this->load->helper('format');
      $this->load->model('Mantenedores_model');
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

	public function exportarExcelPaises(){
            	
            header("Content-type: application/vnd.ms-excel"); 
            header("Content-disposition: attachment; filename=paises.xls"); 
            
            $nacionalidad = $this->Mantenedores_model->get_nacionalidad();

           
            echo '<table>';
            echo "<tr>";
                echo "<td>LISTADO Paises</td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>ID</td>";               
                echo "<td>CODIGO ISO</td>";
                echo "<td>NOMBRE</td>";
            echo "</tr>";                          
              foreach($nacionalidad as $v){
              	 echo "<tr>";
                 echo "<td>".$v->id_paises."</td>";
                 echo "<td>".$v->iso."</td>";
                 echo "<td>".$v->nombre."</td>";
                 echo "</tr>";
               }	
         echo '</table>';
         exit;

    }

    public function exportarExcelIdioma(){
            	
            header("Content-type: application/vnd.ms-excel"); 
            header("Content-disposition: attachment; filename=idiomas.xls"); 
            
            $idiomas = $this->Mantenedores_model->get_idioma();

           
            echo '<table>';
            echo "<tr>";
                echo "<td>LISTADO IDIOMAS</td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>ID</td>";               
                echo "<td>NOMBRE</td>";
            echo "</tr>";                          
              foreach($idiomas as $v){
              	 echo "<tr>";
                 echo "<td>".$v->id_idioma."</td>";
                 echo "<td>".$v->nombre."</td>";
                 echo "</tr>";
               }	
         echo '</table>';
         exit;

    }

    public function exportarExcelCategorias(){
            	
            header("Content-type: application/vnd.ms-excel"); 
            header("Content-disposition: attachment; filename=categorias.xls"); 
            
            $categorias = $this->Mantenedores_model->get_categoria();

           
            echo '<table>';
            echo "<tr>";
                echo "<td>LISTADO CARGOS</td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>ID</td>";               
                echo "<td>NOMBRE</td>";
            echo "</tr>";                          
              foreach($categorias as $v){
              	 echo "<tr>";
                 echo "<td>".$v->id_categoria."</td>";
                 echo "<td>".$v->nombre."</td>";
                 echo "</tr>";
               }	
         echo '</table>';
         exit;

    }

     public function exportarExcelCargos(){
            	
            header("Content-type: application/vnd.ms-excel"); 
            header("Content-disposition: attachment; filename=cargos.xls"); 
            
            $cargos = $this->Mantenedores_model->get_cargos();

           
            echo '<table>';
            echo "<tr>";
                echo "<td>LISTADO CARGOS</td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>ID</td>";               
                echo "<td>NOMBRE</td>";
            echo "</tr>";                          
              foreach($cargos as $v){
              	 echo "<tr>";
                 echo "<td>".$v->id_cargos."</td>";
                 echo "<td>".$v->nombre."</td>";
                 echo "</tr>";
               }	
         echo '</table>';
         exit;

    }

    public function exportarExcelComunas(){
            	
            header("Content-type: application/vnd.ms-excel"); 
            header("Content-disposition: attachment; filename=comunas.xls"); 
            
            $comuna = $this->Mantenedores_model->get_comuna();

           
            echo '<table>';
            echo "<tr>";
                echo "<td>LISTADO COMUNAS</td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>ID</td>";               
                echo "<td>COMUNA</td>";
                echo "<td>PROVINCIA</td>";
            echo "</tr>";                          
              foreach($comuna as $v){
              	 echo "<tr>";
                 echo "<td>".$v->idcomuna."</td>";
                 echo "<td>".$v->nombre."</td>";
                 echo "<td>".$v->provincia."</td>";
                 echo "</tr>";
               }	
         echo '</table>';
         exit;

    }

    public function exportarExcelRegion(){
            	
            header("Content-type: application/vnd.ms-excel"); 
            header("Content-disposition: attachment; filename=regiones.xls"); 
            
            $regiones = $this->Mantenedores_model->get_regiones();

           
            echo '<table>';
            echo "<tr>";
                echo "<td>LISTADO REGIONES</td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>ID</td>";               
                echo "<td>NOMBRE</td>";
            echo "</tr>";                          
              foreach($regiones as $v){
              	 echo "<tr>";
                 echo "<td>".$v->id_region."</td>";
                 echo "<td>".$v->nombre."</td>";
                 echo "</tr>";
               }	
         echo '</table>';
         exit;

    }


	
	public function exportarExcelbancos(){
            	
            header("Content-type: application/vnd.ms-excel"); 
            header("Content-disposition: attachment; filename=bancos.xls"); 
            
            $bancos = $this->Mantenedores_model->get_bancos();

            echo '<table>';
             echo "<tr>";
                echo "<td>LISTADO BANCOS</td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>ID</td>";               
                echo "<td>CODIGO SBIF</td>";
                echo "<td>NOMBRE</td>";
            echo "</tr>";                          
              foreach($bancos as $v){
              	 echo "<tr>";
                 echo "<td>".$v->id_banco."</td>";
                 echo "<td>".$v->cod_sbif."</td>";
                 echo "<td>".$v->nombre."</td>";
                 echo "</tr>";
               }	
         echo '</table>';
         exit;

    }

    

}