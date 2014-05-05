$().ready(function() {
	$('#data-table').dataTable({
		"bProcessing": true,
		"iDisplayLength": 10,
	 	"bJQueryUI":true,
		//"bSort":true,
	  	//"bPaginate":false,
	 	//"sScrollY": "200px",
	  	//"bFilter": false
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
  $('#data-table_dev').dataTable({
		"bProcessing": true,
		"iDisplayLength": 4,
	 	"bJQueryUI":true
	});

  $('#data-table_cat').dataTable({
		"bProcessing": true,
		"iDisplayLength": 4,
	 	"bJQueryUI":true
	});		

  $('#edit_table').dataTable({
		"bProcessing": true,
		"iDisplayLength": 10,
	 	"bJQueryUI":true,
		"bSort":false,
	  	"bPaginate":false,
	 	//"sScrollY": "200px",
	  	"bFilter": false
	});
});