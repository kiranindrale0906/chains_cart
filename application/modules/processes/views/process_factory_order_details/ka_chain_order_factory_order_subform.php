<tr class="">
	<td><?php echo $ka_chain_order_factory_order['customer_name'];?></td>
	<td><?php echo $ka_chain_order_factory_order['due_date']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['wt_in_18_inch'];?></td>
	<td><?php echo $ka_chain_order_factory_order['wt_in_24_inch'];?></td>

	<td>
		<?php 
			$wt_per_inch=0;
			if ($ka_chain_order_factory_order['wt_in_18_inch'] != 0)
        $wt_per_inch = $ka_chain_order_factory_order['wt_in_18_inch'] / 18;
      elseif ($ka_chain_order_factory_order['wt_in_24_inch'] != 0)
        $wt_per_inch = $ka_chain_order_factory_order['wt_in_24_inch'] / 24;
      
      echo four_decimal($wt_per_inch);
	 	?>
  </td>

	<td><?php echo $ka_chain_order_factory_order['14_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['15_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['16_inch_qty']; ?></td>
    <td><?php echo $ka_chain_order_factory_order['17_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['18_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['19_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['20_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['21_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['22_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['23_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['24_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['25_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['26_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['27_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['28_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['29_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['30_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['31_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['32_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['33_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['34_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['35_inch_qty']; ?></td>
	<td><?php echo $ka_chain_order_factory_order['36_inch_qty']; ?></td>
	<td class="total_weight">
		<?php echo four_decimal(  ($ka_chain_order_factory_order['14_inch_qty'] * 14 * $wt_per_inch)
												 	  +($ka_chain_order_factory_order['15_inch_qty'] * 15 * $wt_per_inch)
												 	  + ($ka_chain_order_factory_order['16_inch_qty'] * 16 * $wt_per_inch)
												 	  + ($ka_chain_order_factory_order['17_inch_qty'] * 17 * $wt_per_inch)
												 	  + ($ka_chain_order_factory_order['18_inch_qty'] * 18 * $wt_per_inch)
												 	  + ($ka_chain_order_factory_order['19_inch_qty'] * 19 * $wt_per_inch)
													  + ($ka_chain_order_factory_order['20_inch_qty'] * 20 * $wt_per_inch)
													  + ($ka_chain_order_factory_order['21_inch_qty'] * 21 * $wt_per_inch)
													  + ($ka_chain_order_factory_order['22_inch_qty'] * 22 * $wt_per_inch)
													  + ($ka_chain_order_factory_order['23_inch_qty'] * 23 * $wt_per_inch)
													  + ($ka_chain_order_factory_order['24_inch_qty'] * 24 * $wt_per_inch)
													  + ($ka_chain_order_factory_order['25_inch_qty'] * 25 * $wt_per_inch)
													  + ($ka_chain_order_factory_order['26_inch_qty'] * 26 * $wt_per_inch)
													  + ($ka_chain_order_factory_order['27_inch_qty'] * 27 * $wt_per_inch)
													  + ($ka_chain_order_factory_order['28_inch_qty'] * 28 * $wt_per_inch)
													  + ($ka_chain_order_factory_order['29_inch_qty'] * 29 * $wt_per_inch)
													  + ($ka_chain_order_factory_order['30_inch_qty'] * 30 * $wt_per_inch)
													  + ($ka_chain_order_factory_order['31_inch_qty'] * 31 * $wt_per_inch)
													  + ($ka_chain_order_factory_order['32_inch_qty'] * 32 * $wt_per_inch)
													  + ($ka_chain_order_factory_order['33_inch_qty'] * 33 * $wt_per_inch)
													  + ($ka_chain_order_factory_order['34_inch_qty'] * 34 * $wt_per_inch)
													  + ($ka_chain_order_factory_order['35_inch_qty'] * 35 * $wt_per_inch)
													  + ($ka_chain_order_factory_order['36_inch_qty'] * 36 * $wt_per_inch)); ?>
	</td>															 
</tr>