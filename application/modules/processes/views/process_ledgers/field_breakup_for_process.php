<?php if (isset($field_breakup_for_process_records)) { 
	$in_weight = $out_weight = 0; ?>
	<h6><?= 'Breakup for process: '.$process_id ?></h6>
	<table class="table table-sm">
	  <thead class="bg_gray">
			<th>Process</th>
			<th>Department Name</th>
			<th>Field Name</th>
			<th class="text-right">In Weight</th>
			<th class="text-right">Out Weight</th>
		</thead>
		<tbody>
			<?php 
				foreach($field_breakup_for_process_records as $field_breakup_for_process_record) {
					$in_weight += $field_breakup_for_process_record['in_weight'];
					$out_weight += $field_breakup_for_process_record['out_weight'];
					?>
					<tr>
						<td>
							<a href="/processes/processes/view/<?= $field_breakup_for_process_record['process_id'] ?>" target="_blank">
								<?= $field_breakup_for_process_record['process_id']; ?>
							</a>	
						</td>
						<td>
							<?= $field_breakup_for_process_record['department_name']; ?>
						</td>
						<td>
							<?= $field_breakup_for_process_record['field_name']; ?>
						</td>
						<td class="text-right">
							<?= two_decimal($field_breakup_for_process_record['in_weight']); ?>
						</td>
						<td class="text-right">
							<?= two_decimal($field_breakup_for_process_record['out_weight']); ?>
						</td>
					</tr>
			<?php } ?>		
		</tbody>
		<tbody>
			<tr class="bold">
				<td>Total</td>
				<td></td>
				<td></td>
				<td class="text-right">
					<?= two_decimal($in_weight); ?>
				</td>
				<td class="text-right">
					<?= two_decimal($out_weight); ?>
				</td>
			</tr>
		</tbody>
	</table>
<?php } ?>