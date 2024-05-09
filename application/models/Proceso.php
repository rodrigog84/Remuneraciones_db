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



    public function creacion_periodos_faltantes()
    {

            $query= $this->db->query("insert into rem_periodo (mes, anno)
                                        select      distinct c.MES, c.AÑO
                                        from        rem_calendario c
                                        left join   rem_periodo p on c.PERIODO = p.periodo
                                        where       p.periodo is null");
    }    




    public function genera_haberes_descuentos_fijos($mes,$anno){

        if($mes != '' && $anno != ''){


            $query= $this->db->query("insert into rem_bonos_personal (
                                                                    idconf,
                                                                    idpersonal,
                                                                    descripcion,
                                                                    monto,
                                                                    idperiodo
                                                                )
                                                    select      p.idconf
                                                                ,p.idpersonal
                                                                ,p.descripcion
                                                                ,p.monto
                                                                ,p.idperiodo
                                                    from        (                                                                
                                                                select      bp.idconf
                                                                            ,bp.idpersonal
                                                                            ,bp.descripcion
                                                                            ,bp.monto
                                                                            ,(
                                                                                select  id_periodo
                                                                                from    rem_periodo
                                                                                where   mes = " . $mes ."
                                                                                and     anno = " . $anno ."              
                                                                            ) as idperiodo
                                                                from        rem_bonos_personal bp
                                                                inner join  rem_personal p on bp.idpersonal = p.id_personal
                                                                inner join  rem_conf_haber_descuento c on bp.idconf = c.id
                                                                inner join  rem_conf_haber_descuento_empresa ce on c.id = ce.idconfhd and ce.idempresa = " . $this->session->userdata('empresaid') . "
                                                                where       p.id_empresa = " . $this->session->userdata('empresaid') . "
                                                                and         bp.valido = 1
                                                                and         bp.idperiodo = (
                                                                                                select  id_periodo -- OBTENEMOS EL ID DEL ULTIMO PERIODO APROBADO POR LA EMPRESA
                                                                                                from    rem_periodo
                                                                                                where   periodo = ( -- OBTENEMOS EL ULTIMO PERIODO APROBADO DE LA EMPRESA 
                                                                                                                    select  max(p.periodo) as periodo
                                                                                                                    from    rem_periodo_remuneracion pr
                                                                                                                    inner join rem_periodo p on pr.id_periodo = p.id_periodo
                                                                                                                    where   pr.id_empresa = " . $this->session->userdata('empresaid') . "
                                                                                                                    and     pr.aprueba is not null
                                                                                                                    and        periodo < ( -- OBTENEMOS EL ID DEL PERIODO QUE ESTAMOS BUSCANDO
                                                                                                                                        select  periodo
                                                                                                                                        from    rem_periodo
                                                                                                                                        where   mes = " . $mes ."
                                                                                                                                        and     anno = " . $anno ."
                                                                                                                                        )
                                                                                                                    )
                                                                                            )
                                                                and        c.fijo = 1
                                                            ) p
                                                            left join   rem_bonos_personal bp on p.idpersonal = bp.idpersonal and p.idconf = bp.idconf and p.idperiodo = bp.idperiodo
                                                            where       bp.idconf is null                                                                
                                                    ");




        }


    }






    public function haberes_descuentos_periodo_nuevo(){


            $query= $this->db->query("select    p.*
                                        from    (
                                                select  min(periodo) as min_periodo
                                                from    (
                                                        select      b.periodo
                                                                    ,p.id_periodo
                                                                    --,r.id_periodo
                                                        from        (
                                                                    select      distinct periodo
                                                                    from        rem_calendario
                                                                    where       periodo > (
                                                                                            select      periodo
                                                                                            from        rem_periodo
                                                                                            where       id_periodo = (

                                                                                                                            select      max(id_periodo)
                                                                                                                            from        rem_periodo_remuneracion
                                                                                                                            where       id_empresa = " . $this->session->userdata('empresaid'). "
                                                                                                                            and         aprueba = (
                                                                                                                                                    select      max(aprueba)
                                                                                                                                                    from        rem_periodo_remuneracion
                                                                                                                                                    where       id_empresa = " . $this->session->userdata('empresaid'). "
                                                                                                                                                    and         aprueba is not null
                                                                                                                                                    )



                                                                                                                        )
                                                                                            )
                                                                    ) b
                                                        inner join  rem_periodo p on b.PERIODO = p.periodo
                                                        left join (
                                                                    select      distinct id_periodo
                                                                    from        rem_periodo_remuneracion
                                                                    where       id_empresa = " . $this->session->userdata('empresaid'). "
                                                                    and         cierre is not null
                                                                    ) r on p.id_periodo = r.id_periodo
                                                        where       r.id_periodo is null
                                                        )p
                                                )m
                                        inner join rem_periodo p on m.min_periodo = p.periodo                                                              
                                                                                            ");


                $data_result = $query->result();

                if(count($data_result) > 0){
                        $data = $data_result[0];
                       // var_dump($data); exit;
                        $mes = $data->mes;
                        $anno = $data->anno;
                        $this->genera_haberes_descuentos_fijos($mes,$anno);

                }
                


    }


    public function replica_indicador_mes_anterior_a_actual($indicador){


            $periodo = date('Ym');
            // SUELDO MINIMO
            $query= $this->db->query("INSERT INTO rem_parametros (
                                                    nombre
                                                    ,valor
                                                    ,fecha
                                                    )

                                        select   '" . $indicador. "' as nombre,
                                                
                                                (select     valor
                                                from        rem_parametros
                                                where       nombre = '" . $indicador. "'
                                                and         fecha = (
                                                                    select  max(fecha)
                                                                    from    rem_calendario
                                                                    where   periodo = (
                                                                                        select max(periodo) as periodo
                                                                                        from    rem_calendario c
                                                                                        where   periodo < " . $periodo . "
                                                                                )
                                                                    )
                                                ) as valor,
                                                c.fecha
                                        from    rem_calendario c
                                        left join (
                                                    select      *
                                                    from        rem_parametros
                                                    where       nombre = '" . $indicador. "'
                                                    ) p on c.fecha = p.fecha
                                        where   c.periodo = " . $periodo . "
                                        and     p.fecha is null");



    }


    public function actualizar_indicadores()
    {


            $query= $this->db->query("select    *
                                    from        rem_procesos
                                    where   id = 1
                                    and     fec_ult_actualizacion = CONVERT(date, GETDATE())");
            $data_result_proceso = $query->result();

            if(count($data_result_proceso) == 0){ // SE EJECUTA SOLO UNA VEZ AL DIA



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


                    /******* ACTUALIZAR UF FUTURA ******************/
                         $anio = date('Y');
                         $mes_usr = date('m');

                          $contenido = file_get_contents("http://www.sii.cl/valores_y_fechas/uf/uf".$anio.".htm");
                          $dom = new DOMDocument;
                          $dom->loadHTML($contenido);
                          $tables = $dom->getElementById('table_export');

                          foreach($dom->getElementById('table_export')->getElementsByTagName("tr") as $meses => $tr){
                            foreach($tr->getElementsByTagName('td') as $dias => $td){
                              $valores_por_mes[$dias][$meses] = $td->nodeValue;
                            }
                          }

                          $array_uf = array();
                          foreach($valores_por_mes as $meses => $arreglo_dias){
                            
                            $mes = intval($meses+1);
                            if(strlen($mes)==1){ 
                              $mes = "0".$mes; 
                            }else{ 
                              $mes; 
                            }   
                            
                            foreach($arreglo_dias as $dias => $valor){      
                              if($mes == $mes_usr || $mes_usr == 13){     
                                if (strpos($valor,'.') !== false) {         
                                  if(strlen($dias)==1){ $dias = "0".$dias; }else{ $dias; }
                                  $fecha = $dias."-".$mes."-".$anio;
                                  $array_uf[$fecha] = $valor;
                                }       
                              }
                            }   
                          } 

                        foreach ($array_uf as $key_uf => $datos_uf) {

                            $array_key_uf = explode('-',$key_uf);


                            $fecha_ind = $array_key_uf[2].$array_key_uf[1].$array_key_uf[0];
                            $valor = $datos_uf;
                            $valor = str_replace('.', '', $valor);
                            $valor = str_replace(',', '.', $valor);
                            $data_indicador = $this->admin->get_indicadores_by_day($fecha_ind,'UF');

                            if(count($data_indicador) == 0){


                                $data = array('nombre' => 'UF',
                                            'valor' => $valor,
                                            'fecha' => $fecha_ind);


                                $this->db->insert('rem_parametros', $data);
                            }

                        }





                    /***** ACTUALIZA UTM *********************/





                    
                    $query_procesa= $this->db->query("select      case when dias_parametro < dias_mes then 1
                                                                 else 0
                                                            end as proceso,
                                                            dias_mes

                                                from        (   
                                                            select      count(*) as dias_parametro,
                                                                        (
                                                                        select  count(*)
                                                                        from    rem_calendario
                                                                        where   periodo = " . date('Ym') . "
                                                                        ) as dias_mes
                                                            from        rem_parametros
                                                            where       nombre = 'UTM'
                                                            and         fecha in (
                                                                                    SELECT fecha
                                                                                    FROM    rem_calendario
                                                                                    WHERE   PERIODO = " . date('Ym') . ")
                                                            ) b");
                    $data_procesa = $query_procesa->row();


                    $datos_faltantes = false;
                    $dias_mes = 30;
                    if(isset($data_procesa->proceso)){
                            if($data_procesa->proceso == 1){
                                $datos_faltantes = true;
                                $dias_mes = $data_procesa->dias_mes;
                            }

                    }


                    $data_result = $query->row();

                    $query= $this->db->query("select        count(distinct fecha) as cantidad
                                    from        rem_parametros
                                    where       nombre = 'UTM'
                                    and         fecha between GETDATE() - 10 and GETDATE()");

                    $data_result = $query->row();

                    $cantidad = isset($data_result->cantidad) ? $data_result->cantidad : 0;
                    if($cantidad < 10 || $datos_faltantes){ // solo procesa en caso que falten datos en los ultimos 10 dias

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

                        //var_dump_new($dailyIndicators); exit;
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
                                 //var_dump_new($fecha_inicial_substr);
                                 //var_dump_new($ciclo);
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


                                if($fecha_inicial == $fecha_final  || $ciclo >= $dias_mes){

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

                    //exit;
                    /**************************  ACTUALIZACION OTROS PARAMETROS *************************/



                    $this->replica_indicador_mes_anterior_a_actual('Sueldo Minimo');
                    $this->replica_indicador_mes_anterior_a_actual('Tope Imponible AFP');
                    $this->replica_indicador_mes_anterior_a_actual('Tope Imponible IPS');
                    $this->replica_indicador_mes_anterior_a_actual('Tope Imponible AFC');
                    $this->replica_indicador_mes_anterior_a_actual('Tasa SIS');

                    // Tabla asignacion familiar

                    $periodo = date('Ym');

                    $this->db->select('count(*) as cantidad')
                             ->from('rem_tabla_asig_familiar_periodo')
                             ->where('periodo',$periodo);

                    $query = $this->db->get();    
                    $result_asig = $query->row();
                    $cantidad_asig = isset($result_asig->cantidad) ? $result_asig->cantidad : 0;

                    if($cantidad_asig == 0){

                        $query= $this->db->query("insert into rem_tabla_asig_familiar_periodo (tramo, desde, hasta, monto,periodo)
                                                    select      tramo
                                                                ,desde
                                                                ,hasta
                                                                ,monto
                                                                ," . $periodo . " as periodo
                                                    from        rem_tabla_asig_familiar_periodo t
                                                    where       periodo = (
                                                                            select max(periodo) as periodo
                                                                            from    rem_calendario c
                                                                            where   periodo < " . $periodo . "
                                                                          )");

                    }                    

                    $this->db->where('id',1);
                    $this->db->update('rem_procesos', array('fec_ult_actualizacion' => date('Ymd')));






            }



    }    

    public function update_parametros()
    {


    }
}
