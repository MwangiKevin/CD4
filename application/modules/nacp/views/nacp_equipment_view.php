<div>
	<div class="section-title" ><center>Equipment</center></div>
	<div>
		<table id="data-table">
			<thead>
				<tr>
					<th>#</th>
					<th>Facility </th>
					<th>Equipment Type</th>
					<!-- <th style="width:15%" >Last Uploaded</th> -->
					<th style="width:15%" >Date Added</th>
					<th style="width:15%" >Date Removed</th>
					<th>Deactivation Reason</th>
					<th>Equipment History</th>
					<th>Flag as inactive/active</th>
					<th>Equipment Errors</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$i=1;
					foreach ($equipments as $equipment) {
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
							}
						?>
					</td>
					<td><?php echo Date('Y-F-d',strtotime($equipment['date_added']));?></td>
					<td><?php 
					if($equipment['date_removed']!=""){
						echo Date('Y-F-d',strtotime($equipment['date_removed']));
					}
					?></td>
					<td><?php echo $equipment['deactivation_reason'];?></td>
					<td><?php echo "<a href='javascript:void(null);' >View History</a>"?></td>
					<td>
						
						<?php 
							$id = $equipment["facility_equipment_id"];
							$status = $equipment["equipment_status"];

							echo '<a title ="'.$status.'" href="javascript:void(null);" style="border-radius:1px;" class="" onclick="rollout_toggle('.$id.')">';
						
							if($equipment['equipment_status']==5){
								echo '<span style="font-size: 1.4em;color: #2d6ca2;" class="glyphicon glyphicon-minus-sign" ></span></a>';								
							}elseif($equipment['equipment_status']==1){
								echo '<span style="font-size: 1.4em;color: #3e8f3e;" class="glyphicon glyphicon-ok-sign"></span></a>';								
							}elseif($equipment['equipment_status']==4){
								echo '<span style="font-size: 1.4em;color: #c12e2a;" class="glyphicon glyphicon-remove-sign"></span></a>';								
							}else{
								echo '<span style="font-size: 1.4em;color: #eb9316;" class="glyphicon glyphicon-question-sign"></span></a>';														
							}
							echo '</a>';
						?>
						
					</td>
					<td>
						<a title =" Edit Equipment (<?php echo $equipment['facility'];?>)" href="javascript:void(null);" style="border-radius:1px;" class="" onclick="edit_equipment(<?php echo $equipment['facility_id'];?>)"> 
							<span style="font-size: 1.3em;color:#2aabd2;" class="glyphicon glyphicon-pencil"></span>
						</a>
					</td>
				</tr>
				<?php
					$i++;
					}
				?>
			</tbody>
		</table>
	</div>
</div>