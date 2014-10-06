<script>
$().ready(function() {
  $("#expected_reporting_devices").load("<?php echo base_url("charts/pima/expected_reporting_devices/$user_group_id/$user_filter_used/230"); ?>"); 
  $("#expected_reporting_devices_pie").load("<?php echo base_url("charts/pima/expected_reporting_devices_pie/$user_group_id/$user_filter_used/230"); ?>");
  $("#testspie").load("<?php echo base_url("charts/tests/tests_pie/$user_group_id/$user_filter_used/230"); ?>"); 
  $("#errors_reported_pie").load("<?php echo base_url("charts/pima/errors_reported/$user_group_id/$user_filter_used/250"); ?>");
  $("#pima-tests-table").load("<?php echo base_url("charts/pima/tests_table/$user_group_id/$user_filter_used/250"); ?>" ); 
  $("#pima_error_types_col").load("<?php echo base_url("charts/pima_errors/error_types_col/$user_group_id/$user_filter_used/250"); ?>");
  $("#pima_error_trend").load("<?php echo base_url("charts/pima_errors/error_yearly_trends/$user_group_id/$user_filter_used/250"); ?>"); 
});

</script>


