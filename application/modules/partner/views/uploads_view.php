<?php 
if (isset($message)){
	echo "<div id='msg' style='margin-top: 7px;''>";
	echo $message;
	echo "</div>";
}
?>
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
<div class="section-title" style="margin-right:66%;"><center>upload new:</center></div>
<div style="margin-right:55%;">
	<table>
		<tr>
			<?php
				$formAttr=array('enctype'=>'multipart/form-data','name'=>'upload_form','id'=>"upload_form");
				echo form_open(base_url().'partner/uploads/data_upload',$formAttr);
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
    		<?php echo form_open('partner/uploads/upload_commit');?>
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