
<div id = "gr_equipmenttestspie">

</div>

<script id="equipmenttestspiescript" type="text/javascript" >	  


    	// Build the chart
        $('#gr_equipmenttestspie').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,                
                height:190
            },
            title: {
                text: 'Equipment & Tests'
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
                name: 'Tests',
                size: '140%',
                data: <?php echo json_encode($equipment_tests);?>
                
            }]
        });
    
    
	
</script>