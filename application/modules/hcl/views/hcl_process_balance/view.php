<div class="row">
  <div class="col-sm-12">
  <h6 class='blue text-uppercase bold mb-3'>HCL Process Balance List</h6>
    <div class="table-responsive m-t-10">
    <table class="table table-sm fixedthead table-default">
  	  <thead>
  	  <tr>
  	    <th>Lot No.</th>
  	    <th>Balance</th>
  	  </tr>
  	</thead>
  	<tbody>
      <?php
        $total = 0;
        if(!empty($hcl_process_list)){
          foreach ($hcl_process_list as $index => $record) {
            $total += $record['balance'];
            ?>
           <tr>
              <td><?= isset($record['lot_no'])?$record['lot_no']:'-'; ?></td>
              <td><?= four_decimal($record['balance']) ?></td>
            </tr>
          
          <?php }?>
          <tr class="bg_gray">
            <td class=" bold">Total</td>
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