<?php
	/**
		This is a script to dynamically load menus passed to views
		
	*/
	foreach($menus as $menu){		
		$menuString	=	"<li ".$menu['selectedString']." >
							<a href='".$menu['url']."'  ".$menu['other']." >
								".$menu['name']."
							</a>
						</li>";
		
		echo $menuString;
	
	}
	
?>