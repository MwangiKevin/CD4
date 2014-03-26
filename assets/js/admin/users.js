$().ready(function() {
	$('#data-table').dataTable({
		"bProcessing": true,
		"iDisplayLength": 10,
	 	"bJQueryUI":true,
		"bSort":true,
		// "sScrollX": "100%",
		// "sScrollXInner": "100%",
		// "bScrollCollapse": true,
	  	//	"bPaginate":false,
	 	// "sScrollY": "200px",
	  	// 	"bFilter": false
	});			
  $('#data-table-side').dataTable({
		"bProcessing": true,
		"iDisplayLength": 10,
	 	"bJQueryUI":true
	});			
	$('#data-table-side2').dataTable({
		"bProcessing": true,
		"iDisplayLength": 10,
	 	"bJQueryUI":true
	});			
	$('#data-table-usr-grp').dataTable({
		"bProcessing": true,
		"iDisplayLength": 10,
	 	"bJQueryUI":true
	});		
	$('#data-table-edit').dataTable({
		"bProcessing": true,
		"iDisplayLength": 10,
	 	"bJQueryUI":true,
		"sScrollX": "10%",
		"sScrollXInner": "150%",
		"bScrollCollapse": true,
	});	

});