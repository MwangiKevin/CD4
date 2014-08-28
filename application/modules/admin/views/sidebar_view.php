<div>
	<div>
		<div class="section-title" ><center>
			Notifications 
			<div class="right">
			<i class="glyphicon glyphicon-exclamation-sign"></i>
			</div>
		</div>
		<div>

			<div id="dev_not_reported"><div class="" style"">Loading...</div></div>
			<div class="notice" id="error_notf" style="display:none;">
				<a href="errors" onclick="error_notification()" >
					<i class="glyphicon glyphicon-exclamation-sign"></i> 
					<span id= "notf_error"></span> Errors 
					<b>(<span id= "notf_error_perc"></span> %)</b> reported last month out of 
					<span id= "notf_total_err"></span> Tests, with 
					<span id= "notf_succ_test"></span> successfull results
				</a>

				<script>
				    $.getJSON("<?php echo base_url('poc/tests/notf_errors');?>/", function(data) {
						
				        $('#notf_succ_test').html(data.succ_test);
				        $('#notf_error').html(data.error);
				        $('#notf_error_perc').html(data.perc_errors);
				        $('#notf_total_err').html(data.total);

				        $('#error_notf').css("display","");
					}); 
				</script>
			</div>
			<div id="failed_uploads"><div class="" style"">Loading...</div></div>
			<div id="dev_reg_requests"><div class="" style"">Loading...</div></div>

			<script>
	      			$( document ).ready(function() {
	      				var fn_count_nr = 0; //will help to skip the first fnDrawCallback call.
	      				var fn_count_rq = 0; 
	      				var fn_count_fu = 0; 
						var	table_nr =	$('#dt_not_reported').dataTable({
												"bJQueryUI":true, 
												"sAjaxSource": "<?php echo base_url("poc/Equipment/ss_dt_devices_not_reported");?>" ,
												"aoColumnDefs": [
												{ "bSortable": false, "aTargets": [ 0 ] }
												],
												"aaSorting": [[1, 'asc']],
												"fnDrawCallback": function() {
																if(fn_count_nr>0){
																var oSettings = this.fnSettings();
																var iTotalRecords = oSettings.fnRecordsTotal();
																	if(iTotalRecords==0){
																		$("#dev_not_reported").html('<div class="success"><a  href="#devicesnotreported" data-toggle="modal"><i class="glyphicon glyphicon-ok"></i> All devices uploaded last month</a>	</div>');
																	
																	}else{
																		$("#dev_not_reported").html('<div class="notice"><a  href="#devicesnotreported" data-toggle="modal"><i class="glyphicon glyphicon-exclamation-sign"></i> '+iTotalRecords+' Devices Did not upload Last Month.</a></div>');
																	
																	}
																}
																fn_count_nr++;
															}
											});	
						var	table_rq =	$('#dt_req').dataTable({
												"bJQueryUI":true, 
												"sAjaxSource": "<?php echo base_url("poc/Equipment/ss_dt_device_reg_req");?>" ,
												"aoColumnDefs": [
												{ "bSortable": false, "aTargets": [ 0 ] }
												],
												"aaSorting": [[1, 'asc']],
												"fnDrawCallback": function() {
																if(fn_count_rq>0){
																var oSettings = this.fnSettings();
																var iTotalRecords = oSettings.fnRecordsTotal();
																	if(iTotalRecords==0){
																		$("#dev_reg_requests").html('<div class="success"><a  href="#requestsmade" data-toggle="modal"><i class="glyphicon glyphicon-ok"></i> You have no pending device registration requests</a>	</div>');
																	
																	}else{
																		$("#dev_reg_requests").html('<div class="notice"><a  href="#requestsmade" data-toggle="modal"><i class="glyphicon glyphicon-exclamation-sign"></i> '+iTotalRecords+' requests for device registration were made.</a></div>');
																	
																	}
																}
																fn_count_rq++;
															}
											});	
						var	table_fu =	$('#dt_failed_uploads').dataTable({
												"bJQueryUI":true, 
												"sAjaxSource": "<?php echo base_url("admin/Equipment/ss_dt_failed_uploads");?>" ,
												"aoColumnDefs": [
												{ "bSortable": false, "aTargets": [ 0 ] }
												],
												"aaSorting": [[1, 'asc']],
												"fnDrawCallback": function() {
																if(fn_count_fu>0){
																var oSettings = this.fnSettings();
																var iTotalRecords = oSettings.fnRecordsTotal();
																	if(iTotalRecords==0){
																		$("#failed_uploads").html('<div class="success"><a  href="#unrecognizeddevices" data-toggle="modal"><i class="glyphicon glyphicon-ok"></i> No unrecognized devices tried to upload</a>	</div>');
																	
																	}else{
																		$("#failed_uploads").html('<div class="notice"><a  href="#unrecognizeddevices" data-toggle="modal"><i class="glyphicon glyphicon-exclamation-sign"></i> '+iTotalRecords+' Unrecognized devices tried to upload data.</a></div>');
																	
																	}
																}
																fn_count_fu++;
															}
											});	
					});
			</script>
		</div>
	</div>
	<div>
		<div class="section-title" ><center>
			Side Menu 
			<div class="right">
			<i class="glyphicon glyphicon-list"></i>
			</div>
		</div>
		<div>
			<div class="section-content">	
				<ul class="nice-list">
					<li><span class="quiet">1.</span> <a href="<?php echo base_url()?>user/profile">My Profile</a></li>
					<li><span class="quiet">2.</span> <a href="settings">Settings</a></li>
					<!-- <li><span class="quiet">3.</span> <a href="#SystemUploads" data-toggle="modal" onclick = "systemUpload()">Attempt a System Upload</a></li> -->
					<li><span class="quiet">3.</span> <a href="javascript:void(null);" onclick = "systemUpload()">Attempt a System Upload</a></li>			
					<li><span class="quiet">4.</span> <a href="#changePassword" data-toggle="modal">Change Password</a></li>
				</ul>					
			</div>
			<div class="modal fade" id="SystemUploads" data-backdrop="static" data-keboard="false" >
			  	<div class="modal-dialog" style="width:60%;margin-bottom:2px;">
			    	<div class="modal-content" >
			      		<div class="modal-header">
			        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        		<h4 class="modal-title">System Uploads</h4>
			      		</div>
			      		<div class="modal-body" id ="modalbody">
			       	 		<div class="alert alert-info">
							  Wait while data is being fetched and uploaded! This may take a few moments.
							</div>
			       	 		<div class="progress progress-striped active">
							  <div class="progress-bar "  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
							    <span class="sr-only">45% Complete</span>
							  </div>
							</div>
			      		</div>
			      		<div class="modal-footer" style="height:11px;padding-top:11px;">
			      			<?php echo $this->config->item("copyrights");?>
			      		</div>
			   		</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		</div>
	</div>
	<div class="modal fade" id="devicesnotreported" >
	  	<div class="modal-dialog" style="width:37%;margin-bottom:2px;">
	    	<div class="modal-content" >
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        		<h4 class="modal-title">All devices not reported for Last month</h4>
	      		</div>
	      		<div class="modal-body" style="padding-bottom:0px;">
	            	<table id="dt_not_reported">
	            		<thead>				
							<th>#</th>
							<th>Facility</th>							
							<th>Equipment Type</th>							
						</thead>
	            	</table>
	      		</div>		      		
	      		<div class="modal-footer" style="height:11px;padding-top:11px;">
	      			<?php echo $this->config->item("copyrights");?>
	      		</div> 
	   		</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade" id="unrecognizeddevices" >
	  	<div class="modal-dialog" style="width:50%;margin-bottom:2px;">
	    	<div class="modal-content" >
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        		<h4 class="modal-title">Unrecognized devices that attempted uploads for <?php echo Date("Y,F");?></h4>
	      		</div>
	      		<div class="modal-body" style="padding-bottom:0px;">
	            	<table id="dt_failed_uploads">
	            		<thead>				
							<th>#</th>
							<th>User</th>							
							<th>Equipment Type</th>				
							<th>Serial Number</th>				
							<th># Upload Attempts</th>							
						</thead>
						<tbody>
						</tbody>
	            	</table>
	      		</div>		      		
	      		<div class="modal-footer" style="height:11px;padding-top:11px;">
	      			<?php echo $this->config->item("copyrights");?>
	      		</div> 
	   		</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<div class="modal fade" id="requestsmade" >
	  	<div class="modal-dialog" style="width:50%;margin-bottom:2px;">
	    	<div class="modal-content" >
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        		<h4 class="modal-title">Facilities Requested for registration <?php echo Date("Y,F");?></h4>
	      		</div>
	      		<div class="modal-body" style="padding-bottom:0px;">
	            	<table id="dt_req">
	            		<thead>	
	            		<center>
							<th rowspan="2">#</th>
							<th rowspan="2">Facility</th>							
							<th rowspan="2">Serial Number</th>				
							<th rowspan="2">Requested By</th>				
							<th rowspan="2">CTC ID No</th>	
							<th rowspan="2">Description</th>	
							<th colspan="2"><center>Action</center></th>
							<tr>
								<th><center>Approve</center></th>
								<th><center>Reject</center></th>
							</tr>
						</center>	
						</thead>
	            	</table>
	      		</div>		      		
	      		<div class="modal-footer" style="height:11px;padding-top:11px;">
	      			<?php echo $this->config->item("copyrights");?>
	      		</div> 
	   		</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

</div>
<script>
 	function systemUpload(){

 		$('#SystemUploads').modal('show');

 		alert("Wait while data is being fetched and uploaded! This may take a few moments.");

 		$.ajax({
          type:"POST",
          async:false,
          data:"",
            url:"<?php echo base_url()."uploads/server_upload"; ?>",  
            success:function(data) {
                           $('#modalbody').html(data);
                           $('#data-table1').dataTable({
								"bProcessing": true,
								"iDisplayLength": 5,
							 	"bJQueryUI":true,
								"bSort":false,
							  	"bPaginate":true,
							  	"bLengthChange": false,
							 	//"sScrollY": "160px",
							  	"bFilter": false
							});
              }
      });
 	}
</script>