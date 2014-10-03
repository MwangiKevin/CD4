<div class = "row tree-outer">
    <div class="col-md-12 well" id ="desc" style=" min-height: 10px;  padding: 8px;  margin-bottom: 0px; ">
        <div class="" style=" height:13px;  ">

            <b><center><div id="filter-identifier">National<div></div></div></center></b>
        </div>
    </div>
    <div class="col-md-3 well " style="overflow-y: auto; height: 560px !important;" id="tree">
                    <div class="loader" style"">Loading...</div>  
    </div>
    <div class="col-md-9" style="overflow-y: auto; height: 560px !important;">
        <div class="row">
        	<div class="col-md-12" id="">   
                <div class="panel panel-default" style="width:100%;float:left;padding:30px;box-shadow: 4px 4px 4px #888888;" id="cd4testtrends">
                    <div class="loader" style"">Loading...</div>
                </div>  
            </div>
            <div class="col-md-7" id="">
                <div class="section-title" ><center>Loading Header</center></div>
                <div id="tests-table">              
                    <!-- <div class="loader" style"">Loading...</div>     -->
                </div>  
            </div>
            <div class="col-md-5" id="">        
                <div class="section-title" ><center>Loading Header</center></div>                      
                <div id="equipment-test-table">
                    <!-- <div class="loader" style"">Loading...</div>     -->
                </div>
            </div>
            
        </div>
    </div>
    
   
</div>

<script>

$(function () {
    //$("#tree").load("<?php echo base_url('nacp/tree/tree_schema')?>");

    $.ajax({
      type:"POST",
      async:true,
      url:"<?php echo base_url('nacp/tree/tree_schema')?>",  
      success:function(data) {
        $("#tree").html(data);
        init_tree();
    }
});


});



</script>