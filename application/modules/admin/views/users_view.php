<div >
	<div class="section-title"><center><b><strong>User Details</strong></b></center></div>
	<div>
		<table id="data-table">
			<thead>
				<tr>
					<th rowspan = "2" style="width:15%" >#</th>
					<th rowspan = "2">Username</th>					
					<th rowspan = "2">Name</th>
					<th rowspan = "2">Phone Number</th>
					<th rowspan = "2">Email</th>
					<th rowspan = "2" style = "width:50%">Type</th>
					<th rowspan = "2">Status</th>
					<th colspan="4"><center>Actions</center></th>
				</tr>
				<tr>
					<th>Reset Password</th>
					<th>Activate</th>
					<th>Remove</th>
					<th>Edit Details</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$i=1;
					foreach ($users as $user) {
				?>
				<tr id="tr_<?php echo $user["user_id"]; ?>" >
					<td><?php echo $i;?></td>
					<td><?php echo $user['username'];?></td>
					<td><?php echo $user['name'];?></td>
					<td><?php echo $user['phone'];?></td>
					<td><?php echo $user['email'];?></td>	
					<td><?php echo $user['user_group'];?></td>					
					<td>

					<?php 

						$class = "";
						$color = "";

						if($user['status']==5){	
							$class = "glyphicon glyphicon-minus-sign";
							$color = "#2d6ca2";
						}elseif($user['status']==1){
							$class = "glyphicon glyphicon-ok-sign";
							$color = "#3e8f3e";							
						}elseif($user['status']==4){
							$class = "glyphicon glyphicon-remove-sign";
							$color = "#c12e2a";							
						}else{
							$class = "glyphicon glyphicon-question-sign";
							$color = "#eb9316";															
						}
					?>

						<a title =" User Status (<?php echo $user['username'];?>)" href="javascript:void(null);" style="border-radius:1px;" class="" onclick="edit_user(<?php echo $user['user_id'];?>,'<?php echo $user["username"] ?>','<?php echo $user["user_group"] ?>','<?php echo $user["name"] ?>','<?php echo $user["email"] ?>','<?php echo $user["phone"] ?>','<?php echo $user["status"] ?>')"> 
							<span style="font-size: 1.3em;color:<?php echo $color;?>;" class="<?php echo $class;?>"></span>  <?php echo $user['status_desc'];?>
						</a>
					</td>
					<td>
						<a title =" Reset User (<?php echo $user['username'];?>) Password" href="users/actions/reset_password/<?php echo $user["user_id"];?>" style="border-radius:1px;" class="" onclick="reset_password(<?php echo $user['user_id'];?>)"> 
							<span style="font-size: 1.4em;color: #eb9316;" class="glyphicon glyphicon-pencil"></span>
						</a>
					</td>				
					<td>
						<a title =" Activate (<?php echo $user['username'];?>)" href="users/actions/activate_user/<?php echo $user["user_id"];?>" style="border-radius:1px;" class="" > 
							<span style="font-size: 1.3em;color:#3e8f3e;;" class="glyphicon glyphicon-ok-sign"></span>
						</a>						
					</td>
					<td>
						<a title =" Remove User (<?php echo $user['username'];?>) " href="users/actions/remove_user/<?php echo $user["user_id"];?>" style="border-radius:1px;" class="" > 
							<span style="font-size: 1.4em;color: #2d6ca2;" class="glyphicon glyphicon-minus-sign"></span>
						</a>
					</td>
					<td>
						<a title =" Edit User (<?php echo $user['username'];?>)" href="javascript:void(null);" style="border-radius:1px;" class="" onclick="edit_user(<?php echo $user['user_id'];?>,'<?php echo $user["username"] ?>','<?php echo $user["user_group"] ?>','<?php echo $user["name"] ?>','<?php echo $user["email"] ?>','<?php echo $user["phone"] ?>','<?php echo $user["status"] ?>')"> 
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
<div>
	<div class="tabbable span12" style="margin-top:5px;">
		<ul class="nav nav-tabs">
			<li id ="tabAdd" class="active"><a href="#tabs1-add" data-toggle="tab">Add User</a></li>
			<li id ="tabType"><a href="#tabs1-type" data-toggle="tab">User Types</a></li>
		</ul>
		<div class="tab-content">

			<!-- Add new -->
			<div class="tab-pane active" id="tabs1-add" >					
				<?php echo form_open('admin/users/save_user');?>
					<table>
						<tr>
							<td style="width:50%">
								<div class="mycontainer" id="full">
									<div class="input-group" style="width: 100%;padding:4px;">
										<span class="input-group-addon" style="width: 40%;">Name :</span>
										<input required name="name" id="name" class="textfield form-control" type="text" />
									</div>         
									<div class="input-group" style="width: 100%;padding:4px;">
										<span class="input-group-addon" style="width: 40%;">Username :</span>
										<input required name="usr" id="usr" class="textfield form-control" type="text" />
									</div>
									<div class="input-group" style="width: 100%;padding:4px;">
										<span class="input-group-addon" style="width: 40%;">Email :</span>
										<input required name="email" id="email" class="textfield form-control" type="text" />
									</div>
									<div class="input-group" style="width: 100%;padding:4px;">
										<span class="input-group-addon" style="width: 40%;">Phone :</span>
										<input required name="phone" id="phone" class="textfield form-control" type="text" />
									</div>
				                </div>
					        </td>
					        <td>
								<div class="mycontainer" id="full">	
									<div class="input-group" style="width: 100%;padding:4px;">
										<span class="input-group-addon" style="width: 40%;">User Type:</span>
										<select required name="usr_grp" id="usr_grp" class="textfield form-control" >
						                   	<option value="">*Select a user Group*</option>  
						                   	<?php
						                   		foreach ($user_groups as $group) {
						                   			if($group["id"]!=1 && $group["id"]!=4 && $group["id"]!=5 && $group["id"]!=7){
						                  	?>     
											<option value="<?php echo $group["id"];?>"><?php echo $group["name"];?></option>
											<?php
													}
						                   		}
						                  	?>
						                </select>
					                </div>		               
					                <div class="input-group" style="width: 100%;padding:4px;" id="par_div">
										<span class="input-group-addon" style="width: 40%;">Partner :</span>
										<select name="par" id="par" class="textfield form-control" >
						                   	<option value="">*Select a user partner*</option>
						                   	<?php
						                   		foreach ($partners as $par) {
						                  	?>     
											<option value="<?php echo $par["id"];?>"><?php echo $par["name"];?></option>
											<?php
						                   		}
						                  	?>                   					
						                </select>
					                </div>
					                <div class="input-group" style="width: 100%;padding:4px;" id="reg_div">
										<span class="input-group-addon" style="width: 40%;">Region :</span>
										<select name="reg" id="reg" class="textfield form-control" >
						                   	<option value="">*Select a user region*</option>  
						                   	<?php
						                   		foreach ($regions as $reg) {
						                  	?>     
											<option value="<?php echo $reg["region_id"];?>"><?php echo $reg["region_name"];?></option>
											<?php
						                   		}
						                  	?>                  					
						                </select>
					                </div>
					                <div class="input-group" style="width: 100%;padding:4px;" id="dis_div">
										<span class="input-group-addon" style="width: 40%;">District :</span>
										<select name="dis" id="dis" class="textfield form-control" >
						                   	<option value="">*Select a user district*</option>    
						                   	<?php
						                   		foreach ($districts as $dis) {
						                  	?>     
											<option value="<?php echo $dis["district_id"];?>"><?php echo $dis["district_name"];?></option>
											<?php
						                   		}
						                  	?>                					
						                </select>
					                </div>
					                <div class="input-group" style="width: 100%;padding:4px;" id="fac_div">
										<span class="input-group-addon" style="width: 40%;">Facility :</span>
										<select name="fac" id="fac" class="textfield form-control" >
						                   	<option value="">*Select a user facility*</option>    
						                   	<?php
						                   		foreach ($facilities as $fac) {
						                  	?>     
											<option value="<?php echo $fac["facility_id"];?>"><?php echo $fac["facility_name"];?></option>
											<?php
						                   		}
						                  	?>                					
						                </select>
					                </div>						
									<div class="right" style="padding:7px;">
										<button name="viewData" type="submit" onclick="viewData()" class="btn btn-primary btn-minii"><i class="glyphicon glyphicon-save"></i>Save</button>
										<button name="reset" type="reset"  class="btn btn-default btn-minii"><i class="glyphicon glyphicon-remove"></i>Discard</button>
									</div>						
								</div>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<!-- type -->
			<div class="tab-pane" id="tabs1-type" >
				<div class="mycontainer" style="float:left;">		
					<?php echo form_open('admin/users/save_user_group');?>	          
						<div class="input-group" style="width: 100%;padding:4px;">
							<span class="input-group-addon" style="width: 40%;">Description :</span>
							<input required name="usr_grp2" class="textfield form-control" type="text" />
						</div>									
						<div class="right" style="padding:7px;">
							<button name="viewData" type="submit" onclick="viewData()" class="btn btn-primary btn-minii"><i class="glyphicon glyphicon-save"></i>Save</button>
							<button name="reset" type="reset"  class="btn btn-default btn-minii"><i class="glyphicon glyphicon-remove"></i> Discard</button>
						</div>						
					</form>
				</div>
				<div class="mycontainer" style="float:right;">
					<table id="data-table-usr-grp">
						<thead >
							<tr>
								<th>#</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($user_groups as $gr) {
									# code...
								
							?>
							<tr>
								<td><?php echo $gr["id"];?></td>
								<td><?php echo $gr["name"];?></td>
							</tr>
							<?php
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>





	
<div class="modal fade" id="editdetailsdiv">
	<div class="modal-dialog" style="width:60%;margin-bottom:2px;">
		<div class="modal-content" >
			<div class="modal-header">
	    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	    		<h5 class="modal-title">Edit Details</h5>
	  		</div>
			<div class="modal-body" style="padding-bottom:0px;">	
				<?php echo form_open('admin/users/edit_user');?>

					<input required id="edituserid" type="hidden" name="edituserid" class="textfield form-control" readonly />
					<div class="input-group" style="width: 100%;padding:4px;">
						<table id="data-table-edit">
							<thead>
								<tr>
									<th rowspan = "2">#</th>
									<th rowspan = "2">Username</th>					
									<th rowspan = "2">Name</th>
									<th rowspan = "2">Phone Number</th>
									<th rowspan = "2">Email</th>
									<th rowspan = "2">Type</th>
									<th rowspan = "2">Status</th>
									<th colspan = "4"><center>Actions</center></th>
								</tr>
								<tr>
									<th>Reset Password</th>
									<th>Activate</th>
									<th>Remove</th>
									<th>Edit Details</th>
								</tr>
							</thead>
							<tbody>
								<tr id="edit_table_row">
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							<tbody>
						</table>	
		            </div>	
					<div class="input-group" style="width: 100%;padding:4px;">
						<span class="input-group-addon" style="width: 40%;">Username :</span>
						<input required id="editusername" name="username" class="textfield form-control" type="text" readonly />
					</div>		
					<div class="input-group" style="width: 100%;padding:4px;">
						<span class="input-group-addon" style="width: 40%;">User Type :</span>
						<input required id="editusertype" name="usertype" class="textfield form-control" type="text" readonly />
					</div>	
					<div class="input-group" style="width: 100%;padding:4px;">
						<span class="input-group-addon" style="width: 40%;">Name:</span>
						<input required id="editname" name="name" class="textfield form-control" type="text" />
					</div>	
					<div class="input-group" style="width: 100%;padding:4px;">
						<span class="input-group-addon" style="width: 40%;">email:</span>
						<input required id="editemail" name="email" class="textfield form-control" type="text" />
					</div>	
					<div class="input-group" style="width: 100%;padding:4px;">
						<span class="input-group-addon" style="width: 40%;">Phone no.:</span>
						<input required id="editphone" name="phone" class="textfield form-control" type="text" />
					</div>	
					<div class="input-group" style="width: 100%;padding:4px;">
						<span class="input-group-addon" style="width: 40%;">Status :</span>
						<span class="input-group-addon" style="width: 10%;"><input type="radio" name="editstatus" value="1">  Active  <span style="font-size: 1.4em;color: #3e8f3e;" class="glyphicon glyphicon-ok-sign"></span></input></span>
						<span class="input-group-addon" style="width: 10%;"><input type="radio" name="editstatus" value="2">  Pending Activation  <span style="font-size: 1.4em;color: #eb9316;" class="glyphicon glyphicon-question-sign"></span></input></span>
						<span class="input-group-addon" style="width: 10%;"><input disabled type="radio" name="editstatus" value="3">  locked  <span style="font-size: 1.4em;color: #c12e2a;" class="glyphicon glyphicon-remove-sign"></span></input></span>
						<span class="input-group-addon" style="width: 10%;"><input disabled type="radio" name="editstatus" value="4">  Password Reset  <span style="font-size: 1.4em;color: #c12e2a;" class="glyphicon glyphicon-pencil"></span></input></span>
						<span class="input-group-addon" style="width: 10%;"><input type="radio" name="editstatus" value="5">  Remove(d)  <span style="font-size: 1.4em;color: #c12e2a;" class="glyphicon glyphicon-remove-sign"></span></input></span>
	                </div>
					<div class="modal-footer" style="height:11px;padding-top:11px;">								
						<div class="" style="padding:7px;">
							<button name="save" type="submit" class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Save</button>
							<button name="discard" type="button"  onclick="hide_edit()" class="btn btn-default btn-minii"><i class="glyphicon glyphicon-remove"></i>Discard</button>
						</div>
					</div>		      		 
		      	</form>
			</div>
			<div class="modal-footer" style="height:11px;padding-top:11px;">
      			<?php echo $this->config->item("copyrights");?>
      		</div> 
		</div>
	</div>
</div>

<?php $this->load->view("users_footer_view");?>