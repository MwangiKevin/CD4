$().ready(function() {
	$('#data-table').dataTable({
		"bProcessing": true,
		"iDisplayLength": -1,
	 	"bJQueryUI":true,
		"bSort":false,
	  	"bPaginate":false,
	 	//"sScrollY": "200px",
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
});

function viewData(){	
	$('#data').modal({
        show: 'true'
    });
}
