<div class="row">
	<div class="tabbable span12">
		<ul class="nav nav-tabs">
			<!-- <li id ="tabSummary" ><a id = "linkSummary"  href="#tabs1-summary" data-toggle="tab">Summary</a></li> -->
			<li id ="tabPima" class="active"><a id = "linkPima" href="#tabs1-pima" data-toggle="tab" onclick = "draw_charts(<?php echo $user_group_id;?>,<?php echo $user_filter_used;?>)">PIMA</a></li>
		</ul>
		<div class="tab-content" >
			<!-- SUMMARRY -->
			<div class="tab-pane" id="tabs1-summary">
			</div>
			<!-- PIMA -->
			<div class="tab-pane  active" id="tabs1-pima">
				<div class="panel panel-default" style="float:left;width:100%;margin-top:5px;box-shadow: 4px 4px 4px #888888;">	
					<div  id = "expected_reporting_devices" style = "float:left;width:60%;padding-right:20px;" >
						<div class="loader" style"">Loading...</div>
					</div>			
					<div  id = "expected_reporting_devices_pie" style = "float:left;width:39%" >
						<div class="loader" style"">Loading...</div>
					</div>							
				</div>
				<div class="panel panel-default" style="float:left;width:100%;box-shadow: 4px 4px 4px #888888;" >	
					<div id = "testspie" style = "float:left;width:30%" >
						<div class="loader" style"">Loading...</div>
					</div>			
					<div id = "pima_errors_pie" style = "float:left;width:30%" >
						<div class="loader" style"">Loading...</div>
					</div>
					<div  style = "float:left;width:39%">
						<div class="section-title" ><center> PIMA Tests for <?php echo $date_filter_desc;?> </center></div>
						<div id="pima-tests-table" >							
							<div class="loader" style"">Loading...</div>
						</div>
					</div>						
				</div>
				<div class="panel panel-default" style="float:left;width:100%;box-shadow: 4px 4px 4px #888888;">	
					<div  id = "pima_error_types_col" style = "float:left;width:50%;padding:20px;" >
						<div class="loader" style"">Loading...</div>
					</div>			
					<div  id = "pima_error_trend" style = "float:right;width:50%" >
						<div class="loader" style"">Loading...</div>
					</div>							
				</div>
			</div>				
		</div><!-- /.tab-content -->
	</div><!-- /.tabbable -->
</div><!-- /.row -->


<?php $this->load->view("home_footer_view");?>
