<script id = "static">
$().ready(function() {
    //draw_charts();
    monthly_error_trend();      
    error_type_pie(); 
    errors_column(); 

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
    
    var criteria1= $("#criteria1").val();
    var criteria2= $("#criteria2").val();   
    $("#monthlyerrortrendscript").html(""); 
    $("#errortypepiescript").html(""); 
    
    $.ajax({
          type:"POST",
          async:false,
          data:"criteria1="+criteria1+"&criteria2="+criteria2,
            url:"<?php echo base_url()."charts/pima_errors/monthly_error_trend"; ?>",  
            success:function(data) {
                  $("#monthlyerrortrendscript").html(data);  
                  monthly_error_trend();   
              }
      });
    $.ajax({
          type:"POST",
          async:false,
          data:"criteria1="+criteria1+"&criteria2="+criteria2,
            url:"<?php echo base_url()."charts/pima_errors/error_type_pie"; ?>",  
            success:function(data) {
                  $("#errortypepiescript").html(data);  
                  error_type_pie();   
              }
      });

    $.ajax({
          type:"POST",
          async:false,
            url:"<?php echo base_url()."charts/pima_errors/error_table/";?>"+criteria1+"/"+criteria2,  
            success:function(data) {
                  $("#errortable").html(data);     
              }
      });
    $.ajax({
          type:"POST",
          async:false,
            url:"<?php echo base_url()."charts/pima_errors/errors_column/";?>"+criteria1+"/"+criteria2,  
            success:function(data) {
                  $("#errorscolumnscript").html(data);    
                  errors_column(); 
              }
      });


}
</script>

<!--<script id = 'monthlyerrortrendscript'>
</script>
<script id = 'errortypepiescript'>
</script>
<script id = 'errorscolumnscript'>
</script>-->


<?php $this->pima_errors->monthly_error_trend(); ?>
<?php $this->pima_errors->error_type_pie(); ?>
<?php $this->pima_errors->errors_column(0,0); ?>