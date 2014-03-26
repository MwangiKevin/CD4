<?php
class charts_model extends MY_Model{
	public function yearly_device_test_trends($year){
		$sql	=	"SELECT 	MONTH(`result_date`) as month, 
								count(MONTH(`result_date`)) as tests 
							FROM `pima_test` WHERE `error_id`=0 
							AND year(result_date)= $year 
							Group By month 
							ORDER BY month ASC";

		$trends 	=	R::getAll($sql);

		$trends_array 	=	array();
		$month 	=	array();
		$tests 	=	array();

		for($i=1;$i<=12;$i++){
			$month[$i]	=	$this->getMonthName($i);
			$tests[$i]	=	0;//initialize

			foreach ($trends as $monthly) {
				if($monthly['month']==$i){
					$tests[$i]	= $monthly['tests'];
				}
			}
			array_push($trends_array,array(
											'month' => $month[$i],
											'tests'	=> $tests[$i]
											));
		}

		$json_chart				= 	array();
		$json_header 			= 	$this->config->item("chart_header");
		$json_footer 			= 	$this->config->item("line_graph_style");
		$json_categories		= 	array();
		$json_category			= 	array();
		$json_dataset_pima		=	array();
		$json_data_pima_tests	=	array();

		$json_header['chart']['yAxisName']  = "Tests";

		//populate category
		foreach ($trends_array as $trend) {
			array_push($json_category,	array( "label" => $trend['month']));			
		}
		$json_categories		=	array(
										"categories"=> array(
													"category"	=>	$json_category
														)
									);

		//populate data
		foreach ($trends_array as $trend) {
			array_push($json_data_pima_tests,	array( "value" => "".$trend['tests']));			
		}

		$json_dataset_pima	=	array(
									"dataset" =>	array(
													"seriesname"	=>	"PIMA",
													"color"			=>	"A66EDD",
													"data"		=>	$json_data_pima_tests
												)
								);
		$json_chart		=	array(
								'chart'			=>	$json_header['chart'],
								'categories'	=>	$json_categories['categories'],
								'dataset'		=>	$json_dataset_pima['dataset'],
								'styles'		=>	$json_footer['styles']
								);


		$r= json_encode($json_chart);
		return $r;
	}
	public function yearly_device_test_perc($year){
		$sql		=	"SELECT `pimas`.`tests` AS pima_tests,
								`other`.`tests` AS other_tests 
							FROM 
							(SELECT count(*) AS tests FROM `pima_test` 
								WHERE `error_id` = 0 
								AND year(result_date)= $year
							) AS `pimas`,
							(SELECT count(*) AS tests FROM `pima_test` 
								WHERE `error_id` = -1 									
								AND year(result_date)= $year
							) AS `other`
						";    //  -1 hypothetical null

		$tests 	=		R::getAll($sql);

		$json_chart				= 	array();
		$json_header 			= 	$this->config->item("chart_header");
		$json_footer 			= 	$this->config->item("pie_chart_style");

		$data 	=		array(
								array(
										"label" 		=>	"PIMA",
										"value"			=>	"".$tests[0]["pima_tests"],
										"issliced"		=>	"0",
										"color"			=>	"0372AB"
									),
								array(
										"label" 		=>	"OTHER",
										"value"			=>	"".$tests[0]["other_tests"],
										"issliced"		=>	"1",
										"color"			=>	"FF0000"
									)
							);
		$json_chart		=	array(
								'chart'			=>	$json_header['chart'],
								'data'			=>	$data,								
								'styles'		=>	$json_footer['styles']
								);
		$r= json_encode($json_chart);
		return $r;
	}
	public function periodic_device_test_perc($from,$to){

		$date_delimiter	 	=	"";
		
		if(!$from==""||!$from==0||!$from==null){
			$date_delimiter	=	" AND `pima_test`.`result_date` between '$from' and '$to' ";
		}
		$sql		=	"SELECT `pimas`.`tests` AS pima_tests,
								`other`.`tests` AS other_tests 
							FROM 
							(SELECT count(*) AS tests FROM `pima_test` 
								WHERE `error_id` = 0 
								$date_delimiter
							) AS `pimas`,
							(SELECT count(*) AS tests FROM `pima_test` 
								WHERE `error_id` = -1 									
								$date_delimiter
							) AS `other`
						";    //  -1 hypothetical null

		$tests 	=		R::getAll($sql);

		$json_chart				= 	array();
		$json_header 			= 	$this->config->item("chart_header");
		$json_footer 			= 	$this->config->item("pie_chart_style");

		$data 	=		array(
								array(
										"label" 		=>	"PIMA",
										"value"			=>	"".$tests[0]["pima_tests"],
										"issliced"		=>	"0",
										"color"			=>	"0372AB"
									),
								array(
										"label" 		=>	"OTHER",
										"value"			=>	"".$tests[0]["other_tests"],
										"issliced"		=>	"1",
										"color"			=>	"FF0000"
									)
							);
		$json_chart		=	array(
								'chart'			=>	$json_header['chart'],
								'data'			=>	$data,								
								'styles'		=>	$json_footer['styles']
								);
		$r= json_encode($json_chart);
		return $r;
	}
}