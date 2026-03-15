<tr class="process_<?= $process['id']?>">
	<td>
		<?php load_field('checkbox', array('field' => 'process_id',
																			 'class' => 'tounch_ghiss_out_process_id',
																		 	 'index' => $index,
																		 	 'option' => array(
																		 	 							array('chk_id' => $index,
																		                      'value' => $process['id'],
																		                      'label' => '',
																		                      'checked' => (!empty($processes_out_wastage_details[$index]['process_id']) 
																		                      							? 'checked' : ''))),
																		   'controller' => 'process_out_wastage_details'));?>
	</td>
	<td><?php echo $process['product_name'];?></td>
	<td><?php echo $process['process_name'];?></td>
	<td><?php echo $process['department_name'];?></td>
	<td><?php echo $process['lot_no'];?></td>
	<td><?php echo $process['design_code'];?></td>
	<td class="balance_tounch_ghiss"><?php echo four_decimal($process['balance_tounch_ghiss']);?></td>
	<td><?php echo four_decimal($process['balance_tounch_ghiss'] * ($process['in_purity'] / 100) * ($process['in_lot_purity'] / 100));?></td>
</tr>