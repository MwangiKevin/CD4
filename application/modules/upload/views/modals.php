<!-- modal -->
<div class="modal fade" id="data" >
	<div class="modal-dialog" style="width:90%">
		<div class="modal-content">
			<?php echo form_open('upload/upload_commit'); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title">File contents:</h4>
			</div>
			<div class="modal-body" id="dataBody">
				<?php
				if($uploaded!=""){
				for($i=1;$i<sizeof($uploaded['testNO']);$i++){
				echo '<input type="hidden" name="testNO'.$i.'" value="'.$uploaded['testNO'][$i].'" />'.
					'<input type="hidden" name="deviceID'.$i.'" value="'.$uploaded['deviceID'][$i].'" />'.
					'<input type="hidden" name="asayID'.$i.'" value="'.$uploaded['asayID'][$i].'" />'.
					'<input type="hidden" name="sampleNumber'.$i.'" value="'.$uploaded['sampleNumber'][$i].'" />'.
					'<input type="hidden" name="cdCount'.$i.'" value="'.$uploaded['cdCount'][$i].'" />'.
					'<input type="hidden" name="resulttime'.$i.'" value="'.$uploaded['resulttime'][$i].'" />'.
					'<input type="hidden" name="resultDate'.$i.'" value="'.$uploaded['resultDate'][$i].'" />'.
					'<input type="hidden" name="barcode'.$i.'" value="'.$uploaded['barcode'][$i].'" />'.
					'<input type="hidden" name="volume'.$i.'" value="'.$uploaded['volume'][$i].'" />'.
					'<input type="hidden" name="expire'.$i.'" value="'.$uploaded['expire'][$i].'" />'.
					'<input type="hidden" name="device'.$i.'" value="'.$uploaded['device'][$i].'" />'.
					'<input type="hidden" name="reagent'.$i.'" value="'.$uploaded['reagent'][$i].'" />'.
					'<input type="hidden" name="error'.$i.'" value="'.$uploaded['error'][$i].'" />'.
					'<input type="hidden" name="operatorId'.$i.'" value="'.$uploaded['operatorId'][$i].'" />'.					
					'</tr>';
				
				}
				}
				?>
				<table class="table table-bordered dataTable">
				<?php
				echo '<thead>';
				for($i=0;$i<1;$i++){
					echo '<tr>'.
					'<th>'.$uploaded['testNO'][$i].'</th>'.
					'<th>'.$uploaded['deviceID'][$i].'</th>'.
					'<th>'.$uploaded['asayID'][$i].'</th>'.
					'<th>'.$uploaded['sampleNumber'][$i].'</th>'.
					'<th>'.$uploaded['cdCount'][$i].'</th>'.
					'<th>'.$uploaded['resultDate'][$i].'</th>'.
					'<th>'.$uploaded['operatorId'][$i].'</th>'.
					'<th>'.$uploaded['resulttime'][$i].'</th>'.
					'<th>'.$uploaded['barcode'][$i].'</th>'.
					'<th>'.$uploaded['volume'][$i].'</th>'.
					'<th>'.$uploaded['expire'][$i].'</th>'.
					'<th>'.$uploaded['device'][$i].'</th>'.
					'<th>'.$uploaded['reagent'][$i].'</th>'.
					'<th>'.$uploaded['error'][$i].'</th>'.
					'</tr>';
					
				}
				echo '<thead>';
				echo '<tbody>';
				$j=0;
				for($i=1;$i<sizeof($uploaded['testNO']);$i++){
					echo '<tr>'.
					'<td>'.$uploaded['testNO'][$i].' </td>'.
					'<td>'.$uploaded['deviceID'][$i].'</td>'.
					'<td>'.$uploaded['asayID'][$i].'</td>'.
					'<td>'.$uploaded['sampleNumber'][$i].'</td>'.
					'<td>'.$uploaded['cdCount'][$i].'</td>'.
					'<td>'.$uploaded['resultDate'][$i].'</td>'.
					'<td>'.$uploaded['operatorId'][$i].'</td>'.
					'<th>'.$uploaded['resulttime'][$i].'</th>'.
					'<th>'.$uploaded['barcode'][$i].'</th>'.
					'<th>'.$uploaded['volume'][$i].'</th>'.
					'<th>'.$uploaded['expire'][$i].'</th>'.
					'<th>'.$uploaded['device'][$i].'</th>'.
					'<th>'.$uploaded['reagent'][$i].'</th>'.
					'<th>'.$uploaded['error'][$i].'</th>'.
					'</tr>';
					$j++;
				}
				echo '</tbody>';
				?>
				</table>
			<?php
			echo '<input type="hidden" name="size" value="'.$j.'">';
			?>
			</div>
			<div class="modal-footer" style="height:45px">
				<button type="submit" class="btn btn-primary upload">
					<i class="fa fa-arrow-up"></i> Upload Data
				</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">
					<i class="fa fa-times"></i> Close
				</button>
			</div>
			<?php   echo form_close(); ?>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
