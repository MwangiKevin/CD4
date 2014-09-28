<div id = "gr_equipmentpie">

</div>

<script id="equipmentpiescript" type="text/javascript" >	  
	

    	// Build the chart
        $('#gr_equipmentpie').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,                
                height:190
            },
            title: {
                text: 'CD4 Equipment'
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
                data: <?php echo $equipment;?>
                
            }]
        });
    

	
</script>