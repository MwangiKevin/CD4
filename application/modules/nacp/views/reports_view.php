<div>

	<div class="section-title" ><center>Select criteria to generate reports</center></div>
		<div>		
			<div class="mycontainer" id="full">
				<div class="section-title" style="width: 30%"> <center> Criteria: Show All (Device and Reports) </center></div>
				<form method="post" action="<?php echo base_url();?>nacp/reports/submit2/1" >
					<table>
						<tr>
							<td>
								<div class="input-group" style="width: 100%;padding:4px;">
									<span class="input-group-addon" style="width: 40%;">Report Type :</span>
									<select required class="textfield form-control" name="report_type" id="report_type" >
										<option value="0">Show Both Tests and Errors</option> 
										<option value="1"> Tests Report Only</option>
										<option value="2"> Errors Report Only</option>							                   	                  					
									</select>
								</div>
							</td>
							<td>
								<div id="startDate">
								<div class="input-group" style="width: 100%;padding:4px;">
									<span class="input-group-addon" style="width: 40%;padding:4px;"> Start Date: </span> 
									<input type="text" class="textfield form-control" id="datepickerFrom" name="datepickerFrom" >
								</div>
							</div>
							</td>
							<td>
								<div id="endDate">
									<div class="input-group" style="width: 100%;padding:4px;">
										<span class="input-group-addon" style="width: 40%;padding:4px;"> End Date: </span>
										<input type="text" class="textfield form-control"  id="datepickerTo" name="datepickerTo">
									</div>
								</div>
							</td>
							<td></td>
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
							<td>
								<button id="click" type="submit"  class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Download Report</button>
							</td>
						</tr>
					</table>
				</form>
				
				<div class="section-title" style="width: 30%"> <center> Criteria: Device </center></div>
					<form method="post" action="<?php echo base_url();?>nacp/reports/submit2/2">
						<table>	
							<tr>
								<td>
									<div class="input-group" style="width: 100%;padding:4px;" id="devicesdiv">
										<span class="input-group-addon" style="width:40%">Device:</span>
	
										<select name='device' id='device' style='border-radius:0px 5px 5px 0px;'; class="textfield form-control">
											<option value='' selected='selected'>*Select Device*</option>
											<?php foreach($devices as $device){ ?>
											<option value='<?php echo $device["facility_equipment_id"].'.'.$device["facility_name"]; ?>'><?php echo "<b>".$device["facility_name"]."</b>&nbsp&nbsp&nbsp&nbsp(".$device["serial_number"].")"; ?></option>
											<?php } ?>
										</select>
										<span id='locationInfo'></span>
									</div>
								</td>
								<td>
									<div id="startDate">
										<div class="input-group" style="width: 100%;padding:4px;">
										<span class="input-group-addon" style="width: 40%;padding:4px;"> Start Date: </span> 
										<input type="text" class="textfield form-control" id="datepickerFromd" name="datepickerFromd" >
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
								<td>
									<button id="click" type="submit"  class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Download Report</button>
								</td>
							</tr>
										
						</table>
					</form>
					
					<div class="section-title" style="width: 30%"> <center> Criteria: Facility </center></div>
					<form method="post" action="<?php echo base_url();?>nacp/reports/submit2/3">
						<table>
							<tr>
								<td>
									<div class="input-group" style="width: 100%;padding:4px;" id="facilitydiv">
									<span class="input-group-addon" style="width: 40%;">Facility:</span>

									<select name='facility' id='facility' style="border-radius:0px 5px 5px 0px;"  class="textfield form-control">
										<option value='' selected='selected'>*Select Facility*</option>
										<?php foreach($facilities as $facility){ ?>
										<option value='<?php echo $facility["facility_id"].'.'.$facility["facility_name"]; ?>'><?php echo $facility["facility_name"]; ?></option>
										<?php } ?>
									</select>
									<span id='locationInfo'></span>
									</div>
								</td>
								<td>
									<div id="startDate">
										<div class="input-group" style="width: 100%;padding:4px;">
											<span class="input-group-addon" style="width: 40%;padding:4px;"> Start Date: </span> 
											<input type="text" class="textfield form-control" id="datepickerFromf" name="datepickerFromf" >
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
								<td>
									<button id="click" type="submit"  class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Download Report</button>
								</td>
							</tr>
						</table>
					</form>
			</div>
		</div>
		</div>
</div>

<?php $this->load->view("report_footer_view");?>