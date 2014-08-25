<script>
$( document ).ready(function() {

	$('#equipment_table').dataTable({
		"bJQueryUI":true, 
		"sAjaxSource": "http://localhost/cd4/poc/equipment/ss_dt_equipment" ,
		"aoColumnDefs": [
		{ "bSortable": false, "aTargets": [ 0 ] }
		],
		"aaSorting": [[1, 'asc']]

	});	
});
</script>