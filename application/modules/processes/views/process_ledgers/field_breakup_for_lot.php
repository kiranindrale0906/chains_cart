<?php if (isset($field_breakup_for_lot_records)) { 
	$in_weight = $out_weight = 0; 
	$base_href  = "/processes/process_ledgers?product_name=".urlencode($product_name);
	$base_href .= "&lot_no=".urlencode($lot_no); 
	$base_href .= "&field_name=".urlencode($field_name); ?>
	<h6><?= ucwords(str_replace('_', ' ', $field_name)).' breakup for '.$lot_no ?></h6>
	Group By: <a href=<?= $base_href.'&field_breakup_for_lot_group=field_name' ?>>Field</a>
	|
	<a href=<?= $base_href.'&field_breakup_for_lot_group=process_id' ?>>Process</a>
	|
	<a href=<?= $base_href.'&field_breakup_for_lot_group=id' ?>>None</a>
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
				foreach($field_breakup_for_lot_records as $field_breakup_for_lot_record) {
					$in_weight += $field_breakup_for_lot_record['in_weight'];
					$out_weight += $field_breakup_for_lot_record['out_weight'];
					?>
					<tr>
						<td>
							<a href="/processes/processes/view/<?= $field_breakup_for_lot_record['process_id'] ?>" target="_blank">
								<?= $field_breakup_for_lot_record['process_id']; ?>
							</a>	
						</td>
						<td>
							<?= $field_breakup_for_lot_record['department_name'] ?>
						</td>
						
						<td>
							<?= ($field_breakup_for_lot_group != 'process_id') ? $field_breakup_for_lot_record['field_name'] : '-' ?>
						</td>
					
						<td class="text-right">
							<?= two_decimal($field_breakup_for_lot_record['in_weight']); ?>
						</td>
						<td class="text-right">
							<?= two_decimal($field_breakup_for_lot_record['out_weight']); ?>
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
			<tr class="bold <?= ($in_weight - $out_weight) !=0 ? 'text-danger' : '' ?>">
				<td>Difference</td>
				<td class="text-right"></td>
				<td class="text-right"></td>
				<td class="text-right"></td>
				<td class="text-right">
					<?= two_decimal($in_weight - $out_weight); ?>
				</td>
			</tr>
		</tbody>
	</table>
<?php } ?>