<script id = 'testslinetrendscript'>
function tests_line_trend(){
        $('#cd4testtrends').highcharts({
             chart: {      
                zoomType: 'x',
                type: 'area',
                height:350
            },
            title: {
                text: 'Testing Trends (last 4 years)',
                x: -20 //center   
            },
            // subtitle: {
            //     text: 'Source: WorldClimate.com',
            //     x: -20
            // },
            xAxis: {
                categories: <?php echo json_encode($chart["categories"]);?>,
                labels: {
                    rotation: -45,
                    step : 3,
                    align: "right"
                }
            },
            yAxis: {
                title: {
                    text: '# Tests'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            plotOptions: {
                area: {
                    stacking: 'normal',
                    lineColor: '#666666',
                    lineWidth: 1,
                    marker: {
                        lineWidth: 1,
                        lineColor: '#666666'
                    }                
                }            
            },            
            credits:{
                enabled:false
            },
            tooltip: {
                shared: true,
                valueSuffix: ' Tests',
                crosshairs: [true,false],
                //pointFormat: '<br/><br/>{series.name}: <div><b>{point.y}, </b><b>{series.data.percentage:.1f}%</b></div>'
            },
            series: <?php echo json_encode($chart["series_data"]);?>
        });
}
</script>