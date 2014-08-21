<script>

$().ready(function() {

  $("#expected_reporting_devices").load("<?php echo base_url("charts/pima/expected_reporting_devices/$user_group_id/$user_filter_used"); ?>"); 
  $("#expected_reporting_devices_pie").load("<?php echo base_url("charts/pima/expected_reporting_devices_pie/$user_group_id/$user_filter_used"); ?>");
  $("#testspie").load("<?php echo base_url("charts/tests/tests_pie/$user_group_id/$user_filter_used"); ?>"); 
  $("#errors_reported_pie").load("<?php echo base_url("charts/pima/errors_reported/$user_group_id/$user_filter_used"); ?>"); 
  $("#pima-tests-table").load("<?php echo base_url("charts/pima/tests_table/$user_group_id/$user_filter_used"); ?>" ); 
});


</script>

<?php //$this->pima->errors_reported($user_group_id,$user_filter_used); ?>

<?php //$this->pima_errors->error_yearly_trends($user_group_id,$user_filter_used); ?>

<?php //$this->pima_errors->error_types_col($user_group_id,$user_filter_used); ?>


