<tr class="process_<?= $process_factory_order_detail['factory_order_detail_id'] ?>">
	<td>
		<?php load_field('checkbox', array('field' => 'factory_order_detail_id',
																			 'class' => 'factory_order_detail_id',
																			 'value' => 0,
																		 	 'index' => $index,
																		 	 'option' => array(
																		 	 							array('chk_id' => $index,
																		                      'value' => $process_factory_order_detail['factory_order_detail_id'],
																		                      'label' => '',
																		                      'checked' => '')),
																		   'controller' => 'process_factory_order_details')); ?>
	</td>
	<td><?php echo $process_factory_order_detail['customer_name'];?></td>
		<?php 
			$wt_per_inch=0;
			if ($process_factory_order_detail['wt_in_18_inch'] != 0)
        $wt_per_inch = $process_factory_order_detail['wt_in_18_inch'] / 18;
      elseif ($process_factory_order_detail['wt_in_24_inch'] != 0)
        $wt_per_inch = $process_factory_order_detail['wt_in_24_inch'] / 24;
	 	?>
	<td><?php echo $process_factory_order_detail['14_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['15_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['16_inch_qty']; ?></td>
    <td><?php echo $process_factory_order_detail['17_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['18_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['19_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['20_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['21_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['22_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['23_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['24_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['25_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['26_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['27_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['28_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['29_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['30_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['31_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['32_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['33_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['34_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['35_inch_qty']; ?></td>
	<td><?php echo $process_factory_order_detail['36_inch_qty']; ?></td>
	<td class="total_weight">
		<?php echo four_decimal(  ($process_factory_order_detail['14_inch_qty'] * 14 * $wt_per_inch)
												 	  +($process_factory_order_detail['15_inch_qty'] * 15 * $wt_per_inch)
												 	  + ($process_factory_order_detail['16_inch_qty'] * 16 * $wt_per_inch)
												 	  + ($process_factory_order_detail['17_inch_qty'] * 17 * $wt_per_inch)
												 	  + ($process_factory_order_detail['18_inch_qty'] * 18 * $wt_per_inch)
												 	  + ($process_factory_order_detail['19_inch_qty'] * 19 * $wt_per_inch)
													  + ($process_factory_order_detail['20_inch_qty'] * 20 * $wt_per_inch)
													  + ($process_factory_order_detail['21_inch_qty'] * 21 * $wt_per_inch)
													  + ($process_factory_order_detail['22_inch_qty'] * 22 * $wt_per_inch)
													  + ($process_factory_order_detail['23_inch_qty'] * 23 * $wt_per_inch)
													  + ($process_factory_order_detail['24_inch_qty'] * 24 * $wt_per_inch)
													  + ($process_factory_order_detail['25_inch_qty'] * 25 * $wt_per_inch)
													  + ($process_factory_order_detail['26_inch_qty'] * 26 * $wt_per_inch)
													  + ($process_factory_order_detail['27_inch_qty'] * 27 * $wt_per_inch)
													  + ($process_factory_order_detail['28_inch_qty'] * 28 * $wt_per_inch)
													  + ($process_factory_order_detail['29_inch_qty'] * 29 * $wt_per_inch)
													  + ($process_factory_order_detail['30_inch_qty'] * 30 * $wt_per_inch)
													  + ($process_factory_order_detail['31_inch_qty'] * 31 * $wt_per_inch)
													  + ($process_factory_order_detail['32_inch_qty'] * 32 * $wt_per_inch)
													  + ($process_factory_order_detail['33_inch_qty'] * 33 * $wt_per_inch)
													  + ($process_factory_order_detail['34_inch_qty'] * 34 * $wt_per_inch)
													  + ($process_factory_order_detail['35_inch_qty'] * 35 * $wt_per_inch)
													  + ($process_factory_order_detail['36_inch_qty'] * 36 * $wt_per_inch)); ?>
	</td>															 
</tr>