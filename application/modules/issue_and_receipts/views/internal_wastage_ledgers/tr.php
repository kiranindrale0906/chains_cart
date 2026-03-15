<?php $issue_melting=$issue_fine=$fine=0?>
<tr>
  <td><?= $record['str_created_date']; ?></td>
  <td><?= $record['account_name'];?></td>
  <td><?= $record['item'];?></td>
  <td class="text-right"><?= four_decimal($record['weight']) ?></td>
  <td class="text-right"><?= four_decimal($record['melting']); ?></td>
  <td class="text-right"><?= $fine=four_decimal($record['fine']); ?></td>
  <td class="text-right"><?= four_decimal($record['internal_wastage']); ?></td>
  <td class="text-right"><?= $issue_melting=four_decimal($record['melting']+$record['internal_wastage']); ?></td>
  <td class="text-right"><?= four_decimal($record['issue_fine']); ?></td>
  <td class="text-right"><?=four_decimal($record['vodator']) ?></td>
</tr>