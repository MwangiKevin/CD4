<div id="pima_error_trend_gr"></div>
<script id = 'pima_error_trend_script'>
            $('#pima_error_trend_gr').highcharts({
                 chart: { 
                    plotBackgroundColor: null,
                    plotBorderWidth: 2,
                    plotShadow: true,       
                    zoomType: 'x',
                    type: 'area',
                    height:<?php echo $height;?>
                },
                title: {
                    text: 'Error Trends (Year <?php echo $date_filter_year;?>)',
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
                        text: '# '
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                plotOptions: {
                    area: {
                        stacking: 'percent',
                        lineColor: '#666666',
                        lineWidth: 1,
                        marker: {
                            lineWidth: 0,
                            lineColor: '#666666',
                            radius: 0
                        }             
                    }            
                },            
                credits:{
                    enabled:false
                },
                tooltip: {
                    shared: true,
                    valueSuffix: ' #',
                    crosshairs: [true,false],
                    pointFormat: '<br/><br/>{series.name}: <div><b>{point.y}, </b><b>({point.percentage:.2f}) %</b></div>'
                },
                // tooltip: {
                //     formatter: function() {
                //         var perc = ((this.y)/(this.point.stackTotal))*100;
                //         return '<b>'+ this.x +'</b><br/>'+
                //             this.series.name +': '+ this.y +'<br/>'+
                //             'Percentage: '+ perc +'%<br/>'+
                //             'Total: '+ this.point.stackTotal;
                //     }
                // },
                series: <?php echo json_encode($chart);?>
            });
</script>