<tbody>
  <tr>
  	<td><?= $wastage_type ?></td>
  	<td class="text-right"><?=isset($records['in_weight'])?four_decimal($records['in_weight']):0;?></td>
  	<td class="text-right"><?=isset($records['out_weight'])?four_decimal($records['out_weight']):0;?></td>
  	<td class="text-right"><?=isset($records['balance'])?four_decimal($records['balance']):0;?></td>
  	<td class="text-right"><?=isset($records['balance_fine'])?four_decimal($records['balance_fine']):0;?></td>
  </tr>
</tbody> 