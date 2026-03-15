<tbody>
  <tr>
  	<td>Ghiss</td>
  	<td class="text-right"><?=isset($ghiss_reports['in_weight'])?$ghiss_reports['in_weight']:0;?></td>
  	<td class="text-right"><?=isset($ghiss_reports['out_weight'])?$ghiss_reports['out_weight']:0;?></td>
  	<td class="text-right"><?=isset($ghiss_reports['balance'])?$ghiss_reports['balance']:0;?></td>
  	<td class="text-right"><?=isset($ghiss_reports['balance_fine'])?four_decimal($ghiss_reports['balance_fine']):0;?></td>
  </tr>
</tbody> 