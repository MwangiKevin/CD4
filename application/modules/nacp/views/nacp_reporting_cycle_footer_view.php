<script>
	$().ready(function() {

  $('#datatable-reported').dataTable({
    "bProcessing": true,
    "iDisplayLength": 5,
    "bJQueryUI":true,
    "bLengthChange": false,
    "bFilter": false
  }); 
  $('#datatable-unreported').dataTable({
    "bProcessing": true,
    "iDisplayLength": 5,
    "bJQueryUI":true,
    "bLengthChange": false,
    "bFilter": false  	
  });  
});

</script>