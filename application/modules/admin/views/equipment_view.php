<div >
	<div class="section-title" ><center><b><strong>Equipment Details</strong></b></center></div>
	<div>
		<table id="data-table">
			<thead>
				<tr>
					<th rowspan = "2">#</th>
					<th rowspan = "2">Facility Name</th>
					<th rowspan = "2" >Equipment</th>
					<th rowspan = "2">Serial Number</th>
					<th rowspan = "2">Date Added</th>
					<th rowspan = "2">Date Removed</th>					
					<th rowspan = "2">Deactivation Reason</th>
					<th colspan = "2"><center>Actions</center></th>
				</tr>
				<tr>
					<th nowrap>Status</th>
					<th>Edit Details</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i=1;
				foreach ($equipments as $equipment) {
					?>
					<tr id="tr_<?php echo $equipment["facility_equipment_id"]; ?>">
						<td><?php echo $i;?></td>
						<td><?php echo $equipment['facility_name'];?></td>
						<td>
							<?php
							if($equipment['equipment']=="Alere PIMA"){
								?>
								<a title =" view Equipment (<?php echo $equipment['facility_name'];?>'s')  PIMA Details" href="javascript:void(null);" style="border-radius:1px; " class="" onclick="edit_facility(<?php echo $equipment['facility_id'];?>)"> 
									<span style="" class="glyphicon glyphicon-list-alt">
									</span>
									<?php echo $equipment['equipment'];?>
								</a>
								<?php 
							}
							?>
						</td>					
						<td><?php echo $equipment['serial_number'];?></td>
						<td><?php echo Date("Y, M, d",strtotime($equipment['date_added'])) ;?></td>
						<td><?php if($equipment['date_removed']!=""){echo Date("Y, M, d",strtotime($equipment['date_removed']));}?></td>
						<td><?php echo $equipment['deactivation_reason'];?></td>
						
						<?php 
						$color = "";
						$class = "";

						if($equipment['facility_equipment_status_id']==4){								
							$color = "#2d6ca2";
							$class = "glyphicon glyphicon-minus-sign";								
						}elseif($equipment['facility_equipment_status_id']==1){							
							$color = "#3e8f3e";
							$class = "glyphicon glyphicon-ok-sign";								
						}elseif($equipment['facility_equipment_status_id']==3){									
							$color = "#c12e2a";
							$class = "glyphicon glyphicon-remove-sign";							
						}else{							
							$color = "#eb9316";
							$class = "glyphicon glyphicon-question-sign";														
						}
						?>

						<td>
							<center>
								<a title ="<?php echo $equipment["facility_equipment_status"];?>" href="javascript:void(null);" style="border-radius:1px;" class="" onclick='edit_equipment(<?php echo $equipment["facility_equipment_id"]; ?>,"<?php echo $equipment["equipment_category"]; ?>","<?php echo $equipment["equipment"]; ?>","<?php echo $equipment["serial_number"]; ?>",<?php echo $equipment["facility_id"]; ?>,<?php echo $equipment["facility_equipment_status_id"];?>)' >
									<span style="font-size: 1.4em;color: <?php echo $color;?>;" class="<?php echo $class;?>"></span>
								</a>
							</center>
						</td>

						<td>
							<center>
								<a title =" Edit Equipment (<?php echo $equipment['facility_name'];?>)" href="javascript:void(null);" style="border-radius:1px;" class="" onclick='edit_equipment(<?php echo $equipment["facility_equipment_id"]; ?>,"<?php echo $equipment["equipment_category"]; ?>","<?php echo $equipment["equipment"]; ?>","<?php echo $equipment["serial_number"]; ?>",<?php echo $equipment["facility_id"]; ?>,<?php echo $equipment["facility_equipment_status_id"];?>)'> 
									<span style="font-size: 1.3em;color:#2aabd2;" class="glyphicon glyphicon-pencil"></span>
								</a>
							</center>
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
			<li id ="tabAddFacEquip" class="active"><a href="#tabs1-add_fac_equip" data-toggle="tab">Add Equipment to Facility </a></li>
			<li id ="tabAddEquip" ><a href="#tabs1-add_equip" data-toggle="tab">Equipment</a></li>
			<li id ="tabAddCat"><a href="#tabs1-add_category" data-toggle="tab">Equipment Category</a></li>
		</ul>
		<div class="tab-content">
			<!-- Add new -->
			<div class="tab-pane active" id="tabs1-add_fac_equip">
				<div class="mycontainer">
					<?php echo form_open('admin/equipment/save_fac_equip');?>
					<div class="input-group" style="width: 100%;padding:4px;">
						<span class="input-group-addon" style="width: 40%;">Equipment Category:</span>
						<select required id="equipmentcategory" name="cat" class="textfield form-control" >
							<option  value="" required >*Select an Equipment Category*</option> 
							<?php
							foreach($equipment_category as $cat){
								?>   
								<option value= "<?php echo $cat["id"] ?>" ><?php echo $cat["description"] ?></option>
								<?php
							}
							?>               					
						</select>
					</div>					
					<div id="equipmentdiv" class="input-group" style="width: 100%;padding:4px;">
						<span class="input-group-addon" style="width: 40%;">Equipment:</span>
						<select required id="equipment" name = "eq" class="textfield form-control" >
							<option value="">*Select an Equipment*</option>                   					
						</select>
					</div>
					<div class="input-group" style="width: 100%;padding:4px;">
						<span class="input-group-addon" style="width: 40%;">Facility:</span>
						<select  required name="fac" class="textfield form-control" >
							<option value="">*Select a Facility*</option> 
							<?php
							foreach($facilities as $fac){
								?>   
								<option value= "<?php echo $fac["facility_id"] ?>" ><?php echo $fac["facility_name"] ?></option>
								<?php
							}
							?>                  					
						</select>
					</div>	          
					<div class="input-group" style="width: 100%;padding:4px;">
						<span class="input-group-addon" style="width: 40%;">Equipment Serial:</span>
						<input required name="serial" class="textfield form-control" type="text" />
					</div>		          
					<div id="ctcdiv" class="input-group" style="width: 100%;padding:4px;">
						<span class="input-group-addon" style="width: 40%;">CTC ID NO:</span>
						<input name="ctc" class="textfield form-control" type="text" />
					</div>								
					<div class="right" style="padding:7px;">
						<button name="save" type="submit" onclick="viewData()" class="btn btn-primary btn-minii"><i class="glyphicon glyphicon-save"></i>Save</button>
						<button name="reset" type="reset"  class="btn btn-default btn-minii"><i class="glyphicon glyphicon-remove"></i>Discard</button>
					</div>						
				</form>
			</div>
		</div>
		<div class="tab-pane" id="tabs1-add_equip">
			<div class="mycontainer" style="float:left;">					
				<?php echo form_open('admin/equipment/save_equip');?>				
				<div class="input-group" style="width: 100%;padding:4px;">
					<span class="input-group-addon" style="width: 40%;">Type:</span>
					<select required name="cat1" class="textfield form-control" >
						<option  value="">*Select an Equipment Category*</option>   
						<?php
						foreach($equipment_category as $cat){
							?>   
							<option value= "<?php echo $cat["id"] ?>" ><?php echo $cat["description"] ?></option>
							<?php
						}
						?>                					
					</select>
				</div>	          
				<div class="input-group" style="width: 100%;padding:4px;">
					<span class="input-group-addon" style="width: 40%;">Description :</span>
					<input  name="eq1" class="textfield form-control" type="text" />
				</div>									
				<div class="right" style="padding:7px;">
					<button name="saveeq" type="submit" onclick="viewData()" class="btn btn-primary btn-minii"><i class="glyphicon glyphicon-save"></i>Save</button>
					<button name="reset" type="reset"  class="btn btn-default btn-minii"><i class="glyphicon glyphicon-remove"></i>Discard</button>
				</div>						
			</form>
		</div>
		<div class="mycontainer" style="float:right;">
			<table id="data-table_dev">
				<thead>
					<tr>
						<th>#</th>
						<th>Description</th>
						<th>Category</th>
					</tr>
				</thead>
				<tbody>	
					<?php 
					$i=1;
					foreach ($equipment_1 as $eq) {
						?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $eq['description'];?></td>
							<td><?php echo $eq['category_desc'];?></td>
						</tr>
						<?php 
						$i++;
					}
					?>						
				</tbody>
			</table>
		</div>
	</div>
	<div class="tab-pane" id="tabs1-add_category">
		<div class="mycontainer" style="float:left;">
			<?php echo form_open('admin/equipment/save_cat');?>	          
			<div class="input-group" style="width: 100%;padding:4px;">
				<span class="input-group-addon" style="width: 40%;">Description :</span>
				<input  name="cat2" class="textfield form-control" type="text" />
			</div>									
			<div class="right" style="padding:7px;">
				<button name="savecat" type="submit" onclick="viewData()" class="btn btn-primary btn-minii"><i class="glyphicon glyphicon-save"></i>Save</button>
				<button name="reset" type="reset"  class="btn btn-default btn-minii"><i class="glyphicon glyphicon-remove"></i>Discard</button>
			</div>						
		</form>
	</div>
	<div class="mycontainer" style="float:right;">
		<table id="data-table_cat">
			<thead>
				<tr>
					<th>#</th>
					<th>Category</th>
				</tr>
			</thead>
			<tbody>	
				<?php 
				$i=1;
				foreach ($equipment_category as $cat) {
					?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $cat['description'];?></td>
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
</div >		
<div class="modal fade" id="rolloutstatusdiv">
	<div class="modal-dialog" style="width:30%;margin-bottom:2px;">
		<div class="modal-content" >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Device status</h4>
			</div>
			<div class="modal-body" style="padding-bottom:0px;height:100px;">
				<?php echo form_open('admin/equipment/save_fac_equip');?>
				<div style="float:left">
					<div style="height:30px;">
						<input checked type="radio" name="rolloutstatus" value="1" />
						<span style="font-size: 1.4em;color: #3e8f3e;" class="glyphicon glyphicon-ok-sign"></span>
						Functional
					</div>
					<div style="height:30px;">
						<input type="radio" name="rolloutstatus" value="2" />
						<span style="font-size: 1.4em;color: #eb9316;" class="glyphicon glyphicon-question-sign"></span>
						Flagged
					</div>
					<div style="height:30px;">
						<input type="radio" name="rolloutstatus" value="3" />
						<span style="font-size: 1.4em;color: #c12e2a;" class="glyphicon glyphicon-remove-sign"></span>
						Obsolete
					</div>
				</div>
				<div>
					<div style="float:right">
						<button name="save" type="submmit" onclick="viewData()" class="btn btn-primary btn-minii"><i class="glyphicon glyphicon-save"></i>Save</button>
					</div>
					<div style="float:right">
						<button name="reset" type="reset" class="btn btn-default btn-minii"><i class="glyphicon glyphicon-remove"></i>Discard</button>
					</div>
				</div>
				<?php echo form_close();?>	
			</div>
			<div class="modal-footer" style="height:11px;padding-top:11px;">
				<?php echo $this->config->item("copyrights");?>
			</div>
		</div>
	</div>
</div >











<div class="modal fade" id="editdetailsdiv">
	<div class="modal-dialog" style="width:60%;margin-bottom:2px;">
		<div class="modal-content" >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title">Edit Details</h5>
			</div>
			<div class="modal-body" style="padding-bottom:0px;">	
				<?php echo form_open('admin/equipment/edit_fac_equip');?>


				<input required id="editequipmentid" type="hidden" name="editequipmentid" class="textfield form-control" readonly />
				<div class="input-group" style="width: 100%;padding:4px;">
					<table id ="edit_table">
						<thead>
							<tr>
								<th rowspan = "2">#</th>
								<th rowspan = "2">Facility Name</th>
								<th rowspan = "2" >Equipment</th>
								<th rowspan = "2">Serial Number</th>
								<th rowspan = "2">Date Added</th>
								<th rowspan = "2">Date Removed</th>					
								<th rowspan = "2">Deactivation Reason</th>
								<th colspan = "2"><center>Actions</center></th>
							</tr>
							<tr>
								<th nowrap>Status</th>
								<th>Edit Details</th>
							</tr>
						</thead>
						<tbody >
							<tr id="edit_table_row"><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
							<tbody>
							</table>	
						</div>	
						<div class="input-group" style="width: 100%;padding:4px;">
							<span class="input-group-addon" style="width: 40%;">Equipment Category:</span>
							<input required id="editequipmentcategory" name="cat" class="textfield form-control" readonly />	
						</div>					
						<div id="equipmentdiv" class="input-group" style="width: 100%;padding:4px;">
							<span class="input-group-addon" style="width: 40%;">Equipment:</span>
							<input required id="editequipment" name = "eq" class="textfield form-control" readonly  />  
						</div>
						<div class="input-group" style="width: 100%;padding:4px;">
							<span class="input-group-addon" style="width: 40%;">Facility:</span>
							<select  required id="editfac" name="fac" class="textfield form-control" >
								<option value="">*Select a Facility*</option> 
								<?php
								foreach($facilities as $fac){
									?>   
									<option value= "<?php echo $fac["facility_id"] ?>" ><?php echo $fac["facility_name"] ?></option>
									<?php
								}
								?>                					
							</select>
						</div>	          
						<div class="input-group" style="width: 100%;padding:4px;">
							<span class="input-group-addon" style="width: 40%;">Equipment Serial:</span>
							<input required id="editserial" name="serial" class="textfield form-control" type="text" />
						</div>		          
					<!-- <div id="ctcdiv" class="input-group" style="width: 100%;padding:4px;">
						<span class="input-group-addon" style="width: 40%;">CTC ID NO:</span>
						<input id="editctc" name="ctc" class="textfield form-control" type="text" readonly />
					</div>	 -->	
					<div class="input-group" style="width: 100%;padding:4px;">
						<span class="input-group-addon" style="width: 40%;">Status :</span>
						<span class="input-group-addon" style="width: 20%;"><input type="radio" name="editstatus" value="1">  Active  <span style="font-size: 1.4em;color: #3e8f3e;" class="glyphicon glyphicon-ok-sign"></span></input></span>
						<span class="input-group-addon" style="width: 20%;"><input type="radio" name="editstatus" value="2">  Disfunctional  <span style="font-size: 1.4em;color: #eb9316;" class="glyphicon glyphicon-question-sign"></span></input></span>
						<span class="input-group-addon" style="width: 20%;"><input type="radio" name="editstatus" value="3">  Obsolete  <span style="font-size: 1.4em;color: #c12e2a;" class="glyphicon glyphicon-remove-sign"></span></input></span>
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
<?php $this->load->view("equipment_footer_view");?>