<script id = 'monthlyerrortrendscript'>
function monthly_error_trend(){
    var colors = Highcharts.getOptions().colors;
    $('#monthlyerrortrend').highcharts({
        chart:{
            type:"column",
            height:"260",
            width:"1150"},
            title:{
                "text":""
            },
            xAxis:{
                categories:["January","February","March","April","May","June","July","August","September","October","November","December"],
                labels:{
                    rotation:-45,
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
            series:[
            {"name":"Total Tests","data":[0,0,6,25,7,2,0,2,5,46,43,39],"stack":"Test","color":"#a4d53a"},
            {"name":"Total Errors","data":[0,0,0,0,0,3,2,3,0,2,4,0],"stack":"Tot","color":"#aa1919"},
            {"name":"User Errors","data":[0,0,0,0,0,3,2,3,0,2,4,0],"stack":"typ","color":"#33c6e7"},
            {"name":"Device Errors","data":[0,0,0,0,0,0,0,0,0,0,0,0],"stack":"typ","color":"#624289"}],
            tooltip: {
                formatter: function() {
                    var perc = ((this.y)/(this.point.stackTotal))*100
                    return '<b>'+ this.x +'</b><br/>'+
                    this.series.name +': '+ this.y +'<br/>'+
                    'Percentage: '+ perc +'%<br/>'+
                    'Total: '+ this.point.stackTotal;
                }
            }
        });
}
</script>