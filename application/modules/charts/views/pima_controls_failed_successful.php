<div id="pima_controls_failed_successful_tests"></div>
<script id="pima_controls_tests_script" type="text/javascript" > 
$('#div1').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,                
                height:200
            },
            title: {
                text: 'Failed Vs Successful Controls'
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
                data: <?php echo json_encode($pie);?>
                
            }]
        }); 
</script>