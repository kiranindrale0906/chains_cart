<tr class="process_<?= $process['id']?>">
	<td class="text-right"><?php echo date('d M Y',strtotime($process['created_at']));?></td>
	<td class="text-right"><?php echo $process['department_name'];?></td>
	<td class="text-right"><?php echo $process['in_lot_purity'];?></td>
	<td class="text-right"><?php echo $process['in_weight'];?></td>
	<td class="text-right"><?php echo $process['out_weight'];?></td>
	<td class="text-right"><?php echo $process['melting_wastage'];?></td>
	<td class="text-right"><?php echo $process['balance'];?></td>
	<td class="text-right"><?php echo $process['tounch_in'];?></td>
	<td class="text-right"><?php echo $process['tounch_purity'];?></td>
	<td class="text-right"><?php echo $process['fire_tounch_in'];?></td>
	<td class="text-right"><?php echo $process['fire_tounch_purity'];?></td>
	<td class="text-right"><?php echo $process['daily_drawer_wastage'];?></td>
	<td class="text-right"><?php echo $process['loss'];?></td>
	<td class="text-right"><?php echo $process['loss']*$process['in_lot_purity']/100;?></td>
	<td class="text-right"><?php echo $process['tounch_loss_fine'];?></td>
</tr>