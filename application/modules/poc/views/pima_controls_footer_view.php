<script>
$( document ).ready(function() {

	$('#pima_controls_table').dataTable({
		"bJQueryUI":true, 
		"sAjaxSource": "<?php echo base_url('poc/pima_controls/ss_pima_controls'); ?>" ,
		"aoColumnDefs": [
		{ "bSortable": false, "aTargets": [ 0 ] }
		],
		"aaSorting": [[1, 'asc']]

	});	

	 $.ajax({
      type:"POST",
      async:true,
      url:"<?php echo base_url('poc/pima_controls/tree_schema')?>",  
      success:function(data) {
        $("#tree").html(data);
        init_tree();
        }
    });

    $('#div1').load("<?php echo base_url("charts/pima_controls/get_pima_controls_failed_successful_pie/$user_group_id/$user_filter_used"); ?>");
    $('#div2').load("<?php echo base_url("charts/pima_controls/get_pima_controls_tests_pie/$user_group_id/$user_filter_used"); ?>");
    $('#div3').load("<?php echo base_url("charts/pima_controls/get_pima_controls_errors/$user_group_id/$user_filter_used"); ?>");
    $('#div4').load("<?php echo base_url("charts/pima_controls/get_pima_controls_tests_errors_controls/$user_group_id/$user_filter_used"); ?>");


 // $('#div4').highcharts({
 //            chart: {
 //                plotBackgroundColor: null,
 //                plotBorderWidth: null,
 //                plotShadow: false,                
 //                height:200
 //            },
 //            title: {
 //                text: 'Control Tests Vs Control Errors'
 //            },
 //            tooltip: {
 //                pointFormat: '{series.name}: <div><b>{point.y}, </b><br/>Percentage Share: <b>{point.percentage:.1f}%</b></div>'
 //            },
 //            plotOptions: {
 //                pie: {
 //                    allowPointSelect: true,
 //                    cursor: 'pointer',
 //                    dataLabels: {
 //                        enabled: false
 //                    },
 //                    showInLegend: true
 //                }
 //            },            
 //            credits:{
 //                enabled:false
 //            },
 //            series: [{
 //                type: 'pie',
 //                name: 'Devices',
 //                size: '140%',
 //                data: [
 //                <?php echo json_encode($tests)?>,
 //                {
 //                    name: 'Control Errors', 
 //                    y: 30,
 //                    sliced: true,
 //                    selected: true,
 //                }
                
                
 //            ]
                
 //            }]
 //        }); 
});
</script>