<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Procesos extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('format');
        $this->load->model('proceso');

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_userdata('uri_array', $this->uri->rsegment_array());
            redirect('auth/login', 'refresh');
        } else {
            if (!$this->session->userdata('menu_list')) {
                $this->session->set_userdata('menu_list', json_decode($this->ion_auth_model->get_menu($this->session->userdata('user_id'))));
            }
        }
    }

    public function get_parametros()
    {
    }

    public function post_parametros()
    {
        $nombre = $this->input->post('nombre', false);
        $valor = $this->input->post('valor', false);
        $fecha = $this->input->post('fecha', false);

        if (!isset($nombre) || !isset($valor) || !isset($fecha)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(array('text' => 'Error 404', 'type' => 'danger')));
        }

        $data = ['nombre' => $nombre, 'valor' => $valor, 'fecha' => $fecha];

        $response = $this->proceso->add_parametros($data);

        if (!$response) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(304)
                ->set_output(json_encode(array('text' => 'Error 304', 'type' => 'danger')));
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array('text' => 'Success 200', 'type' => 'success', 'response' => $response)));
    }

    public function put_parametros()
    {
    }



    public function envia_mail(){

        $this->load->model('admin');
        $array_email = array('rodrigog.84@gmail.com');
         $this->admin->envia_mail_sb('robot@arnou.cl', $array_email, 'Creación de Usuario Arnou-Remuneraciones', 'hola', 'html');


    }





    public function actualiza_indicadores(){

               $this->load->model('proceso');
               $this->proceso->actualizar_indicadores();     


    }    
}
