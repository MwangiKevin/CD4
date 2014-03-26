<div class="row">
	<div class="tabbable span12">
		<ul class="nav nav-tabs">
			<li id ="tabSummary" class="active"><a id = "linkSummary"  href="#tabs1-summary" data-toggle="tab">Summary</a></li>
			<li id ="tabPima"><a id = "linkPima" href="#tabs1-pima" data-toggle="tab">PIMA</a></li>
		</ul>
		<div class="tab-content">

			<!-- SUMMARRY -->
			<div class="tab-pane active" id="tabs1-summary">				
				<table>
					<tr>
						<td style="height:130px;width:30%;vertical-align: top;">
							<center>
								<div class="section-title" ><center>CD4 Tests for Year <?php echo $date_filter_year;?></center></div>
								<div id="yearlyDeviceTestTrends" style="align:center;"></div>
								<script type="text/javascript">
								    FusionCharts.setCurrentRenderer('javascript');
								    var myChart = new FusionCharts( "FusionCharts/MSLine.swf", "chartyearlyDeviceTestTrends","400", "220", "0", "0");
								    myChart.setJSONUrl(" <?php echo base_url()?>partner/charts/yearly_device_test_trends");
								    myChart.render("yearlyDeviceTestTrends");							    
							    </script>
						    </center>       
						</td>
						<td style="height:130px;width:30%;vertical-align: top;">
							<center>
								<div class="section-title" ><center>% CD4 Tests for Year <?php  echo $date_filter_year;?></center></div>
								<div id="yearlyDeviceTestPerc" style="align:center;"></div>
								<script type="text/javascript">
								    FusionCharts.setCurrentRenderer('javascript');
								    var myChart = new FusionCharts( "FusionCharts/Doughnut2D.swf", "chartyearlyDeviceTestPerc","400", "220", "0", "0");
								    myChart.setJSONUrl(" <?php echo base_url()?>partner/charts/yearly_device_test_perc");
								    myChart.render("yearlyDeviceTestPerc");							    
							    </script>
						    </center>     
						</td>
						<td style="height:130px;width:35%;vertical-align: top;">
							<center>
								<div class="section-title" ><center>CD4 Tests < 350cell/mm3 For <?php echo $date_filter_desc;?></center></div>
								<table class="data-table" style=" margin-left:0px;">
				                    <tbody>
				                    	<tr class="even">
					                        <th>&nbsp;</th>
					                        <th><center>Tests</center></th>
					                        <th nowrap="nowrap"><center>&lt;350</center></th>
					                        <th nowrap="nowrap"><center>&lt;350 % </center></th>					                        
				                    	</tr>
				                    	<?php 
				                    		foreach ($devices_tests_totals as $device ) { 
				                    	?>
						                <tr>
						                    <td style="background-color:#CCCCCC " nowrap="nowrap"><b></b><center><b><?php echo $device['description']?></b></center></td>
						                    <td><center><?php echo $device['total']?></center></td>
						                    <td><center><?php echo $device['fails']?></center></td>
						                    <td><center><?php echo $device['fails_perc']?></center></td>						                    
						                </tr>
						                <?php 
						                	}
						                ?>						               
				           	 		</tbody>
				        		</table>
							</center>
						</td>
					</tr>
					<tr>
						
						<td style="height:130px;width:30%;vertical-align: top;">
							<center>
								<div class="section-title" ><center> Device reporting trends for <?php  echo $date_filter_year;?></center></div>
								<div id="periodicTestPerc" style="align:center;"></div>
								<script type="text/javascript">
								    FusionCharts.setCurrentRenderer('javascript');
								    var myChart = new FusionCharts( "FusionCharts/MSLine.swf", "chartperiodicTestPerc","400", "220", "0", "0");
								    myChart.setJSONUrl(" <?php echo base_url()?>partner/charts/yearly_device_reporting_trends");
								    myChart.render("periodicTestPerc");							    
							    </script>
						    </center>     
						</td>
						<td style="height:130px;width:30%;vertical-align: top;">
							<center>
								<div class="section-title" ><center>CD4 Devices used for <?php  echo $date_filter_year;?></center></div>
								<div id="periodicDeviceTestPerc" style="align:center;"></div>
								<script type="text/javascript">
								    FusionCharts.setCurrentRenderer('javascript');
								    var myChart = new FusionCharts( "FusionCharts/Doughnut2D.swf", "chartperiodicDeviceTestPerc","400", "220", "0", "0");
								    myChart.setJSONUrl(" <?php echo base_url()?>partner/charts/periodic_device_test_perc");
								    myChart.render("periodicDeviceTestPerc");							    
							    </script>
						    </center>       
						</td>
						<td style="height:130px;width:35%;vertical-align: top;">
							<center>
								
							</center>
						</td>
					</tr>
				</table>
			</div>
			<!-- PIMA -->
			<div class="tab-pane" id="tabs1-pima">					
				<table>
					<tr>
						<td style="height:130px;width:30%;vertical-align: top;">
							<center>
								<div class="section-title" ><center>Pima Reporting trends for year <?php  echo $date_filter_year;?></center></div>
								<div id="yearlyFacilityPimaReportingRates" style="align:center;"></div>
								<script type="text/javascript">
								    FusionCharts.setCurrentRenderer('javascript');
								    var myChart = new FusionCharts( "FusionCharts/MSLine.swf", "chartyearlyFacilityPimaReportingRates","400", "220", "0", "0");
								    myChart.setJSONUrl(" <?php echo base_url()?>partner/charts/yearly_facility_pima_reporting_rates");
								    myChart.render("yearlyFacilityPimaReportingRates");							    
							    </script>
						    </center>     
						</td>
						<td style="height:130px;width:30%;vertical-align: top;">
							<center>
								<div class="section-title" ><center>Device Errors For: <?php  echo $date_filter_desc;?></center></div>
								<div id="periodicTestErrorPerc" style="align:center;"></div>
								<script type="text/javascript">
								    FusionCharts.setCurrentRenderer('javascript');
								    var myChart = new FusionCharts( "FusionCharts/Pie2D.swf", "chartperiodicTestErrorPerc","400", "220", "0", "0");
								    myChart.setJSONUrl(" <?php echo base_url()?>partner/charts/periodic_test_error_perc");
								    myChart.render("periodicTestErrorPerc");							    
							    </script>
						    </center>       
						</td>
						<td style="height:130px;width:35%;vertical-align: top;">
							<center>
								<div class="section-title" ><center>Statistics for : <?php  echo $date_filter_desc;?></center></div>
								<table class="data-table" style=" margin-left:0px;">
				                    <tbody>
				                    	<?php 
				                    		foreach ($pima_statistics as $pima_s ) { 
				                    	?>
						                <tr>						                	
						                    <td><center><?php echo $pima_s['caption'];?></center></td>
						                    <td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2"><center><?php echo $pima_s['data'];?></center></td>					                   					                   
						                </tr>
						                <?php 
				                    		} 
				                    	?> 
				           	 		</tbody>
				        		</table>
							</center>
						</td>
					</tr>
					<tr>
						<td style="height:130px;width:30%;vertical-align: top;" colspan="2">
							<center>
								<div class="section-title" ><center>Errors encountered For: <?php echo $date_filter_desc;?></center></div>
								<div id="chartTestDataColumn" style="align:center;"></div>
								<script type="text/javascript">
								    FusionCharts.setCurrentRenderer('javascript');
								    var myChart = new FusionCharts( "FusionCharts/Column2D.swf", "chartchartTestDataColumn","820", "220", "0", "0");
								    myChart.setJSONUrl(" <?php echo base_url()?>partner/charts/periodic_facility_pima_errors");
								    myChart.render("chartTestDataColumn");							    
							    </script>
						    </center>       
						</td>
						<td style="height:130px;width:30%;vertical-align: top;">
							<center>
								<div class="section-title" ><center>% CD4 Tests for Year <?php echo $date_filter_year;?></center></div>
								<div id="yearlyTestReportingRates" style="align:center;"></div>
								<script type="text/javascript">
								    FusionCharts.setCurrentRenderer('javascript');
								    var myChart = new FusionCharts( "FusionCharts/MSLine.swf", "chartyearlyTestReportingRates","400", "220", "0", "0");
								    myChart.setJSONUrl(" <?php echo base_url()?>partner/charts/yearly_test_reporting_rates");
								    myChart.render("yearlyTestReportingRates");							    
							    </script>
						    </center>     
						</td>
					</tr>
				</table>
			</div>				
		</div><!-- /.tab-content -->
	</div><!-- /.tabbable -->
</div><!-- /.row -->
