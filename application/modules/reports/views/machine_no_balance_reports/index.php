
  <h6 class='blue text-uppercase bold mb-3'><?php echo @getTableSettings()['page_title']; ?></h6>
 <table class="table table-sm fixedthead table-default">
    <thead>
      <tr>
        <th>Product Name</th>
        <th>Department Name</th>
        <th class="text-right">Total Balance</th>
        <th class="text-right">Total Balance Gross</th>
        <th class="text-right">Total Balance Fine</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sum_balance=$sum_balance_gross=$sum_balance_fine=0;
      if(!empty($machine_no_details)){
       foreach ($machine_no_details as $machine_no_index => $balance) { 
         $sum_balance+=$balance['balance'];
         $sum_balance_gross+=$balance['balance_gross'];
         $sum_balance_fine+=$balance['balance_fine'];?>
        <tr>
          <td class=""><?php echo ($balance['department_name']); ?></td>
          <td class=""><?php echo ($balance['product_name']); ?></td>
          <td class="text-right"><?php echo four_decimal($balance['balance']); ?></td>
          <td class="text-right"><?php echo four_decimal($balance['balance_gross']); ?></td>
          <td class="text-right"><?php echo four_decimal($balance['balance_fine']); ?></td>
        </tr>
       
      <?php } ?>
       <tr class="bg_gray bold">
          <td></td>
          <td></td>
          <td class="text-right"><?=four_decimal($sum_balance);?></td>
          <td class="text-right"><?=four_decimal($sum_balance_gross);?></td>
          <td class="text-right"><?=four_decimal($sum_balance_gross);?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>