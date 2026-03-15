<div class="row">
  <div class="col-sm-12">
  <h6 class='blue text-uppercase bold mb-3'>HCL Wastage Lot No Wise Report</h6>
    <div class="table-responsive m-t-10">
    <table class="table table-sm fixedthead table-default">
  	  <thead>
  	  <tr>
        <th>Product Name</th>
  	    <th>Lot No.</th>
        <th>Balance</th>
        <th>Balance Gross</th>
  	    <th>Balance Fine</th>
        <th>Action</th>
  	  </tr>
  	</thead>
  	<tbody>
      <?php
        $total = 0;
        if(!empty($record['lot_wise_data'])){
          foreach ($record['lot_wise_data'] as $index => $record) {
            $total += $record['balance_hcl_wastage'];
            ?>
           <tr>
              <td><?= isset($record['product_name'])?$record['product_name']:'-'; ?></td>
              <td><?= isset($record['lot_no'])?$record['lot_no']:'-'; ?></td>
              <td><?= four_decimal($record['balance_hcl_wastage']) ?></td>
              <td><?= four_decimal($record['balance_hcl_wastage_gross']) ?></td>
              <td><?= four_decimal($record['balance_hcl_wastage_fine']) ?></td>
              <td><a href="<?=base_url().'hcl/hcl_wastages?'.urlencode('like[lot_no]').'='.$record['lot_no'];?>">View</a></td>
            </tr>
          
          <?php }?>
          <tr class="bg_gray">
            <td class=" bold">Total</td>
            <td class=" bold"></td>

            <td class=" bold"><?=four_decimal($total);?></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
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

  <div class="col-sm-12">
  <h6 class='blue text-uppercase bold mb-3'>HCL Wastage Parent Lot No Wise Report</h6>
    <div class="table-responsive m-t-10">
    <table class="table table-sm fixedthead table-default">
      <thead>
      <tr>
        <th>Product Name</th>
        <th>Parent Lot Name.</th>
        <th>Balance</th>
        <th>Balance Gross</th>
        <th>Balance Fine</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $total = 0;
        if(!empty($parent_lot_wise_data)){
          foreach ($parent_lot_wise_data as $index => $record) {
            $total += $record['balance_hcl_wastage'];
            ?>
           <tr>
              <td><?= isset($record['product_name'])?$record['product_name']:'-'; ?></td>
              <td><?= isset($record['parent_lot_name'])?$record['parent_lot_name']:'-'; ?></td>
              <td><?= four_decimal($record['balance_hcl_wastage']) ?></td>
              <td><?= four_decimal($record['balance_hcl_wastage_gross']) ?></td>
              <td><?= four_decimal($record['balance_hcl_wastage_fine']) ?></td>
              <td><a href="<?=base_url().'hcl/hcl_wastages?'.urlencode('like[parent_lot_name]').'='.$record['parent_lot_name'];?>">View</a></td>
            </tr>
          
          <?php }?>
          <tr class="bg_gray">
            <td class=" bold">Total</td>
            <td class=" bold"></td>
            <td class=" bold"><?=four_decimal($total);?></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
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