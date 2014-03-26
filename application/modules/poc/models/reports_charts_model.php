<?php

class reports_charts_model extends CI_Model{

	/*====================== Facility by month========================================*/
	function year_month_facility_tests_chart($facility,$test,$total,$monthname,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$facility.','.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';
		$Chart.="<category label='$monthname'/>";
		$Chart.= '</categories>';

		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		$Chart.= "<set value='$total'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
		$Chart.= "<set value='$test'/>";
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;


	}

	function year_month_facility_errors_chart($facility,$errors,$total,$monthname,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$facility.','.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';
		$Chart.="<category label='$monthname'/>";
		$Chart.= '</categories>';

		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		$Chart.= "<set value='$total'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
		$Chart.= "<set value='$errors'/>";
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;

       

	}

	function year_month_facility_chart($facility,$test,$errors,$total,$monthname,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$facility.','.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';
		$Chart.="<category label='$monthname'/>";
		$Chart.= '</categories>';

		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		$Chart.= "<set value='$total'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
		$Chart.= "<set value='$test'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
		$Chart.= "<set value='$errors'/>";
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;

       

	}

/*====================== Facility by month End========================================*/

/*====================== Device by month=============================================*/

	function year_month_device_chart($device,$test,$errors,$total,$monthname,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$device.','.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';
		$Chart.="<category label='$monthname'/>";
		$Chart.= '</categories>';

		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		$Chart.= "<set value='$total'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
		$Chart.= "<set value='$test'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
		$Chart.= "<set value='$errors'/>";
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}

	function year_month_device_tests_chart($device,$test,$total,$monthname,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$device.','.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';
		$Chart.="<category label='$monthname'/>";
		$Chart.= '</categories>';

		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		$Chart.= "<set value='$total'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
		$Chart.= "<set value='$test'/>";
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;

	}

	function year_month_device_errors_chart($device,$errors,$total,$monthname,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$device.','.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';
		$Chart.="<category label='$monthname'/>";
		$Chart.= '</categories>';

		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		$Chart.= "<set value='$total'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
		$Chart.= "<set value='$errors'/>";
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}
/*====================== Device by month End=============================================*/

/*====================== All by month===================================================*/

	function year_month_all_tests_chart($test,$total,$monthname,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="Report for all tests - Successful Tests, '.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';
		$Chart.="<category label='$monthname'/>";
		$Chart.= '</categories>';

		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		$Chart.= "<set value='$total'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
		$Chart.= "<set value='$test'/>";
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}

	function year_month_all_errors_chart($errors,$total,$monthname,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="Report for all tests - Errors, '.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';
		$Chart.="<category label='$monthname'/>";
		$Chart.= '</categories>';

		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		$Chart.= "<set value='$total'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
		$Chart.= "<set value='$errors'/>";
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}

	function year_month_all_chart($test,$errors,$total,$monthname,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="Report for all tests, '.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';
		$Chart.="<category label='$monthname'/>";
		$Chart.= '</categories>';

		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		$Chart.= "<set value='$total'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
		$Chart.= "<set value='$test'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
		$Chart.= "<set value='$errors'/>";
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}

/*====================== All by month End=============================================*/

/*====================== facility by quarter ==========================================*/

function year_quarter_facility_tests_chart($facility,$test,$total,$quarter,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$facility.','.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		if($quarter==1)
		{
			$startmonth=1;
			$endmonth=4;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';

		}

		else if($quarter==2)
		{
			$start=5;
			$endmonth=8;

			for($start;  $start<=$endmonth;  $start++)
		  		{  

			  		$monthname=$this->GetMonthName($start);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		else if($quarter==3)
		{
			$startmonth=9;
			$endmonth=12;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}

	function year_quarter_facility_errors_chart($facility,$errors,$total,$quarter,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$facility.','.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		if($quarter==1)
		{
			$startmonth=1;
			$endmonth=4;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';
			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}

		else if($quarter==2)
		{
			$start=5;
			$endmonth=8;

			for($start;  $start<=$endmonth;  $start++)
		  		{  

			  		$monthname=$this->GetMonthName($start);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';
			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		else if($quarter==3)
		{
			$startmonth=9;
			$endmonth=12;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';
			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}
	function year_quarter_facility_chart($facility,$test,$errors,$total,$quarter,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$facility.','.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		if($quarter==1)
		{
			$startmonth=1;
			$endmonth=4;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';
			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}

		else if($quarter==2)
		{
			$start=5;
			$endmonth=8;

			for($start;  $start<=$endmonth;  $start++)
		  		{  

			  		$monthname=$this->GetMonthName($start);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';
			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		else if($quarter==3)
		{
			$startmonth=9;
			$endmonth=12;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';
			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}
/*====================== facility by quarter End ==========================================*/

/*====================== device by quarter ===============================================*/

	function year_quarter_device_tests_chart($device,$test,$total,$quarter,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$device.','.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		if($quarter==1)
		{
			$startmonth=1;
			$endmonth=4;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';
			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';

		}

		else if($quarter==2)
		{
			$start=5;
			$endmonth=8;

			for($start;  $start<=$endmonth;  $start++)
		  		{  

			  		$monthname=$this->GetMonthName($start);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		else if($quarter==3)
		{
			$startmonth=9;
			$endmonth=12;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}

	function year_quarter_device_errors_chart($device,$errors,$total,$quarter,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$device.',,'.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		if($quarter==1)
		{
			$startmonth=1;
			$endmonth=4;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';
			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}

		else if($quarter==2)
		{
			$start=5;
			$endmonth=8;

			for($start;  $start<=$endmonth;  $start++)
		  		{  

			  		$monthname=$this->GetMonthName($start);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';
			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		else if($quarter==3)
		{
			$startmonth=9;
			$endmonth=12;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';
			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}

	function year_quarter_device_chart($device,$test,$errors,$total,$quarter,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$device.','.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		if($quarter==1)
		{
			$startmonth=1;
			$endmonth=4;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';
			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}

		else if($quarter==2)
		{
			$start=5;
			$endmonth=8;

			for($start;  $start<=$endmonth;  $start++)
		  		{  

			  		$monthname=$this->GetMonthName($start);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';
			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		else if($quarter==3)
		{
			$startmonth=9;
			$endmonth=12;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';
			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}
/*====================== device by quarter End============================================*/

/*====================== All by quarter ==================================================*/

function year_quarter_all_tests_chart($test,$total,$quarter,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="Chart for all data - Successful Tests,'.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		if($quarter==1)
		{
			$startmonth=1;
			$endmonth=4;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';
			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';

		}

		else if($quarter==2)
		{
			$start=5;
			$endmonth=8;

			for($start;  $start<=$endmonth;  $start++)
		  		{  

			  		$monthname=$this->GetMonthName($start);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		else if($quarter==3)
		{
			$startmonth=9;
			$endmonth=12;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}

function year_quarter_all_errors_chart($errors,$total,$quarter,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="Chart for all data - Errors,'.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		if($quarter==1)
		{
			$startmonth=1;
			$endmonth=4;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';
			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}

		else if($quarter==2)
		{
			$start=5;
			$endmonth=8;

			for($start;  $start<=$endmonth;  $start++)
		  		{  

			  		$monthname=$this->GetMonthName($start);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';
			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		else if($quarter==3)
		{
			$startmonth=9;
			$endmonth=12;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';
			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}

function year_quarter_all_chart($test,$errors,$total,$quarter,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="Chart for all data,'.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		if($quarter==1)
		{
			$startmonth=1;
			$endmonth=4;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';
			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=1;$startmonth< 5;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}

		else if($quarter==2)
		{
			$start=5;
			$endmonth=8;

			for($start;  $start<=$endmonth;  $start++)
		  		{  

			  		$monthname=$this->GetMonthName($start);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';
			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=5;$startmonth< 9;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		else if($quarter==3)
		{
			$startmonth=9;
			$endmonth=12;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';
			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=9;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}


/*====================== All by quarter End===============================================*/

/*====================== facility by biannual=============================================*/

	function year_bian_facility_tests_chart($facility,$test,$total,$bian,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$facility.',,'.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		if($bian==1)
		{
			$startmonth=1;
			$endmonth=6;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';

		}

		else if($bian==2)
		{
			$start=7;
			$endmonth=12;

			for($start;  $start<=$endmonth;  $start++)
		  		{  

			  		$monthname=$this->GetMonthName($start);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=7;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=7;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}

	function year_bian_facility_errors_chart($facility,$errors,$total,$bian,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$facility.',,'.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		if($bian==1)
		{
			$startmonth=1;
			$endmonth=6;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';

		}

		else if($bian==2)
		{
			$start=7;
			$endmonth=12;

			for($start;  $start<=$endmonth;  $start++)
		  		{  

			  		$monthname=$this->GetMonthName($start);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=7;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=7;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}


function year_bian_facility_chart($facility,$test,$errors,$total,$bian,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$facility.','.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		if($bian==1)
		{
			$startmonth=1;
			$endmonth=6;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';

		}

		else if($bian==2)
		{
			$start=7;
			$endmonth=12;

			for($start;  $start<=$endmonth;  $start++)
		  		{  

			  		$monthname=$this->GetMonthName($start);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=7;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=7;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}

/*====================== facility by biannual End=============================================*/

/*====================== device by biannual==================================================*/

function year_bian_device_tests_chart($device,$test,$total,$bian,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$device.',,'.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		if($bian==1)
		{
			$startmonth=1;
			$endmonth=6;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';

		}

		else if($bian==2)
		{
			$start=7;
			$endmonth=12;

			for($start;  $start<=$endmonth;  $start++)
		  		{  

			  		$monthname=$this->GetMonthName($start);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=7;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=7;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}

	function year_bian_device_errors_chart($device,$errors,$total,$bian,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$device.','.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		if($bian==1)
		{
			$startmonth=1;
			$endmonth=6;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';

		}

		else if($bian==2)
		{
			$start=7;
			$endmonth=12;

			for($start;  $start<=$endmonth;  $start++)
		  		{  

			  		$monthname=$this->GetMonthName($start);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=7;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=7;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}


	function year_bian_device_chart($device,$test,$errors,$total,$bian,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$device.','.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		if($bian==1)
		{
			$startmonth=1;
			$endmonth=6;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';

		}

		else if($bian==2)
		{
			$start=7;
			$endmonth=12;

			for($start;  $start<=$endmonth;  $start++)
		  		{  

			  		$monthname=$this->GetMonthName($start);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=7;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=7;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}
/*====================== device by biannual End=============================================*/

/*====================== All by biannual End===============================================*/

function year_bian_all_tests_chart($test,$total,$bian,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="Chart for all data,'.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		if($bian==1)
		{
			$startmonth=1;
			$endmonth=6;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';

		}

		else if($bian==2)
		{
			$start=7;
			$endmonth=12;

			for($start;  $start<=$endmonth;  $start++)
		  		{  

			  		$monthname=$this->GetMonthName($start);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=7;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=7;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}

	function year_bian_all_errors_chart($errors,$total,$bian,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="Chart for all data,'.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		if($bian==1)
		{
			$startmonth=1;
			$endmonth=6;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';

		}

		else if($bian==2)
		{
			$start=7;
			$endmonth=12;

			for($start;  $start<=$endmonth;  $start++)
		  		{  

			  		$monthname=$this->GetMonthName($start);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=7;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=7;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}


	function year_bian_all_chart($test,$errors,$total,$bian,$the_year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="Chart for all data,'.$the_year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		if($bian==1)
		{
			$startmonth=1;
			$endmonth=6;

			for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
		  		{  

			  		$monthname=$this->GetMonthName($startmonth);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';

		}

		else if($bian==2)
		{
			$start=7;
			$endmonth=12;

			for($start;  $start<=$endmonth;  $start++)
		  		{  

			  		$monthname=$this->GetMonthName($start);

					$Chart.="<category label='$monthname'/>";

				}
			$Chart.= '</categories>';
			$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
			for ( $startmonth=7;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$total'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
			for ( $startmonth=1;$startmonth< 7;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$test'/>";

				  	}
			$Chart.= '</dataset>';

			$Chart.= '<dataset seriesName="Tests with Errors" color="FF00000" >';
			for ($startmonth=7;$startmonth< 13;  $startmonth++)
			  		{ 
				  		$Chart.= "<set value='$errors'/>";

				  	}
			$Chart.= '</dataset>';
		}
		
		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}

/*====================== All by biannual End===============================================*/

/*====================== facility by year==================================================*/

	function yearly_facility_tests_chart($facility,$test,$total,$year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$facility.','.$year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		$startmonth=1;
		$endmonth=12;

		for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
	  		{  

		  		$monthname=$this->GetMonthName($startmonth);

				$Chart.="<category label='$monthname'/>";

			}
		$Chart.= '</categories>';
		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$total'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$test'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}
	function yearly_facility_errors_chart($facility,$errors,$total,$year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$facility.','.$year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		$startmonth=1;
		$endmonth=12;

		for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
	  		{  

		  		$monthname=$this->GetMonthName($startmonth);

				$Chart.="<category label='$monthname'/>";

			}
		$Chart.= '</categories>';
		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$total'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Tests with Errors" color="FF0000" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$errors'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}

	function yearly_facility_chart($facility,$test,$errors,$total,$year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$facility.','.$year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		$startmonth=1;
		$endmonth=12;

		for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
	  		{  

		  		$monthname=$this->GetMonthName($startmonth);

				$Chart.="<category label='$monthname'/>";

			}
		$Chart.= '</categories>';
		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$total'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$test'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Tests with Errors" color="FF0000" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$errors'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}

/*====================== facility by year End==============================================*/

/*====================== device by year ==================================================*/

	function yearly_device_tests_chart($device,$test,$total,$year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$device.','.$year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		$startmonth=1;
		$endmonth=12;

		for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
	  		{  

		  		$monthname=$this->GetMonthName($startmonth);

				$Chart.="<category label='$monthname'/>";

			}
		$Chart.= '</categories>';
		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$total'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$test'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}

	function yearly_device_errors_chart($device,$errors,$total,$year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$device.','.$year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		$startmonth=1;
		$endmonth=12;

		for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
	  		{  

		  		$monthname=$this->GetMonthName($startmonth);

				$Chart.="<category label='$monthname'/>";

			}
		$Chart.= '</categories>';
		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$total'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Tests with Errors" color="FF0000" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$errors'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}
	function yearly_device_chart($device,$test,$errors,$total,$year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$device.','.$year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		$startmonth=1;
		$endmonth=12;

		for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
	  		{  

		  		$monthname=$this->GetMonthName($startmonth);

				$Chart.="<category label='$monthname'/>";

			}
		$Chart.= '</categories>';
		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$total'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$test'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Tests with Errors" color="FF0000" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$errors'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}

/*====================== device by year End ===============================================*/

/*====================== All by year ======================================================*/

	function yearly_all_tests_chart($test,$total,$year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="Chart for all data - Successful Tests,'.$year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		$startmonth=1;
		$endmonth=12;

		for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
	  		{  

		  		$monthname=$this->GetMonthName($startmonth);

				$Chart.="<category label='$monthname'/>";

			}
		$Chart.= '</categories>';
		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$total'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$test'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}
	function yearly_all_errors_chart($errors,$total,$year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="Chart for all data - Errors,'.$year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		$startmonth=1;
		$endmonth=12;

		for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
	  		{  

		  		$monthname=$this->GetMonthName($startmonth);

				$Chart.="<category label='$monthname'/>";

			}
		$Chart.= '</categories>';
		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$total'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Tests with Errors" color="FF0000" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$errors'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}
	function yearly_all_chart($test,$errors,$total,$year)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="chart for all data,'.$year.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';

		$startmonth=1;
		$endmonth=12;

		for($startmonth;  $startmonth<=$endmonth;  $startmonth++)
	  		{  

		  		$monthname=$this->GetMonthName($startmonth);

				$Chart.="<category label='$monthname'/>";

			}
		$Chart.= '</categories>';
		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$total'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$test'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Tests with Errors" color="FF0000" >';
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
		  		{ 
			  		$Chart.= "<set value='$errors'/>";

			  	}
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;
	}

/*====================== All by year End =================================================*/

/*====================== facility customized dates =======================================*/

function customized_dates_facility_tests_chart($facility,$test,$total,$from,$to)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$facility.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';
		$Chart.="<category label=' Between $from and $to '/>";
		$Chart.= '</categories>';

		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		$Chart.= "<set value='$total'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
		$Chart.= "<set value='$test'/>";
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;


	}


	function customized_dates_facility_errors_chart($facility,$errors,$total,$from,$to)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$facility.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';
		$Chart.="<category label=' Between $from and $to '/>";
		$Chart.= '</categories>';

		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		$Chart.= "<set value='$total'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Tests with Errors" color="FF0000" >';
		$Chart.= "<set value='$errors'/>";
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;


	}

	function customized_dates_facility_chart($facility,$test,$errors,$total,$from,$to)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$facility.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';
		$Chart.="<category label=' Between $from and $to '/>";
		$Chart.= '</categories>';

		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		$Chart.= "<set value='$total'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
		$Chart.= "<set value='$test'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Tests with Errors" color="FF0000" >';
		$Chart.= "<set value='$errors'/>";
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;


	}

/*====================== facility customized dates End ===================================*/

/*====================== device customized dates =========================================*/

	function customized_dates_device_tests_chart($device,$test,$total,$from,$to)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$device.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';
		$Chart.="<category label=' Between $from and $to '/>";
		$Chart.= '</categories>';

		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		$Chart.= "<set value='$total'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
		$Chart.= "<set value='$test'/>";
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;


	}


	function customized_dates_device_errors_chart($device,$errors,$total,$from,$to)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$device.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';
		$Chart.="<category label=' Between $from and $to '/>";
		$Chart.= '</categories>';

		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		$Chart.= "<set value='$total'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Tests with Errors" color="FF0000" >';
		$Chart.= "<set value='$errors'/>";
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;


	}

	function customized_dates_device_chart($device,$test,$errors,$total,$from,$to)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="'.$device.'" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';
		$Chart.="<category label=' Between $from and $to '/>";
		$Chart.= '</categories>';

		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		$Chart.= "<set value='$total'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
		$Chart.= "<set value='$test'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Tests with Errors" color="FF0000" >';
		$Chart.= "<set value='$errors'/>";
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;


	}
/*====================== device customized dates End =====================================*/

/*====================== all customized dates ===========================================*/

function customized_dates_all_tests_chart($test,$total,$from,$to)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="Chart for all tests" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';
		$Chart.="<category label=' Between $from and $to '/>";
		$Chart.= '</categories>';

		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		$Chart.= "<set value='$total'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
		$Chart.= "<set value='$test'/>";
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;


	}


	function customized_dates_all_errors_chart($errors,$total,$from,$to)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="Chart for all tests" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';
		$Chart.="<category label=' Between $from and $to '/>";
		$Chart.= '</categories>';

		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		$Chart.= "<set value='$total'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Tests with Errors" color="FF0000" >';
		$Chart.= "<set value='$errors'/>";
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;


	}

	function customized_dates_all_chart($test,$errors,$total,$from,$to)
	{
		$Chart="";

		$export_handler='http://export.api3.fusioncharts.com/';

		$Chart.='<chart yAxisName="Tests" xAxisName="Chart for all tests" exportHandler="'.$export_handler.'" exportEnabled="1" exportAtClient="1" exportFileName="CD4 Chart">';
		$Chart.='<categories>';
		$Chart.="<category label=' Between $from and $to '/>";
		$Chart.= '</categories>';

		$Chart.= '<dataset seriesName="Tests Done" color="A666EDD" >';
		$Chart.= "<set value='$total'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Successful Tests" color="006600" >';
		$Chart.= "<set value='$test'/>";
		$Chart.= '</dataset>';

		$Chart.= '<dataset seriesName="Tests with Errors" color="FF0000" >';
		$Chart.= "<set value='$errors'/>";
		$Chart.= '</dataset>';

		$Chart.='<styles>
							<definition>
								<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
								<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
								<style name="DataShadow" type="Shadow" alpha="40"/>
							</definition>
							-
							<application>
								<apply toObject="DIVLINES" styles="Anim1"/>
								<apply toObject="HGRID" styles="Anim2"/>
								<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
							</application>
						</styles>
						</chart>';
		return $Chart;


	}

/*====================== all customized dates End =======================================*/

public function GetMonthName($month)
		{
			 if ($month==1)
			 {
			     $monthname=" Jan ";
			 }
			  else if ($month==2)
			 {
			     $monthname=" Feb ";
			 }else if ($month==3)
			 {
			     $monthname=" Mar ";
			 }else if ($month==4)
			 {
			     $monthname=" Apr ";
			 }else if ($month==5)
			 {
			     $monthname=" May ";
			 }else if ($month==6)
			 {
			     $monthname=" Jun ";
			 }else if ($month==7)
			 {
			     $monthname=" Jul ";
			 }else if ($month==8)
			 {
			     $monthname=" Aug ";
			 }else if ($month==9)
			 {
			     $monthname=" Sep ";
			 }else if ($month==10)
			 {
			     $monthname=" Oct ";
			 }else if ($month==11)
			 {
			     $monthname=" Nov ";
			 }
			  else if ($month==12)
			 {
			     $monthname=" Dec ";
			 }
			  else if ($month==13)
			 {
			     $monthname=" Jan - Sep  ";
			 }
		return $monthname;
		}
}	