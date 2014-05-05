<?php 
	ob_start();

	// $data['jsFiles']=$jsFiles;
	// $data['cssFiles']=$cssFiles;
	// $data['jsPluginFiles']=$jsPluginFiles;
	   
	$this->load->view('header_menuless_View');		
	$this->load->view($content_view);
	$this->load->view('footer_View');

?>