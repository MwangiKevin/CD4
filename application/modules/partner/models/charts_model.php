<?php
class charts_model extends MY_Model{
	public function yearly_device_test_trends($year){
		$trends_sql	=	"SELECT 	
								`equipment`.`description` as device,
								MONTH(`result_date`) as month, 
								count(MONTH(`result_date`)) as tests 
							FROM `cd4_test` 
							RIGHT JOIN `equipment` 
								ON `equipment`.`id`=`cd4_test`.`equipment_id`
							WHERE `valid`=1 
							AND year(result_date)= $year 
							Group By month,`equipment`.`description` 
							ORDER BY month ASC";

		$devices_sql=	"SELECT 	`description` 
							FROM `equipment` 
							WHERE `category`=1 
							AND `status`=1";

		$trends 	=	R::getAll($trends_sql);
		$devices 	=	R::getAll($devices_sql);

		$trends_array 	=	array();
		$month 			=	array();
		$tests 			=	array();


		

		

		$json_chart				= 	array();
		$json_header 			= 	$this->config->item("chart_header");
		$json_footer 			= 	$this->config->item("line_graph_style");
		$json_categories		= 	array();
		$json_category			= 	array();
		$json_dataset			=	array();

		$json_header['chart']['yAxisName']  = "Tests";

		$j=0;
		for ($i=0; $i < 12; $i++) { 
			$json_category[$i]['label'] =	$this->get_month_name($i+1);
		}
		foreach($devices as $device){
			$tests[$j]['seriesname']=$device['description'];
			$tests[$j]['data']	=	array();//initialize data
			for($i=1;$i<=12;$i++){
				$tests[$j]['data'][$i-1]['value']	=	0;//initialize data				
			}
			for($i=1;$i<=12;$i++){
				foreach ($trends as $trend) {
					if($device['description']==$trend['device'] && $i ==$trend['month']){
						$tests[$j]['data'][$i-1]['value']	= $trend['tests'];
					}
				}
			}
			$j++;
		}
		//populate category
		foreach ($trends_array as $trend) {
			array_push($json_category,	array( "label" => $trend['month']));			
		}
		$json_categories		=	array(
										"categories"=> array(
													"category"	=>	$json_category
														)
									);

		

		$json_dataset	=	array(
									"dataset" => $tests	
									);
		$json_chart		=	array(
								'chart'			=>	$json_header['chart'],
								'categories'	=>	$json_categories['categories'],
								'dataset'		=>	$json_dataset['dataset'],
								'styles'		=>	$json_footer['styles']
								);


		$r 	= json_encode($json_chart);
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
	public function yearly_device_reporting_trends($year){ 
		
		$json_header 			= 	$this->config->item("chart_header");
		$json_footer 			= 	$this->config->item("line_graph_style");
		$json_categories		= 	array();
		$json_category			= 	array();
		

		$json_header['chart']['yAxisName']  = "Devices";

		
		$json_categories		=	array(
										"categories"=> array(
													"category"	=>	$this->month_categories()
														)
									);

		

		$json_dataset_pima	=	array(
									"dataset" =>	array(
													"seriesname"	=>	"Expected Reporting Devices",
													"color"			=>	"A66EDD",
													"data"		=>	$this->expected_reporting_dev_array($year)
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
	public function periodic_test_error_perc($from,$to){
		$date_delimiter	 	=	"";
		
		if(!$from==""||!$from==0||!$from==null){
			$date_delimiter	=	" AND `cd4_test`.`result_date` between '$from' and '$to' ";
		}
		$sql		=	"SELECT 
								`test`.`total` AS `test_total`, 
								`error`.`total` AS `error_total` 
							FROM (SELECT 
							          	count(*) AS `total` 
							          	FROM `pima_test` 
							          RIGHT JOIN `cd4_test`
							          ON `pima_test`.`cd4_test_id`=`cd4_test`.`id` 
							          WHERE `error_id` = 0 
							          $date_delimiter
						          AND `cd4_test`.`result_date` between '2012-12-21' and '2013-12-21'
						         ) AS `test`, 
								(SELECT 
							          	count(*) AS `total` 
							          	FROM `pima_test` 
							          RIGHT JOIN `cd4_test`
							          ON `pima_test`.`cd4_test_id`=`cd4_test`.`id` 
							          WHERE `error_id` > 0 
							          $date_delimiter
							          AND `cd4_test`.`result_date` between '2012-12-21' and '2013-12-21'         
						        ) AS `error`
						"; 
		$tests 	=		R::getAll($sql);

		
		$json_chart				= 	array();
		$json_header 			= 	$this->config->item("chart_header");
		$json_footer 			= 	$this->config->item("pie_chart_style");

		$data 	=		array(
								array(
										"label" 		=>	"Successful Tests",
										"value"			=>	"".$tests[0]["test_total"],
										"issliced"		=>	"0",
										"color"			=>	"0372AB"
									),
								array(
										"label" 		=>	"Errors",
										"value"			=>	"".$tests[0]["error_total"],
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
	public function yearly_facility_pima_reporting_rates($year){ 
		
		$json_header 			= 	$this->config->item("chart_header");
		$json_footer 			= 	$this->config->item("line_graph_style");
		$json_categories		= 	array();
		$json_category			= 	array();
		

		$json_header['chart']['yAxisName']  = "Devices";

		
		$json_categories		=	array(
										"categories"=> array(
													"category"	=>	$this->month_categories()
														)
									);

		

		$json_dataset_pima	=	array(
									"dataset" =>	array(
														
														"seriesname"	=>	"Expected Reporting Pima Devices",
														"color"			=>	"A66EDD",
														"data"		=>	$this->expected_reporting_pima_array($year)
														
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
	public function periodic_facility_pima_errors($from,$to){
		$date_delimiter	 	=	"";
		
		if(!$from==""||!$from==0||!$from==null){
			$date_delimiter	=	" WHERE `cd4_test`.`result_date` between '$from' and '$to' ";
		}

		$sql =	"SELECT 
						`pima_error`.`error_code`, 
						`pima_error`.`error_detail`, 
						COUNT(`pima_test`.`error_id`) as `total` 
					FROM `pima_error` 
					LEFT JOIN `pima_test` 
					ON `pima_test`.`error_id`=`pima_error`.`id` 	
						LEFT JOIN `cd4_test`
						ON `pima_test`.`cd4_test_id`=`cd4_test`.`id` 
						$date_delimiter 
					GROUP BY `error_code`";
		//echo $sql;
		$errors_reporteds_assoc 	=	R::getAll($sql);
		//print_r($errors_reporteds_assoc);
		$data 		=		array();

		foreach ($errors_reporteds_assoc as $error) {
			array_push($data,array('label'=>$error['error_code'], 'value' => "".$error['total']));
		}
		$json_chart				= 	array();
		$json_header 			= 	$this->config->item("chart_header");
		$json_footer 			= 	$this->config->item("pie_chart_style");

		$json_header['chart']['yAxisName']  = "Error Frequency";
		$json_header['chart']['xAxisName']  = "Error codes";

		$json_chart		=	array(
								'chart'			=>	$json_header['chart'],
								'data'			=>	$data,								
								'styles'		=>	$json_footer['styles']
								);
		$r= json_encode($json_chart);
		return $r;
	}
	public function yearly_test_reporting_rates($year){
		$json_header 			= 	$this->config->item("chart_header");
		$json_footer 			= 	$this->config->item("line_graph_style");
		$json_categories		= 	array();
		$json_category			= 	array();

		$json_header['chart']['yAxisName']  = "Devices";

		
		$json_categories		=	array(
										"categories"=> array(
													"category"	=>	$this->month_categories()
														)
									);

		
		$data = array();
		array_push($data, array("seriesname"	=>	"Pima Tests",
								"color"			=>	"A66EDD",
								"data"			=>	$this->yearly_pima_result_trend($year)));


		array_push($data, array("seriesname"	=>	"Pima Errors",
								"color"			=>	"F6BD0F",
								"data"			=>	$this->yearly_pima_errors_trend($year)));

		$json_dataset_pima	=	array(
									"dataset" =>	$data
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
	private function expected_reporting_dev_array($year){
		$sql_added	=	"SELECT
								`t1`.`date_added` as `rank_date`,
								`t1`.`yearmonth`,
								`t1`.`month`, 
								`t1`.`rolledout`, 
								SUM(`t2`.`rolledout`) AS `cumulative`
							FROM
								(SELECT 	CONCAT(YEAR(`date_added`),'-',MONTH(`date_added`)) AS `yearmonth`,
                                 			`date_added`, 
											MONTH(`date_added`) AS `month`,
											COUNT(*) AS `rolledout` 			
										FROM `facility_equipment` 		 
										WHERE `date_added` <> '0000-00-00'
										GROUP BY `yearmonth`) AS `t1` 
							INNER JOIN 
								(SELECT 	CONCAT(YEAR(`date_added`),'-',MONTH(`date_added`)) AS `yearmonth`,
                                 			`date_added`, 
											MONTH(`date_added`) AS `month`,
											COUNT(*) AS `rolledout` 			
										FROM `facility_equipment` 		 
										WHERE `date_added` <> '0000-00-00'
										GROUP BY `yearmonth`) AS `t2` 
							ON `t1`.`date_added` >= `t2`.`date_added` 
							group by `t1`.`date_added`";
		$sql_removed	="SELECT 
									`t1`.`date_removed` as `rank_date`,
									`t1`.`yearmonth`,
									`t1`.`month`, 
									`t1`.`removed`, 
									SUM(`t2`.`removed`) AS `cumulative`
								FROM
									(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
												`date_removed`, 
												MONTH(`date_removed`) AS `month`,
												COUNT(*) AS `removed` 			
											FROM `facility_equipment` 		 
											WHERE `date_removed` <> '0000-00-00'
											GROUP BY `yearmonth`) AS `t1` 
								INNER JOIN 
									(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
												`date_removed`, 
												MONTH(`date_removed`) AS `month`,
												COUNT(*) AS `removed` 			
											FROM `facility_equipment` 		 
											WHERE `date_removed` <> '0000-00-00'
											GROUP BY `yearmonth`) AS `t2` 
								ON `t1`.`date_removed` >= `t2`.`date_removed` 
								
								group by `t1`.`date_removed`";

		$devices_added_assoc 	=	R::getAll($sql_added);
		$devices_removed_assoc 	=	R::getAll($sql_removed);

		$devices_added_array	=	array();	
		$devices_removed_array	=	array();

		$consolidated_array		=	array();
		// monthly arrays
			//initialize $devices_added_array[0]['cumulative']
		$a=1;
		foreach ($devices_added_assoc as $added) {
			if($added['yearmonth']==($year-1)."-".$a){
				$devices_added_array[0]['cumulative'] =$added['cumulative'];
			}else{
				$devices_added_array[0]['cumulative'] =0;
			}
		}			
		//first cummulative gotten
		$first	=	null;
		for($i=1;$i<=12;$i++){
			$devices_added_array[$i]['month']		=	$this->get_month_name($i);
			$devices_added_array[$i]['rolledout']	=	0;
			$devices_added_array[$i]['cumulative']	=	$devices_added_array[($i-1)]['cumulative'];
			foreach ($devices_added_assoc as $added) {
				if(is_null($first)){$first	=	$added['cumulative'];}
				if($i==$added['month'] && $added['yearmonth']==$year."-".$i){
					$devices_added_array[$i]['rolledout']	=	$added['rolledout'];
					$devices_added_array[$i]['cumulative']	=	$added['cumulative'];
				}
			}
		}

		$a=1;
		foreach ($devices_removed_assoc as $removed) {
			if($removed['yearmonth']==($year-1)."-".$a){
				$devices_removed_array[0]['cumulative'] =$removed['cumulative'];
			}else{
				$devices_removed_array[0]['cumulative'] =0;
			}
		}			
		//first cummulative gotten
		$first	=	null;
		for($i=1;$i<=12;$i++){
			$devices_removed_array[$i]['month']			=	$this->get_month_name($i);
			$devices_removed_array[$i]['removed']		=	0;
			$devices_removed_array[$i]['cumulative']	=	$devices_removed_array[($i-1)]['cumulative'];
			foreach ($devices_removed_assoc as $removed) {
				if(is_null($first)){$first	=	$removed['cumulative'];}
				if($i==$removed['month'] && $removed['yearmonth']==$year."-".$i){
					$devices_removed_array[$i]['removed']	=	$removed['removed'];
					$devices_removed_array[$i]['cumulative']	=	$removed['cumulative'];
				}
			}
		}

		//consolidate added and removed
		$data 	= array();

		for($i=1;$i<=12;$i++) {
			$consolidated_array[$i]['month']		=	$this->get_month_name($i);
			$consolidated_array[$i]['rolledout']	=	$devices_added_array[$i]['rolledout'];
			$consolidated_array[$i]['removed']		=	$devices_removed_array[$i]['removed'];
			$consolidated_array[$i]['consolidated']	=	($devices_added_array[$i]['cumulative']-$devices_removed_array[$i]['cumulative']);
			array_push($data, array('value'=>$consolidated_array[$i]['consolidated']));
		}
		
		return $data;
	}
	private function expected_reporting_pima_array($year){
		$sql_added	=	"SELECT
								`t1`.`date_added` as `rank_date`,
								`t1`.`yearmonth`,
								`t1`.`month`, 
								`t1`.`rolledout`, 
								SUM(`t2`.`rolledout`) AS `cumulative`
							FROM
								(SELECT 	CONCAT(YEAR(`date_added`),'-',MONTH(`date_added`)) AS `yearmonth`,
                                 			`date_added`, 
											MONTH(`date_added`) AS `month`,
											COUNT(*) AS `rolledout` 			
										FROM `facility_equipment` 		 
										WHERE `date_added` <> '0000-00-00' 
										AND `equipment_id`= 4 
										GROUP BY `yearmonth`) AS `t1` 
							INNER JOIN 
								(SELECT 	CONCAT(YEAR(`date_added`),'-',MONTH(`date_added`)) AS `yearmonth`,
                                 			`date_added`, 
											MONTH(`date_added`) AS `month`,
											COUNT(*) AS `rolledout` 			
										FROM `facility_equipment` 		 
										WHERE `date_added` <> '0000-00-00' 
										AND `equipment_id`= 4 
										GROUP BY `yearmonth`) AS `t2` 
							ON `t1`.`date_added` >= `t2`.`date_added` 
							group by `t1`.`date_added`";
		$sql_removed	="SELECT 
									`t1`.`date_removed` as `rank_date`,
									`t1`.`yearmonth`,
									`t1`.`month`, 
									`t1`.`removed`, 
									SUM(`t2`.`removed`) AS `cumulative`
								FROM
									(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
												`date_removed`, 
												MONTH(`date_removed`) AS `month`,
												COUNT(*) AS `removed` 			
											FROM `facility_equipment` 		 
											WHERE `date_removed` <> '0000-00-00' 
											AND `equipment_id`= 4 
											GROUP BY `yearmonth`) AS `t1` 
								INNER JOIN 
									(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
												`date_removed`, 
												MONTH(`date_removed`) AS `month`,
												COUNT(*) AS `removed` 			
											FROM `facility_equipment` 		 
											WHERE `date_removed` <> '0000-00-00' 
											AND `equipment_id`= 4 
											GROUP BY `yearmonth`) AS `t2` 
								ON `t1`.`date_removed` >= `t2`.`date_removed` 
								
								group by `t1`.`date_removed`";

		$devices_added_assoc 	=	R::getAll($sql_added);
		$devices_removed_assoc 	=	R::getAll($sql_removed);

		$devices_added_array	=	array();	
		$devices_removed_array	=	array();

		$consolidated_array		=	array();
		// monthly arrays
			//initialize $devices_added_array[0]['cumulative']
		$a=1;
		foreach ($devices_added_assoc as $added) {
			if($added['yearmonth']==($year-1)."-".$a){
				$devices_added_array[0]['cumulative'] =$added['cumulative'];
			}else{
				$devices_added_array[0]['cumulative'] =0;
			}
			$a++;
		}			
		//first cummulative gotten
		$first	=	null;
		for($i=1;$i<=12;$i++){
			$devices_added_array[$i]['month']		=	$this->get_month_name($i);
			$devices_added_array[$i]['rolledout']	=	0;
			$devices_added_array[$i]['cumulative']	=	$devices_added_array[($i-1)]['cumulative'];
			foreach ($devices_added_assoc as $added) {
				if(is_null($first)){$first	=	$added['cumulative'];}
				if($i==$added['month'] && $added['yearmonth']==$year."-".$i){
					$devices_added_array[$i]['rolledout']	=	$added['rolledout'];
					$devices_added_array[$i]['cumulative']	=	$added['cumulative'];
				}
			}
		}

		$a=1;
		foreach ($devices_removed_assoc as $removed) {
			if($removed['yearmonth']==($year-1)."-".$a){
				$devices_removed_array[0]['cumulative'] =$removed['cumulative'];
			}else{
				$devices_removed_array[0]['cumulative'] =0;
			}
		$a++;
		}			
		//first cummulative gotten
		$first	=	null;
		for($i=1;$i<=12;$i++){
			$devices_removed_array[$i]['month']			=	$this->get_month_name($i);
			$devices_removed_array[$i]['removed']		=	0;
			$devices_removed_array[$i]['cumulative']	=	$devices_removed_array[($i-1)]['cumulative'];
			foreach ($devices_removed_assoc as $removed) {
				if(is_null($first)){$first	=	$removed['cumulative'];}
				if($i==$removed['month'] && $removed['yearmonth']==$year."-".$i){
					$devices_removed_array[$i]['removed']	=	$removed['removed'];
					$devices_removed_array[$i]['cumulative']	=	$removed['cumulative'];
				}
			}
		}

		//consolidate added and removed
		$data 	= array();

		for($i=1;$i<=12;$i++) {
			$consolidated_array[$i]['month']		=	$this->get_month_name($i);
			$consolidated_array[$i]['rolledout']	=	$devices_added_array[$i]['rolledout'];
			$consolidated_array[$i]['removed']		=	$devices_removed_array[$i]['removed'];
			$consolidated_array[$i]['consolidated']	=	($devices_added_array[$i]['cumulative']-$devices_removed_array[$i]['cumulative']);
			array_push($data, array('value'=>$consolidated_array[$i]['consolidated']));
		}
		
		return $data;
	}
	private function yearly_pima_result_trend($year){

		$sql = "SELECT 
						CONCAT(YEAR(`cd4_test`.`result_date`),'-',MONTH(`cd4_test`.`result_date`)) AS `yearmonth`, 
						`cd4_test`.`result_date`, 
						MONTH(`cd4_test`.`result_date`) AS `month`, 
						COUNT(*) AS `reported` 
					FROM `pima_test` 
					RIGHT JOIN `cd4_test`
						ON `pima_test`.`cd4_test_id`=`cd4_test`.`id`
					WHERE `error_id`= 0 
					AND YEAR(`cd4_test`.`result_date`) = $year  
					GROUP BY `yearmonth`";
		$tests_assoc	=	R::getAll($sql);

		$tests_array	= array();
		
		$data = array();
		for($i=1;$i<=12;$i++){
			$tests_array[$i]['month'] =	$this->get_month_name($i);
			$tests_array[$i]['value'] = 0;

			foreach ($tests_assoc as $test) {
				if($i==$test['month'] && $test['yearmonth']==$year."-".$i){
					$tests_array[$i]['value']	=	$test['reported'];
				}				
			}
			array_push($data, array('value'=>$tests_array[$i]['value']));
		}
		
		return $data;
	}
	private function yearly_pima_errors_trend($year){

		$sql = "SELECT 
						CONCAT(YEAR(`cd4_test`.`result_date`),'-',MONTH(`cd4_test`.`result_date`)) AS `yearmonth`, 
						`cd4_test`.`result_date`, 
						MONTH(`cd4_test`.`result_date`) AS `month`, 
						COUNT(*) AS `errors` 
					FROM `pima_test` 
						LEFT JOIN `cd4_test`
						ON `pima_test`.`cd4_test_id`=`cd4_test`.`id` 
					WHERE `error_id`> 0 
					AND YEAR(`cd4_test`.`result_date`) = $year 
					GROUP BY `yearmonth`";

		$errors_assoc	=	R::getAll($sql);

		$errors_array	= array();
		
		$data = array();
		for($i=1;$i<=12;$i++){
			$errors_array[$i]['month'] =	$this->get_month_name($i);
			$errors_array[$i]['value'] = 0;

			foreach ($errors_assoc as $error) {
				if($i==$error['month'] && $error['yearmonth']==$year."-".$i){
					$errors_array[$i]['value']	=	$error['errors'];
				}				
			}
			array_push($data, array('value'=>$errors_array[$i]['value']));
		}

		return $data;
	}
	private function month_categories(){
		$cat = array();
		for($i=1;$i<=12;$i++){
			array_push($cat, array('label'=>$this->get_month_name($i)));
		}
		return $cat;
	}
	
}