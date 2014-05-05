<?php 
	ob_start();	
	if (!isset($sidebar)){ 
		
		$this->load->view('header_View');

		echo "<div class='main' id='main' >"; 	
		$this->load->view($content_view);
		echo "</div>";
		$this->load->view('footer_View');
		
	}
	else{
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