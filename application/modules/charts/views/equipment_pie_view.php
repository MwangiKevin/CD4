<script id="equipmentpiescript" type="text/javascript" >	  
	function equipment_pie(){

    	// Build the chart
        $('#equipmentpie').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,                
                height:200
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
    
    }
	
</script>