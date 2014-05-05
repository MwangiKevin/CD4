<?php 
	ob_start();
	$this->load->view('Commons/loginHeader_View');		

?>
	<?php 
		$loginFailMessage = $this->session->flashdata('flash_loginFailMessage');
		if(!($loginFailMessage=="")){
	?>
	<div class="error">
	<?php echo $loginFailMessage; ?>
	</div> 
	<br>
	<?php
		}
	?>
	<section class="login">
		<fieldset class ="" style="">
			<h5>&nbsp;&nbsp;&nbsp;Users Login &nbsp;&nbsp;&nbsp;</h5>
			<?php 
				echo form_open('login/authenticate',"id='login-form' '");
				echo "\n";

				$username = array(
			              'name'        => 'username',
			              'id'          => 'username',
			              'value'       => '',
			              'placeholder' => 'Username',
			            );
				$password = array(
			              'name'        => 'password',
			              'id'          => 'password',
			              'value'       => '',
			              'placeholder' => 'password',
			            );



			?>
				<div align="center"> 
					<div class="input-prepend input-prepend-lg">
					<span class="icon-user"></span>	
					<?php
						echo form_input($username);					
					?>
					</div>
					<div class="input-prepend input-prepend-lg">
					<span class="icon-lock"></span>	
					<?php	
						echo form_password($password);
					?>
					</div>
				</div>									
				<button type="submit" name="submit">LOGIN</button>
				<a href="login/forgot_password">Forgot Password</a>
				</div>
			<?php 
				echo form_close()."\n";
			?>			
		</fieldset>
	</section>
	<div class="clearer">&nbsp;</div>
<div id="site-title">

</div>

<?php
$this->load->view('Commons/footer_View');
?>	