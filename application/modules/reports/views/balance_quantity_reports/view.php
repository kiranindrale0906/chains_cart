
<div class="row">
<div class="col-sm-12">
<h6 class='blue text-uppercase bold mb-3'>Balance Quantity Details</h6>
<div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>
	    <th>Date</th>
      <th>Lot No</th>
      <th>Department Name</th>
      <th>Job Card No</th>
      <th>Party Name</th>
      <th>Weight</th>
      <th>Balance Quantity</th>
      </tr>
	</thead>
	<tbody>
    <?php
      $total_out_weight =$total_quantity =$total_balance_quantity = 0;
      if(!empty($record['balance_quantity_data'])){
        foreach ($record['balance_quantity_data'] as $index => $record) {
          $total_out_weight += $record['out_weight'];
          $total_balance_quantity += $record['balance_quantity'];
          ?>
         <tr>
            <td><?= !empty($record['date'])?date('d-m-Y',strtotime($record['date'])):'-' ?></td>
            <td><?= !empty($record['lot_no'])?$record['lot_no']:'-' ?></td>
            <td><?= !empty($record['department_name'])?$record['department_name']:'-' ?></td>
            <td><?= !empty($record['job_card_no'])?$record['job_card_no']:'-' ?></td>
            <td><?= !empty($record['account'])?$record['account']:'-' ?></td>
            <td><?= !empty($record['out_weight'])?$record['out_weight']:'-' ?></td>
            <td><?= ($record['balance_quantity']) ?></td>
            </tr>
        
        <?php }?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"><?=four_decimal($total_out_weight);?></td>
          <td class=" bold"><?=($total_balance_quantity);?></td>
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