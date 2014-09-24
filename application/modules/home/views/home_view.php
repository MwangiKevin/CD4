<div>
	<div>
		<div class="panel panel-default" style="width:40%;margin-right:5px; float:left;box-shadow: 4px 4px 4px #888888;">
			<div id='homemap' style="">
				<div class="loader" style"">Loading...</div>
			</div>
		</div>		
		<div class="panel panel-default" style="width:57%; float:right;height:452px;box-shadow: 4px 4px 4px #888888;">
			<div style="font-size: 14px;width:35%; height:22px; float:right; background-color:#33c6e7; color:#fff; opacity:20border-style: double;border-color: black;border-radius: 3px;margin-right:1%" >
				<b><center><div id ="filter-identifier">National<div></center></b>
			</div>
			<div style="width:46%; float:left;">
				<div id="equipmentpie">
					<div class="loader" style"">Loading...</div>	
				</div>		
			</div>
			<div style="width:50%; float:right;margin:4px;">	
				<div>		
					<div class="section-title" ><center>CD4 Equipment </center></div>
					<div id="equipment-table">
						<div class="loader" style"">Loading...</div>	
					</div>									
				</div>
			</div>
			<div style="width:46%; float:left;">	
					<div id="equipmenttestpie">
						<div class="loader" style"">Loading...</div>	
					</div>
			</div>
			<div style="width:50%; float:right;margin:4px;">
				<div>		
					<div class="section-title" ><center>Equipment Tests for <?php echo $date_filter_desc;?></center></div>						
					<div id="equipment-test-table">
						<div class="loader" style"">Loading...</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default" style="width:100%;float:right;box-shadow: 4px 4px 4px #888888;">
		<div style="width:28%; float:left;">
			<div id="equipmenttestscolumn">				
				<div class="loader" style"">Loading...</div>	
			</div>	
		</div>
		<div style="width:40%; float:right;margin:4px;">
			<div>
				<div class="section-title" ><center>CD4 Tests for <?php echo $date_filter_desc;?> </center></div>
				<div id="tests-table">				
					<div class="loader" style"">Loading...</div>	
				</div>	
			</div>
		</div>
		<div style="width:28%; float:right;">
			<div id="testspie">
				<div class="loader" style"">Loading...</div>
			</div>		
		</div>

	</div>
	<div style="width:100%;float:left;">
		<div class="panel panel-default" style="width:100%;float:left;padding:30px;box-shadow: 4px 4px 4px #888888;" id="cd4testtrends">
			<div class="loader" style"">Loading...</div>
		</div>		
		<div class="panel panel-default" style="width:100%;float:left;padding:30px;box-shadow: 4px 4px 4px #888888;" id="expected_reporting_devices">
			<div class="loader" style"">Loading...</div>
		</div>	
	</div>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<div style="height:300px;" >&nbsp;nacpnacpnacp</div>
	<div>&nbsp;</div>
	<div>&nbsp;</div>
	<div>&nbsp;</div>
	<div>&nbsp;</div>
	<div>&nbsp;</div>
</div>
<?php $this->load->view("home_footer_view");?>