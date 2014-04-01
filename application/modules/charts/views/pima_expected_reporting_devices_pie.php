<script id="expected_reporting_devices_pie_script" type="text/javascript" >	  
	function expected_reporting_devices_pie(){

    	// Build the chart
        $('#expectedreportingdevicespie').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: 2,
                plotShadow: true,                
                height:350
            },
            title: {
                text: 'Expected PIMA Reporting (<?php echo $date_filter_desc;?>)'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <div><b>{point.y}, </b><br/>Percentage: <b>{point.percentage:.1f}%</b></div>'
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
                size: '70%',
                data: <?php echo json_encode($chart);?>
                
            }]
        });
    
    }
	
</script>