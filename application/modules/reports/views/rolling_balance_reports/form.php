<h5> Select Period: 
  <a class="ml-5 <?= ($period=='date') ? 'bold black underline' : '' ?>" 
     href='<?= base_url().'reports/rolling_balance_reports/create' ?>?period=date'>Date</a>
  <a class="ml-5 <?= ($period=='week') ? 'bold black underline' : '' ?>" 
     href='<?= base_url().'reports/rolling_balance_reports/create' ?>?period=week'>Week</a>
  <a class="ml-5 <?= ($period=='month') ? 'bold black underline' : '' ?>" 
     href='<?= base_url().'reports/rolling_balance_reports/create' ?>?period=month'>Month</a>
  <a class="ml-5 <?= ($period=='year') ? 'bold black underline' : '' ?>" 
     href='<?= base_url().'reports/rolling_balance_reports/create' ?>?period=year'>Year</a>
</h5>
<div class="row">
<div class="col-sm-12">
  <div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>
	    <th>Date</th>
      <th>In Gross</th>
      <th>In Pure</th>
      <th>Out Gross</th>
      <th>Out Pure</th>
      <th>Day Balance Gross </th>
	    <th>Day Balance Pure</th>
      <th>Closing Gross</th>
      <th>Closing Pure</th>
	  </tr>
	</thead>
	<tbody>
    <?php
      $total_issue = 0;
      $total_issue_fine = 0;
      $total_receipt = 0;
      $total_receipt_fine = 0;
      $closing_balance = 0;
      $closing_balance_pure = 0;
      $total_balance = 0;
      $total_balance_pure = 0;
      if(!empty($total)){
        foreach ($total as $index => $record) {
          $total_receipt+=four_decimal($record['receipt']['weight']);
          $total_receipt_fine+=four_decimal($record['receipt']['fine']);
          $total_issue+=four_decimal($record['issue']['weight']);
          $total_issue_fine+=four_decimal($record['issue']['fine']);
          $total_balance+=four_decimal($total_receipt-$total_issue);
          $total_balance_pure+=four_decimal($total_receipt_fine-$total_issue_fine);
          $closing_balance=four_decimal($total_receipt-$total_issue);
          $closing_balance_pure=four_decimal($total_receipt_fine-$total_issue_fine);
        ?>
        <tr>
            <td class='bold'><?=$index  ?></td>
            <td><?= four_decimal($record['receipt']['weight']) ?></td>
            <td><?= four_decimal($record['receipt']['fine']) ?></td>
            <td><?= four_decimal($record['issue']['weight']) ?></td>
            <td><?= four_decimal($record['issue']['fine']) ?></td>
            <td><?= four_decimal($record['receipt']['weight']-$record['issue']['weight']) ?></td>
            <td><?= four_decimal($record['receipt']['fine']-$record['issue']['fine']) ?></td>
            <td><?= four_decimal($closing_balance) ?></td>
            <td><?= four_decimal($closing_balance_pure) ?></td>
        </tr>
        
        <?php }?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td class=" bold"><?=four_decimal($total_receipt);?></td>
          <td class=" bold"><?=four_decimal($total_receipt_fine);?></td>
          <td class=" bold"><?=four_decimal($total_issue);?></td>
          <td class=" bold"><?=four_decimal($total_issue_fine);?></td>
          <td class=" bold"><?=four_decimal($total_balance);?></td>
          <td class=" bold"><?=four_decimal($total_balance_pure);?></td>
          <td class=" bold"><?=four_decimal($closing_balance);?></td>
          <td class=" bold"><?=four_decimal($closing_balance_pure);?></td>
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
</div>
</div>