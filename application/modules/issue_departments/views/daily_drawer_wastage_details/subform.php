<tr class="process_<?= $process['id']?>">
	<td>
		<?php load_field('checkbox', array('field' => 'process_id',
																			 'class' => 'issue_department_details_process_id',
																		 	 'index' => $index,
																		 	 'option' => array(
																		 	 							array('chk_id' => $index,
																		                      'value' => $process['id'],
																		                      'label' => '',
																		                      'checked' => (!empty($issue_department_details[$index]['process_id']) ? 'checked' : ''),
																		 	 						        )),
																		   'controller' => 'issue_department_details'));?>
	</td>
	<td><?php echo $process['department_name'];?></td>
	<td><?php echo $process['process_name'];?></td>
	<td><?php echo $process['quantity'];?></td>
	<td><?php echo four_decimal($process['daily_drawer_wastage']);?></td>
	<td class="balance_weight"><?php echo four_decimal($process['balance_daily_drawer_wastage']);?></td>
	<td>
		<?php load_field('text', array('field' => 'out_weight',
			                             'class' => 'out_weight',
																 	 'index' => $index,
																   'controller' => 'issue_department_details')); ?>
		
	</td>
	<td class="gross_weight"></td>
	<td class="purity"><?php echo four_decimal($process['out_lot_purity']) ;?></td>
	<td class="fine"></td>
</tr>