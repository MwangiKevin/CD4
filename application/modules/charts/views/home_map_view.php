<div id = "gr_homemap">

</div>

<script id="homemapscript" type="text/javascript" >	  
	
  $(function () {

                // Prepare demo data
                var data = <?php echo $map_data;?>;

                    
                // Initiate the chart
                $('#gr_homemap').highcharts('Map', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,                
                        height:<?php echo $height;?>
                    },
                    
                    title : {
                        text : 'National PIMA Testing Distribution'
                    },

                    mapNavigation: {
                        enabled: true,
                        buttonOptions: {
                            verticalAlign: 'bottom'
                        }
                    },

                    colorAxis: {
                        min: 0
                    },        
                    credits:{
                        enabled:false
                    },

                    series : [{
                        data : data,
                        mapData: Highcharts.maps['countries/tz/tz-all'],
                        joinBy: 'hc-key',
                        name: 'CD4 Devices',
                        states: {
                            hover: {
                                color: '#BADA55'
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}'
                        }
                    }]
                });
            });
	
</script>