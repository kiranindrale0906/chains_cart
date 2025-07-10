<tr class="process_<?= $process['id']?>">
	<td>
		<?php load_field('checkbox', array('field' => 'process_id',
																			 'class' => 'daily_drawer_wastage_hold_process_id',
																		 	 'index' => $index,
																		 	 'option' => array(array('chk_id' => $index,
																		                      'value' => $process['id'],
																		                      'label' => '',
																		                      'checked' => (!empty($processes_out_wastage_details[$index]['process_id']) 
																		                      							? 'checked' : ''))),
																		   'controller' => 'process_out_wastage_details'));?>
	</td>
	<td><?php echo $process['product_name'];?></td>
	<td><?php echo $process['process_name'];?></td>
	<td><?php echo $process['department_name'];?></td>
	<td><?php echo $process['lot_no'].' ('.$process['id'].')';?></td>
	<td><?php echo $process['design_code'];?></td>
	<td><?php echo ($process['daily_drawer_wastage']);?></td>
	<td class="balance_hold_daily_drawer_wastage"><?php echo ($process['balance_daily_drawer_wastage']);?></td>
	<td><?php echo $process['username'];?></td>
	<td><?php echo $process['created_at'];?></td>
</tr>