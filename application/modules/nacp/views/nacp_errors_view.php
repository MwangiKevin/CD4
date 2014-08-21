<div class="tabbable span12" style="margin-top:5px;">
	<ul class="nav nav-tabs">
		<li id ="tabPima" class="active"><a href="#tabs1-pima" data-toggle="tab">PIMA</a></li>		
	</ul>
	<div class="tab-content">
		<!-- pima -->
	<div class="tab-pane active" id="tabs1-pima" >
			<div style="width: 100%;">
				<div class="input-group" style="width: 25%;padding:4px;float:left;">
					<span class="input-group-addon" style="width: 40%;">Criteria:</span>
					<select id="criteria1" name="criteria1" class="textfield form-control" onchange="secondCriteria(this);">
	                   	<!--<option value="">---Choose Criteria---</option>-->
						<option value="1">National</option>
						<option value="2">Partner</option>
						<option value="3">Region</option>
						<option value="4">District</option>
						<option value="5">Facility</option>
						<option value="6">Device</option>                   					
	                </select>
                </div>
                <div id= "criteria2Div" class="input-group" style="width: 25%;padding:4px;float:left;">
				</div>
            </div>
        	</br>
        	</br>
        	</br>			
            <div class="panel panel-default">
				<div class="panel-heading">
				 	<h3 class="panel-title">Error Trends For <?php echo $date_filter_desc;?></h3>
				</div>
			 	<div class="panel-body">			    	
			    	<div style="width: 100%;float:left; border:solid;border-color:#EEE;">
			    		<div id="monthly_error_trend">
			    		</div>
			    	</div>
			    	<div style="width: 60%;float:left; border:solid;border-color:#EEE;">
			    		<div id="errortypepie">
			    		</div>
			    	</div>
			    	<div style="width: 40%;float:left;border:solid;border-color:#EEE;">
			    		<div id="error_table" style="">
			    		</div>
			    	</div>
			    	<div style="width: 100%;float:left; border:solid;border-color:#EEE;">
			    		<div id="errorscolumn">
			    		</div>
			    	</div>
			  	</div>
			</div>	
		</div>
	</div>
</div>
<?php $this->load->view("nacp_errors_footer_view");?>