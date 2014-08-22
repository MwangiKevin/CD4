<script>
	$().ready(function() { 		    
		/*
		 * describes various characteristics/styling of the datatables called #datatable-region and #data-table
		 */
	  $('#datatable-region').dataTable({
	    "bProcessing": true,
	    "iDisplayLength": 17,
	    "bJQueryUI":true,
	    "bLengthChange": false,
	    "bFilter": false
	  }); 
	    $('#data-table').dataTable({
		    "bProcessing": true,
		    "iDisplayLength": 5,
		    "bJQueryUI":true,
		    "bLengthChange": false,
		    "bFilter": false
	  	});	  	  
});
	
	
//controls the Tanzanian Map in nacp_drilldown_view.php


</script>