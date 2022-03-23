<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Proceso extends CI_Model
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

    public function get_parametros()
    {
    }

    public function add_parametros($data)
    {

        $this->db->select('p.id')
            ->from('rem_parametros as p')
            ->where('p.fecha', $data['fecha'])
            ->where('p.nombre', $data['nombre']);
        $query = $this->db->get();

        if ($query->row() == 0) {
            return $this->db->insert('rem_parametros', $data);
        } else {
            return false;
        }
    }

    public function update_parametros()
    {
    }
}
