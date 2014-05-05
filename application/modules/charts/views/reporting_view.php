<script type="text/javascript">
		<script>		
			var myChart = new FusionCharts("<?php echo base_url();?>assets/plugins/Fusion/FusionWidgets/Charts/AngularGauge.swf", "myChartId", "950", "110", "0", "0");
			//myChart.setDataURL();//location of php file
			myChart.setXML("<?php echo base_url();?>assets/xml/Data.xml");
			myChart.render("HLineargauge");
		</script> 
</script>
    

    <!-- <html>
	<body>
		<div id="chartContainer">This should be a chart. Please work</div>
		 <script type="text/javascript">
		            var myChart = new FusionCharts( "FusionWidgetsAngularGauge.swf", "myChartId", "400", "200", "0" );
		            myChart.setXMLUrl("xml/data.xml");
		//				mychart.setDataXML("Data.php");
		            myChart.render("chartContainer");

		    </script>
    </body>
    
</html> -->
