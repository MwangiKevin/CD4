<script>
$( document ).ready(function() {

	$('#tests_table').dataTable({
		"bJQueryUI":true, 
		"sAjaxSource": "http://localhost/cd4/poc/tests/ss_dt_tests" ,
		"aoColumnDefs": [
		{ "bSortable": false, "aTargets": [ 0 ] }
		],
		"aaSorting": [[1, 'asc']]


	});	
});
</script>