<thead>
<tr>
  <th>Lot No</th>
  <th>Purity</th>
  <th>Design Code</th>
  <th class="text-right">Balance</th>
</tr>
</thead>
<tbody>
<?php
 $sum_in_weight=$sum_out_weight=$sum_balance=$sum_balance_fine=$sum_box_weight=$balance=$balance_fine=0;
 foreach ($lot_no_columns as $lot_no_index => $purity_columns) {
 foreach ($purity_columns as $purity_index => $purity_wise_datas) {
 		$purity_sum_in_weight=$purity_sum_out_weight=$purity_sum_balance=$purity_sum_balance_fine=$purity_balance=$purity_balance_fine=$purity_sum_box_weight=0;
 	?>
	  <tr>
	  	<?php
	  		$count=0;
				 foreach ($purity_wise_datas as $type_index => $type_data) { 
				 	$sum_in_weight+=($type_data['in']);
					$sum_out_weight+=($type_data['out']);
					$balance=$type_data['in']+$type_data['out'];
					 

					
					$sum_balance+=$balance;
					$purity_sum_in_weight+=($type_data['in']);
					
					 $purity_sum_out_weight+=($type_data['out']);
					 $purity_balance=$type_data['in']-$type_data['out'];
					 $purity_sum_balance+=$balance;	 	?>
					<tr>
	  					<td><?=($count==0)?$lot_no_index:''?></td>
	  					<td><?=($count==0)?$purity_index:''?></td>
						<td><?=$type_index ?></td>
						<td class="text-right"><?=isset($balance)?four_decimal($balance):0?></td>
							
			  			
			  	</tr>
	  	<?php 	$count++; }} ?>
	  </tr>

<?php 	} ?>
<tr class="bg_cyan bold">
	<td>Total</td>
	<td></td>
	<td></td>
	<td class="text-right bold"><?=four_decimal($sum_balance);?></td>
</tr>
</tbody> 