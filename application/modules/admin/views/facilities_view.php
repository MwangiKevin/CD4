<div >
	<div class="section-title"><center><b><strong>Facility Details</strong></b></center></div>
	<div>
		<table id="facilities_table">
			<thead>
				<tr>
					<th rowspan = "2">#</th>
					<th rowspan = "2">Facility Name</th>					
					<th rowspan = "2">District</th>
					<th rowspan = "2">Region</th>
					<th rowspan = "2">Partner</th>
					<th rowspan = "2"># equipment</th>
					<th rowspan = "2"># Users</th>
					<th colspan="2"><center>Actions</center></th>

				</tr>
				<tr>
					<th>Rollout</th>
					<th>Edit Details</th>
				</tr>
			</thead>
		</table>
	</div>
</div>








<div>
	<div class="tabbable span12" style="margin-top:5px;">
		<ul class="nav nav-tabs">
			<li id ="tabAdd" class="active"><a href="#tabs1-add" data-toggle="tab">Add Facility</a></li>
			<li id ="tabDistrict"><a href="#tabs1-District" data-toggle="tab">Districts</a></li>
			<li id ="tabRegion"><a href="#tabs1-Region" data-toggle="tab">Regions</a></li>
			<li id ="tabPartner"><a href="#tabs1-Partner" data-toggle="tab">Partners</a></li>
		</ul>
		<div class="tab-content">

			<!-- Add new -->
			<div class="tab-pane active" id="tabs1-add" >
				<div class="mycontainer">
					<?php echo form_open('admin/facilities/save_fac');?>
		                <div class="input-group" style="width: 100%;padding:4px;">
							<span class="input-group-addon" style="width: 40%;">Region:</span>
							<select name="reg" id="reg" required class="textfield form-control" >
			                   	<option value="">*Select a Region*</option>  
		                   		<?php
			                   		foreach ($regions as $reg) {
			                  	?>     
								<option value="<?php echo $reg["region_id"];?>"><?php echo $reg["region_name"];?></option>
								<?php
			                   		}
			                  	?>                 					
			                </select>
		                </div>
		                <div id="dis_div" class="input-group" style="width: 100%;padding:4px;">
							<span class="input-group-addon" style="width: 40%;">District:</span>
							<select name="dis" id="dis" required class="textfield form-control" >
			                                     					
			                </select>
		                </div>
		                <div class="input-group" style="width: 100%;padding:4px;">
							<span class="input-group-addon" style="width: 40%;">Partner:</span>
							<select name="par" id="par" required class="textfield form-control" >
			                   	<option value="">*Select a Partner*</option>  
		                   		<?php
			                   		foreach ($partners as $par) {
			                  	?>     
								<option value="<?php echo $par["id"];?>"><?php echo $par["name"];?></option>
								<?php
			                   		}
			                  	?>                 					
			                </select>
		                </div>
						<div id="fac_name_div" class="input-group" style="width: 100%;padding:4px;">
							<span class="input-group-addon" style="width: 40%;">Facility Name:</span>
							<input name="fac_name" id="fac_name" required class="textfield form-control" type="text" />
						</div>	
						<div id="fac_email_div" class="input-group" style="width: 100%;padding:4px;">
							<span class="input-group-addon" style="width: 40%;">email:</span>
							<input name="fac_email" id="fac_email" required class="textfield form-control" type="text" />
						</div>																
						<div id="fac_phone_div" class="input-group" style="width: 100%;padding:4px;">
							<span class="input-group-addon" style="width: 40%;">Phone no:</span>
							<input name="fac_phone" id="fac_phone" required class="textfield form-control" type="text" />
						</div>															
						<div class="right" style="padding:7px;">
							<button name="viewData" type="submit" onclick="viewData()" class="btn btn-primary btn-minii"><i class="glyphicon glyphicon-save"></i>Save</button>
							<button name="reset" type="reset"  class="btn btn-default btn-minii"><i class="glyphicon glyphicon-remove"></i>Discard</button>
						</div>						
					</form>
				</div>
			</div>
			<!-- District -->
			<div class="tab-pane" id="tabs1-District" style="width: 60%;padding:4px;" >		
				<table id="data-table-dis">
					<thead>
						<tr>
							<th>#</th>
							<th>District Name</th>					
							<th>Region</th>
							<th>Partner</th>						
					</thead>
					<tbody>
						<?php
							$i=1;
							foreach ($districts as $dis) {
						?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $dis['district_name'];?></td>
							<td><?php echo $dis['region_name'];?></td>
							<td><?php echo $dis['partner_name'];?></td>
						</tr>
						<?php
							$i++;
							}
						?>
					</tbody>
				</table>		
			</div>
			<!-- Region -->
			<div class="tab-pane" id="tabs1-Region" style="width: 60%;padding:4px;" >	
				<table id="data-table-reg">
					<thead>
						<tr>
							<th>#</th>				
							<th>Region Name</th>
							<th>Partner</th>						
					</thead>
					<tbody>
						<?php
							$i=1;
							foreach ($regions as $reg) {
						?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $reg['region_name'];?></td>
							<td><?php echo $reg['partner_name'];?></td>
						</tr>
						<?php
							$i++;
							}
						?>
					</tbody>
				</table>					
			</div>
			<!-- Partner -->
			<div class="tab-pane" id="tabs1-Partner" style="width: 60%;padding:4px;" >		
				<table id="data-table-par">
					<thead>
						<tr>
							<th>#</th>			
							<th>Partner</th>	
							<th>Email</th>	
							<th>Phone</th>						
					</thead>
					<tbody>
						<?php
							$i=1;
							foreach ($partners as $par) {
						?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $par['name'];?></td>
							<td><?php echo $par['email'];?></td>
							<td><?php echo $par['phone'];?></td>
						</tr>
						<?php
							$i++;
							}
						?>
					</tbody>
				</table>							
			</div>
		</div>
	</div>
</div>













<div class="modal fade" id="editdetailsdiv">
	<div class="modal-dialog" style="width:60%;margin-bottom:2px;">
		<div class="modal-content" >
			<div class="modal-header">
	    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	    		<h5 class="modal-title">Edit Facility Details</h5>
	  		</div>
			<div class="modal-body" style="padding-bottom:0px;">	
				<?php echo form_open('admin/facilities/edit_fac');?>

					<input required id="editfacilityid" type="hidden" name="editfacilityid" class="textfield form-control" readonly />

					<div class="input-group" style="width: 100%;padding:4px;">
						<table id="data-table-edit">
							<thead>
								<tr>
									<th>Facility Name</th>
									<th>District</th>
									<th>Region</th>
									<th>Partner</th>
									<th>Email</th>
									<th>Phone</th>
								</tr>
							</thead>
							<tbody>
								<tr id="edit_table_row"><td id="ed_dt_fac_name"></td><td id="ed_dt_dis_name"></td><td id="ed_dt_reg_name"></td><td id="ed_dt_par_name"></td><td id="ed_dt_email"></td><td id="ed_dt_phone"></td></tr>
							</tbody>
						</table>
		            </div>	
					<div class="input-group" style="width: 100%;padding:4px;">
						<span class="input-group-addon" style="width: 40%;">Facility name:</span>
						<input required id="editfacname" name="facname" class="textfield form-control" />	
		            </div>					
					<div id="equipmentdiv" class="input-group" style="width: 100%;padding:4px;">
						<span class="input-group-addon" style="width: 20%;">Region:</span>

						<select  required id="editreg" name="reg" class="textfield form-control" >
		                   	<option value="">*Select a Region*</option> 
		                   	<?php
		                   		foreach($regions as $reg){
		                   	?>   
		                   	<option value= "<?php echo $reg["region_id"] ?>" ><?php echo $reg["region_name"] ?></option>
		                   	<?php
		                   		}
		                   	?>                					
		                </select>
						<span class="input-group-addon" style="width: 20%;">District:</span>
						<select  required id="editdis" name="dis" class="textfield form-control" >            					
		                </select>
		            </div>	          
					<div class="input-group" style="width: 100%;padding:4px;">
						<span class="input-group-addon" style="width: 40%;">Partner:</span>
						<select  required id="editpar" name="par" class="textfield form-control" >
		                   	<option value="">*Select a Partner*</option> 
		                   	<?php
		                   		foreach($partners as $par){
		                   	?>   
		                   	<option value= "<?php echo $par["id"] ?>" ><?php echo $par["name"] ?></option>
		                   	<?php
		                   		}
		                   	?>                					
		                </select>
					</div>	
					<div class="input-group" style="width: 100%;padding:4px;">
						<span class="input-group-addon" style="width: 40%;"> email:</span>
						<input id="editemail" name="email" class="textfield form-control" />	
		            </div>
					<div class="input-group" style="width: 100%;padding:4px;">
						<span class="input-group-addon" style="width: 40%;">phone:</span>
						<input id="editphone" name="phone" class="textfield form-control" />	
		            </div>
					<div class="input-group" style="width: 100%;padding:4px;">
						<span class="input-group-addon" style="width: 40%;"> Rollout Status :</span>
						<span class="input-group-addon" style="width: 30%;"><input type="radio" name="editstatus" value="1">  Rolledout  <span style="font-size: 1.4em;color: #3e8f3e;" class="glyphicon glyphicon-ok-sign"></span></input></span>
						<span class="input-group-addon" style="width: 30%;"><input type="radio" name="editstatus" value="2">  Not Rolledout  <span style="font-size: 1.4em;color: #eb9316;" class="glyphicon glyphicon-question-sign"></span></input></span>
	                </div>				
				
					</div>
					<div class="modal-footer" style="height:11px;padding-top:11px;">								
						<div class="" style="padding:7px;">
							<button name="save" type="submit" class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Save</button>
							<button name="discard" type="button"  onclick="hide_edit()" class="btn btn-default btn-minii"><i class="glyphicon glyphicon-remove"></i>Discard</button>
						</div>
		      		</div> 
		      	</form>

			<div class="modal-footer" style="height:11px;padding-top:11px;">
      			<?php echo $this->config->item("copyrights");?>
      		</div> 
		</div>
	</div>
</div>

<?php $this->load->view("facilities_footer_view");?>