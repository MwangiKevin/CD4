<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class worksheets extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('PHPExcel');
	}

	/**************************************** creating excel sheet for the system *************************/
	public function create_worksheet($excel_data=NUll) {
		
 	//check if the excel data has been set if not exit the excel generation    

		if(count($excel_data)>0){

			$objPHPExcel = new PHPExcel();
			$objPHPExcel -> getProperties() -> setCreator("CD4");
			$objPHPExcel -> getProperties() -> setLastModifiedBy($excel_data['doc_creator']);
			$objPHPExcel -> getProperties() -> setTitle($excel_data['doc_title']);
			$objPHPExcel -> getProperties() -> setSubject($excel_data['doc_title']);
			$objPHPExcel -> getProperties() -> setDescription("");

			// Add some data
			//	echo date('H:i:s') . " Add some data\n";
			$objPHPExcel -> setActiveSheetIndex(0);

			$rowExec = 1;

			//Looping through the cells
			$column = 0;
			
			
			// foreach ($excel_data['column_data'] as $cell) {
			// 	$objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow($column, $rowExec, $cell);
			// 	$objPHPExcel -> getActiveSheet() -> getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($column)) -> setAutoSize(true);

			// 	$column++;
			// }
			
			// $rowExec = 2;
			// $column = 0;
			
			// foreach ($excel_data['row_data'] as $cell) {

			// //Looping through the cells per facility
			// 	$objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow($column, $rowExec, $cell);
			// 	$rowExec++;
			// 	$column++;
				
			// }

			$objPHPExcel->getActiveSheet()->fromArray($excel_data['row_data'], NULL, 'A1');

			// Rename sheet
			//	echo date('H:i:s') . " Rename sheet\n";
			$objPHPExcel -> getActiveSheet() -> setTitle('Simple');

			// Save Excel 2007 file
			//echo date('H:i:s') . " Write to Excel2007 format\n";
			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');

			// It will be called file.xls
			header("Content-Disposition: attachment; filename=".$excel_data['file_name']);

			// Write file to the browser
			$objWriter -> save('php://output');
			// Echo done
		}
	}
	
}