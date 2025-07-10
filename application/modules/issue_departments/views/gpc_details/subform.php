<tr class="process_<?= $process['id']?>">
	<td>
		<?php load_field('checkbox', 
										 array('field' => 'process_id',
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
	<td><?php echo $process['lot_no'];?></td>
	<td><?php echo $process['tone'];?></td>
	<?php if(HOST=='ARC'){ ?>
		<td><?php echo $process['melting_lot_category_one'];?></td>
		<td><?php echo $process['melting_lot_category_two'];?></td>
	<?php } ?>
  <td><?= $process['product_name'].((HOST=='ARF') ? ' - '.$process["melting_lot_category_one"]	 : '') ;?></td>
	<td><?= ((HOST=='ARF') ? $process["machine_size"].' / '	 : '').$process['design_code'];?></td>
	<td>
		<?= @$process['design_chitti_name']; ?>
		<?php if (!empty($process['design_code']) && (empty($process['design_chitti_name']))) { ?>
			<a href="<?= base_url().'settings/category_fours/edit/0?product_name='.$process['product_name'].'&category='.$process['design_code'].'&machine_size='.$process['machine_size'] ?>">Add Chitti Design Name</a>
		<?php } ?>		
	</td>
	<td><?php echo four_decimal($process['tounch_purity']);?></td>
	<td ><?php load_field('text', array('field' => 'quantity','col'=> 'col-25',
			                             'class' => 'quantity','value'=>four_decimal($process['quantity']),
																 	 'index' => $index,
																   'controller' => 'issue_department_details')); ?>
	</td>
	<td><?php echo $process['melting_lot_chain_name'];?></td>
	<td><?php echo $process['customer_name'];?></td>
	<td><?php echo four_decimal($process['gpc_out']);?></td>
	<td class="balance_weight"><?php echo four_decimal($process['balance_gpc_out']);?></td>
	<td class="balance_quantity"><?php echo four_decimal($process['quantity']);?></td>
	<td>
		<?php load_field('text', array('field' => 'out_weight',
			                             'class' => 'out_weight','col'=> 'col-25',
																 	 'index' => $index,
																   'controller' => 'issue_department_details')); ?>
		
	</td>
	<td>
		<?php 
			//if(empty($process['chain_margin']) && ($record['product_name']=='GPC Out' || $record['product_name']=='Finish Good'))
			//else
				echo isset($process['chain_margin']) ? four_decimal($process['chain_margin']) : 0; ?>
				<br />
				<?php
				echo getHttpButton('set wastage', base_url().'settings/process_issue_purities/create?process_id='.$process['id'].'&weight='.$process['chain_margin'], '');  
		?>		
	</td>


	<td class="gross_weight"></td>
	<td class="gross_quantity"></td>
	<td class="purity"><?php echo four_decimal($process['out_lot_purity']) ;?></td>
	<td class="fine"></td>
	<td class="wastage_fine">
		<?php 
			//if(empty($process['chain_margin']) && ($record['product_name']=='GPC Out' || $record['product_name']=='Finish Good'))
			//else
		echo four_decimal($process['balance_gpc_out']*($process['out_lot_purity']+$process['chain_margin'])/100);
		?>		
	</td>
	<!-- <td>
		<?php 
			//if(empty($process['chain_margin']) && ($record['product_name']=='GPC Out' || $record['product_name']=='Finish Good'))
				//echo getHttpButton('add wastage', base_url().'settings/issue_purities/create?product_name='.$process['product_name'], 'btn-warning');  
			//else
			//	echo isset($process['chain_margin']) ? four_decimal($process['chain_margin']) : 0; 
		?>		
	</td> -->
	<td><?php echo $process['item_code'] ;?></td>
	<td>
		<?php 
			if((empty($process['chitti_purity'])||$process['chitti_purity']==0) && ($record['product_name']=='GPC Out' || $record['product_name']=='Finish Good'))
				echo getHttpButton('add chitti purity', base_url().'settings/issue_purities/create?product_name='.$process['product_name'], 'btn-warning');  
			else
				echo isset($process['chitti_purity']) ? four_decimal($process['chitti_purity']) : 0; 
		?>		
	</td>
</tr>
