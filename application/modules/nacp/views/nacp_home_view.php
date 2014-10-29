<div class="row">
	<div class="tabbable span12">
		<ul class="nav nav-tabs">
			<li id ="tabPima" class="active"><a id = "linkPima" href="#tabs1-pima" data-toggle="tab">ALERE PIMA</a></li>
		</ul>
		<div class="tab-content">

			<!-- PIMA -->
			<div class="tab-pane  active" id="tabs1-pima">
				<div class="row" style="margin-top:10px;">
					<div id="cd4_test_trends" class="col-md-6">
						<div class="loader" style"">Loading...</div>
					</div>

					<div id="equipment_tests_column" class="col-md-6">
						<div class="loader" style"">Loading...</div>
					</div>	
				</div>
				<div class="row" style="margin-top:10px;">

					<div id="equipment_pie" class="col-md-3">
						<div class="loader" style"">Loading...</div>
					</div>
					<div id="equipment_tests_pie" class="col-md-3">
						<div class="loader" style"">Loading...</div>
					</div>                        
					<div id="tests_table" class="col-md-6">
						<div class="loader" style"">Loading...</div>
					</div>
				</div>
			</div>				
		</div><!-- /.tab-content -->
	</div><!-- /.tabbable -->
</div><!-- /.row -->

<?php $this->load->view("nacp_home_footer_view");?>

