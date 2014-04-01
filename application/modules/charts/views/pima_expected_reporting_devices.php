<script id = 'expected_reporting_devices_script'>
    function expected_reporting_devices(){
            $('#expected_reporting_devices').highcharts({
                 chart: { 
                    plotBackgroundColor: null,
                    plotBorderWidth: 2,
                    plotShadow: true,       
                    zoomType: 'x',
                    type: 'area',
                    height:350
                },
                title: {
                    text: 'Expected Reporting Devices (Year <?php echo $year;?>)',
                    x: -20 //center   
                },
                xAxis: {
                    categories: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
                    labels: {
                        rotation: -45,
                        step : 0,
                        align: "right"
                    }
                },
                yAxis: {
                    title: {
                        text: '# Pima Devices'
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
                    valueSuffix: ' Devices',
                    crosshairs: [true,false],
                    //pointFormat: '<br/><br/>{series.name}: <div><b>{point.y}, </b><b>{series.data.percentage:.1f}%</b></div>'
                },
                series: <?php echo json_encode($chart);?>
            });
    }
</script>