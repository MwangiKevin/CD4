<div class="modal fade" id="changePassword" >
  	<div class="modal-dialog" style="width:37%;margin-bottom:2px;">
    	<div class="modal-content" >
    		<?php echo form_open(base_url().'user/change_password',"id='password_header'");?>
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        		<h4 class="modal-title">Change Password</h4>
      		</div>
      		<div class="modal-body" style="padding-bottom:0px;">
            <div class="input-group" style="width: 100%;padding:4px;">
              <span class="input-group-addon" style="width: 40%;">Old Password :</span>
              <?php echo form_password(array('name' => 'oldPassword', 'id' => 'oldPassword', 'class'=>'textfield form-control', 'placeholder' => '***********'));?>
            </div>
            
            <div class="input-group" style="width: 100%;padding:4px;">
              <span class="input-group-addon" style="width: 40%;">Password :</span>
              <?php echo form_password(array('name' => 'password', 'id' => 'password', 'class'=>'textfield form-control', 'placeholder' => '***********'));?>
            </div>
            
            <div class="input-group" style="width: 100%;padding:4px;">
              <span class="input-group-addon" style="width: 40%;">Confirm Password :</span>
              <?php echo form_password(array('name' => 'confPassword', 'id' => 'confPassword', 'class'=>'textfield form-control', 'placeholder' => '***********'));?>
            </div>       	 		
      		</div>	

      		<div class="modal-footer" style="height:30px;padding-top:4px;">
      			<button type="button" onclick="submit_password_header()" class="btn btn-primary"><i class="glyphicon glyphicon-save"></i>Save password</button>
        		<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i>Close</button>         		   		
      		</div>
      		<div class="modal-footer" style="height:11px;padding-top:11px;">
      			<?php echo $this->config->item("copyrights");?>
      		</div>
      		<?php   echo form_close();    	?>  
   		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->