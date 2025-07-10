<?php if (isset($lot_summary_records)) {
	$in_weight = $out_weight = 0; 
	$base_href  = "/processes/process_ledgers?product_name=".urlencode($product_name); ?>
	Group By: <a href=<?= $base_href.'&lot_process_group=lot_no' ?>>Lot No</a>
	|
	<a href=<?= $base_href.'&lot_process_group=process_id' ?>>Process</a>
	<table class="table table-sm">
	  <thead class="bg_gray">
			<th><?= ucwords(str_replace('_',' ',$lot_process_group)); ?></th>
			<th class="text-right">Weight Difference</th>
		</thead>
		<tbody>
			<?php 
				$weight_difference = 0;
				foreach($lot_summary_records as $lot_summary_record) {
					$weight_difference +=	$lot_summary_record['weight_difference'];
					$href = $base_href."&lot_process_group=".$lot_process_group."&".$lot_process_group."=".$lot_summary_record[$lot_process_group]; ?>
					<tr class="<?= $lot_summary_record[$lot_process_group]==$$lot_process_group ? 'bold bg-warning' : '' ?>">
						<td>
							<a style="color: black" href="<?= $href; ?>">
									<?= $lot_summary_record[$lot_process_group]; ?>
							</a>
						</td>
						<td class="text-right">
								<a href="<?= $href; ?>">
									<?= two_decimal($lot_summary_record['weight_difference']); ?>
								</a>
						</td>
					</tr>
			<?php } ?>		
			<tr class="bold <?= ($weight_difference) !=0 ? 'text-danger' : '' ?>">
				<td>Difference</td>
				<td class="text-right">
					<?= two_decimal($weight_difference); ?>
				</td>
			</tr>
		</tbody>
	</table>
<?php } ?> 