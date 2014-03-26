<div>
	<div class="section-title" ><center>Generate Reports</center></div>
	<div>
		<div class="tabbable span12">
				<ul class="nav nav-tabs">
					<li id ="tabPreset" class="active"><a href="#tabs1-preset" data-toggle="tab">Preset</a></li>
					<li id ="tabCustom"><a href="#tabs1-custom" data-toggle="tab">Custom</a></li>
				</ul>
				<div class="tab-content">
					<!-- preset -->
					<div class="tab-pane active" id="tabs1-preset">
						<table>
							<tr>
								<td style="height:330px;width:50%;vertical-align: top;" rowspan="1">
									<center>										
										<div id='mapDiv' style=""></div>
										<script type="text/javascript">										
										var map = new FusionMaps("<?php echo base_url();?>assets/plugins/Fusion/FusionMaps/FCMap_Tanzania.swf", "Tanzania","400","350","0","0");
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
					</div>
					<!-- custom -->
					<div class="tab-pane" id="tabs1-custom">
						<div class="mycontainer">
					<form>
						<div class="input-group" style="width: 100%;padding:4px;">
							<span class="input-group-addon" style="width: 40%;">Criteria :</span>
							<select  class="textfield form-control" >
			                   	<option value="-1">*Select criteria to use*</option>                   					
			                </select>
		                </div>					
						<div class="input-group" style="width: 100%;padding:4px;">
							<span class="input-group-addon" style="width: 40%;">Duration :</span>
							<select  class="textfield form-control" >
			                   	<option value="-1">*Select Duration*</option>                   					
			                </select>
			            </div>	
		                <div class="input-group" style="width: 100%;padding:4px;">
							<span class="input-group-addon" style="width: 40%;">Monthly :</span>
							<select  class="textfield form-control" >
			                   	<option value="-1">*Select Month*</option>                 					
			                </select>
			                <select  class="textfield form-control" >
			                   	<option value="-1">*Select Year*</option>                 					
			                </select>
		                </div>
		                <div class="input-group" style="width: 100%;padding:4px;">
							<span class="input-group-addon" style="width: 40%;">Quarterly :</span>
							<select  class="textfield form-control" >
			                   	<option value="-1">*Select a Quarter*</option>                 					
			                </select>
			                <select  class="textfield form-control" >
			                   	<option value="-1">*Select Year*</option>                 					
			                </select>
		                </div>	
		                <div class="input-group" style="width: 100%;padding:4px;">
							<span class="input-group-addon" style="width: 40%;">Bi-Annually :</span>
							<select  class="textfield form-control" >
			                   	<option value="-1">*Select a bi-annual*</option>                 					
			                </select>
			                <select  class="textfield form-control" >
			                   	<option value="-1">*Select Year*</option>                 					
			                </select>
		                </div>
		                 <div class="input-group" style="width: 100%;padding:4px;">
							<span class="input-group-addon" style="width: 40%;">Yearly :</span>
							<select  class="textfield form-control" >
			                   	<option value="-1">*Select a Year*</option>                 					
			                </select>
		                </div>
		                <div class="input-group" style="width: 100%;padding:4px;">
							<span class="input-group-addon" style="width: 40%;">Custom Dates :</span>
							<div class="input-group" style="width: 100%;">
								<span class="input-group-addon" style="width: 40%;">From :</span>
								<div class="input-group date" id="to_div" data-date="" data-date-format="dd-mm-yyyy">
								  <input id="from" class="span2" size="22%" type="text" value="">
								  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div> 
							<div class="input-group" style="width: 100%;">
								<span class="input-group-addon" style="width: 40%;">to :</span>
								<div class="input-group date" id="from_div" data-date="" data-date-format="dd-mm-yyyy">
								  <input id="to" class="span2" size="22%" type="text" value="">
								  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
		                </div>
		                <div class="input-group" style="width: 100%;padding:4px;">
							<span class="input-group-addon" style="width: 40%;">Format :</span>
							<span class="input-group-addon" style="width: 30%;"><img src="<?php echo img_url();?>pdf.png" width="25" height="25">&nbsp;&nbsp;&nbsp;<input type="radio" name="format" checked value="pdf">PDF</span>
							<span class="input-group-addon" style="width: 30%;"><img src="<?php echo img_url();?>/excel.png" width="30" height="30">&nbsp;&nbsp;&nbsp;<input type="radio" name="format" value="excel">EXCEL</span>
		                </div>									
						<div class="right" style="padding:7px;">
							<button name="viewData" type="button" onclick="viewData()" class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i> Download Report</button>
							<button name="viewData" type="button" onclick="email()" class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-upload"></i> Email Report</button>
							<button name="reset" type="reset"  class="btn btn-default btn-minii"><i class="glyphicon glyphicon-remove"></i> Reset</button>
						</div>						
					</form>
				</div>
			</div>
		</div>
	</div>
</div>