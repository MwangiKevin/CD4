<script language="javascript">
$(function() {
$('#datepickerFrom').datepicker({dateFormat: 'yy-mm-dd', maxDate: new Date(),changeMonth: true,changeYear: true});
$('#datepickerTo').datepicker({dateFormat: 'yy-mm-dd'});

   /**
    *  On the 'On change' event listener, 
    *  dynamically re-create the 'end' date based
    *  on the Start date.
   **/
   $('#datepickerFrom').on("change", function() {

       //Begin the re-creation
       $('#datepickerTo').datepicker( "destroy" );

       $('#datepickerTo').datepicker({
                /**
                 * Set the date to be the same as the first
                **/
                minDate : $('#datepickerFrom').datepicker( "getDate" ),
                dateFormat: 'yy-mm-dd',
                maxDate: new Date(),
                changeMonth: true,
                changeYear: true
                
                //Optional: setDate: The same as minDate.
             });
        });

});

$(document).ready(function(){
  $("#dev").hide();
	$('#criteria').change(function(){
		var k=$('#criteria').val();
		if(k==1){
			$('#dev').show();
		}else{
		 $("#dev").hide();	
		}
	
		//alert("me");
	});
});

$(document).ready(function(){
  $("#facility").hide();
	$('#criteria').change(function(){
		var k=$('#criteria').val();
		if(k==2){
			$('#facility').show();
		}else{
		 $("#facility").hide();	
		}
	
		//alert("me");
	});
});
$(document).ready(function(){
  $("#CustDates").hide();
	$('#duration').change(function(){
		var k=$('#duration').val();
		if(k==5){
			$('#CustDates').show();
		}else{
		 $("#CustDates").hide();	
		}
	
		//alert("me");
	});
});
$(document).ready(function(){
  $("#monthlyM").hide();
	$('#duration').change(function(){
		var k=$('#duration').val();
		if(k==1){
			$('#monthlyM').show();
		}else{
		 $("#monthlyM").hide();	
		}
	
		//alert("me");
	});
});

$(document).ready(function(){
  $("#quarterlyD").hide();
	$('#duration').change(function(){
		var k=$('#duration').val();
		if(k==2){
			$('#quarterlyD').show();
		}else{
		 $("#quarterlyD").hide();	
		}
	
		//alert("me");
	});
});

$(document).ready(function(){
  $("#biannual").hide();
	$('#duration').change(function(){
		var k=$('#duration').val();
		if(k==3){
			$('#biannual').show();
		}else{
		 $("#biannual").hide();	
		}
	
		//alert("me");
	});
});

$(document).ready(function(){
  $("#year").hide();
	$('#duration').change(function(){
		var k=$('#duration').val();
		if(k==4){
			$('#year').show();
		}else{
		 $("#year").hide();	
		}
	
		//alert("me");
	});
});




function bootstrap()
{
	
	var select = document.getElementById("criteria").value;
	
	if(select==1)
	{

	}
	else if(select==2)
	{
		var facility = document.getElementById("facilities").value;

		if(facility!='')
		{
			$("#report_error").modal("show");//Call Modal Dialog
		}
	}
	else
	{
		$("#report_error").modal("show");//Call Modal Dialog
		function a(e){e.preventDefault();}
	}

	//$("#report_error").modal("show");//Call Modal Dialog
	

}

function hide_divs()
{
	$("#year").hide();
	$("#biannual").hide();
	$("#quarterlyD").hide();
	$("#monthlyM").hide();
	$("#CustDates").hide();
	$("#dev").hide();
	$("#facility").hide();		

}


</script>
<style type="text/css">

#Labels
{
	border:1px solid rgb(204,204,204);
	font-family:Verdana;
	background-color: #F2F2F2;
	border-radius: 5px 0px 0px 5px;
	padding:5px 5px 2px 5px;
	width: 100px;
	margin-left: 5px;
	position: absolute;
}
#ComboBoxesData
{
	margin-left:109px;
}

</style>
<div>
	<div class="section-title" ><center>Generate Reports</center></div>
	<div>
		<!-- <div class="tabbable span12"> -->
			<!-- <ul class="nav nav-tabs">
				<li id ="tabPreset" class="active"><a href="#tabs1-preset" data-toggle="tab">Preset</a></li>
				<li id ="tabCustom"><a href="#tabs1-custom" data-toggle="tab">Reports</a></li>
			</ul> -->
			<!-- <div class="tab-content"> -->
				<!-- preset -->
				<!-- div class="tab-pane active" id="tabs1-preset">
					<table>
						<tr>
							<td style="height:330px;width:50%;vertical-align: top;" rowspan="1">
								<center>										
									<div id='mapDiv' style=""></div>
									<script type="text/javascript">										
										var map = new FusionMaps("<?php echo base_url();?>assets/plugins/Fusion/FusionMaps/FCMap_KenyaCounty.swf", "Tanzania","400","350","0","0");
										//map.setDataURL("xml/commoditymap.php");
										map.render("mapDiv");
									</script>
								</center>
							</td>
							<td>									
								<div style="vertical-align:center">
									<div class="section-title">All <a><div class="right"><i class="glyphicon glyphicon-stats"></i></div></a></div>
									<div class="section-title">Tests <a><div class="right"><i class="glyphicon glyphicon-stats"></i></div></a></div>
									<div class="section-title">Errors <a><div class="right"><i class="glyphicon glyphicon-stats"></i></div></a></div>
									<div class="section-title">Equipment <a><div class="right"><i class="glyphicon glyphicon-stats"></i></div></a></div>
								</div>									
							</td>
						</tr>
						<tr>
							<td colspan="2"></td>
						</tr>
					</table>						
				</div> -->
				<!-- custom -->
				<div class="tab-pane" id="tabs1-custom">
					<form method="post" action="<?php echo base_url();?>poc/reports/reportSpecs" id="form-report">
						<table>
							<tr>
								<td style="width:50%">
									<div class="mycontainer" id="full">
										<div class="input-group" style="width: 100%;padding:4px;">
											<span class="input-group-addon" style="width: 40%;">Criteria :</span>
											<select  class="textfield form-control" id="criteria" name="the_criteria">
							                   	<option value="-1">*Select criteria to use*</option>
							                   	<option value="3">Show All Data</option>
							                   	<option value="1">By Device</option>
							                   	<option value="2">By Facility</option>                  					
							                </select>
						                </div>
						                <div class="input-group" style="width: 100%;padding:4px;">
											<span class="input-group-addon" style="width: 40%;">Report Type :</span>
											<select  class="textfield form-control" name="report_type" id="test_errors" >
							                   	<option value="0">*Show Both Tests and Errors*</option> 
							                   	<option value="1"> Tests Report Only</option>
							                   	<option value="2"> Errors Report Only</option>							                   	                  					
							                </select>
						                </div>
						                <div class="input-group" style="width: 100%;padding:4px;" id="dev">
						                	<span class="input-group-addon" style="width:40%">Device:</span>
					              		
					              			<select name='device' id='devices' style='border-radius:0px 5px 5px 0px;'; class="textfield form-control">
							              		<option value='' selected='selected'>*Select Device*</option>
							              		<?php foreach($DeviceNumberOptions as $DeviceNumber){ ?>
							              		<option value='<?php echo $DeviceNumber; ?>'><?php echo $DeviceNumber; ?></option>
							              		<?php } ?>
								              	</select>
							              	<span id='locationInfo'></span>
					              		</div>

					              		<div class="input-group" style="width: 100%;padding:4px;" id="facility">
						                	<span class="input-group-addon" style="width: 40%;">Facility:</span>
					              		
					              			<select name='facility' id='facilities' style="border-radius:0px 5px 5px 0px;"  class="textfield form-control">
							              		<option value='' selected='selected'>*Select Facility*</option>
							              		<?php foreach($FacilitiesList as $fname){ ?>
							              		<option value='<?php echo $fname; ?>'><?php echo $fname; ?></option>
							              		<?php } ?>
								              	</select>
							              	<span id='locationInfo'></span>
					              		</div>  					
										<div class="input-group" style="width: 100%;padding:4px;" >
											<span class="input-group-addon" style="width: 40%;" >Duration :</span>
											<select  class="textfield form-control" id="duration" name="Duration" >
							                   	<option value="-1">*Select Duration*</option>
							                   	 <option value="1">Monthly</option>
							                     <option value="2">Quartely</option>
								                 <option value="3">Bi-Annually</option>
								                 <option value="4">Yearly</option>
								                 <option value="5">Customize Dates</option>                   					
							                </select>
							            </div>	
						                <div class="input-group" style="width: 100%;padding:4px;" id="monthlyM">
											<span class="input-group-addon" style="width: 40%;">Monthly :</span>
											<select class="textfield form-control" style='border-radius:0px 5px 5px 0px;' name="FieldM">
							                   	<option value="">*Select Month*</option>
							                   	<option value="01">January</option>
					                            <option value="2">February</option>
					                          	<option value="03">March</option>
					                          	<option value="04">April</option>
					                          	<option value="05">May</option>
					                          	<option value="06">June</option>
					                          	<option value="07">July</option>
					                          	<option value="08">August</option>
					                          	<option value="09">September</option>
					                          	<option value="10">October</option>
					                          	<option value="11">November</option>
					                          	<option value="12">December</option>                 					
							                </select>
							                <select  class="textfield form-control" style='border-radius:0px 5px 5px 0px;' name="YearM" onchange="">
							                   	<option value="">*Select Year*</option>
							                   	<?php foreach($yearlyReports as $Year){?>
					                            <option value="<?php echo $Year['yr']; ?>"><?php echo $Year['yr']; ?></option>
					                            <?php } ?>                 					
							                </select>
						                </div>
						                <div class="input-group" style="width: 100%;padding:4px;" id="quarterlyD">
											<span class="input-group-addon" style="width: 40%;">Quarterly :</span>
											<select  class="textfield form-control" style='border-radius:0px 5px 5px 0px;' name="quarterly" >
							                   	<option value="">*Select a Quarter*</option>
							                   	<option value="1">January - April</option>
                              					<option value="2">May - August</option>
                              					<option value="3">September - December</option>                 					
							                </select>
							                <select  class="textfield form-control" name="YearQ" >
							                   	<option value="">*Select Year*</option>
							                   	<?php foreach($yearlyReports as $Year){?>
                              					<option value="<?php echo $Year['yr']; ?>"><?php echo $Year['yr']; ?></option>
                              					<?php } ?>                 					
							                </select>
						                </div>	
						                <div class="input-group" style="width: 100%;padding:4px;" id="biannual">
											<span class="input-group-addon" style="width: 40%;">Bi-Annually :</span>
											<select  class="textfield form-control" style='border-radius:0px 5px 5px 0px;' name="bian">
							                   	<option value="">*Select a bi-annual*</option>
							                   	<option value="1">January - June</option>
                              					<option value="2">July - December</option>                  					
							                </select>
							                <select  class="textfield form-control" name="YearB" >
							                   	<option value="">*Select Year*</option>
							                   	<?php foreach($yearlyReports as $Year){?>
					                            <option value="<?php echo $Year['yr']; ?>"><?php echo $Year['yr']; ?></option>
					                            <?php } ?>                 					
							                </select>
						                </div>
						                <div class="input-group" style="width: 100%;padding:4px;" id="year">
											<span class="input-group-addon" style="width: 40%;">Yearly :</span>
											<select  class="textfield form-control" name="YearO">
							                   	<option value="">*Select a Year*</option>
							                   	<?php foreach($yearlyReports as $Year){?>
					                            <option value="<?php echo $Year['yr']; ?>"><?php echo $Year['yr']; ?></option>
					                            <?php } ?>                 					
							                </select>
						                </div>
						                <div class="input-group" style="width: 100%;padding:4px;" id="CustDates">
											<span class="input-group-addon" style="width: 40%;">Custom Dates :</span>
											<div class="input-group" style="width: 100%;">
												<span class="input-group-addon" style="width: 40%;">From :</span>
												<input type="text" id="datepickerFrom" placeholder="From" name="FromDate" style="width:150px;">
											</div> 
											<div class="input-group" style="width: 100%;">
												<span class="input-group-addon" style="width: 40%;">to :</span>
												<input type="text" id="datepickerTo" placeholder="To" name="ToDate" style="width:150px;">
											</div>
						                </div>
						            </div>
						        </td>
						        <td>
									<div class="mycontainer" id="full">
						                 
						                <div class="input-group" style="width: 100%;padding:4px;">
											<span class="input-group-addon" style="width: 40%;">Format :</span>
											<span class="input-group-addon" style="width: 30%;"><img src="<?php echo img_url();?>pdf.png" width="25" height="25">&nbsp;&nbsp;&nbsp;<input type="radio" name="format" checked value="pdf">PDF</span>
											<span class="input-group-addon" style="width: 30%;"><img src="<?php echo img_url();?>/excel.png" width="30" height="30">&nbsp;&nbsp;&nbsp;<input type="radio" name="format" value="excel">EXCEL</span>
						                </div>									
										<div class="right" style="padding:7px 32px 7px 7px;">
											<button id="click" type="submit" onclick="" class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Download Report</button>
											<button name="viewData" type="submit" class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-upload"></i> Email Report</button>
											<button name="reset" type="reset" onclick="hide_divs()"  class="btn btn-default btn-minii"><i class="glyphicon glyphicon-remove"></i> Reset</button>
										</div>						
									</div>
								</td>
							</tr>
						</table>
					</form>


					<div class="modal fade" id="report_error" >
					  	<div class="modal-dialog" style="width:37%;margin-bottom:2px;">
					    	<div class="modal-content" >

					    		<div class="modal-header">
					        		<h4 class="modal-title">Report Details</h4>
					      		</div>

				      			<div class="modal-body" style="padding-bottom:0px;">
				      				The data for the month or year you have selected does not exist
				      				or has not yet been collected
				      			</div>
				      			<div class="modal-footer" style="height:30px;padding-top:4px;">
				      				<?php echo $this->config->item("copyrights");?>
				      			</div>

					    	</div>
					    </div>
					</div>





				</div>
			<!-- </div> -->
		<!-- </div> -->
	</div>
</div>