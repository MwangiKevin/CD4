<script>
	$().ready(function() {
      expected_reporting_devices();
      expected_reporting_devices_pie();
      tests_pie();
      errors_pie();
	});

	function draw_charts(user_group_id,user_filter_used){

		$.ajax({
          type:"POST",
          async:false,          

            url:"<?php echo base_url()."charts/pima/expected_reporting_devices/"; ?>"+user_group_id+"/"+user_filter_used,             
            success:function(data) {
                  $("#expected_reporting_devices_script").html(data); 
                  expected_reporting_devices();    
              }
      });


	}
</script>

<?php $this->pima->expected_reporting_devices($user_group_id,$user_filter_used); ?>

<?php $this->pima->expected_reporting_devices_pie($user_group_id,$user_filter_used); ?>

<?php $this->tests->tests_pie($user_group_id,$user_filter_used); ?>

<?php $this->pima->errors_reported($user_group_id,$user_filter_used); ?>
                      