<div>
	<div>
		<div class="section-title" ><center>
			Notifications 
			<div class="right">
			<i class="glyphicon glyphicon-exclamation-sign"></i>
			</div>
		</div>
		<div>
			<div id ="dev_not_reported"><div class="" style"">Loading...</div></div>

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
			<div id ="dev_reg_requests"><div class="" style"">Loading...</div></div>

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

					<!--<li><span class="quiet">2.</span> <a href="settings">Settings</a></li>-->
					<!-- <li><span class="quiet">3.</span> <a href="#flag" data-toggle="modal">flag Device as inactive</a></li>						 -->
					<li><span class="quiet">2.</span> <a href="#changePassword" data-toggle="modal">Change Password</a></li>
					<?php 
						if($this->session->userdata("user_group_id")==3){
					?>
					<li><span class="quiet">3.</span> <a href="#facilityRegistrationRequest" data-toggle="modal">Facility Registartion Request</a></li>
					<?php
						}
					?>
				</ul>					
			</div>
		</div>
	</div>



	<div class="modal fade" id="devicesnotreported" >
	  	<div class="modal-dialog" style="width:37%;margin-bottom:2px;">
	    	<div class="modal-content" >
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        		<h4 class="modal-title">Devices <?php 

	        		$user_filter = $this->session->userdata("user_filter");

	        		echo "(".$user_filter[0]["user_filter_name"].")";

	        		?> 
	        		not reported for <?php echo Date("Y,F", strtotime("last month"));?></h4>
	      		</div>
	      		<div class="modal-body" style="padding-bottom:0px;">
	            	<table id="dt_not_reported">
	            		<thead>				
							<th>#</th>
							<th>Facility</th>							
							<th>Equipment Type</th>
							<th>Do upload</th>							
						</thead>
	            	</table>
	      		</div>
	      		<script>
	      			$( document ).ready(function() {
	      				var fn_count_nr = 0; //will help to skip the first fnDrawCallback call.
	      				var fn_count_rq = 0; 
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
																		$("#dev_reg_requests").html('<div class="notice"><a  href="#requestsmade" data-toggle="modal"><i class="glyphicon glyphicon-exclamation-sign"></i> You have '+iTotalRecords+' requests for device registration pending approval.</a></div>');
																	
																	}
																}
																fn_count_rq++;
															}
											});	
					});
	      		</script>		      		
	      		<div class="modal-footer" style="height:11px;padding-top:11px;">
	      			<?php echo $this->config->item("copyrights");?>
	      		</div> 
	   		</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


	<div class="modal fade" id="facilityRegistrationRequest" >
	  	<div class="modal-dialog" style="width:37%;margin-bottom:2px;">
	    	<div class="modal-content" >
	    		<?php echo form_open(base_url().'poc/upload/request_facility_registration',"id='devise_registration'");?>
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        		<h4 class="modal-title">Facility Registration Request</h4>
	      		</div>
	      		<div class="modal-body" style="padding-bottom:0px;">
	            <div class="input-group" style="width: 100%;padding:4px;">
	              <span class="input-group-addon" style="width: 40%;">Device Type :</span>
	              
	              <select required class="textfield form-control" name="device_type" id="device_type">
	              	<option value="" selected='selected' disabled="true">--Select Device type--</option>
	              	<?php foreach($device_types as $device){ ?>
					 	<option value='<?php echo $device["id"]; ?>'><?php echo "<b>".$device["description"]."</b>"; ?></option>
					<?php } ?>
	              </select>

	            </div>
	            
	            <div class="input-group" style="width: 100%;padding:4px;">
	              <span class="input-group-addon" style="width: 40%;">Serial Number :</span>
	              <?php echo form_input(array('id' => 'serial_number', 'name' => 'serial_number', 'class'=>'textfield form-control'));?>
	            </div>
	            
	            <div class="input-group" style="width: 100%;padding:4px;">
	              <span class="input-group-addon" style="width: 40%;">Facility ID:</span>
	              <?php echo form_input(array('name' => 'facility', 'id' => 'facility', 'class'=>'textfield form-control'));?>
	            </div>
	            
	      		<div class="input-group" style="width: 100%;padding:4px;" id="ctc_id">
	              <span class="input-group-addon" style="width: 40%;">CTC ID No:</span>
	              <?php echo form_input(array('name' => 'ctc_id_no', 'id' => 'ctc_id_no', 'class'=>'textfield form-control'));?>
	            </div>
	      		  	 		
	      		</div>	
	      		<div class="modal-footer" style="height:30px;padding-top:4px;">
	      			<button type="submit"  class="btn btn-primary"><i class="glyphicon glyphicon-save"></i>Submit</button>
	        		<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i>Close</button>         		   		
	      		</div>
	      		<div class="modal-footer" style="height:11px;padding-top:11px;">
	      			<?php echo $this->config->item("copyrights");?>
	      		</div>
	      		<?php   echo form_close();    	?>  
	   		</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade" id="requestsmade" >
	  	<div class="modal-dialog" style="width:45%;margin-bottom:2px;">
	    	<div class="modal-content" >
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        		<h4 class="modal-title">
	        			Facilities requested for registration
	        		</h4>
	      		</div>
	      		<div class="modal-body" style="padding-bottom:0px;">
	            	<table id="dt_req">
	            		<thead>				
							<th>#</th>
							<th>Facility</th>							
							<th>Equipment Type</th>
							<th>Serial Number</th>
							<th>CTC ID Number</th>
							<th>Date Requested</th>
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
	
</div>
<script>
function error_notification(){
	$.ajax({
      type:"POST",
      async:false,
      data:"type=Periodic&value=1",
        url:"<?php echo base_url()."Home/date_filter_post"; ?>",  
        success:function(data){
        }
  	});
}
        $('#device_type').change(function(){

          var criteria	 = $('#device_type').val();

          if (criteria==4){
            $("#ctc_id").show();			
            $("#ctc_id_no").prop('required',true);

           

        }else{			
          $("#ctc_id").hide();
          $("#ctc_id_no").removeAttr('required');

         
      }

  });
</script>