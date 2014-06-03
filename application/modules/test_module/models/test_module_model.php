<?php

class test_module_model extends MY_Model{
	public function menus($selected){
		$menus  	=	 array(
									array(	'num'			=>	1,
											'name'			=>	'Test Results',
											'url'			=>	base_url()."test_module/",
											'other'			=>	"",
					 						'selected'		=>	false,
					 						'selectedString'=>	"",							
										),
									array(	'num'			=>	2,
											'name'			=>	'Other',
											'url'			=>	base_url()."test_module/",
											'other'			=>	"",
					 						'selected'		=>	false,
					 						'selectedString'=>	"",							
										),
							);
			$j=0;
		foreach($menus as $menu){				
			$j++;
		}	
		for($i=0;$i<=($j-1);$i++){
			if($menus[$i]['num']==$selected){
				$menus[$i]['selected']=true;
				$menus[$i]['selectedString']="class='current-tab' style='background: url(\"".base_url()."img/navigation-arrow.gif \" ) no-repeat center bottom'";		
				$menus[$i]['name']="<b style=\"font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif\">".$menus[$i]['name']."</b>";
			}
		}
		return $menus;

	}

	public function test_results(){

		return R::getAll("SELECT * FROm `test_table`");
	}

}