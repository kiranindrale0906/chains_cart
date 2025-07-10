<tr class="process_<?= $process['id']?>">
	<td>
		<?php load_field('checkbox', array('field' => 'process_id',
																			 'class' => 'pending_loss_from_hook_process_id',
																		 	 'index' => $index,
																		 	 'option' => array(
																		 	 							array('chk_id' => $index,
																		                      'value' => $process['id'],
																		                      'label' => '',
																		                      'checked' => (!empty($processes_out_wastage_details[$index]['process_id']) ? 'checked' : ''))),
																		   'controller' => 'process_out_wastage_details'));?>
	</td>
	<td><?php echo $process['completed_at'];?></td>
	<td><?php echo $process['lot_no'];?></td>
	<td><?php echo $process['product_name'];?></td>
	<td><?php echo $process['design_code']; ?></td>
	<td class="in_weight"><?php echo four_decimal($process['in_lot_purity']); ?></td>
	<td class="in_lot_purity"><?php echo four_decimal($process['in_weight']); ?></td>
	<td><?php echo four_decimal($process['out_weight']); ?></td>
	<td class="balance_hook_in_weight"><?php echo four_decimal($process['hook_in']); ?></td>
	<td><?php echo four_decimal($process['loss']); ?></td>
</tr>