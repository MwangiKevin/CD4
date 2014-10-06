<?php
class map_model extends MY_Model{

	public function  home_map_data(){


		$sql	=	"SELECT
							`r`.`id` 	AS `region_id`,
							`r`.`name` 	AS `region_name`,
							`r`.`hc_key`,
							SUM(CASE WHEN `e`.`category`= '1'    THEN 1 ELSE 0 END) AS `cd4_equipment`,
							SUM(CASE WHEN `e`.`id`= '4'    THEN 1 ELSE 0 END) AS `pimas`
						FROM `facility_equipment` `f_e`
							LEFT JOIN `equipment` `e`
							ON `f_e`.`equipment_id`=`e`.`id`

							LEFT JOIN `facility` `f`
							ON 	`f_e`.`facility_id` = `f`.`id`
								LEFT JOIN `district` `d`
								ON 	`f`.`district_id` = `d`.`id`
									LEFT JOIN `region` `r`
									ON 	`d`.`region_id` = `r`.`id`

							WHERE `f_e`.`status`='1'
							AND `region_id` IS NOT NULL

						GROUP BY`r`.`hc_key`

					";

		$res =	R::getAll($sql);

		foreach ($res as $key => $value) {
			$res[$key]["value"] = 	$value["cd4_equipment"];
			$res[$key]["hc-key"] = 	"tz-".$value["hc_key"];
			$res[$key]["events"] = 	'{click:function(e){draw_charts(9,this.region_id);}}';
		}

		$json  	= 	json_encode($res,2);

		$json 	=	str_replace('"{click:function(e){draw_charts(9,this.region_id);}}"', '{click:function(e){draw_charts(9,this.region_id);}}', $json);

		$json 	= 	preg_replace('/"([a-zA-Z]+[a-zA-Z0-9_]*)":/','$1:',$json);

		return $json;
	}

}