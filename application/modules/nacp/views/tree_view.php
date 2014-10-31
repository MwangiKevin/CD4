<div class = "row tree-outer">
    <div class="col-md-12 well" id ="desc" style=" min-height: 10px;  padding: 8px;  margin-bottom: 0px; ">
        <div class="" style=" height:13px;  ">

            <b><center><div id="filter-identifier">National<div></div></div></center></b>
        </div>
    </div>
    <div class="col-md-3 well " style="overflow-y: auto; height: 740px !important;" id="tree">
                    <div class="loader" style"">Loading...</div>  
    </div>
    <div class="col-md-9" style="overflow-y: auto; height: 740px !important;">
        <div class="row">
            <div class="col-md-7" style="margin-bottom:15px;">
                <div id="tests-table">              
                    <div class="loader" style"">Loading...</div>    
                </div>  
            </div>
            <div class="col-md-5" style="margin-bottom:15px;">                             
                <div id="equipment-test-table">
                    <div class="loader" style"">Loading...</div>    
                </div>
            </div>
            <div class="col-md-12" style="margin-bottom:15px;">   
                <div id="cd4testtrends">
                    <div class="loader" style"">Loading...</div>
                </div>  
            </div>
            <div class="col-md-12" style="">
                <div id="monthly_error_trend">
                    <div class="loader" style"">Loading...</div>
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


    $("#equipment-test-table").load("<?php echo base_url('charts/equipment/equipment_tests_table/0/0'); ?>" ); 
    $("#tests-table").load("<?php echo base_url('charts/tests/tests_table/0/0'); ?>" );
    $("#cd4testtrends").load("<?php echo base_url('charts/tests/tests_line_trend/0/0'); ?>");  
    $("#monthly_error_trend").load("<?php echo base_url('charts/pima_errors/monthly_error_trend/0/0'); ?>"); 
});

function load_tree_data(type,id,type_identifier){
    $("#filter-identifier").html(type_identifier);

    $("#equipment-test-table").html('<div class="loader" style"">Loading...</div>'); 
    $("#tests-table").html('<div class="loader" style"">Loading...</div>'); 
    $("#cd4testtrends").html('<div class="loader" style"">Loading...</div>');
    $("#monthly_error_trend").html('<div class="loader" style"">Loading...</div>'); 


    $("#equipment-test-table").load("<?php echo base_url()."charts/equipment/equipment_tests_table/"; ?>"+type+"/"+id );  
    $("#tests-table").load("<?php echo base_url()."charts/tests/tests_table/"; ?>"+type+"/"+id ); 
    $("#cd4testtrends").load("<?php echo base_url('charts/tests/tests_line_trend'); ?>/"+type+"/"+id ); 
    $("#monthly_error_trend").load("<?php echo base_url('charts/pima_errors/monthly_error_trend'); ?>/"+type+"/"+id ); 

}

</script>