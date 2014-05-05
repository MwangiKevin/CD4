<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta name="description" content=""/>
	<meta name="keywords" content="" />
	<meta name="author" content="" />	
    <link rel="SHORTCUT ICON" href="<?php echo base_url().'img/favicon.ico';?>">
    <title>CD4 LIMS | <?php echo $title;?></title>
    <?php      	
		$this->load->view('utils/dynamicLoads');
	?>	
  	
</head>

<body id="top" >
	<div class="clearer">
	</div>
	<div id="site" >
		<div id="header">	
			<div id="network">
				<div class="left" id="welcome"><?php echo "<b>" . date("l, d F Y") . "</b>"; ?> 
					<span class="text-separator">|</span> 
					<span class="quiet">				        
			        	<?php
		                 	if($this -> session -> userdata('login_status')){
		                 		echo "Welcome <a href='".base_url()."user/profile'> <span class='glyphicon glyphicon-user'></span> ".$this -> session -> userdata('name')."</a>";
		                 	}else{
		                 		echo "Hello guest. Login to view the site";
		                 	}					
						?>
			       	</span>
                    <span class="text-separator">|</span>
			    </div>
                <div class="center" style="margin-left: 0%;">
                	<form style="margin:0px; float:left">
                        <div class="input-group" style="width:250px;margin-left:0px">
  							<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
 							<input type="text" class="form-control" placeholder="search" style="height: 27px;">
						</div>
                    </form> 
                </div>
				<div class="right">
					<ul class="tabbed" id="network-tabs">
                    	<li>
                        	                      	
                        </li>
						<li class="current-tab" ><a href="<?php echo base_url();?>">CD4 LIMS</a></li>
		                 <?php
		                 	if($this -> session -> userdata('login_status')){
		                 		echo "<li><a href='".base_url()."home/logout'>Log Out</a></li>";
		                 	}else{
		                 		echo "<li><a href='".base_url()."login"."'> Login</a></li>";
		                 	}					
						?>
					</ul>
					<div class="clearer">&nbsp;</div>		
				</div>		
				<div class="clearer" ></div>	
			</div>				
			<div class="clearer" ></div>
			<div id="site-title">
				<a href="<?php echo base_url();?>">
					<div align="center"> <h1><img src="<?php echo base_url().'img/tz.png';?>" height="80" width="30%" alt="" style="z-index: -50;" /></h1></div>
				</a>
			</div>
			<div id="navigation">				
			<div id="main-nav">
				<small>
					<ul class="tabbed">					
						<?php $this->load->view('utils/dynamicMenus');?>
					</ul>
				</small>				
				<div class="content-separator"></div>									
			</div>
		</div>
	</div>  	
	<div style="margin-top:200px;">
	</div>
	<?php $this->load->view('change_password_view');?>
	<?php
		if(isset($filter)&&$filter==true){
	?>
	<div class="" id="" style=" margin-left:3%;margin-right:3%;font-size:11px;">
		<?php $this->load->view('utils/filter_View');?>
	</div>
	<?php
		}
	?>