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
			<div class="tab-pane  active row" id="tabs1-pima">
				<div  id = "expected_reporting_devices" class="col-md-6">
					<div class="loader" style"">Loading...</div>
				</div>			
				<div  id = "expected_reporting_devices_pie" class="col-md-3" >
					<div class="loader" style"">Loading...</div>
				</div>	
				<div id = "testspie" class="col-md-3" >
					<div class="loader" style"">Loading...</div>
				</div>	
				<div id="pima-tests-table" class="col-md-5" >							
					<div class="loader" style"">Loading...</div>
				</div>
				<div id = "errors_reported_pie" class="col-md-3" >
					<div class="loader" style"">Loading...</div>
				</div>
				<div  id = "pima_error_types_col" class="col-md-3" >
					<div class="loader" style"">Loading...</div>
				</div>			
				<div  id = "pima_error_trend" class="col-md-3" >
					<div class="loader" style"">Loading...</div>
				</div>	
			</div>				
		</div><!-- /.tab-content -->
	</div><!-- /.tabbable -->
</div><!-- /.row -->


<?php $this->load->view("home_footer_view");?>
