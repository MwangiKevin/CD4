
<div id = "testspie-gr">

</div>

<script id = 'testspiescript'>
    var colors = Highcharts.getOptions().colors,
            categories = <?php echo json_encode($tests_err['categories']);?>,
            name = 'Tests VS Errors',
            data = <?php echo json_encode($tests_err['tests']);?>;
    
    
        // Build the data arrays
        var testsData = [];
        var testsTypeData = [];
        for (var i = 0; i < data.length; i++) {
    
            // add browser data
            testsData.push({
                name: categories[i],
                y: data[i].y,
                color: data[i].color
            });
    
            // add version data
            for (var j = 0; j < data[i].drilldown.data.length; j++) {
                var brightness = 0.2 - (j / data[i].drilldown.data.length) / 5 ;
                testsTypeData.push({
                    name: data[i].drilldown.categories[j],
                    y: data[i].drilldown.data[j],
                    color: Highcharts.Color(data[i].color).brighten(brightness).get()
                });
            }
        }
    
        // Create the chart
        $('#testspie-gr').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: true, 
                type: 'pie',
                height: <?php echo $height;?>

            },
            title: {
                text: 'Tests VS Errors'
            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            credits:{
                enabled:false
            }, 
            plotOptions: {
                pie: {
                    shadow: false,
                    center: ['50%', '50%'],
                    showInLegend: true,
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                }
            },
            tooltip: {
                valueSuffix: '',
                pointFormat: '<b>{series.name}</b>: <div><b>{point.y}, </b><br/>Percentage Share: <b>{point.percentage:.2f}%</b></div>'
            },
            series: [{
                name: '#',
                data: testsData,
                size: '100%',
                dataLabels: {
                    formatter: function() {
                        return this.y > 0 ? this.point.name : null ;
                    },
                    color: 'white',
                    distance: -30
                }
            }, {
                name: '#',
                data: testsTypeData,
                size: '230%',
                innerSize: '200%',
                dataLabels: {
                    formatter: function() {
                        // display only if larger than 1
                        return this.y > 0 ? '<b>'+ this.point.name +':</b> '+ this.y +' ('+Math.round(this.percentage,2)+' %)'  : null;
                    }
                }
            }]
        });

</script>