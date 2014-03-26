<div id="upload">
	<h3>Upload File</h3>
<div class="inner">
	<?php
	$formAttr=array('enctype'=>'multipart/form-data','name'=>'upload_form','id'=>"upload_form");
	echo form_open(base_url().'upload/data_upload',$formAttr);
	$btnAttr = array('id'=>'upload_button','class'=>'btn btn-default','name'=>'file_1');
	echo form_upload($btnAttr);
	//echo form_button('viewData', '<i class="glyphicon glyphicon-list"></i> View Data', 'onclick="viewData()" class="btn btn-default btn-minii"');
	echo form_close();
	?>
	</div>
</div>
