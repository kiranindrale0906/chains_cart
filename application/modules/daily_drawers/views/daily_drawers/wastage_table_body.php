<tbody>
<?php
 $href = ADMIN_PATH.'daily_drawers/daily_drawer_wastage_views?';
$sum_in_weight=$sum_out_weight=$sum_balance=$sum_balance_fine=$sum_issue_weight=0;
$w = 'W3';
 foreach ($dd_wastages as $index => $wastage) {
			$sum_in_weight+=$wastage['in_weight'];
      $sum_out_weight+=$wastage['out_weight'];
			$sum_issue_weight+=$wastage['issue_weight'];
			$sum_balance+=$wastage['balance'];
			$sum_balance_fine+=$wastage['balance_fine'];
      if($wastage['hook_kdm_purity']==''){
        $wastage['hook_kdm_purity']=$wastage['purity_group'];
      }
 	?>
	  <tr>
	  	<td><?=$wastage['purity_group']?></td>

	  	 <td>

        <?php
            $department_name=((HOST == 'ARG' || HOST == 'AR Gold') && ($wastage['purity_group']!=100))?"&department_name=Hook":'&section='.$category.'';
          if (!empty($wastage['hook_kdm_purity'])) {
            load_buttons('anchor',array('name'=>'View',
                                        'layout' => 'application',
                                        'class'=>'btn-xs bold blue float-left bar_code_genrate',
                                        'href'=>ADMIN_PATH."issue_and_receipts/daily_drawer_wastage_ledgers/create?hook_kdm_purity=".$wastage['hook_kdm_purity']."".$department_name));
          }
        ?>
      </td>
  	 	<td><?php load_buttons('anchor',array('name'=>'Print',
                             'layout' => 'application',
                             'class'=>'btn-xs bold blue float-left bar_code_genrate ajax',
                             'href'=>base_url().'bar_codes'.'/'.'bar_code_dd_summary?barcode='
                             .$w.
                             '&purity='.$wastage['hook_kdm_purity'].
                             '&type='));
                $bar_code_value = "'".$w."-".purities_code($wastage["hook_kdm_purity"])."'";
                $onclick = "scan_bar_code(".$bar_code_value.")";
                
  	 						load_buttons('anchor',array('name'=>'Scan',
                                      'onclick'=>$onclick,
                                      'layout' => 'application',
                                      'class'=>'btn-xs bold blue float-left',
                                      'href'=>'javascript:void(1)'));
                             ?>
                             	


      </td>
	  	<td>Wastage</td>
	  	<td class="text-right"><a href=<?=$href.'column=in_weight&&category='.$category.'&&purity='.$wastage['hook_kdm_purity']?>><?=isset($wastage['in_weight'])?four_decimal($wastage['in_weight']):0;?></a></td>

	   <td class="text-right"><a href=<?=$href.'column=out_weight&&category='.$category.'&&purity='.$wastage['hook_kdm_purity']?> ><?=isset($wastage['out_weight'])?four_decimal($wastage['out_weight']):0;?></a></td></td>

     	<td class="text-right"><a href=<?=$href.'column=issue_weight&&category='.$category.'&&purity='.$wastage['hook_kdm_purity']?> ><?=isset($wastage['issue_weight'])?four_decimal($wastage['issue_weight']):0;?></a></td></td>

	  	<td class="text-right"><a href=<?=$href.'column=balance&&category='.$category.'&&purity='.$wastage['hook_kdm_purity']?>><?=isset($wastage['balance'])?four_decimal($wastage['balance']):0;?></a></td>

	  	<td class="text-right"><?=isset($wastage['balance_fine'])?four_decimal($wastage['balance_fine']):0;?></td>
	  </tr>
<?php } ?>
<tr class="bg_gray bold">
<td>Total</td>
<td></td>
<td></td>
<td></td>
<td class="text-right"><?=four_decimal($sum_in_weight);?></td>
<td class="text-right"><?=four_decimal($sum_out_weight);?></td>
<td class="text-right"><?=four_decimal($sum_issue_weight);?></td>
<td class="text-right"><?=four_decimal($sum_balance);?></td>
<td class="text-right"><?=four_decimal($sum_balance_fine);?></td>
</tr>
</tbody> 