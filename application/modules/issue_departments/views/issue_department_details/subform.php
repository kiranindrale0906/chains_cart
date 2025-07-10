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
	<td><?php echo $process['lot_no'];?></td>
	<td><?php echo $process['tone'];?></td>
    <td><?php echo $process['product_name'];?></td>
    <?php if(HOST=="Hallmark"){?>
	<td><?php echo $process['job_card_no'];?></td>
	<td><?php echo $process['factory_issue_department_id'];?></td>
	<?php }else{
		if($record['product_name']=="QC Out"){
		?>

	<td><?php echo $process['melting_lot_category_one'];?></td>
<?php }else{?>
	<td><?php echo $process['design_code'];?></td>
    <?php }}?>
	<td><?php echo $process['description'];?></td>
	<?php if(HOST=='Hallmark'){ ?><td><?php echo two_decimal($process['out_quantity']);?></td>
	</td>
	<?php }else{
		?>
	<td><?php echo two_decimal($process['quantity']);?></td>
	</td>
	<?php }?>
	<td class=""><?php echo $process['gpc_out'];?></td>
	<td class="gross_weight"><?php echo $process['balance_gpc_out'];?></td>
	<td class="purity"><?php echo four_decimal($process['out_lot_purity']) ;?></td>
	<td class="fine"><?php echo four_decimal(($process['balance_gpc_out'] * $process['out_lot_purity']) / 100); ?></td>
	<?php if(HOST=='Domestic'){ ?><td><?php echo $process['rate_per_gram'] ?></td><?php }?>
	
</tr>
