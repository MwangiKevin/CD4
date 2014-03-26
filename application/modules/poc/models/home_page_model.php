<?php

class home_page_model extends MY_Model{
	public function devices_tests_totals($from,$to){

		$date_delimiter	 	=	"";

		//if date is set
		if(!$from==""||!$from==0||!$from==null){
			$date_delimiter	=	"AND `cd4_test`.`result_date` between '$from' and '$to'";
		}

		$sql =	"SELECT 	`success`.`description`,
							(`success`.`total`+`fails`.`total`) AS `total`,
							`success`.`total` AS `success`,
							`fails`.`total` AS `fails`,
							((`fails`.`total`/(`success`.`total`+`fails`.`total`))*100) AS `fails_perc`
						FROM	
						(SELECT `equipment`.`description`,
					            COUNT(`cd4_test`.`cd4_count`)AS `total`
					        FROM `equipment` 
					        LEFT JOIN `cd4_test`
					        ON `cd4_test`.`equipment_id`=`equipment`.`id`
					        AND `cd4_test`.`valid`=1
					        AND `cd4_test`.`cd4_count`>= 350
					        WHERE `equipment`.`status`=1
					        $date_delimiter
					    GROUP BY `equipment`.`description`) AS `success`
					LEFT JOIN 
						    (SELECT `equipment`.`description`,
						            COUNT(`cd4_test`.`cd4_count`)AS `total`
						        FROM `equipment` 
						        LEFT JOIN `cd4_test`
						        ON `cd4_test`.`equipment_id`=`equipment`.`id`
						        AND `cd4_test`.`valid`=1
						        AND `cd4_test`.`cd4_count`< 350
						        WHERE `equipment`.`status`=1
						        $date_delimiter
						    GROUP BY `equipment`.`description`) AS `fails`
						ON `fails`.`description`=`success`.`description` 
					WHERE (`success`.`total`+`fails`.`total`) <> 0
					GROUP BY `success`.`description`
			";
		$stat_assoc	=	R::getAll($sql);
		$total['description']= "Total";
		$total['total']=0;
		$total['success']=0;
		$total['fails']=0;
		

		$i=0;
		foreach ($stat_assoc as $stat) {
			$stat_assoc[$i]['fails_perc']= round($stat['fails_perc'],2)."%";

			$total['total']+=$stat['total'];
			$total['success']+=$stat['success'];
			$total['fails']+=$stat['fails'];
			$i++;			
		}
		if($total['total']>0){
			$total['fails_perc']= round(($total['fails']/$total['total'])*100,2)."%";
		}else{$total['fails_perc']=0;}
		$stat_assoc[]=$total;

		return $stat_assoc;
	}
	
	public function pima_statistics($from,$to){

		$date_delimiter	 	=	"";

		//if date is set
		if(!$from==""||!$from==0||!$from==null){
			$date_delimiter	=	"AND `cd4_test`.`result_date` between '$from' and '$to'";
		}

		$pima_test_sql	=	"SELECT 	`totals_res`.`totals` ,
								        `fails_res`.`fails`,
								        `success_res`.`success`,
								        `errors_res`.`errors`FROM 
								    (SELECT count(*) as `totals`
								        FROM  `pima_test`
								     		LEFT JOIN `cd4_test` 
								     		ON `pima_test`.`cd4_test_id`=`cd4_test`.`id`
								        WHERE  1 
								     	$date_delimiter  
								    ) as `totals_res`,
								    (SELECT count(*) as `fails`
								        FROM  `pima_test` 
								     		LEFT JOIN `cd4_test` 
								     		ON `pima_test`.`cd4_test_id`=`cd4_test`.`id`
								        WHERE  `cd4_test`.`cd4_count` < 350  
								        AND  `pima_test`.`error_id` = 0 
								        $date_delimiter  
								    ) as `fails_res`,
								    (SELECT count(*) as `success`
								        FROM  `pima_test` 
								     		LEFT JOIN `cd4_test` 
								     		ON `pima_test`.`cd4_test_id`=`cd4_test`.`id`
								        WHERE  `cd4_test`.`cd4_count` = 350 OR `cd4_test`.`cd4_count`> 350  
								        AND  `pima_test`.`error_id` = 0 
								        $date_delimiter 
								    ) as `success_res`,
								    (SELECT count(*) as `errors`
								        FROM  `pima_test` 
								     		LEFT JOIN `cd4_test` 
								     		ON `pima_test`.`cd4_test_id`=`cd4_test`.`id`
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
									// array(
									// 	'caption'	=>	"# of Devices Reported during last upload",
									// 	'data'		=>	""
									// 	),
									// array(
									// 	'caption'	=>	"% Reporting",
									// 	'data'		=>	""
									// 	)
								);
		return $pima_array;
	}
	
}

/* End of file home_page_model.php */
/* Location: ./application/modules/poc/models/home_page_model.php */