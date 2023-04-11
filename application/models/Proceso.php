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


    public function actualizar_indicadores()
    {

            /***** ACTUALIZA UF *********************/

            $this->load->model('admin');
            $query= $this->db->query("select        count(distinct fecha) as cantidad
                            from        rem_parametros
                            where       nombre = 'UF'
                            and         fecha between GETDATE() - 10 and GETDATE()");

            $data_result = $query->row();

            $cantidad = isset($data_result->cantidad) ? $data_result->cantidad : 0;

            if($cantidad < 10){ // solo procesa en caso que falten datos en los ultimos 10 dias

                $apiUrl = 'https://mindicador.cl/api/uf';
                //Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
                if ( ini_get('allow_url_fopen') ) {
                    $json = file_get_contents($apiUrl);
                } else {
                    //De otra forma utilizamos cURL
                    $curl = curl_init($apiUrl);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    $json = curl_exec($curl);
                    curl_close($curl);
                }
                 
                $dailyIndicators = json_decode($json);
                $i = 1;
                foreach ($dailyIndicators->serie as $fecha) {
                    $fecha_ind = substr($fecha->fecha,0,10);
                    $fecha_ind = str_replace('-', '', $fecha_ind);
                    $valor = $fecha->valor;
                    $data_indicador = $this->admin->get_indicadores_by_day($fecha_ind,'UF');

                    if(count($data_indicador) == 0){


                        $data = array('nombre' => 'UF',
                                    'valor' => $valor,
                                    'fecha' => $fecha_ind);


                        $this->db->insert('rem_parametros', $data);
                    }

                    $i++;
                    if($i >= 10){ //revisa solo 10 dias
                        break;
                    }
                }


             
            }


            /***** ACTUALIZA UTM *********************/
            $query= $this->db->query("select        count(distinct fecha) as cantidad
                            from        rem_parametros
                            where       nombre = 'UTM'
                            and         fecha between GETDATE() - 10 and GETDATE()");

            $data_result = $query->row();

            $cantidad = isset($data_result->cantidad) ? $data_result->cantidad : 0;
            if($cantidad < 10){ // solo procesa en caso que falten datos en los ultimos 10 dias

                $apiUrl = 'https://mindicador.cl/api/utm';
                //Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
                if ( ini_get('allow_url_fopen') ) {
                    $json = file_get_contents($apiUrl);
                } else {
                    //De otra forma utilizamos cURL
                    $curl = curl_init($apiUrl);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    $json = curl_exec($curl);
                    curl_close($curl);
                }
                 
                $dailyIndicators = json_decode($json);
                $i = 1;
                foreach ($dailyIndicators->serie as $fecha) {


                    $fecha_ind = substr($fecha->fecha,0,7);
                    //$fecha_ind = str_replace('-', '', $fecha_ind);
                    $valor = $fecha->valor;

                    $fecha_final = date("d-m-Y");
                    $fecha_inicial = date("d-m-Y",strtotime($fecha_final."- 10 days"));
                    //$fecha_revisa = $fecha_inicial;
                    $regla = true;
                    $ciclo = 1;

                    while($regla){

                         $fecha_inicial = date("Y-m-d",strtotime($fecha_inicial."+ 1 days"));
                         $fecha_inicial_substr = str_replace('-', '', $fecha_inicial);
                         $fecha_inicial_per =  substr($fecha_inicial,0,7);
                        // var_dump($fecha_inicial_per); exit;
                         if($fecha_ind == $fecha_inicial_per){ // el valor de la API corresponde al periodo que estamos revisando

                                $data_indicador = $this->admin->get_indicadores_by_day($fecha_inicial_substr,'UTM');

                                if(count($data_indicador) == 0){


                                    $data = array('nombre' => 'UTM',
                                                'valor' => $valor,
                                                'fecha' => $fecha_inicial_substr);


                                    $this->db->insert('rem_parametros', $data);
                                }



                         }


                        if($fecha_inicial == $fecha_final  || $ciclo >= 30){

                            $regla = false;
                        }

                        $ciclo++;






                    }






                    $i++;
                    if($i >= 2){ //revisa solo 10 dias
                        break;
                    }
                }


             
            }


    }    

    public function update_parametros()
    {


    }
}
