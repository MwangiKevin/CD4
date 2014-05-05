<div>
	<div style="width:40%">
		<div id='mapDiv' style=""></div>
		<script type="text/javascript">									
			var map = new FusionMaps("<?php echo base_url();?>assets/plugins/Fusion/FusionMaps/FCMap_Tanzania.swf", "Tanzania","570","460","0","0");
			var xml = "";
			map.setXMLData("<map  markerBorderColor = '000000' markerBgColor = 'FF5904' markerRadius = '6' legendPosition='right' legendAllowDrag='1' useHoverColor='1' showMarkerToolTip='1'  showExportDataMenuItem='1' canvasBorderColor='FFFFFF' borderColor='000000' fillColor='FFFFFF' numberSuffix='%' includeValueInLabels='0' labelSepChar=':-:' baseFontSize='9'><colorRange gradient='1' minValue='0' code='CC0001' startlabel='Bad (%)' endLabel='Very Good (%)'><color maxValue='20' displayValue='Poor' code='FF0000' /><color maxValue='50' displayValue='Average' code='FFCC33' /><color maxValue='100' code='069F06' /></colorRange><data><?php echo $xmldata;?></data><styles><definition><style name='TTipFont' type='font' isHTML='1'  color='FFFFFF' bgColor='666666' size='11'/><style name='HTMLFont' type='font' color='333333' borderColor='CCCCCC' bgColor='FFFFFF'/><style name='myShadow' type='Shadow' distance='1'/></definition><application><apply toObject='MARKERS' styles='myShadow' /><apply toObject='MARKERLABELS' styles='HTMLFont,myShadow' /><apply toObject='TOOLTIP' styles='TTipFont'/></application></styles></map>");
			map.render("mapDiv");
		</script>
	</div>
</div>