<div class = "row">
    <div class="col-md-12" id ="desc"></div>
    <div class="col-md-3 tree-outer well " style="overflow-y: auto; height: 340px !important;" id="tree">
    </div>
    <div class="col-md-9" style="overflow-y: auto; height: 340px !important;">
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