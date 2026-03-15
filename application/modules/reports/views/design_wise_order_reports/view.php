<div class="row">
<div class="col-sm-12">
<h6 class='blue text-uppercase bold mb-3'>Design wise Order Report</h6>
  <div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>
	    <th>Design Code</th>
      <th>Order Wt</th>
      <th>Order Qty</th>
      <th>Action</th>

	  </tr>
	</thead>
	<tbody>
    <?php
      $total = 0;
      $total_qty = 0;
      if(!empty($record['design_wise_order_reports'])){
        foreach ($record['design_wise_order_reports'] as $index => $record) {
          $total += $record['order_wt'];
          $total_qty += $record['order_qty'];
          ?>
         <tr>
            <td><?= !empty($record['item_code'])?$record['item_code']:'-' ?></td>
            <td><?= !empty($record['order_wt'])?$record['order_wt']:'-' ?></td>
            <td><?= !empty($record['order_qty'])?$record['order_qty']:'-' ?></td>
            <td><a href="<?= base_url().'reports/design_wise_order_detail_reports?item_code='.(isset($record['item_code'])?$record['item_code']:''); ?>">View</a></td>
          </tr>
        <?php }?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td  class=" bold"><?=$total?></td>
          <td  class=" bold"><?=$total_qty?></td>
          <td  class=" bold"></td>
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
