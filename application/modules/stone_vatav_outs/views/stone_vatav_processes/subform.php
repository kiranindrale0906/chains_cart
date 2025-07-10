<tr class="process_<?= $process['id']?>">
	<td>
		<?php load_field('checkbox', array('field' => 'process_id',
																			 'class' => 'stone_vatav_process_id',
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
	<td><?php echo $process['in_lot_purity'];?></td>
	<td><?php echo $process['lot_no'];?></td>
	<td class="balance_stone_vatav"><?php echo four_decimal($process['stone_vatav']);?></td>
	<td><?php echo four_decimal($process['stone_vatav'] * ($process['in_lot_purity'] / 100));?></td>
  <td><?php echo $process['created_at'];?></td>
</tr>