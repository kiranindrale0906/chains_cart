<tr class="process_<?= $process['id']?>">
	<td>
		<?php load_field('checkbox', array('field' => 'chitti_id',
																		 	 'index' => $index,
																		 	 'class' => 'issue_department_details_process_id',
																		 	 'option' => array(
																		 	 							array('chk_id' => $index,
																		                      'value' => $process['id'],
																		                      'label' => '',
																		                      'checked' => (!empty($issue_department_details[$index]['chitti_id']) ? 'checked' : ''),
																		 	 						        )),
																		   'controller' => 'issue_department_chitti_details'));?>
	</td>
    <td><?php echo $process['product_name'];?></td>
	<td class="gross_weight"><?php echo $process['in_weight'];?></td>
	<td class="purity"><?php echo four_decimal($process['in_lot_purity']) ;?></td>
	<td class="fine"><?php echo four_decimal(($process['in_weight'] * $process['in_lot_purity']) / 100); ?></td>
	<td class="out_purity"><?php echo four_decimal($process['out_purity']); ?></td>
	<td class="out_fine"><?php echo four_decimal($process['wastage_fine']); ?></td>
</tr>