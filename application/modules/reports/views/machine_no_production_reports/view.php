<div class="boxrow mb-2">
  <div class="float-left">   
    <h6 class="heading blue bold text-uppercase mb-0">Average Production Reports</h6>
  </div>
</div>
<div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
    <thead>
	  <tr>
        <th>Date</th>
        <th>Process ID</th>
        <th>Product Name</th>
        <th>Process Name</th>
        <th>Department Name</th>
        <th>Lot No.</th>
        <th>Parent Lot Name</th>
        <th class="text-right">Out-Weight</th>
	  </tr>
	</thead>
	<tbody>
      <?php if(!empty($out_weight_details)) {
        $total_outweight = 0;
        foreach ($out_weight_details as $key => $out_weight_detail) {
          if($out_weight_detail['out_weight']>0) {
            $total_outweight += $out_weight_detail['out_weight'];
      ?>
        <tr>
          <td><?= date('d-m-Y', strtotime($_GET['date']))?></td>
          <td><?= $out_weight_detail['id']?></td>
          <td><?= $out_weight_detail['product_name']?></td>
          <td><?= $out_weight_detail['process_name']?></td>
          <td><?= $out_weight_detail['department_name']?></td>
          <td><?= $out_weight_detail['lot_no']?></td>
          <td><?= $out_weight_detail['parent_lot_name']?></td>
          <td class="text-right"><?= four_decimal($out_weight_detail['out_weight'])?></td>
        </tr>
        <?php } }?>
      <tr class="bg_gray">
        <td class="bold" colspan="7">Total</td>
        <td class="text-right bold"><?=four_decimal($total_outweight);?></td>
      </tr>
      <?php } else { ?>
        <tr>
          <td colspan="10">No Out-Weight data found.</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  
  <table class="table table-sm fixedthead table-default">
    <thead>
	  <tr>
        <th>Date</th>
        <th>Process ID</th>
        <th>Product Name</th>
        <th>Process Name</th>
        <th>Department Name</th>
        <th>Lot No.</th>
        <th>Parent Lot Name</th>
        <th class="text-right">Loss</th>
        <th class="text-right">Gross Loss</th>
        <th class="text-right">Fine Loss</th>
	  </tr>
	</thead>
	<tbody>
      <?php if(!empty($loss_details)) {
        $total_loss = 0;
        $total_loss_gross = 0;
        $total_loss_fine = 0;
        foreach ($loss_details as $key => $loss_detail) {
          $total_loss += (isset($loss_detail['loss'])) ? $loss_detail['loss'] : 0;
          $total_loss_gross += (isset($loss_detail['loss_gross'])) ? $loss_detail['loss_gross'] : 0;
          $total_loss_fine += (isset($loss_detail['loss_fine'])) ? $loss_detail['loss_fine'] : 0;
      ?>
        <tr>
          <td><?= date('d-m-Y', strtotime($_GET['date']))?></td>
          <td><?= $loss_detail['id']?></td>
          <td><?= $loss_detail['product_name']?></td>
          <td><?= $loss_detail['process_name']?></td>
          <td><?= $loss_detail['department_name']?></td>
          <td><?= $loss_detail['lot_no']?></td>
          <td><?= $loss_detail['parent_lot_name']?></td>
          <td class="text-right"><?= four_decimal($loss_detail['loss'])?></td>
          <td class="text-right"><?= four_decimal($loss_detail['loss_gross'])?></td>
          <td class="text-right"><?= four_decimal($loss_detail['loss_fine'])?></td>
        </tr>
      <?php } ?>
      <tr class="bg_gray">
        <td class="bold" colspan="7">Total</td>
        <td class="text-right bold"><?=four_decimal($total_loss);?></td>
        <td class="text-right bold"><?=four_decimal($total_loss_gross);?></td>
        <td class="text-right bold"><?=four_decimal($total_loss_fine);?></td>
      </tr>
      <?php } else { ?>
        <tr>
          <td colspan="10">No Loss data found.</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>