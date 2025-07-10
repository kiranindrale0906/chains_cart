
<div class='col-sm-6'>
<?php 
// pd($group_purity_of_process_balance);
if(!empty($worker_daily_drawers)){
  foreach ($worker_daily_drawers as $worker_name_index => $purity_columns) { 
    if($worker_name_index==$record['worker']){ ?>
    <table class="table table-sm fixedthead table-default">
<?php 
  $href = ADMIN_PATH.'daily_drawers/daily_drawer_in_out_views?';
?>
<thead>
<tr>
  <th>Purity</th>
  <th class="text-right">Balance</th>
  <!-- <th class="text-right">Process Balance</th> -->
  <th class="text-right">Total</th>
</tr>
</thead>
<tbody>
<?php
 $sum_in_weight=$sum_out_weight=$sum_balance=$sum_balance_fine=$sum_box_weight=$balance=$balance_fine=0;
 foreach ($purity_columns as $purity_index => $purity_wise_datas) {
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
					 // $balance_fine=($type_data['in']-$type_data['gpc_powder_out'])*$purity_index/100;
					}else{
					$sum_out_weight+=($type_data['out']);
					 $balance=$type_data['in']-$type_data['out'];
					 // $balance_fine=($type_data['in']-$type_data['out'])*$purity_index/100;
					}

					
					$sum_balance+=$balance;
					// $sum_balance_fine+=$balance_fine;
					$sum_box_weight=$sum_box_weight+$sum_balance;
				 	

					$purity_sum_in_weight+=($type_data['in']);

					if($type_index=='GPC Powder'){
					$purity_sum_out_weight+=($type_data['gpc_powder_out']);
					$purity_balance=$type_data['in']-$type_data['gpc_powder_out'];
					$purity_balance_fine=($type_data['in']-$type_data['gpc_powder_out'])*$purity_index/100;
					}else{
					 $purity_sum_out_weight+=($type_data['out']);
					 $purity_balance=$type_data['in']-$type_data['out'];
					 // $purity_balance_fine=($type_data['in']-$type_data['out'])*$purity_index/100;
					}
					
					$purity_sum_box_weight+=($type_data['box_weight']);
					$purity_sum_balance+=$balance;
					// $purity_sum_balance_fine+=$balance_fine;
					$purity_sum_box_weight=$purity_sum_box_weight+$purity_balance;
				 	?>
					
	  	<?php 	$count++; } 
	  	$process_balance=!empty($group_purity_of_process_balance[$purity_index]['weight'])?$group_purity_of_process_balance[$purity_index]['weight']:0;
	  	?>
	  </tr>
	  <tr class="">
			<td class="bold"><?=$purity_index;?></td>
			<td class="text-right bold"><?=four_decimal($purity_sum_balance);?></td>
			<!-- <td class="text-right bold"><?//=four_decimal($process_balance);?></td> -->
			<td class="text-right bold"><?=four_decimal($purity_sum_balance+$process_balance);?></td>
		</tr>

<?php 	} ?>

</tbody> 
</table>
<?php }}
}?>
<hr>
</div>
