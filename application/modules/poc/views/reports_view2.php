<div>

	<div class="section-title" style="font-size: 200%"><center>Select criteria to generate reports</center></div>

	
		
		<div class="section-title" style="width: 30%;" ><center>Criteria: Show All (By Device & Facility)</center></div>
		<div class="mycontainer" id="full">
		<form method="post" action="<?php echo base_url();?>poc/reports/submit2/1" id="form-report">	
			<table>
				<tr>
					<td style="width:35%;">
						<div class="input-group" style="width: 100%;padding:4px;">
							<span class="input-group-addon" style="width: 40%;">Report Type :</span>
							<select required class="textfield form-control" name="report_type" id="report_type" >
								<option value="">*Select Report Type*</option>
								<option value="0">Show Both Tests and Errors</option> 
								<option value="1"> Tests Report Only</option>
								<option value="2"> Errors Report Only</option>							                   	                  					
							</select>
						</div>
					</td>
					<td style="width:33%;">
						<div id="startDate">
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;padding:4px;"> Start Date: </span> 
								<input type="text" class="textfield form-control" id="datepickerFrom" name="datepickerFrom" >
							</div>
						</div>
					</td>
					<td style="width:33%;">
						<div id="endDate">
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;padding:4px;"> End Date: </span>
								<input type="text" class="textfield form-control"  id="datepickerTo" name="datepickerTo">
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div id="format">
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;padding:4px;"> Format: </span>
								<select required class="textfield form-control" name="format" id="format"  >
									<option value="">*Select Format*</option>
									<option value="1">Detailed</option>
									<option value="2">Summary</option>
								</select>
							</div>	
						</div>
					</td>
					<td></td>
					<td style="float:right;">
						<button id="click" type="submit"  class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Generate Report</button>
					</td>
				</tr>
			</table>
		</form>
		</div>
		
		<div class="section-title" style="width: 30%;" ><center>Criteria: By Device</center></div>
		<div class="mycontainer" id="full">
		<form method="post" action="<?php echo base_url();?>poc/reports/submit2/2" id="form-report">	
			<table>
				<tr>
					<td>
						<div class="input-group" style="width: 100%;padding:4px;" id="devicesdiv">
							<span class="input-group-addon" style="width:40%">Device:</span>
							<select name='device' id='device' style='border-radius:0px 5px 5px 0px;'; class="textfield form-control">
								<option value='' selected='selected'>*Select Device*</option>
								<?php foreach($devices as $device){ ?>
								<option value='<?php echo $device["facility_equipment_id"]; ?>'><?php echo "<b>".$device["facility_name"]."</b>&nbsp&nbsp&nbsp&nbsp(".$device["serial_number"].")"; ?></option>
								<?php } ?>
							</select>
							<span id='locationInfo'></span>
						</div>		
					</td>
					<td>
						<div id="startDate">
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;padding:4px;"> Start Date: </span> 
								<input type="text" class="textfield form-control" id="datepickerFromd" name="datepickerFromd">
							</div>
						</div>
					</td>
					<td>
						<div id="endDate">
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;padding:4px;"> End Date: </span>
								<input type="text" class="textfield form-control"  id="datepickerTod" name="datepickerTod">
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div id="format">
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;padding:4px;"> Format: </span>
								<select name='format' id='format' class="textfield form-control">
									<option>*Select Format*</option>
									<option value="1">Detailed</option>
									<option value="2">Summary</option>
								</select>	
							</div>
						</div>
					</td>
					<td></td>
					<td style="float:right;">
						<button id="click" type="submit" class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Generate Report</button>
					</td>
				</tr>
			</table>
		</form>
		</div>
		
		<div class="section-title" style="width: 30%;" ><center>Criteria: By Facility</center></div>
		<div class="mycontainer" id="full">
		<form method="post" action="<?php echo base_url();?>poc/reports/submit2/3" id="form-report">
			<table>
				<tr>
					<td>
						<div class="input-group" style="width: 100%;padding:4px;" id="facilitydiv">
							<span class="input-group-addon" style="width: 40%;">Facility:</span>

							<select name='facility' id='facility' style="border-radius:0px 5px 5px 0px;"  class="textfield form-control">
								<option value='' selected='selected'>*Select Facility*</option>
								<?php foreach($facilities as $facility){ ?>
								<option value='<?php echo $facility["facility_id"]; ?>'><?php echo $facility["facility_name"]; ?></option>
								<?php } ?>
							</select>
							<span id='locationInfo'></span>
						</div> 
					</td>
					<td>
						<div id="startDate">
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;padding:4px;"> Start Date: </span> 
								<input type="text" class="textfield form-control" id="datepickerFromf" name="datepickerFromf">
							</div>
						</div>
					</td>
					<td>
						<div id="endDate">
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;padding:4px;"> End Date: </span>
								<input type="text" class="textfield form-control"  id="datepickerTof" name="datepickerTof">
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div id="format">
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;padding:4px;"> Format: </span>
								<select name='format' id='format' class="textfield form-control">
									<option>*Select Format*</option>
									<option value="1">Detailed</option>
									<option value="2">Summary</option>
								</select>	
							</div>
						</div>
					</td>
					<td></td>
					<td style="float:right;">
						<button id="click" type="submit" class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Generate Report</button>						
					</td>
				</tr>
			</table>
		</form>
		</div>
</div>

<?php $this->load->view("reports_footer_view2");?>