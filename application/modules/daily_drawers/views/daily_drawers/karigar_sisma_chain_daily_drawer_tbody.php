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
  <th class="text-right">Total Balance</th>
</tr>
</thead>
<tbody>
<?php
 $sum_in_weight=$sum_out_weight=$sum_balance=$sum_balance_fine=$sum_box_weight=$balance=$balance_fine=0;
 foreach ($purity_columns as $purity_index => $purity_wise_datas) {
 		if( $purity_index!=0){
 		$purity_sum_in_weight=$purity_sum_out_weight=$purity_sum_balance=$purity_sum_balance_fine=$purity_balance=$purity_balance_fine=$purity_sum_box_weight=0;
 	?>
	  <tr>
	  	<?php
	  		$count=0;
				 foreach ($purity_wise_datas as $type_index => $type_data) { 
				 	$sum_in_weight+=($type_data['in']);
				 	$sum_box_weight+=($type_data['box_weight']);
					if($type_index=='GPC Powder'){
					 $sum_out_weight+=($type_data['gpc_powder_out']);	
					 $balance=$type_data['in']-$type_data['gpc_powder_out'];
					 $balance_fine=($type_data['in']-$type_data['gpc_powder_out'])*$purity_index/100;
					}else{
					$sum_out_weight+=($type_data['out']);
					 $balance=$type_data['in']-$type_data['out'];
					 $balance_fine=($type_data['in']-$type_data['out'])*$purity_index/100;
					}

					
					$sum_balance+=$balance;
					$sum_balance_fine+=$balance_fine;
					$sum_box_weight=$sum_box_weight;
				 	

					$purity_sum_in_weight+=($type_data['in']);

					if($type_index=='GPC Powder'){
					$purity_sum_out_weight+=($type_data['gpc_powder_out']);
					$purity_balance=$type_data['in']-$type_data['gpc_powder_out'];
					$purity_balance_fine=($type_data['in']-$type_data['gpc_powder_out'])*$purity_index/100;
					}else{
					 $purity_sum_out_weight+=($type_data['out']);
					 $purity_balance=$type_data['in']-$type_data['out'];
					 $purity_balance_fine=($type_data['in']-$type_data['out'])*$purity_index/100;
					}
					
					$purity_sum_box_weight+=($type_data['box_weight']);
					$purity_sum_balance+=$balance;
					$purity_sum_balance_fine+=$balance_fine;
					$purity_sum_box_weight=$purity_sum_box_weight;
				 	?>
					<tr>
	  					<td><?=($count==0)?$purity_index:''?></td>
	  					<td>
	  						<?php
	  							if ($count==0) {
	  								if (!empty($karigar)) {
	  									$type='';
	  									if($type_index=='GPC Powder'){
	  										$type="&&type=".$type_index;
	  									}
	  									load_buttons('anchor',array('name'=>'View',
					                                      	'layout' => 'application',
					                                      	'class'=>'btn-xs bold blue float-left bar_code_genrate',
					                                      	'href'=>ADMIN_PATH."issue_and_receipts/karigar_ledgers/create?karigar=".$karigar."&&hook_kdm_purity=".$purity_index.$type."&&group_by_purity=".$group_by_purity));
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
				                                      	'href'=>ADMIN_PATH."issue_and_receipts/karigar_ledgers/create?karigar=".$karigar."&&hook_kdm_purity=".$purity_index."&&type=".$type_index."&&group_by_purity=".$group_by_purity));
  								}
	  						?>
  						</td>
							<td class="text-right"><a href=<?=$href.'type='.str_replace(' ', '_', $type_index).'&&column=in_weight&&purity='.$purity_index.'&&karigar='.str_replace(' ', '_', $karigar)?> ><?=isset($type_data['in'])?$type_data['in']:0 ?></a></td>

							<?php if($type_index=='GPC Powder'){?>
							<td class="text-right"><a href=<?=$href.'type='.str_replace(' ', '_', $type_index).'&&column=out_weight&&purity='.$purity_index.'&&karigar='.str_replace(' ', '_', $karigar)?> ><?=isset($type_data['gpc_powder_out'])?four_decimal($type_data['gpc_powder_out']):0?>
							</a></td>
							<?php }else{?>
							<td class="text-right"><a href=<?=$href.'type='.str_replace(' ', '_', $type_index).'&&column=out_weight&&purity='.$purity_index.'&&karigar='.str_replace(' ', '_', $karigar)?> ><?=isset($type_data['out'])?four_decimal($type_data['out']):0?>
							</a></td>

							<?php }?>

							<td class="text-right"><a href=<?=$href.'type='.str_replace(' ', '_', $type_index).'&&column=balance&&purity='.$purity_index.'&&karigar='.str_replace(' ', '_', $karigar)?> ><?=isset($balance)?four_decimal($balance):0?></a></td>
							<td class="text-right"><?=isset($balance_fine)?four_decimal($balance_fine):0?></td>
							<td class="text-right"><?=isset($type_data['box_weight'])?four_decimal($type_data['box_weight']):four_decimal(0) ?></td>
							
							
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
			<td class="text-right bold"><?=four_decimal($purity_sum_box_weight);?></td>
		</tr>

<?php  }	} ?>
<tr class="bg_cyan bold">
	<td>Total</td>
	<td></td>
	<td></td>
	<td></td>
	<td class="text-right bold"><?=four_decimal($sum_in_weight);?></td>
	<td class="text-right bold"><?=four_decimal($sum_out_weight);?></td>
	<td class="text-right bold"><?=four_decimal($sum_balance);?></td>
	<td class="text-right bold"><?=four_decimal($sum_balance_fine);?></td>
	<td class="text-right bold"><?=four_decimal($sum_box_weight);?></td>
</tr>
</tbody> 