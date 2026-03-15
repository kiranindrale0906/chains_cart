<div class="table-responsive m-t-10">
  <h6 class='blue text-uppercase bold mb-3'>Purity Wise <?= $title ?></h6>
  <table class="table table-sm fixedthead table-default">
    <thead>
    <tr>
      <th>Purity</th> 
      <th>Balance</th>
      <th>Balance Gross</th>
      <th>Balance Fine</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $total_balance = 0;
      $total_balance_gross = 0;
      $total_balance_fine = 0;
      if(!empty($balances)){
        foreach ($balances as $index => $balance) {
          $total_balance += $balance['balance'];
          $total_balance_gross += $balance['balance_gross'];
          $total_balance_fine += $balance['balance_fine'];
          ?>
         <tr>
            <td><?= $index ?></td>
            <td><?= four_decimal($balance['balance']) ?></td>
            <td><?= four_decimal($balance['balance_gross']) ?></td>
            <td><?= four_decimal($balance['balance_fine']) ?></td>
          </tr>
        
        <?php }?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td class=" bold"><?=four_decimal($total_balance);?></td>
          <td class=" bold"><?=four_decimal($total_balance_gross);?></td>
          <td class=" bold"><?=four_decimal($total_balance_fine);?></td>
        </tr> 

     <?php }else{ ?>
        <tr>
          <td>No Record Found.</td>
        </tr>
      <?php }
    ?>
  </tbody>
  </table>
</div>