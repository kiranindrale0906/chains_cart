<?php ?>
  <div class="boxrow mb-2">
    <div class="float-left">
      <h6 class="heading blue bold text-uppercase mb-0"><?= @getTableSettings()['page_title']; ?></h6>
    </div>
  </div>



<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th>Date</th>
      <th>Balance</th>
      <th>GPC Balance</th>
      <th>Rolling</th>
    </tr>
  </thead>
  <tbody>
  <td><?=date('d-m-Y')?></td>
  <td><?=$balance_rolling=!empty($balance)?four_decimal(abs($balance)):0?></td>
  <td><?=$gpc_balance_rolling=!empty($gpc_out_balance)?four_decimal($gpc_out_balance):0?></td>
  <td><?=!empty($balance_rolling)?four_decimal($gpc_balance_rolling/$balance_rolling):0?></td>
    
  </tbody>
</table>