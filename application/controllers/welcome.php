<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
/*	public function index()
	{
		$this->load->view('welcome_message');
	}
*/


public function index()
 {
		 $spreadsheet = new Spreadsheet();
		 $sheet = $spreadsheet->getActiveSheet();
		 $sheet->setCellValue('A1', 'Hello World !');
		 
		 $writer = new Xlsx($spreadsheet);
		 
		 $filename = 'name-of-the-generated-file.xlsx';
		 
		 $writer->save($filename); // will create and save the file in the root of the project
 }


public function download()
 {
 $spreadsheet = new Spreadsheet();
 $sheet = $spreadsheet->getActiveSheet();
 $sheet->setCellValue('A1', 'Hello World !');
 
 $writer = new Xlsx($spreadsheet);
 
 $filename = 'name-of-the-generated-file';
 
 header('Content-Type: application/vnd.ms-excel');
 header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
 header('Cache-Control: max-age=0');
 
 $writer->save('php://output'); // download file 
 
 } 


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */