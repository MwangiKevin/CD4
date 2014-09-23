<script id = "static">
  $().ready(function() {

      $("#monthly_error_trend").load("<?php echo base_url('charts/pima_errors/monthly_error_trend/0/0'); ?>"); 
      $("#error_type_pie").load("<?php echo base_url('charts/pima_errors/error_type_pie/0/0'); ?>"); 
      $("#error_table").load("<?php echo base_url('charts/pima_errors/error_table/0/0'); ?>" ); 
      $("#errors_column").load("<?php echo base_url('charts/pima_errors/errors_column/0/0'); ?>"); 

  });
function secondCriteria(sel){
  if(sel.value==0){
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


      var criteria1= 0;
      var criteria2= 0;  


    if($("#criteria1").val()==0){

    }else{
      criteria1= $("#criteria1").val();
      criteria2= $("#criteria2").val();  
    } 
   

    $("#monthly_error_trend").load("<?php echo base_url('charts/pima_errors/monthly_error_trend'); ?>/"+criteria1+"/"+criteria2); 
    $("#error_type_pie").load("<?php echo base_url('charts/pima_errors/error_type_pie'); ?>/"+criteria1+"/"+criteria2); 
    $("#error_table").load("<?php echo base_url('charts/pima_errors/error_table'); ?>/"+criteria1+"/"+criteria2); 
    $("#errors_column").load("<?php echo base_url('charts/pima_errors/errors_column'); ?>/"+criteria1+"/"+criteria2); 



}
</script>