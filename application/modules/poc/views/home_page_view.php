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
				<div style = "">	
					<div  id = "expected_reporting_devices" style = "float:left;width:60%;padding-right:20px;" ></div>			
					<div  id = "expectedreportingdevicespie" style = "float:left;width:39%" ></div>							
				</div>
				<div >	
					<div  	id = "testspie" style = "float:left;width:30%" ></div>			
					<div 	id = "pima_errors_pie" style = "float:left;width:30%" ></div>							
				</div>
			</div>				
		</div><!-- /.tab-content -->
	</div><!-- /.tabbable -->
</div><!-- /.row -->


<?php $this->load->view("home_footer_view");?>
