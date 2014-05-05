<div>
	<?php 
		if(sizeof($upl_res)<1){
	?>
	<div class="alert alert-info"> No new data was uploaded! </div>		
	<?php
		}else{
	?>
	<div class="alert alert-success">New data was uploaded!</div>
	<table id="data-table1" class="data-table">
		<thead>				
				<th>#</th>
				<th style="width:15%">Date Uploaded</th>
				<th style="width:15%">Device Serial number</th>
				<th>Facility</th>
				<th>Uploaded by</th>
				<th style="font-size: 1.1em;color: #2d6ca2;" ># of total tests</th>
				<th style="font-size: 1.1em;color: #2aabd2;" ># of valid tests</th>
				<th style="font-size: 1.1em;color: #3e8f3e; width:15%;"># of tests &gt= 350 cells/mm3 </th>
				<th style="font-size: 1.1em;color: #eb9316; width:15%;"># of tests &lt 350 cells/mm3</th>
				<th style="font-size: 1.1em;color: #c12e2a;" ># of errors</th>
		</thead>
		<tbody>
		<?php 
			$i = 0;	
			foreach ($upl_res as $uploads) {
		?>
			<tr>
				<td><?php echo ($i+1); ?></td>
				<td><?php echo  date('d-F-Y',strtotime($uploads["upload_date"]));  ?></td>
				<td><?php echo  $uploads["equipment_serial_number"]; ?></td>
				<td><?php echo  $uploads["facility_name"]; ?></td>
				<td><?php echo  $uploads["uploader_name"]; ?></td>
				<td style="font-size: 1.1em;color: #2d6ca2;"><?php echo  $uploads["total_tests"]; ?></td>
				<td style="font-size: 1.1em;color: #2aabd2;"><?php echo  $uploads["valid_tests"]; ?></td>
				<td style="font-size: 1.1em;color: #3e8f3e;"><?php echo  $uploads["passed"]; ?></td>
				<td style="font-size: 1.1em;color: #eb9316;"><?php echo  $uploads["failed"]; ?></td>
				<td style="font-size: 1.1em;color: #c12e2a;"><?php echo  $uploads["errors"]; ?></td>
			</tr>
		<?php		
			}
		?>
		</tbody>
	</table>	
	<?php
		}
	?>
</div>
