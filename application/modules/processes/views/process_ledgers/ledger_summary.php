<table class="table table-sm">
  <thead class="bg_gray">
		<th>Chain / Wastage</th>
		<th class="text-right">Weight Difference</th>
	</thead>
	<tbody>
		<?php 
			foreach($ledger_summary_records as $ledger_summary_record) {	
				$href = "/processes/process_ledgers?product_name=".$ledger_summary_record['product_name'];
				?>
				<tr class="<?= $ledger_summary_record['product_name']==$product_name ? 'bold bg-warning' : '' ?>">
					<td>
						<a style="color: black" href="<?= $href; ?>">
							<?= $ledger_summary_record['product_name']; ?>
						</a>
					</td>
					<td class="text-right">
							<a href="<?= $href; ?>">
								<?= two_decimal($ledger_summary_record['weight_difference']); ?>
							</a>
					</td>
				</tr>
		<?php } ?>		
	</tbody>
</table>