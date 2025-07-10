<tr class="process_<?= $process['id']?>">
	<td>
		<?php load_field('checkbox', array('field' => 'process_id',
																		 	 'index' => $index,
																		 	 'class' => 'issue_department_details_process_id',
																		 	 'option' => array(
																		 	 							array('chk_id' => $index,
																		                      'value' => $process['id'],
																		                      'label' => '',
																		                      'checked' => (!empty($issue_department_details[$index]['process_id']) 
																		                      							? 'checked' : ''),
																		 	 						        )),
																		   'controller' => 'issue_department_details'));?>
	</td>
	<td><?php echo $process['parent_lot_name'];?></td>
	<td><?php echo $process['product_name'];?></td>
	<td><?php echo $process['department_name'];?></td>
	<td class="gross_weight"><?php echo four_decimal($process['loss']);?></td>
	<td class="gross_weight"><?php echo four_decimal(($process['loss'] * $process['out_lot_purity']) / 100);?></td>
	<td class="purity"><?php echo four_decimal($process['out_lot_purity']) ;?></td>
	<td class="fine"><?php echo four_decimal((($process['loss'] * $process['out_lot_purity']) / 100)* $process['out_lot_purity'] / 100); ?></td>
</tr>