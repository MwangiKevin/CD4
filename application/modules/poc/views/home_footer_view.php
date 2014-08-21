<script>

$().ready(function() {

  $("#expected_reporting_devices").load("<?php echo base_url("charts/pima/expected_reporting_devices/$user_group_id/$user_filter_used"); ?>"); 
  $("#expected_reporting_devices_pie").load("<?php echo base_url("charts/pima/expected_reporting_devices_pie/$user_group_id/$user_filter_used"); ?>"); 
  $("#pima-tests-table").load("<?php echo base_url("charts/pima/tests_table/$user_group_id/$user_filter_used"); ?>" ); 
});


</script>

<script>






$().ready(function() {
      // expected_reporting_devices();
      // expected_reporting_devices_pie();
      // tests_pie();
      // errors_pie();
      // pima_error_types_col();
      // pima_error_trend();
    });


</script>

<?php //$this->pima->expected_reporting_devices($user_group_id,$user_filter_used); ?>

<?php //$this->pima->expected_reporting_devices_pie($user_group_id,$user_filter_used); ?>

<?php //$this->tests->tests_pie($user_group_id,$user_filter_used); ?>

<?php //$this->pima->errors_reported($user_group_id,$user_filter_used); ?>

<?php //$this->pima_errors->error_yearly_trends($user_group_id,$user_filter_used); ?>

<?php //$this->pima_errors->error_types_col($user_group_id,$user_filter_used); ?>


