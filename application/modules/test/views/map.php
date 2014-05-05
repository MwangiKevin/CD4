<div class="containerw">
<div id="mapDiv" ></div>
<script type="text/javascript">
var map = new FusionMaps("<?php echo base_url();?>assets/plugins/Fusion/FusionMaps/FCMap_KenyaCounty.swf", "KenyaMap", 560, 500, "0", "0");
map.setDataURL("<?php echo base_url();?>test/map/data");
map.render("mapDiv");
</script>
</div>