<?php 
	$dd_in_types = array_column($daily_drawer_receipt_reports, 'daily_drawer_type');
	$dd_out_types = array_column($daily_drawer_out_reports, 'daily_drawer_type');
	$dd_types = array_merge($dd_in_types, $dd_out_types);
	$dd_types = array_unique(array_values($dd_types));
	array_push($dd_types,"Sisma Pipe");
	
	$dd_in_records = get_records_by_id($daily_drawer_receipt_reports, 'daily_drawer_type');
	$dd_out_records = get_records_by_id($daily_drawer_out_reports, 'daily_drawer_type');

	/*$dd_in_records['Solid Pipe']['in_weight'] = isset($solid_pipe_reports['in_weight']) ? $solid_pipe_reports['in_weight'] : 0;
	$dd_out_records['Solid Pipe']['out_weight'] = isset($solid_pipe_reports['out_weight']) ? $solid_pipe_reports['out_weight'] : 0;
	$dd_in_records['Solid Pipe']['balance'] = isset($solid_pipe_reports['balance']) ? $solid_pipe_reports['balance'] : 0 ;
	$dd_in_records['Solid Pipe']['balance_fine'] = isset($solid_pipe_reports['balance_fine']) ? $solid_pipe_reports['balance_fine'] : 0;*/

	$dd_in_records['Sisma Pipe']['in_weight'] = isset($sisma_stripe_reports['in_weight']) ? $sisma_stripe_reports['in_weight'] : 0;
	$dd_out_records['Sisma Pipe']['out_weight'] = isset($sisma_stripe_reports['out_weight']) ? $sisma_stripe_reports['out_weight'] : 0;
	$dd_in_records['Sisma Pipe']['balance'] = isset($sisma_stripe_reports['balance']) ? $sisma_stripe_reports['balance'] : 0 ;
	$dd_in_records['Sisma Pipe']['balance_fine'] = isset($sisma_stripe_reports['balance_fine']) ? $sisma_stripe_reports['balance_fine'] : 0;

?>

<tbody>
	  <!-- <tr>
	  	<td>Solid Pipe</td>
	  	<td class="text-right"><?=$solid_pipe_out=isset($solid_pipe_reports['in_weight'])?$solid_pipe_reports['in_weight']:0;?></td>
	  	<td class="text-right"><?=$solid_pipe_out=isset($solid_pipe_reports['out_weight'])?$solid_pipe_reports['out_weight']:0;?></td>
	  	<td class="text-right"><?=$solid_pipe_balance=isset($solid_pipe_reports['balance'])?$solid_pipe_reports['balance']:0;?></td>
	  	<td class="text-right"><?=$solid_pipe_balance_fine=isset($solid_pipe_reports['balance_fine'])?four_decimal($solid_pipe_reports['balance_fine']):0;?></td>
	  </tr> 
	   <tr>
	  	<td>Hollow Pipe</td>
	  	<td class="text-right"><?=$hollw_pipe_in=isset($hollw_pipe_reports['in_weight'])?$hollw_pipe_reports['in_weight']:0;?></td>
	  	<td class="text-right"><?=$hollw_pipe_out=isset($hollw_pipe_reports['out_weight'])?$hollw_pipe_reports['out_weight']:0;?></td>
	  	<td class="text-right"><?=$hollw_pipe_balance=isset($hollw_pipe_reports['balance'])?$hollw_pipe_reports['balance']:0;?></td>
	  	<td class="text-right"><?=$hollw_pipe_balance_fine=isset($hollw_pipe_reports['balance_fine'])?four_decimal($hollw_pipe_reports['balance_fine']):0;?></td>
	  </tr>
	    <tr>
	  	<td>Sisma Stripe</td>
	  	<td class="text-right"><?=$sisma_stripe_in=isset($sisma_stripe_reports['in_weight'])?$sisma_stripe_reports['in_weight']:0;?></td>
	  	<td class="text-right"><?=$sisma_stripe_out=isset($sisma_stripe_reports['out_weight'])?$sisma_stripe_reports['out_weight']:0;?></td>
	  	<td class="text-right"><?=$sisma_stripe_balance=isset($sisma_stripe_reports['balance'])?$sisma_stripe_reports['balance']:0;?></td>
	  	<td class="text-right"><?=$sisma_stripe_balance_fine=isset($sisma_stripe_reports['balance_fine'])?four_decimal($sisma_stripe_reports['balance_fine']):0;?></td>
	  </tr>  -->
	  <?php
			if(!empty($dd_types)){ 
				$w = 'DO'.'1';
	  		foreach ($dd_types as $index => $dd_type) { ?>
				  <tr>
				  	<td><?=$dd_type?></td>
				  	
				  	<td class="text-right"><?= isset($dd_in_records[$dd_type]['in_weight']) ? four_decimal($dd_in_records[$dd_type]['in_weight']) : 0; ?></td>
				  	<td class="text-right"><?= isset($dd_out_records[$dd_type]['out_weight']) ? $dd_out_records[$dd_type]['out_weight'] : 0; ?></td>
				  	<td class="text-right">
				  		<?php 
				  			$in_balance = isset($dd_in_records[$dd_type]['balance']) ? $dd_in_records[$dd_type]['balance'] : 0;
								$out_balance = isset($dd_out_records[$dd_type]['balance']) ? $dd_out_records[$dd_type]['balance'] : 0;
								echo four_decimal($in_balance - $out_balance);
				  		?>
				  	</td>
				  	<td class="text-right">
				  		<?php 
				  			$in_balance_fine = isset($dd_in_records[$dd_type]['balance_fine']) ? $dd_in_records[$dd_type]['balance_fine'] : 0;
								$out_balance_fine = isset($dd_out_records[$dd_type]['balance_fine']) ? $dd_out_records[$dd_type]['balance_fine'] : 0;
								echo four_decimal($in_balance_fine - $out_balance_fine);
				  		?>
				  	</td>
				  </tr>
	  		<?php $w++;}
			}
	  ?>
	  <?php
			if(!empty($dd_types)){ 
				$total_in_weight = 0;
				$total_out_weight = 0;
				$total_balance = 0;
				$total_balance_fine=0;
	  		foreach ($dd_types as $index => $dd_type) {
					$total_in_weight = $total_in_weight + (isset($dd_in_records[$dd_type]['in_weight']) ? four_decimal($dd_in_records[$dd_type]['in_weight']) : 0);	  

					$total_out_weight = $total_out_weight + (isset($dd_out_records[$dd_type]['out_weight']) ? four_decimal($dd_out_records[$dd_type]['out_weight']) : 0);	

					$in_balance = isset($dd_in_records[$dd_type]['balance']) ? $dd_in_records[$dd_type]['balance'] : 0;
					$out_balance = isset($dd_out_records[$dd_type]['balance']) ? $dd_out_records[$dd_type]['balance'] : 0;
					$total_balance = $total_balance + ($in_balance - $out_balance); 
					
					$in_balance_fine = isset($dd_in_records[$dd_type]['balance_fine']) ? $dd_in_records[$dd_type]['balance_fine'] : 0;
					$out_balance_fine = isset($dd_out_records[$dd_type]['balance_fine']) ? $dd_out_records[$dd_type]['balance_fine'] : 0;
					$total_balance_fine = $total_balance_fine + ($in_balance_fine - $out_balance_fine);
	  		}
	  		?>
	  		<tr class="bg_gray">
					<td>Total</td>
					<td></td>
					<td class="text-right"><?= four_decimal($total_in_weight);?></td>
					<td class="text-right"><?= four_decimal($total_out_weight);?></td>
					<td class="text-right"><?= four_decimal($total_balance);?></td>
					<td class="text-right"><?= four_decimal($total_balance_fine);?></td>
				</tr>
			<?php
			}
	  ?>
</tbody> 