<div>

	<div class="section-title" ><center>Select criteria to generate reports</center></div>

	<form method="post" action="<?php echo base_url();?>poc/reports/submit" id="form-report">
		<div>		
			<div class="tab-pane" id="tabs1-custom">
				<table>
					<tr>
						<td style="width:50%">
							<div class="mycontainer" id="full">
								<div class="input-group" style="width: 100%;padding:4px;">
									<span class="input-group-addon" style="width: 40%;">Report Type :</span>
									<select required class="textfield form-control" name="report_type" id="report_type" >
										<option value="0">Show Both Tests and Errors</option> 
										<option value="1"> Tests Report Only</option>
										<option value="2"> Errors Report Only</option>							                   	                  					
									</select>
								</div>
								<div class="input-group" style="width: 100%;padding:4px;">
									<span class="input-group-addon" style="width: 40%;">Criteria :</span>
									<select required class="textfield form-control" id="criteria" name="criteria">
										<option value="">*Select criteria to use*</option>
										<option value="3">Show All</option>
										<option value="1">By Device</option>
										<option value="2">By Facility</option>                  					
									</select>
								</div>
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
								<div class="input-group" style="width: 100%;padding:4px;" >
									<span class="input-group-addon" style="width: 40%;" >Duration :</span>
									<select  class="textfield form-control" id="duration" name="Duration" >
										<option value="">*Select Duration*</option>
										<option value="1">Monthly</option>
										<option value="2">Quartely</option>
										<option value="3">Bi-Annually</option>
										<option value="4">Yearly</option>
										<option value="5">Customize Dates</option>                   					
									</select>
									<input type = "hidden" name = "date_from"  id = "date_from"/> 
									<input type = "hidden" name = "date_to"    id = "date_to"  /> 
								</div>	
								<div class="input-group" style="width: 100%;padding:4px;" id="monthlydiv">
									<span class="input-group-addon" style="width: 40%;">Monthly :</span>
									<select class="textfield form-control" style='border-radius:0px 5px 5px 0px;' name="monthly_month" id="monthly_month">
										<option value="">*Select Month*</option>
										<option value="00">January</option>
										<option value="01">February</option>
										<option value="02">March</option>
										<option value="03">April</option>
										<option value="04">May</option>
										<option value="05">June</option>
										<option value="06">July</option>
										<option value="07">August</option>
										<option value="08">September</option>
										<option value="09">October</option>
										<option value="10">November</option>
										<option value="11">December</option>                 					
									</select>
									<select  class="textfield form-control" style='border-radius:0px 5px 5px 0px;' name="monthly_year" id="monthly_year" >
										<option value="">*Select Year*</option>
										<?php 

										$this_year = (int) Date("Y");
										for($i=$starting_year;$i<=$this_year;$i++){ 

											?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
											<?php 
										} 
										?>                 					
									</select>
								</div>
								<div class="input-group" style="width: 100%;padding:4px;" id="quarterlydiv">
									<span class="input-group-addon" style="width: 40%;">Quarterly :</span>
									<select  class="textfield form-control" style='border-radius:0px 5px 5px 0px;' name="quarterly_quarter" id="quarterly_quarter" >
										<option value="">*Select a Quarter*</option>
										<option value="1">January - March</option>
										<option value="2">April - June</option>
										<option value="3">July - September</option>
										<option value="4">October - December</option>                 					
									</select>
									<select  class="textfield form-control" name="quarterly_year" id="quarterly_year" >
										<option value="">*Select Year*</option>
										<?php 

										$this_year = (int) Date("Y");
										for($i=$starting_year;$i<=$this_year;$i++){ 

											?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
											<?php 
										} 
										?>                					
									</select>
								</div>	
								<div class="input-group" style="width: 100%;padding:4px;" id="biannualdiv">
									<span class="input-group-addon" style="width: 40%;">Bi-Annually :</span>
									<select  class="textfield form-control" style='border-radius:0px 5px 5px 0px;' name="biannually_bian" id="biannually_bian">
										<option value="">*Select a bi-annual*</option>
										<option value="1">January - June</option>
										<option value="2">July - December</option>                  					
									</select>
									<select  class="textfield form-control" name="biannually_year"  id="biannually_year" >
										<option value="">*Select Year*</option>	
										<?php 

										$this_year = (int) Date("Y");
										for($i=$starting_year;$i<=$this_year;$i++){ 

											?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>


											<?php } ?>                 					
										</select>
									</div>
									<div class="input-group" style="width: 100%;padding:4px;" id="yearlydiv">
										<span class="input-group-addon" style="width: 40%;">Yearly :</span>
										<select  class="textfield form-control" name="yearly" id="yearly">
											<option value="">*Select a Year*</option>
											<?php 

											$this_year = (int) Date("Y");
											for($i=$starting_year;$i<=$this_year;$i++){ 

												?>
												<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
												<?php 
											} 
											?>                 					
										</select>
									</div>
									<div class="input-group" style="width: 100%;padding:4px;" id="CustDatesdiv">
										<span class="input-group-addon" style="width: 40%;">Custom Dates :</span>
										<div class="input-group" style="width: 100%;">
											<span class="input-group-addon" style="width: 40%;">From :</span>
											<input type="text" id="datepickerFrom" placeholder="From" readonly name="cust_date_from" style="width:150px;">
										</div> 
										<div class="input-group" style="width: 100%;">
											<span class="input-group-addon" style="width: 40%;">to :</span>
											<input type="text" id="datepickerTo" placeholder="To" readonly name="cust_date_to" style="width:150px;">
										</div>
									</div>
								</div>
							</td>
							<td>
								<div class="mycontainer" id="full">
									<div class="input-group" style="width: 100%;padding:4px;">
										<span class="input-group-addon" style="width: 40%;">Format :</span>
										<span class="input-group-addon" style="width: 30%;"><img src="<?php echo img_url();?>pdf.png" width="25" height="25">&nbsp;&nbsp;&nbsp;<input type="radio" name="format" disabled value="pdf">PDF</span>
										<span class="input-group-addon" style="width: 30%;"><img src="<?php echo img_url();?>/excel.png" width="30" height="30">&nbsp;&nbsp;&nbsp;<input type="radio" name="format" checked value="excel">EXCEL</span>
									</div>									
									<div class="right" style="padding:7px 32px 7px 7px;">
										<button id="click" type="submit" onclick="consolidate_dates()" class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Download Report</button>
										<!-- <button name="viewData" type="submit" class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-upload"></i> Download Email Report</button> -->
										<button name="reset" type="reset" onclick="hide_divs()"  class="btn btn-default btn-minii"><i class="glyphicon glyphicon-remove"></i> Reset</button>
									</div>						
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</form>
</div>

<?php $this->load->view("reports_footer_view");?>