<div>
	<div>
		<div class="section-title" ><center>
			Notifications 
			<div class="right">
			<i class="glyphicon glyphicon-exclamation-sign"></i>
			</div>
		</div>
		<div>
			<div class="notice">
				<a href="excel_upload.php">
					<i class="glyphicon glyphicon-exclamation-sign"></i> 
					3 Devices Awaiting Results Upload.
				</a>
			</div>
			<div class="notice">
				<a href="excel_upload.php">
					<i class="glyphicon glyphicon-exclamation-sign"></i> 
					11 Errors reported
				</a>
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
					<li><span class="quiet">1.</span> <a href="profile">My Profile</a></li>
					<li><span class="quiet">2.</span> <a href="settings">Settings</a></li>
					<li><span class="quiet">3.</span> <a href="#assign" data-toggle="modal">Assign Device to Facility</a></li>
					<li><span class="quiet">4.</span> <a href="#flag" data-toggle="modal">flag Device as inactive</a></li>							
					<li><span class="quiet">5.</span> <a href="#changePassword" data-toggle="modal">Change Password</a></li>
				</ul>					
			</div>
		</div>
	</div>
	<div>
		<div class="section-title" ><center>
			Custom search 
			<div class="right">
			<i class="glyphicon glyphicon-search"></i>
			</div>
		</div>
		<div>
			<table>
				<tr>
					<td>
						<?php
							echo form_checkbox('Equipment', 'accept', TRUE)."&nbsp; Equipment";
							echo br();
							echo form_checkbox('Facilities', 'accept', false)."&nbsp; Facilities";
						?>
					</td>
					<td>
						<?php
							echo form_checkbox('Users', 'accept', false)."&nbsp; Users";
							echo br();
							echo form_checkbox('Reports', 'accept', false)."&nbsp; Reports";
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="input-group" style="width:100%;margin-left:0px">
  							<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
 							<input type="text" class="form-control" placeholder="search" style="height: 27px;">
						</div>
					</td>					
				</tr>
			</table>
		</div>
	</div>
</div>