<script>
$( document ).ready(function() {

	$('#failed_controls_table').dataTable({
		"bJQueryUI":true, 
		"sAjaxSource": "<?php echo base_url('poc/pima_controls/ss_pima_controls'); ?>" ,
		"aoColumnDefs": [
		{ "bSortable": false, "aTargets": [ 0 ] }
		],
		"aaSorting": [[1, 'asc']]

	});	

	 $.ajax({
      type:"POST",
      async:true,
      url:"<?php echo base_url('poc/pima_controls/tree_schema')?>",  
      success:function(data) {
        $("#tree").html(data);
        init_tree();
    	}
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
});
</script>