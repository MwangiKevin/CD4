$().ready(function() {
	$('#data-table').dataTable({
		"bProcessing": true,
		"iDisplayLength": 5,
	 	"bJQueryUI":true,
		"bSort":false,
	  	"bPaginate":true,
	  	"bLengthChange": false,
	 	//"sScrollY": "160px",
	  	"bFilter": false
	});
	// $('#data-table1').dataTable({
		
	//  	"bJQueryUI":true,
	// 	"bSort":false,
	//   	"bPaginate":false,
	//  	//"sScrollY": "200px",
	//   	//"bFilter": false
	// });		

	$( "#msg" ).delay(5000).fadeOut( "slow", function() {
		
  });	
  $('#data-table-side').dataTable({
		"bProcessing": true,
		"iDisplayLength": 10,
	 	"bJQueryUI":true
	});		
});

function viewData(){	
	$('#data').modal({
        show: 'true'
    });
}
