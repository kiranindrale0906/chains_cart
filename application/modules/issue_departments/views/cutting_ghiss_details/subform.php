<tr class="process_<?= $process['id']?>">
	<td>
		<?php load_field('checkbox', array('field' => 'process_id',
																		 	 'index' => $index,
																		 	 'class' => 'issue_department_details_process_id',
																		 	 'option' => array(
																		 	 							array('chk_id' => $index,
																		                      'value' => $process['id'],
																		                      'label' => '',
																		                      'checked' => (!empty($issue_department_details[$index]['process_id']) ? 'checked' : ''),
																		 	 						        )),
																		   'controller' => 'issue_department_details'));?>
	</td>
	<td><?php echo $process['product_name'];?></td>
	<td><?php echo $process['lot_no'];?></td>
	<td><?php echo $process['design_code'];?></td>
	<td class="gross_weight"><?php echo $process['balance_ghiss'];?></td>
	<td class="purity"><?php echo four_decimal($process['out_lot_purity']) ;?></td>
	<td class="fine"><?php echo four_decimal(($process['balance_ghiss'] * $process['out_lot_purity']) / 100); ?></td>
</tr>