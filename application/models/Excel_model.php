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
			 $sheet->setCellValue('G'.$i, 'Gratificación');	
			 $sheet->getColumnDimension('H')->setWidth(15);			
			 $sheet->setCellValue('H'.$i, 'Movilización');	
			 $sheet->getColumnDimension('I')->setWidth(15);			
			 $sheet->setCellValue('I'.$i, 'Colación');		
			 $sheet->getColumnDimension('J')->setWidth(15);			
			 $sheet->setCellValue('J'.$i, 'Bonos Imponibles');				 			 			 		 
			 $sheet->getColumnDimension('K')->setWidth(15);			
			 $sheet->setCellValue('K'.$i, 'Bonos No Imponibles');	
			 $sheet->getColumnDimension('L')->setWidth(15);			
			 $sheet->setCellValue('L'.$i, 'Horas Extras 50%');	
			 $sheet->getColumnDimension('M')->setWidth(15);			
			 $sheet->setCellValue('M'.$i, 'Horas Extras 100%');	
			 $sheet->getColumnDimension('N')->setWidth(15);			
			 $sheet->setCellValue('N'.$i, 'Semana Corrida');				 
			 $sheet->getColumnDimension('O')->setWidth(15);			
			 $sheet->setCellValue('O'.$i, 'Aguinaldo');	
			 $sheet->getColumnDimension('P')->setWidth(15);			
			 $sheet->setCellValue('P'.$i, 'Asignación Familiar');		
			 $sheet->getColumnDimension('Q')->setWidth(15);			
			 $sheet->setCellValue('Q'.$i, 'Total Haberes');				 			 
			 $sheet->getColumnDimension('R')->setWidth(15);			
			 $sheet->setCellValue('R'.$i, 'Cotización Obligatoria');				 			 
			 $sheet->getColumnDimension('S')->setWidth(15);			
			 $sheet->setCellValue('S'.$i, 'Comisión AFP');				 			 
			 $sheet->getColumnDimension('T')->setWidth(15);			
			 $sheet->setCellValue('T'.$i, 'Adicional AFP');				 			 
			 $sheet->getColumnDimension('U')->setWidth(15);			
			 $sheet->setCellValue('U'.$i, 'Ahorro Voluntario');	
			 $sheet->getColumnDimension('V')->setWidth(15);			
			 $sheet->setCellValue('V'.$i, 'APV');	
			 $sheet->getColumnDimension('W')->setWidth(15);			
			 $sheet->setCellValue('W'.$i, 'Cotización Salud Obligatoria');	
			 $sheet->getColumnDimension('X')->setWidth(15);			
			 $sheet->setCellValue('X'.$i, 'Cotización Adicional Isapre');	
			 $sheet->getColumnDimension('Y')->setWidth(15);			
			 $sheet->setCellValue('Y'.$i, 'Adicional Salud');	
			 $sheet->getColumnDimension('Z')->setWidth(15);			
			 $sheet->setCellValue('Z'.$i, 'Fonasa');	
			 $sheet->getColumnDimension('AA')->setWidth(15);			
			 $sheet->setCellValue('AA'.$i, 'Seguro Cesantía');	
			 $sheet->getColumnDimension('AB')->setWidth(15);			
			 $sheet->setCellValue('AB'.$i, 'Impuesto');	
			 $sheet->getColumnDimension('AC')->setWidth(15);			
			 $sheet->setCellValue('AC'.$i, 'Total Leyes Sociales');	
			 $sheet->getColumnDimension('AD')->setWidth(15);			
			 $sheet->setCellValue('AD'.$i, 'Anticipo');	
			 $sheet->getColumnDimension('AE')->setWidth(15);			
			 $sheet->setCellValue('AE'.$i, 'Descuento por Aguinaldo');	
			 $sheet->getColumnDimension('AF')->setWidth(15);			
			 $sheet->setCellValue('AF'.$i, 'Horas Descuento');	
			 $sheet->getColumnDimension('AG')->setWidth(15);			
			 $sheet->setCellValue('AG'.$i, 'Otros Descuentos');	
			 $sheet->getColumnDimension('AH')->setWidth(15);			
			 $sheet->setCellValue('AH'.$i, 'Préstamos');	
			 $sheet->getColumnDimension('AI')->setWidth(15);			
			 $sheet->setCellValue('AI'.$i, 'Total Otros Descuentos');				 			 			 			 		
			 $sheet->getColumnDimension('AJ')->setWidth(15);			
			 $sheet->setCellValue('AJ'.$i, 'Líquido a Pagar');				 			 			 			 		
			 $sheet->getColumnDimension('AK')->setWidth(15);	
			 $sheet->setCellValue('AK'.$i, 'Aporte Seguro Cesantía');	 
			 $sheet->getColumnDimension('AL')->setWidth(15);			
			 $sheet->setCellValue('AL'.$i, 'Aporte SIS');	 
			 $sheet->getColumnDimension('AM')->setWidth(15);			
			 $sheet->setCellValue('AM'.$i, 'Mutual de Seguridad');	 
			 $sheet->getColumnDimension('AN')->setWidth(15);			
			 $sheet->setCellValue('AN'.$i, 'Total Aportes Empresa');	 




			 $columnaFinal = 39;
			 $mergeTotal = 40;
			 $columnaTotales = 39;
			 $sheet->getStyle("B".$i.":".ordenLetrasExcel($columnaFinal).$i)->getFont()->setBold(true);
			 $i++;
			$filaInicio = $i-1; 
			
			//$sheet->getStyle("B7:I7")->getFont()->setSize(11);  
			$linea = 1;
            foreach ($datos_remuneracion as $remuneracion) {

            	$datos_bonos_imponibles = $this->rrhh_model->get_bonos_by_remuneracion($remuneracion->id_remuneracion,true);
            	//$datos_bonos_imponibles = array();
            	$bonos_imponibles = 0;
            	foreach ($datos_bonos_imponibles as $bono_imponible) {
            		$bonos_imponibles += $bono_imponible->monto;
            	}


            	$datos_bonos_no_imponibles = $this->rrhh_model->get_bonos_by_remuneracion($remuneracion->id_remuneracion,false);
            	$datos_bonos_no_imponibles = array();
            	$bonos_no_imponibles = 0;
            	foreach ($datos_bonos_no_imponibles as $bono_no_imponible) {
            		$bonos_no_imponibles += $bono_no_imponible->monto;
            	}

				//$datos_descuentos = $this->get_descuento($remuneracion->idperiodo,'D',$remuneracion->idtrabajador);
				$datos_descuentos = $this->rrhh_model->get_haberes_descuentos($remuneracion->idtrabajador,null,'DESCUENTO');	
				//$datos_descuentos = array();
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
            	$sheet->setCellValue("G".$i,$remuneracion->gratificacion);
            	$sheet->getStyle('G'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("H".$i,$remuneracion->movilizacion);
            	$sheet->getStyle('H'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("I".$i,$remuneracion->colacion);
            	$sheet->getStyle('I'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("J".$i,$bonos_imponibles);
            	$sheet->getStyle('J'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("K".$i,$bonos_no_imponibles);
            	$sheet->getStyle('K'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("L".$i,$remuneracion->montohorasextras50);
            	$sheet->getStyle('L'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("M".$i,$remuneracion->montohorasextras100);
            	$sheet->getStyle('M'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("N".$i,$remuneracion->semana_corrida);
            	$sheet->getStyle('N'.$i)->getNumberFormat()->setFormatCode('#,##0');            	
            	$sheet->setCellValue("O".$i,$remuneracion->aguinaldobruto);
            	$sheet->getStyle('O'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("P".$i,$remuneracion->asigfamiliar);
            	$sheet->getStyle('P'.$i)->getNumberFormat()->setFormatCode('#,##0');      
            	$sheet->setCellValue("Q".$i,$remuneracion->totalhaberes);
            	$sheet->getStyle('Q'.$i)->getNumberFormat()->setFormatCode('#,##0');
            	$sheet->setCellValue("R".$i,$remuneracion->cotizacionobligatoria);
            	$sheet->getStyle('R'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("S".$i,$remuneracion->comisionafp);
            	$sheet->getStyle('S'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("T".$i,$remuneracion->adicafp);
            	$sheet->getStyle('T'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("U".$i,$remuneracion->montoahorrovol);
            	$sheet->getStyle('U'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("V".$i,$remuneracion->montocotapv);
            	$sheet->getStyle('V'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("W".$i,$remuneracion->cotizacionsalud);
            	$sheet->getStyle('W'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("X".$i,$remuneracion->cotadicisapre);
            	$sheet->getStyle('X'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("Y".$i,$remuneracion->adicsalud);
            	$sheet->getStyle('Y'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("Z".$i,$remuneracion->fonasa + $remuneracion->inp);
            	$sheet->getStyle('Z'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AA".$i,$remuneracion->segcesantia);
            	$sheet->getStyle('AA'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AB".$i,$remuneracion->impuesto);
            	$sheet->getStyle('AB'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AC".$i,$remuneracion->totalleyessociales);
            	$sheet->getStyle('AC'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AD".$i,$remuneracion->anticipo);
            	$sheet->getStyle('AD'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AE".$i,$remuneracion->aguinaldo);
            	$sheet->getStyle('AE'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AF".$i,$remuneracion->montodescuento);
            	$sheet->getStyle('AF'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AG".$i,$monto_descuento);
            	$sheet->getStyle('AG'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AH".$i,$monto_prestamo);
            	$sheet->getStyle('AH'.$i)->getNumberFormat()->setFormatCode('#,##0'); 
            	$sheet->setCellValue("AI".$i,$remuneracion->otrosdescuentos);
            	$sheet->getStyle('AI'.$i)->getNumberFormat()->setFormatCode('#,##0');             	            	            	
            	$sheet->setCellValue("AJ".$i,$remuneracion->sueldoliquido);
            	$sheet->getStyle('AJ'.$i)->getNumberFormat()->setFormatCode('#,##0');              	
            	$sheet->setCellValue("AK".$i,$remuneracion->aportesegcesantia);
            	$sheet->getStyle('AK'.$i)->getNumberFormat()->setFormatCode('#,##0');  
            	$sheet->setCellValue("AL".$i,$remuneracion->seginvalidez);
            	$sheet->getStyle('AL'.$i)->getNumberFormat()->setFormatCode('#,##0');  
            	$sheet->setCellValue("AM".$i,$remuneracion->aportepatronal);
            	$sheet->getStyle('AM'.$i)->getNumberFormat()->setFormatCode('#,##0');  
            	$sheet->setCellValue("AN".$i,$remuneracion->aportesegcesantia + $remuneracion->seginvalidez + $remuneracion->aportepatronal);
            	$sheet->getStyle('AN'.$i)->getNumberFormat()->setFormatCode('#,##0');              	            	            	

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

						$sheet->getStyle("Q".$filaInicio.":Q".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle("Q".$filaInicio.":Q".$i)->getFill()->getStartColor()->setRGB('E8EDFF');
	
						$sheet->getStyle("AC".$filaInicio.":AC".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle("AC".$filaInicio.":AC".$i)->getFill()->getStartColor()->setRGB('E8EDFF');	

						$sheet->getStyle("AI".$filaInicio.":AI".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle("AI".$filaInicio.":AI".$i)->getFill()->getStartColor()->setRGB('E8EDFF');									
						$sheet->getStyle("AJ".$filaInicio.":AJ".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle("AJ".$filaInicio.":AJ".$i)->getFill()->getStartColor()->setRGB('E8EDFF');	


						$sheet->getStyle("AN".$filaInicio.":AN".$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
						$sheet->getStyle("AN".$filaInicio.":AN".$i)->getFill()->getStartColor()->setRGB('E8EDFF');											
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