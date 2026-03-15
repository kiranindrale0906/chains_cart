<thead>
<tr>
  <th>Product Name</th>
  <th>Purity</th>
  <th class="text-right">Balance</th>
</tr>
</thead>
<tbody>
<?php
 $sum_balance=$balance=0;
 foreach ($product_name_columns as $product_name_index => $purity_columns) {
 	$count=0;
 foreach ($purity_columns as $purity_index => $purity_wise_datas) {
 		$purity_sum_balance=$purity_balance=0;
 	?>
	  <tr>
	  	<?php
	  		
				 foreach ($purity_wise_datas as $type_index => $type_data) { 
				 	$balance=$type_data;
					$sum_balance+=$balance;
					$purity_sum_balance+=$balance;	 	?>
					<tr>
	  					<td><?=($count==0)?$product_name_index:''?></td>
	  					<td><?=$purity_index?></td>
						<td class="text-right"><?=!empty($balance)?four_decimal($balance):0?></td>
							
			  			
			  	</tr>
	  	<?php 	$count++; }} ?>
	  </tr>

<?php 	} ?>
<tr class="bg_gray bold">
	<td>Total</td>
	<td></td>
	<td class="text-right bold"><?=four_decimal($sum_balance);?></td>
</tr>
</tbody> 