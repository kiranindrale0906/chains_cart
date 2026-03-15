<tr class="process_<?= $process['id']?>">
	<?php if($_SESSION['name']=="GPC HOLD"){ ?>
	<td>
		<?php load_field('checkbox', array('field' => 'process_id',
																			 'class' => 'gpc_out_process_id',
																		 	 'index' => $index,
																		 	 'option' => array(array('chk_id' => $index,
																		                      'value' => $process['id'],
																		                      'label' => '',
																		                      'checked' => (!empty($processes_out_wastage_details[$index]['process_id'])? 'checked' : ''))),
																		   'controller' => 'process_out_wastage_details'));?>
	</td>
	<?php }?>
	<td><?php echo $process['product_name'];?></td>
	<td><?php echo $process['process_name'];?></td>
	<td><?php echo $process['department_name'];?></td>
	<td><?php echo $process['lot_no'].' ('.$process['id'].')';?></td>
	<td><?php echo $process['design_code'];?></td>
	<td class="gpc_out"><?php echo ($process['balance_gpc_out']);?></td>
	<td><?php echo $process['username'];?></td>
	<td><?php echo $process['created_at'];?></td>
</tr>