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
	<td><?php echo $process['id'];?></td>
  	<td><?php echo  date('d-m-Y',strtotime($process['date']));?></td>
  	<td class="gross_weight"><?php echo $process['gross_weight'];?></td>
	<td class="gross_weight"><?php echo $process['net_weight'];?></td>
	<td class="purity"><?php echo four_decimal($process['purity']) ;?></td>
	<td class="fine"><?php echo four_decimal(($process['gross_weight'] * $process['purity']) / 100); ?></td>
</tr>