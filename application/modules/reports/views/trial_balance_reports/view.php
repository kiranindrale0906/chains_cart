<div class="row">
<div class="col-sm-12">
<h6 class='blue text-uppercase bold mb-3'>Trail Balance Report</h6>
  <div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>
	    <th>Acount Name</th>
      <th>Lot Purity</th>
      <th>IN</th>
      <th>OUT</th>
      <th>Balance </th>
	    <th>Balance Fine</th>
	  </tr>
	</thead>
	<tbody>
    <?php
      $total = 0;
      $total_fine = 0;
      if(!empty($trail_balance_reports)){
        foreach ($trail_balance_reports as $index => $account_names) {
          foreach ($account_names as $purity_index => $record) {
          $record['balance']=$record['in_weight']-$record['out_weight'];
          $record['balance_fine']=($record['balance']*$purity_index/100);
          $total += $record['balance'];
          $total_fine += $record['balance_fine'];
          ?>
         <tr>
            <td><?= !empty($index)?$index:'-' ?></td>
            <td><?= !empty($purity_index)?$purity_index:'-' ?></td>
            <td><?= !empty($record['in_weight'])?$record['in_weight']:'-' ?></td>
            <td><?= !empty($record['out_weight'])?$record['out_weight']:'-' ?></td>
            <td><?= four_decimal($record['balance']) ?></td>
            <td><?= four_decimal($record['balance_fine']) ?></td>
        </tr>
        
        <?php }}?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td class=" bold"><?=four_decimal($total);?></td>
          <td class=" bold"><?=four_decimal($total_fine);?></td>
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