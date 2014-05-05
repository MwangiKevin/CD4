$().ready(function() {
	$('#data-table').dataTable({
		"bProcessing": true,
		"iDisplayLength": 10,
	 	"bJQueryUI":true,
	 	
		//"bSort":false,
	  	//"bPaginate":false,
	 	//"sScrollY": "200px",
	  	//"bFilter": false
	});
	$('#data-table1').dataTable({
		
	 	"bJQueryUI":true,
		"bSort":false,
	  	"bPaginate":false,
	 	//"sScrollY": "200px",
	  	//"bFilter": false
	});	
	$('#data-table-side').dataTable({
		"bProcessing": true,
		"iDisplayLength": 10,
	 	"bJQueryUI":true
	});				
});