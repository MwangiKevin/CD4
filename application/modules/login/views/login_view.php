<div class="container" >
	<?php echo form_open('login/process_credentials');?><!--creates form-->
	<?php echo form_fieldset('', array('id' => 'login_legend', 'style'=>'border: #aaa solid 1px;'));?><!-- explain -->
	<legend id="login_legend" >
		<i class="glyphicon glyphicon-exclamation-sign" style="padding-right:5px">  </i>Log In
	</legend>
	<?php echo $this->session->flashdata('error_message');?><!-- displays error message-->
    
	<div class="item" style="padding-left:15%; padding-right:15%">	
		<?php echo form_error('username', '<center><div class="error_message">', '</div></center>');?><!-- Enables you to add an error report next to the form element-->
		<?php echo form_label('Username:', 'username');?><!-- Creates the form label for the text username-->
		<div class="input-group">
  			<span class="input-group-addon"> <span class="glyphicon glyphicon-user"> </span></span>
			<?php echo form_input(array('name' => 'username', 'id' => 'username', 'size' => '24', 'class' => 'textfield form-control', 'placeholder' => 'username'));?><!-- creates input field-->
		</div>
	</div>
    
	<div class="item" style="padding-left:15%; padding-right:15%">
		<?php echo form_error('password', '<div class="error_message">', '</div>');?>
		<?php echo form_label('Password:', 'password');?>
		<div class="input-group">
  			<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
			<?php echo form_password(array('name' => 'password', 'id' => 'password', 'size' => '24', 'class' => 'textfield form-control', 'placeholder' => '***********'));?><!-- creates a password field-->
		</div>
	</div>	
    
	<div>
		<br/>
	</div>	
    
	<?php echo form_fieldset_close();?>
	<div  >
	<?php echo form_fieldset('', array('class' => 'tblFooters','style'=>'height:70px', 'style'=>'border: #aaa solid 1px;'));?>
	<?php echo form_submit('input_go', 'Go','Style=width:10%;margin-top:20px;margin-bottom:20px;margin-right:20px height=20px ');?><!-- Submit button -->
	<?php echo form_fieldset_close();?>
	<?php echo form_close();?>

	<?php //echo base_url();?>
	</div>
</div>