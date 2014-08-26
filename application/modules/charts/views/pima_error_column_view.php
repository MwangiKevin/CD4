<div id="pima_errors_column_gr"></div>
<script id="errorscolumnscript" type="text/javascript">
        $('#pima_errors_column_gr').highcharts({
            chart: {
                type: 'column',
                height:260,                
                zoomType: 'x'
            },
            title: {
                text: 'PIMA Errors'
            },
            subtitle: {
                text: '' 
            },
            xAxis: {
                categories: [
                    'Error Reported'
                ]
            },            
            yAxis: {
                min: 0,
                title: {
                    text: 'Error Frequency'
                }
            },            
            credits:{
                enabled:false
            },
            tooltip: {
                hideDelay: 500,
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} </b></td><td style="padding:0">,  </b></td></tr>',
                footerFormat: '</table>',
                shared: false,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.1,
                    borderWidth: 0
                }
            },
            series: <?php echo $data;?>
        });    

</script>