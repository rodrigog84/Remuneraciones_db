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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel_model extends CI_Model
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


	

public function resumen_rem($datos_remuneracion,$idperiodo){

	$spreadsheet = new Spreadsheet();
	$sheet = $spreadsheet->getActiveSheet();

	  //$this->phpexcel->setActiveSheetIndex(0);
	//$sheet = $this->phpexcel->getActiveSheet();
	$sheet->setTitle("resumen_remuneraciones");

	//echo '<pre>';
	//var_dump($datos_remuneracion); exit;



	$this->load->model('admin');
	$this->load->model('rrhh_model');
	$datos_empresa = $this->admin->datos_empresa($this->session->userdata('empresaid'));

	$datos_periodo = $this->admin->get_periodo_by_id_v2($idperiodo);
	$periodo = $datos_periodo[0];

	/********* COMIENZA A CREAR EXCEL *******/
	// DATOS INICIALES
	$sheet->getColumnDimension('A')->setWidth(5);


	$sheet->mergeCells('B2:D2');
	$sheet->setCellValue('B2', 'Resumen Remuneraciones');
	$sheet->getColumnDimension('B')->setWidth(20);
	$sheet->setCellValue('B3', 'Nombre Empresa');
	$sheet->setCellValue('C3',html_entity_decode($this->session->userdata('empresanombre')));
	$sheet->mergeCells('C3:D3');
	$sheet->setCellValue('B4', 'Rut Empresa');
	$sheet->setCellValue('C4',number_format($datos_empresa->rut,0,".",".") . '-' .$datos_empresa->dv);	        
	$sheet->mergeCells('C4:D4');
	$sheet->setCellValue('B5', 'Direccion Empresa');
	$sheet->setCellValue('C5',$datos_empresa->direccion.", ".$datos_empresa->comuna);	        	        
	$sheet->mergeCells('C5:D5');
	$sheet->setCellValue('B6', 'Fecha emision Reporte');
	$sheet->setCellValue('C6',date('d/m/Y') );
	$sheet->mergeCells('C6:D6');
	

	$sheet->setCellValue('B7', 'Período Reporte');
	$sheet->setCellValue('C7',month2string($periodo->mes).' '.$periodo->anno );
	//$sheet->setCellValue('C7',date('d/m/Y') );
	$sheet->mergeCells('C7:D7');
	

	$sheet->getStyle("B2:B7")->getFont()->setBold(true);
	$sheet->getStyle("B2:D7")->getFont()->setSize(10);    	

	//D7E4BC


	/****************** TABLA INICIAL ****************/

	/*************************todos los bordes internos *************************************/
	$sheet->getStyle("B2:D7")->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


	/*************************bordes cuadro principal (externo) *************************************/
	$sheet->getStyle("B2:D2")->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
	$sheet->getStyle("B2:D2")->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
	$sheet->getStyle("B7:D7")->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
	$sheet->getStyle("B2:B7")->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
	$sheet->getStyle("B2:B7")->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
	$sheet->getStyle("D2:D7")->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);

	/**********************************************************************************************************/			        
	/***** COLOR TABLA ****************/
	$sheet->getStyle("B2:D2")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$sheet->getStyle("B2:D2")->getFill()->getStartColor()->setRGB('FA8D72');

	$sheet->getStyle("B2:B7")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$sheet->getStyle("B2:B7")->getFill()->getStartColor()->setRGB('FA8D72');			


	$i = 9;		
	$filaInicio = $i; 
	$sueldobase = 0;
	$gratificacion = 0;
	$movilizacion = 0;
	$colacion = 0;
	$bonosimponibles = 0;
	$bonosnoimponibles = 0;
	$horasextras50 = 0;
	$numhorasextras50 = 0;
	$horasextras100 = 0;
	$numhorasextras100 = 0;
	$semanacorrida = 0;
	$aguinaldo = 0;
	$asigfamiliar = 0;
	$segcesantia = 0;
	$impuesto = 0;
	$anticipo = 0;
	$descuentoaguinaldo = 0;
	$horasdescuentos = 0;
	$descuentosvariables = 0;
	$total_afp = 0;
	$total_salud = 0;
	$total_apv = 0;

	$ccafcredito = 0;
	$ccafseguro = 0;


	$liquido_pago = 0;
	$aportesegcesantia = 0;
	$aportesis = 0;
	$mutualseguridad = 0;

	$baseimponible = 0;
	$basetributaria = 0;
	//$prestamos = 0;
	$array_salud = array();
	$array_afp = array();
	$array_apv = array();
	
	$num_trabajadores = 0;
	foreach($datos_remuneracion as $remuneracion){

		$datos_descuentos = $this->rrhh_model->get_bonos_by_remuneracion($remuneracion->id_remuneracion,null,'DESCUENTO');

		//$datos_d = $this->get_haberes_descuentos($datos_remuneracion->idtrabajador,null,'DESCUENTO',$datos_remuneracion->id_periodo);
		$monto_descuento = 0;
		foreach ($datos_descuentos as $dato_descuento) {
			$monto_descuento += $dato_descuento->monto;
		}
		
		
		$sueldobase += $remuneracion->sueldobase;
		$gratificacion += $remuneracion->gratificacion;
		$movilizacion += $remuneracion->movilizacion;
		$colacion += $remuneracion->colacion;
		$bonosimponibles += $remuneracion->bonosimponibles;
		$bonosnoimponibles += $remuneracion->bonosnoimponibles;
	
		$horasextras50 += $remuneracion->montohorasextras50;
		$horasextras100 += $remuneracion->montohorasextras100;

		$numhorasextras50 += $remuneracion->horasextras50;
		$numhorasextras100 += $remuneracion->horasextras100;
		$semanacorrida += $remuneracion->semana_corrida;
		$aguinaldo += $remuneracion->aguinaldobruto;
		$asigfamiliar += $remuneracion->asigfamiliar;
		$segcesantia += $remuneracion->segcesantia;
		$impuesto += $remuneracion->impuesto;
		$anticipo += $remuneracion->anticipo;
		$descuentoaguinaldo += $remuneracion->aguinaldo;
		$horasdescuentos += $remuneracion->montodescuento;
		$descuentosvariables += $monto_descuento;

		$ccafcredito += $remuneracion->ccafcredito;
		$ccafseguro += $remuneracion->ccafseguro;

		$liquido_pago += $remuneracion->sueldoliquido;

		$aportesegcesantia += $remuneracion->aportesegcesantia;
		$aportesis += $remuneracion->seginvalidez;
		$mutualseguridad += $remuneracion->aportepatronal;

		$baseimponible += $remuneracion->sueldoimponible;
		$basetributaria += $remuneracion->basetributaria;

		if(!isset($array_salud[$remuneracion->prev_salud])){
			$array_salud[$remuneracion->prev_salud] = 0;
		}

		if(!isset($array_afp[$remuneracion->afp])){
			$array_afp[$remuneracion->afp]['cotizacion'] = 0;
			$array_afp[$remuneracion->afp]['adicional'] = 0;
			$array_afp[$remuneracion->afp]['ahorrovol'] = 0;
		}

		if(!is_null($remuneracion->nomapv)){

			if(!isset($array_apv[$remuneracion->nomapv])){
				$array_apv[$remuneracion->nomapv] = 0;
			}

		}


		$array_salud[$remuneracion->prev_salud] += $remuneracion->cotizacionsalud + $remuneracion->cotadicisapre + $remuneracion->adicsalud + $remuneracion->fonasa + $remuneracion->inp;
		$array_afp[$remuneracion->afp]['cotizacion'] += $remuneracion->cotizacionobligatoria + $remuneracion->comisionafp;
		$array_afp[$remuneracion->afp]['adicional'] += $remuneracion->adicafp;
		$array_afp[$remuneracion->afp]['ahorrovol'] += $remuneracion->montoahorrovol;
		$total_salud += $remuneracion->cotizacionsalud + $remuneracion->cotadicisapre + $remuneracion->adicsalud + $remuneracion->fonasa + $remuneracion->inp;
		$total_afp += $remuneracion->cotizacionobligatoria + $remuneracion->comisionafp + $remuneracion->adicafp + $remuneracion->montoahorrovol;
		if(!is_null($remuneracion->nomapv)){
			$array_apv[$remuneracion->nomapv] += $remuneracion->montocotapv;
			$total_apv += $remuneracion->montocotapv;
		}

		$num_trabajadores++;
	}
	//echo '<pre>';
	//var_dump($array_apv);  exit;
	$total_haberes = $sueldobase + $gratificacion + $movilizacion + $colacion + $bonosimponibles + $bonosnoimponibles + $horasextras50 + $horasextras100 + $semanacorrida + $aguinaldo + $asigfamiliar;
	$total_descuentos = $total_salud + $total_afp + $total_apv + $segcesantia + $impuesto + $anticipo + $descuentoaguinaldo + $horasdescuentos + $descuentosvariables + $ccafcredito + $ccafseguro;
	$total_aportes = $aportesegcesantia + $aportesis + $mutualseguridad;


//ENCABEZADO REPORTE

	 $sheet->getColumnDimension('B')->setWidth(10);
	 $sheet->setCellValue('B'.$i, '#');
	 $sheet->getColumnDimension('C')->setWidth(40);
	 $sheet->setCellValue('C'.$i, 'Concepto');
	 $sheet->getColumnDimension('D')->setWidth(15);
	 $sheet->setCellValue('D'.$i, 'Total General');
	 $sheet->getColumnDimension('E')->setWidth(35);
	 $sheet->setCellValue('E'.$i, 'Información Adicional');

	 $i = $i + 1;
	 $sheet->mergeCells('B' . ($i - 1) . ':B' . $i );	 
	 $sheet->setCellValue('C'.$i, 'HABERES');
	 $sheet->mergeCells('D' . ($i - 1) . ':D' . $i );
	 $sheet->mergeCells('E' . ($i - 1) . ':E' . $i );

     $i = $i + 1;
	 $sheet->setCellValue('B'.$i, '1');
	 $sheet->setCellValue('C'.$i, 'Sueldo Base');
	 $sheet->setCellValue('D'.$i, $sueldobase);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, '');


     $i = $i + 1;
	 $sheet->setCellValue('B'.$i, '2');
	 $sheet->setCellValue('C'.$i, 'Gratificación');
	 $sheet->setCellValue('D'.$i, $gratificacion);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, '');
	 
     $i = $i + 1;
	 $sheet->setCellValue('B'.$i, '3');
	 $sheet->setCellValue('C'.$i, 'Movilización');
	 $sheet->setCellValue('D'.$i, $movilizacion);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, '');

     $i = $i + 1;
	 $sheet->setCellValue('B'.$i, '4');
	 $sheet->setCellValue('C'.$i, 'Colación');
	 $sheet->setCellValue('D'.$i, $colacion);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, '');	 

     $i = $i + 1;
	 $sheet->setCellValue('B'.$i, '5');
	 $sheet->setCellValue('C'.$i, 'Bonos Imponibles');
	 $sheet->setCellValue('D'.$i, $bonosimponibles);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, '');

     $i = $i + 1;
	 $sheet->setCellValue('B'.$i, '6');
	 $sheet->setCellValue('C'.$i, 'Bonos No Imponibles');
	 $sheet->setCellValue('D'.$i, $bonosnoimponibles);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, ''); 


     $i = $i + 1;
	 $sheet->setCellValue('B'.$i, '7');
	 $sheet->setCellValue('C'.$i, 'Horas Extras 50%');
	 $sheet->setCellValue('D'.$i, $horasextras50);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, $numhorasextras50 . ' Horas');



     $i = $i + 1;
	 $sheet->setCellValue('B'.$i, '8');
	 $sheet->setCellValue('C'.$i, 'Horas Extras 100%');
	 $sheet->setCellValue('D'.$i, $horasextras100);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, $numhorasextras100 . ' Horas');

	 $i = $i + 1;
	 $sheet->setCellValue('B'.$i, '9');
	 $sheet->setCellValue('C'.$i, 'Semana Corrida');
	 $sheet->setCellValue('D'.$i, $semanacorrida);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, '');	 


     $i = $i + 1;
	 $sheet->setCellValue('B'.$i, '10');
	 $sheet->setCellValue('C'.$i, 'Aguinaldo');
	 $sheet->setCellValue('D'.$i, $aguinaldo);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, ''); 	 


     $i = $i + 1;
	 $sheet->setCellValue('B'.$i, '11');
	 $sheet->setCellValue('C'.$i, 'Asignación Familiar');
	 $sheet->setCellValue('D'.$i, $asigfamiliar);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, ''); 

	 $i = $i + 1;
	 $sheet->setCellValue('C'.$i, 'TOTAL HABERES');
	 //$sheet->mergeCells('B' . $i . ':C' . $i );	 
	 $sheet->setCellValue('D'.$i, $total_haberes);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, ''); 	 

	 $filaTotalHaberes = $i;
	 $i = $i + 1;
	 $sheet->setCellValue('C'.$i, 'DESCUENTOS');
	 //$sheet->mergeCells('B' . $i . ':C' . $i );	 
	 $sheet->setCellValue('D'.$i, '');

	 //$sheet->mergeCells('B' . $i . ':B' . ($i-1) );
	 $sheet->mergeCells('D' . $i . ':E' . $i );

	 $j = 1;
	 foreach($array_afp as $nombreafp => $valores_afp){

		$i = $i + 1;
		$sheet->setCellValue('B'.$i, $j);
		$sheet->setCellValue('C'.$i, $nombreafp . ' Cot Obligatoria');
		$sheet->setCellValue('D'.$i, $valores_afp['cotizacion']);
		$sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
		$sheet->setCellValue('E'.$i, ''); 

		$i = $i + 1;
		$j = $j + 1;
		$sheet->setCellValue('B'.$i, $j);
		$sheet->setCellValue('C'.$i, $nombreafp . ' Cot Adicional');
		$sheet->setCellValue('D'.$i, $valores_afp['adicional']);
		$sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
		$sheet->setCellValue('E'.$i, ''); 

		$i = $i + 1;
		$j = $j + 1;
		$sheet->setCellValue('B'.$i, $j);
		$sheet->setCellValue('C'.$i, $nombreafp . ' Ahorro Voluntario');
		$sheet->setCellValue('D'.$i, $valores_afp['ahorrovol']);
		$sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
		$sheet->setCellValue('E'.$i, ''); 	
		
		$j = $j + 1;
	 }


	 foreach($array_apv as $nombreapv => $valores_apv){

		$i = $i + 1;
		$sheet->setCellValue('B'.$i, $j);
		$sheet->setCellValue('C'.$i, 'APV ' .$nombreapv);
		$sheet->setCellValue('D'.$i, $valores_apv);
		$sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
		$sheet->setCellValue('E'.$i, ''); 

		$j = $j + 1;
	 }
	 

	 foreach($array_salud as $nombreisapre => $valores_isapre){

		$i = $i + 1;
		$sheet->setCellValue('B'.$i, $j);
		$sheet->setCellValue('C'.$i, $nombreisapre);
		$sheet->setCellValue('D'.$i, $valores_isapre);
		$sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
		$sheet->setCellValue('E'.$i, ''); 

		$j = $j + 1;
	 }
	 


     $i = $i + 1;
	 $sheet->setCellValue('B'.$i, $j);
	 $sheet->setCellValue('C'.$i, 'Seguro Cesantía');
	 $sheet->setCellValue('D'.$i, $segcesantia);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, ''); 
	 $j = $j + 1;

     $i = $i + 1;
	 $sheet->setCellValue('B'.$i, $j);
	 $sheet->setCellValue('C'.$i, 'Impuesto');
	 $sheet->setCellValue('D'.$i, $impuesto);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, ''); 
	 $j = $j + 1;

	 $i = $i + 1;
	 $sheet->setCellValue('B'.$i, $j);
	 $sheet->setCellValue('C'.$i, 'Anticipo');
	 $sheet->setCellValue('D'.$i, $anticipo);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, ''); 
	 $j = $j + 1;


	 $i = $i + 1;
	 $sheet->setCellValue('B'.$i, $j);
	 $sheet->setCellValue('C'.$i, 'Descuento por Aguinaldo');
	 $sheet->setCellValue('D'.$i, $descuentoaguinaldo);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, ''); 
	 $j = $j + 1;


	 $i = $i + 1;
	 $sheet->setCellValue('B'.$i, $j);
	 $sheet->setCellValue('C'.$i, 'CCAF Crédito');
	 $sheet->setCellValue('D'.$i, $ccafcredito);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, ''); 
	 $j = $j + 1;


	 $i = $i + 1;
	 $sheet->setCellValue('B'.$i, $j);
	 $sheet->setCellValue('C'.$i, 'CCAF Seguro');
	 $sheet->setCellValue('D'.$i, $ccafseguro);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, ''); 
	 $j = $j + 1;
	 	 	 

	 $i = $i + 1;
	 $sheet->setCellValue('B'.$i, $j);
	 $sheet->setCellValue('C'.$i, 'Horas Descuento');
	 $sheet->setCellValue('D'.$i, $horasdescuentos);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, ''); 
	 $j = $j + 1;

	 
	 $i = $i + 1;
	 $sheet->setCellValue('B'.$i, $j);
	 $sheet->setCellValue('C'.$i, 'Otros Descuentos');
	 $sheet->setCellValue('D'.$i, $descuentosvariables);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, ''); 
	 $j = $j + 1;

	 $i = $i + 1;
	 $sheet->setCellValue('C'.$i, 'TOTAL DESCUENTOS');
	 //$sheet->mergeCells('B' . $i . ':C' . $i );	 
	 $sheet->setCellValue('D'.$i, $total_descuentos);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, ''); 	 

	 $filaTotalDescuentos = $i;
	 $i = $i + 1;
	 $sheet->setCellValue('C'.$i, 'LIQUIDO A PAGAR');
	 //$sheet->mergeCells('B' . $i . ':C' . $i );	 
	 $sheet->setCellValue('D'.$i, $liquido_pago);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, ''); 	

	 $filaTotalLiquidoPagar = $i;

	 $i = $i + 1;
	 $sheet->setCellValue('C'.$i, 'APORTES EMPRESA');
	 //$sheet->mergeCells('B' . $i . ':C' . $i );	 
	 $sheet->setCellValue('D'.$i, '');	 
	 $sheet->mergeCells('D' . $i . ':E' . $i );

	 
	 //$sheet->mergeCells('B' . ($i-2) . ':B' . $i );


	 $i = $i + 1;
	 $sheet->setCellValue('B'.$i, 1);
	 $sheet->setCellValue('C'.$i, 'Aporte Seguro Cesantia');
	 $sheet->setCellValue('D'.$i, $aportesegcesantia);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, ''); 

	 $i = $i + 1;
	 $sheet->setCellValue('B'.$i, 2);
	 $sheet->setCellValue('C'.$i, 'Aporte SIS');
	 $sheet->setCellValue('D'.$i,$aportesis);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, ''); 

	 $i = $i + 1;
	 $sheet->setCellValue('B'.$i, 3);
	 $sheet->setCellValue('C'.$i, 'Mutual de Seguridad');
	 $sheet->setCellValue('D'.$i, $mutualseguridad);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, ''); 

	 $i = $i + 1;
	 $sheet->setCellValue('C'.$i, 'TOTAL APORTES EMPRESA');
	 //$sheet->mergeCells('B' . $i . ':C' . $i );	 
	 $sheet->setCellValue('D'.$i,  $total_aportes);	 
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');

	 $filaTotalAportesEmpresa = $i;

	 $i = $i + 1;
	 $sheet->setCellValue('C'.$i, 'OTROS DATOS');
	 //$sheet->mergeCells('B' . $i . ':C' . $i );	 
	 $sheet->setCellValue('D'.$i, '');	 
	 //$sheet->mergeCells('D' . $i . ':E' . $i );

	 
	// $sheet->mergeCells('B' . ($i-1) . ':B' . $i );

	 $i = $i + 1;
	 $sheet->setCellValue('B'.$i, 1);
	 $sheet->setCellValue('C'.$i, 'Bases Imponibles');
	 $sheet->setCellValue('D'.$i, $baseimponible);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, ''); 

	 
	 $i = $i + 1;
	 $sheet->setCellValue('B'.$i, 2);
	 $sheet->setCellValue('C'.$i, 'Bases Tributables');
	 $sheet->setCellValue('D'.$i, $basetributaria);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, ''); 
	 

	 $i = $i + 1;
	 $sheet->setCellValue('B'.$i, 3);
	 $sheet->setCellValue('C'.$i, 'Num Trabajadores');
	 $sheet->setCellValue('D'.$i, $num_trabajadores);
	 $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');
	 $sheet->setCellValue('E'.$i, ''); 


	 /************************* ESTILOS */
	 /*************************todos los bordes internos *************************************/
	$sheet->getStyle("B".$filaInicio.":E".$i)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$sheet->getStyle("B" . $filaInicio . ":E".$i)->getFont()->setSize(10);
	$sheet->getStyle("B".$filaInicio.":E".($filaInicio + 1))->getFont()->setBold(true);
	$sheet->getStyle("B".$filaInicio.":C".$i)->getFont()->setBold(true);

	for($j = $filaInicio; $j <= $i; $j++){

		if($j % 2 != 0){
			$sheet->getStyle("B".$j.":E".$j)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$sheet->getStyle("B".$j.":E".$j)->getFill()->getStartColor()->setRGB('F7F9FD');	 
		}
	}

	/***************************** Color fila superior********************************************************/
	
		$sheet->getStyle("B".$filaInicio.":E".($filaInicio + 1))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
		$sheet->getStyle("B".$filaInicio.":E".($filaInicio + 1))->getFill()->getStartColor()->setRGB('E8EDFF');

		$sheet->getStyle("B".$filaInicio.":C".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
		$sheet->getStyle("B".$filaInicio.":C".$i)->getFill()->getStartColor()->setRGB('E8EDFF');


		
		$sheet->getStyle("B".$filaTotalHaberes.":E".$filaTotalHaberes)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
		$sheet->getStyle("B".$filaTotalHaberes.":E".$filaTotalHaberes)->getFill()->getStartColor()->setRGB('C3ECCB');

		$sheet->getStyle("B".$filaTotalDescuentos.":E".$filaTotalDescuentos)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
		$sheet->getStyle("B".$filaTotalDescuentos.":E".$filaTotalDescuentos)->getFill()->getStartColor()->setRGB('C3ECCB');

		$sheet->getStyle("B".$filaTotalLiquidoPagar.":E".$filaTotalLiquidoPagar)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
		$sheet->getStyle("B".$filaTotalLiquidoPagar.":E".$filaTotalLiquidoPagar)->getFill()->getStartColor()->setRGB('C3ECCB');

		$sheet->getStyle("B".$filaTotalAportesEmpresa.":E".$filaTotalAportesEmpresa)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
		$sheet->getStyle("B".$filaTotalAportesEmpresa.":E".$filaTotalAportesEmpresa)->getFill()->getStartColor()->setRGB('C3ECCB');

		/******************************************************************************************************/

		
	/*************************bordes cuadro principal (externo) *************************************/
	$sheet->getStyle("B".$filaInicio.":E".$filaInicio)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
	$sheet->getStyle("B".($filaInicio+1).":E".($filaInicio+1))->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
	$sheet->getStyle("C".$filaInicio.":E".$filaInicio)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
	

	$sheet->getStyle("B".$filaInicio.":B".$i)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
	$sheet->getStyle("C".$filaInicio.":C".$i)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
	$sheet->getStyle("D".$filaInicio.":D".$i)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
	$sheet->getStyle("E".$filaInicio.":E".$i)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);

	$sheet->getStyle("B".$filaTotalHaberes.":E".$filaTotalHaberes)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
	$sheet->getStyle("B".$filaTotalHaberes.":E".$filaTotalHaberes)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);

	$sheet->getStyle("B".$filaTotalDescuentos.":E".$filaTotalDescuentos)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
	$sheet->getStyle("B".$filaTotalDescuentos.":E".$filaTotalDescuentos)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);

	$sheet->getStyle("B".$filaTotalLiquidoPagar.":E".$filaTotalLiquidoPagar)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
	$sheet->getStyle("B".$filaTotalLiquidoPagar.":E".$filaTotalLiquidoPagar)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);

	$sheet->getStyle("B".$filaTotalAportesEmpresa.":E".$filaTotalAportesEmpresa)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
	$sheet->getStyle("B".$filaTotalAportesEmpresa.":E".$filaTotalAportesEmpresa)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);

	$sheet->getStyle("E".$filaInicio.":E".$i)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
	$sheet->getStyle("B".$i.":E".$i)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
	

	

	header("Content-Type: application/vnd.ms-excel");
	$nombreArchivo = 'resumen_remuneraciones';
	header("Content-Disposition: attachment; filename=\"$nombreArchivo.xlsx\"");
	header("Cache-Control: max-age=0");
	// Genera Excel
	$writer = new Xlsx($spreadsheet); //objeto de PHPExcel, para escribir en el excel
	//$writer = new PHPExcel_Writer_Excel2007($this->phpexcel); //objeto de PHPExcel, para escribir en el excel
	// Escribir
	//$writer->setIncludeCharts(TRUE);			
	$writer->save('php://output');
	exit;		


	 $columnaFinal = 43;
	 $mergeTotal = 44;
	 $columnaTotales = 43;
	 $sheet->getStyle("B".$i.":".ordenLetrasExcel($columnaFinal).$i)->getFont()->setBold(true);
	 $i++;
	$filaInicio = $i-1; 
	
	//$sheet->getStyle("B7:I7")->getFont()->setSize(11);  
	$linea = 1;
	foreach ($datos_remuneracion as $remuneracion) {
         	            	            	
		 if($i % 2 != 0){
			 //echo "consulta 4: -- i : ".$i. "  -- mod : ". ($i % 2)."<br>";
			$sheet->getStyle("B".$i.":".ordenLetrasExcel($columnaFinal).$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$sheet->getStyle("B".$i.":".ordenLetrasExcel($columnaFinal).$i)->getFill()->getStartColor()->setRGB('F7F9FD');	  				
		 }	            	
		$i++;
		$linea++;
	  }
	 $i--;



				 
	$sheet->getStyle("B" . $filaInicio . ":".ordenLetrasExcel($columnaFinal).$i)->getFont()->setSize(10);


/*************************todos los bordes internos *************************************/
	$sheet->getStyle("B".$filaInicio.":".ordenLetrasExcel($columnaFinal).$i)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


	/*************************bordes cuadro principal (externo) *************************************/
			for($j=1;$j<=$columnaFinal;$j++){ //borde superior
				$sheet->getStyle(ordenLetrasExcel($j).$filaInicio)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
			}
	
			for($j=1;$j<=$columnaFinal;$j++){ //borde inferior
				$sheet->getStyle(ordenLetrasExcel($j).$i)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
			}
	
			for($n=$filaInicio;$n<=$i;$n++){ //borde izquierdo
				$sheet->getStyle("B".$n)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
			}
	
			for($n=$filaInicio;$n<=$i;$n++){ //borde derecho
				$sheet->getStyle(ordenLetrasExcel($columnaFinal).$n)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
			}
	
	/**********************************************************************************************************/			        
		

	/***************************** Segundo borde superior********************************************************/
	
			for($j=1;$j<=$columnaFinal;$j++){ //borde inferior
				$sheet->getStyle(ordenLetrasExcel($j).$filaInicio)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
			}
	
	/******************************************************************************************************/
	

/***************************** Penultimo borde izquierdo ********************************************************/
	
			for($n=$filaInicio;$n<=$i;$n++){ //borde derecho
				$sheet->getStyle("B".$n)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
			}
	
/******************************************************************************************************/			



/***************************** Penultimo borde derecho ********************************************************/
	
			for($n=$filaInicio;$n<=$i;$n++){ //borde derecho
				$sheet->getStyle(ordenLetrasExcel($columnaFinal).$n)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
			}
	
/******************************************************************************************************/			

	/***************************** Color fila superior********************************************************/
	
			for($j=1;$j<=$columnaFinal;$j++){ //color fondo inferior
				$sheet->getStyle(ordenLetrasExcel($j).$filaInicio)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
				$sheet->getStyle(ordenLetrasExcel($j).$filaInicio)->getFill()->getStartColor()->setRGB('E8EDFF');
			}
	
	/******************************************************************************************************/


/***************************** Color primera columna ********************************************************/
				$sheet->getStyle("B".$filaInicio.":B".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
				$sheet->getStyle("B".$filaInicio.":B".$i)->getFill()->getStartColor()->setRGB('E8EDFF');
	
	/******************************************************************************************************/


/***************************** Color montos ********************************************************/

				$sheet->getStyle("R".$filaInicio.":R".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
				$sheet->getStyle("R".$filaInicio.":R".$i)->getFill()->getStartColor()->setRGB('E8EDFF');

				$sheet->getStyle("S".$filaInicio.":S".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
				$sheet->getStyle("S".$filaInicio.":S".$i)->getFill()->getStartColor()->setRGB('E8EDFF');

				$sheet->getStyle("T".$filaInicio.":T".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
				$sheet->getStyle("T".$filaInicio.":T".$i)->getFill()->getStartColor()->setRGB('E8EDFF');


				$sheet->getStyle("AF".$filaInicio.":AF".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
				$sheet->getStyle("AF".$filaInicio.":AF".$i)->getFill()->getStartColor()->setRGB('E8EDFF');	


				$sheet->getStyle("AG".$filaInicio.":AG".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
				$sheet->getStyle("AG".$filaInicio.":AG".$i)->getFill()->getStartColor()->setRGB('E8EDFF');	

				$sheet->getStyle("AM".$filaInicio.":AM".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
				$sheet->getStyle("AM".$filaInicio.":AM".$i)->getFill()->getStartColor()->setRGB('E8EDFF');									
				$sheet->getStyle("AN".$filaInicio.":AN".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
				$sheet->getStyle("AN".$filaInicio.":AN".$i)->getFill()->getStartColor()->setRGB('E8EDFF');	


				$sheet->getStyle("AR".$filaInicio.":AR".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
				$sheet->getStyle("AR".$filaInicio.":AR".$i)->getFill()->getStartColor()->setRGB('E8EDFF');											
	/******************************************************************************************************/


	$sheet->setSelectedCells('E1'); //celda seleccionada



	header("Content-Type: application/vnd.ms-excel");
	$nombreArchivo = 'libro_remuneraciones';
	header("Content-Disposition: attachment; filename=\"$nombreArchivo.xlsx\"");
	header("Cache-Control: max-age=0");
	// Genera Excel
	$writer = new Xlsx($spreadsheet); //objeto de PHPExcel, para escribir en el excel
	//$writer = new PHPExcel_Writer_Excel2007($this->phpexcel); //objeto de PHPExcel, para escribir en el excel
	// Escribir
	//$writer->setIncludeCharts(TRUE);			
	$writer->save('php://output');
	exit;				
}			



public function libro($datos_remuneracion){

			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();

	  	    //$this->phpexcel->setActiveSheetIndex(0);
	        //$sheet = $this->phpexcel->getActiveSheet();
	        $sheet->setTitle("libro_remuneraciones");




			$this->load->model('admin');
			$this->load->model('rrhh_model');
			$datos_empresa = $this->admin->datos_empresa($this->session->userdata('empresaid'));

			/********* COMIENZA A CREAR EXCEL *******/
	        // DATOS INICIALES
			$sheet->getColumnDimension('A')->setWidth(5);


	        $sheet->mergeCells('B2:D2');
	        $sheet->setCellValue('B2', 'Libro Remuneraciones');
	        $sheet->getColumnDimension('B')->setWidth(20);
	        $sheet->setCellValue('B3', 'Nombre Empresa');
	        $sheet->setCellValue('C3',html_entity_decode($this->session->userdata('empresanombre')));
	        $sheet->mergeCells('C3:D3');
	        $sheet->setCellValue('B4', 'Rut Empresa');
	        $sheet->setCellValue('C4',number_format($datos_empresa->rut,0,".",".") . '-' .$datos_empresa->dv);	        
	        $sheet->mergeCells('C4:D4');
	        $sheet->setCellValue('B5', 'Direccion Empresa');
	        $sheet->setCellValue('C5',$datos_empresa->direccion.", ".$datos_empresa->comuna);	        	        
	        $sheet->mergeCells('C5:D5');
	        $sheet->setCellValue('B6', 'Fecha emision Reporte');
	        $sheet->setCellValue('C6',date('d/m/Y') );
	        $sheet->mergeCells('C6:D6');
	        

	        $sheet->getStyle("B2:B6")->getFont()->setBold(true);
			$sheet->getStyle("B2:D6")->getFont()->setSize(10);    	

			//D7E4BC


			/****************** TABLA INICIAL ****************/

			/*************************todos los bordes internos *************************************/
			$sheet->getStyle("B2:D6")->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


			/*************************bordes cuadro principal (externo) *************************************/
			$sheet->getStyle("B2:D2")->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
			$sheet->getStyle("B2:D2")->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
			$sheet->getStyle("B6:D6")->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
			$sheet->getStyle("B2:B6")->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
			$sheet->getStyle("B2:B6")->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
			$sheet->getStyle("D2:D6")->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
		
			/**********************************************************************************************************/			        
			/***** COLOR TABLA ****************/
			$sheet->getStyle("B2:D2")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$sheet->getStyle("B2:D2")->getFill()->getStartColor()->setRGB('FA8D72');

			$sheet->getStyle("B2:B6")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$sheet->getStyle("B2:B6")->getFill()->getStartColor()->setRGB('FA8D72');			


			$i = 8;		

	//ENCABEZADO REPORTE

			 $sheet->getColumnDimension('B')->setWidth(10);
			 $sheet->setCellValue('B'.$i, '#');
			 $sheet->getColumnDimension('C')->setWidth(15);
			 $sheet->setCellValue('C'.$i, 'Rut');
			 $sheet->getColumnDimension('D')->setWidth(35);
			 $sheet->setCellValue('D'.$i, 'Nombre');
			 $sheet->getColumnDimension('E')->setWidth(15);
			 $sheet->setCellValue('E'.$i, 'Fecha Ingreso');
			 $sheet->getColumnDimension('F')->setWidth(15);			
			 $sheet->setCellValue('F'.$i, 'Sueldo Base');
			 $sheet->getColumnDimension('G')->setWidth(15);			
			 $sheet->setCellValue('G'.$i, 'Días Trabajados');
			 $sheet->getColumnDimension('H')->setWidth(15);			
			 $sheet->setCellValue('H'.$i, 'Gratificación');	
			 $sheet->getColumnDimension('I')->setWidth(15);			
			 $sheet->setCellValue('I'.$i, 'Movilización');	
			 $sheet->getColumnDimension('J')->setWidth(15);			
			 $sheet->setCellValue('J'.$i, 'Colación');		
			 $sheet->getColumnDimension('K')->setWidth(15);			
			 $sheet->setCellValue('K'.$i, 'Bonos Imponibles');				 			 			 		 
			 $sheet->getColumnDimension('L')->setWidth(15);			
			 $sheet->setCellValue('L'.$i, 'Bonos No Imponibles');	
			 $sheet->getColumnDimension('M')->setWidth(15);			
			 $sheet->setCellValue('M'.$i, 'Horas Extras 50%');	
			 $sheet->getColumnDimension('N')->setWidth(15);			
			 $sheet->setCellValue('N'.$i, 'Horas Extras 100%');	
			 $sheet->getColumnDimension('O')->setWidth(15);			
			 $sheet->setCellValue('O'.$i, 'Semana Corrida');				 
			 $sheet->getColumnDimension('P')->setWidth(15);			
			 $sheet->setCellValue('P'.$i, 'Aguinaldo');	
			 $sheet->getColumnDimension('Q')->setWidth(15);			
			 $sheet->setCellValue('Q'.$i, 'Asignación Familiar');
			 $sheet->getColumnDimension('R')->setWidth(15);			
			 $sheet->setCellValue('R'.$i, 'Total Imponible');	
			 $sheet->getColumnDimension('S')->setWidth(15);			
			 $sheet->setCellValue('S'.$i, 'Total No Imponible');		 			 			 		
			 $sheet->getColumnDimension('T')->setWidth(15);			
			 $sheet->setCellValue('T'.$i, 'Total Haberes');				 			 
			 $sheet->getColumnDimension('U')->setWidth(15);			
			 $sheet->setCellValue('U'.$i, 'Cotización Obligatoria');				 			 
			 $sheet->getColumnDimension('V')->setWidth(15);			
			 $sheet->setCellValue('V'.$i, 'Comisión AFP');				 			 
			 $sheet->getColumnDimension('W')->setWidth(15);			
			 $sheet->setCellValue('W'.$i, 'Adicional AFP');				 			 
			 $sheet->getColumnDimension('X')->setWidth(15);			
			 $sheet->setCellValue('X'.$i, 'Ahorro Voluntario');	
			 $sheet->getColumnDimension('Y')->setWidth(15);			
			 $sheet->setCellValue('Y'.$i, 'APV');	
			 $sheet->getColumnDimension('Z')->setWidth(15);			
			 $sheet->setCellValue('Z'.$i, 'Cotización Salud Obligatoria');	
			 $sheet->getColumnDimension('AA')->setWidth(15);			
			 $sheet->setCellValue('AA'.$i, 'Cotización Adicional Isapre');	
			 $sheet->getColumnDimension('AB')->setWidth(15);			
			 $sheet->setCellValue('AB'.$i, 'Adicional Salud');	
			 $sheet->getColumnDimension('AC')->setWidth(15);			
			 $sheet->setCellValue('AC'.$i, 'Fonasa');	
			 $sheet->getColumnDimension('AD')->setWidth(15);			
			 $sheet->setCellValue('AD'.$i, 'Seguro Cesantía');	
			 $sheet->getColumnDimension('AE')->setWidth(15);			
			 $sheet->setCellValue('AE'.$i, 'Impuesto');	
			 $sheet->getColumnDimension('AF')->setWidth(15);			
			 $sheet->setCellValue('AF'.$i, 'Total Descuentos Legales');	
			 $sheet->getColumnDimension('AG')->setWidth(15);			
			 $sheet->setCellValue('AG'.$i, 'Base Tributaria');				 
			 $sheet->getColumnDimension('AH')->setWidth(15);			
			 $sheet->setCellValue('AH'.$i, 'Anticipo');	
			 $sheet->getColumnDimension('AI')->setWidth(15);			
			 $sheet->setCellValue('AI'.$i, 'Descuento por Aguinaldo');	
			 $sheet->getColumnDimension('AJ')->setWidth(15);			
			 $sheet->setCellValue('AJ'.$i, 'Horas Descuento');	
			 $sheet->getColumnDimension('AK')->setWidth(15);			
			 $sheet->setCellValue('AK'.$i, 'Otros Descuentos');	
			 $sheet->getColumnDimension('AL')->setWidth(15);			
			 $sheet->setCellValue('AL'.$i, 'Préstamos');	

			 $sheet->getColumnDimension('AM')->setWidth(15);			
			 $sheet->setCellValue('AM'.$i, 'CCAF Crédito');	


			 $sheet->getColumnDimension('AN')->setWidth(15);			
			 $sheet->setCellValue('AN'.$i, 'CCAF Seguro');	


			 $sheet->getColumnDimension('AO')->setWidth(15);			
			 $sheet->setCellValue('AO'.$i, 'Total Otros Descuentos');				 			 			 			 		
			 $sheet->getColumnDimension('AP')->setWidth(15);			
			 $sheet->setCellValue('AP'.$i, 'Líquido a Pagar');				 			 			 			 		
			 $sheet->getColumnDimension('AQ')->setWidth(15);	
			 $sheet->setCellValue('AQ'.$i, 'Aporte Seguro Cesantía');	 
			 $sheet->getColumnDimension('AR')->setWidth(15);			
			 $sheet->setCellValue('AR'.$i, 'Aporte SIS');	 
			 $sheet->getColumnDimension('AS')->setWidth(15);			
			 $sheet->setCellValue('AS'.$i, 'Mutual de Seguridad');	 
			 $sheet->getColumnDimension('AT')->setWidth(15);			
			 $sheet->setCellValue('AT'.$i, 'Total Aportes Empresa');	 




			 $columnaFinal = 45;
			 $mergeTotal = 46;
			 $columnaTotales = 45;
			 $sheet->getStyle("B".$i.":".ordenLetrasExcel($columnaFinal).$i)->getFont()->setBold(true);
			 $i++;
			$filaInicio = $i-1; 
			
			//$sheet->getStyle("B7:I7")->getFont()->setSize(11);  
			$linea = 1;
            foreach ($datos_remuneracion as $remuneracion) {

            	$datos_bonos_imponibles = $this->rrhh_model->get_bonos_by_remuneracion($remuneracion->id_remuneracion,true,'HABER');
            	//$datos_bonos_imponibles = array();
            	$bonos_imponibles = 0;
            	foreach ($datos_bonos_imponibles as $bono_imponible) {
            		$bonos_imponibles += $bono_imponible->monto;
            	}


            	$datos_bonos_no_imponibles = $this->rrhh_model->get_bonos_by_remuneracion($remuneracion->id_remuneracion,false,'HABER');

            	//$datos_bonos_no_imponibles = array();
            	$bonos_no_imponibles = 0;
            	foreach ($datos_bonos_no_imponibles as $bono_no_imponible) {     	

            		
            		$bonos_no_imponibles += $bono_no_imponible->monto;
            	}

				//$datos_descuentos = $this->get_descuento($remuneracion->idperiodo,'D',$remuneracion->idtrabajador);
				/*$datos_descuentos = $this->rrhh_model->get_haberes_descuentos($remuneracion->idtrabajador,null,'DESCUENTO');	
				//$datos_descuentos = array();
				$monto_descuento = 0;
            	foreach ($datos_descuentos as $dato_descuento) {
            		$monto_descuento += $dato_descuento->monto;
            	} */          	



				$datos_descuentos = $this->rrhh_model->get_bonos_by_remuneracion($remuneracion->id_remuneracion,null,'DESCUENTO');

				//$datos_d = $this->get_haberes_descuentos($datos_remuneracion->idtrabajador,null,'DESCUENTO',$datos_remuneracion->id_periodo);
				$monto_descuento = 0;
				foreach ($datos_descuentos as $dato_descuento) {
					$monto_descuento += $dato_descuento->monto;
				}


            	//$datos_prestamos = $this->get_descuento($remuneracion->idperiodo,'P',$remuneracion->idtrabajador);
            	$datos_prestamos = array();
            	$monto_prestamo = 0;
            	foreach ($datos_prestamos as $dato_prestamo) {
            		$monto_prestamo += $dato_prestamo->monto;
            	}   

            	$sheet->setCellValue("B".$i,$linea);
            	$sheet->setCellValue("C".$i,$remuneracion->rut."-".$remuneracion->dv);
            	$sheet->setCellValue("D".$i,$remuneracion->nombre." ".$remuneracion->apaterno." ".$remuneracion->amaterno);
            	$sheet->setCellValue("E".$i,$remuneracion->fecingreso);
            	$sheet->setCellValue("F".$i,$remuneracion->sueldobase);
            	$sheet->getStyle('F'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("G".$i,$remuneracion->diastrabajo);
            	//$sheet->getStyle('G'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("H".$i,$remuneracion->gratificacion);
            	$sheet->getStyle('H'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("I".$i,$remuneracion->movilizacion);
            	$sheet->getStyle('I'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("J".$i,$remuneracion->colacion);
            	$sheet->getStyle('J'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("K".$i,$bonos_imponibles);
            	$sheet->getStyle('K'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("L".$i,$bonos_no_imponibles);
            	$sheet->getStyle('L'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("M".$i,$remuneracion->montohorasextras50);
            	$sheet->getStyle('M'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("N".$i,$remuneracion->montohorasextras100);
            	$sheet->getStyle('N'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("O".$i,$remuneracion->semana_corrida);
            	$sheet->getStyle('O'.$i)->getNumberFormat()->setFormatCode('#,##0');            	
            	$sheet->setCellValue("P".$i,$remuneracion->aguinaldobruto);
            	$sheet->getStyle('P'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("Q".$i,$remuneracion->asigfamiliar);
            	$sheet->getStyle('Q'.$i)->getNumberFormat()->setFormatCode('#,##0');      

            	$sheet->setCellValue("R".$i,$remuneracion->sueldoimponible);
            	$sheet->getStyle('R'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("S".$i,$remuneracion->sueldonoimponible);
            	$sheet->getStyle('S'.$i)->getNumberFormat()->setFormatCode('#,##0');


            	$sheet->setCellValue("T".$i,$remuneracion->totalhaberes);
            	$sheet->getStyle('T'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("U".$i,$remuneracion->cotizacionobligatoria);
            	$sheet->getStyle('U'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("V".$i,$remuneracion->comisionafp);
            	$sheet->getStyle('V'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("W".$i,$remuneracion->adicafp);
            	$sheet->getStyle('W'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("X".$i,$remuneracion->montoahorrovol);
            	$sheet->getStyle('X'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("Y".$i,$remuneracion->montocotapv);
            	$sheet->getStyle('Y'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("Z".$i,$remuneracion->cotizacionsalud);
            	$sheet->getStyle('Z'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AA".$i,$remuneracion->cotadicisapre);
            	$sheet->getStyle('AA'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AB".$i,$remuneracion->adicsalud);
            	$sheet->getStyle('AB'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AC".$i,$remuneracion->fonasa + $remuneracion->inp);
            	$sheet->getStyle('AC'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AD".$i,$remuneracion->segcesantia);
            	$sheet->getStyle('AD'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AE".$i,$remuneracion->impuesto);
            	$sheet->getStyle('AE'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AF".$i,$remuneracion->totaldescuentoslegales);
            	$sheet->getStyle('AF'.$i)->getNumberFormat()->setFormatCode('#,##0'); 


				$sheet->setCellValue("AG".$i,$remuneracion->basetributaria);
            	$sheet->getStyle('AG'.$i)->getNumberFormat()->setFormatCode('#,##0'); 


            	$sheet->setCellValue("AH".$i,$remuneracion->anticipo);
            	$sheet->getStyle('AH'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AI".$i,$remuneracion->aguinaldo);
            	$sheet->getStyle('AI'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AJ".$i,$remuneracion->montodescuento);
            	$sheet->getStyle('AJ'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AK".$i,$monto_descuento);
            	$sheet->getStyle('AK'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AL".$i,$monto_prestamo);
            	$sheet->getStyle('AL'.$i)->getNumberFormat()->setFormatCode('#,##0'); 

            	$sheet->setCellValue("AM".$i,$remuneracion->ccafcredito);
            	$sheet->getStyle('AM'.$i)->getNumberFormat()->setFormatCode('#,##0'); 

            	$sheet->setCellValue("AN".$i,$remuneracion->ccafseguro);
            	$sheet->getStyle('AN'.$i)->getNumberFormat()->setFormatCode('#,##0');             	

            	$sheet->setCellValue("AO".$i,$remuneracion->descuentosnolegales);
            	$sheet->getStyle('AO'.$i)->getNumberFormat()->setFormatCode('#,##0');



            	$sheet->setCellValue("AP".$i,$remuneracion->sueldoliquido);
            	$sheet->getStyle('AP'.$i)->getNumberFormat()->setFormatCode('#,##0');              	
            	$sheet->setCellValue("AQ".$i,$remuneracion->aportesegcesantia);
            	$sheet->getStyle('AQ'.$i)->getNumberFormat()->setFormatCode('#,##0');  
            	$sheet->setCellValue("AR".$i,$remuneracion->seginvalidez);
            	$sheet->getStyle('AR'.$i)->getNumberFormat()->setFormatCode('#,##0');  
            	$sheet->setCellValue("AS".$i,$remuneracion->aportepatronal);
            	$sheet->getStyle('AS'.$i)->getNumberFormat()->setFormatCode('#,##0');  
            	$sheet->setCellValue("AT".$i,$remuneracion->aportesegcesantia + $remuneracion->seginvalidez + $remuneracion->aportepatronal);
            	$sheet->getStyle('AT'.$i)->getNumberFormat()->setFormatCode('#,##0');              	            	            	

	 			if($i % 2 != 0){
	 				//echo "consulta 4: -- i : ".$i. "  -- mod : ". ($i % 2)."<br>";
					$sheet->getStyle("B".$i.":".ordenLetrasExcel($columnaFinal).$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
					$sheet->getStyle("B".$i.":".ordenLetrasExcel($columnaFinal).$i)->getFill()->getStartColor()->setRGB('F7F9FD');	  				
	 			}	            	
            	$i++;
            	$linea++;
              }
             $i--;



			         	
			$sheet->getStyle("B" . $filaInicio . ":".ordenLetrasExcel($columnaFinal).$i)->getFont()->setSize(10);


	/*************************todos los bordes internos *************************************/
			$sheet->getStyle("B".$filaInicio.":".ordenLetrasExcel($columnaFinal).$i)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


			/*************************bordes cuadro principal (externo) *************************************/
					for($j=1;$j<=$columnaFinal;$j++){ //borde superior
						$sheet->getStyle(ordenLetrasExcel($j).$filaInicio)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
					}
			
					for($j=1;$j<=$columnaFinal;$j++){ //borde inferior
						$sheet->getStyle(ordenLetrasExcel($j).$i)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
					}
			
					for($n=$filaInicio;$n<=$i;$n++){ //borde izquierdo
						$sheet->getStyle("B".$n)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
					}
			
					for($n=$filaInicio;$n<=$i;$n++){ //borde derecho
						$sheet->getStyle(ordenLetrasExcel($columnaFinal).$n)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
					}
			
			/**********************************************************************************************************/			        
				

			/***************************** Segundo borde superior********************************************************/
			
					for($j=1;$j<=$columnaFinal;$j++){ //borde inferior
						$sheet->getStyle(ordenLetrasExcel($j).$filaInicio)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
					}
			
			/******************************************************************************************************/
			

		/***************************** Penultimo borde izquierdo ********************************************************/
			
					for($n=$filaInicio;$n<=$i;$n++){ //borde derecho
						$sheet->getStyle("B".$n)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
					}
			
		/******************************************************************************************************/			



		/***************************** Penultimo borde derecho ********************************************************/
			
					for($n=$filaInicio;$n<=$i;$n++){ //borde derecho
						$sheet->getStyle(ordenLetrasExcel($columnaFinal).$n)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
					}
			
		/******************************************************************************************************/			

			/***************************** Color fila superior********************************************************/
			
					for($j=1;$j<=$columnaFinal;$j++){ //color fondo inferior
						$sheet->getStyle(ordenLetrasExcel($j).$filaInicio)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle(ordenLetrasExcel($j).$filaInicio)->getFill()->getStartColor()->setRGB('E8EDFF');
					}
			
			/******************************************************************************************************/


		/***************************** Color primera columna ********************************************************/
						$sheet->getStyle("B".$filaInicio.":B".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle("B".$filaInicio.":B".$i)->getFill()->getStartColor()->setRGB('E8EDFF');
			
			/******************************************************************************************************/


		/***************************** Color montos ********************************************************/

						$sheet->getStyle("R".$filaInicio.":R".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle("R".$filaInicio.":R".$i)->getFill()->getStartColor()->setRGB('E8EDFF');

						$sheet->getStyle("S".$filaInicio.":S".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle("S".$filaInicio.":S".$i)->getFill()->getStartColor()->setRGB('E8EDFF');

						$sheet->getStyle("T".$filaInicio.":T".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle("T".$filaInicio.":T".$i)->getFill()->getStartColor()->setRGB('E8EDFF');

	
						$sheet->getStyle("AF".$filaInicio.":AF".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle("AF".$filaInicio.":AF".$i)->getFill()->getStartColor()->setRGB('E8EDFF');	


						$sheet->getStyle("AG".$filaInicio.":AG".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle("AG".$filaInicio.":AG".$i)->getFill()->getStartColor()->setRGB('E8EDFF');	

						$sheet->getStyle("AO".$filaInicio.":AM".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle("AO".$filaInicio.":AM".$i)->getFill()->getStartColor()->setRGB('E8EDFF');									
						$sheet->getStyle("AP".$filaInicio.":AN".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle("AP".$filaInicio.":AN".$i)->getFill()->getStartColor()->setRGB('E8EDFF');	


						$sheet->getStyle("AT".$filaInicio.":AR".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle("AT".$filaInicio.":AR".$i)->getFill()->getStartColor()->setRGB('E8EDFF');											
			/******************************************************************************************************/


			$sheet->setSelectedCells('E1'); //celda seleccionada



	        header("Content-Type: application/vnd.ms-excel");
	        $nombreArchivo = 'libro_remuneraciones';
	        header("Content-Disposition: attachment; filename=\"$nombreArchivo.xlsx\"");
	        header("Cache-Control: max-age=0");
	        // Genera Excel
	        $writer = new Xlsx($spreadsheet); //objeto de PHPExcel, para escribir en el excel
	        //$writer = new PHPExcel_Writer_Excel2007($this->phpexcel); //objeto de PHPExcel, para escribir en el excel
	        // Escribir
	        //$writer->setIncludeCharts(TRUE);			
	        $writer->save('php://output');
	        exit;				
	}			


	function exporta_colaborador($datos_colaborador){

			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();

	  	    //$this->phpexcel->setActiveSheetIndex(0);
	        //$sheet = $this->phpexcel->getActiveSheet();
	        $sheet->setTitle("libro_colaboradores");
			$this->load->model('admin');
			$datos_empresa = $this->admin->datos_empresa($this->session->userdata('empresaid'));

			/********* COMIENZA A CREAR EXCEL *******/
	        // DATOS INICIALES
			$sheet->getColumnDimension('A')->setWidth(5);


	        $sheet->mergeCells('B2:D2');
	        $sheet->setCellValue('B2', 'Libro Colaboradores');
	        $sheet->getColumnDimension('B')->setWidth(20);
	        $sheet->setCellValue('B3', 'Nombre Empresa');
	        $sheet->setCellValue('C3',html_entity_decode($this->session->userdata('empresanombre')));
	        $sheet->mergeCells('C3:D3');
	        $sheet->setCellValue('B4', 'Rut Empresa');
	        $sheet->setCellValue('C4',number_format($datos_empresa->rut,0,".",".") . '-' .$datos_empresa->dv);	        
	        $sheet->mergeCells('C4:D4');
	        $sheet->setCellValue('B5', 'Direccion Empresa');
	        $sheet->setCellValue('C5',$datos_empresa->direccion.", ".$datos_empresa->comuna);	        	        
	        $sheet->mergeCells('C5:D5');
	        $sheet->setCellValue('B6', 'Fecha emision Reporte');
	        $sheet->setCellValue('C6',date('d/m/Y') );
	        $sheet->mergeCells('C6:D6');
	        
 
			$sheet->getStyle("B2:B6")->getFont()->setBold(true);
			$sheet->getStyle("B2:D6")->getFont()->setSize(10);    					        



			/****************** TABLA INICIAL ****************/

			/*************************todos los bordes internos *************************************/
			$sheet->getStyle("B2:D6")->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


			/*************************bordes cuadro principal (externo) *************************************/
			$sheet->getStyle("B2:D2")->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
			$sheet->getStyle("B2:D2")->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
			$sheet->getStyle("B6:D6")->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
			$sheet->getStyle("B2:B6")->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
			$sheet->getStyle("B2:B6")->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
			$sheet->getStyle("D2:D6")->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
		
			/**********************************************************************************************************/			        
				
			/***** COLOR TABLA ****************/
			$sheet->getStyle("B2:D2")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$sheet->getStyle("B2:D2")->getFill()->getStartColor()->setRGB('FA8D72');

			$sheet->getStyle("B2:B6")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$sheet->getStyle("B2:B6")->getFill()->getStartColor()->setRGB('FA8D72');			


			$i = 8;

			$array_columna = array(	'B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI',
				'AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP',
				'BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV');

			
			
			$array_nombre_columna = array('#',
				'Rut',
				'Nombre Completo', 
				'Fecha Nacimiento', 
				'Sexo', 
				'idecivil', 
				'Nacionalidad', 
				'Direccion', 
				'Region', 
				'Comuna', 
				'Telefono', 
				'Email', 
				'Fecha de Ingreso', 
				'Cargo', 
				'Tipo Contrato', 
				'Part Time', 
				'Seguro Cesantia', 
				'Pensionado', 
				'Dias Trabajo', 
				'Horas Diarias', 
				'Horas Semanales', 
				'Sueldo Base', 
				'Tipo Gratificacion', 
				'Gratificacion', 
				'Asignación Familiar', 
				'Cargas Simples', 
				'Cargas Invalidas', 
				'Cargas Maternales', 
				'Cargas Retroactivas', 
				'id Asignación Familiar',
				'Movilización', 
				'Colación', 
				'id AFP', 
				'Adic AFP', 
				'Tipo Ahorro voluntario', 
				'Ahorro Voluntario', 
				'Tipo Cotización APV', 
				'Cotización APV', 
				'id Isapre', 
				'Valor Pactado',
				'id Nacionalidad',
				'Bonos Fijos',
				'Fecha AFC',
				'Meses Vacaciones',
				'Fecha Inicio Vacaciones',
				'Saldo Inicio Vacaciones',
				'Dias Vacaciones Tomados',
				'Dias Progresivos',
				'Dias Progresivos Tomados',
				'Saldo Inicio Vacaciones Programadas',
				'id Centro Costo',
				'Talla Polera',
				'Talla Pantalon',
				'Titulo',
				'id Licencia',
				'id Estudio',
				'inst APV',
				'Numero Contrato APV',
				'Jubilado',
				'Sindicato',
				'Rol Privado',
				'id Lugar Pago',
				'id Categoria',
				'Semana Corrida',
				'Tipo Renta',
				'id Idioma',
				'Numero Ficha',
				'Fecha AFP',
				'id Banco',
				'id Forma Pago',
				'Numero Cuenta Banco',
				'Tipo Documento',
				'C Beneficio',
				'Fecha Retiro',
				'Fecha Finiquito',
				'id Motivo Egreso',
				'id Tipo cc',
				'id Seccion',
				'id Situacion',
				'id Clase',
				'id Ine',
				'id Zona',
				'Fecha Real Contrato',
				'Primer Vencimiento',
				'Fun',
				'Fec Vencimiento Plan',
				'fec apvc',
				'Fecha Termino Subsidio',
				'Rut Pago', 
				'dv Pago', 
				'Nombre Pago',
				'Email Pago',
				'Usuario Windows',
				'id Jefe',
				'id Reemplazo',
				'Forma Pago APV',
				'Regimen APV',
				'Trabajo Pesado',
				'Plazo Contrato');



			//ENCABEZADO REPORTE
			
/*
			$contador = count($array_nombre_columna);
			echo $contador;
			for ($y = 0; $y > $contador; $y++) {
   				//echo $array_nombre_columna[$y];
   				//echo " \n ";
   				//var_dump($array_nombre_columna);
				$sheet->getColumnDimension($array_columna[$y])->setAutoSize(true);
				$sheet->setCellValue($array_nombre_columna[$y] . $i, $array_columna[$y]);
			}*/
             		
			 $sheet->getColumnDimension('B')->setWidth(10);
			 $sheet->setCellValue('B'.$i, '#');
			 $sheet->getColumnDimension('C')->setWidth(15);
			 $sheet->setCellValue('C'.$i, 'Rut');
			 $sheet->getColumnDimension('D')->setWidth(35);
			 $sheet->setCellValue('D'.$i, 'Nombre Completo');
			 $sheet->getColumnDimension('E')->setWidth(15);
			 $sheet->setCellValue('E'.$i, 'Fecha Nacimiento');
			 $sheet->getColumnDimension('F')->setWidth(15);			
			 $sheet->setCellValue('F'.$i, 'Sexo');
			 $sheet->getColumnDimension('G')->setWidth(15);			
			 $sheet->setCellValue('G'.$i, 'idecivil');	
			 $sheet->getColumnDimension('H')->setWidth(15);			
			 $sheet->setCellValue('H'.$i, 'Nacionalidad');	
			 $sheet->getColumnDimension('I')->setWidth(15);			
			 $sheet->setCellValue('I'.$i, 'Dirección');		
			 $sheet->getColumnDimension('J')->setWidth(15);			
			 $sheet->setCellValue('J'.$i, 'Regíon');				 			 			 		 
			 $sheet->getColumnDimension('K')->setWidth(15);			
			 $sheet->setCellValue('K'.$i, 'Comuna');	
			 $sheet->getColumnDimension('L')->setWidth(15);			
			 $sheet->setCellValue('L'.$i, 'Telefono');	
			 $sheet->getColumnDimension('M')->setWidth(15);			
			 $sheet->setCellValue('M'.$i, 'Email');	
			 $sheet->getColumnDimension('N')->setWidth(15);			
			 $sheet->setCellValue('N'.$i, 'Fecha Ingreso');				 
			 $sheet->getColumnDimension('O')->setWidth(15);			
			 $sheet->setCellValue('O'.$i, 'Cargo');	
			 $sheet->getColumnDimension('P')->setWidth(15);			
			 $sheet->setCellValue('P'.$i, 'Tipo Contrato');		
			 $sheet->getColumnDimension('Q')->setWidth(15);			
			 $sheet->setCellValue('Q'.$i, 'Part Time');				 			 
			 $sheet->getColumnDimension('R')->setWidth(15);			
			 $sheet->setCellValue('R'.$i, 'Seguro Cesantia');				 			 
			 $sheet->getColumnDimension('S')->setWidth(15);			
			 $sheet->setCellValue('S'.$i, 'Pensionado');				 			 
			 $sheet->getColumnDimension('T')->setWidth(15);			
			 $sheet->setCellValue('T'.$i, 'Dias Trabajo');				 			 
			 $sheet->getColumnDimension('U')->setWidth(15);			
			 $sheet->setCellValue('U'.$i, 'Horas Diarias');	
			 $sheet->getColumnDimension('V')->setWidth(15);			
			 $sheet->setCellValue('V'.$i, 'Horas Semanales');	
			 $sheet->getColumnDimension('W')->setWidth(15);			
			 $sheet->setCellValue('W'.$i, 'Sueldo Base');	
			 $sheet->getColumnDimension('X')->setWidth(15);			
			 $sheet->setCellValue('X'.$i, 'Tipo Gratificacion');	
			 $sheet->getColumnDimension('Y')->setWidth(15);			
			 $sheet->setCellValue('Y'.$i, 'Gratificacion');	
			 $sheet->getColumnDimension('Z')->setWidth(15);			
			 $sheet->setCellValue('Z'.$i, 'Asignación Familiar');	


			 $sheet->getColumnDimension('AA')->setWidth(15);			
			 $sheet->setCellValue('AA'.$i, 'Cargas Simples');	
			 $sheet->getColumnDimension('AB')->setWidth(15);			
			 $sheet->setCellValue('AB'.$i, 'Cargas Invalidas');	
			 $sheet->getColumnDimension('AC')->setWidth(15);			
			 $sheet->setCellValue('AC'.$i, 'Cargas Maternales');	
			 $sheet->getColumnDimension('AD')->setWidth(15);			
			 $sheet->setCellValue('AD'.$i, 'Cargas Retroactivas');	
			 $sheet->getColumnDimension('AE')->setWidth(15);			
			 $sheet->setCellValue('AE'.$i, 'id Asignación Familiar');	
			 $sheet->getColumnDimension('AF')->setWidth(15);			
			 $sheet->setCellValue('AF'.$i, 'Movilización');	
			 $sheet->getColumnDimension('AG')->setWidth(15);			
			 $sheet->setCellValue('AG'.$i, 'Colación');	
			 $sheet->getColumnDimension('AH')->setWidth(15);			
			 $sheet->setCellValue('AH'.$i, 'id AFP');	
			 $sheet->getColumnDimension('AI')->setWidth(15);			
			 $sheet->setCellValue('AI'.$i, 'Adic AFP');				 			 			 			 		
			 $sheet->getColumnDimension('AJ')->setWidth(15);			
			 $sheet->setCellValue('AJ'.$i, 'Tipo Ahorro voluntario');				 			 			 			 		
			 $sheet->getColumnDimension('AK')->setWidth(15);	
			 $sheet->setCellValue('AK'.$i, 'Ahorro Voluntario');	 
			 $sheet->getColumnDimension('AL')->setWidth(15);			
			 $sheet->setCellValue('AL'.$i, 'Tipo Cotización APV');	 
			 $sheet->getColumnDimension('AM')->setWidth(15);			
			 $sheet->setCellValue('AM'.$i, 'Cotización APV');	 
			 $sheet->getColumnDimension('AN')->setWidth(15);			
			 $sheet->setCellValue('AN'.$i, 'id Isapre');
			 $sheet->getColumnDimension('AO')->setWidth(15);			
			 $sheet->setCellValue('AO'.$i, 'Valor Pactado');
			 $sheet->getColumnDimension('AP')->setWidth(15);			
			 $sheet->setCellValue('AP'.$i, 'id Nacionalidad');
			 $sheet->getColumnDimension('AQ')->setWidth(15);			
			 $sheet->setCellValue('AQ'.$i, 'Bonos Fijos');
			 $sheet->getColumnDimension('AR')->setWidth(15);			
			 $sheet->setCellValue('AR'.$i, 'Fecha AFC');
			 $sheet->getColumnDimension('AS')->setWidth(15);			
			 $sheet->setCellValue('AS'.$i, 'Meses Vacaciones');
			 $sheet->getColumnDimension('AT')->setWidth(15);			
			 $sheet->setCellValue('AT'.$i, 'Fecha Inicio Vacaciones');
			 $sheet->getColumnDimension('AU')->setWidth(15);			
			 $sheet->setCellValue('AU'.$i, 'Saldo Inicio Vacaciones');
			 $sheet->getColumnDimension('AV')->setWidth(15);			
			 $sheet->setCellValue('AV'.$i, 'Dias Vacaciones Tomados');
			 $sheet->getColumnDimension('AW')->setWidth(15);			
			 $sheet->setCellValue('AW'.$i, 'Dias Progresivos');
			 $sheet->getColumnDimension('AX')->setWidth(15);			
			 $sheet->setCellValue('AX'.$i, 'Dias Progresivos Tomados');
			 $sheet->getColumnDimension('AY')->setWidth(15);			
			 $sheet->setCellValue('AY'.$i, 'Saldo Inicio Vacaciones Programadas');
			 $sheet->getColumnDimension('AZ')->setWidth(15);			
			 $sheet->setCellValue('AZ'.$i, 'id Centro Costo');		 

			 $sheet->getColumnDimension('BA')->setWidth(15);			
			 $sheet->setCellValue('BA'.$i, 'Talla Polera');	
			 $sheet->getColumnDimension('BB')->setWidth(15);			
			 $sheet->setCellValue('BB'.$i, 'Talla Pantalon');	
			 $sheet->getColumnDimension('BC')->setWidth(15);			
			 $sheet->setCellValue('BC'.$i, 'Titulo');	
			 $sheet->getColumnDimension('BD')->setWidth(15);			
			 $sheet->setCellValue('BD'.$i, 'id Licencia');	
			 $sheet->getColumnDimension('BE')->setWidth(15);			
			 $sheet->setCellValue('BE'.$i, 'id Estudio');	
			 $sheet->getColumnDimension('BF')->setWidth(15);			
			 $sheet->setCellValue('BF'.$i, 'inst APV');	
			 $sheet->getColumnDimension('BG')->setWidth(15);			
			 $sheet->setCellValue('BG'.$i, 'Numero Contrato APV');	
			 $sheet->getColumnDimension('BH')->setWidth(15);			
			 $sheet->setCellValue('BH'.$i, 'Jubilado');	
			 $sheet->getColumnDimension('BI')->setWidth(15);			
			 $sheet->setCellValue('BI'.$i, 'Sindicato');				 			 			 			 		
			 $sheet->getColumnDimension('BJ')->setWidth(15);			
			 $sheet->setCellValue('BJ'.$i, 'Rol Privado');				 			 			 			 		
			 $sheet->getColumnDimension('BK')->setWidth(15);	
			 $sheet->setCellValue('BK'.$i, 'id Lugar Pago');	 
			 $sheet->getColumnDimension('BL')->setWidth(15);			
			 $sheet->setCellValue('BL'.$i, 'id Categoria');	 
			 $sheet->getColumnDimension('BM')->setWidth(15);			
			 $sheet->setCellValue('BM'.$i, 'Semana Corrida');	 
			 $sheet->getColumnDimension('BN')->setWidth(15);			
			 $sheet->setCellValue('BN'.$i, 'Tipo Renta');
			 $sheet->getColumnDimension('BO')->setWidth(15);			
			 $sheet->setCellValue('BO'.$i, 'id Idioma');
			 $sheet->getColumnDimension('BP')->setWidth(15);			
			 $sheet->setCellValue('BP'.$i, 'Numero Ficha');
			 $sheet->getColumnDimension('BQ')->setWidth(15);			
			 $sheet->setCellValue('BQ'.$i, 'Fecha AFP');
			 $sheet->getColumnDimension('BR')->setWidth(15);			
			 $sheet->setCellValue('BR'.$i, 'id Banco');
			 $sheet->getColumnDimension('BS')->setWidth(15);			
			 $sheet->setCellValue('BS'.$i, 'id Forma Pago');
			 $sheet->getColumnDimension('BT')->setWidth(15);			
			 $sheet->setCellValue('BT'.$i, 'Numero Cuenta Banco');
			 $sheet->getColumnDimension('BU')->setWidth(15);			
			 $sheet->setCellValue('BU'.$i, 'Tipo Documento');
			 $sheet->getColumnDimension('BV')->setWidth(15);			
			 $sheet->setCellValue('BV'.$i, 'C Beneficio');
			 $sheet->getColumnDimension('BW')->setWidth(15);			
			 $sheet->setCellValue('BW'.$i, 'Fecha Retiro');
			 $sheet->getColumnDimension('BX')->setWidth(15);			
			 $sheet->setCellValue('BX'.$i, 'Fecha Finiquito');
			 $sheet->getColumnDimension('BY')->setWidth(15);			
			 $sheet->setCellValue('BY'.$i, 'id Motivo Egreso');
			 $sheet->getColumnDimension('BZ')->setWidth(15);			
			 $sheet->setCellValue('BZ'.$i, 'id Tipo cc');
			 $sheet->getColumnDimension('CA')->setWidth(15);			
			 $sheet->setCellValue('CA'.$i, 'id Seccion');	
			 $sheet->getColumnDimension('CB')->setWidth(15);			
			 $sheet->setCellValue('CB'.$i, 'id Situacion');	
			 $sheet->getColumnDimension('CC')->setWidth(15);			
			 $sheet->setCellValue('CC'.$i, 'id Clase');	
			 $sheet->getColumnDimension('CD')->setWidth(15);			
			 $sheet->setCellValue('CD'.$i, 'id Ine');	
			 $sheet->getColumnDimension('CE')->setWidth(15);			
			 $sheet->setCellValue('CE'.$i, 'id Zona');	
			 $sheet->getColumnDimension('CF')->setWidth(15);			
			 $sheet->setCellValue('CF'.$i, 'Fecha Real Contrato');	
			 $sheet->getColumnDimension('CG')->setWidth(15);			
			 $sheet->setCellValue('CG'.$i, 'Primer Vencimiento');	
			 $sheet->getColumnDimension('CH')->setWidth(15);			
			 $sheet->setCellValue('CH'.$i, 'Fun');	
			 $sheet->getColumnDimension('CI')->setWidth(15);			
			 $sheet->setCellValue('CI'.$i, 'Fec Vencimiento Plan'); 			 		
			 $sheet->getColumnDimension('CJ')->setWidth(15);			
			 $sheet->setCellValue('CJ'.$i, 'fec apvc'); 			 			 		
			 $sheet->getColumnDimension('CK')->setWidth(15);	
			 $sheet->setCellValue('CK'.$i, 'Fecha Termino Subsidio');	 
			 $sheet->getColumnDimension('CL')->setWidth(15);			
			 $sheet->setCellValue('CL'.$i, 'Rut Pago');	 
			 $sheet->getColumnDimension('CM')->setWidth(15);			
			 $sheet->setCellValue('CM'.$i, 'dv Pago');	 
			 $sheet->getColumnDimension('CN')->setWidth(15);			
			 $sheet->setCellValue('CN'.$i, 'Nombre Pago');
			 $sheet->getColumnDimension('CO')->setWidth(15);			
			 $sheet->setCellValue('CO'.$i, 'Email Pago');
			 $sheet->getColumnDimension('CP')->setWidth(15);			
			 $sheet->setCellValue('CP'.$i, 'Usuario Windows');
			 $sheet->getColumnDimension('CQ')->setWidth(15);			
			 $sheet->setCellValue('CQ'.$i, 'id Jefe');
			 $sheet->getColumnDimension('CR')->setWidth(15);			
			 $sheet->setCellValue('CR'.$i, 'id Reemplazo');
			 $sheet->getColumnDimension('CS')->setWidth(15);			
			 $sheet->setCellValue('CS'.$i, 'Forma Pago APV');
			 $sheet->getColumnDimension('CT')->setWidth(15);			
			 $sheet->setCellValue('CT'.$i, 'Regimen APV');
			 $sheet->getColumnDimension('CU')->setWidth(15);			
			 $sheet->setCellValue('CU'.$i, 'Trabajo Pesado');
			 $sheet->getColumnDimension('CV')->setWidth(15);			
			 $sheet->setCellValue('CV'.$i, 'Plazo Contrato');
			



			 $columnaFinal = 98;
			 $mergeTotal = 99;
			 $columnaTotales = 98;
			 $sheet->getStyle("B".$i.":".ordenLetrasExcel($columnaFinal).$i)->getFont()->setBold(true);
			 $i++;
			 
			$filaInicio = $i-1; 
			
			//$sheet->getStyle("B7:I7")->getFont()->setSize(11);  
			$linea = 1;


            foreach ($datos_colaborador as $colaborador) {

	            //	$sheet->setCellValue("B".$i,$linea);
				$sheet->setCellValue("B".$i,$linea);
            	$sheet->setCellValue("C".$i,$colaborador->rut."-".$colaborador->dv);
            	$sheet->setCellValue("D".$i,$colaborador->nombre." ".$colaborador->apaterno." ".$colaborador->amaterno);
            	$sheet->setCellValue("E".$i,$colaborador->fecnacimiento);
            	$sheet->setCellValue("F".$i,$colaborador->sexo);
            	$sheet->getStyle('F'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("G".$i,$colaborador->idecivil);
            	$sheet->getStyle('G'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("H".$i,$colaborador->nacionalidad);
            	$sheet->getStyle('H'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("I".$i,$colaborador->direccion);
            	$sheet->getStyle('I'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("J".$i,$colaborador->idregion);
            	$sheet->getStyle('J'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("K".$i,$colaborador->idcomuna);
            	$sheet->setCellValue("L".$i,$colaborador->fono);
            	$sheet->setCellValue("M".$i,$colaborador->email);
            	$sheet->setCellValue("N".$i,$colaborador->fecingreso);
            	$sheet->setCellValue("O".$i,$colaborador->idcargo);
            	$sheet->getStyle('O'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("P".$i,$colaborador->tipocontrato);
            	$sheet->setCellValue("Q".$i,$colaborador->parttime);
            	$sheet->getStyle('Q'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("R".$i,$colaborador->segcesantia);
            	$sheet->getStyle('R'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("S".$i,$colaborador->pensionado);
            	$sheet->getStyle('S'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("T".$i,$colaborador->diastrabajo);
            	$sheet->getStyle('T'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("U".$i,$colaborador->horasdiarias);
            	$sheet->getStyle('U'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("V".$i,$colaborador->horassemanales);
            	$sheet->getStyle('V'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("W".$i,$colaborador->sueldobase);
            	$sheet->getStyle('W'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("X".$i,$colaborador->tipogratificacion);
            	$sheet->getStyle('X'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("Y".$i,$colaborador->gratificacion);
            	$sheet->getStyle('Y'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("Z".$i,$colaborador->asigfamiliar);
            	$sheet->getStyle('Z'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	
            	$sheet->setCellValue("AA".$i,$colaborador->cargassimples);
            	$sheet->getStyle('AA'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AB".$i,$colaborador->cargasinvalidas);
            	$sheet->getStyle('AB'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AC".$i,$colaborador->cargasmaternales);
            	$sheet->getStyle('AC'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AD".$i,$colaborador->cargasretroactivas);
            	$sheet->getStyle('AD'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AE".$i,$colaborador->idasigfamiliar);
            	$sheet->getStyle('AE'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AF".$i,$colaborador->movilizacion);
            	$sheet->getStyle('AF'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("AG".$i,$colaborador->colacion);
            	$sheet->getStyle('AG'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AH".$i,$colaborador->idafp);
            	$sheet->getStyle('AH'.$i)->getNumberFormat()->setFormatCode('#,##0');  
            	$sheet->setCellValue("AI".$i,$colaborador->adicafp);
            	$sheet->getStyle('AI'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AJ".$i,$colaborador->tipoahorrovol);
            	$sheet->getStyle('AJ'.$i)->getNumberFormat()->setFormatCode('#,##0');  
            	$sheet->setCellValue("AK".$i,$colaborador->ahorrovol);
            	$sheet->getStyle('AK'.$i)->getNumberFormat()->setFormatCode('#,##0');    
            	$sheet->setCellValue("AL".$i,$colaborador->tipocotapv);
            	$sheet->getStyle('AL'.$i)->getNumberFormat()->setFormatCode('#,##0');  
            	$sheet->setCellValue("AM".$i,$colaborador->cotapv);
            	$sheet->getStyle('AM'.$i)->getNumberFormat()->setFormatCode('#,##0');  
            	$sheet->setCellValue("AN".$i,$colaborador->idisapre);
            	$sheet->getStyle('AN'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("AO".$i,$colaborador->valorpactado);
            	$sheet->getStyle('AO'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AP".$i,$colaborador->idnacionalidad);
            	$sheet->setCellValue("AQ".$i,$colaborador->bonos_fijos);
            	$sheet->getStyle('AQ'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("AR".$i,$colaborador->fecafc);
            	$sheet->getStyle('AR'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AS".$i,$colaborador->meses_vac);
            	$sheet->getStyle('AS'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AT".$i,$colaborador->fecinicvacaciones);
            	$sheet->getStyle('AT'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AU".$i,$colaborador->saldoinicvacaciones);
            	$sheet->getStyle('AU'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AV".$i,$colaborador->diasvactomados);
            	$sheet->getStyle('AV'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AW".$i,$colaborador->diasprogresivos);
            	$sheet->getStyle('AW'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AX".$i,$colaborador->diasvactomados);
            	$sheet->getStyle('AX'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("AY".$i,$colaborador->saldoinicvacprog);
            	$sheet->getStyle('AY'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AZ".$i,$colaborador->idcentrocosto);
            	$sheet->getStyle('AZ'.$i)->getNumberFormat()->setFormatCode('#,##0'); 




            	$sheet->setCellValue("BA".$i,$colaborador->tallapolera);
            	$sheet->getStyle('BA'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("BB".$i,$colaborador->tallapantalon);
            	$sheet->getStyle('BB'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("BC".$i,$colaborador->titulo);
            	$sheet->getStyle('BC'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("BD".$i,$colaborador->idlicencia);
            	$sheet->getStyle('BD'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("BE".$i,$colaborador->idestudio);
            	$sheet->getStyle('BE'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("BF".$i,$colaborador->instapv);
            	$sheet->getStyle('BF'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BG".$i,$colaborador->nrocontratoapv);
            	$sheet->getStyle('BG'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BH".$i,$colaborador->jubilado);
            	$sheet->getStyle('BH'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BI".$i,$colaborador->sindicato);
            	$sheet->getStyle('BI'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BJ".$i,$colaborador->rol_privado);
            	$sheet->getStyle('BJ'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BK".$i,$colaborador->id_lugar_pago);
            	$sheet->getStyle('BK'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BL".$i,$colaborador->id_categoria);
            	$sheet->getStyle('BL'.$i)->getNumberFormat()->setFormatCode('#,##0');        
            	$sheet->setCellValue("BM".$i,$colaborador->semana_corrida);
            	$sheet->getStyle('BM'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BN".$i,$colaborador->tiporenta);
            	$sheet->getStyle('BN'.$i)->getNumberFormat()->setFormatCode('#,##0');  
            	$sheet->setCellValue("BO".$i,$colaborador->ididioma);
            	$sheet->getStyle('BO'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BP".$i,$colaborador->numficha);
            	$sheet->getStyle('BP'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BQ".$i,$colaborador->fecafp);
            	$sheet->getStyle('BQ'.$i)->getNumberFormat()->setFormatCode('#,##0');

            	$sheet->setCellValue("BR".$i,$colaborador->idbanco);
            	$sheet->getStyle('BR'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("BS".$i,$colaborador->id_forma_pago);
            	$sheet->getStyle('BS'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("BT".$i,$colaborador->nrocuentabanco);
            	$sheet->getStyle('BT'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("BU".$i,$colaborador->tipodocumento);
            	$sheet->getStyle('BU'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BV".$i,$colaborador->cbeneficio);
            	$sheet->getStyle('BV'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BW".$i,$colaborador->fecha_retiro);
            	$sheet->getStyle('BW'.$i)->getNumberFormat()->setFormatCode('#,##0');  

            	$sheet->setCellValue("BX".$i,$colaborador->fecha_finiquito);
            	$sheet->getStyle('BX'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("BY".$i,$colaborador->id_motivo_egreso);
            	$sheet->getStyle('BY'.$i)->getNumberFormat()->setFormatCode('#,##0');

            	$sheet->setCellValue("BZ".$i,$colaborador->id_tipocc);
            	$sheet->getStyle('BZ'.$i)->getNumberFormat()->setFormatCode('#,##0');

            	$sheet->setCellValue("CA".$i,$colaborador->id_seccion);
            	$sheet->getStyle('CA'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CB".$i,$colaborador->id_situacion);
            	$sheet->getStyle('CB'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("CC".$i,$colaborador->id_clase);
            	$sheet->getStyle('CC'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("CD".$i,$colaborador->id_ine);
            	$sheet->getStyle('CD'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CE".$i,$colaborador->id_zona);
            	$sheet->getStyle('CE'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CF".$i,$colaborador->fecrealcontrato);
            	$sheet->getStyle('CF'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CG".$i,$colaborador->primervenc);
            	$sheet->getStyle('CG'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CH".$i,$colaborador->fun);
            	$sheet->getStyle('CH'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CI".$i,$colaborador->fecvencplan);
            	$sheet->getStyle('CI'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CJ".$i,$colaborador->fecapvc);
            	$sheet->getStyle('CJ'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CK".$i,$colaborador->fectermsubsidio);
            	$sheet->getStyle('CK'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CL".$i,$colaborador->rut_pago);
            	$sheet->getStyle('CL'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CM".$i,$colaborador->dv_pago);
            	$sheet->getStyle('CM'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CN".$i,$colaborador->nombre_pago);
            	$sheet->getStyle('CN'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CO".$i,$colaborador->email_pago);
            	$sheet->getStyle('CO'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CP".$i,$colaborador->usuario_windows);
            	$sheet->getStyle('CP'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CQ".$i,$colaborador->idjefe);
            	$sheet->getStyle('CQ'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CR".$i,$colaborador->idreemplazo);
            	$sheet->getStyle('CR'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("CS".$i,$colaborador->formapagoapv);
            	$sheet->getStyle('CS'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CT".$i,$colaborador->regimenapv);
            	$sheet->getStyle('CT'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CU".$i,$colaborador->trabajo_pesado);
            	$sheet->getStyle('CU'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("CV".$i,$colaborador->plazo_contrato);
            	$sheet->getStyle('CV'.$i)->getNumberFormat()->setFormatCode('#,##0');       

 	            	            	

	 			if($i % 2 != 0){
	 				//echo "consulta 4: -- i : ".$i. "  -- mod : ". ($i % 2)."<br>";
					$sheet->getStyle("B".$i.":".ordenLetrasExcel($columnaFinal).$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
					$sheet->getStyle("B".$i.":".ordenLetrasExcel($columnaFinal).$i)->getFill()->getStartColor()->setRGB('F7F9FD');	  				
	 			}	            	
            	$i++;
            	$linea++;
              }
             $i--;



			         	
			$sheet->getStyle("B" . $filaInicio . ":".ordenLetrasExcel($columnaFinal).$i)->getFont()->setSize(10);

			/*************************todos los bordes internos *************************************/
			$sheet->getStyle("B".$filaInicio.":".ordenLetrasExcel($columnaFinal).$i)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


			/*************************bordes cuadro principal (externo) *************************************/
					for($j=1;$j<=$columnaFinal;$j++){ //borde superior
						$sheet->getStyle(ordenLetrasExcel($j).$filaInicio)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
					}
			
					for($j=1;$j<=$columnaFinal;$j++){ //borde inferior
						$sheet->getStyle(ordenLetrasExcel($j).$i)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
					}
			
					for($n=$filaInicio;$n<=$i;$n++){ //borde izquierdo
						$sheet->getStyle("B".$n)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
					}
			
					for($n=$filaInicio;$n<=$i;$n++){ //borde derecho
						$sheet->getStyle(ordenLetrasExcel($columnaFinal).$n)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
					}
			
			/**********************************************************************************************************/			        
				

			/***************************** Segundo borde superior********************************************************/
			
					for($j=1;$j<=$columnaFinal;$j++){ //borde inferior
						$sheet->getStyle(ordenLetrasExcel($j).$filaInicio)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
					}
			
			/******************************************************************************************************/
			

		/***************************** Penultimo borde izquierdo ********************************************************/
			
					for($n=$filaInicio;$n<=$i;$n++){ //borde derecho
						$sheet->getStyle("B".$n)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
					}
			
		/******************************************************************************************************/			



		/***************************** Penultimo borde derecho ********************************************************/
			
					for($n=$filaInicio;$n<=$i;$n++){ //borde derecho
						$sheet->getStyle(ordenLetrasExcel($columnaFinal).$n)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
					}
			
		/******************************************************************************************************/			

			/***************************** Color fila superior********************************************************/
			
					for($j=1;$j<=$columnaFinal;$j++){ //color fondo inferior
						$sheet->getStyle(ordenLetrasExcel($j).$filaInicio)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle(ordenLetrasExcel($j).$filaInicio)->getFill()->getStartColor()->setRGB('E8EDFF');
					}
			
			/******************************************************************************************************/


		/***************************** Color primera columna ********************************************************/
						$sheet->getStyle("B".$filaInicio.":B".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle("B".$filaInicio.":B".$i)->getFill()->getStartColor()->setRGB('E8EDFF');
			
			/******************************************************************************************************/


		/***************************** Color montos ********************************************************/

					/*	$sheet->getStyle("Q".$filaInicio.":Q".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle("Q".$filaInicio.":Q".$i)->getFill()->getStartColor()->setRGB('E8EDFF');
	
						$sheet->getStyle("AC".$filaInicio.":AC".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle("AC".$filaInicio.":AC".$i)->getFill()->getStartColor()->setRGB('E8EDFF');	

						$sheet->getStyle("AI".$filaInicio.":AI".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle("AI".$filaInicio.":AI".$i)->getFill()->getStartColor()->setRGB('E8EDFF');									
						$sheet->getStyle("AJ".$filaInicio.":AJ".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle("AJ".$filaInicio.":AJ".$i)->getFill()->getStartColor()->setRGB('E8EDFF');	


						$sheet->getStyle("CU".$filaInicio.":CU".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle("CU".$filaInicio.":CU".$i)->getFill()->getStartColor()->setRGB('E8EDFF');	*/										
			/******************************************************************************************************/


			$sheet->setSelectedCells('E1'); //celda seleccionada


	        header("Content-Type: application/vnd.ms-excel");
	        $nombreArchivo = 'libro_colaboradores';
	        header("Content-Disposition: attachment; filename=\"$nombreArchivo.xlsx\"");
	        header("Cache-Control: max-age=0");
	        // Genera Excel
	        $writer = new Xlsx($spreadsheet); //objeto de PHPExcel, para escribir en el excel
	        //$writer = new PHPExcel_Writer_Excel2007($this->phpexcel); //objeto de PHPExcel, para escribir en el excel
	        // Escribir
	        //$writer->setIncludeCharts(TRUE);			
	        $writer->save('php://output');
	        exit;		
	}


}