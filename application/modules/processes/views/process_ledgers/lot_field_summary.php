<?php if (isset($lot_field_summary_records)) { 
	$base_href  = "/processes/process_ledgers?product_name=".$product_name;
	$base_href .= "&lot_no=".$lot_no; ?>	
	<h6><?= $lot_no.' Weight Summary' ?></h6>
	<a href="<?= $base_href.'&field_name=All Fields' ?>">View breakup for all fields</a>
	<table class="table table-sm">
	  <thead class="bg_gray">
			<th>Field Name</th>
			<th class="text-right">In Weight</th>
			<th class="text-right">Out Weight</th>
		</thead>
		<tbody>
			<?php
				$in_weight = $out_weight = 0;
				foreach($lot_field_summary_records as $lot_field_summary_record) {
					$in_weight += $lot_field_summary_record['in_weight'];
					$out_weight += $lot_field_summary_record['out_weight'];	
					$href  = "/processes/process_ledgers?product_name=".$product_name;
					$href .= "&lot_no=".$lot_field_summary_record['lot_no']; 
					$href .= "&field_name=".$lot_field_summary_record['field_name']; ?>
					<tr class="<?= $lot_field_summary_record['field_name']==$field_name ? 'bold bg-warning' : '' ?>">
						<td>
							<a style="color: black" href="<?= $href; ?>">
								<?= ucwords(str_replace('_', ' ',$lot_field_summary_record['field_name'])); ?>
							</a>
						</td>
						<td class="text-right">
							<a href="<?= $href; ?>"><?= two_decimal($lot_field_summary_record['in_weight']); ?></a>
						</td>
						<td class="text-right">
							<a href="<?= $href; ?>"><?= two_decimal($lot_field_summary_record['out_weight']); ?></a>
						</td>
					</tr>
			<?php } ?>		
		</tbody>
		<tbody>
			<tr class="bold">
				<td>Total</td>
				<td class="text-right">
					<?= two_decimal($in_weight); ?>
				</td>
				<td class="text-right">
					<?= two_decimal($out_weight); ?>
				</td>
			</tr>
			<tr class="bold <?= ($in_weight - $out_weight) !=0 ? 'text-danger' : '' ?>">
				<td>Difference</td>
				<td class="text-right">
				</td>
				<td class="text-right">
					<?= two_decimal($in_weight - $out_weight); ?>
				</td>
			</tr>
		</tbody>
	</table>
<?php } ?>		