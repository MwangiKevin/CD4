<div style="margin-left:15%;margin-right:15%; ">
	<div>
		<table id="data_table">
			<thead>
				<tr>
					<td>Name</td>
					<td>Result</td>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($results as $key => $value) {
				?>
				<tr>
					<td><?php echo $value["name"];?></td>
					<td><?php echo $value["result"];?></td>
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>
	</div>
	<br/>
	<div>

		<?php
		echo form_open("test_module/submit");
		?>
		Name
		<div class="input-group">
			<span class="input-group-addon"> <span class="glyphicon glyphicon-user"> </span></span>
			<input type="text" name="name" value="" id="name" size="24" class="textfield form-control" placeholder="name"><!-- creates input field-->
		</div>
		Result
		<div class="input-group">
			<span class="input-group-addon"> <span class="glyphicon glyphicon-user"> </span></span>
			<input type="text" name="result" value="" id="result" size="24" class="textfield form-control" placeholder="result"><!-- creates input field-->
		</div>
		<?php  
		echo form_submit('input_go', 'Go','Style=width:10%;margin-top:20px;margin-bottom:20px;margin-right:20px height=20px ');
		echo form_close();
		?>

	</div>
	<div id = "chart">
	</div>
</div>

<script>
$().ready(function(){

	$("#data_table").dataTable({
	    "bProcessing": true,
	    "iDisplayLength": 17,
	    "bJQueryUI":true,
	    "bLengthChange": true,
	    "bFilter": true
	  });


});

$(function () {
        $('#chart').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'CD4 Result'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Result'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'Population in 2008: <b>{point.y:.1f} millions</b>',
            },
            series: [{
                name: 'Population',
                data: <?php echo json_encode($chart)?>
                ,
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    x: 4,
                    y: 10,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif',
                        textShadow: '0 0 3px black'
                    }
                }
            }]
        });
    });

</script>

