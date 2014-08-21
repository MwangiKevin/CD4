<script>
	$().ready(function() {

    $("#tests_table").load("<?php echo base_url("charts/pima/tests_table/0/0"); ?>" ); 

  });
</script>

<?php //$this->equipment->equipment_pie(0,0); ?>

<?php //$this->equipment->equipment_tests_pie(0,0); ?>

<?php //$this->tests->tests_pie(0,0); ?>

<?php //$this->equipment->equipment_tests_column(0,0); ?>

<?php //$this->tests->tests_line_trend(0,0); ?>

<?php //$this->pima->expected_reporting_devices(0,0); ?>