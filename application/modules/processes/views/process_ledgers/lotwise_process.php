<?php if (isset($lot_field_summary_records)) { ?>
	<h6><?= 'Balance difference for '.$lot_no ?></h6>
	<table class="table table-sm">
	  <thead class="bg_gray">
			<th>Process</th>
			<th>Department</th>
			<th class="text-right">Difference</th>
		</thead>
		<tbody>
			<?php
				$difference = 0;
				foreach($lotwise_process_records as $lotwise_process_record) {
					$difference += 	$lotwise_process_record['balance'];
					$href  = "/processes/processes/view/".$lotwise_process_record['id']; ?>
					<?php if($lotwise_process_record['balance'] != 0) { ?>
						<tr>
							<td>
								<a href="<?= $href; ?> target="_blank">
									<?= $lotwise_process_record['id'] ?>
								</a>
							</td>
							<td>
								<?= $lotwise_process_record['department_name'] ?>
							</td>
							<td class="text-right">
								<?= $lotwise_process_record['balance'] ?>
							</td>
						</tr>
					<?php } ?>
			<?php } ?>		
			<?php if ($difference==0) { ?>
				<tr>
					<td colspan="3">No difference in balance found.</td>
				</tr>
			<?php } ?>			
		</tbody>
	</table>
<?php } ?>