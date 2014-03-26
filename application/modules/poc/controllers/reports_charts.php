<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class reports_charts extends MY_Controller {

	function PDFchart($test,$errors,$total,$report_type,$facility,$device,$all,$month_name,$q_no,$b_no,$year,$the_year,$from,$to)
	{
		$this->load->model('reports_charts_model');
		
		$graph_tests="";
		
		if($month_name!="0")// check if month was selected
		{
			
			if($facility!="0")
			{
				if($report_type==1)
				{
					$graph_tests=$this->reports_charts_model->year_month_facility_tests_chart($facility,$test,$total,$month_name,$the_year);
				}
				else if($report_type==2)
				{
					$graph_tests=$this->reports_charts_model->year_month_facility_errors_chart($facility,$errors,$total,$month_name,$the_year);
				}
				else if($report_type==0)
				{
					//$graph_tests="heref";
					$graph_tests=$this->reports_charts_model->year_month_facility_chart($facility,$test,$errors,$total,$month_name,$the_year);
				}
				
			}

			if($device!="0")
			{
				if($report_type==1)
				{
					$graph_tests=$this->reports_charts_model->year_month_device_tests_chart($device,$test,$total,$month_name,$the_year);
				}
				else if($report_type==2)
				{
					$graph_tests=$this->reports_charts_model->year_month_device_errors_chart($device,$errors,$total,$month_name,$the_year);
				}
				else if($report_type==0)
				{
					//$graph_tests="hered";
					$graph_tests=$this->reports_charts_model->year_month_device_chart($device,$test,$errors,$total,$month_name,$the_year);
				}
			}
			if($all!="0")
			{
				if($report_type==1)
				{
					$graph_tests=$this->reports_charts_model->year_month_all_tests_chart($test,$total,$month_name,$the_year);
				}
				else if($report_type==2)
				{
					$graph_tests=$this->reports_charts_model->year_month_all_errors_chart($errors,$total,$month_name,$the_year);
				}
				else if($report_type==0)
				{
					$graph_tests=$this->reports_charts_model->year_month_all_chart($test,$errors,$total,$month_name,$the_year);
				}
			}

			
		}
		if($q_no!="0")// check if Quarter was selected
		{
			if($facility!="0")
			{
				if($report_type==1)
				{
					
					$graph_tests=$this->reports_charts_model->year_quarter_facility_tests_chart($facility,$test,$total,$q_no,$the_year);

				}
				else if($report_type==2)
				{
					
					$graph_tests=$this->reports_charts_model->year_quarter_facility_errors_chart($facility,$errors,$total,$q_no,$the_year);
				}
				else if($report_type==0)
				{
					
					$graph_tests=$this->reports_charts_model->year_quarter_facility_chart($facility,$test,$errors,$total,$q_no,$the_year);
				}
			}

			if($device!="0")
			{
				if($report_type==1)
				{
					
					$graph_tests=$this->reports_charts_model->year_quarter_device_tests_chart($device,$test,$total,$q_no,$the_year);

				}
				else if($report_type==2)
				{
					$graph_tests=$this->reports_charts_model->year_quarter_device_errors_chart($device,$errors,$total,$q_no,$the_year);
				}
				else if($report_type==0)
				{
					
					$graph_tests=$this->reports_charts_model->year_quarter_device_chart($device,$test,$errors,$total,$q_no,$the_year);
				}
			}

			if($all!="0")
			{
				if($report_type==1)
				{
					//$graph_tests="yes_tests";
					$graph_tests=$this->reports_charts_model->year_quarter_all_tests_chart($test,$total,$q_no,$the_year);
				}

				
				else if($report_type==2)
				{
					//$graph_tests="yes_errors";
					$graph_tests=$this->reports_charts_model->year_quarter_all_errors_chart($errors,$total,$q_no,$the_year);
				}
				else if($report_type==0)
				{
					//$graph_tests="yes_both";
					$graph_tests=$this->reports_charts_model->year_quarter_all_chart($test,$errors,$total,$q_no,$the_year);
				}
			}
			
				
		}

		if($b_no!="0")// check if the biannual criteria is chosen
		{
			if($facility!="0")
			{
				if($report_type==1)
				{
					$graph_tests=$this->reports_charts_model->year_bian_facility_tests_chart($facility,$test,$total,$b_no,$the_year);
				}
				else if($report_type==2)
				{
					$graph_tests=$this->reports_charts_model->year_bian_facility_errors_chart($facility,$errors,$total,$b_no,$the_year);
				}
				else if($report_type==0)
				{
					$graph_tests=$this->reports_charts_model->year_bian_facility_chart($facility,$test,$errors,$total,$b_no,$the_year);
				}
			}

			if($device!="0")
			{
				if($report_type==1)
				{
					$graph_tests=$this->reports_charts_model->year_bian_device_tests_chart($device,$test,$total,$b_no,$the_year);
				}
				else if($report_type==2)
				{
					$graph_tests=$this->reports_charts_model->year_bian_device_errors_chart($device,$errors,$total,$b_no,$the_year);
				}
				else if($report_type==0)
				{
					$graph_tests=$this->reports_charts_model->year_bian_device_chart($device,$test,$errors,$total,$b_no,$the_year);
				}

			}
			if($all!="0")
			{
				if($report_type==1)
				{
					$graph_tests=$this->reports_charts_model->year_bian_all_tests_chart($test,$total,$b_no,$the_year);
				}
				else if($report_type==2)
				{
					$graph_tests=$this->reports_charts_model->year_bian_all_errors_chart($errors,$total,$b_no,$the_year);
				}
				else if($report_type==0)
				{
					$graph_tests=$this->reports_charts_model->year_bian_all_chart($test,$errors,$total,$b_no,$the_year);
				}

			}
		}

		if($year!="0")// check if the yearly criteria is chosen
		{
			if($facility!="0")
			{
				if($report_type==1)
				{
					$graph_tests=$this->reports_charts_model->yearly_facility_tests_chart($facility,$test,$total,$year);
				}
				else if($report_type==2)
				{
					$graph_tests=$this->reports_charts_model->yearly_facility_errors_chart($facility,$errors,$total,$year);
				}
				else if($report_type==0)
				{
					$graph_tests=$this->reports_charts_model->yearly_facility_chart($facility,$test,$errors,$total,$year);
				}
			}
			if($device!="0")
			{
				if($report_type==1)
				{
					$graph_tests=$this->reports_charts_model->yearly_device_tests_chart($device,$test,$total,$year);
				}
				else if($report_type==2)
				{
					$graph_tests=$this->reports_charts_model->yearly_device_errors_chart($device,$errors,$total,$year);
				}
				else if($report_type==0)
				{
					$graph_tests=$this->reports_charts_model->yearly_device_chart($device,$test,$errors,$total,$year);
				}

			}
			if($all!="0")
			{
				if($report_type==1)
				{
					$graph_tests=$this->reports_charts_model->yearly_all_tests_chart($test,$total,$year);
				}
				else if($report_type==2)
				{
					$graph_tests=$this->reports_charts_model->yearly_all_errors_chart($errors,$total,$year);
				}
				else if($report_type==0)
				{
					$graph_tests=$this->reports_charts_model->yearly_all_chart($test,$errors,$total,$year);
				}
			}
		}

		if($from!="0" && $to!="0")
		{
			if($facility!="0")
			{
				if($report_type==1)
				{
					$graph_tests=$this->reports_charts_model->customized_dates_facility_tests_chart($facility,$test,$total,$from,$to);
				}
				else if($report_type==2)
				{
					$graph_tests=$this->reports_charts_model->customized_dates_facility_errors_chart($facility,$errors,$total,$from,$to);
				}
				else if($report_type==0)
				{
					$graph_tests=$this->reports_charts_model->customized_dates_facility_chart($facility,$test,$errors,$total,$from,$to);
				}
			}
			if($device!="0")
			{
				if($report_type==1)
				{
					$graph_tests=$this->reports_charts_model->customized_dates_device_tests_chart($device,$test,$total,$from,$to);
				}
				else if($report_type==2)
				{
					$graph_tests=$this->reports_charts_model->customized_dates_device_errors_chart($device,$errors,$total,$from,$to);
				}
				else if($report_type==0)
				{
					$graph_tests=$this->reports_charts_model->customized_dates_device_chart($device,$test,$errors,$total,$from,$to);		
				}
			}
			if($all!="0")
			{
				if($report_type==1)
				{
					$graph_tests=$this->reports_charts_model->customized_dates_all_tests_chart($test,$total,$from,$to);
				}
				else if($report_type==2)
				{
					$graph_tests=$this->reports_charts_model->customized_dates_all_errors_chart($errors,$total,$from,$to);
				}
				else if($report_type==0)
				{
					$graph_tests=$this->reports_charts_model->customized_dates_all_chart($test,$errors,$total,$from,$to);			
				}
			}
		}

	echo $graph_tests;	
	}
}