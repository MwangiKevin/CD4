			<div style="heigth:200px">&nbsp;</div>
			<div id="footer">
				<div id="network">	
					<?php
						if(!$menuless){
					?>					
					<div class="left" style="padding-left:43%;">	
						<ul class="tabbed" id="network-tabs" >
							<li class="<?php
											if($this->session -> userdata("user_filter_used")==0){
												echo "current-tab";
											}
											?>" >
								<a onclick = "user_filter(0)" href="">National Data</a></li>						
							<?php
								$user_filter = $this->session -> userdata("user_filter");
								
								if($user_filter){
									foreach ($user_filter as $filter) {
								
							?>
							<li class="<?php
											if($this->session -> userdata("user_filter_used")==$filter["user_filter_id"]){
												echo "current-tab";
											}
											?>" >
								<a href="" onclick = "user_filter(<?php echo $filter["user_filter_id"]; ?>)"><?php echo $filter["user_filter_name"];?>
								</a>
							</li>
							<?php									
									}
								}
							?>
						</ul>
						<script>
							function user_filter(value){
						      $.ajax({
						          type:"POST",
						          async:false,
						          data:"&value="+value,
						            url:"<?php echo base_url()."Home/user_filter_post"; ?>",  
						            success:function(data) {
						                  $("#exists").val(data);           
						              }
						      });
						    }
						</script>
					</div>	
					<?php
						}
					?>
					<div class="right" id="welcome">
						<ul class="tabbed" id="network-tabs">
							<li class="current-tab" ><?php echo $this->config->item("copyrights");?> </li>
						</ul>						
					</div>					
				</div>
				<div class="clearer">&nbsp;</div>
			</div>
		</div>
	</div>
</body>
</html>