<?php

class home_page_model extends MY_Model{
	public function devices_tests_totals($from,$to){

		$date_delimiter	 	=	"";

		/**
		*PIMA		
		*/

		//if date is set
		if(!$from==""||!$from==0||!$from==null){
			$date_delimiter	=	" AND `pima_test`.`result_date` between '$from' and '$to' ";
		}

		$pima_test_sql	=	"SELECT `totals_res`.`totals` ,
									`fails_res`.`fails`,
									`success_res`.`success` FROM 
							(SELECT count(*) as `totals`
								FROM  `pima_test` 
								WHERE  1 
								AND  `pima_test`.`error_id` = 0   
								$date_delimiter 
							) as `totals_res`,
							(SELECT count(*) as `fails`
								FROM  `pima_test` 
								WHERE  `pima_test`.`cd4_count` < 350  
								AND  `pima_test`.`error_id` = 0 
								$date_delimiter 
							) as `fails_res`,
							(SELECT count(*) as `success`
							    FROM  `pima_test` 
							    WHERE  `pima_test`.`cd4_count` = 350 OR `pima_test`.`cd4_count`> 350  
							    AND  `pima_test`.`error_id` = 0
							    $date_delimiter 
							) as `success_res`
							";
		$pima_test_res	=	R::getAll($pima_test_sql);

		//catching division by zero error
		if($pima_test_res[0]['totals']==0){
			$pima_perc_fails	= 0 ;
		}else{
			$pima_perc_fails =(($pima_test_res[0]['fails']/$pima_test_res[0]['totals'])*100);
		}
		$pima_array		=	array(	
									'title'		=>	'PIMA',
									'totals'	=>	$pima_test_res[0]['totals'],
									'fails'		=>	$pima_test_res[0]['fails'],
									'success'	=>	$pima_test_res[0]['success'],
									'perc_fails'=>	$pima_perc_fails." %"
								);
		/**
		*OTHER
		*/
		$other_test_array	= array(	
									'title'		=>	'Other',
									'totals'	=>	0,
									'fails'		=>	0,
									'success'	=>	0,
									'perc_fails'=>	"0 %"
								);
		/**
		*Totals
		*/
		$total_totals		=	$pima_array['totals']	+	$other_test_array['totals'];
		$total_fails		=	$pima_array['fails']	+	$other_test_array['fails'];
		$total_success		=	$pima_array['success']	+	$other_test_array['success'];		

		//catching division by zero error
		if($total_totals==0){
			$total_perc_fails	= 0 ;
		}else{
			$total_perc_fails =(($total_fails/$total_totals)*100);
		}
		$total_test_array	= array(	
									'title'		=>	'Totals',
									'totals'	=>	$total_totals,
									'success'	=>	$total_success,
									'perc_fails'=>	$total_perc_fails." %",
									'fails'		=>	$total_fails
								);
		//print_r($total_test_array);
		/**
		*Array
		*/
		$devices_tests_totals	=	array($pima_array,$other_test_array,$total_test_array);

		return $devices_tests_totals;
	}
	public function pima_statistics($from,$to){

		$date_delimiter	 	=	"";

		//if date is set
		if(!$from==""||!$from==0||!$from==null){
			$date_delimiter	=	"AND `pima_test`.`result_date` between '$from' and '$to'";
		}

		$pima_test_sql	=	"SELECT `totals_res`.`totals` ,
									`fails_res`.`fails`,
									`success_res`.`success`,
									`errors_res`.`errors`FROM 
							(SELECT count(*) as `totals`
								FROM  `pima_test` 
								WHERE  1   
								AND  `pima_test`.`error_id` = 0 
								$date_delimiter 
							) as `totals_res`,
							(SELECT count(*) as `fails`
								FROM  `pima_test` 
								WHERE  `pima_test`.`cd4_count` < 350  
								AND  `pima_test`.`error_id` = 0 
								$date_delimiter 
							) as `fails_res`,
							(SELECT count(*) as `success`
							    FROM  `pima_test` 
							    WHERE  `pima_test`.`cd4_count` = 350 OR `pima_test`.`cd4_count`> 350  
							    AND  `pima_test`.`error_id` = 0 
							    $date_delimiter 
							) as `success_res`,
							(SELECT count(*) as `errors`
								FROM  `pima_test` 
								WHERE `pima_test`.`error_id` > 0 
								$date_delimiter 
							) as `errors_res`
							";
		$pima_test_res	=	R::getAll($pima_test_sql);

		//catching division by zero error
		if($pima_test_res[0]['totals']==0){
			$pima_perc_fails	= 0 ;
		}else{
			$pima_perc_fails =(($pima_test_res[0]['fails']/$pima_test_res[0]['totals'])*100);
		}
		$pima_array		=	array(	
									array(
										'caption'	=>	"# of CD4 Tests Performed",
										'data'		=>	$pima_test_res[0]['totals']
										),
									array(
										'caption'	=>	"CD4 Tests < 350 cells/mm3",
										'data'		=>	$pima_test_res[0]['fails']
										),
									array(
										'caption'	=>	"CD4 Tests > 350 cells/mm3",
										'data'		=>	$pima_test_res[0]['success']
										),
									array(
										'caption'	=>	"# of Failed/error Tests",
										'data'		=>	$pima_test_res[0]['errors']
										),
									array(
										'caption'	=>	"# of Devices Reported during last upload",
										'data'		=>	""
										),
									array(
										'caption'	=>	"% Reporting",
										'data'		=>	""
										)
								);
		return $pima_array;
	}
}