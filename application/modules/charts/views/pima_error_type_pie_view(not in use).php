<script id = 'errortypepiescript'>

                        function error_type_pie(){
                            var colors = Highcharts.getOptions().colors,
                                    categories = ["User Error","Device Error"],
                                    name = 'Errors Encountered',
                                    data = [{"y":14,"color":"#33c6e7","drilldown":{"name":"User Error","error_codes":["201","200 ","203 ","810","830","840","850","860","880","910","920","940","206 ","202 "],"categories":["Volume (201)","Test Aborted (200 )","Expiry date (203 )","Channel Filling (810)","Exposure Time (830)","Focus Range (840)","Exposure postion (850)","Reagent Control (860)","Cell Movement control (880)","Image (910)","Plausability (920)","Gating (940)","Manual Abort(206 )","Test Not Finished(202 )"],"color":"#33c6e7","data":[0,2,11,1,0,0,0,0,0,0,0,0,0,0]}},{"y":0,"color":"#624289","drilldown":{"name":"Device Error","error_codes":["210","300-399 ","820","870","890","930","825"],"categories":["Device Application (210)","Electronic Errors (300-399 )","Focus Chanel(820)","Corrspondence control (870)","Focus control- large objects (890)","Homogeneity (930)","Focus Control (825)"],"color":"#624289","data":[0,0,0,0,0,0,0]}}];
                            
                            
                                // Build the data arrays
                                var errorData = [];
                                var errorTypeData = [];
                                for (var i = 0; i < data.length; i++) {
                            
                                    // add browser data
                                    errorData.push({
                                        name: categories[i],
                                        y: data[i].y,
                                        color: data[i].color
                                    });
                            
                                    // add version data
                                    for (var j = 0; j < data[i].drilldown.data.length; j++) {
                                        var brightness = 0.2 - (j / data[i].drilldown.data.length) / 5 ;
                                        errorTypeData.push({
                                            name: data[i].drilldown.categories[j],
                                            y: data[i].drilldown.data[j],
                                            color: Highcharts.Color(data[i].color).brighten(brightness).get()
                                        });
                                    }
                                }
                            
                                // Create the chart
                                $('#errortypepie').highcharts({
                                    chart: {
                                        type: 'pie',
                                        height: 265

                                    },
                                    title: {
                                        text: 'Errors Encountered'
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
                                            center: ['50%', '50%']
                                        }
                                    },
                                    tooltip: {
                                        valueSuffix: '<br/>.',
                                    },
                                    series: [{
                                        name: 'Error Types',
                                        data: errorData,
                                        size: '35%',
                                        dataLabels: {
                                            formatter: function() {
                                                return this.y > 5 ? this.point.name : null;
                                            },
                                            color: 'white',
                                            distance: -30
                                        }
                                    }, {
                                        name: 'Types',
                                        data: errorTypeData,
                                        size: '60%',
                                        innerSize: '50%',
                                        dataLabels: {
                                            formatter: function() {
                                                // display only if larger than 1
                                                return this.y > 0 ? '<b>'+ this.point.name +':</b> '+ this.y +' ('+Math.round(this.percentage,2)+' %)'  : null;
                                            }
                                        }
                                    }]
                                });
                        }
                      </script>