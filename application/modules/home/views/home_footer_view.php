<script>
$().ready(function() {
        $("#equipmentpie").load("<?php echo base_url('charts/equipment/equipment_pie/0/0'); ?>"); 
        $("#equipment-table").load("<?php echo base_url('charts/equipment/equipment_table/0/0'); ?>" ); 
        $("#equipmenttestpie").load("<?php echo base_url('charts/equipment/equipment_tests_pie/0/0'); ?>"); 
        $("#equipment-test-table").load("<?php echo base_url('charts/equipment/equipment_tests_table/0/0'); ?>" ); 
        $("#equipmenttestscolumn").load("<?php echo base_url('charts/equipment/equipment_tests_column/0/0'); ?>"); 
        $("#testspie").load("<?php echo base_url('charts/tests/tests_pie/0/0'); ?>"); 
        $("#tests-table").load("<?php echo base_url('charts/tests/tests_table/0/0'); ?>" ); 
        $("#cd4testtrends").load("<?php echo base_url('charts/tests/tests_line_trend/0/0'); ?>"); 
        $("#expected_reporting_devices").load("<?php echo base_url('charts/pima/expected_reporting_devices/0/0'); ?>"); 
  });

function draw_charts(user_group_id,user_filter_used){
  
        $("#equipmentpie").html('<div class="loader" style"">Loading...</div>'); 
        $("#equipment-table").html('<div class="loader" style"">Loading...</div>'); 
        $("#equipmenttestpie").html('<div class="loader" style"">Loading...</div>'); 
        $("#equipment-test-table").html('<div class="loader" style"">Loading...</div>'); 
        $("#equipmenttestscolumn").html('<div class="loader" style"">Loading...</div>');
        $("#testspie").html('<div class="loader" style"">Loading...</div>');
        $("#tests-table").html('<div class="loader" style"">Loading...</div>');  
        $("#cd4testtrends").html('<div class="loader" style"">Loading...</div>');
        $("#expected_reporting_devices").html('<div class="loader" style"">Loading...</div>');

        $("#equipmentpie").load("<?php echo base_url('charts/equipment/equipment_pie'); ?>/"+user_group_id+"/"+user_filter_used ); 
        $("#equipment-table").load("<?php echo base_url()."charts/equipment/equipment_table/"; ?>"+user_group_id+"/"+user_filter_used ); 
        $("#equipmenttestpie").load("<?php echo base_url('charts/equipment/equipment_tests_pie'); ?>/"+user_group_id+"/"+user_filter_used );
        $("#equipment-test-table").load("<?php echo base_url()."charts/equipment/equipment_tests_table/"; ?>"+user_group_id+"/"+user_filter_used );  
        $("#equipmenttestscolumn").load("<?php echo base_url('charts/equipment/equipment_tests_column'); ?>/"+user_group_id+"/"+user_filter_used ); 
        $("#testspie").load("<?php echo base_url('charts/tests/tests_pie'); ?>/"+user_group_id+"/"+user_filter_used ); 
		    $("#tests-table").load("<?php echo base_url()."charts/tests/tests_table/"; ?>"+user_group_id+"/"+user_filter_used ); 
        $("#cd4testtrends").load("<?php echo base_url('charts/tests/tests_line_trend'); ?>/"+user_group_id+"/"+user_filter_used ); 
        $("#expected_reporting_devices").load("<?php echo base_url('charts/pima/expected_reporting_devices'); ?>/"+user_group_id+"/"+user_filter_used ); 



      $.ajax({
          type:"POST",
          async:false,
            url:"<?php echo base_url()."ajax/user_desc/"; ?>"+user_group_id+"/"+user_filter_used,  
            success:function(data) {
                  $("#filter-identifier").html(data);     
              }
      });
}
        
</script>
