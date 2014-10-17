<?php //echo json_encode($tests); die();?>
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
            <div class="row">
        	<div class="col-md-12" id="">   
                <div class="section-title" ><center>Failed Controls</center></div>
                    <div>
                    	<table id="failed_controls_table">
                    		<thead>
                    			<tr>
                    				<th>#</th>
                    				<th>Facility</th>
                                    <th>Type</th>
                    				<th>Date</th>
                    				<th>Reported</th>
                    			</tr>
                    		</thead>
                    		<tbody></tbody>
                    	</table>
                    </div>
                
            </div>
        </div>
            
            
        </div>
    </div>

    <div class="col-md-12" style="overflow-y: auto; height: 560px !important;">
        <div class="row">
            <div class="col-md-4" id="">
                <div class="panel panel-default" style="width:100%;padding:30px;box-shadow: 4px 4px 4px #888888;" >
                    <div id="div1">              
                        <div class="loader" style"">Loading...</div>      
                    </div>  
                </div> 
                
            </div>
            <div class="col-md-4" id="">        
                <div class="panel panel-default" style="width:100%;padding:30px;box-shadow: 4px 4px 4px #888888;" >
                    <div id="div2">
                        <div class="loader" style"">Loading...</div>    
                    </div>
                </div> 
            </div>
            <div class="col-md-4" id="">        
                <div class="panel panel-default" style="width:100%;padding:30px;box-shadow: 4px 4px 4px #888888;" >
                    <div id="div3">
                        <div class="loader" style"">Loading...</div>    
                    </div>
                </div> 
            </div>
            <div class="col-md-4" id="">
                <div class="panel panel-default" style="width:100%;padding:30px;box-shadow: 4px 4px 4px #888888;" >
                    <div id="div4">              
                        <div class="loader" style"">Loading...</div>      
                    </div>  
                </div> 
            </div>
            <div class="col-md-4" id="">        
               
                <div class="panel panel-default" style="width:100%;padding:30px;box-shadow: 4px 4px 4px #888888;" >
                    <div id="div5">
                        <div class="loader" style"">Loading...</div>    
                    </div>
                </div> 
            </div>
            <div class="col-md-4" id="">        
               
                <div class="panel panel-default" style="width:100%;padding:30px;box-shadow: 4px 4px 4px #888888;" >
                    <div id="div6">
                        <div class="loader" style"">Loading...</div>    
                    </div>
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
      url:"<?php echo base_url('poc/pima_controls/tree_schema')?>",  
      success:function(data) {
        $("#tree").html(data);
        init_tree();
    	}
	});
});

$( document ).ready(function() {

    $('#failed_controls_table').dataTable({
        "bJQueryUI":true, 
        "sAjaxSource": "<?php echo base_url('poc/pima_controls/ss_pima_controls'); ?>" ,
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]

    });

    $('#div1').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,                
                height:200
            },
            title: {
                text: 'Failed Vs Successful Tests'
            },
            tooltip: {
                pointFormat: '{series.name}: <div><b>{point.y}, </b><br/>Percentage Share: <b>{point.percentage:.1f}%</b></div>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },            
            credits:{
                enabled:false
            },
            series: [{
                type: 'pie',
                name: 'Devices',
                size: '140%',
                data: [
                ['Third',   15.0],
                ['Second',       25.0],
                {
                    name: 'First',
                    y: 60.0,
                    sliced: true,
                    selected: true
                }
            ]
                
            }]
        }); 

    
     $('#div2').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,                
                height:200
            },
            title: {
                text: 'Tests Vs Controls'
            },
            tooltip: {
                pointFormat: '{series.name}: <div><b>{point.y}, </b><br/>Percentage Share: <b>{point.percentage:.1f}%</b></div>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },            
            credits:{
                enabled:false
            },
            series: [{
                type: 'pie',
                name: 'Devices',
                size: '140%',
                data: [
                ['Tests',   75.0],
                
                {
                    name: 'Controls',
                    y: 25.0,
                    sliced: true,
                    selected: true
                }
                
            ]
                
            }]
        }); 


 $('#div3').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,                
                height:200
            },
            title: {
                text: 'Should not Be Pie'
            },
            tooltip: {
                pointFormat: '{series.name}: <div><b>{point.y}, </b><br/>Percentage Share: <b>{point.percentage:.1f}%</b></div>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },            
            credits:{
                enabled:false
            },
            series: [{
                type: 'pie',
                name: 'Devices',
                size: '140%',
                data: [
                ['First',   45.0],
                ['Second',       26.8],
                {
                    name: 'Third',
                    y: 12.8,
                    sliced: true,
                    selected: true
                },
                ['Fourth',    8.5],
                ['Fifth',     6.2],
                ['Sixth',   0.7]
            ]
                
            }]
        }); 



 $('#div4').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,                
                height:200
            },
            title: {
                text: 'Control Tests Vs Control Errors'
            },
            tooltip: {
                pointFormat: '{series.name}: <div><b>{point.y}, </b><br/>Percentage Share: <b>{point.percentage:.1f}%</b></div>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },            
            credits:{
                enabled:false
            },
            series: [{
                type: 'pie',
                name: 'Devices',
                size: '140%',
                data: [
                <?php echo json_encode($tests)?>,
                {
                    name: 'Control Errors', 
                    y: 30,
                    sliced: true,
                    selected: true,
                }
                
                
            ]
                
            }]
        }); 


 $('#div5').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,                
                height:200
            },
            title: {
                text: 'Static Data'
            },
            tooltip: {
                pointFormat: '{series.name}: <div><b>{point.y}, </b><br/>Percentage Share: <b>{point.percentage:.1f}%</b></div>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },            
            credits:{
                enabled:false
            },
            series: [{
                type: 'pie',
                name: 'Devices',
                size: '140%',
                data: [
                ['First',   45.0],
                ['Second',       26.8],
                {
                    name: 'Third',
                    y: 12.8,
                    sliced: true,
                    selected: true
                },
                ['Fourth',    8.5],
                ['Fifth',     6.2],
                ['Sixth',   0.7]
            ]
                
            }]
        }); 



 $('#div6').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,                
                height:200
            },
            title: {
                text: 'Static Data'
            },
            tooltip: {
                pointFormat: '{series.name}: <div><b>{point.y}, </b><br/>Percentage Share: <b>{point.percentage:.1f}%</b></div>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },            
            credits:{
                enabled:false
            },
            series: [{
                type: 'pie',
                name: 'Devices',
                size: '140%',
                data: [
                ['First',   45.0],
                ['Second',       26.8],
                {
                    name: 'Third',
                    y: 12.8,
                    sliced: true,
                    selected: true
                },
                ['Fourth',    8.5],
                ['Fifth',     6.2],
                ['Sixth',   0.7]
            ]
                
            }]
        }); 

});

      // Build the chart

 
</script>