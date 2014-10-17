<script>
	$().ready(function() {

    $("#tests_table").load("<?php echo base_url("charts/pima/tests_table/0/0"); ?>" ); 
    $("#cd4_test_trends").load("<?php echo base_url("charts/tests/tests_line_trend/0/0/210"); ?>"); 
    $("#equipment_tests_column").load("<?php echo base_url("charts/equipment/equipment_tests_column/0/0/210"); ?>"); 
    $("#equipment_pie").load("<?php echo base_url("charts/equipment/equipment_pie/0/0"); ?>"); 
    $("#equipment_tests_pie").load("<?php echo base_url("charts/equipment/equipment_tests_pie/0/0"); ?>"); 

  });
</script>