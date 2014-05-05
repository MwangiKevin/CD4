<?php
/**
 * @author Maestro
 */
class Upload extends MY_Controller {

	function __construct() {
		parent::__construct();
		//$this -> load -> model('models_sugar/M_Sugar_ExternalFort_B3');
		$this -> load -> library('PHPexcel');
		ini_set('memory_size', '2048M');
	}

	function index() {
		$dataArr['contentView'] = 'upload/upload_v';
		$dataArr['uploaded']='';
		$dataArr['posted']=0;
		$this -> load -> view('template_v', $dataArr);
	}

	public function data_upload() {//convert .slk file to xlsx for upload
		$type = "slk";
		$start = 1;
		$config['upload_path'] = '././uploads/';
		$config['allowed_types'] = 'csv';
		$config['max_size'] = '1000000000';
		$this -> load -> library('upload', $config);

		
		//die();
		$file_1 = "upload_button";
		$activesheet = 0;
		if ($type == 'slk') {
			//$edata = new Spreadsheet_Excel_Reader();

			// Set output Encoding.
			//$edata -> setOutputEncoding("CP1251");

			if ($_FILES['file_1']['tmp_name']) {
				$excelReader = PHPExcel_IOFactory::createReader('Excel2007');
				$excelReader -> setReadDataOnly(true);
				$objPHPExcel = PHPExcel_IOFactory::load($_FILES['file_1']['tmp_name']);

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$objWriter -> save(str_replace('.php', '.xlsx', __FILE__));

			}

			$objPHPExcel = PHPExcel_IOFactory::load(str_replace('.php', '.xlsx', __FILE__));
		} else {
			$objPHPExcel = PHPExcel_IOFactory::load($_FILES['file_1']['tmp_name']);
		}
		$objReader = new PHPExcel_Reader_Excel5();
		$arr = $objPHPExcel -> setActiveSheetIndex($activesheet) -> toArray(null, true, true, true);
		$highestColumm = $objPHPExcel -> setActiveSheetIndex($activesheet) -> getHighestColumn();
		$highestRow = $objPHPExcel -> setActiveSheetIndex($activesheet) -> getHighestRow();
		$data = array();
        $mytab="";
		for ($row = $start; $row < $highestRow; $row++) {
			//fields you want to save in DB
			$test = $arr[$row]["A"];
			$deviceNo = $arr[$row]["B"];
			$assay = $arr[$row]["C"];
			$sample = $arr[$row]["E"];
			$cd = $arr[$row]["F"];
			$rdate = $arr[$row]["I"];
			if($row<1){
			$resultDate = date('Y-m-d', strtotime($arr[$row]["I"]));
			}
			else{
			 $resultDate = $arr[$row]["I"];
			
			}
			if($row<1){
			$resultTime=$this->convertresulttime(time($arr[$row]["J"]));
			}
			else {	
            $resultTime=$arr[$row]["J"];
			}
	        $operator=$arr[$row]["H"];
	        $barcode=$arr[$row]["K"];
	        $expire=$arr[$row]["L"];
   		    $volume=$arr[$row]["M"];
		    $device=$arr[$row]["N"];
		    $reagent=$arr[$row]["O"];
		    $error=$arr[$row]["G"]; 


			//create the array with the respective fields
			$data['testNO'][] =  $test;
			$data['deviceID'][] = $deviceNo;
			$data['asayID'][] =  $assay;
			$data['sampleNumber'][] =  $sample;
			$data['cdCount'][] = $cd;
			$data['resultDate'][] = $resultDate;
			$data['operatorId'][] =  $operator;
			$data['resulttime'][] =  $resultTime;
			$data['barcode'][] =  $barcode;
			$data['expire'][] =  $expire;
			$data['volume'][] =  $volume;
			$data['device'][] =  $device;
			$data['reagent'][] =  $reagent;
			$data['error'][] =  $error;

		}
		//$data =json_encode($data);
		//echo($data);die;
		$dataArr['uploaded']=$data;
		
		$dataArr['posted']=1;
		$dataArr['contentView'] = 'upload/upload_v';
		$this -> load -> view('template_v', $dataArr);
		
	}
	public function upload_commit(){
		
		$size=$this->input->post('size');
		for($i=1;$i<=$size;$i++){
			$data['testNO'][$i]=	$this->input->post('testNO'.$i);
			$data['deviceID'][$i]=	$this->input->post('deviceID'.$i);
			$data['asayID'][$i]=	$this->input->post('asayID'.$i);
			$data['sampleNumber'][$i]=	$this->input->post('sampleNumber'.$i);
			$data['cdCount'][$i]=	$this->input->post('cdCount'.$i);
			$data['resultDate'][$i]=	$this->input->post('resultDate'.$i);
			$data['operatorId'][$i]=	$this->input->post('operatorId'.$i);
			$data['resulttime'][$i]=	$this->input->post('resulttime'.$i);
			$data['barcode'][$i]=	$this->input->post('barcode'.$i);
			$data['volume'][$i]=	$this->input->post('volume'.$i);
			$data['expire'][$i]=	$this->input->post('expire'.$i);
			$data['device'][$i]=	$this->input->post('device'.$i);
			$data['reagent'][$i]=	$this->input->post('reagent'.$i);
			$data['error'][$i]=	$this->input->post('error'.$i);
			
		}
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	   //save to DB
		//$this->db->insert_batch("test",$data);

	}
	
		 //converts excel date format to nomalcy
   public  function convertresulttime($timefromexcel)
                {
    $DayDifference = 25569; //Day difference between 1 January 1900 to 1 January 1970
    $Day2Seconds = 3600; // no. of seconds in a day
    $ExcelTime= $timefromexcel ; //integer value stored in the Excel column
               
    $UnixTime = ($ExcelTime)*$Day2Seconds; //convert it to unit time
                $converteddate= date("H:i:s", $UnixTime);
                $dateofresult = strtotime ( '-0 day' , strtotime ( $converteddate) ) ;
               $dateofresult = date ( "H:i:s" , $dateofresult ); //convert date to yyy-mm-dd format
                return $dateofresult ;
                }
	
}
