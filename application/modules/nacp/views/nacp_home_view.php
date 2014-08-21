<div class="row">
	<div class="tabbable span12">
		<ul class="nav nav-tabs">
			<li id ="tabPima" class="active"><a id = "linkPima" href="#tabs1-pima" data-toggle="tab">PIMA</a></li>
		</ul>
		<div class="tab-content">

			<!-- PIMA -->
			<div class="tab-pane  active" id="tabs1-pima">					
				<table>
					<tr>
						<td style="height:130px;width:40%; top;">
							<center>
								<div class="section-title" ><center>Above 350 below 350 curve </center></div>
								<div id="cd4testtrends">
									<div class="loader" style"">Loading...</div>
								</div>
						    </center>     
						</td>
					
						<td style="height:130px;width:25%;vertical-align: top;">
							<center>
								<div class="section-title" ><center>Device Tests Graphs</center></div>
                                    <div id="equipmenttestscolumn">
										<div class="loader" style"">Loading...</div>
									</div>	
							</center>
						</td>
						
					</tr>
					
					<tr>
						<td style="height:130px;width:30%;vertical-align: top;" >
							<center><div class="section-title" ><center>CD4 Equipment/Equipment and tests</center></div>
								<table class="data-table" style=" margin-left:0px;">
				                    <tbody>
						                <tr>						                	
						                    <td style="background-color:#fff; width:50%" >
                                            	<center>CD4 Equipment</center>
												<div id="equipmentpie">
													<div class="loader" style"">Loading...</div>
												</div>
                                            </td>
						                    <td style="background-color:#fff; width:50%" >
                                            	<center>Equipment and tests</center>
                                            	<div id="equipmenttestspie">
													<div class="loader" style"">Loading...</div>
												</div>
                                            </td>					                   					                   
						                </tr>
				           	 		</tbody>
				        		</table>
						    </center>       
						</td>
						<td style="height:130px;width:30%;vertical-align: top;">
							<center>
								<div class="section-title" ><center>PIMA Tests for <?php echo $date_filter_desc; ?> </center></div>                          
                            	<div id="tests_table">
									<div class="loader" style"">Loading...</div>
								</div>
								<div id="yearlyTestReportingRates" style="align:center;"></div>
						
						    </center>     
						</td>
					</tr>
				</table>
			</div>				
		</div><!-- /.tab-content -->
	</div><!-- /.tabbable -->
</div><!-- /.row -->

<?php $this->load->view("nacp_home_footer_view");?>

