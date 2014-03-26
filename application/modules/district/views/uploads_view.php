<center>
	<div class="section-title" ><center>Last 5 CD4 uploads</center></div>
	<div style="margin-bottom:20px">
		<table id="data-table" class="data-table">
			<thead>				
					<th>#</th>
					<th>Date</th>
					<th>Device number</th>
					<th>Facility</th>
					<th>Uploaded by</th>
					<th># of tests</th>
					<th># of errors</th>
			</thead>
			<tbody>				
			</tbody>
		</table>
	</div>		
</center>	
<div class="section-title" style="margin-right:53%;"><center>upload new:</center></div>
<div style="margin-right:55%;">
	<table>
		<tr>
			<?php
				echo "<td>";
					echo form_upload('pimaUpload','Pima upload','class="btn btn-default"');
				echo "</td>";
				echo "<td>";
					echo form_button('viewData','<i class="glyphicon glyphicon-list"></i> View Data','onclick="viewData()" class="btn btn-default btn-minii"');
				echo "</td>";
			?>
		</tr>
	</table>			
</div>
<!-- modal -->
<div class="modal fade" id="data" >
  	<div class="modal-dialog" style="width:90%">
    	<div class="modal-content">
    		<?php echo form_open('upload');?>
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        		<h4 class="modal-title">File contents:</h4>
      		</div>
      		<div class="modal-body">
       	 		<table id="data-table1" class="data-table">
					<thead>				
							<th>Test ID</th>
							<th>Device ID</th>
							<th>Sample</th>
							<th>CD3+CD4+ Value [cells/mm3]</th>
							<th>Error</th>
							<th>Operator</th>
							<th>Result Date</th>
							<th>Barcode</th>
							<th>Expiry Date</th>						
					</thead>
					<tbody>
					</tbody>
				</table>
      		</div>					      	
      		<div class="modal-footer" style="height:30px;padding-top:4px;">
      			<button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-upload"></i> Upload Data</button>
        		<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove-circle"></i> Close</button>         		   		
      		</div>
      		<div class="modal-footer" style="height:11px;padding-top:11px;">
      			<?php echo $this->config->item("copyrights");?>
      		</div>
      			<?php   echo form_close();    	?>  
   		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
