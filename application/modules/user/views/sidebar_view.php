<div>
	<div>
		<div class="section-title" ><center>
			Notifications 
			<div class="right">
			<i class="glyphicon glyphicon-exclamation-sign"></i>
			</div>
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
					<li><span class="quiet">3.</span> <a href="#assign" data-toggle="modal">Assign Device to Facility</a></li>
					<li><span class="quiet">4.</span> <a href="#flag" data-toggle="modal">flag Device as inactive</a></li>							
					<li><span class="quiet">5.</span> <a href="#changePassword" data-toggle="modal">Change Password</a></li>
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

	        		$user_group  = $this->session->userdata("user_group_id");

	        		if($user_group==3){
	        			echo " for ".$devices_not_reported[0]['partner']." "; 
	        		}elseif($user_group==8){
	        			echo " in ".$devices_not_reported[0]['district']." "; 
	        		}elseif($user_group==9){
	        			echo " in ".$devices_not_reported[0]['region']." "; 
	        		}

	        		
	        		?> 
	        		not reported for <?php echo Date("Y,F");?></h4>
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
								<td><?php echo $equipment['facility'];?></td>
								<td>
									<?php
										if($equipment['equipment']=="Alere PIMA"){
									?>
									<a title =" view Equipment (<?php echo $equipment['facility'];?>'s')  PIMA Details" href="javascript:void(null);" style="border-radius:1px; " class="" onclick="edit_facility(<?php echo $equipment['facility_id'];?>)"> 
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
	
</div>