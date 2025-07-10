<thead>
  <tr>
    <th >Purity Group</th>
    <th >Barcode</th>
    <th >Type</th>
    <th class="text-right">In</th>
    <th class="text-right">Out</th>
    <th class="text-right">Issue wastage</th>
    <th class="text-right">Balance</th>
    <th class="text-right">Balance Fine</th>
  </tr>
</thead>
<tbody>
<?php
 $href = ADMIN_PATH.'daily_drawers/daily_drawer_wastage_views?';
$sum_in_weight=$sum_out_weight=$sum_balance=$sum_balance_fine=$sum_issue_daily_drawer_wastage=0;
$w = 'W3';
 foreach ($wastages as $index => $wastage) {
			$sum_in_weight+=$wastage['in_weight'];
			$sum_out_weight+=$wastage['out_weight'];
			$sum_issue_daily_drawer_wastage+=@$wastage['issue_daily_drawer_wastage'];
			$sum_balance+=$wastage['balance'];
			$sum_balance_fine+=$wastage['balance_fine'];
 	?>
	  <tr>
	  	<td><?=$wastage['purity_group']?></td>
	  	 <td><?php load_buttons('anchor',array('name'=>'Print',
                                      'layout' => 'application',
                                      'class'=>'btn-xs bold blue float-left bar_code_genrate ajax',
                                      'href'=>base_url().'bar_codes'.'/'.'bar_code_dd_summary?barcode='
                                      .$w.
                                      '&purity='.$wastage['hook_kdm_purity'].
                                      '&type='))?></td>
	  	<td>Wastage</td>
	  	<td class="text-right"><a href=<?=$href.'column=in_weight&&purity='.$index.'&&chain_name='.str_replace(' ','_',$chain_name)?>><?=isset($wastage['in_weight'])?$wastage['in_weight']:0;?></a></td>

	  	<td class="text-right"><a href=<?=$href.'column=out_weight&&purity='.$index.'&&chain_name='.str_replace(' ','_',$chain_name)?> ><?=isset($wastage['out_weight'])?$wastage['out_weight']:0;?></a></td></td>
	  	<td class="text-right"><a href=<?=$href.'column=issue_weight&&purity='.$index.'&&chain_name='.str_replace(' ','_',$chain_name)?> ><?=isset($wastage['issue_daily_drawer_wastage'])?$wastage['issue_daily_drawer_wastage']:0;?></a></td></td>

	  	<td class="text-right"><a href=<?=$href.'column=balance&&purity='.$wastage['hook_kdm_purity'].'&&chain_name='.str_replace(' ','_',$chain_name)?>><?=isset($wastage['balance'])?$wastage['balance']:0;?></a></td>

	  	<td class="text-right"><?=isset($wastage['balance_fine'])?four_decimal($wastage['balance_fine']):0;?></td>
	  </tr>
<?php } ?>
<tr class="bg_gray">
<td>Total</td>
<td></td>
<td></td>
<td class="text-right"><?=four_decimal($sum_in_weight);?></td>
<td class="text-right"><?=four_decimal($sum_out_weight);?></td>
<td class="text-right"><?=four_decimal($sum_issue_daily_drawer_wastage);?></td>
<td class="text-right"><?=four_decimal($sum_balance);?></td>
<td class="text-right"><?=four_decimal($sum_balance_fine);?></td>
</tr>
</tbody> 