<style>
table, th, td {
	margin:0px;
	padding:0px;
} 

.small-caption{
	font-size: 10px;
}
.col-md-2, .col-md-1{
	padding-left: 2.5px;
	padding-right: 2.5px;
}
.report-row{
	padding: 5px;
}
#endDate,#startDate{
	width:50%;
	float:left;
}
</style>
<div class="mycontainer" id="full">
	<div class="section-title" style="font-size: 100%"><center>Select a criteria and generate a report</center></div>
	<div class="report-row">
		<form method="post" action="<?php echo base_url();?>poc/reports/submit2/1" id="form-report">	
			<div class="row">
				<div class="col-md-2">
					<button type="button" class="btn btn-white btn-sm btn-primary" style="width: 100%;">National</button>
				</div>
				<div class="col-md-2">
					<div class="input-group" >
						<span class="input-group-addon small-caption" style="">Report:</span>
						<select required class="textfield form-control" name="report_title_national" id="report_title_national" >
							<option value="">*Select Report Title*</option>
							<option value="1"> Tests Report </option>
							<option value="2"> Errors Report </option>
							<option value="3"> Summarized By Month </option>
							<option value="4"> Tests & Errors Report </option>							                   	                  					
						</select>
					</div>	
				</div>
				<div class="col-md-2">
					<div class="input-group" >
						<span class="input-group-addon small-caption" >Type :</span>
						<select required class="textfield form-control" name="report_type_national" id="report_type_national" >
							<option value="">*Select Report Type*</option>
							<option value="1"> Detailed </option>
							<option value="2"> Summarized </option>							                   	                  					
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div id="startDate">
						<div class="input-group" style="">
							<span class="input-group-addon small-caption" style=""> From: </span> 
							<input type="text" class="textfield form-control" id="datepickerFrom" name="datepickerFrom" >
						</div>
					</div>
					<div id="endDate">
						<div class="input-group" style="">
							<span class="input-group-addon small-caption" style=""> To: </span>
							<input type="text" class="textfield form-control"  id="datepickerTo" name="datepickerTo">
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div id="format">
						<div class="input-group" style="">
							<span class="input-group-addon small-caption" style=""> Format: </span>
							<select required class="textfield form-control" name="format" id="format"  >
								<option value="">*Select Format*</option>
								<option value="1">PDF</option>
								<option value="2">Excel</option>
							</select>
						</div>	
					</div>

				</div>
				<div class="col-md-1">
					<button id="click" type="submit"  class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Generate</button>
				</div>
			</div>	
		</form>
	</div>

	<div class="report-row">
		<form method="post" action="<?php echo base_url();?>poc/reports/submit2/6" id="form-report">	
			<div class="row">
				<div class="col-md-2">
					<div class="input-group" style="" id="partnerdiv">
						<span class="input-group-addon small-caption" style="">Partner:</span>
						<select name='partner' id='partner' style=''; class="textfield form-control">
							<option value='' selected='selected'>*Select Partner*</option>
							<?php foreach($partners as $partner){ ?>
							<option value='<?php echo $partner["partner_id"].'.'.$partner["partner_name"]; ?>'><?php echo "".$partner["partner_name"]; ?></option>
							<?php } ?>
						</select>
						<span id='locationInfo'></span>
					</div>	
				</div>
				<div class="col-md-2">
					<div class="input-group" style="">
						<span class="input-group-addon small-caption" style="">Report:</span>
						<select required class="textfield form-control" name="report_title_partner" id="report_title_partner" >
							<option value="">*Select Report Title*</option>
							<option value="1"> Tests Report </option>
							<option value="2"> Errors Report </option>	
							<option value="3"> Summarized By Month </option>
							<option value="4"> Tests & Errors Report </option>						                   	                  					
						</select>
					</div>	
				</div>
				<div class="col-md-2">
					<div class="input-group" >
						<span class="input-group-addon small-caption" >Type :</span>
						<select required class="textfield form-control" name="report_type_partner" id="report_type_partner" >
							<option value="">*Select Report Type*</option>
							<option value="1"> Detailed </option>
							<option value="2"> Summarized </option>							                   	                  					
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div id="startDate">
						<div class="input-group" style="">
							<span class="input-group-addon small-caption" style=""> From: </span> 
							<input type="text" class="textfield form-control" id="datepickerFromp" name="datepickerFromp" >
						</div>
					</div>
					<div id="endDate">
						<div class="input-group" style="">
							<span class="input-group-addon small-caption" style=""> To: </span>
							<input type="text" class="textfield form-control"  id="datepickerTop" name="datepickerTop">
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="input-group" style="">
						<span class="input-group-addon small-caption" style=""> Format: </span>
						<select required class="textfield form-control" name="format" id="format"  >
							<option value="">*Select Format*</option>
							<option value="1">PDF</option>
							<option value="2">Excel</option>
						</select>
					</div>	
				</div>
				<div class="col-md-1">
					<button id="click" type="submit"  class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Generate</button>
				</div>
			</div>	
		</form>
	</div>	
	
	<div class="report-row">
		<form method="post" action="<?php echo base_url();?>poc/reports/submit2/5" id="form-report">	
			<div class="row">
				<div class="col-md-2">
					<div class="input-group" style="" id="regiondiv">
						<span class="input-group-addon small-caption" style="">Region:</span>

						<select name='region' id='region' style=""  class="textfield form-control ">
							<option value='' selected='selected'>*Select Region*</option>
							<?php foreach($regions as $regions){ ?>
							<option value='<?php echo $regions["region_id"].'.'.$regions["region_name"]; ?>'><?php echo $regions["region_name"]; ?></option>
							<?php } ?>
						</select>
						<span id='locationInfo'></span>
					</div> 	
				</div>
				<div class="col-md-2">
					<div class="input-group" style="">
						<span class="input-group-addon small-caption" style="">Report:</span>
						<select required class="textfield form-control" name="report_title_region" id="report_title_region" >
							<option value="">*Select Report Title*</option>
							<option value="1"> Tests Report </option>
							<option value="2"> Errors Report </option>
							<option value="3"> Summarized By Month </option>
							<option value="4"> Tests & Errors Report </option>							                   	                  					
						</select>
					</div>	
				</div>
				<div class="col-md-2">
					<div class="input-group" >
						<span class="input-group-addon small-caption" >Type :</span>
						<select required class="textfield form-control" name="report_type_region" id="report_type_region" >
							<option value="">*Select Report Type*</option>
							<option value="1"> Detailed </option>
							<option value="2"> Summarized </option>							                   	                  					
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div id="startDate">
						<div class="input-group" style="">
							<span class="input-group-addon small-caption" style=""> From: </span> 
							<input type="text" class="textfield form-control" id="datepickerFromr" name="datepickerFromr">
						</div>
					</div>
					<div id="endDate">
						<div class="input-group" style="">
							<span class="input-group-addon small-caption" style=""> To: </span>
							

							<input type="text" class="textfield form-control"  id="datepickerTor" name="datepickerTor">
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="input-group" style="">
						<span class="input-group-addon small-caption" style=""> Format: </span>
						<select required class="textfield form-control" name="format" id="format"  >
							<option value="">*Select Format*</option>
							<option value="1">PDF</option>
							<option value="2">Excel</option>
						</select>
					</div>	
				</div>
				<div class="col-md-1">
					<button id="click" type="submit"  class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Generate</button>
				</div>
			</div>	
		</form>
	</div>	

	<div class="report-row">
		<form method="post" action="<?php echo base_url();?>poc/reports/submit2/4" id="form-report">	
			<div class="row">
				<div class="col-md-2">
					<div class="input-group" style="" id="districtdiv">
						<span class="input-group-addon small-caption" style="">District:</span>

						<select name='district' id='district' style=""  class="textfield form-control">
							<option value='' selected='selected'>*Select District*</option>
							<?php foreach($districts as $district){ ?>
							<option value='<?php echo $district["district_id"].'.'.$district["district_name"]; ?>'><?php echo $district["district_name"]; ?></option>
							<?php } ?>
						</select>
						<span id='locationInfo'></span>
					</div> 	
				</div>
				<div class="col-md-2">
					<div class="input-group" style="">
						<span class="input-group-addon small-caption" style="">Report:</span>
						<select required class="textfield form-control" name="report_title_district" id="report_title_district" >
							<option value="">*Select Report Title*</option>
							<option value="1"> Tests Report </option>
							<option value="2"> Errors Report </option>
							<option value="3"> Summarized By Month </option>
							<option value="4"> Tests & Errors Report </option>								                   	                  					
						</select>
					</div>	
				</div>
				<div class="col-md-2">
					<div class="input-group" >
						<span class="input-group-addon small-caption" >Type :</span>
						<select required class="textfield form-control" name="report_type_district" id="report_type_district" >
							<option value="">*Select Report Type*</option>
							<option value="1"> Detailed </option>
							<option value="2"> Summarized </option>							                   	                  					
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div id="startDate">
						<div class="input-group" style="">
							<span class="input-group-addon small-caption" style=""> From: </span> 
							<input type="text" class="textfield form-control" id="datepickerFromdis" name="datepickerFromdis">
						</div>
					</div>
					<div id="endDate">
						<div class="input-group" style="">
							<span class="input-group-addon small-caption" style=""> To: </span>
							

							<input type="text" class="textfield form-control"  id="datepickerTodis" name="datepickerTodis">
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="input-group" style="">
						<span class="input-group-addon small-caption" style=""> Format: </span>
						<select required class="textfield form-control" name="format" id="format"  >
							<option value="">*Select Format*</option>
							<option value="1">PDF</option>
							<option value="2">Excel</option>
						</select>
					</div>	
				</div>
				<div class="col-md-1">
					<button id="click" type="submit"  class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Generate</button>
				</div>
			</div>	
		</form>
	</div>

	<div class="report-row">
		<form method="post" action="<?php echo base_url();?>poc/reports/submit2/3" id="form-report">	
			<div class="row">
				<div class="col-md-2">
					<div class="input-group" style="" id="facilitydiv">
						<span class="input-group-addon small-caption" style="">Facility:</span>

						<select name='facility' id='facility' style=""  class="textfield form-control">
							<option value='' selected='selected'>*Select Facility*</option>
							<?php foreach($facilities as $facility){ ?>
							<option value='<?php echo $facility["facility_id"]; ?>'><?php echo $facility["facility_name"]; ?></option>
							<?php } ?>
						</select>
						<span id='locationInfo'></span>
					</div> 	
				</div>
				<div class="col-md-2">
					<div class="input-group" style="">
						<span class="input-group-addon small-caption" style="">Report:</span>
						<select required class="textfield form-control" name="report_title_facility" id="report_title_facility" >
							<option value="">*Select Report Title*</option>
							<option value="1"> Tests Report </option>
							<option value="2"> Errors Report </option>		
							<option value="3"> Summarized By Month </option>
							<option value="4"> Tests & Errors Report </option>				                   	                  					
						</select>
					</div>	
				</div>
				<div class="col-md-2">
					<div class="input-group" >
						<span class="input-group-addon small-caption" >Type :</span>
						<select required class="textfield form-control" name="report_type_facility" id="report_type_facility" >
							<option value="">*Select Report Type*</option>
							<option value="1"> Detailed </option>
							<option value="2"> Summarized </option>							                   	                  					
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div id="startDate">
						<div class="input-group" style="">
							<span class="input-group-addon small-caption" style=""> From: </span> 
							<input type="text" class="textfield form-control" id="datepickerFromf" name="datepickerFromf">
						</div>
					</div>
					<div id="endDate">
						<div class="input-group" style="">
							<span class="input-group-addon small-caption" style=""> To: </span>
							

							<input type="text" class="textfield form-control"  id="datepickerTof" name="datepickerTof">
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="input-group" style="">
						<span class="input-group-addon small-caption" style=""> Format: </span>
						<select required class="textfield form-control" name="format" id="format"  >
							<option value="">*Select Format*</option>
							<option value="1">PDF</option>
							<option value="2">Excel</option>
						</select>
					</div>	
				</div>
				<div class="col-md-1">
					<button id="click" type="submit"  class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Generate</button>
				</div>
			</div>	
		</form>
	</div>

	<div class="report-row">
		<form method="post" action="<?php echo base_url();?>poc/reports/submit2/2" id="form-report">	
			<div class="row">
				<div class="col-md-2">
					<div class="input-group " style="" id="devicesdiv">
						<span class="input-group-addon small-caption" style="">Device:</span>
						<select name='device' id='device' style=''; class="textfield form-control">
							<option value='' selected='selected'>*Select Device*</option>
							<?php foreach($devices as $device){ ?>
							<option value='<?php echo $device["facility_equipment_id"].'.'.$device["facility_name"]; ?>'><?php echo "<b>".$device["facility_name"]."</b>&nbsp&nbsp&nbsp&nbsp(".$device["serial_number"].")"; ?></option>
							<?php } ?>
						</select>
						<span id='locationInfo'></span>
					</div>	
				</div>
				<div class="col-md-2">
					<div class="input-group" style="">
						<span class="input-group-addon small-caption" style="">Report:</span>
						<select required class="textfield form-control" name="report_title_device" id="report_title_device" >
							<option value="">*Select Report Title*</option>
							<option value="1"> Tests Report </option>
							<option value="2"> Errors Report </option>		
							<option value="3"> Summarized By Month </option>
							<option value="4"> Tests & Errors Report </option>						                   	                  					
						</select>
					</div>	
				</div>
				<div class="col-md-2">
					<div class="input-group" >
						<span class="input-group-addon small-caption" >Type :</span>
						<select required class="textfield form-control" name="report_type_device" id="report_type_device" >
							<option value="">*Select Report Type*</option>
							<option value="1"> Detailed </option>
							<option value="2"> Summarized </option>							                   	                  					
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div id="startDate">
						<div class="input-group" style="">
							<span class="input-group-addon small-caption" style=""> From: </span> 
							<input type="text" class="textfield form-control" id="datepickerFromd" name="datepickerFromd">
						</div>
					</div>
					<div id="endDate">
						<div class="input-group" style="">
							<span class="input-group-addon small-caption" style=""> To: </span>
							

							<input type="text" class="textfield form-control"  id="datepickerTod" name="datepickerTod">
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="input-group" style="">
						<span class="input-group-addon small-caption" style=""> Format: </span>
						<select required class="textfield form-control" name="format" id="format"  >
							<option value="">*Select Format*</option>
							<option value="1">PDF</option>
							<option value="2">Excel</option>
						</select>
					</div>	
				</div>
				<div class="col-md-1">
					<button id="click" type="submit"  class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Generate</button>
				</div>
			</div>	
		</form>
	</div>
</div>

<?php $this->load->view("reports_footer_view");?>