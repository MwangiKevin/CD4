<div class="container" >
	<?php echo form_open('login/process_credentials');?>
	<?php echo form_fieldset('', array('id' => 'login_legend', 'style'=>'border: #aaa solid 1px;'));?>
	<legend id="login_legend" >
		<i class="glyphicon glyphicon-exclamation-sign" style="padding-right:5px">  </i>Log In
	</legend>
	<?php echo $this->session->flashdata('error_message');?>
	<div class="item" style="padding-left:15%; padding-right:15%">	
		<?php echo form_error('username', '<center><div class="error_message">', '</div></center>');?>
		<?php echo form_label('Username:', 'username');?>
		<div class="input-group">
  			<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
			<?php echo form_input(array('name' => 'username', 'id' => 'username', 'size' => '24', 'class' => 'textfield form-control', 'placeholder' => 'username'));?>
		</div>
	</div>
	<div class="item" style="padding-left:15%; padding-right:15%">
		<?php echo form_error('password', '<div class="error_message">', '</div>');?>
		<?php echo form_label('Password:', 'password');?>
		<div class="input-group">
  			<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
			<?php echo form_password(array('name' => 'password', 'id' => 'password', 'size' => '24', 'class' => 'textfield form-control', 'placeholder' => '***********'));?>
		</div>
	</div>	
	<div>
		<br/>
	</div>	
	<?php echo form_fieldset_close();?>
	<div  >
	<?php echo form_fieldset('', array('class' => 'tblFooters','style'=>'height:70px', 'style'=>'border: #aaa solid 1px;'));?>
	<?php echo form_submit('input_go', 'Go','Style=width:10%;margin-top:20px;margin-bottom:20px;margin-right:20px height=20px ');?>
	<?php echo form_fieldset_close();?>
	<?php echo form_close();?>

	<?php //echo base_url();?>
	</div>
</div>