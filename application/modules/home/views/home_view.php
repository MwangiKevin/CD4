<div>
	<div>
		<div class="panel panel-default" style="width:40%;margin-right:5px; float:left;box-shadow: 4px 4px 4px #888888;">
			<div id='mapDiv' style="">
				<div class="loader" style"">Loading...</div>
			</div>
			<script type="text/javascript">									
				var map = new FusionMaps("<?php echo base_url();?>assets/plugins/Fusion/FusionMaps/FCMap_Tanzania.swf", "Tanzania","450","450","0","0");
				var xml = "";
				var mapdata;

				$.ajax({
			          type:"POST",
			          async:false,          

			            url:"<?php echo base_url('home/get_xml_map_data');?>",             
			            success:function(data) {
			                      mapdata = data;
			              }
			      });

				//alert(mapdata);
				map.setXMLData("<map  markerBorderColor='000000' markerBgColor='FF5904' markerRadius='6' useHoverColor='1' showMarkerToolTip='1'  showExportDataMenuItem='1' canvasBorderColor='FFFFFF' borderColor='000000' fillColor='FFFFFF' numberSuffix='%' includeValueInLabels='0' labelSepChar=':-:' baseFontSize='9'><data>"+mapdata+"</data><styles><definition><style name='TTipFont' type='font' isHTML='1'  color='FFFFFF' bgColor='666666' size='11'/><style name='HTMLFont' type='font' color='333333' borderColor='CCCCCC' bgColor='FFFFFF'/><style name='myShadow' type='Shadow' distance='1'/></definition><application><apply toObject='MARKERS' styles='myShadow' /><apply toObject='MARKERLABELS' styles='HTMLFont,myShadow' /><apply toObject='TOOLTIP' styles='TTipFont'/></application></styles></map>");
				map.render("mapDiv");
			</script>
		</div>		
		<div class="panel panel-default" style="width:57%; float:right;height:452px;box-shadow: 4px 4px 4px #888888;">
			<div style="font-size: 14px;width:35%; height:22px; float:right; background-color:#33c6e7; color:#fff; opacity:20border-style: double;border-color: black;border-radius: 3px;margin-right:1%" >
				<b><center><div id ="filter-identifier">National<div></center></b>
			</div>
			<div style="width:46%; float:left;">
				<div id="equipmentpie">
					<div class="loader" style"">Loading...</div>	
				</div>		
			</div>
			<div style="width:50%; float:right;margin:4px;">	
				<div>		
					<div class="section-title" ><center>CD4 Equipment </center></div>
					<div id="equipment-table">
						<div class="loader" style"">Loading...</div>	
					</div>									
				</div>
			</div>
			<div style="width:46%; float:left;">	
					<div id="equipmenttestpie">
						<div class="loader" style"">Loading...</div>	
					</div>
			</div>
			<div style="width:50%; float:right;margin:4px;">
				<div>		
					<div class="section-title" ><center>Equipment Tests for <?php echo $date_filter_desc;?></center></div>						
					<div id="equipment-test-table">
						<div class="loader" style"">Loading...</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default" style="width:100%;float:right;box-shadow: 4px 4px 4px #888888;">
		<div style="width:28%; float:left;">
			<div id="equipmenttestscolumn">				
				<div class="loader" style"">Loading...</div>	
			</div>	
		</div>
		<div style="width:40%; float:right;margin:4px;">
			<div>
				<div class="section-title" ><center>CD4 Tests for <?php echo $date_filter_desc;?> </center></div>
				<div id="tests-table">				
					<div class="loader" style"">Loading...</div>	
				</div>	
			</div>
		</div>
		<div style="width:28%; float:right;">
			<div id="testspie">
				<div class="loader" style"">Loading...</div>
			</div>		
		</div>

	</div>
	<div style="width:100%;float:left;">
		<div class="panel panel-default" style="width:100%;float:left;padding:30px;box-shadow: 4px 4px 4px #888888;" id="cd4testtrends">
			<div class="loader" style"">Loading...</div>
		</div>		
		<div class="panel panel-default" style="width:100%;float:left;padding:30px;box-shadow: 4px 4px 4px #888888;" id="expected_reporting_devices">
			<div class="loader" style"">Loading...</div>
		</div>	
	</div>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<div style="height:300px;" >&nbsp;nacpnacpnacp</div>
	<div>&nbsp;</div>
	<div>&nbsp;</div>
	<div>&nbsp;</div>
	<div>&nbsp;</div>
	<div>&nbsp;</div>
</div>
<?php $this->load->view("home_footer_view");?>