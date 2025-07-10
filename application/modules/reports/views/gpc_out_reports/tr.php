<tr>
  <td><?= $record['product_name'] ?></td>
  <td><?= $record['design_code'];?></td>
  <td class="text-right"><?= $record['weight'] ?></td>
  <td class="text-right"><?= $record['purity'] ?></td>
  <td class="text-right"><?= four_decimal($record['micro_coating']); ?></td>
  <td class="text-right"><?= four_decimal($record['gpc_powder']); ?></td>
  <td class="text-right"><?= four_decimal($record['kcn']); ?></td>
  <td><?= $record['created_at']; ?></td>
</tr>
