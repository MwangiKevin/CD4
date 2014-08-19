<div>
	<div>
		<div class="section-title" ><center>
			Notifications 
			<div class="right">
			<i class="glyphicon glyphicon-exclamation-sign"></i>
			</div>
		</div>
		<div>
			<?php 
				if(sizeof($devices_not_reported)>0){
			?>
			<div class="notice">
				<a  href="#devicesnotreported" data-toggle="modal">
					<i class="glyphicon glyphicon-exclamation-sign"></i> 
					 <?php echo sizeof($devices_not_reported); ?> Devices Did not upload Last Month.
				</a>
			</div>			
			<?php 
				}else{
			?>
			<div class="success">
				<a  href="#devicesnotreported" data-toggle="modal">
					<i class="glyphicon glyphicon-ok"></i> 
					 All devices uploaded last month
				</a>
			</div>
			<?php 
				}
			?>
			<div class="notice">
				<a href="errors" onclick="error_notification()">
					<i class="glyphicon glyphicon-exclamation-sign"></i> 
					<?php echo $errors_agg["error"]." Errors <b>(";if($errors_agg["total"]>0){echo round((($errors_agg["error"]/$errors_agg["total"])*100),2);}else{ echo "0";}?>%)</b> reported last month out of <?php echo $errors_agg["total"];?> tests
				</a>
			</div>
			<?php 
				if(sizeof($facility_requests)>0){
					foreach($facility_requests as $requests){
			?>
			<div class="notice">
				<a  href="#requestsmade" data-toggle="modal">
					<i class="glyphicon glyphicon-exclamation-sign"></i> 
					 
					 <?php 
						 if (sizeof($facility_requests)>2) {
						  	echo $requests['Totals'].' facility has been requested for registration.';
						  } else {
						  	echo $requests['Totals'].' facilities have been requested for registration.';
						  }
					   
					 ?>
					  
				</a>
			</div>			
			<?php 
				}}else{
			?>
			<div class="success">
				<a  href="" data-toggle="modal">
					<i class="glyphicon glyphicon-ok"></i> 
					 No facilty requested for registration
				</a>
			</div>
			<?php 
				}
			?>
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
	            	<table id="data-table-side">
	            		<thead>				
							<th>#</th>
							<th>Facility</th>							
							<th>Equipment Type</th>
							<th>Do upload</th>							
						</thead>
						<tbody>
							<?php
								$i=1;
								foreach ($devices_not_reported as $equipment) {
							?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $equipment['facility_name'];?></td>
								<td>
									<?php
										if($equipment['equipment_id']=="4"){
									?>
									<a title =" view Equipment (<?php echo $equipment['facility_name'];?>'s')  PIMA Details" href="javascript:void(null);" style="border-radius:1px; " class="" onclick="edit_facility(<?php echo $equipment['facility_id'];?>)"> 
										<span style="" class="glyphicon glyphicon-list-alt">
										</span>
										<?php echo $equipment['equipment'];?>
									</a>
									<?php 
										$i++;
										}
									?>
								</td>
								<td><a href="uploads">Do upload</a></td>
							</tr>
							<?php
								}
							?>
						</tbody>
	            	</table>
	      		</div>		      		
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
	  	<div class="modal-dialog" style="width:37%;margin-bottom:2px;">
	    	<div class="modal-content" >
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        		<h4 class="modal-title">
	        			Facilities requested for registration
	        		</h4>
	      		</div>
	      		<div class="modal-body" style="padding-bottom:0px;">
	            	<table id="data-table-side">
	            		<thead>				
							<th>#</th>
							<th>Facility</th>							
							<th>Equipment Type</th>
							<th>Serial Number</th>
							<th>CTC ID Number</th>
						</thead>
						<tbody>
							<?php
								$i=1;
								foreach ($facilities_requested as $facilities) {
									
							?>
							<tr>
								<td><center><?php echo $i;?></center></td>
								<td><center><?php echo $facilities['facility_id'];?></center></td>
								<td><center>
									<?php echo $facilities['Equipment'];?>
									<?php 
										$i++;
									?>
									</center>
								</td>
								<td><center><?php echo $facilities['Serial'];?></center></td>
								<td><center><?php echo $facilities['CTC'];?></center></td>
							</tr>
							<?php
								}
							?>
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