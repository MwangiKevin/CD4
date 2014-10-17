<script>
$( document ).ready(function() {

	$('#failed_controls_table').dataTable({
		"bJQueryUI":true, 
		"sAjaxSource": "<?php echo base_url('poc/pima_controls/ss_pima_controls'); ?>" ,
		"aoColumnDefs": [
		{ "bSortable": false, "aTargets": [ 0 ] }
		],
		"aaSorting": [[1, 'asc']]

	});	
});
</script>