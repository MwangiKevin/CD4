<div>
	<div class="section-title" ><center>CD4 Tests</center></div>
	<div>
		<table id="data-table">
			<thead>
				<tr>
					<th rowspan = "2" >#</th>
					<th rowspan = "1" colspan= "2" style="width:27%"><center>Dates</center></th>
					<th rowspan = "2" ># Facilities Reported</th>
					<th rowspan = "2" style="font-size: 1.0em;color: #2d6ca2;" ># of total tests</th>
					<th rowspan = "2" style="font-size: 1.0em;color: #2aabd2;" ># of valid tests</th>
					<th rowspan = "2" style="font-size: 1.0em;color: #3e8f3e; width:15%;"># of tests &gt= 350 cells/mm3 </th>
					<th rowspan = "2" style="font-size: 1.0em;color: #eb9316; width:15%;"># of tests &lt 350 cells/mm3</th>
					<th rowspan = "2" style="font-size: 1.0em;color: #c12e2a;" ># of errors</th>
				</tr>
				<tr>
					<th>From </th>
					<th> To </th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i=1;
					foreach ($tests as $test) {				
				?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo Date("Y-F-1",strtotime($test["result_date"]))?></td>
					<td><?php echo Date("Y-F-t",strtotime($test["result_date"]));?></td>
					<td><?php echo $test["facilities_reported"];?></td>
					<td style="font-size: 1.1em;color: #2d6ca2;"><?php echo $test["total_tests"];?></td>
					<td style="font-size: 1.1em;color: #2aabd2;"><?php echo $test["valid"];?></td>
					<td style="font-size: 1.1em;color: #3e8f3e;"><?php echo $test["passed"];?></td>
					<td style="font-size: 1.1em;color: #eb9316;"><?php echo $test["failed"];?></td>
					<td style="font-size: 1.1em;color: #c12e2a;"><?php echo $test["errors"];?></td>
				</tr>
				<?php
						$i++;
					}
				?>
			</tbody>
		</table>
	</div>
</div>