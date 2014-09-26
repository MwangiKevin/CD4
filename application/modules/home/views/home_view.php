<div>
	<div class="row">
		<div class="col-md-9"></div>
		<div class="col-md-3" style=" font-size:14px;background-color:#33c6e7; color:#fff; opacity:20border-style: double;border-color: black;" >
			<b><center><div id ="filter-identifier">National</div></center></b>
		</div>
	</div>
	<div class="row">
		<div class="col-md-5" style="">
			<div id='homemap' style="">
				<div class="loader" style"">Loading...</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="row">
				<div class="col-md-12" id="equipmentpie">
					<div class="loader" style"">Loading...</div>	
				</div>
				<div class="col-md-12" id="equipmenttestpie">
					<div class="loader" style"">Loading...</div>	
				</div>
			</div>
		</div>


		<div class="col-md-4">		
			<div class="section-title" ><center>CD4 Equipment </center></div>
			<div id="equipment-table">
				<div class="loader" style"">Loading...</div>	
			</div>									
		</div>
		<div class="col-md-4">		
			<div class="section-title" ><center>Equipment Tests for <?php echo $date_filter_desc;?> </center></div>
			<div id="equipment-test-table">
				<div class="loader" style"">Loading...</div>	
			</div>									
		</div>								
	</div>
	<div class="row" style="margin-top:20px;">
		<div class="col-md-4" id="equipmenttestscolumn">				
			<div class="loader" style"">Loading...</div>	
		</div>
		<div class="col-md-4" id="testspie">
			<div class="loader" style"">Loading...</div>
		</div>
		<div class="col-md-4" >
			<div class="section-title" ><center>CD4 Tests for <?php echo $date_filter_desc;?> </center></div>
			<div id="tests-table">				
				<div class="loader" style"">Loading...</div>	
			</div>	
		</div>
	</div>
	<div class="row" style="">
		<div class="col-md-12" style="margin-top:20px; " id="cd4testtrends">
			<div class="loader" style"">Loading...</div>
		</div>	
		<div class="col-md-12" style=" margin-top:20px;" id="expected_reporting_devices">
			<div class="loader" style"">Loading...</div>
		</div>	
	</div>
</div>


<?php $this->load->view("home_footer_view");?>