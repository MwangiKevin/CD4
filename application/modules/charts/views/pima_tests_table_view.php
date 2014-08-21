<div id="pima-tests-tbl">
	<table style = "border: 1px solid #DDD;height:240px;vertical-align:center;" >
		<thead class="even" style="background:#f0f0f0" >
			<tr style = "border: 1px solid #DDD;" >
				<td></td>
				<td>Total Attempted</td>
				<td>Valid tests</td>
				<td>cd4 Above critical Level <br/><br/> (350 cells/mm for adults)</td>
				<td>cd4 Below critical Level <br/><br/> (25% for peadiatrics)</td>
				<td>Unsuccessful Tests</td>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($tests as $tes) {
			?>
			<tr style = "border: 1px solid #DDD;" >
				<td style="background-color: #CCCCCC;"  ><center><?php echo $tes["title"];?></center></td>
				<td style="background-color: #F6F6F6;;" ><center><?php echo $tes["total"];?></center></td>
				<td style="background-color: #F6F6F6;;" ><center><?php echo $tes["valid"];?></center></td>
				<td style="background-color: #F6F6F6;;" ><center><?php echo $tes["passed"];?></center></td>
				<td style="background-color: #F6F6F6;;" ><center><?php echo $tes["failed"];?></center></td>
				<td style="background-color: #F6F6F6;;" ><center><?php echo $tes["errors"];?></center></td>
			</tr>
			<?php
				}
			?>
			<tr style = "border: 1px solid #DDD;" >
				<td style="background-color: #CCCCCC;"  ></center></td>
				<td style="background-color: #F6F6F6;;" ></center></td>
				<td style="background-color: #F6F6F6;;" ></center></td>
				<td style="background-color: #F6F6F6;;" ></center></td>
				<td style="background-color: #F6F6F6;;" ></center></td>
				<td style="background-color: #F6F6F6;;" ></center></td>
			</tr>
		</tbody>
	</table>
</div>