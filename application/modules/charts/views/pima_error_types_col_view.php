<script id = 'pima_error_types_col_script'>
function pima_error_types_col(){
    var colors = Highcharts.getOptions().colors;
    $('#pima_error_types_col').highcharts({
         chart:{ 
            plotBackgroundColor: null,
            plotBorderWidth: 2,
            plotShadow: true, 
            type:"bar",
            height:"350",
            //width:"1150"
        },
            title:{
                "text":""
            },
            xAxis:{
                categories:[],
                labels:{
                    rotation:0,
                    align:"right",
                    style:{
                        fontSize:"11px"
                    }
                }
            },
            yAxis:{
                allowDecimals:false,
                min:0,
                title:{
                    text:"# Reported"
                }
            },
            credits:{
                enabled:false
            },
            plotOptions:{
                column:{
                    stacking:"normal"
                }
            },
            series: [{
                name: 'Error Types',
                colorByPoint: true,
                data: <?php echo json_encode($series_data);?>
            }],
            drilldown: {
                series: <?php echo json_encode($drilldown);?>
            },
            tooltip: {
                formatter: function() {
                    var perc = ((this.y)/(this.point.stackTotal))*100
                    return '<b>'+ this.y +'</b><br/>'+
                    this.series.name +': '+ this.y +'<br/>'
                }
            }
        });
}
</script>