$().ready(function() {
	$('#data-table').dataTable({
	 	"bJQueryUI":true,
		"aaSorting": [[ 1, "desc" ]],
		//"bSort":false,
	  	"bPaginate":false,
		//"sPaginationType":"full_numbers",
	 	"sScrollY": "300px",
	  	//"bFilter": false,
	  	//"bInfo": false
	});					
});
