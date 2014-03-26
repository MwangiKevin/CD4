$().ready(function() {
	$('#data-table').dataTable({
		"bProcessing": true,
	 	"bJQueryUI":true,
		"bSort":true,
	  	"bPaginate":true,
	  	"iDisplayLength":10 
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
	$('#data-table-dis').dataTable({
		"bProcessing": true,
		"iDisplayLength": 10,
	 	"bJQueryUI":true
	});	
	$('#data-table-reg').dataTable({
		"bProcessing": true,
		"iDisplayLength": 10,
	 	"bJQueryUI":true
	});	
	$('#data-table-par').dataTable({
		"bProcessing": true,
		"iDisplayLength": 10,
	 	"bJQueryUI":true
	});			
	$('#data-table-edit').dataTable({
		"bProcessing": true,
		"iDisplayLength": 10,
	 	"bJQueryUI":true
	});			
});