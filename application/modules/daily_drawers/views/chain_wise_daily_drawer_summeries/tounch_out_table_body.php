<tbody>
	  <tr>
	  	<td>Tounch Out</td>
	  	<td class="text-right"><?=isset($tounch_out_reports['in_weight'])?$tounch_out_reports['in_weight']:0;?></td>
	  	<td class="text-right"><?=isset($tounch_out_reports['out_weight'])?$tounch_out_reports['out_weight']:0;?></td>
	  	<td class="text-right"><?=isset($tounch_out_reports['balance'])?$tounch_out_reports['balance']:0;?></td>
	  	<td class="text-right"><?=isset($tounch_out_reports['balance_fine'])?four_decimal($tounch_out_reports['balance_fine']):0;?></td>
	  </tr>
</tbody> 