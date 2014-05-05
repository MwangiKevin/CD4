<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class files extends MY_Controller {

	public function index()
	{
		$root_folder = "POC-Uploads/PIMA-EXPORT";

		if ($handle = opendir($root_folder)) {
		    while (false !== ($entry = readdir($handle))) {
		        if ($entry != "." && $entry != ".." && is_dir("POC-Uploads/PIMA-EXPORT/$entry")) {
		            echo "$entry </br>";
		            if ($handle2 = opendir("$root_folder/$entry")) {
		             	while (false !== ($entry2 = readdir($handle2))) {
		            		if ($entry2 != "." && $entry2 != ".." && is_dir("POC-Uploads/PIMA-EXPORT/$entry/$entry2")) {
		             			echo "----------$entry2 </br>";
		             			if ($handle3 = opendir("$root_folder/$entry/$entry2")) {
					             	while (false !== ($entry3 = readdir($handle3))) {
					            		if ($entry3 != "." && $entry3 != ".." && !is_dir("POC-Uploads/PIMA-EXPORT/$entry/$entry2/$entry3") && $entry3!="AssayID_X (Unknown).slk") {
					             			echo "-------------------$entry3 </br>";
					             			$file =fopen(realpath("POC-Uploads/PIMA-EXPORT/$entry/$entry2/$entry3"),"r");	
					             			//echo  realpath("POC-Uploads/PIMA-EXPORT/$entry/$entry2/$entry3");	             			
					             		}
					            	}
					            	closedir($handle3);
					        	}
		             		}
		            	}
		            	closedir($handle2);
		        	}
		        }
		    }
		    closedir($handle);
		}
	}
}