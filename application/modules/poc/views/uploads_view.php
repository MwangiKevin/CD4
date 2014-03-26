<?php 
if (isset($message)){
	echo "<div id='msg' style='margin-top: 7px;''>";
	echo $message;
	echo "</div>";
}
?>
<center>
	<div class="section-title" ><center>Last 50 PIMA uploads</center></div>
	<div style="margin-bottom:20px">
		<table id="data-table" class="data-table">
			<thead>				
					<th>#</th>
					<th style="width:15%">Date Uploaded</th>
					<th style="width:15%">Device Serial number</th>
					<th>Facility</th>
					<th>Uploaded by</th>
					<th style="font-size: 1.1em;color: #2d6ca2;" ># of total tests</th>
					<th style="font-size: 1.1em;color: #2aabd2;" ># of valid tests</th>
					<th style="font-size: 1.1em;color: #3e8f3e; width:15%;"># of tests &gt= 350 cells/mm3 </th>
					<th style="font-size: 1.1em;color: #eb9316; width:15%;"># of tests &lt 350 cells/mm3</th>
					<th style="font-size: 1.1em;color: #c12e2a;" ># of errors</th>
			</thead>
			<tbody>				
			<?php 

				$max_rows = 50;
				if (sizeof($uploads)<50){
					$max_rows= sizeof($uploads);
				}
				for($i=0;$i<$max_rows;$i++){
			?>	
			<tr>
				<td><?php echo $i+1;?></td>
				<td><?php echo date('d-F-Y',strtotime($uploads[$i]["upload_date"]));?></td>
				<td><?php echo $uploads[$i]["serial_num"];?></td>
				<td><?php echo $uploads[$i]["facility"];?></td>
				<td><?php echo $uploads[$i]["uploaded_by_name"];?></td>
				<td style="font-size: 1.1em;color: #2d6ca2;"><?php echo $uploads[$i]["total_tests"];?></td>
				<td style="font-size: 1.1em;color: #2aabd2;"><?php echo $uploads[$i]["valid_tests"];?></td>
				<td style="font-size: 1.1em;color: #3e8f3e;"><?php echo $uploads[$i]["passed"];?></td>
				<td style="font-size: 1.1em;color: #eb9316;"><?php echo $uploads[$i]["failed"];?></td>
				<td style="font-size: 1.1em;color: #c12e2a;"><?php echo $uploads[$i]["errors"];?></td>
			</tr>
			<?php
				}
			?>		
			</tbody>
		</table>
	</div>		
</center>	
<div class="section-title" style="margin-right:66%;"><center>upload new:</center></div>
<div style="margin-right:55%;">
	<table>
		<tr>
			<?php
				$formAttr=array('enctype'=>'multipart/form-data','name'=>'upload_form','id'=>"upload_form");
				echo form_open(base_url().'poc/uploads/data_upload',$formAttr);
				echo "<td>";
				$btnAttr = array('id'=>'upload_button','class'=>'btn btn-default','name'=>'file_1');
				echo form_upload($btnAttr);
				echo "</td>";
				echo form_close();
			?>
		</tr>
	</table>			
</div>
<!-- modal -->
<?php if($posted=1){?>
<div class="modal fade" id="data" >
  	<div class="modal-dialog" style="width:94%">
    	<div class="modal-content">
    		<?php echo form_open('poc/uploads/upload_commit');?>
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        		<h4 class="modal-title">File contents:</h4>
        		<?php 

        			echo "<input type='hidden' name='data' value='".json_encode($upload_data)."'/>";

        		?>
      		</div>
      		<div class="modal-body">
       	 		<table id="data-table1" class="data-table" style="font-size:8px;">
					<?php echo $sheet_data;?>
				</table>
      		</div>					      	
      		<div class="modal-footer" style="height:30px;padding-top:4px;">
      			<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-upload"></i> Upload Data</button>
        		<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove-circle"></i> Close</button>         		   		
      		</div>
      		<div class="modal-footer" style="height:11px;padding-top:11px;">
      			<?php echo $this->config->item("copyrights");?>
      		</div>
      			<?php   echo form_close();    	?>  
   		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php }?>
<?php $this->load->view("uploads_footer_view");?>