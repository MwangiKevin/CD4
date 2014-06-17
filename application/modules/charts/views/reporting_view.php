<script type="text/javascript">
		<script>		
			var myChart = new FusionCharts("<?php echo base_url();?>assets/plugins/Fusion/FusionWidgets/Charts/AngularGauge.swf", "myChartId", "950", "110", "0", "0");
			//myChart.setDataURL();//location of php file
			myChart.setXML("<?php echo base_url();?>assets/xml/Data.xml");
			myChart.render("HLineargauge");
		</script> 
</script>
