<div class="row">
	<div class="tabbable span12">
		<div class="tab-content">
			<!-- PIMA -->
			<div class="tab-pane  active" id="tabs1-pima">					
				<table style="float: left; width: 30%">
					<tr>
						<td style="height:130px;width:30%; top;">
						<div class="section-title" ><center>Regions </center></div>
						
							<table  id="datatable-region" style="margin-left:%">
							<thead>
								<th style="background-color: #f2f6fa; text-align: center;"><strong> Name </strong></th>
							</thead>
							<tbody>
								<?php
									foreach($regions as $row){
										$region_name = $row["region_name"];
										$region_id = $row["region_id"];
										echo("<tr id = '".$region_id."' class = 'region'  style='cursor: pointer' ><td><center>".$region_name."</a></center></td></tr>");
									}
								?>
							</tbody>
							</table>
						</td>
				</table>
				<table style="float:right; width: 65%;">
					<tr>
						<td style="height:130px;width:35%;vertical-align: top;">
							<div id="top_tests">
								<center>
									<div class="section-title" ><center>CD4 Tests for <?php echo $date_filter_desc;?> </center></div>
									<div id="tests_table">
										<?php $this->tests->tests_table(0,0); ?>
									</div>
								</center>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div id="bottom_equipment">
								<center>
									<div class="section-title" ><center>Equipment Tests for <?php echo $date_filter_desc;?></center></div>
									<div id="equipment_tests_table">													
										<?php $this->equipment->equipment_tests_table(0,0); ?>
									</div>
								</center>
							</div>
						</td>
					</tr>
				</table>	
			</tr>
				<table style="clear: both;">
					<tr>
						<td id="bottom-sec" style="height:130px;width:40%;vertical-align: top;">
							<center>
								<div>
									<div class="section-title" ><center>CD4 Tests</center></div>
									<div>
										<table id="data-table">
											<thead>
												<tr>
													<th rowspan = "2" >#</th>
													<th rowspan = "1" colspan= "2" style="width:27%"><center>Dates</center></th>
													<th rowspan = "2" ># Facilities Reported</th>
													<th rowspan = "2" style="font-size: 1.0em;color: #2d6ca2;" ># of total tests</th>
													<th rowspan = "2" style="font-size: 1.0em;color: #2aabd2;" ># of valid tests</th>
													<th rowspan = "2" style="font-size: 1.0em;color: #3e8f3e; width:15%;"># of tests &gt= 350 cells/mm3 </th>
													<th rowspan = "2" style="font-size: 1.0em;color: #eb9316; width:15%;"># of tests &lt 350 cells/mm3</th>
													<th rowspan = "2" style="font-size: 1.0em;color: #c12e2a;" ># of errors</th>
												</tr>
												<tr>
													<th>From </th>
													<th> To </th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$i=1;
													foreach ($tests as $test) {				
												?>
												<tr>
													<td><?php echo $i;?></td>
													<td><?php echo Date("Y-F-1",strtotime($test["result_date"]))?></td>
													<td><?php echo Date("Y-F-t",strtotime($test["result_date"]));?></td>
													<td><?php echo $test["facilities_reported"];?></td>
													<td style="font-size: 1.1em;color: #2d6ca2;"><?php echo $test["total_tests"];?></td>
													<td style="font-size: 1.1em;color: #2aabd2;"><?php echo $test["valid"];?></td>
													<td style="font-size: 1.1em;color: #3e8f3e;"><?php echo $test["passed"];?></td>
													<td style="font-size: 1.1em;color: #eb9316;"><?php echo $test["failed"];?></td>
													<td style="font-size: 1.1em;color: #c12e2a;"><?php echo $test["errors"];?></td>
												</tr>
												<?php
														$i++;
													}
												?>
											</tbody>
										</table>
									</div>
								</div>
						    </center>     
						</td>
					</tr>
				</table>
				
			</div>				
		</div><!-- /.tab-content -->
	</div><!-- /.tabbable -->
</div><!-- /.row -->
<?php $this->load->view("nacp_drilldown_footer_view");?>

