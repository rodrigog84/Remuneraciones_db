<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Carga_masiva extends CI_Controller {

	 function cargar_archivo() {

        $mi_archivo = 'mi_archivo';
        $config['upload_path'] = "uploads/";
        $config['file_name'] = "nombre_archivo";
        $config['allowed_types'] = "*";
        $config['max_size'] = "0";
        $config['max_width'] = "0";
        $config['max_height'] = "0";

        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload($mi_archivo)) {
            //*** ocurrio un error
            $data['uploadError'] = $this->upload->display_errors();
            echo $this->upload->display_errors();
            return;
        }

        $data['uploadSuccess'] = $this->upload->data();
    }

    public function rescatar(){

		$resp = array();

        $config['upload_path'] = "./cargas/"	;
        $config['file_name'] = 'archivo_precios';
        $config['allowed_types'] = "*";
        $config['max_size'] = "10240";
        $config['overwrite'] = TRUE;

        $fecha = $this->input->post('fecha_subida');
        $numero = $this->input->post('numero');
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload("archivo")) {
            print_r($this->upload->data()); 
            print_r($this->upload->display_errors());
            $error = true;
            $message = "Error en subir archivo.  Intente nuevamente";
        };

        $data_file_upload = $this->upload->data();

		$nombre_archivo = $config['upload_path'].$config['file_name'].$data_file_upload['file_ext'];

		$this->load->library('PHPExcel');	       		
				//read file from path
		$objPHPExcel = PHPExcel_IOFactory::load($nombre_archivo);
		 //get only the Cell Collection
		$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

		//extract to a PHP readable array format
		foreach ($cell_collection as $cell) {
			    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
			    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();

			    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
			   //header will/should be in row 1 only. of course this can be modified to suit your need.
			    if ($row < 4) {
				$header[$row][$column] = $data_value;
			    } else {
				$arr_data[$row][$column] = $data_value;
			    };
		};

	foreach ($arr_data as $precio) {
		
		$id = $precio['A'];
		$codigo = $precio['B'];
		$nombre = $precio['C'];
		$precio_venta = $precio['D'];
		$precio_lista = $precio['E'];
		$stock = $precio['F'];
		
		if ($id > 0){
		
		$precios = array(
			'numero' => $numero,
	        'fecha' => date('Y-m-d'),
	        'id_producto' => $id,
	        'valor_original' => $p_venta,
	        'valor_originallista' => $p_lista,
	        'nuevalor' => $precio_venta,
	        'nuevovalor_lista' => $precio_lista,
	        'stock' => $stock
		);

		$this->db->insert('precios', $precios);

	    };
		};

		 $resp['success'] = true;
         echo json_encode($resp);

	}

	  public function insertar(){{
		//obtenemos el archivo .csv
		$tipo = $_FILES['archivo']['type'];		 
		$tamanio = $_FILES['archivo']['size'];		 
		$archivotmp = $_FILES['archivo']['tmp_name'];
		 
		//cargamos el archivo
		$lineas = file($archivotmp);
		 
		//inicializamos variable a 0, esto nos ayudará a indicarle que no lea la primera línea
		$i=0;
		 
		//Recorremos el bucle para leer línea por línea
		foreach ($lineas as $linea_num => $linea)
		{ 
		   //abrimos bucle
		   /*si es diferente a 0 significa que no se encuentra en la primera línea 
		   (con los títulos de las columnas) y por lo tanto puede leerla*/
		   if($i != 0){ 
	       //abrimos condición, solo entrará en la condición a partir de la segunda pasada del bucle.
	       /* La funcion explode nos ayuda a delimitar los campos, por lo tanto irá 
	       leyendo hasta que encuentre un ; */
	       $datos = explode(";",$linea); 
	       //Almacenamos los datos que vamos leyendo en una variable
	       //usamos la función utf8_encode para leer correctamente los caracteres especiales
	       $nombre = utf8_encode($datos[0]);
	       $edad = $datos[1];
	       $profesion = utf8_encode($datos[2]);
 
       	   //guardamos en base de datos la línea leida
	       mysql_query("INSERT INTO datos(nombre,edad,profesion) VALUES('$nombre','$edad','$profesion')");
	 
       //cerramos condición
   			};
 
   /*Cuando pase la primera pasada se incrementará nuestro valor y a la siguiente pasada ya 
   entraremos en la condición, de esta manera conseguimos que no lea la primera línea.*/
   			$i++;
   //cerramos bucle
}
}

}