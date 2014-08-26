<script>
$(document).ready(function() {
	posted = <?php echo($posted);?>;
	if(posted!=0){
		$('#data').modal('show');

		$('#data').delay(4000,function(nxt){

			nxt();
		});
	}
	$('#upload_button').change(function(){		
		$("#upload_form").submit();
	});		
	$('#uploads_table').dataTable({
		//"bProcessing": true,
		"iDisplayLength": 5,
		"bJQueryUI":true,
		"bSort":false,
		"bPaginate":true,
		"bLengthChange": false,
		"bJQueryUI":true, 
		"sAjaxSource": "http://localhost/cd4/poc/upload/ss_dt_upload_data" ,
		"aoColumnDefs": [
		{ "bSortable": false, "aTargets": [ 0 ] }
		],
		"aaSorting": [[1, 'asc']]

	});		
}); 


function viewData(){	
	$('#data').modal({
        show: 'true'
    });
}
</script>