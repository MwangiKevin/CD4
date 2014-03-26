<script src="<?php echo base_url().'assets/scripts/jquery-1.10.2.min.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/scripts/bootstrap/bootstrap.min.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/scripts/modernizr.js'?>"></script>
<script src="<?php echo base_url().'assets/scripts/datatables/jquery.dataTables.min.js'?>"></script>
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
$('.dataTable').dataTable({
	
	
});


/*$(".upload").click(function(){
	alert("sdhvgikl")
});*/

	}); 
</script>