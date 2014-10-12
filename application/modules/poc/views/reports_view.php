<style>
table, th, td {
    margin:0px;
    padding:0px;
}report_type
</style>

<div>
	<div class="section-title" style="font-size: 200%"><center>Select a criteria and generate a report</center></div>
		<div class="mycontainer" id="full">
			<div class="section-title" style="width: 30%;" ><center> Criteria: National </center></div>
			<form method="post" action="<?php echo base_url();?>poc/reports/submit2/1" id="form-report">	
			<table>
					<tr>
						<td>
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;">Report Title :</span>
								<select required class="textfield form-control" name="report_title" id="report_title" >
									<option value="">*Select Report Title*</option>
									<option value="1"> Tests Report </option>
									<option value="2"> Errors Report </option>							                   	                  					
								</select>
							</div>						
						</td>
						<td>
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;">Report Type :</span>
								<select required class="textfield form-control" name="report_type" id="report_type" >
									<option value="">*Select Report Type*</option>
									<option value="1"> Detailed </option>
									<option value="2"> Summarized </option>							                   	                  					
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
						<td>
							<div id="format">
								<div class="input-group" style="width: 100%;padding:4px;">
									<span class="input-group-addon" style="width: 40%;padding:4px;"> Format: </span>
									<select required class="textfield form-control" name="format" id="format"  >
										<option value="">*Select Format*</option>
										<option value="1">PDF</option>
										<option value="2">Excel</option>
									</select>
								</div>	
							</div>
						</td>
						<td>
							<button id="click" type="submit"  class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Generate</button>
						</td>
					</tr>
				</table>	
			</form>
			
			<div class="section-title" style="width: 30%;" ><center> Criteria: Partner </center></div>
			<form method="post" action="<?php echo base_url();?>poc/reports/submit2/6" id="form-report">	
			<table>
					<tr>
						<td>
							<div class="input-group" style="width: 100%;padding:4px;" id="partnerdiv">
								<span class="input-group-addon" style="width:40%">Partner:</span>
								<select name='partner' id='partner' style='border-radius:0px 5px 5px 0px;'; class="textfield form-control">
									<option value='' selected='selected'>*Select Partner*</option>
									<?php foreach($partners as $partner){ ?>
									<option value='<?php echo $partner["partner_id"].'.'.$partner["partner_name"]; ?>'><?php echo "".$partner["partner_name"]; ?></option>
									<?php } ?>
								</select>
								<span id='locationInfo'></span>
							</div>		
						</td>
						<td>
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;">Report Title :</span>
								<select required class="textfield form-control" name="report_title" id="report_title" >
									<option value="">*Select Report Title*</option>
									<option value="1"> Tests Report </option>
									<option value="2"> Errors Report </option>							                   	                  					
								</select>
							</div>						
						</td>
						<td>
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;">Report Type :</span>
								<select required class="textfield form-control" name="report_type" id="report_type" >
									<option value="">*Select Report Type*</option>
									<option value="1"> Detailed </option>
									<option value="2"> Summarized </option>							                   	                  					
								</select>
							</div>						
						</td>
						<td>
							<div id="startDate">
								<div class="input-group" style="width: 100%;padding:4px;">
									<span class="input-group-addon" style="width: 40%;padding:4px;"> Start Date: </span> 
									<input type="text" class="textfield form-control" id="datepickerFromp" name="datepickerFromp" >
								</div>
							</div>
						</td>
						<td>
							<div id="endDate">
								<div class="input-group" style="width: 100%;padding:4px;">
									<span class="input-group-addon" style="width: 40%;padding:4px;"> End Date: </span>
									<input type="text" class="textfield form-control"  id="datepickerTop" name="datepickerTop">
								</div>
							</div>
						</td>
						<td>
							<div id="format">
								<div class="input-group" style="width: 100%;padding:4px;">
									<span class="input-group-addon" style="width: 40%;padding:4px;"> Format: </span>
									<select required class="textfield form-control" name="format" id="format"  >
										<option value="">*Select Format*</option>
										<option value="1">PDF</option>
										<option value="2">Excel</option>
									</select>
								</div>	
							</div>
						</td>
						<td>
							<button id="click" type="submit"  class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Generate</button>
						</td>
					</tr>
				</table>	
			</form>
			
			<div class="section-title" style="width: 30%;" ><center>Criteria: By Device</center></div>
			<form method="post" action="<?php echo base_url();?>poc/reports/submit2/2" id="form-report">	
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
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;">Report Title :</span>
								<select required class="textfield form-control" name="report_title" id="report_title" >
									<option value="">*Select Report Title*</option>
									<option value="1"> Tests Report </option>
									<option value="2"> Errors Report </option>							                   	                  					
								</select>
							</div>						
						</td>
						<td>
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;">Report Type :</span>
								<select required class="textfield form-control" name="report_type" id="report_type" >
									<option value="">*Select Report Type*</option>
									<option value="1"> Detailed </option>
									<option value="2"> Summarized </option>							                   	                  					
								</select>
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
						<td>
							<div id="format">
								<div class="input-group" style="width: 100%;padding:4px;">
									<span class="input-group-addon" style="width: 40%;padding:4px;"> Format: </span>
									<select name='format' id='format' class="textfield form-control">
										<option>*Select Format*</option>
										<option value="1">PDF</option>
										<option value="2">Excel</option>
									</select>	
								</div>
							</div>
						</td>
						<td>
							<button id="click" type="submit" class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Generate</button>
						</td>
					</tr>
				</table>
			</form>
			
			
			<div class="section-title" style="width: 30%;" ><center>Criteria: By Region</center></div>
			<form method="post" action="<?php echo base_url();?>poc/reports/submit2/5" id="form-report">
				<table>
					<tr>
						<td>
							<div class="input-group" style="width: 100%;padding:4px;" id="regiondiv">
								<span class="input-group-addon" style="width: 40%;">Region:</span>
	
								<select name='region' id='region' style="border-radius:0px 5px 5px 0px;"  class="textfield form-control">
									<option value='' selected='selected'>*Select Region*</option>
									<?php foreach($regions as $regions){ ?>
									<option value='<?php echo $regions["region_id"].'.'.$regions["region_name"]; ?>'><?php echo $regions["region_name"]; ?></option>
									<?php } ?>
								</select>
								<span id='locationInfo'></span>
							</div> 
						</td>
						<td>
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;">Report Title :</span>
								<select required class="textfield form-control" name="report_title" id="report_title" >
									<option value="">*Select Report Title*</option>
									<option value="1"> Tests Report </option>
									<option value="2"> Errors Report </option>							                   	                  					
								</select>
							</div>						
						</td>
						<td>
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;">Report Type :</span>
								<select required class="textfield form-control" name="report_type" id="report_type" >
									<option value="">*Select Report Type*</option>
									<option value="1"> Detailed</option>
									<option value="2"> Summarized </option>							                   	                  					
								</select>
							</div>						
						</td>
						<td>
							<div id="startDate">
								<div class="input-group" style="width: 100%;padding:4px;">
									<span class="input-group-addon" style="width: 40%;padding:4px;"> Start Date: </span> 
									<input type="text" class="textfield form-control" id="datepickerFromr" name="datepickerFromr">
								</div>
							</div>
						</td>
						<td>
							<div id="endDate">
								<div class="input-group" style="width: 100%;padding:4px;">
									<span class="input-group-addon" style="width: 40%;padding:4px;"> End Date: </span>
									<input type="text" class="textfield form-control"  id="datepickerTor" name="datepickerTor">
								</div>
							</div>
						</td>
						<td>
							<div id="format">
								<div class="input-group" style="width: 100%;padding:4px;">
									<span class="input-group-addon" style="width: 40%;padding:4px;"> Format: </span>
									<select name='format' id='format' class="textfield form-control">
										<option>*Select Format*</option>
										<option value="1">PDF</option>
										<option value="2">Excel</option>
									</select>	
								</div>
							</div>
						</td>
						<td>
							<button id="click" type="submit" class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Generate</button>						
						</td>
					</tr>
				</table>
			</form>
			
			<div class="section-title" style="width: 30%;" ><center>Criteria: By District</center></div>
			<form method="post" action="<?php echo base_url();?>poc/reports/submit2/4" id="form-report">
				<table>
					<tr>
						<td>
							<div class="input-group" style="width: 100%;padding:4px;" id="districtdiv">
								<span class="input-group-addon" style="width: 40%;">District:</span>
	
								<select name='district' id='district' style="border-radius:0px 5px 5px 0px;"  class="textfield form-control">
									<option value='' selected='selected'>*Select District*</option>
									<?php foreach($districts as $district){ ?>
									<option value='<?php echo $district["district_id"].'.'.$district["district_name"]; ?>'><?php echo $district["district_name"]; ?></option>
									<?php } ?>
								</select>
								<span id='locationInfo'></span>
							</div> 
						</td>
						<td>
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;">Report Title :</span>
								<select required class="textfield form-control" name="report_title" id="report_title" >
									<option value="">*Select Report Title*</option>
									<option value="1"> Tests Report </option>
									<option value="2"> Errors Report </option>							                   	                  					
								</select>
							</div>						
						</td>
						<td>
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;">Report Type :</span>
								<select required class="textfield form-control" name="report_type" id="report_type" >
									<option value="">*Select Report Type*</option>
									<option value="1"> Detailed</option>
									<option value="2"> Summarized </option>							                   	                  					
								</select>
							</div>						
						</td>
						<td>
							<div id="startDate">
								<div class="input-group" style="width: 100%;padding:4px;">
									<span class="input-group-addon" style="width: 40%;padding:4px;"> Start Date: </span> 
									<input type="text" class="textfield form-control" id="datepickerFromdis" name="datepickerFromdis">
								</div>
							</div>
						</td>
						<td>
							<div id="endDate">
								<div class="input-group" style="width: 100%;padding:4px;">
									<span class="input-group-addon" style="width: 40%;padding:4px;"> End Date: </span>
									<input type="text" class="textfield form-control"  id="datepickerTodis" name="datepickerTodis">
								</div>
							</div>
						</td>
						<td>
							<div id="format">
								<div class="input-group" style="width: 100%;padding:4px;">
									<span class="input-group-addon" style="width: 40%;padding:4px;"> Format: </span>
									<select name='format' id='format' class="textfield form-control">
										<option>*Select Format*</option>
										<option value="1">PDF</option>
										<option value="2">Excel</option>
									</select>	
								</div>
							</div>
						</td>
						<td>
							<button id="click" type="submit" class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Generate</button>						
						</td>
					</tr>
				</table>		
			</form>
			
			<div class="section-title" style="width: 30%;" ><center>Criteria: By Facility</center></div>
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
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;">Report Title :</span>
								<select required class="textfield form-control" name="report_title" id="report_title" >
									<option value="">*Select Report Title*</option>
									<option value="1"> Tests Report </option>
									<option value="2"> Errors Report </option>							                   	                  					
								</select>
							</div>						
						</td>
						<td>
							<div class="input-group" style="width: 100%;padding:4px;">
								<span class="input-group-addon" style="width: 40%;">Report Type :</span>
								<select required class="textfield form-control" name="report_type" id="report_type" >
									<option value="">*Select Report Type*</option>
									<option value="1"> Detailed </option>
									<option value="2"> Summarized </option>							                   	                  					
								</select>
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
						<td>
							<div id="format">
								<div class="input-group" style="width: 100%;padding:4px;">
									<span class="input-group-addon" style="width: 40%;padding:4px;"> Format: </span>
									<select name='format' id='format' class="textfield form-control">
										<option>*Select Format*</option>
										<option value="1">PDF</option>
										<option value="2">Excel</option>
									</select>	
								</div>
							</div>
						</td>
						<td>
							<button id="click" type="submit" class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Generate</button>						
						</td>
					</tr>
				</table>
			</form>
		</div>
		
		
		<!-- <div class="section-title" style="width: 30%;" ><center>Criteria: By Device</center></div>
		<div class="mycontainer" id="full">
		
		</div> 
		
		<!-- <div class="section-title" style="width: 30%;" ><center>Criteria: By Facility</center></div>
		<div class="mycontainer" id="full">
		</div> -->
</div>

<?php $this->load->view("reports_footer_view");?>