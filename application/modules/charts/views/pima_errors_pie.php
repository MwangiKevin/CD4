<div id="errors_reported_pie_gr"></div>
<script id="errors_pie_script" type="text/javascript" >	  
    	// Build the chart
        $('#errors_reported_pie_gr').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                height:290
            },
            title: {
                text: 'PIMA Errors'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <div><b>{point.y}, </b><br/>Percentage : <b>{point.percentage:.1f}%</b></div>'
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
            legend:{
                maxHeight:60
            },
            series: [{
                type: 'pie',
                name: 'Error',
                size: '80%',
                data: <?php echo json_encode($chart);?>
                
            }]
        });
    
	
</script>