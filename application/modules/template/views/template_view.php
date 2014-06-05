<?php 
	ob_start();	
	if (!isset($sidebar)){//checks if the page requested for needs a sidebar 
		
		$this->load->view('header_View');//loads the view header_view

		echo "<div class='main' id='main' >"; 	
		$this->load->view($content_view);//dynamically loads the content of the page requested for
		echo "</div>";
		$this->load->view('footer_View');//dynamically loads the footer of the page requested for
		
	}else{//if the sidebar isn't needed for the page this code is run to build the page
		$this->load->view('header_View');
		?>
			<div class="main">
				<table>
					<tr>
						<td colspan="3" rowspan="5" style="vertical-align:top">
		<?php		
			$this->load->view($content_view);
		?>
						</td>					
						<td colspan="1" rowspan="1" width="25%">
		<?php
			$this->load->view($sidebar);
		?>		
						</td>
					</tr>
				</table>
			</div>
		<?php
		$this->load->view('footer_View');	
	}
?>