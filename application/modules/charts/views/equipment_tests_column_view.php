<script id="equipmenttestscolumnscript" type="text/javascript" >	  
	function equipment_tests_column(){

    	// Build the chart
        $('#equipmenttestscolumn').highcharts({
           chart: {
                type: 'column',                
                height:290
            },
            title: {
                text: 'Yearly CD4 Tests'
            },
            xAxis: {
                categories: <?php echo json_encode($equipment_tests["categories"]);?>
            },
            yAxis: {
                min: 0,
                title: {
                    text: ' # Tests'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },           
            credits:{
                enabled:false
            },
            // legend: {
            //     align: 'right',
            //     x: -30,
            //     verticalAlign: 'top',
            //     y: 20,
            //     floating: true,
            //     backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
            //     borderColor: '#CCC',
            //     borderWidth: 6,
            //     shadow: true
            // },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        this.series.name +': '+ this.y +'<br/>'+
                        'Total: '+ this.point.stackTotal;
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: false,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        style: {
                            textShadow: '0 0 3px black, 0 0 3px black'
                        }
                    }
                }
            },
            series: <?php echo json_encode($equipment_tests["data"]);?>
        });
    
    }
	
</script>