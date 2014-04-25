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
		$('#data-table1').dataTable({
		
	 	"bJQueryUI":true,
		"bSort":false,
	  	"bPaginate":true,
	 	//"sScrollY": "200px",
	  	//"bFilter": false
	});			
	}); 
</script>