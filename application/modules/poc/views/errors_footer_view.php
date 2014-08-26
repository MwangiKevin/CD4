<script id = "static">
  $().ready(function() {

      $("#monthly_error_trend").load("<?php echo base_url('charts/pima_errors/monthly_error_trend/0/0'); ?>"); 
      $("#error_type_pie").load("<?php echo base_url('charts/pima_errors/error_type_pie/0/0'); ?>"); 
      $("#error_table").load("<?php echo base_url('charts/pima_errors/error_table/0/0'); ?>" ); 
      $("#errors_column").load("<?php echo base_url('charts/pima_errors/errors_column/0/0'); ?>"); 

  });
function secondCriteria(sel){
  if(sel.value==1){
      draw_charts();
    }
 	$.ajax({
          type:"POST",
          async:false,
          data:"selected="+sel.value,
            url:"<?php echo base_url()."poc/errors/pima_error_criteria"; ?>",  
            success:function(data) {
                  $("#criteria2Div").html(data);     
              }
      });  
 	 	
}

function draw_charts(){
    
    $("#monthly_error_trend").html('<div class="loader" style"">Loading...</div>'); 
    $("#error_type_pie").html('<div class="loader" style"">Loading...</div>'); 
    $("#error_table").html('<div class="loader" style"">Loading...</div>'); 
    $("#errors_column").html('<div class="loader" style"">Loading...</div>'); 

    var criteria1= $("#criteria1").val();
    var criteria2= $("#criteria2").val();   
    
    $.ajax({
          type:"POST",
          async:true,
          data:"criteria1="+criteria1+"&criteria2="+criteria2,
            url:"<?php echo base_url()."charts/pima_errors/monthly_error_trend"; ?>",  
            success:function(data) {
                  $("#monthly_error_trend").html(data);  
              }
      });
    $.ajax({
          type:"POST",
          async:true,
          data:"criteria1="+criteria1+"&criteria2="+criteria2,
            url:"<?php echo base_url()."charts/pima_errors/error_type_pie"; ?>",  
            success:function(data) {
                  $("#error_type_pie").html(data); 
              }
      });

    $.ajax({
          type:"POST",
          async:true,
            url:"<?php echo base_url()."charts/pima_errors/error_table/";?>"+criteria1+"/"+criteria2,  
            success:function(data) {
                  $("#error_table").html(data);     
              }
      });
    $.ajax({
          type:"POST",
          async:true,
            url:"<?php echo base_url()."charts/pima_errors/errors_column/";?>"+criteria1+"/"+criteria2,  
            success:function(data) {
                  $("#errors_column").html(data);
              }
      });


}
</script>