<div class="tabbable span12" style="margin-top:5px;">
	<ul class="nav nav-tabs">
		<li id ="tabPima" class="active"><a href="#tabs1-pima" data-toggle="tab">PIMA</a></li>		
	</ul>
	<div class="tab-content">
		<!-- pima -->
	<div class="tab-pane active" id="tabs1-pima" >
			<div style="width: 100%;">
			<!--<div class="input-group" style="width: 20%;padding:4px;float:left;">
					<span class="input-group-addon" style="width: 40%;">Year:</span>
					<select id="criteriaYear" class="textfield form-control" onchange="">
	                   	<option value="">-Choose Year-</option>
	                  	<?php 
				            $strtyr   = $this->config->item("starting_year");
				            $curryr   = (int)(date("Y"));
				            for($i= $strtyr;$i<=$curryr;$i++){
				        ?>
				         <option value="<?php echo $i;?>"><?php echo $i;?></option>
				          <?php
				            }
				          ?>                					
	                </select>
                </div>
				<div class="input-group" style="width: 20%;padding:4px;float:left;">
					<span class="input-group-addon" style="width: 40%;">Month:</span>
					<select id="criteriaMonth" class="textfield form-control" onchange="">
	                   	<option value="">-Choose Month-</option>
						<option value="1">Jan</option>
						<option value="2">Feb</option>
						<option value="3">Mar</option>
						<option value="4">Apr</option>
						<option value="5">May</option>
						<option value="6">Jun</option> 
						<option value="7">Jul</option>
						<option value="8">Aug</option>
						<option value="9">Sep</option>
						<option value="10">Oct</option>
						<option value="11">Nov</option>
						<option value="12">Dec</option>                   					
	                </select>
                </div>-->
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
			    	<div style="width: 100%;float:left; border:solid;border-color:aliceblue;">
			    		<div id="monthlyerrortrend">
			    		</div>
			    	</div>
			    	<div style="width: 60%;float:left; border:solid;border-color:aliceblue;">
			    		<div id="errortypepie">
			    		</div>
			    	</div>
			    	<div style="width: 40%;float:left;border:solid;border-color:aliceblue;">
			    		<div id="errortable" style="">
			    		</div>
			    	</div>
			    	<div style="width: 100%;float:left; border:solid;border-color:aliceblue;">
			    		<div id="errorscolumn">
			    		</div>
			    	</div>
			  	</div>
			</div>	
		</div>
	</div>
</div>
<?php $this->load->view("errors_footer_view");?>