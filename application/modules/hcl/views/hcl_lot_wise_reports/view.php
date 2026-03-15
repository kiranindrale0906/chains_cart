<div class="row">
  <div class="col-sm-12">
  <h6 class='blue text-uppercase bold mb-3'>HCL Wastage Report</h6>
    <div class="table-responsive m-t-10">
    <table class="table table-sm fixedthead table-default">
  	  <thead>
  	  <tr>
        <th>Product Name</th>
        <th>Process Name</th>
        <th>Department Name</th>
  	    <th>Lot No.</th>
  	    <th>Gross Balance</th>
  	  </tr>
  	</thead>
  	<tbody>
      <?php
        $total = 0;
        if(!empty($record['hcl_wastage_data'])){
          foreach ($record['hcl_wastage_data'] as $index => $record) {
            $total += $record['out_weight'];
            ?>
           <tr>
              <td><?= isset($record['product_name'])?$record['product_name']:'-'; ?></td>
              <td><?= isset($record['process_name'])?$record['process_name']:'-'; ?></td>
              <td><?= isset($record['department_name'])?$record['department_name']:'-'; ?></td>
              <td><?= isset($record['lot_no'])?$record['lot_no']:'-'; ?></td>
              <td><?= four_decimal($record['out_weight']) ?></td>
            </tr>
          
          <?php }?>
          <tr class="bg_gray">
            <td class=" bold">Total</td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"><?=four_decimal($total);?></td>
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