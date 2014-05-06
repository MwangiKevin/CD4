<div>
	<div style="width:40%; float: left;">
		<div id='mapDiv' style=""></div>
		<script type="text/javascript">									
		var map = new FusionMaps("<?php echo base_url();?>assets/plugins/Fusion/FusionMaps/FCMap_Tanzania.swf", "Tanzania","570","460","0","0");
		var xml = "";
		map.setXMLData("<map  markerBorderColor='000000' markerBgColor='FF5904' markerRadius='6' legendPosition='right' legendAllowDrag='1' useHoverColor='1' showMarkerToolTip='1'  showExportDataMenuItem='1' canvasBorderColor='FFFFFF' borderColor='000000' fillColor='FFFFFF' numberSuffix='%' includeValueInLabels='0' labelSepChar=':-:' baseFontSize='9'><colorRange gradient='1' minValue='0' code='CC0001' startlabel='Bad (%)' endLabel='Very Good (%)'><color maxValue='20' displayValue='Poor' code='FF0000' /><color maxValue='50' displayValue='Average' code='FFCC33' /><color maxValue='100' code='069F06' /></colorRange><data><?php echo $xmldata;?></data><styles><definition><style name='TTipFont' type='font' isHTML='1'  color='FFFFFF' bgColor='666666' size='11'/><style name='HTMLFont' type='font' color='333333' borderColor='CCCCCC' bgColor='FFFFFF'/><style name='myShadow' type='Shadow' distance='1'/></definition><application><apply toObject='MARKERS' styles='myShadow' /><apply toObject='MARKERLABELS' styles='HTMLFont,myShadow' /><apply toObject='TOOLTIP' styles='TTipFont'/></application></styles></map>");
		map.render("mapDiv");
		</script>
	</div>
	
	<div class="panel panel-default" style="width:47%; float:right;height:452px;box-shadow: 4px 4px 4px #888888;">
		<div style="font-size: 14px;width:35%; height:22px; margin:auto; padding-left: 13%; background-color:#33c6e7; color:#fff; opacity:20border-style: double;border-color: black;border-radius: 3px;" >
			<div>Facilities</div>
		</div>
		
		<!-- <div style="width:48%; float:left; box-shadow: 1px 0px 1px 1px #888888; margin:4px; height: 420px">
			<div>
				<div class="section-title" ><center>Reported</center></div>
			</div>		
		</div>
		
		<div style="width:48%; float:right;box-shadow: 1px 0px 1px 1px #888888; margin:4px; height: 420px">	
			<div>		
				<div class="section-title" ><center>Not yet reported </center></div>									
			</div>
		</div> -->
		<div style="width:90%; float:left; box-shadow: 1px 0px 1px 1px #888888; margin-left:28px; height: 210px">
			<div>
				<div class="section-title" ><center>Reported</center></div>
				<center><table style="width:60%" id = "datatable-reported" >
					<thead>
						<th><strong>Region Name</strong></th>
						<th><strong>Facility Name</strong></th>
					</thead>
					<?php
					//prints the reported facilities
					foreach($reported as $row){							
						echo ("<tr> <td>".$row["region_name"]." </td> <td>". $row['facility_name']."  </td> </tr>");
					}				
					?>
				</table></center>
			</div>		
		</div>
		
		<div style="width:90%; box-shadow: 1px 0px 1px 1px #888888; margin:auto;  clear: both; margin-top:5px; height: 210px">	
			<div>		
				<div class="section-title" ><center>Not yet reported </center></div>
				<center>
					<table style="width: 60%;" id= "datatable-unreported">
						<thead>
							<th><strong> Name </strong></th>
							<th><strong> Facility Name </strong></th>
						</thead>
						<?php
					//prints the unreported facilities
						foreach($unreported as $row){							
							echo ("<tr> <td>".$row["region_name"]." </td> <td>". $row['facility_name']."  </td> </tr>");
						}				
						?>
					</table>
				</center>									
			</div>
		</div>
	</div>
	
	
	<div style="width:100%;float:left;">
		<div class="panel panel-default" style="width:100%;float:left;padding:30px;box-shadow: 4px 4px 4px #888888;" id="cd4testtrends">
			<div class="section-title"  style="text-align: center;" ><strong> Commodity Timeline </strong></div>
			<center><div id="HLineargauge"></div></center>
			
			<?php //echo Modules::run('charts/reporting/reporting_view'); ?>
			
			<script type="text/javascript">

			// var myChart = new FusionCharts("<?php echo base_url();?>assets/plugins/Fusion/FusionWidgets/Charts/HLinearGauge.swf", "myChartId", "950", "110", "0", "0");
			// //myChart.setDataURL();//location of php file
			// myChart.setDataURL("<?php echo base_url();?>assets/xml/test.xml");
			// myChart.render("HLineargauge");

			</script> 
			
		</div>
		<div class="panel panel-default" style="width:100%;float:left;padding:30px;box-shadow: 4px 4px 4px #888888;" id="expected_reporting_devices"></div>	
	</div>
</div>

<?php $this->load->view("nacp_reporting_cycle_footer_view");?>