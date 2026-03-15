<div class="boxrow mb-2">
	<div class="float-left">
		<?php $page_details = @getTableSettings();?>
		<h6 class="heading blue bold text-uppercase mb-0">
			<?= @$page_details['page_title']; ?>
		</h6>
	</div>
</div>
<table class="table table-sm table-default table-hover">
	<thead>
		<tr>
			<th>Alloy Name</th>      
			<th class="text-right">In</th>
			<th class="text-right">Out</th>
			<th class="text-right">Balance</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
			if(!empty($alloy_records)){
				$in_wight_total= $out_wight_total=$balance_total=0;
				foreach ($alloy_records as $index => $alloy_record) {
					$in_wight_total+=$alloy_record['in_weight'];
					$out_wight_total+=$alloy_record['out_weight'];
					$balance_total+=$alloy_record['balance'];
					?>
				 <tr>
						<td class=""><?= $alloy_record['type']?></td>
						<td class="text-right"><?= four_decimal($alloy_record['in_weight']) ?></td>
						<td class="text-right"><?= four_decimal($alloy_record['out_weight']) ?></td>
						<td class="text-right"><?= four_decimal($alloy_record['balance']) ?></td>
					</tr> 
				<?php }?>
				 <tr class="bg_gray">
						<td></td>
						<td class="text-right bold"><span><?= four_decimal($in_wight_total) ?></span></td>
						<td class="text-right bold"><span><?= four_decimal($out_wight_total) ?></span></td>
						<td class="text-right bold"><span><?= four_decimal($balance_total) ?></span></td>
				 </tr>

		 <?php }else{ ?>
				<tr>
					<td>No Record Found.</td>
				</tr>
			<?php }
		?>
	</tbody>
</table>