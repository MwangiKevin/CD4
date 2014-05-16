<div class="row">
	<div class="tabbable span12">
		<ul class="nav nav-tabs">
			<li id ="tabSummary" ><a id = "linkSummary"  href="#tabs1-summary" data-toggle="tab">Summary</a></li>
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
								<div id="cd4testtrends"></div>
						    </center>     
						</td>
					
						<td style="height:130px;width:25%;vertical-align: top;">
							<center>
								<div class="section-title" ><center>Device Tests Graphs</center></div>
                                    <div id="equipmenttestscolumn"></div>	
							</center>
						</td>
						
					</tr>
					
					<tr>
						<td style="height:130px;width:30%;vertical-align: top;" >
							<center><div class="section-title" ><center>CD4 Equipment/Equipment and tests</center></div>
								<table class="data-table" style=" margin-left:0px;">
				                    <tbody>
						                <tr>						                	
						                    <td style="background-color:fff; width:50%" >
                                            	<center>CD4 Equipment</center>
												<div id="equipmentpie"></div>
                                            </td>
						                    <td style="background-color:fff; width:50%" >
                                            	<center>Equipment and tests</center>
                                            	<div id="equipmenttestspie"></div>
                                            </td>					                   					                   
						                </tr>
				           	 		</tbody>
				        		</table>
						    </center>       
						</td>
						<td style="height:130px;width:30%;vertical-align: top;">
							<center>
								<div class="section-title" ><center>PIMA Tests for </center></div>
                                <?php $this->tests->tests_table(0,0); ?>
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

