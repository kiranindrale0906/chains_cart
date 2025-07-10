
<thead>
<tr>
  <th>Purity</th>
  <th>Type</th>
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
				 	?>
					<tr>
	  					<td><?=($count==0)?$purity_index:''?></td>
							<td ><?=$type_index ?></td>
							<td class="text-right"><?=isset($type_data['in'])?$type_data['in']:0 ?></td>
							<td class="text-right"><?=isset($type_data['out'])?$type_data['out']:0?></td>
							<td class="text-right"><?=isset($balance)?$balance:0?></td>
							<td class="text-right"><?=isset($balance_fine)?$balance_fine:0?></td>
			  			
			  	</tr>
	  	<?php 	$count++; } ?>
	  </tr>
<?php 	} ?>
<tr class="bg_gray">
	<td class="bold">Total</td>
	<td></td>
	<td class="text-right bold"><?=four_decimal($sum_in_weight);?></td>
	<td class="text-right bold"><?=four_decimal($sum_out_weight);?></td>
	<td class="text-right bold"><?=four_decimal($sum_balance);?></td>
	<td class="text-right bold"><?=four_decimal($sum_balance_fine);?></td>
</tr>
</tbody> 