<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class reports extends MY_Controller {

	public function index(){

		$this->home_page();
	}

	public function home_page() {
		$this->login_reroute(array(3,8,9,6));
		$data['content_view'] = "poc/reports_view";
		$data['title'] = "Reports";
		$data['sidebar']	= "poc/sidebar_view";
		$data['filter']	=	false;
		$data	=array_merge($data,$this->load_libraries(array('FusionCharts','poc_reports','jqueryui','dataTables')));

		 /*echo */$patID=$this->session->userdata('id');
		// $patID=$patID-3;
		//die;

		$this->load->model('reports_model');

		$data['DeviceNumberOptions']=$this->reports_model->DeviceNumberOptions($patID);
		$data['yearlyReports']=$this->reports_model->getyearsreported($patID);
		$data['FacilitiesList']=$this->reports_model->getFacilities($patID);


		$this->load->model('poc_model');

		$data['devices_not_reported'] = $this->poc_model->devices_not_reported();
		
		$data['errors_agg'] = $this->poc_model->errors_reported();


		$data['menus']	= 	$this->poc_model->menus(6);
		$this -> template($data);
		//$this->load->view('reports_view',$data);
	}

	/*function dates_check()
	{
		$month_flag="";
		$year_flag="";

		$month_number_check=$this->reports_model->month_check($patID);//check if month exists in the database
		$year_number_check=$this->reports_model->year_check($patID);// check if year exits in the database


	}*/

	function reportSpecs()
	{	
		
		$this->load->model('reports_model');//load reports_model
		$patID=$this->session->userdata('id');//partner session

		$Format=$this->input->post('format');//get radio button value

		$report_type=$this->input->post('report_type');
		

		$Yearo=$this->input->post('YearO');// Yearly report
		
		
		$Device=$this->input->post('device');// get the facility and the device
		$Facility=$this->input->post('facility');
		$all_data=$this->input->post('the_criteria');

		

		$Fromdate=$this->input->post('FromDate');// for customized dates
		$Todate=$this->input->post('ToDate');
		
		$monthly=$this->input->post('FieldM');// Monthly report
	 	$YearM=$this->input->post('YearM');
	 

		$quarterly=$this->input->post('quarterly');// Quarterly report
		$yearQ=$this->input->post('YearQ');

		$biannual=$this->input->post('bian');// Bi-annual report
		$yearB=$this->input->post('YearB');

		$month_flag="";
		$year_flag="";

		$month_number_check=$this->reports_model->month_check($patID);//check if month exists in the database
		$year_number_check=$this->reports_model->year_check($patID);// check if year exits in the database

	//	die;
		
	
		/*..................Format: PDF is selected Start if..........................*/
		if($Format=="pdf")//
		{	

			if($YearM!="" && $monthly!="")// Month and Year chosen
			{
				

					foreach ($month_number_check as $key=> $m_value) 
					{
						
						if($m_value==$monthly)
						{
							$month_flag=1;//set  month flag
						}
						else
						{
							
						}

					}

					foreach ($year_number_check as $y_value)
					{
						if($y_value==$YearM)
						{
							$year_flag=1; //set year flag
						}
						else 
						{
							
						}
					}


					if($month_flag==1 && $year_flag==1)//check the flags set
					{
						/*
							set a default start date and end date for the month selected

						*/
						$month_from_date="-01";
						$from_month=$YearM."-".$monthly.$month_from_date;
					 	$monthly+1;
					 	$end_month=date('Y-m-d',mktime(0,0,0,$monthly,31,$YearM));					 	

					 	//die;
						$GraphPDF=$this->reports_model->year_month_report($YearM,$monthly,$all_data,$Facility,$Device,$from_month,$end_month,$report_type);
						
					}
					else 
					{	

						if($year_flag==null || $year_flag="")
							{
								$img=base_url().'img/nascop.jpg';// Nascop Logo
								$NoData='<table width="100%" border="1">
											<tr>
												<td><center><img style="vertical-align: top;" src="'.$img.'"/></center></td>
											</tr>
											<tr>
												<td>
													<center>
														<b>The data for the year you have selected does not existed or has not been collected yet
														</b>
													</center>
												</td>
											</tr>
										</table>';


								$this->load->library('mpdf/mpdf');// Load the library
								//echo $NoData;die;
								$filename="CD4 Report.pdf";
								$this->mpdf->WriteHTML($NoData);
								$this->mpdf->Output();// Output the results in the browser
							}
						else if($month_flag==null || $month_flag=="")
							{
								$img=base_url().'img/nascop.jpg';// Nascop Logo
								$NoData='<table width="100%" border="1">
											<tr>
												<td><center><img style="vertical-align: top;" src="'.$img.'"/></center></td>
											</tr>
											<tr>
												<td>
													<center>
														<b>The data for the month you have selected does not existed or has not been collected yet
														</b>
													</center>
												</td>
											</tr>
										</table>';


								$this->load->library('mpdf/mpdf');// Load the library
								//echo $NoData;die;
								$filename="CD4 Report.pdf";
								$this->mpdf->WriteHTML($NoData);
								$this->mpdf->Output();// Output the results in the browser
								

							}

					}


				
			}

			if($yearQ!="" && $quarterly!="")// Quarter and Year chosen
			{

			 	if($quarterly==1)
			 	{
			 		/*
						set a default start date and end date for the month selected

					*/
			 		$from_month=$yearQ.'-01-01';
			 		$end_month=$yearQ.'-04-30';
			 		$quarter="January - April";
			 		//echo $Facility;die;
					$GraphPDF = $this->reports_model->year_quarter_report($yearQ,$quarter,$quarterly,$all_data,$Facility,$Device,$from_month,$end_month,$report_type);
				

			 	}else if($quarterly==2)
			 	{
			 		$from_month=$yearQ.'-05-01';
			 		$end_month=$yearQ.'-08-31';
			 		$quarter="May - August";

			 		$GraphPDF = $this->reports_model->year_quarter_report($yearQ,$quarter,$quarterly,$all_data,$Facility,$Device,$from_month,$end_month,$report_type);

			 	}else if($quarterly==3)
			 	{
			 		$from_month=$yearQ.'-09-01';
			 		$end_month=$yearQ.'-12-31';
			 		$quarter="September - December";

			 		$GraphPDF = $this->reports_model->year_quarter_report($yearQ,$quarter,$quarterly,$all_data,$Facility,$Device,$from_month,$end_month,$report_type);
			 	}

				
			}

			if($yearB!="" && $biannual!="")// Bi-annual and Year chosen
			{
				if($biannual==1)
				{
					$from_month=$yearB.'-01-01';
			 		$end_month=$yearB.'-06-30';
			 		$biannual_name="January - June";

					$GraphPDF = $this->reports_model->year_biannual_report($yearB,$biannual_name,$biannual,$all_data,$Facility,$Device,$from_month,$end_month,$report_type);
				}
				else if($biannual==2)
				{
					$from_month=$yearB.'-07-01';
			 		$end_month=$yearB.'-12-31';
			 		$biannual_name="July - December";

					$GraphPDF = $this->reports_model->year_biannual_report($yearB,$biannual_name,$biannual,$all_data,$Facility,$Device,$from_month,$end_month,$report_type);
				}
					
					
			}

			if($Yearo!="")// Yearly criteria chosen
			{	
				$from_month=$Yearo.'-01-01';
				$end_month=$Yearo.'-12-01';

				$GraphPDF = $this->reports_model->year_report($Yearo,$all_data,$Facility,$Device,$from_month,$end_month,$report_type);
				
			}


			if($Fromdate!="" && $Todate!="")// Custom dates chosen
			{

				$GraphPDF= $this->reports_model->customized_dates_report($Fromdate,$Todate,$all_data,$Facility,$Device,$report_type);
			
			}

			

				//echo $GraphPDF;
				/*$this->load->library('mpdf/mpdf');// Load the library

				$filename="CD4 Report.pdf";
				$this->mpdf->WriteHTML($GraphPDF);
				//$this->mpdf->Output();// Output the results in the browser
				$this->mpdf->Output($filename,'D'); //bring up "Save as Dialog"*/

		}/*..................Format: PDF End if..........................*/



		/*..................Format: Excel is selected..........................*/
		else if($Format=="excel")
		{

			if($YearM!="" && $monthly!="")// Month and Year chosen
			{
				$month_from_date="-01";
				$from_month=$YearM."-".$monthly.$month_from_date."<br />";
			 	$monthly+1;
			 	$end_month=date('Y-m-d',mktime(0,0,0,$monthly,31,$YearM));

				//$ssql_data=$this->reports_model->cd4_test_details_facility($from_month,$end_month,$Facility);
				$PHPExcel[] = $this->reports_model->excel_year_month($YearM,$monthly,$Facility,$Device,$from_month,$end_month,$report_type);
	
			}

			if($yearQ!="" && $quarterly!="")// Quarter and Year chosen
			{
				if($quarterly==1)
				{
					$from_month=$yearQ.'-01-01';
			 		$end_month=$yearQ.'-04-30';
			 		$quarter="January - April";

					$PHPExcel[] = $this->reports_model->excel_year_quarter_report($yearQ,$quarter,$Facility,$Device,$from_month,$end_month,$report_type);
				}
				else if($quarterly==2)
				{
					$from_month=$yearQ.'-05-01';
			 		$end_month=$yearQ.'-08-31';
			 		$quarter="May - August";

					$PHPExcel[] = $this->reports_model->excel_year_quarter_report($yearQ,$quarter,$Facility,$Device,$from_month,$end_month,$report_type);
				}
				else if($quarterly==3)
				{
					$from_month=$yearQ.'-09-01';
			 		$end_month=$yearQ.'-12-31';
			 		$quarter="September - December";

					$PHPExcel[] = $this->reports_model->excel_year_quarter_report($yearQ,$quarter,$Facility,$Device,$from_month,$end_month,$report_type);
				}
					
			}
			
			if($yearB!="" && $biannual!="")// Bi-annual and Year chosen
			{
				
				if($biannual==1)
				{
					$from_month=$yearB.'-01-01';
			 		$end_month=$yearB.'-06-30';
			 		$biannual_name="January - June";

					$PHPExcel[] = $this->reports_model->excel_year_biannual_report($yearB,$biannual_name,$Facility,$Device,$from_month,$end_month,$report_type);
				}
				else if($biannual==2)
				{
					$from_month=$yearB.'-07-01';
			 		$end_month=$yearB.'-12-31';
			 		$biannual_name="July - December";

					$PHPExcel[] = $this->reports_model->excel_year_biannual_report($yearB,$biannual_name,$Facility,$Device,$from_month,$end_month,$report_type);
	
				}
			}

			if($Yearo!="")// Yearly criteria chosen
			{
				$from_month=$Yearo.'-01-01';
				$end_month=$Yearo.'-12-01';

				$PHPExcel[] = $this->reports_model->excel_year_report($Yearo,$Facility,$Device,$from_month,$end_month,$report_type);
				
			}
			if($Fromdate!="" && $Todate!="")
			{
				
				$PHPExcel[]= $this->reports_model->excel_customized_dates_report($Fromdate,$Todate,$Facility,$Device,$report_type);

			}
			

			$filename="TEST OUTCOME REPORT FOR CD4 Count.xls";
			header('Content-Type: application/vnd.ms-excel');// *can use ms-excel2007
			header('Content-Disposition: attachment;filename="'.$filename.'" ');
			header('Cache-Control: max-age=0');
			$obWrite=PHPExcel_IOFactory::createWriter($this->excel,'Excel5');
			$obWrite->save('php://output');


		}

		}
		
		function print_pdf()
		{
			$img=base_url().'img/nascop.jpg';// Nascop Logo

			$tests_done=$this->input->post('tests_done');
			$count=$this->input->post('count');
			$errors=$this->input->post('errors');

			$the_month=$this->input->post('month');
			$quarter=$this->input->post('quarter');
			$bian=$this->input->post('bian');
			$year_cri=$this->input->post('year_cri');
			$customized_from=$this->input->post('from');
			$customized_end=$this->input->post('end');

			$facility=$this->input->post('facility');
			$device=$this->input->post('device');
			$all=$this->input->post('all');

			$report_type=$this->input->post('report_type');
			$year=$this->input->post('year');


			$GraphPDF="
							<table width='53%' border='0' align='center'>
								<tr>
									<td><center><img style='vertical-align: top;' src='$img'/></center></td>
								</tr>
							</table>";
			// Checks 
			if($the_month!="")// Check if month was selected
			{

				if($facility!="")// check if the facility was selected
				{
					
					$GraphPDF.='<br /><table border="0" align="center">
								<tr>
									<td><center><b>Report for '.$facility.' - '.$the_month.', '.$year.'</b></center></td>							
								</tr>
							</table>';
					if($report_type==1)//tests 
					{
						$GraphPDF.='<table border="1" align="center" width="480">
									<tr>
										<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
										<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
									</tr>';

						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table><br />';
					}
					else if($report_type==2)//errors
					{
						$GraphPDF.='<table width="480" border="1" align="center">
										<tr>
											<th bgcolor="#CC0000" style="color:#FFF;">Tests with Errors</th>
											<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
										</tr>';
						$GraphPDF.='<tr><td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';

					}
					else if($report_type==0)// All Tests
					{
							$GraphPDF.='<table width="580" border="1" align="center">
											<tr>
												<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
												<th bgcolor="#CC0000" style="color:#FFF;">Tests with Errors</th>
												<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
											</tr>';
							$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
							$GraphPDF.='<td align="center">'.$errors.'</td>';
							$GraphPDF.='<td align="center">'.$count.'</td></tr>';
							$GraphPDF.='</table>';
					}

				}
				if($device!="")// Check if device was selected
				{
					$GraphPDF.='<br /><table border="0" align="center">
									<tr>
										<td>
											<center><b>Report for the '.$device.' Device - '.$the_month.', '.$year.' </b></center>
										</td>
									</tr>
								</table>';

					if($report_type==1)
					{
						$GraphPDF.='<table border="1" align="center" width="480">
								<tr>
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>
								<tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';
					}
					else if($report_type==2)
					{
						$GraphPDF.='<table width="480" border="1" align="center">
								<tr>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests with Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';

					}
					else if($report_type==0)
					{
						$GraphPDF.='<table width="580" border="1" align="center">
								<tr>
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests With Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';

					}

				}
				if($all==3)
				{
					$GraphPDF.='<br />
								<table border="0" align="center">
									<tr>
										<td>
											<center><b>Report for all tests - '.$the_month.', '.$year.' </b></center>
										</td>
									</tr>
								</table>';
					if($report_type==1)
					{
						$GraphPDF.='<table border="1" align="center" width="480">
								<tr>
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>
								<tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';
					}
					else if($report_type==2)
					{
						$GraphPDF.='<table width="480" border="1" align="center">
										<tr>
											<th bgcolor="#CC0000" style="color:#FFF;">Tests with Errors</th>
											<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
										</tr>';
						$GraphPDF.='<tr><td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';


					}
					else if($report_type==0)
					{
						$GraphPDF.='<table width="580" border="1" align="center">
								<tr>
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests With Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';
					}

				}	
			}

			if($quarter!="")// Check if quarter was selected
			{
				
				if($facility!="")
				{
					$GraphPDF.='<br /><table align="center">
							<tr>
								<td><center><b>Report for '.$facility.' - '.$quarter.', '.$year.'</b></center></td>							
							</tr>
							</table>';

					if($report_type==1)
					{
						$GraphPDF.='<table width="480" border="1" align="center">
								<tr>
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';

					}
					else if($report_type==2)
					{
						$GraphPDF.='<table width="480" border="1" align="center">
								<tr>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests with Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';

					}
					else if($report_type==0)
					{
						$GraphPDF.='<table width="580" border="1" align="center">
								<tr>
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests With Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';

					}
				}

				if($device!="")
				{
					$GraphPDF.='<br /><table align="center">
							<tr>
								<td><center><b>Report for '.$device.' - '.$quarter.' ,'.$year.'</b></center></td>							
							</tr>
						</table>';
					if($report_type==1)
					{
						$GraphPDF.='<table width="480" border="1" align="center">
								<tr>
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';

					}
					else if($report_type==2)
					{
						$GraphPDF.='<table width="480" border="1" align="center">
								<tr>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests with Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';

					}
					else if($report_type==0)
					{
						$GraphPDF.='<table width="580" border="1" align="center">
								<tr>
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests With Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';

					}
				}

				if($all==3)
				{
					$GraphPDF.='<br />
								<table border="0" align="center">
									<tr>
										<td>
											<center><b>Report for all tests - '.$quarter.', '.$year.' </b></center>
										</td>
									</tr>
								</table>';
					if($report_type==1)
					{
						$GraphPDF.='<table width="480" border="1" align="center">
								<tr>
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';

					}
					else if($report_type==2)
					{
						$GraphPDF.='<table width="480" border="1" align="center">
								<tr>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests with Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';

					}
					else if($report_type==0)
					{
						$GraphPDF.='<table width="580" border="1" align="center">
								<tr>
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests With Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';

					}
				}
			}

			if($bian!="")// Check if biannual was selected
			{
				
				if($facility!="")
				{
					$GraphPDF.='<br /><table align="center">
							<tr>
								<td><center><b>Report for '.$facility.' - '.$bian.', '.$year.'</b></center></td>							
							</tr>
							</table>';
					if($report_type==1)
					{
						$GraphPDF.='<table width="480" border="1" align="center">
								<tr>
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';

					}
					else if($report_type==2)
					{
						$GraphPDF.='<table width="480" border="1" align="center">
								<tr>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests with Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';

					}
					else if($report_type==0)
					{
						$GraphPDF.='<table width="580" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests With Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';
					}
				}

				if($device!="")
				{
					$GraphPDF.='<br />
							<table align="center">
								<tr>
									<td><center><b>Report for '.$device.' - '.$bian.', '.$year.'</b></center></td>							
								</tr>
							</table>';

					if($report_type==1)
					{
						$GraphPDF.='<table width="480" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';		
					}
					else if($report_type==2)
					{
						$GraphPDF.='<table width="480" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#CC0000" style="color:#FFF;">Tests with Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';
					}
					else if($report_type==0)
					{
						$GraphPDF.='<table width="580" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests With Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';
					}
				}

				if($all==3)
				{
					$GraphPDF.='<br /><table border="0" align="center">
										<tr>
											<td>
												<center><b>Report for all tests - '.$bian.' '.$year.' </b></center>
											</td>
										</tr>
									</table>';

					if($report_type==1)
					{
						$GraphPDF.='<table width="480" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';		
					}
					else if($report_type==2)
					{
						$GraphPDF.='<table width="480" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#CC0000" style="color:#FFF;">Tests with Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';
					}
					else if($report_type==0)
					{
						$GraphPDF.='<table width="580" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests With Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';
					}
				}
			}

			if($year_cri!="")
			{
				if($facility!="")
				{
					$GraphPDF.='<br />
						<table align="center">
							<tr>
								<td><center><b>Yearly Report for '.$facility.' - '.$year_cri.'</b></center></td>							
							</tr>
						</table>';
					if($report_type==1)
					{
						$GraphPDF.='<table width="480" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';		
					}
					else if($report_type==2)
					{
						$GraphPDF.='<table width="480" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#CC0000" style="color:#FFF;">Tests with Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';
					}
					else if($report_type==0)
					{
						$GraphPDF.='<table width="580" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests With Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';
					}

				}
				if($device!="")
				{
					$GraphPDF.='<br /><table align="center">
							<tr>
								<td><center><b>Yearly Report for '.$device.' - '.$year_cri.'</b></center></td>								
							</tr>
						</table>';
					if($report_type==1)
					{
						$GraphPDF.='<table width="480" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';		
					}
					else if($report_type==2)
					{
						$GraphPDF.='<table width="480" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#CC0000" style="color:#FFF;">Tests with Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';
					}
					else if($report_type==0)
					{
						$GraphPDF.='<table width="580" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests With Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';
					}
				}
				if($all==3)
				{
					$GraphPDF.='
					<br /><table border="0" align="center">
						<tr>
							<td>
								<center><b>Yearly Report - '.$year_cri.' </b></center>
							</td>
						</tr>
					</table>';
					if($report_type==1)
					{
						$GraphPDF.='<table width="480" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';		
					}
					else if($report_type==2)
					{
						$GraphPDF.='<table width="480" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#CC0000" style="color:#FFF;">Tests with Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';
					}
					else if($report_type==0)
					{
						$GraphPDF.='<table width="580" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests With Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
						$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
						$GraphPDF.='<td align="center">'.$errors.'</td>';
						$GraphPDF.='<td align="center">'.$count.'</td></tr>';
						$GraphPDF.='</table>';
					}
				}
			}

			if($customized_from!="" && $customized_end!="")//check if the user selected customized dates
			{
				if($facility!="")
				{
					$GraphPDF.='<br /><table align="center">
							<tr>
								<td><center><b>Report for '.$facility.' - Between '.$customized_from.' and '.$customized_end.'</b></center></td>
							</tr>
						</table>';
						if($report_type==1)
						{
							$GraphPDF.='<table width="480" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
							$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
							$GraphPDF.='<td align="center">'.$count.'</td></tr>';
							$GraphPDF.='</table>';
						}
						else if($report_type==2)
						{
							$GraphPDF.='<table width="480" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#CC0000" style="color:#FFF;">Tests with Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
							$GraphPDF.='<tr><td align="center">'.$errors.'</td>';
							$GraphPDF.='<td align="center">'.$count.'</td></tr>';
							$GraphPDF.='</table>';
						}
						else if($report_type==0)
						{
							$GraphPDF.='<table width="580" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests With Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
							$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
							$GraphPDF.='<td align="center">'.$errors.'</td>';
							$GraphPDF.='<td align="center">'.$count.'</td></tr>';
							$GraphPDF.='</table>';
						}
				}

				if($device!="")
				{
					$GraphPDF.='<br /><table align="center">
							<tr>
								<td><center><b>Report for '.$device.' - Between '.$customized_from.' and '.$customized_end.'</b></center></td>
							</tr>
						</table>';
					if($report_type==1)
						{
							$GraphPDF.='<table width="480" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
							$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
							$GraphPDF.='<td align="center">'.$count.'</td></tr>';
							$GraphPDF.='</table>';
						}
						else if($report_type==2)
						{
							$GraphPDF.='<table width="480" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#CC0000" style="color:#FFF;">Tests with Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
							$GraphPDF.='<tr><td align="center">'.$errors.'</td>';
							$GraphPDF.='<td align="center">'.$count.'</td></tr>';
							$GraphPDF.='</table>';
						}
						else if($report_type==0)
						{
							$GraphPDF.='<table width="580" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests With Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
							$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
							$GraphPDF.='<td align="center">'.$errors.'</td>';
							$GraphPDF.='<td align="center">'.$count.'</td></tr>';
							$GraphPDF.='</table>';
						}
				}

				if($all==3)
				{
					$GraphPDF.='<br /><table border="0" align="center">
									<tr>
										<td>
											<center><b>Report - Between '.$customized_from.' and '.$customized_end.'</b></center>
										</td>
									</tr>
								</table>';
					if($report_type==1)
						{
							$GraphPDF.='<table width="480" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
							$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
							$GraphPDF.='<td align="center">'.$count.'</td></tr>';
							$GraphPDF.='</table>';
						}
						else if($report_type==2)
						{
							$GraphPDF.='<table width="480" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#CC0000" style="color:#FFF;">Tests with Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
							$GraphPDF.='<tr><td align="center">'.$errors.'</td>';
							$GraphPDF.='<td align="center">'.$count.'</td></tr>';
							$GraphPDF.='</table>';
						}
						else if($report_type==0)
						{
							$GraphPDF.='<table width="580" border="1" align="center">
								<tr cols="1">
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests With Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
							$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
							$GraphPDF.='<td align="center">'.$errors.'</td>';
							$GraphPDF.='<td align="center">'.$count.'</td></tr>';
							$GraphPDF.='</table>';
						}
				}	

			}


			$this->load->library('mpdf/mpdf');// Load the library
			/*echo $GraphPDF;
			die;*/
			$filename="CD4 Report.pdf";
			$this->mpdf->WriteHTML($GraphPDF);
			//$this->mpdf->Output();// Output the results in the browser
			$this->mpdf->Output($filename,'D'); //bring up "Save as Dialog"
		}
		

	}

	/*

	*http://filext.com/faq/office_mime_types.php for the header mime types

	*/

/* End of file reports.php */
/* Location: ./application/modules/poc/controller/reports.php */