<tr class="process_<?= $process['id']?>">
	<td>
		<?php load_field('checkbox', array('field' => 'process_id',
																		 	 'index' => $index,
																		 	 'class' => 'finish_good_details_process_id',
																		 	 'option' => array(
																		 	 							array('chk_id' => $index,
																		                      'value' => $process['id'],
																		                      'label' => '',
																		                      'checked' => (!empty($finish_good_details[$index]['process_id']) ? 'checked' : ''),
																		 	 						        )),
																		   'controller' => 'finish_good_details'));?>
	</td>
	<td><?php echo $process['lot_no'];?></td>
	<td><?php echo $process['tone'];?></td>
  <td><?php echo $process['product_name'];?></td>
  <td><?php echo $process['department_name'];?></td>
	<td><?php echo $process['design_code'];?></td>
	<td><?php echo $process['quantity'];?></td>
	<td class="gross_weight"><?php echo $process['gpc_out'];?></td>
	<td class="gross_weight"><?php echo $process['balance_gpc_out'];?></td>
	<td class="purity"><?php echo four_decimal($process['out_lot_purity']) ;?></td>
	<td class="fine"><?php echo four_decimal(($process['gpc_out'] * $process['out_lot_purity']) / 100); ?></td>
</tr>