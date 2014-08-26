<script>
$( document ).ready(function() {

	$('#equipment_table').dataTable({
		"bJQueryUI":true, 
		"sAjaxSource": "<?php echo base_url('poc/equipment/ss_dt_equipment'); ?>" ,
		"aoColumnDefs": [
		{ "bSortable": false, "aTargets": [ 0 ] }
		],
		"aaSorting": [[1, 'asc']]

	});	
});
</script>