<div id="pima_controls_test_errors_controls"></div>
<script id="test_errors_controls_script" type="text/javascript">
$('#div4').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,                
                height:200
            },
            title: {
                text: 'Correct against Erroneous Controls'
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
                name: 'Controls',
                size: '140%',
                data: <?php echo json_encode($pie); ?>
                
            }]
        }); 
</script>