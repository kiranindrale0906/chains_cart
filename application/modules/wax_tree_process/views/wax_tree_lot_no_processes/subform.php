<tr class="process_<?= $process['id']?>">
	<td>
		<?php load_field('checkbox', array('field' => 'wax_id',
																		 	 'index' => $index,
																		 	 'class' => 'wax_tree_process_id',
																		 	 'option' => array(
																		 	 							array('chk_id' => $index,
																		                      'value' => $process['id'],
																		                      'label' => '',
																		                      'checked' => (!empty($wax_tree_processes[$index]['wax_id']) ? 'checked' : ''),
																		 	 						        )),
																		   'controller' => 'wax_tree_processes'));?>
	</td>
	<td><?php echo $process['id'];?></td>
	<td><?php echo $process['type'];?></td>
	<td><?php echo $process['item_name'];?></td>
	<td><?php echo $process['melting'];?></td>
	<td><?php echo $process['tree_gross_wt'];?></td>
	<td><?php echo $process['tree_base_wt'];?></td>
	<td><?php echo $process['stone_wt'];?></td>
	<td><?php echo $process['tree_net_wt'];?></td>
	<td><?php echo $process['gold_ratio'];?></td>
	<td><?php echo $process['total_required_gold'];?></td>
</tr>