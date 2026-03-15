<?php 
  $href = ADMIN_PATH.'daily_drawers/daily_drawer_in_out_views?';
?>
<thead>
<tr>
  <th>Purity</th>
  <th></th>
  <th>Type</th>
  <th></th>
  <th class="text-right">In</th>
  <th class="text-right">Out</th>
  <th class="text-right">Balance</th>
  <th class="text-right">Balance Fine</th>
</tr>
</thead>
<tbody>
<?php
 $sum_in_weight=$sum_out_weight=$sum_balance=$sum_balance_fine=$balance=$balance_fine=0;
 foreach ($purity_columns as $purity_index => $purity_wise_datas) {
 		$purity_sum_in_weight=$purity_sum_out_weight=$purity_sum_balance=$purity_sum_balance_fine=$purity_balance=$purity_balance_fine=0;
 	?>
	  <tr>
	  	<?php
	  		$count=0;
				 foreach ($purity_wise_datas as $type_index => $type_data) { 
				 	$sum_in_weight+=($type_data['in']);
					$sum_out_weight+=($type_data['out']);
					$balance=$type_data['in']-$type_data['out'];
					$balance_fine=($type_data['in']-$type_data['out'])*$purity_index/100;
					$sum_balance+=$balance;
					$sum_balance_fine+=$balance_fine;

					$purity_sum_in_weight+=($type_data['in']);
					$purity_sum_out_weight+=($type_data['out']);
					$purity_balance=$type_data['in']-$type_data['out'];
					$purity_balance_fine=($type_data['in']-$type_data['out'])*$purity_index/100;
					$purity_sum_balance+=$balance;
					$purity_sum_balance_fine+=$balance_fine;
				 	?>
					<tr>
	  					<td><?=($count==0)?$purity_index:''?></td>
	  					<td>
	  						<?php
	  							if ($count==0) {
	  								if (!empty($karigar)) {
	  									load_buttons('anchor',array('name'=>'View',
					                                      	'layout' => 'application',
					                                      	'class'=>'btn-xs bold blue float-left bar_code_genrate',
					                                      	'href'=>ADMIN_PATH."issue_and_receipts/karigar_ledgers/create?karigar=".$karigar."&&hook_kdm_purity=".$purity_index.""));
	  								}
	  							}
	  						?>
  						</td>
							<td><?=$type_index ?></td>
							<td>
	  						<?php
  								if (!empty($karigar)) {
  									load_buttons('anchor',array('name'=>'View',
				                                      	'layout' => 'application',
				                                      	'class'=>'btn-xs bold blue float-left bar_code_genrate',
				                                      	'href'=>ADMIN_PATH."issue_and_receipts/karigar_ledgers/create?karigar=".$karigar."&&hook_kdm_purity=".$purity_index."&&type=".$type_index));
  								}
	  						?>
  						</td>
							<td class="text-right"><a href=<?=$href.'type='.str_replace(' ', '_', $type_index).'&&column=in_weight&&purity='.$purity_index.'&&karigar='.str_replace(' ', '_', $karigar)?> ><?=isset($type_data['in'])?$type_data['in']:0 ?></a></td>
							<td class="text-right"><a href=<?=$href.'type='.str_replace(' ', '_', $type_index).'&&column=out_weight&&purity='.$purity_index.'&&karigar='.str_replace(' ', '_', $karigar)?> ><?=isset($type_data['out'])?$type_data['out']:0?>
							</a></td>
							<td class="text-right"><a href=<?=$href.'type='.str_replace(' ', '_', $type_index).'&&column=balance&&purity='.$purity_index.'&&karigar='.str_replace(' ', '_', $karigar)?> ><?=isset($balance)?four_decimal($balance):0?></a></td>
							<td class="text-right"><?=isset($balance_fine)?four_decimal($balance_fine):0?></td>
			  			
			  	</tr>
	  	<?php 	$count++; } ?>
	  </tr>
	  <tr class="bg_gray">
			<td class="bold"></td>
			<td></td>
			<td></td>
			<td></td>
			<td class="text-right bold"><?=four_decimal($purity_sum_in_weight);?></td>
			<td class="text-right bold"><?=four_decimal($purity_sum_out_weight);?></td>
			<td class="text-right bold"><?=four_decimal($purity_sum_balance);?></td>
			<td class="text-right bold"><?=four_decimal($purity_sum_balance_fine);?></td>
		</tr>

<?php 	} ?>
<tr class="bg_cyan bold">
	<td>Total</td>
	<td></td>
	<td></td>
	<td></td>
	<td class="text-right bold"><?=four_decimal($sum_in_weight);?></td>
	<td class="text-right bold"><?=four_decimal($sum_out_weight);?></td>
	<td class="text-right bold"><?=four_decimal($sum_balance);?></td>
	<td class="text-right bold"><?=four_decimal($sum_balance_fine);?></td>
</tr>
</tbody> 